<?php
// Text
//$_['text_items']    = '%s -<br>%s';
if (file_exists(DIR_IMAGE.'/ico/cart.svg')) {
    $_['text_items'] = '<div class="header__cart-count count"><div class="header__cart-svg svg">' . file_get_contents(DIR_IMAGE.'/ico/cart.svg') . '</div><span class="cart-total__count">%s</span></div><div class="header__amount">Кошик<br>%s</div>';
} else {
    $_['text_items'] = '<div class="header__cart-count count"><div class="header__cart-svg svg"></div><span class="cart-total__count">%s</span></div><div class="header__amount">Кошик<br>%s</div>';
}
$_['text_items_mobile']     = '<span class="m-menu__total">%s</span><span class="m-menu__count">%s</span>';
$_['text_empty']    = 'Кошик<br>порожній!';
$_['text_cart']     = 'Переглянути кошик';
$_['text_checkout'] = 'Оформити замовлення';
$_['text_recurring']  = 'Платіжний профіль';
$_['text_tovars']    = array('товар', 'товара', 'товарів');

