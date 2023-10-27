<?php

namespace App\Http\Controllers\Admin;

use App\Models\Regions;
use App\Models\ShowRoom;
use Illuminate\Http\Request;
use App\Libraries\MimeChecker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Libraries\ImageStorageLibrary;

class ShowroomController extends Controller
{
    protected $imageStorage;

    public function __construct(ImageStorageLibrary $imageStorage)
    {
        $this->imageStorage = $imageStorage;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Regions::with('showroom')->get();
        return view('admin.showroom.index')->with(['regions' => $regions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Regions::get();
        return view('admin.showroom.create')->with('regions', $regions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response() -> json(['messages'=>$request->all()]);
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|unique:showroom|max:255',
            'region_id' => 'required|integer',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable|max:255',
            'seo_key' => 'nullable|max:255',
            'status' => 'nullable|in:on,off',
            'phone' => ['required', 'regex:/^[0-9]{10}$/'],
        ]);
        $showroom = new ShowRoom;
        $showroom->name = $request->input('title');
        $showroom->url = $request->input('url');
        $showroom->address = $request->input('address');
        $showroom->phone = $request->input('phone');
        $showroom->region_id = $request->input('region_id');
        $showroom->seo_title = $request->input('seo_title');
        $showroom->seo_description = $request->input('seo_description');
        $showroom->seo_keywords = $request->input('seo_key');
        $thumbnail = $request->file('thumbnail');
        
        if($thumbnail){
            if (!MimeChecker::isImage($thumbnail->getPathname())) {
                return response()->json(['message' => 'Tệp không hợp lệ. Chỉ cho phép tải lên hình ảnh dưới 3MB.'], 400);
            }else{           
                $imagePath = $this->imageStorage->storeImage($thumbnail, 'showroom-images/'.$request->input('title').'/'.'thumbnail');
                $fileName = basename($imagePath);
                $showroom->thumbnail = $fileName;
            }
        }
        
        if ($request->hasFile('images_detail')) {
            $images = $request->file('images_detail');
            $imageList = [];
            $count = 1;

            foreach ($images as $image) {
                $originalName = $image->getClientOriginalName();
                $fileName = $request->input('url') . '-hinh-' . $count;
                $imagePath = $this->imageStorage->storeImage($image, 'showroom-images/' . $request->input('url') . '/images-detail', $fileName);
                $imageList[] = $fileName;

                $count++; 
            }

            $showroom->images = serialize($imageList);
        }

        $showroomContent = $request->input('blog_content');
        $showroom->status = $request->input('status');

        $showroom->content = $showroomContent;
        if($showroom->save()) {
            return response([
                'status' => 'success',
                'code' => 200,
                'data' => $showroom
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
        $showroom = ShowRoom::find($id);
        if(empty($showroom)) abort(404);
        $showroom->images=unserialize($showroom->images);
        $regions = Regions::get();
        return view('admin.showroom.edit',compact('showroom','regions'));
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
        $showroom = ShowRoom::find($id);
        if(empty($showroom)) return response() -> json(['code'=>404,'messages'=>'không tìm thấy showroom'],404);
        $showroom->status = 'off';
        $showroom->save();
        return response(['code'=>200,'messages'=>'đã xoá showroom thành công'],200);
    }

    // public function get_list_image_html(image){
    //     $html = '';

    // }
}
