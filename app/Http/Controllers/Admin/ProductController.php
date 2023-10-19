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
    public function store(ProductRequest $request)
    {

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
        preg_match_all('/<img[^>]+src="([^"]+)"/',$product->description, $matches);
        foreach($matches[1] as $imagePath){ 
            $product->description = str_replace($imagePath, url("storage/uploads/products/$product->name/content/$imagePath"), $product->description );
        }
        $color_ver = [];
        foreach ($product->colors as $color) {
            $color_ver[$color->name] = unserialize($color->images->url);
            $color->images->url = unserialize($color->images->url);
        };
        $image_ver=[];
        foreach($color_ver as $color => $images){
            $html = '';
            foreach($images as $image){
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
        return view('admin.product.edit', compact('cate', 'sorting', 'product','image_ver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response() -> json([
            'code'=>200,
            'messages'=>$request->all()
        ]);
        dd($request->all());
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

    private function storeImage($imagePath, $title)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagePath));
        $imageName = time() . '_' . Str::random(10) . '.png';
        Storage::disk('public')->put('uploads/products/' . $title . '/content/' . $imageName, $imageData);
        return asset('storage/uploads/products/' . $imageName);
    }
}
