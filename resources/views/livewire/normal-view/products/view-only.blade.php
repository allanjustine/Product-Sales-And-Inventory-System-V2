<div style="overflow-x: hidden;">
    @include('livewire.normal-view.products.view')
    <div class="col-md-5 col-sm-6 offset-md-4 offset-sm-3 mt-4">
        <input type="search" class="form-control" placeholder="Search" wire:model.live.debounce.200ms="search"
            style="border-radius: 30px; height: 50px;">
    </div>
    <div class="row d-flex justify-content-center mt-5 pb-3">
        {{-- <div class="col-md-1 col-sm-1 col-3 text-center">
            <label>Show</label>
            <select wire:model.live="perPage" class="perPageSelect form-select" id="select-cat">
                <option>15</option>
                <option>20</option>
                <option>25</option>
                <option>35</option>
                <option>45</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div> --}}
        <div class="col-md-2 col-sm-3 col-6 text-center">
            <label for="category">Categories</label>
            <select name="category" id="select-cat" class="form-select" wire:model.live="category_name">
                <option value="All">All</option>
                @foreach ($product_categories as $category)
                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-3 col-6 text-center">
            <label for="sort">Ratings</label>
            <select wire:model.live="product_rating" class="form-select" id="select-cat">
                <option value="All">All</option>
                <option value="1">1
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=1) &#9733; @else &#9734; @endif @endfor </option>
                <option value="2">2
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=2) &#9733; @else &#9734; @endif @endfor </option>
                <option value="3">3
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=3) &#9733; @else &#9734; @endif @endfor </option>
                <option value="4">4
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=4) &#9733; @else &#9734; @endif @endfor </option>
                <option value="5">5
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=5) &#9733; @else &#9734; @endif @endfor </option>
            </select>
        </div>
        <div class="col-md-2 col-sm-4 col-6 text-center">
            <label for="sort">Sort By</label>
            <select wire:model.live="sort" class="form-select" id="select-cat">
                <option value="low_to_high">Price: Low to High</option>
                <option value="high_to_low">Price: High to Low</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-4 col-6 text-center">
            <label for="Clear Filters">Clear Filters</label>
            <button style="height: 40px;" wire:click="clearFilters" class="btn btn-secondary form-control"><i
                    class="fa-solid fa-broom-wide"></i> Clear Filters</button>
        </div>
    </div>
    <div class="container mt-5">
        <h3><i class="fa-light fa-box-open"></i> Products</h3>

        @if ($products->count() === 0)
        <h5>-</h5>
        @else
        <h5 class="text-danger">{{ $allDisplayProducts }} products found.</h5>
        @endif
        <hr>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-3 mt-2 col-sm-4 col-6">
                <div class="card shadow product-card" style="min-width: 50px;">
                    <div style="position: relative;">
                        <a href="#" class="text-black" data-bs-toggle="modal" data-bs-target="#viewProduct"
                            wire:click="view({{ $product->id }})">
                            <div class="image-container">
                                @if (Storage::exists($product->product_image))
                                <img class="card-img-top" src="{{ Storage::url($product->product_image) }}"
                                    alt="{{ $product->product_name }}">
                                @else
                                <img class="card-img-top" src="{{ url($product->product_image) }}"
                                    alt="{{ $product->product_name }}">
                                @endif
                            </div>
                        </a>

                        <div class="pt-2 pr-2" style="position: absolute; top:0; right: 0;">
                            @if ($product->product_stock >= 20)
                            <span class="badge badge-success badge-pill">{{ number_format($product->product_stock)
                                }}</span>
                            @elseif ($product->product_stock)
                            <span class="badge badge-warning badge-pill">{{ number_format($product->product_stock)
                                }}</span>
                            @else
                            <span class="badge badge-danger badge-pill">OUT OF STOCK</span>
                            @endif
                        </div>

                    </div>
                    <a href="#" class="text-black" data-bs-toggle="modal" data-bs-target="#viewProduct"
                        wire:click="view({{ $product->id }})">
                        <div class="card-footer text-center mb-3 mt-auto">
                            <h6 class="d-inline-block text-secondary medium font-weight-medium mb-1">
                                {{ $product->product_category->category_name }}</h6>
                            <h5 class="font-size-1 font-weight-normal text-capitalize">
                                {{ $product->product_name }}
                            </h5>
                            <div class="d-block font-size-1 mb-2">
                                <span class="font-weight-medium">₱{{
                                    number_format($product->product_price, 2, '.', ',') }}</span>
                            </div>
                            <div class="d-block font-size-1 mb-2">
                                <span class="font-weight-medium">
                                    @if ($product->product_status === 'Available')
                                    <td><span class="badge badge-success">AVAILABLE</span></td>
                                    @else
                                    <td><span class="badge badge-danger">NOT AVAILABLE</span></td>
                                    @endif
                                </span>
                            </div>
                            <a wire:navigate href="/login" class="btn btn-primary mt-1 form-control"><i
                                    class="fa-solid fa-cart-shopping"></i> Buy Now</a>

                            <div class="d-flex font-size-1 mb-2">
                                <strong class="pl-2" style="position: absolute; bottom:0; left: 0;">Sold:

                                    {{ $product->product_sold }}
                                </strong>
                                <span class="font-weight-medium pr-2" style="position: absolute; bottom:0; right: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <strong>
                                        {{ $product->product_rating }}/5
                                    </strong>
                                    <span class="text-danger">({{ $product->product_votes }})</span>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            @if (!empty($search) && $products->count() === 0)
            <span class="text-center">
                <i class="fa-regular fa-face-thinking mb-3 mt-5" style="font-size: 100px;"></i>
                <h4>"{{ $search }}" product not found.</h4>
            </span>
            @elseif($products->count() === 0)
            <span class="text-center">
                <i class="fa-regular fa-xmark-to-slot mb-3 mt-5" style="font-size: 100px;"></i>
                <h4>No products found comeback soon.</h4>
            </span>
            @endif
        </div>
    </div>
    {{-- <div class="d-flex align-items-center overflow-auto">
        <span class="mx-auto pt-3" id="paginate">
            {{ $products->links('pagination::bootstrap-4') }}</span>
    </div> --}}
    <div class="d-flex mb-2 align-items-center overflow-auto">
        @if($products->count() < $allDisplayProducts)
            <div class="mx-auto" id="sentinel" wire:loading.remove wire:target='loadMore'></div>
        @endif
        <button wire:loading type="button" wire:target='loadMore' class="btn btn-link mx-auto" wire:click="loadMore" id="loadMoreData">
            <span class="spinner-border"></span>
        </button>
        {{-- <a wire:click="loadMore" class="mx-auto btn btn-link" {{ $products->count() >= $allDisplayProducts ||
            $search
            ?
            'hidden' : '' }} id="paginate">
            <span wire:loading.remove>Load more...</span>
            <span wire:loading class="spinner-border"></span>
        </a> --}}
    </div>

    <script>
        let search = '';
        let sentinelObserver = null;
        document.addEventListener('searchData', function(e) {
            search = e.detail.search;
        });

        document.addEventListener('livewire:navigated', function() {
            const sentinel = document.getElementById('sentinel');
            const button = document.getElementById('loadMoreData');
            if(!sentinel) return;

            if(sentinelObserver) {
                sentinelObserver.disconnect();
            }

            sentinelObserver = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && !search) {
                    button?.click();
                }
            });

            sentinelObserver.observe(sentinel);

        });
    </script>

</div>
