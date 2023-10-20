<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Libraries\ImageStorageLibrary;
use App\Libraries\MimeChecker;
use App\Models\color_version;
use App\Models\image_service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;

use function PHPUnit\Framework\matches;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // File::delete(public_path('storage/uploads/products/GHẾ MASSAGE KINGSPORT G50/avatar2'));
        // $directory = public_path('storage/uploads/products/GHẾ MASSAGE KINGSPORT G50/avatarFuck');
        // $newDirectory = public_path('storage/uploads/products/GHẾ MASSAGE KINGSPORT G50/avatar');
        // if (File::isDirectory($directory)) {
        //     // File::deleteDirectory($directory);
        //     File::move($directory, $newDirectory);
        // }
        // $sourcePath = public_path('storage/uploads/products/GHẾ MASSAGE KINGSPORT G50/avatar/652fdd5d19693_1697635677.webp');
        // $destinationPath = public_path('storage/uploads/products/GHẾ MASSAGE KINGSPORT G50/avatar2/652fdd5d19693_1697635677.webp');
        // if (File::exists($sourcePath)) {
        //     File::copy($sourcePath, $destinationPath);
        // }
        // $directoryPath = public_path('storage/uploads/products/GHẾ MASSAGE KINGSPORT G50/avatar2');

        // if (!File::isDirectory($directoryPath)) {
        //     File::makeDirectory($directoryPath, 0755, true);
        // }

        $products = Product::with('category')->with('subCategory')->with('colors', 'colors.images')->with('images')->orderBy('id', 'desc')->paginate(5);
        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cate = Category::with('subCategory')->get();
        $sorting = DB::table('products')->max('sorting') + 1;
        return view('admin.product.create', compact('cate', 'sorting'));
    }

    // public function getSubCategory($id){
    //     dd($request->all);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $desc = $request->desc;
        preg_match_all('/<img[^>]+src="([^"]+)"/', $desc, $matches);
        $imagePaths = $matches[1];
        foreach ($imagePaths as $imagePath) {
            $newImagePath = $this->storeImage($imagePath, $request->input('name'), 'content');

            // Lấy tên tệp hình ảnh từ đường dẫn
            $imageName = pathinfo($newImagePath, PATHINFO_BASENAME);

            // Thay thế đường dẫn bằng tên tệp hình ảnh
            $desc = str_replace($imagePath, $imageName, $desc);
        }
        $request->merge(['description' => $desc]);
        $list_color_image = $request->file();
        $avatarPath = ImageStorageLibrary::storeImage($list_color_image['avatarThumb'], "products/{$request->name}/avatar");
        $request->merge(['avatar' => basename($avatarPath)]);
        $product = Product::create($request->all());
        if (!empty($request->subCat)) {
            $product->subCategory()->attach($request->subCat);
        }
        $listColor = [
            'red' => '#FF0000',
            'gray' => '#808080',
            'white' => '#FFFFFF',
            'beige' => '#F5F5DC',
            'black' => '#000000',
            'brown' => '#A52A2A'
        ];

        $count = 0;
        if ($list_color_image) {
            foreach ($list_color_image['image_color'] as $color => $list_image) {
                //tạo các phiên bản màu của sản phẩm
                if ($color) {
                    $ver_color = color_version::create([
                        'product_id' => $product->id,
                        'name' => $color,
                        'code_color' => $listColor[$color]
                    ]);
                    $url = [];
                    foreach ($list_image as $k => $image) {
                        $imagePath = ImageStorageLibrary::storeImage($image, "products/{$request->name}/{$color}");
                        $url[] = basename($imagePath);
                        $count++;
                    }
                    image_service::create([
                        'color_ver_id' => $ver_color->id,
                        'url' => serialize($url)
                    ]);
                }
            }
        }

        if ($count > 0) return response()->json([
            'code' => 200,
            'messages' => 'Đã thêm sản phẩm thành công'
        ]);
    }

    public function validateForm()
    {
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
        $product = Product::with('subCategory')->with('colors', 'colors.images')->find($id);
        preg_match_all('/<img[^>]+src="([^"]+)"/', $product->description, $matches);
        foreach ($matches[1] as $imagePath) {
            $product->description = str_replace($imagePath, url("storage/uploads/products/$product->name/content/$imagePath"), $product->description);
        }

        $color_ver = [];
        foreach ($product->colors as $color) {
            $color_ver[$color->name] = unserialize($color->images->url);
            $color->images->url = unserialize($color->images->url);
        };
        $image_ver = [];
        foreach ($color_ver as $color => $images) {
            $html = '';
            foreach ($images as $image) {
                $src = url("storage/uploads/products/$product->name/$color/$image");
                $html .=  "<div class='swiper-slide' style='position:relative'>
                <img class='img-fluid thumbnail' src='$src' alt='img'>
            </div>";
            }
            $image_ver[] = $html;
        }
        if (!$product) abort(404);
        $cate = Category::with('subCategory')->get();
        $sorting = $product->sorting;
        return view('admin.product.edit', compact('cate', 'sorting', 'product', 'image_ver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return response()->json(['data' => $request->except('name')]);

        //tìm sản phẩm
        $product = Product::with('subCategory')->with('colors', 'colors.images')->find($id);
        //sử lý khi không tìm thấy sản phẩm
        if (!$product) return response()->json(['code' => 404, 'messages' => 'Không Tìm Thấy Sản Phẩm'], 404);
        //xử lý khi tên sản phẩm thay đổi
        if ($product->name != $request->name) {
            //sử lý đổi tên thư mục chứa ảnh của sản phẩm
            $oldNameDirectory = public_path("storage/uploads/products/$product->name");
            $newNameDirectory = public_path("storage/uploads/products/$request->name");
            File::move($oldNameDirectory, $newNameDirectory);
            $product->name = $request->name;
            $product->save();
        }

        $desc = $request->desc;
        //xoá ảnh trong 

        preg_match_all('/<img[^>]+src="([^"]+)"/', $desc, $matches);
        //tạo thư mục lưu trữ tạm thời ảnh của content
        $newFolderConent = public_path("storage/uploads/products/$product->name/content2");
        if (!File::isDirectory($newFolderConent)) {
            File::makeDirectory($newFolderConent, 0755, true);
        }
        foreach ($matches[1] as $key => $path) {
            $nameImage = basename($path);
            $oldPath = public_path("storage/uploads/products/$product->name/content/$nameImage");
            if (file_exists($oldPath)) {
                $destinationPath = public_path("storage/uploads/products/$product->name/content2/$nameImage");
                File::copy($oldPath, $destinationPath);
                $desc = str_replace($path, $nameImage, $desc);
                unset($matches[1][$key]);
            };
        }

        foreach ($matches[1] as $imagePath) {
            $newImagePath = $this->storeImage($imagePath, $request->input('name'), 'content2');
            // Lấy tên tệp hình ảnh từ đường dẫn
            $imageName = pathinfo($newImagePath, PATHINFO_BASENAME);
            // Thay thế đường dẫn bằng tên tệp hình ảnh
            $desc = str_replace($imagePath, $imageName, $desc);
        }

        //xoá thư mục content củ
        $directory = public_path("storage/uploads/products/$product->name/content");
        if (File::isDirectory($directory)) File::deleteDirectory($directory);
        //lấy thư mục vừa lưu ảnh trong content
        $temporaryDirectory = public_path("storage/uploads/products/$product->name/content2");
        //đổi tên thư mục tạm thời lại thành content 
        File::move($temporaryDirectory, $directory);
        $product->description = $desc;
        // xử lý ảnh avatar
        if ($request->avatar) {
            if (file_exists(public_path("storage/uploads/products/$product->name/avatar/$product->avatar"))) {
                unlink(public_path("storage/uploads/products/$product->name/avatar/$product->avatar"));
                $pathAvatar = ImageStorageLibrary::storeImage($request->avatar, "products/$product->name/avatar");
                $product->avatar = basename($pathAvatar);
            }
        }

        //sử lý đổi màu sản phẩm
        foreach ($request->color as $key => $color) {
            if (!empty($color)) {
                if (!empty($product->colors[$key])) {
                    $oldColor = $product->colors[$key]->name;
                    $oldColorDirectory = public_path("storage/uploads/products/$product->name/$oldColor");
                    $newColorDirectory = public_path("storage/uploads/products/$product->name/$color");
                    if (File::isDirectory($oldColorDirectory)) {
                        File::move($oldColorDirectory, $newColorDirectory);
                        $color_ver = color_version::where(function ($query) use ($product, $oldColor) {
                            $query->where('product_id', $product->id)->where('name', $oldColor);
                        })->first();
                        $color_ver->name = $color;
                        $color_ver->save();
                    }
                } else {
                    $listColor = [
                        'red' => '#FF0000',
                        'gray' => '#808080',
                        'white' => '#FFFFFF',
                        'beige' => '#F5F5DC',
                        'black' => '#000000',
                        'brown' => '#A52A2A'
                    ];
                    $color_ver =  color_version::create([
                        'product_id' => $product->id,
                        'name' => $color,
                        'code_color' => $listColor[$color]
                    ]);
                    image_service::create([
                        'color_ver_id' => $color_ver->id,
                    ]);
                    File::makeDirectory(public_path("storage/uploads/products/$product->name/$color"), 0755, true);
                }
            }
        }
        //xử lý khi upload ảnh mới
        if ($request->image_color) {
            foreach ($request->image_color as $color => $images) {
                if (!empty($images)) {
                    if (File::isDirectory(public_path("storage/uploads/products/$product->name/$color"))) {
                        File::deleteDirectory(public_path("storage/uploads/products/$product->name/$color"));
                    }
                    $url = [];
                    foreach ($images as $image) {
                        $path = ImageStorageLibrary::storeImage($image, "products/$product->name/$color");
                        $url[] = basename($path);
                    }
                    $color_ver = color_version::where(function ($query) use ($product, $color) {
                        $query->where('product_id', $product->id)->where('name', $color);
                    })->first();
                    $image_service = image_service::where('color_ver_id', $color_ver->id)->first();
                    $image_service->url = serialize($url);
                    $image_service->save();
                }
            }
        }
        //xử lý danh mục sản phẩm thay đổi
        if($request->category_id != $product->category_id){
            $product->subCategory()->sync([]);
            $product->subCategory()->sync(array_diff($request->subCat,$product->subCategory->pluck('id')->toArray()));
        }else{
            $product->subCategory()->sync($request->subCat);
        }
        //xử lý khi danh mục thuộc tính thay đổi
        $product->update($request->except(['name','avatar']));
        return response()->json(['code' => 200, 'messages' => 'đã cập nhật thành công'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json([
            'code' => 404,
            'messages' => 'Không tìm thấy sản phẩm'
        ], 404);
        $product->status = 'off';
        $product->save();
        return response()->json([
            'code' => 200,
            'messages' => 'success'
        ], 200);
    }

    private function storeImage($imagePath, $title, $directory)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagePath));
        $imageName = time() . '_' . Str::random(10) . '.png';
        Storage::disk('public')->put('uploads/products/' . $title . "/$directory/" . $imageName, $imageData);
        return asset('storage/uploads/products/' . $imageName);
    }
}
