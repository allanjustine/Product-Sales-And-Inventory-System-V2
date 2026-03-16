<div>
    <!-- Modal Delete User - Modern Confirmation Design -->
    <div wire:ignore.self class="modal fade" id="deleteUser" tabindex="-1" role="dialog"
        aria-labelledby="deleteUserModalTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <!-- Header with danger gradient -->
                <div class="modal-header bg-gradient-danger text-white py-3 border-0">
                    <h5 class="modal-title font-weight-bold" id="deleteUserModalTitle">
                        <i class="fa-solid fa-exclamation-triangle mr-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center p-4">
                    @if ($userToDelete)
                        <!-- Warning Icon Animation -->
                        <div class="mb-4">
                            <div class="warning-animation">
                                <span class="danger-icon-wrapper">
                                    <i class="fa-solid fa-user-slash fa-4x text-danger"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Warning Message -->
                        <h4 class="mb-3 font-weight-bold text-dark">Are you absolutely sure?</h4>

                        <div class="alert alert-danger bg-danger-soft border-0 rounded-lg mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-info-circle fa-2x mr-3 text-danger"></i>
                                <div class="text-left">
                                    <p class="mb-1 font-weight-bold text-dark">This action cannot be undone.</p>
                                    <p class="mb-0 text-muted">
                                        The user <strong class="text-danger">"{{ $userToDelete->name }}"</strong>
                                        will be permanently deleted from the system.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- User Summary Card -->
                        <div class="card bg-light border-0 mb-3">
                            <div class="card-body p-3">
                                <h6 class="card-subtitle mb-2 text-muted">User Summary</h6>
                                <div class="row text-left small">
                                    <div class="col-6">
                                        <p class="mb-1"><i
                                                class="fa-solid fa-envelope text-muted mr-2"></i>{{ $userToDelete->email }}
                                        </p>
                                        <p class="mb-1"><i class="fa-solid fa-tag text-muted mr-2"></i>ID:
                                            #{{ $userToDelete->id }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-1"><i class="fa-solid fa-calendar text-muted mr-2"></i>Joined:
                                            {{ $userToDelete->created_at ? $userToDelete->created_at->format('M d, Y') : 'N/A' }}
                                        </p>
                                        <p class="mb-1">
                                            <i class="fa-solid fa-shield-alt text-muted mr-2"></i>
                                            Role:
                                            @if ($userToDelete->isAdmin())
                                                <span class="badge badge-info">ADMIN</span>
                                            @else
                                                <span class="badge badge-warning">USER</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Warning -->
                        <div class="text-muted small">
                            <i class="fa-solid fa-database mr-1"></i>
                            This will remove all associated data and cannot be reversed.
                        </div>
                    @else
                        <!-- Enhanced Loading State -->
                        <div class="py-5">
                            <div class="spinner-border text-danger mb-3" style="width: 3rem; height: 3rem;"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h5 class="text-muted">Loading user information...</h5>
                            <p class="text-muted small">Please wait while we fetch the data</p>
                        </div>
                    @endif
                </div>

                <div class="modal-footer bg-light border-top-0 px-4 py-3">
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <!-- Cancel Button -->
                        <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal"
                            id="closeModalDelete">
                            <i class="fa-solid fa-arrow-left mr-2"></i> No, Cancel
                        </button>

                        <!-- Delete Button with Loading State -->
                        <button class="btn btn-danger px-4" type="button" wire:click="deleteUser"
                            wire:loading.attr="disabled" wire:target="deleteUser">
                            <!-- Loading State -->
                            <span wire:loading.remove wire:target="deleteUser">
                                <i class="fa-solid fa-trash-alt mr-2"></i> Yes, Delete Permanently
                            </span>
                            <span wire:loading wire:target="deleteUser">
                                <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                                Deleting...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles for Delete Modal */
        .bg-gradient-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .bg-danger-soft {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .modal-content {
            border-radius: 15px;
            overflow: hidden;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        /* Warning Animation */
        .warning-animation {
            animation: pulse 2s infinite;
        }

        .danger-icon-wrapper {
            display: inline-block;
            padding: 15px;
            background: rgba(220, 53, 69, 0.1);
            border-radius: 50%;
            animation: bounce 1s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        /* Alert Box */
        .alert-danger-soft {
            background-color: rgba(220, 53, 69, 0.05);
            border-left: 4px solid #dc3545;
        }

        /* Card Styles */
        .card.bg-light {
            border-radius: 12px;
            transition: all 0.3s;
        }

        .card.bg-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.1);
        }

        /* Button Styles */
        .btn-danger {
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-danger:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .btn-danger:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-outline-secondary {
            transition: all 0.3s;
        }

        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.2);
        }

        /* Ripple Effect for Delete Button */
        .btn-danger::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }

        .btn-danger:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        /* Animation */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-2px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(2px);
            }
        }

        .modal.fade .modal-dialog .modal-content {
            animation: shake 0.5s ease-in-out;
        }

        /* Dark Mode Support */
        .dark-mode .bg-light {
            background-color: #2d2d2d !important;
        }

        .dark-mode .card.bg-light {
            background-color: #2d2d2d !important;
            border-color: #404040 !important;
        }

        .dark-mode .text-dark {
            color: #fff !important;
        }

        .dark-mode .text-muted {
            color: #adb5bd !important;
        }

        .dark-mode .bg-danger-soft {
            background-color: rgba(220, 53, 69, 0.2);
        }

        .dark-mode .alert-danger-soft {
            background-color: rgba(220, 53, 69, 0.15);
        }

        .dark-mode .card.bg-light .text-muted {
            color: #adb5bd !important;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0;
                min-height: 100vh;
            }

            .modal-content {
                border-radius: 0;
                min-height: 100vh;
            }

            .modal-footer .w-100 {
                flex-direction: column-reverse;
                gap: 10px;
            }

            .modal-footer .w-100 button {
                width: 100%;
            }

            .danger-icon-wrapper i {
                font-size: 3rem !important;
            }

            .alert .d-flex {
                flex-direction: column;
                text-align: center;
            }

            .alert .d-flex i {
                margin-right: 0 !important;
                margin-bottom: 10px;
            }
        }

        /* Loading State */
        .spinner-border.text-danger {
            border-color: #dc3545;
            border-right-color: transparent;
        }

        /* Custom Scrollbar */
        .modal-body::-webkit-scrollbar {
            width: 5px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 5px;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: #dc3545;
            border-radius: 5px;
        }

        .modal-body::-webkit-scrollbar-thumb:hover {
            background: #c82333;
        }

        /* Dark mode scrollbar */
        .dark-mode .modal-body::-webkit-scrollbar-track {
            background: #2d2d2d;
        }

        /* Confirmation Text */
        .font-weight-bold.text-dark {
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }

        /* User Summary Icons */
        .card .col-6 p i {
            width: 20px;
            text-align: center;
        }

        /* Hover effect on user summary */
        .card.bg-light:hover .text-muted {
            color: #dc3545 !important;
        }

        /* Badge styling in summary */
        .badge {
            padding: 0.4rem 0.6rem;
            font-weight: 500;
        }

        /* Focus states */
        .btn-danger:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
        }

        .btn-outline-secondary:focus {
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.5);
        }

        /* Delete button disabled state */
        .btn-danger:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Additional polish */
        .rounded-lg {
            border-radius: 12px !important;
        }

        /* Transition for smooth theme switching */
        .modal-content,
        .card,
        .btn,
        .alert,
        .badge {
            transition: all 0.3s ease;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            // Reset when modal is closed
            $('#deleteUser').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });

            // Prevent accidental deletion with double confirmation
            $('#deleteUser').on('show.bs.modal', function() {
                // Optional: Add any pre-modal show logic
            });

            // Add keyboard shortcut for cancel (ESC already works)
            $(document).keydown(function(e) {
                if (e.key === "Escape" && $('#deleteUser').hasClass('show')) {
                    $('#closeModalDelete').click();
                }
            });
        });

        // Additional safety measure - confirm before delete if needed
        function confirmDelete(userName) {
            return Swal.fire({
                title: 'Final Confirmation',
                text: `Are you absolutely sure you want to delete ${userName}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete permanently'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteUser');
                }
            });
        }
    </script>
</div>
