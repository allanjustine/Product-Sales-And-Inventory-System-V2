<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">

    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11.0.13/dist/sweetalert2.min.css">



    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="images/mylogo.jpg">


    <title>My Web | {{ $title ?? 'Not Set' }}</title>

    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11.0.13/dist/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    @livewireStyles

    @role('admin')
    @livewire('layouts.sidebar')
    @else
    @livewire('layouts.navbar')
    @endrole
</head>

<body style="overflow-x: hidden;">
    {{ $slot ?? '' }}

    @include('sweetalert::alert')

    @livewireScripts
    @livewireScriptConfig

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

<footer class="bg-dark text-light py-4" onload="updateTime()">
    <div class="container">
        <div class="row p-2">
            <div class="col-md-4">
                <h5>AJM Company</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore
                    et dolore magna aliqua.</p>
            </div>

            <div class="col-md-4">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt"></i> Address: Tinangnan, Tubigon, Bohol - Purok 2</li>
                    <li><i class="fas fa-phone"></i> Phone: 09512072888</li>
                    <li><i class="fas fa-envelope"></i> Email: mydummy.2022.2023@gmail.com</li>
                </ul>
            </div>

            <div class="col-md-4 text-center">
                <h5>Follow Us</h5>
                <ul class="list-inline social-icons">
                    <li class="list-inline-item">
                        <a href="https://facebook.com/1down" id="facebook" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://twitter.com" id="twitter" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://youtube.com" id="youtube" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://gmail.com" id="gmail" target="_blank">
                            <i class="fab fa-google"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://instagram.com" id="instagram" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p style="font-size: 12px;" class="text-center mt-3">Current date and time: <span class="border-bottom"><span id="date"></span>
                        <span id="time"></span></span></p>
                <hr>
                <p>&copy; 2023 <strong>AJM</strong>. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<div class="back-to-top">
    <a id="button" class="btn" href="#">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>
<script>
    window.addEventListener('scroll', function() {
        var backToTopButton = document.querySelector('.back-to-top');

        if (backToTopButton) {
            if (window.scrollY > 400) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        }
    });

    document.addEventListener('livewire:init', function() {
        Livewire.on('backToTop', function() {
            window.scrollTo({
                top: 0
                , behavior: 'smooth'
            });
        });
    });

</script>

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

</html>
