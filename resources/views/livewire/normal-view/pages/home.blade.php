<div>
    @include('livewire.normal-view.products.view')
    <div id="homeCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            @foreach ([['image' => 'images/slide1.jpg', 'title' => 'Food is not just fuel, it\'s information. It talks to your DNA and tells it what to do.'], ['image' => 'images/slide2.jpg', 'title' => 'A restaurant should be a place where you can eat food that has been cooked with passion, served with warmth, and enjoyed with pleasure.'], ['image' => 'images/slide3.jpg', 'title' => 'Food delivery is not just a service, it\'s a relationship between the restaurant and the customer.']] as $index => $slide)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="position-relative">
                        <img class="d-block w-100 carousel-image" src="{{ $slide['image'] }}"
                            alt="Slide {{ $index + 1 }}" style="height: 80vh; object-fit: cover;">
                        <div class="carousel-overlay position-absolute top-0 start-0 w-100 h-100"
                            style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7));">
                        </div>
                    </div>

                    <div class="carousel-caption position-absolute top-50 start-50 translate-middle w-100 px-3">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-md-12 text-center">
                                    <div class="mb-4">
                                        <i class="fa-classic fa-solid fa-quote-left text-white-50 fa-2x mb-3"></i>
                                    </div>
                                    <h1 class="display-5 fw-bold text-white mb-4 carousel-title" id="home-title">
                                        {{ $slide['title'] }}
                                    </h1>

                                    @if (auth()->check())
                                        <div
                                            class="d-inline-block bg-opacity-20 backdrop-blur rounded-pill px-4 py-2 mb-4">
                                            <div class="d-flex align-items-center gap-2" id="signin-text">
                                                @if ($morning)
                                                    <i class="fa-classic fa-solid fa-sunrise text-warning fa-lg"></i>
                                                    <span class="fw-medium text-white">Good Morning</span>
                                                @elseif($afternoon)
                                                    <i class="fa-classic fa-solid fa-sun text-warning fa-lg"></i>
                                                    <span class="fw-medium text-white">Good Afternoon</span>
                                                @elseif($evening)
                                                    <i class="fa-classic fa-solid fa-moon-stars text-light fa-lg"></i>
                                                    <span class="fw-medium text-white">Good Evening</span>
                                                @else
                                                    <i class="fa-classic fa-solid fa-smile-beam text-light fa-lg"></i>
                                                    <span class="fw-medium text-white">Have a nice day</span>
                                                @endif
                                                <span class="fw-bold text-white">, {{ auth()->user()->name }}</span>
                                            </div>
                                        </div>
                                        <br>
                                        <a wire:navigate href="/products"
                                            class="btn btn-primary btn-lg px-4 py-3 shadow-lg">
                                            <i class="fa-classic fa-solid fa-shopping-cart me-2"></i>Order Now
                                        </a>
                                    @else
                                        <div class="backdrop-blur rounded p-3 mb-4 d-inline-block">
                                            <p class="text-white mb-0" id="signin-text">
                                                <i class="fa-classic fa-solid fa-info-circle me-2"></i>
                                                Sign in to get personalized recommendations
                                            </p>
                                        </div>
                                        <br>
                                        <div class="d-flex flex-wrap gap-3 justify-content-center">
                                            <a wire:navigate href="/product-lists" id="signin-text"
                                                class="btn btn-warning btn-lg px-4 py-3">
                                                <i class="fa-classic fa-solid fa-eye me-2"></i>Browse Products
                                            </a>
                                            <a wire:navigate href="/login" id="signin-text"
                                                class="btn btn-primary btn-lg px-4 py-3 shadow-lg">
                                                <i class="fa-classic fa-solid fa-sign-in-alt me-2"></i>Sign In
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-opacity-50 p-3" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-opacity-50 p-3" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container py-5">
        <section class="mb-5">
            <div class="section-header mb-5">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="line bg-gradient"></div>
                    <div class="text-center">
                        <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">
                            <i class="fa-classic fa-solid fa-medal me-2"></i>Top Picks
                        </span>
                        <h2 class="fw-bold" id="title-tops">Top Selling Products</h2>
                        <p class="text-muted mb-0">Most loved items by our customers</p>
                    </div>
                    <div class="line bg-gradient"></div>
                </div>
            </div>

            <div class="row">
                @forelse ($topDeals as $product)
                    <div class="col-xl-3 col-lg-4 col-6 mt-1" style="padding: 0.5px;">
                        @include('components.product-card', [
                            'product' => $product,
                            'badgeType' => 'top',
                            'badgeText' => 'Top ' . ($loop->index + 1),
                        ])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fa-classic fa-solid fa-trophy text-muted mb-3" style="font-size: 4rem;"></i>
                            <h4 class="text-muted mb-2">No Top Products Yet</h4>
                            <p class="text-muted">Products will appear here once they gain popularity</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($topDeals->count() > 0)
                <div class="text-center mt-5">
                    @if (auth()->check())
                        <a wire:navigate href="/products?sorted_by=top_selling"
                            class="btn btn-outline-primary btn-lg px-5">
                            <i class="fa-classic fa-solid fa-arrow-right me-2"></i>View All Products
                        </a>
                    @else
                        <a wire:navigate href="/product-lists?sorted_by=top_selling"
                            class="btn btn-outline-primary btn-lg px-5">
                            <i class="fa-classic fa-solid fa-arrow-right me-2"></i>Browse All Products
                        </a>
                    @endif
                </div>
            @endif
        </section>

        <section class="mb-5">
            <div class="section-header mb-5">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="line bg-gradient"></div>
                    <div class="text-center">
                        <span class="badge bg-warning mb-2 px-3 py-2 rounded-pill">
                            <i class="fa-classic fa-solid fa-fire me-2"></i>Trending Now
                        </span>
                        <h2 class="fw-bold" id="title-tops">Popular Products</h2>
                        <p class="text-muted mb-0" id="subtitle-tops">Currently trending in our store</p>
                    </div>
                    <div class="line bg-gradient"></div>
                </div>
            </div>

            <div class="row">
                @forelse ($popularityDeals as $product)
                    <div class="col-xl-3 col-lg-4 col-6 mt-1" style="padding: 0.5px;">
                        @include('components.product-card', [
                            'product' => $product,
                            'badgeType' => 'popular',
                            'badgeText' => 'Trending',
                        ])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fa-classic fa-solid fa-fire text-muted mb-3" style="font-size: 4rem;"></i>
                            <h4 class="text-muted mb-2">No Popular Products Yet</h4>
                            <p class="text-muted">Check back later for trending products</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($popularityDeals->count() > 0)
                <div class="text-center mt-5">
                    @if (auth()->check())
                        <a wire:navigate href="/products?sorted_by=popularity"
                            class="btn btn-outline-warning btn-lg px-5">
                            <i class="fa-classic fa-solid fa-arrow-right me-2"></i>Explore More
                        </a>
                    @else
                        <a wire:navigate href="/product-lists?sorted_by=popularity"
                            class="btn btn-outline-warning btn-lg px-5">
                            <i class="fa-classic fa-solid fa-arrow-right me-2"></i>Discover More
                        </a>
                    @endif
                </div>
            @endif
        </section>

        <section class="mb-5">
            <div class="section-header mb-5">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="line bg-gradient"></div>
                    <div class="text-center">
                        <span class="badge bg-info mb-2 px-3 py-2 rounded-pill">
                            <i class="fa-classic fa-solid fa-bolt me-2"></i>Just Arrived
                        </span>
                        <h2 class="fw-bold" id="title-tops">Latest Products</h2>
                        <p class="text-muted mb-0">Freshly added to our collection</p>
                    </div>
                    <div class="line bg-gradient"></div>
                </div>
            </div>

            <div class="row">
                @forelse ($latestProducts as $product)
                    <div class="col-xl-3 col-lg-4 col-6 mt-1" style="padding: 0.5px;">
                        @include('components.product-card', [
                            'product' => $product,
                            'badgeType' => 'latest',
                            'badgeText' => 'New',
                        ])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fa-classic fa-solid fa-clock text-muted mb-3" style="font-size: 4rem;"></i>
                            <h4 class="text-muted mb-2">No Latest Products</h4>
                            <p class="text-muted">New products will be added soon</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($latestProducts->count() > 0)
                <div class="text-center mt-5">
                    @if (auth()->check())
                        <a wire:navigate href="/products?sorted_by=latest" class="btn btn-outline-info btn-lg px-5">
                            <i class="fa-classic fa-solid fa-arrow-right me-2"></i>See All New Arrivals
                        </a>
                    @else
                        <a wire:navigate href="/product-lists?sorted_by=latest"
                            class="btn btn-outline-info btn-lg px-5">
                            <i class="fa-classic fa-solid fa-arrow-right me-2"></i>View All Products
                        </a>
                    @endif
                </div>
            @endif
        </section>
    </div>

    <section class="bg-light py-5">
        <div class="container">
            <div class="section-header mb-5">
                <div class="text-center">
                    <span class="badge bg-dark mb-2 px-3 py-2 rounded-pill">
                        <i class="fa-classic fa-solid fa-map-marker-alt me-2"></i>Visit Us
                    </span>
                    <h2 class="fw-bold" id="title-tops">Our Location</h2>
                    <p class="text-muted mb-4">Find us at our cozy store</p>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start gap-3 mb-4">
                                <div class="bg-primary rounded-circle p-3 flex-shrink-0">
                                    <i class="fa-classic fa-solid fa-location-dot text-white fa-lg"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1">AJM Store</h4>
                                    <p class="text-muted mb-0">
                                        <i class="fa-classic fa-solid fa-map-pin text-danger me-2"></i>
                                        Tinangnan, Tubigon, Bohol
                                    </p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="fa-classic fa-solid fa-clock text-primary"></i>
                                        <span class="fw-medium">Opening Hours</span>
                                    </div>
                                    <p class="text-muted mb-0">9:00 AM - 10:00 PM</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="fa-classic fa-solid fa-phone text-primary"></i>
                                        <span class="fw-medium">Contact</span>
                                    </div>
                                    <p class="text-muted mb-0">(032) 123-4567</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d413.07098686836446!2d123.970567480301!3d9.949291019306209!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zOcKwNTYnNTcuMCJOIDEyM8KwNTgnMTMuOCJF!5e0!3m2!1sen!2sph!4v1681485598511!5m2!1sen!2sph"
                                    target="_blank" class="btn btn-primary">
                                    <i class="fa-classic fa-solid fa-directions me-2"></i>Get Directions
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="map-container rounded-3 overflow-hidden shadow-lg">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d413.07098686836446!2d123.970567480301!3d9.949291019306209!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zOcKwNTYnNTcuMCJOIDEyM8KwNTgnMTMuOCJF!5e0!3m2!1sen!2sph!4v1681485598511!5m2!1sen!2sph"
                            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" class="w-100 h-100">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @media (max-width: 300px) {
            #home-title {
                font-size: 15px;
            }

            #signin-text {
                font-size: 10px;
            }

            #title-tops {
                font-size: 15px;
            }

            #subtitle-tops {
                font-size: 12px;
            }

            #badge-text {
                font-size: 6px;
            }

            #discount-badge {
                font-size: 6px;
                margin-top: 2px;
            }

            #category {
                font-size: 7px;
            }

            #product-name {
                font-size: 9px;
            }

            #price {
                font-size: 11px;
            }

            #old-price {
                font-size: 9px;
            }

            #rating-sold {
                font-size: 8px;
            }

            #product-image {
                height: 130px;
            }
        }

        @media (min-width: 300px) {
            #product-image {
                height: 200px;
            }
        }

        #homeCarousel {
            position: relative;
            overflow: hidden;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .carousel-image {
            min-height: 600px;
            object-fit: cover;
            object-position: center;
        }

        .carousel-caption {
            z-index: 10;
            padding: 0;
            max-width: 1200px;
            left: 50%;
            transform: translateX(-50%);
            top: 50%;
            margin-top: -30px;
        }

        .carousel-title {
            font-size: 2.5rem;
            line-height: 1.3;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 60px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        .carousel-indicators {
            margin-bottom: 2rem;
            z-index: 10;
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 6px;
            border: 2px solid white;
            background-color: transparent;
        }

        .carousel-indicators button.active {
            background-color: white;
        }

        .backdrop-blur {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .btn-outline-light {
            border-width: 2px;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .btn-primary {
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.4) !important;
        }

        @media (max-width: 992px) {
            .carousel-title {
                font-size: 2rem;
            }

            .carousel-image {
                min-height: 500px;
            }

            .carousel-caption {
                padding: 0 20px;
            }
        }

        @media (max-width: 768px) {
            .carousel-title {
                font-size: 1.6rem;
            }

            .carousel-image {
                min-height: 400px;
            }

            .carousel-caption {
                top: 45%;
            }

            .btn-lg {
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
            }

            .carousel-indicators {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .carousel-title {
                font-size: 1.3rem;
                margin-bottom: 1rem;
            }

            .carousel-image {
                min-height: 350px;
            }

            .d-flex.flex-wrap {
                flex-direction: column;
                gap: 10px !important;
            }

            .d-flex.flex-wrap .btn {
                width: 100%;
                max-width: 250px;
                margin: 0 auto;
            }
        }

        .carousel-item {
            transition: transform 0.6s ease-in-out;
        }

        .carousel-overlay {
            pointer-events: none;
        }

        .fa-quote-left {
            opacity: 0.7;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 0.7;
                transform: translateY(0);
            }
        }

        .bg-opacity-20 {
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-header .line {
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, transparent, #dee2e6, transparent);
        }

        .bg-gradient {
            background: linear-gradient(90deg, transparent, #6c757d, transparent);
        }

        .product-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-0.5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .product-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
        }

        .favorite-btn {
            position: absolute;
            bottom: 10px;
            left: 10px;
            z-index: 1;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .favorite-btn:hover {
            background: white;
            transform: scale(1.1);
        }

        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #dc3545;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            z-index: 1;
        }

        .map-container {
            border-radius: 12px;
            overflow: hidden;
            height: 350px;
        }

        .animate__animated {
            animation-duration: 1s;
        }

        .animate__delay-1s {
            animation-delay: 0.5s;
        }

        .backdrop-blur {
            backdrop-filter: blur(10px);
        }

        .bg-opacity-25 {
            background-color: rgba(255, 255, 255, 0.25);
        }

        @media (max-width: 768px) {
            .carousel-caption h1 {
                font-size: 1.8rem;
            }

            .carousel-image-wrapper img {
                height: 70vh;
            }

            .section-header .line {
                display: none;
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        document.addEventListener('livewire:navigated', () => {
            Livewire.on('toastr', (event) => {
                const {
                    type,
                    message
                } = event.data;
                toastr[type](message, '', {
                    closeButton: true,
                    progressBar: true,
                });
            });

            Livewire.on('closeModal', () => {
                $('#addToCart').modal('hide');
            });
        });

        @if (session('already_login'))
            const {
                title,
                type,
                message
            } = @json(session('already_login'));
            Swal.fire({
                title: title,
                icon: type,
                text: message,
                confirmButtonText: 'Ok',
                showCloseButton: true,
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
        @endif
    </script>
</div>
