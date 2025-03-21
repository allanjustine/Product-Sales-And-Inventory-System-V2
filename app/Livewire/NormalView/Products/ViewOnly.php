<?php

namespace App\Livewire\NormalView\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ViewOnly extends Component
{

    #[Title("Products")]

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    // public $perPage = 15;
    public $category_name = 'All';
    public $sort = 'low_to_high';
    public $product_rating = 'All';
    public $productView = null;
    public $allDisplayProducts;
    public $defaultPage = 20;
    public $loadMorePlus = 20;

    use WithPagination;

    public function loadMore()
    {
        $this->defaultPage += $this->loadMorePlus;
    }

    public function updatedSearch($value) {
        $this->dispatch('searchData', search: $value);
    }

    public function mount()
    {
        $this->allDisplayProducts = Product::count();
    }

    public function displayProducts()
    {
        $query = Product::search($this->search);

        if ($this->category_name != 'All') {
            $query->whereHas('product_category', function ($q) {
                $q->where('category_name', $this->category_name);
            });
        }

        if ($this->sort === 'low_to_high') {
            $query->orderBy('product_price', 'asc');
        } else {
            $query->orderBy('product_price', 'desc');
        }

        if ($this->product_rating != 'All') {
            if ($this->product_rating == 1) {
                $query->whereBetween('product_rating', [1.0, 1.9]);
            } else
            if ($this->product_rating == 2) {
                $query->whereBetween('product_rating', [2.0, 2.9]);
            } else
            if ($this->product_rating == 3) {
                $query->whereBetween('product_rating', [3.0, 3.9]);
            } else if ($this->product_rating == 4) {
                $query->whereBetween('product_rating', [4.0, 4.9]);
            } else {
                $query->where('product_rating', $this->product_rating);
            }
        }


        $products = $query->paginate($this->defaultPage);

        return compact('products');
    }

    public function view($id)
    {
        $this->productView = Product::find($id);
    }

    #[On('closedModal')]
    public function closedModal()
    {
        $this->productView = null;
    }

    public function clearFilters()
    {
        $this->search = '';
        // $this->perPage = 15;
        $this->category_name = 'All';
        $this->sort = 'low_to_high';
        $this->product_rating = 'All';
        $this->resetPage();
    }

    public function render()
    {
        $product_categories = ProductCategory::all();

        return view('livewire.normal-view.products.view-only', $this->displayProducts(), ['product_categories' => $product_categories]);
    }
}
