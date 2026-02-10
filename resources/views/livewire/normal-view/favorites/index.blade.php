<div>
    @include('livewire.normal-view.products.view')
    @include('livewire.normal-view.carts.add-to-cart')
    @include('livewire.normal-view.orders.buy-now')
    <div class="container">
        <h3 class="mt-5 fw-bold text-primary"><i class="fa-solid fa-heart text-danger"></i> My Shopping Favorites</h3>
        <hr>
        <div class="row">
            @forelse ($allFavorites as $favorite)
                <div class="col-md-6 col-lg-3 col-6 mt-2" style="padding: 0.5px;">
                    <x-product-list-card :product="$favorite->product" />
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-heart text-muted" style="font-size: 80px;"></i>
                    </div>
                    <h3 class="text-muted mb-3">Your favorites is empty</h3>
                    <p class="text-muted mb-4">Add some products to get started with your shopping</p>
                    <a wire:navigate href="/products" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-shopping-bag me-2"></i>Browse Products
                    </a>
                </div>
            @endforelse
        </div>
    </div>
    <div class="d-flex mb-2 align-items-center overflow-auto">
        @if ($allFavorites->count() < $allFavoritesData)
            <div class="mx-auto" id="sentinel" wire:loading.remove wire:target='loadMorePages'>
            </div>
        @endif
        <button wire:loading type="button" class="btn btn-link mx-auto" wire:click='loadMorePages' id="loadMoreData"
            wire:target='loadMorePages'>
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
        .container-fluid {
            max-width: 1400px;
        }

        .sticky-top {
            z-index: 1;
        }

        .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .product-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(0.5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .favorite-btn {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .favorite-btn:hover {
            background: white;
            transform: scale(1.1);
        }

        .rating-stars {
            font-size: 0.9rem;
        }

        .text-decoration-line-through {
            text-decoration-thickness: 2px;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        [x-cloak] {
            display: none !important;
        }

        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
        }

        .bg-opacity-90 {
            opacity: 0.9;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            animation: fadeIn 0.5s ease-out;
        }

        .product-image-container {
            height: 200px;
        }

        @media (max-width: 992px) {
            .product-image-container {
                height: 180px;
            }
        }

        @media (max-width: 768px) {
            .product-image-container {
                height: 160px;
            }

            .sticky-top {
                position: static;
            }
        }

        @media (max-width: 576px) {
            .product-image-container {
                height: 130px;
            }

            .card-body {
                padding: 1rem;
            }
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #495057;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .rating-filter .fa-star {
            font-size: 0.9rem;
        }

        .text-primary {
            color: #0d6efd !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.3);
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }

        .spinner-border {
            vertical-align: middle;
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
            Livewire.on('toastr', (event) => {
                const {
                    type,
                    message
                } = event.data;

                toastr[type](message, '', {
                    closeButton: true,
                    "progressBar": true,
                });
            });

            Livewire.on('alert', function(event) {
                const {
                    title,
                    type,
                    message
                } = event.alerts;

                Swal.fire({
                    showConfirmButton: false,
                    icon: type,
                    title: title,
                    html: message
                });
            });

            Livewire.on('closeModal', function() {
                $("#addToCart").modal('hide');
                $("#toBuyNow").modal('hide');
            });
        });
    </script>

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
