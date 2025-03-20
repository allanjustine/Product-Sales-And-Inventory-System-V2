<div>
    <!-- Modal Order Received  -->
    <div wire:ignore.self class="modal fade" id="order-received" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="mt-5 text-center">How would you rate this product?</h3>
                    <form class="d-flex justify-content-center">
                        @csrf
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="rating" value="5"
                                wire:model.live.debounce.200ms="product_rating">
                            <label for="star5" title="5 stars">&starf;</label>
                            <input type="radio" id="star4" name="rating" value="4"
                                wire:model.live.debounce.200ms="product_rating">
                            <label for="star4" title="4 stars">&starf;</label>
                            <input type="radio" id="star3" name="rating" value="3"
                                wire:model.live.debounce.200ms="product_rating">
                            <label for="star3" title="3 stars">&starf;</label>
                            <input type="radio" id="star2" name="rating" value="2"
                                wire:model.live.debounce.200ms="product_rating">
                            <label for="star2" title="2 stars">&starf;</label>
                            <input type="radio" id="star1" name="rating" value="1"
                                wire:model.live.debounce.200ms="product_rating">
                            <label for="star1" title="1 star">&starf;</label>
                        </fieldset>
                    </form>
                    @error('product_rating')
                        <h6 class="text-center text-danger">*Please select rating first</h6>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary form-control" type="button" wire:click="submitRating"><i class="fa-sharp fa-solid fa-thumbs-up"></i> Submit
                    </button>
                    <button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:navigated', function() {
        $('#order-received').on('hidden.bs.modal', function() {
            @this.dispatch('resetInputs');
        });
    });
</script>
