window.addToCart = function addToCart(id, quantity = 1) {
    $.ajax({
        url: window.addToCartRoute,
        type: "POST",
        data: { id, qty: quantity },
        headers: {},
        success: (data) => {
            $('.cart-total__count').text(Object.keys(data).length)
            $('.header__amount').text(Object.keys(data).length)
        },
        error: (data) => {
            console.log(data)
        }
    });
}

$(function() {
    $('.tobasket').on('click', function(event) {
        event.preventDefault();
        const id = $(this).attr('data-id');
        let quantity = 1;
        try {
            quantity = $('#quantity_input').val();
        } catch {
            // pass
        }
        window.addToCart(id, quantity);
    })
});