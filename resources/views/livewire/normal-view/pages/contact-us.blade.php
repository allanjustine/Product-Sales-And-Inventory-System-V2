<div>
    <!-- Hero Section -->
    <div class="feedback-hero py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="hero-icon mb-4">
                        <i class="fas fa-comments fa-4x text-primary"></i>
                    </div>
                    <h1 class="display-5 fw-bold mb-3">Share Your Feedback</h1>
                    <div class="divider mx-auto mb-4"></div>
                    <p class="lead text-muted">
                        Your thoughts and experiences help us improve. Whether you have suggestions,
                        stories to share, or need assistance, we're listening.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback Form -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- Card Header -->
                    <div class="card-header bg-primary text-white py-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-white text-primary me-3">
                                <i class="fas fa-pen-fancy fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">Share Your Thoughts</h4>
                                <p class="text-white-50 mb-0">We value every piece of feedback</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4 p-lg-5">
                        <form wire:submit="submit" class="needs-validation" novalidate>
                            @csrf

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold mb-2">
                                    <i class="fas fa-user me-2 text-primary"></i>Your Name
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control border-start-0 ps-0 {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        id="name" placeholder="Enter your full name" wire:model="name"
                                        @if (auth()->check()) readonly @endif>
                                    @if (auth()->check())
                                        <span class="input-group-text bg-light border-start-0">
                                            <i class="fas fa-lock text-success"
                                                title="Auto-filled from your account"></i>
                                        </span>
                                    @endif
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                @if (auth()->check())
                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-info-circle me-1"></i>Automatically filled from your profile
                                    </small>
                                @endif
                            </div>

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold mb-2">
                                    <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email"
                                        class="form-control border-start-0 ps-0 {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        id="email" placeholder="your.email@example.com" wire:model="email"
                                        @if (auth()->check()) readonly @endif>
                                    @if (auth()->check())
                                        <span class="input-group-text bg-light border-start-0">
                                            <i class="fas fa-lock text-success"
                                                title="Auto-filled from your account"></i>
                                        </span>
                                    @endif
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-shield-alt me-1"></i>We'll never share your email with anyone else
                                </small>
                            </div>

                            <!-- Message Field -->
                            <div class="mb-5">
                                <label for="message" class="form-label fw-semibold mb-2">
                                    <i class="fas fa-comment-dots me-2 text-primary"></i>Your Message
                                </label>
                                <div class="position-relative">
                                    <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" id="message" rows="6"
                                        maxlength="1000" placeholder="Share your thoughts, suggestions, or stories with us..." wire:model="message"></textarea>
                                    <div class="position-absolute bottom-0 end-0 m-3 text-muted">
                                        <small id="messageCounter">0/1000</small>
                                    </div>
                                </div>
                                @error('message')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="d-flex justify-content-between mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-lightbulb me-1"></i>Be specific for better assistance
                                    </small>
                                    <small class="text-muted">Maximum 1000 characters</small>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg py-3 fw-semibold"
                                    wire:loading.attr="disabled" wire:target="submit">
                                    <span wire:loading.remove wire:target="submit">
                                        <i class="fas fa-paper-plane me-2"></i>Send Feedback
                                    </span>
                                    <span wire:loading wire:target="submit">
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                        Sending...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        /* Hero Section */
        .feedback-hero {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .hero-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #0d6efd, #6f42c1);
            border-radius: 2px;
        }

        /* Form Styles */
        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .form-control:read-only {
            background-color: #f8f9fa;
            border-color: #e9ecef;
            cursor: not-allowed;
        }

        /* Input Group */
        .input-group-lg .input-group-text,
        .input-group-lg .form-control {
            height: 39px;
            font-size: 1rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        /* Textarea */
        textarea.form-control {
            padding: 1rem;
            resize: vertical;
            min-height: 150px;
        }

        #messageCounter {
            background: rgba(255, 255, 255, 0.9);
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
        }

        /* Submit Button */
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

        /* Testimonial Cards */
        .testimonial-card {
            transition: all 0.3s ease;
            height: 100%;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Contact Info */
        .contact-info {
            padding: 1.5rem;
            border-radius: 10px;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .contact-info:hover {
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Card Styling */
        .rounded-4 {
            border-radius: 20px !important;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .display-5 {
                font-size: 2.5rem;
            }

            .input-group-lg .input-group-text,
            .input-group-lg .form-control {
                height: 50px;
            }

            .card-body {
                padding: 1.5rem !important;
            }

            .contact-info {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .display-5 {
                font-size: 2rem;
            }

            .btn-lg {
                padding: 0.75rem 1.5rem;
            }

            .testimonial-card {
                margin-bottom: 1rem;
            }
        }

        /* Form Validation States */
        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
        }

        /* Hover Effects */
        a.text-decoration-none:hover {
            color: #0d6efd !important;
            text-decoration: underline !important;
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Character counter for message textarea
        document.addEventListener('livewire:navigated', function() {
            const messageTextarea = document.getElementById('message');
            const messageCounter = document.getElementById('messageCounter');

            const updateCounter = (e) => {
                const length = e.target.value.length;
                messageCounter.innerText = `${length}/1000`;

                if (length > 1000) {
                    messageCounter.style.color = '#dc3545';
                    messageCounter.style.fontWeight = 'bold';
                } else if (length > 800) {
                    messageCounter.style.color = '#ffc107';
                    messageCounter.style.fontWeight = 'bold';
                } else {
                    messageCounter.style.color = '#6c757d';
                    messageCounter.style.fontWeight = 'normal';
                }
            };

            messageTextarea.addEventListener('input', updateCounter);
            updateCounter();
            // Form submission feedback
            document.querySelector('form').addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                }
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('formSubmissionError', function() {
                const submitBtn = document.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = false;
                }
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('alert', function(event) {
                const {
                    title,
                    type,
                    message
                } = event.alerts;

                console.log(event)

                Swal.fire({
                    title: title,
                    icon: type,
                    text: message,
                    confirmButtonText: 'Got it',
                    confirmButtonColor: '#0d6efd',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    }
                });
            });
        });
    </script>
</div>
