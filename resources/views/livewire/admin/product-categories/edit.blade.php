<div>
    <!-- Modal Edit Product Category-->
    <div wire:ignore.self class="modal fade" id="editProductCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Edit Product Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($productCategoryEdit)
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="category_name">Category Name:</label>
                                <div>
                                    <input type="text" wire:model='category_name' class="form-control mt-2"
                                        placeholder="Enter Category Name">
                                </div>
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
                                <textarea id="category_description" name="category_description"
                                    wire:model="category_description" placeholder="Description" class="form-control"
                                    rows="5" required></textarea>
                                @error('category_description')
                                <span class="text-danger">*{{ $message ?? '' }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center fw-4 fs-4">
                        <div class="spinner-border"></div> Getting product category's information...
                    </div>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:loading.attr='disabled' wire:target='update'
                        wire:click="update">
                        <div wire:loading wire:target='update'>
                            <span class="spinner-border spinner-border-sm"></span> Updating...
                        </div>
                        <div wire:loading.remove wire:target='update'>
                            <i class="fa-solid fa-pen-to-square"></i> Update Product Category
                        </div>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id='closeModalUpdate'>Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
