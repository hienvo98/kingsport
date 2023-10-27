<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\Libraries\ImageStorageLibrary;
use App\Libraries\MimeChecker;
use App\Libraries\Helper;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ArticleController extends Controller
{
    protected $imageStorage;

    public function __construct(ImageStorageLibrary $imageStorage)
    {
        $this->imageStorage = $imageStorage;
    }

    public function index(Request $request, $id = '')
    {
        //kiểm tra xem đang ở mục bài viết đã xoá không
        $trash = $request->trash;
        //kiểm tra xem id danh mục có tồn tại hay không nếu có thì lọc bài viết theo danh mục 
        if (empty($id)) {
            //kiểm tra có đang ở mục bài đã xoá nếu không lấy ds tất cả các bài viết
            $articles = $trash == 'on' ? Article::with('category')->where('status', 'off')->paginate(2) : Article::with('category')->paginate(9);
            $published_article_list = $this->get_published_article_list($articles); //lấy ds các bài viết đã xuất bản
            $unpublished_article_list = $this->get_unpublished_article_list($articles); //lấy ds các bài viết chưa xuất bản
        } else {
            if (empty(Category::find($id))) abort(404); //kiểm tra danh mục có tồn tại
            $articles = Category::with('articles')->find($id)->articles()->paginate(9); //lấy ds tất cả các bài viết có liên quan đến danh mục
            $published_article_list = $this->get_published_article_list($articles); // lấy ds bài viết đã được xuất bản
            $unpublished_article_list = $this->get_unpublished_article_list($articles); // lấy ds bài viết chưa được xuất bản
        }
        $category = Category::get(); // lấy tất cả danh mục
        $count = [
            'allArticles' => Article::count(), // số lượng tất cả bài viết
            'deleteArticles'=>Article::where('status','off')->count() // số lượng bài đã xoá
        ];
        return view('admin.article.index', compact('articles', 'published_article_list', 'unpublished_article_list', 'trash', 'category','count','id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $_category = Category::with(['products' => function ($query) {
            $query->where('status', 'on');
        }])->where('status', 1)->select('id', 'name')->get();
        return view('admin.article.create', ['category' => $_category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        // return response() -> json('messages'=>$request->)
        //kiểm tra bài viết có sản phẩm liên quan không
        if ($request->productInArticle) {
            $product_id = serialize(Product::whereIn('name', explode(',', $request->productInArticle))->pluck('id')->toArray()); //xử lý id của sản phẩm liên quan
            $request->merge(['product_id' => $product_id]); //lưu danh sách id sản phẩm liên quan vào request để tạo bài viết
        };
        $request->merge(['user_id' => Auth::id()]); // lưu id người tạo
        //kiểm tra,xử lý và lưu ngày xuất bản bài viết
        $request->publish_date?$request->merge(['publish_date'=>Carbon::parse($request->input('publish_date'))]):'';
        //kiểm tra có thumbnail bài viết
        if($request->thumbnailArticle){
            //xử lý và lưu ảnh thumbnail
            $imagePath = $this->imageStorage->storeImage($request->thumbnailArticle, 'blog_images/' . $request->input('title') . '/' . 'thumbnail');
            $request->merge(['thumbnail'=>basename($imagePath)]); //lưu tên ảnh vào request
        }

        $ArticleContent = $request->content;// content của bài viết chưa xử lý
        $title = $request->title; //tiêu để bài viết
        //xử lý, tất cả ảnh trong bài viết và trả về nội dung bài viết đã xử lý.
        $content = $this->imageStorage->processAndSaveImagesInContent($ArticleContent,'blog_images',$title); //nội dung đã xử lý
        $request->merge(['content'=>$content]); // lưu nội dung vào $request
        //tạo bài viết
        if (Article::create($request->all())) {
            return response([
                'status' => 'success',
                'code' => 200,
                'messages' => 'đã tạo bài viết thành công'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Article::find($id);
        if (empty($post)) abort(404);
        $content = $post->content;
        $title = $post->title;
        //cập nhật url để hiển thị ảnh trong bài viết
        $contentUpdatedUrl = $this->imageStorage->updateUrlContent($content,'blog_images',$title);
        $post->content = $contentUpdatedUrl;
        $category = Category::with('products')->get();
        return view('admin.article.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, string $id)
    {
        $post = Article::find($id);
        if (empty($post)) return response()->json(['code' => 404, 'messages' => 'không tìm thấy sản phẩm', 404]);
        //sử lý thay đổi title bài viết
        if ($request->title != $post->title) {
            //lấy tên thư mục cũ
            $oldPathTitle = public_path("storage/uploads/blog_images/$post->title");
            $newPathTitle = public_path("storage/uploads/blog_images/$request->title");
            if (File::isDirectory($oldPathTitle)) {
                File::move($oldPathTitle, $newPathTitle);
            }
            $post->title = $request->title;
            $post->save();
        }
        //xử lý khi thay đổi thumbnail
        if ($request->thumbnail) {
            $oldThumbNail = public_path("storage/uploads/blog_images/$post->title/thumbnail/$post->thumbnail");
            if (File::exists($oldThumbNail)) {
                unlink($oldThumbNail);
                $newThumbPath = ImageStorageLibrary::storeImage($request->thumbnail, "blog_images/$post->title/thumbnail");
                $newThumbName = basename($newThumbPath);
                $post->thumbnail = $newThumbName;
            }
        }
        //xử lý khi thay đổi content
        if (!File::isDirectory(public_path("storage/uploads/blog_images/$post->title/content2"))) {
            File::makeDirectory(public_path("storage/uploads/blog_images/$post->title/content2"), 0755, true);
        }
        $content = $request->content;
        preg_match_all('/<img[^>]+src="([^"]+)"/', $content, $matches);
        $stt = 0;

        foreach ($matches[1] as $key => $path) {
            $basename = basename($path);
            $oldPath = public_path("storage/uploads/blog_images/$post->title/content/$basename");
            if (File::exists($oldPath)) {
                $newPath = public_path("storage/uploads/blog_images/$post->title/content2/$basename");
                //copy ảnh sang thư mục tạm thời
                File::copy($oldPath, $newPath);
                //thay thế đường dẫn bằng tên hình ảnh
                $content = str_replace($path, $basename, $content);
                unset($matches[1][$key]);
            } else {
                //lưu ảnh mới có trong content
                $pathNewImage =  $this->storeImage($path, $post->title, 'content2');
                $imageName = pathinfo($pathNewImage, PATHINFO_BASENAME);
                //thay thế đường dẫn bằng tên hình ảnh
                $content = str_replace($path, $imageName, $content);
            }
        }
        //xoá thư mục content cũ
        if (File::isDirectory(public_path("storage/uploads/blog_images/$post->title/content"))) {
            File::deleteDirectory(public_path("storage/uploads/blog_images/$post->title/content"));
        }
        //đổi tên thư mục tạm thời content2 thành content
        if (File::isDirectory(public_path("storage/uploads/blog_images/$post->title/content2"))) {
            File::move(public_path("storage/uploads/blog_images/$post->title/content2"), public_path("storage/uploads/blog_images/$post->title/content"));
        };
        $post->content = $content;
        $post->description = $request->description;
        $post->url = $request->input('url');
        $post->category_id = $request->input('category_id');
        $post->seo_title = $request->input('seo_title');
        $post->seo_description = $request->input('seo_description');
        $post->seo_keywords = $request->input('seo_keywords');
        $post->publish_date = Carbon::parse($request->input('publish_date'));
        $post->status = $request->input('status');
        $post->on_form = $request->input('on_form');
        if ($request->productInArticle) {
            $product_id = serialize(Product::whereIn('name', explode(',', $request->productInArticle))->pluck('id')->toArray()); //xử lý id của sản phẩm liên quan
           $post->product_id = $product_id;
        };
        $post->save();
        return response()->json(['code' => 200, 'messages' => $post], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Article::find($id);

        if (empty($post)) return response()->json(['code' => 404, 'messages' => 'không tìm thấy sản phẩm'], 404);
        $post->status = 'off';
        if ($post->save()) {
            return response()->json([
                'code' => 200,
                'messages' => $id
            ], 200);
        }
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $articles = Article::with('category')->where('title', 'like', "%$keywords%")->paginate(9);
        $published_article_list = $this->get_published_article_list($articles); //lấy ds các bài viết đã xuất bản
        $unpublished_article_list = $this->get_unpublished_article_list($articles); //lấy ds các bài viết chưa xuất bản
        $articles_html = $this->get_card_html($articles,'search'); //lấy mã html của tất cả bài viết để render ra giao diện
        $published_article_html = $this->get_card_html($published_article_list,'search'); //lấy mã html của bài viết chưa xuất bản
        $unpublished_article_html = $this->get_card_html($unpublished_article_list,'search'); // lấy mã html của bài viết đã xuất bản
        return response()->json([
            'code' => 200,
            'blogs' => $articles_html,
            'blogPendings' => $unpublished_article_html,
            'blogCompleteds' => $published_article_html
        ], 200);
    }

    public function filterArticlesAjax($flag = 'index')
    {
        if ($flag == 'index') {
            $articles = Article::with('category')->paginate(9);
            $unpublished_article_list = $this->get_unpublished_article_list($articles);
            $published_article_list = $this->get_published_article_list($articles);
        } else {
            if($flag=='trash'){
                $articles = Article::with('category')->where('status', 'off')->paginate(9);
                $unpublished_article_list = $this->get_unpublished_article_list($articles);
                $published_article_list = $this->get_published_article_list($articles);
            }else{
                $category = Category::find($flag);
                if(empty($category)) return response()->json(['code'=>404,'messages'=>'không tìm thấy danh mục'],404);
                $articles = $category->articles()->paginate(9);
                $unpublished_article_list = $this->get_unpublished_article_list($articles);
                $published_article_list = $this->get_published_article_list($articles);
            }
        }
        $articles_html = $this->get_card_html($articles,'current');
        $published_article_html = $this->get_card_html($published_article_list,'current');
        $unpublished_article_html = $this->get_card_html($unpublished_article_list,'current');
        $nav = $this->get_nav($articles, $flag);
        return response()->json([
            'code' => 200,
            'blogs' => $articles_html,
            'blogPendings' => $unpublished_article_html,
            'blogCompleteds' => $published_article_html,
            'nav' => $nav
        ], 200);
    }

    private function get_published_article_list($articles)
    {
        $published_article_list = $articles->filter(function ($article) {
            return Carbon::parse($article->publish_date)->isPast();
        });
        return $published_article_list;
    }

    private function get_unpublished_article_list($articles)
    {
        $unpublished_article_list = $articles->filter(function ($article) {
            return Carbon::parse($article->publish_date)->isFuture();
        });
        return $unpublished_article_list;
    }

    private function get_card_html($articles,$flag)
    {
        $articles_html = '';
        foreach ($articles as $article) {
            $pathThumbnail = url("storage/uploads/blog_images/$article->title/thumbnail/$article->thumbnail");
            $routeEdit = route('admin.post.edit', ['id' => $article->id]);
            $routeDelete = url("/admin/post/delete/$article->id");
            $disabled = $article->status == 'off' ? 'disabled' : '';
            $title = Helper::customName($article->title,15);
            $articles_html .=
                "<div class='col-xl-4 $flag'>
            <div class='card custom-card task-pending-card' style='height: 290px'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between flex-wrap gap-2'>
                        <div>
                            <p class='fw-semibold mb-3 d-flex align-items-center'><a
                                    href='javascript:void(0);'></i></a> $title 
                            </p>
                            <p class='mb-3'>Ngày tạo : <span
                                    class='fs-12 mb-1 text-muted'>$article->created_at</span></p>
                            <p class='mb-3'>Ngày xuất bản : <span
                                    class='fs-12 mb-1 text-muted'>$article->publish_date</span></p>
                            <p class='mb-0'>Người tạo :
                                <span class='avatar-list-stacked ms-1'>
                                    <span class='avatar avatar-sm avatar-rounded'>
                                        <img src='$pathThumbnail'
                                            alt='img'>
                                    </span>
                                </span>
                            </p>
                        </div>
                        <div>
                            <div class='btn-list'>
                                <a href='$routeEdit'
                                    class='btn btn-icon btn-sm btn-info-light'><i
                                        class='ri-edit-line'></i></a>
                                <button class='btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnDelete'
                                    data-id='$article->id'
                                    $disabled data-route='$routeDelete'><i
                                        class='ri-delete-bin-line'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        return $articles_html;
    }


    private function get_nav($articles, $flag)
    {
        $nav = "<ul class='pagination mb-0'>";
        //nút previous
        $nav .= "<li class='page-item disabled'>
            <span class='page-link'>Previous</span>
        </li>";
        // danh sách các trang
        for ($i = 1; $i <= $articles->lastPage(); $i++) {
            $active = $i === $articles->currentPage() ? 'active' : '';
            $disabled =  $i === $articles->currentPage() ? 'disable-link' : '';
            if ($flag == 'index') {
                $link = route('admin.post.index') . "?page=$i";
            } else {
                $link = $flag == 'trash' ? route('admin.post.index') . "?trash=on&page=$i" : route('admin.post.index', ['id' => $flag]) . "?page=$i";
            }
            $nav .= "<li class='page-item $active'>
            <a class='page-link  $disabled' href='$link'> $i </a>
        </li>";
        }

        //nút next
        if ($articles->hasMorePages()) {
            if ($flag == 'index') {
                $link = route('admin.post.index') . "?page=2";
            } else {
                $link = $flag == 0 ? route('admin.post.index') . "?trash=on&page=2" : route('admin.post.index', ['id' => $flag]) . "?page=2";
            }
            $nav .=  "<li class='page-item'>
            <a class='page-link' href='$link' aria-label='Next'>
                <span aria-hidden='true'>Next</span>
            </a>
        </li>";
        } else {
            $nav .= "<li class='page-item disabled'>
            <span class='page-link'>Next</span>
        </li>";
        }
        $nav .= "</ul>";
        return $nav;
    }

    private function storeImage($imagePath, $title, $folder)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagePath));
        $imageName = time() . '_' . Str::random(10) . '.png';
        Storage::disk('public')->put('uploads/blog_images/' . $title . "/$folder/" . $imageName, $imageData);
        return asset('storage/uploads/blog_images/' . $imageName);
    }
}
