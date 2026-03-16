<div>
    <!-- Modal Delete Product -->
    <div wire:ignore.self class="modal fade" id="deleteProduct" tabindex="-1" role="dialog"
        aria-labelledby="deleteProductModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteProductModalTitle">
                        <i class="fa-solid fa-exclamation-triangle me-2"></i>
                        Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body text-center py-4">
                    @if ($productToDelete)
                        <!-- Warning Icon -->
                        <div class="mb-3">
                            <span class="bg-danger bg-opacity-10 d-inline-flex p-3 rounded-circle">
                                <i class="fa-solid fa-trash-alt fa-3x text-danger"></i>
                            </span>
                        </div>

                        <!-- Warning Message -->
                        <h4 class="fw-bold mb-3">Are you absolutely sure?</h4>

                        <p class="text-muted mb-2">
                            This action cannot be undone. This will permanently delete:
                        </p>

                        <div class="bg-light p-3 rounded border-start border-danger border-4 mb-3 text-start">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-box text-danger me-2 fa-fw"></i>
                                <span class="fw-bold text-capitalize">{{ $productToDelete->product_name }}</span>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <i class="fa-solid fa-hashtag text-muted me-2 fa-fw"></i>
                                <span class="text-muted small">Code: {{ $productToDelete->product_code }}</span>
                            </div>
                            @if ($productToDelete->product_category)
                                <div class="d-flex align-items-center mt-1">
                                    <i class="fa-solid fa-tag text-muted me-2 fa-fw"></i>
                                    <span class="text-muted small">Category:
                                        {{ $productToDelete->product_category->category_name }}</span>
                                </div>
                            @endif
                        </div>

                        <p class="text-danger small mb-0">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            This product will be permanently removed from the database.
                        </p>
                    @else
                        <!-- Loading State -->
                        <div class="py-4" id="deleteLoadingState">
                            <div class="spinner-border text-danger mb-3" style="width: 3rem; height: 3rem;"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <h6 class="text-muted">Loading product information...</h6>
                            <p class="text-muted small mb-0">Please wait while we fetch the details</p>
                        </div>
                    @endif
                </div>

                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-times me-1"></i>
                        Cancel
                    </button>

                    <button class="btn btn-danger" wire:click="deleteProduct" wire:target="deleteProduct"
                        wire:loading.attr='disabled' @if (!$productToDelete) disabled @endif>
                        <span wire:target='deleteProduct' wire:loading.remove>
                            <i class="fa-solid fa-trash-alt me-1"></i>
                            Yes, Delete Permanently
                        </span>
                        <span wire:target='deleteProduct' wire:loading>
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Deleting...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles using IDs */
        #deleteProduct .modal-content {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        #deleteProduct .modal-header {
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        #deleteProduct .modal-header.bg-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
        }

        #deleteProduct .modal-body {
            padding: 2rem 1.5rem;
        }

        #deleteProduct .modal-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
        }

        #deleteProduct .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        #deleteProduct .btn-close:hover {
            opacity: 1;
        }

        /* Warning Icon Container */
        #deleteProduct .bg-danger.bg-opacity-10 {
            background-color: rgba(220, 53, 69, 0.1) !important;
            width: 80px;
            height: 80px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Product Info Card */
        #deleteProduct .bg-light {
            background-color: #f8f9fa !important;
            border-left: 4px solid #dc3545;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        #deleteProduct .bg-light i.fa-box {
            color: #dc3545;
        }

        /* Loading State */
        #deleteLoadingState {
            animation: fadeIn 0.3s ease;
        }

        #deleteLoadingState .spinner-border {
            color: #dc3545;
        }

        /* Button Styles */
        #deleteProduct .btn {
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            border-radius: 6px;
            transition: none;
        }

        #deleteProduct .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        #deleteProduct .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        #deleteProduct .btn-danger:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            transform: none;
        }

        #deleteProduct .btn-danger:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* Animations */
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

        /* Fade in animation for content */
        #deleteProduct .modal-body>div:not(#deleteLoadingState) {
            animation: fadeIn 0.4s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            #deleteProduct .modal-dialog {
                margin: 0.5rem;
            }

            #deleteProduct .modal-body {
                padding: 1.5rem 1rem;
            }

            #deleteProduct .bg-danger.bg-opacity-10 {
                width: 60px;
                height: 60px;
            }

            #deleteProduct .bg-danger.bg-opacity-10 i {
                font-size: 2rem !important;
            }

            #deleteProduct h4 {
                font-size: 1.25rem;
            }

            #deleteProduct .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }

        /* Modal width adjustment for small screens */
        @media (min-width: 576px) {
            #deleteProduct .modal-dialog {
                max-width: 450px;
            }
        }
    </style>
</div>
