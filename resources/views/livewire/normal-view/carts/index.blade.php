<div>
    @include('livewire.normal-view.carts.delete')
    @include('livewire.normal-view.orders.check-out')

    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="fw-bold mb-2">
                    <i class="fas fa-shopping-cart text-primary me-2"></i>My Shopping Cart
                </h2>
                <p class="text-muted mb-0">
                    @if ($cartItems->count() > 0)
                        {{ $cartItems->count() }} item{{ $cartItems->count() > 1 ? 's' : '' }} in your cart
                    @endif
                </p>
            </div>
        </div>

        @if (count($this->cart_ids) > 0)
            <div class="card shadow-sm mb-4 border-0 bg-light">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary rounded-circle p-2">
                                    <i class="fas fa-shopping-bag text-white"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Order Summary</h5>
                                    <p class="text-muted mb-0">{{ count($this->cart_ids) }}
                                        item{{ count($this->cart_ids) > 1 ? 's' : '' }} selected</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <h4 class="fw-bold text-primary mb-1">
                                &#8369;{{ number_format($this->grand_total, 2) }}
                            </h4>
                            @if ($this->total_save > 0)
                                <p class="text-success mb-0">
                                    <i class="fas fa-tag me-1"></i>
                                    You save &#8369;{{ number_format($this->total_save, 2) }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($cartItems->count() > 0)
            <div class="d-flex align-items-center gap-2 mb-2">
                @if (
                    $cartItems->filter(function ($item) {
                            return $item->product && $item->product->product_status === 'Available';
                        })->count() > 0)
                    <div class="form-check d-flex gap-3 align-items-center">
                        <input class="form-check-input" type="checkbox" wire:model.live='select_all'
                            style="width: 18px; height: 18px;">
                        <label class="form-check-label text-muted mt-1 ml-2">Select all</label>
                    </div>
                @endif
            </div>
        @endif
        <div class="row">
            <div @class([
                'col-lg-12' => count($this->cart_ids) === 0,
                'col-lg-8' => count($this->cart_ids) > 0,
            ])>
                @forelse ($cartItems as $item)
                    <div class="card shadow-sm mb-3 border">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center gap-3 p-2">
                                    <input type="checkbox" class="form-check-input mt-1"
                                        style="width: 18px; height: 18px;" wire:model.live='cart_ids'
                                        value="{{ $item->id }}" @if ($item->product->product_status === 'Not Available') disabled @endif>

                                    <span
                                        class="badge ml-2
                                    @if ($item->product->product_status === 'Available') bg-success
                                    @else bg-danger @endif">
                                        {{ $item->product->product_status }}
                                    </span>

                                    <small class="text-muted">
                                        <i class="fas fa-box me-1"></i>
                                        {{ $item->product->product_stock }} pcs available
                                    </small>
                                </div>

                                <button class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1"
                                    data-bs-toggle="modal" data-bs-target="#remove"
                                    wire:click="remove({{ $item->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                    <span class="d-none d-sm-inline">Remove</span>
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <div class="position-relative">
                                        @if (Storage::exists($item->product->product_image))
                                            <img class="rounded-3 w-100" style="height: 150px; object-fit: cover;"
                                                src="{{ Storage::url($item->product->product_image) }}"
                                                alt="{{ $item->product->product_name }}">
                                        @else
                                            <img class="rounded-3 w-100" style="height: 150px; object-fit: cover;"
                                                src="{{ $item->product->product_image }}"
                                                alt="{{ $item->product->product_name }}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <h5 class="fw-bold mb-2">{{ $item->product->product_name }}</h5>

                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <h4 class="fw-bold text-primary mb-0">
                                            &#8369;{{ number_format($item->product->product_price, 2) }}
                                        </h4>
                                        @if ($item->product->product_old_price !== null && $item->product->product_old_price !== $item->product->product_price)
                                            <small class="text-decoration-line-through text-muted">
                                                &#8369;{{ number_format($item->product->product_old_price, 2) }}
                                            </small>
                                        @endif
                                    </div>

                                    @if ($item->product->product_old_price !== null && $item->product->product_old_price !== $item->product->product_price)
                                        <span class="badge bg-danger rounded-pill ms-2">
                                            {{ $item->product->discount }} OFF
                                        </span>
                                    @endif

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-outline-secondary px-3 py-2"
                                                    @if ($item->quantity === 1) onclick="toDelete({{ $item->id }})"
                                                    @else wire:click='decreaseQuantity({{ $item->id }})' @endif>
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <span class="btn btn-light px-4 py-2">
                                                    {{ $item->quantity }}
                                                </span>
                                                <button class="btn btn-outline-secondary px-3 py-2"
                                                    wire:click="updateCartItem({{ $item->id }})">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>

                                            <small class="text-muted">{{ $item->quantity }}
                                                piece{{ $item->quantity > 1 ? 's' : '' }}</small>
                                        </div>

                                        <div class="text-end">
                                            <small class="text-muted d-block">Subtotal</small>
                                            <h5 class="fw-bold text-primary mb-0">
                                                &#8369;{{ number_format($item->quantity * $item->product->product_price, 2) }}
                                            </h5>
                                            @if ($item->product->product_old_price !== null && $item->product->product_old_price !== $item->product->product_price)
                                                <small class="text-success">
                                                    Save
                                                    &#8369;{{ number_format(
                                                        $item->quantity * $item->product->product_old_price - $item->quantity * $item->product->product_price,
                                                        2,
                                                    ) }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-shopping-cart text-muted" style="font-size: 80px;"></i>
                        </div>
                        <h3 class="text-muted mb-3">Your cart is empty</h3>
                        <p class="text-muted mb-4">Add some products to get started with your shopping</p>
                        <a wire:navigate href="/products" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-shopping-bag me-2"></i>Browse Products
                        </a>
                    </div>
                @endforelse
            </div>

            @if (count($this->cart_ids) > 0)
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Order Summary</h5>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Items ({{ count($this->cart_ids) }})</span>
                                <span>&#8369;{{ number_format($this->grand_total, 2) }}</span>
                            </div>

                            @if ($this->total_save > 0)
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-success">Discount</span>
                                    <span class="text-success">-&#8369;{{ number_format($this->total_save, 2) }}</span>
                                </div>
                            @endif

                            <div class="border-top pt-3 mt-2">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold mb-0">Total Amount</h5>
                                    <h3 class="fw-bold text-primary mb-0">
                                        &#8369;{{ number_format($this->grand_total, 2) }}
                                    </h3>
                                </div>

                                @if (count($this->cart_ids) > 0)
                                    <button wire:loading.attr="disabled" wire:target='cart_ids'
                                        class="btn btn-primary btn-lg w-100 py-3 d-flex align-items-center justify-content-center gap-2"
                                        data-bs-toggle="modal" data-bs-target="#checkOut">
                                        <i class="fas fa-credit-card"></i>
                                        <span>Proceed to Checkout ({{ count($this->cart_ids) }})</span>
                                    </button>
                                @else
                                    <button class="btn btn-secondary btn-lg w-100 py-3" disabled>
                                        Select items to checkout
                                    </button>
                                @endif

                                <div class="text-center mt-3">
                                    <a wire:navigate href="/products" class="text-decoration-none text-primary">
                                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .btn-group .btn {
            border-color: #dee2e6;
        }

        .btn-group .btn:hover {
            background-color: #f8f9fa;
        }

        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
        }

        .sticky-top {
            z-index: 1;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .form-check-input:disabled {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', () => {
            Livewire.on('toastr', (event) => {
                const {
                    type,
                    message
                } = event.data;
                toastr[type](message, '', {
                    closeButton: true,
                    progressBar: true,
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

        function toDelete(id) {
            Swal.fire({
                icon: "info",
                title: "Remove Item",
                text: "Are you sure you want to remove this item from your cart?",
                showCancelButton: true,
                confirmButtonText: "Yes, remove it",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d"
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
