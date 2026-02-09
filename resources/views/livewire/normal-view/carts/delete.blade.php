<div>
    <div wire:ignore.self class="modal fade" id="remove" tabindex="-1" role="dialog"
        aria-labelledby="removeFromCartModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light border-bottom-0 rounded-top-3 p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-2">
                            <i class="fas fa-trash-alt text-danger"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-1" id="removeFromCartModal">
                                Remove from Cart
                            </h5>
                            <p class="text-muted mb-0">Confirm item removal</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4" style="max-height: calc(100vh - 300px); overflow-y: auto;">
                    @if ($cartItemToRemove)
                        <div class="text-center mb-4">
                            <div class="d-inline-flex p-3 rounded-circle bg-warning bg-opacity-10">
                                <i class="fas fa-triangle-exclamation text-white" style="font-size: 3rem;"></i>
                            </div>
                        </div>

                        <div class="text-center">
                            <h6 class="fw-bold mb-3">Are you sure you want to remove this item?</h6>
                            <div class="alert alert-light border mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    @if (Storage::exists($cartItemToRemove->product->productImages()?->first()?->path))
                                        <img style="width: 60px; height: 60px; border-radius: 8px; object-fit: cover;"
                                            src="{{ Storage::url($cartItemToRemove->product->productImages()?->first()?->path) }}"
                                            alt="{{ $cartItemToRemove->product->product_name }}">
                                    @else
                                        <img style="width: 60px; height: 60px; border-radius: 8px; object-fit: cover;"
                                            src="{{ $cartItemToRemove->product->productImages()?->first()?->path }}"
                                            alt="{{ $cartItemToRemove->product->product_name }}">
                                    @endif
                                    <div class="text-start">
                                        <strong class="d-block text-capitalize">
                                            {{ $cartItemToRemove->product->product_name }}
                                        </strong>
                                        <small class="text-muted">
                                            x{{ $cartItemToRemove->quantity }}
                                            piece{{ $cartItemToRemove->quantity > 1 ? 's' : '' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-0">
                                This item will be permanently removed from your cart.
                            </p>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="text-muted">Loading item details...</p>
                        </div>
                    @endif
                </div>

                <div class="modal-footer border-top-0 p-4 pt-0">
                    <div class="d-flex gap-2 w-100">
                        <button type="button" class="btn btn-outline-secondary flex-fill py-2" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>

                        <button class="btn btn-danger flex-fill py-2" wire:click="removeItemToCart" type="button"
                            wire:target='removeItemToCart' wire:loading.attr='disabled' data-bs-dismiss="modal">
                            <span wire:target='removeItemToCart' wire:loading.remove>
                                <i class="fas fa-trash-alt me-2"></i>Remove Item
                            </span>
                            <span wire:target='removeItemToCart' wire:loading>
                                <span class="spinner-border spinner-border-sm me-2"></span>
                                Removing...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
