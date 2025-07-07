<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected function chartProductSale()
    {
        // Truy vấn 10 sản phẩm bán chạy nhất (chỉ lấy số lượng)
        $productSales = OrderItem::selectRaw('product_id, SUM(quantity) as total_quantity')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.order_status', 'completed')  // Lọc theo đơn đã hoàn thành
            ->groupBy('product_id')
            ->orderByDesc('total_quantity') // Sắp xếp giảm dần theo số lượng
            ->limit(10) // Chỉ lấy 10 sản phẩm bán chạy nhất
            ->get();

// Truy vấn tên sản phẩm (có thể truy vấn từ bảng products)
        $products = [];
        $quantities = [];

        foreach ($productSales as $sale) {
            $product = Product::find($sale->product_id); // Truy vấn tên sản phẩm từ bảng products
            $products[] = $product->name; // Lấy tên sản phẩm
            $quantities[] = $sale->total_quantity; // Tổng số lượng bán được
        }

        return [
            'products' => $products,
            'quantities' => $quantities,
        ];

    }

    protected function chartRevenue()
    {
        $revenues = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_amount) as total_revenue')
            ->where('order_status', Order::ORDER_STATUS_COMPLETED)  // Lọc theo đơn đã hoàn thành
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $months = [];
        $totalRevenue = [];

        // Chuẩn bị dữ liệu để truyền vào view
        foreach ($revenues as $revenue) {
            $months[] = $revenue->year . '-' . str_pad($revenue->month, 2, '0', STR_PAD_LEFT); // Tạo định dạng năm-tháng
            $totalRevenue[] = $revenue->total_revenue; // Doanh thu theo tháng
        }
        return [
            'months' => $months,
            'total_revenue' => $totalRevenue,
        ];
    }
    protected function getGrowthRateOrder(){
        $currentMonth = Carbon::now()->format('Y-m');
        $lastMonth = Carbon::now()->subMonth()->format('Y-m');
        $currentMonthTotal = DB::table('orders')
            ->where('created_at', 'like', $currentMonth . '%')
            ->count();

        $lastMonthTotal = DB::table('orders')
            ->where('created_at', 'like', $lastMonth . '%')
            ->count();
        if ($lastMonthTotal > 0) {
            $growthRate = (($currentMonthTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
        } else {
            $growthRate = 100; // Nếu tháng trước không có đơn, coi như tăng trưởng 100%
        }

        return $growthRate;
    }
    protected function getGrowthRateRevenue(){
        $currentMonth = Carbon::now()->format('Y-m');
        $lastMonth = Carbon::now()->subMonth()->format('Y-m');
        $currentMonthTotal = DB::table('orders')->where('order_status', Order::ORDER_STATUS_COMPLETED)
            ->where('created_at', 'like', $currentMonth . '%')
            ->sum('total');

        $lastMonthTotal = DB::table('orders')->where('order_status', Order::ORDER_STATUS_COMPLETED)
            ->where('created_at', 'like', $lastMonth . '%')
            ->sum('total_amount');
        if ($lastMonthTotal > 0) {
            $growthRate = (($currentMonthTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
        } else {
            $growthRate = 100; // Nếu tháng trước không có đơn, coi như tăng trưởng 100%
        }

        return $growthRate;
    }

    public function index(){
        $currentMonth = Carbon::now()->format('Y-m');
        return view('content.index',
            [

                'newOrder'=>Order::where('created_at', 'like', $currentMonth . '%')->count(),
                'orderGrowRate'=>$this->getGrowthRateOrder(),
                'revenue'=>Order::where('created_at', 'like', $currentMonth . '%')->where('order_status', Order::ORDER_STATUS_COMPLETED)->sum('total_amount'),
                'revenueGrowRate'=>$this->getGrowthRateRevenue(),
                'chartRevenueMonths' => $this->chartRevenue()['months'],
                'chartRevenueTotalRevenue' => $this->chartRevenue()['total_revenue'],
                'chartProductSaleProducts' => $this->chartProductSale()['products'],
                'chartProductSaleProductQuantities' => $this->chartProductSale()['quantities'],
            ]);
    }
    public function getRevenueByMonth(Request $request)
    {
        $month = $request->get('month', Carbon::now()->month); // Lấy tháng từ request, mặc định là tháng hiện tại
        $year = $request->get('year', Carbon::now()->year);   // Lấy năm từ request, mặc định là năm hiện tại

        // Truy vấn doanh thu của tháng và năm được chọn
        $revenues = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_revenue')
            ->whereYear('created_at', $year)  // Lọc theo năm
            ->whereMonth('created_at', $month) // Lọc theo tháng
            ->where('order_status', 'completed') // Chỉ lấy đơn hàng đã hoàn thành
            ->groupBy('month')
            ->first();

        // Nếu không có dữ liệu, trả về 0
        $totalRevenue = $revenues ? $revenues->total_revenue : 0;

        // Truy vấn doanh thu theo từng tháng trong năm
        $revenuesByYear = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_revenue')
            ->whereYear('created_at', $year)
            ->where('order_status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Dữ liệu cho biểu đồ
        $months = [];
        $monthlyRevenues = [];
        foreach ($revenuesByYear as $revenue) {
            $months[] = $revenue->month;
            $monthlyRevenues[] = $revenue->total_revenue;
        }

        // Trả về dữ liệu dạng JSON
        return response()->json([
            'months' => $months,
            'monthlyRevenues' => $monthlyRevenues,
            'totalRevenue' => $totalRevenue
        ]);
    }
}
