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
    <div class="card p-3">
        <form class="mt-4" method="GET" action="{{route('accessory.index', ["accessory_type"=>$accessoryType])}}">
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
                        <label for="search" class="form-label">Tên Sản phẩm</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" id="search" placeholder="Search...">
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-2">
                <div class="col-lg-6 col-sm-6">
                    <div class="mb-0">
                        <label for="search" class="form-label">Tên Nhãn hiệu</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="brand" id="search" placeholder="Search...">
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
        <a href="{{route('accessory.add',["accessory_type"=>$accessoryType])}}">
            <button type="button" class="btn btn-primary waves-effect waves-light my-3"><i class="bx bx-plus"></i>Thêm Sản Phẩm</button>

        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table  align-middle table-borderless brand-table text-center">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center px-3">ID</th>
                            <th scope="col" class="text-start px-3">Tên Sản Phẩm</th>
                            <th scope="col" class="text-start px-3">Danh mục</th>
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
        @include("components.modal.productPostModal",['item'=>$item->product, 'name'=>'danh mục'])

    @endforeach
@endsection
