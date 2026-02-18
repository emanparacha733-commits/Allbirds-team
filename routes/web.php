<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MenController;
use App\Http\Controllers\WomenController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\OrderController;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Men section
Route::prefix('men')->name('men.')->group(function () {
    Route::get('/', function () {
        return view('shop.men.shoes');
    })->name('index');

    Route::get('/collection/{slug}', [MenController::class, 'collection'])->name('collection');
    Route::get('/new-arrivals', [MenController::class, 'newArrivals'])->name('new-arrivals');
    Route::get('/bestsellers', [MenController::class, 'bestsellers'])->name('bestsellers');

    Route::get('/shop/men/detailshoes', function () {
        return view('shop.men.detailshoes');
    });

    Route::get('/shoes', function () {
        return view('shop.men.shoes');
    })->name('shoes');
    Route::get('/shoes/{category}', [ProductController::class, 'showByCategory'])->name('shoes.category');

    Route::get('/product/{slug}', [MenController::class, 'product'])->name('product');

    Route::get('/apparel', function () {
        return view('shop.men.apparel');
    })->name('apparel');
    Route::get('/apparel/new', [MenController::class, 'apparelNew'])->name('apparel.new');
    Route::get('/apparel/collection/{slug}', [MenController::class, 'apparelCollection'])->name('apparel.collection');
    Route::get('/apparel/{category}', [MenController::class, 'apparelCategory'])->name('apparel.category');

    Route::get('/socks', [MenController::class, 'socks'])->name('socks');
    Route::get('/socks/{category}', [MenController::class, 'socksCategory'])->name('socks.category');
});

// Women section
Route::prefix('women')->name('women.')->group(function () {
    Route::get('/', function () {
        return view('shop.women.index');
    })->name('index');

    Route::get('/collection/{slug}', [WomenController::class, 'collection'])->name('collection');
    Route::get('/new-arrivals', [WomenController::class, 'newArrivals'])->name('new-arrivals');
    Route::get('/bestsellers', [WomenController::class, 'bestsellers'])->name('bestsellers');

    Route::get('/shoes', function () {
        return view('shop.women.shoes');
    })->name('shoes');
    Route::get('/shoes/{category}', [WomenController::class, 'shoesCategory'])->name('shoes.category');

    Route::get('/product/{slug}', [WomenController::class, 'product'])->name('product');

    Route::get('/apparel', function () {
        return view('shop.women.apparel');
    })->name('apparel');
    Route::get('/apparel/new', [WomenController::class, 'apparelNew'])->name('apparel.new');
    Route::get('/apparel/collection/{slug}', [WomenController::class, 'apparelCollection'])->name('apparel.collection');
    Route::get('/apparel/{category}', [WomenController::class, 'apparelCategory'])->name('apparel.category');

    Route::get('/socks', [WomenController::class, 'socks'])->name('socks');
    Route::get('/socks/{category}', [WomenController::class, 'socksCategory'])->name('socks.category');
});

// Sale section
Route::prefix('sale')->name('sale.')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('index');

    Route::get('/men', [SaleController::class, 'men'])->name('men');
    Route::get('/men/clearance', [SaleController::class, 'menClearance'])->name('men.clearance');
    Route::get('/men/last-chance', [SaleController::class, 'menLastChance'])->name('men.last-chance');
    Route::get('/men/shoes', [SaleController::class, 'menShoes'])->name('men.shoes');
    Route::get('/men/shoes/{category}', [SaleController::class, 'menShoesCategory'])->name('men.shoes.category');
    Route::get('/men/apparel', [SaleController::class, 'menApparel'])->name('men.apparel');
    Route::get('/men/apparel/{category}', [SaleController::class, 'menApparelCategory'])->name('men.apparel.category');
    Route::get('/men/socks', [SaleController::class, 'menSocks'])->name('men.socks');
    Route::get('/men/socks/{category}', [SaleController::class, 'menSocksCategory'])->name('men.socks.category');

    Route::get('/women', [SaleController::class, 'women'])->name('women');
    Route::get('/women/clearance', [SaleController::class, 'womenClearance'])->name('women.clearance');
    Route::get('/women/last-chance', [SaleController::class, 'womenLastChance'])->name('women.last-chance');
    Route::get('/women/shoes', [SaleController::class, 'womenShoes'])->name('women.shoes');
    Route::get('/women/shoes/{category}', [SaleController::class, 'womenShoesCategory'])->name('women.shoes.category');
    Route::get('/women/apparel', [SaleController::class, 'womenApparel'])->name('women.apparel');
    Route::get('/women/apparel/{category}', [SaleController::class, 'womenApparelCategory'])->name('women.apparel.category');
    Route::get('/women/socks', [SaleController::class, 'womenSocks'])->name('women.socks');
    Route::get('/women/socks/{category}', [SaleController::class, 'womenSocksCategory'])->name('women.socks.category');

    Route::get('/shoes', [SaleController::class, 'shoes'])->name('shoes');
    Route::get('/{category}', [SaleController::class, 'category'])->name('category');
});

// Accessories
Route::get('/accessories', [AccessoriesController::class, 'index'])->name('accessories');
Route::get('/accessories/{category}', [AccessoriesController::class, 'category'])->name('accessories.category');

Route::get('/gift-cards', function () {
    return view('gift-cards.index');
})->name('gift-cards');

// Cart & Checkout
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/checkout', [CartController::class, 'index'])->name('checkout');
Route::post('/checkout/place', [OrderController::class, 'place'])->name('checkout.place');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/buttons', function () {
        return view('admin.buttons');
    })->name('buttons');

    Route::get('/alerts', function () {
        return view('admin.alerts');
    })->name('alerts');

    Route::get('/avatars', function () {
        return view('admin.avatars');
    })->name('avatars');

    Route::get('/badge', function () {
        return view('admin.badge');
    })->name('badge');

    Route::get('/bar-chart', function () {
        return view('admin.bar-chart');
    })->name('bar-chart');

    Route::get('/basic-tables', function () {
        return view('admin.basic-tables');
    })->name('basic-tables');

    Route::get('/blank', function () {
        return view('admin.blank');
    })->name('blank');

    Route::get('/calender', function () {
        return view('admin.calender');
    })->name('calender');

    Route::get('/form-elements', function () {
        return view('admin.form-elements');
    })->name('form-elements');

    Route::get('/images', function () {
        return view('admin.images');
    })->name('images');
});

// Debug / Test routes (remove in production)
Route::get('/test-cart', function () {
    $cart = session('cart', []);
    $cart['test-product-123'] = [
        'id' => 'test-product-123',
        'name' => 'Tree Runner - Natural Black',
        'price' => 98,
        'size' => '10',
        'image' => 'images/1.jpg',
        'quantity' => 1
    ];
    session(['cart' => $cart]);
    return redirect()->route('home')->with('success', 'Test product added!');
});

Route::get('/session-test', function () {
    return session('cart', 'empty');
});

Route::get('/debug-session', function () {
    return response()->json([
        'cart' => session('cart'),
        'session_id' => session()->getId(),
        'all' => session()->all(),
    ]);
});

Route::get('/clear-old-cart', function () {
    session()->forget('cart');
    session()->save();
    return redirect('/')->with('success', 'Cart cleared!');
});