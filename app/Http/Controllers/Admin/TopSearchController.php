<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopSearch;
use Illuminate\Http\Request;

class TopSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topSearchs = TopSearch::paginate(10);
        return view('admin.topsearch.index', compact('topSearchs'));
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
                'name' => 'required|string|max:255|unique:topsearcheds',
                'url' => 'required|string|max:255|unique:topsearcheds',
                'seo_title' => 'required|string|max:255',
                'seo_keywords' => 'required|string|max:255',
                'seo_description' => 'required|string'
            ],
            [
                'required' => ':attribute không được để trống',
                'string' => ':attribute phải ở dạng ký tự',
                'max' => ':attribute có tối đa 255 ký tự',
                'unique' => ':attribute đã tồn tại'
            ],
            [
                'name' => 'tên tìm kiếm',
            ]
        );
        $path = parse_url($request->url, PHP_URL_PATH);
        // Sử dụng hàm pathinfo để lấy tên tệp và sau đó loại bỏ phần mở rộng .html
        $url = pathinfo($path, PATHINFO_FILENAME);
        $request->merge(['url'=>$url]);
        if (TopSearch::create($request->all())) return response()->json(['code' => 200, 'messages' => 'đã tạo thành công'], 200);
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
