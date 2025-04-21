<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
// Halaman utama (opsional)
Route::get('/', function () {
    return view('welcome');
});

// Menampilkan halaman shopcart dengan data dummy
Route::get('/shopcart', function () {
    $products = Product::all();
    return view('shopcart', compact('products'));
})->name('shopcart'); // Tambahkan ini
// Menampilkan halaman checkout
Route::get('/receipt', function (Request $request) {
    return view('receipt', [
        'cart' => json_decode($request->query('cart'), true),
        'totalHarga' => $request->query('totalHarga'),
    ]);
})->name('receipt');

// Rute untuk keranjang belanja
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Rute untuk checkout dari keranjang
Route::post('/checkout', [CheckoutController::class, 'checkoutCart'])->name('checkout');

// Rute untuk halaman struk setelah checkout
Route::get('/receipt', [CheckoutController::class, 'receipt'])->name('receipt');
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');