<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Responsive</title>
    <header class="custom-header">
        <img src="/images/bicopi.png" alt="Logo" class="logo">
        <h1 class="menu-title">Menu</h1>
    </header>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>

        body {
            font-family: sans-serif;
            margin: 0;
            padding-bottom: 100px;
            background: #f7f7f7;
        }
        /* Header */
.custom-header {
    display: flex;
    align-items: center;
    padding: 10px 16px;
    background: white;
    border-bottom: 1px solid #ccc;
}
.logo {
    width: 40px;
    height: 35px;
    border-radius: 50%;
    margin-right: 12px;
}
.menu-title {
    margin: 0;
    font-size: 20px;
    font-weight: bold;
}

/* Footer */
.custom-footer {
    background-color: #078603;
    color: white;
    padding: 20px 16px;
}
.footer-content {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}
.logo-footer {
    width: 60px;
    height: 55%;
    border-radius: 50%;
}
.footer-info {
    flex: 1;
}
.footer-title {
    margin-top: 0;
    font-size: 18px;
}
.footer-info p {
    margin: 4px 0;
}
.footer-info a {
    color: white;
    text-decoration: underline;
}
.icon {
    margin-right: 6px;
}


        .kategori-buttons {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding: 12px;
            background: white;
        }

        .kategori-buttons button {
            padding: 8px 16px;
            border: 1px solid #078603
            ;
            background-color: white;
            color: #078603
            ;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            white-space: nowrap;
        }

        .kategori-buttons button.active {
            background-color: #078603
;
            color: white;
        }

        .produk-list {
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .produk-item {
            background: white;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .produk-item img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
        }

        .produk-info {
            flex: 1;
        }

        .produk-nama {
            font-weight: bold;
            font-size: 14px;
        }

        .produk-harga {
            color: #888;
            font-size: 13px;
        }

        .btn-add, .qty-btn {
            border: 1px solid #078603
            ;
            color: #078603
            ;
            background: white;
            border-radius: 8px;
            padding: 4px 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .qty-num {
            font-weight: bold;
            width: 20px;
            text-align: center;
        }

        .checkout-popup {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #ddd;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }

        .checkout-popup button {
            background-color: #078603
            ;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Kategori -->
    <div class="kategori-buttons">
        <button class="active" onclick="filterByCategory('all', this)">Semua</button>
        @foreach ($categories as $category)
            <button onclick="filterByCategory('{{ $category->id_kategori_menu }}', this)">
                {{ $category->kategori }}
            </button>
        @endforeach
    </div>

    <!-- Produk -->
    <div class="produk-list">
        @foreach ($products as $product)
        <div class="produk-item" data-id="{{ $product->id_menu }}" data-nama="{{ $product->nama_menu }}" data-harga="{{ $product->harga_menu }}" data-kategori="{{ $product->id_kategori_menu }}">
            <a href="{{ route('produk.detail', ['id' => $product->id_menu]) }}">
                <img src="{{ $product->foto_menu }}" alt="{{ $product->nama_menu }}">
            </a>
            <div class="produk-info">
                <div class="produk-nama">{{ $product->nama_menu }}</div>
                <div class="produk-harga">Rp{{ number_format($product->harga_menu, 0, ',', '.') }}</div>
            </div>
            <div class="produk-action" id="action-{{ $product->id_menu }}">
                <button class="btn-add" onclick="addToCart('{{ $product->id_menu }}')">Add</button>
            </div>
        </div>
        
        @endforeach
    </div>

    <!-- Checkout -->
    <div class="checkout-popup">
        <div>Total: <span id="totalHarga">Rp0</span> (<span id="totalItem">0</span> item)</div>
        <button onclick="checkout()">CHECK OUT</button>
    </div>
<!-- Footer -->
<footer class="custom-footer">
    <div class="footer-content">
        <img src="/images/bicopi.png" alt="Logo" class="logo-footer">
        <div class="footer-info">
            <h2 class="footer-title">Customer Center</h2>
            <p><span class="icon">📍</span> Jalan Raya, Jl. Dr. Ir. H. Soekarno Merr No.678, Gn. Anyar, Kec. Gn. Anyar, Surabaya, Jawa Timur 60294</p>
            <p><span class="icon">💬</span> <a href="https://wa.me/6287855804679">0878-5580-4679</a></p>
        </div>
    </div>
</footer>

    <script>
        let cart = {};
    
        function addToCart(id) {
            cart[id] = 1;
            renderQty(id);
            updateCheckout();
        }
    
        function updateQty(id, delta) {
            if (!cart[id]) cart[id] = 0;
            cart[id] += delta;
            if (cart[id] <= 0) delete cart[id];
            renderQty(id);
            updateCheckout();
        }
        function renderQty(id) {
            const container = document.getElementById(`action-${id}`);
            if (!cart[id]) {
                container.innerHTML = `<button class="btn-add" onclick="addToCart('${id}')">Add</button>`;
            } else {
                container.innerHTML = `
                    <div class="qty-control">
                        <button class="qty-btn" onclick="updateQty('${id}', -1)">−</button>
                        <span class="qty-num">${cart[id]}</span>
                        <button class="qty-btn" onclick="updateQty('${id}', 1)">+</button>
                    </div>
                `;
            }
        }
    
        function updateCheckout() {
            let total = 0;
            let items = 0;
            for (let id in cart) {
                let el = document.querySelector(`[data-id="${id}"]`);
                let harga = parseInt(el.getAttribute("data-harga"));
                total += harga * cart[id];
                items += cart[id];
            }
            document.getElementById("totalHarga").innerText = "Rp" + total.toLocaleString("id-ID");
            document.getElementById("totalItem").innerText = items;
        }
    
        function checkout() {
            let total = 0;
            let cartData = {};
            for (let id in cart) {
                let el = document.querySelector(`[data-id="${id}"]`);
                let nama = el.getAttribute("data-nama");
                let harga = parseInt(el.getAttribute("data-harga"));
                let qty = cart[id];
                let subtotal = harga * qty;
                total += subtotal;
                cartData[id] = {
                    name: nama,
                    price: harga,
                    qty: qty
                };
            }
    
            // Generate a random order code
            let kode = 'ORD' + Math.floor(10000 + Math.random() * 90000); // Order code generation
    
            // Encode cart data and pass it along with the order code
            let cartEncoded = encodeURIComponent(JSON.stringify(cartData));
            window.location.href = `/receipt?cart=${cartEncoded}&totalHarga=${total}&kode=${kode}`;
        }
    
        function filterByCategory(kategori, btn) {
            document.querySelectorAll('.kategori-buttons button').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
    
            document.querySelectorAll('.produk-item').forEach(item => {
                if (kategori === 'all' || item.getAttribute('data-kategori') === kategori) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
    

</body>
</html>
