@include('admin.partials.mainhead')

<link rel="stylesheet" href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/libs/swiper/swiper-bundle.min.css')}}">
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/alerts.js') }}"></script>
</head>

<body>
@include('admin.partials.switcher')
@include('admin.partials.loader')
<div class="page">
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    @include('admin.components.alert')
    <div class="main-content app-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>

<!-- Modal edit -->
@include('admin/category/edit')
<!-- Modal edit -->
<!-- Modal subCategory -->
@include('admin/category/sub-category')

@include('admin.partials.headersearch_modal')
@include('admin.partials.footer')
@include('admin.partials.commonjs')
@include('admin.partials.custom_switcherjs')

<!-- Custom JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('/assets/js/category.js')}}"></script>
</body>
