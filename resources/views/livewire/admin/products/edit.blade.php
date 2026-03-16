<div>
    <!-- Modal Update Product-->
    <div wire:ignore.self class="modal fade" id="updateProduct" tabindex="-1" role="dialog"
        aria-labelledby="updateProductModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="updateProductModalTitle">
                        <i class="fa-solid fa-edit me-2"></i>Edit Product
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if ($productEdit)
                        <!-- Product Images Section -->
                        <div class="card card-outline card-warning mb-3">
                            <div class="card-header bg-light py-2">
                                <h6 class="card-title mb-0">
                                    <i class="fa-solid fa-images text-warning me-2"></i>Product Images
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="product_image_update" class="form-label fw-bold">Update Images:</label>
                                    <input type="file" accept=".png, .jpg, .jpeg, .gif" multiple class="form-control"
                                        id="product_image_update" wire:model.live="product_images">

                                    @error('product_image')
                                        <span class="text-danger small mt-1">*{{ $message ?? '' }} (jpg, jpeg, png, gif
                                            only)</span>
                                    @enderror

                                    <!-- Image Gallery -->
                                    <div class="mt-3" id="imageGallery">
                                        <!-- Existing Images -->
                                        @if ($this->product_all_images->count() > 0)
                                            <div class="mb-2">
                                                <label class="small text-muted fw-bold">Current Images:</label>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($this->product_all_images as $image)
                                                        <div class="position-relative" wire:key='{{ $image->id }}'
                                                            style="width: 90px; height: 90px;">
                                                            <img src="{{ Storage::exists($image->path) ? Storage::url($image->path) : url($image->path) }}"
                                                                class="img-thumbnail w-100 h-100"
                                                                style="object-fit: cover;" alt="Product image">
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger position-absolute rounded-circle p-0"
                                                                wire:click='removeImage({{ $image->id }})'
                                                                style="top: -5px; right: -5px; width: 22px; height: 22px;">
                                                                <i class="fa-solid fa-xmark fa-xs"></i>
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <!-- New Images Preview -->
                                        @if (count($product_images) > 0)
                                            <div>
                                                <label class="small text-muted fw-bold">New Images:</label>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($product_images as $key => $product_image)
                                                        <div class="position-relative" wire:key='{{ $key }}'
                                                            style="width: 90px; height: 90px;">
                                                            <img src="{{ $product_image->temporaryUrl() }}"
                                                                class="img-thumbnail w-100 h-100"
                                                                style="object-fit: cover;"
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
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-2" wire:loading wire:target='product_images'>
                                        <span class="spinner-border spinner-border-sm text-warning me-1"></span>
                                        <span class="small">Uploading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Information Section -->
                        <div class="card card-outline card-warning mb-3">
                            <div class="card-header bg-light py-2">
                                <h6 class="card-title mb-0">
                                    <i class="fa-solid fa-info-circle text-warning me-2"></i>Basic Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="update_product_name" class="form-label fw-bold">Product
                                                Name:</label>
                                            <input type="text" multiple class="form-control" id="update_product_name"
                                                placeholder="Enter product name"
                                                wire:model.live.debounce.200ms="product_name" required>
                                            @error('product_name')
                                                <span class="text-danger small">*{{ $message ?? '' }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="update_product_code" class="form-label fw-bold">Product
                                                Code:</label>
                                            <input type="text" id="update_product_code" class="form-control bg-light"
                                                name="product_code" wire:model.live="product_code" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="update_product_category"
                                                class="form-label fw-bold">Category:</label>
                                            <select class="form-select" id="update_product_category"
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
                                            <label for="update_product_status"
                                                class="form-label fw-bold">Status:</label>
                                            <select class="form-select" id="update_product_status"
                                                wire:model.live.debounce.200ms="product_status" required>
                                                <option value="" selected hidden>Select status</option>
                                                <option value="Available">Available</option>
                                                <option value="Not Available">Not Available</option>
                                            </select>
                                            @error('product_status')
                                                <span class="text-danger small">*{{ $message ?? '' }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Section -->
                        <div class="card card-outline card-warning mb-3">
                            <div class="card-header bg-light py-2">
                                <h6 class="card-title mb-0">
                                    <i class="fa-solid fa-tag text-warning me-2"></i>Pricing
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="update_product_price" class="form-label fw-bold">Regular
                                                Price:</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" id="update_product_price" name="product_price"
                                                    wire:model.live.debounce.200ms="product_price" placeholder="0.00"
                                                    class="form-control" step="0.01" required>
                                            </div>
                                            @error('product_price')
                                                <span class="text-danger small">*{{ $message ?? '' }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="update_product_old_price" class="form-label fw-bold">Old Price
                                                (Optional):</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" id="update_product_old_price"
                                                    placeholder="0.00" name="product_old_price"
                                                    wire:model.live.debounce.200ms="product_old_price"
                                                    class="form-control" step="0.01">
                                            </div>
                                            @error('product_old_price')
                                                <span class="text-danger small">*{{ $message ?? '' }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Management Section -->
                        <div class="card card-outline card-warning mb-3">
                            <div class="card-header bg-light py-2">
                                <h6 class="card-title mb-0">
                                    <i class="fa-solid fa-warehouse text-warning me-2"></i>Stock Management
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <label for="update_product_stock" class="form-label fw-bold">Quantity in
                                        Stock:</label>
                                    <input type="number" @if ($this->is_color_selected || $this->is_size_selected) disabled @endif
                                        id="update_product_stock" placeholder="Enter quantity" name="product_stock"
                                        wire:model.live.debounce.200ms="product_stock" class="form-control"
                                        min="0" required>
                                    @error('product_stock')
                                        <span class="text-danger small">*{{ $message }}</span>
                                    @enderror

                                    @if ($this->is_color_selected || $this->is_size_selected)
                                        <div class="alert alert-info mt-2 mb-0 py-2 small">
                                            <i class="fa-solid fa-info-circle me-1"></i>
                                            Stock is managed through variants. Edit variants in the product details
                                            page.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="card card-outline card-warning mb-3">
                            <div class="card-header bg-light py-2">
                                <h6 class="card-title mb-0">
                                    <i class="fa-solid fa-align-left text-warning me-2"></i>Description
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <textarea id="update_product_description" name="product_description"
                                        wire:model.live.debounce.200ms="product_description" placeholder="Enter detailed product description..."
                                        class="form-control" rows="4" required></textarea>
                                    @error('product_description')
                                        <span class="text-danger small">*{{ $message ?? '' }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Loading Placeholder -->
                        <div class="text-center py-4" id="loadingPlaceholder">
                            <div class="spinner-border text-warning mb-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <h6 class="text-muted">Loading product data...</h6>
                        </div>

                        <div class="row g-3">
                            <!-- Product Images Placeholder -->
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-4"></span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex gap-2">
                                            <div class="placeholder" style="width: 90px; height: 90px;"></div>
                                            <div class="placeholder" style="width: 90px; height: 90px;"></div>
                                            <div class="placeholder" style="width: 90px; height: 90px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Basic Info Placeholder -->
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-6"></span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12 mb-2"></span>
                                            <span class="placeholder col-8"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-5"></span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12 mb-2"></span>
                                            <span class="placeholder col-6"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-times me-1"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-warning" wire:target='update' wire:loading.attr='disabled'
                        wire:click="update">
                        <span wire:loading wire:target='update'>
                            <span class="spinner-border spinner-border-sm me-1"></span> Updating...
                        </span>
                        <span wire:loading.remove wire:target='update'>
                            <i class="fa-solid fa-save me-1"></i> Update Product
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles using IDs */
        #updateProduct .modal-content {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        #updateProduct .modal-header {
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        #updateProduct .modal-header.bg-warning {
            background-color: #ffc107 !important;
        }

        #updateProduct .modal-body {
            padding: 1.5rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        #updateProduct .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
        }

        #updateProduct .card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        #updateProduct .card.card-outline.card-warning {
            border-top: 3px solid #ffc107;
        }

        #updateProduct .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
        }

        #updateProduct .card-header h6 {
            font-size: 0.95rem;
            font-weight: 600;
            color: #495057;
        }

        #updateProduct .form-label {
            font-size: 0.85rem;
            margin-bottom: 0.25rem;
            color: #495057;
        }

        #updateProduct .form-control,
        #updateProduct .form-select {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }

        #updateProduct .form-control:focus,
        #updateProduct .form-select:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        #updateProduct .form-control.bg-light {
            background-color: #e9ecef;
        }

        #updateProduct .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            color: #495057;
            font-size: 0.9rem;
        }

        #updateProduct .btn-close {
            filter: brightness(0) invert(1);
        }

        #updateProduct .btn-warning {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        #updateProduct .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        #imageGallery {
            max-height: 200px;
            overflow-y: auto;
            padding-right: 5px;
        }

        #imageGallery::-webkit-scrollbar {
            width: 5px;
        }

        #imageGallery::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 5px;
        }

        #imageGallery::-webkit-scrollbar-thumb {
            background: #ffc107;
            border-radius: 5px;
        }

        #loadingPlaceholder {
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Image thumbnails */
        #updateProduct .img-thumbnail {
            border: 2px solid #dee2e6;
            transition: none;
        }

        /* Alert styling */
        #updateProduct .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }

        /* Scrollbar styling for modal body */
        #updateProduct .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        #updateProduct .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #updateProduct .modal-body::-webkit-scrollbar-thumb {
            background: #ffc107;
            border-radius: 10px;
        }

        #updateProduct .modal-body::-webkit-scrollbar-thumb:hover {
            background: #e0a800;
        }

        /* Loading states */
        #updateProduct button:disabled {
            cursor: not-allowed;
            opacity: 0.65;
        }

        /* Placeholder styling */
        #updateProduct .placeholder {
            background-color: #e9ecef;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #updateProduct .modal-dialog {
                margin: 0.5rem;
            }

            #updateProduct .modal-body {
                padding: 1rem;
            }

            #imageGallery {
                max-height: 150px;
            }
        }
    </style>
</div>
