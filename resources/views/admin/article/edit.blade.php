@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <link rel="stylesheet" href="{{ asset('assets/libs/prismjs/themes/prism-coy.min.css') }}">

    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Chỉnh Sửa Bài Viết</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chỉnh Sửa Bài Viết</li>
                </ol>
            </nav>
        </div>
    </div>

    <div id="errors">

    </div>

    <!-- Page Header Close -->
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <form class="form-update" data-route="{{ route('admin.post.update',['id'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body p-0">
                                <div class="d-flex p-3 align-items-center justify-content-between">
                                    <div>
                                        <h6 class="fw-semibold mb-0">Nội Dung Bài Viết</h6>
                                    </div>
                                    <div>
                                        <ul class="nav nav-tabs nav-tabs-header mb-0 d-sm-flex d-block" role="tablist">
                                            <li class="nav-item m-1">
                                                <a class="nav-link active" data-bs-toggle="tab" role="tab"
                                                    aria-current="page" href="#all-tasks" aria-selected="true">Thông Tin Bài
                                                    Viết</a>
                                            </li>
                                            <li class="nav-item m-1">
                                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                                    href="#pending" aria-selected="true">Nội Dung Bài Viết</a>
                                            </li>
                                            <li class="nav-item m-1">
                                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="image"
                                                    href="#image" aria-selected="true">Sản Phẩm Liên Quan Bài Viết</a>
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
                                                            <label for="blog-title" class="form-label">Tiêu đề</label>
                                                            <input type="text" name="title" value="{{ $post->title }}" class="form-control"
                                                                id="blog-title" placeholder="Blog Title">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="blog-url" class="form-label">URL</label>
                                                            <input type="text" value="{{ $post->url }}" name="url" class="form-control"
                                                                id="blog-url" placeholder="Blog Title">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="blog-category" class="form-label">Chọn danh
                                                                mục</label>
                                                            <select class="form-control" name="category_id" data-trigger
                                                                name="blog-category" id="blog-category">
                                                                <option value="">Select Category</option>
                                                                @foreach ($category as $cate)
                                                                    <option {{ $post->category_id==$cate->id?'selected':'' }} value="{{ $cate->id }}">{{ $cate->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="seo-title" class="form-label">Seo Title</label>
                                                            <input type="text" value="{{ $post->seo_title }}" name="seo_title" class="form-control"
                                                                id="seo_title" placeholder="Enter Name">
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="seo-description" class="form-label">Seo
                                                                Description</label>
                                                            <input type="text" value="{{ $post->seo_description }}" name="seo_description"
                                                                class="form-control" id="seo_description"
                                                                placeholder="Enter Name">
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <label for="seo-keyword"  class="form-label">Seo
                                                                Keyword</label>
                                                            <input type="text" value="{{ $post->seo_keywords }}" name="seo_keywords" class="form-control"
                                                                id="seo_keyword" placeholder="Enter Name">
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <label for="publish-date" class="form-label">Ngày xuất
                                                                bản</label>
                                                            <input type="text" value="{{ $post->publish_date }}" name="publish_date"
                                                                class="form-control" id="publish-date" value=""
                                                                placeholder="Choose date">
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <label for="product-status-add" class="form-label">Trạng thái
                                                                form</label>
                                                            <select class="form-control" data-trigger name="on_form"
                                                                id="form-status">
                                                                <option value="">Select</option>
                                                                <option {{ $post->on_form=='on'?'selected':'' }} value="on">Bật</option>
                                                                <option  {{ $post->on_form=='off'?'selected':'' }} value="off">Tắt</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <label for="product-status-add" class="form-label">Trạng thái
                                                            </label>
                                                            <select class="form-control" data-trigger name="status"
                                                                id="form-status">
                                                                <option value="">Select</option>
                                                                <option  {{ $post->status=='on'?'selected':'' }} value="on">Bật</option>
                                                                <option  {{ $post->status=='off'?'selected':'' }} value="off">Tắt</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-8">
                                                            <label for="blog-thumbnail"
                                                                class="form-label">Thumbnail</label>
                                                            <input type="file" class="form-control thumbnail" name="thumbnail"
                                                                id="thumbnail" placeholder="Thumbnail">
                                                        </div>
                                                        <div class="col-xl-2">
                                                            <label for="" class="form-label">Ảnh
                                                                Thumbnail</label><br>
                                                            <img id="thumbnailImg" src="{{ url("storage/uploads/blog_images/$post->title/thumbnail/$post->thumbnail") }}" alt=" Chưa Có Ảnh..."
                                                                class="img-fluid img-thumbnail rounded">
                                                        </div>
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
                                                        <label for="product-description-add" class="form-label">Nội dung bài Viết</label>
                                                        <div id="blog-content">{!! $post->content !!}</div>
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
                                                        <div class="col-xl-12 my-3">



                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="card custom-card">
                                                                        <div
                                                                            class="card-header d-flex align-items-center justify-content-between">
                                                                            <h6 class="card-title">Danh Sách Sản Phẩm</h6>
                                                                        </div>
                                                                        <div class="card-body">

                                                                            <p class="fw-semibold mb-2">Có Thể Chọn Nhiều
                                                                                Sản Phẩm</p>
                                                                            <select data-trigger class="form-control"
                                                                                name="products[]"
                                                                                id="choices-multiple-groups" multiple>

                                                                                <option value="">Chọn Sản Phẩm
                                                                                </option>
                                                                                @if (!$category->isEmpty())
                                                                                    @foreach ($category as $cat)
                                                                                        @if (!$cat->products->isEmpty())
                                                                                            <optgroup
                                                                                                label="{{ $cat->name }}">
                                                                                                @foreach ($cat->products as $product)
                                                                                                    <option {{ in_array($product->name,$post->products()->pluck('name')->toArray())?'selected':'' }}
                                                                                                        value="{{ $product->name }}">
                                                                                                        {{ $product->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </optgroup>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
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
                </div>
                <ul class="pagination justify-content-end">
                    <button id="submit" type="submit" class="btn btn-primary-light m-1">Cập Nhật<i
                            class="bi bi-plus-lg ms-2"></i></button>
                </ul>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
    <script src=" {{ asset('assets/js/prism-custom.js') }} "></script>
    <script src="{{ asset('assets/js/choices.js') }} "></script>
    <script src="{{ asset('assets/js/blog-create.js') }}"></script>
@endsection
