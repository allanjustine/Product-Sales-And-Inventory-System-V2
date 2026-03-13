<div>
    <!-- Success Alert - Enhanced -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <div class="d-flex align-items-center">
                <div class="alert-icon bg-success text-white rounded-circle p-2 mr-3">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="flex-grow-1">
                    <strong class="font-weight-bold">Success!</strong> {{ session('success') }}
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Card -->
    <div class="card card-primary card-outline shadow-lg" id="product-table">
        <div class="card-header bg-gradient-primary text-white">
            <h5 class="card-title font-weight-bold mb-0">
                <i class="fas fa-clipboard-list mr-2"></i>Order Management
            </h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Filter Bar -->
            <div class="row mb-4 align-items-center">
                <div class="col-md-2">
                    <div class="d-flex align-items-center">
                        <label class="mr-2 mb-0 font-weight-bold">Show:</label>
                        <select wire:model.live="perPage" class="form-control form-control-sm w-auto">
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
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="search" class="form-control"
                            placeholder="Search by transaction code, buyer, product..."
                            wire:model.live.debounce.300ms="search">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="filterStatus" id="filterStatus" class="form-control" wire:model.live="filterStatus">
                        <option value="All">📋 All Orders</option>
                        <option value="Pending">⏳ Pending</option>
                        <option value="Processing Order">⚙️ Processing</option>
                        <option value="To Deliver">🚚 To Deliver</option>
                        <option value="Delivered">✅ Delivered</option>
                        <option value="Complete">🎉 Complete</option>
                    </select>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="bg-gradient-dark text-white" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th class="align-middle" wire:click="sortItemBy('orders.transaction_code')"
                                style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    Transaction Code
                                    @if ($sortBy === 'orders.transaction_code')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle" wire:click="sortItemBy('users.name')" style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    Buyer
                                    @if ($sortBy === 'users.name')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle" wire:click="sortItemBy('products.product_name')"
                                style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    Product
                                    @if ($sortBy === 'products.product_name')
                                        <i
                                            class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-2"></i>
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle text-right">Price</th>
                            <th class="align-middle text-center">Qty</th>
                            <th class="align-middle text-center">Color & Size</th>
                            <th class="align-middle text-right">Total</th>
                            <th class="align-middle">Payment</th>
                            <th class="align-middle">Location</th>
                            <th class="align-middle">Date</th>
                            <th class="align-middle text-center">Rating</th>
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="align-middle">
                                <td>
                                    <span class="badge badge-light p-2 font-weight-bold">
                                        <i class="fas fa-hashtag mr-1"></i>{{ $order->transaction_code }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-info rounded-circle mr-2 d-flex align-items-center justify-content-center"
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
                                        <div>
                                            <strong>{{ $order->user->name }}</strong>
                                            <small class="d-block text-muted">{{ $order->user->phone_number }}</small>
                                        </div>
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
                                <td class="text-right font-weight-bold text-primary">
                                    ₱{{ number_format($order->order_price * $order->order_quantity, 2) }}
                                </td>
                                <td>
                                    <span class="badge badge-light">
                                        <i
                                            class="fas fa-{{ $order->order_payment_method === 'Cash on Delivery' ? 'truck' : 'credit-card' }} mr-1"></i>
                                        {{ $order->order_payment_method }}
                                    </span>
                                </td>
                                <td>
                                    <span data-toggle="tooltip" title="{{ $order->user->user_location }}">
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                        {{ Str::limit($order->user->user_location, 15) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>{{ date_format($order->created_at, 'M d, Y') }}</span>
                                        <small
                                            class="text-muted">{{ date_format($order->created_at, 'g:i A') }}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if ($order->orderRating === null)
                                        <span class="badge badge-light">Not rated</span>
                                    @else
                                        <span class="badge badge-warning">
                                            {{ $order->orderRating->rating }} <i class="fa-solid fa-star"></i>
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusClasses = [
                                            'Pending' => 'badge-warning',
                                            'Processing Order' => 'badge-info',
                                            'To Deliver' => 'badge-primary',
                                            'Delivered' => 'badge-success',
                                            'Complete' => 'badge-success',
                                        ];
                                        $statusIcons = [
                                            'Pending' => 'fa-clock',
                                            'Processing Order' => 'fa-cog',
                                            'To Deliver' => 'fa-truck',
                                            'Delivered' => 'fa-check-circle',
                                            'Complete' => 'fa-check-double',
                                        ];
                                    @endphp
                                    <span
                                        class="badge {{ $statusClasses[$order->order_status] ?? 'badge-secondary' }} p-2">
                                        <i
                                            class="fas {{ $statusIcons[$order->order_status] ?? 'fa-circle' }} mr-1"></i>
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group-vertical" style="min-width: 140px;">
                                        @if ($order->order_status === 'Pending')
                                            <button type="button"
                                                onclick="handleUpdateStatus({{ $order->id }}, 'processOrder')"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa-sharp fa-solid fa-cart-circle-arrow-up mr-1"></i>
                                                Process Order
                                            </button>
                                        @elseif ($order->order_status === 'Processing Order')
                                            <button type="button"
                                                onclick="handleUpdateStatus({{ $order->id }}, 'markAsDeliver')"
                                                class="btn btn-info btn-sm">
                                                <i class="fa-regular fa-truck-container mr-1"></i>
                                                Mark as Deliver
                                            </button>
                                        @elseif ($order->order_status === 'To Deliver')
                                            <button type="button"
                                                onclick="handleUpdateStatus({{ $order->id }}, 'markAsDelivered')"
                                                class="btn btn-success btn-sm">
                                                <i class="fa-solid fa-truck mr-1"></i>
                                                Mark as Delivered
                                            </button>
                                        @elseif ($order->order_status === 'Complete')
                                            <button type="button"
                                                onclick="handleUpdateStatus({{ $order->id }}, 'markAsPaid')"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-solid fa-check mr-1"></i>
                                                Paid Settlement
                                            </button>
                                        @else
                                            <button type="button"
                                                onclick="handleUpdateStatus({{ $order->id }}, 'markAsPaid')"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-solid fa-check mr-1"></i>
                                                Mark as Paid
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                                        @if (!empty($search))
                                            <h6>No orders found for "{{ $search }}"</h6>
                                            <p class="text-muted">Try adjusting your search criteria</p>
                                        @else
                                            <h6>No orders yet</h6>
                                            <p class="text-muted">Orders will appear here once customers make purchases
                                            </p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gradient-dark text-white">
                        <tr>
                            <td colspan="5" class="text-right font-weight-bold">
                                <h5 class="mb-0">Grand Total:</h5>
                            </td>
                            <td class="font-weight-bold">
                                <h5 class="mb-0 text-warning">₱{{ number_format($grandTotal, 2) }}</h5>
                            </td>
                            <td colspan="7"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
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
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-dark {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
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
        }

        .table tbody tr {
            transition: all 0.2s;
        }

        .btn-group-vertical .btn {
            margin: 2px 0;
            border-radius: 4px !important;
        }

        .dataTables_info {
            padding-top: 0.75rem;
            color: #6c757d;
        }

        /* Status badges */
        .badge {
            padding: 0.5rem 0.75rem;
            font-weight: 500;
        }

        /* Dark mode */
        .dark-mode .table {
            color: #fff;
        }

        .dark-mode .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .dark-mode .bg-gradient-dark {
            background: linear-gradient(135deg, #1a2634 0%, #0d131f 100%);
        }

        .dark-mode .badge-light {
            background-color: #3d3d3d;
            color: #fff;
        }

        .dark-mode .table td .text-muted {
            color: #adb5bd !important;
        }

        /* Animation */
        @keyframes fadeIn {
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
            animation: fadeIn 0.3s ease-out;
        }

        /* Alert styling */
        .alert-success {
            border-left: 4px solid #28a745;
            border-radius: 0.5rem;
        }

        .alert-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .btn-group-vertical {
                min-width: 100% !important;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .avatar-sm {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }
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
            background: #667eea;
            border-radius: 5px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #5a67d8;
        }

        /* Tooltip */
        [data-toggle="tooltip"] {
            cursor: help;
        }

        /* Font weights */
        .font-weight-medium {
            font-weight: 500;
        }

        /* Card tools */
        .card-tools .btn-tool {
            color: white;
            opacity: 0.8;
        }

        .card-tools .btn-tool:hover {
            opacity: 1;
        }

        /* Pagination styling */
        .pagination {
            margin-bottom: 0;
        }

        .page-item.active .page-link {
            background-color: #667eea;
            border-color: #667eea;
        }

        .page-link {
            color: #667eea;
        }

        .page-link:hover {
            color: #5a67d8;
        }

        /* Dark mode pagination */
        .dark-mode .page-link {
            background-color: #2d2d2d;
            border-color: #404040;
            color: #fff;
        }

        .dark-mode .page-item.active .page-link {
            background-color: #667eea;
            border-color: #667eea;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Card widget
            $('[data-card-widget="collapse"]').click(function() {
                $(this).closest('.card').find('.card-body').slideToggle();
                $(this).find('i').toggleClass('fa-minus fa-plus');
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            // Toastr notifications
            Livewire.on('toastr', (event) => {
                const {
                    type,
                    message
                } = event.data;

                toastr[type](message, '', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000,
                    extendedTimeOut: 1000,
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
                    confirmButtonColor: '#667eea',
                    confirmButtonText: 'Close',
                    title: title,
                    icon: type,
                    text: message,
                    showCloseButton: true,
                    timer: 5000,
                    timerProgressBar: true
                });
            });
        });
    </script>

    <script>
        function handleUpdateStatus(id, status) {
            const statusConfig = {
                'processOrder': {
                    title: 'Process Order',
                    icon: 'info',
                    color: '#667eea'
                },
                'markAsDeliver': {
                    title: 'Mark as Deliver',
                    icon: 'question',
                    color: '#17a2b8'
                },
                'markAsDelivered': {
                    title: 'Mark as Delivered',
                    icon: 'success',
                    color: '#28a745'
                },
                'markAsPaid': {
                    title: 'Mark as Paid',
                    icon: 'success',
                    color: '#28a745'
                }
            };

            const config = statusConfig[status] || statusConfig['processOrder'];

            Swal.fire({
                title: config.title,
                text: `Are you sure you want to mark this order as ${config.title}?`,
                icon: config.icon,
                showCancelButton: true,
                confirmButtonColor: config.color,
                cancelButtonColor: '#6c757d',
                confirmButtonText: `Yes, ${config.title}`,
                showCloseButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(status, {
                        id
                    });

                    Swal.fire({
                        title: 'Updated!',
                        text: 'Order status has been updated successfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>

    <script>
        document.addEventListener("livewire:navigated", function() {
            // Echo listeners
            if (window.Echo) {
                window.Echo.private(`cancel-order-{{ auth()->id() }}`)
                    .listen('.cancel-order-event', (e) => {
                        Livewire.dispatch('cancelOrderByUser');
                        toastr.info('An order has been cancelled', 'Order Update');
                    });

                window.Echo.private(`repurchase-and-submit-rating-{{ auth()->id() }}`)
                    .listen('.repurchase-and-submit-rating-event', (e) => {
                        Livewire.dispatch('repurchaseAndSubmitRating');
                        toastr.success('Order has been updated with rating', 'Rating Submitted');
                    });

                window.Echo.private(`place-order-{{ auth()->id() }}`)
                    .listen('.place-order-event', (e) => {
                        Livewire.dispatch('placeOrderByUser');
                        toastr.success('New order has been placed', 'New Order');
                    });
            }
        });
    </script>
</div>
