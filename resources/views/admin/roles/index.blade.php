@extends('layouts.appAdmin')
@section('content')
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
        <h4 class="text-info">Cấp Quyền Cho Admin</h4>
        <form action="{{ url('/admin/authorizeUser') }}" method="post">
            @csrf
            <div class="col-xl-6 my-3">
                <label for="product-gender-add" class="form-label">Admin</label>
                @error('user')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <select class="form-control" data-trigger name="user" id="product-gender-add">
                    <option value="">Chọn Admin Cần Cấp Quyền</option>
                    @if (!empty($users))
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    @else
                        <option value="">Không có admin nào</option>
                    @endif
                </select>
            </div>
            <div class="col-xl-6 my-3">
                <label for="product-gender-add" class="form-label">Quyền</label>
                @error('role')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <select class="form-control" data-trigger name="role" id="product-gender-add">
                    <option value="">Chọn Quyền</option>
                    @if (!empty($roles))
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    @else
                        <option value="All">Chưa có quyền nào được tạo</option>
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-outline-info">Cấp Quyền</button>
        </form>
    </div>
@endsection
