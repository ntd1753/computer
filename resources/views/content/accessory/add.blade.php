@extends('layouts.master')

@section('title')
    @lang('translation.Add_Product')
@endsection

@section('css')
    <!-- select2 css -->
    <link href="{{ URL::asset('build/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quản Lí Sản Phẩm
        @endslot
        @slot('title')
            Thêm Sản Phẩm
        @endslot
    @endcomponent
    <form action="{{route('accessory.store',['accessory_type'=>$accessoryType])}}" method="POST" enctype="multipart/form-data" class="frm_form_add">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin cơ bản</h4>
                        @include('components.product.basicInformation')
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông Số</h4>
                    @include('components.product.'.$accessoryType)
                </div>
            </div>

            <div class="card">
                <div class="card-body row">
                    <div class="col-8">
                        <h4 class="card-title mb-3">Product Images</h4>
                        <div class="dropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple="multiple" name="images[]">
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                </div>

                                <h4>Drop files here or click to upload.</h4>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-0" id="dropzone-preview">
                            <li class="mt-2" id="dropzone-preview-list">
                                <!-- This is used as the file preview template -->
                                <div class="border rounded">
                                    <div class="d-flex p-2">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm bg-light rounded">
                                                <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                     src="https://img.themesbrand.com/judia/new-document.png"
                                                     alt="Dropzone-Image">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="pt-1">
                                                <h5 class="fs-md mb-1" data-dz-name>&nbsp;</h5>
                                                <p class="fs-sm text-muted mb-0" data-dz-size></p>
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <h4 class="card-title mb-3">Data Sheet</h4>

                        <textarea id="dataSheet" name="dataSheet">
                            @include('components.product.dataSheet')
                        </textarea>
                    </div>
                </div>

            </div> <!-- end card-->

            <div class="card">
                @include("components.product.post")
            </div>
        </div>
    </div>
    <div class="w-100 d-flex justify-content-center">
        <div class="d-flex flex-wrap ">
            <button type="submit" class="btn btn-primary waves-effect waves-light">Lưu</button>
        </div>
    </div>
    <!-- end row -->
    </form>

@endsection
@section('script')
    <!-- select 2 plugin -->
    <script src="{{ URL::asset('build/libs/select2/js/select2.min.js') }}"></script>

    <!-- dropzone plugin -->
    <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>

    <!-- init js -->
    <script src="{{ URL::asset('build/js/pages/ecommerce-select2.init.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy phần tử checkbox
            const discountCheckbox = document.getElementById('discount-checkbox');
            // Lấy phần tử input để nhập giá trị giảm giá
            const discountValue = document.getElementById('discount-value');
            const discountType = document.getElementById('discount-type');

            // Lắng nghe sự kiện thay đổi trên checkbox
            discountCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    // Nếu checkbox được check, enable ô discount-value
                    discountValue.disabled = false;
                    discountType.disabled = false;
                } else {
                    // Nếu checkbox không được check, disable ô discount-value và xóa nội dung
                    discountValue.disabled = true;
                    discountValue.value = null;
                    discountType.disabled = true;
                    discountType.value = null;

                }
            });
        });
        $(document).ready(function () {
            $('.frm_form_add').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: $(this).serialize(),
                    beforeSend: function () {
                        showPreload();
                    },
                    complete: function () {
                        hidePreload();
                    },
                    success: function (res) {
                        if (res.success) {
                            //showSuccessMessage(res.message);
                            setTimeout(function () {
                                location.href = res.url;
                            }, 1000);
                        } else {
                           // showErrorMessage(res.message);
                        }
                    },
                    error: function (e) {
                        showErrorValidate(e);
                    }
                });
            });
        });

    </script>
@endsection
