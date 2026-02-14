<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MenController;
use App\Http\Controllers\WomenController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AccessoriesController;

// ========================================================================
// HOME
// ========================================================================
Route::get('/', function () {
    return view('home');
})->name('home');

// ========================================================================
// MEN'S SECTION
// ========================================================================
Route::prefix('men')->name('men.')->group(function () {
    // Main men's page
    Route::get('/', function () {
        return view('shop.men.index');
    })->name('index');
    
    // Collections
    Route::get('/collection/{slug}', [MenController::class, 'collection'])->name('collection');
    // Examples: dasher-nz, terralux, varsity
    
    // New Arrivals & Bestsellers
    Route::get('/new-arrivals', [MenController::class, 'newArrivals'])->name('new-arrivals');
    Route::get('/bestsellers', [MenController::class, 'bestsellers'])->name('bestsellers');
    
    // Shoes
    Route::get('/shoes', function () {
        return view('shop.men.shoes');
    })->name('shoes');
    Route::get('/shoes/{category}', [ProductController::class, 'showByCategory'])->name('shoes.category');

    // shoes detail page 
Route::get('/shop/men/detailshoes', function () {
    return view('shop.men.detailshoes');
});



    // Examples: sneakers, slip-ons, slippers, all-weather, sandals
    
    // Products (Individual items)
    Route::get('/product/{slug}', [MenController::class, 'product'])->name('product');
    // Examples: tree-runner-nz, tree-runner, varsity, dasher-nz, wool-cruiser
    
    // Apparel
    Route::get('/apparel', function () {
        return view('shop.men.apparel');
    })->name('apparel');
    Route::get('/apparel/new', [MenController::class, 'apparelNew'])->name('apparel.new');
    Route::get('/apparel/collection/{slug}', [MenController::class, 'apparelCollection'])->name('apparel.collection');
    // Examples: new-arrivals, bestsellers, tree-apparel
    Route::get('/apparel/{category}', [MenController::class, 'apparelCategory'])->name('apparel.category');
    // Examples: tees, sweats
    
    // Socks
    Route::get('/socks', [MenController::class, 'socks'])->name('socks');
    Route::get('/socks/{category}', [MenController::class, 'socksCategory'])->name('socks.category');
    // Examples: no-show, ankle, crew
    
    // Sale (existing route)
    Route::get('/sale', function () {
        return view('shop.men.sale');
    })->name('sale');
});

// ========================================================================
// WOMEN'S SECTION
// ========================================================================
Route::prefix('women')->name('women.')->group(function () {
    // Main women's page
    Route::get('/', function () {
        return view('shop.women.index');
    })->name('index');
    
    // Collections
    Route::get('/collection/{slug}', [WomenController::class, 'collection'])->name('collection');
    // Examples: dasher-nz, varsity
    
    // New Arrivals & Bestsellers
    Route::get('/new-arrivals', [WomenController::class, 'newArrivals'])->name('new-arrivals');
    Route::get('/bestsellers', [WomenController::class, 'bestsellers'])->name('bestsellers');
    
    // Shoes
    Route::get('/shoes', function () {
        return view('shop.women.shoes');
    })->name('shoes');
    Route::get('/shoes/{category}', [WomenController::class, 'shoesCategory'])->name('shoes.category');
    // Examples: sneakers, slip-ons, flats
    
    // Products (Individual items)
    Route::get('/product/{slug}', [WomenController::class, 'product'])->name('product');
    // Examples: tree-runner, tree-dasher, varsity
    
    // Apparel
    Route::get('/apparel', function () {
        return view('shop.women.apparel');
    })->name('apparel');
    Route::get('/apparel/new', [WomenController::class, 'apparelNew'])->name('apparel.new');
    Route::get('/apparel/collection/{slug}', [WomenController::class, 'apparelCollection'])->name('apparel.collection');
    // Examples: new-arrivals, bestsellers, tree-apparel
    Route::get('/apparel/{category}', [WomenController::class, 'apparelCategory'])->name('apparel.category');
    // Examples: tees, leggings
    
    // Socks
    Route::get('/socks', [WomenController::class, 'socks'])->name('socks');
    Route::get('/socks/{category}', [WomenController::class, 'socksCategory'])->name('socks.category');
    // Examples: no-show, ankle, crew
    
    // Sale (existing route)
    Route::get('/sale', function () {
        return view('shop.women.sale');
    })->name('sale');
});

// ========================================================================
// SALE SECTION
// ========================================================================
Route::prefix('sale')->name('sale.')->group(function () {
    // Main sale page
    Route::get('/', [SaleController::class, 'index'])->name('index');
    
    // Men's Sale
    Route::get('/men', [SaleController::class, 'men'])->name('men');
    Route::get('/men/shoes', [SaleController::class, 'menShoes'])->name('men.shoes');
    Route::get('/men/shoes/{category}', [SaleController::class, 'menShoesCategory'])->name('men.shoes.category');
    // Examples: sneakers, running
    Route::get('/men/clearance', [SaleController::class, 'menClearance'])->name('men.clearance');
    Route::get('/men/last-chance', [SaleController::class, 'menLastChance'])->name('men.last-chance');
    
    // Women's Sale
    Route::get('/women', [SaleController::class, 'women'])->name('women');
    Route::get('/women/shoes', [SaleController::class, 'womenShoes'])->name('women.shoes');
    Route::get('/women/shoes/{category}', [SaleController::class, 'womenShoesCategory'])->name('women.shoes.category');
    // Examples: sneakers, flats
    Route::get('/women/clearance', [SaleController::class, 'womenClearance'])->name('women.clearance');
    Route::get('/women/last-chance', [SaleController::class, 'womenLastChance'])->name('women.last-chance');
    
    // Sale Shoes (must come before general category to avoid conflicts)
    Route::get('/shoes', [SaleController::class, 'shoes'])->name('shoes');
    
    // General Sale Categories (must be last to avoid conflicts)
    Route::get('/{category}', [SaleController::class, 'category'])->name('category');
    // Examples: sneakers, apparel
});

// ========================================================================
// ACCESSORIES
// ========================================================================
Route::get('/accessories', [AccessoriesController::class, 'index'])->name('accessories');
Route::get('/accessories/{category}', [AccessoriesController::class, 'category'])->name('accessories.category');
// Example: bags

// ========================================================================
// GIFT CARDS
// ========================================================================
Route::get('/gift-cards', function () {
    return view('gift-cards.index');
})->name('gift-cards');

// ========================================================================
// CHECKOUT
// ========================================================================
Route::get('/checkout', function () {
    return view('checkout'); 
})->name('checkout');
// ========================================================================
// ADMIN ROUTES
// ========================================================================
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');

// ========================================================================
// SHOP / PRODUCTS
// ========================================================================
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');


