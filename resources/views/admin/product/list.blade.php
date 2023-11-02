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
                                    {{-- <th scope="col">
                                        <input class="form-check-input check-all" type="checkbox" id="all-products"
                                            value="" aria-label="...">
                                    </th> --}}
                                    <th scope="col">Tên</th>
                                    <th scope="col">Danh Mục</th>
                                    <th scope="col">Danh Mục Thuộc Tính</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số Lượng</th>
                                    {{-- <th scope="col">Mô Tả</th> --}}
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($products))
                                    @foreach ($products as $item)
                                        <tr class="product-list">
                                            {{-- <td class="product-checkbox"><input class="form-check-input" type="checkbox"
                                                    id="product1" value="" aria-label="..."></td> --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        <span class="avatar avatar-md avatar-rounded">
                                                            <img src="{{ url("storage/uploads/products/{$item->name}/avatar/{$item->avatar}") }}"
                                                                alt="">
                                                        </span>
                                                    </div>
                                                    <div class="fw-semibold">
                                                        {{ $item->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <span class="badge bg-light text-default">{{ $item->category->name }}</span>
                                            </td>
                                            <td style="text-align: center" >
                                                @if (!$item->category->subCategory->isEmpty())
                                                    @foreach ($item->category->subCategory as $subCat)
                                                        <span
                                                            class="badge bg-light text-default">{{ $subCat->name }}</span><br>
                                                    @endforeach
                                                @else
                                                    <span class="badge bg-light text-default">Không Có</span>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="text-danger text-decoration-line-through">
                                                    {{ $item->sale_price > 0 ? number_format($item->regular_price, 0, '', '.') . ' đ' : '' }}
                                                </p>
                                                <p class="text-primary">{{ $item->sale_price > 0 ? number_format($item->sale_price, 0, '', '.') . ' đ' : number_format($item->regular_price, 0, '', '.') . ' đ' }}
                                                </p>
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            {{-- <td>dấdasdsd</td> --}}
                                            <td>
                                                @if ($item->status == 'on')
                                                    <span class="badge bg-success-transparent">Bật</span>
                                                @else
                                                    <span class="badge bg-danger-transparent">Tắt</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="hstack gap-2 fs-15">
                                                    <a href="{{ route('admin.product.edit',['id'=>$item->id]) }}"
                                                        class="btn btn-icon btn-sm btn-info-light"><i
                                                            class="ri-edit-line"></i></a>
                                                    <a href=""
                                                        class="btn btn-icon btn-sm btn-danger-light product-btn btnDeleteProduct {{ $item->status=='off'?'disable-link':'' }}" data-id="{{ $item->id }}"><i
                                                            class="ri-delete-bin-line"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="">
                                        <td colspan="9">Chưa Có Sản Phẩm nào Được Tạo</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <nav aria-label="...">
                            <ul class="pagination mb-0">
                                {{-- Nút "Previous" --}}
                                @if ($products->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true">Previous</span>
                                        </a>
                                    </li>
                                @endif

                                {{-- Danh sách các trang --}}
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    <li class="page-item {{ $i === $products->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Nút "Next" --}}
                                @if ($products->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">Next</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Next</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                        <button type="button" class="btn btn-primary btn-wave m-1 waves-effect waves-light"><a href="{{ route('admin.product.create') }}" class="text-light">Thêm sản phẩm</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/add-products.js') }}"></script>
@endsection
