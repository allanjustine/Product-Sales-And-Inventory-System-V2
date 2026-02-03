<div>
    <div>
        <div wire:ignore.self class="modal fade" id="viewProduct" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white p-4 border-0">
                        <div class="d-flex align-items-center w-100">
                            <div class="icon-wrapper rounded-circle p-2 me-3">
                                <i class="fa-solid fa-box-open fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="modal-title fw-bold mb-1">Product Information</h4>
                                <p class="mb-0 opacity-75">Complete product details and specifications</p>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <div class="modal-body p-0" style="overflow-x: hidden;">
                        @if ($productView)
                            <div class="product-details-container">
                                <div class="row g-0">
                                    <div class="col-lg-6 border-end">
                                        <div
                                            class="product-image-section p-4 p-lg-5 d-flex align-items-center justify-content-center bg-light">
                                            <div class="position-relative product-image-wrapper">
                                                @if (Storage::exists($productView->product_image))
                                                    <img src="{{ Storage::url($productView->product_image) }}"
                                                        alt="{{ $productView->product_name }}"
                                                        class="img-fluid rounded-3 shadow-sm product-main-image">
                                                @else
                                                    <img src="{{ url($productView->product_image) }}"
                                                        alt="{{ $productView->product_name }}"
                                                        class="img-fluid rounded-3 shadow-sm product-main-image">
                                                @endif

                                                @if ($productView->product_old_price !== null && $productView->product_old_price !== $productView->product_price)
                                                    <div
                                                        class="discount-badge-item bg-danger text-white position-absolute top-0 start-0 m-3">
                                                        <div class="p-2 text-center">
                                                            <div class="fw-bold fs-5">{{ $productView->discount }}</div>
                                                            <small class="opacity-75">OFF</small>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="product-info-section p-4 p-lg-5">
                                            <h2 class="product-name fw-bold mb-3" id="product_name">
                                                {{ $productView->product_name }}
                                            </h2>

                                            <div class="product-rating mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="stars me-2">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $productView->product_rating)
                                                                <i class="fa-solid fa-star text-warning"></i>
                                                            @else
                                                                <i class="far fa-star text-secondary"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span class="text-muted small">
                                                        @if ($productView->product_rating === 0)
                                                            No ratings yet
                                                        @else
                                                            {{ number_format($productView->product_rating, 1) }}
                                                            (@short($productView->product_sold) sold)
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="price-section mb-4">
                                                <div class="current-price fw-bold fs-2 text-primary mb-1">
                                                    &#8369;{{ number_format($productView->product_price, 2) }}
                                                </div>
                                                @if ($productView->product_old_price !== null && $productView->product_old_price !== $productView->product_price)
                                                    <div class="old-price text-muted text-decoration-line-through fs-5">
                                                        &#8369;{{ number_format($productView->product_old_price, 2) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row mb-4 g-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="info-card border rounded-3 p-3 h-100">
                                                        <div class="d-flex align-items-center">
                                                            <div
                                                                class="info-icon-content bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                                <i class="fa-solid fa-tag text-white"></i>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted d-block">Category</small>
                                                                <div class="fw-semibold">
                                                                    {{ $productView->product_category->category_name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="info-card border rounded-3 p-3 h-100">
                                                        <div class="d-flex align-items-center">
                                                            <div
                                                                class="info-icon-content bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                                <i class="fa-solid fa-chart-simple text-white"></i>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted d-block">Status</small>
                                                                <div style="font-size: 10px;">
                                                                    @if ($productView->product_status === 'Available')
                                                                        <span
                                                                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                                                            <i
                                                                                class="fa-solid fa-circle-check text-white me-1"></i>
                                                                            AVAILABLE
                                                                        </span>
                                                                    @else
                                                                        <span
                                                                            class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                                                            <i
                                                                                class="fa-solid fa-circle-xmark text-white me-1"></i>
                                                                            NOT
                                                                            AVAILABLE
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="info-card border rounded-3 p-3 h-100">
                                                        <div class="d-flex align-items-center">
                                                            <div
                                                                class="info-icon-content bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                                <i class="fa-solid fa-boxes-stacked text-white"></i>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted d-block">Stock</small>
                                                                <div class="fw-semibold" style="font-size: 10px;">
                                                                    @if ($productView->product_stock)
                                                                        @short($productView->product_stock)
                                                                        units
                                                                    @else
                                                                        <span
                                                                            class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                                                            <i
                                                                                class="fa-solid fa-triangle-exclamation text-white me-1"></i>
                                                                            OUT OF STOCK
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="info-card border rounded-3 p-3 h-100">
                                                        <div class="d-flex align-items-center">
                                                            <div
                                                                class="info-icon-content bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                                <i class="fa-solid fa-chart-line text-white"></i>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted d-block">Total Sold</small>
                                                                <div class="fw-semibold">
                                                                    @short($productView->product_sold)
                                                                    units
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @role('user')
                                                <div class="action-buttons mt-4">
                                                    <button type="button" wire:loading.attr='disabled'
                                                        wire:target='addToCartNowItem'
                                                        wire:click='addToCartNowItem({{ $productView->id }})'
                                                        class="btn btn-primary btn-lg w-100 rounded-pill mb-3">
                                                        <i class="fa-solid fa-cart-plus me-2"></i> Add to Cart
                                                    </button>
                                                    @if ($productView->favorites()->where('product_id', $productView->id)->where('user_id', auth()->user()->id)->exists())
                                                        <button type="button" wire:loading.attr='disabled'
                                                            wire:target='removeToFavorite'
                                                            wire:click='removeToFavorite({{ $productView->favorites()->where('product_id', $productView->id)->where('user_id', auth()->user()->id)->first()->id }})'
                                                            class="btn btn-outline-danger btn-lg w-100 rounded-pill"
                                                            id="remove-to-wishlist">
                                                            <i class="far fa-heart me-2"></i> Remove to Wishlist
                                                        </button>
                                                    @else
                                                        <button type="button" wire:loading.attr='disabled'
                                                            wire:target='addToFavorite'
                                                            wire:click='addToFavorite({{ $productView->id }})'
                                                            class="btn btn-outline-primary btn-lg w-100 rounded-pill"
                                                            id="add-to-wishlist">
                                                            <i class="far fa-heart me-2"></i> Add to Wishlist
                                                        </button>
                                                    @endif
                                                </div>
                                            @endrole
                                        </div>
                                    </div>
                                </div>

                                <div class="product-description-section border-top bg-light-subtle">
                                    <div class="p-4 p-lg-5">
                                        <h5 class="fw-bold mb-3">
                                            <i class="fa-solid fa-align-left me-2 text-primary"></i>Product Description
                                        </h5>
                                        <div class="description-content bg-white rounded-3 p-4 shadow-sm">
                                            <p class="mb-0">{{ $productView->product_description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="loading-skeleton">
                                <div class="row g-0">
                                    <div class="col-lg-6 border-end">
                                        <div
                                            class="p-4 p-lg-5 d-flex align-items-center justify-content-center bg-light">
                                            <div class="placeholder-glow w-100">
                                                <div class="placeholder rounded-3"
                                                    style="height: 300px; width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="p-4 p-lg-5">
                                            <div class="placeholder-glow mb-3">
                                                <div class="placeholder rounded" style="height: 40px; width: 80%;">
                                                </div>
                                            </div>

                                            <div class="placeholder-glow mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="placeholder rounded me-2"
                                                        style="height: 20px; width: 100px;"></div>
                                                    <div class="placeholder rounded"
                                                        style="height: 20px; width: 60px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="placeholder-glow mb-4">
                                                <div class="placeholder rounded" style="height: 48px; width: 150px;">
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-4">
                                                @for ($i = 0; $i < 4; $i++)
                                                    <div class="col-6">
                                                        <div class="border rounded-3 p-3 h-100">
                                                            <div class="d-flex align-items-center">
                                                                <div class="placeholder rounded-circle"
                                                                    style="height: 40px; width: 40px;"></div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    <div class="placeholder rounded mb-2"
                                                                        style="height: 12px; width: 60px;"></div>
                                                                    <div class="placeholder rounded"
                                                                        style="height: 16px; width: 80px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>

                                            <div class="placeholder-glow">
                                                <div class="placeholder rounded-pill mb-3"
                                                    style="height: 48px; width: 100%;"></div>
                                                <div class="placeholder rounded-pill"
                                                    style="height: 48px; width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top bg-light-subtle p-4 p-lg-5">
                                    <div class="placeholder-glow">
                                        <div class="placeholder rounded mb-3" style="height: 24px; width: 200px;">
                                        </div>
                                        <div class="placeholder rounded mb-2" style="height: 16px; width: 100%;">
                                        </div>
                                        <div class="placeholder rounded mb-2" style="height: 16px; width: 90%;"></div>
                                        <div class="placeholder rounded mb-2" style="height: 16px; width: 95%;"></div>
                                        <div class="placeholder rounded" style="height: 16px; width: 80%;"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer border-top p-4">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            @if ($productView)
                                <div class="text-muted small">
                                    <i class="fa-solid fa-info-circle me-2"></i>
                                    Product ID: #{{ str_pad($productView->id, 6, '0', STR_PAD_LEFT) }}
                                </div>
                            @endif
                            <button type="button" class="btn btn-outline-primary px-4 rounded-pill"
                                data-bs-dismiss="modal">
                                <i class="fa-solid fa-times me-2"></i>Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal-content {
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        }

        .product-image-section {
            min-height: 400px;
        }

        .product-image-wrapper {
            max-width: 400px;
            width: 100%;
        }

        .product-main-image {
            width: 100%;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .product-main-image:hover {
            transform: scale(1.02);
        }

        .discount-badge-item {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .product-name {
            color: #2c3e50;
            font-size: 1.75rem;
            text-transform: capitalize;
            line-height: 1.3;
        }

        .stars i {
            font-size: 1.1rem;
            margin-right: 2px;
        }

        .current-price {
            color: #2c3e50;
        }

        .old-price {
            opacity: 0.7;
        }

        #add-to-wishlist:hover {
            color: #0e6ece !important;
        }

        #remove-to-wishlist-to-wishlist:hover {
            color: #cd1763 !important;
        }

        .info-card {
            transition: all 0.3s ease;
            border-color: #e9ecef !important;
        }

        .info-card:hover {
            transform: translateY(-2px);
            border-color: #0d6efd !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.1);
        }

        .info-icon-content {
            width: 50px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-description-section {
            background: linear-gradient(to right, #f8f9fa, #ffffff);
        }

        .description-content {
            border-left: 4px solid #0d6efd;
            line-height: 1.8;
        }

        .action-buttons .btn {
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .action-buttons .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            border: none;
        }

        .action-buttons .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
        }

        .action-buttons .btn-outline-primary:hover {
            background: rgba(13, 110, 253, 0.05);
        }

        .loading-skeleton .placeholder {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        @media (max-width: 992px) {
            .product-image-section {
                min-height: 300px;
            }

            .modal-dialog {
                margin: 1rem;
            }

            .product-info-section,
            .product-image-section {
                padding: 2rem !important;
            }
        }

        @media (max-width: 768px) {
            .row.g-0 {
                flex-direction: column;
            }

            .col-lg-6.border-end {
                border-right: none !important;
                border-bottom: 1px solid #dee2e6;
            }

            .product-name {
                font-size: 1.5rem;
            }

            .current-price {
                font-size: 1.75rem;
            }

            .action-buttons .btn {
                padding: 0.75rem 1rem;
            }

            .info-card {
                padding: 1rem !important;
            }

            .modal-footer {
                flex-direction: column;
                gap: 1rem;
            }

            .modal-footer .small {
                order: 2;
                text-align: center;
            }

            .modal-footer button {
                order: 1;
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .modal-header {
                padding: 1.5rem !important;
            }

            .product-info-section,
            .product-image-section {
                padding: 1.5rem !important;
            }

            .product-description-section {
                padding: 1.5rem !important;
            }

            .info-card {
                padding: 0.75rem !important;
            }

            .stars i {
                font-size: 0.9rem;
            }

            h4.modal-title {
                font-size: 1.25rem;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-details-container,
        .loading-skeleton {
            animation: fadeInUp 0.5s ease-out;
        }

        .modal-body {
            max-height: calc(100vh - 300px);
            overflow-y: auto;
        }

        .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .modal-body::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('viewProduct');

            if (modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    Livewire.dispatch('closedModal');
                });

                const productImage = document.querySelector('.product-main-image');
                if (productImage) {
                    const productImageWrapper = productImage.parentElement;
                    productImageWrapper.addEventListener('mousemove', function(e) {
                        const rect = this.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;

                        const xPercent = x / rect.width;
                        const yPercent = y / rect.height;

                        productImage.style.transformOrigin = `${xPercent * 100}% ${yPercent * 100}%`;
                        productImage.style.transform = 'scale(1.5)';
                    });

                    productImageWrapper.addEventListener('mouseleave', function() {
                        productImage.style.transform = 'scale(1)';
                        productImage.style.transformOrigin = 'center center';
                    });
                }

                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        });

        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('viewProduct');
            if (modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    Livewire.dispatch('closedModal');
                });
            }
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('closeModal', function() {
                $('#viewProduct').modal('hide');
            })
        });
    </script>

</div>
