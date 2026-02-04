<div class="container-fluid">
    <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
        <div class="card-header py-4"
            style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 20px 20px 0 0;">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div id="feedbackHeaderIcon"
                        style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                        <i class="fas fa-comments text-white fa-lg"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 id="feedbackTitle" class="card-title mb-0 text-white">Customer Feedback</h3>
                        <p id="feedbackSubtitle" class="text-white-50 mb-0 small">Manage and publish user feedback</p>
                    </div>
                </div>
                <div id="feedbackCountBadge"
                    style="background: rgba(255, 255, 255, 0.2); border-radius: 50px; padding: 8px 20px;">
                    <span class="text-white fw-bold">{{ $feedbacks->total() }} Total</span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead id="feedbackTableHead" style="background: #f8fafc;">
                        <tr>
                            <th class="py-4 px-4 border-0" style="border-radius: 15px 0 0 0;">
                                <div class="d-flex align-items-center">
                                    <div id="nameHeader"
                                        style="width: 36px; height: 36px; background: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    <span class="fw-bold text-uppercase text-primary small">User</span>
                                </div>
                            </th>
                            <th class="py-4 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div id="emailHeader"
                                        style="width: 36px; height: 36px; background: #e8f5e9; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                        <i class="fas fa-envelope text-success"></i>
                                    </div>
                                    <span class="fw-bold text-uppercase text-success small">Email</span>
                                </div>
                            </th>
                            <th class="py-4 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div id="messageHeader"
                                        style="width: 36px; height: 36px; background: #fff3e0; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                        <i class="fas fa-comment-dots text-warning"></i>
                                    </div>
                                    <span class="fw-bold text-uppercase text-warning small">Message</span>
                                </div>
                            </th>
                            <th class="py-4 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div id="statusHeader"
                                        style="width: 36px; height: 36px; background: #f3e5f5; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                        <i class="fas fa-flag text-purple"></i>
                                    </div>
                                    <span class="fw-bold text-uppercase text-purple small">Status</span>
                                </div>
                            </th>
                            <th class="py-4 px-4 border-0" style="border-radius: 0 15px 0 0;">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div id="actionHeader"
                                        style="width: 36px; height: 36px; background: #e0f7fa; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-cogs text-info"></i>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr id="feedbackRow{{ $feedback->id }}" class="border-bottom"
                                style="transition: all 0.3s ease;">
                                <td class="py-3 px-4 align-middle">
                                    <div class="d-flex align-items-center">
                                        <div id="userAvatar{{ $feedback->id }}"
                                            style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                            <span
                                                class="text-white fw-bold">{{ strtoupper(substr($feedback->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <div id="userName{{ $feedback->id }}" class="fw-bold text-dark">
                                                {{ $feedback->name }}</div>
                                            <div id="userDate{{ $feedback->id }}" class="text-muted small">
                                                {{ $feedback->created_at->format('M j') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 align-middle">
                                    <a href="mailto:{{ $feedback->email }}" class="text-decoration-none">
                                        <div id="userEmail{{ $feedback->id }}"
                                            class="text-dark d-flex align-items-center">
                                            <i class="fas fa-envelope me-2 text-primary"></i>
                                            <span style="word-break: break-all;">{{ $feedback->email }}</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="py-3 px-4 align-middle">
                                    <div id="messagePreview{{ $feedback->id }}" class="message-preview">
                                        <p class="mb-0 text-dark" style="white-space: pre-wrap; word-wrap: break-word;">
                                            {{ Str::limit($feedback->message, 80) }}
                                        </p>
                                        @if (strlen($feedback->message) > 80)
                                            <button
                                                class="btn btn-link btn-sm p-0 text-decoration-none mt-1 text-primary"
                                                onclick="toggleMessage('{{ $feedback->id }}')">
                                                <i class="fas fa-chevron-down me-1"></i>Read more
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4 align-middle">
                                    @if ($feedback->is_published)
                                        <span id="statusBadge{{ $feedback->id }}"
                                            class="badge py-2 px-3 d-inline-flex align-items-center"
                                            style="background: rgba(40, 167, 69, 0.1); color: #28a745; border-radius: 50px; border: 1px solid rgba(40, 167, 69, 0.3);">
                                            <i class="fas fa-check-circle me-2"></i>Published
                                        </span>
                                    @else
                                        <span id="statusBadge{{ $feedback->id }}"
                                            class="badge py-2 px-3 d-inline-flex align-items-center"
                                            style="background: rgba(255, 193, 7, 0.1); color: #ffc107; border-radius: 50px; border: 1px solid rgba(255, 193, 7, 0.3);">
                                            <i class="fas fa-clock me-2"></i>Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 align-middle text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" id="viewBtn{{ $feedback->id }}"
                                            class="btn btn-sm d-flex align-items-center"
                                            style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 10px; padding: 8px 15px;"
                                            data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $feedback->id }}">
                                            <i class="fas fa-eye me-2 text-primary"></i>
                                            <span>View</span>
                                        </button>
                                        @if ($feedback->is_published)
                                            <button type="button" id="actionBtn{{ $feedback->id }}"
                                                class="btn btn-sm d-flex align-items-center"
                                                onclick="handlePublish({{ $feedback->id }})"
                                                style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; border: none; border-radius: 10px; padding: 8px 15px;">
                                                <i class="fas fa-times-circle me-2"></i>
                                                <span>Unpublish</span>
                                            </button>
                                        @else
                                            <button type="button" id="actionBtn{{ $feedback->id }}"
                                                class="btn btn-sm d-flex align-items-center"
                                                onclick="handlePublish({{ $feedback->id }})"
                                                style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); color: white; border: none; border-radius: 10px; padding: 8px 15px;">
                                                <i class="fas fa-check-circle me-2"></i>
                                                <span>Publish</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="feedbackModal{{ $feedback->id }}" tabindex="-1"
                                style="border-radius: 20px;">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
                                        <div class="modal-header"
                                            style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-bottom: none; padding: 1.5rem 2rem;">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                    <i class="fas fa-comment-alt text-white fa-lg"></i>
                                                </div>
                                                <div>
                                                    <h5 class="modal-title text-white">Feedback Details</h5>
                                                    <p class="text-white-50 mb-0 small">From {{ $feedback->name }}</p>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="row g-0">
                                                <div class="col-md-4"
                                                    style="background: #f8fafc; border-right: 1px solid #e9ecef;">
                                                    <div class="p-4">
                                                        <div class="mb-4">
                                                            <div id="modalAvatar{{ $feedback->id }}"
                                                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                                                <span
                                                                    class="text-white fw-bold display-6">{{ strtoupper(substr($feedback->name, 0, 1)) }}</span>
                                                            </div>
                                                            <h5 id="modalUserName{{ $feedback->id }}"
                                                                class="text-center mb-1">{{ $feedback->name }}</h5>
                                                            <p id="modalUserEmail{{ $feedback->id }}"
                                                                class="text-center text-muted small mb-3">
                                                                {{ $feedback->email }}</p>
                                                        </div>

                                                        <div class="card border-0 shadow-sm mb-3"
                                                            style="border-radius: 15px;">
                                                            <div class="card-body">
                                                                <h6 class="card-title mb-3 text-primary">
                                                                    <i class="fas fa-info-circle me-2"></i>Details
                                                                </h6>
                                                                <div class="mb-2">
                                                                    <small class="text-muted d-block">Submitted</small>
                                                                    <div id="modalDate{{ $feedback->id }}"
                                                                        class="fw-bold">
                                                                        {{ $feedback->created_at->format('F j, Y') }}
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <small class="text-muted d-block">Time</small>
                                                                    <div id="modalTime{{ $feedback->id }}"
                                                                        class="fw-bold">
                                                                        {{ $feedback->created_at->format('g:i A') }}
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <small class="text-muted d-block">Status</small>
                                                                    @if ($feedback->is_published)
                                                                        <span id="modalStatus{{ $feedback->id }}"
                                                                            class="badge py-2 px-3 mt-1"
                                                                            style="background: rgba(40, 167, 69, 0.1); color: #28a745; border-radius: 50px; border: 1px solid rgba(40, 167, 69, 0.3);">
                                                                            <i
                                                                                class="fas fa-check-circle me-1"></i>Published
                                                                        </span>
                                                                    @else
                                                                        <span id="modalStatus{{ $feedback->id }}"
                                                                            class="badge py-2 px-3 mt-1"
                                                                            style="background: rgba(255, 193, 7, 0.1); color: #ffc107; border-radius: 50px; border: 1px solid rgba(255, 193, 7, 0.3);">
                                                                            <i class="fas fa-clock me-1"></i>Pending
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="d-grid gap-2">
                                                            @if ($feedback->is_published)
                                                                <button type="button"
                                                                    id="modalActionBtn{{ $feedback->id }}"
                                                                    class="btn btn-danger d-flex align-items-center justify-content-center"
                                                                    onclick="handlePublish({{ $feedback->id }})"
                                                                    style="border-radius: 10px; padding: 12px;">
                                                                    <i class="fas fa-times-circle me-2"></i>
                                                                    <span>Unpublish Feedback</span>
                                                                </button>
                                                            @else
                                                                <button type="button"
                                                                    id="modalActionBtn{{ $feedback->id }}"
                                                                    class="btn btn-success d-flex align-items-center justify-content-center"
                                                                    onclick="handlePublish({{ $feedback->id }})"
                                                                    style="border-radius: 10px; padding: 12px;">
                                                                    <i class="fas fa-check-circle me-2"></i>
                                                                    <span>Publish Feedback</span>
                                                                </button>
                                                            @endif
                                                            <button type="button"
                                                                class="btn btn-outline-secondary d-flex align-items-center justify-content-center"
                                                                data-bs-dismiss="modal"
                                                                style="border-radius: 10px; padding: 12px;">
                                                                <i class="fas fa-times me-2"></i>
                                                                <span>Close</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="p-4">
                                                        <h5 class="mb-4 text-dark">
                                                            <i class="fas fa-comment me-2 text-primary"></i>Feedback
                                                            Message
                                                        </h5>
                                                        <div id="modalMessage{{ $feedback->id }}"
                                                            class="card border-0 bg-light"
                                                            style="border-radius: 15px; min-height: 200px;">
                                                            <div class="card-body">
                                                                <p class="mb-0"
                                                                    style="white-space: pre-wrap; line-height: 1.8;">
                                                                    {{ $feedback->message }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="py-5 text-center">
                                    <div id="emptyState" class="empty-state" style="padding: 4rem 1rem;">
                                        <div
                                            style="width: 100px; height: 100px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                                            <i class="fas fa-comments-slash text-white fa-2x"></i>
                                        </div>
                                        <h4 id="emptyTitle" class="text-muted mb-3">No Feedback Yet</h4>
                                        <p id="emptyMessage" class="text-muted mb-4">When users submit feedback, they
                                            will appear here.</p>
                                        <button id="refreshBtn" class="btn btn-primary"
                                            style="border-radius: 10px; padding: 10px 30px;">
                                            <i class="fas fa-sync-alt me-2"></i>Refresh
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-2">
                {{ $feedbacks->links() }}
            </div>
        </div>
    </div>

    <script>
        function handlePublish(id) {
            Swal.fire({
                title: 'Change Publication Status?',
                text: "This will update the feedback's visibility to users.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, proceed',
                cancelButtonText: 'Cancel',
                buttonsStyling: true,
                reverseButtons: true,
                customClass: {
                    popup: 'border-radius-20'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('publishCall', {
                        id
                    });
                }
            })
        }
    </script>
    <script>
        function toggleMessage(id) {
            const container = document.getElementById(`messagePreview${id}`);
            const button = container.querySelector('button');
            const paragraph = container.querySelector('p');
            const fullText = container.getAttribute('data-full-text') || '{{ $feedback->message }}';

            if (button.innerHTML.includes('Read more')) {
                paragraph.textContent = fullText;
                button.innerHTML = '<i class="fas fa-chevron-up me-1"></i>Show less';
                container.setAttribute('data-full-text', fullText);
            } else {
                paragraph.textContent = fullText.substring(0, 80) + '...';
                button.innerHTML = '<i class="fas fa-chevron-down me-1"></i>Read more';
            }
        }

        document.getElementById('refreshBtn')?.addEventListener('click', function() {
            Livewire.dispatch('refresh');
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('alert', (e) => {
                const {
                    title,
                    message,
                    type
                } = e.alerts;
                Swal.fire({
                    title: title,
                    html: message,
                    icon: type,
                    showCloseButton: true,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    position: 'top-end',
                    toast: true,
                    background: '#fff',
                    customClass: {
                        popup: 'shadow-lg border-0 border-radius-10'
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('closeModal', (event) => {
                const [id] = event;
                $(`#feedbackModal${id}`).modal('hide');
            });
        });
    </script>

    <style>
        .border-radius-20 {
            border-radius: 20px !important;
        }

        .border-radius-10 {
            border-radius: 10px !important;
        }

        .message-preview {
            max-width: 300px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(106, 17, 203, 0.05);
        }

        .modal-content {
            border: none;
        }

        .btn-close:focus {
            box-shadow: none;
        }

        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 3px;
            border: none;
            color: #6a11cb;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
        }

        .pagination .page-link:hover {
            background: rgba(106, 17, 203, 0.1);
        }
    </style>
</div>
