<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Livewire\Attributes\Computed;
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
                'sales' => $orders->whereNotIn('order_status', ['Pending', 'Cancelled'])->sum('order_total_amount')
            ];
        }

        return $salesData;
    }
    private function getMonthlyProductSalesData()
    {
        $productSalesData = [];

        for ($month = 1; $month <= 12; $month++) {
            $products = Product::withSum('orders', 'order_quantity')->whereMonth('created_at', $month)->get();
            $monthName = date("F", mktime(0, 0, 0, $month, 1));
            $productSalesData[] = [
                'month'         => $monthName,
                'product_sales' => $products->sum('orders_sum_order_quantity')
            ];
        }

        return $productSalesData;
    }

    public function count()
    {
        $user = User::query();
        $usersCount = (clone $user)->role('user')->count();
        $adminsCount = (clone $user)->role('admin')->count();

        $feedbacks = Contact::query()->count();

        $productItem = Product::query()->with('orders');
        $productsCount = (clone $productItem)->count();
        $productTotalSolds = (clone $productItem)
            ->whereHas(
                'orders',
                fn($item)
                =>
                $item->where(
                    fn($q)
                    =>
                    $q->where('order_status', 'Delivered')
                        ->orWhere('order_status', 'Paid')
                )
            )
            ->count();

        $categoriesCount = ProductCategory::query()->count();

        $order = Order::query();
        $ordersCount = (clone $order)->whereNotIn('order_status', ['Paid', 'Deliverd', 'Cancelled'])
            ->count();
        $productSalesCount = (clone $order)->where('order_status', 'Paid')->count();


        $grandTotal = (clone $order)->whereIn('order_status', ['Paid', 'Deliverd'])
            ->sum('order_total_amount');

        $todaysTotal = (clone $order)->whereDate('created_at', today())
            ->whereIn('order_status', ['Paid', 'Deliverd'])
            ->sum('order_total_amount');

        $monthlyTotal = (clone $order)->whereMonth('created_at', now()->month)
            ->whereIn('order_status', ['Paid', 'Deliverd'])
            ->sum('order_total_amount');

        $yearlyTotal = (clone $order)->whereYear('created_at', now()->year)
            ->whereIn('order_status', ['Paid', 'Deliverd'])
            ->sum('order_total_amount');

        $orderMonth = (clone $order)->whereMonth('created_at', now()->month)->get();

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
            'feedbacks',
            'productTotalSolds'
        );
    }

    #[Computed]
    public function stockStatus()
    {
        $product = Product::query();

        $in_stock = (clone $product)->where(
            fn($q)
            =>
            $q->where('product_stock', '>', 0)
                ->orWhereHas('productSizes', fn($size) => $size->where('stock', '>', 0))
                ->orWhereHas('productColors', fn($size) => $size->where('stock', '>', 0))
        )->count();

        $low_stock = (clone $product)->where(
            fn($q)
            =>
            $q->where('product_stock', '<', 20)
                ->orWhereHas('productSizes', fn($size) => $size->where('stock', '<', 20))
                ->orWhereHas('productColors', fn($size) => $size->where('stock', '<', 20))
        )->count();

        $out_of_stock = (clone $product)->where(
            fn($q)
            =>
            $q->where('product_stock', '<', 1)
                ->orWhereHas('productSizes', fn($size) => $size->where('stock', '<', 1))
                ->orWhereHas('productColors', fn($size) => $size->where('stock', '<', 1))
        )->count();

        $not_available = (clone $product)->where('product_status', 'Not Available')->count();

        return (object) [
            "in_stock"      => $in_stock,
            "low_stock"     => $low_stock,
            "out_of_stock"  => $out_of_stock,
            "not_available" => $not_available,
        ];
    }

    #[Computed]
    public function categoryPerformance()
    {
        return ProductCategory::query()
            ->withCount('products')
            ->withSum('orders', 'order_quantity')
            ->withSum('orders', 'order_total_amount')
            ->has('products')
            ->has('orders')
            ->orderBy('orders_sum_order_quantity', 'desc')
            ->take(10)
            ->get();
    }

    #[Computed]
    public function randomColor()
    {
        return ['red', 'green', 'blue', 'violet', 'pink', 'cyan', 'yellow', 'orange'];
    }
    public function render()
    {
        return view('livewire.admin.pages.dashboard', $this->count());
    }
}
