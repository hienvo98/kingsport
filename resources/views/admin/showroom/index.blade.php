
@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Showroom</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Showroom</li>
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
        <div class="col-xl-3">
            <div class="card custom-card">
                <div class="card-body p-0">
                    <div class="p-3 border-bottom border-block-end-dashed">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0" placeholder="Search Task Here" aria-describedby="button-addon2">
                            <button class="btn btn-light" type="button" id="button-addon2"><i class="ri-search-line text-muted"></i></button>
                        </div>
                    </div>
                    <div class="p-3 task-navigation border-bottom border-block-end-dashed">
                        <ul class="list-unstyled task-main-nav mb-0">
                            <li class="px-0 pt-2">
                                <span class="fs-11 text-muted op-7 fw-semibold">Vùng Miền</span>
                            </li>
                            @if($regions)                      
                            @foreach ($regions as $region)
                            <li>
                                <a href="javascript:void(0);" class="category-item">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 lh-1">
                                            <i class="ri-price-tag-line align-middle fs-14 fw-semibold text-primary"></i>
                                        </span>
                                        
                                        <span class="flex-fill text-nowrap">
                                            {{$region->name}}
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body p-0">
                            <div class="d-flex p-3 align-items-center justify-content-between">
                                <div>
                                    <h6 class="fw-semibold mb-0">Showroom</h6>
                                </div>
                                <div>
                                    <ul class="nav nav-tabs nav-tabs-header mb-0 d-sm-flex d-block" role="tablist">
                                        <li class="nav-item m-1">
                                            <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page"
                                            href="#all-tasks" aria-selected="true">Tất Cả</a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                            href="#completed" aria-selected="true">Đang hoạt động</a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                            href="#pending" aria-selected="true">Ngừng hoạt động</a>
                                        </li>                                    
                                    </ul>
                                </div>
                                <div>
                                    <div class="dropdown" style="display: none;" >
                                        <button class="btn btn-icon btn-sm btn-light btn-wave waves-light waves-effect" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">Select All</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Share All</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Delete All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.showroom.list-showroom');        
            </div>
        </div>
    </div>
    <!--End::row-1 -->
    @endsection