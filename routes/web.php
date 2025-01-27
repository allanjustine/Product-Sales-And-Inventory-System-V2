<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSiteController;
use App\Http\Controllers\Normal_View\SiteController;
use App\Livewire\Admin\Pages\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\NormalView\Carts\Index;
use App\Livewire\NormalView\Pages\About;
use App\Livewire\NormalView\Pages\Home;
use App\Livewire\NormalView\Products\Index as ProductsIndex;
use App\Models\Product;

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
Route::get('/register', [AuthController::class, 'register']);
Route::get('/verification/{token}/{user}', [AuthController::class, 'verification']);

Route::get('/', Home::class);
Route::get('/about-us', About::class);
Route::get('/contact-us', [SiteController::class, 'contact']);
Route::get('/view-products', [SiteController::class, 'viewProducts']);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/profile', [SiteController::class, 'profile']);
    Route::get('/products', ProductsIndex::class);
    Route::get('/orders', [SiteController::class, 'order']);
    Route::get('/favorites', [SiteController::class, 'favorite']);
    Route::get('/recent-orders', [SiteController::class, 'recentOrder']);
    Route::get('/carts', Index::class);
    // Route::get('/cart', [SiteController::class, 'myCart']);
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/feedbacks', [AdminSiteController::class, 'contact']);
    // Route::get('/admin/about', [AdminSiteController::class, 'about']);
    Route::get('/admin/profile', [AdminSiteController::class, 'profile']);
    Route::get('/admin/users', [AdminSiteController::class, 'user']);
    Route::get('/admin/products', [AdminSiteController::class, 'product']);
    Route::get('/admin/product-categories', [AdminSiteController::class, 'category']);
    Route::get('/admin/orders', [AdminSiteController::class, 'order']);
    Route::get('/admin/product-sales', [AdminSiteController::class, 'productSales']);
});
