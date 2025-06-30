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

    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table  align-middle table-borderless brand-table text-center">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center px-3">ID</th>
                            <th scope="col" class="text-start px-3">Tên Bộ Lọc</th>
                            <th scope="col" class="text-start px-3">Giá Trị</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('content.filter.row_table',['listItem'=>$filters])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
