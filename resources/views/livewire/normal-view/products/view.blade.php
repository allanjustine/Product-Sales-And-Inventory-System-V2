<div>
    <!-- Modal Product Info-->
    <div wire:ignore.self class="modal fade" id="viewProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="modal-title" id="exampleModalLongTitle">Product Info</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($productView)
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card w-100 shadow-none">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (Storage::exists($productView->product_image))
                                        <img src="{{ Storage::url($productView->product_image) }}"
                                            alt="{{ $productView->product_name }}" class="img-fluid">
                                        @else
                                        <img src="{{ url($productView->product_image) }}"
                                            alt="{{ $productView->product_name }}" class="img-fluid">
                                        @endif
                                        <br>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 id="product_name"
                                            class="text-center border-bottom border-secondary py-2 border-1">
                                            {{ $productView->product_name }}</h4>
                                        <p class="d-flex justify-content-between"><strong>Category:</strong>
                                            {{ $productView->product_category->category_name }}</p>
                                        <p class="d-flex justify-content-between"><strong>Status:</strong>
                                            @if ($productView->product_status === 'Available')
                                            <td><span class="badge badge-success">AVAILABLE</span></td>
                                            @else
                                            <td><span class="badge badge-danger">NOT AVAILABLE</span></td>
                                            @endif
                                        </p>
                                        <p class="d-flex justify-content-between"><strong>Stock(s):</strong>
                                            @if ($productView->product_stock)
                                            <span>{{ number_format($productView->product_stock) }}</span>
                                            @else
                                            <span class="badge badge-warning">OUT OF STOCK</span>
                                            @endif
                                        </p>
                                        <p class="d-flex justify-content-between"><strong>Price:</strong>
                                            &#8369;{{ number_format($productView->product_price, 2, '.', ',') }}</p>
                                        <p class="d-flex justify-content-between"><strong>Sold(s):</strong>
                                            {{ number_format($productView->product_sold) }}</p>
                                        <p class="d-flex justify-content-between"><strong>Rating(s):</strong>
                                            <span>
                                                @if ($productView->product_rating === 0)
                                                No ratings yet
                                                @else
                                                @for ($i = 1; $i <= 5; $i++) @if ($i <=$productView->product_rating)
                                                    <i class="fa-solid fa-star"></i>
                                                    @else
                                                    <i class="fa-light fa-star"></i>
                                                    @endif
                                                    @endfor
                                                    @endif
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="text-center mt-3 border-top border-1 py-3 border-secondary">
                                        <strong>Product
                                            Description <br></strong>
                                        {{ $productView->product_description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Close</button>
                </div>
                @else
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card w-100 shadow-none">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Placeholder for the product image -->
                                        <div class="placeholder-glow">
                                            <div class="placeholder img-fluid" style="height: 200px; width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Placeholder for Product Name -->
                                        <h4 id="product_name"
                                            class="text-center border-bottom border-secondary py-2 border-1 placeholder-glow">
                                            <span class="placeholder col-6"></span>
                                        </h4>
                                        <!-- Placeholder for Category -->
                                        <p class="d-flex justify-content-between placeholder-glow">
                                            <strong>Category:</strong>
                                            <span class="placeholder col-7"></span>
                                        </p>
                                        <!-- Placeholder for Status -->
                                        <p class="d-flex justify-content-between placeholder-glow">
                                            <strong>Status:</strong>
                                            <span class="placeholder col-5"></span>
                                        </p>
                                        <!-- Placeholder for Stock -->
                                        <p class="d-flex justify-content-between placeholder-glow">
                                            <strong>Stock(s):</strong>
                                            <span class="placeholder col-4"></span>
                                        </p>
                                        <!-- Placeholder for Price -->
                                        <p class="d-flex justify-content-between placeholder-glow">
                                            <strong>Price:</strong>
                                            <span class="placeholder col-5"></span>
                                        </p>
                                        <!-- Placeholder for Sold -->
                                        <p class="d-flex justify-content-between placeholder-glow">
                                            <strong>Sold(s):</strong>
                                            <span class="placeholder col-4"></span>
                                        </p>
                                        <!-- Placeholder for Rating -->
                                        <p class="d-flex justify-content-between placeholder-glow">
                                            <strong>Rating(s):</strong>
                                            <span>
                                                <i class="fa-light fa-star placeholder col-1"></i>
                                                <i class="fa-light fa-star placeholder col-1"></i>
                                                <i class="fa-light fa-star placeholder col-1"></i>
                                                <i class="fa-light fa-star placeholder col-1"></i>
                                                <i class="fa-light fa-star placeholder col-1"></i>
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Placeholder for Product Description -->
                                <div class="col-md-12">
                                    <p
                                        class="text-center mt-3 border-top border-1 py-3 border-secondary placeholder-glow">
                                        <strong>Product Description <br></strong>
                                        <span class="placeholder col-12"></span>
                                        <span class="placeholder col-8"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer placeholder-glow">
                        <button type="button"
                            class="btn btn-secondary form-control disabled placeholder w-100"></button>
                    </div>
                </div>

                @endif

            </div>
        </div>
    </div>


    <style>
        #product_name {
            text-transform: capitalize;
        }
    </style>

    <script>
        document?.addEventListener('livewire:navigated', function() {
            const modal = document?.getElementById("viewProduct");
            if(modal) {
                modal?.addEventListener('hidden.bs.modal', function () {
                    @this.dispatch('closedModal');
                });
            }
        })
    </script>
</div>
