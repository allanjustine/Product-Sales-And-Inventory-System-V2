<div style="overflow-x: hidden;">
    @include('livewire.normal-view.products.view')
    @include('livewire.normal-view.carts.add-to-cart')
    @include('livewire.normal-view.carts.delete')
    @include('livewire.normal-view.orders.check-out')
    @include('livewire.normal-view.orders.buy-now')
    <div class="col-md-5 col-sm-6 offset-md-4 offset-sm-3 mt-4">
        <div class="dropdown" id="mainDropdown">
            <div x-data="{ open: false }">
                <input type="search" class="form-control" id="searchInput" placeholder="Search" x-on:input="open = true"
                    wire:model.live.debounce.200ms="search" style="border-radius: 30px; height: 50px;">
                <div id="searchDropdown" class="dropdown-menu w-100" @if(count($searchLogs) !==0)
                    :class="{ 'show': open }" @click.outside="open = false" x-cloak x-transition @else
                    style="display: none !important" @endif aria-bs-labelledby="searchInput">
                    @foreach ($searchLogs as $log)
                    <div class="d-flex align-items-center" key={{ $log->id }}>
                        <button type="button" @click="open = false" id="searchLogButton"
                            class="dropdown-item p-3 flex-grow-1 text-truncate" type="button"
                            wire:click="searchLog({{ $log->id }})">
                            {{ $log->log_entry }}
                        </button>
                        <button type="button" wire:loading.attr='disabled' wire:target='searchDelete' class="mr-2"
                            id="removeSearchLogButton" style="background-color: transparent; border: none;"
                            wire:click="searchDelete({{ $log->id }})">
                            <i class="fa-regular fa-times"></i>
                        </button>
                    </div>
                    @endforeach
                    <div>
                        <a href="#" class="float-end px-3" id="clearAllSearchLogsButton"
                            wire:click="clearAllLogs({{ auth()?->user()?->id }})">Clear
                            all</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-5 pb-3">
        {{-- <div class="col-md-1 col-sm-1 col-3 text-center">
            <label>Show</label>
            <select wire:model.live.debounce.200ms="perPage" class="perPageSelect form-select" id="select-cat">
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
            <select name="category" id="select-cat" class="form-select" wire:model.live.debounce.200ms="category_name">
                <option value="All">All</option>
                @foreach ($product_categories as $category)
                <option value="{{ $category->category_name }}">{{ $category->category_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-3 col-6 text-center">
            <label for="sort">Ratings</label>
            <select wire:model.live.debounce.200ms="product_rating" class="form-select" id="select-cat">
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
            <select wire:model.live.debounce.200ms="sort" class="form-select" id="select-cat">
                <option value="low_to_high">Price: Low to High</option>
                <option value="high_to_low">Price: High to Low</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-4 col-6 text-center">
            <label for="Clear Filters">Clear Filters</label>
            <button style="height: 40px;" wire:click="clearFilters" class="btn btn-secondary form-control"><i
                    class="fa-solid fa-broom-wide"></i> Clear
                Filters</button>
        </div>
    </div>
    @role('user')
    <div class="position-fixed" style="right: 0; margin-top: -180px; z-index: 1;" id="cartIcon">
        <div class="position-relative d-flex justify-content-end mr-5" id="main-cart" x-data="{ open: false }">
            <button type="button" class="btn btn-link p-2 cartdropdown position-relative" id="cart-dropdown"
                @click="open = !open">
                <i class="fa-regular fa-cart-shopping pt-3"></i>
                @if($carts->count() > 0)
                <span class="badge badge-pill badge-danger" id="badge-cart">
                    <span style="font-size: 12px;">{{ $carts->count() }}</span>
                </span>
                @endif
            </button>

            <ul id="myDiv" class="bg-white border shadow-sm position-absolute" style="list-style: none;" x-cloak
                x-show="open" @click.outside="open = false">
                <h4 class="sticky-top bg-white py-3"><strong><i class="fa-regular fa-cart-shopping"></i> My Cart
                        @if($carts->count() > 0) ({{ $carts->count() }}) @endif</strong></h4>
                <hr>
                @foreach ($carts as $item)
                <li class="cart-item px-3 py-2 mr-5">
                    <div class="cart-item-image">
                        <button class="btn btn-link text-primary" type="button"
                            wire:click="decreaseQuantity({{ $item->id }})">
                            <i class="fas fa-minus text-black"></i>
                        </button>
                        x{{ number_format($item->quantity) }}
                        <button type="button" class="btn btn-link text-primary"
                            wire:click="increaseQuantity({{ $item->id }})">
                            <i class="fas fa-plus text-black"></i>
                        </button>
                        @if (Storage::exists($item->product->product_image))
                        <img style="width: 70px; height: 70px; border-radius: 10%;"
                            src="{{ Storage::url($item->product->product_image) }}" alt="">
                        @else
                        <img style="width: 70px; height: 70px; border-radius: 10%;"
                            src="{{ url($item->product->product_image) }}" alt="">
                        @endif
                        &nbsp;&nbsp;<span><strong class="text-capitalize">{{ $item->product->product_name
                                }}</strong></span>
                    </div>
                    <div class="cart-item-price mt-2">
                        &#8369;{{ number_format($item->product->product_price, 2, '.', ',') }}
                        <button class="btn btn-link text-danger" data-bs-toggle="modal" data-bs-target="#remove"
                            wire:click="remove({{ $item->id }})">
                            <i class="fas fa-trash-alt"></i>&nbsp;Delete
                        </button>
                        <button class="btn btn-link text-primary" data-bs-toggle="modal" data-bs-target="#checkOut"
                            wire:click="checkOut({{ $item->id }})">
                            <i class="fas fa-check"></i>&nbsp;Checkout
                        </button><br>
                        <span><strong>Sub total: &#8369;{{ number_format($item->product->product_price *
                                $item->quantity, 2,
                                '.', ',') }}</strong></span>
                    </div>
                </li>
                <li class="dropdown-divider"></li>
                @endforeach
                <li class="mr-5">
                    @if ($carts->count() === 0)
                    <p class="text-center">
                        <i class="fa-regular fa-cart-xmark mt-5" style="font-size: 50px;"></i>
                    </p>
                    <p class="text-center mb-5 fs-5">Your cart is empty.</p>
                    @else
                    <span class="px-3 py-2"><strong>Grand total: &#8369;{{ number_format($total, 2, '.', ',')
                            }}</strong></span>
                    @endif
                </li>
            </ul>
        </div>
    </div>
    @endrole
    <div class="container">
        <h3 class="mt-5"><i class="fa-light fa-box-open"></i> Products</h3>
        @if ($products->count() === 0)
        <h5 class="text-danger">No products found.</h5>
        @elseif (!empty($search))
        <h5 class="text-danger">{{ $products->count() }} products founded.</h5>
        @else
        <h5 class="text-danger">{{ $allDisplayProducts }} products.</h5>
        @endif
        <hr>
        <div class="row">

            @foreach ($products as $product)
            <div class="p-1 col-md-3 mt-2 col-sm-4 col-6">
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
                        <button type="button"
                            title="@if ($product->favorites->contains('user_id', auth()?->user()?->id)) {{ $product->favorites->count() }} people added this to favorites @else Add to favorites @endif"
                            class="btn btn-link position-absolute top-0 start-0"
                            wire:click="addToFavorite({{ $product->id }})">
                            <h2 class="text-danger"><i
                                    class="{{ $product->favorites->contains('user_id', auth()?->user()?->id) ? 'fas' : 'far' }} fa-heart"></i>
                            </h2>
                        </button>

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
                            @role('user')
                            <a class="btn btn-warning mt-1 form-control" data-bs-toggle="modal"
                                data-bs-target="#addToCart" wire:click="addToCart({{ $product->id }})"><i
                                    class="fa-solid fa-cart-plus"></i>
                                Add to Cart</a>

                            <a class="btn btn-primary mt-1 form-control btn-block" data-bs-toggle="modal"
                                data-bs-target="#toBuyNow" wire:click="toBuyNow({{ $product->id }})"><i
                                    class="fa-solid fa-cart-shopping"></i> Buy Now</a>
                            @endrole
                            @role('admin')
                            <a wire:navigate href="/admin/products"
                                class="btn btn-primary mt-1 form-control btn-block"><i
                                    class="fa-light fa-pen-to-square"></i> Update</a>
                            @endrole

                            <div class="d-flex font-size-1 mb-2">
                                <strong class="pl-2" style="position: absolute; bottom:0; left: 0;">Sold:

                                    {{ $product->product_sold }}
                                </strong>
                                {{-- <strong class="pl-2" style="position: absolute; bottom:0; left: 0;">
                                    Sold:
                                    @if ($product->product_sold >= 1000)
                                    {{ number_format($product->product_sold / 1000, 1) }}k
                                    @else
                                    {{ $product->product_sold }}
                                    @endif
                                </strong> --}}
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
                <h4 class="text-break">"{{ $search }}" product not found.</h4>
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
    {{-- <div class="d-flex mb-2 align-items-center overflow-auto">
        <a wire:click="loadMorePage" class="mx-auto btn btn-link" {{ $products->count() >= $allDisplayProducts ||
            $search ? 'hidden' : '' }} id="paginate">
            <span wire:loading class="spinner-border"></span><span wire:loading.remove>Load more...</span></a>
    </div> --}}

    <div class="d-flex mb-2 align-items-center overflow-auto">
        @if($products->count() < $allDisplayProducts)
            <div class="mx-auto" id="sentinel" wire:loading.remove wire:target='loadMorePage'></div>
        @endif
        <button wire:loading type="button" wire:target='loadMorePage' class="btn btn-link mx-auto" wire:click='loadMorePage' id="loadMoreData">
            <span class="spinner-border"></span>
        </button>
        {{-- <a wire:click="loadMorePage" class="mx-auto btn btn-link" {{ $products->count() >= $allDisplayProducts ||
            $search
            ?
            'hidden' : '' }} id="paginate">
            <span wire:loading.remove>Load more...</span>
            <span wire:loading class="spinner-border"></span>
        </a> --}}
    </div>

    <script>
        let search = '';
        document.addEventListener('searchData', function(e) {
            search = e.detail.search;
        });

        document.addEventListener('livewire:navigated', function() {
            const sentinel = document.getElementById('sentinel');
            const button = document.getElementById('loadMoreData');
            if(!sentinel) return;

            if(!window.sentinelObserver) {
                window.sentinelObserver = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting && !search) {
                        button?.click();
                    }
                });
            }

            window.sentinelObserver.observe(sentinel);

        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {

            @this.on('toastr', (event) => {
                const {
                    type
                    , message
                } = event.data;

                toastr[type](message, '', {
                    closeButton: true
                    , "progressBar": true
                , });
            });
            @this.on('closeModal', () => {
                $('#addToCart').modal('hide');
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            @this.on('alert', function(event) {
                const { title, type, message} = event.alerts;

                Swal.fire({
                    icon: type,
                    title: title,
                    html: message,
                    showCloseButton: false,
                    showConfirmButton: false
                })
            });

            @this.on('closeModal', function() {
                $('#toBuyNow').modal('hide');
                $('#checkOut').modal('hide');
            });
        });
    </script>


    {{-- @if (session('message'))
    <script>
        toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.success("{{ session('message') }}");
    </script>
    @endif --}}

    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-message {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }

        .dropdown-menu .dropdown-item:focus {
            background-color: transparent !important;
            color: black !important;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const cartIcon = document.getElementById('cartIcon');

            if(window.pageYOffset > 85) {
                cartIcon.style.marginTop = '-270px';
                cartIcon.style.transition = 'margin-top 0.3s ease-in-out';
            } else {
                cartIcon.style.transition = 'margin-top 0.3s ease-in-out';
                cartIcon.style.marginTop = '-180px';
            }
            document.addEventListener('scroll', () => {
                if (window.scrollY > 85) {
                    cartIcon.style.marginTop = '-270px';
                    cartIcon.style.transition = 'margin-top 0.3s ease-in-out';
                } else {
                    cartIcon.style.transition = 'margin-top 0.3s ease-in-out';
                    cartIcon.style.marginTop = '-180px';
                }
            });
        });
    </script>

</div>
