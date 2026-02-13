<div>
    <!-- Modal Add Product-->
    <div wire:ignore.self class="modal fade" id="addProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Add Product</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="title">Product Image:</label>
                                <input type="file" accept=".png, .jpg, .jpeg, .webp" multiple class="form-control"
                                    id="create_product_image" wire:model="product_images" required>
                                <div style="overflow-x: auto; overflow-y: hidden;" class="d-flex gap-1">
                                    @if (count($product_images) > 0)
                                        @foreach ($product_images as $key => $product_image)
                                            <div class="position-relative" wire:key='{{ $key }}'
                                                style="width: 100px; height: 100px;">
                                                <img src="{{ $product_image->temporaryUrl() }}"
                                                    style="width: 100px; height: 100px;" class="mt-1 rounded">
                                                @error("product_images.{$key}")
                                                    <span style="font-size: 8px; opacity: 0.8;"
                                                        class="position-absolute top-50 w-100 h-100 start-50 translate-middle text-white bg-danger position-absolute">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                <button type="button"
                                                    class="btn btn-link position-absolute bg-danger rounded-circle text-white"
                                                    wire:click='remove({{ $key }})'
                                                    style="top: 1px; right: 1px;"><i
                                                        class="fa-solid fa-xmark"></i></button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @error('product_images')
                                    <span class="text-danger">*{{ $message }} (jpg, jpeg, png, webp) is only
                                        accepted.</span>
                                @enderror
                                <div class="mt-2" wire:loading wire:target='product_images'>
                                    <span class="spinner-border"></span> Uploading...
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="form-group mb-3 col-10">
                                    <label for="product-code">Product Code:</label>
                                    <input type="text" id="product-code" class="form-control" name="product_code"
                                        wire:model.live="product_code" readonly>
                                </div>
                                <div class="col-2 form-group">
                                    <label for="btn">-</label>
                                    <button type="button" wire:loading.attr="disabled"
                                        wire:target='generateProductCode' wire:click="generateProductCode"
                                        class="btn btn-primary">
                                        <span wire:target='generateProductCode' wire:loading.remove><i
                                                class="fas fa-rotate"></i></span>
                                        <span wire:target='generateProductCode' wire:loading><i
                                                class="fas fa-rotate fa-spin"></i></span>
                                    </button>
                                </div>
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
                                    <span class="text-danger">*{{ $message }}</span>
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
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_old_price">Product Old Price:</label>
                                <input type="number" id="product_old_price" placeholder="Product Old Price"
                                    name="product Old Price" wire:model.live.debounce.200ms="product_old_price"
                                    class="form-control" required>
                                @error('product_old_price')
                                    <span class="text-danger">*{{ $message }}</span>
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
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_stock">Product Stock:</label>
                                <input type="number" @if ($this->is_color_selected || $this->is_size_selected) disabled @endif
                                    id="product_stock" placeholder="Product Stock" name="product Stock"
                                    wire:model.live.debounce.200ms="product_stock" class="form-control" required>
                                @error('product_stock')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    <div>
                        <input type="checkbox" wire:model.live='is_size_selected' id=""> <label
                            for="is_size_selected">Stock as Sizes</label>
                        @if ($this->is_size_selected)
                            @foreach ($this->size_lists as $key => $item)
                                <div class="d-flex flex-column" wire:model="size_lists.{{ $key }}"
                                    wire:key="size_lists.{{ $key }}">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="size_names">Product Size Name:</label>
                                                <input type="text" id="size_names"
                                                    placeholder="Product Size Name" name="product Stock"
                                                    wire:model="size_names.{{ $key }}" class="form-control"
                                                    required>
                                                @error("size_names.{$key}")
                                                    <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="size_stocks">Product Size Stock:</label>
                                                <input type="number" id="size_stocks"
                                                    placeholder="Product Size Stock" name="product Stock"
                                                    wire:model="size_stocks.{{ $key }}"
                                                    class="form-control" required>
                                                @error("size_stocks.{$key}")
                                                    <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if (count($this->size_lists) > 1)
                                        <button type="button"
                                            class="btn btn-link text-danger btn-sm align-self-start"
                                            wire:click='removeSize({{ $key }})'><i
                                                class="fa-solid fa-xmark"></i>
                                            Remove</button>
                                    @endif
                                </div>
                            @endforeach
                            <button type="button" class="btn btn-link btn-sm" wire:click='addSize'><i
                                    class="fa-solid fa-plus"></i>
                                Add</button>
                        @endif
                    </div>
                    <div>
                        <input type="checkbox" wire:model.live='is_color_selected' id=""> <label
                            for="is_color_selected">Stock as Colors</label>
                        @if ($this->is_color_selected)
                            @foreach ($this->color_lists as $key => $item)
                                <div class="d-flex flex-column" wire:model="color_lists.{{ $key }}"
                                    wire:key="color_lists.{{ $key }}">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="color_names">Product Color Name:</label>
                                                <input type="text" id="color_names"
                                                    placeholder="Product Color Name" name="product Stock"
                                                    wire:model="color_names.{{ $key }}" class="form-control"
                                                    required>
                                                @error("color_names.{$key}")
                                                    <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="color_stocks">Product Color Stock:</label>
                                                <input type="number" id="color_stocks"
                                                    placeholder="Product Color Stock" name="product Stock"
                                                    wire:model="color_stocks.{{ $key }}"
                                                    class="form-control" required>
                                                @error("color_stocks.{$key}")
                                                    <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if (count($this->color_lists) > 1)
                                        <button type="button"
                                            class="btn btn-link text-danger btn-sm align-self-start"
                                            wire:click='removeColor({{ $key }})'><i
                                                class="fa-solid fa-xmark"></i>
                                            Remove</button>
                                    @endif
                                </div>
                            @endforeach
                            <button type="button" class="btn btn-link btn-sm" wire:click='addColor'><i
                                    class="fa-solid fa-plus"></i>
                                Add</button>
                        @endif
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="product_description">Description:</label>
                                <textarea id="product_description" name="product_description" wire:model.live.debounce.200ms="product_description"
                                    placeholder="Description" class="form-control" rows="5" required></textarea>
                                @error('product_description')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:loading.attr='disabled' wire:target='addProduct,product_images,product_code' type="button"
                        class="btn btn-primary" wire:click="addProduct">
                        <div wire:loading wire:target='addProduct'>
                            <span class="spinner-border spinner-border-sm"></span> Adding...
                        </div>
                        <div wire:loading.remove wire:target='addProduct'>
                            <i class="fa-solid fa-plus"></i> Add Product
                        </div>
                    </button>
                    <button class="btn btn-outline-warning" wire:target='resetInputs' wire:loading.attr='disabled'
                        wire:click="resetInputs">
                        <div wire:target='resetInputs' wire:loading>
                            <span class="spinner-border spinner-border-sm"></span> Resetting...
                        </div>
                        <div wire:target='resetInputs' wire:loading.remove>
                            <i class="fa-solid fa-rotate"></i> Reset Inputs
                        </div>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
