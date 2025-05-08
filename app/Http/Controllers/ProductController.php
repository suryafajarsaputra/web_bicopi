<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\KategoriMenu;

class ProductController extends Controller
{
    public function index()
    {
        $products = Menu::all();
        $categories = KategoriMenu::all();

        return view('shop', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Menu::with('kategori')->findOrFail($id);

        return view('produk.detail', compact('product'));
    }
}
