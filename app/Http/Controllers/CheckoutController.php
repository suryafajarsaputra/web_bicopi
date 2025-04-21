<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class CheckoutController extends Controller
{
    public function checkoutCart()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Keranjang masih kosong!');
        }

        // Ambil data menu dari database berdasarkan id_menu dalam cart
        $menuItems = Menu::whereIn('id_menu', array_keys($cart))->get();

        // Hitung total harga
        $totalHarga = 0;
        foreach ($menuItems as $item) {
            $totalHarga += $item->harga_menu * $cart[$item->id_menu]['quantity'];
        }

        session()->forget('cart');

        return redirect()->route('receipt')->with([
            'cart' => $menuItems,
            'totalHarga' => $totalHarga
        ]);
    }

    public function receipt()
    {
        $cart = session()->get('cart', []);
        $totalHarga = session()->get('totalHarga', 0);

        return view('receipt', compact('cart', 'totalHarga'));
    }
    public function processCheckout(Request $request)
{
    $cart = $request->input('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.view')->with('error', 'Keranjang masih kosong!');
    }

    // Ambil menu dari database
    $menuItems = Menu::whereIn('id_menu', array_keys($cart))->get();

    // Hitung total harga
    $totalHarga = 0;
    foreach ($menuItems as $item) {
        $totalHarga += $item->harga_menu * $cart[$item->id_menu]['qty'];
    }

    // Simpan data ke session
    session([
        'cart' => $cart,
        'totalHarga' => $totalHarga
    ]);

    return response()->json(['success' => true]);
}

}
