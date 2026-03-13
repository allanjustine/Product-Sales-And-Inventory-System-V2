<div>
    <!-- Main Card -->
    <div class="card card-primary card-outline shadow-lg" id="product-table">
        <div class="card-header bg-gradient-success text-white">
            <h5 class="card-title font-weight-bold mb-0">
                <i class="fas fa-chart-line mr-2"></i>Sales Report & Analytics
            </h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="refresh" wire:click="$refresh">
                    <i class="fas fa-sync-alt text-white"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Filter Section -->
            <div class="row mb-4 align-items-center">
                <div class="col-md-2">
                    <div class="d-flex align-items-center bg-light p-2 rounded">
                        <label class="mr-2 mb-0 font-weight-bold">Show:</label>
                        <select wire:model.live="perPage" class="form-control form-control-sm w-auto border-0 bg-white">
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <span class="ml-2 text-muted">entries</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="search" class="form-control"
                            placeholder="Search by transaction code, buyer, product..."
                            wire:model.live.debounce.300ms="search">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="d-flex">
                        <div class="input-group mr-2" style="width: 200px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <select name="product_category" id="product_category" class="form-control"
                                wire:model.live="date_filter">
                                <option value="All">📅 All Time</option>
                                <option value="Today">📆 Today</option>
                                <option value="Yesterday">📆 Yesterday</option>
                                <option value="This week">📅 This Week</option>
                                <option value="Last week">📅 Last Week</option>
                                <option value="This month">📅 This Month</option>
                                <option value="Last month">📅 Last Month</option>
                                <option value="This year">📅 This Year</option>
                                <option value="Last year">📅 Last Year</option>
                            </select>
                        </div>
                        <button class="btn btn-success flex-grow-1" wire:click="downloadPdf">
                            <i class="fas fa-file-pdf mr-2"></i> Export PDF
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sales Table -->
            <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="bg-gradient-success text-white" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th class="align-middle" wire:click="handleSortBy('transaction_code')"
                                style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-hashtag mr-2"></i>Transaction Code
                                    @if ($sortBy === 'transaction_code')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle" wire:click="handleSortBy('name')" style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-user mr-2"></i>Buyer
                                    @if ($sortBy === 'name')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle text-capitalize" wire:click="handleSortBy('product_name')"
                                style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-box mr-2"></i>Product
                                    @if ($sortBy === 'product_name')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle text-right" wire:click="handleSortBy('order_price')"
                                style="cursor: pointer;">
                                <span class="d-flex align-items-center justify-content-end">
                                    Price
                                    @if ($sortBy === 'order_price')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle text-center" wire:click="handleSortBy('order_quantity')"
                                style="cursor: pointer;">
                                <span class="d-flex align-items-center justify-content-center">
                                    Qty
                                    @if ($sortBy === 'order_quantity')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle text-center">Color & Size</th>
                            <th class="align-middle text-right" wire:click="handleSortBy('order_total_amount')"
                                style="cursor: pointer;">
                                <span class="d-flex align-items-center justify-content-end">
                                    Total
                                    @if ($sortBy === 'order_total_amount')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle" wire:click="handleSortBy('order_payment_method')"
                                style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-credit-card mr-2"></i>Payment
                                    @if ($sortBy === 'order_payment_method')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle" wire:click="handleSortBy('orders.created_at')"
                                style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-calendar mr-2"></i>Date
                                    @if ($sortBy === 'orders.created_at')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="align-middle">
                                <td>
                                    <span class="badge badge-light p-2 font-weight-bold">
                                        {{ $order->transaction_code }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-success rounded-circle mr-2 d-flex align-items-center justify-content-center"
                                            style="width: 35px; height: 35px;">
                                            @if ($order->user->profile_image)
                                                <img src="{{ Storage::url($order->user->profile_image) }}"
                                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;"
                                                    alt="">
                                            @else
                                                <span class="text-white font-weight-bold">
                                                    {{ substr($order->user->name, 0, 2) }}
                                                </span>
                                            @endif
                                        </div>
                                        <span class="font-weight-medium">{{ $order->user->name }}</span>
                                    </div>
                                </td>
                                <td class="text-capitalize">
                                    <span class="font-weight-medium">{{ $order->product->product_name }}</span>
                                </td>
                                <td class="text-right font-weight-medium">
                                    ₱{{ number_format($order->order_price, 2) }}
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-secondary">{{ number_format($order->order_quantity) }}
                                        PC(s)</span>
                                </td>

                                <td class="text-center">
                                    @if ($order->hasVariation())
                                        <div class="d-flex flex-column gap-1">
                                            @if ($order->productColor)
                                                <span class="fw-bold text-muted text-sm">Color:
                                                    {{ Str::upper($order->productColor->name) }}</span>
                                            @endif
                                            @if ($order->productSize)
                                                <span class="fw-bold text-muted text-sm">Size:
                                                    {{ Str::upper($order->productSize->name) }}</span>
                                            @endif
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-right font-weight-bold text-success">
                                    ₱{{ number_format($order->order_total_amount, 2) }}
                                </td>
                                <td>
                                    <span class="badge badge-light">
                                        <i
                                            class="fas fa-{{ $order->order_payment_method === 'Cash on Delivery' ? 'truck' : 'credit-card' }} mr-1"></i>
                                        {{ $order->order_payment_method }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($order->order_status === 'Pending')
                                        <span class="badge badge-warning p-2">
                                            <i class="fas fa-clock mr-1"></i> PENDING
                                        </span>
                                    @else
                                        <span class="badge badge-success p-2">
                                            <i class="fas fa-check-circle mr-1"></i> PAID
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>{{ date_format($order->created_at, 'M d, Y') }}</span>
                                        <small
                                            class="text-muted">{{ date_format($order->created_at, 'g:i A') }}</small>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-chart-line fa-4x text-muted mb-3"></i>
                                        @if (!empty($search))
                                            <h6>No sales found for "{{ $search }}"</h6>
                                            <p class="text-muted">Try adjusting your search criteria</p>
                                        @else
                                            <h6>No sales data available</h6>
                                            <p class="text-muted">Sales reports will appear here once orders are
                                                completed</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gradient-success text-white">
                        <tr>
                            <td colspan="5" class="text-right font-weight-bold">
                                <h5 class="mb-0">Grand Total Revenue:</h5>
                            </td>
                            <td class="font-weight-bold">
                                <h5 class="mb-0 text-warning">₱{{ number_format($grandTotal, 2) }}</h5>
                            </td>
                            <td colspan="4">
                                <div class="d-flex justify-content-end">
                                    <span class="mr-3">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Avg:
                                        ₱{{ number_format($orders->count() > 0 ? $grandTotal / $orders->count() : 0, 2) }}
                                    </span>
                                    <span>
                                        <i class="fas fa-cubes mr-1"></i>
                                        Total Items: {{ $orders->sum('order_quantity') }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Pagination and Summary -->
            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info bg-light p-2 rounded">
                        <i class="fas fa-info-circle mr-1 text-info"></i>
                        Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of
                        {{ $orders->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers float-right">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles */
        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .small-box {
            border-radius: 0.5rem;
            box-shadow: 0 0 1rem rgba(0, 0, 0, .1);
            transition: transform 0.3s;
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .avatar-sm {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .empty-state {
            padding: 2rem;
            text-align: center;
        }

        .empty-state i {
            opacity: 0.5;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.2s;
        }

        .dataTables_info {
            padding-top: 0.75rem;
            color: #6c757d;
        }

        /* Badge styles */
        .badge {
            padding: 0.5rem 0.75rem;
            font-weight: 500;
        }

        /* Dark mode */
        .dark-mode .table {
            color: #fff;
        }

        .dark-mode .table tbody tr:hover {
            background-color: rgba(40, 167, 69, 0.15);
        }

        .dark-mode .bg-gradient-success {
            background: linear-gradient(135deg, #1e7e34 0%, #1a9c7a 100%);
        }

        .dark-mode .badge-light {
            background-color: #3d3d3d;
            color: #fff;
        }

        .dark-mode .table td .text-muted {
            color: #adb5bd !important;
        }

        .dark-mode .bg-light {
            background-color: #2d2d2d !important;
            color: #fff;
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table tbody tr {
            animation: slideIn 0.3s ease-out;
        }

        /* Filter section */
        .bg-light.p-2.rounded {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }

        /* Card tools */
        .card-tools .btn-tool {
            color: white;
            opacity: 0.8;
        }

        .card-tools .btn-tool:hover {
            opacity: 1;
        }

        /* Pagination */
        .pagination {
            margin-bottom: 0;
        }

        .page-item.active .page-link {
            background-color: #28a745;
            border-color: #28a745;
        }

        .page-link {
            color: #28a745;
        }

        .page-link:hover {
            color: #218838;
        }

        /* Dark mode pagination */
        .dark-mode .page-link {
            background-color: #2d2d2d;
            border-color: #404040;
            color: #fff;
        }

        .dark-mode .page-item.active .page-link {
            background-color: #28a745;
            border-color: #28a745;
        }

        /* Custom scrollbar */
        .table-responsive::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #28a745;
            border-radius: 5px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #218838;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .row.mb-4.align-items-center>div {
                margin-bottom: 10px;
            }

            .d-flex {
                flex-direction: column;
            }

            .input-group.mr-2 {
                width: 100% !important;
                margin-right: 0 !important;
                margin-bottom: 10px;
            }

            .btn-success {
                width: 100%;
            }

            .avatar-sm {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }

            tfoot .d-flex {
                flex-direction: row;
                justify-content: flex-end;
                gap: 10px;
            }
        }

        /* Font weights */
        .font-weight-medium {
            font-weight: 500;
        }

        /* Tooltip customization */
        [data-toggle="tooltip"] {
            cursor: help;
        }

        /* Export button */
        .btn-success {
            transition: all 0.3s;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        /* Footer stats */
        tfoot .text-warning {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        tfoot .d-flex span {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Card widget controls
            $('[data-card-widget="collapse"]').click(function() {
                $(this).closest('.card').find('.card-body').slideToggle();
                $(this).find('i').toggleClass('fa-minus fa-plus');
            });

            $('[data-card-widget="refresh"]').click(function() {
                $(this).find('i').addClass('fa-spin');
                setTimeout(() => {
                    $(this).find('i').removeClass('fa-spin');
                }, 1000);
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            // Toastr notifications (if you're using toastr)
            Livewire.on('toastr', (event) => {
                const {
                    type,
                    message
                } = event.data;

                toastr[type](message, '', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000,
                    positionClass: 'toast-top-right'
                });
            });

            // SweetAlert notifications
            Livewire.on('alert', (event) => {
                const {
                    title,
                    type,
                    message
                } = event.alerts;

                Swal.fire({
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'Close',
                    title: title,
                    icon: type,
                    text: message,
                    showCloseButton: true,
                    timer: 5000,
                    timerProgressBar: true
                });
            });

            // PDF download notification
            Livewire.on('pdfGenerated', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'PDF Generated',
                    text: 'Your sales report has been generated successfully!',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        });
    </script>
</div>
