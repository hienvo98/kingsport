@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Banner</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Banner</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Danh Sách Banner
                    </div>
                    <div class="header-element header-search" style="width:40%">
                        <input type="search" id="search" data-route="{{ url('admin/banner/search') }}" data-type-name="Category" style="background-color: #F0F1F7" name="category"
                            class="form-control border-0 px-2 " placeholder="Tìm Kiếm" aria-label="Username">
                        <!-- End::header-link -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">Tên Banner</th>
                                    <th scope="col">Ảnh Banner</th>
                                    <th scope="col" style="text-align: center;">Trạng Thái</th>
                                    {{-- <th scope="col">Hình Ảnh</th> --}}
                                    <th scope="col" style="text-align: center;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="type">
                                @if ($banners->count() > 0)
                                    @foreach ($banners as $banner)
                                        <tr class="product-list current">
                                            <td style="text-align: center;">
                                                <span>{{ $banner->name }}</span>
                                            </td>
                                            <td class="w-25">
                                                <img src="{{ url("storage/uploads/banner/$banner->name/$banner->image") }}" class="img-fluid img-thumbnail rounded" alt="">
                                            </td>
                                            <td style="text-align: center;">
                                                <span id="statusCategory-{{ $banner->id }}"
                                                    class="badge {{ $banner->status == 'on' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $banner->status == 'on' ? 'Đang Mở' : 'Đã Tắt' }}
                                                </span>
                                            </td>
                                            <td style="text-align: center;">
                                                <div class="hstack gap-2 fs-15 d-flex justify-content-center">
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-icon btn-sm btn-info-light btn-edit"
                                                        data-name="{{ $banner->name }}" data-url="{{ $banner->url }}" data-seo-title="{{ $banner->seo_title }}" data-seo-keywords="{{ $banner->seo_keywords }}" data-seo-description="{{ $banner->seo_description }}" data-status="{{ $banner->status }}" data-image="{{ url("storage/uploads/banner/$banner->name/$banner->image") }}" data-route="{{ route('admin.banner.update',['id'=>$banner->id]) }}"><i class="ri-edit-line"></i></a>
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-icon btn-sm btn-danger-light product-btn btn-delete {{ $banner->status == 'off' ? 'disable-link' : '' }}"
                                                        data-route="{{ route('admin.banner.destroy',['id'=>$banner->id]) }}"><i
                                                            class="ri-delete-bin-line" data-toggle="modal"
                                                            data-target="#exampleModalCenter"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <nav aria-label="...">
                            <ul class="pagination mb-0">
                                {{-- Nút "Previous" --}}
                                @if ($banners->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $banners->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true">Previous</span>
                                        </a>
                                    </li>
                                @endif

                                {{-- Danh sách các trang --}}
                                @for ($i = 1; $i <= $banners->lastPage(); $i++)
                                    <li class="page-item {{ $i === $banners->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $banners->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Nút "Next" --}}
                                @if ($banners->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $banners->nextPageUrl() }}" aria-label="Next">
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
                        <button type="button" data-route="{{ route('admin.banner.store') }}"  class="btn btn-primary btn-wave m-1 waves-effect waves-light"
                            id="openCreateModal">Thêm Danh Mục</button>
                        <!-- Modal add -->
                        @include('admin/banner/create')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.components.delete')
    <script src="{{ asset('/assets/js/tag.js') }}"></script>
@endsection
