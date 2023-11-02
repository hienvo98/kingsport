<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ url('/admin') }}" class="header-logo">
            <img src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}" alt="logo" class="desktop-logo">
            <img src="{{ asset('assets/images/brand-logos/toggle-logo.png') }}" alt="logo" class="toggle-logo">
            <img src="{{ asset('assets/images/brand-logos/desktop-dark.png') }}" alt="logo" class="desktop-dark">
            <img src="{{ asset('assets/images/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
            <img src="{{ asset('assets/images/brand-logos/desktop-white.png') }}" alt="logo" class="desktop-white">
            <img src="{{ asset('assets/images/brand-logos/toggle-white.png') }}" alt="logo" class="toggle-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Main</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">Dashboards<span
                                class="badge bg-warning-transparent ms-2">12</span></span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Dashboards</a>
                        </li>
                        <li class="slide">
                            <a href="index.html" class="side-menu__item">CRM</a>
                        </li>
                        <li class="slide">
                            <a href="index-1.html" class="side-menu__item">Ecommerce</a>
                        </li>
                        <li class="slide">
                            <a href="index-2.html" class="side-menu__item">Crypto</a>
                        </li>
                        <li class="slide">
                            <a href="index-3.html" class="side-menu__item">Jobs</a>
                        </li>
                        <li class="slide">
                            <a href="index-4.html" class="side-menu__item">NFT</a>
                        </li>
                        <li class="slide">
                            <a href="index-5.html" class="side-menu__item">Sales</a>
                        </li>
                        <li class="slide">
                            <a href="index-6.html" class="side-menu__item">Analytics</a>
                        </li>
                        <li class="slide">
                            <a href="index-7.html" class="side-menu__item">Projects</a>
                        </li>
                        <li class="slide">
                            <a href="index-8.html" class="side-menu__item">HRM</a>
                        </li>
                        <li class="slide">
                            <a href="index-9.html" class="side-menu__item">Stocks</a>
                        </li>
                        <li class="slide">
                            <a href="index-10.html" class="side-menu__item">Courses</a>
                        </li>
                        <li class="slide">
                            <a href="index-11.html" class="side-menu__item">Personal</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Pages</span></li>
                <!-- End::slide__category -->
                @can('Super Admin')
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <i class="bx bxs-analyse side-menu__icon"></i>
                            <span class="side-menu__label">Quản Lý Hệ Thống</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>

                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Quản Lý Admin</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item"> Phân Quyền ADMIN
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="{{ route('admin.role.show') }}" class="side-menu__item">Danh Sách</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('admin.role.create') }}" class="side-menu__item">Tạo Quyền</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('admin.role.index') }}" class="side-menu__item">Phân Quyền</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item"> Quản Lý ADMIN
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="{{ url('/admin/show') }}" class="side-menu__item">Danh Sách</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ url('/admin/create') }}" class="side-menu__item">Tạo Admin</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcan
                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bxl-product-hunt side-menu__icon"></i>
                        <span class="side-menu__label">Quản Lý Sản Phẩm</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Pages</a>
                        </li>
                        @canany(['admin.category.index', 'admin.category.store', 'admin.category.update',
                            'admin.category.destroy'])
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Danh Mục Sản Phẩm
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="{{ route('admin.category.index') }}" class="side-menu__item">Danh
                                            Sách Sản Phẩm</a>
                                    </li>
                                </ul>
                            </li>
                        @endcanany
                        @canany(['admin.product.index', 'admin.product.create', 'admin.product.store',
                            'admin.product.update', 'admin.product.destroy'])
                            <li class="slide has-sub active">
                                <a href="javascript:void(0);" class="side-menu__item active">Sản Phẩm
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2 active" style="display: block;">
                                    <li class="slide">
                                        <a href="{{ route('admin.product.index') }}" class="side-menu__item">Danh
                                            Sách</a>
                                    </li>
                                    <li class="slide active">
                                        <a href="{{ route('admin.product.create') }}" class="side-menu__item active">Thêm
                                            sản phẩm </a>
                                    </li>
                                </ul>
                            </li>
                        @endcanany
                    </ul>
                </li>
                <!-- card -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class='bx bxs-cart side-menu__icon'></i>
                        <span class="side-menu__label">Quản Lý Đơn Hàng</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide has-sub">
                            <a href="#" class="side-menu__item">Danh Sách</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="#" class="side-menu__item">Tạo showroom</a>
                        </li>
                    </ul>
                </li>
                <!-- endcard -->
                <!-- card -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class='bx bxs-user-pin side-menu__icon'></i>
                        <span class="side-menu__label">Quản Trị Người Dùng</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide has-sub">
                            <a href="#" class="side-menu__item">Danh Sách</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="#" class="side-menu__item">Tạo showroom</a>
                        </li>
                    </ul>
                </li>
                <!-- endcard -->
                @canany(['admin.post.index', 'admin.post.create', 'admin.post.store', 'admin.post.update',
                    'admin.post.destroy'])
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <i class='bx bxl-blogger side-menu__icon'></i>
                            <span class="side-menu__label">Bài Viết</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>

                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Bài Viết</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Thông Tin Bài Viết
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="{{ route('admin.post.index') }}" class="side-menu__item">Danh Sách</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('admin.post.create') }}" class="side-menu__item">Tạo Bài
                                            Viết</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcanany
                <!-- showrooms -->              
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class='bx bxs-store-alt side-menu__icon'></i>
                        <span class="side-menu__label">Showroom</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide has-sub">
                            <a href="{{ route('admin.showroom.index') }}" class="side-menu__item">Danh Sách</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="{{ route('admin.showroom.create') }}" class="side-menu__item">Tạo showroom</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- FAQ -->            
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class='bx bx-question-mark side-menu__icon'></i>
                        <span class="side-menu__label">FAQ</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide has-sub">
                            <a href="{{ route('admin.faq.index') }}" class="side-menu__item">Danh Sách</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="{{ route('admin.faq.create') }}" class="side-menu__item">Tạo FAQ</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Event -->
                <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <i class='bx bxs-calendar-event side-menu__icon'></i>
                            <span class="side-menu__label">Sự Kiện</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>

                        <ul class="slide-menu child1">
                            <li class="slide has-sub">
                                <a href="{{ route('admin.event.index') }}" class="side-menu__item">Danh Sách</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="{{ route('admin.event.create') }}" class="side-menu__item">Tạo Sự Kiện</a>
                            </li>
                        </ul>
                    </li>
                <!-- end event -->
                <!-- voucher -->
                <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <i class='bx bxs-discount side-menu__icon'></i>
                            <span class="side-menu__label">Khuyến Mãi </span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide has-sub">
                                <a href="{{ route('admin.voucher.index') }}" class="side-menu__item">Danh Sách</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="{{ route('admin.voucher.create') }}" class="side-menu__item">Tạo Khuyến Mãi</a>
                            </li>
                        </ul>
                    </li>
                <!-- endvoucher -->
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->
