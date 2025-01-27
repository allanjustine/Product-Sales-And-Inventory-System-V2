<div>
    <!-- Modal Cancel Order -->
    <div wire:ignore.self class="modal fade" id="cancel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to cancel this to order?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($cancel)
                    <div class="modal-body">
                        Cancelling this product <strong class="text-capitalize">"{{ $cancel->product->product_name }} -
                            x{{ $cancel->order_quantity }}PC(s)"</strong> will be
                        removed from your pending orders.
                    </div>
                @endif
                <div class="modal-footer">
                    <button class="btn btn-danger form-control" wire:click="cancelOrder()"><i class="fa-solid fa-circle-xmark"></i> Yes, Cancel
                    </button>
                    <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
