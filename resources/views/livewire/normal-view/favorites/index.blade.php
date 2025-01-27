<div>
    @include('livewire.normal-view.products.view')
    @include('livewire.normal-view.carts.add-to-cart')
    @include('livewire.normal-view.orders.buy-now')
    <div class="container">
        <h3 class="mt-5"><i class="fa-light fa-heart"></i> My Favorites</h3>
        <hr>
        <div class="row">

            @forelse ($allFavorites as $favorite)
            <div class="col-md-3 mt-2 col-sm-4 col-6 p-1">

                <a href="#" class="text-black" data-toggle="modal" data-target="#viewProduct" wire:click="view({{ $favorite->product->id }})">
                    <div class="card shadow product-card" style="min-width: 50px;">
                        <div style="position: relative;">
                            <div class="image-container">
                                @if (Storage::exists($favorite->product->product_image))
                                <img class="card-img-top" src="{{ Storage::url($favorite->product->product_image) }}" alt="{{ $favorite->product->product_name }}">
                                @else
                                <img class="card-img-top" src="{{ url($favorite->product->product_image) }}" alt="{{ $favorite->product->product_name }}">
                                @endif
                            </div>
                            <a href="#" title="@if ($favorite->user_id == auth()->user()->id) {{ $favorite->where('product_id', $favorite->product->id)->count() }} people added this to favorites @else Add to favorites @endif" class="btn btn-link position-absolute top-0 start-0" wire:click.prevent="removeToFavorite({{ $favorite->id }})">
                                <h2 class="text-danger"><i class="{{ $favorite->user_id == auth()->user()->id ? 'fas' : 'far' }} fa-heart"></i>
                                </h2>
                            </a>

                            <div class="pt-2 pr-2" style="position: absolute; top:0; right: 0;">
                                @if ($favorite->product->product_stock >= 20)
                                <span class="badge badge-success badge-pill">{{ number_format($favorite->product->product_stock) }}</span>
                                @elseif ($favorite->product->product_stock)
                                <span class="badge badge-warning badge-pill">{{ number_format($favorite->product->product_stock) }}</span>
                                @else
                                <span class="badge badge-danger badge-pill">OUT OF STOCK</span>
                                @endif
                            </div>

                        </div>
                        <div class="card-footer text-center mb-3 mt-auto">
                            <h6 class="d-inline-block text-secondary medium font-weight-medium mb-1">
                                {{ $favorite->product->product_category->category_name }}</h6>
                            <h3 class="font-size-1 font-weight-normal">
                                <h5 id="product_name">{{ $favorite->product->product_name }}</h5>
                            </h3>
                            <div class="d-block font-size-1 mb-2">
                                <span class="font-weight-medium"><i class="fas fa-peso-sign"></i>{{ number_format($favorite->product->product_price, 2, '.', ',') }}</span>
                            </div>
                            <div class="d-block font-size-1 mb-2">
                                <span class="font-weight-medium">
                                    @if ($favorite->product->product_status === 'Available')
                                    <td><span class="badge badge-success">AVAILABLE</span></td>
                                    @else
                                    <td><span class="badge badge-danger">NOT AVAILABLE</span></td>
                                    @endif
                                </span>
                            </div>
                            @role('user')
                            @if ($favorite->product->product_status === 'Not Available')
                            <a wire:click="notAvailable()" class="btn btn-warning mt-1 form-control"><i class="fa-solid fa-cart-plus"></i>
                                Add to Cart</a>
                            <a wire:click="notAvailable()" class="btn btn-primary mt-1 form-control"><i class="fa-solid fa-cart-shopping"></i>
                                Buy Now</a>
                            @elseif ($favorite->product->product_stock == 0)
                            <a wire:click="outOfStock()" class="btn btn-warning mt-1 form-control"><i class="fa-solid fa-cart-plus"></i>
                                Add to Cart</a>
                            <a wire:click="outOfStock()" class="btn btn-primary mt-1 form-control"><i class="fa-solid fa-cart-shopping"></i>
                                Buy Now</a>
                            @else
                            <a class="btn btn-warning mt-1 form-control" data-toggle="modal" data-target="#addToCart" wire:click.prevent="addToCart({{ $favorite->product->id }})"><i class="fa-solid fa-cart-plus"></i>
                                Add to Cart</a>

                            <a class="btn btn-primary mt-1 form-control btn-block" data-toggle="modal" data-target="#toBuyNow" wire:click.prevent="toBuyNow({{ $favorite->product->id }})"><i class="fa-solid fa-cart-shopping"></i> Buy Now</a>
                            @endif
                            @endrole
                            @role('admin')
                            <a href="/admin/products" class="btn btn-primary mt-1 form-control btn-block"><i class="fa-light fa-pen-to-square"></i> Update</a>
                            @endrole

                            <div class="d-flex font-size-1 mb-2">
                                <strong class="pl-2" style="position: absolute; bottom:0; left: 0;">Sold:

                                    {{ $favorite->product->product_sold }}
                                </strong>
                                {{-- <strong class="pl-2" style="position: absolute; bottom:0; left: 0;">
                                    Sold:
                                    @if ($favorite->product->product_sold >= 1000)
                                        {{ number_format($favorite->product->product_sold / 1000, 1) }}k
                                @else
                                {{ $favorite->product->product_sold }}
                                @endif
                                </strong> --}}
                                <span class="font-weight-medium pr-2" style="position: absolute; bottom:0; right: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <strong>
                                        {{ $favorite->product->product_rating }}/5
                                    </strong>
                                    <span class="text-danger">({{ $favorite->product->product_votes }})</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <span class="text-center">
                <i class="fa-regular fa-xmark-to-slot mb-3 mt-5" style="font-size: 100px;"></i>
                <h4>You have not selected product to your favorites yet.</h4>
            </span>
            @endforelse
        </div>
    </div>


    <style>
        #product_name {

            text-transform: capitalize;
        }

    </style>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toastr', (event) => {
                const data = event;

                toastr[data[0].type](data[0].message, '', {
                    closeButton: true
                    , "progressBar": true
                , })
            })
        })

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

    </style>
</div>
