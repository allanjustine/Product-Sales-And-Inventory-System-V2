<div>
    <!-- Modal Product Info-->
    <div wire:ignore.self class="modal fade" id="viewProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="modal-title" id="exampleModalLongTitle">Product Info</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($productView)
                    <div class="row justify-content-center">
                        <div class="card w-100 shadow-none">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ Storage::exists($productView->product_image) ? Storage::url($productView->product_image) : $productView->product_image }}"
                                            alt="{{ $productView->product_name }}" class="img-fluid"><br>
                                    </div>
                                    <div class="col-md-6">
                                        <h4
                                            class="text-center text-capitalize border-bottom border-secondary py-2 border-1">
                                            {{ $productView->product_name }}</h4>
                                        <p class="d-flex justify-content-between"><strong>Product Code:</strong>
                                            <strong>{{ $productView->product_code }}</strong>
                                        </p>
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
                                                @for ($i = 1; $i <= 5; $i++) @if ($i <=$productView->product_rating)
                                                    <i class="fa-solid fa-star"></i>
                                                    @else
                                                    <i class="fa-light fa-star"></i>
                                                    @endif
                                                    @endfor
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
                    @else
                    <div class="row justify-content-center">
                        <div class="card w-100 shadow-none">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Image Placeholder -->
                                    <div class="col-md-6 text-center">
                                        <div class="placeholder-glow">
                                            <div class="placeholder w-100" style="height: 250px;"></div>
                                        </div>
                                    </div>
                    
                                    <!-- Text Placeholder -->
                                    <div class="col-md-6">
                                        <div class="placeholder-glow mb-3">
                                            <span class="placeholder col-6"></span>
                                        </div>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-10"></span>
                                        </div>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-8"></span>
                                        </div>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-9"></span>
                                        </div>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-7"></span>
                                        </div>
                                    </div>
                                </div>
                    
                                <!-- Description Placeholder -->
                                <div class="col-md-12 mt-4">
                                    <div class="placeholder-glow mb-3">
                                        <span class="placeholder col-6"></span>
                                    </div>
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-12"></span>
                                    </div>
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-11"></span>
                                    </div>
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-10"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>