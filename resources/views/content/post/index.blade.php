@extends('layouts.master')

@section('title')
    @lang('translation.Projects_List')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quản Lí Bài Viết
        @endslot
        @slot('title')
            Danh Sách Bài Viết
        @endslot
    @endcomponent
    <div>
        <a href="{{route('post.add')}}">
            <button type="button" class="btn btn-primary waves-effect waves-light my-3"><i class="bx bx-plus"></i>Thêm bài viết</button>

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
                            <th scope="col" class="text-start px-3">Tên Bài viết</th>
                            <th scope="col" class="px-3">Mô tả</th>
                            <th scope="col" style="width: 100px">Ảnh Preview</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @include('content.post.row_table',['posts'=>$posts])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
