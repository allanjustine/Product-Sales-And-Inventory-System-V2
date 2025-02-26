<div>
    <!-- Modal Add User-->
    <div wire:ignore.self class="modal fade" id="addUser" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Add User</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Profile Image:</label>
                            <input type="file" accept=".png, .jpg, .jpeg, .gif" class="form-control"
                                id="create_profile_image" wire:model.live.debounce.200ms="profile_image" required>
                            <div wire:target='profile_image' class="mt-2" wire:loading>
                                <div class="spinner-border"></div> Uploading...
                            </div>
                            @if ($profile_image && in_array($profile_image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ $profile_image->temporaryUrl() }}" style="width: 100px; height: 100px;"
                                    class="mt-1 rounded">
                                    <button type="button" wire:click='removeImage' class="btn btn-danger">Remove</button>
                            @endif
                            @error('profile_image')
                                <span class="text-danger">*{{ $message }} (jpg, jpeg, png, gif) is only
                                    accepted.</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name"
                                        wire:model.live.debounce.200ms="name" required>
                                    @error('name')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" placeholder="Address"
                                        wire:model.live.debounce.200ms="address" required>
                                    @error('address')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password">Password:</label>
                                    <input type="password" id="password" placeholder="Password" name="password"
                                        wire:model.live.debounce.200ms="password" class="form-control">
                                    @error('password')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Confirm Password:</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        wire:model.live.debounce.200ms="password_confirmation" placeholder="Confirm Password"
                                        class="form-control">
                                    @error('password_confirmation')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" placeholder="Email" id="email"
                                wire:model.live.debounce.200ms="email" required>
                            @error('email')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="number" class="form-control" id="phone_number"
                                        placeholder="Phone Number (09-xxxxxxxxx)" wire:model.live.debounce.200ms="phone_number" required>
                                    @error('phone_number')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="gender">Gender:</label>
                                    <select class="form-select" id="gender" wire:model.live.debounce.200ms="gender" required>
                                        <option selected hidden="true">Select Gender</option>
                                        <option disabled>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:loading.attr="disabled" wire:target='addUser,profile_image' type="button" class="btn btn-primary" wire:click="addUser">
                        <div wire:loading class="spinner-border spinner-border-sm" wire:target='addUser'></div>&nbsp; <i class="fa-solid fa-plus" wire:loading.remove wire:target='addUser'></i> <span wire:loading.remove wire:target='addUser'>Add User</span> <span wire:loading wire:target='addUser'>Adding...</span>
                    </button>
                    <button type="button" class="btn btn-outline-warning" wire:click="resetInputs" wire:loading.attr='disabled' wire:target='resetInputs'><span wire:target='resetInputs' wire:loading.remove><i class="fa-solid fa-rotate"></i> Reset Inputs</span><span wire:target='resetInputs' wire:loading><span class="spinner-border spinner-border-sm"></span> Resetting..</span></button>
                    <button type="button" type="button" class="btn btn-secondary" id="closeModalAdd" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
