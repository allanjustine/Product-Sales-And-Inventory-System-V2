<?php

namespace App\Livewire\NormalView\Favorites;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
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
        return;
    }

    public function view($id)
    {
        $this->productView = Product::find($id);
    }

    public function addToCart($id)
    {
        $this->productToBeCart = Product::find($id);
    }
    public function addToCartNow()
    {
        $this->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $this->productToBeCart->id)
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
            ]);
        }

        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      'Product added to cart successfully.'
        ]);
        $this->dispatch('closeModal');
        $this->reset();

        // alert()->success('Success', 'Product added to cart successfully.');

        // return $this->redirect('/favorites', navigate: true);
        return;
    }

    #[On('closedModal')]
    public function closedModal()
    {
        $this->productView = null;
    }

    public function toBuyNow($productId)
    {

        $this->orderToBuy = Product::findOrFail($productId);

        if (auth()->check()) {
            $this->user_location = auth()->user()->user_location;
        }

        $this->orderPlaceOrder = $productId;
    }

    public function orderPlaceOrderItem()
    {
        $product = Product::find($this->orderPlaceOrder);

        $this->validate([
            'order_quantity'        =>      ['required', 'numeric', 'min:1'],
        ]);

        $productQuantity = $product->product_stock;
        $productStatus = $product->product_status;

        if ($productStatus == 'Available' && $productQuantity >= $this->order_quantity) {
            Auth::user()->orderSummaries()->delete();

            Auth::user()->orderSummaries()->create([
                'product_id'     => $product->id,
                'order_quantity' => $this->order_quantity
            ]);

            $this->dispatch('closeModal');

            return $this->redirect('/order-summaries', navigate: true);
        } else {

            if ($productStatus == 'Not Available') {
                // alert()->error('Sorry', 'The product is Not Available');

                // return $this->redirect('/products', navigate: true);

                $this->dispatch('toastr',  data: [
                    'type' => 'error',
                    'message' => 'The product is Not Available'
                ]);
                return;
            } elseif ($product->product_stock == 0) {
                // alert()->error('Sorry', 'The product is out of stock');

                // return $this->redirect('/products', navigate: true);
                $this->dispatch('toastr',  data: ['type' => 'warning', 'message' => 'The product is out of stock']);
                return;
            } else {
                // alert()->error('Sorry', 'The product stock is insufficient please reduce your cart quantity');

                // return $this->redirect('/products', navigate: true);
                $this->dispatch('toastr',  data: ['type' => 'info', 'message' => 'The product stock is insufficient please reduce your cart quantity']);
                return;
            }
        }
    }

    public function render()
    {
        return view('livewire.normal-view.favorites.index', $this->displayAllFavorites());
    }
}
