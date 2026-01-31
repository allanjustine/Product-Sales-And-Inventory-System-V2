<div>
    <!-- Modal Add To Cart -->
    <div wire:ignore.self class="modal fade" id="checkOut" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Are you sure you want to check out?</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">You selected ({{ count($this->cart_ids) }}) items in your cart.</h5>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary form-control" wire:click="placeOrder" wire:target='placeOrder'
                        type="button" wire:loading.attr='disabled'>
                        <span wire:target='placeOrder' wire:loading.remove><i class="fa-solid fa-check"></i>
                            Proceed to Checkout</span>
                        <span wire:target='placeOrder' wire:loading><span
                                class="spinner-border spinner-border-sm"></span> Please wait...</span>
                    </button>
                    <button type="button" class="btn btn-secondary form-control"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:navigated', function() {
        $('#checkOut').on('hidden.bs.modal', function() {
            Livewire.dispatch('resetInputs');
        });
    });
</script>
