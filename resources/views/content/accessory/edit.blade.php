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
            Sửa thông tin Sản Phẩm
        @endslot
    @endcomponent
    <form action="{{route('accessory.update',['accessory_type'=>$accessoryType, 'id' => $accessory->id])}}" method="POST" enctype="multipart/form-data" class="frm_form_add">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Thông tin cơ bản</h4>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="name">Tên Sản Phẩm</label>
                                    <input id="name" name="name" type="text" class="form-control" value="{{$accessory->product->name}}"
                                    >
                                </div>
                                <div class="mb-3">
                                    <label for="slug">Loại Sản Phẩm</label>
                                    <input id="slug" type="text"
                                           class="form-control" value="{{strtoupper($accessoryType)}}"
                                           disabled>
                                    <input type="hidden" name="product_type"
                                           class="form-control" value="{{strtoupper($accessoryType)}}">
                                </div>
                                <div class="mb-3">
                                    <label for="cost">Giá nhập</label>
                                    <input id="cost" name="cost" type="text" value="{{$accessory->product->cost}}"
                                           class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="discount-type">Loại Giảm giá</label>
                                    <select id="discount-type" class="form-control" name="discount_type"
                                    @if(!$accessory->product->discount_type)
                                        disabled
                                    @endif
                                    >
                                        <option value=""
                                            @if(!$accessory->product->discount_type)
                                            selected
                                            @endif>Chọn Loại Giảm giá</option>
                                        <option value="1"
                                                @if($accessory->product->discount_type == \App\Models\Product::DISCOUNT_PERCENT)
                                                    selected
                                               @endif>
                                            Giảm Phần Trăm
                                         </option>
                                        <option value="0"
                                                @if($accessory->product->discount_type == \App\Models\Product::DISCOUNT_VND)
                                                    selected
                                            @endif>
                                            Giảm Giá Trực Tiếp</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="control-label">Danh Mục</label>

                                    <select class="form-control select2" name="category_id">

                                        <option>Chọn Danh Mục</option>
                                        @include('content.accessory.category_selected_option',
                                            ['item'=>$accessory->product,
                                            "categories" =>$categories,
                                            'level' => 0])
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="control-label">Nhãn Hàng</label>

                                    <select class="form-control select2" name="brand_id"
                                    >
                                        <option>Chọn Nhãn Hàng</option>
                                        @foreach($brands as $brand)
                                            @if($accessory->brand_id == $brand->id)
                                                <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                            @endif
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price">Giá Bán</label>
                                    <input id="price" name="price" type="text" class="form-control" value="{{$accessory->product->price}}"
                                           placeholder="Price">
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-10">
                                        <label for="discount-value">Giảm Giá</label>
                                        <input id="discount-value" name="discount_value" type="text"
                                               class="form-control" value="{{$accessory->product->discount_value??""}}"
                                               @if(!$accessory->product->discount_type)
                                                   disabled
                                            @endif
                                        >
                                    </div>

                                    <div class="col-2 d-flex align-items-end">
                                        <div class="form-check form-switch form-switch-lg mb-2" dir="ltr">
                                            <input class="form-check-input" type="checkbox" id="discount-checkbox"
                                                    @if($accessory->product->discount_type)
                                                    checked
                                                    @endif
                                            >
                                            <label class="form-check-label" for="discount-checkbox"></label>
                                        </div></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thông Số</h4>
                        @include('components.product.'.$accessoryType, ["item" => $accessory->detail])
                    </div>
                </div>

                <div class="card">
                    <div class="card-body row">
                        <div class="col-8">
                            <h4 class="card-title mb-3">Product Images</h4>
                            <div class="row">
                                <div class="col-8">
                                    <div class="gallery_container">
                                        <div id = "image_container" class="image_container property_gallery">
                                            @php
                                                $previewImgs = json_decode($accessory->product->images, true);
                                            @endphp
                                            @foreach($previewImgs as $image)
                                                <div class="image_box">
                                                    <img src="{{$image}}">
                                                    <button type="button" class="btn btn-warning btn_delete_image">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <input type="hidden" name="images[]" value="{{$image}}">
                                                </div>
                                            @endforeach
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
                        <div class="col-4">
                            <h4 class="card-title mb-3">Data Sheet</h4>

                            <textarea id="dataSheet" name="dataSheet">
                            {!! $accessory->data_sheet !!}
                        </textarea>
                        </div>
                    </div>

                </div> <!-- end card-->

                <div class="card">
                    @include("components.product.post",['item'=>$accessory->product->post])
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
