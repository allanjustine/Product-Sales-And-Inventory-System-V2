<?php

namespace App\Livewire\NormalView\Pages;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductRating;
use Livewire\Attributes\Title;
use Livewire\Component;

class About extends Component
{
    #[Title('About Us')]

    public function index()
    {
        $testimonies = Contact::query()
            ->where('is_published', true)
            ->get(['name', 'email', 'message', 'created_at']);

        $product_available = Product::query()
            ->where('product_status', "Available")
            ->count();

        $happy_customers = ProductRating::query()
            ->distinct('user_id')
            ->count();

        $orders_delivered = Order::query()
            ->where(
                fn($query)
                =>
                $query->where('order_status', 'Delivered')
                    ->orWhere('order_status', 'Paid')
            )
            ->count();

        return compact('testimonies', 'product_available', 'happy_customers', 'orders_delivered');
    }

    public function render()
    {
        return view('livewire.normal-view.pages.about', $this->index());
    }
}
