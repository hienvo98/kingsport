@extends('layouts.appAdmin')
@section('content')
    <form action="{{ url('/test2') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default" style="height: 100%">Tên Quyền</span>
            </div>
            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="form-check">
            <input class="form-check-input" data-type="cat" data-check-all="true" name="role_name" type="checkbox" value="" id="flexCheckDefault1">
            <label class="form-check-label  fw-bolder" for="flexCheckDefault1">
                Danh Mục Sản Phẩm
            </label>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="card-header d-block">
                            <div class="d-sm-flex d-block align-items-center">
                                <div class="me-2">
                                    <span>
                                        <div class="form-check-inline">
                                            <input type="checkbox" data-type="cat" class="form-check-input" id="option1" name="permission[]" value="1">
                                        </div>
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <a href="javascript:void(0)">
                                        <span class="fs-14 fw-semibold text-center">Xem Danh Sách</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="card-header d-block">
                            <div class="d-sm-flex d-block align-items-center">
                                <div class="me-2">
                                    <span>
                                        <div class="form-check-inline">
                                            <input type="checkbox" data-type="cat" class="form-check-input" id="option1" name="permission[]" value="2">
                                        </div>
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <a href="javascript:void(0)">
                                        <span class="fs-14 fw-semibold">Tạo Danh Mục</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="card-header d-block">
                            <div class="d-sm-flex d-block align-items-center">
                                <div class="me-2">
                                    <span>
                                        <div class="form-check-inline">
                                            <input type="checkbox" data-type="cat" class="form-check-input" id="option1" name="permission[]" value="3">
                                        </div>
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <a href="javascript:void(0)">
                                        <span class="fs-14 fw-semibold">Chỉnh Sửa Danh Mục</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="card-header d-block">
                            <div class="d-sm-flex d-block align-items-center">
                                <div class="me-2">
                                    <span>
                                        <div class="form-check-inline">
                                            <input type="checkbox" data-type="cat" class="form-check-input" id="option1" name="permission[]" value="4">
                                        </div>
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <a href="javascript:void(0)">
                                        <span class="fs-14 fw-semibold">Xoá Danh Mục</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        $(document).ready(function() {
            $("input[data-check-all=true]").click(function(){
                let dataType = $(this).attr('data-type');
                $(`input[data-type=${dataType}]`).not(this).prop('checked', this.checked);
            })
        });
    </script>
@endsection
