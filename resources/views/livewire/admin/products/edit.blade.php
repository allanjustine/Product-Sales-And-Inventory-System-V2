<div>
    <!-- Modal Update Product-->
    <div wire:ignore.self class="modal fade" id="updateProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Edit Product</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($productEdit)
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="title">Product Image:</label>
                                <br>
                                @error('product_image')
                                <span class="text-danger">*{{ $message ?? '' }} (jpg, jpeg, png, gif) is only
                                    accepted.</span>
                                @enderror
                                <input type="file" accept=".png, .jpg, .jpeg, .gif" class="form-control"
                                    id="product_image" wire:model.live="product_image" required>
                                @if ($product_image && in_array($product_image->getClientOriginalExtension(),
                                ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ $product_image->temporaryUrl() }}" style="width: 100px; height: 100px;"
                                    class="mt-1 rounded">
                                @else
                                <img src="{{ $product_image_url }}" style="width: 100px; height: 100px;"
                                    class="mt-1 rounded">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product-code">Product Code:</label>
                                <input type="text" id="product-code" class="form-control" name="product_code"
                                    wire:model.live="product_code" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_name">Product Name:</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Product Name"
                                    wire:model.live.debounce.200ms="product_name" required>
                                @error('product_name')
                                <span class="text-danger">*{{ $message ?? '' }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_status">Product Status:</label>
                                <select class="form-select" id="product_status"
                                    wire:model.live.debounce.200ms="product_status" required>
                                    <option selected hidden="true">Select Product Status</option>
                                    <option disabled>Select Product Status</option>
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
                                </select>
                                @error('product_status')
                                <span class="text-danger">*{{ $message ?? '' }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_stock">Product Stock:</label>
                                <input type="number" id="product_stock" placeholder="Product Stock" name="product Stock"
                                    wire:model.live.debounce.200ms="product_stock" class="form-control" required>
                                @error('product_stock')
                                <span class="text-danger">*{{ $message ?? '' }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_price">Product Price:</label>
                                <input type="number" id="product_price" name="product_price"
                                    wire:model.live.debounce.200ms="product_price" placeholder="Product Price"
                                    class="form-control" required>
                                @error('product_price')
                                <span class="text-danger">*{{ $message ?? '' }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="product_category_id">Product Category:</label>
                                <select class="form-select" id="product_category_id"
                                    wire:model.live.debounce.200ms="product_category_id" required>
                                    <option selected hidden="true">Select Product Category</option>
                                    <option disabled>Select Product Category</option>
                                    @foreach ($product_categories as $product_category)
                                    <option value="{{ $product_category->id }}">
                                        {{ $product_category->category_name }}</option>
                                    @endforeach

                                </select>
                                @error('product_category_id')
                                <span class="text-danger">*The product category field is required.</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="product_description">Description:</label>
                                <textarea id="product_description" name="product_description"
                                    wire:model.live.debounce.200ms="product_description" placeholder="Description"
                                    class="form-control" rows="5" required></textarea>
                                @error('product_description')
                                <span class="text-danger">*{{ $message ?? '' }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @else
                    <div class="row">
                        <!-- Product Image Placeholder -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Product Image:</label>
                                <div class="placeholder-glow">
                                    <div class="placeholder w-100" style="height: 100px;"></div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Product Code Placeholder -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Product Code:</label>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Product Name Placeholder -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Product Name:</label>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Product Status Placeholder -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Product Status:</label>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Product Stock Placeholder -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Product Stock:</label>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Product Price Placeholder -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Product Price:</label>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-10"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Product Category Placeholder -->
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Product Category:</label>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Product Description Placeholder -->
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Description:</label>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                    <span class="placeholder col-10"></span>
                                    <span class="placeholder col-8"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:target='update' wire:loading.attr='disabled'
                        wire:click="update">
                        <div wire:loading wire:target='update'>
                            <span class="spinner-border spinner-border-sm"></span> Updating...
                        </div>
                        <div wire:loading.remove wire:target='update'>
                            <i class="fa-solid fa-pen-to-square"></i> Update Product
                        </div>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>