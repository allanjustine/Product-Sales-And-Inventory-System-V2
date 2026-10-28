<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJM Store | {{ $title ?? 'Not Set' }}</title>
    <meta property="og:title" content="AJM Store | {{ $title ?? 'Not Set' }}">
    <meta name="author" content="Allan Justine Mascariñas" />
    <meta property="og:description"
        content="A powerful, real-time eCommerce platform designed for simplicity and speed. Seamlessly manage products, process orders, and track inventory with instant updates. Whether you're a small business or a growing enterprise, our user-friendly interface makes online selling effortless — no technical expertise required.">
    <meta property="og:image" content="https://store.ajmapp.online/images/slide1.jpg">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="AJM E-Commerce Web App">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.13/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://adminlte.io/docs/3.2/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet"
        href="https://adminlte.io/docs/3.2/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://adminlte.io/docs/3.2/assets/css/docs.css">
    <link rel="stylesheet" href="https://adminlte.io/docs/3.2/assets/css/highlighter.css">
    <link rel="stylesheet" href="https://adminlte.io/docs/3.2/assets/css/adminlte.min.css">
    <script data-navigate-once src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    @livewireStyles
</head>

<body style="overflow-x: hidden;">

    @role('admin')
        <div class="wrapper" style="max-height: 100vh; overflow-y: hidden;">
            {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <div class="ring">Loading
                <span class="ring2"></span>
            </div>
        </div> --}}

            @livewire('layouts.sidebar')
            <div class="content-wrapper px-4 py-2" style="max-height: 84vh; overflow-y: auto;">
                <div class="content-header">
                    <h1>
                        {{ $title ?? 'No title' }}
                    </h1>
                </div>
                <hr>
                <div class="content px-2">
                    {{ $slot ?? '' }}
                </div>
            </div>
            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline text-sm">
                    <span id="date"></span>
                    <span id="time"></span></span>
                </div>
                <strong>Copyright &copy; {{ now()->year }} <a href="https://facebook.com/1down" target="_blank">Allan
                        Justine
                        Mascariñas</a>.</strong> All rights
                reserved.
            </footer>
        </div>
    @else
        @if (!request()->is('verification/*/*'))
            @livewire('layouts.navbar')
        @endif
        {{ $slot ?? '' }}
    @endrole

    <script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script data-navigate-once src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.13/dist/sweetalert2.min.js"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script data-navigate-once src="https://adminlte.io/docs/3.2/assets/plugins/jquery/jquery.min.js"></script>
    <script data-navigate-once src="https://adminlte.io/docs/3.2/assets/plugins/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <script data-navigate-once
        src="https://adminlte.io/docs/3.2/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script data-navigate-once src="https://adminlte.io/docs/3.2/assets/js/adminlte.min.js"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @livewireScripts
    @livewireScriptConfig

</body>

@unlessrole('admin')
    <livewire:layouts.footer />
@endunlessrole

<div class="back-to-top">
    <button type="button" id="button" onclick="backToTop()" class="btn">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
</div>
<script>
    document.addEventListener('livewire:navigated', function() {
        const backToTopButton = document.getElementById('button');

        window.addEventListener('scroll', function() {
            if (backToTopButton) {
                if (window.scrollY > 400) {
                    backToTopButton.style.bottom = window.innerWidth > 770 ? "30px" : "70px";
                } else {
                    backToTopButton.style.bottom = "-50px";
                }
            }
        });

        if (window.pageYOffset > 400) {
            backToTopButton.style.bottom = window.innerWidth > 770 ? "30px" : "70px";
        } else {
            backToTopButton.style.bottom = "-50px";
        }
    });
</script>

<script>
    function backToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>

<script>
    function updateTime() {
        var now = new Date();
        var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var monthsOfYear = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
            "October", "November", "December"
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



<script>
    document.addEventListener('livewire:navigated', function() {
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
    })
</script>
@include('partials.preloader')

<script>
    document.addEventListener('livewire:navigated', () => {
        const el = document.getElementById('pre-loader-normal');

        if (el) {
            el.remove();
        }
    });
</script>

<style>
    html,
    body {
        width: 100%;
        min-height: 100%;
        height: 100vh !important;
        margin: 0;
    }

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

    .company-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
    }

    .social-icon {
        position: relative;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .social-icon .icon-wrapper {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    @media (max-width: 300px) {
        .social-icon .icon-wrapper {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
    }

    .social-icon:hover .icon-wrapper {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .social-icon.facebook:hover .icon-wrapper {
        background: linear-gradient(135deg, #1877f2, #0d5cba) !important;
    }

    .social-icon.twitter:hover .icon-wrapper {
        background: linear-gradient(135deg, #1da1f2, #0d8bd9) !important;
    }

    .social-icon.youtube:hover .icon-wrapper {
        background: linear-gradient(135deg, #ff0000, #cc0000) !important;
    }

    .social-icon.instagram:hover .icon-wrapper {
        background: linear-gradient(135deg, #e4405f, #c13584) !important;
    }

    .social-icon.tiktok:hover .icon-wrapper {
        background: linear-gradient(135deg, #271f1e, #050505) !important;
    }

    .social-icon:hover i {
        color: white !important;
    }

    .time-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(13, 110, 253, 0.2) !important;
        transition: all 0.3s ease;
    }

    .time-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(13, 110, 253, 0.1);
        border-color: rgba(13, 110, 253, 0.4) !important;
    }

    .contact-item {
        transition: transform 0.3s ease;
    }

    .contact-item:hover {
        transform: translateX(5px);
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .footer-links a {
        position: relative;
        padding-bottom: 2px;
    }

    .footer-links a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 1px;
        background: #0d6efd;
        transition: width 0.3s ease;
    }

    .footer-links a:hover {
        color: #0d6efd !important;
    }

    .footer-links a:hover::after {
        width: 100%;
    }
</style>

<script>
    function updateTime() {
        var now = new Date();
        var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var monthsOfYear = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
            "October", "November", "December"
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

<script>
    toastr.options = {
        "preventDuplicates": true,
        "preventOpenDuplicates": true,
    };
</script>

</html>
