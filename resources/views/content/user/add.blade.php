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
            Quản Lí Người dùng
        @endslot
        @slot('title')
            Thêm Người dùng
        @endslot
    @endcomponent
    <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" class="frm_form_add">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin người dùng</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="metatitle">email</label>
                                <input id="metatitle" name="email" type="text" class="form-control" value=""
                                       placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="metakeywords">Password</label>
                                <input id="metakeywords" name="password" type="password" class="form-control" value=""
                                       placeholder="Meta Keywords">
                            </div>
                            <div class="mb-3">
                                <label for="metakeywords">Vai trò</label>
                                {!! Form::select('role_id', ['' => 'Chọn vai trò'] + $listRole, old('role_id'), ['class' => 'form-control select2']) !!}
                            </div>
                            <div class="mb-3">
                                <label for="metakeywords">Trạng thái</label>
                                {!! Form::select('status', ['' => 'Chọn trạng thái'] + \App\Models\Admin::$listStatus, old('status'), ['class' => 'form-control select2']) !!}
                            </div>

                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="name" class="form-label">Avatar</label><br>
                            <input type="hidden" name="avatar" id="image_label">
                            <div class="row justify-content-center">
                                <img id="img_preview" src="{{ asset('build/images/default-preview-img.jpg') }}" ><br>
                                <div class="mt-2 text-center text-white bold p-2" type="button" id="button-image" style="background-color: #0d6efd; width: 30%;"> Chọn ảnh</div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
        <div class="w-100 d-flex justify-content-center">
            <div class="d-flex flex-wrap ">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Lưu</button>
            </div>
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
        function addImage(){
            inputId='';
                html=`
                    <div class="border rounded">
                        <div class="d-flex p-2">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm bg-light rounded">
                                    <img data-dz-thumbnail class="img-fluid rounded d-block" id="img_preview-${countInputId}"
                                         src=""
                                         alt="Dropzone-Image">
                                    <input type="hidden" name="images[]" value="">
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
                `;
                inputId=countInputId.toString();
                countInputId++;
                console.log(inputId);
                const previewList = document.getElementById('preview-list');
                previewList.insertAdjacentHTML('beforeend', html);
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');

        }
    </script>
@endsection
