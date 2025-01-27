<div>
    <!-- Modal User Info -->
    <div wire:ignore.self class="modal fade" id="viewUser" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="modal-title" id="exampleModalLongTitle">User Info</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($userView)
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="card w-100 shadow-none">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ $userView->profile_image === null ? Storage::url('asset/profile-pic.jpg') : Storage::url($userView->profile_image) }}"
                                            style="height: 180px; width: 180px; border-radius: 50%;"
                                            alt="Profile picture">
                                        <h4 class="mb-0 mt-3">{{ $userView->name }}</h4>
                                        @if ($userView->isAdmin())
                                            <span class="badge badge-info">ADMIN</span>
                                        @else
                                            <span class="badge badge-warning">USER</span>
                                        @endif
                                        <hr>
                                        <p class="text-muted">{{ $userView->role }}</p>
                                    </div>
                                    <ul class="list-group list-group-flush mt-3">
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <strong>Email:</strong>
                                                <span>{{ $userView->email }}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <strong>Address:</strong>
                                                <span>{{ $userView->address }}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <strong>Gender</strong>
                                                <span>{{ $userView->gender }}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <strong>Status:</strong>
                                                @if ($userView->email_verified_at)
                                                    <span class="badge badge-success">VERIFIED</span>
                                                @else
                                                    <span class="badge badge-danger">UNVERIFIED</span>
                                                @endif
                                            </div>
                                        </li>
                                        <li class="list-group-item" hidden></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .dark-mode .list-group-item {
        color: white !important;
    }
</style>
