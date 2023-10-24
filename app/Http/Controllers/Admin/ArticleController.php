<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequestCreate;
use Illuminate\Support\Facades\Storage;
use App\Libraries\ImageStorageLibrary;
use App\Libraries\MimeChecker;
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
        if (!empty($id)) {
            if (empty(Category::find($id))) abort(404);
            $blog = Category::with('articles')->find($id)->articles()->paginate(2);
            $blogcompleteds = $blog->filter(function ($article) {
                return Carbon::parse($article->publish_date)->isPast();
            });
            $blogPendings = $blog->filter(function ($article) {
                return Carbon::parse($article->publish_date)->isFuture();
            });
        } else {
            $blog = $request->trash == 'on' ? Article::with('category')->where('status', 'off')->paginate(2) : Article::with('category')->paginate(2);
            $blogPendings = $blog->filter(function ($article) {
                return Carbon::parse($article->publish_date)->isFuture();
            });
            $blogcompleteds = $blog->filter(function ($article) {
                return Carbon::parse($article->publish_date)->isPast();
            });
        }
        $category = Category::get();
        return view('admin.article.index', [
            'blog' => $blog,
            'category' => $category,
            'blogcompleteds' => $blogcompleteds,
            'blogPendings' => $blogPendings,
            'trash'=>$request->trash
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $_category = Category::where('status', 1)->select('id', 'name')->get();
        return view('admin.article.create', ['category' => $_category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blog = new Article;
        $blog->user_id = Auth::id();
        $blog->title = $request->input('title');
        $blog->url = $request->input('url');
        $blog->category_id = $request->input('category_id');
        $blog->seo_title = $request->input('seo_title');
        $blog->seo_description = $request->input('seo_description');
        $blog->seo_keywords = $request->input('seo_key');
        $blog->publish_date = Carbon::parse($request->input('publish_date'));
        $blog->status = $request->input('status');
        $thumbnail = $request->file('thumbnail');
        if ($thumbnail) {
            if (!MimeChecker::isImage($thumbnail->getPathname())) {
                return response()->json(['message' => 'Tệp không hợp lệ. Chỉ cho phép tải lên hình ảnh dưới 3MB và phải ở dạng jpg,png,webp,jpeg.'], 400);
            } else {
                $imagePath = $this->imageStorage->storeImage($thumbnail, 'blog_images/' . $request->input('title') . '/' . 'thumbnail');
                $fileName = basename($imagePath);
                $blog->thumbnail = $fileName;
            }
        }

        $blog->on_form = $request->input('form_status');

        $blogContent = $request->input('description');

        preg_match_all('/<img[^>]+src="([^"]+)"/', $blogContent, $matches);

        $imagePaths = $matches[1];
        foreach ($imagePaths as $imagePath) {
            $newImagePath = $this->storeImage($imagePath, $request->input('title'), 'content');

            // Lấy tên tệp hình ảnh từ đường dẫn
            $imageName = pathinfo($newImagePath, PATHINFO_BASENAME);

            // Thay thế đường dẫn bằng tên tệp hình ảnh
            $blogContent = str_replace($imagePath, $imageName, $blogContent);
        }
        $blog->content = $blogContent;

        if ($blog->save()) {
            return response([
                'status' => 'success',
                'code' => 200,
                'data' => $blog
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
        preg_match_all('/<img[^>]+src="([^"]+)"/', $post->content, $matches);
        foreach ($matches[1] as $img) {
            $post->content = str_replace($img, url("storage/uploads/blog_images/$post->title/content/$img"), $post->content);
        }
        $category = Category::all();
        if (empty($post)) abort(404);
        return view('admin.article.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        $post->url = $request->input('url');
        $post->category_id = $request->input('category_id');
        $post->seo_title = $request->input('seo_title');
        $post->seo_description = $request->input('seo_description');
        $post->seo_keywords = $request->input('seo_key');
        $post->publish_date = Carbon::parse($request->input('publish_date'));
        $post->status = $request->input('status');
        $post->on_form = $request->input('form_status');
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
        $blogs = Article::with('category')->where('title', 'like', "%$keywords%")->paginate(9);
        $blogPendings = $blogs->filter(function ($artical) {
            return Carbon::parse($artical->publish_date)->isFuture();
        });
        $blogCompleteds = $blogs->filter(function ($artical) {
            return Carbon::parse($artical->publish_date)->isPast();
        });
        $blogHtml = '';
        foreach ($blogs as $blog) {
            $pathThumbnail = url("storage/uploads/blog_images/$blog->title/thumbnail/$blog->thumbnail");
            $routeEdit = route('admin.post.edit', ['id' => $blog->id]);
            $disabled = $blog->status == 'off' ? 'disabled' : '';
            $blogHtml .=
                "<div class='col-xl-4'>
            <div class='card custom-card task-pending-card'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between flex-wrap gap-2'>
                        <div>
                            <p class='fw-semibold mb-3 d-flex align-items-center'><a
                                    href='javascript:void(0);'></i></a> $blog->title 
                            </p>
                            <p class='mb-3'>Ngày tạo : <span
                                    class='fs-12 mb-1 text-muted'>$blog->created_at</span></p>
                            <p class='mb-3'>Ngày xuất bản : <span
                                    class='fs-12 mb-1 text-muted'>$blog->publish_date</span></p>
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
                                <button class='btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnPostDelete'
                                    data-id='$blog->id'
                                    $disabled><i
                                        class='ri-delete-bin-line'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        $blogCompletedsHtml = '';
        foreach ($blogCompleteds as $blog) {
            $pathThumbnail = url("storage/uploads/blog_images/$blog->title/thumbnail/$blog->thumbnail");
            $routeEdit = route('admin.post.edit', ['id' => $blog->id]);
            $disabled = $blog->status == 'off' ? 'disabled' : '';
            $blogCompletedsHtml .=
                "<div class='col-xl-4'>
            <div class='card custom-card task-pending-card'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between flex-wrap gap-2'>
                        <div>
                            <p class='fw-semibold mb-3 d-flex align-items-center'><a
                                    href='javascript:void(0);'></i></a> $blog->title 
                            </p>
                            <p class='mb-3'>Ngày tạo : <span
                                    class='fs-12 mb-1 text-muted'>$blog->created_at</span></p>
                            <p class='mb-3'>Ngày xuất bản : <span
                                    class='fs-12 mb-1 text-muted'>$blog->publish_date</span></p>
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
                                <button class='btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnPostDelete'
                                    data-id='$blog->id'
                                    $disabled><i
                                        class='ri-delete-bin-line'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        $blogPendingsHtml = '';
        foreach ($blogPendings as $blog) {
            $pathThumbnail = url("storage/uploads/blog_images/$blog->title/thumbnail/$blog->thumbnail");
            $routeEdit = route('admin.post.edit', ['id' => $blog->id]);
            $disabled = $blog->status == 'off' ? 'disabled' : '';
            $blogPendingsHtml .=
                "<div class='col-xl-4'>
            <div class='card custom-card task-pending-card'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between flex-wrap gap-2'>
                        <div>
                            <p class='fw-semibold mb-3 d-flex align-items-center'><a
                                    href='javascript:void(0);'></i></a> $blog->title 
                            </p>
                            <p class='mb-3'>Ngày tạo : <span
                                    class='fs-12 mb-1 text-muted'>$blog->created_at</span></p>
                            <p class='mb-3'>Ngày xuất bản : <span
                                    class='fs-12 mb-1 text-muted'>$blog->publish_date</span></p>
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
                                <button class='btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnPostDelete'
                                    data-id='$blog->id'
                                     $disabled><i
                                        class='ri-delete-bin-line'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        return response()->json([
            'code' => 200,
            'blogs' => $blogHtml,
            'blogPendings' => $blogPendingsHtml,
            'blogCompleteds' => $blogCompletedsHtml
        ], 200);
    }



    public function getArticlesByCategory($id = 'index')
    {
        if ($id == 'index') {
            // return response() -> json(['code'=>'okok']);
            $blogs = Article::with('category')->paginate(2);
            $blogPendings = $blogs->filter(function ($article) {
                return Carbon::parse($article->publish_date)->isFuture();
            });
            $blogCompleteds = $blogs->filter(function ($article) {
                return Carbon::parse($article->publish_date)->isPast();
            });
        } else {
            $category = Category::find($id);
            if (!empty($category)) {
                $blogs = $category->articles()->paginate(2);
                $blogPendings = $blogs->filter(function ($article) {
                    return Carbon::parse($article->publish_date)->isFuture();
                });
                $blogCompleteds = $blogs->filter(function ($article) {
                    return Carbon::parse($article->publish_date)->isPast();
                });
            } else {
                $blogs = Article::with('category')->where('status', 'off')->paginate(2);
                $blogPendings = $blogs->filter(function ($article) {
                    return Carbon::parse($article->publish_date)->isFuture();
                });
                $blogCompleteds = $blogs->filter(function ($article) {
                    return Carbon::parse($article->publish_date)->isPast();
                });
            }
        }
        $blogHtml = '';
        foreach ($blogs as $blog) {
            $pathThumbnail = url("storage/uploads/blog_images/$blog->title/thumbnail/$blog->thumbnail");
            $routeEdit = route('admin.post.edit', ['id' => $blog->id]);
            $disabled = $blog->status == 'off' ? 'disabled' : '';
            $blogHtml .=
                "<div class='col-xl-4'>
            <div class='card custom-card task-pending-card'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between flex-wrap gap-2'>
                        <div>
                            <p class='fw-semibold mb-3 d-flex align-items-center'><a
                                    href='javascript:void(0);'></i></a> $blog->title 
                            </p>
                            <p class='mb-3'>Ngày tạo : <span
                                    class='fs-12 mb-1 text-muted'>$blog->created_at</span></p>
                            <p class='mb-3'>Ngày xuất bản : <span
                                    class='fs-12 mb-1 text-muted'>$blog->publish_date</span></p>
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
                                <button class='btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnPostDelete'
                                    data-id='$blog->id'
                                    $disabled><i
                                        class='ri-delete-bin-line'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        $blogCompletedsHtml = '';
        foreach ($blogCompleteds as $blog) {
            $pathThumbnail = url("storage/uploads/blog_images/$blog->title/thumbnail/$blog->thumbnail");
            $routeEdit = route('admin.post.edit', ['id' => $blog->id]);
            $disabled = $blog->status == 'off' ? 'disabled' : '';
            $blogCompletedsHtml .=
                "<div class='col-xl-4'>
            <div class='card custom-card task-pending-card'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between flex-wrap gap-2'>
                        <div>
                            <p class='fw-semibold mb-3 d-flex align-items-center'><a
                                    href='javascript:void(0);'></i></a> $blog->title 
                            </p>
                            <p class='mb-3'>Ngày tạo : <span
                                    class='fs-12 mb-1 text-muted'>$blog->created_at</span></p>
                            <p class='mb-3'>Ngày xuất bản : <span
                                    class='fs-12 mb-1 text-muted'>$blog->publish_date</span></p>
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
                                <button class='btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnPostDelete'
                                    data-id='$blog->id'
                                    $disabled><i
                                        class='ri-delete-bin-line'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        $blogPendingsHtml = '';
        foreach ($blogPendings as $blog) {
            $pathThumbnail = url("storage/uploads/blog_images/$blog->title/thumbnail/$blog->thumbnail");
            $routeEdit = route('admin.post.edit', ['id' => $blog->id]);
            $disabled = $blog->status == 'off' ? 'disabled' : '';
            $blogPendingsHtml .=
                "<div class='col-xl-4'>
            <div class='card custom-card task-pending-card'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between flex-wrap gap-2'>
                        <div>
                            <p class='fw-semibold mb-3 d-flex align-items-center'><a
                                    href='javascript:void(0);'></i></a> $blog->title 
                            </p>
                            <p class='mb-3'>Ngày tạo : <span
                                    class='fs-12 mb-1 text-muted'>$blog->created_at</span></p>
                            <p class='mb-3'>Ngày xuất bản : <span
                                    class='fs-12 mb-1 text-muted'>$blog->publish_date</span></p>
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
                                <button class='btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnPostDelete'
                                    data-id='$blog->id'
                                     $disabled><i
                                        class='ri-delete-bin-line'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        $nav = "<ul class='pagination mb-0'>";
        //nút previous
        $nav .= "<li class='page-item disabled'>
            <span class='page-link'>Previous</span>
        </li>";
        // danh sách các trang
        for ($i = 1; $i <= $blogs->lastPage(); $i++) {
            $active = $i === $blogs->currentPage() ? 'active' : '';
            $disabled =  $i === $blogs->currentPage() ? 'disable-link' : '';
            if ($id == 'index') {
                $link = route('admin.post.index') . "?page=$i";
            } else {
                $link = $id == 0 ? route('admin.post.index') . "?trash=on&page=$i" : route('admin.post.index', ['id' => $id]) . "?page=$i";
            }
            $nav .= "<li class='page-item $active'>
            <a class='page-link  $disabled' href='$link'> $i </a>
        </li>";
        }
        //nút next
        if ($blogs->hasMorePages()) {
            if ($id == 'index') {
                $link = route('admin.post.index') . "?page=2";
            } else {
                $link = $id == 0 ? route('admin.post.index') . "?trash=on&page=2" : route('admin.post.index', ['id' => $id]) . "?page=2";
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
        return response()->json([
            'code' => 200,
            'blogs' => $blogHtml,
            'blogPendings' => $blogPendingsHtml,
            'blogCompleteds' => $blogCompletedsHtml,
            'nav' => $nav
        ], 200);
    }

    private function listArticleByCat(Request $request, $id)
    {
        // if (empty(Category::find($id))) abort(404);
        $blog = Category::with('articles')->find($id)->articles()->paginate(10);
        $blogcompleteds = $blog->filter(function ($article) {
            return Carbon::parse($article->publish_date)->isPast();
        });
        $blogPendings = $blog->filter(function ($article) {
            return Carbon::parse($article->publish_date)->isFuture();
        });
    }

    private function storeImage($imagePath, $title, $folder)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagePath));
        $imageName = time() . '_' . Str::random(10) . '.png';
        Storage::disk('public')->put('uploads/blog_images/' . $title . "/$folder/" . $imageName, $imageData);
        return asset('storage/uploads/blog_images/' . $imageName);
    }
}
