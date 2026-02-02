@props([
    'product' => null,
])

<div class="card product-card h-100 border shadow-sm">
    <div class="position-relative overflow-hidden">
        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewProduct"
            wire:click="view({{ $product->id }})">
            <div class="product-image-container">
                @if (Storage::exists($product->product_image))
                    <img src="{{ Storage::url($product->product_image) }}" alt="{{ $product->product_name }}"
                        class="product-image">
                @else
                    <img src="{{ url($product->product_image) }}" alt="{{ $product->product_name }}"
                        class="product-image">
                @endif
            </div>
        </a>

        <button type="button" class="btn favorite-btn" wire:click="addToFavorite({{ $product->id }})"
            title="{{ $product->favorites->contains('user_id', auth()?->user()?->id) ? 'Remove from favorites' : 'Add to favorites' }}">
            <i
                class="{{ $product->favorites->contains('user_id', auth()?->user()?->id) ? 'fas' : 'far' }} fa-heart text-danger"></i>
        </button>

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

        @if ($product->product_old_price !== null && $product->product_old_price !== $product->product_price)
            <div class="position-absolute top-0 start-0 m-2">
                <span class="badge bg-danger bg-opacity-90 text-white">
                    <i class="fas fa-percentage me-1"></i>{{ $product->discount }}
                </span>
            </div>
        @endif
    </div>

    <div class="card-body d-flex flex-column">
        <div class="mb-2">
            <small class="text-muted text-uppercase">
                <i class="fas fa-tag me-1"></i>{{ $product->product_category->category_name }}
            </small>
        </div>

        <a href="#" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#viewProduct"
            wire:click="view({{ $product->id }})" title="{{ $product->product_name }}">
            <h6 class="card-title fw-bold text-truncate mb-2 w-100">
                {{ $product->product_name }}
            </h6>
        </a>

        <div class="d-flex align-items-center mb-2">
            <div class="rating-stars me-2">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= $product->product_rating ? 'text-warning' : 'text-muted' }}"></i>
                @endfor
            </div>
            <small class="text-muted">({{ $product->product_votes }})</small>
        </div>

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

        @role('user')
            <div class="d-grid gap-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCart"
                    wire:click="addToCart({{ $product->id }})">
                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                </button>
                @if ($product->product_status === 'Available')
                    @if ((int) $product->product_stock === 0)
                        <button class="btn btn-danger" disabled>
                            <i class="fas fa-circle-xmark me-2"></i>Out of Stock
                        </button>
                    @else
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#toBuyNow"
                            wire:click="toBuyNow({{ $product->id }})">
                            <i class="fas fa-bolt me-2"></i>Buy Now
                        </button>
                    @endif
                @else
                    <button class="btn btn-secondary" disabled>
                        <i class="fas fa-clock me-2"></i>Not Available
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
