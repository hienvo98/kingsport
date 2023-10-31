<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\FAQRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\FAQS;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::select('id','name')->get(); 
        return view('admin.faq.index',['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cate = Category::select('id','name')->get();

        return view('admin.faq.create',['category' => $cate]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FAQRequest $request)
    {   
        if(FAQS::create($request->all())) return redirect()->back()->with('message', 'Tạo thành công.');
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
        $faq = FAQS::find($id);
        if(empty($faq)) abort(404);
        $category = Category::select('id','name')->get();
        return view('admin.faq.edit',compact('faq','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FAQRequest $request, string $id)
    {
        $faq = FAQS::find($id);
        if(empty($faq)) return response() -> json(['code'=>404,'message'=>'Không tìm thấy câu hỏi'],404);
        if($faq->update($request->all())) return response() -> json(['code'=>200,'messages'=>'đã cập nhật thành công'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = FAQS::find($id);
        if(empty($faq)) return response() -> json(['code'=>404,'message'=>'Không tìm thấy câu hỏi'],404);
        $faq->update(['status'=>'off']);
        if($faq->update(['status'=>'off'])) return response() -> json(['code'=>200,'messages'=>'đã cập nhật thành công'],200);  
    }
}
