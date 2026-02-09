<div>
    <div>
        <div wire:ignore.self class="modal fade" id="addToCart" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg" id="addToCartModalContent">
                    <div class="modal-header bg-gradient-primary text-white p-4 border-0" id="addToCartModalHeader">
                        <div class="d-flex align-items-center w-100">
                            <div class="icon-wrapper rounded-circle p-2 me-3" id="cartModalIcon">
                                <i class="fas fa-cart-plus fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="modal-title fw-bold mb-1" id="addToCartModalTitle">Add to Cart</h4>
                                <p class="mb-0 opacity-75" id="addToCartModalSubtitle">Add this product to your shopping
                                    cart</p>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close" id="closeCartModalBtn"></button>
                        </div>
                    </div>

                    <div class="modal-body p-0" id="addToCartModalBody" style="max-height: calc(100vh - 300px);">
                        @if (!$productToBeCart)
                            <div class="loading-state p-5 text-center" id="cartModalLoading">
                                <div class="loading-spinner mb-4" id="cartLoadingSpinner">
                                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"
                                        role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="loading-content" id="cartLoadingContent">
                                    <h5 class="text-muted mb-3" id="cartLoadingTitle">Loading Product Details</h5>
                                </div>
                            </div>
                        @endif

                        @if ($productToBeCart)
                            <div class="add-to-cart-container" id="cartProductContainer">
                                <div class="product-preview-section p-4 border-bottom" id="cartProductPreview">
                                    <div class="product-image-wrapper text-center mb-4 position-relative"
                                        id="cartProductImageWrapper">
                                        @if (Storage::exists($productToBeCart->productImages()?->first()?->path))
                                            <img src="{{ Storage::url($productToBeCart->productImages()?->first()?->path) }}"
                                                alt="{{ $productToBeCart->product_name }}"
                                                class="img-fluid rounded-3 shadow-sm" id="cartProductImage">
                                        @else
                                            <img src="{{ $productToBeCart->productImages()?->first()?->path }}"
                                                alt="{{ $productToBeCart->product_name }}"
                                                class="img-fluid rounded-3 shadow-sm" id="cartProductImage">
                                        @endif

                                        @if (
                                            $productToBeCart->product_old_price !== null &&
                                                $productToBeCart->product_old_price !== $productToBeCart->product_price)
                                            <div class="discount-badge bg-danger text-white position-absolute top-0 end-0 m-2"
                                                id="cartDiscountBadge">
                                                <div class="p-2 text-center">
                                                    <span class="fw-bold"
                                                        id="cartDiscountValue">{{ $productToBeCart->discount }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="product-info text-center" id="cartProductInfo">
                                        <h5 class="product-name fw-bold mb-2 text-capitalize" id="cartProductName">
                                            {{ $productToBeCart->product_name }}
                                        </h5>

                                        <div class="price-section mb-3" id="cartPriceSection">
                                            <div class="current-price fw-bold fs-4 text-primary" id="cartCurrentPrice">
                                                &#8369;{{ number_format($productToBeCart->product_price, 2) }}
                                            </div>
                                            @if (
                                                $productToBeCart->product_old_price !== null &&
                                                    $productToBeCart->product_old_price !== $productToBeCart->product_price)
                                                <div class="old-price text-muted text-decoration-line-through"
                                                    id="cartOldPrice">
                                                    &#8369;{{ number_format($productToBeCart->product_old_price, 2) }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="stock-info mb-4" id="cartStockInfo">
                                            <div class="stock-badge d-inline-flex align-items-center bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-1"
                                                id="cartStockBadge">
                                                <i class="fas fa-boxes me-2 fa-sm" id="stockIcon"></i>
                                                <span class="fw-semibold"
                                                    id="stockCount">{{ number_format($productToBeCart->product_stock) }}
                                                    in stock</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="quantity-section p-4" id="cartQuantitySection">
                                    <div class="quantity-header mb-3" id="quantityHeader">
                                        <h6 class="fw-bold mb-2" id="quantityTitle">
                                            <i class="fas fa-hashtag me-2 text-primary" id="quantityIcon"></i>Select
                                            Quantity
                                        </h6>
                                        <p class="text-muted small mb-0" id="quantityDescription">How many would you
                                            like to add to your cart?</p>
                                    </div>

                                    <form id="addToCartForm">
                                        @csrf
                                        <div class="quantity-input-group" id="cartQuantityGroup">
                                            <div class="input-group input-group-lg shadow-sm" id="quantityInputGroup">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="decrementQuantityBtn"
                                                    wire:click="$set('quantity', {{ $quantity }} - 1)"
                                                    wire:loading.attr="disabled"
                                                    {{ $quantity <= 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-minus" id="decrementIcon"></i>
                                                </button>

                                                <input type="number" class="form-control text-center"
                                                    id="cartQuantityInput" wire:model.live.debounce.500ms="quantity"
                                                    min="1" max="{{ $productToBeCart->product_stock }}"
                                                    aria-label="Quantity">

                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="incrementQuantityBtn"
                                                    wire:click="$set('quantity', {{ $quantity }} + 1)"
                                                    wire:loading.attr="disabled"
                                                    {{ $quantity >= $productToBeCart->product_stock ? 'disabled' : '' }}>
                                                    <i class="fas fa-plus" id="incrementIcon"></i>
                                                </button>
                                            </div>

                                            @error('quantity')
                                                <div class="alert alert-danger alert-dismissible fade show mt-3"
                                                    role="alert" id="quantityErrorAlert">
                                                    <i class="fas fa-exclamation-circle me-2" id="errorIcon"></i>
                                                    <span id="errorMessage">{{ $message }}</span>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close" id="closeErrorBtn"></button>
                                                </div>
                                            @enderror
                                            @if ($productToBeCart->productSizes->isNotEmpty())
                                                <div class="col-12 my-3">
                                                    <h6 class="fw-bold">Sizes</h6>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach ($productToBeCart->productSizes as $productSize)
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
                                            @if ($productToBeCart->productColors->isNotEmpty())
                                                <div class="col-12 my-3">
                                                    <h6 class="fw-bold">Colors</h6>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach ($productToBeCart->productColors as $productColor)
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

                                            <div class="total-price-preview mt-4 p-3 bg-light rounded-3"
                                                id="totalPricePreview">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div id="totalPriceLeft">
                                                        <span class="text-muted" id="totalPriceLabel">Total
                                                            Price:</span>
                                                        <div class="fw-bold fs-4 text-primary" id="totalPrice">
                                                            &#8369;{{ number_format($productToBeCart->product_price * $quantity, 2) }}
                                                        </div>
                                                    </div>
                                                    <div class="text-end" id="totalPriceRight">
                                                        <small class="text-muted d-block" id="priceBreakdown">
                                                            {{ $quantity }} ×
                                                            &#8369;{{ number_format($productToBeCart->product_price, 2) }}
                                                        </small>
                                                        <small class="text-success" id="savingsText">
                                                            <i class="fas fa-save me-1" id="savingsIcon"></i>
                                                            Save:
                                                            &#8369;{{ number_format(($productToBeCart->product_old_price ?? 0) - $productToBeCart->product_price * $quantity, 2) }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if ($productToBeCart)
                        <div class="modal-footer border-top p-4" id="addToCartModalFooter">
                            <div class="d-grid gap-2 w-100" id="cartActionButtons">
                                <button type="button" class="btn btn-primary btn-lg rounded-pill shadow-sm"
                                    id="addToCartConfirmBtn" wire:click="addToCartNow"
                                    wire:target="addToCartNow,quantity,toggleProductVariant" wire:loading.attr="disabled">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span wire:loading.remove wire:target="addToCartNow" id="addToCartText">
                                            <i class="fas fa-cart-plus me-2" id="addToCartIcon"></i>Add to Cart
                                        </span>
                                        <span wire:loading wire:target="addToCartNow" id="addingToCartText">
                                            <span class="spinner-border spinner-border-sm me-2"
                                                id="addingSpinner"></span>
                                            Adding to Cart...
                                        </span>
                                    </div>
                                </button>

                                <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill"
                                    id="cancelCartBtn" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2" id="cancelIcon"></i>Cancel
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        #addToCartModalContent {
            border: none;
            max-width: 450px;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        #addToCartModalHeader {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        }

        #cartModalIcon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        #addToCartModalHeader:hover #cartModalIcon {
            transform: rotate(360deg);
        }

        #addToCartModalTitle {
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        #addToCartModalSubtitle {
            font-size: 0.875rem;
        }

        #cartModalLoading {
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #cartLoadingSpinner {
            animation: cartSpin 1s linear infinite;
        }

        @keyframes cartSpin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #cartLoadingProgress {
            width: 200px;
            margin: 0 auto;
        }

        #cartLoadingMessage {
            max-width: 300px;
            margin: 0 auto;
        }

        #cartProductPreview {
            background: linear-gradient(to bottom, #ffffff, #f8f9fa);
        }

        #cartProductImageWrapper {
            position: relative;
        }

        #cartProductImage {
            width: 180px;
            height: 180px;
            object-fit: contain;
            border: 1px solid #dee2e6;
            transition: transform 0.3s ease;
        }

        #cartProductImage:hover {
            transform: scale(1.05);
        }

        #cartDiscountBadge {
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 0.875rem;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
            animation: cartPulse 2s infinite;
        }

        @keyframes cartPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        #cartProductName {
            color: #2c3e50;
            font-size: 1.25rem;
            line-height: 1.4;
            min-height: 3.5em;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #cartCurrentPrice {
            color: #2c3e50;
            transition: color 0.3s ease;
        }

        #cartOldPrice {
            font-size: 0.9rem;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        #cartStockBadge {
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        #cartStockBadge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(25, 135, 84, 0.1);
        }

        #cartQuantitySection {
            background: #ffffff;
        }

        #quantityTitle {
            color: #2c3e50;
            transition: color 0.3s ease;
        }

        #cartQuantityGroup {
            margin-top: 1rem;
        }

        #quantityInputGroup {
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #dee2e6;
            transition: border-color 0.3s ease;
        }

        #quantityInputGroup:focus-within {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }

        #cartQuantityInput {
            border-color: transparent;
            font-weight: 600;
            font-size: 1.25rem;
            background: transparent;
        }

        #cartQuantityInput:focus {
            box-shadow: none;
            background: transparent;
        }

        #decrementQuantityBtn,
        #incrementQuantityBtn {
            width: 50px;
            border-color: #dee2e6;
            transition: all 0.3s ease;
            background: white;
        }

        #decrementQuantityBtn:hover:not(:disabled),
        #incrementQuantityBtn:hover:not(:disabled) {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }

        #decrementQuantityBtn:disabled,
        #incrementQuantityBtn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f8f9fa;
        }

        #decrementIcon,
        #incrementIcon {
            transition: transform 0.3s ease;
        }

        #decrementQuantityBtn:active #decrementIcon,
        #incrementQuantityBtn:active #incrementIcon {
            transform: scale(0.9);
        }

        #stockLimitInfo {
            transition: opacity 0.3s ease;
        }

        #quantityErrorAlert {
            animation: cartSlideIn 0.3s ease-out;
            border-left: 4px solid #dc3545;
        }

        @keyframes cartSlideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #errorIcon {
            animation: cartBounce 0.5s ease;
        }

        @keyframes cartBounce {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        #totalPricePreview {
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        #totalPricePreview:hover {
            border-color: #0d6efd;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.1);
        }

        #totalPrice {
            color: #0d6efd;
            transition: color 0.3s ease;
        }

        #savingsText {
            transition: color 0.3s ease;
        }

        #savingsIcon {
            animation: cartSavePulse 2s infinite;
        }

        @keyframes cartSavePulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }

            100% {
                opacity: 1;
            }
        }

        #addToCartConfirmBtn {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        #addToCartConfirmBtn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
            background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
        }

        #addToCartConfirmBtn:active:not(:disabled) {
            transform: translateY(0);
        }

        #addToCartConfirmBtn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        #addToCartIcon {
            transition: transform 0.3s ease;
        }

        #addToCartConfirmBtn:hover #addToCartIcon {
            transform: scale(1.2) rotate(-10deg);
        }

        #addingSpinner {
            animation: cartSpin 1s linear infinite;
        }

        #cancelCartBtn {
            border-width: 2px;
            transition: all 0.3s ease;
        }

        #cancelCartBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.1);
            background: rgba(108, 117, 125, 0.05);
            color: gray;
        }

        #cancelIcon {
            transition: transform 0.3s ease;
        }

        #cancelCartBtn:hover #cancelIcon {
            transform: rotate(90deg);
        }

        #securityInfo {
            transition: opacity 0.3s ease;
        }

        #securityIcon {
            color: #28a745;
            animation: cartLockPulse 3s infinite;
        }

        @keyframes cartLockPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        @media (max-width: 576px) {
            #addToCartModalContent {
                margin: 0.5rem;
            }

            #addToCartModalHeader {
                padding: 1.5rem !important;
            }

            #cartProductPreview,
            #cartQuantitySection {
                padding: 1.5rem !important;
            }

            #addToCartModalFooter {
                padding: 1.5rem !important;
            }

            #cartProductImage {
                width: 150px;
                height: 150px;
            }

            #decrementQuantityBtn,
            #incrementQuantityBtn {
                width: 40px;
                padding: 0.5rem;
            }

            #cartQuantityInput {
                font-size: 1.1rem;
            }

            #addToCartConfirmBtn,
            #cancelCartBtn {
                padding: 0.75rem !important;
                font-size: 1rem;
            }

            #addToCartModalTitle {
                font-size: 1.25rem;
            }

            #cartProductName {
                font-size: 1.1rem;
            }

            #cartCurrentPrice {
                font-size: 1.5rem;
            }

            #totalPrice {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 375px) {
            #cartProductImage {
                width: 120px;
                height: 120px;
            }

            #addToCartModalTitle {
                font-size: 1.1rem;
            }

            #cartProductName {
                font-size: 1rem;
            }

            #cartCurrentPrice {
                font-size: 1.25rem;
            }

            #totalPrice {
                font-size: 1.25rem;
            }

            #quantityInputGroup {
                flex-wrap: nowrap;
            }
        }

        #cartQuantityInput::-webkit-inner-spin-button,
        #cartQuantityInput::-webkit-outer-spin-button {
            opacity: 1;
            height: 40px;
            width: 20px;
        }

        #cartQuantityInput:focus,
        #decrementQuantityBtn:focus,
        #incrementQuantityBtn:focus,
        #addToCartConfirmBtn:focus,
        #cancelCartBtn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        }

        #addToCartConfirmBtn:disabled #addToCartIcon {
            animation: cartDisabledPulse 2s infinite;
        }

        @keyframes cartDisabledPulse {

            0%,
            100% {
                opacity: 0.6;
            }

            50% {
                opacity: 0.3;
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('addToCart');

            if (modal) {
                modal.addEventListener('hidden.bs.modal', function() {});

                const quantityInput = document.getElementById('cartQuantityInput');
                const totalPriceElement = document.getElementById('totalPrice');
                const savingsElement = document.getElementById('savingsText');

                if (quantityInput && totalPriceElement) {
                    quantityInput.addEventListener('input', function(e) {
                        const price = parseFloat("{{ $productToBeCart->product_price ?? 0 }}");
                        const oldPrice = parseFloat("{{ $productToBeCart->product_old_price ?? 0 }}");
                        const quantity = parseInt(this.value) || 1;

                        if (price > 0) {
                            const total = price * quantity;
                            totalPriceElement.textContent = '₱' + total.toLocaleString('en-PH', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });

                            totalPriceElement.style.animation = 'none';
                            setTimeout(() => {
                                totalPriceElement.style.animation = 'cartSlideIn 0.3s ease-out';
                            }, 10);

                            // Update savings
                            if (oldPrice > 0 && savingsElement) {
                                const savings = (oldPrice - price) * quantity;
                                if (savings > 0) {
                                    savingsElement.innerHTML =
                                        `<i class="fas fa-save me-1" id="savingsIcon"></i>Save: ₱${savings.toLocaleString('en-PH', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                                }
                            }

                            const priceBreakdown = document.getElementById('priceBreakdown');
                            if (priceBreakdown) {
                                priceBreakdown.textContent =
                                    `${quantity} × ₱${price.toLocaleString('en-PH', {minimumFractionDigits: 2})}`;
                            }
                        }
                    });

                    quantityInput.addEventListener('change', function() {
                        const max = parseInt(this.max) || 999;
                        const value = parseInt(this.value) || 1;

                        if (value > max) {
                            this.value = max;
                            this.dispatchEvent(new Event('input'));
                        } else if (value < 1) {
                            this.value = 1;
                            this.dispatchEvent(new Event('input'));
                        }
                    });
                }

                const decrementBtn = document.getElementById('decrementQuantityBtn');
                const incrementBtn = document.getElementById('incrementQuantityBtn');

                if (decrementBtn) {
                    decrementBtn.addEventListener('click', function() {
                        if (!this.disabled) {
                            this.style.transform = 'scale(0.9)';
                            setTimeout(() => {
                                this.style.transform = 'scale(1)';
                            }, 150);
                        }
                    });
                }

                if (incrementBtn) {
                    incrementBtn.addEventListener('click', function() {
                        if (!this.disabled) {
                            this.style.transform = 'scale(0.9)';
                            setTimeout(() => {
                                this.style.transform = 'scale(1)';
                            }, 150);
                        }
                    });
                }

                document.addEventListener('keydown', function(e) {
                    if (modal.classList.contains('show')) {
                        if (e.key === 'Enter' && !e.target.id === 'cartQuantityInput') {
                            const addButton = document.getElementById('addToCartConfirmBtn');
                            if (addButton && !addButton.disabled) {
                                addButton.click();
                            }
                        }

                        if (e.key === 'Escape') {
                            bootstrap.Modal.getInstance(modal).hide();
                        }

                        if (e.target.id === 'cartQuantityInput') {
                            if (e.key === 'ArrowUp') {
                                e.preventDefault();
                                if (incrementBtn && !incrementBtn.disabled) {
                                    incrementBtn.click();
                                }
                            } else if (e.key === 'ArrowDown') {
                                e.preventDefault();
                                if (decrementBtn && !decrementBtn.disabled) {
                                    decrementBtn.click();
                                }
                            }
                        }
                    }
                });

                const addToCartBtn = document.getElementById('addToCartConfirmBtn');
                if (addToCartBtn) {
                    addToCartBtn.addEventListener('click', function() {
                        if (!this.disabled) {
                            this.style.transform = 'scale(0.98)';
                            setTimeout(() => {
                                this.style.transform = '';
                            }, 150);
                        }
                    });
                }
            }

            document.addEventListener('livewire:navigated', function() {
                const modal = document.getElementById('addToCart');
                if (modal) {
                    modal.addEventListener('hidden.bs.modal', function() {
                        Livewire.dispatch('cart-modal-closed');
                    });
                }
            });
        });

        document.addEventListener('livewire:initialized', function() {
            Livewire.on('open-add-to-cart-modal', function() {
                const modal = new bootstrap.Modal(document.getElementById('addToCart'));
                modal.show();

                setTimeout(() => {
                    const quantityInput = document.getElementById('cartQuantityInput');
                    if (quantityInput) {
                        quantityInput.focus();
                        quantityInput.select();
                    }
                }, 300);
            });
        });
    </script>
</div>
