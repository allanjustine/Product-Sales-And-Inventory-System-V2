<?php

namespace App\Livewire\NormalView\Favorites;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    #[Title('My Favorites')]

    public $productToBeCart;
    public $productView;
    public $orderToBuy;
    public $quantity = 1;
    public $user_location;
    public $order_quantity = 1;
    public $order_payment_method;
    public $orderPlaceOrder;
    public $loadMore = 20;
    public $loadMorePlus = 20;
    public $has_sizes = false;
    public $has_colors = false;

    #[Validate('required_if:has_sizes,true', message: 'Please select a product size.')]
    public $product_size_id = null;

    #[Validate('required_if:has_colors,true', message: 'Please select a product color.')]
    public $product_color_id = null;

    public function rules()
    {
        if ($this->orderToBuy) {

            return [
                'order_quantity' => "required|numeric|min:1|lte:{$this->orderToBuy->productStocks()}"
            ];
        }

        return [];
    }

    public function loadMorePages()
    {
        $this->loadMore += $this->loadMorePlus;
    }

    #[On('isRefresh')]
    public function displayAllFavorites()
    {
        $allFavorites = Favorite::with(['product.product_category'])->where(['user_id' => auth()->user()->id, 'status' => true])->latest()->take($this->loadMore)->get();
        $allFavoritesData = Favorite::with(['product.product_category'])->where(['user_id' => auth()->user()->id, 'status' => true])->count();

        return compact('allFavorites', 'allFavoritesData');
    }

    public function notAvailable()
    {
        $this->dispatch('toastr', data: [
            'type'      =>      'error',
            'message'   =>      'This product is not available.'
        ]);
        return;
    }

    public function outOfStock()
    {
        $this->dispatch('toastr', data: [
            'type'      =>      'error',
            'message'   =>      'This product is out of stock.'
        ]);
        return;
    }

    public function removeToFavorite($id)
    {
        Favorite::findOrFail($id)->delete();

        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      'Removed from favorites.'
        ]);
        $this->dispatch('isRefresh');
        $this->dispatch('closeModal');
        $this->reset();

        return;
    }

    public function view($id)
    {
        $this->reset();
        $this->resetErrorBag();

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

    public function addToCart($id)
    {
        $this->reset();

        $this->productToBeCart = Product::withCount([
            'productRatings',
            'orders'
            =>
            fn($query)
            => $query->where('order_status', '!=', "Cancelled")
        ])
            ->with([
                'product_category',
                'productSizes',
                'productColors',
                'productImages'
            ])
            ->find($id);

        $this->has_sizes = $this->productToBeCart?->productSizes?->isNotEmpty();
        $this->has_colors = $this->productToBeCart?->productColors?->isNotEmpty();
    }

    public function updatedProductColorIds($value, $key)
    {
        Cart::where('user_id', Auth::id())
            ->where('id', $key)
            ->update([
                'product_color_id' => $value
            ]);

        return $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Color updated']);
    }

    public function updatedProductSizeIds($value, $key)
    {
        Cart::where('user_id', Auth::id())
            ->where('id', $key)
            ->update([
                'product_size_id' => $value
            ]);

        return $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Size updated']);
    }

    public function updatedQuantity($value)
    {
        $this->quantity = !$value ? 1 : ($value > 999 ? 999 : $value);
    }

    public function updatedOrderQuantity($value)
    {
        $this->order_quantity = !$value ? 1 : ($value > 999 ? 999 : $value);
    }

    public function addToCartNow()
    {
        $this->validate();

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $this->productToBeCart->id)
            ->whereRelation('productSize', 'id', $this->product_size_id)
            ->whereRelation('productColor', 'id', $this->product_color_id)
            ->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $this->quantity,
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $this->productToBeCart->id,
                'quantity' => $this->quantity,
                'product_size_id'  => $this->product_size_id,
                'product_color_id' => $this->product_color_id
            ]);
        }

        $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Product added to cart successfully.']);
        $this->dispatch('closeModal');
        // $this->reset();

        // alert()->success('Success', 'Product added to cart successfully.');

        // return $this->redirect('/products', navigate: true);
        $this->dispatch('addTocartRefresh');
        $this->reset();

        return;
    }

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

    public function addToCartNowItem($id)
    {
        $this->validate();

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->whereRelation('productSize', 'id', $this->product_size_id)
            ->whereRelation('productColor', 'id', $this->product_color_id)
            ->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + 1,
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => 1,
                'product_size_id'  => $this->product_size_id,
                'product_color_id' => $this->product_color_id
            ]);
        }

        $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Product added to cart successfully.']);
        $this->dispatch('closeModal');
        $this->dispatch('addTocartRefresh');
        $this->reset();

        return;
    }

    #[On('closedModal')]
    public function closedModal()
    {
        $this->productView = null;
    }

    public function toBuyNow($productId)
    {
        $this->reset();
        $this->resetErrorBag();

        $this->orderToBuy = Product::withCount([
            'productRatings',
            'orders'
            =>
            fn($query)
            => $query->where('order_status', '!=', "Cancelled")
        ])
            ->with([
                'product_category',
                'productSizes',
                'productColors',
                'productImages'
            ])
            ->find($productId);

        if (auth()->check()) {
            $this->user_location = auth()->user()->user_location;
        }

        $this->has_sizes = $this->orderToBuy?->productSizes?->isNotEmpty();
        $this->has_colors = $this->orderToBuy?->productColors?->isNotEmpty();

        $this->orderPlaceOrder = $productId;
    }

    public function orderPlaceOrderItem()
    {
        $this->validate();

        $product = Product::with('productSizes', 'productColors')->find($this->orderPlaceOrder);

        $productStock = $product->product_stock;
        $productSizeStock = $product->productSizes()->find($this->product_size_id)?->stock ?: 0;
        $productColorStock = $product->productColors()->find($this->product_color_id)?->stock ?: 0;
        $productStatus = $product->product_status;

        if ($productStatus == 'Not Available') {

            $this->dispatch('toastr',  data: [
                'type' => 'error',
                'message' => 'The product is Not Available'
            ]);
            return;
        }

        if ($product->productStocks() < $this->order_quantity) {
            $this->dispatch('toastr',  data: ['type' => 'warning', 'message' => 'The product is out of stock']);
            return;
        }

        if ($product->productSizes()->exists() && $productSizeStock < $this->order_quantity) {
            $this->dispatch('toastr',  data: [
                'type' => 'error',
                'message' => 'The product size is not enough stock or out of stock. Please reduce your order quantity to continue.'
            ]);
            $this->addError('product_size_id', 'The product size is not enough stock or out of stock. Please reduce your order quantity to continue.');
            return;
        }

        if ($product->productColors()->exists() && $productColorStock < $this->order_quantity) {
            $this->dispatch('toastr',  data: [
                'type' => 'error',
                'message' => 'The product color is not enough stock or out of stock. Please reduce your order quantity to continue.'
            ]);
            $this->addError('product_color_id', 'The product color is not enough stock or out of stock. Please reduce your order quantity to continue.');
            return;
        }

        if (!$product->productSizes()->exists() && !$product->productColors()->exists() && $productStock < $this->order_quantity) {
            $this->dispatch('toastr',  data: [
                'type' => 'error',
                'message' => 'The product is out of stock. Please reduce your order quantity to continue.'
            ]);
            $this->addError('order_quantity', 'The product is out of stock. Please reduce your order quantity to continue.');
            return;
        }

        Auth::user()->orderSummaries()->delete();

        Auth::user()->orderSummaries()->create([
            'product_id'       => $product->id,
            'order_quantity'   => $this->order_quantity,
            'product_size_id'  => $this->product_size_id,
            'product_color_id' => $this->product_color_id
        ]);

        $this->dispatch('closeModal');

        return $this->redirect('/order-summaries', navigate: true);
    }

    public function render()
    {
        return view('livewire.normal-view.favorites.index', $this->displayAllFavorites());
    }
}
