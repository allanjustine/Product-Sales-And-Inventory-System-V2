<?php

namespace App\Livewire\NormalView\Orders;

use App\Models\Order;
use Livewire\Component;

class RecentOrders extends Component
{

    public $orders;
    public $grandTotal;

    public function mount()
    {
        $this->orders = Order::where('user_id', auth()->id())->with('product')->get();
        $this->orders = Order::where('order_status', 'Paid')->where('user_id', auth()->id())->get();
        $this->grandTotal = Order::where('user_id', auth()->id())
            ->whereNotIn('order_status', ['Pending'])
            ->sum('order_total_amount');
    }

    public function render()
    {
        return view('livewire.normal-view.orders.recent-orders');
    }
}
