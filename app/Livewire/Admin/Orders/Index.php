<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Title('Orders')]

    public $perPage = 5;
    public $search;
    public $filterStatus = 'All';
    public $sortBy = 'orders.created_at';
    public $sortDirection = 'desc';

    public function ordersStatus($id, $status, $message)
    {
        $order = Order::findOrFail($id);
        if ($order->order_status == 'Cancelled') {
            $this->dispatch('alert', alerts: [
                'title'         =>          'Sorry',
                'type'          =>          'warning',
                'message'       =>          'The order does not exist or been cancelled by the user'
            ]);
            return;
        }

        $order->update([
            'order_status'  =>   $status
        ]);

        $this->dispatch('toastr', data: [
            'type'      =>      'success',
            'message'   =>      $message
        ]);
        return;
    }

    #[On('processOrder')]
    public function processOrder($id)
    {
        $this->ordersStatus($id, 'Processing Order', 'The order is now processing.');
    }

    #[On('markAsDeliver')]
    public function markAsDeliver($id)
    {
        $this->ordersStatus($id, 'To Deliver', 'The order is on going to deliver.');
    }

    #[On('markAsDelivered')]
    public function markAsDelivered($id)
    {
        $this->ordersStatus($id, 'Delivered', 'The order is now delivered.');
    }

    #[On('markAsPaid')]
    public function markAsPaid($id)
    {
        $this->ordersStatus($id, 'Paid', 'The order is now paid.');
    }

    public function sortItemBy($field)
    {
        $this->sortBy = $field;

        if ($this->sortDirection === 'asc') {
            $this->sortDirection = 'desc';
        } else {

            $this->sortDirection = 'asc';
        }
    }

    public function orderDetails()
    {
        $orders = Order::query()
            ->select('orders.*')
            ->with(['product', 'user'])
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where(function ($query) {
                $query->where('transaction_code', 'like', '%' . $this->search . '%')
                    ->orWhere('order_status', 'like', '%' . $this->search . '%')
                    ->orWhereHas('product', function ($subQuery) {
                        $subQuery->where('product_name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('user', function ($subQuery) {
                        $subQuery->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->whereNotIn('order_status', ['Cancelled', 'Paid']);

        if ($this->filterStatus !== 'All') {
            $orders->where('order_status', $this->filterStatus);
        }

        $orders = $orders->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $grandTotal = $orders->sum('order_total_amount');

        return compact('orders', 'grandTotal');
    }

    public function render()
    {
        return view('livewire.admin.orders.index', $this->orderDetails());
    }
}
