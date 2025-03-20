<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark shadow">
        <h1 class="ms-5">
            <strong id="branding-ajm">AJM</strong>
        </h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mx-auto p-3 navbar-nav-item">
                <li class="nav-item p-2">
                    <a wire:navigate
                        class="nav-link text-white text-center {{ '/' == request()->path() ? 'active2' : '' }}"
                        href="/"><i class="fa-light fa-house"></i> Home</a>
                </li>
                <li class="nav-item p-2">
                    <a wire:navigate
                        class="nav-link text-white text-center {{ 'about-us' == request()->path() ? 'active2' : '' }}"
                        href="/about-us"><i class="fa-light fa-question"></i> About Us</a>
                </li>
                @if (auth()->check())
                <li class="nav-item p-2">
                    <a wire:navigate
                        class="nav-link text-white text-center {{ 'products' == request()->path() ? 'active2' : '' }}"
                        href="/products"><i class="fa-light fa-box-open"></i> Products</a>
                </li>
                @role('user')
                <li class="nav-item p-2">
                    <a wire:navigate
                        class="nav-link text-white text-center {{ 'orders' == request()->path() ? 'active2' : '' }}"
                        href="/orders"><i class="fa-light fa-bag-shopping"></i> My Orders</a>
                </li>
                <li class="nav-item p-2">
                    <a wire:navigate
                        class="nav-link text-white text-center {{ 'carts' == request()->path() ? 'active2' : '' }}"
                        href="/carts"><i class="fa-light fa-shopping-cart"></i> My Carts</a>
                </li>
                <li class="nav-item p-2">
                    <a wire:navigate
                        class="nav-link text-white text-center {{ 'favorites' == request()->path() ? 'active2' : '' }}"
                        href="/favorites"><i class="fa-light fa-heart"></i> My Favorites</a>
                </li>
                @endrole
                @else
                <li class="nav-item p-2">
                    <a wire:navigate
                        class="nav-link text-white text-center {{ 'view-products' == request()->path() ? 'active2' : '' }}"
                        href="/view-products"><i class="fa-light fa-box-open"></i> View Products</a>
                </li>
                @endif
                <li class="nav-item p-2">
                    <a wire:navigate
                        class="nav-link text-white text-center {{ 'feedbacks' == request()->path() ? 'active2' : '' }}"
                        href="/feedbacks"><i class="fa-light fa-comment-dots"></i> Your Feedback</a>
                </li>
            </ul>
            <div class="dropdown me-5">
                <a href="#" class="nav-link text-white text-center profile-dropdown ms-5" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (auth()->check())
                    <div class="outline mx-auto"
                        style="width: 48px; height: 50px; border-radius: 50%; border: 2px solid white;">
                        <img style="width: 45px; height: 45px; border-radius: 50%;"
                            src="{{ auth()->user()->profile_image === null ? "
                            https://cdn-icons-png.flaticon.com/512/2919/2919906.png" :
                            Storage::url(auth()->user()->profile_image) }}" alt="{{ auth()->user()->name }}">
                    </div>
                    @else
                    <h6>
                        <i class="fa-light fa-hand-wave"></i> Welcome, Visitors
                    </h6>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" id="dropdown-setting"
                    aria-labelledby="dropdownMenuButton">
                    @if (auth()->check())
                    <a wire:navigate class="nav-link" href="/profile">
                        <div class="d-flex flex-column align-items-center">
                            <div class="outline mb-3"
                                style="width: 45px; height: 46px; border-radius: 50%; border: 2px solid white;">
                                <img style="width: 41px; height: 41px; border-radius: 50%;"
                                    src="{{ auth()->user()->profile_image === null ? "
                                    https://cdn-icons-png.flaticon.com/512/2919/2919906.png" :
                                    Storage::url(auth()->user()->profile_image) }}" alt="{{ auth()->user()->name }}">
                            </div>
                            <div class="text-center">
                                <span class="text-white">Profile</span><br>
                                <span>{{ auth()->user()->name }}</span><br>
                                <span>{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    @role('admin')
                    <a wire:navigate class="nav-link p-3" href="/admin/dashboard"><i
                            class="fa-light fa-user-lock"></i>&nbsp;
                        <span>Admin Dashboard</span></a>
                    <div class="dropdown-divider"></div>
                    <a wire:navigate class="nav-link p-3" href="/admin/orders"><i
                            class="fa-light fa-bag-shopping"></i>&nbsp;
                        <span>Users Order</span></a>
                    <div class="dropdown-divider"></div>
                    @endrole
                    @role('user')
                    <a wire:navigate class="nav-link p-3" href="/carts">
                        <i class="fa-light fa-shopping-cart"></i>&nbsp;
                        <span>My Carts</span></a>
                    <div class="dropdown-divider"></div>
                    <a wire:navigate class="nav-link p-3" href="/orders">
                        <i class="fa-light fa-bag-shopping"></i>&nbsp;
                        <span>My Orders</span></a>
                    <div class="dropdown-divider"></div>
                    <a wire:navigate class="nav-link p-3" href="/favorites">
                        <i class="fa-light fa-heart"></i>&nbsp;
                        <span>My Favorites</span></a>
                    <div class="dropdown-divider"></div>
                    @endrole
                    <a class="nav-link p-3" href="#" data-bs-toggle="modal" data-bs-target="#logout"><i
                            class="fa-light fa-right-from-bracket"></i>&nbsp;
                        <span>Logout</span></a>
                    @else
                    <a wire:navigate class="nav-link p-3" href="/login"><i
                            class="fa-light fa-right-to-bracket"></i>&nbsp;
                        <span>Login</span></a>
                    <div class="dropdown-divider"></div>
                    <a wire:navigate class="nav-link p-3" href="/register"><i class="fa-light fa-user-plus"></i>&nbsp;
                        <span>Register</span></a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logoutLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to logout?</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    After you logout you will redirect to login page.
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="logout" class="btn btn-danger"><i
                            class="fa-solid fa-arrow-right-from-bracket"></i>Yes, Logout</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal-backdrop {
            z-index: 1 !important;
        }
    </style>
</div>
