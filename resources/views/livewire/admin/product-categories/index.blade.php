<div>
    @include('livewire.admin.product-categories.delete')
    @include('livewire.admin.product-categories.edit')
    @include('livewire.admin.product-categories.create')
    <div class="card card-primary card-outline card-outline-tabs" id="category-table">
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
                <button class="btn btn-primary mb-3 me-2 float-end" data-toggle="modal"
                    data-target="#addProductCategory">
                    <i class="fa-solid fa-plus"></i> Add Category
                </button>
                <input type="search" class="form-control mb-3 mx-2 float-end" style="width: 198px;" placeholder="Search"
                    id="search" wire:model.live="search">
            </div>
            <div class="table-responsive" style="max-height: 500px;">
                <table class="table table-hovered table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th wire:click="handleSortBy('id')" style="cursor: pointer;">
                                @if ($sortBy === 'id')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                ID.
                            </th>
                            <th wire:click="handleSortBy('category_name')" style="cursor: pointer;">
                                @if ($sortBy === 'category_name')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Category Name
                            </th>
                            <th wire:click="handleSortBy('category_description')" style="cursor: pointer;">
                                @if ($sortBy === 'category_description')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Category Description
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_categories as $product_category)
                        <tr>
                            <td>{{ $product_category->id }}</td>
                            <td>{{ $product_category->category_name }}</td>
                            <td style="max-width: 550px;">{{ $product_category->category_description }}</td>
                            <td style="max-width: 100px;">
                                <div class="dropdown dropup">
                                    <span class="badge badge-pill badge-primary py-2" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i style="font-size: 18px; cursor: pointer;"
                                            class="fas fa-plus-circle fa-fw rounded-circle"></i>
                                    </span>
                                    <div class="dropdown-menu text-center p-2" aria-labelledby="dropdownMenuButton">
                                        <a href="#" class="btn btn-primary mt-1 form-control" data-toggle="modal"
                                            data-target="#editProductCategory"
                                            wire:click="edit({{ $product_category->id }})"><i
                                                class="fa-light fa-pen-to-square"></i> Update</a>
                                        <a href="#" class="btn btn-danger mt-1 form-control" data-toggle="modal"
                                            data-target="#deleteProductCategory"
                                            wire:click="delete({{ $product_category->id }})"><i
                                                class="fa-solid fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if (!empty($search) && $product_categories->count() === 0)
                        <td colspan="4" class="text-center">
                            <h6>"{{ $search }}" not found.</h6>
                        </td>
                        @elseif($product_categories->count() === 0)
                        <td colspan="4" class="text-center">
                            <h6>No data found.</h6>
                        </td>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $product_categories->links() }}
        </div>
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
            $('#addProductCategory').on('hidden.bs.modal', function() {
                @this.dispatch('resetInputs');
            });
            $('#deleteProductCategory').on('hidden.bs.modal', function() {
                @this.dispatch('resetInputs');
            });
            $('#editProductCategory').on('hidden.bs.modal', function() {
                @this.dispatch('resetInputs');
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            @this.on('closeModal', () => {
                document.getElementById('closeModalAdd')?.click();
                document.getElementById('closeModalUpdate')?.click();
                document.getElementById('closeModalDelete')?.click();
            });

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
        })
    </script>
</div>
