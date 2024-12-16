function addToCart(productId, quantity = 1) {
    $.ajax({
        url: '/cart/add',
        method: 'POST',
        data: {
            product_id: productId,
            quantity: quantity,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            //alert(response.message);
            updateCartUI(response.message);
        },
        error: function (xhr) {
            console.error(xhr.responseJSON.message);
            //alert('Failed to add product to cart.');
        }
    });
}


function updateCart(productId, quantity) {
    $.ajax({
        url: '/cart/update',
        method: 'POST',
        data: {
            product_id: productId,
            quantity: quantity,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            //alert(response.message);
            updateCartUI(response.message);
        },
        error: function (xhr) {
            console.error(xhr.responseJSON.message);
            //alert('Failed to update cart.');
        }
    });
}


function removeFromCart(productId) {
    $.ajax({
        url: '/cart/remove',
        method: 'POST',
        data: {
            product_id: productId,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            //alert(response.message);
            updateCartUI(response.message);
        },
        error: function (xhr) {
            console.error(xhr.responseJSON.message);
            //alert('Failed to remove product from cart.');
        }
    });
}

// Update Cart UI
function updateCartUI(cart) {
    $('.cart-messages').html(cart);    
    $('.cart-messages').fadeIn(300);
    setTimeout(function(){
        $('.cart-messages').fadeOut(300);
    }, 3000)
}


$(document).on('click', '.add-to-cart-btn', function () {
    const productId = $(this).data('id');
    const quantity = $(this).closest('.product').find('.product-quantity').val() || 1;
    addToCart(productId, quantity);
});

$(document).on('click', '.update-to-cart-btn', function () {
    const productId = $(this).data('id');
    const quantity = $(this).closest('.product').find('.product-quantity').val() || 1;
    updateCart(productId, quantity);
});

$(document).on('click', '.remove-to-cart-btn', function () {
    const productId = $(this).data('id');    
    removeFromCart(productId);
    $(this).closest('.product').remove();
});
