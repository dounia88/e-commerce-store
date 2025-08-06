<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes publiques pour les produits
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/featured', [ProductController::class, 'featured'])->name('products.featured');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Routes publiques pour les catégories
Route::get('/categories', [ProductController::class, 'categories'])->name('categories.index');
Route::get('/categories/{category:slug}', [ProductController::class, 'category'])->name('categories.show');
// Alias pour compatibilité
Route::get('/products/category/{category:slug}', [ProductController::class, 'category'])->name('products.category');

// Route de contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Routes de test (uniquement en développement)
if (app()->environment('local')) {
    Route::get('/test-navbar', function () {
        return view('test-navbar');
    })->name('test.navbar');

    Route::get('/demo-categories', function () {
        return view('demo-categories');
    })->name('demo.categories');

    Route::get('/test-products', function () {
        $products = \App\Models\Product::with(['category', 'user'])->take(8)->get();
        return view('test-products', compact('products'));
    })->name('test.products');
}

// Routes pour le panier (authentification requise)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // Routes pour les favoris
    Route::get('/favorites', function () {
        return view('favorites.index');
    })->name('favorites.index');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

    // Routes pour le checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/payment/{order}', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel/{order}', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

    // Routes pour les commandes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

// Routes vendeur
Route::middleware(['auth', 'vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('vendor.dashboard');
    })->name('dashboard');

    Route::get('/products', function () {
        return view('vendor.products.index');
    })->name('products.index');

    Route::get('/products/create', function () {
        return view('vendor.products.create');
    })->name('products.create');

    Route::get('/sales', function () {
        return view('vendor.sales');
    })->name('sales');
});

// Routes admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Gestion des produits
    Route::resource('products', AdminProductController::class);
    
    // Gestion des catégories
    Route::resource('categories', AdminCategoryController::class);
    
    // Gestion des commandes
    Route::resource('orders', AdminOrderController::class);
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

    // Gestion des utilisateurs
    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');

    // Gestion des signalements
    Route::get('/reports', function () {
        return view('admin.reports.index');
    })->name('reports.index');
});

// Routes d'authentification existantes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
