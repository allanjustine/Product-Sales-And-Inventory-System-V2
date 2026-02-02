<div>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-md-8 col-lg-6">
                <div class="text-center mb-4">
                    <div class="logo-container mb-4">
                        <div class="logo-circle mx-auto mb-3">
                            <img src="images/mylogo.jpg" alt="Logo" class="w-100 h-100 rounded-circle">
                        </div>
                        <h2 class="fw-bold mb-2">Create Account</h2>
                        <p class="text-muted">Join our community today</p>
                    </div>
                </div>
                <div class="card border-0 shadow-lg rounded-3">
                    <div class="card-body p-4 p-lg-5">
                        <form wire:submit="register" class="needs-validation" novalidate>
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <div class="profile-image-container mb-3">
                                        @if($profile_image)
                                            <img src="{{ $profile_image->temporaryUrl() }}"
                                                 alt="Profile Preview"
                                                 class="profile-image rounded-circle">
                                            <button type="button"
                                                    class="btn-remove-profile btn btn-sm btn-danger rounded-circle"
                                                    wire:click="removeProfileImage">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @else
                                            <div class="profile-placeholder rounded-circle">
                                                <i class="fas fa-user fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="button"
                                                class="btn btn-outline-primary btn-sm"
                                                onclick="document.getElementById('profile_image').click()"
                                                wire:loading.attr="disabled"
                                                wire:target="profile_image">
                                            <span wire:loading.remove wire:target="profile_image">
                                                <i class="fas fa-camera me-2"></i>Upload Photo
                                            </span>
                                            <span wire:loading wire:target="profile_image">
                                                <span class="spinner-border spinner-border-sm me-2"></span>
                                                Uploading...
                                            </span>
                                        </button>
                                        <input type="file"
                                               hidden
                                               id="profile_image"
                                               wire:model="profile_image"
                                               accept=".png, .jpg, .jpeg, .gif">
                                        <small class="text-muted">JPG, PNG or GIF (Max 2MB)</small>
                                    </div>
                                    @error('profile_image')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text"
                                               id="name"
                                               class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                               placeholder="Enter your full name"
                                               wire:model="name"
                                               required>
                                    </div>
                                    @error('name')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email"
                                               id="email"
                                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                               placeholder="you@example.com"
                                               wire:model="email"
                                               required>
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="username" class="form-label fw-semibold">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-at text-muted"></i>
                                        </span>
                                        <input type="text"
                                               id="username"
                                               class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                               placeholder="Choose a username"
                                               wire:model="username"
                                               required>
                                    </div>
                                    @error('username')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone_number" class="form-label fw-semibold">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input type="tel"
                                               id="phone_number"
                                               class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                               placeholder="09XXXXXXXXX"
                                               wire:model="phone_number"
                                               maxlength="11"
                                               required>
                                    </div>
                                    <small class="text-muted">Format: 09XXXXXXXXX (11 digits)</small>
                                    @error('phone_number')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="address" class="form-label fw-semibold">Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-home text-muted"></i>
                                        </span>
                                        <input type="text"
                                               id="address"
                                               class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                               placeholder="Enter your address"
                                               wire:model="address"
                                               required>
                                    </div>
                                    @error('address')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="gender" class="form-label fw-semibold">Gender</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-venus-mars text-muted"></i>
                                        </span>
                                        <select id="gender"
                                                class="form-select {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                                wire:model="gender"
                                                required>
                                            <option value="" selected disabled>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password"
                                               id="password"
                                               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                               placeholder="Create password"
                                               wire:model="password"
                                               required>
                                        <button type="button"
                                                class="input-group-text bg-light"
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

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password"
                                               id="password_confirmation"
                                               class="form-control"
                                               placeholder="Confirm password"
                                               wire:model="password_confirmation"
                                               required>
                                        <button type="button"
                                                class="input-group-text bg-light"
                                                onclick="toggleConfirmPasswordVisibility()"
                                                id="password-confirm-toggle">
                                            <i id="password-confirm-toggle-icon" class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="terms"
                                           required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the
                                        <a href="/terms-and-conditions" target="_blank" class="text-decoration-none">
                                            Terms & Conditions
                                        </a>
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit"
                                        class="btn btn-primary btn-lg py-3 fw-semibold"
                                        wire:loading.attr="disabled"
                                        wire:target="register">
                                    <span wire:loading.remove wire:target="register">
                                        <i class="fas fa-user-plus me-2"></i>Create Account
                                    </span>
                                    <span wire:loading wire:target="register">
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                        Creating Account...
                                    </span>
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="mb-0">
                                    Already have an account?
                                    <a href="/login" wire:navigate class="text-decoration-none fw-semibold ms-1">
                                        Sign In
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <small class="text-muted">
                        <i class="fas fa-shield-alt me-1"></i>
                        Your information is securely encrypted
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
            width: 100px;
            height: 100px;
            border: 3px solid #0d6efd;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.1);
        }

        .profile-image-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 3px solid #f8f9fa;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .profile-placeholder {
            width: 100%;
            height: 100%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px dashed #dee2e6;
        }

        .btn-remove-profile {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 30px;
            height: 30px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 16px !important;
        }

        .form-control, .form-select, .input-group-text {
            height: 50px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        #password-toggle, #password-confirm-toggle {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #password-toggle:hover, #password-confirm-toggle:hover {
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

        .btn-outline-primary {
            border-radius: 8px;
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

        input[type="tel"] {
            font-family: monospace;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem !important;
            }

            .btn-lg {
                padding: 0.75rem 1.5rem;
            }

            .logo-circle {
                width: 80px;
                height: 80px;
            }

            .profile-image-container {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 576px) {
            .card {
                border-radius: 12px !important;
            }

            h2 {
                font-size: 1.75rem;
            }

            .row > [class*="col-"] {
                margin-bottom: 1rem;
            }
        }

        .spinner-border {
            vertical-align: middle;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
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

        function toggleConfirmPasswordVisibility() {
            const passwordInput = document.getElementById("password_confirmation");
            const passwordToggleIcon = document.getElementById("password-confirm-toggle-icon");

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

        document.addEventListener('livewire:navigated', function() {
            const phoneInput = document.getElementById('phone_number');

            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');

                    if (!value.startsWith('09')) {
                        value = '09' + value.replace(/^09/, '');
                    }

                    value = value.substring(0, 11);

                    e.target.value = value;

                    @this.set('phone_number', value);
                });
            }

            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        document.addEventListener('livewire:navigated', function() {
            Livewire.on('alert', (event) => {
                const { title, message, type } = event.alerts;

                Swal.fire({
                    icon: type,
                    title: title,
                    text: message,
                    showConfirmButton: true,
                    confirmButtonText: 'Okay',
                    confirmButtonColor: '#0d6efd',
                    showCloseButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.navigate('/login');
                    }
                });
            });
        });

        document.addEventListener('livewire:navigated', function() {
            const form = document.querySelector('form.needs-validation');

            if (form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }

            const firstInput = document.getElementById('name');
            if (firstInput) {
                setTimeout(() => {
                    firstInput.focus();
                }, 100);
            }
        });
    </script>
</div>
