<div>
    @include('livewire.normal-view.products.view')

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

    <div class="d-md-none mb-2">
        <div class="sticky-top bg-white border-bottom py-2 px-3" style="top: 0; z-index: 1;">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="search" class="form-control border-start-0 ps-0" placeholder="Search products..."
                            wire:model.live.debounce.500ms="search" style="height: 50px;">
                        @if ($search)
                            <button class="btn btn-outline-secondary border-start-0" wire:click="$set('search', '')">
                                <i class="fas fa-times"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4" x-data='{ grid: "3" }'>
        <div class="row">
            <div class="col-lg-3 col-md-4 mb-4 d-none d-md-block">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px; z-index: 1;">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="fw-bold mb-0"><i class="fas fa-filter me-2"></i>Filters</h5>
                            <button type="button" wire:loading.attr='disabled' wire:target='clearFilters'
                                wire:click="clearFilters" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-broom me-1"></i>Clear All
                            </button>
                        </div>

                        <div class="filter-sidebar">
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-2">Search Products</label>
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
                                <label class="form-label fw-medium mb-2">Customer Rating</label>
                                <div class="rating-filter">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="product_rating"
                                            id="ratingAll" wire:model.live="product_rating" value="All">
                                        <label class="form-check-label" for="ratingAll">
                                            <span class="text-muted">All Ratings</span>
                                        </label>
                                    </div>
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
                                    <small class="text-muted">₱{{ $minPrice ?? 0 }}</small>
                                    <small class="text-muted">₱{{ $maxPrice ?? 'Max' }}</small>
                                </div>
                                <div class="d-flex gap-2 align-items-center mb-3">
                                    <input type="number" class="form-control form-control-sm" placeholder="Min"
                                        wire:model.live.debounce.500ms="minPrice">
                                    <span class="text-muted">-</span>
                                    <input type="number" class="form-control form-control-sm" placeholder="Max"
                                        wire:model.live.debounce.500ms="maxPrice">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium mb-2">Availability</label>
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
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Active Filters:</span>
                                    <span class="fw-medium text-primary">{{ $activeFilters }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="d-md-flex justify-content-between align-items-center mb-4">
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

                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-3 col-6 mt-2" style="padding: 0.5px;" :class="`col-lg-${grid} col-6`">
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
                        <div id="sentinel" wire:loading.remove wire:target='loadMore'></div>
                        <button wire:loading wire:target='loadMore' class="btn btn-outline-primary px-5" disabled>
                            <span class="spinner-border spinner-border-sm me-2"></span>
                            Loading...
                        </button>
                        <button wire:loading.remove wire:target='loadMore' wire:click="loadMore"
                            class="btn btn-primary px-5">
                            <i class="fas fa-arrow-down me-2"></i>Load More Products
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .container-fluid {
            max-width: 1400px;
        }

        .filter-sidebar {
            z-index: 1;
            max-height: calc(100vh - 300px);
            overflow-y: auto;
            padding: 10px;
        }

        .filter-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .filter-sidebar::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        .filter-sidebar::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 3px;
        }

        .filter-mobile-sidebar {
            scrollbar-width: thin;
            scrollbar-color: #dee2e6 #f8f9fa;
        }

        .filter-mobile-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .filter-mobile-sidebar::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        .filter-mobile-sidebar::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 3px;
        }

        .list-group-item {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .product-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-0.5px);
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

        .rating-stars {
            font-size: 0.9rem;
        }

        .text-light {
            color: #dee2e6 !important;
        }

        .d-lg-none .sticky-top {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
        }

        .bg-opacity-90 {
            opacity: 0.9;
        }

        .bg-opacity-10 {
            background-color: rgba(13, 110, 253, 0.1);
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

        .btn-outline-secondary.active {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
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

            .col-md-8 {
                padding-left: 15px;
            }

            .d-none.d-md-block {
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .product-image-container {
                height: 160px;
            }

            .container-fluid {
                padding-top: 0.5rem;
            }

            .row {
                margin-left: -8px;
                margin-right: -8px;
            }

            .g-3 {
                gap: 12px !important;
            }

            .col-6 {
                padding-left: 8px;
                padding-right: 8px;
            }
        }

        @media (max-width: 576px) {
            .product-image-container {
                height: 130px;
            }

            .card-body {
                padding: 1rem;
            }

            .btn-group-sm .btn {
                padding: 0.25rem 0.5rem;
            }
        }

        .form-check-input {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
            user-select: none;
        }

        .form-select {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .spinner-border {
            vertical-align: middle;
        }

        .text-decoration-line-through {
            text-decoration-thickness: 2px;
        }

        @media (max-width: 767.98px) {
            .container-fluid.py-4 {
                padding-top: 0 !important;
            }

            .col-md-8 {
                width: 100%;
                margin-left: 0;
            }

            .product-card {
                margin-bottom: 0.5rem;
            }

            .g-3>.col-6 {
                margin-bottom: 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const sentinel = document.getElementById('sentinel');
            if (!sentinel) return;

            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && @json($products->count() < $products->total())) {
                    @this.call('loadMore');
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
    </script>
</div>
