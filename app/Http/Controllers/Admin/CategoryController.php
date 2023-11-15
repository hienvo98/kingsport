<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\ImageStorageLibrary;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        if (!Gate::allows('admin.category.index')) {
            abort(403);
        }
        $category = Category::with('subCategory')->orderBy('ordinal_number', 'desc')->paginate(5);
        $stt = Category::count();
        return view('admin.category.index', compact('category', 'stt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('admin.category.store')) {
            abort(403);
        }
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('admin.category.store')) {
            abort(403);
        }
        try {
            $request->validate(
                [
                    'name' => 'required|string|max:255|unique:category',
                    'avatarThumb' => 'required|image|mimes:png,jpg,jpeg,webp|max:3072'
                ]
            );
            if ($request->avatarThumb) {
                $path = ImageStorageLibrary::storeImage($request->avatarThumb, "category/$request->name/avatar");
                $request->merge(['avatar' => basename($path)]);
            }
            if (Category::create($request->all()))
                return response()->json(['message' => 'Thêm thành công'], 200);
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
    public function edit($categoryId)
    {
        if (!Gate::allows('admin.category.store')) {
            abort(403);
        }
        try {
            $category = Category::find($categoryId);
            // Kiểm tra xem danh mục có tồn tại không
            if (!$category) {
                return response()->json(['error' => 'Danh mục không tồn tại'], 404);
            }
            // Trả về dữ liệu JSON chứa thông tin của danh mục
            return response()->json([
                'data' => $category,
                'pathImage' => url("storage/uploads/category/{$category->name}/avatar/{$category->avatar}")
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categoryId)
    {
        if (!Gate::allows('admin.category.update')) {
            abort(403);
        }
        try {
            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'avatarThumb' => 'image|mimes:png,jpg,jpeg,webp|max:3072'
                ]
            );
            $category = Category::find($categoryId);
            if (empty($category)) return response()->json(['message' => 'Danh mục không tồn tại'], 404);
            $request->name != $category->name ? ImageStorageLibrary::updateNameFolder('category',$category->name,$request->name):'';
            if (!empty($request->avatarThumb)) {
                $path = ImageStorageLibrary::processImageUpdate($request->avatarThumb, 'category', $request->name, 'avatar', $category->avatar);
                $request->merge(['avatar' => basename($path)]);
            }
            $category->update($request->all());
            return response()->json(['code' => 200, 'message' => 'Cập nhật thành công'], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        if (!Gate::allows('admin.category.destroy')) {
            abort(403);
        }
        try {
            if (empty(Category::find($categoryId))) return response()->json(['message' => 'danh mục không tồn tại'], 404);
            Category::find($categoryId)->update(['status' => '0']);
            return response()->json(['message' => 'đã xoá sản phẩm']);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function search(Request $request)
    {
        try {
            $keywords = $request->keywords;
            $categories = Category::where('name', 'like', "%{$keywords}%")->orderby('id', 'desc')->get();
            return response()->json([
                'code' => '200',
                'html' => $this->get_html($categories)
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
       
    }

    public  function getSubCategory($categoryId)
    {
        $id = (int)$categoryId;
        $subCate = SubCategory::where('category_id', $id)->get()->toArray();
        return response()->json($subCate);
    }

    private function get_html($categories)
    {
        $html = '';
        foreach ($categories as $cat) {
            $html .= "<tr class='product-list search'><td><div class='d-flex align-items-center'><div class='fw-semibold'>";
            $html .= $cat->name;
            $html .= "</div></div></td><td><ul class='list-unstyled'>";
            if (isset($cat->subCategory) && count($cat->subCategory) > 0) {
                foreach ($cat->subCategory as $child) {
                    $html .= "<li>--$child->name</li>";
                }
            } else {
                $html .= "<li>--Trống</li>";
            }
            $html .= "</ul></td><td>";
            $html .= "<span class='badge bg-light text-default'> $cat->ordinal_number </span>";
            $html .= "</td><td style='text-align: center;'>";
            $html .= "<span id='statusCategory-$cat->id'";
            if ($cat->status == 1) {
                $bg = 'bg-success';
            } else {
                $bg = 'bg-danger';
            }
            $html .= "class='badge $bg'>";
            if ($cat->status == 1) {
                $html .= 'Đang Mở';
            } else {
                $html .= 'Đã Tắt';
            }
            $status = $cat->status == 0 ? 'disable-link' : '';
            $html .= "</span>
            </td>
            <td>
                để sau
            </td>
            <td>
                <div class='hstack gap-2 fs-15'>
                    <a
                        class='btn btn-icon btn-sm btn-info-light btn-edit-category'
                        data-category-id='$cat->id'><i class='ri-edit-line'></i></a>

                    <a
                        class='btn btn-icon btn-sm btn-danger-light product-btn deleteModalCategoryOpen $status'
                        data-category-id='$cat->id' id='cat-$cat->id' ><i class='ri-delete-bin-line'
                            data-toggle='modal' data-target='#exampleModalCenter'></i></a>

                    <button id='subcategory'
                        class='btn btn-icon btn-secondary-light ms-2 subcategory'
                        data-category-id='$cat->id'
                        data-category-name='$cat->name' data-bs-toggle='tooltip'
                        data-bs-placement='top' data-bs-title='Thêm danh mục con'><i
                            class='ri-add-line'></i></button>
                </div>
            </td>
        </tr>";
        }
        return $html;
    }
}
