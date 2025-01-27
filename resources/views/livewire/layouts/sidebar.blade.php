<div>
    <div class="wrapper">
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <div class="ring">Loading
                <span class="ring2"></span>
            </div>
        </div> --}}
        <nav class="main-header navbar navbar-expand navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-mug-hot mr-2"></i>{{ Auth::user()->name }} </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right mr-3">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0" style="text-align: left;">Welcome! {{ Auth::user()->name }}
                            </h6>
                        </div>
                        <a href="/admin/profile" class="dropdown-item">
                            <i class="fa fa-user mr-2"></i>
                            <span>My profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logout">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/admin/dashboard" class="brand-link">
                <img src="/images/mylogo.jpg" alt="AJM logo" class="brand-image img-circle elevation-0" style="opacity: .8; border-radius: 50%;">
                <span class="brand-text"><strong id="branding-ajm">AJM</strong></span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img id="sidebar-img" src="{{ Auth::user()->profile_image === null ? Storage::url('asset/profile-pic.jpg') : Storage::url(Auth::user()->profile_image) }}" class="img-circle elevation-2" alt="User Image" style="border-radius: 50%; width: 40px; height: 40px;">
                    </div>
                    <div class="info">
                        <a href="/admin/profile" class="d-block">Welcome, {{ Auth::user()->name }}</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="/admin/dashboard" class="nav-link {{ 'admin/dashboard' == request()->path() ? 'active2' : '' }}">
                                <i class="nav-icon fa-solid fa-gauge-max"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/users" class="nav-link {{ 'admin/users' == request()->path() ? 'active2' : '' }}">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>
                                    Users
                                </p>

                                <span class="right badge badge-info">{{ $usersCount }}</span>
                            </a>
                        </li>
                        <li class="nav-header">ORDERS MANAGEMENT</li>
                        <li class="nav-item {{ in_array(request()->path(), ['admin/orders', 'admin/product-sales']) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-hand-pointer"></i>
                                <p>
                                    Order Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/orders" class="nav-link {{ 'admin/orders' == request()->path() ? 'active2' : '' }}">
                                        <i class="nav-icon fa-solid fa-bag-shopping"></i>
                                        <p>
                                            Users Order
                                            <span class="right badge badge-info"></span>
                                        </p>
                                        <span class="right badge badge-info">{{ $ordersCount }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/product-sales" class="nav-link {{ 'admin/product-sales' == request()->path() ? 'active2' : '' }}">
                                        <i class="nav-icon fa-solid fa-database"></i>
                                        <p>
                                            Product Sales
                                            <span class="right badge badge-info"></span>
                                        </p>
                                        <span class="right badge badge-info">{{ $productSalesCount }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">PRODUCT MANAGEMENT</li>
                        <li class="nav-item {{ in_array(request()->path(), ['admin/products', 'admin/product-categories']) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-hand-pointer"></i>
                                <p>
                                    Product Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/products" class="nav-link {{ 'admin/products' == request()->path() ? 'active2' : '' }}">
                                        <i class="nav-icon fa-solid fa-box-open"></i>
                                        <p>Products</p>
                                        <span class="right badge badge-info">{{ $productsCount }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/product-categories" class="nav-link {{ 'admin/product-categories' == request()->path() ? 'active2' : '' }}">
                                        <i class="nav-icon fa-solid fa-list"></i>
                                        <p>Product Categories</p>
                                        <span class="right badge badge-info">{{ $categoriesCount }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">PAGE MANAGEMENT</li>
                        {{-- <li class="nav-item">
                            <a href="/admin/about"
                                class="nav-link {{ 'admin/about' == request()->path() ? 'active2' : '' }}">
                        <i class="nav-icon fa-solid fa-question"></i>
                        <p>
                            About
                        </p>
                        </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="/admin/feedbacks" class="nav-link {{ 'admin/feedbacks' == request()->path() ? 'active2' : '' }}">
                                <i class="nav-icon fa-solid fa-comments"></i>
                                <p>
                                    Feed Backs
                                </p>
                                <span class="right badge badge-info">{{ $feedbacks }}</span>
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
                                    <i class="right fas fa-angle-left"></i>
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
                                    <a href="profile/" class="nav-link {{ 'admin/profile' == request()->path() ? 'active2' : '' }}">
                                        <i class="fa-solid fa-user nav-icon"></i>
                                        <p>My Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-toggle="modal" data-target="#logout">
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
        <div class="content-wrapper px-4 py-2">
            <div class="content-header">
                @yield('content-header')
            </div>
            <hr>
            <div class="content px-2">

                @yield('content')

            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                <span id="date"></span>
                <span id="time"></span></span>
            </div>
            <strong>Copyright &copy; 2023-2024 <a href="https://facebook.com/1down" target="_blank">Allan Justine
                    Mascariñas</a>.</strong> All rights
            reserved.
        </footer>
    </div>

    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to logout?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    After you logout you will redirect to login page.
                </div>
                <div class="modal-footer">
                    <a href="/logout" class="btn btn-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i>Yes,
                        Logout</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var toggleSwitch = document.querySelector('.theme-switch #checkbox[type="checkbox"]');
        var currentTheme = localStorage.getItem('theme');
        var mainHeader = document.querySelector('.main-header');

        if (currentTheme) {
            if (currentTheme === 'dark') {
                if (!document.body.classList.contains('dark-mode')) {
                    document.body.classList.add("dark-mode");
                }
                if (mainHeader.classList.contains('navbar-light')) {
                    mainHeader.classList.add('navbar-dark');
                    mainHeader.classList.remove('navbar-light');
                }
                toggleSwitch.checked = true;
            }
        }

        function switchTheme(e) {
            if (e.target.checked) {
                if (!document.body.classList.contains('dark-mode')) {
                    document.body.classList.add("dark-mode");
                }
                if (mainHeader.classList.contains('navbar-light')) {
                    mainHeader.classList.add('navbar-dark');
                    mainHeader.classList.remove('navbar-light');
                }
                localStorage.setItem('theme', 'dark');
            } else {
                if (document.body.classList.contains('dark-mode')) {
                    document.body.classList.remove("dark-mode");
                }
                if (mainHeader.classList.contains('navbar-dark')) {
                    mainHeader.classList.add('navbar-light');
                    mainHeader.classList.remove('navbar-dark');
                }
                localStorage.setItem('theme', 'light');
            }
        }

        toggleSwitch.addEventListener('change', switchTheme, false);

    </script>


    <style>
        .theme-switch {
            position: relative;
            width: 40px;
            height: 20px;
            margin: 0;
        }

        .theme-switch #checkbox[type="checkbox"] {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        #checkbox[type="checkbox"]:checked+.slider {
            background-color: #2196F3;
        }

        #checkbox[type="checkbox"]:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        #checkbox[type="checkbox"]:checked+.slider:before {
            transform: translateX(20px);
        }

        .ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150px;
            height: 150px;
            background: transparent;
            border: 3px solid #3c3c3c;
            border-radius: 50%;
            text-align: center;
            line-height: 150px;
            font-family: sans-serif;
            font-size: 20px;
            color: #fff000;
            letter-spacing: 4px;
            text-transform: uppercase;
            text-shadow: 0 0 10px #fff000;
            box-shadow: 0 0 20px rgba(0, 0, 0, .5);
        }

        .ring:before {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            width: 100%;
            height: 100%;
            border: 3px solid transparent;
            border-top: 3px solid #fff000;
            border-right: 3px solid #fff000;
            border-radius: 50%;
            animation: animateC 2s linear infinite;
        }

        .ring2 {
            display: block;
            position: absolute;
            top: calc(50% - 2px);
            left: 50%;
            width: 50%;
            height: 4px;
            background: transparent;
            transform-origin: left;
            animation: animate 2s linear infinite;
        }

        .ring2:before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #fff000;
            top: -6px;
            right: -8px;
            box-shadow: 0 0 20px #fff000;
        }

        @keyframes animateC {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes animate {
            0% {
                transform: rotate(45deg);
            }

            100% {
                transform: rotate(405deg);
            }
        }

        .active2 {
            background-color: #597da0 !important;
            color: whitesmoke !important;
        }

        #branding-ajm {
            background-image: linear-gradient(-320deg, #64e764, #5151d6, cyan);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

    </style>

    <script>
        function updateTime() {
            var now = new Date();
            var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            var monthsOfYear = ["January", "February", "March", "April", "May", "June", "July", "August", "September"
                , "October", "November", "December"
            ];
            var dayOfWeek = daysOfWeek[now.getDay()];
            var month = monthsOfYear[now.getMonth()];
            var dayOfMonth = now.getDate();
            var year = now.getFullYear();
            var dateString = dayOfWeek + " - " + month + " " + dayOfMonth + ", " + year;
            var timeString = now.toLocaleTimeString();
            document.getElementById("date").innerHTML = dateString;
            document.getElementById("time").innerHTML = timeString;
        }
        setInterval(updateTime, 1000);

    </script>
</div>
