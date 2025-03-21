<div>
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
                <select name="product_category" id="product_category" class="form-select mb-3 float-end"
                    style="width: 180px;" wire:model.live="date_filter">
                    <option value="All">(Filter date) All</option>
                    <option value="Today">Today</option>
                    <option value="Yesterday">Yesterday</option>
                    <option value="This week">This week</option>
                    <option value="Last week">Last week</option>
                    <option value="This month">This month</option>
                    <option value="Last month">Last month</option>
                    <option value="This year">This year</option>
                    <option value="Last year">Last year</option>
                </select>
            </div>
            <div class="table-responsive" id="product-table" style="max-height: 515px;">
                <table class="table table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th wire:click="handleSortBy('transaction_code')" style="cursor: pointer;">
                                @if ($sortBy === 'transaction_code')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif Transaction Code
                            </th>
                            <th wire:click="handleSortBy('name')" style="cursor: pointer;">
                                @if ($sortBy === 'name')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif Buyer
                            </th>
                            <th class="text-capitalize" wire:click="handleSortBy('product_name')"
                                style="cursor: pointer;">
                                @if ($sortBy === 'product_name')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif Product Name
                            </th>
                            <th wire:click="handleSortBy('order_price')" style="cursor: pointer;">
                                @if ($sortBy === 'order_price')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif Price
                            </th>
                            <th wire:click="handleSortBy('order_quantity')" style="cursor: pointer;">
                                @if ($sortBy === 'order_quantity')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif Quantity
                            </th>
                            <th wire:click="handleSortBy('order_total_amount')" style="cursor: pointer;">
                                @if ($sortBy === 'order_total_amount')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif Total
                            </th>
                            <th wire:click="handleSortBy('order_payment_method')" style="cursor: pointer;">
                                @if ($sortBy === 'order_payment_method')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif Payment Method
                            </th>
                            <th>Status</th>
                            <th wire:click="handleSortBy('orders.created_at')" style="cursor: pointer;">
                                @if ($sortBy === 'orders.created_at')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif Date Order
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td><strong>{{ $order->transaction_code }}</strong></td>
                            <td>{{ $order->user->name }}</td>
                            <td class="text-capitalize">{{ $order->product->product_name }}</td>
                            <td>&#8369;{{ $order->order_price }}</td>
                            <td>{{ number_format($order->order_quantity) }}PC(s)</td>
                            <td>&#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</td>
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
                        @if (!empty($search) && $orders->count() === 0)
                        <td colspan="9" class="text-center">"{{ $search }}" not found.</td>
                        @elseif($orders->count() === 0)
                        <td colspan="9" class="text-center">No product sales yet.</td>
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
                            <td colspan="4"><button class="btn btn-info float-end" wire:click="downloadPdf">Download
                                    PDF</button></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{ $orders->links() }}
        </div>
    </div>
</div>
