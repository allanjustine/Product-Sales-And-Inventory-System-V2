<div>
    <div class="container">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card-img-top d-flex justify-content-center align-items-center mb-3">
                <div class="overflow-hidden" style="width: 150px; height: 150px;">
                    <img src="images/mylogo.jpg" class="w-100 h-100" alt="Login Image">
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center">Register &nbsp; <span class="position-relative">
                            <span style="cursor: pointer;"
                                class="position-absolute bottom-0 translate-middle badge rounded-pill bg-dark"
                                id="login-pill">
                                <i class="fa-solid fa-question" wire:ignore.self data-toggle="tooltip"
                                    data-placement="top" title="Register an account to continue"></i>
                            </span>
                        </span></h3>
                    <hr>
                    <form wire:submit="register">
                        <div class="d-flex flex-column gap-2 align-items-center justify-content-center">
                            <div class="position-relative">
                                @if($profile_image)
                                <button type="button"
                                    class="btn btn-secondary px-2 py-1 rounded-circle btn-sm position-absolute top-0 end-0"
                                    wire:click="removeProfileImage"><i class="far fa-xmark"></i></button>
                                @endif
                                <img wire:target="profile_image" style="width: 120px; height: 120px;" wire:loading
                                    class="rounded-circle img-fluid"
                                    src="https://assets-v2.lottiefiles.com/a/eca613de-1151-11ee-ab90-2708ab72937c/Pt7BWGiXJy.gif"
                                    alt="loading">
                                <img wire:target="profile_image" style="width: 120px; height: 120px;"
                                    wire:loading.remove src="{{ $profile_image ? $profile_image->temporaryUrl() : "
                                    https://cdn-icons-png.flaticon.com/512/2919/2919906.png" }}" alt=""
                                    class="rounded-circle img-fluid">
                            </div>
                            <button wire:loading.attr='disabled' wire:target='profile_image' type="button"
                                class="btn btn-primary" onclick="document.getElementById('profile_image').click()">
                                <span wire:loading wire:target='profile_image'><span
                                        class="spinner-border spinner-border-sm"></span> Uploading...</span>
                                <span wire:loading.remove wire:target='profile_image'>Upload photo</span>
                            </button>
                            <input type="file" hidden class="form-control" accept=".png, .jpg, .jpeg, .gif"
                                id="profile_image" wire:model.live="profile_image">
                            @error('profile_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating mt-3">
                            <input type="text" id="name" wire:model.live.debounce.200ms="name" class="form-control"
                                placeholder="Name">
                            <label for="name">Name</label>
                        </div>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="text" id="address" wire:model.live.debounce.200ms="address"
                                class="form-control" placeholder="Address">
                            <label for="address">Address</label>
                        </div>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="email" id="email" wire:model.live="email" class="form-control"
                                placeholder="Email">
                            <label for="email">Email</label>
                        </div>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="password" id="password" wire:model.live.debounce.200ms="password"
                                placeholder="Password" class="form-control">
                            <button type="button"
                                class="position-absolute no-focus top-50 end-0 mr-2 translate-middle-y"
                                onclick="togglePasswordVisibility()">
                                <i id="password-toggle-icon" class="fas fa-eye-slash"></i>
                            </button>
                            <label for="password">Password</label>
                        </div>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="password" id="password_confirmation" placeholder="Confirm Password"
                                wire:model.live.debounce.200ms="password_confirmation" class="form-control">
                            <button type="button"
                                class="position-absolute no-focus top-50 end-0 mr-2 translate-middle-y"
                                onclick="toggleConfirmPasswordVisibility()">
                                <i id="password_confirmation-toggle-icon" class="fas fa-eye-slash"></i>
                            </button>
                            <label for="password_confirmation">Confirm Password</label>
                        </div>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <select name="gender" id="" class="form-select" wire:model.live.debounce.200ms="gender"
                            >
                                <option hidden="true">Select Gender</option>
                                <option selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="password_confirmation">Select Gender</label>
                            @error('gender')
                            <p class="text-danger" id="messagee">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mt-3">
                            <input type="number" id="phone_number" wire:model.live="phone_number" class="form-control"
                                placeholder="Phone Number">
                            <label for="phone_number">Phone Number: (09-xxxxxxxxx) (must 11 digits)</label>
                        </div>
                        @error('phone_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="d-flex mt-3">
                            <div class="flex-grow-1">
                                <p><input type="checkbox"> I agree to the <a href="/terms-and-conditions"
                                        target="_" class="text-primary">Terms &
                                        Conditions</a>.</p>
                                <p>Already have an account? <a href="/login" wire:navigate>Login</a></p>
                            </div>
                        </div>
                        <button type="submit" class="mt-3 btn btn-primary form-control">
                            <span wire:loading wire:target='register'><span class="spinner-border spinner-border-sm"></span> Registering...</span>
                            <span wire:loading.remove wire:target='register'>Register</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        .no-focus:focus {
            outline: none;
        }

        .no-focus {
            border: none;
            background: transparent;
            font-size: 18px;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <script>
        $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var passwordToggleIcon = document.getElementById("password-toggle-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggleIcon.classList.remove("fa-eye-slash");
            passwordToggleIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            passwordToggleIcon.classList.remove("fa-eye");
            passwordToggleIcon.classList.add("fa-eye-slash");
        }
    }

    function toggleConfirmPasswordVisibility() {
        var passwordInput = document.getElementById("password_confirmation");
        var passwordToggleIcon = document.getElementById("password_confirmation-toggle-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggleIcon.classList.remove("fa-eye-slash");
            passwordToggleIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            passwordToggleIcon.classList.remove("fa-eye");
            passwordToggleIcon.classList.add("fa-eye-slash");
        }
    }



    </script>
</div>
