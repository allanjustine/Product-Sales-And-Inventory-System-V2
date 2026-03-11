<div>
    <!-- Modal User Info - Modern Profile Card Design -->
    <div wire:ignore.self class="modal fade" id="viewUser" tabindex="-1" role="dialog"
        aria-labelledby="viewUserModalTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <!-- Header with profile cover -->
                <div class="modal-header border-0 p-0 position-relative">
                    <div class="profile-cover bg-gradient-primary w-100"
                        style="height: 100px; border-radius: 0.3rem 0.3rem 0 0;"></div>
                    <button type="button" class="close position-absolute text-white"
                        style="top: 10px; right: 15px; z-index: 10;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pt-0 px-4 pb-4">
                    @if ($userView)
                        <!-- Profile Avatar - Positioned to overlap cover -->
                        <div class="text-center" style="margin-top: -60px;">
                            <div class="position-relative d-inline-block">
                                <div class="avatar-wrapper">
                                    <img src="{{ $userView->profile_image === null
                                        ? 'https://cdn-icons-png.flaticon.com/512/2919/2919906.png'
                                        : Storage::url($userView->profile_image) }}"
                                        class="rounded-circle border border-4 border-white shadow"
                                        style="height: 120px; width: 120px; object-fit: cover; background: white;"
                                        alt="Profile picture"
                                        onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/512/2919/2919906.png';">

                                    <!-- Status Badge on Avatar -->
                                    @if ($userView->email_verified_at)
                                        <span
                                            class="position-absolute bg-success rounded-circle p-1 border border-white"
                                            style="bottom: 10px; right: 5px; width: 15px; height: 15px;"
                                            title="Verified"></span>
                                    @else
                                        <span class="position-absolute bg-danger rounded-circle p-1 border border-white"
                                            style="bottom: 10px; right: 5px; width: 15px; height: 15px;"
                                            title="Unverified"></span>
                                    @endif
                                </div>
                            </div>

                            <!-- User Name and Role -->
                            <div class="mt-3">
                                <h3 class="mb-1 font-weight-bold">{{ $userView->name }}</h3>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-envelope mr-1"></i>{{ $userView->email }}
                                </p>

                                <!-- Role Badges -->
                                <div class="d-flex justify-content-center gap-2">
                                    @if ($userView->isAdmin())
                                        <span class="badge badge-info px-3 py-2">
                                            <i class="fas fa-crown mr-1"></i> ADMINISTRATOR
                                        </span>
                                    @else
                                        <span class="badge badge-warning px-3 py-2">
                                            <i class="fas fa-user mr-1"></i> REGULAR USER
                                        </span>
                                    @endif

                                    @if ($userView->email_verified_at)
                                        <span class="badge badge-success px-3 py-2">
                                            <i class="fas fa-check-circle mr-1"></i> VERIFIED
                                        </span>
                                    @else
                                        <span class="badge badge-danger px-3 py-2">
                                            <i class="fas fa-times-circle mr-1"></i> UNVERIFIED
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- User Details Card -->
                        <div class="card border-0 bg-light mt-4">
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush bg-transparent">
                                    <!-- Username -->
                                    <div
                                        class="list-group-item bg-transparent d-flex align-items-center px-3 py-3 border-bottom">
                                        <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-2 mr-3"
                                            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-at text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block">Username</small>
                                            <span
                                                class="font-weight-medium text-light text-dark">{{ $userView->username ?? 'Not set' }}</span>
                                        </div>
                                    </div>

                                    <!-- Phone Number -->
                                    <div
                                        class="list-group-item bg-transparent d-flex align-items-center px-3 py-3 border-bottom">
                                        <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle p-2 mr-3"
                                            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-phone-alt text-success"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block">Phone Number</small>
                                            <span
                                                class="font-weight-medium text-light text-dark">{{ $userView->phone_number ?? 'Not provided' }}</span>
                                        </div>
                                    </div>

                                    <!-- Gender -->
                                    <div
                                        class="list-group-item bg-transparent d-flex align-items-center px-3 py-3 border-bottom">
                                        <div class="icon-wrapper bg-info bg-opacity-10 rounded-circle p-2 mr-3"
                                            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i
                                                class="fas fa-{{ $userView->gender === 'Male' ? 'mars' : 'venus' }} text-info"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block">Gender</small>
                                            <span
                                                class="font-weight-medium text-light text-dark">{{ $userView->gender ?? 'Not specified' }}</span>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div
                                        class="list-group-item bg-transparent d-flex align-items-center px-3 py-3 border-bottom">
                                        <div class="icon-wrapper bg-warning bg-opacity-10 rounded-circle p-2 mr-3"
                                            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-map-marker-alt text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block">Address</small>
                                            <span
                                                class="font-weight-medium text-light text-dark">{{ $userView->address ?? 'No address provided' }}</span>
                                        </div>
                                    </div>

                                    <!-- Member Since -->
                                    <div class="list-group-item bg-transparent d-flex align-items-center px-3 py-3">
                                        <div class="icon-wrapper bg-secondary bg-opacity-10 rounded-circle p-2 mr-3"
                                            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-calendar-alt text-secondary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block">Member Since</small>
                                            <span
                                                class="font-weight-medium text-light text-dark">{{ $userView->created_at ? $userView->created_at->format('F d, Y') : 'N/A' }}</span>
                                            <small
                                                class="text-muted d-block">{{ $userView->created_at ? $userView->created_at->diffForHumans() : '' }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Stats Cards -->
                        <div class="row mt-4 g-2">
                            <div class="col-6">
                                <div class="card border-0 bg-primary bg-opacity-10 text-center py-2">
                                    <div class="card-body p-2">
                                        <i class="fas fa-clock text-primary mb-1"></i>
                                        <h6 class="mb-0 font-weight-bold text-light text-dark">Last Updated</h6>
                                        <small
                                            class="text-light text-dark">{{ $userView->updated_at ? $userView->updated_at->format('M d, Y') : 'N/A' }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card border-0 bg-success bg-opacity-10 text-center py-2">
                                    <div class="card-body p-2">
                                        <i class="fas fa-id-card text-success mb-1"></i>
                                        <h6 class="mb-0 font-weight-bold text-light text-dark">User ID</h6>
                                        <small class="text-light text-dark">#{{ $userView->id }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Loading Skeleton - Redesigned -->
                        <div class="text-center">
                            <!-- Cover Placeholder -->
                            <div class="bg-gradient-primary w-100"
                                style="height: 100px; border-radius: 0.3rem 0.3rem 0 0; opacity: 0.3;"></div>

                            <!-- Avatar Placeholder -->
                            <div style="margin-top: -60px;">
                                <div class="spinner-border text-primary" role="status"
                                    style="height: 120px; width: 120px; border-width: 4px; background: white; border-radius: 50%;">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <!-- Name and Email Placeholder -->
                            <div class="mt-3">
                                <div class="placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </div>
                                <div class="placeholder-glow mt-2">
                                    <span class="placeholder col-8"></span>
                                </div>
                            </div>

                            <!-- Badges Placeholder -->
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                            </div>

                            <!-- Details Card Placeholder -->
                            <div class="card border-0 bg-light mt-4">
                                <div class="card-body p-0">
                                    @for ($i = 0; $i < 5; $i++)
                                        <div class="d-flex align-items-center px-3 py-3 border-bottom">
                                            <span class="placeholder rounded-circle mr-3"
                                                style="width: 40px; height: 40px;"></span>
                                            <div class="flex-grow-1">
                                                <span class="placeholder col-4"></span>
                                                <span class="placeholder col-8 d-block mt-1"></span>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Modal Footer with Action Buttons -->
                <div class="modal-footer border-top-0 pt-0 px-4 pb-4">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles for User Info Modal */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-opacity-10 {
            --bg-opacity: 0.1;
            background-color: rgba(var(--primary-rgb), var(--bg-opacity)) !important;
        }

        .modal-content {
            border-radius: 15px;
            overflow: hidden;
        }

        .avatar-wrapper {
            position: relative;
            display: inline-block;
        }

        .avatar-wrapper img {
            transition: transform 0.3s;
        }

        .avatar-wrapper:hover img {
            transform: scale(1.05);
        }

        .icon-wrapper {
            transition: all 0.3s;
            background-color: rgba(0, 0, 0, 0.03);
        }

        .list-group-item:hover .icon-wrapper {
            transform: scale(1.1);
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .font-weight-medium text-light text-dark {
            font-weight: 500;
        }

        /* Status Badge */
        .status-badge {
            width: 15px;
            height: 15px;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .modal.fade .modal-dialog .modal-content {
            animation: fadeInUp 0.3s ease-out;
        }

        /* Dark mode support */
        .dark-mode .bg-light {
            background-color: #2d2d2d !important;
        }

        .dark-mode .list-group-item {
            background-color: transparent !important;
            border-color: #404040 !important;
        }

        .dark-mode .text-muted {
            color: #adb5bd !important;
        }

        .dark-mode .card.bg-primary.bg-opacity-10,
        .dark-mode .card.bg-success.bg-opacity-10 {
            background-color: rgba(230, 226, 226, 0.05) !important;
        }

        .dark-mode .icon-wrapper {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0;
            }

            .modal-content {
                border-radius: 0;
                min-height: 100vh;
            }

            .gap-2 {
                flex-direction: column;
            }

            .gap-2 .badge {
                width: 100%;
            }
        }

        /* Custom scrollbar for modal body */
        .modal-body::-webkit-scrollbar {
            width: 5px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        .modal-body::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Primary RGB for opacity */
        :root {
            --primary-rgb: 102, 126, 234;
        }

        .bg-primary.bg-opacity-10 {
            background-color: rgba(var(--primary-rgb), 0.1) !important;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            // Reset view when modal is closed
            $('#viewUser').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetView');
            });
        });
    </script>
</div>
