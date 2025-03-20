<div>

    <div class="container">
        <h3 class="mb-4 mt-3"><i class="fa-light fa-comment-dots"></i> Send Us Feedback</h3>
        <hr>
        <h5 class="text-center">Welcome to our feedback page! We value your feedback and stories. Whether you have a
            question, want to share a testimony,
            or report an issue, we’re here for you. Fill out the form below and we’ll get back to you as soon as
            possible.</h5>
        <br>
    </div>
    <hr>
    <div class="container mt-4">
        <div class="card rounded elevation-3 col-md-6 offset-md-3">
            <div class="card-header">
                <h5 class="text-center mt-3 mb-3"><i class="fa-light fa-comment-dots"></i> Send Us Your Feedback or
                    Testimony.</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div>
                        <form wire:submit="submit">
                            @csrf
                            <label for="name">Name:</label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" @if (auth()->check()) readonly @endif id="name"
                                placeholder="Enter your name" wire:model.live.debounce.200ms="name">
                                <label for="name">Name:</label>
                            </div>
                            @error('name')
                            <span class="text-danger">*{{ $message }}</span>
                            @enderror
                            <br>
                            <label for="email">Email address:</label>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" @if (auth()->check()) readonly @endif
                                id="email"
                                placeholder="Enter email" wire:model.live.debounce.200ms="email">
                                <label for="email">Email address:</label>
                            </div>
                            @error('email')
                            <span class="text-danger">*{{ $message }}</span>
                            @enderror
                            <br>
                            <div class="form-group mb-3">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Message..."
                                    wire:model.live.debounce.200ms="message"></textarea>
                            </div>
                            @error('message')
                            <span class="text-danger">*{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn btn-primary btn-block">
                                <span wire:target="submit" wire:loading.remove>
                                    <i class="fa-solid fa-paper-plane"></i> Submit
                                </span>
                                <span wire:target="submit" wire:loading>
                                    <span class="spinner-border spinner-border-sm"></span> Submitting...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', function() {
            @this.on('alert', function(event) {
                const { title, type, message } = event.alerts;

                Swal.fire({
                    title: title,
                    icon: type,
                    text: message,
                    confirmButtonText: 'Close',
                    confirmButtonColor: 'gray'
                });
            });
        });
    </script>
</div>
