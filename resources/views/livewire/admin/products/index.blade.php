<div>
    @include('livewire.admin.products.delete')
    @include('livewire.admin.products.edit')
    @include('livewire.admin.products.create')
    @include('livewire.admin.products.view')
    <div class="card">
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
                <button class="btn btn-primary mb-3 me-2 float-end" data-bs-toggle="modal"
                    onclick="generateProductCode()" data-bs-target="#addProduct">
                    <i class="fa-solid fa-plus"></i> Add Product
                </button>
                <input type="search" class="form-control mb-3 mx-2 float-end" style="width: 198px;" placeholder="Search"
                    wire:model.live.debounce.200ms="search">
                <select name="product_category" id="product_category" class="form-select mb-3 float-end"
                    style="width: 180px;" wire:model.live="category_name">
                    <option value="All">(Filter category) All</option>
                    @foreach ($product_categories as $category)
                    <option key={{ $category->id }} value="{{ $category->category_name }}">{{ $category->category_name
                        }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="table-responsive" id="product-table" style="max-height: 500px;">
                <table class="table table-hovered table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th wire:click="handleSortBy('product_code')" style="cursor: pointer;">
                                @if ($sortBy === 'product_code')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Product Code
                            </th>
                            <th>Product Image</th>
                            <th wire:click="handleSortBy('product_name')" style="cursor: pointer;">
                                @if ($sortBy === 'product_name')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Product Name
                            </th>
                            <th wire:click="handleSortBy('product_stock')" style="cursor: pointer;">
                                @if ($sortBy === 'product_stock')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Stock(s)
                            </th>
                            <th wire:click="handleSortBy('product_rating')" style="cursor: pointer;">
                                @if ($sortBy === 'product_rating')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Rating(s)
                            </th>
                            <th wire:click="handleSortBy('product_price')" style="cursor: pointer;">
                                @if ($sortBy === 'product_price')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Price
                            </th>
                            <th wire:click="handleSortBy('product_status')" style="cursor: pointer;">
                                @if ($sortBy === 'product_status')
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
                            <th wire:click="handleSortBy('product_category_id')" style="cursor: pointer;">
                                @if ($sortBy === 'product_category_id')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Category
                            </th>
                            <th wire:click="handleSortBy('product_sold')" style="cursor: pointer;">
                                @if ($sortBy === 'product_sold')
                                @if ($sortDirection === 'asc')
                                <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                                @else
                                <i class="fa-thin fa-sort"></i>
                                @endif
                                Sold
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr key={{ $product->id }}>
                            <td>{{ $product->product_code }}</td>
                            <td>
                                @if (Storage::exists($product->product_image))
                                <img src="{{ Storage::url($product->product_image) }}"
                                    style="height: 50px; width: 60px; border-radius: 5px;"
                                    alt="{{ $product->product_name }}">
                                @else
                                <img src="{{ url($product->product_image) }}"
                                    style="height: 50px; width: 60px; border-radius: 5px;"
                                    alt="{{ $product->product_name }}">
                                @endif
                            </td>
                            <td class="text-capitalize">{{ $product->product_name }}</td>
                            @if ($product->product_stock)
                            <td><span>{{ number_format($product->product_stock) }} PC(s)</span></td>
                            @else
                            <td><span class="badge badge-warning">OUT OF STOCK</span></td>
                            @endif
                            @if ($product->product_rating === 0)
                            <td>No ratings yet</td>
                            @else
                            <td>{{ $product->product_rating }} <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                            </td>
                            @endif
                            <td>&#8369;{{ number_format($product->product_price, 2, '.', ',') }}</td>
                            {{-- @if ($product->product_status === 'Available')
                            <td><span class="badge badge-success">AVAILABLE</span></td>
                            @else
                            <td><span class="badge badge-danger">NOT AVAILABLE</span></td>
                            @endif --}}
                            <td class="text-center">
                                @if ($product->product_status == 'Available')
                                <div class="custom-control custom-switch">
                                    <input wire:click="statusChange({{ $product->id }})" type="checkbox"
                                        class="custom-control-input" id="customSwitch1{{ $product->id }}" checked>
                                    <label class="custom-control-label" style="cursor: pointer;"
                                        for="customSwitch1{{ $product->id }}"></label>
                                </div>
                                @else
                                <div class="custom-control custom-switch">
                                    <input wire:click="statusChange({{ $product->id }})" type="checkbox"
                                        class="custom-control-input" id="customSwitch1{{ $product->id }}">
                                    <label class="custom-control-label" style="cursor: pointer;"
                                        for="customSwitch1{{ $product->id }}"></label>
                                </div>
                                @endif

                                {{-- <button
                                    class="btn btn-{{ $product->product_status == 'Available' ? 'danger' : 'primary' }}"
                                    wire:click="statusChange({{ $product->id }})">{{ $product->product_status ==
                                    'Available'
                                    ? 'Disable' : 'Enable' }}</button> --}}

                            </td>
                            <td>{{ $product->product_category->category_name }}</td>
                            @if ($product->product_sold === 0)
                            <td>No sold yet</td>
                            @else
                            <td>x{{ $product->product_sold }}</td>
                            @endif
                            <td>
                                <div class="dropdown">
                                    <span class="badge badge-pill badge-primary py-2" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i style="font-size: 18px; cursor: pointer;"
                                            class="fas fa-plus-circle fa-fw rounded-circle"></i>
                                    </span>
                                    <div class="dropdown-menu text-center p-2" aria-labelledby="dropdownMenuButton">
                                        <a href="#" class="btn btn-warning mt-1 form-control" data-bs-toggle="modal"
                                            data-bs-target="#viewProduct" wire:click="view({{ $product->id }})"><i
                                                class="fa-solid fa-eye"></i>
                                            View</a>
                                        <a href="#" class="btn btn-primary mt-1 form-control" data-bs-toggle="modal"
                                            data-bs-target="#updateProduct" wire:click="edit({{ $product->id }})"><i
                                                class="fa-light fa-pen-to-square"></i> Update</a>
                                        <a href="#" class="btn btn-danger mt-1 form-control" data-bs-toggle="modal"
                                            data-bs-target="#deleteProduct" wire:click="delete({{ $product->id }})"><i
                                                class="fa-solid fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if (!empty($search) && $products->count() === 0)
                        <td colspan="9" class="text-center">
                            <h6>"{{ $search }}" not found.</h6>
                        </td>
                        @elseif($products->count() === 0)
                        <td colspan="9" class="text-center">
                            <h6>No data found.</h6>
                        </td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{ $products->links() }}


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
        document.addEventListener('livewire:navigated', () => {
            @this.on('toastr', (event) => {
                const {
                    type
                    , message
                } = event.data;

                toastr[type](message, '', {
                    closeButton: true
                    , "progressBar": true
                , })
            })
        })

    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            $('#addProduct').on('hidden.bs.modal', function() {
                @this.dispatch('resetInputs');
            });
            $('#updateProduct').on('hidden.bs.modal', function() {
                @this.dispatch('resetInputs');
            });
            $('#deleteProduct').on('hidden.bs.modal', function() {
                @this.dispatch('resetInputs');
            });
            $('#viewProduct').on('hidden.bs.modal', function() {
                @this.dispatch('resetInputs');
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            @this.on('closeModal', () => {
                $('#addProduct').modal('hide');
                $('#deleteProduct').modal('hide');
                $('#updateProduct').modal('hide');
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
        });
    </script>
</div>
