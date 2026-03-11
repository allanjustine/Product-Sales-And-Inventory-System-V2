<div>
    <!-- Modal Update User - Modern Edit Form Design -->
    <div wire:ignore.self class="modal fade" id="updateUser" tabindex="-1" role="dialog"
        aria-labelledby="updateUserModalTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0 shadow-lg">
                <!-- Header with gradient and icon -->
                <div class="modal-header bg-gradient-warning text-white py-3 border-0">
                    <h4 class="modal-title font-weight-bold" id="updateUserModalTitle">
                        <i class="fas fa-user-edit mr-2"></i>Edit User Profile
                    </h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4">
                    @if ($userEdit)
                        <form>
                            @csrf

                            <!-- Profile Image Section - Enhanced -->
                            <div class="text-center mb-4">
                                <label class="font-weight-bold text-muted mb-3 d-block">Profile Picture</label>
                                <div class="d-flex flex-column align-items-center">
                                    <!-- Image Preview Container -->
                                    <div class="position-relative mb-3">
                                        @if ($profile_image && in_array($profile_image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                            <div class="image-preview-wrapper">
                                                <img wire:target='profile_image' wire:loading.remove
                                                    src="{{ $profile_image->temporaryUrl() }}"
                                                    class="rounded-circle border border-4 border-warning shadow"
                                                    style="width: 140px; height: 140px; object-fit: cover;">
                                                <button type="button" wire:click='removeImage'
                                                    class="btn btn-danger btn-sm position-absolute rounded-circle"
                                                    style="top: 5px; right: 5px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;"
                                                    title="Remove new image">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @else
                                            <div class="current-image-wrapper position-relative">
                                                <img wire:target='profile_image' wire:loading.remove
                                                    src="{{ $profile_image_url }}"
                                                    class="rounded-circle border border-4 border-warning shadow"
                                                    style="width: 140px; height: 140px; object-fit: cover;"
                                                    onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/512/2919/2919906.png';">
                                                <span
                                                    class="position-absolute bg-secondary text-white px-2 py-1 rounded small"
                                                    style="bottom: -10px; left: 50%; transform: translateX(-50%); white-space: nowrap;">
                                                    <i class="fas fa-image mr-1"></i>Current
                                                </span>
                                            </div>
                                        @endif

                                        <!-- Loading Indicator -->
                                        <div wire:target='profile_image' wire:loading class="mt-2">
                                            <div class="spinner-border text-warning" role="status">
                                                <span class="sr-only">Uploading...</span>
                                            </div>
                                            <p class="text-muted small mt-1">Uploading new image...</p>
                                        </div>
                                    </div>

                                    <!-- Upload Controls -->
                                    <div class="upload-controls w-100" style="max-width: 300px;">
                                        <div class="custom-file mb-2">
                                            <input type="file" accept=".png,.jpg,.jpeg,.gif"
                                                class="custom-file-input @error('profile_image') is-invalid @enderror"
                                                id="profile_image_update" wire:model.live="profile_image">
                                            <label class="custom-file-label text-truncate" for="profile_image_update">
                                                <i class="fas fa-cloud-upload-alt mr-1"></i>
                                                {{ $profile_image ? $profile_image->getClientOriginalName() : 'Choose new image...' }}
                                            </label>
                                        </div>

                                        @error('profile_image')
                                            <span class="text-danger small d-block">
                                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                            </span>
                                        @enderror

                                        <small class="text-muted d-block mt-1">
                                            <i class="fas fa-info-circle mr-1"></i>Allowed: JPG, JPEG, PNG, GIF (Max
                                            2MB)
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Sections -->
                            <div class="row">
                                <!-- Account Information Card -->
                                <div class="col-12 mb-4">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-warning mb-3">
                                                <i class="fas fa-id-card mr-2"></i>Account Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="username-edit" class="font-weight-medium">
                                                            <i class="fas fa-at text-warning mr-1"></i>Username
                                                        </label>
                                                        <input type="text" class="form-control h-5" id="username-edit"
                                                            placeholder="Enter username" wire:model.live="username"
                                                            required>
                                                        @error('username')
                                                            <span class="text-danger small"><i
                                                                    class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email-edit" class="font-weight-medium">
                                                            <i class="fas fa-envelope text-warning mr-1"></i>Email
                                                            Address
                                                        </label>
                                                        <input type="email" class="form-control h-5" id="email-edit"
                                                            placeholder="Enter email" wire:model.live="email" required>
                                                        @error('email')
                                                            <span class="text-danger small"><i
                                                                    class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Personal Information Card -->
                                <div class="col-12 mb-4">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-warning mb-3">
                                                <i class="fas fa-user-circle mr-2"></i>Personal Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name-edit" class="font-weight-medium">
                                                            <i class="fas fa-user text-warning mr-1"></i>Full Name
                                                        </label>
                                                        <input type="text" class="form-control h-5" id="name-edit"
                                                            placeholder="Enter full name" wire:model.live="name"
                                                            required>
                                                        @error('name')
                                                            <span class="text-danger small"><i
                                                                    class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gender-edit" class="font-weight-medium">
                                                            <i class="fas fa-venus-mars text-warning mr-1"></i>Gender
                                                        </label>
                                                        <select class="form-control h-5" id="gender-edit"
                                                            wire:model.live="gender" required>
                                                            <option value="" selected hidden>Select gender
                                                            </option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="text-danger small"><i
                                                                    class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="address-edit" class="font-weight-medium">
                                                            <i
                                                                class="fas fa-map-marker-alt text-warning mr-1"></i>Address
                                                        </label>
                                                        <textarea class="form-control h-5" id="address-edit" rows="2" placeholder="Enter complete address"
                                                            wire:model.live="address" required></textarea>
                                                        @error('address')
                                                            <span class="text-danger small"><i
                                                                    class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact & Role Card -->
                                <div class="col-12 mb-3">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-warning mb-3">
                                                <i class="fas fa-address-card mr-2"></i>Contact & Role
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone_number-edit" class="font-weight-medium">
                                                            <i class="fas fa-phone-alt text-warning mr-1"></i>Phone
                                                            Number
                                                        </label>
                                                        <input type="tel" class="form-control h-5"
                                                            id="phone_number-edit" placeholder="09XXXXXXXXX"
                                                            wire:model.live="phone_number" required>
                                                        @error('phone_number')
                                                            <span class="text-danger small"><i
                                                                    class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="role-edit" class="font-weight-medium">
                                                            <i class="fas fa-shield-alt text-warning mr-1"></i>User
                                                            Role
                                                        </label>
                                                        <select class="form-control h-5" id="role-edit"
                                                            wire:model.live="role" required>
                                                            <option value="" selected hidden>Select role</option>
                                                            @foreach ($roles as $role)
                                                                <option class="role-name"
                                                                    value="{{ $role->id }}">
                                                                    {{ $role->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('role')
                                                            <span class="text-danger small"><i
                                                                    class="fas fa-exclamation-circle"></i>
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Footer Note -->
                            <div class="alert alert-warning alert-dismissible fade show mt-3 mb-0 py-2"
                                role="alert">
                                <i class="fas fa-info-circle mr-2"></i>
                                <small>Fields marked with <span class="text-danger">*</span> are required</small>
                            </div>
                        </form>
                    @else
                        <!-- Enhanced Loading State -->
                        <div class="text-center py-5">
                            <div class="spinner-border text-warning mb-3" style="width: 3rem; height: 3rem;"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h5 class="text-muted">Loading user information...</h5>
                            <p class="text-muted small">Please wait while we fetch the data</p>
                        </div>
                    @endif
                </div>

                <!-- Modal Footer with Enhanced Buttons -->
                <div class="modal-footer bg-light border-top-0 px-4 py-3">
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"
                            id="closeModalUpdate">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-warning px-4" wire:click="updateUser"
                            wire:loading.attr="disabled" wire:target="updateUser,profile_image">
                            <!-- Loading State -->
                            <span wire:loading.remove wire:target="updateUser">
                                <i class="fas fa-save mr-2"></i> Update User
                            </span>
                            <span wire:loading wire:target="updateUser">
                                <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                                Updating...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles for Update Modal */
        .bg-gradient-warning {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
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

        /* Form Styles */
        .form-control h-5,
        .custom-file-label {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .form-control h-5:focus,
        .custom-file-label:focus {
            border-color: #f39c12;
            box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
        }

        .form-control h-5.is-invalid {
            border-color: #dc3545;
        }

        /* Card Styles */
        .card {
            border-radius: 12px;
            transition: all 0.3s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
        }

        /* Image Preview Styles */
        .image-preview-wrapper,
        .current-image-wrapper {
            position: relative;
            display: inline-block;
        }

        .image-preview-wrapper img,
        .current-image-wrapper img {
            transition: all 0.3s;
        }

        .image-preview-wrapper:hover img,
        .current-image-wrapper:hover img {
            transform: scale(1.05);
        }

        /* Custom File Input */
        .custom-file-label::after {
            content: "Browse";
            background-color: #f39c12;
            color: white;
            border-radius: 0 8px 8px 0;
        }

        .custom-file-label {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Animation */
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .modal.fade .modal-dialog .modal-content {
            animation: slideInRight 0.3s ease-out;
        }

        /* Dark Mode Support */
        .dark-mode .bg-light {
            background-color: #2d2d2d !important;
        }

        .dark-mode .card.bg-light {
            background-color: #2d2d2d !important;
        }

        .dark-mode .form-control h-5,
        .dark-mode .custom-file-label {
            background-color: #3d3d3d;
            border-color: #4d4d4d;
            color: #fff;
        }

        .dark-mode .form-control h-5:focus {
            background-color: #3d3d3d;
            color: #fff;
        }

        .dark-mode .custom-file-label::after {
            background-color: #f39c12;
            color: white;
        }

        .dark-mode .text-muted {
            color: #adb5bd !important;
        }

        .dark-mode .alert-warning {
            background-color: rgba(243, 156, 18, 0.2);
            border-color: #f39c12;
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 768px) {
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

            .upload-controls {
                max-width: 100% !important;
            }
        }

        /* Loading State */
        .spinner-border.text-warning {
            border-color: #f39c12;
            border-right-color: transparent;
        }

        /* Font Weight */
        .font-weight-medium {
            font-weight: 500;
        }

        /* Image Comparison Tooltip */
        .position-absolute.bg-secondary {
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 10;
        }

        /* Hover Effects */
        .btn-warning {
            transition: all 0.3s;
        }

        .btn-warning:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
        }

        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.2);
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
            background: #f39c12;
            border-radius: 5px;
        }

        .modal-body::-webkit-scrollbar-thumb:hover {
            background: #e67e22;
        }

        /* Dark mode scrollbar */
        .dark-mode .modal-body::-webkit-scrollbar-track {
            background: #2d2d2d;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            // Reset form when modal is closed
            $('#updateUser').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });

            // Update custom file input label with selected filename
            $(document).on('change', '#profile_image_update', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html('<i class="fas fa-cloud-upload-alt mr-1"></i>' +
                    fileName);
            });
        });
    </script>
</div>
