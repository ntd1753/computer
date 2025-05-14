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
    <div class="card p-3">
            <form class="mt-4" method="GET" action="{{route('post.index')}}">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-0">
                            <label for="search" class="form-label">Tiêu đề</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="title" id="search" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-0">
                            <label for="search" class="form-label">Tác giả</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="author" id="search" placeholder="Search...">
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
        <a href="{{route('post.add')}}">
            <button type="button" class="btn btn-primary waves-effect waves-light my-3"><i class="bx bx-plus"></i>Thêm bài viết</button>

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
    @foreach($posts as $item)
        @include('components.modal.SeoModal',['item'=>$item])
        @include('components.modal.PostModal',['item'=>$item])

    @endforeach
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
@endsection
