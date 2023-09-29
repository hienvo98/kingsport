@extends('layouts.appAdmin')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/libs/prismjs/themes/prism-coy.min.css') }}">
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Quyền</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Phân Quyền</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Phân Quyền
                    </div>
                    <div class="header-element header-search">
                        <!-- Start::header-link -->
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal"
                            data-bs-target="#searchModal">
                            {{-- <i class="bx bx-search-alt-2 header-link-icon"></i> --}}
                        </a>
                        <!-- End::header-link -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h4 class="text-info">Chỉnh Sửa Quyền Cho Admin</h4>
                        <form action="{{ url('/admin/authorize/update') }}" method="post">
                            @csrf
                            <div class="col-xl-6 my-3">
                                <label for="product-gender-add" class="form-label">Admin</label>
                                @error('user')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input id="price_to" class="form-control" value="{{ $user->name }}" disabled="disabled">
                                <input type="hidden" name="user" value="{{ $user->id }}">
                            </div>
                            <div class="col-xl-6 my-3">
                                <label for="product-gender-add" class="form-label">Quyền</label>
                                @error('role')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <select class="form-control" data-trigger name="role[]" id="choices-multiple-default"
                                    multiple>
                                    @if (!empty($roles))
                                        @foreach ($roles as $role)
                                            <option {{ in_array($role->id,$user->roles->pluck('id')->toArray())  ? 'selected' : '' }}
                                                value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-info">Cập Nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
    <script src=" {{ asset('assets/js/prism-custom.js') }} "></script>
    <script src="{{ asset('assets/js/choices.js') }} "></script>
@endsection
