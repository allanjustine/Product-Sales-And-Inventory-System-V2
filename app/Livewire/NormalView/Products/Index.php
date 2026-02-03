<?php

namespace App\Livewire\NormalView\Products;

use App\Events\PlaceOrder;
use App\Events\UserSearchLog;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\OrderSummary;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SearchLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public $cartItemToRemove = null;
    public $cartItemToCheckOut = null;
    public $itemRemove = null;
    public $item, $updateCartItem;
    public $order_payment_method, $order_quantity = 1;
    public $user_location = "";
    public $product_sold;
    public $orderToBuy = null;
    public $orderPlaceOrder = null;
    public $order;
    public $loadMore = 20;
    public $loadMorePlus = 20;
    public $searchLogs = [];
    public $carts;
    public $cart_ids = [];
    public $select_all = false;
    public $inStockOnly = false;
    public $maxPrice = 0;
    public $minPrice = 0;

    use WithPagination;

    public function updatedSearch($value)
    {
        $this->dispatch('searchData', search: $value);
    }

    public function loadMorePage()
    {
        $this->loadMore += $this->loadMorePlus;
    }

    public function displayProducts()
    {
        $query = Product::with(['product_category', 'favorites'])->search($this->search);

        $sorted_by = request('sorted_by', '');

        if ($this->category_name != 'All') {
            $query->whereHas('product_category', function ($q) {
                $q->where('category_name', $this->category_name);
            });
        }

        if ($sorted_by === 'top_selling') {
            $query->orderBy('product_sold', 'desc');
        } else if ($sorted_by === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sorted_by === 'popularity') {
            $query->orderBy('product_votes', 'desc');
        } elseif ($this->sort === 'low_to_high') {
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

        $this->carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        $allDisplayProducts = Product::count();

        if ($this->maxPrice && $this->minPrice) {
            $query->whereBetween('product_price', [$this->minPrice, $this->maxPrice]);
        }

        $products = $query->when(
            $this->inStockOnly,
            fn($q)
            =>
            $q->where('product_stock', '>', 0)
        )
            ->latest()
            ->paginate($this->loadMore);

        if ($this->search) {
            $searchLog = SearchLog::where('log_entry', $this->search)->first();

            if (!$searchLog) {
                $log_entry = $this->search;
                // event(new UserSearchLog($log_entry));
                UserSearchLog::dispatch($log_entry);
            }
        }


        $this->searchLogs = SearchLog::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(5)->get();

        return compact('products', 'allDisplayProducts');
    }

    public function searchDelete($id)
    {
        SearchLog::findOrFail($id)->delete();
        $this->reset();
    }

    public function updatedQuantity($value)
    {
        $this->quantity = !$value ? 1 : ($value > 999 ? 999 : $value);
    }

    public function updatedOrderQuantity($value)
    {
        $this->order_quantity = !$value ? 1 : ($value > 999 ? 999 : $value);
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
    #[On('closeModalCart')]
    public function closedModal()
    {
        $this->productView = null;
        $this->cartItemToRemove = null;
        $this->cartItemToCheckOut = null;
        $this->itemRemove = null;
        $this->orderToBuy = null;
        $this->orderPlaceOrder = null;
        $this->user_location = "";
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
        $this->dispatch('addTocartRefresh');
        return;
    }

    public function addToCartNowItem($id)
    {

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
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
            ]);
        }

        $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Product added to cart successfully.']);
        $this->dispatch('closeModal');
        $this->dispatch('addTocartRefresh');
        return;
    }

    public function getTotal()
    {
        $cartTotal = $this->carts->whereIn('id', $this->cart_ids)->sum(function ($item) {
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
                $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Quantity updated']);
            } else {

                $cart->delete();

                $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Cart item deleted']);

                $this->dispatch('addTocartRefresh');
            }
        }

        $this->cart_ids = [];

        $this->select_all = false;

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

    public function remove($itemId)
    {
        $this->cartItemToRemove = Cart::find($itemId);

        $this->itemRemove = $itemId;
    }

    public function removeItemToCart()
    {
        $product = Cart::where('id', $this->itemRemove)->first();

        $product->delete();

        $this->cart_ids = [];

        $this->select_all = false;

        $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Removed from cart successfully']);

        $this->dispatch('addTocartRefresh');

        $this->reset();

        return;
    }


    public function checkOut($itemId)
    {
        $this->cartItemToCheckOut = Cart::find($itemId);
        $this->user_location = $this->cartItemToCheckOut->user->user_location;
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

    public function mount()
    {
        $orderSummaries = OrderSummary::where('user_id', Auth::id())
            ->pluck('cart_id')
            ->filter()
            ->toArray();

        $this->cart_ids = $orderSummaries;
    }

    public function placeOrder()
    {
        $carts = Cart::where('user_id', Auth::id())
            ->whereIn('id', $this->cart_ids)
            ->get();

        DB::transaction(function () use ($carts) {
            Auth::user()->orderSummaries()->delete();

            foreach ($carts as $cart) {
                $productQuantity = $cart->product->product_stock;
                $productStatus = $cart->product->product_status;

                if ($productStatus == 'Not Available') {
                    // alert()->error('Sorry', 'The product is Not Available');

                    // return $this->redirect('/products', navigate: true);

                    $this->dispatch('toastr', data: ['type' => 'error', 'message' => 'The product is Not Available. Please remove it from your cart or uncheck it.']);
                    return;
                }

                if ($cart->product->product_stock == 0) {
                    // alert()->error('Sorry', 'The product is out of stock');

                    // return $this->redirect('/products', navigate: true);
                    $this->dispatch('toastr', data: ['type' => 'warning', 'message' => 'The product is out of stock. Please remove it from your cart or uncheck it.']);
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
                        'product_id'     => $cart->product->id,
                        'order_quantity' => $cart->quantity,
                        'cart_id'        => $cart->id
                    ]);
                }
            }

            $this->dispatch('closeModalCart');
            $this->dispatch('addTocartRefresh');

            return $this->redirect('/order-summaries', navigate: true);
        });
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
            'order_quantity'        =>      ['required', 'numeric', 'min:1', "max:{$product->product_stock}"],
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

    #[On('resetInputs')]
    public function resetInputs()
    {
        $this->order_payment_method = '';
        $this->user_location = '';

        $this->resetValidation();
    }

    private function availableCarts()
    {
        return Cart::where('user_id', Auth::id())
            ->whereHas(
                'product',
                fn($item)
                =>
                $item->where('product_status', 'Available')
                    ->whereColumn('product_stock', '>=', 'quantity')
            );
    }

    public function updatedSelectAll($value)
    {

        $value ? $this->cart_ids = $this->availableCarts()->pluck('id')->filter()->toArray() : $this->cart_ids = [];
    }

    public function updatedCartIds()
    {
        $this->select_all = count($this->cart_ids) === $this->availableCarts()->count();
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
