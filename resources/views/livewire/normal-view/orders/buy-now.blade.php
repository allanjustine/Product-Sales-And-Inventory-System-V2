<div>
    <!-- Modal Buy Now Info-->
    <div wire:ignore.self class="modal fade" id="toBuyNow" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Buy Now <i class="fa-solid fa-cart-shopping"></i>
                    </h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card w-100 shadow-none">
                            <div class="card-body">
                                @if (!$orderToBuy)
                                    <div class="loading-overlay mt-3">
                                        <div class="loading-message card p-3 bg-dark">
                                            <span class="spinner-border"></span>
                                        </div>
                                    </div>
                                @endif

                                @if ($orderToBuy)
                                    <h5>Are you sure you want to buy this product and place it to order?</h5>

                                    <div wire:loading>
                                        <div class="loading-overlay">
                                            <div class="loading-message card p-3 bg-dark">
                                                <span class="spinner-border"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        @if (Storage::exists($orderToBuy->product_image))
                                            <img src="{{ Storage::url($orderToBuy->product_image) }}"
                                                alt="{{ $orderToBuy->product_name }}" class="img-fluid"
                                                style="width: 150px; height: 150px;">
                                        @else
                                            <img src="{{ $orderToBuy->product_image }}"
                                                alt="{{ $orderToBuy->product_name }}" class="img-fluid"
                                                style="width: 150px; height: 150px;">
                                        @endif
                                        <h6 class="mt-5"><strong class="text-capitalize">{{ $orderToBuy->product_name }}</strong></h6>
                                        <p><strong>&#8369;{{ number_format($orderToBuy->product_price, 2, '.', ',') }}</strong>
                                            @if($orderToBuy->product_old_price !== null && $orderToBuy->product_old_price !== $orderToBuy->product_price)
                                            <span class="text-muted text-decoration-line-through">( &#8369;{{
                                                number_format($orderToBuy->product_old_price, 2, '.', ',') }})</span><span
                                                class="flag-discount"> {{ $orderToBuy->discount }}</span>
                                            @endif
                                        </p>
                                        <p><strong>Stock: x{{ number_format($orderToBuy->product_stock) }}
                                                PC(s)</strong>
                                        </p>
                                        <form>
                                            @csrf
                                            <p>
                                                <span><strong>Quantity</strong>
                                                    <input
                                                        class="form-control {{ $errors->has('order_quantity') ? 'border-danger' : '' }} {{ $order_quantity > $orderToBuy->product_stock ? 'border-danger' : '' }}"
                                                        type="number" placeholder="Enter Quantity"
                                                        wire:model.live.debounce.200ms="order_quantity" min="1">
                                                    <br>
                                                    @error('order_quantity')
                                                        <span
                                                            class="text-center text-danger">*{{ $message }}</span><br>
                                                    @enderror
                                                    @if ($order_quantity > $orderToBuy->product_stock)
                                                        <span class="text-center text-danger">The product stock is
                                                            insufficient please reduce your cart quantity</span><br>
                                                    @endif
                                                </span>
                                            </p>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if ($orderToBuy)
                    <div class="modal-footer">
                        <button type="button" wire:loading.attr="disabled" class="btn btn-primary form-control" wire:click="orderPlaceOrderItem" wire:target='orderPlaceOrderItem'>
                            <span wire:target='orderPlaceOrderItem' wire:loading.remove><i class="fa-solid fa-check"></i> Checkout</span>
                            <span wire:target='orderPlaceOrderItem' wire:loading><span class="spinner-border spinner-border-sm"></span> Please wait...</span>

                        <button type="button" class="btn btn-secondary form-control"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:navigated', function() {
        $('#toBuyNow').on('hidden.bs.modal', function() {
            Livewire.dispatch('resetInputs');
        });
    });
</script>
