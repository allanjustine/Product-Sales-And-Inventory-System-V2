<div>
    <div>
        <div wire:ignore.self class="modal fade" id="cancel" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg" id="cancelModalContent">
                    <div class="modal-header bg-gradient-danger text-white p-4 border-0" id="cancelModalHeader">
                        <div class="d-flex align-items-center w-100">
                            <div class="icon-wrapper rounded-circle p-2 me-3"
                                id="cancelModalIcon">
                                <i class="fas fa-triangle-exclamation fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="modal-title fw-bold mb-1" id="cancelModalTitle">Cancel Order Confirmation
                                </h4>
                                <p class="mb-0 opacity-75" id="cancelModalSubtitle">Confirm order cancellation</p>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close" id="closeCancelModalBtn"></button>
                        </div>
                    </div>

                    <div class="modal-body p-0" id="cancelModalBody">
                        @if (!$cancel)
                            <div class="loading-state p-5 text-center" id="cancelModalLoading">
                                <div class="loading-spinner mb-4" id="cancelLoadingSpinner">
                                    <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"
                                        role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($cancel)
                            <div class="cancel-container" id="cancelOrderContainer">
                                <div class="warning-section p-4 border-bottom" id="cancelWarningSection">
                                    <div class="alert alert-danger border-0 rounded-3 shadow-sm" role="alert"
                                        id="cancelWarningAlert">
                                        <div class="d-flex align-items-center">
                                            <div class="alert-icon me-3" id="cancelAlertIcon">
                                                <i class="fas fa-exclamation-triangle fa-2x"></i>
                                            </div>
                                            <div>
                                                <h5 class="alert-heading mb-2 fw-bold" id="cancelAlertTitle">Warning:
                                                    Order Cancellation</h5>
                                                <p class="mb-0" id="cancelAlertMessage">Are you sure you want to
                                                    cancel this order?</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="order-details-section p-4" id="cancelOrderDetails">
                                    <div class="order-item-card border rounded-3 p-3 mb-4" id="cancelOrderCard">
                                        <div class="d-flex align-items-center" id="cancelOrderInfo">
                                            <div class="order-icon bg-danger bg-opacity-10 rounded-circle p-2 me-3"
                                                id="cancelOrderIcon">
                                                <i class="fas fa-box text-danger"></i>
                                            </div>
                                            <div class="flex-grow-1" id="cancelOrderText">
                                                <h6 class="fw-bold mb-1 text-capitalize" id="cancelProductName">
                                                    {{ $cancel->product->product_name }}</h6>
                                                <div class="text-muted small" id="cancelOrderDetailsText">
                                                    <span
                                                        class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 me-2"
                                                        id="cancelQuantityBadge">
                                                        x{{ $cancel->order_quantity }} PC(s)
                                                    </span>
                                                    <span class="text-muted" id="cancelOrderStatus">Pending Order</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="consequences-section bg-light rounded-3 p-3" id="cancelConsequences">
                                        <div class="d-flex align-items-start mb-2" id="cancelConsequencesHeader">
                                            <i class="fas fa-info-circle text-danger me-2 mt-1"
                                                id="cancelConsequencesIcon"></i>
                                            <div>
                                                <h6 class="fw-bold mb-1" id="cancelConsequencesTitle">Important Notice
                                                </h6>
                                                <p class="mb-0 small text-muted" id="cancelConsequencesText">
                                                    Cancelling <strong
                                                        class="text-capitalize">"{{ $cancel->product->product_name }} -
                                                        x{{ $cancel->order_quantity }}PC(s)"</strong>
                                                    will permanently remove this item from your pending orders.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-3 pt-2 border-top" id="cancelAdditionalInfo">
                                            <small class="text-muted d-block" id="cancelInfo1">
                                                <i class="fas fa-clock me-1"></i> This action cannot be undone
                                            </small>
                                            <small class="text-muted d-block mt-1" id="cancelInfo2">
                                                <i class="fas fa-history me-1"></i> Order history will be updated
                                            </small>
                                            <small class="text-muted d-block mt-1" id="cancelInfo3">
                                                <i class="fas fa-box-open me-1"></i> Stock will be restored
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer border-top p-4" id="cancelModalFooter">
                        <div class="d-grid gap-2 w-100" id="cancelActionButtons">
                            <button class="btn btn-danger btn-lg rounded-pill shadow-sm" id="cancelConfirmBtn"
                                wire:click="cancelOrder" wire:target='cancelOrder' wire:loading.attr='disabled'
                                type="button">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span wire:target='cancelOrder' wire:loading.remove id="cancelBtnText">
                                        <i class="fas fa-circle-xmark me-2" id="cancelBtnIcon"></i> Yes, Cancel Order
                                    </span>
                                    <span wire:target='cancelOrder' wire:loading id="cancellingBtnText">
                                        <span class="spinner-border spinner-border-sm me-2"
                                            id="cancellingSpinner"></span>
                                        Cancelling...
                                    </span>
                                </div>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill"
                                id="cancelCloseBtn" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2" id="closeBtnIcon"></i>Keep Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #cancelModalContent {
            border: none;
            max-width: 450px;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        #cancelModalHeader {
            background: linear-gradient(135deg, #dc3545 0%, #bb2d3b 100%);
        }

        #cancelModalIcon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        #cancelModalHeader:hover #cancelModalIcon {
            transform: rotate(-15deg);
        }

        #cancelModalTitle {
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        #cancelModalSubtitle {
            font-size: 0.875rem;
        }

        #cancelModalLoading {
            min-height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #cancelLoadingSpinner {
            animation: cancelSpin 1s linear infinite;
        }

        @keyframes cancelSpin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #cancelLoadingProgress {
            width: 200px;
            margin: 0 auto;
        }

        #cancelWarningAlert {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c2c7 100%);
            border-left: 4px solid #dc3545;
        }

        #cancelAlertIcon {
            color: #dc3545;
            animation: cancelPulse 2s infinite;
        }

        @keyframes cancelPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        #cancelAlertTitle {
            color: #842029;
        }

        #cancelOrderCard {
            border: 2px solid #f8d7da;
            background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);
            transition: all 0.3s ease;
        }

        #cancelOrderCard:hover {
            border-color: #dc3545;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.1);
        }

        #cancelOrderIcon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #cancelProductName {
            color: #2c3e50;
            font-size: 1.1rem;
        }

        #cancelQuantityBadge {
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        #cancelQuantityBadge:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
        }

        #cancelConsequences {
            border: 2px solid #f8d7da;
            background: linear-gradient(135deg, #fff5f5 0%, #ffe3e3 100%);
        }

        #cancelConsequencesIcon {
            animation: cancelWarningBounce 1.5s infinite;
        }

        @keyframes cancelWarningBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-3px);
            }
        }

        #cancelConsequencesTitle {
            color: #842029;
        }

        #cancelAdditionalInfo {
            border-color: rgba(220, 53, 69, 0.2) !important;
        }

        #cancelConfirmBtn {
            background: linear-gradient(135deg, #dc3545 0%, #bb2d3b 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        #cancelConfirmBtn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
            background: linear-gradient(135deg, #bb2d3b 0%, #b02a37 100%);
        }

        #cancelConfirmBtn:active:not(:disabled) {
            transform: translateY(0);
        }

        #cancelConfirmBtn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        #cancelBtnIcon {
            transition: transform 0.3s ease;
        }

        #cancelConfirmBtn:hover #cancelBtnIcon {
            transform: scale(1.2) rotate(90deg);
        }

        #cancellingSpinner {
            animation: cancelSpin 1s linear infinite;
        }

        #cancelCloseBtn {
            border-width: 2px;
            transition: all 0.3s ease;
        }

        #cancelCloseBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.1);
            background: rgba(108, 117, 125, 0.05);
            color: gray;
        }

        #closeBtnIcon {
            transition: transform 0.3s ease;
        }

        #cancelCloseBtn:hover #closeBtnIcon {
            transform: rotate(90deg);
        }

        #cancelModalContent:focus-within {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
        }

        @media (max-width: 576px) {
            #cancelModalContent {
                margin: 0.5rem;
            }

            #cancelModalHeader {
                padding: 1.5rem !important;
            }

            #cancelWarningSection,
            #cancelOrderDetails {
                padding: 1.5rem !important;
            }

            #cancelModalFooter {
                padding: 1.5rem !important;
            }

            #cancelModalTitle {
                font-size: 1.25rem;
            }

            #cancelProductName {
                font-size: 1rem;
            }

            #cancelConfirmBtn,
            #cancelCloseBtn {
                padding: 0.75rem !important;
                font-size: 1rem;
            }
        }

        @media (max-width: 375px) {
            #cancelModalTitle {
                font-size: 1.1rem;
            }

            #cancelProductName {
                font-size: 0.95rem;
            }

            #cancelAlertIcon {
                font-size: 1.5rem;
            }

            #cancelOrderIcon {
                width: 36px;
                height: 36px;
            }
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            opacity: 1;
            height: 40px;
            width: 20px;
        }

        #cancelConfirmBtn:focus,
        #cancelCloseBtn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
        }

        #cancelConfirmBtn.clicked {
            animation: cancelClickEffect 0.3s ease;
        }

        @keyframes cancelClickEffect {
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
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('cancel');

            if (modal) {
                modal.addEventListener('hidden.bs.modal', function() {});

                const cancelBtn = document.getElementById('cancelConfirmBtn');
                if (cancelBtn) {
                    cancelBtn.addEventListener('click', function() {
                        if (!this.disabled) {
                            this.classList.add('clicked');
                            setTimeout(() => {
                                this.classList.remove('clicked');
                            }, 300);
                        }
                    });
                }

                document.addEventListener('keydown', function(e) {
                    if (modal.classList.contains('show')) {
                        if (e.key === 'Enter') {
                            const confirmBtn = document.getElementById('cancelConfirmBtn');
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
                const modal = document.getElementById('cancel');
                if (modal) {
                    modal.addEventListener('hidden.bs.modal', function() {});
                }
            });
        });

        document.addEventListener('livewire:initialized', function() {
            Livewire.on('open-cancel-modal', function() {
                const modal = new bootstrap.Modal(document.getElementById('cancel'));
                modal.show();

                setTimeout(() => {
                    const cancelBtn = document.getElementById('cancelConfirmBtn');
                    if (cancelBtn) {
                        cancelBtn.focus();
                    }
                }, 300);
            });
        });
    </script>
</div>
