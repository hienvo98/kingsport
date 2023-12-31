@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Bài viết</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
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
                    <div class="p-3 border-bottom border-block-end-dashed">
                        <div class="input-group">
                            <input type="text" id="search" data-route="{{ url('/admin/post/search') }}"
                                class="form-control bg-light border-0" placeholder="Tìm Tên Bài Viết"
                                aria-describedby="button-addon2">
                            <button class="btn btn-light" type="button" id="button-addon2"><i
                                    class="ri-search-line text-muted"></i></button>
                        </div>
                    </div>
                    <div class="p-3 task-navigation border-bottom border-block-end-dashed">
                        <ul class="list-unstyled task-main-nav mb-0">
                            <li class="px-0 pt-2">
                                <span class="fs-11 text-muted op-7 fw-semibold">Danh mục</span>
                            </li>
                            <li class="{{ empty($id) && $trash != 'on' ? 'active' : '' }}">
                                <a class="filter" data-update-url="{{ url('admin/post/index') }}"
                                    data-route-filter="{{ url('admin/post/filterArticlesAjax') }}"
                                    href="javascript:void(0)">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 lh-1">
                                            <i class="ri-task-line align-middle fs-14"></i>
                                        </span>
                                        <span class="flex-fill text-nowrap">
                                            Tất cả bài viết
                                        </span>
                                        <span
                                            class="badge bg-success-transparent rounded-pill">{{ $count['allArticles'] }}</span>
                                    </div>
                                </a>
                            </li>
                            <li class="{{ $trash == 'on' ? 'active' : '' }}">
                                <a href="javascript:void(0)" class="filter"
                                    data-update-url="{{ url('admin/post/index') . '?trash=on' }}"
                                    data-route-filter="{{ url('admin/post/filterArticlesAjax/trash') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 lh-1">
                                            <i class="ri-delete-bin-5-line align-middle fs-14"></i>
                                        </span>
                                        <span class="flex-fill text-nowrap">
                                            Trash
                                        </span>
                                        <span
                                            class="badge bg-success-transparent rounded-pill">{{ $count['deleteArticles'] }}</span>
                                    </div>
                                </a>
                            </li>
                            @foreach ($category as $_category)
                                <li class="{{ $_category->id == $id ? 'active' : '' }}">
                                    <a href="javascript:void(0)"
                                        data-update-url="{{ url('admin/post/index', ['id' => $_category->id]) }}"
                                        class="category-item filter"
                                        data-route-filter="{{ url("admin/post/filterArticlesAjax/$_category->id") }}">
                                        <div class="d-flex align-items-center">
                                            <span class="me-2 lh-1">
                                                <i
                                                    class="ri-price-tag-line align-middle fs-14 fw-semibold text-primary"></i>
                                            </span>

                                            <span class="flex-fill text-nowrap">
                                                {{ $_category->name }}
                                            </span>

                                            <span
                                                class="badge bg-success-transparent rounded-pill"><?php echo $_category->articles->count(); ?></span>
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
                        <div class="card-body p-0">
                            <div class="d-flex p-3 align-items-center justify-content-between">
                                <div>
                                    <h6 class="fw-semibold mb-0">Bài viết</h6>
                                </div>
                                <div>
                                    <ul class="nav nav-tabs nav-tabs-header mb-0 d-sm-flex d-block" role="tablist">
                                        <li class="nav-item m-1">
                                            <a class="nav-link active" data-bs-toggle="tab" role="tab"
                                                aria-current="page" href="#all-tasks" aria-selected="true">Tất Cả</a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                                href="#pending" aria-selected="true">Chưa xuất bản</a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                                href="#completed" aria-selected="true">Đã xuất bản</a>
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
                @include('admin.article.list-buy-category')
            </div>
            <div class="d-flex pagination justify-content-end flex-wrap">
                <nav aria-label="..." id="nav">
                    <ul class="pagination mb-0">
                        {{-- Nút "Previous" --}}
                        @if ($articles->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ !empty($trash) ? $articles->appends(['trash' => 'on'])->previousPageUrl() : $articles->previousPageUrl() }}"
                                    aria-label="Previous">
                                    <span aria-hidden="true">Previous</span>
                                </a>
                            </li>
                        @endif

                        {{-- Danh sách các trang --}}
                        @for ($i = 1; $i <= $articles->lastPage(); $i++)
                            <li class="page-item {{ $i === $articles->currentPage() ? 'active' : '' }}">
                                <a class="page-link  {{ $i === $articles->currentPage() ? 'disable-link' : '' }}"
                                    href="{{ !empty($trash) ? $articles->appends(['trash' => 'on'])->url($i) : $articles->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Nút "Next" --}}
                        @if ($articles->hasMorePages())
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ !empty($trash) ? $articles->appends(['trash' => 'on'])->nextPageUrl() : $articles->nextPageUrl() }}"
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
                <!-- Modal add -->
                {{-- @include('admin/category/create') --}}
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/showroom-blog.js') }}"></script>
    <!--End::row-1 -->
@endsection
