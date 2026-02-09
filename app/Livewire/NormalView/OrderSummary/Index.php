<?php

namespace App\Livewire\NormalView\OrderSummary;

use App\Events\PlaceOrder;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderSummary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Title('Order Summary')]

    public $purchase_completed = false;
    public $shipping_address = '';
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
        try {
            $orderSummaries = OrderSummary::with('productSize', 'productColor')
                ->where('user_id', Auth::id())
                ->get();

            if ($orderSummaries->isEmpty()) {
                return $this->redirect('/products', navigate: true);
            }

            $adminId = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->pluck('id')->first();

            if (!Auth::user()->user_location) {
                return $this->dispatch('toastr', data: ['type' => 'error', 'message' => 'Please set your shipping address first']);
            }

            DB::transaction(function () use ($orderSummaries, $adminId) {
                foreach ($orderSummaries as $orderSummary) {

                    $productQuantity = $orderSummary->product->productStocks();
                    $productStatus = $orderSummary->product->product_status;

                    if ($productStatus == 'Not Available') {
                        throw new \Exception('The product is Not Available.');
                    }

                    if ($orderSummary->product->productStocks() < $orderSummary->order_quantity) {
                        throw new \Exception('The product is not enough stock or out of stock.');
                    }

                    if ($orderSummary->hasVariation()) {
                        if ($orderSummary->productSize?->stock < $orderSummary->order_quantity) {
                            throw new \Exception('The selected size is not enough stock or out of stock. Please reduce your order quantity or replace it.');
                        }

                        if ($orderSummary->productColor?->stock < $orderSummary->order_quantity) {
                            throw new \Exception('The selected color is not enough stock or out of stock. Please reduce your order quantity or replace it.');
                        }
                    } else {
                        if ($orderSummary->product?->product_stock < $orderSummary->order_quantity) {
                            throw new \Exception('The product stock not enough stock or out of stock. Please reduce your order quantity or replace it.');
                        }
                    }

                    if ($orderSummary->order_quantity > $productQuantity) {
                        throw new \Exception('The product stock is insufficient please reduce your order quantity or replace it.');
                    }

                    $existingOrder = Order::where([
                        ['user_id', auth()->id()],
                        ['product_id', $orderSummary->product->id],
                        ['order_status', 'Pending'],
                        ['shipping_address', Auth::user()->user_location],
                        ['product_size_id', $orderSummary->product_size_id],
                        ['product_color_id', $orderSummary->product_color_id],
                    ])->first();

                    if ($existingOrder) {
                        $existingOrder->update([
                            'order_quantity'     => $existingOrder->order_quantity + $orderSummary->order_quantity,
                            'order_total_amount' => $existingOrder->order_total_amount + ($orderSummary->order_quantity * $orderSummary->product->product_price),
                            'created_at'         => now()
                        ]);
                    } else {
                        $transactionCode = 'AJM-' . Str::random(10);

                        Order::create([
                            "user_id"              => auth()->id(),
                            "product_id"           => $orderSummary->product->id,
                            "order_quantity"       => $orderSummary->order_quantity,
                            "order_price"          => $orderSummary->product->product_price,
                            "order_total_amount"   => $orderSummary->order_quantity * $orderSummary->product->product_price,
                            "order_payment_method" => "Cash On Delivery",
                            "order_status"         => 'Pending',
                            "transaction_code"     => $transactionCode,
                            "shipping_address"     => Auth::user()->user_location,
                            'product_size_id'      => $orderSummary->product_size_id,
                            'product_color_id'     => $orderSummary->product_color_id,
                        ]);
                    }

                    if ($orderSummary->hasVariation()) {
                        if ($orderSummary->productSize) {
                            $orderSummary->productSize->update([
                                'stock' => $orderSummary->productSize->stock - $orderSummary->order_quantity
                            ]);
                        }

                        if ($orderSummary->productColor) {
                            $orderSummary->productColor->update([
                                'stock' => $orderSummary->productColor->stock - $orderSummary->order_quantity
                            ]);
                        }
                    } else {
                        $orderSummary->product->update([
                            'product_stock' => $orderSummary->product->product_stock - $orderSummary->order_quantity,
                        ]);
                    }
                }


                $carts = $orderSummary?->pluck('cart_id')->filter()->toArray();

                $date = now();

                $this->order_date = $date->format('F j, Y');

                $this->estimated_delivery_date = (clone $date)->addDays(2)->format('M d') . '-' . (clone $date)->addDays(7)->format('M d, Y');

                PlaceOrder::dispatch($adminId);

                Cart::whereIn('id', $carts)->delete();

                $this->total_amount = $orderSummaries->map(function ($orderSummary) {
                    return [
                        "total_amount" => $orderSummary->order_quantity * $orderSummary->product->product_price

                    ];
                })
                    ->values()
                    ->sum('total_amount');

                $orderSummaries->each->delete();

                $this->purchase_completed = true;

                $this->dispatch('success-placed-order');

                return;
            });
        } catch (\Throwable $e) {
            $this->dispatch('toastr', data: [
                'type' => 'error',
                'message' => $e->getMessage()
            ]);

            return;
        }
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
