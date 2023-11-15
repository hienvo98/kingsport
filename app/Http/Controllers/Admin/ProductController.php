<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Libraries\ImageStorageLibrary;
use App\Libraries\MimeChecker;
use App\Models\color_version;
use App\Models\image_service;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id = '')
    {
        $trash = $request->trash;
        $products  = $this->get_list_products($id,$trash);
        $count = [
            'products'=>Product::count(),
            'products_off'=>Product::where('status','off')->count()
        ];
        $category = Category::all();
        return view('admin.product.index',compact('products','category','trash','id','count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cate = Category::with('subCategory')->get();
        $sorting = Product::count() + 1;
        return view('admin.product.create', compact('cate', 'sorting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            //validate ảnh trong bài viết
            if (!MimeChecker::ValidateImageInContent($request->desc)) return response()->json(['code' => 422, 'messages' => 'ảnh trong bài viết không đúng định đạng jpg, png, jpeg, webp hoặc lớn hơn 3MB'], 422);
            $desctiption =  ImageStorageLibrary::processAndSaveImagesInContentCreate($request->desc, 'product', $request->name); //xử lý và lưu ảnh trong bài viết
            $request->merge(['description' => $desctiption]);
            $list_image_path = $request->file();
            $avatarPath = ImageStorageLibrary::storeImage($list_image_path['avatarThumb'], "product/{$request->name}/avatar");
            $request->merge(['avatar' => basename($avatarPath)]);
            $request->merge(['subCategory_id' => serialize($request->subCat)]);
            $product = Product::create($request->all());
            $listColor = [
                'red' => '#FF0000',
                'gray' => '#808080',
                'white' => '#FFFFFF',
                'beige' => '#F5F5DC',
                'black' => '#000000',
                'brown' => '#A52A2A'
            ];

            $count = 0;
            if (!empty($list_image_path['image_color'])) {
                foreach ($list_image_path['image_color'] as $color => $list_image) {
                    //tạo các phiên bản màu của sản phẩm
                    if ($color) {
                        $ver_color = color_version::create([
                            'product_id' => $product->id,
                            'name' => $color,
                            'code_color' => $listColor[$color]
                        ]);
                        $url = [];
                        foreach ($list_image as $k => $image) {
                            $imagePath = ImageStorageLibrary::storeImage($image, "product/{$request->name}/{$color}");
                            $url[] = basename($imagePath);
                            $count++;
                        }
                        image_service::create([
                            'color_ver_id' => $ver_color->id,
                            'url' => serialize($url)
                        ]);
                    }
                }
            }
            if ($count > 0) return response()->json([
                'code' => 200,
                'messages' => 'Đã thêm sản phẩm thành công'
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function validateForm()
    {
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
        $product = Product::with(['category.subCategory' => function ($query) use ($id) {
            $product = Product::find($id);
            if (isset($product->subCategory_id) && is_array(unserialize($product->subCategory_id))) {
                $subCategory_id = unserialize($product->subCategory_id);
                $query->whereIn('id', $subCategory_id);
            } else {
                $query->whereIn('id', []);
            }
        }])->with('colors', 'colors.images')->find($id);
        if (!$product) abort(404);
        $contentUpdateUrl = ImageStorageLibrary::updateUrlContent($product->description, 'product', $product->name);
        $product->description = $contentUpdateUrl;
        $color_ver = [];
        foreach ($product->colors as $color) {
            $color_ver[$color->name] = unserialize($color->images->url);
            $color->images->url = unserialize($color->images->url);
        };
        $image_ver = [];
        foreach ($color_ver as $color => $images) {
            $html = '';
            foreach ($images as $image) {
                $src = url("storage/uploads/product/$product->name/$color/$image");
                $html .=  "<div class='swiper-slide' style='position:relative'>
                <img class='img-fluid thumbnail' src='$src' alt='img'>
            </div>";
            }
            $image_ver[] = $html;
        }
        $cate = Category::with('subCategory')->get();
        $sorting = $product->sorting;
        return view('admin.product.edit', compact('cate', 'sorting', 'product', 'image_ver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        try {
            //validate ảnh trong bài viết
            if (!MimeChecker::ValidateImageInContent($request->desc)) return response()->json(['code' => 422, 'messages' => 'ảnh trong bài viết không đúng định đạng jpg, png, jpeg, webp hoặc lớn hơn 3MB'], 422);
            //tìm sản phẩm
            $product = Product::with('category')->with('colors', 'colors.images')->find($id);
            //sử lý khi không tìm thấy sản phẩm
            if (!$product) return response()->json(['code' => 404, 'messages' => 'Không Tìm Thấy Sản Phẩm'], 404);
            //xử lý đổi tên thư mục lưu ảnh khi tên sản phẩm thay đổi
            $product->name != $request->name ? ImageStorageLibrary::updateNameFolder('product', $product->name, $request->name) : '';
            // xử lý ảnh avatar nếu có thay đổi
            if ($request->avatarThumb) {
                $newImagePath = ImageStorageLibrary::processImageUpdate($request->avatarThumb, 'product', $request->name, 'avatar', $product->avatar);
                $request->merge(['avatar' => basename($newImagePath)]);
            }
            //xử lý bài viết và lưu lại ảnh mới
            $request->merge(['description' => ImageStorageLibrary::processAndSaveImagesInContentUpdate($request->desc, 'product', $request->name)]);
            //sử lý màu sản phẩm và list ảnh sp theo màu
            $this->updateColorVerAndStoreImageByColorVer($request->color, $product, $request->image_color);
            $request->merge(['subCategory_id' => serialize($request->subCat)]); //lưu danh sách subCate
            $product->update($request->all());
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
            $product = Product::find($id);
            if (!$product) return response()->json([
                'code' => 404,
                'messages' => 'Không tìm thấy sản phẩm'
            ], 404);
            $product->status = 'off';
            $product->save();
            return response()->json([
                'code' => 200,
                'messages' => 'success'
            ], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $products = Product::with('category')->where('name', 'like', "%$keywords%")->get();
        $productSearch = $products->map(function ($product) {
            if (isset($product->subCategory_id) && is_array(unserialize($product->subCategory_id))) {
                return Product::with(['category.subCategory' => function ($query) use ($product) {
                    $query->whereIn('id', unserialize($product->subCategory_id));
                }])->find($product->id);
            } else {
                $product->category->subCategory = collect();
                return $product;
            }
        });
        return response()->json([
            'code' => 200,
            'html' => $this->get_html($productSearch, 'search')
        ], 200);
        // dd($productSearch);
    }

    public function filterProductsAjax($flag=''){
        $products = $flag=='trash'?$this->get_list_products('','on'):$this->get_list_products($flag,'');
        return response() -> json([
            'html' => $this->get_html($products,'current'),
            'nav' => $this->get_nav($products,$flag)
        ]);
    }


    private function get_html($products, $flag)
    {
        $html = '';
        foreach ($products as $product) {
            $categoryName =  $product->category->name;
            $pathAvatar = url("storage/uploads/product/$product->name/avatar/$product->avatar");
            $sale_price = $product->sale_price > 0 ? number_format($product->regular_price, 0, '', '.') . ' đ' : '';
            $regular_price = $product->sale_price > 0 ? number_format($product->sale_price, 0, '', '.') . ' đ' : number_format($product->regular_price, 0, '', '.') . ' đ';
            $routeEdit = route('admin.product.edit', ['id' => $product->id]);
            $disabled = $product->status == 'off' ? 'disable-link' : '';
            $status = $product->status == 'on' ? "<span class='badge bg-success-transparent'>Bật</span>" : "<span class='badge bg-danger-transparent'>Tắt</span>";
            $SubcategoryHtml = '';
            if (!$product->category->subCategory->isEmpty()) {
                foreach ($product->category->subCategory as $subCat) {
                    $SubcategoryHtml .= "<span
                    class='badge bg-light text-default'>$subCat->name</span><br>";
                }
            } else {
                $SubcategoryHtml .= "<span class='badge bg-light text-default'>Không Có</span>";
            };

            $html .= "<tr class='product-list $flag'>
            <td>
            <div class='d-flex align-items-center'>
            <div class='me-2'>
                <span class='avatar avatar-md avatar-rounded'>
                    <img src='$pathAvatar'
                        alt=''>
                </span>
            </div>
            <div class='fw-semibold'>
                $product->name
            </div>
        </div>

            </td>

            <td style='text-align: center'>
                <span class='badge bg-light text-default'>$categoryName</span>
            </td>
            <td style='text-align: center' >
                $SubcategoryHtml
            </td>
            <td>
                <p class='text-danger text-decoration-line-through'>
                    $sale_price
                </p>
                <p class='text-primary'>$regular_price
                </p>
            </td>
            <td> $product->quantity </td>
            <td>
                $status
            </td>
            <td>
                <div class='hstack gap-2 fs-15'>
                    <a href='$routeEdit'
                        class='btn btn-icon btn-sm btn-info-light'><i
                            class='ri-edit-line'></i></a>
                            <a href=''
                            class='btn btn-icon btn-sm btn-danger-light product-btn btnDeleteProduct $disabled' data-id='$product->id'><i
                                class='ri-delete-bin-line'></i></a>
                </div>
            </td>
        </tr>";
        }
        return $html;
    }

    private function get_nav($products, $flag){
        $html = '';
            $previousHtml = "<li class='page-item disabled'>
            <span class='page-link'>Previous</span>
        </li>";
        $currentPage = $products->currentPage();
        $startPage = max($currentPage - 3, 1); // Hiển thị tối đa 3 trang trước trang hiện tại
        $endPage = min($currentPage + 3, $products->lastPage());
        $body = '';
        for ($i = $startPage; $i <= $endPage; $i++) {
            if(empty($flag)){
                $url = url('admin/product/index')."?page=$i";
            }else{
                $url = $flag=='trash'?url('admin/product/index')."?trash=on&page=$i":url("admin/product/index/$flag")."?page=$i";
            }
            if ($i == $currentPage) {
                $body .= '<li class="page-item active"><a class="page-link" href="javascript:void(0);">' . $i . '</a></li>';
            } else {
                $body .= '<li class="page-item"><a class="page-link" href="' .$url . '">' . $i . '</a></li>';
            }
        }
        $dotHtml= $products->currentPage() + 3 < $products->lastPage()?"<li class='page-item'>
        <a class='page-link' href='javascript:void(0);'>
            <i class='bi bi-three-dots'></i>
        </a>
    </li>
            <li class='page-item'>
                <a class='page-link' href='javascript:void(0);'>
                    <i class='bi bi-three-dots'></i>
                </a>
            </li>":'';
            if(empty($flag)){
                $url = url('admin/product/index')."?page=2";
            }else{
                $url = $flag=='trash'?url('admin/product/index')."?trash=on&page=2":url("admin/product/index/$i")."?page=2";
            }
        $nextHtml = $products->hasMorePages()?"<li class='page-item'>
        <a class='page-link' href='$url'
            aria-label='Next'>
            <span aria-hidden='true'>Next</span>
        </a>
    </li>":"<li class='page-item disabled'>
    <span class='page-link'>Next</span>
</li>";
      $html .= $previousHtml.$body.$dotHtml.$nextHtml;
    return $html;
    }

    private function updateColorVerAndStoreImageByColorVer($listColor, $product, $listImage)
    {
        //sử lý đổi màu sản phẩm
        foreach ($listColor as $key => $color) {
            if (!empty($color)) {
                if (!empty($product->colors[$key])) {
                    $oldColor = $product->colors[$key]->name;
                    $oldColorDirectory = public_path("storage/uploads/product/$product->name/$oldColor");
                    $newColorDirectory = public_path("storage/uploads/product/$product->name/$color");
                    if (File::isDirectory($oldColorDirectory)) {
                        File::move($oldColorDirectory, $newColorDirectory);
                        $color_ver = color_version::where(function ($query) use ($product, $oldColor) {
                            $query->where('product_id', $product->id)->where('name', $oldColor);
                        })->first();
                        $color_ver->name = $color;
                        $color_ver->save();
                    }
                } else {
                    $listColor = [
                        'red' => '#FF0000',
                        'gray' => '#808080',
                        'white' => '#FFFFFF',
                        'beige' => '#F5F5DC',
                        'black' => '#000000',
                        'brown' => '#A52A2A'
                    ];
                    $color_ver =  color_version::create([
                        'product_id' => $product->id,
                        'name' => $color,
                        'code_color' => $listColor[$color]
                    ]);
                    image_service::create([
                        'color_ver_id' => $color_ver->id,
                    ]);
                    File::makeDirectory(public_path("storage/uploads/product/$product->name/$color"), 0755, true);
                }
            }
        }
        //xử lý khi upload ảnh mới
        if ($listImage) {
            foreach ($listImage as $color => $images) {
                if (!empty($images)) {
                    if (File::isDirectory(public_path("storage/uploads/product/$product->name/$color"))) {
                        File::deleteDirectory(public_path("storage/uploads/product/$product->name/$color"));
                    }
                    $url = [];
                    foreach ($images as $image) {
                        $path = ImageStorageLibrary::storeImage($image, "product/$product->name/$color");
                        $url[] = basename($path);
                    }
                    $color_ver = color_version::where(function ($query) use ($product, $color) {
                        $query->where('product_id', $product->id)->where('name', $color);
                    })->first();
                    $image_service = image_service::where('color_ver_id', $color_ver->id)->first();
                    $image_service->url = serialize($url);
                    $image_service->save();
                }
            }
        }
    }

    private function get_list_products($id,$trash){
        if ($trash == 'on') {
            $products = Product::with('category.subCategory')->where('status', 'off')->paginate(20);
            $filteredProducts = $products->map(function ($product) {
                if (!empty($product->subCategory_id)) {
                    $subCategoryIds = unserialize($product->subCategory_id);
                    if (is_array($subCategoryIds)) {
                        $product->category->subCategory = $product->category->subCategory->whereIn('id', $subCategoryIds);
                    } else {
                        $product->category->subCategory = collect(); // Không có subcategory
                    }
                } else {
                    $product->category->subCategory = collect(); // Không có subcategory
                }
                return $product;
            });
        } else {
            if (empty($id)) {
                $products = Product::with('category.subCategory')->paginate(20);
                $filteredProducts = $products->map(function ($product) {
                    if (!empty($product->subCategory_id)) {
                        $subCategoryIds = unserialize($product->subCategory_id);
                        if (is_array($subCategoryIds)) {
                            $product->category->subCategory = $product->category->subCategory->whereIn('id', $subCategoryIds);
                        } else {
                            $product->category->subCategory = collect(); // Không có subcategory
                        }
                    } else {
                        $product->category->subCategory = collect(); // Không có subcategory
                    }
                    return $product;
                });
            } else {
                $products = Product::with('category.subCategory')->where('category_id', $id)->paginate(20);
                $filteredProducts = $products->map(function ($product) {
                    if (!empty($product->subCategory_id)) {
                        $subCategoryIds = unserialize($product->subCategory_id);
                        if (is_array($subCategoryIds)) {
                            $product->category->subCategory = $product->category->subCategory->whereIn('id', $subCategoryIds);
                        } else {
                            $product->category->subCategory = collect(); // Không có subcategory
                        }
                    } else {
                        $product->category->subCategory = collect(); // Không có subcategory
                    }
                    return $product;
                });
            }
        }

        $filteredProductsPaginated = new LengthAwarePaginator(
            $filteredProducts,
            $products->total(),
            $products->perPage(),
            $products->currentPage(),
            ['path' => request()->url()]
        );
        return $filteredProductsPaginated;
    }
}
