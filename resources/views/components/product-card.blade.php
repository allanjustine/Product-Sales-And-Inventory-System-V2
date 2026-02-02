<div class="card product-card border shadow-sm h-100">
    <div class="position-relative">
        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewProduct"
            wire:click="view({{ $product->id }})">
            <div class="overflow-hidden" style="height: 200px;">
                @if (Storage::exists($product->product_image))
                    <img src="{{ Storage::url($product->product_image) }}" alt="{{ $product->product_name }}"
                        class="product-image w-100 h-100">
                @else
                    <img src="{{ $product->product_image }}" alt="{{ $product->product_name }}"
                        class="product-image w-100 h-100">
                @endif
            </div>
        </a>

        @auth
            <button type="button" class="favorite-btn border-0"
                title="{{ $product->favorites->contains('user_id', auth()->user()->id) ? $product->favorites->count() . ' people added this to favorites' : 'Add to favorites' }}"
                wire:click="addToFavorite({{ $product->id }})">
                <i
                    class="{{ $product->favorites->contains('user_id', auth()->user()->id) ? 'fas' : 'far' }} fa-heart text-danger fa-lg"></i>
            </button>
        @endauth

        <div class="product-badge">
            @if ($badgeType === 'top')
                <span class="badge bg-primary px-3 py-2">
                    <i class="fas fa-medal me-1"></i>{{ $badgeText }}
                </span>
            @elseif($badgeType === 'popular')
                <span class="badge bg-warning px-3 py-2">
                    <i class="fas fa-fire me-1"></i>{{ $badgeText }}
                </span>
            @elseif($badgeType === 'latest')
                <span class="badge bg-info px-3 py-2">
                    <i class="fas fa-bolt me-1"></i>{{ $badgeText }}
                </span>
            @endif
        </div>

        @if ($product->product_old_price !== null && $product->product_old_price !== $product->product_price)
            <div class="discount-badge">
                {{ $product->discount }}
            </div>
        @endif
    </div>

    <div class="card-body d-flex flex-column">
        <small class="text-muted text-uppercase mb-1">
            {{ $product->product_category->category_name }}
        </small>

        <a href="#" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#viewProduct"
            wire:click="view({{ $product->id }})">
            <h6 class="card-title fw-bold mb-2 text-truncate w-100">
                {{ $product->product_name }}
            </h6>
        </a>

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

        <div class="mt-auto">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-star text-warning me-1"></i>
                    <span class="fw-bold">{{ $product->product_rating }}/5</span>
                    <small class="text-muted ms-1">({{ $product->product_votes }})</small>
                </div>
                <div>
                    <small class="text-muted">
                        <i class="fas fa-shopping-bag me-1"></i>
                        {{ $product->product_sold }} sold
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
