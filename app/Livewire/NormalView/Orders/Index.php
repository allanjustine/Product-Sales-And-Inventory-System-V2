<?php

namespace App\Livewire\NormalView\Orders;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{

    public $recents;
    public $pendings;
    public $grandTotalPending;
    public $grandTotalRecent;
    public $grandTotalCancelled;
    public $cancel;
    public $cancels;
    public $toRemoved;
    public $removedOrder;
    public $receive;
    public $received;
    public $cancelled;
    public $product_rating;
    public $product;
    public $orders;
    public $order_quantity;
    public $user_rating;

    protected $listeners = ['resetInputs'];

    public function mount()
    {

        $userId = auth()->id();

        $this->pendings = Order::orderBy('created_at', 'desc')->where(function ($query) use ($userId) {
            $query->where('order_status', 'To Deliver')
                ->orWhere('order_status', 'Processing Order')
                ->orWhere('order_status', 'Pending')
                ->orWhere('order_status', 'Delivered');
        })
            ->where('user_id', $userId)
            ->get();
        $this->grandTotalPending = Order::where('user_id', auth()->id())
            ->whereNotIn('order_status', ['Paid'])
            ->whereNotIn('order_status', ['Complete'])
            ->whereNotIn('order_status', ['Cancelled'])
            ->sum('order_total_amount');

        $this->recents = Order::orderBy('created_at', 'desc')->where(function ($query) use ($userId) {
            $query->where('order_status', 'Paid')
                ->orWhere('order_status', 'Complete');
        })
            ->where('user_id', $userId)
            ->get();

        $this->grandTotalRecent = Order::where('user_id', auth()->id())
            ->whereNotIn('order_status', ['Pending'])
            ->whereNotIn('order_status', ['Processing Order'])
            ->whereNotIn('order_status', ['To Deliver'])
            ->whereNotIn('order_status', ['Delivered'])
            ->whereNotIn('order_status', ['Cancelled'])
            ->sum('order_total_amount');

        $this->cancels = Order::orderBy('created_at', 'desc')->where('order_status', 'Cancelled')
            ->where('user_id', auth()->id())
            ->get();

        $this->grandTotalCancelled = Order::where('user_id', auth()->id())
            ->whereNotIn('order_status', ['Pending'])
            ->whereNotIn('order_status', ['Processing Order'])
            ->whereNotIn('order_status', ['To Deliver'])
            ->whereNotIn('order_status', ['Delivered'])
            ->whereNotIn('order_status', ['Complete'])
            ->whereNotIn('order_status', ['Paid'])
            ->sum('order_total_amount');
    }

    // public function toRemove($orderId)
    // {
    //     $this->toRemoved = Order::find($orderId);

    //     $this->removedOrder = $orderId;
    // }

    // public function removeOrder()
    // {
    //     $order = Order::where('id', $this->removedOrder)->first();

    //     $order->delete();

    //     alert()->info('Removed', 'The order has been removed successfully');

    //     return redirect('/orders');
    // }

    public function toCancel($orderId)
    {
        $this->cancel = Order::find($orderId);

        $this->cancelled = $orderId;
    }

    public function cancelOrder()
    {
        $order = Order::where('id', $this->cancelled)->first();

        if ($order->order_status == 'Pending') {
            $product = Product::find($order->product_id);

            $order->order_status = 'Cancelled';
            $order->save();

            $product->product_stock += $order->order_quantity;
            $product->product_sold -= $order->order_quantity;
            $product->save();

            alert()->info('Cancelled', 'The order has been cancelled successfully');

            return redirect('/orders');
        } elseif ($order->order_status == 'To Deliver') {

            alert()->error('Sorry', 'The order you are trying to cancel is on going to deliver');
            return redirect('/orders');
        } elseif ($order->order_status == 'Delivered') {

            alert()->error('Sorry', 'The order you are trying to cancel is already delivered');
            return redirect('/orders');
        } elseif ($order->order_status == 'Complete') {

            alert()->error('Sorry', 'The order you are trying to cancel is already complete');
            return redirect('/orders');
        } else {
            alert()->error('Sorry', 'The order you are trying to cancel does not exist');

            return redirect('/orders');
        }
    }

    public function toReceived($orderId)
    {
        $this->receive = Order::find($orderId);

        $this->received = $orderId;
    }

    public function rePurchaseOrder($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            alert()->error('Sorry', 'The order does not exist');
            return redirect('/orders');
        }

        $product = Product::find($order->product_id);

        if (!$product) {
            alert()->error('Sorry', 'The product you trying to re-pruchase is does not exist');
            return redirect('/orders');
        }

        if ($product->product_status == 'Not Available') {
            alert()->error('Sorry', 'The product you trying to re-pruchase is Not Available');
            return redirect('/orders');
        }

        $availableStock = $product->product_stock;

        if ($availableStock < $order->order_quantity) {
            alert()->error('Sorry', 'The product you trying to re-pruchase is not enough stock');
            return redirect('/products');
        }

        $order->order_status = 'Pending';
        $order->created_at = now();
        $order->save();

        $product->product_stock -= $order->order_quantity;
        $product->product_sold += $order->order_quantity;
        $product->save();

        alert()->success('Congrats', 'You purchased the cancelled order again.');
        return redirect('/orders');
    }


    public function submitRating()
    {
        $received = Order::where('id', $this->received)->first();

        $product = Product::find($received->product_id);

        if ($received->order_status === 'Paid') {
            alert()->info('Sorry', 'The order was already been paid');
            return redirect('/orders');
        }

        if ($received->order_status === 'Complete') {
            alert()->warning('Sorry', 'You can submit a rating at once');
            return redirect('/orders');
        }

        if ($received->order_status === 'Cancelled') {
            alert()->warning('Sorry', 'You can`t submit a rating on cancelled orders');
            return redirect('/orders');
        }

        $this->validate([
            'product_rating'        =>          'required|numeric|min:1|max:5'
        ]);

        $product->product_rating = ($product->product_rating * $product->product_votes + $this->product_rating) / ($product->product_votes + 1);
        $product->product_votes += 1;
        $product->save();

        $received->user_rating = $this->product_rating;
        $received->order_status = 'Complete';
        $received->save();

        $newRating = $this->product_rating;
        alert()->success('Success', 'Thank you for rating us ' . $newRating . ' Star(s).');

        return redirect('/orders');
    }

    public function resetInputs()
    {
        $this->product_rating = '';

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.normal-view.orders.index');
    }
}
