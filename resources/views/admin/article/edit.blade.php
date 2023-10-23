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
    <div id="errors">

    </div>
    <div class="row">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">New Blog</div>
                </div>
                <form id="blog-form-update" method="POST" data-route="{{ route('admin.post.update',['id'=>$post->id]) }}" enctype="multipart/form-data">
                    @csrf()
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="blog-title" class="form-label">Tiêu đề</label>
                                <input type="text" name="title" value="{{ $post->title }}" class="form-control" id="blog-title"
                                    placeholder="Blog Title">
                            </div>
                            <div class="col-xl-12">
                                <label for="blog-url" class="form-label">URL</label>
                                <input type="text" name="url" value="{{ $post->url }}" class="form-control" id="blog-url"
                                    placeholder="Blog Title">
                            </div>
                            <div class="col-xl-12">
                                <label for="blog-category" class="form-label">Chọn danh mục</label>
                                <select class="form-control" name="category_id" data-trigger name="blog-category"
                                    id="blog-category">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $cate)
                                        <option {{ $post->category_id==$cate->id?'selected':'' }} value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6">
                                <label for="seo-title" class="form-label">Seo Title</label>
                                <input type="text" name="seo_title" value="{{ $post->seo_title }}" class="form-control" id="seo_title"
                                    placeholder="Enter Name">
                            </div>
                            <div class="col-xl-6">
                                <label for="seo-description" class="form-label">Seo Description</label>
                                <input type="text" name="seo_description" value="{{ $post->seo_description }}" class="form-control" id="seo_description"
                                    placeholder="Enter Name">
                            </div>
                            <div class="col-xl-6">
                                <label for="seo-keyword" class="form-label">Seo Keyword</label>
                                <input type="text" name="seo_key" value="{{ $post->seo_keywords }}" class="form-control" id="seo_keyword"
                                    placeholder="Enter Name">
                            </div>
                            <div class="col-xl-6">
                                <label for="product-status-add" class="form-label">Trạng thái form</label>
                                <select class="form-control" data-trigger name="form_status" id="form-status">
                                    <option value="">Select</option>
                                    <option {{ $post->on_form=='on'?'selected':'' }} value="on">Bật</option>
                                    <option  {{ $post->on_form=='off'?'selected':'' }} value="off">Tắt</option>
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
                            <div class="col-xl-8">
                                <label for="blog-thumbnail" class="form-label">File Thumbnail</label>
                                <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                                    placeholder="Thumbnail">
                            </div>
                            <div class="col-xl-2">
                                <label for="" class="form-label">Ảnh Thumbnail</label>
                                <img id="thumbnailImg" src="{{ url("storage/uploads/blog_images/$post->title/thumbnail/$post->thumbnail") }}" alt="..." class="img-fluid img-thumbnail rounded">
                            </div>
                            <div class="col-xl-6">
                                <label for="publish-date" class="form-label">Ngày xuất bản</label>
                                <input type="text" value="{{ $post->publish_date }}" name="publish_date" class="form-control" id="publish-date"
                                    value="" placeholder="Choose date">
                            </div>
                            <div class="col-xl-6">
                                <label for="product-status-add" class="form-label">Trạng thái</label>
                                <select class="form-control" data-trigger name="status" id="product-status-add">
                                    <option value="">Select</option>
                                    <option {{ $post->status=='on'?'selected':'' }} value="on">Bật</option>
                                    <option {{ $post->status=='off'?'selected':'' }} value="off">Tắt</option>
                                </select>
                            </div>
                            <div class="col-xl-12">
                                <label class="form-label">Blog Content</label>
                                <div id="blog-content">{!! $post->content !!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-list text-end">
                            <button type="submit" class="btn btn-sm btn-primary">Cập Nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/blog-create.js') }}"></script>
@endsection
