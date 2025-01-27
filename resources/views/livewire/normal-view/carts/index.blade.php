@section('title', '| My Carts')

<div>
    @include('livewire.normal-view.carts.delete')
    @include('livewire.normal-view.orders.check-out')
    <div class="container">
        <h3 class="mt-4"><i class="fa-light fa-shopping-cart"></i> My Carts</h3>
        <hr>
        <div class="d-flex justify-content-center">
            <div class="card col-md-10 mt-3 shadow rounded">
                <div class="card-body table-responsive">
                    <div class="row">
                        <h5 class="col-4">Description</h5>
                        <h5 class="col-4 text-center">Quantity</h5>
                        <h5 class="col-4 text-end">Action</h5>
                    </div>
                    <hr>
                    @forelse ($cartItems as $item)
                    <div class="row mb-3 mt-3">
                        <div class="col-4">
                            <p>
                                @if (Storage::exists($item->product->product_image))
                                <img style="width: 70px; height: 70px; border-radius:50%;" src="{{ Storage::url($item->product->product_image) }}" alt="">
                                @else
                                <img style="width: 70px; height: 70px; border-radius:50%;" src="{{ $item->product->product_image }}" alt="">
                                @endif
                            </p>
                            <p>
                                <span class="text-capitalize"><strong>{{ $item->product->product_name }}</strong></span>
                            </p>
                            <p>
                                <span>&#8369;{{ number_format($item->product->product_price, 2, '.', ',') }}</span>
                            </p>
                            <p>
                                x{{ $item->quantity }}PC(s)
                            </p>
                            <hr>
                            <p>
                                <span class="item-price">Sub total: &#8369;{{ number_format($item->quantity * $item->product->product_price, 2, '.', ',') }}</span>
                            </p>
                        </div>
                        <div class="col-4 text-center">
                            <div class="btn-group">
                                <button class="btn border" wire:click="decreaseQuantity({{ $item->id }})"><i class="far fa-minus"></i></button><span class="p-3">{{ $item->quantity }}</span><button class="btn border" wire:click="updateCartItem({{ $item->id }})"><i class="far fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column align-items-end">
                            <button class="btn btn-primary mt-2 checkout" data-toggle="modal" data-target="#checkOut" wire:click="checkOut({{ $item->id }})">Checkout</button>
                            <button class="btn btn-danger mt-2" data-toggle="modal" data-target="#remove" wire:click="remove({{ $item->id }})">Remove</button>
                        </div>
                    </div>
                    <hr>
                    @empty
                    <h5 class="text-center"><i class="fa-regular fa-cart-xmark" style="font-size: 50px;"></i><br>
                        Your cart is empty. <a href="/products">Click
                            here to add an product to cart.</a></h5>
                    @endforelse
                    <div class="row mt-4">
                        <div class="col text-right">
                            <h4>Grand total: &#8369;<span id="total-price">{{ number_format(
                                $cartItems->sum(function ($cart) {
                                return $cart->product->product_price * $cart->quantity;
                                }),
                                2,
                                ) }}
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toastr', (event) => {
                const data = event;

                toastr[data[0].type](data[0].message, '', {
                    closeButton: true
                    , "progressBar": true
                , })
            })

            Livewire.on('closeModal', () => {
                $('#addToCart').modal('hide');
                $('#remove').modal('hide');
            })
        })

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

</div>
