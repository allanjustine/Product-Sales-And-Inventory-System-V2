<?php

namespace App\Livewire\NormalView\OrderSummary;

use App\Events\PlaceOrder;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderSummary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Title('Order Summary')]

    public $purchase_completed = false;
    public $shipping_address = '';
    public $order_transaction_codes = [];
    public $order_date = null;
    public $payment_method = 'Cash on Delivery';
    public $total_amount = 0;
    public $estimated_delivery_date = null;

    #[Computed]
    public function orderSummaries()
    {
        return OrderSummary::with('product')
            ->where('user_id', Auth::id())
            ->get();
    }

    public function mount()
    {
        $date = now();

        $this->estimated_delivery_date = (clone $date)->addDays(2)->format('M d') . '-' . (clone $date)->addDays(7)->format('M d, Y');

        if (Auth::user()->orderSummaries()->count() < 1 && !$this->purchase_completed) {
            return $this->redirect('/products', navigate: true);
        }
    }

    public function placeOrderItems()
    {
        $orderSummaries = OrderSummary::where('user_id', Auth::id())
            ->get();

        $carts = $orderSummaries->pluck('cart_id')->filter();

        $adminId = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->pluck('id')->first();

        if (!Auth::user()->user_location) {
            return $this->dispatch('toastr', data: ['type' => 'error', 'message' => 'Please set your shipping address first']);
        }

        foreach ($orderSummaries as $orderSummary) {
            $existingOrder = Order::where([
                ['user_id', auth()->id()],
                ['product_id', $orderSummary->product->id],
                ['order_status', 'Pending'],
                ['shipping_address', Auth::user()->user_location]
            ])->first();

            if ($existingOrder) {
                $existingOrder->update([
                    'order_quantity'     => $existingOrder->order_quantity + $orderSummary->order_quantity,
                    'order_total_amount' => $existingOrder->order_total_amount + ($orderSummary->order_quantity * $orderSummary->product->product_price),
                    'created_at'         => now()
                ]);

                $this->order_transaction_codes[] = $existingOrder->transaction_code;
                $this->total_amount += $orderSummary->order_quantity * $orderSummary->product->product_price;
            } else {
                $transactionCode = 'AJM-' . Str::random(10);

                $order = Order::create([
                    "user_id"              => auth()->id(),
                    "product_id"           => $orderSummary->product->id,
                    "order_quantity"       => $orderSummary->order_quantity,
                    "order_price"          => $orderSummary->product->product_price,
                    "order_total_amount"   => $orderSummary->order_quantity * $orderSummary->product->product_price,
                    "order_payment_method" => "Cash On Delivery",
                    "order_status"         => 'Pending',
                    "transaction_code"     => $transactionCode,
                    "shipping_address"     => Auth::user()->user_location
                ]);

                $this->order_transaction_codes[] = $order->transaction_code;
                $this->total_amount += $order->order_total_amount;
            }
            $orderSummary->product->update([
                'product_stock' => $orderSummary->product->product_stock - $orderSummary->order_quantity,
                'product_sold'  => $orderSummary->product->product_sold + $orderSummary->order_quantity
            ]);
        }

        $date = now();

        $this->order_date = $date->format('F j, Y');

        $this->estimated_delivery_date = (clone $date)->addDays(2)->format('M d') . '-' . (clone $date)->addDays(7)->format('M d, Y');

        PlaceOrder::dispatch($adminId);

        Cart::whereIn('id', $carts)->delete();

        $orderSummaries->each->delete();

        $this->purchase_completed = true;

        $this->dispatch('success-placed-order');

        return;
    }

    public function cancelOrderItems()
    {
        OrderSummary::where('user_id', Auth::id())->delete();

        return $this->redirect('/products', navigate: true);
    }

    public function addShippingAddress()
    {
        Auth::user()->update([
            'user_location' => $this->shipping_address
        ]);

        $this->dispatch('toastr', data: ['type' => 'success', 'message' => 'Shipping address updated successfully']);
        $this->dispatch('closeModal');

        return;
    }

    public function render()
    {
        return view('livewire.normal-view.order-summary.index');
    }
}
