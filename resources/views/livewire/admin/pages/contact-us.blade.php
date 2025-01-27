<div>
    <div class="container" style="height: 200vh;">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->email }}</td>
                                <td>{{ $feedback->message }}</td>
                                <td>{{ $feedback->created_at->format('F j, Y g:i A') }}</td>
                            </tr>
                        @endforeach
                        @if ($feedbacks->count() === 0)
                            <tr>
                                <td colspan="4" class="text-center">No feedbacks yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
