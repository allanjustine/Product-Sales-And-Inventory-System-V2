@props([
    'product' => null,
])

<div class="card product-card h-100 border shadow-sm">
    <div class="position-relative overflow-hidden">
        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewProduct"
            wire:click="view({{ $product->id }})">
            <div class="product-image-container">
                @if (Storage::disk('public')->exists($product->productImages()?->first()?->path))
                    <img src="{{ Storage::url($product->productImages()?->first()?->path) }}"
                        alt="{{ $product->product_name }}" class="product-image">
                @else
                    <img src="{{ url($product->productImages()?->first()?->path) }}" alt="{{ $product->product_name }}"
                        class="product-image">
                @endif
            </div>
        </a>

        @role('user')
            <button type="button" class="btn favorite-btn" wire:click="addToFavorite({{ $product->id }})"
                title="{{ $product->favorites->contains('user_id', auth()?->user()?->id) ? 'Remove from favorites' : 'Add to favorites' }}">
                <i
                    class="{{ $product->favorites->contains('user_id', auth()?->user()?->id) ? 'fas' : 'far' }} fa-heart text-danger"></i>
            </button>
        @endrole

        <div class="position-absolute top-0 end-0 m-2">
            @if ($product->productStocks() >= 20)
                <span class="badge bg-success bg-opacity-90 text-white" id="stock-badge">
                    <i class="fas fa-check-circle me-1"></i>In Stock
                </span>
            @elseif ($product->productStocks() > 0)
                <span class="badge bg-warning bg-opacity-90 text-dark" id="stock-badge">
                    <i class="fas fa-exclamation-circle me-1"></i>Low Stock
                </span>
            @else
                <span class="badge bg-danger bg-opacity-90 text-white" id="stock-badge">
                    <i class="fas fa-times-circle me-1"></i>Out of Stock
                </span>
            @endif
        </div>

        @if ($product->product_old_price !== null && $product->product_old_price !== $product->product_price)
            <div class="position-absolute top-0 start-0 m-2">
                <span class="badge bg-danger bg-opacity-90 text-white" id="discount-badge">
                    <i class="fas fa-percentage me-1"></i>{{ $product->discount }}
                </span>
            </div>
        @endif
    </div>

    <div class="card-body d-flex flex-column">
        <div class="mb-1">
            <small class="text-muted text-uppercase" id="category">
                <i class="fas fa-tag me-1"></i>{{ $product->product_category->category_name }}
            </small>
        </div>

        <a href="#" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#viewProduct"
            wire:click="view({{ $product->id }})" title="{{ $product->product_name }}">
            <h6 class="card-title fw-bold text-truncate mb-2 w-100" id="product-name">
                {{ $product->product_name }}
            </h6>
        </a>

        <div class="mb-1">
            <span class="h5 fw-bold text-primary" id="price">
                ₱{{ number_format($product->product_price, 2) }}
            </span>
            @if ($product->product_old_price !== null && $product->product_old_price !== $product->product_price)
                <small class="text-decoration-line-through text-muted ms-2" id="old-price">
                    ₱{{ number_format($product->product_old_price, 2) }}
                </small>
            @endif
        </div>

        <div class="mb-1">
            @if ($product->product_status === 'Available')
                <span class="badge bg-success bg-opacity-10 text-success" id="status">
                    <i class="fas fa-check-circle me-1"></i>Available
                </span>
            @else
                <span class="badge bg-danger bg-opacity-10 text-danger" id="status">
                    <i class="fas fa-times-circle me-1"></i>Not Available
                </span>
            @endif
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center" id="rating-sold">
                    <i class="fas fa-star text-warning me-1"></i>
                    <span><span
                            class="fw-semibold">{{ (int) $product->averageRatings() === 0 ? 'No ratings yet' : $product->averageRatings() }}</span>
                        | <span class="text-muted">{{ $product->shortOrderSold() }} sold</span></span>
                </div>
            </div>
        </div>

        @role('user')
            <div class="d-grid gap-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCart" id="buttons"
                    wire:click="addToCart({{ $product->id }})">
                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                </button>
                @if ($product->product_status === 'Available')
                    @if ($product->productStocks() === 0)
                        <button class="btn btn-danger" disabled id="buttons">
                            <i class="fas fa-circle-xmark me-2"></i>Out of Stock
                        </button>
                    @else
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#toBuyNow"
                            id="buttons" wire:click="toBuyNow({{ $product->id }})">
                            <i class="fas fa-bolt me-2"></i>Buy Now
                        </button>
                    @endif
                @else
                    <button class="btn btn-secondary" id="buttons" disabled>
                        <i class="fas fa-clock me-2"></i>Not Available
                    </button>
                @endif
            </div>
        @endrole

        @role('admin')
            <div class="d-grid">
                <a wire:navigate href="/admin/products" id="buttons" class="btn btn-outline-primary">
                    <i class="fas fa-edit me-2"></i>Update Product
                </a>
            </div>
        @endrole
    </div>
</div>

<style>
    @media (max-width: 300px) {
        #stock-badge {
            font-size: 6px;
        }

        #discount-badge {
            font-size: 6px;
            margin-top: 2px;
        }

        #category {
            font-size: 7px;
        }

        #product-name {
            font-size: 9px;
        }

        #price {
            font-size: 11px;
        }

        #old-price {
            font-size: 9px;
        }

        #rating-sold {
            font-size: 8px;
        }

        #status {
            font-size: 8px;
        }

        #buttons {
            font-size: 7px;
        }
    }
</style>
