@extends('layouts.appAdmin')
@section('content')
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Sản Phẩm</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Danh sách sản phẩm
                    </div>
                    <div class="header-element header-search">
                        <!-- Start::header-link -->
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal"
                            data-bs-target="#searchModal">
                            <i class="bx bx-search-alt-2 header-link-icon"></i>
                        </a>
                        <!-- End::header-link -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input class="form-check-input check-all" type="checkbox" id="all-products"
                                            value="" aria-label="...">
                                    </th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Danh Mục</th>
                                    <th scope="col">Danh Mục Thuộc Tính</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số Lượng</th>
                                    <th scope="col">Mô Tả</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="product-list">
                                    <td class="product-checkbox"><input class="form-check-input" type="checkbox"
                                            id="product1" value="" aria-label="..."></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-2">
                                                <span class="avatar avatar-md avatar-rounded">
                                                    <img src="{{ asset('storage/images/demo.jpg') }}" alt="">
                                                </span>
                                            </div>
                                            <div class="fw-semibold">
                                                asdasdasddas
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-default">ádsadad</span>
                                    </td>
                                    <td><span class="badge bg-light text-default">ádsadd</span></td>
                                    <td>ádasdad</td>
                                    <td>adadad</td>
                                    <td>dấdasdsd</td>
                                    <td>
                                            <span class="badge bg-danger-transparent">Tắt</span>
                                            <span class="badge bg-success-transparent">Bật</span>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 fs-15">
                                            <a href="edit-products.html" class="btn btn-icon btn-sm btn-info-light"><i
                                                    class="ri-edit-line"></i></a>
                                            <a href="javascript:void(0);"
                                                class="btn btn-icon btn-sm btn-danger-light product-btn"><i
                                                    class="ri-delete-bin-line"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <nav aria-label="...">
                            <ul class="pagination mb-0">
                                {{-- Nút "Previous" --}}
                                {{-- @if ($product->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $product->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">Previous</span>
                                        </a>
                                    </li>
                                @endif --}}

                                {{-- Danh sách các trang --}}
                                {{-- @for ($i = 1; $i <= $product->lastPage(); $i++)
                                    <li class="page-item {{ $i === $product->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $product->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor --}}

                                {{-- Nút "Next" --}}
                                {{-- @if ($product->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $product->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">Next</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Next</span>
                                    </li>
                                @endif --}}
                            </ul>
                        </nav>
                        <button type="button" class="btn btn-primary btn-wave m-1 waves-effect waves-light">Thêm Sản
                            Phẩm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
