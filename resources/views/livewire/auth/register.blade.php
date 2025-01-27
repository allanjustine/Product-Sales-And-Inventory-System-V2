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
                                <i class="fa-solid fa-question" data-toggle="tooltip" data-placement="top"
                                    title="Register an account to continue"></i>
                            </span>
                        </span></h3>
                    <hr>
                    <form wire:submit="register">
                        <div class="form-floating">
                            <input type="file" class="form-control" accept=".png, .jpg, .jpeg, .gif"
                                id="profile_image" wire:model.live="profile_image">
                            <label for="profile_image" class=" p-2">Select Profile Image: (jpg, jpeg, png,
                                gif)</label>
                            @if ($profile_image && in_array($profile_image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ $profile_image->temporaryUrl() }}" style="width: 120px; height:120px;"
                                    class="mt-1">
                            @endif
                        </div>
                        @error('profile_image')
                            <span class="text-danger">{{ $message }} (jpg, jpeg, png, gif) is only accepted.</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="text" id="name" wire:model.live.debounce.200ms="name" class="form-control"
                                placeholder="Name" required>
                            <label for="name">Name</label>
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="text" id="address" wire:model.live.debounce.200ms="address" class="form-control"
                                placeholder="Address" required>
                            <label for="address">Address</label>
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="email" id="email" wire:model.live="email" class="form-control"
                                placeholder="Email" required>
                            <label for="email">Email</label>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="password" id="password" wire:model.live.debounce.200ms="password" placeholder="Password"
                                class="form-control" required>
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
                                wire:model.live.debounce.200ms="password_confirmation" class="form-control" required>
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
                                required>
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
                                placeholder="Phone Number" required>
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
                                <p href="/register">Already have an account? <a href="/login">Login</a></p>
                            </div>
                        </div>
                        <button type="submit" class="mt-3 btn btn-primary form-control">Register</button>
                    </form>
                </div>
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
