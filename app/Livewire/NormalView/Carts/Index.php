<?php

namespace App\Livewire\NormalView\Carts;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public $cartItemToRemove;
    public $cartItemToCheckOut;
    public $user_location;
    public $itemPlaceOrder;
    public $itemRemove;
    public $order_payment_method;

    public function carts()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        return compact('cartItems');
    }

    public function updateCartItem($itemId)
    {

        $cart = Cart::find($itemId);

        if ($cart && $cart->user_id === auth()->id()) {
            $cart->update([
                'quantity' => $cart->quantity + 1,
            ]);
        }
        $this->dispatch('success', ['message' => 'Quantity updated']);
        // alert()->toast('Updated cart quantity successfully', 'success');

        // return redirect('/products');
    }

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
                // return redirect('/products');
                $this->dispatch('success', ['message' => 'Quantity updated']);
            } else {
                $cart->delete();

                $this->dispatch('success', ['message' => 'Cart item deleted']);

                $this->reset();
            }
        }
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

        $this->dispatch('success', ['message' => 'Removed from cart successfully']);

        $this->reset();
    }

    public function placeOrder()
    {
        $cartItem = Cart::find($this->itemPlaceOrder);

        $this->validate([
            'order_payment_method'  =>      'required',
            'user_location'         =>      'required|max:255',
        ]);

        $product = $cartItem->product;
        $productQuantity = $product->product_stock;
        $productStatus = $product->product_status;

        if ($cartItem->quantity <= $productQuantity && $productStatus == 'Available') {
            $existingOrder = Order::where([
                ['user_id', auth()->id()],
                ['product_id', $product->id],
                ['order_status', 'Pending']
            ])->first();

            if ($existingOrder) {
                // $existingOrder->user_location = $this->user_location;
                $cartItem->user->update([
                    'user_location' => $this->user_location
                ]);
                $existingOrder->created_at = now();
                $existingOrder->order_quantity += $cartItem->quantity;
                $existingOrder->order_total_amount += ($cartItem->quantity * $product->product_price);
                $existingOrder->save();
            } else {
                $transactionCode = 'AJM-' . Str::random(10);
                $order = new Order();
                $order->user_id = auth()->id();
                $order->product_id = $product->id;
                $order->order_quantity = $cartItem->quantity;
                // $order->user_location = $this->user_location;
                $order->order_price = $product->product_price;
                $order->order_total_amount = $cartItem->quantity * $product->product_price;
                $order->order_payment_method = $this->order_payment_method;
                $order->order_status = 'Pending';
                $order->transaction_code = $transactionCode;
                $order->save();

                $cartItem->user->update([
                    'user_location' => $this->user_location
                ]);
            }

            $product->product_stock -= $cartItem->quantity;
            $product->product_sold += $cartItem->quantity;
            $product->save();
            $cartItem->delete();

            if ($existingOrder) {
                alert()->html('Congrats', 'The product is added/changed' . '<br><br><a class="btn btn-primary" href="/orders">Go to Orders</a>', 'success');
            } else {
                alert()->html('Congrats', 'The product ordered successfully. Your transaction code is "' . $order->transaction_code . '"' . '<br><br><a class="btn btn-primary" href="/orders">Go to Orders</a>', 'success');
            }

            return redirect('/carts');
        } else {

            if ($productStatus == 'Not Available') {
                // alert()->error('Sorry', 'The product is Not Available');

                // return redirect('/products');

                $this->dispatch('error', ['message' => 'The product is Not Available']);
            } elseif ($product->product_stock == 0) {
                // alert()->error('Sorry', 'The product is out of stock');

                // return redirect('/products');
                $this->dispatch('warning', ['message' => 'The product is out of stock']);
            } else {
                // alert()->error('Sorry', 'The product stock is insufficient please reduce your cart quantity');

                // return redirect('/products');
                $this->dispatch('info', ['message' => 'The product stock is insufficient please reduce your cart quantity']);
            }
        }
    }

    public function render()
    {
        return view('livewire.normal-view.carts.index', $this->carts())->layout('pages.normal-view.layout.base');
    }
}
