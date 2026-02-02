<div>
    <div>
        <div wire:ignore.self class="modal fade" id="toBuyNow" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg" id="buyNowModalContent">
                    <div class="modal-header bg-gradient-success text-white p-4 border-0" id="buyNowModalHeader">
                        <div class="d-flex align-items-center w-100">
                            <div class="icon-wrapper rounded-circle p-2 me-3" id="buyNowModalIcon">
                                <i class="fas fa-cart-shopping fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="modal-title fw-bold mb-1" id="buyNowModalTitle">Buy Now</h4>
                                <p class="mb-0 opacity-75" id="buyNowModalSubtitle">Checkout and place your order</p>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close" id="closeBuyNowModalBtn"></button>
                        </div>
                    </div>

                    <div class="modal-body p-0" id="buyNowModalBody" style="max-height: calc(100vh - 300px);">
                        @if (!$orderToBuy)
                            <div class="loading-state p-5 text-center" id="buyNowModalLoading">
                                <div class="loading-spinner mb-4" id="buyNowLoadingSpinner">
                                    <div class="spinner-border text-success" style="width: 3rem; height: 3rem;"
                                        role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($orderToBuy)
                            <div wire:loading wire:target="orderPlaceOrderItem" id="buyNowProcessingOverlay">
                                <div
                                    class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-90 d-flex align-items-center justify-content-center z-3">
                                    <div class="processing-content text-center p-4 rounded-3 shadow-lg"
                                        id="buyNowProcessingContent">
                                        <div class="spinner-border text-success mb-3" style="width: 3rem; height: 3rem;"
                                            role="status" id="buyNowProcessingSpinner">
                                            <span class="visually-hidden">Processing...</span>
                                        </div>
                                        <h5 class="text-success mb-2" id="buyNowProcessingTitle">Processing Your Order
                                        </h5>
                                        <p class="text-muted small mb-0" id="buyNowProcessingMessage">Please wait while
                                            we prepare your checkout...</p>
                                    </div>
                                </div>
                            </div>

                            <div class="buy-now-container" id="buyNowProductContainer">
                                <div class="confirmation-section p-4 border-bottom" id="buyNowConfirmation">
                                    <div class="alert alert-success border-0 rounded-3 shadow-sm" role="alert"
                                        id="buyNowAlert">
                                        <div class="d-flex align-items-center">
                                            <div class="alert-icon me-3" id="buyNowAlertIcon">
                                                <i class="fas fa-question-circle fa-2x"></i>
                                            </div>
                                            <div>
                                                <h5 class="alert-heading mb-2 fw-bold" id="buyNowAlertTitle">Ready to
                                                    Checkout?</h5>
                                                <p class="mb-0" id="buyNowAlertMessage">Are you sure you want to buy
                                                    this product and place it to order?</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-preview-section p-4 border-bottom" id="buyNowProductPreview">
                                    <div class="product-image-wrapper text-center mb-4 position-relative"
                                        id="buyNowImageWrapper">
                                        @if (Storage::exists($orderToBuy->product_image))
                                            <img src="{{ Storage::url($orderToBuy->product_image) }}"
                                                alt="{{ $orderToBuy->product_name }}"
                                                class="img-fluid rounded-3 shadow-sm" id="buyNowProductImage">
                                        @else
                                            <img src="{{ $orderToBuy->product_image }}"
                                                alt="{{ $orderToBuy->product_name }}"
                                                class="img-fluid rounded-3 shadow-sm" id="buyNowProductImage">
                                        @endif

                                        @if ($orderToBuy->product_old_price !== null && $orderToBuy->product_old_price !== $orderToBuy->product_price)
                                            <div class="discount-badge bg-danger text-white position-absolute top-0 end-0 m-2"
                                                id="buyNowDiscountBadge">
                                                <div class="p-2 text-center">
                                                    <span class="fw-bold"
                                                        id="buyNowDiscountValue">{{ $orderToBuy->discount }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="product-info text-center" id="buyNowProductInfo">
                                        <h5 class="product-name fw-bold mb-2 text-capitalize" id="buyNowProductName">
                                            {{ $orderToBuy->product_name }}
                                        </h5>

                                        <div class="price-section mb-3" id="buyNowPriceSection">
                                            <div class="current-price fw-bold fs-4 text-success"
                                                id="buyNowCurrentPrice">
                                                &#8369;{{ number_format($orderToBuy->product_price, 2) }}
                                            </div>
                                            @if ($orderToBuy->product_old_price !== null && $orderToBuy->product_old_price !== $orderToBuy->product_price)
                                                <div class="old-price text-muted text-decoration-line-through"
                                                    id="buyNowOldPrice">
                                                    &#8369;{{ number_format($orderToBuy->product_old_price, 2) }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="stock-info mb-4" id="buyNowStockInfo">
                                            <div class="stock-badge d-inline-flex align-items-center bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill px-3 py-1"
                                                id="buyNowStockBadge">
                                                <i class="fas fa-boxes me-2 fa-sm" id="buyNowStockIcon"></i>
                                                <span class="fw-semibold"
                                                    id="buyNowStockCount">x{{ number_format($orderToBuy->product_stock) }}
                                                    units available</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="quantity-section p-4" id="buyNowQuantitySection">
                                    <div class="quantity-header mb-3" id="buyNowQuantityHeader">
                                        <h6 class="fw-bold mb-2" id="buyNowQuantityTitle">
                                            <i class="fas fa-sort-amount-up me-2 text-success"
                                                id="buyNowQuantityIcon"></i>Select Quantity
                                        </h6>
                                        <p class="text-muted small mb-0" id="buyNowQuantityDescription">How many units
                                            would you like to purchase?</p>
                                    </div>

                                    <form id="buyNowForm">
                                        @csrf
                                        <div class="quantity-input-group" id="buyNowQuantityGroup">
                                            <div class="input-group input-group-lg shadow-sm"
                                                id="buyNowQuantityInputGroup">
                                                <button type="button" class="btn btn-outline-success"
                                                    id="buyNowDecrementBtn"
                                                    wire:click="$set('order_quantity', {{ $order_quantity }} - 1)"
                                                    wire:loading.attr="disabled"
                                                    {{ $order_quantity <= 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-minus" id="buyNowDecrementIcon"></i>
                                                </button>

                                                <input type="number" class="form-control text-center"
                                                    id="buyNowQuantityInput"
                                                    wire:model.live.debounce.200ms="order_quantity" min="1"
                                                    max="{{ $orderToBuy->product_stock }}"
                                                    aria-label="Order Quantity">

                                                <button type="button" class="btn btn-outline-success"
                                                    id="buyNowIncrementBtn"
                                                    wire:click="$set('order_quantity', {{ $order_quantity }} + 1)"
                                                    wire:loading.attr="disabled"
                                                    {{ $order_quantity >= $orderToBuy->product_stock ? 'disabled' : '' }}>
                                                    <i class="fas fa-plus" id="buyNowIncrementIcon"></i>
                                                </button>
                                            </div>

                                            <div class="stock-limit-info mt-2 text-center" id="buyNowStockLimitInfo">
                                                <small class="text-muted" id="buyNowStockLimitText">
                                                    <i class="fas fa-info-circle me-1" id="buyNowStockInfoIcon"></i>
                                                    Maximum: {{ number_format($orderToBuy->product_stock) }} units
                                                    available
                                                </small>
                                            </div>

                                            @error('order_quantity')
                                                <div class="alert alert-danger alert-dismissible fade show mt-3"
                                                    role="alert" id="buyNowQuantityErrorAlert">
                                                    <i class="fas fa-exclamation-circle me-2" id="buyNowErrorIcon"></i>
                                                    <span id="buyNowErrorMessage">{{ $message }}</span>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close" id="buyNowCloseErrorBtn"></button>
                                                </div>
                                            @enderror

                                            @if ($order_quantity > $orderToBuy->product_stock)
                                                <div class="alert alert-warning alert-dismissible fade show mt-3"
                                                    role="alert" id="buyNowStockWarningAlert">
                                                    <i class="fas fa-exclamation-triangle me-2"
                                                        id="buyNowWarningIcon"></i>
                                                    <span id="buyNowWarningMessage">The product stock is insufficient.
                                                        Please reduce your order quantity.</span>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close" id="buyNowCloseWarningBtn"></button>
                                                </div>
                                            @endif

                                            <div class="order-summary mt-4 p-3 bg-light rounded-3"
                                                id="buyNowOrderSummary">
                                                <div class="d-flex justify-content-between align-items-center mb-2"
                                                    id="buyNowSummaryHeader">
                                                    <h6 class="fw-bold mb-0" id="buyNowSummaryTitle">
                                                        <i class="fas fa-receipt me-2 text-success"></i>Order Summary
                                                    </h6>
                                                    <small class="text-muted" id="buyNowSummarySubtitle">Total
                                                        Amount</small>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center"
                                                    id="buyNowSummaryDetails">
                                                    <div id="buyNowSummaryLeft">
                                                        <div class="text-muted small" id="buyNowItemCount">
                                                            {{ $order_quantity }} item(s) ×
                                                            ₱{{ number_format($orderToBuy->product_price, 2) }}
                                                        </div>
                                                        @if ($orderToBuy->product_old_price !== null && $orderToBuy->product_old_price !== $orderToBuy->product_price)
                                                            <div class="text-success small" id="buyNowSavingsText">
                                                                <i class="fas fa-piggy-bank me-1"></i>
                                                                You save:
                                                                ₱{{ number_format(($orderToBuy->product_old_price - $orderToBuy->product_price) * $order_quantity, 2) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="text-end" id="buyNowSummaryRight">
                                                        <div class="fw-bold fs-3 text-success" id="buyNowTotalPrice">
                                                            &#8369;{{ number_format($orderToBuy->product_price * $order_quantity, 2) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if ($orderToBuy)
                        <div class="modal-footer border-top p-4" id="buyNowModalFooter">
                            <div class="d-grid gap-2 w-100" id="buyNowActionButtons">
                                <button type="button" class="btn btn-success btn-lg rounded-pill shadow-sm"
                                    id="buyNowConfirmBtn" wire:click="orderPlaceOrderItem"
                                    wire:loading.attr="disabled" wire:target="orderPlaceOrderItem"
                                    {{ $order_quantity > $orderToBuy->product_stock ? 'disabled' : '' }}>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span wire:loading.remove wire:target="orderPlaceOrderItem"
                                            id="buyNowCheckoutText">
                                            <i class="fas fa-check-circle me-2" id="buyNowCheckoutIcon"></i>Proceed to
                                            Checkout
                                        </span>
                                        <span wire:loading wire:target="orderPlaceOrderItem"
                                            id="buyNowProcessingText">
                                            <span class="spinner-border spinner-border-sm me-2"
                                                id="buyNowProcessingSpinnerBtn"></span>
                                            Processing Order...
                                        </span>
                                    </div>
                                </button>

                                <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill"
                                    id="buyNowCancelBtn" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2" id="buyNowCancelIcon"></i>Cancel Order
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        #buyNowModalContent {
            border: none;
            max-width: 450px;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        #buyNowModalHeader {
            background: linear-gradient(135deg, #198754 0%, #157347 100%);
        }

        #buyNowModalIcon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        #buyNowModalHeader:hover #buyNowModalIcon {
            transform: rotate(360deg);
        }

        #buyNowModalTitle {
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        #buyNowModalSubtitle {
            font-size: 0.875rem;
        }

        #buyNowModalLoading {
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #buyNowLoadingSpinner {
            animation: buyNowSpin 1s linear infinite;
        }

        @keyframes buyNowSpin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #buyNowLoadingProgress {
            width: 200px;
            margin: 0 auto;
        }

        #buyNowLoadingMessage {
            max-width: 300px;
            margin: 0 auto;
        }

        #buyNowProcessingOverlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
        }

        #buyNowProcessingContent {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(25, 135, 84, 0.2);
            animation: buyNowFadeIn 0.3s ease;
        }

        @keyframes buyNowFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #buyNowProcessingSpinner {
            animation: buyNowProcessingSpin 1s linear infinite;
        }

        @keyframes buyNowProcessingSpin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #buyNowAlert {
            background: linear-gradient(135deg, #d1e7dd 0%, #badbcc 100%);
            border-left: 4px solid #198754;
        }

        #buyNowAlertIcon {
            color: #198754;
            animation: buyNowBounce 2s infinite;
        }

        @keyframes buyNowBounce {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        #buyNowAlertTitle {
            color: #0f5132;
        }

        /* Product Preview Styles */
        #buyNowProductPreview {
            background: linear-gradient(to bottom, #ffffff, #f8f9fa);
        }

        #buyNowImageWrapper {
            position: relative;
        }

        #buyNowProductImage {
            width: 180px;
            height: 180px;
            object-fit: contain;
            border: 1px solid #dee2e6;
            transition: transform 0.3s ease;
        }

        #buyNowProductImage:hover {
            transform: scale(1.05);
        }

        #buyNowDiscountBadge {
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 0.875rem;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
            animation: buyNowDiscountPulse 2s infinite;
        }

        @keyframes buyNowDiscountPulse {
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

        #buyNowProductName {
            color: #2c3e50;
            font-size: 1.25rem;
            line-height: 1.4;
            min-height: 3.5em;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #buyNowCurrentPrice {
            color: #198754;
            transition: color 0.3s ease;
        }

        #buyNowOldPrice {
            font-size: 0.9rem;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        #buyNowStockBadge {
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        #buyNowStockBadge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(13, 202, 240, 0.1);
        }

        #buyNowQuantitySection {
            background: #ffffff;
        }

        #buyNowQuantityTitle {
            color: #2c3e50;
            transition: color 0.3s ease;
        }

        #buyNowQuantityGroup {
            margin-top: 1rem;
        }

        #buyNowQuantityInputGroup {
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #dee2e6;
            transition: border-color 0.3s ease;
        }

        #buyNowQuantityInputGroup:focus-within {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1);
        }

        #buyNowQuantityInput {
            border-color: transparent;
            font-weight: 600;
            font-size: 1.25rem;
            background: transparent;
        }

        #buyNowQuantityInput:focus {
            box-shadow: none;
            background: transparent;
        }

        #buyNowDecrementBtn,
        #buyNowIncrementBtn {
            width: 50px;
            border-color: #198754;
            color: #198754;
            transition: all 0.3s ease;
            background: white;
        }

        #buyNowDecrementBtn:hover:not(:disabled),
        #buyNowIncrementBtn:hover:not(:disabled) {
            background-color: #198754;
            color: white;
            border-color: #198754;
        }

        #buyNowDecrementBtn:disabled,
        #buyNowIncrementBtn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f8f9fa;
            border-color: #dee2e6;
            color: #6c757d;
        }

        #buyNowDecrementIcon,
        #buyNowIncrementIcon {
            transition: transform 0.3s ease;
        }

        #buyNowDecrementBtn:active #buyNowDecrementIcon,
        #buyNowIncrementBtn:active #buyNowIncrementIcon {
            transform: scale(0.9);
        }

        #buyNowQuantityErrorAlert {
            animation: buyNowSlideIn 0.3s ease-out;
            border-left: 4px solid #dc3545;
        }

        #buyNowStockWarningAlert {
            animation: buyNowSlideIn 0.3s ease-out;
            border-left: 4px solid #ffc107;
        }

        @keyframes buyNowSlideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #buyNowErrorIcon {
            color: #dc3545;
            animation: buyNowBounceError 0.5s ease;
        }

        #buyNowWarningIcon {
            color: #ffc107;
            animation: buyNowBounceWarning 0.5s ease;
        }

        @keyframes buyNowBounceError {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        @keyframes buyNowBounceWarning {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        #buyNowOrderSummary {
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        #buyNowOrderSummary:hover {
            border-color: #198754;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.1);
        }

        #buyNowTotalPrice {
            color: #198754;
            transition: color 0.3s ease;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        #buyNowSavingsText {
            transition: color 0.3s ease;
        }

        #buyNowConfirmBtn {
            background: linear-gradient(135deg, #198754 0%, #157347 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        #buyNowConfirmBtn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.3);
            background: linear-gradient(135deg, #157347 0%, #146c43 100%);
        }

        #buyNowConfirmBtn:active:not(:disabled) {
            transform: translateY(0);
        }

        #buyNowConfirmBtn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            background: #6c757d;
        }

        #buyNowCheckoutIcon {
            transition: transform 0.3s ease;
        }

        #buyNowConfirmBtn:hover #buyNowCheckoutIcon {
            transform: scale(1.2) rotate(10deg);
        }

        #buyNowProcessingSpinnerBtn {
            animation: buyNowSpin 1s linear infinite;
        }

        #buyNowCancelBtn {
            border-width: 2px;
            transition: all 0.3s ease;
        }

        #buyNowCancelBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.1);
            background: rgba(108, 117, 125, 0.05);
            color: gray;
        }

        #buyNowCancelIcon {
            transition: transform 0.3s ease;
        }

        #buyNowCancelBtn:hover #buyNowCancelIcon {
            transform: rotate(90deg);
        }

        #buyNowSecurityInfo {
            transition: opacity 0.3s ease;
        }

        #buyNowSecurityIcon {
            color: #198754;
            animation: buyNowShieldPulse 3s infinite;
        }

        @keyframes buyNowShieldPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        @media (max-width: 576px) {
            #buyNowModalContent {
                margin: 0.5rem;
            }

            #buyNowModalHeader {
                padding: 1.5rem !important;
            }

            #buyNowProductPreview,
            #buyNowQuantitySection,
            #buyNowConfirmation {
                padding: 1.5rem !important;
            }

            #buyNowModalFooter {
                padding: 1.5rem !important;
            }

            #buyNowProductImage {
                width: 150px;
                height: 150px;
            }

            #buyNowDecrementBtn,
            #buyNowIncrementBtn {
                width: 40px;
                padding: 0.5rem;
            }

            #buyNowQuantityInput {
                font-size: 1.1rem;
            }

            #buyNowConfirmBtn,
            #buyNowCancelBtn {
                padding: 0.75rem !important;
                font-size: 1rem;
            }

            #buyNowModalTitle {
                font-size: 1.25rem;
            }

            #buyNowProductName {
                font-size: 1.1rem;
            }

            #buyNowCurrentPrice {
                font-size: 1.5rem;
            }

            #buyNowTotalPrice {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 375px) {
            #buyNowProductImage {
                width: 120px;
                height: 120px;
            }

            #buyNowModalTitle {
                font-size: 1.1rem;
            }

            #buyNowProductName {
                font-size: 1rem;
            }

            #buyNowCurrentPrice {
                font-size: 1.25rem;
            }

            #buyNowTotalPrice {
                font-size: 1.25rem;
            }

            #buyNowQuantityInputGroup {
                flex-wrap: nowrap;
            }

            #buyNowAlert {
                flex-direction: column;
                text-align: center;
            }

            #buyNowAlertIcon {
                margin-bottom: 1rem;
                margin-right: 0 !important;
            }
        }

        #buyNowQuantityInput::-webkit-inner-spin-button,
        #buyNowQuantityInput::-webkit-outer-spin-button {
            opacity: 1;
            height: 40px;
            width: 20px;
        }

        #buyNowQuantityInput:focus,
        #buyNowDecrementBtn:focus,
        #buyNowIncrementBtn:focus,
        #buyNowConfirmBtn:focus,
        #buyNowCancelBtn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.25);
        }

        #buyNowTotalPrice {
            transition: all 0.3s ease;
        }

        #buyNowTotalPrice.updated {
            animation: buyNowPriceUpdate 0.5s ease;
        }

        @keyframes buyNowPriceUpdate {
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
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('toBuyNow');

            if (modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    Livewire.dispatch('resetInputs');
                });

                const quantityInput = document.getElementById('buyNowQuantityInput');
                const totalPriceElement = document.getElementById('buyNowTotalPrice');
                const itemCountElement = document.getElementById('buyNowItemCount');
                const savingsElement = document.getElementById('buyNowSavingsText');

                if (quantityInput && totalPriceElement) {
                    quantityInput.addEventListener('input', function() {
                        const price = parseFloat("{{ $orderToBuy->product_price ?? 0 }}");
                        const oldPrice = parseFloat("{{ $orderToBuy->product_old_price ?? 0 }}");
                        const quantity = parseInt(this.value) || 1;

                        if (price > 0) {
                            const total = price * quantity;

                            totalPriceElement.textContent = '₱' + total.toLocaleString('en-PH', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });

                            totalPriceElement.classList.add('updated');
                            setTimeout(() => {
                                totalPriceElement.classList.remove('updated');
                            }, 500);

                            if (itemCountElement) {
                                itemCountElement.textContent =
                                    `${quantity} item(s) × ₱${price.toLocaleString('en-PH', {minimumFractionDigits: 2})}`;
                            }

                            if (oldPrice > 0 && savingsElement) {
                                const savings = (oldPrice - price) * quantity;
                                if (savings > 0) {
                                    savingsElement.innerHTML =
                                        `<i class="fas fa-piggy-bank me-1"></i>You save: ₱${savings.toLocaleString('en-PH', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                                }
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

                const decrementBtn = document.getElementById('buyNowDecrementBtn');
                const incrementBtn = document.getElementById('buyNowIncrementBtn');

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
                        if (e.key === 'Enter' && !e.target.id === 'buyNowQuantityInput') {
                            const checkoutBtn = document.getElementById('buyNowConfirmBtn');
                            if (checkoutBtn && !checkoutBtn.disabled) {
                                checkoutBtn.click();
                            }
                        }

                        if (e.key === 'Escape') {
                            bootstrap.Modal.getInstance(modal).hide();
                        }

                        if (e.target.id === 'buyNowQuantityInput') {
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

                const checkoutBtn = document.getElementById('buyNowConfirmBtn');
                if (checkoutBtn) {
                    checkoutBtn.addEventListener('click', function() {
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
                const modal = document.getElementById('toBuyNow');
                if (modal) {
                    $('#toBuyNow').on('hidden.bs.modal', function() {
                        Livewire.dispatch('resetInputs');
                    });
                }
            });
        });

        document.addEventListener('livewire:initialized', function() {
            Livewire.on('open-buy-now-modal', function() {
                const modal = new bootstrap.Modal(document.getElementById('toBuyNow'));
                modal.show();

                setTimeout(() => {
                    const quantityInput = document.getElementById('buyNowQuantityInput');
                    if (quantityInput) {
                        quantityInput.focus();
                        quantityInput.select();
                    }
                }, 300);
            });
        });
    </script>
</div>
