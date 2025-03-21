<?php

namespace App\Livewire\NormalView\Products;

use App\Events\UserSearchLog;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SearchLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    #[Title("Products")]

    protected $paginationTheme = 'bootstrap';

    public $search;
    // public $perPage = 15;
    public $category_name = 'All';
    public $sort = 'low_to_high';
    public $product_rating = 'All';
    public $productView = null;
    public $productToBeCart;
    public $selectedProductID, $productId, $product_name, $product_price;
    public $quantity = 1;
    public $product;
    public $cartItems;
    public $cartItemToRemove;
    public $cartItemToCheckOut;
    public $itemRemove;
    public $itemPlaceOrder;
    public $item, $updateCartItem;
    public $order_payment_method, $order_quantity = 1;
    public $user_location;
    public $product_sold;
    public $orderToBuy;
    public $orderPlaceOrder;
    public $order;
    public $loadMore = 20;
    public $loadMorePlus = 20;
    public $searchLogs = [];

    use WithPagination;

    public function updatedSearch($value) {
        $this->dispatch('searchData', search: $value);
    }

    public function loadMorePage()
    {
        $this->loadMore += $this->loadMorePlus;
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

        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $allDisplayProducts = Product::count();

        $products = $query->take($this->loadMore)->latest()->get();

        if ($this->search) {
            $searchLog = SearchLog::where('log_entry', $this->search)->first();

            if (!$searchLog) {
                $log_entry = $this->search;
                event(new UserSearchLog($log_entry));
            }
        }


        $this->searchLogs = SearchLog::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(5)->get();

        return compact('products', 'carts', 'allDisplayProducts');
    }

    public function searchDelete($id)
    {
        SearchLog::findOrFail($id)->delete();
        $this->reset();
    }


    public function clearAllLogs()
    {
        SearchLog::where('user_id', auth()->user()->id)->delete();
        $this->reset();
    }

    // public function notAvailable()
    // {
    //     $this->dispatch('error', ['message' => 'This product is not available.']);
    // }

    // public function outOfStock()
    // {
    //     $this->dispatch('error', ['message' => 'This product is out of stock.']);
    // }

    public function addToFavorite($id)
    {
        $productFav = Product::findOrFail($id);

        $added = Favorite::where(['user_id' => auth()->user()->id, 'product_id' => $productFav->id, 'status' => true])->first();

        if ($added) {
            $added->delete();
            $this->dispatch('toastr', data: [
                'type'          =>          'success',
                'message'       =>          'Removed from favorites'
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

    public function searchLog($id)
    {
        $search_log = SearchLog::findOrFail($id);

        $this->search = $search_log->log_entry;
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

        $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Product added to cart successfully.']);
        $this->dispatch('closeModal');
        // $this->reset();

        // alert()->success('Success', 'Product added to cart successfully.');

        // return $this->redirect('/products', navigate: true);
        return;
    }

    public function getTotal()
    {
        $cartTotal = Cart::query()
            ->with('product')
            ->where('user_id', Auth::id())
            ->get()
            ->sum(function ($item) {
                return $item->product->product_price * $item->quantity;
            });

        return $cartTotal;
    }

    public function increaseQuantity($cartItemId)
    {

        $this->validate([
            'quantity'          =>          'required|integer|min:1'
        ]);

        $cart = Cart::find($cartItemId);

        if ($cart && $cart->user_id === auth()->id()) {
            $cart->update([
                'quantity' => $cart->quantity + $this->quantity,
            ]);
        }
        $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Quantity updated']);
        // alert()->toast('Updated cart quantity successfully', 'success');

        // return $this->redirect('/products', navigate: true);
        return;
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
                // return $this->redirect('/products', navigate: true);
                $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Quantity updated']);
                return;
            } else {
                $cart->delete();

                $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Cart item deleted']);
                return;
            }
        }
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

        alert()->toast('Removed from cart successfully', 'success');

        return $this->redirect('/products', navigate: true);
    }


    public function checkOut($itemId)
    {
        $this->cartItemToCheckOut = Cart::find($itemId);
        $this->user_location = $this->cartItemToCheckOut->user->user_location;
        $this->itemPlaceOrder = $itemId;
    }

    // public function checkOutAll()
    // {
    //     $allCart = Cart::all();

    //     foreach ($allCart as $all) {
    //         $transactionCode = 'AJM-' . Str::random(10);
    //         $product = Order::create([
    //             'user_id' => auth()->id(),
    //             'product_id' => $all->product->id,
    //             'order_quantity' => $all->quantity,
    //             'order_price' => $all->product->product_price,
    //             'order_total_amount' => $all->quantity * $all->product->product_price,
    //             'order_payment_method' => 'Cash on delivery',
    //             'order_status' => 'Pending',
    //             'transaction_code' => $transactionCode,
    //         ]);
    //         $all->user->update([
    //             'user_location' => $this->user_location
    //         ]);

    //         $product->save();
    //         $all->delete();
    //     }
    // }

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
                $this->dispatch('alert', alerts: [
                    'type'          =>          'success',
                    'title'         =>          'Ordered',
                    'message'       =>          'The product is added/changed to your existing order.' . '<br><br><a class="btn btn-primary" wire:navigate href="/orders">Go to Orders</a>'
                ]);
                $this->dispatch('closeModal');
                return;
            } else {
                $this->dispatch('alert', alerts: [
                    'type'          =>          'success',
                    'title'         =>          'Ordered',
                    'message'       =>          'The product ordered successfully. Your transaction code is "' . $order->transaction_code . '"' . '<br><br><a class="btn btn-primary" wire:navigate href="/orders">Go to Orders</a>'
                ]);
                $this->dispatch('closeModal');
                return;
            }
        } else {

            if ($productStatus == 'Not Available') {
                // alert()->error('Sorry', 'The product is Not Available');

                // return $this->redirect('/products', navigate: true);

                $this->dispatch('toastr', data: ['type' => 'error', 'message' => 'The product is Not Available']);
                return;
            } elseif ($product->product_stock == 0) {
                // alert()->error('Sorry', 'The product is out of stock');

                // return $this->redirect('/products', navigate: true);
                $this->dispatch('toastr', data: ['type' => 'warning', 'message' => 'The product is out of stock']);
                return;
            } else {
                // alert()->error('Sorry', 'The product stock is insufficient please reduce your cart quantity');

                // return $this->redirect('/products', navigate: true);
                $this->dispatch('toastr', data: ['type' => 'info', 'message' => 'The product stock is insufficient please reduce your cart quantity']);
                return;
            }
        }
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
            'order_payment_method'  =>      'required',
            'user_location'         =>      'required|max:255',
            'order_quantity'        =>      ['required', 'numeric', 'min:1'],
        ]);

        $productQuantity = $product->product_stock;
        $productStatus = $product->product_status;

        if ($productStatus == 'Available' && $productQuantity >= $this->order_quantity) {
            $existingOrder = Order::where([
                ['user_id', auth()->id()],
                ['product_id', $product->id],
                ['order_status', 'Pending']
            ])->first();

            if ($existingOrder) {
                $user = User::where('id', auth()->user()->id);

                $user->update([
                    'user_location' => $this->user_location
                ]);
                $existingOrder->created_at = now();
                $existingOrder->order_quantity += $this->order_quantity;
                $existingOrder->order_total_amount += ($this->order_quantity * $product->product_price);
                $existingOrder->save();
            } else {
                $transactionCode = 'AJM-' . Str::random(10);

                $order = new Order();
                $order->user_id = auth()->id();
                $order->product_id = $product->id;
                $order->order_quantity = $this->order_quantity;
                $order->order_price = $product->product_price;
                $order->order_total_amount = $this->order_quantity * $product->product_price;
                $order->order_payment_method = $this->order_payment_method;
                $order->order_status = 'Pending';
                $order->transaction_code = $transactionCode;
                $order->save();

                $user = User::where('id', auth()->user()->id);

                $user->update([
                    'user_location' => $this->user_location
                ]);
            }

            $product->product_stock -= $this->order_quantity;
            $product->product_sold += $this->order_quantity;
            $product->save();


            if ($existingOrder) {
                $this->dispatch('alert', alerts: [
                    'type'          =>          'success',
                    'title'         =>          'Ordered',
                    'message'       =>          'The product is added/changed to your existing order.' . '<br><br><a class="btn btn-primary" wire:navigate href="/orders">Go to Orders</a>'
                ]);
                $this->dispatch('closeModal');
                return;
            } else {
                $this->dispatch('alert', alerts: [
                    'type'          =>          'success',
                    'title'         =>          'Ordered',
                    'message'       =>          'The product ordered successfully. Your transaction code is "' . $order->transaction_code . '"' . '<br><br><a class="btn btn-primary" wire:navigate href="/orders">Go to Orders</a>'
                ]);
                $this->dispatch('closeModal');
                return;
            }
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

    public function clearFilters()
    {
        $this->search = '';
        // $this->perPage = 15;
        $this->category_name = 'All';
        $this->sort = 'low_to_high';
        $this->product_rating = 'All';
        $this->resetPage();
    }

    #[On('resetInputs')]
    public function resetInputs()
    {
        $this->order_payment_method = '';
        $this->user_location = '';

        $this->resetValidation();
    }

    public function render()
    {
        $product_categories = ProductCategory::all();

        return view(
            'livewire.normal-view.products.index',
            $this->displayProducts(),
            [
                'product_categories' => $product_categories,
                'cartItems' => $this->cartItems,
                'total' => $this->getTotal(),
            ]
        );
    }
}
