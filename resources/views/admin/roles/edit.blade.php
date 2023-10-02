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
    <form action="{{ route('admin.role.update') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default" style="height: 100%">Tên Quyền</span>
            </div>
            <input type="text" class="form-control" name="name" aria-label="Default" value="{{ $role->name }}"
                aria-describedby="inputGroup-sizing-default">
            <input type="hidden" name="role" value="{{ $role->id }}">
        </div>
        @foreach ($permissions as $perParent => $listPerChild)
            @if ($perParent != 'role')
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
                                                        <input type="checkbox" <?php echo in_array($per->id, $listPerRole) ? 'checked' : ''; ?>
                                                            data-type="{{ $perParent }}" class="form-check-input"
                                                            id="per-{{ $per->id }}" name="permission[]"
                                                            value="{{ $per->id }}">
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <a href="javascript:void(0)">
                                                    <label for="" class="fs-14 fw-semibold text-center text-capitalize"><?php 
                                                        $name = [
                                                            'index'=>'xem danh sách',
                                                            'store'=>'thêm',
                                                            'update'=>'chỉnh sửa',
                                                            'destroy'=>'xoá'
                                                    ];
                                                    echo $name[ explode('.',$per->name)[2]];
                                                        ?> </label>
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
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
    <script src="{{ asset('assets/js/role.js') }}"></script>
@endsection
