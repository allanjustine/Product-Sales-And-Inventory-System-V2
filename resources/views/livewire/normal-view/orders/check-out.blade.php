<div>
    <!-- Modal Add To Cart -->
    <div wire:ignore.self class="modal fade" id="checkOut" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Are you sure you want to place this item to order?</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        @if ($cartItemToCheckOut)
                            <div wire:loading>
                                <div class="loading-overlay">
                                    <div class="loading-message card p-3 bg-dark">
                                        <span class="spinner-border"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center">
                                @if (Storage::exists($cartItemToCheckOut->product->product_image))
                                    <img src="{{ Storage::url($cartItemToCheckOut->product->product_image) }}"
                                        alt="{{ $cartItemToCheckOut->product->product_name }}" class="img-fluid"
                                        style="width: 150px; height: 150px;">
                                @else
                                    <img src="{{ $cartItemToCheckOut->product->product_image }}"
                                        alt="{{ $cartItemToCheckOut->product->product_name }}" class="img-fluid"
                                        style="width: 150px; height: 150px;">
                                @endif
                            </p>
                            <p class="text-center text-capitalize">
                                <strong>
                                    {{ $cartItemToCheckOut->product->product_name }}
                                </strong>
                            </p>
                            <p class="text-center">
                                <strong>
                                    x{{ number_format($cartItemToCheckOut->quantity) }} PC(s)
                                </strong>
                            </p>
                            <p class="text-center">
                                <strong>
                                    &#8369;{{ number_format($cartItemToCheckOut->product->product_price, 2, '.', ',') }}
                                </strong>
                            </p>
                            <p class="text-center">
                                <strong>
                                    Total:
                                    &#8369;{{ number_format($cartItemToCheckOut->product->product_price * $cartItemToCheckOut->quantity, 2, '.', ',') }}
                                </strong>
                            </p>
                            @if ($cartItemToCheckOut->quantity > $cartItemToCheckOut->product->product_stock)
                                <span class="text-center text-danger">The product stock is
                                    insufficient please reduce your cart quantity. <strong>Stock:
                                        x{{ number_format($cartItemToCheckOut->product->product_stock) }}
                                        PC(s)</strong>
                                </span><br>
                            @endif
                        @else
                        <div class="loading-overlay mt-3">
                            <div class="loading-message card p-3 bg-dark">
                                <span class="spinner-border"></span>
                            </div>
                        </div>
                        @endif
                    </div>
                    <hr>
                    <p class="text-center">
                    <form>
                        @csrf
                        <label for="order_payment_method">Payment Method</label>
                        <select id="select-cat" class="form-select" style="" name="order_payment_method"
                            id="order_payment_method" wire:model.live="order_payment_method" required>
                            <option selected hidden="true">Select a Payment Method</option>
                            <option disabled>Select a Payment Method</option>
                            <option value="Cash On Delivery">Cash On Delivery</option>
                        </select>
                        @error('order_payment_method')
                            <span class="text-center text-danger">*Please select payment method first.</span>
                        @enderror
                        <br>
                        <label class="mt-3" for="user_location">Your delivery address</label>
                        <textarea name="" class="form-control {{ $errors->has('user_location') ? 'border-danger' : '' }}" id=""
                            cols="20" rows="5" placeholder="Enter specific location for the delivery address"
                            wire:model.live.debounce.200ms="user_location"></textarea>
                        @if ($errors->has('user_location'))
                            <span class="text-danger">*Please your enter delivery address first.</span>
                        @endif
                    </form>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary form-control" wire:click="placeOrder"><i
                            class="fa-solid fa-cart-circle-check"></i> Place Order
                    </button>
                    <button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:navigated', function() {
        $('#checkOut').on('hidden.bs.modal', function() {
            @this.dispatch('resetInputs');
        });
    });
</script>
