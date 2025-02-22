<div>

    <a href="#" id="loginhistory-btn" class="btn btn-primary btn-block" data-bs-toggle="modal"
        data-bs-target="#loginhistory" wire:click="showLoginHistory"><i class="fa-solid fa-history mr-2"></i><b>Login
            Activity
            History</b></a>

    <div wire:ignore.self class="modal fade" id="loginhistory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Login Activity History</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: scroll; overflow-x: hidden;">
                    <div class="row">
                        <div class="col-4 mb-2"><strong>IP Address</strong></div>
                        <div class="col-4 mb-2"><strong>Browser Login</strong></div>
                        <div class="col-4 mb-2"><strong>Timestamp</strong></div>
                        @if($histories)
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
                        @else
                       @for ($i = 0; $i < 6; $i++)
                       <div>
                            <span class="placeholder rounded mt-2 col-6" style="height: 20px;"></span>
                            <span class="placeholder rounded mt-2 w-75" style="height: 20px;"></span>
                            <span class="placeholder rounded mt-2" style="width: 200px; height: 20px;"></span>
                       </div>
                       @endfor
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
