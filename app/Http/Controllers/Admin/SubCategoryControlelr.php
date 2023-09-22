<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
        $formData = $request->input('formData');
        $dataPairs = explode('&', $formData);
        $data = [];
        foreach ($dataPairs as $pair) {
            list($key, $value) = explode('=', $pair);
            $data[urldecode($key)] = urldecode($value);
        }
        
        $subCate = new SubCategory();
        
        $subCate->category_id = $request->input('categoryId');
        $subCate->name = $data['sub_category_name'];
        $subCate->ordinal_number = $data['ordinal_number'];
        $subCate->status = $data['status']= true? 1: 0;

        if($subCate->save()) {
            return response([
                'code' => 200,
                'message' =>'Success',
                'data' =>$subCate,
            ]);
        }else{
            return response([
                'code' => 401,
                'message' =>'Failure',
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
}
