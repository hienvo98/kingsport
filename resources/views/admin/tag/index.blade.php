@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Tags Bài Viết</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tags Bài Viết</li>
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
                        Danh sách Tags
                    </div>
                    <div class="header-element header-search" style="width:40%">
                        <input type="search" id="search" data-route="{{ url('admin/tag/search') }}" data-type-name="Category" style="background-color: #F0F1F7" name="category"
                            class="form-control border-0 px-2 " placeholder="Tìm Kiếm" aria-label="Username">
                        <!-- End::header-link -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">Tag Bài Viết</th>
                                    {{-- <th scope="col">Danh Mục Thuộc Tính</th> --}}
                                    {{-- <th scope="col">Thứ tự</th> --}}
                                    <th scope="col" style="text-align: center;">Trạng Thái</th>
                                    {{-- <th scope="col">Hình Ảnh</th> --}}
                                    <th scope="col" style="text-align: center;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="type">
                                @if ($tags->count() > 0)
                                    @foreach ($tags as $tag)
                                        <tr class="product-list current">
                                            <td style="text-align: center;">
                                                <span>{{ $tag->name }}</span>
                                            </td>
                                            <td style="text-align: center;">
                                                <span id="statusCategory-{{ $tag->id }}"
                                                    class="badge {{ $tag->status == 'on' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $tag->status == 'on' ? 'Đang Mở' : 'Đã Tắt' }}
                                                </span>
                                            </td>
                                            <td style="text-align: center;">
                                                <div class="hstack gap-2 fs-15 d-flex justify-content-center">
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-icon btn-sm btn-info-light btn-edit"
                                                        data-name="{{ $tag->name }}" data-status="{{ $tag->status }}" data-route="{{ route('admin.tag.update',['id'=>$tag->id]) }}"><i class="ri-edit-line"></i></a>
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-icon btn-sm btn-danger-light product-btn btn-delete {{ $tag->status == 'off' ? 'disable-link' : '' }}"
                                                        data-route="{{ route('admin.tag.destroy',['id'=>$tag->id]) }}"><i
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
                                @if ($tags->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $tags->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true">Previous</span>
                                        </a>
                                    </li>
                                @endif

                                {{-- Danh sách các trang --}}
                                @for ($i = 1; $i <= $tags->lastPage(); $i++)
                                    <li class="page-item {{ $i === $tags->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $tags->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Nút "Next" --}}
                                @if ($tags->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $tags->nextPageUrl() }}" aria-label="Next">
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
                        <button type="button" data-route="{{ route('admin.tag.store') }}"  class="btn btn-primary btn-wave m-1 waves-effect waves-light"
                            id="openCreateModal">Thêm Danh Mục</button>
                        <!-- Modal add -->
                        @include('admin/tag/create')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.components.delete')
    <script src="{{ asset('/assets/js/tag.js') }}"></script>
@endsection
