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
                        <label for="search" class="form-label">Tiêu đề banner</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="title" id="search" placeholder="" value="{{request('title', old('title'))}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="mb-0">
                        <label for="search" class="form-label">vị trí banner</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="position" id="search" placeholder="" value="{{request('position', old('position'))}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="mb-0">
                        <label for="search" class="form-label">Status</label>
                        <div class="input-group">
                            {{ Form::select('status', ['' => 'Chọn Status'] + \App\Models\Admin::$listStatus, request('status', old('status')), ['class' => 'form-select']) }}
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
        @if(in_array(\App\Models\CustomPermission::getPermissionByKey('AddABanner'), \App\Models\CustomPermission::getValidPermissions()))
            <div class="col-lg-4 col-sm-6">
                <a href="{{route('banner.add')}}">
                    <button type="button" class="btn btn-primary waves-effect waves-light my-3"><i class="bx bx-plus"></i>Thêm Banner</button>
                </a>
            </div>
        @endif

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table align-middle table-borderless brand-table text-center w-100">
                        <thead>
                        <tr>

                            <th scope="col" class="text-center px-3">Id</th>
                            <th scope="col" class="text-center px-3">Hình ảnh banner</th>
                            <th scope="col">Link</th>
                            <th scope="col">Trạng thái hiển thị</th>
                            <th scope="col">Vị trí</th>
                            <th scope="col">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('content.banner.row_table',['banners'=>$banners])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $banners->links() }}
            </div>
        </div>
@endsection
