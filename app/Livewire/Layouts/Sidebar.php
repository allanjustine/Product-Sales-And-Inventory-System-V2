<?php

namespace App\Livewire\Layouts;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function count()
    {
        $usersCount = User::where('id', '<>', auth()->id())->count();
        $productsCount = Product::count();
        $feedbacks = Contact::count();
        $categoriesCount = ProductCategory::count();
        $ordersCount = Order::where('order_status', '!=', 'Paid')
            ->where('order_status', '!=', 'Cancelled')
            ->count();
        $productSalesCount = Order::where('order_status', 'Paid')->count();

        return compact(
            'usersCount',
            'productsCount',
            'categoriesCount',
            'ordersCount',
            'productSalesCount',
            'feedbacks'
        );
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        return view('livewire.layouts.sidebar', $this->count());
    }
}
