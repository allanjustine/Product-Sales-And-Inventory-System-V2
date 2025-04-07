<div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="bg-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->email }}</td>
                                <td>{{ $feedback->message }}</td>
                                <td>
                                    @if ($feedback->is_published)
                                    <span class="badge badge-success">Is Published</span>
                                    @else
                                    <span class="badge badge-warning">Not Published</span>
                                    @endif
                                </td>
                                <td>{{ $feedback->created_at->format('F j, Y g:i A') }}</td>
                                <td>
                                    @if ($feedback->is_published)
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        onclick="handlePublish({{ $feedback->id }})">
                                        <i class="fas fa-times-circle"></i> Unpublish
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-primary"
                                        onclick="handlePublish({{ $feedback->id }})">
                                        <i class="fas fa-check-circle"></i> Publish
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty

                            <tr>
                                <td colspan="6" class="text-center">No feedbacks yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function handlePublish(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if(result.isConfirmed) {
                    Livewire.dispatch('publishCall', { id });
                }
            })
        }
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('alert', (e) => {
                const { title, message, type } = e.alerts;
                Swal.fire({
                    title: title,
                    icon: type,
                    text: message,
                    showCloseButton: true,
                    showCancelButton: true,
                    cancelButtonText: 'Okay',
                    showConfirmButton: false
                });
            });
        });
    </script>
</div>
