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
                            <i class="bx bx-file-blank side-menu__icon"></i>
                            <span class="side-menu__label">Quản Lý Hệ Thống<span
                                    class="badge bg-secondary-transparent ms-2">New</span></span>
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
                        </ul>
                    </li>
                @endcan

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-file-blank side-menu__icon"></i>
                        <span class="side-menu__label">Pages<span
                                class="badge bg-secondary-transparent ms-2">New</span></span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Pages</a>
                        </li>
                        @canany(['admin.category.index', 'admin.category.store', 'admin.category.update',
                            'admin.category.destroy'])
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Danh Mục
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="{{ route('admin.category.index') }}" class="side-menu__item">Danh
                                            Sách</a>
                                    </li>
                                </ul>
                            </li>
                        @endcanany
                        @canany(['admin.product.index', 'admin.product.store', 'admin.product.update',
                            'admin.product.destroy'])
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Sản Phẩm
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="{{ route('admin.product.index') }}" class="side-menu__item">Danh
                                            Sách</a>
                                    </li>
                                </ul>
                            </li>
                        @endcanany
                        <li class="slide has-sub active">
                            <a href="javascript:void(0);" class="side-menu__item active">Sản Phẩm
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2 active" style="display: block;">
                                <li class="slide active">
                                    <a href="{{ route('admin.product.create') }}" class="side-menu__item active">Thêm
                                        sản phẩm </a>
                                </li>
                                <li class="slide">
                                    <a href="cart.html" class="side-menu__item">Cart</a>
                                </li>
                                <li class="slide">
                                    <a href="checkout.html" class="side-menu__item">Checkout</a>
                                </li>
                                <li class="slide">
                                    <a href="edit-products.html" class="side-menu__item">Edit Products</a>
                                </li>
                                <li class="slide">
                                    <a href="order-details.html" class="side-menu__item">Order Details</a>
                                </li>
                                <li class="slide">
                                    <a href="orders.html" class="side-menu__item">Orders</a>
                                </li>
                                <li class="slide">
                                    <a href="products.html" class="side-menu__item">Products</a>
                                </li>
                                <li class="slide">
                                    <a href="product-details.html" class="side-menu__item">Product Details</a>
                                </li>
                                <li class="slide">
                                    <a href="products-list.html" class="side-menu__item">Products List</a>
                                </li>
                                <li class="slide">
                                    <a href="wishlist.html" class="side-menu__item">Wishlist</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

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
