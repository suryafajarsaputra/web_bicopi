<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="container mx-auto p-6 bg-white shadow-lg rounded mt-8">
    <h2 class="text-2xl font-bold">Keranjang Belanja</h2>

    @if(session('success'))
        <p class="text-green-500">{{ session('success') }}</p>
    @endif

    <ul class="mt-4">
        @php $total = 0; @endphp
        @foreach ($cart as $index => $item)
            @php $total += $item['price']; @endphp
            <li class="flex justify-between items-center border-b py-2">
                <span>{{ $item['name'] }} - Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                <form action="{{ route('cart.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="index" value="{{ $index }}">
                    <button type="submit" class="text-red-500">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>

    <!-- Total Harga -->
    <div class="text-right mt-4">
        <strong>Total: Rp {{ number_format($total, 0, ',', '.') }}</strong>
    </div>

    @if (!empty($cart))
        <form action="{{ route('checkout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Checkout</button>
        </form>
    @endif

    <a href="{{ route('shopcart') }}" class="block text-center text-blue-500 mt-4">Kembali ke Toko</a>
</div>

</body>
</html>
