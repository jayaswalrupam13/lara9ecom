<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sample;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddHomeSlideComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\WishlistComponent;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;

define('OPTION_ATTACHMENT', config('constants.IMAGE_PATH').'/'.config('constants.IMAGE_PATH'));

Route::get('/', HomeComponent::class)->name('home.index');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/cart', CartComponent::class)->name('shop.cart');
Route::get('/wishlist', WishlistComponent::class)->name('shop.wishlist');
Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');
Route::get('/product-category/{slug}', CategoryComponent::class)->name('product.category');
Route::get('/search', SearchComponent::class)->name('product.search');
Route::get('/sample', [Sample::class, 'test']);

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});

Route::middleware('auth', 'authadmin')->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');

    Route::get('/admin/categories', AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.category.add');    
    Route::get('/admin/category/edit/{category_id}', AdminAddCategoryComponent::class)->name('admin.category.edit');

    Route::get('admin/products', AdminProductComponent::class)->name('admin.products');
    Route::get('admin/product/add', AdminAddProductComponent::class)->name('admin.product.add');
    Route::get('/admin/product/edit/{product_id}', AdminAddProductComponent::class)->name('admin.product.edit');

    Route::get('admin/slider', AdminHomeSliderComponent::class)->name('admin.home.slider');
    Route::get('admin/slider/add', AdminAddHomeSlideComponent::class)->name('admin.home.slide.add');
    Route::get('/admin/slider/edit/{slide_id}', AdminAddHomeSlideComponent::class)->name('admin.home.slide.edit');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

require __DIR__.'/auth.php';
