<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Menambahkan produk ke keranjang
        $cart[] = [
            'name' => $request->name,
            'price' => $request->price
        ];

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);

        return view('cart', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        unset($cart[$request->index]);

        session()->put('cart', array_values($cart));

        return redirect(route('shop.view'))->route('cart.view')->with('success', 'Produk berhasil dihapus.');
    }
}
