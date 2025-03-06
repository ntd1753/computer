@extends('layouts.master')

@section('title')
    @lang('translation.Projects_List')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quản Lí  người dùng
        @endslot
        @slot('title')
            Danh sách Nhân viên
        @endslot
    @endcomponent
    <div class="card p-3">
            <form class="mt-4" method="GET" action="#">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-0">
                            <label for="search" class="form-label">Tên nhân viên</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" id="search" placeholder="" value="{{request('name', old('name'))}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-0">
                            <label for="search" class="form-label">Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" id="search" placeholder="Search..." value="{{request('email', old('email'))}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-0">
                            <label for="search" class="form-label">Vai trò</label>
                            <div class="input-group">
                                {!! Form::select('role', ['' => 'Chọn vai trò'] + $listRole, request('role', old('role')), ['class' => 'form-control select2']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-0">
                            <label for="search" class="form-label">Status</label>
                            <div class="input-group">
                                {!! Form::select('status', ['' => 'Chọn Status'] + \App\Models\Admin::$listStatus, request('status', old('status')), ['class' => 'form-control select2']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="w-100 d-flex justify-content-center mt-4">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i> <span>Tìm kiếm</span></button>
                    </div>
                </div>
            </form>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-6">
        <a href="{{route('user.add')}}">
            <button type="button" class="btn btn-primary waves-effect waves-light my-3"><i class="bx bx-plus"></i>Thêm Nhân viên</button>
        </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table align-middle table-borderless brand-table text-center w-100">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center px-3">ID</th>
                            <th scope="col" class="text-start px-3">Họ và tên</th>
                            <th scope="col" style="width: 100px">Vai trò</th>
                            <th scope="col" class="px-3">Email</th>
                            <th scope="col" style="width: 100px">Avatar</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @include('content.user.row_table',['admins'=>$admins])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $admins->links() }}
            </div>
        </div>
@endsection
