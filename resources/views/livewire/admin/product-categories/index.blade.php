<div>
    @include('livewire.admin.product-categories.delete')
    @include('livewire.admin.product-categories.edit')
    @include('livewire.admin.product-categories.create')

    <div class="card card-primary card-outline" id="category-table">
        <div class="card-header bg-white">
            <h3 class="card-title">
                <i class="fa-solid fa-tags text-primary mr-2"></i>
                Product Categories
            </h3>
        </div>

        <div class="card-body">
            <!-- Controls Row -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <div class="d-flex align-items-center">
                    <label class="mr-2 mb-0">Show:</label>
                    <select wire:model.live="perPage" class="form-control form-control-sm" style="width: 70px;"
                        id="categoryPerPage">
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <label class="ml-2 mb-0">Entries</label>
                </div>

                <div class="d-flex align-items-center">
                    <input type="search" class="form-control form-control-sm mr-2" style="width: 200px;"
                        placeholder="Search categories..." id="search" wire:model.live="search">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addProductCategory">
                        <i class="fa-solid fa-plus"></i> Add Category
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive" style="height: 500px; border: 1px solid #dee2e6; border-radius: 4px;">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th wire:click="handleSortBy('id')" style="cursor: pointer; width: 80px;"
                                class="align-middle">
                                @if ($sortBy === 'id')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                ID
                            </th>
                            <th wire:click="handleSortBy('category_name')" style="cursor: pointer;"
                                class="align-middle">
                                @if ($sortBy === 'category_name')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Category Name
                            </th>
                            <th wire:click="handleSortBy('category_description')" style="cursor: pointer;"
                                class="align-middle">
                                @if ($sortBy === 'category_description')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Description
                            </th>
                            <th style="width: 100px;" class="text-center align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_categories as $product_category)
                            <tr>
                                <td class="align-middle font-weight-bold">{{ $product_category->id }}</td>
                                <td class="align-middle">
                                    <span class="font-weight-bold">{{ $product_category->category_name }}</span>
                                </td>
                                <td class="align-middle">
                                    <div style="max-width: 550px;" class="text-muted">
                                        {{ $product_category->category_description }}
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="dropdown">
                                        <span class="badge badge-pill badge-primary py-2 px-3"
                                            id="dropdownMenuButton{{ $product_category->id }}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                                            <i class="fa-solid fa-ellipsis-h"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right p-2"
                                            aria-labelledby="dropdownMenuButton{{ $product_category->id }}">
                                            <a href="#" class="dropdown-item btn-edit" data-toggle="modal"
                                                data-target="#editProductCategory"
                                                wire:click="edit({{ $product_category->id }})">
                                                <i class="fa-solid fa-pen-to-square text-primary mr-2"></i> Update
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item btn-delete" data-toggle="modal"
                                                data-target="#deleteProductCategory"
                                                wire:click="delete({{ $product_category->id }})">
                                                <i class="fa-solid fa-trash text-danger mr-2"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!empty($search) && $product_categories->count() === 0)
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fa-solid fa-search fa-2x text-muted mb-2"></i>
                                    <h6 class="text-muted">"{{ $search }}" not found.</h6>
                                </td>
                            </tr>
                        @elseif($product_categories->count() === 0)
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fa-solid fa-tags fa-2x text-muted mb-2"></i>
                                    <h6 class="text-muted">No categories found.</h6>
                                    <p class="text-muted small mb-0">Click "Add Category" to create your first category.
                                    </p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $product_categories->links() }}
            </div>
        </div>
    </div>

    <style>
        /* Custom styles using IDs */
        #category-table .card-header {
            border-bottom: 2px solid #007bff;
            padding: 1rem 1.5rem;
        }

        #category-table .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        #categoryPerPage {
            width: 70px !important;
            display: inline-block;
        }

        #category-table .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 8px;
        }

        #category-table .table tbody td {
            padding: 12px 8px;
            vertical-align: middle;
        }

        #category-table .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        #category-table .dropdown-menu {
            min-width: 120px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 6px;
        }

        #category-table .dropdown-item {
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        #category-table .dropdown-item i {
            width: 20px;
        }

        #category-table .dropdown-item.btn-edit:hover {
            background-color: #e7f1ff;
            color: #007bff;
        }

        #category-table .dropdown-item.btn-delete:hover {
            background-color: #f8d7da;
            color: #dc3545;
        }

        #category-table .badge-primary {
            background-color: #e7f1ff;
            color: #007bff;
            font-weight: normal;
        }

        #category-table .badge-primary:hover {
            background-color: #007bff;
            color: white;
        }

        /* Pagination styling */
        #category-table .pagination {
            margin-bottom: 0;
        }

        #category-table .page-item .page-link {
            color: #007bff;
            border: 1px solid #dee2e6;
            padding: 0.4rem 0.8rem;
        }

        #category-table .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        #category-table .page-item.disabled .page-link {
            color: #6c757d;
        }

        /* Form controls */
        #category-table .form-control-sm {
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        #category-table .form-control-sm:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .15);
        }

        #category-table .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        #category-table .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        /* Empty state styling */
        #category-table .text-center.py-4 i {
            opacity: 0.5;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #category-table .d-flex {
                flex-direction: column;
                align-items: flex-start !important;
            }

            #category-table .d-flex>div {
                margin-bottom: 10px;
            }

            #category-table .d-flex .btn {
                width: 100%;
            }

            #category-table input[type="search"] {
                width: 100% !important;
                margin-right: 0 !important;
                margin-bottom: 10px;
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            $('#addProductCategory').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });
            $('#deleteProductCategory').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });
            $('#editProductCategory').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            Livewire.on('closeModal', () => {
                document.getElementById('closeModalAdd')?.click();
                document.getElementById('closeModalUpdate')?.click();
                document.getElementById('closeModalDelete')?.click();
            });

            Livewire.on('alert', (event) => {
                const {
                    title,
                    type,
                    message
                } = event.alerts;

                Swal.fire({
                    confirmButtonColor: '#007bff',
                    confirmButtonText: 'Close',
                    title: title,
                    icon: type,
                    text: message
                });
            });
        })
    </script>
</div>
