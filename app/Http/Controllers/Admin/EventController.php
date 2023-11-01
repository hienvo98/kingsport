<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Libraries\Helper;
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
        // $events = Event::with('products')->get();
        // foreach($events as $event){
        //     $product_list = Product::whereIn('id',unserialize($event->product_id))->get();
        //     $event->setAttribute('list_product', $product_list);
        // }
        $events = Event::paginate(9);
        return view('admin.event.index', compact('events'));
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
    public function store(EventCreateRequest $request)
    {
        try {
            //xử lý sản phẩm liên quan sự kiện
            if ($request->productInArticle) {
                $product_id = Product::whereIn('name', explode(',', $request->productInArticle))->pluck('id')->toArray();
                $request->merge(['product_id' => serialize($product_id)]);
            }
            //xử lý ảnh banner
            if ($request->imageThumb) {
                $path = ImageStorageLibrary::storeImage($request->imageThumb, "event/$request->name/banners");
                $request->merge(['banners' => basename($path)]);
            }
            if (Event::create($request->all())) return response()->json(['code' => 200, 'messages' => 'đã tạo thành công'], 200);
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
        $event = Event::find($id);
        $category = Category::with('products')->get();
        return view('admin.event.edit', compact('category', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventUpdateRequest $request, string $id)
    {
        try {

            $event = Event::find($id);
            if (empty($event)) return response()->json(['code' => 404, 'messages' => 'không tìm thấy sự kiện'], 404);
            //xử lý tên thư mục khi tên event thay đổi
            if ($request->name != $event->name) ImageStorageLibrary::updateNameFolder('event', $event->name, $request->name);
            //xử lý ảnh khi thay đổi
            if ($request->imageThumb) {
                $path = ImageStorageLibrary::processImageUpdate($request->imageThumb, 'event', $request->name, 'banners', $event->banners);
                $request->merge(['banners' => basename($path)]);
            }
            //xử lý sản phẩm liên quan
            if ($request->productInArticle) {
                $product_id = Product::whereIn('name', explode(',', $request->productInArticle))->pluck('id')->toArray();
                $request->merge(['product_id' => serialize($product_id)]);
            }
            if ($event->update($request->all())) return response()->json(['code' => 200, 'message' => 'đã cập nhật'], 200);
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
            $event = Event::find($id);
            if (empty($event)) return response()->json(['code' => 404, 'messages' => 'Không tìm thấy event'], 404);
            if ($event->update(['status' => 'off'])) return response()->json(['code' => 200, 'messages' => 'đã cập nhật trạng thái'], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function search(Request $request)
    {
        try {
            $events = Event::where('name', 'like', "%$request->keywords%")->get();
            if ($events->count() > 0) {
                return response()->json([
                    'code' => 200,
                    'all' => $this->get_card_html($events, 'search'),
                    'on' => $this->get_card_html($events->where('status', 'on'), 'search'),
                    'off' => $this->get_card_html($events->where('status', 'off'), 'search')
                ], 200);
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    private function get_card_html($events, $flag)
    {
        $event_html = '';
        foreach ($events as $event) {
            $pathBanner = url("storage/uploads/event/$event->name/banners/$event->banners");
            $routeEdit = url("/admin/event/edit/$event->id");
            $routeDelete = url("/admin/event/delete/$event->id");
            $disabled = $event->status == 'off' ? 'disabled' : '';
            $name = Helper::customName($event->name, 15);
            $event_html .=
                "<div class='col-xl-4 $flag'>
            <div class='card custom-card task-pending-card'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between flex-wrap gap-2'>
                        <div>
                            <p class='fw-semibold mb-3 d-flex align-items-center'><a
                                    href='javascript:void(0);'></i></a> $name 
                            </p>
                            <p class='mb-3'>Ngày tạo : <span
                                    class='fs-12 mb-1 text-muted'>$event->created_at</span></p>
                            <p class='mb-0'>Người tạo :
                            <img src='$pathBanner'
                            alt='img' class='img-fluid img-thumbnail height-auto'>
                            </p>
                        </div>
                        <div>
                            <div class='btn-list'>
                                <a href='$routeEdit'
                                    class='btn btn-icon btn-sm btn-info-light'><i
                                        class='ri-edit-line'></i></a>
                                <button class='btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnDelete'
                                    data-id='$event->id'
                                    $disabled data-route='$routeDelete'><i
                                        class='ri-delete-bin-line'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        return $event_html;
    }
}
