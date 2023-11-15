@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Sản Phẩm</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
                </ol>
            </nav>
        </div>
    </div>
    @if (session('message'))
        <div id="notification" class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <!-- Page Header Close -->
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-3">
            <div class="card custom-card">
                <div class="card-body p-0">
                    <div class="p-3 task-navigation border-bottom border-block-end-dashed">
                        <ul class="list-unstyled task-main-nav mb-0">
                            <li class="px-0 pt-2">
                                <span class="fs-11 text-muted op-7 fw-semibold">Danh mục</span>
                            </li>
                            <li class="{{ empty($id) && $trash != 'on' ? 'active' : '' }}">
                                <a class="filter" data-update-url="{{ url('admin/product/index') }}"
                                    data-route-filter="{{ url('admin/product/filterProductsAjax') }}"
                                    href="javascript:void(0)">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 lh-1">
                                            <i class="ri-task-line align-middle fs-14"></i>
                                        </span>
                                        <span class="flex-fill text-nowrap">
                                            Tất cả Sản Phẩm
                                        </span>
                                        <span
                                            class="badge bg-success-transparent rounded-pill">{{ $count['products'] }}</span>
                                    </div>
                                </a>
                            </li>
                            <li class="{{ $trash == 'on' ? 'active' : '' }}">
                                <a href="javascript:void(0)" class="filter"
                                    data-update-url="{{ url('admin/product/index') . '?trash=on' }}"
                                    data-route-filter="{{ url('admin/product/filterProductsAjax/trash') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 lh-1">
                                            <i class="ri-delete-bin-5-line align-middle fs-14"></i>
                                        </span>
                                        <span class="flex-fill text-nowrap">
                                            Trash
                                        </span>
                                        <span
                                            class="badge bg-success-transparent rounded-pill">{{ $count['products_off'] }}</span>
                                    </div>
                                </a>
                            </li>
                            @foreach ($category as $_category)
                                <li class="{{ $_category->id == $id ? 'active' : '' }}">
                                    <a href="javascript:void(0)"
                                        data-update-url="{{ url('admin/product/index', ['id' => $_category->id]) }}"
                                        class="category-item filter"
                                        data-route-filter="{{ url("admin/product/filterProductsAjax/$_category->id") }}">
                                        <div class="d-flex align-items-center">
                                            <span class="me-2 lh-1">
                                                <i
                                                    class="ri-price-tag-line align-middle fs-14 fw-semibold text-primary"></i>
                                            </span>

                                            <span class="flex-fill text-nowrap">
                                                {{ $_category->name }}
                                            </span>

                                            <span
                                                class="badge bg-success-transparent rounded-pill"><?php echo $_category->products->count(); ?></span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="table-responsive mb-4">
                                <div class="mb-3 border-bottom border-block-end-dashed">
                                    <div class="input-group">
                                        <input type="text" id="search"
                                            data-route="{{ url('/admin/product/search') }}"
                                            class="form-control bg-light border-0" placeholder="Tìm Tên sản phẩm"
                                            aria-describedby="button-addon2">
                                        <button class="btn btn-light" type="button" id="button-addon2"><i
                                                class="ri-search-line text-muted"></i></button>
                                    </div>
                                </div>
                                <table class="table text-nowrap table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Danh Mục</th>
                                            <th scope="col">Danh Mục Thuộc Tính</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số Lượng</th>
                                            <th scope="col">Trạng Thái</th>
                                            <th scope="col">Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($products))
                                            @foreach ($products as $item)
                                                <tr class="product-list current">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-2">
                                                                <span class="avatar avatar-md avatar-rounded">
                                                                    <img src="{{ url("storage/uploads/product/{$item->name}/avatar/{$item->avatar}") }}"
                                                                        alt="">
                                                                </span>
                                                            </div>
                                                            <div class="fw-semibold">
                                                                {{ $item->name }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <span
                                                            class="badge bg-light text-default">{{ $item->category->name }}</span>
                                                    </td>
                                                    <td style="text-align: center">
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
                                                        <p class="text-primary">
                                                            {{ $item->sale_price > 0 ? number_format($item->sale_price, 0, '', '.') . ' đ' : number_format($item->regular_price, 0, '', '.') . ' đ' }}
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
                                                            <a href="{{ route('admin.product.edit', ['id' => $item->id]) }}"
                                                                class="btn btn-icon btn-sm btn-info-light"><i
                                                                    class="ri-edit-line"></i></a>
                                                            <a href=""
                                                                class="btn btn-icon btn-sm btn-danger-light product-btn btnDeleteProduct {{ $item->status == 'off' ? 'disable-link' : '' }}"
                                                                data-id="{{ $item->id }}"><i
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
                                <nav aria-label="Page navigation" class="pagination-style-3">
                                    <ul class="pagination mb-0 flex-wrap">
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

                                        @php
                                            $currentPage = $products->currentPage();
                                            $startPage = max($currentPage - 3, 1); // Hiển thị tối đa 3 trang trước trang hiện tại
                                            $endPage = min($currentPage + 3, $products->lastPage());
                                            // Hiển thị các trang
                                            for ($i = $startPage; $i <= $endPage; $i++) {
                                                if ($i == $currentPage) {
                                                    echo '<li class="page-item active"><a class="page-link" href="javascript:void(0);">' . $i . '</a></li>';
                                                } else {
                                                    echo '<li class="page-item"><a class="page-link" href="' . $products->url($i) . '">' . $i . '</a></li>';
                                                }
                                            }
                                        @endphp
                                        @if ($products->currentPage() + 3 < $products->lastPage())
                                            <li class="page-item">
                                                <a class="page-link" href="javascript:void(0);">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Nút "Next" --}}
                                        @if ($products->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $products->nextPageUrl() }}"
                                                    aria-label="Next">
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

                                <button type="button" class="btn btn-primary btn-wave m-1 waves-effect waves-light"><a
                                        href="{{ route('admin.product.create') }}" class="text-light">Thêm sản
                                        phẩm</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/add-products.js') }}"></script>
    <!--End::row-1 -->
@endsection
