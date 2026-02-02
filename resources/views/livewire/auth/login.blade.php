<div>
    @livewire('auth.forgot-password')
    @livewire('auth.resend-email')

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4">
                    <div class="logo-container d-inline-block mb-3">
                        <div class="logo-circle">
                            <img src="images/mylogo.jpg" alt="Logo" class="w-100 h-100 rounded-circle">
                        </div>
                    </div>
                    <h2 class="fw-bold mb-2">Welcome Back</h2>
                    <p class="text-muted">Sign in to your account</p>
                </div>

                <div class="card border-0 shadow-lg rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <form wire:submit="login">
                            <div class="mb-4">
                                <label for="username_or_email" class="form-label fw-semibold mb-2">
                                    Username or Email
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text"
                                           id="username_or_email"
                                           class="form-control border-start-0 {{ $errors->has('username_or_email') ? 'is-invalid' : '' }}"
                                           placeholder="Enter username or email"
                                           wire:model="username_or_email"
                                           required>
                                </div>
                                @error('username_or_email')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="password" class="form-label fw-semibold mb-0">
                                        Password
                                    </label>
                                    <a href="#" class="text-decoration-none small" data-bs-toggle="modal"
                                       data-bs-target="#forgotPassword">
                                        Forgot Password?
                                    </a>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password"
                                           id="password"
                                           class="form-control border-start-0 {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                           placeholder="Enter your password"
                                           wire:model="password"
                                           required>
                                    <button type="button"
                                            class="input-group-text bg-light border-start-0"
                                            onclick="togglePasswordVisibility()"
                                            id="password-toggle">
                                        <i id="password-toggle-icon" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                @error('password')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           id="remember" wire:model="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit"
                                        class="btn btn-primary btn-lg py-3 fw-semibold"
                                        wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="login">
                                        Sign In
                                    </span>
                                    <span wire:loading wire:target="login">
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                        Signing In...
                                    </span>
                                </button>
                            </div>

                            <div class="position-relative my-4">
                                <div class="border-bottom"></div>
                                <div class="position-absolute top-50 start-50 translate-middle px-3 bg-white">
                                    <small class="text-muted">Or</small>
                                </div>
                            </div>

                            <div class="text-center">
                                <p class="mb-2">
                                    Don't have an account?
                                    <a href="/register" wire:navigate class="text-decoration-none fw-semibold ms-1">
                                        Sign up
                                    </a>
                                </p>
                                <p class="mb-0">
                                    Didn't receive verification?
                                    <a href="#" class="text-decoration-none fw-semibold ms-1" data-bs-toggle="modal"
                                       data-bs-target="#resend">
                                        Resend Email
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <small class="text-muted">
                        <i class="fas fa-shield-alt me-1"></i>
                        Secure login with encryption
                    </small>
                </div>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 1200px;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            border: 3px solid #0d6efd;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
        }

        .card {
            border-radius: 16px !important;
        }

        .form-control, .input-group-text {
            transition: all 0.3s ease;
            height: 50px;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        #password-toggle {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #password-toggle:hover {
            background-color: #e9ecef;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .form-check-input {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.3);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        a.text-decoration-none {
            color: #0d6efd;
            transition: all 0.3s ease;
        }

        a.text-decoration-none:hover {
            text-decoration: underline !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem !important;
            }

            .btn-lg {
                padding: 0.75rem 1.5rem;
            }

            .logo-circle {
                width: 70px;
                height: 70px;
            }
        }

        @media (max-width: 576px) {
            .card {
                border-radius: 12px !important;
            }

            h2 {
                font-size: 1.75rem;
            }
        }

        .spinner-border {
            vertical-align: middle;
        }
    </style>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const passwordToggleIcon = document.getElementById("password-toggle-icon");

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

        document.addEventListener('livewire:navigated', () => {
            Livewire.on('alert', (event) => {
                const { title, type, message } = event.alerts;
                Swal.fire({
                    title: title,
                    text: message,
                    icon: type,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0d6efd',
                    showCloseButton: true,
                });
            });

            Livewire.on('closeModal', () => {
                $('#resend').modal('hide');
                $('#forgotPassword').modal('hide');
            });
        });

        @if(session('verified'))
        document.addEventListener('livewire:navigated', function() {
            const { title, message, type } = @json(session('verified'));
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd',
                showCloseButton: true,
            });
        });
        @endif

        @if(session('alreadyVerified'))
        document.addEventListener('livewire:navigated', function() {
            const { title, message, type } = @json(session('alreadyVerified'));
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd',
                showCloseButton: true,
            });
        });
        @endif

        @if(session('invalidToken'))
        document.addEventListener('livewire:navigated', function() {
            const { title, message, type } = @json(session('invalidToken'));
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd',
                showCloseButton: true,
            });
        });
        @endif
    </script>
</div>
