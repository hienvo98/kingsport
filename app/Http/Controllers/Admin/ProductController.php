<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('category','subCategory')->orderBy('id', 'desc')->paginate(5);
        return view('admin.product.list',['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cate = Category::with('subCategory')->get();
        return view('admin.product.create')->with('cate',$cate);
    }

    // public function getSubCategory($id){
    //     dd($request->all);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // $data = $request->validated();
        // return 'okok';
        $name = $request->name;
        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        $description = $request->description;
        $quantity = $request->quantity;
        $regular_price = $request->regular_price;
        $sale_price = $request->sale_price;
        $discount = $request->discount;
        $status = $request->status;
        $status_stock = $request->status_stock;
        $sorting = $request->sorting;
        $on_outstanding = $request->on_outstanding;
        $on_hot = $request->on_hot;
        $on_sale = $request->on_sale;
        $on_installment = $request->on_installment;
        $on_new = $request->on_new;
        $on_comming = $request->on_comming;
        $on_gift = $request->on_gift;

        dd($request->all());

        // $product = new Product();
        // $product->name = $name;
        // $product->category_id = $category_id;
        // $product->subcategory_id = $subcategory_id;
        // $product->quantity = $quantity;
        // $product->description = $description;
        // $product->regular_price = $regular_price;
        // $product->sale_price = $sale_price;
        // $product->discount = $discount;
        // $product->status = $status;
        // $product->status_stock = $status_stock;
        // $product->on_outstanding = $on_outstanding==1?"on":"off";
        // $product->on_hot = $on_hot==1?"on":"off";
        // $product->on_sale = $on_sale==1?"on":"off";
        // $product->on_installment = $on_installment==1?"on":"off";
        // $product->on_new = $on_new==1?"on":"off";
        // $product->on_comming = $on_comming==1?"on":"off";
        // $product->on_gift = $on_gift==1?"on":"off";
        // $product->sorting = $sorting;
        
        // if($product->save()){
        //     return redirect()->back()->with('message', 'Thêm sản phẩm thành công')->header('Refresh', '2');
        // }
    }

    public function validateForm(){

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
