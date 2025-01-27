<div>
    <div class="container">
        <h1 class="mt-3">Recent Orders</h1>
        <hr>
        <table class="table table-bordered mt-5">
            <thead class="bg-dark">
                <tr>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Total
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Order Date
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="text-capitalize">{{ $order->product->product_name }}</td>
                        <td>&#8369;{{ number_format($order->product->product_price, 2, '.', ',') }}</td>
                        <td>{{ number_format($order->order_quantity) }}</td>
                        <td>&#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</td>
                        @if ($order->order_status === 'Pending')
                            <td><span class="badge badge-warning">PENDING</span></td>
                        @else
                            <td><span class="badge badge-success"><i class="fa fa-solid fa-check"></i> PAID</span></td>
                        @endif
                        <td>{{ date_format($order->created_at, 'F j, Y g:i A') }}</td>
                        <td>
                            @if ($order->order_status === 'Pending')
                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#cancel"
                                    wire:click="toCancel({{ $order->id }})">
                                    <i class="fa-solid fa-xmark"></i>
                                    Cancel Order
                                </a>
                            @else
                                <a href="" class="btn btn-warning">
                                    <i class="fa-solid fa-eye"></i>
                                    View
                                </a>
                        </td>
                @endif
                </tr>
                @endforeach
                @if ($orders->count() === 0)
                    <tr>
                        <td colspan="8" class="text-center">
                            <i class="fa-regular fa-xmark-to-slot mt-5" style="font-size: 50px;"></i>
                            <h5 class="mb-2 mt-4">No orders yet. <a href="/products">Click here to order</a></h5>
                        </td>
                    </tr>
                @endif
            </tbody>
            <tfoot class="bg-dark">
                <tr>
                    <td colspan="3">
                        <h5>Grand Total:</h5>
                    </td>
                    <td>
                        &#8369;{{ number_format($grandTotal, 2, '.', ',') }}
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
