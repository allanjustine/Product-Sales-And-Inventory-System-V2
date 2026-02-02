<div>
    <div style="overflow-x: hidden;">
        @include('livewire.normal-view.products.view')
        @include('livewire.normal-view.carts.add-to-cart')
        @include('livewire.normal-view.carts.delete')
        @include('livewire.normal-view.orders.check-out')
        @include('livewire.normal-view.orders.buy-now')

        <!-- Main Layout -->
        <div class="container-fluid py-4">
            <div class="row">
                <!-- Left Sidebar Filters -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                        <div class="card-body">
                            <!-- Header -->
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="fw-bold mb-0"><i class="fas fa-filter me-2"></i>Filters</h5>
                                <button type="button" wire:loading.attr='disabled' wire:target='clearFilters'
                                    wire:click="clearFilters" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-broom me-1"></i>Clear All
                                </button>
                            </div>

                            <!-- Search Box -->
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-2">Search Products</label>
                                <div x-data="{ open: false }" class="position-relative">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="search" class="form-control border-start-0 ps-0"
                                            placeholder="Search products..." x-on:input="open = true"
                                            wire:model.live.debounce.500ms="search">
                                    </div>

                                    <!-- Search Dropdown -->
                                    @if (count($searchLogs) > 0)
                                        <div class="dropdown-menu w-100 mt-1 shadow" x-show="open" x-cloak
                                            @click.outside="open = false" x-transition>
                                            <div class="dropdown-header small text-muted px-3 py-2">
                                                Recent Searches
                                            </div>
                                            @foreach ($searchLogs as $log)
                                                <div class="d-flex align-items-center border-bottom">
                                                    <button type="button" @click="open = false"
                                                        class="dropdown-item text-truncate py-2 flex-grow-1"
                                                        wire:click="searchLog({{ $log->id }})">
                                                        <i class="fas fa-history text-muted me-2"></i>
                                                        {{ $log->log_entry }}
                                                    </button>
                                                    <button type="button" wire:loading.attr='disabled'
                                                        wire:target='searchDelete' class="btn btn-link text-danger px-2"
                                                        wire:click="searchDelete({{ $log->id }})">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                            <div class="dropdown-divider"></div>
                                            <div class="px-3 py-2">
                                                <a href="#" class="text-danger small"
                                                    wire:click="clearAllLogs({{ auth()?->user()?->id }})">
                                                    <i class="fas fa-trash-alt me-1"></i>Clear all history
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Category Filter -->
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-2">Categories</label>
                                <div class="list-group">
                                    <a href="#"
                                        class="list-group-item list-group-item-action border-0 rounded mb-1 {{ $category_name === 'All' ? 'active' : '' }}"
                                        wire:click="$set('category_name', 'All')">
                                        <i class="fas fa-layer-group me-2"></i>All Categories
                                        <span class="badge bg-secondary float-end">{{ $products->total() }}</span>
                                    </a>
                                    @foreach ($product_categories as $category)
                                        <a href="#"
                                            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ $category_name === $category->category_name ? 'active' : '' }}"
                                            wire:click="$set('category_name', '{{ $category->category_name }}')">
                                            <i class="fas fa-tag me-2"></i>{{ $category->category_name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-2">Price Range</label>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <small class="text-muted">Min</small>
                                    <small class="text-muted">Max</small>
                                </div>
                                <div class="d-flex gap-2 align-items-center mb-3">
                                    <input type="number" class="form-control form-control-sm" placeholder="Min"
                                        wire:model.live.debounce.500ms="minPrice">
                                    <span class="text-muted">-</span>
                                    <input type="number" class="form-control form-control-sm" placeholder="Max"
                                        wire:model.live.debounce.500ms="maxPrice">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model.live="hasDiscount"
                                        id="hasDiscount">
                                    <label class="form-check-label" for="hasDiscount">
                                        <i class="fas fa-percentage text-danger me-1"></i>Show discounted items only
                                    </label>
                                </div>
                            </div>

                            <!-- Ratings Filter -->
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-2">Customer Rating</label>
                                <div class="rating-filter">
                                    @foreach ([5, 4, 3, 2, 1] as $rating)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="product_rating"
                                                id="rating{{ $rating }}" wire:model.live="product_rating"
                                                value="{{ $rating }}">
                                            <label class="form-check-label" for="rating{{ $rating }}">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fas fa-star {{ $i <= $rating ? 'text-warning' : 'text-light' }}"></i>
                                                @endfor
                                                <span class="text-muted ms-2">& above</span>
                                            </label>
                                        </div>
                                    @endforeach
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_rating"
                                            id="ratingAll" wire:model.live="product_rating" value="All">
                                        <label class="form-check-label" for="ratingAll">
                                            <span class="text-muted">All Ratings</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Sort Options -->
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-2">Sort By</label>
                                <select class="form-select" wire:model.live="sort">
                                    <option value="low_to_high">Price: Low to High</option>
                                    <option value="high_to_low">Price: High to Low</option>
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-2">Price Range</label>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <small class="text-muted">Min</small>
                                    <small class="text-muted">Max</small>
                                </div>
                                <div class="d-flex gap-2 align-items-center mb-3">
                                    <input type="number" class="form-control form-control-sm" placeholder="Min"
                                        wire:model.live.debounce.500ms="minPrice">
                                    <span class="text-muted">-</span>
                                    <input type="number" class="form-control form-control-sm" placeholder="Max"
                                        wire:model.live.debounce.500ms="maxPrice">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model.live="hasDiscount"
                                        id="hasDiscount">
                                    <label class="form-check-label" for="hasDiscount">
                                        <i class="fas fa-percentage text-danger me-1"></i>Show discounted items only
                                    </label>
                                </div>
                            </div>

                            <!-- Stock Status -->
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-2">Stock Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model.live="inStockOnly"
                                        id="inStockOnly">
                                    <label class="form-check-label" for="inStockOnly">
                                        <i class="fas fa-check-circle text-success me-1"></i>In stock only
                                    </label>
                                </div>
                            </div>

                            <!-- Quick Stats -->
                            <div class="mt-4 pt-3 border-top">
                                <div class="small text-muted">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Products Found:</span>
                                        <span class="fw-medium">{{ $products->total() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Active Filters:</span>
                                        <span class="fw-medium text-primary">
                                            @php
                                                $activeFilters = 0;
                                                if ($category_name !== 'All') {
                                                    $activeFilters++;
                                                }
                                                if ($product_rating !== 'All') {
                                                    $activeFilters++;
                                                }
                                                if ($search) {
                                                    $activeFilters++;
                                                }
                                            @endphp
                                            {{ $activeFilters }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Products Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="fw-bold mb-1">
                                <i class="fas fa-box-open text-primary me-2"></i>Products
                            </h2>
                            <p class="text-muted mb-0">
                                @if ($search)
                                    Search results for "{{ $search }}"
                                @elseif($category_name !== 'All')
                                    {{ $category_name }} products
                                @else
                                    Browse all products
                                @endif
                            </p>
                        </div>
                        <div class="d-none d-md-block">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary active">
                                    <i class="fas fa-th-large"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="row g-3">
                        @foreach ($products as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <!-- Product Image -->
                                    <div class="position-relative overflow-hidden">
                                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#viewProduct" wire:click="view({{ $product->id }})">
                                            <div class="product-image-container">
                                                @if (Storage::exists($product->product_image))
                                                    <img src="{{ Storage::url($product->product_image) }}"
                                                        alt="{{ $product->product_name }}" class="product-image">
                                                @else
                                                    <img src="{{ url($product->product_image) }}"
                                                        alt="{{ $product->product_name }}" class="product-image">
                                                @endif
                                            </div>
                                        </a>

                                        <!-- Favorite Button -->
                                        <button type="button" class="btn favorite-btn"
                                            wire:click="addToFavorite({{ $product->id }})"
                                            title="{{ $product->favorites->contains('user_id', auth()?->user()?->id) ? 'Remove from favorites' : 'Add to favorites' }}">
                                            <i
                                                class="{{ $product->favorites->contains('user_id', auth()?->user()?->id) ? 'fas' : 'far' }} fa-heart text-danger"></i>
                                        </button>

                                        <!-- Stock Badge -->
                                        <div class="position-absolute top-0 end-0 m-2">
                                            @if ($product->product_stock >= 20)
                                                <span class="badge bg-success bg-opacity-90 text-white">
                                                    <i class="fas fa-check-circle me-1"></i>In Stock
                                                </span>
                                            @elseif ($product->product_stock > 0)
                                                <span class="badge bg-warning bg-opacity-90 text-dark">
                                                    <i class="fas fa-exclamation-circle me-1"></i>Low Stock
                                                </span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-90 text-white">
                                                    <i class="fas fa-times-circle me-1"></i>Out of Stock
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Discount Badge -->
                                        @if ($product->product_old_price !== null && $product->product_old_price !== $product->product_price)
                                            <div class="position-absolute top-0 start-0 m-2">
                                                <span class="badge bg-danger bg-opacity-90 text-white">
                                                    <i class="fas fa-percentage me-1"></i>{{ $product->discount }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="card-body">
                                        <!-- Category -->
                                        <div class="mb-2">
                                            <small class="text-muted text-uppercase">
                                                <i
                                                    class="fas fa-tag me-1"></i>{{ $product->product_category->category_name }}
                                            </small>
                                        </div>

                                        <!-- Product Name -->
                                        <a href="#" class="text-decoration-none text-dark"
                                            data-bs-toggle="modal" data-bs-target="#viewProduct"
                                            wire:click="view({{ $product->id }})">
                                            <h6 class="card-title fw-bold text-truncate mb-2">
                                                {{ $product->product_name }}
                                            </h6>
                                        </a>

                                        <!-- Rating -->
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="rating-stars me-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fas fa-star {{ $i <= $product->product_rating ? 'text-warning' : 'text-light' }}"></i>
                                                @endfor
                                            </div>
                                            <small class="text-muted">({{ $product->product_votes }})</small>
                                        </div>

                                        <!-- Price -->
                                        <div class="mb-3">
                                            <span class="h5 fw-bold text-primary">
                                                ₱{{ number_format($product->product_price, 2) }}
                                            </span>
                                            @if ($product->product_old_price !== null && $product->product_old_price !== $product->product_price)
                                                <small class="text-decoration-line-through text-muted ms-2">
                                                    ₱{{ number_format($product->product_old_price, 2) }}
                                                </small>
                                            @endif
                                        </div>

                                        <!-- Status Badge -->
                                        <div class="mb-3">
                                            @if ($product->product_status === 'Available')
                                                <span class="badge bg-success bg-opacity-10 text-success">
                                                    <i class="fas fa-check-circle me-1"></i>Available
                                                </span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    <i class="fas fa-times-circle me-1"></i>Not Available
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Action Buttons -->
                                        @role('user')
                                            <div class="d-grid gap-2">
                                                @if ($product->product_status === 'Available')
                                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#addToCart"
                                                        wire:click="addToCart({{ $product->id }})">
                                                        <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                                    </button>
                                                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                        data-bs-target="#toBuyNow"
                                                        wire:click="toBuyNow({{ $product->id }})">
                                                        <i class="fas fa-bolt me-2"></i>Buy Now
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary" disabled>
                                                        <i class="fas fa-clock me-2"></i>Out of Stock
                                                    </button>
                                                @endif
                                            </div>
                                        @endrole

                                        @role('admin')
                                            <div class="d-grid">
                                                <a wire:navigate href="/admin/products" class="btn btn-outline-primary">
                                                    <i class="fas fa-edit me-2"></i>Update Product
                                                </a>
                                            </div>
                                        @endrole
                                    </div>

                                    <!-- Footer Stats -->
                                    <div class="card-footer bg-transparent border-top">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fas fa-shopping-bag me-1"></i>
                                                {{ $product->product_sold }} sold
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-box me-1"></i>
                                                {{ $product->product_stock }} in stock
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Empty States -->
                    @if (!empty($search) && $products->count() === 0)
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-search text-muted" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="fw-bold text-muted mb-3">No products found for "{{ $search }}"</h4>
                            <p class="text-muted mb-4">Try adjusting your search or filters</p>
                            <button wire:click="clearFilters" class="btn btn-primary">
                                <i class="fas fa-filter me-2"></i>Clear Filters
                            </button>
                        </div>
                    @elseif($products->count() === 0)
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-box-open text-muted" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="fw-bold text-muted mb-3">No products available</h4>
                            <p class="text-muted mb-4">Check back soon for new arrivals</p>
                        </div>
                    @endif

                    <!-- Load More -->
                    @if ($products->count() < $products->total())
                        <div class="text-center mt-5">
                            <div id="sentinel" wire:loading.remove wire:target='loadMorePage'></div>
                            <button wire:loading wire:target='loadMorePage' class="btn btn-outline-primary px-5"
                                disabled>
                                <span class="spinner-border spinner-border-sm me-2"></span>
                                Loading...
                            </button>
                            <button wire:loading.remove wire:target='loadMorePage' wire:click="loadMorePage"
                                class="btn btn-primary px-5">
                                <i class="fas fa-arrow-down me-2"></i>Load More Products
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @include('partials.cart-dropdown')
    </div>

    <!-- Custom CSS -->
    <style>
        /* Layout */
        .container-fluid {
            max-width: 1400px;
        }

        /* Filter Sidebar */
        .sticky-top {
            z-index: 1;
        }

        .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        /* Product Cards */
        .product-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .product-image-container {
            height: 200px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .favorite-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .favorite-btn:hover {
            background: white;
            transform: scale(1.1);
        }

        /* Rating Stars */
        .rating-stars {
            font-size: 0.9rem;
        }

        /* Price Styling */
        .text-decoration-line-through {
            text-decoration-thickness: 2px;
        }

        /* Form Elements */
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        /* Search Dropdown */
        [x-cloak] {
            display: none !important;
        }

        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
        }

        .bg-opacity-90 {
            opacity: 0.9;
        }

        /* Animation for infinite scroll */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .product-image-container {
                height: 180px;
            }
        }

        @media (max-width: 768px) {
            .product-image-container {
                height: 160px;
            }

            .sticky-top {
                position: static;
            }
        }

        @media (max-width: 576px) {
            .product-image-container {
                height: 200px;
            }

            .card-body {
                padding: 1rem;
            }
        }

        /* Filter labels */
        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #495057;
        }

        /* Input group styling */
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        /* Rating filter stars */
        .rating-filter .fa-star {
            font-size: 0.9rem;
        }

        /* Active filter count */
        .text-primary {
            color: #0d6efd !important;
        }

        /* Button hover effects */
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.3);
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }

        /* Loading state */
        .spinner-border {
            vertical-align: middle;
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Intersection Observer for infinite scroll
        document.addEventListener('livewire:navigated', function() {
            const sentinel = document.getElementById('sentinel');
            if (!sentinel) return;

            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && @json($products->count() < $products->total())) {
                    @this.call('loadMorePage');
                }
            }, {
                rootMargin: '100px',
            });

            observer.observe(sentinel);

            // Cleanup on page change
            document.addEventListener('livewire:navigate', () => {
                observer.disconnect();
            });
        });

        // Toastr notifications
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

            Livewire.on('closeModal', () => {
                $('#addToCart').modal('hide');
            });
        });

        // SweetAlert alerts
        document.addEventListener('livewire:navigated', () => {
            Livewire.on('alert', function(event) {
                const {
                    title,
                    type,
                    message
                } = event.alerts;
                Swal.fire({
                    icon: type,
                    title: title,
                    html: message,
                    showCloseButton: false,
                    showConfirmButton: false
                });
            });

            Livewire.on('closeModal', function() {
                $('#toBuyNow').modal('hide');
                $('#checkOut').modal('hide');
            });
        });

        // Cart icon position on scroll
        document.addEventListener('livewire:navigated', function() {
            const cartIcon = document.getElementById('cartIcon');
            if (!cartIcon) return;

            const updateCartPosition = () => {
                if (window.scrollY > 85) {
                    cartIcon.style.marginTop = '-270px';
                } else {
                    cartIcon.style.marginTop = '-180px';
                }
            };

            updateCartPosition();
            window.addEventListener('scroll', updateCartPosition);

            // Cleanup
            document.addEventListener('livewire:navigate', () => {
                window.removeEventListener('scroll', updateCartPosition);
            });
        });

        // Quantity decrease confirmation
        function toDelete(id) {
            Swal.fire({
                icon: "warning",
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
            });
        }
    </script>

</div>
