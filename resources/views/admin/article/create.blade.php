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
    @if(session('message'))
        <div id="notification" class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">New Blog</div>
                </div>
                <form id="blog-form" method="POST" enctype="multipart/form-data">
                    @csrf()
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-xl-12">
                            <label for="blog-title" class="form-label">Tiêu đề</label>
                            <input type="text" name="title" class="form-control" id="blog-title" placeholder="Blog Title">
                        </div>
                        <div class="col-xl-12">
                            <label for="blog-url" class="form-label">URL</label>
                            <input type="text" name="url" class="form-control" id="blog-url" placeholder="Blog Title">
                        </div>
                        <div class="col-xl-12">
                            <label for="blog-category" class="form-label">Chọn danh mục</label>
                            <select class="form-control" name="category_id" data-trigger name="blog-category" id="blog-category">
                            <option value="">Select Category</option>
                                @foreach($category as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <label for="seo-title" class="form-label">Seo Title</label>
                            <input type="text" name="seo_title" class="form-control" id="seo_title" placeholder="Enter Name">
                        </div>
                        <div class="col-xl-6">
                            <label for="seo-description" class="form-label">Seo Description</label>
                            <input type="text" name="seo_description" class="form-control" id="seo_description" placeholder="Enter Name">
                        </div>
                        <div class="col-xl-6">
                            <label for="seo-keyword" class="form-label">Seo Keyword</label>
                            <input type="text" name="seo_key" class="form-control" id="seo_keyword" placeholder="Enter Name">
                        </div>
                        <div class="col-xl-6">
                            <label for="product-status-add" class="form-label">Trạng thái form</label>
                            <select class="form-control" data-trigger name="form_status" id="form-status">
                                <option value="">Select</option>
                                <option value="on">Bật</option>
                                <option value="off">Tắt</option>
                            </select>
                        </div>
                        <div class="col-xl-6"hidden>
                            <label for="blog-tags" class="form-label">Blog Tags</label>
                            <select class="form-control" name="blog-tags" id="blog-tags" multiple>
                                <option value="Top Blog" selected>Top Blog</option>
                                <option value="Blogger">Blogger</option>
                                <option value="Adventure">Adventure</option>
                                <option value="Landscape" selected>Landscape</option>
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <label for="blog-thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail" placeholder="Thumbnail" required >
                        </div>
                        <div class="col-xl-6">
                            <label for="publish-date" class="form-label">Ngày xuất bản</label>
                            <input type="text" name="publish_date" class="form-control" id="publish-date" placeholder="Choose date">
                        </div>
                        <div class="col-xl-6">
                            <label for="product-status-add" class="form-label">Trạng thái</label>
                            <select class="form-control" data-trigger name="status" id="product-status-add">
                                <option value="">Select</option>
                                <option value="on">Bật</option>
                                <option value="off">Tắt</option>
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">Blog Content</label>
                            <div id="blog-content"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-list text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Post Blog</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/blog-create.js')}}"></script>
@endsection