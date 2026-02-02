<div>
    <div wire:ignore.self class="modal fade" id="resend" tabindex="-1" role="dialog"
        aria-labelledby="resendVerificationModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header border-bottom-0 pb-0">
                    <div class="d-flex align-items-center w-100">
                        <div class="modal-icon bg-warning bg-opacity-10 text-warning rounded-circle p-2 me-3">
                            <i class="fas fa-envelope fa-lg"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title fw-bold mb-1" id="resendVerificationModal">Resend Verification Email
                            </h5>
                            <p class="text-muted mb-0">Get a new verification link</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>

                <div class="modal-body py-4">
                    <form wire:submit="resend" class="needs-validation" novalidate>
                        <div class="alert alert-light border mb-4">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-envelope-circle-check text-warning mt-1 me-2"></i>
                                <div>
                                    <p class="mb-0">Didn't receive the verification email? Enter your email below and
                                        we'll send you a new verification link.</p>
                                </div>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger border-0 mb-4" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <div>{{ session('error') }}</div>
                                </div>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success border-0 mb-4" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <div>{{ session('success') }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="resendEmail" class="form-label fw-semibold mb-2">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-at text-muted"></i>
                                </span>
                                <input type="email" id="resendEmail"
                                    class="form-control border-start-0 h-auto{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    placeholder="Enter your registered email" wire:model.live.debounce.200ms="email"
                                    required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle me-1"></i>Make sure this is the email you used to register
                            </small>
                        </div>

                        <div class="mb-4">
                            <div class="accordion" id="verificationHelp">
                                <div class="accordion-item border-0">
                                    <h6 class="accordion-header">
                                        <button class="accordion-button collapsed bg-light text-dark" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#helpContent">
                                            <i class="fas fa-question-circle me-2 text-warning"></i>
                                            Having trouble?
                                        </button>
                                    </h6>
                                    <div id="helpContent" class="accordion-collapse collapse"
                                        data-bs-parent="#verificationHelp">
                                        <div class="accordion-body bg-light rounded-bottom-3">
                                            <ul class="list-unstyled mb-0">
                                                <li class="mb-2">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <small>Check your spam/junk folder</small>
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <small>Make sure email is spelled correctly</small>
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <small>Wait a few minutes before requesting again</small>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                            <button type="button"
                                class="btn btn-outline-secondary order-sm-2 order-1 w-100 w-sm-auto px-4"
                                data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-warning order-sm-1 order-2 w-100 w-sm-auto px-4"
                                wire:loading.attr="disabled" wire:target="resend">
                                <span wire:loading.remove wire:target="resend">
                                    <i class="fas fa-paper-plane me-2"></i>Resend Verification
                                </span>
                                <span wire:loading wire:target="resend">
                                    <span class="spinner-border spinner-border-sm me-2"></span>
                                    Sending...
                                </span>
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 pt-3 border-top">
                        <div class="text-center">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Verification links expire in 24 hours
                            </small>
                            <div class="mt-1">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Secure email delivery
                                </small>
                            </div>
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

        .alert {
            border-radius: 10px;
            border-width: 1px;
        }

        .alert-light {
            background-color: #f8f9fa;
            border-color: #e9ecef;
        }

        .form-control,
        .input-group-text {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .input-group-lg .input-group-text,
        .input-group-lg .form-control {
            font-size: 1rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .accordion-button {
            border-radius: 8px !important;
            font-weight: 500;
        }

        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: #212529;
            box-shadow: none;
        }

        .accordion-button:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        }

        .accordion-body {
            padding: 1rem;
            border-radius: 0 0 8px 8px;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border: none;
            color: #212529;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 193, 7, 0.3);
            color: #212529;
        }

        .btn-warning:disabled {
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

        .list-unstyled li {
            padding: 0.25rem 0;
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

            .input-group-lg .input-group-text,
            .input-group-lg .form-control {
                height: 50px;
            }

            .accordion-button {
                font-size: 0.9rem;
            }
        }

        .spinner-border {
            vertical-align: middle;
        }

        .fa-check-circle {
            color: #28a745;
        }

        .fa-exclamation-circle {
            color: #dc3545;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('resend');

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
                    const emailInput = modal.querySelector('#resendEmail');
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

                Livewire.on('verificationResent', function(data) {
                    if (data && data.success) {
                        setTimeout(() => {
                            const modalInstance = bootstrap.Modal.getInstance(modal);
                            if (modalInstance) {
                                modalInstance.hide();
                            }
                        }, 2000);
                    }
                });
            }

            document.addEventListener('input', function(e) {
                if (e.target.id === 'resendEmail') {
                    const emailInput = e.target;
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (emailInput.value && !emailPattern.test(emailInput.value)) {
                        emailInput.classList.add('is-invalid');
                    } else {
                        emailInput.classList.remove('is-invalid');
                    }
                }
            });
        });

        document.addEventListener('click', function(e) {
            if (e.target.matches('.accordion-button') || e.target.closest('.accordion-button')) {
                const accordion = document.getElementById('verificationHelp');
                if (accordion) {
                    const isExpanded = accordion.querySelector('.accordion-button').classList.contains('collapsed');
                    if (isExpanded) {
                        console.log('Help accordion opened');
                    }
                }
            }
        });
    </script>
</div>
