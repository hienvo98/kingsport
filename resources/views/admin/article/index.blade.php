
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
    <!-- Page Header Close -->
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                    <a href="javascript:void(0);">
                        <div class="card custom-card bg-dark overlay-card text-fixed-white">
                            <img src="{{ asset('storage/images/ghe-massage.jpg') }}" class="card-img" alt="...">
                            <div class="card-img-overlay d-flex flex-column p-0 over-content-bottom">
                                <div class="card-footer border-top-0">
                                    <h6 class="fw-semibold mb-0 text-fixed-white">Ghế Massage</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                    <a href="javascript:void(0);">
                        <div class="card custom-card bg-dark overlay-card text-fixed-white">
                            <img src="{{ asset('storage/images/xe-dap-tap.jpg') }}" class="card-img" alt="...">
                            <div class="card-img-overlay d-flex flex-column p-0 over-content-bottom">
                                <div class="card-footer border-top-0">
                                    <h6 class="fw-semibold mb-0 text-fixed-white">Xe Đạp Tập</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                    <a href="javascript:void(0);">
                        <div class="card custom-card bg-dark overlay-card text-fixed-white">
                            <img src="{{ asset('storage/images/gian-ta.jpg') }}" class="card-img" alt="...">
                            <div class="card-img-overlay d-flex flex-column p-0 over-content-bottom">
                                <div class="card-footer border-top-0">
                                    <h6 class="fw-semibold mb-0 text-fixed-white">Giàn Tạ</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                    <a href="javascript:void(0);">
                        <div class="card custom-card bg-dark overlay-card text-fixed-white">
                            <img src="{{ asset('storage/images/may-chay-bo.jpg') }}" class="card-img" alt="...">
                            <div class="card-img-overlay d-flex flex-column p-0 over-content-bottom">
                                <div class="card-footer border-top-0">
                                    <h6 class="fw-semibold mb-0 text-fixed-white">Máy chạy bộ</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                    <a href="javascript:void(0);">
                        <div class="card custom-card bg-dark overlay-card text-fixed-white">
                            <img src="{{ asset('storage/images/mini.jpg') }}" class="card-img" alt="...">
                            <div class="card-img-overlay d-flex flex-column p-0 over-content-bottom">
                                <div class="card-footer border-top-0">
                                    <h6 class="fw-semibold mb-0 text-fixed-white">Máy Massage mini</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                    <a href="javascript:void(0);">
                        <div class="card custom-card bg-dark overlay-card text-fixed-white">
                            <img src="{{ asset('storage/images/suc-khoe.jpg') }}" class="card-img" alt="...">
                            <div class="card-img-overlay d-flex flex-column p-0 over-content-bottom">
                                <div class="card-footer border-top-0">
                                    <h6 class="fw-semibold mb-0 text-fixed-white">Mẹo sức khỏe</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
        <h1 class="page-title fw-semibold fs-18 mb-0">Theo dòng sự kiện</h1>
            <div class="row">
                <div class="col-xl-6 col-xxl-8 col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div class="card custom-card">
                                <a href="javascript:void(0);">
                                    <img src="{{ asset('storage/images/event3.webp') }}" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <a href="blog-details.html" class="fw-semibold fs-14 text-dark mb-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">BÁO HIẾU MẸ CHA - TRAO QUÀ SỨC KHỎE | ƯU ĐÃI X3</font></font></a>
                                    <p class="card-text text-muted mb-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Báo hiếu mùa Vu Lan đã trở thành truyền thống quý báu của dân tộc, được lớp lớp thế hệ gia đình Việt kế thừa và phát huy...</font></font></p>
                                    <a href="javascript:void(0);" class="btn btn-primary-light"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đọc thêm</font></font></a>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded me-2">
                                                <img src="{{asset('assets/images/faces/11.jpg')}}" alt="">
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-semibold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Alister Chuk</font></font></p>
                                                <p class="text-muted fs-10 mb-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">18,Tháng 12 2022 - 12:25</font></font></p>
                                            </div>
                                        </div>
                                        <div class="btn-list">
                                            <button aria-label="cái nút" type="button" class="btn btn-icon btn-light btn-sm m-1"><i class="ri-thumb-up-line"></i></button>
                                            <button aria-label="cái nút" type="button" class="btn btn-icon btn-light btn-sm m-1"><i class="ri-chat-2-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div class="card custom-card">
                                <a href="javascript:void(0);">
                                    <img src="{{ asset('storage/images/event2.webp') }}" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <a href="blog-details.html" class="fw-semibold fs-14 text-dark mb-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bãi biển tuyệt đẹp vào một ngày nắng!</font></font></a>
                                    <p class="card-text text-muted mb-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nguyên lý ảnh ba chiều, được lý thuyết là một tính chất của lực hấp dẫn lượng tử, đưa ra giả thuyết rằng sự mô tả.</font></font></p>
                                    <a href="javascript:void(0);" class="btn btn-primary-light"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đọc thêm</font></font></a>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded me-2">
                                                <img src="{{asset('assets/images/faces/3.jpg')}}" alt="">
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-semibold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Samantha Nance</font></font></p>
                                                <p class="text-muted fs-10 mb-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">25,Tháng 12 2022 - 04:25</font></font></p>
                                            </div>
                                        </div>
                                        <div class="btn-list">
                                            <button aria-label="cái nút" type="button" class="btn btn-icon btn-light btn-sm m-1"><i class="ri-thumb-up-line"></i></button>
                                            <button aria-label="cái nút" type="button" class="btn btn-icon btn-light btn-sm m-1"><i class="ri-chat-2-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-4 col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Blog nổi bật
                            </font></font></div>
                            <div>
                                <span class="badge bg-primary-transparent"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">32 Blog</font></font></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <span class="avatar avatar-xl me-3">
                                            <img src="{{ asset('storage/images/event1.webp') }}" class="img-fluid" alt="...">
                                        </span>
                                        <div class="flex-fill">
                                            <a href="javascript:void(0);" class="fs-14 fw-semibold mb-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Samantha Jack</font></font></a>
                                            <p class="mb-1 popular-blog-content text-truncate"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                Có rất nhiều biến thể của đoạn văn Lorem Ipsum có sẵn
                                            </font></font></p>
                                            <span class="text-muted fs-11"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">24,Tháng 11 2022 - 18:27</font></font></span>
                                        </div>
                                        <div>
                                            <button class="btn btn-icon btn-light btn-sm rtl-rotate"><i class="ri-arrow-right-s-line"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <span class="avatar avatar-xl me-3">
                                            <img src="{{asset('assets/images/media/media-56.jpg')}}" class="img-fluid" alt="...">
                                        </span>
                                        <div class="flex-fill">
                                            <a href="javascript:void(0);" class="fs-14 fw-semibold mb-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Kirsten Sam</font></font></a>
                                            <p class="mb-1 popular-blog-content text-truncate"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                Từ Latin, kết hợp với một số câu mẫu
                                            </font></font></p>
                                            <span class="text-muted fs-11"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">28,Tháng 11 2022 - 10:45</font></font></span>
                                        </div>
                                        <div>
                                            <button class="btn btn-icon btn-light btn-sm rtl-rotate"><i class="ri-arrow-right-s-line"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <span class="avatar avatar-xl me-3">
                                            <img src="{{asset('assets/images/media/media-54.jpg')}}" class="img-fluid" alt="...">
                                        </span>
                                        <div class="flex-fill">
                                            <a href="javascript:void(0);" class="fs-14 fw-semibold mb-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Jessica bây giờ</font></font></a>
                                            <p class="mb-1 popular-blog-content text-truncate"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                Trái ngược với niềm tin phổ biến, Lorem Ipsum không chỉ đơn giản là ngẫu nhiên
                                            </font></font></p>
                                            <span class="text-muted fs-11"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">30,Tháng 11 2022 - 08:32</font></font></span>
                                        </div>
                                        <div>
                                            <button class="btn btn-icon btn-light btn-sm rtl-rotate"><i class="ri-arrow-right-s-line"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <span class="avatar avatar-xl me-3">
                                            <img src="{{asset('assets/images/media/media-52.jpg')}}" class="img-fluid" alt="...">
                                        </span>
                                        <div class="flex-fill">
                                            <a href="javascript:void(0);" class="fs-14 fw-semibold mb-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Stuart rộng</font></font></a>
                                            <p class="mb-1 popular-blog-content text-truncate"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                Nó được phổ biến vào những năm 1960 với việc phát hành các tờ Letraset có chứa
                                            </font></font></p>
                                            <span class="text-muted fs-11"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3,Tháng 12 2022 - 12:56</font></font></span>
                                        </div>
                                        <div>
                                            <button class="btn btn-icon btn-light btn-sm rtl-rotate"><i class="ri-arrow-right-s-line"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item text-center">
                                    <button class="btn btn-primary-light"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tải thêm</font></font></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('storage/images/demo.jpg') }}" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <a href="blog-details.html" class="fw-semibold fs-14 text-dark mb-1">Strawberry juice recipe.</a>
                            <p class="card-text text-muted mb-3">Want to have something different but healthy to drink? Then look no further!! Strawberry Juice is rich in vitamin</p>
                            <a href="javascript:void(0);" class="btn btn-primary-light">Read More</a>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-rounded me-2">
                                        <img src="{{ asset('storage/images/demo.jpg') }}" alt="">
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-semibold">Maria Bose</p>
                                        <p class="text-muted fs-10 mb-0">17,Dec 2022 - 12:32</p>
                                    </div>
                                </div>
                                <div class="btn-list">
                                    <button aria-label="button" type="button" class="btn btn-icon btn-light btn-sm"><i class="ri-thumb-up-line"></i></button>
                                    <button aria-label="button" type="button" class="btn btn-icon btn-light btn-sm"><i class="ri-chat-2-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('storage/images/demo.jpg') }}" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <a href="blog-details.html" class="fw-semibold fs-14 text-dark mb-1">Night Sky is pleasent to watch.</a>
                            <p class="card-text text-muted mb-3">Sky map showing the night sky tonight from any location. What planets are visible tonight? Where is Mars. </p>
                            <a href="javascript:void(0);" class="btn btn-primary-light">Read More</a>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-rounded me-2">
                                        <img src="{{ asset('storage/images/demo.jpg') }}" alt="">
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-semibold">Helsenky</p>
                                        <p class="text-muted fs-10 mb-0">24,Dec 2022 - 14:21</p>
                                    </div>
                                </div>
                                <div class="btn-list">
                                    <button aria-label="button" type="button" class="btn btn-icon btn-light btn-sm"><i class="ri-thumb-up-line"></i></button>
                                    <button aria-label="button" type="button" class="btn btn-icon btn-light btn-sm"><i class="ri-chat-2-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('storage/images/demo.jpg') }}" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <a href="blog-details.html" class="fw-semibold fs-14 text-dark mb-1">Is fashion industry growing ?</a>
                            <p class="card-text text-muted mb-3">The holographic principle, theorized to be a property of quantum gravity, postulates that the description.</p>
                            <a href="javascript:void(0);" class="btn btn-primary-light">Read More</a>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-rounded me-2">
                                        <img src="{{ asset('storage/images/demo.jpg') }}" alt="">
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-semibold">Jason Mama</p>
                                        <p class="text-muted fs-10 mb-0">19,Dec 2022 - 15:48</p>
                                    </div>
                                </div>
                                <div class="btn-list">
                                    <button aria-label="button" type="button" class="btn btn-icon btn-light btn-sm"><i class="ri-thumb-up-line"></i></button>
                                    <button aria-label="button" type="button" class="btn btn-icon btn-light btn-sm"><i class="ri-chat-2-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('storage/images/demo.jpg') }}" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <a href="blog-details.html" class="fw-semibold fs-14 text-dark mb-1">Raising sun is a blessing to watch ..</a>
                            <p class="card-text text-muted mb-3">Rising Sun is a 1993 American buddy cop crime thriller film directed by Philip Kaufman.</p>
                            <a href="javascript:void(0);" class="btn btn-primary-light">Read More</a>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-rounded me-2">
                                        <img src="{{ asset('storage/images/demo.jpg') }}" alt="">
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-semibold">Stuart Hall</p>
                                        <p class="text-muted fs-10 mb-0">13,Dec 2022 - 19:08</p>
                                    </div>
                                </div>
                                <div class="btn-list">
                                    <button aria-label="button" type="button" class="btn btn-icon btn-light btn-sm"><i class="ri-thumb-up-line"></i></button>
                                    <button aria-label="button" type="button" class="btn btn-icon btn-light btn-sm"><i class="ri-chat-2-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

    <!-- Start: pagination -->
    <div class="float-end mb-4">
        <nav aria-label="Page navigation" class="">
            <ul class="pagination mb-0">
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0);">
                        Prev
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">
                        <i class="bi bi-three-dots"></i>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">17</a></li>
                <li class="page-item">
                    <a class="page-link text-primary" href="javascript:void(0);">
                        next
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- End: pagination -->
    @endsection