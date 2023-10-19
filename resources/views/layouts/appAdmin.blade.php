
@include('admin.partials.mainhead')

<body>
@include('admin.partials.switcher')
@include('admin.partials.loader')
<div class="page">
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    @include('admin.components.alert')
    <script src="{{asset('assets/libs/quill/quill.min.js')}}"></script>
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
{# <script src="{{asset('assets/js/custom.js')}}"></script> #}
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
{{-- <script src="{{asset('/assets/js/category.js')}}"></script> --}}
<script src="{{asset('/assets/libs/simplebar/simplebar.min.js')}}"></script>

<!-- Add product JS -->
<!-- Date & Time Picker JS -->
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

<!-- Quill Editor JS -->


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
<script src="{{asset('assets/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js')}}"></script>

<!-- Internal Add Products JS -->
{{-- <script src="{{asset('assets/js/add-products.js')}}"></script> --}}
<!-- Internal Create Blog JS -->
{{-- <script src="{{asset('assets/js/blog-create.js')}}"></script> --}}
<script src="{{ asset('assets/js/quill-editor.js') }}"></script>
</body>
