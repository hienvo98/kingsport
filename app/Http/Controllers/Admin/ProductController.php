<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Validation\ValidationException;
use App\Libraries\ImageStorageLibrary;
use App\Models\color_version;
use App\Models\image_service;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('category', 'subCategory')->orderBy('id', 'desc')->paginate(5);
        return view('admin.product.list', ['product' => $product]);
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
         dd($request->all('image_color'));
        if (isset($request->subCat)) {
            $request->merge(['subcategory_id' => serialize($request->subCat)]);
        }
        // $product = Product::create($request->all());
        
        $listColor = [
            'red' => '#FF0000',
            'gray' => '#808080',
            'white' => '#FFFFFF',
            'beige' => '#F5F5DC',
            'black' => '#000000',
            'brown' => '#A52A2A'
        ];
        //lấy danh sách ảnh sản phẩm
        $list_color_image = $request->file();
        dd($list_color_image);
        $count = 0;
        if($list_color_image){
            foreach($list_color_image['image_color'] as $color => $list_image){
                //tạo các phiên bản màu của sản phẩm
                $ver_color = color_version::create([
                    'product_id' => $product->id,
                    'name' => $color ,
                    'code_color' => $listColor[$color]
                ]);
                $url = [];
                foreach($list_image as $k => $image){
                    //lưu ảnh vào sota
                    dd($k);
                    $imagePath = ImageStorageLibrary::storeImage($image,"products/{$request->name}/{$color}");
                    $url[] = basename($imagePath);
                }
                image_service::create([
                    'color_ver_id'=> $ver_color->id,
                    'url' => serialize($url)
                ]);
            }
        }
        
        return 'đã tạo sản phẩm';
        // return Product::create($request->all());
        
        // if($product->save()){
        //     return redirect()->back()->with('message', 'Thêm sản phẩm thành công')->header('Refresh', '2');
        // }
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
}
