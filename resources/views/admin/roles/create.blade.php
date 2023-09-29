@extends('layouts.appAdmin')
@section('content')
    @if (count($errors->all()))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Quyền</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tạo Quyền</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Tạo Quyền
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
                    <form action="{{ route('admin.role.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default" style="height: 100%">Tên
                                    Quyền</span>
                            </div>
                            <input type="text" class="form-control" name="name" aria-label="Default"
                                value="{{ old('name') }}" aria-describedby="inputGroup-sizing-default">
                        </div>
                        @foreach ($permissions as $perParent => $listPerChild)
                            @if ($perParent != 'role')
                                <div class="form-check">
                                    <input class="form-check-input" data-type="{{ $perParent }}" data-check-all="true"
                                        name="role_name" type="checkbox" value=""
                                        id="flexCheckDefault-{{ $perParent }}">
                                    <label class="form-check-label  fw-bolder" for="flexCheckDefault-{{ $perParent }}">
                                        {{ ucfirst(trans($perParent)) }}
                                    </label>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        @foreach ($listPerChild as $per)
                                            <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-12">
                                                <div class="card custom-card">
                                                    <div class="card-header d-block">
                                                        <div class="d-sm-flex d-block align-items-center">
                                                            <div class="me-2">
                                                                <span>
                                                                    <div class="form-check-inline">
                                                                        <input type="checkbox"
                                                                            data-type="{{ $perParent }}"
                                                                            class="form-check-input" id="per-{{ $per->id }}"
                                                                            name="permission[]" value="{{ $per->id }}">
                                                                    </div>
                                                                </span>
                                                            </div>
                                                            <div class="flex-fill">
                                                                <a href="javascript:void(0)">
                                                                    <label for="per-{{ $per->id }}"
                                                                        class="fs-14 fw-semibold text-center"><?php
                                                                        $name = [
                                                                            'index' => 'Xem Danh Sách',
                                                                            'store' => 'Thêm',
                                                                            'update' => 'Chỉnh Sửa',
                                                                            'destroy' => 'Xoá',
                                                                        ];
                                                                        echo $name[explode('.', $per->name)[2]];
                                                                        ?></label>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <button type="submit" class="btn btn-primary">Tạo Quyền</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- <script>
        $(document).ready(function() {
            $("input[data-check-all=true]").click(function() {
                let dataType = $(this).attr('data-type');
                $(`input[data-type=${dataType}]`).not(this).prop('checked', this.checked);
            })
        });
    </script> --}}
    <script src="{{ asset('assets/js/role.js') }}"></script>
@endsection
