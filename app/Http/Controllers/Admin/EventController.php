<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\ImageStorageLibrary;
use App\Models\Category;
use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('products')->get();
        foreach($events as $event){
            $product_list = Product::whereIn('id',unserialize($event->product_id))->get();
            $event->setAttribute('list_product', $product_list);
        }
        dd($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::with('products')->get();
        return view('admin.event.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->productInArticle) {
            $product_id = Product::whereIn('name', explode(',', $request->productInArticle))->pluck('id')->toArray();
            $request->merge(['product_id' => serialize($product_id)]);
        }
        // return response() -> json(['messages'=>$request->all()]);
        //xử lý ảnh banner
        if ($request->imageThumb) {
            $path = ImageStorageLibrary::storeImage($request->imageThumb, "event/$request->name/banner");
            $request->merge(['banners' => basename($path)]);
        }
        //xử lý ảnh chi tiết
        if ($request->images_detail) {
            $images = [];
            foreach ($request->images_detail as $image) {
                $path = ImageStorageLibrary::storeImage($image, "event/$request->name/images_detail");
                $images[] = basename($path);
            }
            $request->merge(['images' => serialize($images)]);
        }
        if (Event::create($request->all())) return response()->json(['code' => 200, 'messages' => 'đã tạo thành công'], 200);
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
