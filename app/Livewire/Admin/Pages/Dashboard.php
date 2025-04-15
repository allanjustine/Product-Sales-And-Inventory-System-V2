<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]
    public $salesData;
    public $productSalesData;
    public $morning;
    public $afternoon;
    public $evening;

    public function mount()
    {
        $time = now()->format('H');

        $this->morning = $time >= 0 && $time < 12;
        $this->afternoon = $time >= 12 && $time < 18;
        $this->evening = $time >= 18 && $time <= 23;
        $this->salesData = $this->getMonthlySalesData();
        $this->productSalesData = $this->getMonthlyProductSalesData();
    }

    private function getMonthlySalesData()
    {
        $salesData = [];

        for ($month = 1; $month <= 12; $month++) {
            $orders = Order::whereMonth('created_at', $month)->get();
            $monthName = date("F", mktime(0, 0, 0, $month, 1));
            $salesData[] = [
                'month' => $monthName,
                'sales' => $orders->whereNotIn('order_status', ['Pending'])->whereNotIn('order_status', ['Cancelled'])->sum('order_total_amount')
            ];
        }

        return $salesData;
    }
    private function getMonthlyProductSalesData()
    {
        $productSalesData = [];

        for ($month = 1; $month <= 12; $month++) {
            $products = Product::whereMonth('created_at', $month)->get();
            $monthName = date("F", mktime(0, 0, 0, $month, 1));
            $productSalesData[] = [
                'month' => $monthName,
                'product_sales' => $products->sum('product_sold')
            ];
        }

        return $productSalesData;
    }

    public function count()
    {
        $excludedData = ["Pending", "Cancelled", "Complete", "Delivered", "To Deliver"];
        $includedData = ["Pending", "Complete", "To Deliver", "Delivered"];

        $usersCount = User::role('user')->count();
        $adminsCount = User::role('admin')->count();
        $feedbacks = Contact::count();
        $productsCount = Product::count();
        $categoriesCount = ProductCategory::count();
        $ordersCount = Order::whereIn('order_status', $includedData)
            ->count();
        $productSalesCount = Order::where('order_status', 'Paid')->count();


        $grandTotal = Order::whereNotIn('order_status', $excludedData)
            ->sum('order_total_amount');
        $todaysTotal = Order::whereDate('created_at', today())
            ->whereNotIn('order_status', $excludedData)
            ->sum('order_total_amount');
        $monthlyTotal = Order::whereMonth('created_at', now()->month)
            ->whereNotIn('order_status', $excludedData)
            ->sum('order_total_amount');
        $yearlyTotal = Order::whereYear('created_at', now()->year)
            ->whereNotIn('order_status', $excludedData)
            ->sum('order_total_amount');
        $orderMonth = Order::whereMonth('created_at', now()->month)->get();

        return compact(
            'usersCount',
            'adminsCount',
            'productsCount',
            'categoriesCount',
            'ordersCount',
            'productSalesCount',
            'grandTotal',
            'todaysTotal',
            'monthlyTotal',
            'yearlyTotal',
            'orderMonth',
            'feedbacks'
        );
    }
    public function render()
    {
        return view('livewire.admin.pages.dashboard', $this->count());
    }
}
