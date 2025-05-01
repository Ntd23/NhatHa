@extends('admin.layout.app')
@section('css')
<style>
    .page-wrapper {
        background-color: #f5f5f5;
        color: #333;
    }

    .dash-widget {
        background: linear-gradient(135deg, #ffeb3b, #ffca28);
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .dash-widget-bg1,
    .dash-widget-bg2,
    .dash-widget-bg3,
    .dash-widget-bg4 {
        background-color: #fff;
        color: #333;
    }

    .widget-title1,
    .widget-title2,
    .widget-title3,
    .widget-title4 {
        color: #333;
    }

    .card {
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .chart-title h4,
    .chat-user-total li {
        color: #333;
    }

    .chart-container {
        position: relative;
        width: 100%;
        height: 400px;
        padding: 20px;
    }

    .chart-title {
        padding: 15px 0;
        border-bottom: 1px solid #ddd;
    }

    .chart-title h4 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .chart-title .total-amount {
        font-size: 1.2rem;
        font-weight: 500;
    }

    .chat-user-total li i {
        margin-right: 5px;
    }

    .chat-user-total li {
        display: flex;
        align-items: center;
    }

    /* Tinh chỉnh nhỏ cho màn hình nhỏ */
    .dash-widget h3 {
        font-size: 1.8rem;
    }

    .widget-title1,
    .widget-title2,
    .widget-title3,
    .widget-title4 {
        font-size: 1rem;
    }

    .chart-title .form-control {
        width: 100px;
    }
</style>
@endsection
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-12 col-sm-6 mb-4">
                <div class="dash-widget">
                    <span class="dash-widget-bg1"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{ $TotalOrder }}</h3>
                        <span class="widget-title1">Đơn hàng<i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-4">
                <div class="dash-widget">
                    <span class="dash-widget-bg2"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{ $TotalTodayOrder }}</h3>
                        <span class="widget-title2">Đơn hàng trong ngày<i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-4">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fa fa-dollar" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>@money($TotalAmount)</h3>
                        <span class="widget-title3">Doanh thu<i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-4">
                <div class="dash-widget">
                    <span class="dash-widget-bg4"><i class="fa fa-dollar" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>@money($TotalTodayAmount)</h3>
                        <span class="widget-title4">Doanh thu trong ngày<i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-4">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fa fa-users" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{ $TotalCustomer }}</h3>
                        <span class="widget-title3">Khách hàng<i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-4">
                <div class="dash-widget">
                    <span class="dash-widget-bg4"><i class="fa fa-users" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{ $TotalTodayCustomer }}</h3>
                        <span class="widget-title4">Khách hàng trong ngày<i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <h4 class="mb-0 mr-3">Thống kê doanh thu</h4>
                                <select class="form-control ChangeYear">
                                    @for ($i = 2024; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" @selected($i == $year)>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="d-flex flex-wrap align-items-center">
                                <span class="total-amount mr-3 mb-2 mb-md-0">@money($totalAmount)</span>
                                <ul class="chat-user-total list-unstyled d-flex flex-wrap mb-0">
                                    <li class="mr-3 mb-6"><i class="fa fa-circle current-users" aria-hidden="true"></i> Khách hàng</li>
                                    <li class="mr-3 mb-6"><i class="fa fa-circle old-users" aria-hidden="true"></i> Đơn hàng</li>
                                    <li class="mb-6"><i class="fa fa-circle total-users" aria-hidden="true"></i> Tổng</li>
                                </ul>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="sales-chart-order"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
				<div class="row">
					<div class="col-12">
						<div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>Số đơn hàng</th>
                  <th style="min-width: 150px;">Khách hàng</th>
                  <th style="min-width: 130px;">Quốc gia</th>
                  <th style="min-width: 130px;">Địa chỉ</th>
                  <th style="min-width: 130px;">Thành phố</th>
                  <th style="min-width: 130px;">Quận/Huyện</th>
                  <th style="min-width: 130px;">Mã bưu điện</th>
                  <th style="min-width: 130px;">Điện thoại</th>
                  <th style="min-width: 130px;">Email</th>
                  <th>Mã giảm giá</th>
                  <th style="min-width: 130px;">Đã giảm</th>
                  <th style="min-width: 130px;">Phí giao hàng</th>
                  <th style="min-width: 130px;">Thành tiền</th>
                  <th style="min-width: 130px;">Thanh toán</th>
                  <th style="min-width: 130px;">Ngày đặt</th>
                  <th>Tác vụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getLatestOrders as $value)
                  <tr>
                    <td>{{ $value->order_number }}</td>
                    <td>{{ $value->last_name . ' ' . $value->first_name }}</td>
                    <td>{{ $value->country }}</td>
                    <td>{{ $value->address_one }} </br> {{ $value->address_two }}</td>
                    <td>{{ $value->city }}</td>
                    <td>{{ $value->district }}</td>
                    <td>{{ $value->postcode }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->discount_code }}</td>
                    <td>@money($value->discount_amount)</td>
                    <td>@money($value->shipping_amount)</td>
                    <td>@money($value->total_amount)</td>
                    <td>{{ $value->payment_method }}</td>
                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('admin.order.detail', $value->id) }}"><i
                          class="fa fa-eye m-r-5"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
					</div>
				</div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.ChangeYear').change(function() {
        var year = $(this).val();
        window.location.href = '{{ route('admin.dashboard') }}' + `?year=${year}`;
    });

    var ticksStyle = {
        fontColor: '#333',
        fontStyle: 'bold'
    };

    var mode = 'index';
    var intersect = true;
    var $salesChart = $('#sales-chart-order');

    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    backgroundColor: '#ffca28',
                    borderColor: '#ffca28',
                    data: [{{ $getTotalCustomerMonth }}],
                    label: 'Khách hàng',
                    barThickness: 'flex', // Tự động điều chỉnh độ dày
                },
                {
                    backgroundColor: '#4caf50',
                    borderColor: '#4caf50',
                    data: [{{ $getTotalOrderMonth }}],
                    label: 'Đơn hàng',
                    barThickness: 'flex',
                },
                {
                    backgroundColor: '#e91e63',
                    borderColor: '#e91e63',
                    data: [{{ $getTotalOrderAmountMonth }}],
                    label: 'Tổng',
                    barThickness: 'flex',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        var value = tooltipItem.yLabel;
                        if (label === 'Khách hàng') {
                            return label + ': ' + value.toLocaleString('vi-VN');
                        } else if (label === 'Đơn hàng') {
                            return label + ': ' + value.toLocaleString('vi-VN');
                        } else {
                            return label + ': ' + value.toLocaleString('vi-VN') + ' VND';
                        }
                    }
                }
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: '#333',
                    padding: 20,
                    usePointStyle: true,
                    boxWidth: 10,
                    fontSize: 12
                },
                onClick: function() {
                    return false;
                }
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.1)',
                        zeroLineColor: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + ' VND';
                        },
                        fontSize: 12
                    }, ticksStyle)
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: $.extend({
                        fontSize: 12,
                        callback: function(value, index) {
                            // Rút gọn tên tháng trên màn hình nhỏ
                            return window.innerWidth <= 768 ? value.substring(0, 3) : value;
                        }
                    }, ticksStyle)
                }]
            }
        }
    });

    window.addEventListener('resize', function() {
        salesChart.resize();
    });
</script>
@endsection
