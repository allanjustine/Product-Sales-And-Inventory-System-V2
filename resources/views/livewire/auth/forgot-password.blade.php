<div>
    <div wire:ignore.self class="modal fade" id="forgotPassword" tabindex="-1" role="dialog"
        aria-labelledby="forgotPasswordModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header border-bottom-0 pb-0">
                    <div class="d-flex align-items-center w-100">
                        <div class="modal-icon bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                            <i class="fas fa-key fa-lg"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title fw-bold mb-1" id="forgotPasswordModal">Reset Your Password</h5>
                            <p class="text-muted mb-0">We'll help you get back into your account</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>

                <div class="modal-body py-4">
                    <form wire:submit="resetLink" class="needs-validation" novalidate>
                        <div class="alert alert-light border mb-4">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-info-circle text-primary mt-1 me-2"></i>
                                <div>
                                    <p class="mb-0">Enter your email address below. We'll send you a link to reset
                                        your password.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="forgotEmail" class="form-label fw-semibold mb-2">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-at text-muted"></i>
                                </span>
                                <input type="email" id="forgotEmail"
                                    class="form-control border-start-0 h-auto {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    placeholder="you@example.com" wire:model.live.debounce.200ms="email" required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-shield-alt me-1"></i>We'll never share your email with anyone
                            </small>
                        </div>

                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                            <button type="button"
                                class="btn btn-outline-secondary order-sm-2 order-1 w-100 w-sm-auto px-4"
                                data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-primary order-sm-1 order-2 w-100 w-sm-auto px-4"
                                wire:loading.attr="disabled" wire:target="resetLink">
                                <span wire:loading.remove wire:target="resetLink">
                                    <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                                </span>
                                <span wire:loading wire:target="resetLink">
                                    <span class="spinner-border spinner-border-sm me-2"></span>
                                    Sending...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer border-top-0 bg-light rounded-bottom-3">
                    <div class="w-100">
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <i class="fas fa-lock text-success"></i>
                            <small class="text-muted">Secure password reset process</small>
                        </div>
                        <div class="text-center mt-2">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Reset link expires in 24 hours
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal-content {
            border-radius: 16px !important;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(to right, #f8f9fa, #ffffff);
            padding: 1.5rem 1.5rem 0;
        }

        .modal-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-control,
        .input-group-text {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .alert-light {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
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
            transform: none !important;
        }

        .btn-outline-secondary {
            border-radius: 10px;
            border-width: 2px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }

        a.text-decoration-none {
            color: #0d6efd;
            transition: all 0.3s ease;
        }

        a.text-decoration-none:hover {
            text-decoration: underline !important;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal.fade .modal-dialog {
            animation: fadeIn 0.3s ease-out;
        }

        @media (max-width: 576px) {
            .modal-dialog {
                margin: 1rem;
            }

            .modal-content {
                border-radius: 12px !important;
            }

            .modal-header,
            .modal-body,
            .modal-footer {
                padding: 1rem;
            }

            .btn {
                padding: 0.75rem 1.5rem;
            }
        }

        .spinner-border {
            vertical-align: middle;
        }

        #securityCheck:valid {
            border-color: #28a745;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('forgotPassword');

            if (modal) {
                const form = modal.querySelector('form.needs-validation');
                if (form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                }

                modal.addEventListener('shown.bs.modal', function() {
                    const emailInput = modal.querySelector('#forgotEmail');
                    if (emailInput) {
                        setTimeout(() => {
                            emailInput.focus();
                        }, 100);
                    }
                });

                modal.addEventListener('hidden.bs.modal', function() {
                    const form = modal.querySelector('form');
                    if (form) {
                        form.classList.remove('was-validated');
                        @this.set('email', '');
                    }
                });
            }

            Livewire.on('alert', function(event) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('forgotPassword'));
                if (modal) {
                    modal.hide();
                }

                const data = event.alerts;

                if (data && data.message) {
                    Swal.fire({
                        icon: data.type,
                        title: data.title,
                        text: data.message,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#0d6efd',
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        });

        document.addEventListener('input', function(e) {
            if (e.target.id === 'forgotEmail') {
                const emailInput = e.target;
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (emailInput.value && !emailPattern.test(emailInput.value)) {
                    emailInput.classList.add('is-invalid');
                } else {
                    emailInput.classList.remove('is-invalid');
                }
            }
        });
    </script>
</div>
