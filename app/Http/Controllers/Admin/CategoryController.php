<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

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
        if (! Gate::allows('admin.category.index')) {
            abort(403);
        }
        $cate = Category::with('subCategory')->orderBy('ordinal_number', 'desc')->paginate(5);
        return view('admin.category.index')->with('category', $cate);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('admin.category.store')) {
            abort(403);
        }
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('admin.category.store')) {
            abort(403);
        }
        $cate = new Category();
        $name = $request->input('category_name');
        $status = $request->input('status') ? 1 : 0;
        $ordinal_number = $request->input('ordinal_number');

        $cate->name = $name;
        $cate->status = $status;
        $cate->ordinal_number = $ordinal_number;
        $cate->save();
        return response()->json([
            'message' => 'Thêm thành công',
            'data' => $cate
        ]);
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
        if (! Gate::allows('admin.category.store')) {
            abort(403);
        }
        $category = Category::find($categoryId);

        // Kiểm tra xem danh mục có tồn tại không
        if (!$category) {
            return response()->json(['error' => 'Danh mục không tồn tại'], 404);
        }

        // Trả về dữ liệu JSON chứa thông tin của danh mục
        return response()->json(['data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categoryId)
    {
        //dd($request->all());
        if (! Gate::allows('admin.category.update')) {
            abort(403);
        }
        $category = Category::find($categoryId);
        if (!$category) {
            return response()->json(['message' => 'Danh mục không tồn tại'], 404);
        }

        $category->name = $request->input('category_name');
        $category->status = $request->input('status') == 'true' ? 1 : 0;
        $category->ordinal_number = $request->input('ordinal_number');
        // ... 

        $category->save();
        return response()->json([
            'message' => 'Cập nhật thành công',
            'data' => $category
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        if (! Gate::allows('admin.category.destroy')) {
            abort(403);
        }
        $category = Category::find($categoryId);
        if (!$category) {
            return response()->json([
                'message' => 'danh mục không tồn tại'
            ], 404);
        }
        $category->status = 0;
        $category->save();
        return response()->json(['message' => 'đã xoá sản phẩm']);
    }

    public function search(Request $request)
    {
        $type = $request->type;
        $keyword = $request->keyword;
        if ($type == 'Category') $data = Category::where('name', 'like', "%{$keyword}%")->orderby('id','desc')-> get();
        $html = '';
        foreach ($data as $cat) {
            $html .= "<tr class='product-list'><td><div class='d-flex align-items-center'><div class='fw-semibold'>";
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
            if( $cat->status ==1 ){
                $bg = 'bg-success';
            }else{
                $bg = 'bg-danger';
            }
            $html .= "class='badge $bg'>";
            if ($cat->status == 1) {
                $html .= 'Đang Mở';
            } else {
                $html .= 'Đã Tắt';
            }
            $status = $cat->status==0?'disable-link':'';
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
        return response()->json([
            'code'=>'200',
            'data' => $html
        ]);
    }

    public  function getSubCategory($categoryId){
        $id = (int)$categoryId;
        $subCate = SubCategory::where('category_id', $id)->get()->toArray();
        //dd($subCate);
        // foreach ($subCate as $subCategory) {
        //     dd($subCategory);
        // }
        return response()->json($subCate);
    }
}
