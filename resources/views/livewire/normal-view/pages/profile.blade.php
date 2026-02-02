<div>
    <section class="content py-2 mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="card-body p-2 p-lg-5">
                            <div class="text-center mb-5 position-relative">
                                <div wire:loading wire:target="updatePhoto, profile_image" class="loading-overlay">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div class="spinner-grow text-primary mb-3" style="width: 4rem; height: 4rem;"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="text-muted">Uploading...</p>
                                    </div>
                                </div>

                                <div wire:loading.remove wire:target="updatePhoto, profile_image"
                                    class="position-relative d-inline-block profile-image-container">
                                    <div class="profile-image-wrapper">
                                        @if ($profile_image && in_array($profile_image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ $profile_image->temporaryUrl() }}"
                                                alt="{{ $user->name }} photo" id="photo"
                                                style="height: auto; width: auto; border-radius: 50%;">
                                        @else
                                            @if (!$profile_image)
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ Auth::user()->profile_image === null
                                                        ? "
                                                                                                                                                                                                                                                                                                                                                                https://cdn-icons-png.flaticon.com/512/2919/2919906.png"
                                                        : Storage::url(Auth::user()->profile_image) }}"
                                                    alt="{{ $user->name }} photo" id="photo"
                                                    style="height: auto; width: auto; border-radius: 50%;">
                                            @endif
                                            @if ($profile_image)
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ Auth::user()->profile_image === null
                                                        ? "
                                                                                                                                                                                                                                                                                                                                                                https://cdn-icons-png.flaticon.com/512/2919/2919906.png"
                                                        : Storage::url(Auth::user()->profile_image) }}"
                                                    alt="{{ $user->name }} photo" id="photo"
                                                    style="height: auto; width: auto; border-radius: 50%;"><br>
                                                <span
                                                    class="text-danger">*{{ $profile_image->getClientOriginalExtension() }}
                                                    is not a valid image type. Only (jpg, jpeg, png, gif) are
                                                    accepted.</span><br>
                                            @endif
                                        @endif

                                        <div class="profile-image-overlay rounded-circle">
                                            <label for="profile_image"
                                                class="profile-upload-label btn btn-primary btn-sm rounded-pill shadow-sm">
                                                <i class="fas fa-camera me-1"></i>
                                                <span class="d-none d-sm-inline">Change</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <form id="myform" wire:submit="updatePhoto" enctype="multipart/form-data"
                                    class="mt-4">
                                    <input type='file' id="profile_image" class="d-none"
                                        accept=".png, .jpg, .jpeg, .gif" wire:model.live="profile_image"
                                        wire:loading.attr="disabled" />

                                    @if ($profile_image)
                                        <div class="d-grid gap-2 d-sm-flex justify-content-center mt-3">
                                            <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">
                                                <span wire:loading.remove wire:target="updatePhoto">
                                                    <i class="fa-solid fa-cloud-arrow-up me-2"></i>Save Photo
                                                </span>
                                                <span wire:loading wire:target="updatePhoto">
                                                    <span class="spinner-border spinner-border-sm me-2" role="status"
                                                        aria-hidden="true"></span>
                                                    Saving...
                                                </span>
                                            </button>
                                        </div>
                                    @endif
                                </form>
                            </div>

                            <div class="text-center mb-4">
                                <h3 class="h2 fw-bold mb-2">
                                    {{ $user->name }}
                                    @if (auth()->user()->email_verified_at)
                                        <i class="fas fa-badge-check text-primary ms-2" style="font-size: 1.25rem;"></i>
                                    @endif
                                </h3>

                                <span class="badge bg-primary bg-gradient rounded-pill px-3 py-2 mb-3">
                                    @if ($user->isAdmin())
                                        <i class="fas fa-shield-alt me-2"></i>Administrator
                                    @else
                                        <i class="fas fa-user me-2"></i>User
                                    @endif
                                </span>
                            </div>

                            <div class="profile-details mt-5">
                                <h5 class="fw-bold text-uppercase text-muted mb-4">
                                    <i class="fas fa-id-card me-2"></i>Profile Information
                                </h5>

                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="card h-100 border-0 bg-light-subtle rounded-3">
                                            <div class="card-body p-2">
                                                <div class="d-flex align-items-start">
                                                    <div
                                                        class="icon-wrapper bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                                        <i class="fas fa-map-marker-alt text-white fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-semibold text-muted mb-2">Address</h6>
                                                        <p class="mb-0 text-dark fs-6">
                                                            {{ $user->address ?? 'Not provided' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="card h-100 border-0 bg-light-subtle rounded-3">
                                            <div class="card-body p-2">
                                                <div class="d-flex align-items-start">
                                                    <div
                                                        class="icon-wrapper bg-info bg-opacity-10 p-3 rounded-circle me-3">
                                                        <i class="fas fa-envelope text-white fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-semibold text-muted mb-2">Email</h6>
                                                        <p class="mb-0 text-dark fs-6">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="card h-100 border-0 bg-light-subtle rounded-3">
                                            <div class="card-body p-2">
                                                <div class="d-flex align-items-start">
                                                    <div
                                                        class="icon-wrapper bg-success bg-opacity-10 p-3 rounded-circle me-3">
                                                        <i class="fas fa-phone text-white fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-semibold text-muted mb-2">Phone</h6>
                                                        <p class="mb-0 text-dark fs-6">
                                                            {{ $user->phone_number ?? 'Not provided' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="card h-100 border-0 bg-light-subtle rounded-3">
                                            <div class="card-body p-2">
                                                <div class="d-flex align-items-start">
                                                    <div
                                                        class="icon-wrapper bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                                                        @if ($user->gender === 'Male')
                                                            <i class="fas fa-mars text-white fs-5"></i>
                                                        @else
                                                            <i class="fas fa-venus text-white fs-5"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-semibold text-muted mb-2">Gender</h6>
                                                        <p class="mb-0 text-dark fs-6">
                                                            {{ $user->gender ?? 'Not specified' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 pt-4 border-top">
                                @livewire('auth.user-login-history')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9" id="info-box">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="card-header bg-gradient-primary text-white p-4 border-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper rounded-circle p-2 me-3">
                                        <i class="fas fa-user-circle fa-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="card-title mb-0 fw-bold">About Me</h3>
                                        <br>
                                        <p class="mb-0 opacity-75">Update your personal information</p>
                                    </div>
                                </div>
                                <button type="button" id="save-btn"
                                    class="btn btn-light btn-lg px-4 rounded-pill fw-semibold shadow-sm"
                                    wire:click="updateProfile" wire:loading.attr="disabled">
                                    <span wire:loading wire:target="updateProfile">
                                        <span class="spinner-border spinner-border-sm me-2"></span>Saving...
                                    </span>
                                    <span wire:loading.remove wire:target="updateProfile">
                                        <i class="fas fa-save me-2"></i>Save Changes
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            <form class="form-horizontal" id="info-form">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="section-header mb-4">
                                            <h5 class="fw-semibold text-primary mb-3">
                                                <i class="fas fa-id-card me-2"></i>Personal Information
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control form-control-lg rounded-3"
                                                id="inputName" name="name" placeholder="Full Name"
                                                wire:model.live.debounce.200ms="name" required>
                                            <label for="inputName" class="text-muted">
                                                <i class="fas fa-user me-2"></i>Full Name
                                            </label>
                                        </div>
                                        @error('name')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control form-control-lg rounded-3"
                                                id="username" name="username" placeholder="Username"
                                                wire:model.live.debounce.200ms="username" required>
                                            <label for="username" class="text-muted">
                                                <i class="fas fa-at me-2"></i>Username
                                            </label>
                                        </div>
                                        @error('username')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control form-control-lg rounded-3"
                                                id="inputAddress" name="address" placeholder="Home Address"
                                                wire:model.live.debounce.200ms="address" required>
                                            <label for="inputAddress" class="text-muted">
                                                <i class="fas fa-home me-2"></i>Home Address
                                            </label>
                                        </div>
                                        @error('address')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control form-control-lg rounded-3"
                                                id="inputUser_location" name="user_location"
                                                placeholder="Delivery Address"
                                                wire:model.live.debounce.200ms="user_location" required>
                                            <label for="inputUser_location" class="text-muted">
                                                <i class="fas fa-truck me-2"></i>Delivery Address
                                            </label>
                                        </div>
                                        @error('user_location')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control form-control-lg rounded-3"
                                                name="phone" id="inputPhone" placeholder="Phone Number"
                                                wire:model.live.debounce.200ms="phone_number" required>
                                            <label for="inputPhone" class="text-muted">
                                                <i class="fas fa-phone me-2"></i>Phone Number
                                            </label>
                                        </div>
                                        @error('phone_number')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control form-control-lg rounded-3"
                                                name="email" id="inputEmail" placeholder="Email Address"
                                                wire:model.live.debounce.200ms="email" required>
                                            <label for="inputEmail" class="text-muted">
                                                <i class="fas fa-envelope me-2"></i>Email Address
                                            </label>
                                        </div>
                                        @error('email')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select form-select-lg rounded-3" name="gender"
                                                id="inputGender" wire:model.live.debounce.200ms="gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <label for="inputGender" class="text-muted">
                                                <i class="fas fa-venus-mars me-2"></i>Gender
                                            </label>
                                        </div>
                                        @error('gender')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </form>

                            <div class="password-section mt-5 pt-4 border-top">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas fa-key text-white"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-semibold mb-1">Change Password</h5>
                                            <p class="text-muted small mb-0">Update your account security</p>
                                        </div>
                                    </div>
                                    <button type="button" id="save-pass-btn"
                                        class="btn btn-warning btn-lg px-4 rounded-pill text-white fw-semibold shadow-sm"
                                        wire:click="changePassword" wire:loading.attr="disabled">
                                        <span wire:loading wire:target='changePassword'>
                                            <span class="spinner-border spinner-border-sm me-2"></span>Saving...
                                        </span>
                                        <span wire:loading.remove wire:target='changePassword'>
                                            <i class="fas fa-lock me-2"></i>Update Password
                                        </span>
                                    </button>
                                </div>

                                <div class="row g-4">
                                    <div class="col-12 col-md-4">
                                        <div class="form-floating position-relative">
                                            <input type="password" class="form-control form-control-lg rounded-3"
                                                name="oldPass" id="oldPassword" placeholder="Old Password"
                                                wire:model.live.debounce.200ms="oldPassword">
                                            <label for="oldPassword" class="text-muted">
                                                <i class="fas fa-lock me-2"></i>Old Password
                                            </label>
                                            <button onclick="handleShowPassword('old')" type="button"
                                                class="btn btn-link position-absolute end-0 top-50 translate-middle-y me-3 toggle-password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('oldPassword')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-floating position-relative">
                                            <input type="password" class="form-control form-control-lg rounded-3"
                                                name="newpass" id="password" placeholder="New Password"
                                                wire:model.live.debounce.200ms="password">
                                            <label for="password" class="text-muted">
                                                <i class="fas fa-lock me-2"></i>New Password
                                            </label>
                                            <button onclick="handleShowPassword('new')" type="button"
                                                class="btn btn-link position-absolute end-0 top-50 translate-middle-y me-3 toggle-password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-floating position-relative">
                                            <input type="password" class="form-control form-control-lg rounded-3"
                                                name="cpass" id="password_confirmation"
                                                placeholder="Confirm Password"
                                                wire:model.live.debounce.200ms="password_confirmation">
                                            <label for="password_confirmation" class="text-muted">
                                                <i class="fas fa-lock me-2"></i>Confirm Password
                                            </label>
                                            <button onclick="handleShowPassword('confirm')" type="button"
                                                class="btn btn-link position-absolute end-0 top-50 translate-middle-y me-3 toggle-password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password_confirmation')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4" id="password-strength" style="display: none;">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-2">Password Strength:</span>
                                        <div class="strength-bar flex-grow-1"
                                            style="height: 6px; background: #e9ecef; border-radius: 3px;">
                                            <div class="strength-fill"
                                                style="height: 100%; width: 0%; border-radius: 3px; transition: all 0.3s ease;">
                                            </div>
                                        </div>
                                        <span class="strength-text ms-2 small">Weak</span>
                                    </div>
                                    <div class="password-requirements small text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Use at least 8 characters with a mix of letters, numbers, and symbols
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <style>
        .profile-pic-div .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .profile-pic-div .avatar-edit input {
            display: none;
        }

        .profile-pic-div .avatar-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .profile-pic-div .avatar-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .profile-pic-div .avatar-edit input+label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .profile-image-container {
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }

        .profile-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .profile-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            cursor: pointer;
        }

        .profile-image-wrapper:hover .profile-image-overlay {
            opacity: 1;
        }

        .profile-image-wrapper:hover .profile-image {
            transform: scale(1.05);
        }

        .profile-upload-label {
            background: rgba(255, 255, 255, 0.9);
            color: #0d6efd;
            border: none;
            padding: 0.5rem 1rem;
        }

        .profile-upload-label:hover {
            background: white;
            color: #0d6efd;
            transform: translateY(-2px);
        }

        .loading-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem !important;
            }

            .profile-image-container {
                width: 120px;
                height: 120px;
            }

            .profile-details .card-body {
                padding: 1rem !important;
            }

            .icon-wrapper {
                padding: 0.75rem !important;
            }
        }

        @media (max-width: 576px) {
            .profile-image-container {
                width: 100px;
                height: 100px;
            }

            h3.h2 {
                font-size: 1.5rem;
            }

            .profile-upload-label span {
                display: none;
            }

            .profile-upload-label i {
                margin: 0 !important;
            }
        }

        .card,
        .btn,
        .profile-image,
        .profile-upload-label {
            transition: all 0.3s ease;
        }

        /* Icon wrapper hover effects */
        .icon-wrapper {
            transition: transform 0.3s ease;
        }

        .icon-wrapper:hover {
            transform: translateY(-3px);
        }
    </style>

    <script>
        const oldPasswordInput = document.getElementById('oldPassword');
        const newPasswordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        function handleShowPassword(type) {
            if (type === 'old') {
                oldPasswordInput.type = oldPasswordInput.type === 'password' ? 'text' : 'password';
            } else if (type === 'new') {
                newPasswordInput.type = newPasswordInput.type === 'password' ? 'text' : 'password';
            } else if (type === 'confirm') {
                confirmPasswordInput.type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
            }
        }
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('alert', function(event) {
                const {
                    type,
                    message,
                    title
                } = event.alerts;
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    title: title,
                    text: message,
                    icon: type,
                })
            })
        })
    </script>
</div>
