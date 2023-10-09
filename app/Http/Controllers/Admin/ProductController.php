<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
// use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Validation\ValidationException;


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
        if (isset($request->subCat)) {
            $request->merge(['subcategory_id' => serialize($request->subCat)]);
        }

        // dd($request->all());
        $list_color_image = $request->file();
        // dd($list_color_image);
        $name = [];
        foreach($list_color_image['image_color'] as $color => $list_image){
            foreach($list_image as $image){
                $name[]= $image->getClientOriginalName();
            }
        }
        dd($name);
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
