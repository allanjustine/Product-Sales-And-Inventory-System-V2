<div>
    <div>
        <div wire:ignore.self class="modal fade" id="checkOut" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg" id="checkoutModalContent">
                    <div class="modal-header bg-gradient-primary text-white p-4 border-0" id="checkoutModalHeader">
                        <div class="d-flex align-items-center w-100">
                            <div class="icon-wrapper rounded-circle p-2 me-3"
                                id="checkoutModalIcon">
                                <i class="fas fa-shopping-bag fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="modal-title fw-bold mb-1" id="checkoutModalTitle">Checkout Confirmation</h4>
                                <p class="mb-0 opacity-75" id="checkoutModalSubtitle">Complete your purchase</p>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close" id="closeCheckoutModalBtn"></button>
                        </div>
                    </div>

                    <div class="modal-body p-0" id="checkoutModalBody">
                        <div class="checkout-container" id="checkoutContainer">
                            <div class="confirmation-section p-4 border-bottom" id="checkoutConfirmation">
                                <div class="alert alert-primary border-0 rounded-3 shadow-sm" role="alert"
                                    id="checkoutAlert">
                                    <div class="d-flex align-items-center">
                                        <div class="alert-icon me-3" id="checkoutAlertIcon">
                                            <i class="fas fa-question-circle fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5 class="alert-heading mb-2 fw-bold" id="checkoutAlertTitle">Ready to
                                                Checkout?</h5>
                                            <p class="mb-0" id="checkoutAlertMessage">Are you sure you want to proceed
                                                with checkout?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="order-summary-section p-4" id="checkoutOrderSummary">
                                <div class="order-items-card bg-light rounded-3 p-3 mb-4" id="checkoutItemsCard">
                                    <div class="d-flex align-items-center justify-content-between mb-3"
                                        id="checkoutItemsHeader">
                                        <h6 class="fw-bold mb-0" id="checkoutItemsTitle">
                                            <i class="fas fa-boxes me-2 text-primary"></i>Order Summary
                                        </h6>
                                        <div class="badge bg-primary bg-opacity-10 text-white border border-primary border-opacity-25 rounded-pill px-3 py-1"
                                            id="checkoutItemsBadge">
                                            <span id="checkoutItemsCount">{{ count($this->cart_ids) }}</span> items
                                        </div>
                                    </div>

                                    <div class="text-center py-3" id="checkoutItemsContent">
                                        <div class="items-icon mb-3" id="checkoutItemsIcon">
                                            <i class="fas fa-shopping-cart fa-3x text-primary opacity-75"></i>
                                        </div>
                                        <h5 class="fw-bold mb-2" id="checkoutSelectedItems">Selected Items</h5>
                                        <p class="text-muted mb-0" id="checkoutSelectedCount">You have selected <strong
                                                class="text-primary">{{ count($this->cart_ids) }}</strong> items in your
                                            cart</p>
                                    </div>
                                </div>

                                <div class="checkout-details bg-light-subtle rounded-3 p-3" id="checkoutDetails">
                                    <div class="d-flex align-items-start mb-3" id="checkoutDetailsHeader">
                                        <i class="fas fa-info-circle text-primary me-2 mt-1"
                                            id="checkoutDetailsIcon"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1" id="checkoutDetailsTitle">Checkout Process</h6>
                                            <p class="mb-0 small text-muted" id="checkoutDetailsText">
                                                Proceeding will move your selected items to pending orders for
                                                processing.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3 pt-2 border-top" id="checkoutStepsInfo">
                                        <small class="text-muted d-block" id="checkoutStep1">
                                            <i class="fas fa-check-circle text-success me-1"></i> Review order details
                                        </small>
                                        <small class="text-muted d-block mt-2" id="checkoutStep2">
                                            <i class="fas fa-credit-card text-primary me-1"></i> Proceed to checkout
                                        </small>
                                        <small class="text-muted d-block mt-2" id="checkoutStep3">
                                            <i class="fas fa-truck text-info me-1"></i> Order processing begins
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top p-4" id="checkoutModalFooter">
                        <div class="d-grid gap-2 w-100" id="checkoutActionButtons">
                            <button class="btn btn-primary btn-lg rounded-pill shadow-sm" id="checkoutConfirmBtn"
                                wire:click="placeOrder" wire:target='placeOrder' wire:loading.attr='disabled'
                                type="button">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span wire:target='placeOrder' wire:loading.remove id="checkoutBtnText">
                                        <i class="fas fa-check-circle me-2" id="checkoutBtnIcon"></i> Proceed to
                                        Checkout
                                    </span>
                                    <span wire:target='placeOrder' wire:loading id="checkoutProcessingText">
                                        <span class="spinner-border spinner-border-sm me-2"
                                            id="checkoutProcessingSpinner"></span>
                                        Processing...
                                    </span>
                                </div>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill"
                                id="checkoutCancelBtn" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2" id="checkoutCancelIcon"></i>Continue Shopping
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #checkoutModalContent {
            border: none;
            max-width: 450px;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        #checkoutModalHeader {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        }

        #checkoutModalIcon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        #checkoutModalHeader:hover #checkoutModalIcon {
            transform: rotate(15deg);
        }

        #checkoutModalTitle {
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        #checkoutModalSubtitle {
            font-size: 0.875rem;
        }

        #checkoutAlert {
            background: linear-gradient(135deg, #cfe2ff 0%, #b6d4fe 100%);
            border-left: 4px solid #0d6efd;
        }

        #checkoutAlertIcon {
            color: #0d6efd;
            animation: checkoutPulse 2s infinite;
        }

        @keyframes checkoutPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        #checkoutAlertTitle {
            color: #084298;
        }

        #checkoutItemsCard {
            border: 2px solid #cfe2ff;
            background: linear-gradient(135deg, #ffffff 0%, #f0f7ff 100%);
            transition: all 0.3s ease;
        }

        #checkoutItemsCard:hover {
            border-color: #0d6efd;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.1);
        }

        #checkoutItemsBadge {
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        #checkoutItemsBadge:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.2);
        }

        #checkoutItemsIcon {
            animation: checkoutCartBounce 2s infinite;
        }

        @keyframes checkoutCartBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        #checkoutSelectedItems {
            color: #2c3e50;
            font-size: 1.25rem;
        }

        #checkoutSelectedCount {
            font-size: 1rem;
        }

        #checkoutDetails {
            border: 2px solid #cfe2ff;
            background: linear-gradient(135deg, #f0f7ff 0%, #e3f2fd 100%);
        }

        #checkoutDetailsIcon {
            animation: checkoutInfoBounce 1.5s infinite;
        }

        @keyframes checkoutInfoBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-3px);
            }
        }

        #checkoutDetailsTitle {
            color: #084298;
        }

        #checkoutStepsInfo {
            border-color: rgba(13, 110, 253, 0.2) !important;
        }

        #checkoutStep1 i,
        #checkoutStep2 i,
        #checkoutStep3 i {
            transition: transform 0.3s ease;
        }

        #checkoutStep1:hover i,
        #checkoutStep2:hover i,
        #checkoutStep3:hover i {
            transform: scale(1.2);
        }

        #checkoutConfirmBtn {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        #checkoutConfirmBtn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
            background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
        }

        #checkoutConfirmBtn:active:not(:disabled) {
            transform: translateY(0);
        }

        #checkoutConfirmBtn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        #checkoutBtnIcon {
            transition: transform 0.3s ease;
        }

        #checkoutConfirmBtn:hover #checkoutBtnIcon {
            transform: scale(1.2) rotate(-10deg);
        }

        #checkoutProcessingSpinner {
            animation: checkoutSpin 1s linear infinite;
        }

        @keyframes checkoutSpin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #checkoutCancelBtn {
            border-width: 2px;
            transition: all 0.3s ease;
        }

        #checkoutCancelBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.1);
            background: rgba(108, 117, 125, 0.05);
            color: gray;
        }

        #checkoutCancelIcon {
            transition: transform 0.3s ease;
        }

        #checkoutCancelBtn:hover #checkoutCancelIcon {
            transform: rotate(90deg);
        }

        #checkoutSecurityInfo {
            transition: opacity 0.3s ease;
        }

        #checkoutSecurityInfo i {
            color: #0d6efd;
            animation: checkoutLockPulse 3s infinite;
        }

        @keyframes checkoutLockPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        #checkoutModalContent:focus-within {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        }

        @media (max-width: 576px) {
            #checkoutModalContent {
                margin: 0.5rem;
            }

            #checkoutModalHeader {
                padding: 1.5rem !important;
            }

            #checkoutConfirmation,
            #checkoutOrderSummary {
                padding: 1.5rem !important;
            }

            #checkoutModalFooter {
                padding: 1.5rem !important;
            }

            #checkoutModalTitle {
                font-size: 1.25rem;
            }

            #checkoutSelectedItems {
                font-size: 1.1rem;
            }

            #checkoutConfirmBtn,
            #checkoutCancelBtn {
                padding: 0.75rem !important;
                font-size: 1rem;
            }

            #checkoutItemsIcon i {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 375px) {
            #checkoutModalTitle {
                font-size: 1.1rem;
            }

            #checkoutSelectedItems {
                font-size: 1rem;
            }

            #checkoutAlertIcon {
                font-size: 1.5rem;
            }

            #checkoutItemsBadge {
                font-size: 0.8rem;
                padding: 0.25rem 0.75rem;
            }
        }

        #checkoutConfirmBtn:focus,
        #checkoutCancelBtn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        }

        #checkoutConfirmBtn.clicked {
            animation: checkoutClickEffect 0.3s ease;
        }

        @keyframes checkoutClickEffect {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.95);
            }

            100% {
                transform: scale(1);
            }
        }

        #checkoutItemsBadge.updated {
            animation: checkoutBadgeUpdate 0.5s ease;
        }

        @keyframes checkoutBadgeUpdate {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('checkOut');

            if (modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    Livewire.dispatch('resetInputs');
                });

                const checkoutBtn = document.getElementById('checkoutConfirmBtn');
                if (checkoutBtn) {
                    checkoutBtn.addEventListener('click', function() {
                        if (!this.disabled) {
                            this.classList.add('clicked');
                            setTimeout(() => {
                                this.classList.remove('clicked');
                            }, 300);
                        }
                    });
                }

                const itemsBadge = document.getElementById('checkoutItemsBadge');
                if (itemsBadge) {
                    Livewire.on('cart-items-updated', function(data) {
                        const countElement = document.getElementById('checkoutItemsCount');
                        const selectedCount = document.getElementById('checkoutSelectedCount');

                        if (countElement) {
                            itemsBadge.classList.add('updated');
                            countElement.textContent = data.count;

                            if (selectedCount) {
                                selectedCount.innerHTML =
                                    `You have selected <strong class="text-primary">${data.count}</strong> items in your cart`;
                            }

                            setTimeout(() => {
                                itemsBadge.classList.remove('updated');
                            }, 500);
                        }
                    });
                }

                document.addEventListener('keydown', function(e) {
                    if (modal.classList.contains('show')) {
                        if (e.key === 'Enter') {
                            const confirmBtn = document.getElementById('checkoutConfirmBtn');
                            if (confirmBtn && !confirmBtn.disabled) {
                                e.preventDefault();
                                confirmBtn.click();
                            }
                        }

                        if (e.key === 'Escape') {
                            bootstrap.Modal.getInstance(modal).hide();
                        }
                    }
                });
            }

            document.addEventListener('livewire:navigated', function() {
                const modal = document.getElementById('checkOut');
                if (modal) {
                    $('#checkOut').on('hidden.bs.modal', function() {
                        Livewire.dispatch('resetInputs');
                    });
                }
            });
        });

        document.addEventListener('livewire:initialized', function() {
            Livewire.on('open-checkout-modal', function() {
                const modal = new bootstrap.Modal(document.getElementById('checkOut'));
                modal.show();

                setTimeout(() => {
                    const checkoutBtn = document.getElementById('checkoutConfirmBtn');
                    if (checkoutBtn) {
                        checkoutBtn.focus();
                    }
                }, 300);
            });
        });
    </script>
</div>
