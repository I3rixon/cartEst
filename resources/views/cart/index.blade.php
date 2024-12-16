@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<div class="cart-messages"></div>
<div class="cart_wrapper">
    @foreach($cartItems as $item)
    <div class="product">
        <h2>{{ $item->product->name }}</h2>
        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 350px; height: auto;">
        <p>Price: {{ $item->product->price }}</p>
        <!--<p>Quantity: {{ $item->quantity }}</p>-->

            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
            <input type="number" name="quantity" class="product-quantity" value="{{ $item->quantity }}" min="1">
            <button class="update-to-cart-btn" data-id="{{ $item->product_id }}">Update</button>
        
            
            <button class="remove-to-cart-btn" data-id="{{ $item->product_id }}">Remove</button>
        
    </div>
    @endforeach
</div>
@endsection
