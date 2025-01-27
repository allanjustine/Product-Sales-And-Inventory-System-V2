<div>
    @include('livewire.normal-view.products.view')
    @include('livewire.normal-view.carts.add-to-cart')
    @include('livewire.normal-view.carts.delete')
    @include('livewire.normal-view.orders.check-out')
    @include('livewire.normal-view.orders.buy-now')
    <div style="backdrop-filter: blur(15px);" class="bg-transparent sticky-top rounded" id="cats">
        <details wire:ignore>
            <summary class="bg-secondary p-3 text-center">

            </summary>
            <p>
                <div class="col-md-5 col-sm-6 offset-md-4 offset-sm-3 mt-2">
                    <div class="dropdown">
                        <input type="search" class="form-control dropdown-toggle" id="searchInput" data-toggle="dropdown" placeholder="Search" wire:model.live.debounce.200ms="search" style="border-radius: 30px; height: 50px;" aria-haspopup="true" aria-expanded="false">

                        <div class="dropdown-menu w-100 {{ $searchLogs->isEmpty() ? 'd-none' : '' }}" aria-labelledby="searchInput">
                            @foreach ($searchLogs as $log)
                            <div class="d-flex align-items-center">
                                <button class="dropdown-item p-3 flex-grow-1 text-truncate" type="button" wire:click.prevent="searchLog({{ $log->id }})">
                                    {{ $log->log_entry }}
                                </button>
                                <button class="mr-2" style="background-color: transparent; border: none;" wire:click.prevent="searchDelete({{ $log->id }})">
                                    <i class="far fa-times"></i>
                                </button>
                            </div>
                            @endforeach
                            <div>
                                <a href="#" class="float-end px-3" wire:click.prevent="clearAllLogs({{ auth()->user()->id }})">Clear all</a>
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
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
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
                        <button style="height: 40px;" wire:click="clearFilters" class="btn btn-secondary form-control"><i class="fa-solid fa-broom-wide"></i> Clear Filters</button>
                    </div>
                </div>
        </details>
    </div>
    @role('user')
    <div class="dropdown" wire:ignore.self>
        <a class="float-right mt-4 mr-4 p-2 cartdropdown" id="cart-dropdown" data-toggle="dropdown" aria-expanded="false" href=""><i class="fa-regular fa-cart-shopping pt-3"></i>
            <span class="badge badge-pill badge-danger" id="badge-cart"><span style="font-size: 12px;">{{ $carts->count() }}</span></span>
        </a>
        <ul id="myDiv" class="dropdown-menu dropdown-menu-end cartmenu" style="z-index: 1049;" aria-labelledby="cart-dropdown" wire:ignore.self>
            <h4 class="pl-3"><strong><i class="fa-regular fa-cart-shopping"></i> My Cart
                    ({{ $carts->count() }})</strong>
            </h4>
            <hr>
            @foreach ($carts as $item)
            <li class="cart-item px-3 py-2">
                <div class="cart-item-image">
                    <button class="btn btn-link text-primary" type="button" wire:click="decreaseQuantity({{ $item->id }})" onclick="handleButtonClick(event, {{ $item->id }})">
                        <i class="fas fa-minus text-black"></i>
                    </button>
                    x{{ number_format($item->quantity) }}
                    <button type="button" class="btn btn-link text-primary" wire:click="increaseQuantity({{ $item->id }})" onclick="handleButtonClick(event, {{ $item->id }})">
                        <i class="fas fa-plus text-black"></i>
                    </button>
                    @if (Storage::exists($item->product->product_image))
                    <img style="width: 70px; height: 70px; border-radius:10%;" src="{{ Storage::url($item->product->product_image) }}" alt="">
                    @else
                    <img style="width: 70px; height: 70px; border-radius:10%;" src="{{ url($item->product->product_image) }}" alt="">
                    @endif
                    &nbsp;&nbsp;<span><strong class="text-capitalize">{{ $item->product->product_name }}</strong></span>
                </div>
                <div class="cart-item-price mt-2">
                    &#8369;{{ number_format($item->product->product_price, 2, '.', ',') }}
                    <button class="btn btn-link text-danger" data-toggle="modal" data-target="#remove" wire:click="remove({{ $item->id }})">
                        <i class="fas fa-trash-alt"></i>&nbsp;Delete
                    </button>
                    <button class="btn btn-link text-primary" data-toggle="modal" data-target="#checkOut" wire:click="checkOut({{ $item->id }})">
                        <i class="fas fa-check"></i>&nbsp;Checkout
                    </button><br>
                    <span><strong>Sub total:
                            &#8369;{{ number_format($this->getProductTotalAmount($item->product_id), 2, '.', ',') }}</strong></span>
                </div>

            </li>
            <li class="dropdown-divider"></li>
            @endforeach
            <li>
                {{-- <button wire:click.prevent="checkOutAll()">Checkout all</button> --}}
                @if ($carts->count() === 0)
                <p class="text-center">
                    <i class="fa-regular fa-cart-xmark mt-5" style="font-size: 50px;"></i>
                </p>
                <p class="text-center mb-5">No Product Added Yet.</p>
                @else
                <span class="px-3 py-2"><strong>Grand total:
                        &#8369;{{ number_format($total, 2, '.', ',') }}</strong></span>
                @endif
            </li>
        </ul>
    </div>
    @endrole
    <div class="container">

        <br><br>
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
            <div class="col-md-3 mt-2 col-sm-4 col-6 p-1">

                <a href="#" class="text-black" data-toggle="modal" data-target="#viewProduct" wire:click="view({{ $product->id }})">
                    <div class="card shadow product-card" style="min-width: 50px;">
                        <div style="position: relative;">
                            <div class="image-container">
                                @if (Storage::exists($product->product_image))
                                <img class="card-img-top" src="{{ Storage::url($product->product_image) }}" alt="{{ $product->product_name }}">
                                @else
                                <img class="card-img-top" src="{{ url($product->product_image) }}" alt="{{ $product->product_name }}">
                                @endif
                            </div>
                            <a href="#" title="@if ($product->favorites->contains('user_id', auth()->user()->id)) {{ $product->favorites->count() }} people added this to favorites @else Add to favorites @endif" class="btn btn-link position-absolute top-0 start-0" wire:click.prevent="addToFavorite({{ $product->id }})">
                                <h2 class="text-danger"><i class="{{ $product->favorites->contains('user_id', auth()->user()->id) ? 'fas' : 'far' }} fa-heart"></i>
                                </h2>
                            </a>

                            <div class="pt-2 pr-2" style="position: absolute; top:0; right: 0;">
                                @if ($product->product_stock >= 20)
                                <span class="badge badge-success badge-pill">{{ number_format($product->product_stock) }}</span>
                                @elseif ($product->product_stock)
                                <span class="badge badge-warning badge-pill">{{ number_format($product->product_stock) }}</span>
                                @else
                                <span class="badge badge-danger badge-pill">OUT OF STOCK</span>
                                @endif
                            </div>

                        </div>
                        <div class="card-footer text-center mb-3 mt-auto">
                            <h6 class="d-inline-block text-secondary medium font-weight-medium mb-1">
                                {{ $product->product_category->category_name }}</h6>
                            <h5 class="font-size-1 font-weight-normal text-capitalize">
                                {{ $product->product_name }}
                            </h5>
                            <div class="d-block font-size-1 mb-2">
                                <span class="font-weight-medium"><i class="fas fa-peso-sign"></i>{{ number_format($product->product_price, 2, '.', ',') }}</span>
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
                            <a class="btn btn-warning mt-1 form-control" data-toggle="modal" data-target="#addToCart" wire:click.prevent="addToCart({{ $product->id }})"><i class="fa-solid fa-cart-plus"></i>
                                Add to Cart</a>

                            <a class="btn btn-primary mt-1 form-control btn-block" data-toggle="modal" data-target="#toBuyNow" wire:click.prevent="toBuyNow({{ $product->id }})"><i class="fa-solid fa-cart-shopping"></i> Buy Now</a>
                            @endrole
                            @role('admin')
                            <a href="/admin/products" class="btn btn-primary mt-1 form-control btn-block"><i class="fa-light fa-pen-to-square"></i> Update</a>
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
                    </div>
                </a>
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
<div class="d-flex mb-2 align-items-center overflow-auto">
    <a wire:click.prevent="loadMore()" class="mx-auto btn btn-link" {{ $products->count() >= $allDisplayProducts && $search ? 'hidden' : '' }} id="paginate">
        <span wire:loading>Loading...</span><span wire:loading.remove>Load more...</span></a>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('toastr', (event) => {
            const {
                type
                , message
            } = event.data;

            toastr[type](message, '', {
                closeButton: true
                , "progressBar": true
            , })
        })
        Livewire.on('closeModal', () => {
            $('#addToCart').modal('hide');
        })
    })

</script>
<script>
    function handleButtonClick(event, itemId) {
        // Prevent event propagation to the dropdown container
        event.stopPropagation();
    }

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

</div>
