<div>
    @include('livewire.admin.products.delete')
    @include('livewire.admin.products.edit')
    @include('livewire.admin.products.create')
    @include('livewire.admin.products.view')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa-solid fa-box text-primary mr-2"></i>
                Product Management
            </h3>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" wire:click="generateProductCode"
                    data-bs-target="#addProduct">
                    <i class="fa-solid fa-plus mr-1"></i> Add Product
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Filters Row -->
            <div class="row mb-3 align-items-end">
                <div class="col-md-2">
                    <label class="form-label text-muted small mb-1">Show entries</label>
                    <select wire:model.live="perPage" class="form-select form-select-sm" id="perPageSelect">
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label text-muted small mb-1">Filter by category</label>
                    <select name="product_category" id="product_category" class="form-select form-select-sm"
                        wire:model.live="category_name">
                        <option value="All">All Categories</option>
                        @foreach ($product_categories as $category)
                            <option key={{ $category->id }} value="{{ $category->category_name }}">
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 offset-md-3">
                    <label class="form-label text-muted small mb-1">Search products</label>
                    <input type="search" class="form-control form-control-sm" placeholder="Search by name, code..."
                        wire:model.live.debounce.200ms="search">
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive" id="product-table" style="height: 500px; border-radius: 8px;">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="bg-secondary">
                        <tr>
                            <th wire:click="handleSortBy('product_code')" style="cursor: pointer;" class="align-middle">
                                @if ($sortBy === 'product_code')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Code
                            </th>
                            <th class="align-middle">Image</th>
                            <th wire:click="handleSortBy('product_name')" style="cursor: pointer;" class="align-middle">
                                @if ($sortBy === 'product_name')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Product Name
                            </th>
                            <th wire:click="handleSortBy('product_stock')" style="cursor: pointer;"
                                class="align-middle text-center">
                                @if ($sortBy === 'product_stock')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Stock
                            </th>
                            <th wire:click="handleSortBy('product_rating')" style="cursor: pointer;"
                                class="align-middle text-center">
                                @if ($sortBy === 'product_rating')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Rating
                            </th>
                            <th wire:click="handleSortBy('product_price')" style="cursor: pointer;"
                                class="align-middle text-end">
                                @if ($sortBy === 'product_price')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Price
                            </th>
                            <th wire:click="handleSortBy('product_status')" style="cursor: pointer;"
                                class="align-middle text-center">
                                @if ($sortBy === 'product_status')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Status
                            </th>
                            <th wire:click="handleSortBy('product_category_id')" style="cursor: pointer;"
                                class="align-middle">
                                @if ($sortBy === 'product_category_id')
                                    <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Category
                            </th>
                            <th wire:click="handleSortBy('orders_sum_order_quantity')" style="cursor: pointer;"
                                class="align-middle text-center">
                                @if ($sortBy === 'orders_sum_order_quantity')
                                    <i
                                        class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} mr-1"></i>
                                @else
                                    <i class="fa-solid fa-sort mr-1 text-muted"></i>
                                @endif
                                Sold
                            </th>
                            <th class="align-middle text-center">Sizes/Colors</th>
                            <th class="align-middle text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr wire:key="{{ $product->id }}">
                                <td class="align-middle"><code class="fw-bold fs-6">{{ $product->product_code }}</code>
                                </td>
                                <td class="align-middle">
                                    @if (Storage::disk('public')->exists($product->productImages?->first()?->path))
                                        <img src="{{ Storage::url($product->productImages?->first()?->path) }}"
                                            class="img-thumbnail" style="height: 50px; width: 60px; object-fit: cover;"
                                            alt="{{ $product->product_name }}">
                                    @else
                                        <img src="{{ url($product->productImages?->first()?->path ?: '') }}"
                                            class="img-thumbnail" style="height: 50px; width: 60px; object-fit: cover;"
                                            alt="{{ $product->product_name }}">
                                    @endif
                                </td>
                                <td class="align-middle text-capitalize fw-bold">{{ $product->product_name }}</td>

                                @if ($product->productStocks() > 0)
                                    <td class="align-middle text-center"><span
                                            class="badge bg-info">{{ number_format($product->productStocks()) }}
                                            pcs</span></td>
                                @else
                                    <td class="align-middle text-center"><span class="badge bg-warning text-dark">OUT OF
                                            STOCK</span></td>
                                @endif

                                @if ((int) $product->averageRatings() === 0)
                                    <td class="align-middle text-center"><span class="text-muted">—</span></td>
                                @else
                                    <td class="align-middle text-center">
                                        <span class="text-warning">{{ $product->averageRatings() }} <i
                                                class="fa-solid fa-star fa-xs"></i></span>
                                    </td>
                                @endif

                                <td class="align-middle text-end">
                                    <span
                                        class="fw-bold">₱{{ number_format($product->product_price, 2, '.', ',') }}</span>
                                    @if ($product->product_old_price !== null && $product->product_old_price !== $product->product_price)
                                        <br><small
                                            class="text-muted text-decoration-line-through">₱{{ number_format($product->product_old_price, 2, '.', ',') }}</small>
                                    @endif
                                </td>

                                <td class="align-middle text-center">
                                    <div class="custom-control custom-switch">
                                        <input wire:click="statusChange({{ $product->id }})" type="checkbox"
                                            class="custom-control-input" id="customSwitch1{{ $product->id }}"
                                            {{ $product->product_status == 'Available' ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                            for="customSwitch1{{ $product->id }}"></label>
                                    </div>
                                </td>

                                <td class="align-middle">
                                    <span
                                        class="badge bg-secondary">{{ $product->product_category->category_name }}</span>
                                </td>

                                @if ((int) $product->orders_sum_order_quantity === 0)
                                    <td class="align-middle text-center"><span class="text-muted">—</span></td>
                                @else
                                    <td class="align-middle text-center"><span
                                            class="fw-bold">{{ $product->orders_sum_order_quantity }}</span></td>
                                @endif

                                <td class="align-middle text-center">
                                    @php
                                        $colorCount = $product->productColors()->count();
                                        $sizeCount = $product->productSizes()->count();
                                        $greaterZeroColor = $colorCount > 0;
                                        $greaterZeroSize = $sizeCount > 0;
                                    @endphp
                                    @if ($greaterZeroColor || $greaterZeroSize)
                                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                                            @if ($greaterZeroColor)
                                                <span class="badge bg-primary badge-sm">C:{{ $colorCount }}</span>
                                            @endif
                                            @if ($greaterZeroSize)
                                                <span class="badge bg-success badge-sm">S:{{ $sizeCount }}</span>
                                            @endif
                                            <a href="{{ route('sizes-and-colors', $product->id) }}" wire:navigate
                                                class="ms-1">
                                                <i class="fa-solid fa-pen text-primary"></i>
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                <td class="align-middle text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            type="button" id="dropdownMenuButton{{ $product->id }}"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right p-2">
                                            <a href="#" class="dropdown-item btn-view" data-bs-toggle="modal"
                                                data-bs-target="#viewProduct" wire:click="view({{ $product->id }})">
                                                <i class="fa-solid fa-eye text-info me-2"></i> View
                                            </a>
                                            <a href="#" class="dropdown-item btn-edit" data-bs-toggle="modal"
                                                data-bs-target="#updateProduct"
                                                wire:click="edit({{ $product->id }})">
                                                <i class="fa-light fa-pen-to-square text-primary me-2"></i> Edit
                                            </a>
                                            <a href="#" class="dropdown-item btn-delete" data-bs-toggle="modal"
                                                data-bs-target="#deleteProduct"
                                                wire:click="delete({{ $product->id }})">
                                                <i class="fa-solid fa-trash text-danger me-2"></i> Remove
                                            </a>
                                            <a href="{{ route('sizes-and-colors', $product->id) }}" wire:navigate class="dropdown-item btn-delete">
                                                <i class="fa-solid fa-layer-group text-info me-2"></i> Color & Size Management
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!empty($search) && $products->count() === 0)
                            <tr>
                                <td colspan="11" class="text-center py-4">
                                    <i class="fa-solid fa-search fa-2x text-muted mb-2"></i>
                                    <h6 class="text-muted">"{{ $search }}" not found.</h6>
                                </td>
                            </tr>
                        @elseif($products->count() === 0)
                            <tr>
                                <td colspan="11" class="text-center py-4">
                                    <i class="fa-solid fa-box-open fa-2x text-muted mb-2"></i>
                                    <h6 class="text-muted">No products found.</h6>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <style>
        /* Custom styles using IDs */
        #perPageSelect {
            width: 80px;
            display: inline-block;
        }

        #product-table thead th {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
            border-bottom-width: 2px;
            padding: 12px 8px;
            white-space: nowrap;
        }

        #product-table tbody td {
            padding: 12px 8px;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        #product-table .img-thumbnail {
            border: 1px solid #dee2e6;
            transition: none;
        }

        #product-table .badge {
            font-weight: 500;
            padding: 0.4rem 0.6rem;
            font-size: 0.75rem;
        }

        #product-table .badge-sm {
            padding: 0.25rem 0.5rem;
        }

        #product-table .dropdown-toggle::after {
            display: none;
        }

        #product-table .dropdown-menu {
            min-width: 120px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: none;
            border-radius: 8px;
        }

        #product-table .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: none;
        }

        #product-table .dropdown-item i {
            width: 18px;
            text-align: center;
        }

        #product-table .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        #product-table .btn-view:hover {
            color: #0dcaf0 !important;
        }

        #product-table .btn-edit:hover {
            color: #0d6efd !important;
        }

        #product-table .btn-delete:hover {
            color: #dc3545 !important;
        }

        #product-table .custom-switch .custom-control-label::before {
            width: 2rem;
            height: 1rem;
            pointer-events: all;
            border-radius: 0.5rem;
        }

        #product-table .custom-switch .custom-control-label::after {
            width: calc(1rem - 4px);
            height: calc(1rem - 4px);
            border-radius: calc(1rem - (1rem / 2));
            background-color: #fff;
        }

        #product-table .custom-switch .custom-control-input:checked~.custom-control-label::after {
            transform: translateX(1rem);
        }

        /* Card styling */
        .card.card-outline.card-primary {
            border-top: 3px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        /* Pagination styling */
        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            padding: 0.4rem 0.75rem;
            color: #495057;
        }

        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Form controls */
        .form-select-sm,
        .form-control-sm {
            border-radius: 6px;
            border-color: #dee2e6;
        }

        .form-select-sm:focus,
        .form-control-sm:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .15);
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', () => {
            Livewire.on('toastr', (event) => {
                const {
                    type,
                    message
                } = event.data;

                toastr[type](message, '', {
                    closeButton: true,
                    "progressBar": true,
                })
            })
        })
    </script>

    <script>
        document.addEventListener('livewire:navigated', function() {
            $('#addProduct').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });
            $('#updateProduct').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });
            $('#deleteProduct').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });
            $('#viewProduct').on('hidden.bs.modal', function() {
                Livewire.dispatch('resetInputs');
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            Livewire.on('closeModal', () => {
                $('#addProduct').modal('hide');
                $('#deleteProduct').modal('hide');
                $('#updateProduct').modal('hide');
            });

            Livewire.on('alert', (event) => {
                const {
                    title,
                    type,
                    message
                } = event.alerts;

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
