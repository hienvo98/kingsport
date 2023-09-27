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
                <div class="p-4">
                    <div class="row gx-5">
                        <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                            <div class="card custom-card shadow-none mb-0 border-0">
                                <div class="card-body p-0">
                                    <div class="row gy-3">
                                        <div class="col-xl-12">
                                            <label for="product-name-add" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="product-name-add" placeholder="Name">
                                            <label for="product-name-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Product Name should not exceed 30 characters</label>
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="product-category-add" class="form-label">Danh mục</label>                                         
                                            <select class="form-control" data-trigger name="product-category-add" id="product-category-add">      
                                                <option value="">Select</option>
                                                @foreach($cate as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="product-subcategory-add" class="form-label">Danh mục thuộc tính</label>
                                            <select class="form-control" data-trigger name="product-subcategory-add" id="product-subcategory-create">
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
                                            <input type="text" class="form-control" id="product-type" placeholder="Color">
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="product-cost-add" class="form-label">Số Lượng</label>
                                            <input type="text" class="form-control" id="product-cost-add" placeholder="to be continued" readonly>
                                            <label for="product-cost-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Mention final price of the product</label>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="product-description-add" class="form-label">Mô tả</label>
                                            <textarea class="form-control" id="product-description-add" rows="2"></textarea>
                                            <label for="product-description-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Description should not exceed 500 letters</label>
                                        </div>
                                        <div class="col-xl-12">
                                            <label class="form-label">Product Features</label>
                                            <div id="product-features"></div>
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
                                            <input type="text" class="form-control" id="product-dealer-price" placeholder="Dealer Price">
                                        </div>
                                        <div class="col-xl-4">
                                            <label for="product-actual-price" class="form-label">Giá cuối</label>
                                            <input type="text" class="form-control" id="product-actual-price" placeholder="Actual Price">
                                        </div>
                                        <div class="col-xl-4">
                                            <label for="product-discount" class="form-label">Discount</label>
                                            <input type="text" class="form-control" id="product-discount" placeholder="Discount in %">
                                        </div>
                                        <div class="col-xl-12 product-documents-container">
                                            <p class="fw-semibold mb-2 fs-14">Product Images :</p>
                                            <input type="file" class="product-Images" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="6">
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <label for="product-status-add" class="form-label">Trạng Thái Hiển Thị</label>
                                            <select class="form-control" data-trigger name="product-status-add" id="product-status-add">
                                                <option value="">Select</option>
                                                <option value="Published">Bật</option>
                                                <option value="Scheduled">Ẩn</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-6">
                                            <label for="product-status-add" class="form-label">Trạng Thái Kho</label>
                                            <select class="form-control" data-trigger name="product-status-add" id="product-status-add">
                                                <option value="">Select</option>
                                                <option value="Published">Còn Hàng</option>
                                                <option value="Scheduled">Hết Hàng</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                        <label for="product-status-add" class="form-label">Tùy chọn hiển thị</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Sản Phẩm nổi bật</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Sản Phẩm Hot</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Sản Phẩm giá tốt</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked" checked="">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Sản phẩm trả góp</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked" checked="">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Sản phẩm mới về</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked" checked="">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Sản phẩm sắp về</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked" checked="">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Sản phẩm có quà tặng</label>
                                            </div>
                                        </div>                             
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                    <button class="btn btn-primary-light m-1">Add Product<i class="bi bi-plus-lg ms-2"></i></button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
