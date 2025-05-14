@extends('layouts.master')

@section('title')
    @lang('translation.Create_New')
@endsection

@section('css')
    <!-- bootstrap datepicker -->
    <link href="{{ URL::asset('build/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <!-- dropzone css -->
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Nhãn hàng
        @endslot
        @slot('title')
            Tạo mới
        @endslot
    @endcomponent

    <form id="brand-frm" method="POST" action="{{route("category.store", ['model_type' => $model_type])}}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="projectname-input" class="form-label">Tên Danh Mục</label>

                            <input id="projectname-input" name="name" type="text" class="form-control"
                                placeholder="Nhập tên nhãn hàng" required>
                            <div class="invalid-feedback">Nhập Tên Danh Mục</div>
                        </div>
                        <div class="mb-3">
                            <label for="parent-category-input" class="form-label">Danh Mục Cha</label>
                            <select class="form-control" id="parent-category-input" name="parent_id">
                                <option value="" selected>Không có danh mục cha</option>
                                @include('content.category.category_option', ["categories" =>$categories, 'level' => 0])
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>

                            <div class="text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute bottom-0 end-0">
                                        <label for="project-image-input" class="mb-0" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Chọn ảnh">
                                            <div class="avatar-xs">
                                                <button id="button-image"
                                                    class="avatar-title bg-light border rounded-circle text-muted cursor-pointer shadow font-size-16">
                                                    <i class='bx bxs-image-alt'></i>
                                                </button>
                                                <input type="hidden" name="image"  class="form-control" id="image_label">
                                            </div>
                                        </label>
                                        <button class="form-control d-none" type="button"
                                               id="button-image"></button>
                                    </div>
                                    <div class="avatar-lg" style="width: 11rem; height: 5rem;">
                                        <div class="avatar-title bg-light overflow-hidden" style="width: 11rem; height: 5rem;">
                                            <img src="" id="img_preview"
                                                class="avatar-md h-auto object-fit-fill w-100 " />
                                        </div>
                                    </div>
                                </div>
                                @error("image")
                                <div class="w-100 text-center text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>


            <div class="col-12">
                <div class="text-end mb-4">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </div>
        <!-- end row -->
    </form>
@endsection
@section('script')
    <!-- bootstrap datepicker -->
    <script src="{{ URL::asset('build/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- dropzone plugin -->
    <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/project-create.init.js') }}"></script>
    <script>
        var inputId='';
    </script>
@endsection
