<div>
    <div class="min-vh-100 d-flex align-items-center">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mb-4">
                        <div class="logo-container mb-3">
                            <div class="logo-wrapper mx-auto">
                                <img src="images/mylogo.jpg" class="logo-img rounded-3 shadow-sm" alt="Company Logo">
                            </div>
                        </div>
                        <h2 class="fw-bold text-gradient-primary mb-2">Secure Password Reset</h2>
                        <p class="text-muted">Create a strong new password for your account</p>
                    </div>

                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="card-header bg-gradient-primary text-white py-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">
                                    <i class="fas fa-key me-2"></i>Reset Password
                                </h4>
                                <span class="badge bg-white bg-opacity-25 rounded-pill" data-bs-toggle="tooltip"
                                    data-bs-placement="left" title="You are resetting your password">
                                    <i class="fas fa-question"></i>
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            <form wire:submit="resetPassword" class="needs-validation" novalidate>
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="fas fa-lock me-2 text-primary"></i>New Password
                                    </label>
                                    <div class="input-group">
                                        <input type="password" id="password" wire:model="password"
                                            class="form-control form-control-lg border-end-0"
                                            placeholder="Enter new password" required>
                                        <span class="input-group-text bg-transparent border-start-0">
                                            <i class="fas fa-eye-slash password-toggle" data-target="password"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-2">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <div class="password-strength mt-2 d-none">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                        <small class="strength-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold">
                                        <i class="fas fa-lock me-2 text-primary"></i>Confirm New Password
                                    </label>
                                    <div class="input-group">
                                        <input type="password" id="password_confirmation"
                                            wire:model="password_confirmation"
                                            class="form-control form-control-lg border-end-0"
                                            placeholder="Confirm new password" required>
                                        <span class="input-group-text bg-transparent border-start-0">
                                            <i class="fas fa-eye-slash password-toggle"
                                                data-target="password_confirmation"></i>
                                        </span>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="text-danger small mt-2">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-gradient-primary btn-lg w-100 py-3 fw-semibold"
                                    :disabled="loading">
                                    <span wire:loading wire:target='resetPassword'>
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                        Resetting Password...
                                    </span>
                                    <span wire:loading.remove wire:target='resetPassword'>
                                        <i class="fas fa-redo-alt me-2"></i>Reset Password
                                    </span>
                                </button>

                                <div class="text-center mt-4 pt-3 border-top">
                                    <p class="mb-0 text-muted">
                                        Remembered your password?
                                        <a href="/login" wire:navigate
                                            class="text-decoration-none fw-semibold text-primary ms-1">
                                            <i class="fas fa-sign-in-alt me-1"></i>Back to Login
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-light py-3 text-center">
                            <small class="text-muted">
                                <i class="fas fa-shield-alt me-1 text-success"></i>
                                Your password is encrypted and securely stored
                            </small>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <div class="alert alert-light border d-inline-flex align-items-center shadow-sm" role="alert">
                            <i class="fas fa-lightbulb text-warning me-2"></i>
                            <small>Use a unique password that you don't use elsewhere</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .logo-wrapper {
            width: 120px;
            height: 120px;
            padding: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .text-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gradient-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-gradient-primary:disabled {
            opacity: 0.7;
            transform: none;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }

        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .requirement.valid {
            color: #198754;
        }

        .requirement.valid i {
            color: #198754;
        }

        .requirement.invalid {
            color: #6c757d;
        }

        .requirement.invalid i {
            color: #dee2e6;
        }

        .password-strength .progress-bar {
            transition: width 0.3s ease;
        }

        .card {
            animation: slideUp 0.5s ease-out;
            border-radius: 16px;
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

        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem !important;
            }

            .logo-wrapper {
                width: 100px;
                height: 100px;
            }

            .btn-lg {
                padding: 0.75rem 1.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', () => {
            document.querySelectorAll('.password-toggle').forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    } else {
                        passwordInput.type = 'password';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    }
                });
            });

            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            Livewire.on('alert', (event) => {
                const {
                    title,
                    type,
                    message
                } = event.alerts;
                Swal.fire({
                    title: title,
                    text: message,
                    icon: type,
                    confirmButtonText: 'OK',
                    showCloseButton: true,
                    confirmButtonColor: '#667eea',
                    background: '#fff',
                    backdrop: 'rgba(102, 126, 234, 0.1)',
                });
            });
        });
    </script>
</div>
