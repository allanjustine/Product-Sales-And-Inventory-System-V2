<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Dompdf\Dompdf;
use Livewire\Attributes\Title;

class ProductSales extends Component
{
    public $perPage = 5;
    public $search;
    public $sortBy = 'transaction_code';
    public $sortDirection = 'asc';
    public $pdf;
    public $html;
    public $date_filter = 'All';

    use WithPagination;

    #[Title('Product Sales')]

    public function downloadPdf()
    {
        $orders = Order::orderBy('created_at', 'desc')->where('order_status', 'Paid')->get();

        $grandTotal = $orders->sum('order_total_amount');

        $pdf = new Dompdf();
        $pdf->loadHtml(view('livewire.admin.orders.download-pdf', compact('orders', 'grandTotal'))->render());
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('defaultFont', 'Helvetica');
        $pdf->set_option('isRemoteEnabled', true);
        $pdf->set_option('chroot', '/');
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        $filename = 'product-sales-copy.pdf';
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public function handleSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function displaySales()
    {
        $query = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name', 'products.product_name')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->where('order_status', 'Paid')
            ->where(function ($query) {
                $query->where('transaction_code', 'like', '%' . $this->search . '%')
                    ->orWhere('order_payment_method', 'like', '%' . $this->search . '%')
                    ->orWhere('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('products.product_name', 'like', '%' . $this->search . '%')
                    ->orWhere('orders.created_at', 'like', '%' . $this->search . '%');
            });

        // $date = $this->date_filter = 'All';
        switch ($this->date_filter) {
            case 'Today':
                $query->whereDate('orders.created_at', today());
                break;
            case 'Yesterday':
                $query->whereDate('orders.created_at', now()->subDay());
                break;
            case 'This week':
                $query->whereBetween('orders.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'Last week':
                $query->whereBetween('orders.created_at', [now()->startOfWeek()->subWeek(), now()->endOfWeek()->subWeek()]);
                break;
            case 'This month':
                $query->whereMonth('orders.created_at', now()->month);
                break;
            case 'Last month':
                $query->whereMonth('orders.created_at', now()->subMonth()->month);
                break;
            case 'This year':
                $query->whereYear('orders.created_at', now()->year);
                break;
            case 'Last year':
                $query->whereYear('orders.created_at', now()->subYear()->year);
                break;
        }

        $orders = $query->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);


        $grandTotal = $query->where('order_status', 'Paid')
            ->simplePaginate($this->perPage)
            ->sum('order_total_amount');

        return compact('orders', 'grandTotal');
    }

    public function render()
    {
        return view('livewire.admin.orders.product-sales', $this->displaySales());
    }
}
