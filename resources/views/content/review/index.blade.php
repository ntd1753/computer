@extends('layouts.master')

@section('title')
    @lang('translation.Projects_List')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quản Lí Đánh giá sản phẩm
        @endslot
        @slot('title')
            Danh Sách bình luận và đánh giá
        @endslot
    @endcomponent
    <div class="card p-3">
        <form class="mt-4" method="GET" action="{{route('review.index')}}">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="mb-0">
                        <label for="search" class="form-label">Trạng thái</label>
                        <div class="input-group">
                            <select class="form-control select2" name="status">
                                <option>chọn trạng thái</option>
                                @foreach(\App\Models\Review::$listStatus as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
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
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table  align-middle table-borderless brand-table text-center">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center px-3">ID</th>
                            <th scope="col" class="text-start px-3">Người bình luận</th>
                            <th scope="col" class="text-start px-3">Sản phẩm</th>
                            <th scope="col" class="text-start px-3">Đánh giá</th>
                            <th scope="col" style="width: 100px">Nội dung</th>
                            <th scope="col" style="width: 100px">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('content.review.row_table',['listItem'=>$reviews])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $reviews->links() }}
            </div>
        </div>
@endsection
