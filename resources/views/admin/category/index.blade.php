@include('admin.partials.mainhead')

<link rel="stylesheet" href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/libs/swiper/swiper-bundle.min.css')}}">
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/alerts.js') }}"></script>
</head>

<body>

@include('admin.partials.switcher')
@include('admin.partials.loader')
<div class="page">
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    @include('admin.components.alert')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Danh mục</h1>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header Close -->
            <!-- Start::row-1 -->
            <div class="row">   
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">
                                    Danh sách
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mb-4">
                                    <table class="table text-nowrap table-bordered">
                                        <thead>
                                            <tr>
                                                
                                                <th scope="col">Danh Mục</th>
                                                <th scope="col">Danh Mục Thuộc Tính</th>
                                                <th scope="col">Thứ tự</th>
                                                <th scope="col">Trạng Thái</th>
                                                <th scope="col">Hình Ảnh</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($category as $cate)
                                            <tr class="product-list">
                                                
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="fw-semibold">
                                                            {{$cate->name}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                @if (isset($cate->subCategory) && count($cate->subCategory) > 0)
                                                    <ul class="list-unstyled">
                                                        @foreach ($cate->subCategory as $child)
                                                            <li>--{{ $child->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <ul class="list-unstyled">
                                                        <li>--Trống</li>
                                                    </ul>
                                                @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-default">{{$cate->ordinal_number}}</span>
                                                </td>
                                                <td style="text-align: center;">
                                                <span class="badge {{ $cate->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $cate->status == 1 ? 'Đang Mở' : 'Đã Tắt' }}
                                                </span>
                                                </td>
                                                <td>
                                                    để sau
                                                </td>
                                                <td>
                                                    <div class="hstack gap-2 fs-15">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-edit-category" data-category-id="{{ $cate->id }}"><i class="ri-edit-line"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger-light product-btn"><i class="ri-delete-bin-line"></i></a>
                                                        <button id="subcategory" class="btn btn-icon btn-secondary-light ms-2 subcategory" data-category-id="{{ $cate->id }}" data-category-name="{{ $cate->name }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Thêm danh mục con"><i class="ri-add-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <nav aria-label="...">
                                    <ul class="pagination mb-0">
                                        {{-- Nút "Previous" --}}
                                        @if ($category->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">Previous</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $category->previousPageUrl() }}" aria-label="Previous">
                                                    <span aria-hidden="true">Previous</span>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Danh sách các trang --}}
                                        @for ($i = 1; $i <= $category->lastPage(); $i++)
                                            <li class="page-item {{ $i === $category->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $category->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        {{-- Nút "Next" --}}
                                        @if ($category->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $category->nextPageUrl() }}" aria-label="Next">
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
                                    <button type="button" class="btn btn-primary btn-wave m-1 waves-effect waves-light" id="openCreateModal">Thêm Danh Mục</button>
                                    <!-- Modal add -->
                                    @include('admin/category/create')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- Modal edit -->
@include('admin/category/edit')
<!-- Modal edit -->
<!-- Modal subCategory -->
@include('admin/category/sub-category')

@include('admin.partials.headersearch_modal')
@include('admin.partials.footer')
@include('admin.partials.commonjs')
@include('admin.partials.custom_switcherjs')

<!-- Custom JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('/assets/js/category.js')}}"></script>
</body>