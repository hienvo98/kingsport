@extends('layouts.appAdmin')
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">Sản Phẩm</h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">   
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Danh Sách Quyền Admin
                    </div>
                    <div class="header-element header-search">
                        <!-- Start::header-link -->
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="bx bx-search-alt-2 header-link-icon"></i>
                        </a>
                        <!-- End::header-link -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Tên Quyền</th>
                                    <th scope="col" class="text-center" >Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($roles))
                                    @foreach ($roles as $role)
                                    <tr class="product-list">
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="fw-semibold">
                                                    {{ $role->name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15 justify-content-center">
                                                <a style="font-size: " href="{{ route('admin.role.edit',['id'=>$role->id]) }}" class="btn btn-icon btn-sm btn-info-light"><i class="ri-edit-line"></i></a>
                                                <a href="{{ route('admin.role.destroy',['id'=>$role->id]) }}" class="btn btn-icon btn-sm btn-danger-light product-btn"><i class="ri-delete-bin-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>  
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
