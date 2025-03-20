<?php

namespace App\Livewire\NormalView\Orders;

use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Title('My Orders')]
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

    #[On('isRefresh')]
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

    //     return $this->redirect('/orders', navigate: true);
    // }

    public function toCancel($orderId)
    {
        $this->cancel = Order::find($orderId);

        $this->cancelled = $orderId;
    }

    public function cancelOrder()
    {
        $order = Order::where('id', $this->cancelled)->first();

        $data = [
            'title',
            'type',
            'message'
        ];

        switch ($order->order_status) {
            case 'Pending':
                $product = Product::find($order->product_id);

                $order->order_status = 'Cancelled';
                $order->save();

                $product->product_stock += $order->order_quantity;
                $product->product_sold -= $order->order_quantity;
                $product->save();

                $data['title'] = 'Cancelled';
                $data['type'] = 'success';
                $data['message'] = 'The order has been cancelled successfully';

                break;

            case 'To Deliver':
                $data['title'] = 'Sorry';
                $data['type'] = 'error';
                $data['message'] = 'The order you are trying to cancel is on going to deliver';

                break;

            case 'Delivered':
                $data['title'] = 'Sorry';
                $data['type'] = 'error';
                $data['message'] = 'The order you are trying to cancel is already delivered';

                break;

            case 'Complete':
                $data['title'] = 'Sorry';
                $data['type'] = 'error';
                $data['message'] = 'The order you are trying to cancel is already complete';

                break;

            default:
                $data['title'] = 'Sorry';
                $data['type'] = 'error';
                $data['message'] = 'The order you are trying to cancel does not exist';

                break;
        }

        $this->dispatch('alert', alerts: [
            'title'         =>          $data['title'],
            'type'          =>          $data['type'],
            'message'       =>          $data['message']
        ]);

        $this->dispatch('closeModal');

        $this->dispatch('isRefresh');

        return;
    }

    public function toReceived($orderId)
    {
        $this->receive = Order::find($orderId);

        $this->received = $orderId;
    }


    #[On('handleClick')]
    public function rePurchaseOrder($orderId)
    {
        $order = Order::find($orderId);

        $data = [
            'title',
            'type',
            'message'
        ];

        if (!$order) {
            $data['title'] = 'Sorry';
            $data['type'] = 'error';
            $data['message'] = 'The order you are trying to re-pruchase does not exist';
        }

        $product = Product::find($order->product_id);

        if (!$product) {
            $data['title'] = 'Sorry';
            $data['type'] = 'error';
            $data['message'] = 'The product you are trying to re-pruchase does not exist';
        }

        if ($product->product_status == 'Not Available') {
            $data['title'] = 'Sorry';
            $data['type'] = 'error';
            $data['message'] = 'The product you are trying to re-pruchase is Not Available';
        }

        $availableStock = $product->product_stock;

        if ($availableStock < $order->order_quantity) {
            $data['title'] = 'Sorry';
            $data['type'] = 'error';
            $data['message'] = 'The product you are trying to re-pruchase is out of stock';
        }

        $order->order_status = 'Pending';
        $order->created_at = now();
        $order->save();

        $product->product_stock -= $order->order_quantity;
        $product->product_sold += $order->order_quantity;
        $product->save();

        $data['title'] = 'Congrats';
        $data['type'] = 'success';
        $data['message'] = 'You re-purchased your cancelled order successfully.';

        $this->dispatch('alert', alerts: [
            'title'         =>          $data['title'],
            'type'          =>          $data['type'],
            'message'       =>          $data['message']
        ]);

        $this->dispatch('isRefresh');
        return;
    }


    public function submitRating()
    {
        $received = Order::where('id', $this->received)->first();

        $product = Product::find($received->product_id);

        if ($received->order_status === 'Paid') {
            $this->dispatch('alert', alerts: [
                'title'         =>          'Sorry',
                'type'          =>          'info',
                'message'       =>          "The order was already been paid"
            ]);
            $this->dispatch('closeModal');
            return;
        }

        if ($received->order_status === 'Complete') {
            $this->dispatch('alert', alerts: [
                'title'         =>          'Sorry',
                'type'          =>          'warning',
                'message'       =>          "You can submit a rating at once"
            ]);
            $this->dispatch('closeModal');
            return;
        }

        if ($received->order_status === 'Cancelled') {
            $this->dispatch('alert', alerts: [
                'title'         =>          'Sorry',
                'type'          =>          'warning',
                'message'       =>          "You can`t submit a rating on cancelled orders"
            ]);
            $this->dispatch('closeModal');
            return;
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
        $this->dispatch('alert', alerts: [
            'title'         =>          'Rating Submitted',
            'type'          =>          'success',
            'message'       =>          "Thank you for rating us \"{$newRating}\" Star(s)."
        ]);
        $this->dispatch('closeModal');
        $this->dispatch('isRefresh');
        return;
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
