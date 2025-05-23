<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="max-height: 100vh; overflow-y: auto;">
        <a wire:navigate href="/admin/dashboard" class="brand-link">
            <img src="/images/mylogo.jpg" alt="AJM logo" class="brand-image img-circle elevation-0"
                style="opacity: .8; border-radius: 50%;">
            <span class="brand-text"><strong id="branding-ajm">AJM</strong></span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img id="sidebar-img" src="{{ Auth::user()->profile_image === null ? "
                        https://cdn-icons-png.flaticon.com/512/2919/2919906.png" :
                        Storage::url(Auth::user()->profile_image)
                    }}" class="img-circle elevation-2" alt="User
                    Image"
                    style="border-radius: 50%; width: 40px; height: 40px;">
                </div>
                <div class="info">
                    <a wire:navigate href="/profile" class="d-block">Welcome, {{ Auth::user()->name }}</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" role="menu">
                    <li class="nav-item">
                        <a wire:navigate href="/admin/dashboard" class="nav-link">
                            <i class="nav-icon fa-solid fa-gauge-max"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a wire:navigate href="/admin/users" class="nav-link">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>
                                Users
                            </p>

                            @if ($usersCount > 0)
                            <span class="right badge badge-info">{{ $usersCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-header">ORDERS MANAGEMENT</li>
                    <li x-data="{ open: window.location.pathname === '/admin/orders' || window.location.pathname === '/admin/product-sales' }"
                        class="nav-item" x-bind:class="{ 'menu-open': open }">
                        <a href="#" @click="open = !open" class="nav-link">
                            <i class="nav-icon fa-solid fa-hand-pointer"></i>
                            <p>
                                Order Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" x-cloak x-show="open" x-transition>
                            <li class="nav-item">
                                <a wire:navigate href="/admin/orders" class="nav-link">
                                    <i class="nav-icon fa-solid fa-bag-shopping"></i>
                                    <p>
                                        Users Order
                                        <span class="right badge badge-info"></span>
                                    </p>
                                    @if ($ordersCount > 0)
                                    <span class="right badge badge-info">{{ $ordersCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a wire:navigate href="/admin/product-sales" class="nav-link">
                                    <i class="nav-icon fa-solid fa-database"></i>
                                    <p>
                                        Product Sales
                                        <span class="right badge badge-info"></span>
                                    </p>
                                    @if ($productSalesCount > 0)
                                    <span class="right badge badge-info">{{ $productSalesCount }}</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">PRODUCT MANAGEMENT</li>
                    <li x-data="{ open: window.location.pathname === '/admin/products' || window.location.pathname === '/admin/product-categories' }"
                        class="nav-item" x-bind:class="{ 'menu-open': open }">
                        <a href="#" class="nav-link" @click="open = !open">
                            <i class="nav-icon fa-solid fa-hand-pointer"></i>
                            <p>
                                Product Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" x-cloak x-show="open" x-transition>
                            <li class="nav-item">
                                <a wire:navigate href="/admin/products" class="nav-link">
                                    <i class="nav-icon fa-solid fa-box-open"></i>
                                    <p>Products</p>
                                    @if ($productsCount > 0)
                                    <span class="right badge badge-info">{{ $productsCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a wire:navigate href="/admin/product-categories" class="nav-link">
                                    <i class="nav-icon fa-solid fa-list"></i>
                                    <p>Product Categories</p>
                                    @if ($categoriesCount)
                                    <span class="right badge badge-info">{{ $categoriesCount }}</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">PAGE MANAGEMENT</li>
                    {{-- <li class="nav-item">
                        <a wire:navigate href="/admin/about"
                            class="nav-link {{ 'admin/about' == request()->path() ? 'active2' : '' }}">
                            <i class="nav-icon fa-solid fa-question"></i>
                            <p>
                                About
                            </p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a wire:navigate href="/admin/feedbacks" class="nav-link">
                            <i class="nav-icon fa-solid fa-comments"></i>
                            <p>
                                Feed Backs
                            </p>
                            @if ($feedbacks > 0)
                            <span class="right badge badge-info">{{ $feedbacks }}</span>
                            @endif
                        </a>
                    </li>
                    {{-- <li class="nav-item menu-close">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-list"></i>
                            <p>
                                List
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    <li class="nav-header">SETTING MANAGEMENT</li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-gear"></i>
                            <p>
                                Settings
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <span class="nav-link">
                                    <i class="nav-icon fa-solid fa-moon nav-icon"></i>
                                    <p>Switch to Dark Mode</p>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">
                                    <i class="nav-icon fa-solid fa-sun"></i>
                                    <p>
                                        <label class="theme-switch" for="checkbox">
                                            <input type="checkbox" id="checkbox" />
                                            <span class="slider round"></span>
                                        </label>
                                        <i class="nav-icon fa-solid fa-moon"></i>
                                    </p>
                                </span>
                            </li>
                            <li class="nav-item">
                                <a wire:navigate href="/profile" class="nav-link">
                                    <i class="fa-solid fa-user nav-icon"></i>
                                    <p>My Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#logout">
                                    <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <nav class="main-header navbar navbar-expand navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-3">
                <a class="nav-link pr-0" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa-solid fa-mug-hot mr-2"></i>{{ Auth::user()->name }} </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 10px;">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0" style="text-align: left;">Welcome! {{ Auth::user()->name
                            }}
                        </h6>
                    </div>
                    <a wire:navigate href="/profile" class="dropdown-item">
                        <i class="fa fa-user mr-2"></i>
                        <span>My profile</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to logout?</h4>
                    <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    After you logout you will redirect to login page.
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="logout" class="btn btn-danger" wire:target='logout'
                        wire:loading.attr='disabled'>
                        <span wire:target='logout' wire:loading.remove><i
                                class="fa-solid fa-arrow-right-from-bracket"></i>Yes, Logout</span>
                        <span wire:target='logout' wire:loading><span class="spinner-border spinner-border-sm"></span>
                            Logging out...</span>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const links = document.querySelectorAll('.nav-link');

            links.forEach(link => {
                if(link.getAttribute('href') === window.location.pathname) {
                    link.classList.add('active2');
                }
            })
        });
    </script>
</div>
