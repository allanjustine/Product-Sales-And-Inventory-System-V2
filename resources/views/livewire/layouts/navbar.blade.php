<div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg" style="z-index: 1030;">
        <div class="container">
            <!-- Brand / Logo -->
            <a href="/" wire:navigate class="navbar-brand d-flex align-items-center">
                <div class="brand-logo me-2">
                    <div class="logo-circle-item">
                        <img src="images/mylogo.jpg" alt="AJM Logo" class="w-100 h-100 rounded-circle">
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-white">AJM</h3>
            </a>

            <!-- Cart & Mobile Toggle -->
            <div class="d-flex align-items-center order-lg-3">
                @if (Auth::check())
                    <livewire:normal-view.carts.cart-count />
                @endif

                <button class="navbar-toggler ms-2 border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="d-block d-md-none" data-bs-toggle="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none"
                    id="userDropdown" aria-expanded="false">
                    @if (auth()->check())
                        <div class="position-relative">
                            <div class="user-avatar">
                                <img src="{{ auth()->user()->profile_image
                                    ? Storage::url(auth()->user()->profile_image)
                                    : 'https://cdn-icons-png.flaticon.com/512/2919/2919906.png' }}"
                                    alt="{{ auth()->user()->name }}" class="rounded-circle">
                                <span class="user-status bg-success"></span>
                            </div>
                        </div>
                        <div class="d-none d-lg-block ms-2">
                            <div class="text-white fw-medium">{{ auth()->user()->name }}</div>
                            <small class="text-white-50">{{ auth()->user()->role }}</small>
                        </div>
                    @else
                        <div class="d-flex align-items-center">
                            <div class="user-avatar">
                                <div class="avatar-placeholder rounded-circle">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            </div>
                            <div class="d-none d-lg-block ms-2">
                                <div class="text-white fw-medium">Welcome</div>
                                <small class="text-white-50">Guest</small>
                            </div>
                        </div>
                    @endif
                </a>
            </div>

            <!-- Main Navigation -->
            <div class="collapse navbar-collapse order-lg-2" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <!-- Home -->
                    <li class="nav-item mx-2">
                        <a wire:navigate class="nav-link d-flex flex-column align-items-center py-3" href="/">
                            <i class="fas fa-home fa-lg mb-1"></i>
                            <span class="small">Home</span>
                        </a>
                    </li>

                    <!-- About Us -->
                    <li class="nav-item mx-2">
                        <a wire:navigate class="nav-link d-flex flex-column align-items-center py-3" href="/about-us">
                            <i class="fas fa-info-circle fa-lg mb-1"></i>
                            <span class="small">About</span>
                        </a>
                    </li>

                    <!-- Products -->
                    <li class="nav-item mx-2">
                        @if (auth()->check())
                            <a wire:navigate class="nav-link d-flex flex-column align-items-center py-3"
                                href="/products">
                                <i class="fas fa-box-open fa-lg mb-1"></i>
                                <span class="small">Products</span>
                            </a>
                        @else
                            <a wire:navigate class="nav-link d-flex flex-column align-items-center py-3"
                                href="/product-lists">
                                <i class="fas fa-box-open fa-lg mb-1"></i>
                                <span class="small">Products</span>
                            </a>
                        @endif
                    </li>

                    <!-- User Only Links -->
                    @role('user')
                        <li class="nav-item mx-2">
                            <a wire:navigate class="nav-link d-flex flex-column align-items-center py-3" href="/orders">
                                <i class="fas fa-shopping-bag fa-lg mb-1"></i>
                                <span class="small">Orders</span>
                            </a>
                        </li>

                        <li class="nav-item mx-2">
                            <a wire:navigate class="nav-link d-flex flex-column align-items-center py-3" href="/carts">
                                <i class="fas fa-shopping-cart fa-lg mb-1"></i>
                                <span class="small">Cart</span>
                            </a>
                        </li>

                        <li class="nav-item mx-2">
                            <a wire:navigate class="nav-link d-flex flex-column align-items-center py-3" href="/favorites">
                                <i class="fas fa-heart fa-lg mb-1"></i>
                                <span class="small">Favorites</span>
                            </a>
                        </li>
                    @endrole

                    <!-- Feedback -->
                    <li class="nav-item mx-2">
                        <a wire:navigate class="nav-link d-flex flex-column align-items-center py-3" href="/feedbacks">
                            <i class="fas fa-comment-dots fa-lg mb-1"></i>
                            <span class="small">Feedback</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- User Profile Dropdown -->
            <div class="dropdown order-lg-4 ms-lg-3">
                <div class="d-none d-md-block" data-bs-toggle="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none"
                        id="userDropdown" aria-expanded="false">
                        @if (auth()->check())
                            <div class="position-relative">
                                <div class="user-avatar">
                                    <img src="{{ auth()->user()->profile_image
                                        ? Storage::url(auth()->user()->profile_image)
                                        : 'https://cdn-icons-png.flaticon.com/512/2919/2919906.png' }}"
                                        alt="{{ auth()->user()->name }}" class="rounded-circle">
                                    <span class="user-status bg-success"></span>
                                </div>
                            </div>
                            <div class="d-none d-lg-block ms-2">
                                <div class="text-white fw-medium">{{ auth()->user()->name }}</div>
                                <small class="text-white-50">{{ auth()->user()->role }}</small>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                <div class="user-avatar">
                                    <div class="avatar-placeholder rounded-circle">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div class="d-none d-lg-block ms-2">
                                    <div class="text-white fw-medium">Welcome</div>
                                    <small class="text-white-50">Guest</small>
                                </div>
                            </div>
                        @endif
                    </a>
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2"
                    style="min-width: 300px;" aria-labelledby="userDropdown">
                    @if (auth()->check())
                        <!-- Profile Header -->
                        <li>
                            <div class="dropdown-header p-3 bg-primary bg-opacity-10">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-3">
                                        <img src="{{ auth()->user()->profile_image
                                            ? Storage::url(auth()->user()->profile_image)
                                            : 'https://cdn-icons-png.flaticon.com/512/2919/2919906.png' }}"
                                            alt="{{ auth()->user()->name }}" class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ auth()->user()->name }}</h6>
                                        <small class="text-white">{{ auth()->user()->email }}</small>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider my-2">
                        </li>

                        <!-- Profile Link -->
                        <li>
                            <a wire:navigate class="dropdown-item py-3" href="/profile">
                                <i class="fas fa-user-circle me-3 text-primary"></i>
                                <span>My Profile</span>
                            </a>
                        </li>

                        <!-- Admin Links -->
                        @role('admin')
                            <li>
                                <a wire:navigate class="dropdown-item py-3" href="/admin/dashboard">
                                    <i class="fas fa-tachometer-alt me-3 text-warning"></i>
                                    <span>Admin Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a wire:navigate class="dropdown-item py-3" href="/admin/orders">
                                    <i class="fas fa-clipboard-list me-3 text-info"></i>
                                    <span>User Orders</span>
                                </a>
                            </li>
                        @endrole

                        <!-- User Links -->
                        @role('user')
                            <li>
                                <a wire:navigate class="dropdown-item py-3" href="/carts">
                                    <i class="fas fa-shopping-cart me-3 text-success"></i>
                                    <span>My Cart</span>
                                </a>
                            </li>
                            <li>
                                <a wire:navigate class="dropdown-item py-3" href="/orders">
                                    <i class="fas fa-shopping-bag me-3 text-primary"></i>
                                    <span>My Orders</span>
                                </a>
                            </li>
                            <li>
                                <a wire:navigate class="dropdown-item py-3" href="/favorites">
                                    <i class="fas fa-heart me-3 text-danger"></i>
                                    <span>My Favorites</span>
                                </a>
                            </li>
                        @endrole

                        <li>
                            <hr class="dropdown-divider my-2">
                        </li>

                        <!-- Logout -->
                        <li>
                            <a class="dropdown-item py-3 text-danger" href="#" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">
                                <i class="fas fa-sign-out-alt me-3"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    @else
                        <!-- Guest Links -->
                        <li>
                            <div class="dropdown-header p-3 bg-light">
                                <h6 class="fw-bold mb-0">Welcome Visitor</h6>
                                <small class="text-muted">Sign in to access more features</small>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider my-2">
                        </li>

                        <li>
                            <a wire:navigate class="dropdown-item py-3" href="/login">
                                <i class="fas fa-sign-in-alt me-3 text-primary"></i>
                                <span>Login</span>
                            </a>
                        </li>
                        <li>
                            <a wire:navigate class="dropdown-item py-3" href="/register">
                                <i class="fas fa-user-plus me-3 text-success"></i>
                                <span>Register</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <!-- Modal Header -->
                <div class="modal-header border-bottom-0 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="modal-icon bg-danger bg-opacity-10 text-danger rounded-circle p-2 me-3">
                            <i class="fas fa-sign-out-alt fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="modal-title text-white fw-bold" id="logoutModalLabel">Confirm Logout</h5>
                            <p class="text-white mb-0">Are you sure you want to sign out?</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body py-4">
                    <div class="alert alert-warning border-0">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                            <div>
                                <p class="mb-0">You will be redirected to the login page.</p>
                                <small class="text-muted">Make sure to save any unsaved changes.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" wire:click="logout" wire:loading.attr="disabled"
                        class="btn btn-danger px-4">
                        <span wire:loading.remove wire:target="logout">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </span>
                        <span wire:loading wire:target="logout">
                            <span class="spinner-border spinner-border-sm me-2"></span>
                            Logging out...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        /* Navigation */
        .navbar {
            padding: 0.5rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            padding: 0;
        }

        /* Logo */
        .logo-circle-item {
            width: 50px;
            height: 50px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .logo-circle-item:hover {
            border-color: #0d6efd;
            transform: scale(1.05);
        }

        /* Navigation Links */
        .navbar-nav .nav-link {
            position: relative;
            color: rgba(255, 255, 255, 0.8) !important;
            transition: all 0.3s ease;
            border-radius: 8px;
            min-width: 70px;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active2 {
            color: white !important;
            background: rgba(13, 110, 253, 0.2);
        }

        .navbar-nav .nav-link.active2::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background: #0d6efd;
            border-radius: 50%;
        }

        /* User Avatar */
        .user-avatar {
            position: relative;
            width: 40px;
            height: 40px;
        }

        .user-avatar img,
        .avatar-placeholder {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .avatar-placeholder {
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-status {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            border: 2px solid #212529;
            border-radius: 50%;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: 1px solid rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-header {
            border-radius: 8px 8px 0 0;
        }

        /* Modal */
        .modal-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Cart Badge */
        .cart-badge {
            position: relative;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .navbar-nav {
                text-align: center;
                padding: 1rem 0;
            }

            .navbar-nav .nav-item {
                margin: 0.25rem 0;
            }

            .navbar-nav .nav-link {
                justify-content: center;
                min-width: auto;
                padding: 0.75rem !important;
            }

            .dropdown-menu {
                margin-top: 0.5rem;
            }

            .logo-circle-item {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand h3 {
                font-size: 1.5rem;
            }

            .dropdown-menu {
                position: fixed !important;
                top: 80px !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
                width: 100% !important;
                max-width: 300px;
            }
        }

        /* Button Styles */
        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }

        /* Active page indicator */
        .nav-link i {
            transition: all 0.3s ease;
        }

        .nav-link:hover i {
            transform: scale(1.1);
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Active link detection
        document.addEventListener('livewire:navigated', function() {
            const links = document.querySelectorAll('.nav-link');
            const currentPath = window.location.pathname;

            links.forEach(link => {
                // Remove active class from all links
                link.classList.remove('active2');

                // Check if this link matches current path
                const linkPath = link.getAttribute('href');
                if (linkPath === currentPath ||
                    (currentPath.startsWith('/admin') && linkPath === '/admin/dashboard') ||
                    (currentPath.startsWith('/products') && linkPath === '/products')) {
                    link.classList.add('active2');
                }
            });

            // Update document title based on active page
            const activeLink = document.querySelector('.nav-link.active2');
            if (activeLink) {
                const pageName = activeLink.querySelector('span')?.textContent || 'AJM Store';
                document.title = `${pageName} - AJM Store`;
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const dropdownMenu = dropdown?.nextElementSibling;

            if (dropdown && !dropdown.contains(event.target) && dropdownMenu && !dropdownMenu.contains(event
                    .target)) {
                if (dropdownMenu.classList.contains('show')) {
                    const bsDropdown = bootstrap.Dropdown.getInstance(dropdown);
                    bsDropdown?.hide();
                }
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '0.25rem 0';
                navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.3)';
            } else {
                navbar.style.padding = '0.5rem 0';
                navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
            }
        });

        // Bootstrap tooltip for user dropdown on mobile
        document.addEventListener('livewire:navigated', function() {
            const userDropdown = document.getElementById('userDropdown');
            if (window.innerWidth < 992) {
                userDropdown.setAttribute('title', 'Account Menu');
                new bootstrap.Tooltip(userDropdown);
            }
        });
    </script>
</div>
