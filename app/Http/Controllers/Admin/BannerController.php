<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\ImageStorageLibrary;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::paginate(9);
        return view('admin.banner.index',compact('banners'));
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
        $request->validate([
            'name'=>'required|string|max:255|unique:banners',
            'imageThumb' => 'required|image|mimes:png,jpg,jpeg,webp',
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string|max:255'
        ]);
        if($request->imageThumb){
            $path = ImageStorageLibrary::storeImage($request->imageThumb,"banner/$request->name");
            $request->merge(['image'=>basename($path)]);
        }
        Banner::create($request->all());
        return response()->json(['code'=>200,'message'=>'success!'],200);
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

        $banner = Banner::find($id);
        if(empty($banner)) return response() -> json(['code'=>404,'message'=>'no data'],404);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('banners', 'name')->ignore($banner->name, 'name'),
            ],
            'imageThumb' => 'image|mimes:png,jpg,jpeg,webp',
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string|max:255',        
        ]);
        $banner->name!=$request->name?ImageStorageLibrary::updateNameFolder('banner',$banner->name,$request->name):'';
        if($request->imageThumb){
            $path = ImageStorageLibrary::processImageUpdate($request->imageThumb,'banner',$request->name,'',$banner->image);
            $request->merge(['image'=>basename($path)]);
        }
        $banner->update($request->except('user_id'));
        return response() -> json(['code'=>200,'message'=>'update success'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        if(empty($banner)) return response() -> json(['code'=>404,'message'=>'not found'],404);
        $banner->update(['status'=>'off']);
        return response() -> json(['code'=>200,'message'=>'delete success'],200);
    }

    public function search(Request $request){
        $keywords = $request->keywords;
        $banners = Banner::where('name','like',"%$keywords%")->get();
        return response(['code'=>200,'html'=>$this->get_html($banners)],200);
    }
    private function get_html($banners){
        $html = '';
        foreach($banners as $banner){
            $urlImage = url("storage/uploads/banner/$banner->name/$banner->image");
            $urlUpdate = route('admin.banner.update',['id'=>$banner->id]);
            $urlDelete = route('admin.banner.destroy',['id'=>$banner->id]);
            $statusBadge =  $banner->status == 'on' ? 'bg-success' : 'bg-danger';
            $status = $banner->status == 'on' ? 'Đang Mở' : 'Đã Tắt';
            $disabled = $banner->status == 'off' ? 'disable-link' : '';
            $html .= "<tr class='product-list search'>
            <td style='text-align: center;'>
                <span>$banner->name</span>
            </td>
            <td class='w-25'>
                <img src='$urlImage' class='img-fluid img-thumbnail rounded' alt=''>
            </td>
            <td style='text-align: center;'>
                <span id='statusCategory-$banner->id'
                    class='badge $statusBadge'>
                            $status
                </span>
            </td>
            <td style='text-align: center;'>
                <div class='hstack gap-2 fs-15 d-flex justify-content-center'>
                    <a href='javascript:void(0);'
                        class='btn btn-icon btn-sm btn-info-light btn-edit'
                        data-name='$banner->name' data-url='$banner->url' data-seo-title='$banner->seo_title' data-seo-keywords='$banner->seo_keywords' data-seo-description='$banner->seo_description' data-status='$banner->status' data-image='$urlImage' data-route='$urlUpdate'><i class='ri-edit-line'></i></a>
                    <a href='javascript:void(0);'
                        class='btn btn-icon btn-sm btn-danger-light product-btn btn-delete $disabled'
                        data-route='$urlDelete'><i
                            class='ri-delete-bin-line' data-toggle='modal'
                            data-target='#exampleModalCenter'></i></a>
                </div>
            </td>
        </tr>";
        }
        return $html;
    }
}
