<link rel="stylesheet" href="{{ asset('assets/css/add-product.css') }}">
@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->

    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Tạo Sản Phẩm</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tạo Sản Phẩm</li>
                </ol>
            </nav>
        </div>
    </div>
    @if (session('message'))
        <div id="notification" class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div id="errors">

    </div>

    <!-- Page Header Close -->
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <form method="POST" id="form-product" enctype="multipart/form-data"
                action="{{ route('admin.product.store') }}">
                @csrf()
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body p-0">
                                <div class="d-flex p-3 align-items-center justify-content-between">
                                    <div>
                                        <h6 class="fw-semibold mb-0">Nội Dung Sản Phẩm</h6>
                                    </div>
                                    <div>
                                        <ul class="nav nav-tabs nav-tabs-header mb-0 d-sm-flex d-block" role="tablist">
                                            <li class="nav-item m-1">
                                                <a class="nav-link active" data-bs-toggle="tab" role="tab"
                                                    aria-current="page" href="#all-tasks" aria-selected="true">Thông Tin Sản
                                                    Phẩm</a>
                                            </li>
                                            <li class="nav-item m-1">
                                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                                    href="#pending" aria-selected="true">Mô Tả Sản Phẩm</a>
                                            </li>
                                            <li class="nav-item m-1">
                                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="image"
                                                    href="#image" aria-selected="true">Hình Ảnh Sản Phẩm</a>
                                            </li>
                                            <li class="nav-item m-1">
                                                <a class="nav-link" data-bs-toggle="tab" role="tab"
                                                    aria-current="options" href="#options" aria-selected="true">Trạng Thái
                                                    Sản Phẩm</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-sm btn-light btn-wave waves-light waves-effect"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:void(0);">Select All</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Share All</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Delete All</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content task-tabs-container">
                        <div class="tab-pane show active p-0" id="all-tasks" role="tabpanel">
                            <div class="row" id="tasks-container">
                                <div class="p-4">
                                    <div class="row gx-5">
                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                            <div class="card custom-card shadow-none mb-0 border-0">
                                                <div class="card-body p-0">
                                                    <div class="row gy-3 p-3">
                                                        <div class="col-xl-12">
                                                            @error('name')
                                                                <div class="alert alert-danger text-capitalize">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="product-name-add"
                                                                class="form-label text-capitalize">Tên sản
                                                                phẩm</label>
                                                            <input type="text" name="name" class="form-control"
                                                                id="product-name-add" placeholder="Name" required
                                                                autocomplete="name" autofocus>
                                                            <label for="product-name-add"
                                                                class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Product
                                                                Name
                                                                should not exceed 30 characters</label>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            @error('name')
                                                                <div class="alert alert-danger text-capitalize">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="product-name-add"
                                                                class="form-label text-capitalize">URL</label>
                                                            <input type="text" name="url" class="form-control"
                                                                id="product-url-add" placeholder="Url" required
                                                                autocomplete="name" autofocus>
                                                            <label for="product-name-add"
                                                                class="form-label mt-1 fs-12 op-5 text-muted mb-0 text-capitalize">URL
                                                                sẽ được tự động sinh ra khi nhập tên sản phẩm, vui lòng
                                                                không viết bậy bạ vào đây</label>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            @error('category_id')
                                                                <div class="alert alert-danger text-capitalize">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="product-category-add"
                                                                class="form-label text-capitalize">Danh mục</label>

                                                            <select class="form-control" name="category_id"
                                                                id="product-category-add" required>
                                                                <option value="">Chọn Danh Mục</option>
                                                                @foreach ($cate as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-xl-12" id="subcategory_box">
                                                            {{-- @error('subcategory_id')
                                                                <div class="alert alert-danger text-capitalize">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror --}}
                                                            <label for="product-subcategory-add"
                                                                class="form-label text-capitalize">Danh mục thuộc
                                                                tính</label>

                                                            @if ($cate->count() > 0)
                                                                @php
                                                                    $stt = 0;
                                                                @endphp
                                                                @foreach ($cate as $category)
                                                                    @foreach ($category->subCategory as $sub)
                                                                        <div data-parent-id="{{ $category->id }}"
                                                                            class="card custom-card d-none">
                                                                            <div class="card-header d-block">
                                                                                <div
                                                                                    class="d-sm-flex d-block align-items-center">
                                                                                    <div class="me-2">
                                                                                        <span>
                                                                                            <div class="form-check-inline">
                                                                                                <input type="checkbox"
                                                                                                    data-type="subCat"
                                                                                                    data-stt="sub-{{ $stt }}"
                                                                                                    class="form-check-input"
                                                                                                    id="sub-{{ $sub->id }}"
                                                                                                    name="subCat[]"
                                                                                                    value="{{ $sub->id }}">
                                                                                            </div>
                                                                                        </span>
                                                                                    </div>
                                                                                    @php
                                                                                        $stt++;
                                                                                    @endphp
                                                                                    <div class="flex-fill">
                                                                                        <a href="javascript:void(0)">
                                                                                            <label
                                                                                                for="sub-{{ $sub->id }}"
                                                                                                class="fs-14 fw-semibold text-center">{{ $sub->name }}</label>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <div class="col-xl-4">
                                                            @error('regular_price')
                                                                <div class="alert alert-danger text-capitalize">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="product-dealer-price" class="form-label">Giá Chưa
                                                                sale</label>
                                                            <input type="text" name="regular_price"
                                                                class="form-control" id="product-dealer-price"
                                                                placeholder="Regular Price" required>
                                                            <label for="product-description-add"
                                                                class="form-label mt-1 fs-12 op-5 text-muted mb-0"></label>
                                                        </div>

                                                        <div class="col-xl-4">
                                                            @error('discount')
                                                                <div class="alert alert-danger text-capitalize">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="product-discount"
                                                                class="form-label">Discount</label>
                                                            <input type="text" name="discount" class="form-control"
                                                                id="product-discount" value=""
                                                                placeholder="Discount in %" disabled>
                                                            <label for="product-description-add"
                                                                class="form-label mt-1 fs-12 op-5 text-muted mb-0">Từ
                                                                1-50</label>
                                                        </div>


                                                        <div class="col-xl-4">
                                                            @error('sale_price')
                                                                <div class="alert alert-danger text-capitalize">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="product-dealer-price" class="form-label">Giá Chưa
                                                                sale</label>
                                                            <input type="text" name="sale_price" class="form-control"
                                                                id="product-dealer-price" placeholder="Last Price">
                                                            <label for="product-description-add"
                                                                class="form-label mt-1 fs-12 op-5 text-muted mb-0"></label>
                                                        </div>

                                                        <div class="col-xl-4">
                                                            <label for="product-cost-add" class="form-label">Số
                                                                Lượng</label>
                                                            <input type="number" name="quantity" class="form-control"
                                                                id="product-cost-add" placeholder="to be continued"
                                                                required>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <label for="product-cost-add" class="form-label">Thứ
                                                                tự</label>
                                                            <input type="hidden" name="sorting"
                                                                value="{{ $sorting }}">
                                                            <input type="numper" name="sorting"
                                                                placeholder="Sản Phẩm Thứ {{ $sorting }}"
                                                                class="form-control" id="product-cost-add" disabled>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <label for="product-cost-add" class="form-label">Số
                                                                Lượng Đã Bán</label>
                                                            <input type="number" name="sold" class="form-control"
                                                                id="product-cost-add" placeholder="to be continued">
                                                            <label for="product-name-add"
                                                                class="form-label mt-1 fs-12 op-5 text-muted mb-0">Real or fake, it's up to you</label>
                                                        </div>
                                                        <div class="col-xl-12" id="imageList"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                            </div>
                        </div>

                        <div class="tab-pane p-0" id="pending" role="tabpanel">
                            <div class="row">
                                <div class="p-4">
                                    <div class="row gx-5">
                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                            <div class="card custom-card shadow-none mb-0 border-0">
                                                <div class="card-body p-0">
                                                    <div class="row gy-3 p-3">
                                                        <label for="product-description-add" class="form-label">Mô tả Sản
                                                            Phẩm</label>
                                                        <div id="blog-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane p-0" id="image" role="tabpanel">
                            <div class="row">
                                <div class="p-4">
                                    <div class="row gx-5">
                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                            <div class="card custom-card shadow-none mb-0 border-0">
                                                <div class="card-body p-0">
                                                    <div class="row gy-3 p-3">
                                                        <div class="avatar-group">
                                                            <div class="col-xl-12">
                                                                <div class="form-group">
                                                                    <label for="avatar" class="form-label">Avatar Sản
                                                                        Phẩm</label>
                                                                    <div class="col-xl-12 product-documents-container p-2">
                                                                        <p class="fw-semibold mb-2 fs-14">Chọn file ảnh:
                                                                        </p>
                                                                        <input type="file" data-ver-color=""
                                                                            id="avatar" name="avatar"
                                                                            data-color="avatar"
                                                                            class="product-Images form-control "
                                                                            data-allow-reorder="true"
                                                                            data-max-file-size="3MB" accept=".jpeg, .jpg, .png, .gif, .webp" size="3000000" required>
                                                                        <input type="hidden" name="list_color_1"
                                                                            value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12">
                                                                <div class="card custom-card">
                                                                    <div class="card-header">
                                                                        <div class="card-title">
                                                                            Ảnh Đại Diện
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="swiper swiper-overflow">
                                                                            <div class="swiper-wrapper"
                                                                                data-slide="avatar">

                                                                            </div>
                                                                            <div class="swiper-pagination"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="color-group" data-group-color="color-1"
                                                            style="display: none">
                                                            <div class="col-xl-6">
                                                                <select class="form-select select-color"
                                                                    data-number-color="color-1"
                                                                    data-select-color="color-1"
                                                                    aria-label="Default select example">
                                                                    <option selected value="">Chọn Màu Sản Phẩm
                                                                    </option>
                                                                    <option data-color="red" value="red">red</option>
                                                                    <option data-color="black" value="black">black
                                                                    </option>
                                                                    <option data-color="gray" value="gray">gray</option>
                                                                    <option data-color="white" value="white">white
                                                                    </option>
                                                                    <option data-color="beige" value="beige">beige
                                                                    </option>
                                                                    <option data-color="brown" value="brown">brown
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <label for="product-description-add"
                                                                class="form-label mt-1 fs-12 op-5 text-red mb-0">Chọn Màu
                                                                Trước Khi
                                                                Upload Ảnh</label>
                                                            <div class="image mt-1"
                                                                style="border-bottom:1px solid blueviolet">
                                                                <div class="form-check d-none">
                                                                    <div class="card custom-card mb-1">
                                                                        <div class="card-header d-block">
                                                                            <div
                                                                                class="d-sm-flex d-block align-items-center">
                                                                                <div class="me-2">
                                                                                    <span>
                                                                                        <div class="form-check-inline">
                                                                                            <input type="checkbox"
                                                                                                data-type=""
                                                                                                class="form-check-input check-color"
                                                                                                id="color-1"
                                                                                                name="color[]"
                                                                                                value="">
                                                                                        </div>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="flex-fill">
                                                                                    <a href="javascript:void(0)">
                                                                                        <label for=""
                                                                                            class="fs-14 fw-semibold text-center"></label>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <div class="col-xl-12 product-documents-container p-2">
                                                                        <p class="fw-semibold mb-2 fs-14">Chọn file ảnh:
                                                                        </p>
                                                                        <input type="file" data-ver-color=""
                                                                            data-color="color-1" id="file-color-1"
                                                                            name=""
                                                                            class="product-Images form-control " multiple
                                                                            data-allow-reorder="true"
                                                                            data-max-file-size="3MB" accept=".jpeg, .jpg, .png, .gif, .webp" size="3000000">
                                                                        <input type="hidden" name="list_color_1"
                                                                            value="">
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="card custom-card">
                                                                            <div class="card-header">
                                                                                <div class="card-title">
                                                                                    Danh Sách Ảnh
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="swiper swiper-overflow">
                                                                                    <div class="swiper-wrapper"
                                                                                        data-slide="color-1">
                                                                                    </div>
                                                                                    <div class="swiper-pagination"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="color-group" data-group-color="color-2"
                                                            style="display: none">
                                                            <div class="col-xl-6">
                                                                <select class="form-select select-color"
                                                                    data-number-color="color-2"
                                                                    data-select-color="color-2"
                                                                    aria-label="Default select example">
                                                                    <option selected value="">Chọn Màu Sản Phẩm
                                                                    </option>
                                                                    <option data-color="red" value="red">red</option>
                                                                    <option data-color="black" value="black">black
                                                                    </option>
                                                                    <option data-color="gray" value="gray">gray</option>
                                                                    <option data-color="white" value="white">white
                                                                    </option>
                                                                    <option data-color="beige" value="beige">beige
                                                                    </option>
                                                                    <option data-color="brown" value="brown">brown
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <label for="product-description-add"
                                                                class="form-label mt-1 fs-12 op-5 text-red mb-0">Chọn Màu
                                                                Trước Khi
                                                                Upload Ảnh</label>
                                                            <div class="image mt-1"
                                                                style="border-bottom:1px solid blueviolet">
                                                                <div class="form-check d-none">
                                                                    <div class="card custom-card mb-1">
                                                                        <div class="card-header d-block">
                                                                            <div
                                                                                class="d-sm-flex d-block align-items-center">
                                                                                <div class="me-2">
                                                                                    <span>
                                                                                        <div class="form-check-inline">
                                                                                            <input type="checkbox"
                                                                                                data-type=""
                                                                                                class="form-check-input check-color"
                                                                                                id="color-2"
                                                                                                name="color[]"
                                                                                                value="">
                                                                                        </div>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="flex-fill">
                                                                                    <a href="javascript:void(0)">
                                                                                        <label for=""
                                                                                            class="fs-14 fw-semibold text-center"></label>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <div class="col-xl-12 product-documents-container p-2">
                                                                        <p class="fw-semibold mb-2 fs-14">Chọn file ảnh:
                                                                        </p>
                                                                        <input type="file" data-color="color-2"
                                                                            id="file-color-2" multiple name=""
                                                                            class="product-Images form-control" accept=".jpeg, .jpg, .png, .gif, .webp" size="3000000">

                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="card custom-card">
                                                                            <div class="card-header">
                                                                                <div class="card-title">
                                                                                    Danh Sách Ảnh
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="swiper swiper-overflow">
                                                                                    <div class="swiper-wrapper"
                                                                                        data-slide="color-2">

                                                                                    </div>
                                                                                    <div class="swiper-pagination"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="color-group" data-group-color="color-3"
                                                            style="display: none">
                                                            <div class="col-xl-6">
                                                                <select class="form-select select-color"
                                                                    data-number-color="color-3"
                                                                    data-select-color="color-3"
                                                                    aria-label="Default select example">
                                                                    <option selected value="">Chọn Màu Sản Phẩm
                                                                    </option>
                                                                    <option data-color="red" value="red">red</option>
                                                                    <option data-color="black" value="black">black
                                                                    </option>
                                                                    <option data-color="gray" value="gray">gray</option>
                                                                    <option data-color="white" value="white">white
                                                                    </option>
                                                                    <option data-color="beige" value="beige">beige
                                                                    </option>
                                                                    <option data-color="brown" value="brown">brown
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <label for="product-description-add"
                                                                class="form-label mt-1 fs-12 op-5 text-red mb-0">Chọn Màu
                                                                Trước Khi
                                                                Upload Ảnh</label>
                                                            <div class="image mt-1"
                                                                style="border-bottom:1px solid blueviolet">
                                                                <div class="form-check d-none">
                                                                    <div class="card custom-card mb-1">
                                                                        <div class="card-header d-block">
                                                                            <div
                                                                                class="d-sm-flex d-block align-items-center">
                                                                                <div class="me-2">
                                                                                    <span>
                                                                                        <div class="form-check-inline">
                                                                                            <input type="checkbox"
                                                                                                data-type=""
                                                                                                class="form-check-input check-color"
                                                                                                id="color-3"
                                                                                                name="color[]"
                                                                                                value="">
                                                                                        </div>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="flex-fill">
                                                                                    <a href="javascript:void(0)">
                                                                                        <label for=""
                                                                                            class="fs-14 fw-semibold text-center"></label>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <div class="col-xl-12 product-documents-container p-2">
                                                                        <p class="fw-semibold mb-2 fs-14">Chọn file ảnh:
                                                                        </p>
                                                                        <input type="file" data-color="color-3"
                                                                            id="file-color-3" multiple name=""
                                                                            class="product-Images form-control"
                                                                            name="filepond" accept=".jpeg, .jpg, .png, .gif, .webp" size="3000000">
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="card custom-card">
                                                                            <div class="card-header">
                                                                                <div class="card-title">
                                                                                    Danh Sách Ảnh
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="swiper swiper-overflow">
                                                                                    <div class="swiper-wrapper"
                                                                                        data-slide="color-3">

                                                                                    </div>
                                                                                    <div class="swiper-pagination"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12" id="addImage"
                                                            data-asset="{{ asset('') }}">
                                                            <span class="btn btn-outline-primary">Ảnh Chi Tiết Sản Phẩm<i
                                                                    class="bi bi-plus-lg ms-2"></i></span>
                                                            <label for="product-description-add"
                                                                class="form-label mt-1 fs-12 op-5 text-muted mb-0">Tối đa 3
                                                                màu</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane p-0" id="options" role="tabpanel">
                            <div class="row">
                                <div class="p-4">
                                    <div class="row gx-5">
                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                            <div class="card custom-card shadow-none mb-0 border-0">
                                                <div class="card-body p-0">
                                                    <div class="row gy-3 p-3">
                                                        <div class="col-xl-6">
                                                            @error('status')
                                                                <div class="alert alert-danger text-capitalize">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="product-status-add" class="form-label">Trạng Thái
                                                                Hiển
                                                                Thị</label>
                                                            <select class="form-control" name="status" required>
                                                                <option value="">Chọn Trạng Thái Hiển Thị</option>
                                                                <option value="on">Bật</option>
                                                                <option value="off">Ẩn</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="product-status-add" class="form-label">Trạng Thái
                                                                Kho</label>
                                                            <select class="form-control" name="status_stock"
                                                                id="product-status-add" required>
                                                                <option value="">Chọn Trạng Thái Kho</option>
                                                                <option value="on">Bật</option>
                                                                <option value="off">Ẩn</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <label for="product-status-add" class="form-label">Tùy chọn
                                                                hiển
                                                                thị</label>
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-check form-switch">
                                                                        <input name="on_outstanding"
                                                                            class="form-check-input" type="checkbox"
                                                                            value="on" role="switch"
                                                                            id="flexSwitchCheckDefault1">
                                                                        <label class="form-check-label"
                                                                            for="flexSwitchCheckDefault1">Sản Phẩm nổi
                                                                            bật</label>
                                                                    </div>
                                                                    <div class="form-check form-switch">
                                                                        <input name="on_hot" class="form-check-input"
                                                                            type="checkbox" value="on" role="switch"
                                                                            id="flexSwitchCheckDefault2">
                                                                        <label class="form-check-label"
                                                                            for="flexSwitchCheckDefault2">Sản Phẩm
                                                                            Hot</label>
                                                                    </div>
                                                                    <div class="form-check form-switch">
                                                                        <input name="on_sale" class="form-check-input"
                                                                            type="checkbox" value="on" role="switch"
                                                                            id="flexSwitchCheckDefault3">
                                                                        <label class="form-check-label"
                                                                            for="flexSwitchCheckDefault3">Sản Phẩm giá
                                                                            tốt</label>
                                                                    </div>
                                                                    <div class="form-check form-switch">
                                                                        <input name="on_installment"
                                                                            class="form-check-input" type="checkbox"
                                                                            value="on" role="switch"
                                                                            id="flexSwitchCheckChecked1">
                                                                        <label class="form-check-label"
                                                                            for="flexSwitchCheckChecked1">Sản phẩm trả
                                                                            góp</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-check form-switch">
                                                                        <input name="on_new" class="form-check-input"
                                                                            type="checkbox" value="on" role="switch"
                                                                            id="flexSwitchCheckChecked2">
                                                                        <label class="form-check-label"
                                                                            for="flexSwitchCheckChecked2">Sản phẩm mới
                                                                            về</label>
                                                                    </div>
                                                                    <div class="form-check form-switch">
                                                                        <input name="on_comming" class="form-check-input"
                                                                            type="checkbox" role="switch"
                                                                            id="flexSwitchCheckChecked3" value="on">
                                                                        <label class="form-check-label"
                                                                            for="flexSwitchCheckChecked3">Sản phẩm sắp
                                                                            về</label>
                                                                    </div>
                                                                    <div class="form-check form-switch">
                                                                        <input name="on_gift" class="form-check-input"
                                                                            type="checkbox" role="switch"
                                                                            id="flexSwitchCheckChecked4" value="on">
                                                                        <label class="form-check-label"
                                                                            for="flexSwitchCheckChecked4">Sản phẩm có quà
                                                                            tặng</label>
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
                            </div>
                        </div>
                    </div>

                </div>
                <ul class="pagination justify-content-end">
                    <button id="submit" type="submit" class="btn btn-primary-light m-1">Tạo Sản Phẩm<i
                            class="bi bi-plus-lg ms-2"></i></button>
                </ul>
            </form>
        </div>
    </div>
      
    <script src="{{ asset('assets/js/add-products.js') }}"></script>
@endsection
