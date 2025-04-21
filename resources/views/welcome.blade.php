<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopcart - Headphones Sale</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <h6 class="font-semibold bg-red-400">Testajah</h6>




    <header>
        <div class="logo">Shopcart</div>
        <nav>
            <ul>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Deals</a></li>
                <li><a href="#">Delivery</a></li>
                <li><a href="#">Account</a></li>
                <li><a href="#">Cart</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <h1>Grab Upto 50% Off On Selected Headphones</h1>
            <button>Buy Now</button>
        </section>
        <section class="product-list">
            <h2>Headphones For You!</h2>
            <div class="product">
                @foreach ($products as $product)
                    <div class="product-item">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <p>${{ $product->price }}</p>
                        <button>Add to Cart</button>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="popular-categories">
            <h2>Popular Categories</h2>
            <ul>
                <li>Furniture</li>
                <li>Headphones</li>
                <li>Laptops</li>
                <li>Books</li>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Shopcart. All rights reserved.</p>
    </footer>
</body>
</html>
