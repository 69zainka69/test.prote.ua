<?php
// Text
//$_['text_items']     = '%s -<br>%s';
$_['text_items']     = '<div class="header__cart-count count"><div class="header__cart-svg svg">'. file_get_contents(DIR_IMAGE.'/ico/cart.svg').'</div><span class="cart-total__count">%s</span></div><div class="header__amount">Корзина<br>%s</div>';
$_['text_items_mobile']     = '<span class="m-menu__total">%s</span><span class="m-menu__count">%s</span>';
$_['text_empty']     = 'В корзине <br>пусто!';
$_['text_cart']      = 'Открыть Корзину';
$_['text_checkout']  = 'Оформить Заказ';
$_['text_recurring'] = 'Профиль платежа';
$_['text_tovars']    = array('товар', 'товара', 'товаров');