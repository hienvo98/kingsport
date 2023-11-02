<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(9);
        return view('admin.tag.index', compact('tags'));
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
            'name' => 'required|string|max:255|unique:tags',
        ]);
        if (Tag::create($request->all())) return response()->json(['code' => 200, 'messages' => 'đã tạo'], 200);
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
        $tag = Tag::find($id);
        if (empty($tag)) return response()->json(['code' => 404, 'message' => 'không tìm thấy tag'], 404);
        if ($tag->update($request->all())) return response()->json(['code' => 200, 'messages' => 'đã cập nhật'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        if (empty($tag)) return response()->json(['code' => 404, 'message' => 'không tìm thấy tag'], 404);
        if ($tag->update(['status' => 'off'])) return response()->json(['code' => 200, 'messages' => 'đã cập nhật'], 200);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $tags = Tag::where('name', 'like', "%$keywords%")->get();
        return response()->json(['code' => 200, 'html' => $this->get_html($tags)], 200);
    }

    private function get_html($tags)
    {
        $html = '';
        foreach ($tags as $tag) {
            $routeEdit = route('admin.tag.update', ['id' => $tag->id]);
            $routeDelete = route('admin.tag.destroy', ['id' => $tag->id]);
            $status = $tag->status == 'on' ? 'Đang Mở' : 'Đã Tắt';
            $badge_color = $tag->status == 'on' ? 'bg-success' : 'bg-danger';
            $html .= "<tr class='product-list search'>
            <td style='text-align: center;'>
                <span>$tag->name</span>
            </td>
            <td style='text-align: center;'>
                <span id='statusCategory-$tag->id'
                    class='badge $badge_color '>
                        $status 
                </span>
            </td>
            <td style='text-align: center;'>
                <div class='hstack gap-2 fs-15 d-flex justify-content-center'>
                    <a href='javascript:void(0);'
                        class='btn btn-icon btn-sm btn-info-light btn-edit'
                        data-name='$tag->name' data-status='$tag->status' data-route='$routeEdit'><i class='ri-edit-line'></i></a>
                    <a href='javascript:void(0);'
                        class='btn btn-icon btn-sm btn-danger-light product-btn btn-delete $tag->status == 'off' ? 'disable-link' : '' '
                        data-route='$routeDelete'><i
                            class='ri-delete-bin-line' data-toggle='modal'
                            data-target='#exampleModalCenter'></i></a>
                </div>
            </td>
        </tr>";
        }
        return $html;
    }
}
