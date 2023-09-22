<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $cate = Category::with('subCategory')->orderBy('ordinal_number', 'desc')->paginate(5);
        return view('admin.category.index')->with('category',$cate);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cate = new Category();
        $name = $request->input('category_name');
        $status = $request->input('status') ? 1 : 0;
        $ordinal_number = $request->input('ordinal_number');

        $cate->name = $name;
        $cate->status = $status;
        $cate->ordinal_number = $ordinal_number;
        $cate->save();
        return response()->json([
            'message' => 'Thêm thành công', 
            'data' => $cate
        ]);
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
    public function edit($categoryId)
    {
        $category = Category::find($categoryId);

        // Kiểm tra xem danh mục có tồn tại không
        if (!$category) {
            return response()->json(['error' => 'Danh mục không tồn tại'], 404);
        }

        // Trả về dữ liệu JSON chứa thông tin của danh mục
        return response()->json(['data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categoryId)
    {
        //dd($request->all());
        $category = Category::find($categoryId);
        if (!$category) {
            return response()->json(['message' => 'Danh mục không tồn tại'], 404);
        }

        $category->name = $request->input('category_name');
        $category->status = $request->input('status') == 'true' ? 1 : 0;
        $category->ordinal_number = $request->input('ordinal_number');
        // ... 

        $category->save();
        return response()->json([
            'message' => 'Cập nhật thành công', 
            'data' => $category
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        $category = Category::find($categoryId);
        if(!$category){
            return response()->json([
                'message' => 'danh mục không tồn tại'
            ],404);
        }
        $category->status = 0;
        $category->save();
        return response()->json(['message'=>'đã xoá sản phẩm']);
    }
}
