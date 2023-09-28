<link rel="stylesheet" href="{{asset('assets/css/add-product.css')}}">
@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Sản phẩm </h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->
    <!-- Start::row-1 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body add-products p-0">
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.product.store') }}">
                @csrf()
                <div class="p-4">
                    <div class="row gx-5">
                        <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                            <div class="card custom-card shadow-none mb-0 border-0">
                                <div class="card-body p-0">
                                    <div class="row gy-3">
                                        <div class="col-xl-12">
                                            <label for="product-name-add" class="form-label">Tên sản phẩm</label>
                                            <input type="text" name="product_name" class="form-control" id="product-name-add" placeholder="Name">
                                            <label for="product-name-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Product Name should not exceed 30 characters</label>
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="product-category-add" class="form-label">Danh mục</label>                                         
                                            <select class="form-control" data-trigger name="category_id" id="product-category-add">      
                                                <option value="">Select</option>
                                                @foreach($cate as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="product-subcategory-add" class="form-label">Danh mục thuộc tính</label>
                                            <select class="form-control" data-trigger name="subcategory_id" id="product-subcategory-create">
                                                <option value="">Select</option>
                                                @foreach($cate as $category)
                                                    <optgroup label="{{$category->name}}">
                                                        @foreach($category->subCategory as $subcategory)
                                                            <option value="{{$subcategory->id}}">-- {{$subcategory->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="product-type" class="form-label">Màu Sắc</label>
                                            <input type="text" name="color" class="form-control" id="product-type" placeholder="Color">
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="product-cost-add" class="form-label">Số Lượng</label>
                                            <input type="text" name="quantity" class="form-control" id="product-cost-add" placeholder="to be continued" readonly>
                                            <label for="product-cost-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Mention final price of the product</label>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="product-description-add" class="form-label">Mô tả</label>
                                            <textarea class="form-control" name="desciption" id="product-description-add" rows="2"></textarea>
                                            <label for="product-description-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Description should not exceed 500 letters</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                            <div class="card custom-card shadow-none mb-0 border-0">
                                <div class="card-body p-0">
                                    <div class="row gy-4">       
                                        <div class="col-xl-4">
                                            <label for="product-dealer-price" class="form-label">Giá Chưa sale</label>
                                            <input type="text" name="regular-price" class="form-control" id="product-dealer-price" placeholder="Dealer Price">
                                        </div>
                                        <div class="col-xl-4">
                                            <label for="product-actual-price" class="form-label">Giá cuối</label>
                                            <input type="text" name="sale-price" class="form-control" id="product-actual-price" placeholder="Actual Price">
                                        </div>
                                        <div class="col-xl-4">
                                            <label for="product-discount" class="form-label">Discount</label>
                                            <input type="text" name="discount" class="form-control" id="product-discount" placeholder="Discount in %">
                                        </div>
                                        <div class="col-xl-12 product-documents-container">
                                            <p class="fw-semibold mb-2 fs-14">Product Images :</p>
                                            <input type="file" name="image_color[][]" class="product-Images" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="6">
                                        </div>
                                        <div class="col-xl-12 product-documents-container">
                                            <p class="fw-semibold mb-2 fs-14">Product Images :</p>
                                            <div id="image-container">
                                                <!-- Các trường hình ảnh sẽ được thêm vào đây -->
                                            </div>
                                            <lable id="add-image-button">Thêm hình ảnh</lable>
                                        </div>
                                        <div class="col-xl-12" id="imageList"></div>
                                        <div id="imageModal" class="modal">
                                            <span class="close" id="closeModal">&times;</span>
                                            <img class="modal-content" id="modalImage">
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="product-status-add" class="form-label">Trạng Thái Hiển Thị</label>
                                            <select class="form-control" data-trigger name="product-status" id="product-status-add">
                                                <option value="">Select</option>
                                                <option value="on">Bật</option>
                                                <option value="off">Ẩn</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-6">
                                            <label for="product-status-add" class="form-label">Trạng Thái Kho</label>
                                            <select class="form-control" data-trigger name="product-status-stock" id="product-status-add">
                                                <option value="">Select</option>
                                                <option value="instock">Còn Hàng</option>
                                                <option value="out-stock">Hết Hàng</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="product-cost-add" class="form-label">Thứ tự</label>
                                            <input type="sort" name="quantity" class="form-control" id="product-cost-add" placeholder="thứ tự hiển thị">
                                            <label for="product-cost-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Mention final price of the product</label>
                                        </div>
                                        <div class="col-xl-6">
                                        <label for="product-status-add" class="form-label">Tùy chọn hiển thị</label>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-check form-switch">
                                                        <input name="on-outstanding" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault1">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault1">Sản Phẩm nổi bật</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input name="on-hot" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault2">Sản Phẩm Hot</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input name="on-sale" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault3">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault3">Sản Phẩm giá tốt</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input name="on-installment" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked1" checked="">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked1">Sản phẩm trả góp</label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-check form-switch">
                                                        <input name="on-new" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked2" checked="">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked2">Sản phẩm mới về</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input name="on-comming" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked3" checked="">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked3">Sản phẩm sắp về</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input name="on-gift" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked4" checked="">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked4">Sản phẩm có quà tặng</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                             
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary-light m-1">Add Product<i class="bi bi-plus-lg ms-2"></i></button>                 
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
