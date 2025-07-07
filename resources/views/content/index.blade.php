@extends('layouts.master')

@section('title') @lang('translation.Saas') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Thống kê @endslot
        @slot('title') Thống kê @endslot
    @endcomponent


    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                    <i class="bx bx-copy-alt"></i>
                                </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Đơn hàng mới</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$newOrder}} <i class="mdi @if($orderGrowRate>=0) mdi-chevron-up @else mdi-chevron-down @endif  ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge @if($orderGrowRate>=0) badge-soft-success @else badge-soft-danger @endif  font-size-12"> {{round($orderGrowRate, 2)}}% </span> <span class="ms-2 text-truncate">So với tháng trước</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                    <i class="bx bx-archive-in"></i>
                                </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Doanh thu</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{number_format($revenue, 0, ',', '.')}} VNĐ <i class="mdi @if($revenueGrowRate>=0) mdi-chevron-up @else mdi-chevron-down @endif ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge @if($revenueGrowRate>=0) badge-soft-success @else badge-soft-danger @endif font-size-12"> {{round($revenueGrowRate, 2)}}% </span> <span class="ms-2 text-truncate">So với tháng trước</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- end row -->
        </div>
    </div>

    <div class="row gap-2 flex justify-content">
        <div class="col-lg-12 card p-2">
            <h4 class="card-title mb-4">Biểu đồ Doanh Thu Theo Tháng</h4>
            <canvas id="revenueChart" width="400" height="200"></canvas>
        </div>
        <div class="col-lg-12 card p-2">
            <h4 class="card-title mb-4">Biểu đồ cột phân tích top 10 sản phẩm bán chạy</h4>
            <canvas id="productRevenueChart" width="400" height="200"></canvas>
        </div>

    </div>


@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Saas dashboard init -->
    <script src="{{ URL::asset('build/js/pages/saas-dashboard.init.js') }}"></script>
    <script>
        // Dữ liệu doanh thu theo tháng từ controller
        var months = @json($chartRevenueMonths);
        var totalRevenue = @json($chartRevenueTotalRevenue);

        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx, {
            type: 'line', // Loại biểu đồ, ở đây dùng biểu đồ đường (line)
            data: {
                labels: months, // Tháng
                datasets: [{
                    label: 'Doanh Thu',
                    data: totalRevenue, // Doanh thu của từng tháng
                    borderColor: 'rgba(75, 192, 192, 1)', // Màu sắc của đường biểu đồ
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Màu nền của điểm
                    fill: true,
                    tension: 0.1, // Làm mềm đường cong
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString(); // Định dạng số liệu
                            }
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return '₫ ' + tooltipItem.raw.toLocaleString(); // Định dạng tooltip với đồng tiền
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        var products = @json($chartProductSaleProducts); // Tên sản phẩm
        var quantities = @json($chartProductSaleProductQuantities); // Số lượng bán của từng sản phẩm

        var ctx = document.getElementById('productRevenueChart').getContext('2d');
        var productRevenueChart = new Chart(ctx, {
            type: 'bar', // Loại biểu đồ: thanh (bar)
            data: {
                labels: products, // Tên sản phẩm
                datasets: [
                    {
                        label: 'Số lượng bán',
                        data: quantities, // Số lượng bán của từng sản phẩm
                        backgroundColor: 'rgba(75, 192, 192, 0.6)', // Màu nền
                        borderColor: 'rgba(75, 192, 192, 1)', // Màu đường biên
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString(); // Định dạng số liệu
                            }
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw.toLocaleString(); // Định dạng tooltip với số lượng
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection


