<?php

namespace App\Livewire\Admin\Products;

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
    public $product_category_id, $product_image, $product_name, $product_description, $product_status, $product_stock, $product_price, $product_code;
    public $productEdit, $product_image_url, $productToDelete, $productView;

    public function handleSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function sweetAlert($title, $icon, $message) {
        $this->dispatch('alert', alerts: [
            'title'         =>          $title,
            'type'          =>          $icon,
            'message'       =>          $message
        ]);

        $this->dispatch('closeModal');

        $this->reset();

        return;
    }

    public function displayProducts()
    {
        $query = Product::search($this->search);

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
    
    public function generateProductCode() {
        $this->product_code = 'AJM-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);
    }

    public function addProduct()
    {
        $validatedData = $this->validate([
            'product_name'              =>          'required|string|unique:products|max:255',
            'product_description'       =>          'required|string|max:65535',
            'product_price'             =>          'required|string|numeric|min:1',
            'product_stock'             =>          'required|string|numeric',
            'product_status'            =>          'required|string',
            'product_image'             =>          'required|image|max:10000',
            'product_category_id'       =>          'required'
        ]);
        $path = $this->product_image->store('public/product/images');

        $product = Product::create([
            'product_name'                  =>          $validatedData['product_name'],
            'product_description'           =>          $validatedData['product_description'],
            'product_price'                 =>          $validatedData['product_price'],
            'product_stock'                 =>          $validatedData['product_stock'],
            'product_status'                =>          $validatedData['product_status'],
            'product_category_id'           =>          $validatedData['product_category_id'],
            'product_image'                 =>          $path,
            'product_code'                  =>          $this->product_code
        ]);

        $this->sweetAlert('Product Added', 'success', message: "The product \"{$product->product_name}\" is added to list.");

    }

    #[On('resetInputs')]
    public function resetInputs()
    {
        $this->product_name = '';
        $this->product_description = '';
        $this->product_price = '';
        $this->product_stock = '';
        $this->product_status = '';
        $this->product_category_id = '';
        $this->product_image = '';
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
        $this->product_stock = $this->productEdit->product_stock;
        $this->product_status = $this->productEdit->product_status;
        $this->product_category_id = $this->productEdit->product_category_id;
        $this->product_code = $this->productEdit->product_code;

        if (is_string($this->productEdit->product_image)) {
            $this->product_image_url = Storage::exists($this->productEdit->product_image) ? Storage::url($this->productEdit->product_image) : $this->productEdit->product_image;
        } else {
            $this->product_image = $this->productEdit->product_image;
            $this->product_image_url = $this->product_image->temporaryUrl();
        }
    }

    public function statusChange($id)
    {
        $product = Product::findOrFail($id);

        if($product->product_status == 'Available')
        {
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
            'product_name'             =>      ['required', 'string', 'max:255', 'unique:products,product_name,' . $this->productEdit->id],
            'product_image'            =>      $this->product_image ? ['image', 'max:10000'] : ''
        ]);

        if ($this->product_image) {
            Storage::delete($this->productEdit->product_image);
        }

        $this->productEdit->update([
            'product_name'              =>          $this->product_name,
            'product_description'       =>          $this->product_description,
            'product_price'             =>          $this->product_price,
            'product_stock'             =>          $this->product_stock,
            'product_status'            =>          $this->product_status,
            'product_category_id'       =>          $this->product_category_id,
            'product_image'             =>          $this->product_image ? $this->product_image->store('public/product/images') : $this->productEdit->product_image
        ]);

        $this->sweetAlert('Product Updated', 'success', message: "The product \"{$this->productEdit->product_name}\" is updated successfully.");
    }

    public function delete($id)
    {
        $this->productToDelete = Product::find($id);
    }

    public function deleteProduct()
    {

        Storage::delete($this->productToDelete->product_image);

        $this->productToDelete->delete();

        $this->productView = null;
        $this->productEdit = null;

        $this->sweetAlert('Product Removed', 'success', message: "The product \"{$this->productToDelete?->product_name}\" has been removed successfully.");
    }

    public function view($id)
    {
        $this->productView = Product::find($id);
    }

    public function render()
    {
        return view('livewire.admin.products.index', $this->displayProducts());
    }
}
