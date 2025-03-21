<div>
    @include('livewire.normal-view.products.view')
    @include('livewire.normal-view.carts.add-to-cart')
    @include('livewire.normal-view.orders.buy-now')
    <div class="container-md">
        <h3 class="mt-5"><i class="fa-light fa-heart"></i> My Favorites</h3>
        <hr>
        <div class="row">

            @forelse ($allFavorites as $favorite)
            <div class="col-md-3 mt-2 col-sm-4 col-6 p-1">

                <div class="card shadow product-card" style="min-width: 50px;">
                    <div style="position: relative;">
                        <a href="#" class="text-black" data-bs-toggle="modal" data-bs-target="#viewProduct"
                            wire:click="view({{ $favorite->product->id }})">
                            <div class="image-container">
                                @if (Storage::exists($favorite->product->product_image))
                                <img class="card-img-top" src="{{ Storage::url($favorite->product->product_image) }}"
                                    alt="{{ $favorite->product->product_name }}">
                                @else
                                <img class="card-img-top" src="{{ url($favorite->product->product_image) }}"
                                    alt="{{ $favorite->product->product_name }}">
                                @endif
                            </div>
                        </a>
                        <a href="#"
                            title="@if ($favorite->user_id == auth()->user()->id) {{ $favorite->where('product_id', $favorite->product->id)->count() }} people added this to favorites @else Add to favorites @endif"
                            class="btn btn-link position-absolute top-0 start-0"
                            wire:click.prevent="removeToFavorite({{ $favorite->id }})">
                            <h2 class="text-danger"><i
                                    class="{{ $favorite->user_id == auth()->user()->id ? 'fas' : 'far' }} fa-heart"></i>
                            </h2>
                        </a>

                        <div class="pt-2 pr-2" style="position: absolute; top:0; right: 0;">
                            @if ($favorite->product->product_stock >= 20)
                            <span class="badge badge-success badge-pill">{{
                                number_format($favorite->product->product_stock) }}</span>
                            @elseif ($favorite->product->product_stock)
                            <span class="badge badge-warning badge-pill">{{
                                number_format($favorite->product->product_stock) }}</span>
                            @else
                            <span class="badge badge-danger badge-pill">OUT OF STOCK</span>
                            @endif
                        </div>

                    </div>
                    <a href="#" class="text-black" data-bs-toggle="modal" data-bs-target="#viewProduct"
                        wire:click="view({{ $favorite->product->id }})">
                        <div class="card-footer text-center mb-3 mt-auto">
                            <h6 class="d-inline-block text-secondary medium font-weight-medium mb-1">
                                {{ $favorite->product->product_category->category_name }}</h6>
                            <h3 class="font-size-1 font-weight-normal">
                                <h5 id="product_name">{{ $favorite->product->product_name }}</h5>
                            </h3>
                            <div class="d-block font-size-1 mb-2">
                                <span class="font-weight-medium">₱{{
                                    number_format($favorite->product->product_price, 2, '.', ',') }}</span>
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
                            <a class="btn btn-warning mt-1 form-control" data-bs-toggle="modal"
                                data-bs-target="#addToCart" wire:click="addToCart({{ $favorite->product->id }})"><i
                                    class="fa-solid fa-cart-plus"></i>
                                Add to Cart</a>

                            <a class="btn btn-primary mt-1 form-control btn-block" data-bs-toggle="modal"
                                data-bs-target="#toBuyNow" wire:click="toBuyNow({{ $favorite->product->id }})"><i
                                    class="fa-solid fa-cart-shopping"></i> Buy Now</a>
                            @endrole
                            @role('admin')
                            <a wire:navigate href="/admin/products"
                                class="btn btn-primary mt-1 form-control btn-block"><i
                                    class="fa-light fa-pen-to-square"></i> Update</a>
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
                    </a>
                </div>
            </div>
            @empty
            <span class="text-center">
                <i class="fa-regular fa-xmark-to-slot mb-3 mt-5" style="font-size: 100px;"></i>
                <h4>You have not selected product to your favorites yet.</h4>
            </span>
            @endforelse
        </div>
    </div>
    <div class="d-flex mb-2 align-items-center overflow-auto">
        @if ($allFavorites->count() < $allFavoritesData) <div class="mx-auto" id="sentinel" wire:loading.remove wire:target='loadMorePages'>
    </div>
    @endif
    <button wire:loading type="button" class="btn btn-link mx-auto" wire:click='loadMorePages' id="loadMoreData" wire:target='loadMorePages'>
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


<style>
    #product_name {

        text-transform: capitalize;
    }
</style>

<script>
    document.addEventListener('livewire:navigated', function() {
            const sentinel = document.getElementById('sentinel');
            const button = document.getElementById('loadMoreData');

            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    button?.click();
                }
            });

            observer.observe(sentinel);

            return () => {
                observer.disconnect();
            }

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

            @this.on('alert', function(event) {
                const { title, type, message } = event.alerts;

                Swal.fire({
                    showConfirmButton: false,
                    icon: type,
                    title: title,
                    html: message
                });
            });

            @this.on('closeModal', function() {
                $("#addToCart").modal('hide');
                $("#toBuyNow").modal('hide');
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
</style>
</div>
