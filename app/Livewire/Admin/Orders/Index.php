<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Title(('Orders'))]
    public function processOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->order_status == 'Cancelled') {

            alert()->warning('Sorry', 'The order does not exist or been cancelled by the user');

            return $this->redirect('/admin/orders', navigate: true);
        }

        $order->update([
            'order_status' => 'Processing Order'
        ]);
        // session()->flash('message', 'The order is now processing');
        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      'The order is now processing.'
        ]);
        return;

        // alert()->success('Congrats', 'The order is now processing');

        // return $this->redirect('/admin/orders', navigate: true);

    }
    public function markAsDeliver($id)
    {
        $order = Order::findOrFail($id);

        if ($order->order_status == 'Cancelled') {

            $this->alert()->warning('Sorry', 'The order does not exist or been cancelled by the user');

            return $this->redirect('/admin/orders', navigate: true);
        }

        $order->update([
            'order_status' => 'To Deliver'
        ]);
        // session()->flash('message', 'The order is on going to deliver');

        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      'The order is on going to deliver.'
        ]);
        // alert()->success('Congrats', 'The order is on going to deliver');

        // return $this->redirect('/admin/orders', navigate: true);
        return;
    }

    public function markAsDelivered($id)
    {
        $order = Order::findOrFail($id);

        if ($order->order_status == 'Cancelled') {

            alert()->warning('Sorry', 'The order does not exist or been cancelled by the user');

            return $this->redirect('/admin/orders', navigate: true);
        }

        $order->update([
            'order_status' => 'Delivered'
        ]);
        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      'The order is now delivered.'
        ]);
        // session()->flash('message', 'The order is now delivered');
        // alert()->success('Congrats', 'The order is now delivered');

        // return $this->redirect('/admin/orders', navigate: true);
        return;
    }


    public function markAsPaid($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'order_status' => 'Paid'
        ]);
        // session()->flash('message', 'The order is now paid');
        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      'The order is now paid'
        ]);
        // alert()->success('Congrats', 'The order is now paid');

        // return $this->redirect('/admin/orders', navigate: true);
        return;
    }
    public function orderDetails()
    {
        $grandTotal = Order::whereNotIn('order_status', ['Paid'])
            ->whereNotIn('order_status', ['Cancelled'])
            ->sum('order_total_amount');

        $orders = Order::orderBy('created_at', 'desc')->where('order_status', 'Pending')
            ->orWhere('order_status', 'Processing Order')
            ->orWhere('order_status', 'To Deliver')
            ->orWhere('order_status', 'Delivered')
            ->orWhere('order_status', 'Complete')
            ->get();

        return compact('orders', 'grandTotal');
    }

    public function render()
    {
        return view('livewire.admin.orders.index', $this->orderDetails());
    }
}
