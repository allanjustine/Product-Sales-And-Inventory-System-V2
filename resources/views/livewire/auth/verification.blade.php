<div>
    <div class="min-vh-100">
        <div class="position-relative min-vh-100 d-flex align-items-center justify-content-center">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary"></div>

            <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
                <div class="position-absolute rounded-circle bg-white bg-opacity-10"
                    style="width: 300px; height: 300px; top: -100px; right: -100px;"></div>
                <div class="position-absolute rounded-circle bg-white bg-opacity-5"
                    style="width: 200px; height: 200px; bottom: -50px; left: -50px;"></div>
                <div class="position-absolute" style="width: 150px; height: 150px; top: 20%; right: 10%;">
                    <div class="w-100 h-100 border border-white border-opacity-10 rounded-4"></div>
                </div>
            </div>

            <div class="container position-relative z-3">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-lg border-0 overflow-hidden">
                            <div class="card-header bg-gradient-primary text-white py-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="me-3">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <h1 class="h3 mb-0 fw-bold">
                                        Email Verification
                                    </h1>
                                </div>
                            </div>

                            <div class="card-body p-4 p-md-5">
                                <div class="text-center mb-4">
                                    @if (session('verified'))
                                        <div
                                            class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 p-4 mb-3">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor"
                                                class="text-success">
                                                <path
                                                    d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm-1.5-5.5l7-7-1.414-1.414L10.5 13.172l-2.586-2.586L6.5 11.586l4 4z" />
                                            </svg>
                                        </div>
                                    @elseif (session('alreadyVerified'))
                                        <div
                                            class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-10 p-4 mb-3">
                                            <i class="fa-solid fa-circle-check" style="font-size: 60px;"></i>
                                        </div>
                                    @elseif (session('invalidToken'))
                                        <div
                                            class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 p-4 mb-3">
                                            <i class="fa-solid fa-circle-xmark" style="font-size: 60px;"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <h2 class="h4 fw-bold mb-3 text-dark">
                                        @if (session('verified'))
                                            {{ session('verified')['title'] }}
                                        @elseif (session('alreadyVerified'))
                                            {{ session('alreadyVerified')['title'] }}
                                        @elseif (session('invalidToken'))
                                            {{ session('invalidToken')['title'] }}
                                        @endif
                                    </h2>

                                    <p class="text-muted mb-4 fs-5">
                                        @if (session('verified'))
                                            {{ session('verified')['message'] }}
                                        @elseif (session('alreadyVerified'))
                                            {{ session('alreadyVerified')['message'] }}
                                        @elseif (session('invalidToken'))
                                            {{ session('invalidToken')['message'] }}
                                        @endif
                                    </p>

                                    <div class="mb-4">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-gradient-primary progress-bar-striped progress-bar-animated"
                                                role="progressbar" style="width: 100%">
                                            </div>
                                        </div>
                                        <p class="small text-muted mt-2 mb-0">
                                            Window will close automatically in <span id="countdown">5</span> seconds
                                        </p>
                                    </div>

                                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                        <button type="button" onclick="window.close()"
                                            class="btn btn-outline-primary px-4">
                                            Close Now
                                        </button>
                                        <a href="/" class="btn btn-gradient-primary px-4">
                                            Go to Homepage
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light py-3">
                                <div class="text-center">
                                    <p class="small text-muted mb-0">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" class="me-1">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                        </svg>
                                        Secure email verification system
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if (session('verified'))
                            <div class="mt-4 text-center">
                                <div class="alert alert-success border-0 shadow-sm d-inline-flex align-items-center">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
                                        class="me-2">
                                        <path
                                            d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm-1.5-5.5l7-7-1.414-1.414L10.5 13.172l-2.586-2.586L6.5 11.586l4 4z" />
                                    </svg>
                                    <span class="small">Your account is now fully activated!</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
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
            box-shadow: 0 7px 14px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .card {
            animation: cardEntrance 0.6s ease-out;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shrink {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .progress-bar {
            animation: shrink 5s linear forwards;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 2rem !important;
            }

            .card-header h1 {
                font-size: 1.25rem;
            }
        }

        .btn-outline-primary {
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    @if (session('verified'))
        <script>
            const {
                title,
                message,
                type
            } = @json(session('verified'));
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'Continue',
                showCloseButton: true,
                confirmButtonColor: '#667eea',
                background: '#fff',
                backdrop: 'rgba(102, 126, 234, 0.1)',
                timer: 4000,
                timerProgressBar: true,
            });
        </script>
    @endif

    @if (session('alreadyVerified'))
        <script>
            const {
                title,
                message,
                type
            } = @json(session('alreadyVerified'));
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'OK',
                showCloseButton: true,
                confirmButtonColor: '#17a2b8',
                background: '#fff',
                backdrop: 'rgba(23, 162, 184, 0.1)',
            });
        </script>
    @endif

    @if (session('invalidToken'))
        <script>
            const {
                title,
                message,
                type
            } = @json(session('invalidToken'));
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'Try Again',
                showCloseButton: true,
                confirmButtonColor: '#dc3545',
                background: '#fff',
                backdrop: 'rgba(220, 53, 69, 0.1)',
            });
        </script>
    @endif

    <script>
        let seconds = 5;
        const countdownElement = document.getElementById('countdown');

        const countdown = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(countdown);
                window.close();
            }
        }, 1000);

        document.addEventListener('click', () => {
            seconds = 5;
            countdownElement.textContent = seconds;
        });
    </script>

</div>
