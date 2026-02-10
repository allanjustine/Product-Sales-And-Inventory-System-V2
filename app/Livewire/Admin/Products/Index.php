<?php

namespace App\Livewire\Admin\Products;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    use WithFileUploads;

    #[Title('Products')]
    public $category_name = 'All';
    public $perPage = 5;
    public $search;
    public $sortBy = 'product_name';
    public $sortDirection = 'asc';
    public $product_stock = 0;
    public $product_category_id, $product_name, $product_description, $product_status, $product_price, $product_old_price, $product_code;
    public $productEdit, $productToDelete, $productView;
    public $product_images = [];
    public $is_color_selected = false;
    public $is_size_selected = false;
    public $size_names = [];
    public $size_stocks = [0];
    public $color_names = [];
    public $color_stocks = [0];
    public $to_remove_images = [];
    public $size_lists = [""];
    public $color_lists = [""];
    public $product_size_id;
    public $product_color_id;

    public function handleSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function sweetAlert($title, $icon, $message, $reset = true)
    {
        $this->dispatch('alert', alerts: [
            'title'         =>          $title,
            'type'          =>          $icon,
            'message'       =>          $message
        ]);

        $this->dispatch('closeModal');

        if ($reset) {
            $this->reset();
        }

        return;
    }

    public function displayProducts()
    {
        $query = Product::with(['product_category', 'productImages', 'productSizes', 'productColors'])
            ->withSum([
                'orders'
                =>
                fn($query)
                => $query->where('order_status', '!=', "Cancelled"),
            ], 'order_quantity')
            ->search($this->search);

        if ($this->category_name != 'All') {
            $query->whereHas('product_category', function ($q) {
                $q->where('category_name', $this->category_name);
            });
        }

        $products = $query->orderBy($this->sortBy, $this->sortDirection);

        $products = $query->paginate($this->perPage);

        $product_categories = ProductCategory::all();

        return compact('products', 'product_categories');
    }

    public function generateProductCode()
    {
        $this->product_code = 'AJM-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);
    }

    public function addProduct()
    {
        $validatedData = $this->validate([
            'product_name'              =>          'required|string|unique:products|max:255',
            'product_description'       =>          'required|string|max:65535',
            'product_price'             =>          'required|string|numeric|min:1|lte:product_old_price',
            'product_old_price'         =>          'required|string|numeric|gte:product_price',
            'product_status'            =>          'required|string',
            'product_stock'             =>          'numeric',
            'product_images'            =>          'required',
            'product_images.*'          =>          'mimes:jpg,jpeg,png,webp|max:2040',
            'product_category_id'       =>          'required',
            'size_names'                =>          'required_if:is_size_selected,true',
            'size_names.*'              =>          'required_if:is_size_selected,true|min:1|max:20',
            'size_stocks'               =>          'required_if:is_size_selected,true',
            'size_stocks.*'             =>          'required_if:is_size_selected,true|numeric',
            'color_names'               =>          'required_if:is_color_selected,true',
            'color_names.*'             =>          'required_if:is_color_selected,true|min:1|max:20',
            'color_stocks'              =>          'required_if:is_color_selected,true',
            'color_stocks.*'            =>          'required_if:is_color_selected,true|numeric',
        ], [
            'product_price.lte'     => 'The product price must be less than or equal to the product old price.',
            'product_old_price.gte' => 'The product price must be greater than or equal to the product price.',
        ]);

        if (!$this->is_size_selected && !$this->is_color_selected && !$this->product_stock) {
            $this->addError('product_stock', 'Product stock is required.');
            return;
        }

        $paths = [];

        foreach ($this->product_images as $product_image) {
            $name = time() . '-' . $product_image->getClientOriginalName();
            $paths[] = [
                'path' => $product_image->storeAs('product/images', $name, 'public')
            ];
        }

        $sizes = [];
        $colors = [];

        foreach ($this->size_names as $key => $size_name) {
            $sizes[] = [
                'name'  => $size_name,
                'stock' => $this->size_stocks[$key]
            ];
        }

        foreach ($this->color_names as $key => $color_name) {
            $colors[] = [
                'name'  => $color_name,
                'stock' => $this->color_stocks[$key]
            ];
        }

        $product = Product::create([
            'product_name'                  =>          $validatedData['product_name'],
            'product_description'           =>          $validatedData['product_description'],
            'product_price'                 =>          $validatedData['product_price'],
            'product_old_price'             =>          $validatedData['product_old_price'],
            'product_stock'                 =>          $validatedData['product_stock'],
            'product_status'                =>          $validatedData['product_status'],
            'product_category_id'           =>          $validatedData['product_category_id'],
            'product_code'                  =>          $this->product_code
        ]);

        $product->productSizes()->createMany($sizes);

        $product->productColors()->createMany($colors);

        $product->productImages()->createMany($paths);

        $this->sweetAlert('Product Added', 'success', "The product \"{$product->product_name}\" is added to list.");

        return;
    }

    #[On('resetInputs')]
    public function resetInputs()
    {
        $this->product_name = '';
        $this->product_description = '';
        $this->product_price = '';
        $this->product_old_price = '';
        $this->product_stock = '';
        $this->product_status = '';
        $this->product_category_id = '';
        $this->product_images = [];
        $this->productEdit = null;
        $this->productView = null;
        $this->productToDelete = null;

        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->productEdit = Product::find($id);

        $this->product_name = $this->productEdit->product_name;
        $this->product_description = $this->productEdit->product_description;
        $this->product_price = $this->productEdit->product_price;
        $this->product_old_price = $this->productEdit->product_old_price;
        $this->product_stock = $this->productEdit->product_stock;
        $this->product_status = $this->productEdit->product_status;
        $this->product_category_id = $this->productEdit->product_category_id;
        $this->product_code = $this->productEdit->product_code;
        $this->is_color_selected = $this->productEdit->productColors()->exists();
        $this->is_size_selected = $this->productEdit->productSizes()->exists();
    }

    public function updatedIsColorSelected()
    {
        $this->product_stock = 0;
    }

    public function updatedIsSizeSelected()
    {
        $this->product_stock = 0;
    }

    public function statusChange($id)
    {
        $product = Product::findOrFail($id);

        if ($product->product_status == 'Available') {
            $product->update([
                'product_status'    =>      'Not Available'
            ]);
        } else {
            $product->update([
                'product_status'    =>      'Available'
            ]);
        }

        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      "Status changed to {$product->product_status}"
        ]);
        return;
    }

    public function update()
    {
        $this->validate([
            'product_name'          => ['required', 'string', 'max:255', 'unique:products,product_name,' . $this->productEdit->id],
            'product_price'         => 'required|string|numeric|min:1|lte:product_old_price',
            'product_old_price'     => 'required|string|numeric|gte:product_price',
            'product_images.*'      => 'mimes:jpg,jpeg,png,webp|max:2040',
            'product_stock'         => 'numeric',
        ], [
            'product_price.lte'     => 'The product price must be less than or equal to the product old price.',
            'product_old_price.gte' => 'The product price must be greater than or equal to the product price.',
        ]);

        $imagesToRemove = Image::whereIn('id', $this->to_remove_images)->get();

        if (!$this->productEdit->productImages()->exists() && count($this->product_images) === 0) {
            $this->addError('product_images', 'At least one image is required.');
            return;
        }

        if (!$this->is_size_selected && !$this->is_color_selected) {
            $this->addError('product_stock', 'Product stock is required.');
            return;
        }

        if ($imagesToRemove->count() > 0) {
            Storage::disk('public')->delete($imagesToRemove->pluck('path')->toArray());
            $imagesToRemove->each->delete();
        }

        $paths = [];

        if (count($this->product_images) > 0) {
            foreach ($this->product_images as $image) {
                $name = time() . '.' . $image->getClientOriginalExtension();
                $paths[] = $image->storeAs('product/images', $name, 'public');
            }
        }

        $this->productEdit->update([
            'product_name'              =>          $this->product_name,
            'product_description'       =>          $this->product_description,
            'product_price'             =>          $this->product_price,
            'product_old_price'         =>          $this->product_old_price,
            'product_stock'             =>          $this->product_stock,
            'product_status'            =>          $this->product_status,
            'product_category_id'       =>          $this->product_category_id,
        ]);

        $this->productEdit->productImages()->createMany($paths);

        $this->sweetAlert('Product Updated', 'success', message: "The product \"{$this->productEdit->product_name}\" is updated successfully.");
    }

    public function remove($key)
    {
        unset($this->product_images[$key]);

        $this->product_images = array_values($this->product_images);

        $this->resetErrorBag("product_images.*");
    }

    public function removeImage($id)
    {
        $this->to_remove_images[] = $id;
    }

    public function delete($id)
    {
        $this->productToDelete = Product::find($id);
    }

    public function deleteProduct()
    {
        Storage::disk('public')->delete($this->productToDelete?->productImages()?->pluck('path')?->toArray());

        $this->productToDelete->delete();

        $this->productView = null;
        $this->productEdit = null;

        $this->sweetAlert('Product Removed', 'success', message: "The product \"{$this->productToDelete?->product_name}\" has been removed successfully.", reset: false);
    }

    public function view($id)
    {
        $this->productView = Product::find($id);
    }

    public function addColor()
    {
        $this->color_lists[] = "";
        $this->color_names[] = '';
        $this->color_stocks[] = 0;
    }

    public function removeColor($key)
    {
        unset($this->color_lists[$key], $this->color_names[$key], $this->color_stocks[$key]);
    }

    public function addSize()
    {
        $this->size_lists[] = "";
        $this->size_names[] = '';
        $this->size_stocks[] = 0;
    }

    public function removeSize($key)
    {
        unset($this->size_lists[$key], $this->size_names[$key], $this->size_stocks[$key]);
    }

    public function render()
    {
        return view('livewire.admin.products.index', $this->displayProducts());
    }
}
