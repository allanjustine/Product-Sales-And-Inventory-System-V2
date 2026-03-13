<div>
    <!-- Modal Edit Product Category-->
    <div wire:ignore.self class="modal fade" id="editProductCategory" tabindex="-1" role="dialog"
        aria-labelledby="editCategoryModalTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editCategoryModalTitle">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Product Category
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @if ($productCategoryEdit)
                        <div class="form-group mb-3">
                            <label for="edit_category_name" class="font-weight-bold">Category Name:</label>
                            <input type="text" wire:model='category_name' class="form-control"
                                id="edit_category_name" placeholder="Enter category name" required>
                            @error('category_name')
                                <span class="text-danger small mt-1">*{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="edit_category_description" class="font-weight-bold">Category
                                Description:</label>
                            <textarea id="edit_category_description" name="category_description" wire:model="category_description"
                                placeholder="Enter category description..." class="form-control" rows="4" required></textarea>
                            @error('category_description')
                                <span class="text-danger small mt-1">*{{ $message ?? '' }}</span>
                            @enderror
                        </div>
                    @else
                        <div class="text-center py-5" id="editLoadingState">
                            <div class="spinner-border text-warning mb-3" style="width: 3rem; height: 3rem;"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h5 class="text-muted">Loading category information...</h5>
                            <p class="text-muted small mb-0">Please wait while we fetch the details</p>
                        </div>
                    @endif
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id='closeModalUpdate'>
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>

                    <button type="button" class="btn btn-warning" wire:loading.attr='disabled' wire:target='update'
                        wire:click="update">
                        <span wire:loading.remove wire:target='update'>
                            <i class="fas fa-save mr-1"></i> Update Category
                        </span>
                        <span wire:loading wire:target='update'>
                            <span class="spinner-border spinner-border-sm mr-1"></span> Updating...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles for the modal */
        #editProductCategory .modal-content {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        #editProductCategory .modal-header {
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        #editProductCategory .modal-header.bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
        }

        #editProductCategory .modal-header .close {
            opacity: 0.8;
            text-shadow: none;
        }

        #editProductCategory .modal-header .close:hover {
            opacity: 1;
        }

        #editProductCategory .modal-body {
            padding: 1.5rem;
        }

        #editProductCategory .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        /* Form control styling */
        #editProductCategory .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 0.6rem 0.75rem;
            font-size: 0.95rem;
            transition: none;
        }

        #editProductCategory .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        #editProductCategory .font-weight-bold {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        /* Button styling */
        #editProductCategory .btn {
            padding: 0.5rem 1.25rem;
            font-size: 0.9rem;
            border-radius: 5px;
            font-weight: 500;
            transition: none;
        }

        #editProductCategory .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        #editProductCategory .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        #editProductCategory .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        #editProductCategory .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* Loading state styling */
        #editLoadingState {
            animation: fadeIn 0.3s ease;
        }

        #editLoadingState .spinner-border {
            color: #ffc107;
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

        /* Error message styling */
        #editProductCategory .text-danger {
            font-size: 0.8rem;
            display: block;
        }

        /* Textarea styling */
        #editProductCategory textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            #editProductCategory .modal-dialog {
                margin: 0.5rem;
            }

            #editProductCategory .modal-body {
                padding: 1rem;
            }

            #editProductCategory .modal-footer {
                flex-direction: column-reverse;
                gap: 0.5rem;
            }

            #editProductCategory .modal-footer .btn {
                width: 100%;
                margin: 0 !important;
            }
        }

        /* Loading state adjustments */
        #editProductCategory button:disabled {
            cursor: not-allowed;
            opacity: 0.65;
        }

        /* Icon spacing */
        #editProductCategory .mr-1 {
            margin-right: 0.25rem;
        }

        #editProductCategory .mr-2 {
            margin-right: 0.5rem;
        }

        /* Small text utility */
        #editProductCategory .small {
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
</div>
