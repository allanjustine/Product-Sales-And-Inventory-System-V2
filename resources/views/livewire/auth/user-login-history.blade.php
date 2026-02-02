<div>
    <div class="login-history-section">
        <button type="button" class="btn btn-primary btn-lg w-100 py-3 fw-semibold shadow-sm" style="border-radius: 8px;"
            data-bs-toggle="modal" data-bs-target="#loginhistory" wire:click="showLoginHistory">
            <div class="d-flex align-items-center justify-content-center">
                <div class="icon-wrapper rounded-circle p-2 me-3">
                    <i class="fa-solid fa-history fa-lg"></i>
                </div>
                <span>View Login Activity History</span>
            </div>
        </button>

        <div wire:ignore.self class="modal fade" id="loginhistory" tabindex="-1" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="modal-header bg-primary text-white p-4">
                        <div class="d-flex align-items-center w-100">
                            <div class="icon-wrapper rounded-circle p-2 me-3">
                                <i class="fa-solid fa-history fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="modal-title fw-bold mb-1">Login Activity History</h4>
                                <p class="mb-0 opacity-75">Track your account login sessions and security</p>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body p-0" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                        @if (!$histories)
                            <div class="p-5 text-center">
                                <div class="spinner-border text-primary mb-4" style="width: 3rem; height: 3rem;"
                                    role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <h5 class="text-muted">Loading login history...</h5>
                                <p class="text-muted small">Fetching your security activity</p>
                            </div>
                        @endif

                        @if ($histories)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-network-wired me-2 text-muted"></i>
                                                    <span>IP Address</span>
                                                </div>
                                            </th>
                                            <th scope="col" class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-window-maximize me-2 text-muted"></i>
                                                    <span>Browser & Device</span>
                                                </div>
                                            </th>
                                            <th scope="col" class="pe-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-clock me-2 text-muted"></i>
                                                    <span>Login Time</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($histories as $index => $history)
                                            <tr class="border-bottom">
                                                <td class="ps-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="ip-badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1 me-2">
                                                            <i class="fa-solid fa-laptop-code me-1"></i>
                                                        </div>
                                                        <div>
                                                            <code class="fw-semibold">{{ $history->ip_address }}</code>
                                                            @if ($loop->first)
                                                                <span
                                                                    class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 ms-2">
                                                                    <i
                                                                        class="fa-solid fa-circle fa-2xs me-1"></i>Current
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        @php
                                                            $browserIcon = 'fa-window-maximize';
                                                            if (
                                                                str_contains(
                                                                    strtolower($history->browser_address),
                                                                    'chrome',
                                                                )
                                                            ) {
                                                                $browserIcon = 'fa-chrome';
                                                            } elseif (
                                                                str_contains(
                                                                    strtolower($history->browser_address),
                                                                    'firefox',
                                                                )
                                                            ) {
                                                                $browserIcon = 'fa-firefox';
                                                            } elseif (
                                                                str_contains(
                                                                    strtolower($history->browser_address),
                                                                    'safari',
                                                                )
                                                            ) {
                                                                $browserIcon = 'fa-safari';
                                                            } elseif (
                                                                str_contains(
                                                                    strtolower($history->browser_address),
                                                                    'edge',
                                                                )
                                                            ) {
                                                                $browserIcon = 'fa-edge';
                                                            }
                                                        @endphp
                                                        <i class="fab {{ $browserIcon }} fa-lg text-primary me-3"></i>
                                                        <div>
                                                            <span
                                                                class="d-block fw-medium">{{ $history->browser_address }}</span>
                                                            <small class="text-muted">
                                                                @if (str_contains(strtolower($history->browser_address), 'mobile'))
                                                                    <i class="fa-solid fa-mobile-screen me-1"></i>Mobile
                                                                @else
                                                                    <i class="fa-solid fa-desktop me-1"></i>Desktop
                                                                @endif
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pe-4 py-3">
                                                    <div class="d-flex flex-column">
                                                        <span
                                                            class="fw-medium">{{ $history->created_at->format('M d, Y') }}</span>
                                                        <span
                                                            class="text-primary">{{ $history->created_at->format('h:i A') }}</span>
                                                        <small class="text-muted mt-1">
                                                            <i class="fa-regular fa-clock me-1"></i>
                                                            {{ $history->created_at->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if (count($histories) === 0)
                                    <div class="text-center py-5">
                                        <div class="empty-state-icon mb-4">
                                            <i class="fa-regular fa-clipboard fa-4x text-muted opacity-25"></i>
                                        </div>
                                        <h5 class="text-muted">No login history found</h5>
                                        <p class="text-muted small">Your login activities will appear here</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer border-top p-4">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            @if ($histories)
                                <div class="text-muted small">
                                    <i class="fa-solid fa-shield-check me-2"></i>
                                    Showing {{ count($histories) }} login
                                    {{ count($histories) === 1 ? 'activity' : 'activities' }}
                                </div>
                            @endif
                            <button type="button" class="btn btn-outline-primary px-4 rounded-pill"
                                data-bs-dismiss="modal">
                                <i class="fa-solid fa-times me-2"></i>Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal-content {
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.03);
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .ip-badge {
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
        }

        @media (max-width: 768px) {
            .modal-dialog {
                margin: 1rem;
            }

            .modal-header {
                padding: 1.5rem !important;
            }


        }

        @media (max-width: 576px) {
            .login-history-btn {
                padding: 1rem !important;
            }

            .login-history-btn span {
                font-size: 1rem;
            }

            .modal-header h4 {
                font-size: 1.25rem;
            }

            .modal-footer {
                flex-direction: column;
                gap: 1rem;
            }

            .modal-footer .small {
                order: 2;
                text-align: center;
            }

            .modal-footer button {
                order: 1;
                width: 100%;
            }
        }

        .modal-body::-webkit-scrollbar {
            width: 8px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 4px;
        }

        .modal-body::-webkit-scrollbar-thumb:hover {
            background: #adb5bd;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-content {
            animation: fadeIn 0.3s ease-out;
        }

        .empty-state-icon {
            opacity: 0.5;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const modal = document.getElementById('loginhistory');

            function setupResponsiveTable() {
                if (window.innerWidth <= 768) {
                    const tbody = modal.querySelector('tbody');
                    if (tbody) {
                        const rows = tbody.querySelectorAll('tr');
                        rows.forEach(row => {
                            const cells = row.querySelectorAll('td');
                            if (cells.length === 3) {
                                cells.forEach((cell, index) => {
                                    cell.setAttribute('data-label',
                                        index === 0 ? 'IP Address' :
                                        index === 1 ? 'Browser & Device' : 'Login Time'
                                    );
                                });
                            }
                        });
                    }
                }
            }

            modal.addEventListener('show.bs.modal', setupResponsiveTable);

            window.addEventListener('resize', setupResponsiveTable);
        });
    </script>
</div>
