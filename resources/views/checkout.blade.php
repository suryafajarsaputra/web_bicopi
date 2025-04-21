@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>
    <div id="checkoutItems">
        @foreach($cart as $item)
            <div class="cart-item">
                <span>{{ $item['name'] }} (x{{ $item['qty'] }})</span>
                <span>Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
            </div>
        @endforeach
    </div>
    <div class="total">Total: Rp <span id="checkoutTotal">{{ number_format($total, 0, ',', '.') }}</span></div>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <button type="submit" class="button">Confirm Payment</button>
    </form>
</div>
@endsection
