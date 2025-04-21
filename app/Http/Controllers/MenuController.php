<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Menu;

class MenuController extends Controller
{
    // Menampilkan daftar menu
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    // Menampilkan form tambah menu
    public function create()
    {
        return view('menus.create');
    }

    // Menyimpan data menu ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'foto_menu' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi_menu' => 'required|string',
            'harga_menu' => 'required|numeric',
        ]);

        // Simpan foto ke storage jika ada
        $fotoPath = null;
        if ($request->hasFile('foto_menu')) {
            $fotoPath = $request->file('foto_menu')->store('menu_fotos', 'public');
        }

        // Simpan data ke database
        Menu::create([
            'nama_menu' => $request->nama_menu,
            'foto_menu' => $fotoPath,
            'deskripsi_menu' => $request->deskripsi_menu,
            'harga_menu' => $request->harga_menu,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }
}
