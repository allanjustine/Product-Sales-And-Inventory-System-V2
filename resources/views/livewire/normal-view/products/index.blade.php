<div>
    <div>
        @include('livewire.normal-view.products.view')
        @include('livewire.normal-view.carts.add-to-cart')
        @include('livewire.normal-view.carts.delete')
        @include('livewire.normal-view.orders.check-out')
        @include('livewire.normal-view.orders.buy-now')

        <div class="d-md-none mb-2">
            <div class="sticky-top bg-white border-bottom py-2 px-3" style="top: 0; z-index: 1;">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="search" class="form-control border-start-0 ps-0"
                                placeholder="Search products..." wire:model.live.debounce.500ms="search"
                                style="height: 50px;">
                            @if ($search)
                                <button class="btn btn-outline-secondary border-start-0"
                                    wire:click="$set('search', '')">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
            if ($minPrice || $maxPrice) {
                $activeFilters++;
            }
            if ($sort) {
                $activeFilters++;
            }
            if ($inStockOnly) {
                $activeFilters++;
            }
        @endphp

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-3 col-md-4 mb-4 d-none d-md-block">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="fw-bold mb-0"><i class="fas fa-filter me-2"></i>Filters</h5>
                                <button type="button" wire:loading.attr='disabled' wire:target='clearFilters'
                                    wire:click="clearFilters" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-broom me-1"></i>Clear All
                                </button>
                            </div>

                            <div id="filter-sidebar">
                                <div class="mb-4">
                                    <label class="form-label fw-medium mb-2">Search Products</label>
                                    <div x-data="{ open: false }" class="position-relative">
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                            <input type="search" class="form-control border-start-0 ps-0"
                                                placeholder="Search products..." x-on:input="open = true"
                                                wire:model.live.debounce.500ms="search" style="height: 50px;">
                                        </div>

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
                                                            wire:target='searchDelete'
                                                            class="btn btn-link text-danger px-2"
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
                                            <button type="button"
                                                class="list-group-item list-group-item-action border-0 rounded mb-1 {{ $category_name === $category->category_name ? 'active' : '' }}"
                                                wire:click="$set('category_name', '{{ $category->category_name }}')">
                                                <i class="fas fa-tag me-2"></i>{{ $category->category_name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

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
                                            <i class="fas fa-percentage text-danger me-1"></i>Show discounted items
                                            only
                                        </label>
                                    </div>
                                </div>

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

                                <div class="mb-4">
                                    <label class="form-label fw-medium mb-2">Sort By</label>
                                    <select class="form-select" wire:model.live="sort">
                                        <option value="low_to_high">Price: Low to High</option>
                                        <option value="high_to_low">Price: High to Low</option>
                                    </select>
                                </div>

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
                                            <i class="fas fa-percentage text-danger me-1"></i>Show discounted items
                                            only
                                        </label>
                                    </div>
                                </div>

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
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <div class="small text-muted">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Products Found:</span>
                                        <span class="fw-medium">{{ $products->total() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Active Filters:</span>
                                        <span class="fw-medium text-primary">
                                            {{ $activeFilters }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-8" x-data='{ grid: "3" }'>
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
                        <div class="d-none d-lg-block">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary"
                                    :class="grid === 3 ? 'active' : ''" @click="grid = 3">
                                    <i class="fas fa-th-large"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary"
                                    :class="grid === 4 ? 'active' : ''" @click="grid = 4">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        @foreach ($products as $product)
                            <div class="col-md-6 col-lg-3 col-6" :class="`col-lg-${grid} col-6`">
                                <x-product-list-card :product="$product" />
                            </div>
                        @endforeach
                    </div>

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

    <style>
        .container-fluid {
            max-width: 1400px;
        }

        .sticky-top {
            z-index: 1;
        }

        .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

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
            bottom: 10px;
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

        .rating-stars {
            font-size: 0.9rem;
        }

        .text-decoration-line-through {
            text-decoration-thickness: 2px;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        [x-cloak] {
            display: none !important;
        }

        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
        }

        .bg-opacity-90 {
            opacity: 0.9;
        }

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

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #495057;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .rating-filter .fa-star {
            font-size: 0.9rem;
        }

        .text-primary {
            color: #0d6efd !important;
        }

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

        .spinner-border {
            vertical-align: middle;
        }

        #filter-sidebar {
            z-index: 1;
            max-height: calc(100vh - 300px);
            overflow-y: auto;
            padding: 10px;
        }

        #filter-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #filter-sidebar::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        #filter-sidebar::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 3px;
        }

        #filter-mobile-sidebar {
            scrollbar-width: thin;
            scrollbar-color: #dee2e6 #f8f9fa;
        }

        #filter-mobile-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #filter-mobile-sidebar::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        #filter-mobile-sidebar::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 3px;
        }
    </style>

    <script>
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

            document.addEventListener('livewire:navigate', () => {
                observer.disconnect();
            });
        });

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

        document.addEventListener('livewire:navigated', function() {
            const cartIcon = document.getElementById('cartIcon');
            if (!cartIcon) return;

            const updateCartPosition = () => {
                if (window.scrollY > 85) {
                    cartIcon.style.top = '20px';
                } else {
                    cartIcon.style.top = '100px';
                }
            };

            updateCartPosition();
            window.addEventListener('scroll', updateCartPosition);

            document.addEventListener('livewire:navigate', () => {
                window.removeEventListener('scroll', updateCartPosition);
            });
        });

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
