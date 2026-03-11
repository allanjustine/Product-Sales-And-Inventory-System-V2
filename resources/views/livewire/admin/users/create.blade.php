<div>
    <!-- Modal Add User - Modern Redesign -->
    <div wire:ignore.self class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserModalTitle"
        aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <!-- Header with gradient background -->
                <div class="modal-header bg-gradient-primary text-white py-3 border-0 rounded-top">
                    <h4 class="modal-title font-weight-bold" id="addUserModalTitle">
                        <i class="fas fa-user-plus mr-2"></i>Create New User
                    </h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body with improved spacing -->
                <div class="modal-body p-4">
                    <form>
                        @csrf

                        <!-- Profile Image Section - Redesigned -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if ($profile_image && in_array($profile_image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                    <div class="avatar-preview-wrapper">
                                        <img src="{{ $profile_image->temporaryUrl() }}"
                                            class="rounded-circle border border-4 border-primary shadow"
                                            style="width: 120px; height: 120px; object-fit: cover;">
                                        <button type="button" wire:click='removeImage'
                                            class="btn btn-danger btn-sm position-absolute rounded-circle"
                                            style="top: 5px; right: 5px; width: 30px; height: 30px;"
                                            title="Remove image">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="avatar-upload-wrapper">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border border-3 border-dashed border-primary"
                                            style="width: 120px; height: 120px; cursor: pointer;"
                                            onclick="document.getElementById('create_profile_image').click();">
                                            <i class="fas fa-camera fa-3x text-muted"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-3">
                                <label for="create_profile_image" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-upload mr-1"></i>Choose Profile Image
                                </label>
                                <input type="file" accept=".png,.jpg,.jpeg,.gif" class="d-none"
                                    id="create_profile_image" wire:model.live="profile_image">

                                <div wire:loading wire:target="profile_image" class="mt-2">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    <span class="ml-2 text-muted small">Uploading...</span>
                                </div>

                                @error('profile_image')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror

                                <p class="text-muted small mt-2 mb-0">
                                    <i class="fas fa-info-circle mr-1"></i>Allowed: JPG, JPEG, PNG, GIF (Max 2MB)
                                </p>
                            </div>
                        </div>

                        <!-- Form Fields - Organized in cards -->
                        <div class="row">
                            <!-- Personal Information Card -->
                            <div class="col-12 mb-4">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-primary mb-3">
                                            <i class="fas fa-user mr-2"></i>Personal Information
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="font-weight-medium">Full Name <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-right-0">
                                                                <i class="fas fa-user text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control h-5 border-left-0"
                                                            id="name" placeholder="Enter full name"
                                                            wire:model.live="name" required>
                                                    </div>
                                                    @error('name')
                                                        <span class="text-danger small"><i
                                                                class="fas fa-exclamation-circle"></i>
                                                            {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="gender" class="font-weight-medium">Gender <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-right-0">
                                                                <i class="fas fa-venus-mars text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <select class="form-control h-5 border-left-0" id="gender"
                                                            wire:model.live="gender" required>
                                                            <option value="" selected hidden>Select gender
                                                            </option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    @error('gender')
                                                        <span class="text-danger small"><i
                                                                class="fas fa-exclamation-circle"></i>
                                                            {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="address" class="font-weight-medium">Address <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-right-0">
                                                                <i class="fas fa-map-marker-alt text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control h-5 border-left-0"
                                                            id="address" placeholder="Enter complete address"
                                                            wire:model.live="address" required>
                                                    </div>
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

                            <!-- Account Information Card -->
                            <div class="col-12 mb-4">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-primary mb-3">
                                            <i class="fas fa-lock mr-2"></i>Account Information
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="font-weight-medium">Email <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-right-0">
                                                                <i class="fas fa-envelope text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email" class="form-control h-5 border-left-0"
                                                            id="email" placeholder="example@email.com"
                                                            wire:model.live="email" required>
                                                    </div>
                                                    @error('email')
                                                        <span class="text-danger small"><i
                                                                class="fas fa-exclamation-circle"></i>
                                                            {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="username" class="font-weight-medium">Username <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-right-0">
                                                                <i class="fas fa-at text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control h-5 border-left-0"
                                                            id="username" placeholder="Choose username"
                                                            wire:model.live="username" required>
                                                    </div>
                                                    @error('username')
                                                        <span class="text-danger small"><i
                                                                class="fas fa-exclamation-circle"></i>
                                                            {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password" class="font-weight-medium">Password <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-right-0">
                                                                <i class="fas fa-key text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password"
                                                            class="form-control h-5 border-left-0 border-right-0"
                                                            id="password" placeholder="Enter password"
                                                            wire:model.live="password" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-white"
                                                                onclick="togglePassword('password')"
                                                                style="cursor: pointer;">
                                                                <i class="fas fa-eye text-muted toggle-password"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @error('password')
                                                        <span class="text-danger small"><i
                                                                class="fas fa-exclamation-circle"></i>
                                                            {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password_confirmation"
                                                        class="font-weight-medium">Confirm Password <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-right-0">
                                                                <i class="fas fa-check-circle text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password"
                                                            class="form-control h-5 border-left-0 border-right-0"
                                                            id="password_confirmation" placeholder="Confirm password"
                                                            wire:model.live="password_confirmation" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-white"
                                                                onclick="togglePassword('password_confirmation')"
                                                                style="cursor: pointer;">
                                                                <i
                                                                    class="fas fa-eye text-muted toggle-confirm-password"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @error('password_confirmation')
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

                            <!-- Contact Information Card -->
                            <div class="col-12">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-primary mb-3">
                                            <i class="fas fa-phone-alt mr-2"></i>Contact Information
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="phone_number" class="font-weight-medium">Phone Number
                                                        <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-right-0">
                                                                <i class="fas fa-phone text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="tel" class="form-control h-5 border-left-0"
                                                            id="phone_number" placeholder="09XXXXXXXXX"
                                                            wire:model.live="phone_number" required>
                                                    </div>
                                                    @error('phone_number')
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
                    </form>
                </div>

                <!-- Footer with improved button styling -->
                <div class="modal-footer bg-light border-top-0 px-4 py-3">
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <div>
                            <button type="button" class="btn btn-outline-warning" wire:click="resetInputs"
                                wire:loading.attr='disabled' wire:target='resetInputs'>
                                <span wire:target='resetInputs' wire:loading.remove>
                                    <i class="fas fa-undo-alt mr-1"></i> Reset
                                </span>
                                <span wire:target='resetInputs' wire:loading>
                                    <span class="spinner-border spinner-border-sm mr-1"></span> Resetting...
                                </span>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary mr-2" id="closeModalAdd"
                                data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i> Cancel
                            </button>
                            <button type="button" class="btn btn-primary" wire:click="addUser"
                                wire:loading.attr="disabled" wire:target="addUser,profile_image">
                                <div wire:loading class="spinner-border spinner-border-sm mr-1" wire:target="addUser">
                                </div>
                                <span wire:loading.remove wire:target="addUser">
                                    <i class="fas fa-save mr-1"></i> Create User
                                </span>
                                <span wire:loading wire:target="addUser">Creating...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles for the modal */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .border-4 {
            border-width: 4px !important;
        }

        .border-dashed {
            border-style: dashed !important;
        }

        .card {
            border-radius: 12px;
            transition: all 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .input-group-text {
            border-radius: 8px 0 0 8px;
            background: white;
        }

        .form-control h-5 {
            border-radius: 0 8px 8px 0;
            border-left: none;
            padding: 10px 15px;
        }

        .form-control h-5:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            border-radius: 8px;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control h-5 {
            border-color: #667eea;
        }

        .font-weight-medium {
            font-weight: 500;
        }

        /* Avatar upload styles */
        .avatar-upload-wrapper .bg-light {
            transition: all 0.3s;
            cursor: pointer;
        }

        .avatar-upload-wrapper .bg-light:hover {
            background-color: #e9ecef !important;
            border-color: #667eea !important;
        }

        .avatar-preview-wrapper {
            position: relative;
            display: inline-block;
        }

        /* Animation */
        @keyframes slideIn {
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
            animation: slideIn 0.3s ease-out;
        }

        /* Dark mode support */
        .dark-mode .bg-light {
            background-color: #343a40 !important;
        }

        .dark-mode .card.bg-light {
            background-color: #2d2d2d !important;
        }

        .dark-mode .input-group-text,
        .dark-mode .form-control h-5 {
            background-color: #3d3d3d;
            border-color: #4d4d4d;
            color: #fff;
        }

        .dark-mode .input-group-text {
            color: #adb5bd;
        }

        .dark-mode .modal-content {
            background-color: #2d2d2d;
        }

        .dark-mode .modal-footer {
            background-color: #252525 !important;
        }

        .dark-mode .text-muted {
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

            .modal-footer .w-100>div {
                width: 100%;
                display: flex;
                justify-content: space-between;
            }
        }
    </style>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);

            // Toggle icon
            const icon = field.parentElement.querySelector('.fa-eye, .fa-eye-slash');
            if (icon) {
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            }
        }

        // Trigger file input when clicking the upload button
        document.addEventListener('livewire:navigated', function() {
            const uploadBtn = document.querySelector(
                '[onclick="document.getElementById(\'create_profile_image\').click();"]');
            if (uploadBtn) {
                uploadBtn.onclick = function() {
                    document.getElementById('create_profile_image').click();
                };
            }
        });
    </script>
</div>
