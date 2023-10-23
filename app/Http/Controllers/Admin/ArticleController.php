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
use Illuminate\Support\Facades\File;


class ArticleController extends Controller
{
    protected $imageStorage;

    public function __construct(ImageStorageLibrary $imageStorage)
    {
        $this->imageStorage = $imageStorage;
    }

    public function index($id = '')
    {
        if (!empty($id)) {
            $blog = Category::with('articles')->find($id)->articles()->paginate(10);
            $blogcompleteds = $blog->filter(function ($article) {
                return Carbon::parse($article->publish_date)->isPast();
            });
            $blogPendings = $blog->filter(function ($article) {
                return Carbon::parse($article->publish_date)->isFuture();
            });
        } else {
            $blog = Article::with('category')->paginate(9);
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
        if($request->title != $post->title){
            //lấy tên thư mục cũ
            $oldPathTitle = public_path("storage/uploads/blog_images/$post->title");
            $newPathTitle = public_path("storage/uploads/blog_images/$request->title");
            if(File::isDirectory($oldPathTitle)){
                File::move($oldPathTitle,$newPathTitle);
            }
            $post->title = $request->title;
            $post -> save();
        }
        //xử lý khi thay đổi thumbnail
        if($request->thumbnail){
            $oldThumbNail = public_path("storage/uploads/blog_images/$post->title/thumbnail/$post->thumbnail");
            if(File::exists($oldThumbNail)){
                unlink($oldThumbNail);
               $newThumbPath = ImageStorageLibrary::storeImage($request->thumbnail,"blog_images/$post->title/thumbnail");
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
                File::copy($oldPath,$newPath);
                //thay thế đường dẫn bằng tên hình ảnh
                $content = str_replace($path,$basename,$content);
                unset($matches[1][$key]);
            } else {
                //lưu ảnh mới có trong content
               $pathNewImage =  $this->storeImage($path, $post->title, 'content2');
               $imageName = pathinfo($pathNewImage, PATHINFO_BASENAME);
               //thay thế đường dẫn bằng tên hình ảnh
               $content = str_replace($path,$imageName,$content);
            }
        }
        //xoá thư mục content cũ
        if (File::isDirectory(public_path("storage/uploads/blog_images/$post->title/content"))) {
            File::deleteDirectory(public_path("storage/uploads/blog_images/$post->title/content"));
        }
        //đổi tên thư mục tạm thời content2 thành content
        if(File::isDirectory(public_path("storage/uploads/blog_images/$post->title/content2"))){
            File::move(public_path("storage/uploads/blog_images/$post->title/content2"),public_path("storage/uploads/blog_images/$post->title/content"));
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
    private function storeImage($imagePath, $title, $folder)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagePath));
        $imageName = time() . '_' . Str::random(10) . '.png';
        Storage::disk('public')->put('uploads/blog_images/' . $title . "/$folder/" . $imageName, $imageData);
        return asset('storage/uploads/blog_images/' . $imageName);
    }
}
