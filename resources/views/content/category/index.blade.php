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
    <div>
        <a href="{{route('category.add')}}">
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
                            <th scope="col" class="text-start px-3">Tên Danh Mục</th>
                            <th scope="col">Slug</th>
                            <th scope="col" style="width: 100px">icon</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @include('content.category.row_table',['categories'=>$categories,"level"=>0])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
