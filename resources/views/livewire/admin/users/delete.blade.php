<div>
    <!-- Modal Delete User-->
    <div wire:ignore.self class="modal fade" id="deleteUser" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to remove this user?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($userToDelete)
                            This user <strong>"{{ $userToDelete->name }}"</strong> will be removed to the table and will deleted permanently.
                    @else
                            Getting the user's information
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" wire:target='deleteUser' wire:loading.attr='disabled' wire:click="deleteUser"><div wire:loading wire:target="deleteUser" class="spinner-border spinner-border-sm"></div>&nbsp;<i
                        wire:target='deleteUser' wire:loading.remove class="fa-solid fa-trash"></i> Yes, Remove</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
