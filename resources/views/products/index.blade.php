@extends('layouts.app')

@section('title', 'Product List')

@section('content')
<div class="product_wrapper">
    @foreach($products as $product)
    <div>
        <h2>{{ $product->name }}</h2>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 350px; height: auto;">
        <p>{{ $product->description }}</p>
        <p>Price: {{ $product->price }}</p>
        <form method="POST" action="/cart/add">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="number" name="quantity" value="1" min="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    @endforeach
</div>
@endsection
