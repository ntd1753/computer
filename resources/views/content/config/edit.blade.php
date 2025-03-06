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
            Cấu hình website
        @endslot
        @slot('title')
            Chỉnh sửa
        @endslot
    @endcomponent

    <form id="brand-frm" method="POST" action="{{route("config.update")}}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class=" col-sm-6 preview" style="display: block;">
                                <div>
                                    <label for="regular-form-1" class="form-label">Tên Doanh Nghiệp:</label>
                                    <input id="regular-form-1" type="text" class="form-control" placeholder="Input text" name="company_name" value="{{config('website.company_name')}}">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-2" class="form-label">Mã số thuế:</label>
                                    <input id="regular-form-2" type="text" class="form-control" placeholder="Rounded" name="tax_code" value="{{config('website.business_registration.tax_code')}}">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-3" class="form-label">Nơi cấp Mã số thuế:</label>
                                    <input id="regular-form-3" type="text" class="form-control" name="issued_by"  value="{{config('website.business_registration.issued_by')}}">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-4" class="form-label">Ngày cấp:</label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="Password" name="issued_date" value="{{config('website.business_registration.issued_date')}}">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-4" class="form-label">Zalo:</label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="Password" name="zalo" value="{{config('website.contact.zalo')}}">
                                </div>
                            </div>

                            <div class="col-sm-6  preview">
                                <div>
                                    <label for="regular-form-1" class="form-label">Hotline:</label>
                                    <input id="regular-form-1" type="text" class="form-control" placeholder="Input text" name="hotline" value="{{config('website.contact.hotline')}}">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Email</label>
                                    <input id="regular-form-1" type="text" class="form-control" placeholder="Input text" name="email" value="{{config('website.contact.email')}}">
                                </div >
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Facebook</label>
                                    <input id="regular-form-1" type="text" class="form-control" placeholder="Input text" name="facebook" value="{{config('website.social_links.facebook')}}">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Twitter</label>
                                    <input id="regular-form-1" type="text" class="form-control" placeholder="Input text" name="twitter" value="{{config('website.social_links.twitter')}}">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Instagram</label>
                                    <input id="regular-form-1" type="text" class="form-control" placeholder="Input text" name="instagram" value="{{config('website.social_links.instagram')}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-span-2">
                            <div>
                                <label for="regular-form-1" class="form-label">Mô tả:</label>
                                <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ config('website.contact.description') }}</textarea>
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
