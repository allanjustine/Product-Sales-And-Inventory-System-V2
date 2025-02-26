<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class DownloadPdf extends Component
{
    public function render()
    {
        return view('livewire.admin.orders.download-pdf');
    }
}
