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
        try {
            $subCate = new SubCategory();
            $subCate->category_id = $request->category_id;
            $subCate->name = $request->sub_category_name;
            $subCate->ordinal_number = $request->sub_ordinal_number;
            $subCate->status = $data['status'] = true ? '1' : '0';
            if (!empty($request->avatar)) {
                $pathImage = ImageStorageLibrary::storeImage($request->avatar, "category/{$request->category_name}/avatarSub/{$request->sub_category_name}");
                $subCate->avatar = basename($pathImage);
            }
            if ($subCate->save()) {
                return response([
                    'code' => 200,
                    'message' => 'Success',
                    'data' => $subCate,
                ]);
            } else {
                return response([
                    'code' => 401,
                    'message' => 'Failure',
                ]);
            }
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
