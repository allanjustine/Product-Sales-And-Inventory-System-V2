<div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h6 class="text-center">
            <strong>Success!</strong> {{ session('success') }}
        </h6>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="col-sm-12">
                <label>Show:</label>
                <select wire:model.live="perPage" class="perPageSelect">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <label>Entries</label>
                <input type="search" class="form-control mb-3 mx-2 float-end" style="width: 198px;" placeholder="Search"
                    wire:model.live.debounse.200ms="search">
                <select name="filterStatus" id="filterStatus" class="form-select mb-3 float-end" style="width: 180px;"
                    wire:model.live="filterStatus">
                    <option value="All">(Filter status) All</option>
                    <option value="Processing Order">Processing Order</option>
                    <option value="Complete">Complete</option>
                    <option value="To Deliver">To Deliver</option>
                    <option value="Delivered">Delivered</option>
                </select>
            </div>
            <div class="table-responsive p-2" id="product-table" style="max-height: 500px;">
                <table class="table table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th wire:click="sortItemBy('orders.transaction_code')" style="cursor: pointer;">
                                @if ($sortBy === 'orders.transaction_code')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Transaction Code
                            </th>
                            <th wire:click="sortItemBy('users.name')" style="cursor: pointer;">
                                @if ($sortBy === 'users.name')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Buyer
                            </th>
                            <th wire:click="sortItemBy('products.product_name')" style="cursor: pointer;">
                                @if ($sortBy === 'products.product_name')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Product Name
                            </th>
                            <th wire:click="sortItemBy('orders.order_price')" style="cursor: pointer;">
                                @if ($sortBy === 'orders.order_price')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Price
                            </th>
                            <th wire:click="sortItemBy('orders.order_quantity')" style="cursor: pointer;">
                                @if ($sortBy === 'orders.order_quantity')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Quantity
                            </th>
                            <th wire:click="sortItemBy('orders.order_total_amount')" style="cursor: pointer;">
                                @if ($sortBy === 'orders.order_total_amount')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Total
                            </th>
                            <th>Payment Method</th>
                            <th wire:click="sortItemBy('users.address')" style="cursor: pointer;">
                                @if ($sortBy === 'users.address')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Location
                            </th>
                            <th wire:click="sortItemBy('orders.created_at')" style="cursor: pointer;">
                                @if ($sortBy === 'orders.created_at')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Date Order
                            </th>
                            <th wire:click="sortItemBy('orders.user_rating')" style="cursor: pointer;">
                                @if ($sortBy === 'orders.user_rating')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Buyer Rate
                            </th>
                            <th wire:click="sortItemBy('orders.order_status')" style="cursor: pointer;">
                                @if ($sortBy === 'orders.status')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Status
                            </th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr key="{{ $order->id }}">
                            <td><strong>{{ $order->transaction_code }}</strong></td>
                            <td>{{ $order->user->name }} - {{ $order->user->phone_number }}</td>
                            <td class="text-capitalize">{{ $order->product->product_name }}</td>
                            <td>&#8369;{{ number_format($order->order_price, 2, '.', ',') }}</td>
                            <td>{{ number_format($order->order_quantity) }}PC(s)</td>
                            <td>&#8369;{{ number_format($order->order_price * $order->order_quantity, 2, '.', ',') }}
                            </td>
                            <td>{{ $order->order_payment_method }}</td>
                            <td>{{ $order->user->user_location }}</td>
                            <td>{{ date_format($order->created_at, 'F j, Y g:i A') }}</td>
                            <td class="text-center">
                                @if ($order->user_rating === null)
                                <span>Not yet rated</span>
                                @else
                                {{ $order->user_rating }}
                                @endif
                            </td>
                            @if ($order->order_status === 'Pending')
                            <td><span class="badge badge-warning">PENDING</span></td>
                            @elseif ($order->order_status === 'Complete')
                            <td><span class="badge badge-primary">COMPLETE</span>
                            </td>
                            @elseif ($order->order_status === 'Processing Order')
                            <td><span class="badge badge-warning">PROCESSING</span>
                            </td>
                            @elseif ($order->order_status === 'To Deliver')
                            <td><span class="badge badge-warning">TO
                                    DELIVER</span>
                            </td>
                            @elseif ($order->order_status === 'Delivered')
                            <td><span class="badge badge-info">DELIVERED</span>
                            </td>
                            @endif
                            <td>
                                @if ($order->order_status === 'Pending')
                                <button type="button" onclick="handleUpdateStatus({{ $order->id }}, 'processOrder')"
                                    class="btn btn-primary d-flex gap-1 align-items-center justify-content-center"
                                    style="width: 140px;">
                                    <i class="fa-sharp fa-solid fa-cart-circle-arrow-up"></i> <span>Process Order</span>
                                </button>
                                @elseif ($order->order_status === 'Processing Order')
                                <button type="button" onclick="handleUpdateStatus({{ $order->id }}, 'markAsDeliver')"
                                    class="btn btn-primary d-flex gap-1 align-items-center justify-content-center"
                                    style="width: 140px;">
                                    <i class="fa-regular fa-truck-container"></i> <span>Deliver</span>
                                </button>
                                @elseif ($order->order_status === 'To Deliver')
                                <button type="button" onclick="handleUpdateStatus({{ $order->id }}, 'markAsDelivered')"
                                    class="btn btn-info d-flex gap-1 align-items-center justify-content-center"
                                    style="width: 140px;">
                                    <i class="fa-solid fa-truck"></i> <span>Delivered</span>
                                </button>
                                @elseif ($order->order_status === 'Complete')
                                <button type="button" onclick="handleUpdateStatus({{ $order->id }}, 'markAsPaid')"
                                    class="btn btn-success d-flex gap-1 align-items-center justify-content-center"
                                    style="width: 140px;">
                                    <i class="fa fa-solid fa-check"></i> <span>Paid Settlement</span>
                                </button>
                                @else
                                <button type="button" onclick="handleUpdateStatus({{ $order->id }}, 'markAsPaid')"
                                    class="btn btn-success d-flex gap-1 align-items-center justify-content-center"
                                    style="width: 140px;">
                                    <i class="fa fa-solid fa-check"></i> <span>Paid Order</span>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @if ($orders->count() === 0)
                        <td colspan="12" class="text-center">No orders yet.</td>
                        </td>
                        @endif
                    </tbody>
                    <tfoot class="bg-dark">
                        <tr>
                            <td colspan="5">
                                <h5>Grand Total:</h5>
                            </td>
                            <td>
                                &#8369;{{ number_format($grandTotal, 2, '.', ',') }}
                            </td>
                            <td colspan="7"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', () => {
            @this.on('toastr', (event) => {
                const {
                    type
                    , message
                } = event.data;

                toastr[type](message, '', {
                    closeButton: true
                    , "progressBar": true
                , });
            });
        });

    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            @this.on('alert', (event) => {
                const { title, type, message } = event.alerts;

                Swal.fire({
                    confirmButtonColor: '#0000FF',
                    confirmButtonText: 'Close',
                    title: title,
                    icon: type,
                    text: message
                });
            });
        });
    </script>

    <script>
        function handleUpdateStatus(id, status) {

            const statusTitle = {
                'processOrder': 'processOrder',
                'markAsDeliver': 'markAsDeliver',
                'markAsDelivered': 'markAsDelivered',
                'markAsPaid': 'markAsPaid'
            };

            const titles = {
                'processOrder': 'Process Order',
                'markAsDeliver': 'Deliver',
                'markAsDelivered': 'Delivered',
                'markAsPaid': 'Paid'
            }

            if (statusTitle[status]) {
                Swal.fire({
                    confirmButtonColor: '#0000FF',
                    confirmButtonText: `Yes, ${titles[status]} it!`,
                    showCancelButton: true,
                    showCloseButton: true,
                    title: titles[status],
                    icon: 'info',
                    text: `Are you sure you want to make this order as ${titles[status]}?`
                }).then((result) => {
                    if(result.isConfirmed) {
                        @this.dispatch(statusTitle[status], { id });
                    }
                });
            }
        }
    </script>
</div>
