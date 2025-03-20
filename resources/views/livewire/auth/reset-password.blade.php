<div>
    <div class="container mb-5">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card-img-top d-flex justify-content-center align-items-center mb-3">
                <div class="overflow-hidden" style="width: 150px; height: 150px;">
                    <img src="images/mylogo.jpg" class="w-100 h-100" alt="Reset Password Image">
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center">Reset Password &nbsp;
                        <span class="position-relative">
                            <span style="cursor: pointer;"
                                class="position-absolute bottom-0 translate-middle badge rounded-pill bg-dark"
                                id="login-pill">
                                <i class="fa-solid fa-question" wire:ignore.self data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Your resetting your password"></i>
                            </span>
                        </span>
                    </h3>
                    <hr>
                    <form wire:submit="resetPassword">

                        <div class="form-floating mt-3">
                            <input type="password" id="password" wire:model="password" class="form-control"
                                placeholder="New Password">
                            <label for="password"><i class="fas fa-lock"></i> New Password</label>
                        </div>

                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                                class="form-control" placeholder="Password_confirmation">
                            <label for="password_confirmation"><i class="fas fa-lock"></i> Confirm New Password</label>
                        </div>
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="d-flex mt-3">
                            <div class="flex-grow-1">
                                <p>Did you remember your password? <a href="/login" wire:navigate>Login</a></p>
                            </div>
                        </div>
                        <button type="submit" class="mt-3 btn btn-primary form-control">
                            <span wire:loading wire:target='resetPassword'><span
                                    class="spinner-border spinner-border-sm"></span> Resetting...</span>
                            <span wire:loading.remove wire:target='resetPassword'>
                                Reset Password
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:navigated', () => {
            @this.on('alert', (event) => {
                const {
                    title
                    , type
                    , message
                } = event.alerts;
                Swal.fire({
                    title: title
                    , text: message
                    , icon: type
                    , confirmButtonText: 'OK'
                    , showCloseButton: true,

                });
            });
        });

        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

</div>
