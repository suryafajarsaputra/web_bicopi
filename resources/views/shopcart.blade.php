<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopcart - Headphones Sale</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007bff;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        nav ul li {
            margin-left: 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .text-center {
            text-align: center;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }
        .product-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1 1 calc(33% - 20px);
            box-sizing: border-box;
        }
        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
        .button-blue {
            background-color: #007bff;
        }
        footer {
            text-align: center;
            padding: 10px;
            background: #ddd;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Shopcart</div>
        <nav>
            <ul>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Deals</a></li>
                <li><a href="#">Delivery</a></li>
                <li><a href="#">Account</a></li>
                <li><a href="{{ route('cart.view') }}">Cart</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section class="text-center">
            <h1>Grab Up to 50% Off On Selected Headphones</h1>
            <button class="button button-blue">Buy Now</button>
        </section>

        <section>
            <h2>Headphones For You!</h2>
            <div class="grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <button 
                            onclick="addToCart('{{ $product->name }}', {{ $product->price }})" 
                            class="button">
                            Tambah ke Keranjang
                        </button>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="text-center">
            <a href="{{ route('cart.view') }}" class="button button-blue">Lihat Keranjang</a>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Shopcart. All rights reserved.</p>
    </footer>

    <script>
        function addToCart(name, price) {
            $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    price: price
                },
                success: function(response) {
                    alert("Produk berhasil ditambahkan ke keranjang!");
                },
                error: function() {
                    alert("Terjadi kesalahan, coba lagi.");
                }
            });
        }
    </script>
</body>
</html>
