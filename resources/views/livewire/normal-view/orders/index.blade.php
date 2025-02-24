<div>
    @include('livewire.normal-view.orders.cancel-order')
    @include('livewire.normal-view.orders.order-received')
    <div class="container">
        <div class="accordion" id="accordionExample">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left text-center" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i
                            class="far {{ auth()->user()->user_location ? 'fa-check text-success' : 'fa-circle-exclamation text-danger' }}"></i>
                        Show delivery address
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">

                <div class="d-flex justify-content-center">
                    <div class="alert mt-2 col-md-8 text-primary" role="alert" style="background: #74bef7a1">
                        <a wire:navigate href="/profile" class="float-end text-primary"
                            style="text-decoration: none;"><i class="far fa-pen"></i>
                            Edit</a>
                        <div class="d-flex align-items-center">
                            <img src="images/mylogo.jpg" alt="Info Logo" class="me-2" style="width: 120px;">
                            <div>
                                <h4 class="alert-heading"><strong>Your delivery address</strong></h4>
                                <p class="{{ auth()->user()->user_location ? 'text-primary' : 'text-danger' }}"><i {{
                                        auth()->user()->user_location ? 'hidden' : '' }}
                                        class="far fa-circle-exclamation mr-2"></i>{{ auth()->user()->user_location ??
                                    'Set up your delivery address to make sure your order will arrive at your address
                                    location.' }}
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
                            <a class="nav-link active" data-bs-toggle="pill" href="#pending" role="tab"
                                aria-controls="custom-tabs-four-home" aria-selected="true">PENDING
                                ORDERS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#recent" role="tab"
                                aria-controls="custom-tabs-four-profile" aria-selected="false">RECENT ORDERS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#cancelled" role="tab"
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
                                        <strong class="info-box-text text-capitalize">{{ $order->product->product_name
                                            }}</strong>
                                        <span class="info-box-text">&#8369;{{
                                            number_format($order->product->product_price, 2, '.', ',') }}</span>
                                        <span class="info-box-text">x{{ number_format($order->order_quantity)
                                            }}PC(s)</span>
                                        <span class="info-box-text">{{ date_format($order->created_at, 'F j, Y g:i A')
                                            }}</span>
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
                                        <span class="info-box-text badge badge-info align-self-start">DELIVERED</span>
                                        @elseif ($order->order_status === 'Complete')
                                        <span class="info-box-text badge badge-primary align-self-start">COMPLETE</span>
                                        @else
                                        <span class="info-box-text badge badge-warning align-self-start">PENDING</span>
                                        @endif
                                        <span class="info-box-text"><strong>{{ $order->transaction_code
                                                }}</strong></span>
                                        <span class="info-box-number">Total:
                                            &#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</span>
                                    </div>
                                    <span>
                                        @if ($order->order_status === 'Pending')
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#cancel" wire:click="toCancel({{ $order->id }})">
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
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#order-received" wire:click="toReceived({{ $order->id }})">
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
                                    No orders yet. <a wire:navigate href="/products">Click
                                        here to order</a></h5>
                            </span>
                            @endif
                            <div class="card shadow">
                                <div class="card-body">
                                    <h2>
                                        <span class="ml-3">
                                            <strong>Grand Total:
                                                &#8369;{{ number_format($grandTotalPending, 2, '.', ',') }}</strong>
                                        </span>
                                    </h2>
                                </div>
                            </div>
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
                                        <span class="info-box-text text-capitalize"><strong>{{
                                                $order->product->product_name }}</strong></span>
                                        <span class="info-box-text">&#8369;{{
                                            number_format($order->product->product_price, 2, '.', ',') }}</span>
                                        <span class="info-box-text">x{{ number_format($order->order_quantity)
                                            }}PC(s)</span>
                                        <span class="info-box-text">{{ date_format($order->created_at, 'F j, Y g:i A')
                                            }}</span>
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
                                        <span class="info-box-text badge badge-info align-self-start">DELIVERED</span>
                                        @elseif ($order->order_status === 'Complete')
                                        <span class="info-box-text badge badge-primary align-self-start">COMPLETE</span>
                                        @else
                                        <span class="info-box-text badge badge-warning align-self-start">PAYMENT
                                            SETTLEMENT</span>
                                        @endif
                                        <span class="info-box-text"><strong>{{ $order->transaction_code
                                                }}</strong></span>
                                        <span class="info-box-number">Total:
                                            &#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</span>
                                    </div>
                                    <span>
                                        @if ($order->order_status === 'Pending')
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#cancel" wire:click="toCancel({{ $order->id }})">
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
                                    No recent order yet. <a wire:navigate href="/products">Click
                                        here to order</a></h5>
                            </span>
                            @endif
                            <div class="card shadow">
                                <div class="card-body">
                                    <h2>
                                        <span class="ml-3">
                                            <strong>Grand Total:
                                                &#8369;{{ number_format($grandTotalRecent, 2, '.', ',') }}</strong>
                                        </span>
                                    </h2>
                                </div>
                            </div>
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
                                        <span class="info-box-text text-capitalize"><strong>{{
                                                $order->product->product_name }}</strong></span>
                                        <span class="info-box-text">&#8369;{{
                                            number_format($order->product->product_price, 2, '.', ',') }}</span>
                                        <span class="info-box-text">x{{ number_format($order->order_quantity)
                                            }}PC(s)</span>
                                        <span class="info-box-text">{{ date_format($order->created_at, 'F j, Y g:i A')
                                            }}</span>
                                        @if ($order->order_status === 'Paid')
                                        <span class="info-box-text badge badge-success align-self-start"><i
                                                class="fa fa-solid fa-check"></i> PAID</span>
                                        @elseif ($order->order_status === 'To Deliver')
                                        <span class="info-box-text badge badge-primary align-self-start">TO
                                            DELIVER</span>
                                        @elseif ($order->order_status === 'Delivered')
                                        <span class="info-box-text badge badge-info align-self-start">DELIVERED</span>
                                        @elseif ($order->order_status === 'Complete')
                                        <span class="info-box-text badge badge-primary align-self-start">COMPLETE</span>
                                        @elseif ($order->order_status === 'Cancelled')
                                        <span class="info-box-text badge badge-danger align-self-start">CANCELLED</span>
                                        @else
                                        <span class="info-box-text badge badge-warning align-self-start">PENDING</span>
                                        @endif
                                        <span class="info-box-text"><strong>{{ $order->transaction_code
                                                }}</strong></span>
                                        <span class="info-box-number">Total:
                                            &#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</span>
                                    </div>
                                    <span>
                                        @if ($order->order_status === 'Cancelled')
                                        {{-- <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#toRemove" wire:click="toRemove({{ $order->id }})">
                                            <i class="fa-solid fa-xmark"></i>
                                            Remove
                                        </a> --}}
                                        <a href="#" class="btn btn-outline-danger">
                                            <i class="fa-solid fa-xmark"></i>
                                            Cancelled
                                        </a>

                                        <button type="button" onclick="rePurchase({{ $order->id }})" class="btn btn-primary mt-1">
                                            <i class="fa-solid fa-rotate-right"></i>
                                            Re-purchase
                                        </button>
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
                            <div class="card shadow">
                                <div class="card-body">
                                    <h2>
                                        <span class="ml-3">
                                            <strong>Grand Total:
                                                &#8369;{{ number_format($grandTotalCancelled, 2, '.', ',') }}</strong>
                                        </span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-message {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
    <script>
        document.addEventListener('livewire:navigated', function() {
            @this.on('alert', function(event) {
                const { title, type, message } = event.alerts;

                Swal.fire({
                    title: title,
                    icon: type,
                    text: message,
                    confirmButtonText: 'Close',
                    confirmButtonColor: 'gray'
                });
            });

            @this.on('closeModal', function() {
                $('#cancel').modal('hide');
                $('#order-received').modal('hide');
            })
        });
    </script>
    <script>
        function rePurchase(orderId) {
            Swal.fire({
                title: 'Are you sure you want to re-purchase this order?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, re-purchase it!',
            }).then((result) => {
               if(result.isConfirmed) {
                @this.dispatch('handleClick', { orderId });
               }
            });
        }
    </script>
</div>
