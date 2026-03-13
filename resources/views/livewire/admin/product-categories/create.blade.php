<div>
    <!-- Modal Add Product Category-->
    <div wire:ignore.self class="modal fade" id="addProductCategory" tabindex="-1" role="dialog"
        aria-labelledby="addCategoryModalTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addCategoryModalTitle">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Add Product Category
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="category_name_select" class="font-weight-bold">Category Name:</label>
                        <div x-data="{ selectedCategory: '', selected: false }">
                            <select name="category_name" wire:model="category_name" x-model="selectedCategory"
                                x-on:change="selected = (selectedCategory === 'Manual')" class="form-control"
                                id="category_name_select" required>
                                <option selected hidden="true">-- Select Category Name --</option>
                                <option disabled>-- Select Category Name --</option>
                                <optgroup label="🍔 Food">
                                    <option value="Bread">Bread</option>
                                    <option value="Dairy">Dairy</option>
                                    <option value="Fruit">Fruit</option>
                                    <option value="Vegetables">Vegetables</option>
                                </optgroup>
                                <optgroup label="🥤 Beverages">
                                    <option value="Coffee">Coffee</option>
                                    <option value="Tea">Tea</option>
                                    <option value="Juice">Juice</option>
                                    <option value="Soda">Soda</option>
                                    <option value="Alcohol">Alcohol</option>
                                </optgroup>
                                <optgroup label="📦 Others">
                                    <option value="Others">Others</option>
                                </optgroup>
                                <optgroup label="✏️ Manual">
                                    <option value="Manual">Manual Entry</option>
                                </optgroup>
                            </select>

                            <div x-show="selected" x-cloak class="mt-2">
                                <label class="small text-muted">Enter custom category name:</label>
                                <input type="text" wire:model='category_name' class="form-control"
                                    placeholder="e.g., Snacks, Frozen Food, etc.">
                            </div>

                            @error('category_name')
                                <span class="text-danger small mt-1">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="category_description" class="font-weight-bold">Category Description:</label>
                        <textarea id="category_description" name="category_description" wire:model="category_description"
                            placeholder="Enter category description..." class="form-control" rows="4" required></textarea>
                        @error('category_description')
                            <span class="text-danger small mt-1">*{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id='closeModalAdd'>
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>

                    <button class="btn btn-outline-warning" wire:target='resetInputs' wire:loading.attr='disabled'
                        wire:click="resetInputs">
                        <span wire:target='resetInputs' wire:loading>
                            <span class="spinner-border spinner-border-sm mr-1"></span> Resetting...
                        </span>
                        <span wire:target='resetInputs' wire:loading.remove>
                            <i class="fas fa-undo-alt mr-1"></i> Reset
                        </span>
                    </button>

                    <button type="button" class="btn btn-primary" wire:loading.attr='disabled'
                        wire:target='addProductCategory' wire:click="addProductCategory">
                        <span wire:loading wire:target='addProductCategory'>
                            <span class="spinner-border spinner-border-sm mr-1"></span> Adding...
                        </span>
                        <span wire:loading.remove wire:target='addProductCategory'>
                            <i class="fas fa-save mr-1"></i> Save Category
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles for the modal */
        #addProductCategory .modal-content {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        #addProductCategory .modal-header {
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        #addProductCategory .modal-header.bg-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        }

        #addProductCategory .modal-header .close {
            opacity: 0.8;
            text-shadow: none;
        }

        #addProductCategory .modal-header .close:hover {
            opacity: 1;
        }

        #addProductCategory .modal-body {
            padding: 1.5rem;
        }

        #addProductCategory .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        /* Form control styling */
        #addProductCategory .form-control,
        #addProductCategory .form-select {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 0.6rem 0.75rem;
            font-size: 0.95rem;
        }

        #addProductCategory .form-control:focus,
        #addProductCategory .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        }

        #addProductCategory .font-weight-bold {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        /* Select optgroup styling */
        #addProductCategory optgroup {
            font-weight: 600;
            color: #495057;
            background-color: #f8f9fa;
        }

        #addProductCategory optgroup option {
            font-weight: normal;
            background-color: white;
            padding: 0.5rem;
        }

        /* Button styling */
        #addProductCategory .btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border-radius: 5px;
            font-weight: 500;
            transition: none;
        }

        #addProductCategory .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        #addProductCategory .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        #addProductCategory .btn-outline-warning {
            color: #856404;
            border-color: #ffc107;
        }

        #addProductCategory .btn-outline-warning:hover {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        #addProductCategory .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        #addProductCategory .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* Error message styling */
        #addProductCategory .text-danger {
            font-size: 0.8rem;
            display: block;
            margin-top: 0.25rem;
        }

        /* Manual input section */
        #addProductCategory [x-show="selected"] {
            animation: slideDown 0.2s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Textarea styling */
        #addProductCategory textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            #addProductCategory .modal-dialog {
                margin: 0.5rem;
            }

            #addProductCategory .modal-body {
                padding: 1rem;
            }

            #addProductCategory .modal-footer {
                flex-direction: column-reverse;
                gap: 0.5rem;
            }

            #addProductCategory .modal-footer .btn {
                width: 100%;
                margin: 0 !important;
            }
        }

        /* Loading state styling */
        #addProductCategory .spinner-border {
            vertical-align: middle;
        }

        #addProductCategory button:disabled {
            cursor: not-allowed;
            opacity: 0.65;
        }

        /* Small text utility */
        #addProductCategory .small {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Icon spacing */
        #addProductCategory .mr-1 {
            margin-right: 0.25rem;
        }

        #addProductCategory .mr-2 {
            margin-right: 0.5rem;
        }
    </style>
</div>
