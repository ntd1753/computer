@extends('layouts.master')

@section('title')
    @lang('translation.Projects_List')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quản Lí Sản Phẩm
        @endslot
        @slot('title')
            Danh Sách Linh Kiện
        @endslot
    @endcomponent
    <div>
        <a href="{{route('accessory.add',["accessory_type"=>$accessoryType])}}">
            <button type="button" class="btn btn-primary waves-effect waves-light my-3"><i class="bx bx-plus"></i>Thêm Sản Phẩm</button>

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
                            <th scope="col" class="text-start px-3">Tên Sản Phẩm</th>
                            <th scope="col" class="px-3">Hãng</th>
                            <th scope="col" style="width: 100px">Ảnh Preview</th>
                            <th scope="col" >Giá Nhập</th>
                            <th scope="col" >Giá Bán</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @include('content.accessory.row_table',['accessories'=>$accessories])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach($accessories as  $item)
        @include("components.modal.productDataSheetModal",['item'=>$item])

    @endforeach
@endsection
