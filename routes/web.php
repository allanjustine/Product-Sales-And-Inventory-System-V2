<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Orders\Index as AdminOrdersIndex;
use App\Livewire\Admin\Orders\ProductSales;
use App\Livewire\Admin\Pages\ContactUs as PagesContactUs;
use App\Livewire\Admin\Pages\Dashboard;
use App\Livewire\Admin\Pages\Profile as PagesProfile;
use App\Livewire\Admin\ProductCategories\Index as ProductCategoriesIndex;
use App\Livewire\Admin\Products\Index as AdminProductsIndex;
use App\Livewire\Admin\Users\Index as UsersIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\Verification;
use App\Livewire\NormalView\Carts\Index;
use App\Livewire\NormalView\Favorites\Index as FavoritesIndex;
use App\Livewire\NormalView\Orders\Index as OrdersIndex;
use App\Livewire\NormalView\Orders\RecentOrders;
use App\Livewire\NormalView\Pages\About;
use App\Livewire\NormalView\Pages\ContactUs;
use App\Livewire\NormalView\Pages\Home;
use App\Livewire\NormalView\Pages\Profile;
use App\Livewire\NormalView\Products\Index as ProductsIndex;
use App\Livewire\NormalView\Products\ViewOnly;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class);
Route::get("/verification/{token}/{user}", action: Verification::class);

Route::get('/', Home::class);
Route::get('/about-us', About::class);
Route::get('/feedbacks', ContactUs::class);
Route::get('/view-products', ViewOnly::class);
Route::get('/reset-password', ResetPassword::class)->name('password.reset');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/products', ProductsIndex::class);
    Route::get('/profile', Profile::class);
    Route::get('/orders',  OrdersIndex::class);
    Route::get('/favorites',  FavoritesIndex::class);
    Route::get('/recent-orders', RecentOrders::class);
    Route::get('/carts', Index::class);
    // Route::get('/cart', [SiteController::class, 'myCart']);
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/feedbacks', PagesContactUs::class);
    // Route::get('/admin/about', [AdminSiteController::class, 'about']);
    Route::get('/admin/profile', PagesProfile::class);
    Route::get('/admin/users', UsersIndex::class);
    Route::get('/admin/products', AdminProductsIndex::class);
    Route::get('/admin/product-categories', ProductCategoriesIndex::class);
    Route::get('/admin/orders', AdminOrdersIndex::class);
    Route::get('/admin/product-sales', ProductSales::class);
});
