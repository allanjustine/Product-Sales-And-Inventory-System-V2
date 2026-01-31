<div>
    @include('livewire.normal-view.carts.delete')
    @include('livewire.normal-view.orders.check-out')
    <div class="container">
        <h3 class="mt-4"><i class="fa-light fa-shopping-cart"></i> My Carts</h3>
        <hr>
        <div class="d-flex justify-content-center">
            <div class="card col-md-10 mt-3 shadow rounded">
                <div class="card-body table-responsive">
                    <div class="d-none d-md-block">
                        <div class="d-flex align-items-center">
                            <div class="d-flex gap-2 align-items-center col-4">
                                @if (
                                    $cartItems->filter(function ($item) {
                                            return $item->product && $item->product->product_status === 'Available';
                                        })->count() > 0)
                                    <input style="width: 18px; height: 18px;" wire:click='handleSelectAll'
                                        @if (count($this->cart_ids) ===
                                                $cartItems->filter(function ($item) {
                                                        return $item->product && $item->product->product_status === 'Available';
                                                    })->count()) checked @endif type="checkbox">
                                @endif
                                <h5> Description</h5>
                            </div>
                            <h5 class="col-4 text-center">Quantity</h5>
                            <h5 class="col-4 text-end">Action</h5>
                        </div>
                    </div>
                    <hr>
                    @forelse ($cartItems as $item)
                        <div class="d-flex flex-column position-relative">
                            <span style="position: absolute; top: 0px; right: 10px;" class="text-sm fw-bold">
                                Stock: ({{ $item->product->product_stock }} pcs)
                            </span>
                            <div class="row mb-3 mt-3 align-items-center">
                                <div class="col-4 d-flex gap-2 align-items-center">
                                    <input type="checkbox" style="width: 18px; height: 18px;" wire:model.live='cart_ids'
                                        value="{{ $item->id }}" @if ($item->product->product_status === 'Not Available') disabled @endif>
                                    <p>
                                        @if (Storage::exists($item->product->product_image))
                                            <img style="width: 70px; height: 70px; border-radius:10%;"
                                                src="{{ Storage::url($item->product->product_image) }}" alt="">
                                        @else
                                            <img style="width: 70px; height: 70px; border-radius:10%;"
                                                src="{{ $item->product->product_image }}" alt="">
                                        @endif
                                    </p>
                                </div>
                                <div class="col-4 text-center">
                                    <div class="btn-group">
                                        <button class="btn border" id="decrease-quantity"
                                            @if ($item->quantity === 1) onclick="toDelete({{ $item->id }})" @else wire:click='decreaseQuantity({{ $item->id }})' @endif><i
                                                class="fa-regular fa-minus"></i></button><span
                                            class="p-3">{{ $item->quantity }}</span><button class="btn border"
                                            wire:click="updateCartItem({{ $item->id }})"><i
                                                class="fa-regular fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-4 d-flex flex-column align-items-end">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-danger mt-2 d-flex gap-1 align-items-center"
                                            data-bs-toggle="modal" data-bs-target="#remove"
                                            wire:click="remove({{ $item->id }})"><i
                                                class="fa-regular fa-trash-alt"></i>
                                            <span class="d-none d-md-block">Remove</span></button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="fs-5" style="cursor: pointer;" :class="{ 'text-truncate': !showText }"
                                    x-data="{ showText: false }">
                                    <span class="text-capitalize" x-cloak
                                        x-on:click="showText = !showText"><strong>{{ $item->product->product_name }}</strong></span>
                                </p>
                                <p @class([
                                    'text-success' => $item->product->product_status === 'Available',
                                    'text-danger' => $item->product->product_status === 'Not Available',
                                    'text-sm',
                                ])>
                                    {{ $item->product->product_status }}
                                </p>
                                <p class="fw-bold">
                                    &#8369;{{ number_format($item->product->product_price, 2, '.', ',') }}
                                    @if ($item->product->product_old_price !== null && $item->product->product_old_price !== $item->product->product_price)
                                        <span class="text-muted text-decoration-line-through">(
                                            &#8369;{{ number_format($item->product->product_old_price, 2, '.', ',') }})</span><span
                                            class="flag-discount"> {{ $item->product->discount }}</span>
                                    @endif
                                </p>
                                <p class="fw-semibold">
                                    x{{ $item->quantity }}PC(s)
                                </p>
                                <hr>
                                <p class="fs-6">
                                    <strong class="item-price">Sub total:
                                        &#8369;{{ number_format($item->quantity * $item->product->product_price, 2, '.', ',') }}</strong>
                                    @if ($item->product->product_old_price !== null && $item->product->product_old_price !== $item->product->product_price)
                                        <span class="text-muted">(save
                                            &#8369;{{ number_format(
                                                $item->quantity * $item->product->product_old_price - $item->quantity * $item->product->product_price,
                                                2,
                                                '.',
                                                ',',
                                            ) }})</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <hr>
                    @empty
                        <h5 class="text-center"><i class="fa-regular fa-cart-xmark" style="font-size: 50px;"></i><br>
                            Your cart is empty. <a wire:navigate href="/products">Click
                                here to add an product to cart.</a></h5>
                    @endforelse
                    <h5>
                        <span class="text-muted">
                            @php

                                $totals = $cartItems->reduce(
                                    function ($carry, $cart) {
                                        $carry['totalOldPrice'] +=
                                            $cart->product->product_old_price === null
                                                ? 0
                                                : $cart->product->product_old_price * $cart->quantity;
                                        $carry['totalPrice'] +=
                                            $cart->product->product_old_price === null
                                                ? 0
                                                : $cart->product->product_price * $cart->quantity;
                                        return $carry;
                                    },
                                    ['totalOldPrice' => 0, 'totalPrice' => 0],
                                );

                                $totalSave = $totals['totalOldPrice'] - $totals['totalPrice'];
                            @endphp
                            @if ($totalSave > 0)
                                Total Saved: &#8369;{{ number_format($totalSave, 2) }}
                            @endif
                        </span>
                    </h5>
                    <div class="row mt-4">
                        <div class="col">
                            <h2><strong>
                                    @php
                                        $grandTotal = $cartItems->sum(function ($cart) {
                                            return $cart->product->product_price * $cart->quantity;
                                        });
                                    @endphp
                                    @if ($grandTotal > 0)
                                        Grand total: &#8369;<strong
                                            id="total-price">{{ number_format($grandTotal, 2) }}
                                    @endif
                                </strong>
                            </h2>
                        </div>
                    </div>
                    @if (count($this->cart_ids) > 0)
                        <div class="row">
                            <button wire:loading.attr="disabled" wire:target='cart_ids'
                                class="btn btn-primary mt-2 checkout d-flex gap-1 justify-content-center align-items-center py-3"
                                data-bs-toggle="modal" data-bs-target="#checkOut"><i class="fa-regular fa-check"></i>
                                <span>Proceed to Checkout</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('livewire:navigated', () => {
            Livewire.on('toastr', (event) => {
                const {
                    type,
                    message
                } = event.data;

                toastr[type](message, '', {
                    closeButton: true,
                    "progressBar": true,
                });
            });

            Livewire.on('alert', function(event) {
                const {
                    title,
                    type,
                    message
                } = event.alerts;

                Swal.fire({
                    showConfirmButton: false,
                    title: title,
                    icon: type,
                    html: message
                });
            });

            Livewire.on('closeModal', () => {
                $('#addToCart').modal('hide');
                $('#remove').modal('hide');
                $('#checkOut').modal('hide');
            });
        });
    </script>

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
        const buttonDecrease = document.getElementById('decrease-quantity');

        function toDelete(id) {
            Swal.fire({
                icon: "info",
                title: "To be remove",
                text: "Are you sure you want to remove this item?",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('decreaseQuantity', {
                        itemId: id
                    });
                }
            })
        }
    </script>

</div>
