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
