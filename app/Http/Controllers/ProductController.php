<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk dari database
        $products = Menu::all();

        return view('shop', compact('products'));
    }
}
