<div>
    <!-- Modal Delete Product Category-->
    <div wire:ignore.self class="modal fade" id="deleteProductCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to remove this product category?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($productCategoryToDelete)
                    This product category <strong>"{{ $productCategoryToDelete->category_name }}"</strong> will be
                    removed to the table and will deleted permanently.
                    @else
                    <div class="text-center fw-4 fs-4">
                        <span class="spinner-border"></span> Getting the product category's information...
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" wire:loading.attr='disabled' wire:target='deleteProductCategory' wire:click="deleteProductCategory">
                        <div wire:loading wire:target='deleteProductCategory'>
                            <span class="spinner-border spinner-border-sm"></span> Deleting...
                        </div>
                        <div wire:loading.remove wire:target='deleteProductCategory'>
                            <i class="fa-solid fa-trash"></i> Yes, Remove
                        </div>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id='closeModalDelete'>Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
