<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .container {
            width: 75%;
            padding: 20px;
            background: white;
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
            text-align: center;
            flex: 1 1 calc(30% - 20px);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
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
        .popup {
            position: fixed;
            top: 0;
            right: 0;
            width: 25%;
            height: 100vh;
            background: white;
            padding: 20px;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.3);
        }
        .popup-items {
            max-height: 60vh;
            overflow-y: auto;
        }
        .item-control {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .qty-btn {
            background-color: #ff9800;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <main class="container">
        <h2>Menu Items</h2>
        <div class="grid">
            @foreach ($products as $product)
                <div class="product-card" id="product-{{ $product->id_menu }}">
                    <img src="{{ $product->foto_menu }}" alt="{{ $product->nama_menu }}">
                    <h3>{{ $product->nama_menu }}</h3>
                    <p>Rp {{ number_format($product->harga_menu, 0, ',', '.') }}</p>
                    <button class="button" onclick="addToCart('{{ $product->id_menu }}', '{{ $product->nama_menu }}', {{ $product->harga_menu }})">
                        Add to Cart <span id="cart-count-{{ $product->id_menu }}">0</span>
                    </button>
                </div>
            @endforeach
        </div>
    </main>
    
    <div class="popup" id="popup">
        <h3>Checkout</h3>
        <div class="popup-items" id="popupItems"></div>
        <h4>Total: Rp <span id="totalPrice">0</span></h4>
        <button class="button" onclick="checkout()">Pay</button>
    </div>

    <script>
        let cart = {};

        function addToCart(id, name, price) {
            if (!cart[id]) {
                cart[id] = { id, name, price, qty: 0 };
            }
            cart[id].qty++;
            updatePopup();
            document.getElementById(`cart-count-${id}`).innerText = cart[id].qty;
        }

        function updatePopup() {
            let popupItems = document.getElementById("popupItems");
            popupItems.innerHTML = "";
            let total = 0;

            for (let id in cart) {
                let item = cart[id];
                total += item.price * item.qty;

                let div = document.createElement("div");
                div.className = "item-control";
                div.innerHTML = `
                    <span>${item.name} - Rp ${item.price.toLocaleString()}</span>
                    <button class="qty-btn" onclick="updateQty('${id}', -1)">-</button>
                    <span id="qty-${id}">${item.qty}</span>
                    <button class="qty-btn" onclick="updateQty('${id}', 1)">+</button>
                `;
                popupItems.appendChild(div);
            }
            document.getElementById("totalPrice").innerText = total.toLocaleString();
        }

        function updateQty(id, change) {
            if (cart[id]) {
                cart[id].qty += change;
                if (cart[id].qty <= 0) {
                    delete cart[id];
                }
                updatePopup();
                if (document.getElementById(`cart-count-${id}`)) {
                    document.getElementById(`cart-count-${id}`).innerText = cart[id] ? cart[id].qty : 0;
                }
            }
        }

        function checkout() {
    if (Object.keys(cart).length === 0) {
        alert("Keranjang Anda kosong!");
        return;
    }

    // Konversi cart ke JSON dan encode untuk URL
    let cartData = encodeURIComponent(JSON.stringify(cart));
    let totalHarga = Object.values(cart).reduce((sum, item) => sum + (item.price * item.qty), 0);

    // Redirect ke halaman receipt dengan data sebagai query string
    window.location.href = `/receipt?cart=${cartData}&totalHarga=${totalHarga}`;
}
    </script>
</body>
</html>