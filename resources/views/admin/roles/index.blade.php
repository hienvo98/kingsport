@extends('layouts.appAdmin')
@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Phân Quyền</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm Sản phẩm
                </nav>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tên Quyền</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
                            <select class="form-control">
                                <option>Chọn tùy chọn</option>
                                <option value="1">Tùy chọn 1</option>
                                <option value="2">Tùy chọn 2</option>
                                <option value="3">Tùy chọn 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tên Admin</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
                            <select class="form-control">
                                <option>Chọn tùy chọn</option>
                                <option value="1">Tùy chọn 1</option>
                                <option value="2">Tùy chọn 2</option>
                                <option value="3">Tùy chọn 3</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
