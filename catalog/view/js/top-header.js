$(function() {
    let langMenu = $('.top-panel__lang');
    let lagnSelect = $('.lang-select');
    let arrow = $('.top-panel__arrow--dark');
    let topPanelLogin = $('.top-panel__login');
    let loginForm = $('.login-form--desktop');
    let countProducts = $('.header .cart-total__count');
    langMenu.on('mouseenter',() => {
        lagnSelect.addClass('lang-select--open', 0);
        arrow.addClass('top-panel__arrow--dark--open', 0);
    });
    lagnSelect.on('mouseleave',() => {
        lagnSelect.removeClass('lang-select--open', 0);
        arrow.removeClass('top-panel__arrow--dark--open', 0);
    });
    topPanelLogin.on('click',() => {
        loginForm.removeClass('login-form--hide');
    });
    $('#cart').bind("DOMSubtreeModified", function() {
        setTimeout(() => {
            countProducts = $('.header .cart-total__count');
            countProducts.addClass('cart-total__bounce');
            $('.top-panel .cart-total__count').addClass('cart-total__bounce');
        }, 400);
    });
    if (countProducts.html() > 0) {
        countProducts.addClass('cart-total__bounce');
        $('.top-panel .cart-total__count').addClass('cart-total__bounce');
    }
});