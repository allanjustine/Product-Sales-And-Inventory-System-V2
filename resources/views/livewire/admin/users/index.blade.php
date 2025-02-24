<div>
    @include('livewire.admin.users.delete')
    @include('livewire.admin.users.edit')
    @include('livewire.admin.users.create')
    @include('livewire.admin.users.view')
    <div class="card card-primary card-outline card-outline-tabs" id="user-table">
        <div class="card-body">
            <div class="col-sm-12">
                <label>Show:</label>
                <select wire:model.live="perPage" class="perPageSelect">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <label>Entries</label>
                <button class="btn btn-primary mb-3 me-2 float-end" data-toggle="modal" data-target="#addUser">
                    <i class="fa-solid fa-user-plus"></i> Add User
                </button>
                <input type="search" class="form-control mb-3 mx-2 float-end" style="width: 198px;" placeholder="Search"
                    wire:model.live="search">
            </div>
            <div class="table-responsive" style="height: 500px;">
                <table class="table table-bordered" style="overflow: none;">
                    <thead>
                        <tr class="bg-dark bg-light" style="text-transform: uppercase;">
                            <th>
                                Profile Picture
                            </th>
                            <th wire:click="sortBy('name')" style="cursor: pointer;">
                                @if ($sortBy === 'name')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Name
                            </th>
                            <th wire:click="sortBy('email')" style="cursor: pointer;">
                                @if ($sortBy === 'email')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Email
                            </th>
                            <th wire:click="sortBy('gender')" style="cursor: pointer;">
                                @if ($sortBy === 'gender')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Gender
                            </th>
                            <th wire:click="sortBy('email_verified_at')" style="cursor: pointer;">
                                @if ($sortBy === 'email_verified_at')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Status
                            </th>
                            <th>
                                Role
                            </th>
                            <th>
                                Account Created
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <img src="{{ $user->profile_image === null ? "
                                    https://cdn-icons-png.flaticon.com/512/2919/2919906.png" :
                                    Storage::url($user->profile_image) }}" style="height: 50px; width: 60px;
                                border-radius: 5px;" alt="{{ $user->profile_name }}">
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->gender }}
                            </td>
                            @if ($user->email_verified_at)
                            <td><span class="badge badge-success">VERIFIED</span></td>
                            @else
                            <td><span class="badge badge-danger">UNVERIFIED</span></td>
                            @endif

                            @if ($user->isAdmin())
                            <td><span class="badge badge-info">ADMIN</span></td>
                            @else
                            <td><span class="badge badge-warning">USER</span></td>
                            @endif
                            <td>
                                {{ $user->created_at->diffForHumans() }}
                            </td>
                            <td>
                                <div class="dropdown dropup">
                                    <span class="badge badge-pill badge-primary py-2" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i style="font-size: 18px; cursor: pointer;"
                                            class="fas fa-plus-circle fa-fw rounded-circle"></i>
                                    </span>
                                    <div class="dropdown-menu text-center p-2" aria-labelledby="dropdownMenuButton">

                                        <a href="#" class="btn btn-warning mt-1 form-control" data-toggle="modal"
                                            data-target="#viewUser" wire:click="view({{ $user->id }})"><i
                                                class="fa-solid fa-eye"></i> View</a>
                                        <a href="#" class="btn btn-primary mt-1 form-control" data-toggle="modal"
                                            data-target="#updateUser" wire:click="edit({{ $user->id }})"><i
                                                class="fa-light fa-pen-to-square"></i> Update</a>
                                        <a href="#" class="btn btn-danger mt-1 form-control" data-toggle="modal"
                                            data-target="#deleteUser" wire:click="delete({{ $user->id }})"><i
                                                class="fa-solid fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if (!empty($search) && $users->count() === 0)
                        <td colspan="7" class="text-center">
                            <h6>"{{ $search }}" not found.</h6>
                        </td>
                        @elseif($users->count() === 0)
                        <td colspan="7" class="text-center">
                            <h6>No data found.</h6>
                        </td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <span class="me-auto p-1 rounded">Showing: <span class="p-1 rounded"
                style="border: 1px solid rgba(156, 154, 154, 0.356); background-color:rgba(150, 209, 248, 0.384);"><strong>{{
                    $users->firstItem() }}-{{ $users->lastItem() }}</strong>
                of
                <strong>{{ $users->total() }}</strong></span> Entries</span>
        <span class="ms-auto pt-3">
            {{ $users->links('pages.admin.layout.pagination') }}</span>
    </div>

    <style>
        .role-name {
            text-transform: uppercase;
        }

        .perPageSelect {
            font-family: Arial, sans-serif;
            border: 1px solid #ccc;
            color: #333;
            width: 70px;
            padding: 10px;
            border-radius: 5px;
        }

        .perPageSelect:focus {
            outline: none;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            @this.on('alert', (event) => {
                const { title, type, message } = event.alerts;

                Swal.fire({
                    confirmButtonColor: '#0000FF',
                    confirmButtonText: 'Close',
                    title: title,
                    icon: type,
                    text: message
                });
            });

            @this.on('closeModal', function() {
                $('#deleteUser').modal('hide');
                $('#updateUser').modal('hide');
                $('#addUser').modal('hide');
            });
        });
    </script>

</div>