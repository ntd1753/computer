@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column flex-sm-row align-items-center mt-4">
        <h2 class="text-lg font-medium mr-auto">
            Chi tiết đơn hàng
        </h2>

    </div>

    <div class="row mt-5">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body rounded-md fs-6 " >
                    <div class="pb-3" style="border-bottom: 1px solid #e4e7ec;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <div class="fw-medium fs-3 truncate">Thông tin đơn hàng</div>
                        <a href="#" class="flex items-center ml-auto text-primary" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit"
                                 data-lucide="edit" class="lucide lucide-edit w-4 h-4 mr-2">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Chỉnh sửa </a>
                    </div>
                    <div class="d-flex mt-3">
                        <i data-lucide="clipboard" class="w-4 h-4"></i>
                        Mã đơn: <span class="ms-1">{{$item->id}}</span> </div>
                    <div class="d-flex mt-3">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        ngày khởi tạo: {{$item->created_at}} </div>
                    <div class="d-flex mt-3">
                        <i data-lucide="clock" class="w-4 h-4"></i> Trạng thái:
                        <span class="bg-success/20 rounded px-2 ml-1">{{\App\Models\Order::$listOrderStatus[$item->order_status]}}</span>
                    </div>
                    <div class="d-flex mt-3 pb-3" style="border-bottom: 1px solid #e4e7ec;">
                        <i data-lucide="book-open" class="w-4 h-4"></i>
                        Ghi chú: <span class="">@if(is_null($item->note)) Không có @else{{$item->note}} @endif</span> </div>
                </div>
                <div class="card-body rounded-md fs-6 ">
                    <div class="pb-3" style="border-bottom: 1px solid #e4e7ec;">
                        <div class="fw-medium fs-3 truncate">Thông tin khách hàng</div>
                    </div>
                    <div class="d-flex mt-3"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="clipboard" data-lucide="clipboard" class="lucide lucide-clipboard w-4 h-4 text-slate-500 mr-2"><path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Name: <span class="underline decoration-dotted ms-1">{{$item->user->name}}</span> </div>
                    <div class="d-flex mt-3"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="clipboard" data-lucide="clipboard" class="lucide lucide-clipboard w-4 h-4 text-slate-500 mr-2"><path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Email: <span class="underline decoration-dotted ms-1">{{$item->user->email}}</span> </div>
                    <div class="d-flex mt-3"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="calendar" data-lucide="calendar" class="lucide lucide-calendar w-4 h-4 text-slate-500 mr-2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Phone Number: {{$item->customer_phone}} </div>
                    <div class="d-flex mt-3 pb-3" style="border-bottom: 1px solid #e4e7ec;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="map-pin" data-lucide="map-pin" class="lucide lucide-map-pin w-4 h-4 text-slate-500 mr-2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> Address: {{$item->customer_address}} </div>
                </div>
                <div class="card-body rounded-md fs-6 ">
                    <div class="pb-3" style="border-bottom: 1px solid #e4e7ec;">
                        <div class="fw-medium fs-3 truncate">Phương thức thanh toán</div>
                    </div>
                    <div class="d-flex mt-3 align-items-center" >
                        <span class="fs-3"><i class="bx bx-clipboard" style="width: 20px;"></i></span>
                        Phương tức thanh toán:
                        <div class="ms-2">Thanh toán khi nhận hàng</div>
                    </div>
                    <div class="d-flex mt-3  align-items-center">
                        <span class="fs-3"> <i class="bx bx-clipboard"></i></span>
                        Đơn giá ({{count($item->orderItems)}} sản phẩm):
                        <div class="ms-auto">{{number_format($item->total,0,',','.')}}VNĐ</div>
                    </div>

                    <div class="d-flex mt-3  align-items-center">
                        <span class="fs-3"> <i class="bx bx-credit-card-alt"></i></span>
                        Tổng cộng:
                        <div class="ms-auto">{{number_format($item->total_amount,0,',','.')}}VNĐ</div>

            </div>


        </div>
            </div>
            </div>
        <div class="col-xl-8 ">
            <div class="box p-5 rounded-md card">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Chi tiết đơn hàng</div>
                </div>
                <div class="overflow-auto lg:overflow-visible -mt-3">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="whitespace-nowrap !py-5">Sản Phẩm</th>
                            <th class="whitespace-nowrap text-right">Đơn giá</th>
                            <th class="whitespace-nowrap text-right">SL</th>
                            <th class="whitespace-nowrap text-right">Tổng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('content.order.order_items_row_table',['orderItems'=>$item->orderItems])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thông tin đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form   class="frm_form_add">
                    <div class="modal-body">
                        <div  class="fs-3 my-1">Trạng thái</div>
                        <div class="mb-3">
                            <label for="parent-category-input" class="form-label">Trạng thái đơn hàng</label>
                            <select class="form-control select2" id="parent-category-input" name="order_status">
                                <option value="">Chọn trạng thái</option>
                                @foreach(\App\Models\Order::$listOrderStatus as $key=>$orderStatus)
                                    <option value="{{$key}}" @if($item->order_status == $key) selected @endif>{{$orderStatus}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="parent-category-input" class="form-label">Trạng thái thanh toán</label>
                            <select class="form-control select2" id="parent-category-input" name="payment_status">
                                <option value="">Chọn trạng thái</option>
                                @foreach(\App\Models\Order::$listPaymentStatus as $key=>$paymentStatus)
                                    <option value="{{$key}}" @if($item->payment_status == $key) selected @endif>{{$paymentStatus}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="border-bottom: 1px solid #f2f2f5;"></div>
                        <div class="fs-3 my-1">Thông tin khách hàng</div>
                        <div class="mb-3">
                            <label for="projectname-input" class="form-label">Email khách hàng</label>
                            <input id="projectname-input" name="email" type="text" class="form-control"
                                   placeholder="" value="{{$item->customer_email}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="projectname-input" class="form-label">Tên khách hàng</label>
                            <input id="projectname-input" name="name" type="text" class="form-control"
                                   placeholder="" value="{{$item->customer_name}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="projectname-input" class="form-label">Số điện thoại</label>
                            <input id="projectname-input" name="phone" type="text" class="form-control"
                                   placeholder="" value="{{$item->customer_phone}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="projectname-input" class="form-label">Địa chỉ</label>
                            <input id="projectname-input" name="phone" type="text" class="form-control"
                                   placeholder="" value="{{$item->customer_address}}" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.frm_form_add').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: {{ route('order.update', $item->id) }},
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
