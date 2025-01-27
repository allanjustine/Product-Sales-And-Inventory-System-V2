<?php

namespace App\Livewire\Admin\ProductCategories;

use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['resetInputs'];

    public $perPage = 5;
    public $search;
    public $sortBy = 'category_name';
    public $sortDirection = 'asc';
    public $category_name, $category_description;
    public $productCategoryEdit, $productCategoryToDelete, $productCategoryRemove;

    public function sortBy($field)
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

    public function addProductCategory()
    {
        $this->validate([
            'category_name'         =>      'required|string|max:255|unique:product_categories',
            'category_description'  =>      'required|string|max:65535'
        ]);

        $product_category = ProductCategory::create([
            'category_name'                =>      $this->category_name,
            'category_description'         =>      $this->category_description,
        ]);

        alert()->success('Product Category Added', '"' . $product_category->category_name . '" is added to the list ');
        return redirect('/admin/product-categories');
    }

    public function resetInputs()
    {
        $this->category_name = '';
        $this->category_description = '';

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

        alert()->success('Product Category Updated', '"' . $this->category_name . '" is updated successfully');
        return redirect('/admin/product-categories');
    }

    public function delete($id)
    {
        $this->productCategoryToDelete = ProductCategory::find($id);

        $this->productCategoryRemove = $id;
    }

    public function deleteProductCategory()
    {
        $productCategory = ProductCategory::where('id', $this->productCategoryRemove)->first();

        $productCategory->delete();

        alert()->success('Product Category Removed', 'The product category "' . $productCategory->category_name .'" has been removed successfully');

        return redirect('/admin/product-categories');
    }

    public function render()
    {
        return view('livewire.admin.product-categories.index', $this->displayProductCategories());
    }
}
