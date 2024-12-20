@extends('layouts.app')

@section('title', 'Product List')

@section('content')
<div class="cart-messages"></div>
<div class="product_wrapper">
    @foreach($products as $product)
    <div class="product">
        <h2>{{ $product->name }}</h2>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 350px; height: auto;">
        <p>{{ $product->description }}</p>
        <p>Price: {{ $product->price }}</p>
        
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="number" name="quantity" class="product-quantity" value="1" min="1">
            <button class="add-to-cart-btn" data-id="{{ $product->id }}">Add to Cart</button>
        
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $products->links() }} <!-- Pagination links -->
    </div>
</div>
@endsection
