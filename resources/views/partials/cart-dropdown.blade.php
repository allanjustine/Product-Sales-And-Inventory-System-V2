@role('user')
    <div class="position-fixed d-none d-sm-block" style="right: 0; top: 100px; z-index: 1;" id="cartIcon">
        <div class="position-relative d-flex justify-content-end me-4" id="main-cart" x-data="{ open: false }">
            <button type="button" class="btn bt-link p-3 rounded-circle shadow-sm position-relative" id="cart-dropdown"
                @click="open = !open">
                <i class="fas fa-shopping-cart fs-5"></i>
                @if ($carts->count() > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        id="badge-cart">
                        {{ $carts->count() }}
                        <span class="visually-hidden">items in cart</span>
                    </span>
                @endif
            </button>
            <div id="myDiv" class="bg-white border shadow-lg rounded-3 position-absolute top-100 end-0 mt-2"
                style="width: 380px; max-height: 500px; overflow: hidden;" x-cloak x-show="open"
                @click.outside="open = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0">

                <!-- Cart Header -->
                <div class="sticky-top bg-white border-bottom rounded-top-3 p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-shopping-cart me-2"></i>My Cart
                            @if ($carts->count() > 0)
                                <span class="text-muted fs-6 fw-normal">({{ $carts->count() }} items)</span>
                            @endif
                        </h4>
                        <button @click="open = false" class="btn btn-sm btn-link text-muted p-0">
                            <i class="fas fa-times fs-5"></i>
                        </button>
                    </div>
                </div>
                <div class="cart-items-container" style="max-height: 300px; overflow-y: auto;">
                    @if ($carts->count() === 0)
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-shopping-cart text-muted" style="font-size: 64px;"></i>
                            </div>
                            <h5 class="text-muted mb-2">Your cart is empty</h5>
                            <p class="text-muted mb-0">Add items to get started</p>
                        </div>
                    @else
                        @foreach ($carts as $item)
                            <div class="cart-item p-4 border-bottom" key="{{ $item->id }}">
                                <div class="d-flex gap-3">
                                    <div class="position-relative flex-shrink-0">
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" wire:model.live='cart_ids' value="{{ $item->id }}"
                                                @if ($item->product->product_status === 'Not Available' || $item->product->productStocks() < $item->quantity) disabled @endif
                                                class="form-check-input mt-1">
                                            @if (Storage::disk('public')->exists($item->product->productImages()?->first()?->path))
                                                <img class="rounded-3" style="width: 80px; height: 80px; object-fit: cover;"
                                                    src="{{ Storage::url($item->product->productImages()?->first()?->path) }}"
                                                    alt="{{ $item->product->product_name }}">
                                            @else
                                                <img class="rounded-3" style="width: 80px; height: 80px; object-fit: cover;"
                                                    src="{{ url($item->product->productImages()?->first()?->path) }}"
                                                    alt="{{ $item->product->product_name }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0 fw-bold text-truncate" style="max-width: 200px;">
                                                {{ $item->product->product_name }}
                                            </h6>
                                            <button class="btn btn-sm btn-link text-danger p-0" data-bs-toggle="modal"
                                                data-bs-target="#remove" wire:click="remove({{ $item->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span
                                                class="badge
                                                @if ($item->product->product_status === 'Available') bg-success
                                                @else bg-danger @endif">
                                                {{ $item->product->product_status }}
                                            </span>
                                            <small class="text-muted">Stock: {{ $item->product->shortProductStocks() }}
                                                pcs</small>
                                        </div>

                                        @if ($item->hasVariation())
                                            <div class="d-flex flex-wrap align-items-center mb-2">
                                                <div class="d-flex gap-2 align-items-center">
                                                    @if ($item->product->productSizes->isNotEmpty())
                                                        <div>
                                                            <label for="size" class="text-sm">Size</label>
                                                            <select wire:model.live='product_size_ids.{{ $item->id }}'
                                                                class="form-select">
                                                                @foreach ($item->product->productSizes as $size)
                                                                    <option value="{{ $size->id }}"
                                                                        wire:key='{{ $size->id }}'
                                                                        {{ $size->stock === 0 ? 'disabled' : '' }}>
                                                                        {{ $size->name }}
                                                                        ({{ $size->stock ?: 'OUT OF STOCK' }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                    @if ($item->product->productColors->isNotEmpty())
                                                        <div>
                                                            <label for="color" class="text-sm">Color</label>
                                                            <select wire:model.live='product_color_ids.{{ $item->id }}'
                                                                class="form-select">
                                                                @foreach ($item->product->productColors as $color)
                                                                    <option value="{{ $color->id }}"
                                                                        wire:key='{{ $color->id }}'
                                                                        {{ $color->stock === 0 ? 'disabled' : '' }}>
                                                                        {{ $color->name }}
                                                                        ({{ $color->stock ?: 'OUT OF STOCK' }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        @if ($item->product->product_old_price !== null && $item->product->product_old_price !== $item->product->product_price)
                                            <span class="badge bg-danger rounded-pill">
                                                {{ $item->product->discount }}
                                            </span>
                                        @endif
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fs-6 fw-bold text-primary">
                                                    &#8369;{{ number_format($item->product->product_price, 2) }}
                                                </span>
                                                @if ($item->product->product_old_price !== null && $item->product->product_old_price !== $item->product->product_price)
                                                    <small class="text-decoration-line-through text-muted">
                                                        &#8369;{{ number_format($item->product->product_old_price, 2) }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button class="btn btn-outline-secondary px-3"
                                                    @if ($item->quantity === 1) onclick="toDelete({{ $item->id }})"
                                                        @else wire:click='decreaseQuantity({{ $item->id }})' @endif>
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <span
                                                    class="btn btn-light px-3">{{ number_format($item->quantity) }}</span>
                                                <button class="btn btn-outline-secondary px-3"
                                                    wire:click="increaseQuantity({{ $item->id }})">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted d-block">Subtotal</small>
                                                <strong class="text-primary">
                                                    &#8369;{{ number_format($item->product->product_price * $item->quantity, 2) }}
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if ($carts->count() > 0)
                    <div class="bg-white border-top rounded-bottom-3 p-4">
                        <!-- Total -->
                        @if ($total > 0)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h5 class="mb-0 fw-bold">Grand Total</h5>
                                </div>
                                <h4 class="mb-0 fw-bold text-primary">
                                    &#8369;{{ number_format($total, 2) }}
                                </h4>
                            </div>
                        @endif
                        <div class="d-flex align-items-center gap-3">
                            @if (
                                $carts->filter(function ($item) {
                                        return $item->product &&
                                            $item->product->product_status === 'Available' &&
                                            $item->product->productStocks() >= $item->quantity;
                                    })->count() > 0)
                                <div class="form-check d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" wire:model.live="select_all"
                                        style="width: 20px; height: 20px;">
                                    <label class="form-check-label text-muted ml-2">Select all</label>
                                </div>
                            @endif

                            <button
                                @if (count($this->cart_ids) > 0) data-bs-toggle="modal"
                                    data-bs-target="#checkOut"
                                @else
                                    disabled @endif
                                class="btn btn-primary btn-lg flex-grow-1 d-flex align-items-center justify-content-center gap-2 py-3"
                                wire:loading.attr='disabled' wire:target='cart_ids'>
                                <i class="fas fa-credit-card"></i>
                                <span>
                                    Checkout
                                    @if (count($this->cart_ids) > 0)
                                        ({{ count($this->cart_ids) }})
                                    @endif
                                </span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endrole
