@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">FAQS</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQS</li>
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
    <div class="main-content">
        <div class="container-fluid">
            <!-- Start::row-1 -->
            <div class="row justify-content-center mb-5">
                <div class="col-xl-12">
                    <div class="row justify-content-center">
                        <div class="col-xl-6">
                            <div class="text-center p-3 faq-header mb-4">
                                <h5 class="mb-1 text-primary op-5 fw-semibold">F.A.Q's</h5>
                                <h4 class="mb-1 fw-semibold">Frequently Asked Questions</h4>
                                <p class="fs-15 text-muted op-7">We have shared some of the most frequently asked questions to help you out! </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <!--code -->
                    <form class="form-create" action="{{ route('admin.faq.store') }}" method="POST" enctype="multipart/form-data">
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
                                                                    <label for="faq-title" class="form-label">Tiêu đề</label>
                                                                    <input type="text" name="title" class="form-control" id="faq-title" placeholder="FAQ title">
                                                                    @error('title')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <label for="faq-title" class="form-label">Câu hỏi</label>
                                                                    <textarea name="answer" class="form-control" id="ask" placeholder="Hướng dẫn điều khiển ghế massage B6"></textarea>
                                                                    @error('ask')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <label for="faq-title" class="form-label">Câu trả lời</label>
                                                                    <textarea name="question" class="form-control" id="question" placeholder="Nhấn nút khởi động trên bảng điều khiển để ..."></textarea>
                                                                    @error('question')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <label for="faq-url" class="form-label">URL</label>
                                                                    <input type="text" name="url" class="form-control" id="faq-url" placeholder="FAQ Title">
                                                                    @error('url')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <label for="faq-category" class="form-label">Chọn danh mục</label>
                                                                    <select class="form-control" name="category_id" data-trigger name="faq-category" id="faq-category">
                                                                        <option value="">Select Category</option>
                                                                        @foreach ($category as $cate)
                                                                            <option value="{{ $cate->id }}">{{ $cate->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('category_id')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <label for="seo-title" class="form-label">Seo Title</label>
                                                                    <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Enter Name">
                                                                    @error('seo_title')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <label for "seo-description" class="form-label">Seo Description</label>
                                                                    <input type="text" name="meta_description" class="form-control" id="meta_description" placeholder="Enter Name">
                                                                    @error('seo_description')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <label for="seo-keyword" class="form-label">Seo Keyword</label>
                                                                    <input type="text" name="meta_keywords" class="form-control" id="meta_keyword" placeholder="Enter Name">
                                                                    @error('seo_key')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <label for="product-status-add" class="form-label">Trạng thái</label>
                                                                    <select class="form-control" data-trigger name="status" id="form-status">
                                                                        <option value="">Select</option>
                                                                        <option value="on">Bật</option>
                                                                        <option value="off">Tắt</option>
                                                                    </select>
                                                                    @error('status')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <meta name="csrf-token" content="AcZvC4Ep2iOctTacuhptFZLPpd3Bjl7gxsSNnTPH">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="pagination justify-content-end">
                            <button type="submit" class="btn btn-primary-light m-1">Tạo FAQ<i
                                    class="bi bi-plus-lg ms-2"></i></button>
                        </ul>
                    </form>
                </div>
            </div>
            <!--End::row-1 -->

        </div>
    </div>
    <!--End::row-1 -->
@endsection
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/faq.js')}}"></script>
