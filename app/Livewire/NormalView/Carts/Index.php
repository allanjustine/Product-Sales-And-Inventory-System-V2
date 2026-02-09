<?php

namespace App\Livewire\NormalView\Carts;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderSummary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Title('My Carts')]
    public $cartItemToRemove;
    public $cartItemToCheckOut;
    public $user_location;
    public $itemPlaceOrder;
    public $itemRemove;
    public $order_payment_method;
    public $cart_ids = [];
    public $select_all = false;
    public $grand_total = 0;
    public $total_save = 0;
    public $product_size_ids = [];
    public $product_color_ids = [];

    public function carts()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $cartSelected = Cart::whereIn('id', $this->cart_ids)
            ->get();

        $this->grand_total = (clone $cartSelected)->sum(function ($cart) {
            return $cart->product->product_price * $cart->quantity;
        });

        $totals = (clone $cartSelected)->reduce(
            function ($carry, $cart) {
                $carry['totalOldPrice'] +=
                    $cart->product->product_old_price === null
                    ? 0
                    : $cart->product->product_old_price * $cart->quantity;
                $carry['totalPrice'] +=
                    $cart->product->product_old_price === null
                    ? 0
                    : $cart->product->product_price * $cart->quantity;
                return $carry;
            },
            ['totalOldPrice' => 0, 'totalPrice' => 0],
        );

        $this->total_save = $totals['totalOldPrice'] - $totals['totalPrice'];

        foreach ($cartItems as $cart) {
            $this->product_color_ids[$cart->id] = $cart->product_color_id;
            $this->product_size_ids[$cart->id] = $cart->product_size_id;
        }

        return compact('cartItems');
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

    public function updateCartItem($itemId)
    {

        $cart = Cart::find($itemId);

        if ($cart && $cart->user_id === auth()->id()) {
            $cart->update([
                'quantity' => $cart->quantity + 1,
            ]);
        }
        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      'Quantity updated'
        ]);
        // alert()->toast('Updated cart quantity successfully', 'success');

        // return $this->redirect('/products', navigate: true);
        return;
    }

    #[On('decreaseQuantity')]
    public function decreaseQuantity($itemId)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $itemId)
            ->first();

        if ($cart) {
            $updatedQuantity = $cart->quantity - 1;

            if ($updatedQuantity > 0) {
                $cart->update([
                    'quantity' => $updatedQuantity,
                ]);

                // alert()->toast('Updated cart quantity successfully', 'success');
                // return $this->redirect('/products', navigate: true);
                $this->dispatch('toastr', data: [
                    'type'      =>      'success',
                    'message'   =>      'Quantity updated'
                ]);
            } else {
                $cart->delete();

                $this->dispatch('toastr', data: [
                    'type'      =>      'success',
                    'message'   =>      'Cart item deleted'
                ]);

                $this->dispatch('addTocartRefresh');

                $this->reset();
            }
        }

        $this->cart_ids = [];

        $this->select_all = false;

        return;
    }

    public function checkOut($itemId)
    {
        $this->cartItemToCheckOut = Cart::find($itemId);
        $this->user_location = $this->cartItemToCheckOut->user->user_location;
        $this->itemPlaceOrder = $itemId;
    }

    public function remove($itemId)
    {
        $this->cartItemToRemove = Cart::find($itemId);

        $this->itemRemove = $itemId;
    }

    public function removeItemToCart()
    {
        $product = Cart::where('id', $this->itemRemove)->first();

        $product->delete();

        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      'Removed from cart successfully'
        ]);
        $this->dispatch('closeModal');
        $this->dispatch('addTocartRefresh');
        $this->reset();
        $this->cart_ids = [];
        $this->select_all = false;

        return;
    }

    public function placeOrder()
    {
        $carts = Cart::with('productSize', 'productColor')
            ->where('user_id', Auth::id())
            ->whereIn('id', $this->cart_ids)
            ->get();

        DB::transaction(function () use ($carts) {
            Auth::user()->orderSummaries()->delete();

            foreach ($carts as $cart) {
                $productQuantity = $cart->product->productStocks();
                $productStatus = $cart->product->product_status;

                if ($productStatus == 'Not Available') {
                    // alert()->error('Sorry', 'The product is Not Available');

                    // return $this->redirect('/products', navigate: true);

                    $this->dispatch('toastr', data: ['type' => 'error', 'message' => 'The product is Not Available. Please remove it from your cart or uncheck it.']);
                    return;
                }

                if ($cart->product->productStocks() < $cart->quantity) {
                    // alert()->error('Sorry', 'The product is out of stock');

                    // return $this->redirect('/products', navigate: true);
                    $this->dispatch('toastr', data: ['type' => 'warning', 'message' => 'The product is not enough stock or out of stock. Please remove it from your cart or uncheck it.']);
                    return;
                }

                if ($cart->productSize?->stock < $cart->quantity) {
                    $this->dispatch('toastr', data: ['type' => 'warning', 'message' => 'The selected size is not enough stock or out of stock. Please remove it from your cart or replace it.']);
                    return;
                }

                if ($cart->productColor?->stock < $cart->quantity) {
                    $this->dispatch('toastr', data: ['type' => 'warning', 'message' => 'The selected color is not enough stock or out of stock. Please remove it from your cart or replace it.']);
                    return;
                }

                if ($cart->quantity > $productQuantity) {
                    // alert()->error('Sorry', 'The product stock is insufficient please reduce your cart quantity');

                    // return $this->redirect('/products', navigate: true);
                    $this->dispatch('toastr', data: ['type' => 'info', 'message' => 'The product stock is insufficient please reduce your cart quantity or remove it from your cart or uncheck it.']);
                    return;
                }

                if ($productStatus == 'Available') {

                    Auth::user()->orderSummaries()->create([
                        'product_id'       => $cart->product->id,
                        'order_quantity'   => $cart->quantity,
                        'cart_id'          => $cart->id,
                        'product_size_id'  => $cart->product_size_id,
                        'product_color_id' => $cart->product_color_id
                    ]);
                }
            }

            $this->dispatch('closeModalCart');
            $this->dispatch('addTocartRefresh');

            return $this->redirect('/order-summaries', navigate: true);
        });
    }

    private function availableCarts()
    {
        return Cart::where('user_id', Auth::id())
            ->whereHas(
                'product',
                fn($item)
                =>
                $item->where('product_status', 'Available')
            )
            ->where(function ($query) {
                $query->whereHas(
                    'productSize',

                    fn($q)

                    =>
                    $q->where('stock', '>', 0)
                )
                    ->orWhereHas(
                        'productColor',

                        fn($q)

                        =>
                        $q->where('stock', '>', 0)
                    )
                    ->orWhereHas(
                        'product',
                        fn($q)
                        =>
                        $q->whereColumn('products.product_stock', '>=', 'carts.quantity')
                    );
            });
    }

    public function updatedSelectAll($value)
    {
        $value ? $this->cart_ids = $this->availableCarts()->pluck('id')->filter() : $this->cart_ids = [];
    }

    #[On('addTocartRefresh')]
    public function updatedCartIds()
    {
        $this->select_all = count($this->cart_ids) === $this->availableCarts()->count();
    }

    public function mount()
    {
        $orderSummaries = OrderSummary::where('user_id', Auth::id())->pluck('cart_id')->filter();

        $this->cart_ids = $orderSummaries;
    }

    public function render()
    {
        return view('livewire.normal-view.carts.index', $this->carts());
    }
}
