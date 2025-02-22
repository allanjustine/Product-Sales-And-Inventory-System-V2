<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h6 class="text-center">
                <strong>Success!</strong> {{ session('success') }}
            </h6>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive card card-primary card-outline card-outline-tabs" id="product-table"
        style="height: 500px;">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="bg-dark">
                    <tr>
                        <th>Transaction Code</th>
                        <th>Buyer</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Payment Method</th>
                        <th>Location</th>
                        <th>Date Order</th>
                        <th>Buyer Rate</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
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
                                    <button wire:click="processOrder({{ $order->id }})" class="btn btn-primary"><i
                                            class="fa-sharp fa-solid fa-cart-circle-arrow-up"></i> Process
                                        Order</button>
                                @elseif ($order->order_status === 'Processing Order')
                                    <button wire:click="markAsDeliver({{ $order->id }})" class="btn btn-primary"><i
                                            class="fa-regular fa-truck-container"></i> Deliver</button>
                                @elseif ($order->order_status === 'To Deliver')
                                    <button wire:click="markAsDelivered({{ $order->id }})" class="btn btn-info"><i
                                            class="fa-solid fa-truck"></i> Delivered</button>
                                @elseif ($order->order_status === 'Complete')
                                    <button wire:click="markAsPaid({{ $order->id }})" class="btn btn-success"><i
                                            class="fa fa-solid fa-check"></i> Paid Settlement</button>
                                @else
                                    <button wire:click="markAsPaid({{ $order->id }})" class="btn btn-success"><i
                                            class="fa fa-solid fa-check"></i> Paid Order</button>
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
            {{-- @if (session('message'))
                <script>
                    toastr.options = {
                        "progressBar": true,
                        "closeButton": true,
                    }
                    toastr.success("{{ session('message') }}");
                </script>
            @endif --}}
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
                , })
            })
        })

    </script>
</div>
