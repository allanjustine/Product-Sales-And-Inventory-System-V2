<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class DownloadPdf extends Component
{
    public $grandTotal;

    public function downloadPdf()
    {
        $orders = Order::where('order_status', 'Paid')->get();

        return compact('orders');
    }
    public function mount()
    {
        $this->grandTotal = Order::whereNotIn('order_status', ['Pending'])
            ->whereNotIn('order_status', ['Complete'])
            ->whereNotIn('order_status', ['To Deliver'])
            ->whereNotIn('order_status', ['Delivered'])
            ->whereNotIn('order_status', ['Processing Order'])
            ->whereNotIn('order_status', ['Cancelled'])
            ->sum('order_total_amount');
    }
    public function render()
    {
        return view('livewire.admin.orders.download-pdf', $this->downloadPdf());
    }
}
