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
        // $cate = Category::with('faq')->select('name')->get();
        // dd($cate);
        // foreach ($cate as $c) {
        //     dd($c);
        //     foreach($c->faq as $faq) {
        //         dd($faq);
        //     }
        // }
        
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
        $validatedData = $request->validated();

        $validator = Validator::make($request->all(), $request->rules(), $request->messages());
    
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Có lỗi xảy ra trong dữ liệu đầu vào.');
        }
        
        $faq = FAQS::create($validatedData);
    
        return redirect()->back()->with('message', 'Tạo thành công.');
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
