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
    public $minPrice = 0;
    public $maxPrice = 0;
    public $inStockOnly = false;
    public $hasDiscount = false;
    public $product_size_id = null;
    public $product_color_id = null;

    use WithPagination;

    public function loadMore()
    {
        $this->defaultPage += $this->loadMorePlus;
    }

    public function updatedSearch($value)
    {
        $this->dispatch('searchData', search: $value);
    }

    public function mount()
    {
        $this->allDisplayProducts = Product::count();
    }

    public function displayProducts()
    {
        $query = Product::with(['product_category', 'favorites', 'productImages', 'productSizes', 'productColors'])
            ->withSum([
                'orders'
                =>
                fn($query)
                => $query->where('order_status', '!=', "Cancelled")

            ], 'order_quantity')
            ->withCount([
                'orders'
                =>
                fn($query)
                => $query->where('order_status', '!=', "Cancelled"),
                'productRatings'
            ])
            ->withAvg('productRatings', 'rating')
            ->search($this->search);

        $sorted_by = request('sorted_by', '');

        if ($this->category_name != 'All') {
            $query->whereHas('product_category', function ($q) {
                $q->where('category_name', $this->category_name);
            });
        }

        if ($sorted_by === 'top_selling') {
            $query->orderBy('orders_sum_order_quantity', 'desc');
        } else if ($sorted_by === 'latest') {
            $query->orderBy('id', 'desc');
        } elseif ($sorted_by === 'popularity') {
            $query->orderBy('product_ratings_count', 'desc');
        } elseif ($this->sort === 'low_to_high') {
            $query->orderBy('product_price', 'asc');
        } else {
            $query->orderBy('product_price', 'desc');
        }

        if ($this->product_rating != 'All') {
            if ($this->product_rating == 1) {
                $query->havingBetween('product_ratings_avg_rating', [1.0, 1.9]);
            } else
            if ($this->product_rating == 2) {
                $query->havingBetween('product_ratings_avg_rating', [2.0, 2.9]);
            } else
            if ($this->product_rating == 3) {
                $query->havingBetween('product_ratings_avg_rating', [3.0, 3.9]);
            } else if ($this->product_rating == 4) {
                $query->havingBetween('product_ratings_avg_rating', [4.0, 4.9]);
            } else {
                $query->having('product_ratings_avg_rating', $this->product_rating);
            }
        }

        if ($this->maxPrice && $this->minPrice) {
            $query->whereBetween('product_price', [$this->minPrice, $this->maxPrice]);
        }

        $products = $query->when(
            $this->inStockOnly,
            fn($q)
            =>
            $q->whereNotNull('product_stock')
                ->where('product_stock', '>', 0)
                ->whereHas('productSizes', function ($item) {
                    $item->where('stock', '>', 0);
                })
        )
            ->when($this->hasDiscount, fn($q) => $q->whereNotNull('product_old_price'))
            ->paginate($this->defaultPage);
        return compact('products');
    }

    public function view($id)
    {
        $this->productView = Product::withCount([
            'productRatings',
            'orders'
            =>
            fn($query)
            => $query->where('order_status', '!=', "Cancelled")
        ])
            ->withSum([
                'orders'
                =>
                fn($query)
                => $query->where('order_status', '!=', "Cancelled")
            ], 'order_quantity')
            ->with([
                'product_category',
                'productSizes',
                'productColors',
                'productImages'
            ])
            ->find($id);
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
        $this->minPrice = 0;
        $this->maxPrice = 0;
        $this->inStockOnly = false;
        $this->resetPage();
    }

    public function render()
    {
        $product_categories = ProductCategory::withCount(['products' => function ($q) {
            $q->search($this->search);
        }])->get();

        return view('livewire.normal-view.products.view-only', $this->displayProducts(), ['product_categories' => $product_categories]);
    }
}
