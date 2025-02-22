<div>
    <!-- Modal Forgot Password-->
    <div wire:ignore.self class="modal fade" id="forgotPassword" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Forgot Password</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit="resetLink">
                        <p>Enter your email address and we'll send you a link to reset your password.</p>
                        <div class="form-floating mb-3">
                            <input type="email" wire:model.live.debounce.200ms="email" class="form-control" id="email"
                                placeholder="Email">
                            <label for="email">Email address</label>
                            @error('email')
                            <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button wire:loading.attr='disabled' wire:target='email' type="submit" class="btn btn-primary">
                                <span wire:loading wire:target='resetLink'><span
                                        class="spinner-border spinner-border-sm"></span> Sending...</span>
                                <span wire:loading.remove wire:target='resetLink'>
                                    Send Reset Link
                                </span>
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
