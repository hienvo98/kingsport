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
    <form action="{{ route('admin.role.store') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default" style="height: 100%">Tên Quyền</span>
            </div>
            <input type="text" class="form-control" name="name" aria-label="Default" value="{{ old('name') }}"
                aria-describedby="inputGroup-sizing-default">
        </div>
        @foreach ($permissions as $perParent => $listPerChild)
            <div class="form-check">
                <input class="form-check-input" data-type="{{ $perParent }}" data-check-all="true" name="role_name"
                    type="checkbox" value="" id="flexCheckDefault-{{ $perParent }}">
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
                                                    <input type="checkbox" data-type="{{ $perParent }}"
                                                        class="form-check-input" id="option1" name="permission[]"
                                                        value="{{ $per->id }}">
                                                </div>
                                            </span>
                                        </div>
                                        <div class="flex-fill">
                                            <a href="javascript:void(0)">
                                                <span class="fs-14 fw-semibold text-center"><?php
                                                $name = [
                                                    'index' => 'Xem Danh Sách',
                                                    'store' => 'Thêm',
                                                    'update' => 'Chỉnh Sửa',
                                                    'destroy' => 'Xoá',
                                                ];
                                                echo $name[explode('.', $per->name)[2]];
                                                ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        $(document).ready(function() {
            $("input[data-check-all=true]").click(function() {
                let dataType = $(this).attr('data-type');
                $(`input[data-type=${dataType}]`).not(this).prop('checked', this.checked);
            })
        });
    </script>
@endsection
