<div>
    @if ($this->purchase_completed)
        <div class="confirmation-container">
            <div class="confirmation-card">
                <div class="success-icon">
                    <i class="fas fa-circle-check"></i>
                </div>

                <h1 class="confirmation-title">Order Confirmed!</h1>
                <p class="confirmation-subtitle">Thank you for your purchase. Your order has been successfully submitted
                    and is now being processed.</p>
                <div class="order-details">
                    <div class="detail-row">
                        <span class="detail-label">Order Transaction Codes</span>
                        <div class="d-flex gap-2 flex-column" style="max-height: 70px; overflow-y: auto;">
                            @foreach ($this->order_transaction_codes as $key => $item)
                                <span class="detail-value" wire:key='{{ $key }}'>{{ $item }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Order Date</span>
                        <span class="detail-value">{{ $this->order_date }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Payment Method</span>
                        <span class="detail-value">{{ $this->payment_method }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Total Amount</span>
                        <span class="detail-value highlight-value">₱{{ number_format($this->total_amount, 2) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Estimated Delivery</span>
                        <span class="detail-value">{{ $this->estimated_delivery_date }}</span>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="/orders" wire:navigate class="btn btn-success py-3" id="trackOrderBtn">
                        <i class="bi bi-truck me-2"></i> Track Your Order
                    </a>
                    <a href="/products" wire:navigate class="btn btn-primary py-3" id="continueShoppingBtn">
                        <i class="bi bi-arrow-left me-2"></i> Continue Shopping
                    </a>
                </div>

                {{-- <div class="confirmation-footer">
                    <p>Need help? Contact our <a href="#">customer support</a> or call 09123456789</p>
                    <p class="mt-2">You'll receive shipping updates via email and SMS.</p>
                </div> --}}
            </div>
        </div>
    @else
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h1 class="display-5 fw-bold text-primary">Order Summary</h1>
                        <p class="lead">Review your order details before proceeding</p>
                    </div>

                    <div class="card order-summary-card">
                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0"><i class="fas fa-bag-check me-2"></i>Your Order Details</h5>
                            </div>
                            <div class="text-end">
                                <p class="mb-0">Expected Delivery</p>
                                <h6 class="mb-0">{{ $this->estimated_delivery_date }}</h6>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h5 class="summary-title">Ordered Items</h5>

                                    @foreach ($this->orderSummaries as $index => $summary)
                                        <div class="row product-row align-items-center" wire:key='{{ $index }}'>
                                            <div class="col-2">
                                                @if (Storage::exists($summary->product->product_image))
                                                    <img src="{{ Storage::url($summary->product->product_image) }}"
                                                        class="product-image"
                                                        alt="{{ $summary->product->product_name }}">
                                                @else
                                                    <img src="{{ url($summary->product->product_image) }}"
                                                        class="product-image"
                                                        alt="{{ $summary->product->product_name }}">
                                                @endif
                                            </div>
                                            <div class="col-7">
                                                <h6 class="mb-1" style="cursor: pointer;"
                                                    :class="{ 'text-truncate': !showText }" x-data="{ showText: false }">
                                                    <span class="text-capitalize" x-cloak
                                                        x-on:click="showText = !showText"><strong>{{ $summary->product->product_name }}</strong></span>
                                                </h6>
                                                <p class="text-muted mb-0 small">{{ $summary->product->product_code }}
                                                </p>
                                                <p class="mb-0 small">Quantity: {{ $summary->order_quantity }}</p>
                                                <p class="mb-0 small text-info">Discount:
                                                    {{ $summary->product->discount }}</p>
                                            </div>
                                            <div class="col-3 text-end">
                                                <div class="price-highlight">
                                                    ₱{{ number_format($summary->product->product_price, 2) }}</div>
                                                <div class="text-muted text-decoration-line-through">
                                                    ₱{{ number_format($summary->product->product_old_price, 2) }}
                                                </div>
                                                <div class="text-sm text-success">
                                                    saved:
                                                    ₱{{ number_format($summary->product->product_old_price * $summary->order_quantity - $summary->product->product_price * $summary->order_quantity, 2, '.', ',') }}
                                                </div>
                                                <div class="text-sm text-primary">
                                                    total:
                                                    ₱{{ number_format($summary->product->product_price * $summary->order_quantity, 2, '.', ',') }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="summary-section mt-4">
                                        <h5 class="summary-title">Price Details</h5>
                                        <div class="row mb-2">
                                            <div class="col-8">Total Original Amount
                                                ({{ count($this->orderSummaries) }} items)
                                            </div>
                                            <div class="col-4 text-end">
                                                ₱{{ number_format(
                                                    $this->orderSummaries->sum(function ($item) {
                                                        return $item->product->product_old_price * $item->order_quantity;
                                                    }),
                                                    2,
                                                ) }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-8">Total Discount/Saved</div>
                                            <div class="col-4 text-end">
                                                -
                                                ₱{{ number_format(
                                                    $this->orderSummaries->sum(function ($item) {
                                                        return $item->product->product_old_price * $item->order_quantity -
                                                            $item->product->product_price * $item->order_quantity;
                                                    }),
                                                    2,
                                                ) }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-8">Subtotal ({{ count($this->orderSummaries) }} items)
                                            </div>
                                            <div class="col-4 text-end">
                                                ₱{{ number_format(
                                                    $this->orderSummaries->sum(function ($item) {
                                                        return $item->product->product_price * $item->order_quantity;
                                                    }),
                                                    2,
                                                ) }}
                                            </div>
                                        </div>
                                        {{-- <div class="row mb-2">
                                        <div class="col-8">Shipping Fee</div>
                                        <div class="col-4 text-end">₱9.99</div>
                                    </div> --}}
                                        <div class="row pt-3 border-top">
                                            <div class="col-8 fw-bold">Total Amount</div>
                                            <div class="col-4 text-end total-amount">
                                                ₱{{ number_format(
                                                    $this->orderSummaries->sum(function ($item) {
                                                        return $item->product->product_price * $item->order_quantity;
                                                    }),
                                                    2,
                                                ) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="summary-section">
                                        <h5 class="summary-title">Payment Method</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="payment-method-icon me-3">
                                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Cash On Delivery</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="summary-section">
                                        <h5 class="summary-title">Shipping Address</h5>
                                        @if (auth()->user()->user_location)
                                            <address class="small">
                                                {{ auth()->user()->user_location }}
                                            </address>
                                        @else
                                            <div>
                                                <p>No address found</p>
                                                <p class="text-danger">Please add a shipping address first to continue
                                                    placing your order.</p>
                                                <button class="btn btn-primary w-100" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#addShippingAddress">
                                                    <i class="fas fa-plus"></i> Add Shipping Address
                                                </button>
                                            </div>
                                        @endif
                                        <p class="mt-2">
                                            <i class="fas fa-phone me-1"></i> {{ auth()->user()->phone_number }}
                                        </p>
                                    </div>
                                    <div class="d-grid gap-1 mt-4">
                                        <button class="btn btn-lg btn-primary mt-2" type="button"
                                            wire:click='placeOrderItems' wire:loading.attr="disabled"
                                            wire:target='placeOrderItems'>
                                            <span wire:loading.remove wire:target='placeOrderItems'>Place Order</span>
                                            <span class="spinner-border" wire:loading
                                                wire:target='placeOrderItems'></span>
                                        </button>
                                        <button class="btn btn-lg btn-danger" type="button"
                                            wire:click='cancelOrderItems'>
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="addShippingAddress" tabindex="-1" aria-labelledby="addShippingAddressLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addShippingAddressLabel">Add your shipping address</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="shippingAddress" class="form-label">Shipping Address</label>
                        <textarea maxlength="200" wire:model='shipping_address' class="form-control" style="resize: none;"
                            id="shippingAddress" rows="4" placeholder="Enter your shipping address (max 200 characters)"></textarea>
                        <span id="limit" class="text-sm"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click='addShippingAddress'
                        wire:loading.attr='disabled' wire:target='addShippingAddress'>Submit</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .order-summary-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 30px;
            border-bottom: none;
        }

        .order-id {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .product-image {
            width: 100px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }

        .product-row {
            border-bottom: 1px solid var(--border-color);
            padding: 15px 0;
            transition: background-color 0.2s;
        }

        .product-row:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .price-highlight {
            color: var(--primary-color);
            font-weight: 600;
        }

        .summary-section {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .summary-title {
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .payment-method-icon {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--primary-color);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .total-amount {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .order-status {
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status-confirmed {
            background-color: rgba(76, 175, 80, 0.15);
            color: #4caf50;
        }

        @media (max-width: 768px) {
            .product-image {
                width: 60px;
                height: 60px;
            }

            .product-details {
                font-size: 0.9rem;
            }

            .total-amount {
                font-size: 1.5rem;
            }
        }

        .confirmation-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .confirmation-card {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            padding: 50px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .confirmation-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(to right, #59b6f8, #3b82f6);
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background-color: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            color: var(--primary-color);
            font-size: 48px;
            animation: scaleIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            70% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .confirmation-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #111827;
        }

        .confirmation-subtitle {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .order-details {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .detail-label {
            color: #6b7280;
            font-weight: 500;
        }

        .detail-value {
            font-weight: 600;
            color: #111827;
        }

        .highlight-value {
            color: var(--primary-color);
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 40px;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            border: none;
            padding: 16px 24px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #0da271;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2);
        }

        .btn-outline-custom {
            background-color: white;
            border: 2px solid #e5e7eb;
            color: #4b5563;
            padding: 16px 24px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary-color);
            background-color: #f8fafc;
            transform: translateY(-2px);
        }

        .confirmation-footer {
            margin-top: 40px;
            color: #9ca3af;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .confirmation-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: var(--primary-color);
            border-radius: 50%;
            opacity: 0;
        }

        @media (max-width: 576px) {
            .confirmation-card {
                padding: 40px 25px;
            }

            .confirmation-title {
                font-size: 1.8rem;
            }

            .success-icon {
                width: 80px;
                height: 80px;
                font-size: 40px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }

        /* Animation for checkmark */
        .checkmark {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: block;
            stroke-width: 3;
            stroke: var(--primary-color);
            stroke-miterlimit: 10;
            margin: 0 auto;
            animation: fill 0.4s ease-in-out 0.4s forwards, scale 0.3s ease-in-out 0.9s both;
        }

        .checkmark-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 3;
            stroke-miterlimit: 10;
            stroke: var(--primary-color);
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark-check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px var(--primary-light);
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('closeModal', function() {
                $('#addShippingAddress').modal('hide');
            });
        });
    </script>

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
            Livewire.on('closeModal', () => {
                $('#addToCart').modal('hide');
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            const textArea = document.getElementById('shippingAddress');
            const limitSpan = document.getElementById('limit');

            textArea.addEventListener('input', function(e) {
                limitSpan.innerText = textArea.value.length > 0 ? `${textArea.value.length}/200` : '';
            });
        })
    </script>
</div>
