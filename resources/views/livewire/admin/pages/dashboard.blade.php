<div>

    <div class="callout bg-info border-dark mt-1">
        @if ($morning)
        <i class="fas fa-sunrise text-warning"></i> Good Morning
        @elseif($afternoon)
        <i class="fas fa-sun text-warning"></i> Good Afternoon
        @elseif($evening)
        <i class="fas fa-moon-stars text-dark"></i> Good Evening
        @else
        Have a nice day
        @endif, {{ auth()->user()->name }}
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="info-box dash elevation-3" style="height: 110px;">
                    <div class="info-box-content">
                        <span class="info-box-text" style="font-size: 11px;">ADMINS</span>
                        <span class="info-box-number">{{ $adminsCount }}</span>
                    </div>
                    <span class="info-box-icon"><i class="fa-solid fa-user-lock" style="font-size: 43px;"></i></span>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <a wire:navigate href="/admin/users" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">USERS</span>
                            <span class="info-box-number">{{ $usersCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-users" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4">
                <a wire:navigate href="/admin/products" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">PRODUCTS</span>
                            <span class="info-box-number">{{ $productsCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-box-open" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4">
                <a wire:navigate href="/admin/product-categories" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">CATEGORIES</span>
                            <span class="info-box-number">{{ $categoriesCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-list" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4">
                <a wire:navigate href="/admin/orders" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">ORDERS</span>
                            <span class="info-box-number">{{ $ordersCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-bag-shopping"
                                style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4">
                <a wire:navigate href="/admin/product-sales" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">PRODUCT SALES</span>
                            <span class="info-box-number">{{ $productSalesCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-database" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4">
                <a wire:navigate href="/admin/feedbacks" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">FEED BACKS</span>
                            <span class="info-box-number">{{ $feedbacks }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-comments" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h4>Revenue Sales Record </h4>
        <hr>
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <a href="#" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">TOTAL REVENUE</span>
                            <span class="info-box-number">&#8369;{{ number_format($grandTotal, 2, '.', ',') }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-hand-holding-dollar"
                                style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg-3">
                <a href="#" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">TODAY REVENUE</span>
                            <span class="info-box-number">&#8369;{{ number_format($todaysTotal, 2, '.', ',') }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-calendar-day"
                                style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg-3">
                <a href="#" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">
                                MONTHLY REVENUE
                            </span>
                            <span class="info-box-number">&#8369;{{ number_format($monthlyTotal, 2, '.', ',') }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-calendar-days"
                                style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg-3">
                <a href="#" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">YEARLY REVENUE</span>
                            <span class="info-box-number">&#8369;{{ number_format($yearlyTotal, 2, '.', ',') }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-calendar" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h4>Net Worth Management </h4>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <div class="position-relative mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="sales-chart" height="200" width="487"
                                style="display: block; width: 487px; height: 200px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <div class="position-relative mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="product-sales-chart" height="200" width="487"
                                style="display: block; width: 487px; height: 200px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dash {
            border-left: 8px solid #343a40;
            border-right-color: #343a40;
            transition: transform 1.05s ease;
        }

        .dark-mode .info-box.dash {
            border-color: white !important;
        }

        .dark-mode .border-dark {
            border-color: white !important;
        }

        .dash:hover {
            transform: scale(1.03);
            background-color: #343a400a;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {

        var canvas = document.getElementById("sales-chart");
        var salesData = @json($salesData);

        var chart = new Chart(canvas, {
            type: "bar",
            data: {
                labels: salesData.map(data => `Month of ${data.month}`),
                datasets: [{
                    label: "Net Worth",
                    data: salesData.map(data => data.sales),
                    backgroundColor: "#007bff"
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var productSalesData = @json($productSalesData);
        var ctx = document.getElementById('product-sales-chart').getContext('2d');
        
        var productSalesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: productSalesData.map(data => `Month of ${data.month}`),
                datasets: [{
                    label: 'Monthly Product Sales',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'red',
                    data: productSalesData.map(data => data.product_sales),
                    fill: true
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    })
    </script>
</div>