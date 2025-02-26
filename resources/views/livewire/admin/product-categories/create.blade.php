<div>
    <!-- Modal Add Product Category-->
    <div wire:ignore.self class="modal fade" id="addProductCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Add Product Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="category_name">Category Name:</label>
                                <div x-data="{ selectedCategory: '', selected: false }">
                                    <select name="category_name" wire:model="category_name" x-model="selectedCategory"
                                        x-on:change="selected = (selectedCategory === 'Manual')" class="form-select"
                                        required>
                                        <option selected hidden="true">Select Category Name</option>
                                        <option disabled>Select Category Name</option>
                                        <optgroup label="Food">
                                            <option value="Bread">Bread</option>
                                            <option value="Dairy">Dairy</option>
                                            <option value="Fruit">Fruit</option>
                                            <option value="Vegetables">Vegetables</option>
                                        </optgroup>
                                        <optgroup label="Beverages">
                                            <option value="Coffee">Coffee</option>
                                            <option value="Tea">Tea</option>
                                            <option value="Juice">Juice</option>
                                            <option value="Soda">Soda</option>
                                            <option value="Alcohol">Alcohol</option>
                                        </optgroup>
                                        <optgroup label="Others">
                                            <option value="Others">Others</option>
                                        </optgroup>
                                        <optgroup label="Manual">
                                            <option value="Manual">Manual</option>
                                        </optgroup>
                                    </select>
                                    <div x-show="selected" x-cloak>
                                        <input type="text" wire:model='category_name' class="form-control mt-2"
                                            placeholder="Enter Category Name">
                                    </div>
                                    @error('category_name')
                                    <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="category_description">Category Description:</label>
                                <textarea id="category_description" name="category_description"
                                    wire:model="category_description" placeholder="Description" class="form-control"
                                    rows="5" required></textarea>
                                @error('category_description')
                                <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:loading.attr='disabled'
                        wire:target='addProductCategory' wire:click="addProductCategory">
                        <div wire:loading wire:target='addProductCategory'>
                            <span class="spinner-border spinner-border-sm"></span> Adding...
                        </div>
                        <div wire:loading.remove wire:target='addProductCategory'>
                            <i class="fa-solid fa-plus"></i> Add Product Category
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id='closeModalAdd'>Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
