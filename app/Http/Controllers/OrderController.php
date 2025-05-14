<?php

namespace App\Http\Controllers;

use App\Libs\CommonLib;
use App\Models\CustomPermission;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{

    public function index()
    {
        return view('content.order.index');
    }

    public function search(Request $request)
    {
        $order = CommonLib::convertDataTableParam($request->all());
        $query = Order::id($order->id)->paymentStatus($order->payment_status)->orderStatus($order->order_status)->orderBy('created_at', 'desc');
        return DataTables::of($query)
            ->escapeColumns([])
            ->editColumn('checkbox', function ($data) {
                return '<input type="checkbox" class="check_one" style="cursor: pointer;" name="order_id[]" value="' . $data->id . '" />';
            })
            ->editColumn('id', function ($data) {
                return $data->id;
            })
            ->editColumn('order_status', function ($data) {
                return '<span style="border-radius: 5px;" class="text-white px-1 text-base ' . Order::$statusColors[$data->order_status] . '">' . Order::$listOrderStatus[$data->order_status] . '</span>';
            })
            ->editColumn('payment_method', function ($data) {
                return $data->paymentMethod->name ?? '';
            })
            ->editColumn('payment_status', function ($data) {
                return '<span style="border-radius: 5px;" class="text-white px-1 text-base ' . Order::$statusColors[$data->payment_status] . '">' . Order::$listPaymentStatus[$data->payment_status] . '</span>';
            })
            ->editColumn('total_amount', function ($data) {
                return number_format($data->total_amount, 0, ',', '.') . ' VNĐ';
            })
            ->editColumn('action', function ($data) {
                $edit = in_array(CustomPermission::getPermissionByKey('EditAnOrder'), CustomPermission::getValidPermissions())
                    ? '<a class="text-orange" href="' . route('order.edit', ['id' => $data->id]) . '"><i class="fas fa-edit"></i></a>'
                    : '';
                return $edit;

            })
            ->make(true);
    }

    public function edit($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Không tìm thấy đơn hàng');
        }
        return view('content.order.edit', ['item' => $order]);
    }
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['success' => false, 'message' => "Cập nhât thất bại, không tìm thấy đơn hàng"]);
        }
        $request->validate([
            'order_status' => 'required|in:' . implode(',', array_keys(Order::$listOrderStatus)),
            'payment_status' => 'required|in:' . implode(',', array_keys(Order::$listPaymentStatus)),
        ]);
        $order->update([
            'order_status' => $request->input('order_status'),
            'payment_status' => $request->input('payment_status'),
        ]);
        return response()->json(['success' => true, 'message' => 'Cập nhât thành công', 'url' => route('coupon.index')]);
    }
}
