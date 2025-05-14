@extends('layouts.master')
@section('content')
    <div class="card p-3">
        <form class="mt-4 frm_search" method="GET" action="">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="mb-0">
                        <label for="search" class="form-label">Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="id" id="search" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="mb-0">
                        <label for="search" class="form-label">Trạng thái thanh toán</label>
                        <div class="input-group">
                            <select class="form-control" id="payment_status" name="payment_status">
                                <option value="" selected>Chọn trạng thái</option>
                                @foreach(\App\Models\Order::$listPaymentStatus as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-2">
                <div class="col-lg-6 col-sm-6">
                    <div class="mb-0">
                        <label for="search" class="form-label">Trạng thái đơn hàng</label>
                        <div class="input-group">
                            <select class="form-control" id="payment_status" name="order_status">
                                <option value="" selected>Chọn trạng thái</option>
                                @foreach(\App\Models\Order::$listOrderStatus as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div  id="datatable_length" class="table-responsive dataTables_length dt-bootstrap4">
                            <table id="datatable" class="table table-striped result_table">
                                <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" style="cursor: pointer;" class="check_all" />
                                    </th>
                                    <th>id</th>
                                    <th>order_status</th>
                                    <th>payment_method</th>
                                    <th>payment_status</th>
                                    <th>total_amount</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
            </div>
        </div> <!-- end col -->
    </div>
    </div>
    <script src="{{ URL::asset('build/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ URL::asset('build/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ URL::asset('build/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ URL::asset('build/libs/toastr/toastr.js')}}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>

    <script type="text/javascript" language="JavaScript">
        $(document).ready(function () {
            let columns = [
                { data: 'checkbox', sortable: false },
                { data: 'id', sortable: true },
                { data: 'order_status', sortable: true },
                { data: 'payment_method', sortable: false },
                { data: 'payment_status', sortable: true },
                { data: 'total_amount', sortable: true },
                { data: 'action', sortable: false },
            ];
            let table = $('.result_table').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                searching: false,
                ajax: {
                    url: '{{ route('order.search') }}',
                    type: 'get',
                    data: function (d) {
                        d.form = $('.frm_search').serializeArray();
                    },
                    error: function(e) {
                        showErrorValidate(e);
                    }
                },
                columns: columns,
                order: [],
                columnDefs: []
            });

            $('.frm_search').submit(function (e) {
                e.preventDefault();
                table.draw();
            });


            $('.form-control').change(function () {
                $('.frm_search').submit();
            });


            $('.btn_delete_history').click(function () {
                if (confirm("{{__('label.confirm_delete_coupon')}}")) {
                    let url = $(this).attr('data-url');
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        data: $('.frm_list').serialize(),
                        beforeSend: function () {
                            showPreload();
                        },
                        complete: function () {
                            hidePreload();
                        },
                        success: function (res) {
                            if (res.success) {
                                $('.frm_search').submit();
                                showSuccessMessage(res.message);
                            } else {
                                showErrorMessage(res.message);
                            }
                        },
                        error: function (e) {
                            showErrorValidate(e);
                        }
                    });
                }
            });

            $(document).on('click', '.check_all', function () {
                $('.check_one').prop('checked', this.checked);
                if (this.checked) {
                    $('.btn_delete_history').prop('disabled', '');
                } else {
                    $('.btn_delete_history').prop('disabled', 'disabled');
                }
            });

            $(document).on('click', '.check_one', function () {
                let $boxes = $('.check_one:checked');
                if ($boxes.length) {
                    $('.btn_delete_history').prop('disabled', '');
                } else {
                    $('.btn_delete_history').prop('disabled', 'disabled');
                }
            });
        });
    </script>

@endsection
