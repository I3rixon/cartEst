<div class="cart_wrapper">
    @foreach($cartItems as $item)
    <div>
        <h2>{{ $item->product->name }}</h2>
        <p>Price: {{ $item->product->price }}</p>
        <p>Quantity: {{ $item->quantity }}</p>
        <form method="POST" action="/cart/update">
            @csrf
            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
            <button type="submit">Update</button>
        </form>
        <form method="POST" action="/cart/remove">
            @csrf
            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
            <button type="submit">Remove</button>
        </form>
    </div>
    @endforeach
</div>
