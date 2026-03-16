<div>
    <!-- Main Card -->
    <div class="card card-primary card-outline shadow-lg">
        <div class="card-header bg-gradient-primary text-white">
            <h5 class="card-title font-weight-bold mb-0">
                <i class="fa-solid fa-palette mr-2"></i>Sizes & Colors Management
            </h5>
            <div class="card-tools">
                <a href="/admin/products" wire:navigate class="btn btn-link"><i class="fa-solid fa-arrow-left text-white"></i></a>
                <button type="button" class="btn btn-tool" data-card-widget="refresh" wire:click="$refresh">
                    <i class="fa-solid fa-sync-alt text-white"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Product Info Banner -->
            <div class="alert alert-info alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                <i class="fa-solid fa-box-open fa-2x mr-3"></i>
                <div>
                    <strong class="font-weight-bold">Managing variations for:</strong>
                    <span class="product-name-badge">{{ $this->product->product_name }}</span>
                    <small class="d-block text-black">Add, edit, or remove sizes and colors for this product</small>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="row">
                <!-- Sizes Section -->
                <div class="col-lg-6 mb-4">
                    <div class="card card-outline card-primary h-100 border-primary">
                        <div class="card-header bg-primary text-white py-3">
                            <h6 class="card-title font-weight-bold mb-0">
                                <i class="fa-solid fa-ruler mr-2"></i>Size Management
                            </h6>
                            <div class="card-tools">
                                <span class="badge badge-light">{{ count($this->product->productSizes) }} items</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Sizes List -->
                            @if (count($this->product->productSizes) > 0)
                                <div class="sizes-container mb-4">
                                    <label class="font-weight-medium text-muted mb-2">
                                        <i class="fa-solid fa-list mr-1"></i>Current Sizes
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Size Name</th>
                                                    <th class="text-center">Stock</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($this->product->productSizes as $size)
                                                    <tr>
                                                        <td>
                                                            <span class="size-badge">{{ $size->name }}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span
                                                                class="stock-badge stock-{{ $size->stock > 0 ? 'available' : 'low' }}">
                                                                <i
                                                                    class="fa-solid fa-{{ $size->stock > 0 ? 'check-circle' : 'exclamation-circle' }} mr-1"></i>
                                                                {{ number_format($size->stock) }} units
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm">
                                                                <button type="button" class="btn btn-outline-primary"
                                                                    wire:click='editSize({{ $size->id }})'
                                                                    title="Edit size">
                                                                    <i class="fa-solid fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-outline-danger"
                                                                    wire:click='removeSize({{ $size->id }})'
                                                                    title="Delete size"
                                                                    onclick="return confirm('Are you sure you want to delete this size?')">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="empty-state-mini text-center py-4 mb-4">
                                    <i class="fa-solid fa-ruler fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">No Sizes Added Yet</h6>
                                    <p class="small text-muted">Add sizes below to manage inventory</p>
                                </div>
                            @endif

                            <!-- Add/Edit Size Form -->
                            <div class="size-form-container border-top pt-4">
                                <h6 class="font-weight-bold text-primary mb-3">
                                    <i class="fa-solid fa-{{ $this->is_edit_size ? 'edit' : 'plus-circle' }} mr-2"></i>
                                    {{ $this->is_edit_size ? 'Edit Size' : 'Add New Size' }}
                                </h6>

                                <div class="form-group mb-3">
                                    <label for="size_name" class="font-weight-medium">Size Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                        </div>
                                        <input type="text" id="size_name"
                                            class="form-control @error('size_name') is-invalid @enderror"
                                            placeholder="e.g., Small, Medium, Large, XL" wire:model="size_name">
                                    </div>
                                    @error('size_name')
                                        <small class="text-danger"><i
                                                class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="size_stock" class="font-weight-medium">Stock Quantity</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-cubes"></i></span>
                                        </div>
                                        <input type="number" id="size_stock"
                                            class="form-control @error('size_stock') is-invalid @enderror"
                                            placeholder="Enter stock quantity" wire:model="size_stock" min="0">
                                    </div>
                                    @error('size_stock')
                                        <small class="text-danger"><i
                                                class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-primary flex-grow-1"
                                        wire:click="{{ $this->is_edit_size ? 'updateSize' : 'submitSize' }}"
                                        wire:loading.attr="disabled"
                                        wire:target="{{ $this->is_edit_size ? 'updateSize' : 'submitSize' }}">
                                        <span wire:loading.remove
                                            wire:target="{{ $this->is_edit_size ? 'updateSize' : 'submitSize' }}">
                                            <i class="fa-solid fa-{{ $this->is_edit_size ? 'save' : 'plus' }} mr-2"></i>
                                            {{ $this->is_edit_size ? 'Update Size' : 'Add Size' }}
                                        </span>
                                        <span wire:loading
                                            wire:target="{{ $this->is_edit_size ? 'updateSize' : 'submitSize' }}">
                                            <span class="spinner-border spinner-border-sm mr-2"></span>
                                            {{ $this->is_edit_size ? 'Updating...' : 'Adding...' }}
                                        </span>
                                    </button>

                                    @if ($this->is_edit_size)
                                        <button type="button" class="btn btn-outline-secondary"
                                            wire:click="cancelSizeEdit">
                                            <i class="fa-solid fa-times"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colors Section -->
                <div class="col-lg-6 mb-4">
                    <div class="card card-outline card-danger h-100 border-danger">
                        <div class="card-header bg-danger text-white py-3">
                            <h6 class="card-title font-weight-bold mb-0">
                                <i class="fa-solid fa-palette mr-2"></i>Color Management
                            </h6>
                            <div class="card-tools">
                                <span class="badge badge-light">{{ count($this->product->productColors) }}
                                    items</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Colors List -->
                            @if (count($this->product->productColors) > 0)
                                <div class="colors-container mb-4">
                                    <label class="font-weight-medium text-muted mb-2">
                                        <i class="fa-solid fa-list mr-1"></i>Current Colors
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Color</th>
                                                    <th class="text-center">Stock</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($this->product->productColors as $color)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <span class="color-dot mr-2"
                                                                    style="background-color: {{ $color->name }};"></span>
                                                                <span class="color-badge">{{ $color->name }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <span
                                                                class="stock-badge stock-{{ $color->stock > 0 ? 'available' : 'low' }}">
                                                                <i
                                                                    class="fa-solid fa-{{ $color->stock > 0 ? 'check-circle' : 'exclamation-circle' }} mr-1"></i>
                                                                {{ number_format($color->stock) }} units
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm">
                                                                <button type="button" class="btn btn-outline-primary"
                                                                    wire:click='editColor({{ $color->id }})'
                                                                    title="Edit color">
                                                                    <i class="fa-solid fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-outline-danger"
                                                                    wire:click='removeColor({{ $color->id }})'
                                                                    title="Delete color"
                                                                    wire:confirm="Are you sure you want to delete this color?">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="empty-state-mini text-center py-4 mb-4">
                                    <i class="fa-solid fa-palette fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">No Colors Added Yet</h6>
                                    <p class="small text-muted">Add colors below to manage inventory</p>
                                </div>
                            @endif

                            <!-- Add/Edit Color Form -->
                            <div class="color-form-container border-top pt-4">
                                <h6 class="font-weight-bold text-danger mb-3">
                                    <i class="fa-solid fa-{{ $this->is_edit_color ? 'edit' : 'plus-circle' }} mr-2"></i>
                                    {{ $this->is_edit_color ? 'Edit Color' : 'Add New Color' }}
                                </h6>

                                <div class="form-group mb-3">
                                    <label for="color_name" class="font-weight-medium">Color Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                        </div>
                                        <input type="text" id="color_name"
                                            class="form-control @error('color_name') is-invalid @enderror"
                                            placeholder="e.g., Red, Blue, Black, White" wire:model="color_name">
                                    </div>
                                    @error('color_name')
                                        <small class="text-danger"><i
                                                class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Color Preview -->
                                @if ($this->color_name)
                                    <div class="color-preview mb-3">
                                        <span class="font-weight-medium text-muted mr-2">Preview:</span>
                                        <span class="color-preview-badge"
                                            style="background-color: {{ $this->color_name }};">
                                            {{ $this->color_name }}
                                        </span>
                                    </div>
                                @endif

                                <div class="form-group mb-3">
                                    <label for="color_stock" class="font-weight-medium">Stock Quantity</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-cubes"></i></span>
                                        </div>
                                        <input type="number" id="color_stock"
                                            class="form-control @error('color_stock') is-invalid @enderror"
                                            placeholder="Enter stock quantity" wire:model="color_stock"
                                            min="0">
                                    </div>
                                    @error('color_stock')
                                        <small class="text-danger"><i
                                                class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-danger flex-grow-1"
                                        wire:click="{{ $this->is_edit_color ? 'updateColor' : 'submitColor' }}"
                                        wire:loading.attr="disabled"
                                        wire:target="{{ $this->is_edit_color ? 'updateColor' : 'submitColor' }}">
                                        <span wire:loading.remove
                                            wire:target="{{ $this->is_edit_color ? 'updateColor' : 'submitColor' }}">
                                            <i class="fa-solid fa-{{ $this->is_edit_color ? 'save' : 'plus' }} mr-2"></i>
                                            {{ $this->is_edit_color ? 'Update Color' : 'Add Color' }}
                                        </span>
                                        <span wire:loading
                                            wire:target="{{ $this->is_edit_color ? 'updateColor' : 'submitColor' }}">
                                            <span class="spinner-border spinner-border-sm mr-2"></span>
                                            {{ $this->is_edit_color ? 'Updating...' : 'Adding...' }}
                                        </span>
                                    </button>

                                    @if ($this->is_edit_color)
                                        <button type="button" class="btn btn-outline-secondary"
                                            wire:click="cancelColorEdit">
                                            <i class="fa-solid fa-times"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Footer -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card bg-light">
                        <div class="card-body py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fa-solid fa-info-circle text-primary mr-1"></i>
                                    <small class="text-muted">
                                        Total Variations:
                                        <span
                                            class="font-weight-bold">{{ count($this->product->productSizes) + count($this->product->productColors) }}</span>
                                        ({{ count($this->product->productSizes) }} sizes,
                                        {{ count($this->product->productColors) }} colors)
                                    </small>
                                </div>
                                <div>
                                    <small class="text-muted">
                                        <i class="fa-solid fa-cubes mr-1"></i>
                                        Total Stock:
                                        <span class="font-weight-bold">
                                            {{ $this->product->productSizes->sum('stock') + $this->product->productColors->sum('stock') }}
                                            units
                                        </span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
        }

        .product-name-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 600;
            margin-left: 8px;
        }

        /* Size and Color Badges */
        .size-badge {
            background: #e3f2fd;
            color: #0d47a1;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .color-badge {
            background: #f3e5f5;
            color: #4a148c;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .color-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Stock Badges */
        .stock-badge {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .stock-available {
            background: #d4edda;
            color: #155724;
        }

        .stock-low {
            background: #fff3cd;
            color: #856404;
        }

        /* Empty State */
        .empty-state-mini {
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }

        /* Color Preview */
        .color-preview-badge {
            padding: 4px 12px;
            border-radius: 20px;
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Form Styling */
        .input-group-text {
            background-color: #f8f9fa;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Card Hover Effects */
        .card-outline.card-primary:hover {
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.2);
        }

        .card-outline.card-danger:hover {
            box-shadow: 0 0 20px rgba(220, 53, 69, 0.2);
        }

        /* Button Group */
        .btn-group-sm .btn {
            padding: 0.25rem 0.5rem;
        }

        /* Gap utility */
        .gap-2 {
            gap: 0.5rem;
        }

        /* Dark Mode */
        .dark-mode .bg-light {
            background-color: #2d2d2d !important;
        }

        .dark-mode .table {
            color: #fff;
        }

        .dark-mode .table-hover tbody tr:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.075);
        }

        .dark-mode .empty-state-mini {
            background: #2d2d2d;
            border-color: #404040;
        }

        .dark-mode .size-badge {
            background: #1e3a5f;
            color: #90caf9;
        }

        .dark-mode .color-badge {
            background: #4a2c5f;
            color: #ce93d8;
        }

        .dark-mode .input-group-text {
            background-color: #3d3d3d;
            border-color: #4d4d4d;
            color: #fff;
        }

        .dark-mode .form-control {
            background-color: #3d3d3d;
            border-color: #4d4d4d;
            color: #fff;
        }

        .dark-mode .form-control:focus {
            background-color: #3d3d3d;
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            .col-lg-6 {
                width: 100%;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-outline {
            animation: fadeIn 0.3s ease-out;
        }

        /* Card Tools */
        .card-tools .btn-tool {
            color: white;
            opacity: 0.8;
        }

        .card-tools .btn-tool:hover {
            opacity: 1;
        }

        /* Custom Scrollbar */
        .table-responsive::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #007bff;
            border-radius: 5px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #0056b3;
        }

        /* Dark mode scrollbar */
        .dark-mode .table-responsive::-webkit-scrollbar-track {
            background: #2d2d2d;
        }

        /* Font weights */
        .font-weight-medium {
            font-weight: 500;
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', function() {
            // Card widget controls
            $('[data-card-widget="collapse"]').click(function() {
                $(this).closest('.card').find('.card-body').slideToggle();
                $(this).find('i').toggleClass('fa-minus fa-plus');
            });

            $('[data-card-widget="refresh"]').click(function() {
                $(this).find('i').addClass('fa-spin');
                setTimeout(() => {
                    $(this).find('i').removeClass('fa-spin');
                }, 1000);
            });
        });
    </script>
</div>
