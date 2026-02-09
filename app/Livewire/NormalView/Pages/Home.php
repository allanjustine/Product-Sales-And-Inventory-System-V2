<?php

namespace App\Livewire\NormalView\Pages;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Home extends Component
{
    #[Title("Home")]

    public $productView;
    public $morning;
    public $afternoon;
    public $evening;
    public $has_sizes = false;
    public $has_colors = false;

    #[Validate('required_if:has_sizes,true', message: 'Please select a product size.')]
    public $product_size_id = null;

    #[Validate('required_if:has_colors,true', message: 'Please select a product color.')]
    public $product_color_id = null;

    public function toggleProductVariant($title, $id)
    {
        if ($title == 'size') {
            if (ProductSize::find($id)->stock === 0) {
                $this->product_size_id = null;
                return $this->addError('product_size_id', 'Product with this size is out of stock.');
            }
            $this->product_size_id = $id === $this->product_size_id ? null : $id;
            $this->resetErrorBag('product_size_id');
        }

        if ($title == 'color') {
            if (ProductColor::find($id)->stock === 0) {
                $this->product_color_id = null;
                return $this->addError('product_color_id', 'Product with this color is out of stock.');
            }
            $this->product_color_id = $id === $this->product_color_id ? null : $id;
            $this->resetErrorBag('product_color_id');
        }
    }

    public function essentialItems()
    {
        $topDeals = Product::with([
            'product_category',
            'productImages',
            'favorites.product',
            'productRatings.ratingImages',
            'productRatings.user'
        ])
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
            ->whereHas(
                'orders',

                fn($query)
                =>
                $query->where('order_status', '!=', "Cancelled")
            )
            ->orderBy('orders_sum_order_quantity', 'desc')
            ->take(value: 12)
            ->get();

        $popularityDeals = Product::with([
            'product_category',
            'productImages',
            'favorites.product',
            'productRatings.ratingImages',
            'productRatings.user',
        ])
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
            ->has('productRatings')
            ->orderBy('product_ratings_count', 'desc')
            ->take(12)
            ->get();

        $latestProducts = Product::with([
            'product_category',
            'productImages',
            'favorites.product',
            'productRatings.ratingImages',
            'productRatings.user',
        ])
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
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();

        return compact('topDeals', 'popularityDeals', 'latestProducts');
    }

    public function addToCartNowItem($id)
    {
        $this->validate();

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->where('product_size_id', $this->product_size_id)
            ->where('product_color_id', $this->product_color_id)
            ->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + 1,
            ]);
        } else {
            Cart::create([
                'user_id'          => auth()->id(),
                'product_id'       => $id,
                'quantity'         => 1,
                'product_size_id'  => $this->product_size_id,
                'product_color_id' => $this->product_color_id
            ]);
        }

        $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Product added to cart successfully.']);
        $this->dispatch('closeModal');
        $this->reset();

        return;
    }

    public function removeToFavorite($id)
    {
        Favorite::findOrFail($id)->delete();

        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      'Removed from favorites.'
        ]);

        return;
    }

    public function mount()
    {
        $time = now()->format('H');

        $this->morning = $time >= 0 && $time < 12;
        $this->afternoon = $time >= 12 && $time < 18;
        $this->evening = $time >= 18 && $time <= 23;
    }

    public function view($id)
    {
        $this->reset();

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

        $this->has_sizes = $this->productView->productSizes->isNotEmpty();
        $this->has_colors = $this->productView->productColors->isNotEmpty();
    }

    #[On('closedModal')]
    public function closedModal()
    {
        $this->productView = null;
    }

    public function addToFavorite($id)
    {
        $productFav = Product::findOrFail($id);

        $added = Favorite::where(['user_id' => auth()->user()->id, 'product_id' => $productFav->id, 'status' => true])->first();

        if ($added) {
            $added->delete();
            $this->dispatch('toastr', data: [
                'type'      =>      'success',
                'message'   =>      'Removed from favorites'
            ]);
            return;
        } else {
            Favorite::create([
                'user_id'           =>      auth()->user()->id,
                'product_id'        =>      $productFav->id,
                'status'            =>      true
            ]);

            $this->dispatch('toastr', data: [
                'type'      =>      'success',
                'message'   =>      'Added to favorites'
            ]);
            return;
        }
    }

    public function render()
    {
        return view('livewire.normal-view.pages.home', $this->essentialItems());
    }
}
