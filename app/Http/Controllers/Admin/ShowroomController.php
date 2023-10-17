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
        $regions = Regions::get();
        // dd($regions);
        return view('admin.showroom.index')->with('regions', $regions);
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
        // dd($request->all());
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
                $imagePath = $this->imageStorage->storeImage($thumbnail, 'showroom_images/'.$request->input('title').'/'.'thumbnail');
                $fileName = basename($imagePath);
                $showroom->thumbnail = $fileName;
            }
        }
        $images_detail = $request->file('images_detail');

        if ($images_detail) {
            $imageList = [];
            foreach ($images_detail as $image_detail) {
                    $imagePath = $this->imageStorage->storeImage($image_detail, 'showroom_images/' . $request->input('title') . '/' . 'images-detail');
                    $fileName = basename($imagePath);
                    $imageList[] = $fileName;
                
            }
            $showroom->images = json_encode($imageList);
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
