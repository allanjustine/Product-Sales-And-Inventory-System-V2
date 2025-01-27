<div>
    <h3>Product Sales</h3>
    <div class="card">
        <table style="font-size: 11px;">
            <thead>
                <tr>
                    <th>Transaction Code
                    </th>
                    <th>Buyer
                    </th>
                    <th>Product Name
                    </th>
                    <th>Price
                    </th>
                    <th>Quantity
                    </th>
                    <th>Total
                    </th>
                    <th>Payment Method
                    </th>
                    <th>Status</th>
                    <th>Date Order
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td><strong>{{ $order->transaction_code }}</strong></td>
                        <td>{{ $order->user->name }}</td>
                        <td class="text-capitalize">{{ $order->product->product_name }}</td>
                        <td>P{{ $order->order_price }}</td>
                        <td>{{ number_format($order->order_quantity) }}PC(s)</td>
                        <td>P{{ number_format($order->order_total_amount, 2, '.', ',') }}</td>
                        <td>{{ $order->order_payment_method }}</td>
                        @if ($order->order_status === 'Pending')
                            <td><span class="badge badge-warning">PENDING</span></td>
                        @else
                            <td><span class="badge badge-success"><i class="fa fa-solid fa-check"></i> PAID</span>
                            </td>
                        @endif
                        <td>{{ date_format($order->created_at, 'F j, Y g:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-dark">
                <tr>
                    <td colspan="5">
                        <h4>Grand Total:</h4>
                    </td>
                    <td>
                        <h4>P{{ number_format($grandTotal, 2, '.', ',') }}</h4>
                    </td>
                    <td colspan="4"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border-left: none;
    }

    td,
    th {
        border: 1px solid black;
        padding: 5px;
    }

    th, tfoot {
        text-align: left;
        background-color: #222;
        color: white;
    }
    .card {
        border: 1px solid black;
    }
    h3 {
        text-align: center;
    }
</style>
