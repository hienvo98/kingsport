@extends('layouts.appAdmin')
<style>
    .ql-image,
    .ql-video {
        pointer-events: none;
    }
</style>
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Showroom</h1>
        <div class="ms-md-1 ms-0">
            <nav>

                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Showroom</li>
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
                    <div class="card-title">New Showroom</div>
                </div>
                <form id="showroom-form" class="form-create" data-route="{{ route('admin.showroom.store') }}" enctype="multipart/form-data">
                    @csrf()
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="blog-title" class="form-label">Tên Showroom</label>
                                <input type="text" name="name" class="form-control" id="blog-title"
                                    placeholder="Kingsport quận 7">
                            </div>
                            <div class="col-xl-12">
                                <label for="blog-url" class="form-label">URL</label>
                                <input type="text" name="url" class="form-control" id="blog-url"
                                    placeholder="king-sport-quan-7">
                            </div>
                            <div class="col-xl-12">
                                <label for="blog-url" class="form-label">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="98A Nguyễn Văn Linh, Phường Tân Phú, Quận 7">
                            </div>
                            <div class="col-xl-6">
                                <label for="blog-category" class="form-label">Chọn Khu Vực</label>
                                <select class="form-control" name="region_id" data-trigger name="region_id" id="region_id">
                                    <option value="">Select Region</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6">
                                <label for="blog-category" class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    placeholder="0969696979" require>
                            </div>
                            <div class="col-xl-8">
                                <label for="blog-thumbnail" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control thumbnail" name="imageThumb" id="thumbnail"
                                    placeholder="Thumbnail" required>
                            </div>
                            <div class="col-xl-2">
                                <label for="" class="form-label">Ảnh
                                    Thumbnail</label><br>
                                <img style="display: none" id="thumbnailImg" src="" alt=""
                                    class="img-fluid img-thumbnail rounded">
                            </div>
                            <div class="col-xl-12">
                                <label for="blog-thumbnail" class="form-label">Images Detail</label>
                                <input type="file" class="form-control" multiple name="images_detail[]"
                                    id="images_detail" accept=".jpg, .jpeg, .png, .webp" placeholder="Hình ảnh chi tiết"
                                    required>
                            </div>
                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">
                                            Danh Sách Ảnh
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="swiper swiper-overflow">
                                            <div class="swiper-wrapper" id="image-list" data-slide="color-1">
                                               
                                            </div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">
                                            Dropzone
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form data-single="true" id="image-upload" enctype="multipart/form-data" method="post" action="https://httpbin.org/post"
                                            class="dropzone">
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-xl-6">
                                <label for="seo-title" class="form-label">Seo Title</label>
                                <input type="text" name="seo_title" class="form-control" id="seo_title"
                                    placeholder="Enter Name">
                            </div>
                            <div class="col-xl-6">
                                <label for="seo-description" class="form-label">Seo Description</label>
                                <input type="text" name="seo_description" class="form-control" id="seo_description"
                                    placeholder="Enter Name">
                            </div>
                            <div class="col-xl-6">
                                <label for="seo-keyword" class="form-label">Seo Keyword</label>
                                <input type="text" name="seo_keywords" class="form-control" id="seo_keyword"
                                    placeholder="Enter Name">
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
                            <div class="col-xl-6">
                                <label for="product-status-add" class="form-label">Trạng thái</label>
                                <select class="form-control" data-trigger name="status" id="showroom-status-add">
                                    <option value="">Select</option>
                                    <option value="on">Bật</option>
                                    <option value="off">Tắt</option>
                                </select>
                            </div>
                            <div class="col-xl-12">
                                <label class="form-label">Showroom Info</label>
                                <div name="description" id="blog-content"
                                    style="
                                    height: 500px !important;
                                ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-list text-end">
                            <button type="submit" class="btn btn-sm btn-primary">Tạo Showroom</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/showroom-blog.js') }}"></script>
@endsection
