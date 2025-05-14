@extends('layouts.master')

@section('title')
    @lang('translation.Projects_List')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quản Lí Danh Mục
        @endslot
        @slot('title')
            Danh Sách Danh Mục
        @endslot
    @endcomponent
    <div class="card p-3">
        <form class="mt-4" method="GET" action="{{route('category.index', ['model_type' => $model_type])}}">
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
                        <label for="search" class="form-label">Tên danh mục</label>
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
        <a href="{{route('category.add', ['model_type' =>$model_type])}}">
            <button type="button" class="btn btn-primary waves-effect waves-light my-3"><i class="bx bx-plus"></i>Thêm Danh Mục</button>

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
                            <th scope="col" class="text-start px-3">Tên Danh Mục</th>
                            <th scope="col">Slug</th>
                            <th scope="col" style="width: 100px">icon</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @include('content.category.row_table',['categories'=>$categories,"level"=>0, 'model_type'=>$model_type])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
