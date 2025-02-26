<div>
    <!-- Modal Delete Product -->
    <div wire:ignore.self class="modal fade" id="deleteProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to remove this product?</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($productToDelete)
                    This product <strong class="text-capitalize">"{{ $productToDelete->product_name }}"</strong> will be
                    removed to the table and will deleted permanently.
                    @else
                    <div class="text-center fw-4 fs-4">
                        <span class="spinner-border"></span> Getting the product's information...
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" wire:click="deleteProduct" wire:target="deleteProduct"
                        wire:loading.attr='disabled'>
                        <div wire:target='deleteProduct' wire:loading>
                            <span class="spinner-border spinner-border-sm"></span> Deleting...
                        </div>
                        <div wire:target='deleteProduct' wire:loading.remove>
                            <i class="fa-solid fa-trash"></i> Yes, Remove
                        </div>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>