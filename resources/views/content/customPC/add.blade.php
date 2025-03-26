@extends('layouts.master')

@section('title')
    @lang('translation.Add_Product')
@endsection

@section('css')
    <!-- select2 css -->
    <link href="{{ URL::asset('build/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css" rel="stylesheet">
        legend {
            border-bottom: solid 1px #d2d2d2;
            margin-bottom: 15px;
            margin-top: 10px;
        }

        .image_box {
            width: 206px;
            height: 256px;
            overflow: hidden;
            position: relative;
            padding: 5px;
            border: solid 1px #ddd;
            background: #f2f2f2;
            float: left;
            margin-right: 15px;
            margin-bottom: 15px;
        }

        .image_box img {
            width: 194px;
            height: 244px;
            object-fit: cover;
        }

        .btn_delete_image {
            position: absolute;
            right: 10px;
            bottom: 10px;
        }

        .add_image_button {
            float: left;
            width: 206px;
            height: 256px;
            border: solid 1px #ddd;
            background: #f2f2f2;
            text-align: center;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .add_image_button i {
            width: 100%;
            margin-top: 50%;
            font-size: 40px;
            color: #02a7f0;
        }

        .add_image_button span {
            color: #02a7f0;
            font-size: 14px;
        }
    </style>

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
    <form action="{{route('pc.store')}}" method="POST" enctype="multipart/form-data" class="frm_form_add">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin cơ bản</h4>
                        @include('components.product.basicInformation',['accessoryType'=>\App\Models\Product::TYPE_PC, 'brands'=>null])
                </div>
            </div>
            @include('content.customPC.accessory')

            <div class="card">
                <div class="card-body row">
                    <div class="col-12">
                        <h4 class="card-title mb-3">Product Images</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="gallery_container">
                                    <div id = "image_container" class="image_container property_gallery">

                                    </div>
                                    <div class="add_image_button" data-preview="property_gallery" data-type="images">
                                        <i class="fa fa-image"></i>
                                        <span>Chọn ảnh</span>
                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
                        </div>
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
        var inputId='';
        var countInputId=0;
    </script>
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function () {

            $(document).on('click', '.btn_delete_image', function () {
                let numberImage = $(this).parent().parent().find('.image_box').length;
                $(this).parent().parent().parent().parent().find('.number_image').text(numberImage - 1);
                $(this).parent().remove();

            });

            $(document).ready(function () {
                $('.add_image_button').click(function () {
                    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');


                    let preview = $(this).data('preview');
                    let target_preview = $('.' + preview);
                    let type = $(this).attr('data-type');

                    $('#file_input').off('change').on('change', function () {
                        let files = $('#file_input')[0].files;
                        if (files.length > 0) {
                            Array.from(files).forEach((file) => {
                                let formData = new FormData();
                                formData.append('file', file)
                                ;
                            });
                        }
                    });
                });
            });

        });
        function fmSetLink(url) {
            var $div = $('<div>').addClass('image_box');
            var $img = $('<img>').attr('src', `${url}`);
            $div.append($img);
            var $button = $('<button>').attr('type', 'button').addClass('btn btn-warning btn_delete_image');
            var $icon = $('<i>').addClass('fa fa-trash');
            $button.append($icon);
            $div.append($button);
            var $input = $('<input>').attr({
                'type': 'hidden',
                'id': 'file_input',
                'name': 'images[]',
                'value': url
            });
            $div.append($input);

            $('#image_container').append($div);

            $button.on('click', function() {
                $div.remove(); // Xóa div khi nhấn nút
            });
        }

    </script>
@endsection
