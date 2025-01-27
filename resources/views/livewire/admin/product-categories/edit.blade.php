<div>
    <!-- Modal Edit Product Category-->
    <div wire:ignore.self class="modal fade" id="editProductCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Edit Product Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="category_name">Category Name:</label>
                                    <select id="category_name" class="form-select" wire:model.live.debounce.200ms="category_name"
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
                                    </select>
                                    @error('category_name')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="category_description">Category Description:</label>
                                    <textarea id="category_description" name="category_description" wire:model.live.debounce.200ms="category_description"
                                        placeholder="Description" class="form-control" rows="5" required></textarea>
                                    @error('category_description')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="update()">
                        <div wire:loading><svg class="loading"></svg></div>&nbsp;<i
                            class="fa-solid fa-pen-to-square"></i> Update Product Category
                    </button>
                    <button class="btn btn-outline-warning" wire:click="resetInputs()"><i
                            class="fa-solid fa-rotate"></i> Reset Inputs</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', function() {
        $('#editProductCategory').on('hidden.bs.modal', function() {
            Livewire.dispatch('resetInputs');
        });
    });
</script>
