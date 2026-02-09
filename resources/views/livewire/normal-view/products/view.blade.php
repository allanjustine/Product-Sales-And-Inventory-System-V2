<div>
    <div>
        <div wire:ignore.self class="modal fade" id="viewProduct" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-xl modal-dialog-centered">
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
                                            <div class="position-relative product-image-wrapper" x-data="{ active: 0 }"
                                                x-init="$watch('active', value => {
                                                    const el = $refs['thumb-' + value];
                                                    if (el) {
                                                        el.scrollIntoView({
                                                            behavior: 'smooth',
                                                            inline: 'center',
                                                            block: 'nearest'
                                                        });
                                                    }
                                                })">

                                                <div id="productImagesCarousel" class="carousel slide carousel-fade"
                                                    style="height: 40vh;">
                                                    <div class="carousel-inner" style="height: 40vh;">
                                                        @foreach ($productView->productImages as $key => $image)
                                                            <div class="carousel-item"
                                                                :class="active === {{ $key }} ? 'active' : ''">
                                                                @if (Storage::exists($image->path))
                                                                    <img src="{{ Storage::url($image->path) }}"
                                                                        alt="{{ $image->product_name }}"
                                                                        class="d-block w-100"
                                                                        style="height: 40vh; object-fit: cover;">
                                                                @else
                                                                    <img src="{{ url($image->path) }}"
                                                                        alt="{{ $productView->product_name }}"
                                                                        class="d-block w-100"
                                                                        style="height: 40vh; object-fit: cover;">
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button class="carousel-control-prev" type="button"
                                                        data-bs-target="#productImagesCarousel"
                                                        @click="active = active === 0 ? {{ count($productView->productImages) - 1 }} : active - 1"
                                                        data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button"
                                                        data-bs-target="#productImagesCarousel"
                                                        @click="active = {{ count($productView->productImages) - 1 }} === active ? 0 : active + 1"
                                                        data-bs-slide="next">
                                                        <span class="carousel-control-next-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                                <div class="w-100 gap-2 d-flex align-items-center mt-5"
                                                    style="overflow-x: auto; height: fit-content;"
                                                    x-bind.javascript="scrollTo()">
                                                    @foreach ($productView->productImages as $key => $productImage)
                                                        <div style="width: 50px; height: 50px;"
                                                            @click="active = {{ $key }}">
                                                            @if (Storage::exists($image->path))
                                                                <img type="button" x-ref="thumb-{{ $key }}"
                                                                    src="{{ Storage::url($productImage->path) }}"
                                                                    :class="active === {{ $key }} ? 'active-image' :
                                                                        ''"
                                                                    data-bs-target="#productImagesCarousel"
                                                                    data-bs-slide-to="{{ $key }}"
                                                                    aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                                                    aria-label="Slide {{ $loop->iteration }}"
                                                                    style="width: 50px; height: 50px;"
                                                                    id="product-images">
                                                            @else
                                                                <img type="button" x-ref="thumb-{{ $key }}"
                                                                    src="{{ url($productImage->path) }}"
                                                                    data-bs-target="#productImagesCarousel"
                                                                    :class="active === {{ $key }} ? 'active-image' :
                                                                        ''"
                                                                    data-bs-slide-to="{{ $key }}"
                                                                    aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                                                    aria-label="Slide {{ $loop->iteration }}"
                                                                    style="width: 50px; height: 50px;"
                                                                    id="product-images">
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @if ($productView->product_old_price !== null && $productView->product_old_price !== $productView->product_price)
                                                    <div
                                                        class="discount-badge-item bg-danger text-white position-absolute top-0 start-0 m-3">
                                                        <div class="p-2 text-center">
                                                            <div class="fw-bold fs-5">{{ $productView->discount }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="position-absolute text-sm rounded-lg px-3 py-1"
                                                    style="bottom: 75px; right: 0px; background-color: #e0dadaca;">
                                                    <span
                                                        x-text="`${active + 1}/{{ $productView->productImages->count() }}`"></span>
                                                </div>
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
                                                            @if ($i <= $productView->averageRatings())
                                                                <i class="fa-solid fa-star text-warning"></i>
                                                            @else
                                                                <i class="far fa-star text-secondary"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span class="text-muted small">
                                                        @if ((int) $productView->averageRatings() === 0)
                                                            No ratings yet
                                                        @else
                                                            {{ $productView->averageRatings() }}
                                                            ({{ $productView->shortOrderSold() }} sold)
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="price-section mb-4 d-flex align-items-center gap-2 flex-wrap">
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
                                                                    @if ($productView->productStocks() > 0)
                                                                        {{ $productView->shortProductStocks() }}
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
                                                            <div x-cloak="">
                                                                <small class="text-muted d-block">Total Sold</small>
                                                                <div class="fw-semibold">
                                                                    {{ $productView->shortOrderSold() }}
                                                                    units
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($productView->productSizes->isNotEmpty())
                                                    <div class="col-12">
                                                        <h6 class="fw-bold">Sizes</h6>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @foreach ($productView->productSizes as $productSize)
                                                                <span
                                                                    @role('user') wire:click='toggleProductVariant("size", {{ $productSize->id }})' @endrole
                                                                    @style([
                                                                        'cursor: not-allowed; background-color: #ccc; font-size: 8px;' => $productSize->stock < 1,
                                                                    ]) @class([
                                                                        'selected-color-size' => $this->product_size_id === $productSize->id,
                                                                        'badge flex-grow-1 text-black border p-3',
                                                                    ])
                                                                    id="color-size">
                                                                    {{ $productSize->name }}
                                                                    ({{ $productSize->stock ?: 'OUT OF STOCK' }})
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                        @error('product_size_id')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                @endif
                                                @if ($productView->productColors->isNotEmpty())
                                                    <div class="col-12">
                                                        <h6 class="fw-bold">Colors</h6>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @foreach ($productView->productColors as $productColor)
                                                                <span
                                                                    @role('user') wire:click='toggleProductVariant("color", {{ $productColor->id }})' @endrole
                                                                    @style([
                                                                        'cursor: not-allowed; background-color: #ccc; font-size: 8px;' => $productColor->stock < 1,
                                                                    ]) @class([
                                                                        'selected-color-size' => $this->product_color_id === $productColor->id,
                                                                        'badge flex-grow-1 text-black border p-3',
                                                                    ])
                                                                    id="color-size">
                                                                    {{ $productColor->name }}
                                                                    ({{ $productColor->stock ?: 'OUT OF STOCK' }})
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                        @error('product_color_id')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                @endif
                                            </div>

                                            @role('user')
                                                <div class="action-buttons mt-4">
                                                    <button type="button" wire:loading.attr='disabled'
                                                        wire:target='addToCartNowItem,toggleProductVariant'
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

                                <div class="reviews-section border-top bg-white">
                                    <div class="p-3 p-md-4 p-lg-5">
                                        <h5 class="fw-bold mb-3 mb-md-4">
                                            <i class="fa-solid fa-star me-2 text-warning"></i>Customer Reviews
                                            <span class="badge bg-primary bg-opacity-10 text-primary ms-2">12
                                                reviews</span>
                                        </h5>

                                        <div class="reviews-container">
                                            <div class="review-item border-bottom pb-3 pb-md-4 mb-3 mb-md-4">
                                                <div class="d-flex align-items-start mb-2 mb-md-3">
                                                    <div class="me-2 me-md-3">
                                                        <div class="user-avatar rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                                                            style="width: 40px; height: 40px;">
                                                            <i class="fa-solid fa-user text-primary fa-sm"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div
                                                            class="d-flex justify-content-between align-items-start flex-wrap">
                                                            <div class="mb-1">
                                                                <h6 class="fw-bold mb-0" style="font-size: 14px;">John
                                                                    Smith</h6>
                                                                <div class="stars mb-0" style="font-size: 11px;">
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted" style="font-size: 11px;">2 days
                                                                ago</small>
                                                        </div>
                                                        <p class="mb-1 mb-md-2"
                                                            style="font-size: 13px; line-height: 1.4;">Excellent
                                                            product! Exceeded my expectations. The quality is
                                                            outstanding and it arrived earlier than expected.</p>

                                                        <div class="review-images d-flex gap-1 gap-md-2 mt-1 mt-md-2">
                                                            <img src="https://media.istockphoto.com/id/154960461/photo/red-sweat-shirt-on-white-background.webp?a=1&b=1&s=612x612&w=0&k=20&c=Dt1h6jsUfwyJolpalOYanvF5kG6VTWhjDI1zVcbdYJY="
                                                                class="rounded border"
                                                                style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                                                onclick="openImageModal(this.src)">
                                                            <img src="https://images.unsplash.com/photo-1539185441755-769473a23570?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fFNob2VzfGVufDB8fDB8fHww"
                                                                class="rounded border"
                                                                style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                                                onclick="openImageModal(this.src)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-3 mt-md-4">
                                            <button class="btn btn-outline-primary rounded-pill px-3 px-md-4"
                                                style="font-size: 14px;">
                                                <i class="fa-solid fa-eye me-1 me-md-2"></i>View All 12 Reviews
                                            </button>
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
                                                                        style="height: 12px; width: 60px;">
                                                                    </div>
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

    <div class="modal fade reviewImageModal" id="reviewImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0">
                    <img src="" id="modalReviewImage" class="img-fluid rounded" style="max-height: 80vh;">
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal" aria-label="Close" onclick="handleCloseModal()"></button>
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

        .active-image {
            opacity: 0.3;
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

        #product-images:hover {
            opacity: 0.3;
        }

        /* Reviews Section Styles */
        .reviews-section {
            background: linear-gradient(to bottom, #ffffff, #f8f9fa);
        }

        .review-item {
            transition: all 0.3s ease;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .review-images img {
            transition: all 0.3s ease;
        }

        .review-images img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Review Image Modal */
        #reviewImageModal .modal-content {
            background: transparent;
            border: none;
        }

        #reviewImageModal .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
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

        /* Reviews Section Mobile Responsive */
        @media (max-width: 500px) {
            .reviews-section {
                padding: 1rem !important;
            }

            .reviews-section h5 {
                font-size: 1rem !important;
                margin-bottom: 1rem !important;
            }

            .reviews-section .badge {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
            }

            .review-item {
                padding-bottom: 0.75rem !important;
                margin-bottom: 0.75rem !important;
            }

            .user-avatar {
                width: 35px !important;
                height: 35px !important;
                min-width: 35px !important;
            }

            .user-avatar i {
                font-size: 0.875rem !important;
            }

            .review-item h6 {
                font-size: 13px !important;
                line-height: 1.2;
            }

            .review-item .stars {
                font-size: 10px !important;
            }

            .review-item .stars i {
                margin-right: 1px;
            }

            .review-item p {
                font-size: 12px !important;
                line-height: 1.3 !important;
                margin-bottom: 0.5rem !important;
            }

            .review-item small {
                font-size: 10px !important;
            }

            .review-images {
                margin-top: 0.25rem !important;
            }

            .review-images img {
                width: 50px !important;
                height: 50px !important;
                min-width: 50px !important;
            }

            /* Button adjustments */
            .reviews-section .btn {
                font-size: 13px !important;
                padding: 0.4rem 1rem !important;
            }

            .reviews-section .btn i {
                font-size: 12px !important;
            }

            /* Reduce spacing */
            .review-item .d-flex.align-items-start {
                margin-bottom: 0.5rem !important;
            }

            /* Make review content more compact */
            .review-item .flex-grow-1 {
                padding-left: 0.25rem;
            }
        }

        @media (max-width: 400px) {
            .user-avatar {
                width: 30px !important;
                height: 30px !important;
                min-width: 30px !important;
            }

            .user-avatar i {
                font-size: 0.75rem !important;
            }

            .review-item h6 {
                font-size: 12px !important;
            }

            .review-item p {
                font-size: 11px !important;
            }

            .review-images img {
                width: 45px !important;
                height: 45px !important;
                min-width: 45px !important;
            }

            .review-item .stars {
                font-size: 9px !important;
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

            /* Reviews responsive */
            .review-images img {
                width: 60px !important;
                height: 60px !important;
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

            .reviews-section {
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

            .user-avatar {
                width: 40px;
                height: 40px;
            }

            .user-avatar i {
                font-size: 1rem !important;
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
            max-height: calc(100vh - 250px);
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

        #color-size:hover {
            background: #e4e7ee;
            cursor: pointer;
        }

        .selected-color-size {
            background: #e4e7ee;
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

        // Function to open review image modal
        function openImageModal(src) {
            document.getElementById('modalReviewImage').src = src;
            const modal = new bootstrap.Modal(document.getElementById('reviewImageModal'));
            modal.show();
        }

        function handleCloseModal() {
            const modal = document.getElementById('reviewImageModal');
            const bootstrapBackDrop = document.querySelectorAll('.modal-backdrop');
            bootstrapBackDrop[1].remove();
            modal.style.display = 'none';
        }
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('closeModal', function() {
                $('#viewProduct').modal('hide');
            })
        });
    </script>

</div>
