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
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category','category.subCategory')->orderBy('id', 'desc')->paginate(5);
        $subCatId = [];
        foreach ($products as $product) {
            $subCatId[] = unserialize($product->subcategory_id);
        }
        // unset($products[0]->category->subCategory[1]);
        dd($products[0]);
        return view('admin.product.list', compact('product'));
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
    public function store(ProductRequest $request)
    {
        if (!empty($request->subCat)) {
            $request->merge(['subcategory_id' => serialize($request->subCat)]);
        } else {
            $request->merge(['subcategory_id' => 'null']);
        }
        $desc = $request->desc;
        preg_match_all('/<img[^>]+src="([^"]+)"/', $desc, $matches);

        $imagePaths = $matches[1];
        foreach ($imagePaths as $imagePath) {
            $newImagePath = $this->storeImage($imagePath, $request->input('name'));
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
        Storage::disk('public')->put('uploads/products/' . $title . '/content/' . $imageName, $imageData);
        return asset('storage/uploads/products/' . $imageName);
    }
}
