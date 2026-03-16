<div>
    <!-- Modal Delete Product Category-->
    <div wire:ignore.self class="modal fade" id="deleteProductCategory" tabindex="-1" role="dialog"
        aria-labelledby="deleteCategoryModalTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteCategoryModalTitle">
                        <i class="fa-solid fa-exclamation-triangle mr-2"></i>
                        Confirm Deletion
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center py-4">
                    @if ($productCategoryToDelete)
                        <!-- Warning Icon -->
                        <div class="mb-3">
                            <span class="bg-danger bg-opacity-10 d-inline-flex p-3 rounded-circle">
                                <i class="fa-solid fa-tag fa-3x text-danger"></i>
                            </span>
                        </div>

                        <!-- Warning Message -->
                        <h5 class="font-weight-bold mb-3">Delete this category?</h5>

                        <p class="text-muted mb-3">
                            You are about to delete the following category:
                        </p>

                        <!-- Category Details Card -->
                        <div class="bg-light p-3 rounded border-left border-danger border-4 mb-3 text-left">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-tag text-danger mr-2 fa-fw"></i>
                                <span
                                    class="font-weight-bold text-capitalize">{{ $productCategoryToDelete->category_name }}</span>
                            </div>
                            @if ($productCategoryToDelete->category_description)
                                <div class="mt-2">
                                    <p class="text-muted small mb-0">
                                        <i class="fa-solid fa-align-left mr-1"></i>
                                        {{ Str::limit($productCategoryToDelete->category_description, 100) }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Warning Notice -->
                        <div class="alert alert-warning py-2 small mb-0">
                            <i class="fa-solid fa-info-circle mr-1"></i>
                            <strong>Note:</strong> This action cannot be undone. Products in this category may be
                            affected.
                        </div>
                    @else
                        <!-- Loading State -->
                        <div class="py-4" id="deleteCategoryLoading">
                            <div class="spinner-border text-danger mb-3" style="width: 3rem; height: 3rem;"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h5 class="text-muted">Loading category information...</h5>
                            <p class="text-muted small mb-0">Please wait while we fetch the details</p>
                        </div>
                    @endif
                </div>

                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id='closeModalDelete'>
                        <i class="fa-solid fa-times mr-1"></i> Cancel
                    </button>

                    <button class="btn btn-danger" wire:loading.attr='disabled' wire:target='deleteProductCategory'
                        wire:click="deleteProductCategory" @if (!$productCategoryToDelete) disabled @endif>
                        <span wire:loading.remove wire:target='deleteProductCategory'>
                            <i class="fa-solid fa-trash-alt mr-1"></i> Yes, Delete Category
                        </span>
                        <span wire:loading wire:target='deleteProductCategory'>
                            <span class="spinner-border spinner-border-sm mr-1"></span> Deleting...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles for the modal */
        #deleteProductCategory .modal-content {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        #deleteProductCategory .modal-header {
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        #deleteProductCategory .modal-header.bg-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
        }

        #deleteProductCategory .modal-header .close {
            opacity: 0.8;
            text-shadow: none;
        }

        #deleteProductCategory .modal-header .close:hover {
            opacity: 1;
        }

        #deleteProductCategory .modal-body {
            padding: 1.5rem 1.5rem;
        }

        #deleteProductCategory .modal-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
        }

        /* Warning Icon Container */
        #deleteProductCategory .bg-danger.bg-opacity-10 {
            background-color: rgba(220, 53, 69, 0.1) !important;
            width: 80px;
            height: 80px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Category Details Card */
        #deleteProductCategory .bg-light {
            background-color: #f8f9fa !important;
            border-left: 4px solid #dc3545;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        #deleteProductCategory .border-left.border-danger {
            border-left-width: 4px !important;
        }

        /* Alert styling */
        #deleteProductCategory .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
            border-radius: 6px;
            text-align: left;
        }

        /* Button styling */
        #deleteProductCategory .btn {
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            border-radius: 6px;
            transition: none;
            font-size: 0.95rem;
        }

        #deleteProductCategory .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        #deleteProductCategory .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        #deleteProductCategory .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        #deleteProductCategory .btn-danger:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            transform: none;
        }

        #deleteProductCategory .btn-danger:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* Loading state */
        #deleteCategoryLoading {
            animation: fadeIn 0.3s ease;
        }

        #deleteCategoryLoading .spinner-border {
            color: #dc3545;
        }

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
        #deleteProductCategory .modal-body>div:not(#deleteCategoryLoading) {
            animation: fadeIn 0.4s ease;
        }

        /* Text utilities */
        #deleteProductCategory .font-weight-bold {
            font-weight: 600;
        }

        #deleteProductCategory .text-muted {
            color: #6c757d !important;
        }

        #deleteProductCategory .small {
            font-size: 0.85rem;
        }

        /* Icon spacing */
        #deleteProductCategory .mr-1 {
            margin-right: 0.25rem;
        }

        #deleteProductCategory .mr-2 {
            margin-right: 0.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            #deleteProductCategory .modal-dialog {
                margin: 0.5rem;
            }

            #deleteProductCategory .modal-body {
                padding: 1.5rem 1rem;
            }

            #deleteProductCategory .bg-danger.bg-opacity-10 {
                width: 60px;
                height: 60px;
            }

            #deleteProductCategory .bg-danger.bg-opacity-10 i {
                font-size: 2rem !important;
            }

            #deleteProductCategory h5 {
                font-size: 1.1rem;
            }

            #deleteProductCategory .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            #deleteProductCategory .modal-footer {
                flex-direction: column-reverse;
                gap: 0.5rem;
            }

            #deleteProductCategory .modal-footer .btn {
                width: 100%;
                margin: 0 !important;
            }
        }

        /* Modal width adjustment */
        @media (min-width: 576px) {
            #deleteProductCategory .modal-dialog {
                max-width: 450px;
            }
        }

        /* Disabled state */
        #deleteProductCategory button:disabled {
            cursor: not-allowed;
        }
    </style>
</div>
