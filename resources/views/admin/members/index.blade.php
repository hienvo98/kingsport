@extends('layouts.appAdmin')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/libs/prismjs/themes/prism-coy.min.css') }} ">
    <script src="{{ asset('assets/libs/prismjs/prism.js') }} "></script>
    <script src="{{ asset('assets/js/prism-custom.js') }}"></script>
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Admin</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh Admin</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Danh Sách Admin
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
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Tên Admin</th>
                                    <th scope="col" class="text-center">Quyền Admin</th>
                                    <th scope="col" class="text-center">Thao Tác</th>
                                    <th scope="col" class="text-center">Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($users))
                                    @foreach ($users as $user)
                                        <tr class="product-list" id="role-{{ $user->id }}">
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="fw-semibold">
                                                        {{ $user->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if (count($user->roles))
                                                    @foreach ($user->roles as $role)
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <div class="fw-semibold text-capitalize">
                                                                {{ $role->name }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="fw-semibold text-capitalize">
                                                            chưa được cấp quyền
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="hstack gap-2 fs-15 justify-content-center">
                                                    <a style="font-size: "
                                                        href="{{ url("/admin/authorize/edit/{$user->id}") }}"
                                                        class="btn btn-icon btn-sm btn-info-light edit-role-{{ $user->id }} <?php echo $user->deleted_at ? 'disable-link' : ''; ?>"><i
                                                            class="ri-edit-line"></i></a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="hstack gap-2 fs-15 justify-content-center">
                                                    <div class="col-xl-4">
                                                        <div data-id="{{ $user->id }}"
                                                            class="status toggle toggle-success <?php echo $user->deleted_at ? 'off' : 'on'; ?>  mb-3">
                                                            <span></span>
                                                        </div>
                                                    </div>
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
    @include('admin.components.delete')
    <script src="{{ asset('assets/js/role.js') }}"></script>
@endsection
