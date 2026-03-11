<div>
    @include('livewire.admin.users.delete')
    @include('livewire.admin.users.edit')
    @include('livewire.admin.users.create')
    @include('livewire.admin.users.view')

    <div class="card card-primary card-outline card-outline-tabs shadow-lg" id="user-table">
        <div class="card-header p-2 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <button wire:click="handleStatus('')" class="nav-link {{ $this->status === '' ? 'active' : '' }}"
                        id="custom-tabs-three-all-tab" data-toggle="pill" role="tab"
                        aria-controls="custom-tabs-three-all" aria-selected="true">
                        <i class="fas fa-list mr-2"></i>All Users
                    </button>
                </li>
                <li class="nav-item">
                    <button wire:click="handleStatus('verified')" class="nav-link {{ $this->status === 'verified' ? 'active' : '' }}" id="custom-tabs-three-verified-tab"
                        data-toggle="pill" role="tab" aria-controls="custom-tabs-three-verified"
                        aria-selected="false">
                        <i class="fas fa-check-circle mr-2"></i>Verified
                    </button>
                </li>
                <li class="nav-item">
                    <button wire:click="handleStatus('pending')" class="nav-link {{ $this->status === 'pending' ? 'active' : '' }}" id="custom-tabs-three-pending-tab"
                        data-toggle="pill" role="tab" aria-controls="custom-tabs-three-pending"
                        aria-selected="false">
                        <i class="fas fa-clock mr-2"></i>Pending
                    </button>
                </li>
                <li class="nav-item">
                    <button wire:click="handleStatus('admins')" class="nav-link {{ $this->status === 'admins' ? 'active' : '' }}" id="custom-tabs-three-admins-tab"
                        data-toggle="pill" role="tab" aria-controls="custom-tabs-three-admins"
                        aria-selected="false">
                        <i class="fas fa-user-shield mr-2"></i>Admins
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <!-- Filter Bar -->
            <div class="row mb-4 align-items-center">
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <label class="mr-2 mb-0 font-weight-bold">Show:</label>
                        <select wire:model.live="perPage" class="form-control form-control-sm w-auto">
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <span class="ml-2 text-muted">entries</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search by name, email, or role..."
                            wire:model.live="search">
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <button class="btn btn-primary btn-lg shadow-sm" data-toggle="modal" data-target="#addUser">
                        <i class="fa-solid fa-user-plus mr-2"></i> Add New User
                    </button>
                </div>
            </div>

            <!-- Users Table -->
            <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="bg-gradient-primary text-white" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th class="align-middle text-center">Profile</th>
                            <th class="align-middle" wire:click="sortItemBy('name')" style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    Name
                                    @if ($sortBy === 'name')
                                        @if ($sortDirection === 'asc')
                                            <i class="fa-solid fa-sort-up ml-2"></i>
                                        @else
                                            <i class="fa-solid fa-sort-down ml-2"></i>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle" wire:click="sortItemBy('email')" style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    Email
                                    @if ($sortBy === 'email')
                                        @if ($sortDirection === 'asc')
                                            <i class="fa-solid fa-sort-up ml-2"></i>
                                        @else
                                            <i class="fa-solid fa-sort-down ml-2"></i>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle text-center">Gender</th>
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle text-center">Role</th>
                            <th class="align-middle" wire:click="sortItemBy('created_at')" style="cursor: pointer;">
                                <span class="d-flex align-items-center">
                                    Joined
                                    @if ($sortBy === 'created_at')
                                        @if ($sortDirection === 'asc')
                                            <i class="fa-solid fa-sort-up ml-2"></i>
                                        @else
                                            <i class="fa-solid fa-sort-down ml-2"></i>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-sort ml-2 text-white-50"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="align-middle text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="align-middle">
                                <td class="text-center" style="width: 80px;">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : 'https://cdn-icons-png.flaticon.com/512/2919/2919906.png' }}"
                                            class="img-circle elevation-2"
                                            style="height: 50px; width: 50px; object-fit: cover;"
                                            alt="{{ $user->name }}">
                                        @if (!$user->email_verified_at)
                                            <button onclick="verifyUser({{ $user->id }}, '{{ $user->name }}')"
                                                class="btn btn-sm btn-link p-0 position-absolute"
                                                style="top: -5px; right: -5px;" title="Verify User">
                                                <i
                                                    class="fas fa-check-circle text-success bg-white rounded-circle"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $user->name }}</div>
                                    <small class="text-muted d-block">ID: #{{ $user->id }}</small>
                                </td>
                                <td>
                                    <div>{{ $user->email }}</div>
                                </td>
                                <td class="text-center">
                                    @if ($user->gender)
                                        <span class="badge badge-light p-2">
                                            <i
                                                class="fas fa-{{ $user->gender === 'male' ? 'mars' : ($user->gender === 'female' ? 'venus' : 'genderless') }} mr-1"></i>
                                            {{ ucfirst($user->gender) }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->email_verified_at)
                                        <span class="badge badge-success p-2">
                                            <i class="fas fa-check-circle mr-1"></i> VERIFIED
                                        </span>
                                    @else
                                        <span class="badge badge-danger p-2">
                                            <i class="fas fa-times-circle mr-1"></i> UNVERIFIED
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->isAdmin())
                                        <span class="badge badge-info p-2">
                                            <i class="fas fa-crown mr-1"></i> ADMIN
                                        </span>
                                    @else
                                        <span class="badge badge-warning p-2">
                                            <i class="fas fa-user mr-1"></i> USER
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="far fa-calendar-alt text-muted mr-2"></i>
                                        <div>
                                            <div>{{ $user->created_at->format('M d, Y') }}</div>
                                            <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                            data-target="#viewUser" wire:click="view({{ $user->id }})"
                                            title="View Details">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#updateUser" wire:click="edit({{ $user->id }})"
                                            title="Edit User">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteUser" wire:click="delete({{ $user->id }})"
                                            title="Delete User">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-users fa-4x text-muted mb-3"></i>
                                        @if (!empty($search))
                                            <h6>No results found for "{{ $search }}"</h6>
                                            <p class="text-muted">Try adjusting your search criteria</p>
                                        @else
                                            <h6>No users found</h6>
                                            <p class="text-muted">Get started by adding your first user</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of
                        {{ $users->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers float-right">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles */
        .bg-gradient-primary {
            background: linear-gradient(45deg, #4e73df, #224abe);
        }

        .small-box {
            border-radius: 0.5rem;
            box-shadow: 0 0 1rem rgba(0, 0, 0, .1);
            transition: transform 0.3s;
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .empty-state {
            padding: 2rem;
            text-align: center;
        }

        .empty-state i {
            opacity: 0.5;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .img-circle {
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-group .btn {
            padding: 0.25rem 0.5rem;
            margin: 0 2px;
            border-radius: 0.25rem !important;
        }

        .dataTables_info {
            padding-top: 0.75rem;
            color: #6c757d;
        }

        /* Dark mode adjustments */
        .dark-mode .bg-gradient-primary {
            background: linear-gradient(45deg, #375a7f, #2c3e50);
        }

        .dark-mode .table {
            color: #fff;
        }

        .dark-mode .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* Animation for new items */
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

        .table tbody tr {
            animation: fadeIn 0.3s ease-out;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            // Modal cleanup
            $('#updateUser, #addUser, #deleteUser, #viewUser').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });

            // Custom pagination styling
            $('.pagination').addClass('pagination-rounded');
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            // SweetAlert2 notifications
            Livewire.on('alert', (event) => {
                const {
                    title,
                    type,
                    message
                } = event.alerts;

                Swal.fire({
                    title: title,
                    icon: type,
                    text: message,
                    confirmButtonColor: '#4e73df',
                    confirmButtonText: 'Close',
                    showCloseButton: true,
                    timer: 5000,
                    timerProgressBar: true
                });
            });

            // Modal closing
            Livewire.on('closeModal', function() {
                document.getElementById('closeModalAdd')?.click();
                document.getElementById('closeModalUpdate')?.click();
                document.getElementById('closeModalDelete')?.click();
            });
        });
    </script>

    <script>
        function verifyUser(id, name) {
            Swal.fire({
                title: 'Verify User',
                html: `Are you sure you want to verify <strong>${name}</strong>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, verify it!',
                cancelButtonText: 'Cancel',
                showCloseButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('verifyUser', {
                        id
                    });

                    Swal.fire({
                        title: 'Verified!',
                        text: 'User has been verified successfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>

</div>
