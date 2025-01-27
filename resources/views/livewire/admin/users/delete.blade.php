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
                @if ($userToDelete)
                    <div class="modal-body">
                        This user <strong>"{{ $userToDelete->name }}"</strong> will be removed to the table and will deleted permanently.
                    </div>
                @endif
                <div class="modal-footer">
                    <button class="btn btn-danger" wire:click="deleteUser()"><div wire:loading><svg class="loading"></svg></div>&nbsp;<i
                        class="fa-solid fa-trash"></i> Yes, Remove</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
