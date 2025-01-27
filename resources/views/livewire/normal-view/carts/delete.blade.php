<div>
    <!-- Modal Delete To Cart -->
    <div wire:ignore.self class="modal fade" id="remove" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to remove this to cart?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($cartItemToRemove)
                    <div class="modal-body">
                        This product <strong class="text-capitalize">,"{{ $cartItemToRemove->product->product_name}} - x{{ $cartItemToRemove->quantity}}PC(s)"</strong> will be
                        removed to the cart and will deleted permanently.
                    </div>
                @endif
                <div class="modal-footer">
                    <button class="btn btn-danger form-control" wire:click="removeItemToCart()"><i class="fa-solid fa-cart-xmark"></i> Yes, Remove
                    </button>
                    <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
