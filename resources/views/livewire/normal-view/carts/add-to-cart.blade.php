<div>
    <!-- Modal Add To Cart Info-->
    <div wire:ignore.self class="modal fade" id="addToCart" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Add to Cart <i class="fa-solid fa-cart-plus"></i>
                    </h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card w-100 shadow-none">
                            <div class="card-body">
                                @if (!$productToBeCart)
                                    <div class="loading-overlay mt-3">
                                        <div class="loading-message card p-3 bg-dark">
                                            <span class="spinner-border"></span>
                                        </div>
                                    </div>
                                @endif

                                @if ($productToBeCart)
                                    <h5>Are you sure you want to add this product to your cart?</h5>
                                    <div class="text-center">
                                        @if (Storage::exists($productToBeCart->product_image))
                                            <img src="{{ Storage::url($productToBeCart->product_image) }}"
                                                alt="{{ $productToBeCart->product_name }}" class="img-fluid"
                                                style="width: 150px; height: 150px;">
                                        @else
                                            <img src="{{ $productToBeCart->product_image }}"
                                                alt="{{ $productToBeCart->product_name }}" class="img-fluid"
                                                style="width: 150px; height: 150px;">
                                        @endif
                                        <h6 class="mt-5 text-capitalize"><strong>{{ $productToBeCart->product_name }}</strong></h6>
                                        <p><strong>&#8369;{{ number_format($productToBeCart->product_price, 2, '.', ',') }}</strong>
                                        </p>
                                        <p><strong>Stock: {{ number_format($productToBeCart->product_price) }}
                                                PC(s)</strong>
                                        </p>
                                        <form>
                                            @csrf
                                            <p>
                                                <strong>Quantity</strong>
                                                <input class="form-control" type="number" placeholder="Enter Quantity"
                                                    wire:model.live.debounce.200ms="quantity" min="1">

                                            </p>
                                        </form>
                                        @error('quantity')
                                            <span class="text-center text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if ($productToBeCart)
                    <div class="modal-footer">
                        <button type="button" wire:loading.attr="disabled" class="btn btn-primary form-control"
                            wire:click="addToCartNow()">
                            <span>
                                <i class="fa-solid fa-cart-plus"></i> Add to Cart
                            </span>
                        </button>
                        <button type="button" class="btn btn-secondary form-control"
                            data-bs-dismiss="modal">Cancel</button>

                        <div wire:loading>
                            <div class="loading-overlay">
                                <div class="loading-message card p-3 bg-dark">
                                    <span class="spinner-border"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
