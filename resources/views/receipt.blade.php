@extends('layouts.master')

@section('title', 'Struk Pembelian')

@section('content')

<!-- Modern Minimalis CSS Struk Kasir -->
<style>
    body {
        font-family: 'Courier New', Courier, monospace; /* Font kasir */
        background-color: #ffffff;
        color: #333333;
        padding: 20px;
    }

    h2 {
        color: #333333;
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
        text-transform: uppercase;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        font-size: 14px;
        margin-bottom: 20px;
    }

    th, td {
        padding: 8px 5px;
        text-align: left;
        border-bottom: 1px dashed #ccc;
    }

    th {
        background-color: #f5f5f5;
        font-weight: bold;
    }

    tr:last-child td {
        border-bottom: none;
    }

    h4 {
        text-align: right;
        margin-top: 10px;
        font-size: 18px;
        color: #333333;
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        font-size: 14px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        color: #333;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.2s;
        margin: 5px 2px;
    }

    .btn:hover {
        background-color: #e0e0e0;
    }

    p {
        font-size: 14px;
        margin-bottom: 10px;
    }

    @media print {
        body {
            padding: 0;
            background-color: #fff;
        }
        .btn {
            display: none; /* Sembunyikan tombol saat cetak */
        }
    }
</style>

<!-- Content Start -->
<h2>Struk Pembelian</h2>

@php
    // Decode cart from query and ensure it's an array
    $cart = json_decode(request()->query('cart'), true) ?? [];
    $totalHarga = request()->query('totalHarga');
    $kodePemesanan = request()->query('kode'); // Capture the kode here
@endphp

@if($kodePemesanan)
    <p><strong>Kode Pemesanan:</strong> {{ $kodePemesanan }}</p>
@endif

@if(count($cart) > 0)
    <table>
        <thead>
            <tr>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $item)
                <tr>
                    <td>{{ $item['name'] ?? 'Nama tidak tersedia' }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
@else
    <p>Tidak ada barang dalam keranjang.</p>
@endif

<a href="{{ route('shop.index') }}" class="btn">Kembali ke Menu</a>
<!-- Content End -->

@endsection
