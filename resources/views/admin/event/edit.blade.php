@extends('layouts.appAdmin')
<!-- Prism CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/prismjs/themes/prism-coy.min.css') }}">

<link rel="stylesheet" href="{{ asset('/assets/libs/filepond/filepond.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css') }}">
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Events</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Events</li>
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

    <!-- Page Header Close -->
    <!-- Start::row-1 -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- Start::row-1 -->
            <div class="row justify-content-center mb-5">
                <div class="col-xl-12">
                    <!--code -->
                    <form class="form-update" data-route="{{ route('admin.event.update',['id'=>$event->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="tab-content task-tabs-container">
                                <div class="tab-pane show active p-0" id="all-tasks" role="tabpanel">
                                    <div class="row">
                                        <div class="p-4">
                                            <div class="row gx-5">
                                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                                    <div class="card custom-card shadow-none mb-0 border-0">
                                                        <div class="card-body p-0">
                                                            <div class="row gy-3 p-3">
                                                                <div class="col-xl-12">
                                                                    <label for="event-title" class="form-label">Tiêu
                                                                        đề</label>
                                                                    <input type="text" id="blog-title" value="{{ $event->name }}" name="name"
                                                                        class="form-control" id="event-title"
                                                                        placeholder="Tên sự kiện" required>
                                                                    @error('title')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                {{-- <div class="col-xl-12">
                                                                    <div class="card custom-card">
                                                                        <div class="card-header">
                                                                            <div class="card-title">
                                                                                Multiple Upload
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <input type="file" class="multiple-filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="6">
                                                                        </div>
                                                                    </div>
                                                                </div> --}}
                                                                <div class="col-xl-12">
                                                                    <label for="event-url" class="form-label">URL</label>
                                                                    <input type="text" id="blog-url" value="{{ $event->url }}" name="url"
                                                                        class="form-control" id="event-url"
                                                                        placeholder="Liên kết" required>
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <label for="blog-thumbnail"
                                                                        class="form-label">Banner</label>
                                                                    <input type="file" class="form-control thumbnail"
                                                                        name="imageThumb" id="thumbnail"
                                                                        placeholder="Thumbnail">
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <label for=""
                                                                        class="form-label">Ảnh Banner: </label><br>
                                                                    <img style="" id="thumbnailImg"
                                                                        src="{{ url("storage/uploads/event/$event->name/banners/$event->banners") }}" alt=""
                                                                        class="img-fluid img-thumbnail rounded">
                                                                </div>
                                                                {{-- <div class="col-xl-12">
                                                                    <label for="blog-thumbnail" class="form-label">Ảnh Chi
                                                                        Tiết</label>
                                                                    <input type="file" class="form-control" multiple
                                                                        name="images_detail[]" id="images_detail"
                                                                        accept=".jpg, .jpeg, .png, .webp"
                                                                        placeholder="Hình ảnh chi tiết" required>
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
                                                                                <div class="swiper-wrapper" id="image-list"
                                                                                    data-slide="color-1">

                                                                                </div>
                                                                                <div class="swiper-pagination"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> --}}
                                                                <div class="col-xl-12">
                                                                    <p class="fw-semibold mb-2">Sản Phẩm</p>
                                                                    <select data-trigger class="form-control"
                                                                    name="products[]"
                                                                    id="choices-multiple-groups" multiple required>
                                                                        <option value="">Chọn sản phẩm</option>
                                                                        @foreach ($category as $cate)
                                                                            @if ($cate->products->count()>0)
                                                                                <optgroup label="{{ $cate->name }}">
                                                                                    @foreach ($cate->products as $product)
                                                                                        <option {{ in_array($product->id,unserialize($event->product_id))?'selected':'' }} value="{{ $product->name }}">{{ $product->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </optgroup>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label for="seo-title" class="form-label">Seo
                                                                        Title</label>
                                                                    <input type="text" value="{{ $event->seo_title }}" name="seo_title"
                                                                        class="form-control" id="meta_title"
                                                                        placeholder="Enter Name" required>
                                                                    @error('seo_title')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label for= "seo-description" class="form-label">Seo
                                                                        Description</label>
                                                                    <input type="text" value="{{ $event->seo_description }}" name="seo_description"
                                                                        class="form-control" id="seo_description"
                                                                        placeholder="Enter Name" required>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label for="seo-keyword" class="form-label">Seo
                                                                        Keyword</label>
                                                                    <input type="text" value="{{ $event->seo_keywords }}" name="seo_keywords"
                                                                        class="form-control" id="meta_keyword"
                                                                        placeholder="Enter Name" required>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label for="product-status-add"
                                                                        class="form-label">Trạng thái</label>
                                                                    <select class="form-control" data-trigger
                                                                        name="status" id="form-status" required>
                                                                        <option value="">Select</option>
                                                                        <option {{ $event->status=='on'?'selected':'' }} value="on">Bật</option>
                                                                        <option  {{ $event->status=='off'?'selected':'' }} value="off">Tắt</option>
                                                                    </select>
                                                                    @error('status')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="pagination justify-content-end">
                                                        <button type="submit" class="btn btn-primary-light m-1">Cập nhật<i class="bi bi-plus-lg ms-2"></i></button>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <meta name="csrf-token" content="AcZvC4Ep2iOctTacuhptFZLPpd3Bjl7gxsSNnTPH">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--End::row-1 -->
        </div>
    </div>
    <script src="{{ asset('assets/js/showroom-blog.js') }}"></script>
    <!--End::row-1 -->
    {{-- <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/event.js')}}"></script>
<!-- Prism JS -->
<script src="{{asset('assets/libs/prismjs/prism.js')}}"></script>
<script src="{{asset('assets/js/prism-custom.js')}}"></script>

<!-- Filepond JS -->
<script src="{{asset('assets/libs/filepond/filepond.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js')}}"></script> --}}
@endsection
