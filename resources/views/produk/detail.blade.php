@extends('layouts.master')

@section('content')
<style>
    .product-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        font-family: Arial, sans-serif;
    }

    .product-content {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .product-image {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .product-details {
        flex: 1;
    }

    .product-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 20px;
        color: #078603;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .product-meta {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }

    .product-description {
        font-size: 15px;
        color: #444;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        border: none;
        transition: background 0.3s;
    }

    .btn-back {
        background-color: #e0e0e0;
        color: #333;
    }

    .btn-back:hover {
        background-color: #ccc;
    }

    .btn-cart {
        background-color: #078603;
        color: white;
    }

    .btn-cart:hover {
        background-color: #078603;
    }

    @media (min-width: 768px) {
        .product-content {
            flex-direction: row;
        }

        .product-image {
            width: 300px;
            height: 300px;
        }
    }
</style>

<div class="product-container">
    <div class="product-content">
        <img src="{{ $product->foto_menu }}" alt="{{ $product->nama_menu }}" class="product-image">
        
        <div class="product-details">
            <div class="product-title">{{ $product->nama_menu }}</div>
            <div class="product-price">Rp {{ number_format($product->harga_menu, 0, ',', '.') }}</div>
            <div class="product-meta"><strong>Kategori:</strong> {{ $categories->kategori->kategori ?? 'Tidak Diketahui' }}</div>
            <div class="product-description">
                {{ $product->deskripsi_menu ?? 'Tidak ada deskripsi.' }}
            </div>

            <div class="action-buttons">
                <a href="/shop" class="btn btn-back">← Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection
