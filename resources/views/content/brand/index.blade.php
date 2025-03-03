@extends('layouts.master')

@section('title')
    @lang('translation.Projects_List')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quản lí nhãn hàng
        @endslot
        @slot('title')
            Danh sách nhãn hàng
        @endslot
    @endcomponent
    <div class="card p-3">
        <form class="mt-4" method="GET" action="{{route('brand.index')}}">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="mb-0">
                        <label for="search" class="form-label">Id</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="id" id="search" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="mb-0">
                        <label for="search" class="form-label">Tên nhãn hàng</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" id="search" placeholder="Search...">
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

    <div>
        <a href="{{route('brand.add')}}">
            <button type="button" class="btn btn-primary waves-effect waves-light my-3"><i class="bx bx-plus"></i>Thêm Nhãn Hàng</button>

        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap align-middle table-borderless brand-table text-center">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center px-3">ID</th>
                            <th scope="col" style="width: 100px">Logo</th>
                            <th scope="col">Tên Nhãn hàng</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @include('content.brand.row_table')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
