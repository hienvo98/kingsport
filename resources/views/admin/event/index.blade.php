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
        {{-- <div class="col-xl-3"></div> --}}
        <div class="col-xl-12">
            <div class="input-group mb-3">
                <input type="text" id="search" data-route="{{ url('/admin/event/search') }}"
                    class="form-control bg-light border-0" placeholder="Tìm Tên Sự Kiện"
                    aria-describedby="button-addon2">
                <button class="btn btn-light" type="button" id="button-addon2"><i
                        class="ri-search-line text-muted"></i></button>
            </div>
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
                                                href="#completed" aria-selected="true">Hiện tại</a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                                href="#pending" aria-selected="true">Đã hết</a>
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
                @include('admin.event.list')
            </div>
            <div class="d-flex pagination justify-content-end flex-wrap">
                <nav aria-label="..." id="nav">
                    <ul class="pagination mb-0">
                        {{-- Nút "Previous" --}}
                        @if ($events->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ !empty($trash) ? $events->appends(['trash' => 'on'])->previousPageUrl() : $events->previousPageUrl() }}"
                                    aria-label="Previous">
                                    <span aria-hidden="true">Previous</span>
                                </a>
                            </li>
                        @endif

                        {{-- Danh sách các trang --}}
                        @for ($i = 1; $i <= $events->lastPage(); $i++)
                            <li class="page-item {{ $i === $events->currentPage() ? 'active' : '' }}">
                                <a class="page-link  {{ $i === $events->currentPage() ? 'disable-link' : '' }}"
                                    href="{{ !empty($trash) ? $events->appends(['trash' => 'on'])->url($i) : $events->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Nút "Next" --}}
                        @if ($events->hasMorePages())
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ !empty($trash) ? $events->appends(['trash' => 'on'])->nextPageUrl() : $events->nextPageUrl() }}"
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
