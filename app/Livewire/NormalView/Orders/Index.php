<?php

namespace App\Livewire\NormalView\Orders;

use App\Events\CancelOrder;
use App\Events\RepurchaseAndSubmitRating;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

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
    public $is_anonymous;
    public $review;
    public $images = [];
    public $old_images = [];

    use WithFileUploads;

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

        $this->recents = Order::with('orderRating')->orderBy('created_at', 'desc')->where(function ($query) use ($userId) {
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
                $product = Product::with('productSizes', 'productColors')->findOrFail($order->product_id);

                $order->order_status = 'Cancelled';

                if ($order->hasVariation()) {
                    if ($order->product_size_id) {
                        $order->productSize->stock += $order->order_quantity;
                    }

                    if ($order->product_color_id) {
                        $order->productColor->stock += $order->order_quantity;
                    }
                } else {
                    $product->product_stock += $order->order_quantity;
                }

                $product->save();

                $order->save();

                $order->productSize?->save();

                $order->productColor?->save();

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

        $adminId = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->pluck('id')->first();

        // event(new CancelOrder($order, $adminId));
        CancelOrder::dispatch($order, $adminId);

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

        try {
            DB::transaction(function () use ($order) {
                $data = [
                    'title',
                    'type',
                    'message'
                ];

                if (!$order) {
                    throw new \Exception('The order you are trying to re-pruchase does not exist');
                }

                $product = Product::with('productSizes', 'productColors')->find($order->product_id);

                if (!$product) {
                    throw new \Exception('The product you are trying to re-pruchase does not exist');
                }

                if ($product->product_status == 'Not Available') {
                    throw new \Exception('The product you are trying to re-pruchase is Not Available');
                }

                $availableStock = $product->productStocks();
                $availableProductStock = $order->product->product_stock;
                $availableProductSizeStock = $order->productSize->stock;
                $availableProductColorStock = $order->productColor->stock;

                if ($availableStock < $order->order_quantity) {
                    throw new \Exception('The product you are trying to re-pruchase is out of stock');
                }

                if ($availableProductSizeStock < $order->order_quantity) {
                    throw new \Exception('The product you are trying to re-pruchase is not enough size stock or out of stock');
                }

                if ($availableProductColorStock < $order->order_quantity) {
                    throw new \Exception('The product you are trying to re-pruchase is not enough color stock or out of stock');
                }

                if ($availableProductStock < $order->order_quantity) {
                    throw new \Exception('The product you are trying to re-pruchase is not enough stock or out of stock');
                }

                $order->order_status = 'Pending';
                $order->created_at = now();

                if ($order->hasVariation()) {
                    if ($order->product_size_id) {
                        $order->productSize->stock -= $order->order_quantity;
                    }

                    if ($order->product_color_id) {
                        $order->productColor->stock -= $order->order_quantity;
                    }
                } else {
                    $product->product_stock -= $order->order_quantity;
                }

                $product->save();

                $order->save();

                $order->productSize?->save();

                $order->productColor?->save();

                $data['title'] = 'Congrats';
                $data['type'] = 'success';
                $data['message'] = 'You re-purchased your cancelled order successfully.';

                $this->dispatch('alert', alerts: [
                    'title'         =>          $data['title'],
                    'type'          =>          $data['type'],
                    'message'       =>          $data['message']
                ]);

                $this->dispatch('isRefresh');
                $adminId = User::whereHas('roles', function ($query) {
                    $query->where('name', 'admin');
                })->pluck('id')->first();

                // event(new RepurchaseAndSubmitRating($order, $adminId));
                RepurchaseAndSubmitRating::dispatch($order, $adminId);
                return;
            });
        } catch (\Throwable $e) {
            $this->dispatch('alert', alerts: [
                'title'         => 'Sorry',
                'type'          => 'error',
                'message'       => $e->getMessage()
            ]);
            return;
        }
    }

    public function updatedImages()
    {
        $this->old_images = array_merge($this->images, $this->old_images);

        $this->images = [];
    }

    public function submitRating()
    {
        $received = Order::where('id', $this->received)->first();

        $product = Product::with('productRatings')->find($received->product_id);

        $this->validate([
            'product_rating'          => ['required', 'max:5', 'min:1', 'numeric'],
            'images.*'                => ['mimes:jpg,png,jpeg', 'max:2048'],
            'review'                  => ['max:1000']
        ], [
            'product_rating.required' => 'Please select a rating',
            'product_rating.max'      => 'Rating must be between 1 and 5',
            'product_rating.min'      => 'Rating must be between 1 and 5',
            'product_rating.numeric'  => 'Rating must be numbers only',
        ]);

        $data = [];

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

        if (!$this->is_anonymous) {
            $data['user_id'] = Auth::id();
        }

        if ($this->review) {
            $data['review'] = $this->review;
        }

        $data['order_id'] = $received->id;
        $data['rating'] = $this->product_rating;

        DB::transaction(function () use ($product, $received, $data) {
            $created_product_rating = $product->productRatings()->create($data);
            $imagesPaths = [];

            if (count($this->old_images) > 0) {
                foreach ($this->old_images as $image) {
                    $name = time() . '-' . $image->getClientOriginalName();
                    $imagesPaths[] = [
                        'path' => $image->storeAs('ratings/images', $name, 'public')
                    ];
                }
            }

            $created_product_rating->ratingImages()->createMany($imagesPaths);

            $received->update([
                'order_status' => 'Complete'
            ]);
        });

        $newRating = $this->product_rating;

        $this->dispatch('alert', alerts: [
            'title'         =>          'Rating Submitted',
            'type'          =>          'success',
            'message'       =>          "Thank you for rating us \"{$newRating}\" Star(s)."
        ]);
        $this->dispatch('closeModal');
        $this->dispatch('isRefresh');
        $adminId = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->pluck('id')->first();

        // event(new RepurchaseAndSubmitRating($received, $adminId));
        RepurchaseAndSubmitRating::dispatch($received, $adminId);
        return;
    }

    #[On('resetInputs')]
    public function resetInputs()
    {
        $this->product_rating = '';

        $this->resetValidation();
    }

    public function removeImage($index)
    {
        unset($this->old_images[$index]);

        $this->old_images = array_values($this->old_images);
    }

    public function render()
    {
        return view('livewire.normal-view.orders.index');
    }
}
