<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\ImageStorageLibrary;

class SubCategoryControlelr extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:category_type',
                'avatarThumb'=>'required|image|mimes:png,jpg,jpeg,webp|max:3072'
            ]
        );
        try {
            if ($request->avatarThumb) {
                $path = ImageStorageLibrary::storeImage($request->avatarThumb, "category/$request->parent_name/avatarSub/$request->name");
                $request->merge(['avatar'=>basename($path)]);
            }
            SubCategory::create($request->all());
            return response()->json(['code' => 200, 'messages' => 'đã tạo thành công'], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
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

    public function getRank(Request $request)
    {
        try {
            return response()->json([
                'code' => 200,
                'messages' => SubCategory::where('category_id', $request->categoryId)->count()
            ], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
