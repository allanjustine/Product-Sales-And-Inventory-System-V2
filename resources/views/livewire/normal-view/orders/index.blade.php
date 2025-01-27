<div>
    @include('livewire.normal-view.orders.cancel-order')
    @include('livewire.normal-view.orders.order-received')
    <div class="container">
        <div class="accordion" id="accordionExample">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left text-center" type="button" data-toggle="collapse"
                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i
                            class="far {{ auth()->user()->user_location ? 'fa-check text-success' : 'fa-circle-exclamation text-danger' }}"></i>
                        Show delivery address
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">

                <div class="d-flex justify-content-center">
                    <div class="alert mt-2 col-md-8 text-primary" role="alert" style="background: #74bef7a1">
                        <a href="/profile" class="float-end text-primary" style="text-decoration: none;"><i
                                class="far fa-pen"></i>
                            Edit</a>
                        <div class="d-flex align-items-center">
                            <img src="images/mylogo.jpg" alt="Info Logo" class="me-2" style="width: 120px;">
                            <div>
                                <h4 class="alert-heading"><strong>Your delivery address</strong></h4>
                                <p class="{{ auth()->user()->user_location ? 'text-primary' : 'text-danger' }}"><i
                                        {{ auth()->user()->user_location ? 'hidden' : '' }}
                                        class="far fa-circle-exclamation mr-2"></i>{{ auth()->user()->user_location ?? 'Set up your delivery address to make sure your order will arrive at your address location.' }}
                                </p>
                                <hr>
                                <p class="mb-0"><strong>Phone number:</strong> {{ auth()->user()->phone_number }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4"><i class="fa-light fa-bag-shopping"></i> My Orders</h3>
        <hr>
        <div class="col-md-12 p-0">

            <div class="card card-primary card-outline card-outline-tabs" style="height: 100%">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="schedulesTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#pending" role="tab"
                                aria-controls="custom-tabs-four-home" aria-selected="true">PENDING
                                ORDERS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#recent" role="tab"
                                aria-controls="custom-tabs-four-profile" aria-selected="false">RECENT ORDERS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#cancelled" role="tab"
                                aria-controls="custom-tabs-four-profile" aria-selected="false">CANCELLED ORDERS</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body px-0">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="pending" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            @foreach ($pendings as $order)
                                <div class="col-md-12 p-0">
                                    <div class="info-box elevation-3">
                                        <div class="info-box-content">
                                            <span class="info-box-image">

                                                @if (Storage::exists($order->product->product_image))
                                                    <img style="width: 90px; height: 80px; border-radius: 5px;"
                                                        src="{{ Storage::url($order->product->product_image) }}"
                                                        alt="{{ $order->product->product_name }}">
                                                @else
                                                    <img style="width: 90px; height: 80px; border-radius: 5px;"
                                                        src="{{ $order->product->product_image }}"
                                                        alt="{{ $order->product->product_name }}">
                                                @endif
                                            </span>
                                            <strong class="info-box-text text-capitalize">{{ $order->product->product_name }}</strong>
                                            <span
                                                class="info-box-text">&#8369;{{ number_format($order->product->product_price, 2, '.', ',') }}</span>
                                            <span
                                                class="info-box-text">x{{ number_format($order->order_quantity) }}PC(s)</span>
                                            <span
                                                class="info-box-text">{{ date_format($order->created_at, 'F j, Y g:i A') }}</span>
                                            @if ($order->order_status === 'Paid')
                                                <span class="info-box-text badge badge-success align-self-start"><i
                                                        class="fa fa-solid fa-check"></i> PAID</span>
                                            @elseif ($order->order_status === 'Processing Order')
                                                <span
                                                    class="info-box-text badge badge-success align-self-start">PREPARING</span>
                                            @elseif ($order->order_status === 'To Deliver')
                                                <span class="info-box-text badge badge-primary align-self-start">OUT FOR
                                                    DELIVERY</span>
                                            @elseif ($order->order_status === 'Delivered')
                                                <span
                                                    class="info-box-text badge badge-info align-self-start">DELIVERED</span>
                                            @elseif ($order->order_status === 'Complete')
                                                <span
                                                    class="info-box-text badge badge-primary align-self-start">COMPLETE</span>
                                            @else
                                                <span
                                                    class="info-box-text badge badge-warning align-self-start">PENDING</span>
                                            @endif
                                            <span
                                                class="info-box-text"><strong>{{ $order->transaction_code }}</strong></span>
                                            <span class="info-box-number">Total:
                                                &#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</span>
                                        </div>
                                        <span>
                                            @if ($order->order_status === 'Pending')
                                                <a href="" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#cancel" wire:click="toCancel({{ $order->id }})">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Cancel Order
                                                </a>
                                            @elseif ($order->order_status === 'Processing Order')
                                                <a href="#" class="btn btn-success">
                                                    <i class="fa-sharp fa-solid fa-cart-circle-arrow-up"></i>
                                                    Preparing
                                                </a>
                                            @elseif ($order->order_status === 'To Deliver')
                                                <a href="#" class="btn btn-primary">
                                                    <i class="fa-solid fa-car-side"></i>
                                                    Out for Delivery
                                                </a>
                                            @elseif ($order->order_status === 'To Deliver')
                                                <a href="#" class="btn btn-primary">
                                                    <i class="fa-solid fa-car-side"></i>
                                                    To Deliver
                                                </a>
                                            @elseif ($order->order_status === 'Delivered')
                                                <a href="#" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#order-received"
                                                    wire:click="toReceived({{ $order->id }})">
                                                    <i class="fa-solid fa-hand-holding-box"></i>
                                                    Order Received
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-warning">
                                                    <i class="fa-solid fa-check"></i>
                                                    Paid
                                                </a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            @if ($pendings->count() === 0)
                                <span class="text-center">
                                    <h5><i class="fa-regular fa-xmark-to-slot" style="font-size: 50px;"></i><br>
                                        No orders yet. <a href="/products">Click
                                            here to order</a></h5>
                                </span>
                            @endif
                            <span class="ml-3">
                                <strong>Grand Total:
                                    &#8369;{{ number_format($grandTotalPending, 2, '.', ',') }}</strong>
                            </span>
                        </div>
                        <div class="tab-pane fade" id="recent" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            @foreach ($recents as $order)
                                <div class="col-md-12 p-0">
                                    <div class="info-box elevation-3">
                                        <div class="info-box-content">

                                            <span class="info-box-image">
                                                @if (Storage::exists($order->product->product_image))
                                                    <img style="width: 90px; height: 80px; border-radius: 5px;"
                                                        src="{{ Storage::url($order->product->product_image) }}"
                                                        alt="{{ $order->product->product_name }}">
                                                @else
                                                    <img style="width: 90px; height: 80px; border-radius: 5px;"
                                                        src="{{ $order->product->product_image }}"
                                                        alt="{{ $order->product->product_name }}">
                                                @endif
                                            </span>
                                            <span
                                                class="info-box-text text-capitalize"><strong>{{ $order->product->product_name }}</strong></span>
                                            <span
                                                class="info-box-text">&#8369;{{ number_format($order->product->product_price, 2, '.', ',') }}</span>
                                            <span
                                                class="info-box-text">x{{ number_format($order->order_quantity) }}PC(s)</span>
                                            <span
                                                class="info-box-text">{{ date_format($order->created_at, 'F j, Y g:i A') }}</span>
                                            @if ($order->order_status === 'Paid')
                                                <span class="info-box-text badge badge-success align-self-start"><i
                                                        class="fa fa-solid fa-check"></i> PAID</span>
                                            @elseif ($order->order_status === 'Processing Order')
                                                <span
                                                    class="info-box-text badge badge-success align-self-start">PREPARING</span>
                                            @elseif ($order->order_status === 'To Deliver')
                                                <span class="info-box-text badge badge-primary align-self-start">OUT
                                                    FOR
                                                    DELIVERY</span>
                                            @elseif ($order->order_status === 'Delivered')
                                                <span
                                                    class="info-box-text badge badge-info align-self-start">DELIVERED</span>
                                            @elseif ($order->order_status === 'Complete')
                                                <span
                                                    class="info-box-text badge badge-primary align-self-start">COMPLETE</span>
                                            @else
                                                <span
                                                    class="info-box-text badge badge-warning align-self-start">PAYMENT
                                                    SETTLEMENT</span>
                                            @endif
                                            <span
                                                class="info-box-text"><strong>{{ $order->transaction_code }}</strong></span>
                                            <span class="info-box-number">Total:
                                                &#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</span>
                                        </div>
                                        <span>
                                            @if ($order->order_status === 'Pending')
                                                <a href="" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#cancel" wire:click="toCancel({{ $order->id }})">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Cancel Order
                                                </a>
                                            @elseif ($order->order_status === 'Complete')
                                                <a href="#" class="btn btn-outline-primary">
                                                    <i class="fa-solid fa-sack-dollar"></i> Payment Settlement
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-outline-success">
                                                    <i class="fa-solid fa-check"></i>
                                                    Paid
                                                </a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            @if ($recents->count() === 0)
                                <span class="text-center">
                                    <h5><i class="fa-regular fa-xmark-to-slot" style="font-size: 50px;"></i><br>
                                        No recent order yet. <a href="/products">Click
                                            here to order</a></h5>
                                </span>
                            @endif
                            <span class="ml-3">
                                <strong>Grand Total:
                                    &#8369;{{ number_format($grandTotalRecent, 2, '.', ',') }}</strong>
                            </span>
                        </div>

                        <div class="tab-pane fade" id="cancelled" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            @foreach ($cancels as $order)
                                <div class="col-md-12 p-0">
                                    <div class="info-box elevation-3">
                                        <div class="info-box-content">
                                            <span class="info-box-image">
                                                @if (Storage::exists($order->product->product_image))
                                                    <img style="width: 90px; height: 80px; border-radius: 5px;"
                                                        src="{{ Storage::url($order->product->product_image) }}"
                                                        alt="{{ $order->product->product_name }}">
                                                @else
                                                    <img style="width: 90px; height: 80px; border-radius: 5px;"
                                                        src="{{ $order->product->product_image }}"
                                                        alt="{{ $order->product->product_name }}">
                                                @endif
                                            </span>
                                            <span
                                                class="info-box-text text-capitalize"><strong>{{ $order->product->product_name }}</strong></span>
                                            <span
                                                class="info-box-text">&#8369;{{ number_format($order->product->product_price, 2, '.', ',') }}</span>
                                            <span
                                                class="info-box-text">x{{ number_format($order->order_quantity) }}PC(s)</span>
                                            <span
                                                class="info-box-text">{{ date_format($order->created_at, 'F j, Y g:i A') }}</span>
                                            @if ($order->order_status === 'Paid')
                                                <span class="info-box-text badge badge-success align-self-start"><i
                                                        class="fa fa-solid fa-check"></i> PAID</span>
                                            @elseif ($order->order_status === 'To Deliver')
                                                <span class="info-box-text badge badge-primary align-self-start">TO
                                                    DELIVER</span>
                                            @elseif ($order->order_status === 'Delivered')
                                                <span
                                                    class="info-box-text badge badge-info align-self-start">DELIVERED</span>
                                            @elseif ($order->order_status === 'Complete')
                                                <span
                                                    class="info-box-text badge badge-primary align-self-start">COMPLETE</span>
                                            @elseif ($order->order_status === 'Cancelled')
                                                <span
                                                    class="info-box-text badge badge-danger align-self-start">CANCELLED</span>
                                            @else
                                                <span
                                                    class="info-box-text badge badge-warning align-self-start">PENDING</span>
                                            @endif
                                            <span
                                                class="info-box-text"><strong>{{ $order->transaction_code }}</strong></span>
                                            <span class="info-box-number">Total:
                                                &#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</span>
                                        </div>
                                        <span>
                                            @if ($order->order_status === 'Cancelled')
                                                {{-- <a href="#" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#toRemove"
                                                    wire:click="toRemove({{ $order->id }})">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Remove
                                                </a> --}}
                                                <a href="#" class="btn btn-outline-danger">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Cancelled
                                                </a>

                                                <a href="#" class="btn btn-primary mt-1"
                                                    wire:click="rePurchaseOrder({{ $order->id }})">
                                                    <i class="fa-solid fa-rotate-right"></i>
                                                    Re-purchase
                                                </a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            @if ($cancels->count() === 0)
                                <span class="text-center">
                                    <h5><i class="fa-regular fa-xmark-to-slot" style="font-size: 50px;"></i><br>
                                        No cancelled order.</h5>
                                </span>
                            @endif
                            <span class="ml-3">
                                <strong>Grand Total:
                                    &#8369;{{ number_format($grandTotalCancelled, 2, '.', ',') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
