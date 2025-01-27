<div>

    <a href="#" id="loginhistory-btn" class="btn btn-primary btn-block" data-toggle="modal" data-target="#loginhistory"
        wire:click="showLoginHistory()"><i class="fa-solid fa-history mr-2"></i><b>Login Activity
            History</b></a>

    <div wire:ignore.self class="modal fade" id="loginhistory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Login Activity History</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 mb-2"><strong>IP Address</strong></div>
                        <div class="col-4 mb-2"><strong>Browser Login</strong></div>
                        <div class="col-4 mb-2"><strong>Timestamp</strong></div>
                        @foreach ($histories as $history)
                            <hr>
                            <div class="col-4">
                                {{ $history->ip_address }}
                            </div>
                            <div class="col-4">
                                {{ $history->browser_address }}
                            </div>
                            <div class="col-4">
                                {{ $history->created_at->format('F d, Y h:i A') }} -
                                <span class="text-muted"><i>{{ $history->created_at->diffForHumans() }}</i></span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
