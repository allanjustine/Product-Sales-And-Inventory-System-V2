<?php

namespace App\Livewire\Admin\ProductCategories;

use App\Models\ProductCategory;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Title('Product Categories')]

    public $perPage = 5;
    public $search;
    public $sortBy = 'category_name';
    public $sortDirection = 'asc';
    public $category_name, $category_description;
    public $productCategoryEdit, $productCategoryToDelete, $productCategoryRemove;

    public function handleSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function displayProductCategories()
    {
        $product_categories = ProductCategory::where(function ($query) {
            $query->where('category_name', 'like', '%' . $this->search . '%')
                ->orWhere('category_description', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return compact('product_categories');
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

    public function addProductCategory()
    {
        $this->validate([
            'category_name'         =>      'required|string|max:255|unique:product_categories|not_in:Manual',
            'category_description'  =>      'required|string|max:65535'
        ], [
            'category_name.not_in'  =>      'Category name cannot be "Manual"'
        ]);

        $product_category = ProductCategory::create([
            'category_name'                =>      $this->category_name,
            'category_description'         =>      $this->category_description,
        ]);

        $this->sweetAlert('Product Category Added', 'success', "\"{$product_category->category_name}\" is added to the list ");
    }

    #[On('resetInputs')]
    public function resetInputs()
    {
        $this->category_name = '';
        $this->category_description = '';
        $this->productCategoryEdit = null;
        $this->productCategoryToDelete = null;

        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->productCategoryEdit = ProductCategory::find($id);

        $this->category_name = $this->productCategoryEdit->category_name;
        $this->category_description = $this->productCategoryEdit->category_description;
    }

    public function update()
    {
        $this->validate([
            'category_name'         =>          ['required', 'string', 'unique:product_categories,category_name,' . $this->productCategoryEdit->id],
        ]);

        $this->productCategoryEdit->update([
            'category_name'                =>      $this->category_name,
            'category_description'         =>      $this->category_description,
        ]);

        $this->sweetAlert('Product Category Updated', 'success', "\"{$this->category_name}\" is updated successfully");
    }

    public function delete($id)
    {
        $this->productCategoryToDelete = ProductCategory::find($id);
    }

    public function deleteProductCategory()
    {

        $this->productCategoryToDelete->delete();

        $this->sweetAlert('Product Category Removed', 'success', "The product category \"{$this->productCategoryToDelete->category_name}\" has been removed successfully");
    }

    public function render()
    {
        return view('livewire.admin.product-categories.index', $this->displayProductCategories());
    }
}
