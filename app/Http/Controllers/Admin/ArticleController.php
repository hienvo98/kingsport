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
            $blog = Category::with('articles')->find($id);
            $blogPendings = $blog->where('status', 'off');
            $blogcompleteds = $blog->where('status', 'on');
        } else {
            $blog = Article::with('category')->paginate(9);
            $blogPendings = $blog->where('status', 'off');
            $blogcompleteds = $blog->where('status', 'on');
        }
        $category = Category::get();
        dd($blog);
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
        $blog->publish_date = $request->input('publish_date');
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
            $newImagePath = $this->storeImage($imagePath, $request->input('title'));

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    private function storeImage($imagePath, $title)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagePath));
        $imageName = time() . '_' . Str::random(10) . '.png';
        Storage::disk('public')->put('uploads/blog_images/' . $title . '/content/' . $imageName, $imageData);

        return asset('storage/uploads/blog_images/' . $imageName);
    }
}
