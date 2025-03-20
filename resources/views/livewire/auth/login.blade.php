<div>
    @livewire('auth.forgot-password')
    @livewire('auth.resend-email')
    <div class="container mb-5">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card-img-top d-flex justify-content-center align-items-center mb-3">
                <div class="overflow-hidden" style="width: 150px; height: 150px;">
                    <img src="images/mylogo.jpg" class="w-100 h-100" alt="Login Image">
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center">Login &nbsp;
                        <span class="position-relative">
                            <span style="cursor: pointer;"
                                class="position-absolute bottom-0 translate-middle badge rounded-pill bg-dark"
                                id="login-pill">
                                <i class="fa-solid fa-question" wire:ignore.self data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Login to continue the website"></i>
                            </span>
                        </span>
                    </h3>
                    <hr>
                    <form wire:submit="login">

                        <div class="form-floating mt-3">
                            <input type="text" id="username_or_email" wire:model="username_or_email"
                                class="form-control" placeholder="Username or email">
                            <label for="username_or_email"><i class="fas fa-user"></i> Username or email</label>
                        </div>

                        @error('username_or_email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="password" id="password" wire:model="password" class="form-control"
                                placeholder="Password">
                            <label for="password"><i class="fas fa-lock"></i> Password</label>
                            <button type="button"
                                class="position-absolute no-focus top-50 end-0 mr-2 translate-middle-y"
                                onclick="togglePasswordVisibility()">
                                <i id="password-toggle-icon" class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="d-flex mt-3">
                            <div class="flex-grow-1">
                                <a href="#" class="float-end" data-bs-toggle="modal"
                                    data-bs-target="#forgotPassword">Forgot
                                    password?</a>
                                <p><input type="checkbox" wire:model="remember"> Remember me</p>
                                <p>Don't have an account? <a href="/register" wire:navigate>Register</a></p>
                                <p>Didn't receive email verification? <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#resend">Resend</a></p>
                            </div>
                        </div>
                        <button type="submit" class="mt-3 btn btn-primary form-control"><span wire:loading
                                wire:target="login"><span class="spinner-border spinner-border-sm"></span> Logging
                                in...</span> <span wire:loading.remove wire:target="login">Login</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .no-focus:focus {
            outline: none;
        }

        .no-focus {
            border: none;
            background: transparent;
            font-size: 18px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });

        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordToggleIcon = document.getElementById("password-toggle-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggleIcon.classList.remove("fa-eye-slash");
                passwordToggleIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                passwordToggleIcon.classList.remove("fa-eye");
                passwordToggleIcon.classList.add("fa-eye-slash");
            }
        }

    </script>

    @if(session('verified'))
    <script>
        document.addEventListener('livewire:navigated', function() {
            const {
                title
                , message
                , type
            } = @json(session('verified'));
            Swal.fire({
                title: title
                , text: message
                , icon: type
                , confirmButtonText: 'OK'
                , showCloseButton: true,

            });
        });

    </script>
    @endif

    @if(session('alreadyVerified'))
    <script>
        document.addEventListener('livewire:navigated', function() {
            const {
                title
                , message
                , type
            } = @json(session('alreadyVerified'));
            Swal.fire({
                title: title
                , text: message
                , icon: type
                , confirmButtonText: 'OK'
                , showCloseButton: true,

            });

        });
    </script>
    @endif

    @if(session('invalidToken'))
    <script>
        document.addEventListener('livewire:navigated', function() {
            const {
                title
                , message
                , type
            } = @json(session('invalidToken'));
            Swal.fire({
                title: title
                , text: message
                , icon: type
                , confirmButtonText: 'OK'
                , showCloseButton: true,

            });
        });

    </script>
    @endif

    <script>
        document.addEventListener('livewire:navigated', () => {
            @this.on('alert', (event) => {
                const {
                    title
                    , type
                    , message
                } = event.alerts;
                Swal.fire({
                    title: title
                    , text: message
                    , icon: type
                    , confirmButtonText: 'OK'
                    , showCloseButton: true,

                });
            });
            @this.on('closeModal', () => {
               $('#resend').modal('hide');
               $('#forgotPassword').modal('hide');
            });
        });

    </script>
</div>
