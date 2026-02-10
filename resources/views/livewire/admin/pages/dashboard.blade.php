<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-info">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-white p-3 me-3">
                            @if ($morning)
                            <i class="fa-solid fa-sunrise text-warning fa-2x"></i>
                            @elseif($afternoon)
                            <i class="fa-solid fa-sun text-warning fa-2x"></i>
                            @elseif($evening)
                            <i class="fa-solid fa-moon-stars text-dark fa-2x"></i>
                            @else
                            <i class="fa-solid fa-star text-primary fa-2x"></i>
                            @endif
                        </div>
                        <div>
                            <h2 class="card-title text-white mb-1">
                                @if ($morning)
                                Good Morning
                                @elseif($afternoon)
                                Good Afternoon
                                @elseif($evening)
                                Good Evening
                                @else
                                Have a nice day
                                @endif, {{ auth()->user()->name }}
                            </h2>
                            <p class="text-white-50 mb-0">Welcome to your dashboard</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="card-title mb-0 text-dark">Overview</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-3 border-left-primary h-100 shadow-sm hover-shadow-lg transition-all">
                                <div class="d-flex align-items-center justify-content-between p-4">
                                    <div>
                                        <div class="text-muted small text-uppercase fw-bold">ADMINS</div>
                                        <div class="fw-bold display-6 text-dark">{{ $adminsCount }}</div>
                                    </div>
                                    <div class="icon-circle bg-primary bg-opacity-10 p-3">
                                        <i class="fa-solid fa-user-lock text-primary fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a wire:navigate href="/admin/users" class="text-decoration-none">
                                <div class="card border-left-3 border-left-success h-100 shadow-sm hover-shadow-lg transition-all">
                                    <div class="d-flex align-items-center justify-content-between p-4">
                                        <div>
                                            <div class="text-muted small text-uppercase fw-bold">USERS</div>
                                            <div class="fw-bold display-6 text-dark">{{ $usersCount }}</div>
                                        </div>
                                        <div class="icon-circle bg-success bg-opacity-10 p-3 float-end">
                                            <i class="fa-solid fa-users text-success fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a wire:navigate href="/admin/products" class="text-decoration-none">
                                <div class="card border-left-3 border-left-warning h-100 shadow-sm hover-shadow-lg transition-all">
                                    <div class="d-flex align-items-center justify-content-between p-4">
                                        <div>
                                            <div class="text-muted small text-uppercase fw-bold">PRODUCTS</div>
                                            <div class="fw-bold display-6 text-dark">{{ $productsCount }}</div>
                                        </div>
                                        <div class="icon-circle bg-warning bg-opacity-10 p-3">
                                            <i class="fa-solid fa-box-open text-warning fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a wire:navigate href="/admin/product-categories" class="text-decoration-none">
                                <div class="card border-left-3 border-left-info h-100 shadow-sm hover-shadow-lg transition-all">
                                    <div class="d-flex align-items-center justify-content-between p-4">
                                        <div>
                                            <div class="text-muted small text-uppercase fw-bold">CATEGORIES</div>
                                            <div class="fw-bold display-6 text-dark">{{ $categoriesCount }}</div>
                                        </div>
                                        <div class="icon-circle bg-info bg-opacity-10 p-3">
                                            <i class="fa-solid fa-list text-info fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a wire:navigate href="/admin/orders" class="text-decoration-none">
                                <div class="card border-left-3 border-left-danger h-100 shadow-sm hover-shadow-lg transition-all">
                                    <div class="d-flex align-items-center justify-content-between p-4">
                                        <div>
                                            <div class="text-muted small text-uppercase fw-bold">ORDERS</div>
                                            <div class="fw-bold display-6 text-dark">{{ $ordersCount }}</div>
                                        </div>
                                        <div class="icon-circle bg-danger bg-opacity-10 p-3">
                                            <i class="fa-solid fa-bag-shopping text-danger fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a wire:navigate href="/admin/product-sales" class="text-decoration-none">
                                <div class="card border-left-3 border-left-purple h-100 shadow-sm hover-shadow-lg transition-all">
                                    <div class="d-flex align-items-center justify-content-between p-4">
                                        <div>
                                            <div class="text-muted small text-uppercase fw-bold">PRODUCT SALES</div>
                                            <div class="fw-bold display-6 text-dark">{{ $productSalesCount }}</div>
                                        </div>
                                        <div class="icon-circle bg-purple bg-opacity-10 p-3">
                                            <i class="fa-solid fa-database text-purple fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a wire:navigate href="/admin/feedbacks" class="text-decoration-none">
                                <div class="card border-left-3 border-left-teal h-100 shadow-sm hover-shadow-lg transition-all">
                                    <div class="d-flex align-items-center justify-content-between p-4">
                                        <div>
                                            <div class="text-muted small text-uppercase fw-bold">FEED BACKS</div>
                                            <div class="fw-bold display-6 text-dark">{{ $feedbacks }}</div>
                                        </div>
                                        <div class="icon-circle bg-teal bg-opacity-10 p-3">
                                            <i class="fa-solid fa-comments text-teal fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="card-title mb-0 text-dark">Revenue Sales Record</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-0 bg-gradient-primary text-white shadow-lg h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-white-50 small">TOTAL REVENUE</div>
                                            <div class="fw-bold display-6">&#8369;{{ number_format($grandTotal, 2, '.', ',') }}</div>
                                        </div>
                                        <div class="icon-circle bg-white bg-opacity-20 p-3">
                                            <i class="fa-solid fa-hand-holding-dollar fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-0 bg-gradient-success text-white shadow-lg h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-white-50 small">TODAY REVENUE</div>
                                            <div class="fw-bold display-6">&#8369;{{ number_format($todaysTotal, 2, '.', ',') }}</div>
                                        </div>
                                        <div class="icon-circle bg-white bg-opacity-20 p-3">
                                            <i class="fa-solid fa-calendar-day fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-0 bg-gradient-warning text-white shadow-lg h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-white-50 small">MONTHLY REVENUE</div>
                                            <div class="fw-bold display-6">&#8369;{{ number_format($monthlyTotal, 2, '.', ',') }}</div>
                                        </div>
                                        <div class="icon-circle bg-white bg-opacity-20 p-3">
                                            <i class="fa-solid fa-calendar-days fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-0 bg-gradient-info text-white shadow-lg h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-white-50 small">YEARLY REVENUE</div>
                                            <div class="fw-bold display-6">&#8369;{{ number_format($yearlyTotal, 2, '.', ',') }}</div>
                                        </div>
                                        <div class="icon-circle bg-white bg-opacity-20 p-3">
                                            <i class="fa-solid fa-calendar fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="card-title mb-0 text-dark">Net Worth Management</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card border-0 h-100 shadow-sm">
                                <div class="card-header bg-white border-0">
                                    <h5 class="card-title mb-0">Sales Overview</h5>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative">
                                        <canvas id="sales-chart" height="250"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card border-0 h-100 shadow-sm">
                                <div class="card-header bg-white border-0">
                                    <h5 class="card-title mb-0">Product Sales Trend</h5>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative">
                                        <canvas id="product-sales-chart" height="250"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-left-3 {
            border-left-width: 4px !important;
        }
        .border-left-purple {
            border-left-color: #6f42c1 !important;
        }
        .border-left-teal {
            border-left-color: #20c997 !important;
        }
        .bg-purple {
            background-color: #6f42c1 !important;
        }
        .bg-teal {
            background-color: #20c997 !important;
        }
        .icon-circle {
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .transition-all {
            transition: all 0.3s ease;
        }
        .hover-shadow-lg:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }
        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        }
        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
        }
        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
        }
        .bg-gradient-danger {
            background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%) !important;
        }
        .display-6 {
            font-size: 2rem;
            font-weight: 600;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            var canvas = document.getElementById("sales-chart");
            var salesData = @json($salesData);
            var chart = new Chart(canvas, {
                type: "bar",
                data: {
                    labels: salesData.map(data => `${data.month}`),
                    datasets: [{
                        label: "Net Worth",
                        data: salesData.map(data => data.sales),
                        backgroundColor: "rgba(0, 123, 255, 0.8)",
                        borderColor: "rgba(0, 123, 255, 1)",
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            var productSalesData = @json($productSalesData);
            var ctx = document.getElementById('product-sales-chart').getContext('2d');
            var productSalesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: productSalesData.map(data => `${data.month}`),
                    datasets: [{
                        label: 'Monthly Product Sales',
                        backgroundColor: 'rgba(255, 99, 132, 0.1)',
                        borderColor: 'rgba(220, 53, 69, 1)',
                        borderWidth: 3,
                        pointBackgroundColor: 'rgba(220, 53, 69, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        data: productSalesData.map(data => data.product_sales),
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>
