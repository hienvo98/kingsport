<?php

namespace App\Http\Controllers\Admin;

use App\Models\Regions;
use App\Models\ShowRoom;
use Illuminate\Http\Request;
use App\Libraries\MimeChecker;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShowroomCreateRequest;
use App\Http\Requests\ShowroomUpdateRequest;
use App\Libraries\Helper;
use Illuminate\Support\Facades\Storage;
use App\Libraries\ImageStorageLibrary;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\matches;

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
    public function index($id = '')
    {
        $showrooms = !$id ? ShowRoom::paginate(9) : ShowRoom::where('region_id', $id)->paginate(9);
        $total = ShowRoom::count();
        $regions = Regions::all();
        return view('admin.showroom.index', compact('showrooms', 'regions', 'id', 'total'));
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
    public function store(ShowroomCreateRequest $request)
    {
        try {
            $thumbnail = $request->file('imageThumb');
            if ($thumbnail) {
                $imagePath = $this->imageStorage->storeImage($thumbnail, 'showroom-images/' . $request->input('name') . '/' . 'thumbnail');
                $fileName = basename($imagePath);
                $request->merge(['thumbnail' => $fileName]);
            }
            if ($request->hasFile('images_detail')) {
                $images = $request->file('images_detail');
                $imageList = [];
                foreach ($images as $image) {
                    $imagePath = $this->imageStorage->storeImage($image, 'showroom-images/' . $request->input('name') . '/images-detail', $fileName);
                    $imageList[] =  basename($imagePath);
                }
                $request->merge(['images' => serialize($imageList)]);
            }

            if (ShowRoom::create($request->all())) {
                return response([
                    'status' => 'success',
                    'code' => 200,
                    'messages' => 'đã thêm showroom thành công'
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
        $showroom = ShowRoom::find($id);
        if (empty($showroom)) abort(404);
        $showroom->images = unserialize($showroom->images);
        $images = $showroom->images;
        $showroom->list_images = $this->get_list_image_html($showroom->name, $images);
        $regions = Regions::get();
        return view('admin.showroom.edit', compact('showroom', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $showroom = ShowRoom::find($id);
            if (empty($showroom)) return response()->json(['code' => 404, 'messages' => 'không tìm thấy showroom'], 404);
            if ($request->title != $showroom->name) {
                //đổi tên thư mục lưu ảnh
                ImageStorageLibrary::updateNameFolder('showroom-images', $showroom->name, $request->name);
            }
            if ($request->imageThumb) {
                //xoá và lưu thumbnail mới
                $newPath = ImageStorageLibrary::processImageUpdate($request->imageThumb, 'showroom-images', $request->name, 'thumbnail', $showroom->thumbnail);
                $request->merge(["thumbnail" => basename($newPath)]);
            }
            if ($request->images_detail) {
                $directoryImagesDetail = public_path("storage/uploads/showroom-images/$request->name/images-detail"); //lấy đường dẫn thư mục
                ImageStorageLibrary::deleteFolder($directoryImagesDetail); //xoá thư mục lưu ảnh hiện tại
                $listImagesName = [];
                foreach ($request->images_detail as $image) {
                    $path = ImageStorageLibrary::storeImage($image, "showroom-images/$request->name/images-detail"); // tạo thư mục và cập nhật ảnh mới
                    $listImagesName[] = basename($path);
                }
                $request->merge(['images' => serialize($listImagesName)]);
            }
            $showroom->update($request->all());
            return response()->json(['code' => 200, 'messages' => 'đã cập nhật thành công'], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $showroom = ShowRoom::find($id);
            if (empty($showroom)) return response()->json(['code' => 404, 'messages' => 'không tìm thấy showroom'], 404);
            $showroom->status = 'off';
            $showroom->save();
            return response(['code' => 200, 'messages' => 'đã xoá showroom thành công'], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function filterShowroomAjax($id = '')
    {
        try {
            if ($id) {
                $region = Regions::find($id);
                if (empty($region)) return response()->json(['code' => 404, 'messages' => 'không tìm thấy khu vực'], 404);
                $showrooms = ShowRoom::where('region_id', $id)->paginate(9);
            } else {
                $showrooms = ShowRoom::paginate(9);
            }
            $showrooms_on_html = $showrooms->where('status', 'on');
            $showrooms_off_html = $showrooms->where('status', 'off');
            return response()->json([
                'code' => '200',
                'all' =>  $this->get_card_html($showrooms, 'current'),
                'on' => $this->get_card_html($showrooms_on_html, 'current'),
                'off' => $this->get_card_html($showrooms_off_html, 'current'),
                'nav' => $this->get_nav($showrooms, $id)
            ], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $keywords = $request->keywords;
            $showrooms = ShowRoom::where('name', 'like', "%$keywords%")->get();
            $showrooms_on_html = $showrooms->where('status', 'on');
            $showrooms_off_html = $showrooms->where('status', 'off');
            return response()->json([
                'code' => '200',
                'all' =>  $this->get_card_html($showrooms, 'search'),
                'on' => $this->get_card_html($showrooms_on_html, 'search'),
                'off' => $this->get_card_html($showrooms_off_html, 'search'),
            ], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    private function get_list_image_html($name, $images)
    {
        $html = '';
        foreach ($images as $image) {
            $url = url("storage/uploads/showroom-images/$name/images-detail/$image");
            $html .=  "<div class='swiper-slide' style='position:relative'>
            <img class='img-fluid thumbnail' src='$url' alt='img'>
        </div>";
        };
        return $html;
    }

    private function get_card_html($showrooms, $flag)
    {
        $showroom_html = '';
        foreach ($showrooms as $showroom) {
            $pathThumbnail = url("storage/uploads/showroom-images/$showroom->name/thumbnail/$showroom->thumbnail");
            $routeEdit = url("/admin/showroom/edit/$showroom->id");
            $routeDelete = url("/admin/showroom/delete/$showroom->id");
            $disabled = $showroom->status == 'off' ? 'disabled' : '';
            $name = Helper::customName($showroom->name, 15);
            $showroom_html .=
                "<div class='col-xl-4 $flag'>
            <div class='card custom-card task-pending-card'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between flex-wrap gap-2'>
                        <div>
                            <p class='fw-semibold mb-3 d-flex align-items-center'><a
                                    href='javascript:void(0);'></i></a> $name 
                            </p>
                            <p class='mb-3'>Địa Chỉ : <span
                                    class='fs-12 mb-1 text-muted'>$showroom->address</span></p>
                            <p class='mb-3'>Số điện thoại : <span
                                    class='fs-12 mb-1 text-muted'>$showroom->phone</span></p>
                            <p class='mb-0'>Người tạo :
                                <span class='avatar-list-stacked ms-1'>
                                    <span class='avatar avatar-sm avatar-rounded'>
                                        <img src='$pathThumbnail'
                                            alt='img'>
                                    </span>
                                </span>
                            </p>
                        </div>
                        <div>
                            <div class='btn-list'>
                                <a href='$routeEdit'
                                    class='btn btn-icon btn-sm btn-info-light'><i
                                        class='ri-edit-line'></i></a>
                                <button class='btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnDelete'
                                    data-id='$showroom->id'
                                    $disabled data-route='$routeDelete'><i
                                        class='ri-delete-bin-line'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        return $showroom_html;
    }

    private function get_nav($showrooms, $id)
    {
        $nav = "<ul class='pagination mb-0'>";
        //nút previous
        $nav .= "<li class='page-item disabled'>
            <span class='page-link'>Previous</span>
        </li>";
        // danh sách các trang
        for ($i = 1; $i <= $showrooms->lastPage(); $i++) {
            $active = $i === $showrooms->currentPage() ? 'active' : '';
            $disabled =  $i === $showrooms->currentPage() ? 'disable-link' : '';
            $link = $id ? route('admin.showroom.index', ['id' => $id]) . "?page=$i" : route('admin.showroom.index') . "?page=$i";
            $nav .= "<li class='page-item $active'>
            <a class='page-link  $disabled' href='$link'> $i </a>
        </li>";
        }
        //nút next
        if ($showrooms->hasMorePages()) {
            $link = $id ? route('admin.showroom.index', ['id' => $id]) . "?page=2" : route('admin.showroom.index') . "?page=2";
            $nav .=  "<li class='page-item'>
            <a class='page-link' href='$link' aria-label='Next'>
                <span aria-hidden='true'>Next</span>
            </a>
        </li>";
        } else {
            $nav .= "<li class='page-item disabled'>
            <span class='page-link'>Next</span>
        </li>";
        }
        $nav .= "</ul>";
        return $nav;
    }
}
