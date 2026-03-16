<div>
    <!-- Modal Add Product-->
    <div wire:ignore.self class="modal fade" id="addProduct" tabindex="-1" role="dialog"
        aria-labelledby="addProductModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addProductModalTitle">
                        <i class="fa-solid fa-box me-2"></i>Add New Product
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Product Images Section -->
                    <div class="card card-outline card-primary mb-3">
                        <div class="card-header bg-light py-2">
                            <h6 class="card-title mb-0">
                                <i class="fa-solid fa-images text-primary me-2"></i>Product Images
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="create_product_image" class="form-label fw-bold">Upload Images:</label>
                                <input type="file" accept=".png, .jpg, .jpeg, .webp" multiple class="form-control"
                                    id="create_product_image" wire:model="product_images" required>

                                @error('product_images')
                                    <span class="text-danger small mt-1">*{{ $message }} (jpg, jpeg, png, webp
                                        only)</span>
                                @enderror

                                <!-- Image Preview -->
                                @if (count($product_images) > 0)
                                    <div class="d-flex flex-wrap gap-2 mt-3" id="imagePreviewContainer">
                                        @foreach ($product_images as $key => $product_image)
                                            <div class="position-relative" wire:key='{{ $key }}'
                                                style="width: 100px; height: 100px;">
                                                <img src="{{ $product_image->temporaryUrl() }}"
                                                    class="img-thumbnail w-100 h-100" style="object-fit: cover;"
                                                    alt="Preview {{ $key }}">
                                                @error("product_images.{$key}")
                                                    <div class="position-absolute bottom-0 start-0 end-0 bg-danger text-white small p-1 text-center"
                                                        style="font-size: 8px; opacity: 0.9;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <button type="button"
                                                    class="btn btn-sm btn-danger position-absolute rounded-circle p-0"
                                                    wire:click='remove({{ $key }})'
                                                    style="top: -5px; right: -5px; width: 22px; height: 22px;">
                                                    <i class="fa-solid fa-xmark fa-xs"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="mt-2" wire:loading wire:target='product_images'>
                                    <span class="spinner-border spinner-border-sm text-primary me-1"></span>
                                    <span class="small">Uploading...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Basic Information Section -->
                    <div class="card card-outline card-primary mb-3">
                        <div class="card-header bg-light py-2">
                            <h6 class="card-title mb-0">
                                <i class="fa-solid fa-info-circle text-primary me-2"></i>Basic Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_name" class="form-label fw-bold">Product Name:</label>
                                        <input type="text" class="form-control" id="product_name"
                                            placeholder="Enter product name"
                                            wire:model.live.debounce.200ms="product_name" required>
                                        @error('product_name')
                                            <span class="text-danger small">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_code_display" class="form-label fw-bold">Product
                                            Code:</label>
                                        <div class="input-group">
                                            <input type="text" id="product_code_display" class="form-control"
                                                name="product_code" wire:model.live="product_code" readonly>
                                            <button type="button" wire:loading.attr="disabled"
                                                wire:target='generateProductCode' wire:click="generateProductCode"
                                                class="btn btn-outline-primary" title="Generate new code">
                                                <span wire:target='generateProductCode' wire:loading.remove>
                                                    <i class="fa-solid fa-sync-alt"></i>
                                                </span>
                                                <span wire:target='generateProductCode' wire:loading>
                                                    <i class="fa-solid fa-sync-alt fa-spin"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_category_id" class="form-label fw-bold">Category:</label>
                                        <select class="form-select" id="product_category_id"
                                            wire:model.live.debounce.200ms="product_category_id" required>
                                            <option value="" selected hidden>Select a category</option>
                                            @foreach ($product_categories as $product_category)
                                                <option value="{{ $product_category->id }}">
                                                    {{ $product_category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_category_id')
                                            <span class="text-danger small">*Please select a category</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_status" class="form-label fw-bold">Status:</label>
                                        <select class="form-select" id="product_status"
                                            wire:model.live.debounce.200ms="product_status" required>
                                            <option value="" selected hidden>Select status</option>
                                            <option value="Available">Available</option>
                                            <option value="Not Available">Not Available</option>
                                        </select>
                                        @error('product_status')
                                            <span class="text-danger small">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="card card-outline card-primary mb-3">
                        <div class="card-header bg-light py-2">
                            <h6 class="card-title mb-0">
                                <i class="fa-solid fa-tag text-primary me-2"></i>Pricing
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_price" class="form-label fw-bold">Regular Price:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="number" id="product_price" name="product_price"
                                                wire:model.live.debounce.200ms="product_price" placeholder="0.00"
                                                class="form-control" step="0.01" required>
                                        </div>
                                        @error('product_price')
                                            <span class="text-danger small">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_old_price" class="form-label fw-bold">Old Price
                                            (Optional):</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="number" id="product_old_price" placeholder="0.00"
                                                name="product_old_price"
                                                wire:model.live.debounce.200ms="product_old_price"
                                                class="form-control" step="0.01">
                                        </div>
                                        @error('product_old_price')
                                            <span class="text-danger small">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Management Section -->
                    <div class="card card-outline card-primary mb-3">
                        <div class="card-header bg-light py-2">
                            <h6 class="card-title mb-0">
                                <i class="fa-solid fa-warehouse text-primary me-2"></i>Stock Management
                            </h6>
                        </div>
                        <div class="card-body">
                            <!-- Stock Type Selection -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"
                                            wire:model.live='is_size_selected' id="is_size_selected">
                                        <label class="form-check-label fw-bold" for="is_size_selected">
                                            Manage stock by sizes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"
                                            wire:model.live='is_color_selected' id="is_color_selected">
                                        <label class="form-check-label fw-bold" for="is_color_selected">
                                            Manage stock by colors
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Simple Stock -->
                            @if (!$this->is_size_selected && !$this->is_color_selected)
                                <div class="form-group mb-0">
                                    <label for="product_stock" class="form-label fw-bold">Quantity in Stock:</label>
                                    <input type="number" id="product_stock" placeholder="Enter quantity"
                                        name="product_stock" wire:model.live.debounce.200ms="product_stock"
                                        class="form-control" min="0" required>
                                    @error('product_stock')
                                        <span class="text-danger small">*{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                            <!-- Size Variants -->
                            @if ($this->is_size_selected)
                                <div class="border rounded p-3 bg-light" id="sizeVariantsContainer">
                                    <h6 class="fw-bold mb-3">Size Variants</h6>
                                    @foreach ($this->size_lists as $key => $item)
                                        <div class="d-flex flex-column border-bottom pb-2 mb-2"
                                            wire:key="size_lists.{{ $key }}">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group mb-2">
                                                        <label class="small fw-bold">Size Name:</label>
                                                        <input type="text" placeholder="e.g., Small, Medium, Large"
                                                            wire:model="size_names.{{ $key }}"
                                                            class="form-control form-control-sm" required>
                                                        @error("size_names.{$key}")
                                                            <span class="text-danger small">*{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group mb-2">
                                                        <label class="small fw-bold">Stock:</label>
                                                        <input type="number" placeholder="Quantity"
                                                            wire:model="size_stocks.{{ $key }}"
                                                            class="form-control form-control-sm" min="0"
                                                            required>
                                                        @error("size_stocks.{$key}")
                                                            <span class="text-danger small">*{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    @if (count($this->size_lists) > 1)
                                                        <button type="button"
                                                            class="btn btn-link text-danger p-0 mb-2"
                                                            wire:click='removeSize({{ $key }})'>
                                                            <i class="fa-solid fa-trash-alt me-1"></i>Remove
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2"
                                        wire:click='addSize'>
                                        <i class="fa-solid fa-plus me-1"></i> Add Size Variant
                                    </button>
                                </div>
                            @endif

                            <!-- Color Variants -->
                            @if ($this->is_color_selected)
                                <div class="border rounded p-3 bg-light mt-3" id="colorVariantsContainer">
                                    <h6 class="fw-bold mb-3">Color Variants</h6>
                                    @foreach ($this->color_lists as $key => $item)
                                        <div class="d-flex flex-column border-bottom pb-2 mb-2"
                                            wire:key="color_lists.{{ $key }}">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group mb-2">
                                                        <label class="small fw-bold">Color Name:</label>
                                                        <input type="text" placeholder="e.g., Red, Blue, Green"
                                                            wire:model="color_names.{{ $key }}"
                                                            class="form-control form-control-sm" required>
                                                        @error("color_names.{$key}")
                                                            <span class="text-danger small">*{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group mb-2">
                                                        <label class="small fw-bold">Stock:</label>
                                                        <input type="number" placeholder="Quantity"
                                                            wire:model="color_stocks.{{ $key }}"
                                                            class="form-control form-control-sm" min="0"
                                                            required>
                                                        @error("color_stocks.{$key}")
                                                            <span class="text-danger small">*{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    @if (count($this->color_lists) > 1)
                                                        <button type="button"
                                                            class="btn btn-link text-danger p-0 mb-2"
                                                            wire:click='removeColor({{ $key }})'>
                                                            <i class="fa-solid fa-trash-alt me-1"></i>Remove
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2"
                                        wire:click='addColor'>
                                        <i class="fa-solid fa-plus me-1"></i> Add Color Variant
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="card card-outline card-primary mb-3">
                        <div class="card-header bg-light py-2">
                            <h6 class="card-title mb-0">
                                <i class="fa-solid fa-align-left text-primary me-2"></i>Description
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <textarea id="product_description" name="product_description" wire:model.live.debounce.200ms="product_description"
                                    placeholder="Enter detailed product description..." class="form-control" rows="4" required></textarea>
                                @error('product_description')
                                    <span class="text-danger small">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-times me-1"></i> Cancel
                    </button>
                    <button class="btn btn-outline-warning" wire:target='resetInputs' wire:loading.attr='disabled'
                        wire:click="resetInputs">
                        <span wire:target='resetInputs' wire:loading>
                            <span class="spinner-border spinner-border-sm me-1"></span> Resetting...
                        </span>
                        <span wire:target='resetInputs' wire:loading.remove>
                            <i class="fa-solid fa-undo-alt me-1"></i> Reset
                        </span>
                    </button>
                    <button wire:loading.attr='disabled' wire:target='addProduct,product_images,product_code'
                        type="button" class="btn btn-primary" wire:click="addProduct">
                        <span wire:loading wire:target='addProduct'>
                            <span class="spinner-border spinner-border-sm me-1"></span> Adding...
                        </span>
                        <span wire:loading.remove wire:target='addProduct'>
                            <i class="fa-solid fa-save me-1"></i> Save Product
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles using IDs */
        #addProduct .modal-content {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        #addProduct .modal-header {
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        #addProduct .modal-body {
            padding: 1.5rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        #addProduct .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
        }

        #addProduct .card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        #addProduct .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
        }

        #addProduct .card-header h6 {
            font-size: 0.95rem;
            font-weight: 600;
        }

        #addProduct .form-label {
            font-size: 0.85rem;
            margin-bottom: 0.25rem;
            color: #495057;
        }

        #addProduct .form-control,
        #addProduct .form-select {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }

        #addProduct .form-control:focus,
        #addProduct .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .15);
        }

        #addProduct .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            color: #495057;
            font-size: 0.9rem;
        }

        #addProduct .btn-close {
            filter: brightness(0) invert(1);
        }

        #addProduct .bg-light {
            background-color: #f8f9fa !important;
        }

        #imagePreviewContainer {
            max-height: 120px;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            padding-bottom: 5px;
        }

        #imagePreviewContainer>div {
            display: inline-block;
            float: none;
        }

        #sizeVariantsContainer,
        #colorVariantsContainer {
            background-color: #f8f9fa;
        }

        /* Scrollbar styling */
        #addProduct .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        #addProduct .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #addProduct .modal-body::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        #addProduct .modal-body::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Loading states */
        #addProduct button:disabled {
            cursor: not-allowed;
            opacity: 0.65;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #addProduct .modal-dialog {
                margin: 0.5rem;
            }

            #addProduct .modal-body {
                padding: 1rem;
            }
        }
    </style>
</div>
