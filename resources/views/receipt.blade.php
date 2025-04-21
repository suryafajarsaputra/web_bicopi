@extends('layouts.master')

@section('title', 'Struk Pembelian')

@section('content')
    <h2>Struk Pembelian</h2>

    @php
        $cart = json_decode(request()->query('cart'), true);
        $totalHarga = request()->query('totalHarga');
    @endphp

    @if(count($cart) > 0)
        <table class="table">
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
                        <td>{{ $item['name'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['qty'] }}</td>
                        <td>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h4>

        <button onclick="window.print()" class="btn btn-success">Cetak Struk</button>
    @else
        <p>Tidak ada barang dalam keranjang.</p>
    @endif

    <a href="{{ route('shop.index') }}" class="btn btn-primary">Kembali ke Menu</a>
@endsection
