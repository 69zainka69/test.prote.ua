<svg style="display:none;height:0;width:0;">
<style>
#featured{position:relative;}
#featured .title {color:#00adee;font-size:17px;position:relative;padding:11px 0 13px 39px;border-bottom:3px solid #00aff2;}
#featured .title span.svg.star{display:none;}
#featured .title span.svg{position:absolute;left:0;top:3px;}
#featured .title span.svg path{fill:#00adee;}
#featured .all{position:absolute;bottom:-30px;right:0px;}
#featured .all a{color:#bababa;font-size:17px;font-family:'Open Sans',sans-serif;}
.products{display:flex;}
.products>div{width:20%;flex:1 1 auto;text-align: center;margin-top:28px;border:1px solid #fff;font-family:'Trebuchet MS';}
.products>div:hover{border:1px solid #e3e3e3;}
.products>div:hover a{color:#00aff2;}
.product{position:relative;}
.product.non{-webkit-filter: grayscale(1);filter: grayscale(1);}
.product .image {padding:0 25px;}
.product .image a{display: block;padding:57px 15px 19px;}
.product .ifexist{display:inline-block;padding-left:24px;text-transform:lowercase;line-height:28px;font-size:12px;color:#999;position:relative;}
.product .ifexist:before{content:'';position: absolute;left:-8px;top:3px;width:21px;height:21px;}
.product .ifexist.ico0:before{background: url('/image/ico/00-v-nayavnosti.svg');}
.product .ifexist.ico3:before{background: url('/image/ico/00-nema-v-nayavnosti.svg');}
.product .ndesc{padding:12px 13px 15px;text-align:left;}
.product .name{display:block;line-height:20px;font-size:13px;min-height:66px;}
.product .price{color:#fd9710;font-size:20px;margin-bottom:15px;text-align: left;}
.product .price-old{color:#999;text-decoration: line-through;}
.product .buttons{margin:0 13px 9px;}
.product .buttons a {display:block;line-height:13px;padding:4px 7px 7px 5px;}
.product .buttons .button-row{display:flex;flex: 8 13 auto;}
.product .buttons a.oneclick{background:#bee9f9;color:#484848;font-size:13px; width:81px;background:#bee9f9;color:#484848;font-size:13px; width:37%;margin-right:5px;}
.product .buttons a.tobasket{position:relative;background:#fd9710;color:#484848;font-size:16px; width:132px;padding:10px 7px 10px 37px;color:#fff;}
.product .buttons a.tobasket:before{content:'';position:absolute;left:25px;top:5px;width:30px;height:28px;background: url('/image/ico/04-cart-buy.svg')no-repeat;}
.product .dar{position:absolute;right:8px;top:4px;width:70px;height:70px;}
.product .dar>div{min-height:100%; border-radius:50%; background:#00aff2; color:#fff; text-align:left; }
.product .dar>div:before{content:'';position: absolute;right:16px;top:12px;width:30px;height:28px;background: url('/image/ico/06-action.svg');}
.product .dar .plus{padding:19px 0 0 9px;font-size:30px;}
.product .dar .podn{padding:0 0 0 13px;font-size:12px;line-height:16px;}

@media (max-width: 992px) { /*720*/
  #featured{margin-bottom:30px;margin-top:10px;}
  #featured .title{font-size:30px;padding:5px 0 18px 78px;margin-top:20px;}
  #featured .title span.svg.action{display:none;}
  #featured .title span.svg.star{display:block;z-index:9}
  #featured .title .star svg{width:42px;height:40px;left:23px;top:-6px;}
  .product .price{font-size:30px;}
  .product .name{font-size:20px;}
  .product .buttons a.tobasket{width:100%;font-size:28px;line-height:60px;padding:10px 7px 10px 7px;}
  .product .buttons a.tobasket:before{background:none;}
}
@media (max-width: 768px) {/*540*/
  #featured .title{font-size:20px;padding:13px 0 10px 53px;}
  #featured .title span.svg{left:16px;top:9px;}
  #featured .title .star svg{width:29px;height:27px;}
  .product .name{font-size:15px;}
}
@media (max-width: 576px) {/*320*/
  #featured,#featured .title{margin-top:0;}
  #featured .title{font-size:15px;}
  #featured .title .star svg{width:22px;height:21px;}
}

</style>
</svg>
<div id="featured">
<div class="title">
  <span class="svg action"><?php echo file_get_contents(DIR_IMAGE.'/ico/06-action.svg');?></span>
  <span class="svg star"><?php echo file_get_contents(DIR_IMAGE.'/ico/320-star.svg');?></span>
  <?php echo $heading_title; ?></div>
<div class="products">
  <?php foreach ($products as $product) { ?>
  <div class="product<?php if($product['ifexist']==3) { ?> non<?php } ?>">
    <div class="dar"><div>
      <div class="plus">+</div>
      <div class="podn">дорунок</div>
    </div></div>
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
      <?php if($product['ifexist']<>3) { ?>
      <?php switch ($product['ifexist']) {
          case 0: ?>
             <p class="ifexist ico0"><?php echo $text_exist; ?></p>
         <?php break; case 1: ?>
             <p class="ifexist ico1"><?php echo $text_preorder; ?></p>
         <?php break; case 2: ?>
             <p class="ifwait ico2"><?php echo $text_wait; ?></p>
         <?php break; default: ?>
         <?php } ?>
      <?php } else { ?>
          <p class="ifexist ico3"><?php echo $text_noexist; ?></p>
      <?php } ?>
      <div class="ndesc">
        <a class="name" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
      </div>
      <div class="buttons">
        <?php if ($product['price']) { ?>
        <p class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
          <?php } ?>
        </p>
        <?php } ?>

          <?php if($product['minimum']>1) { ?>
            <div class="product_min list block"><?php echo $text_minimum.$product['minimum'];?></div>
          <?php } ?>
          <?php if ($product['ifexist']!=2) { ?>
            <div class="button-row">
              <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                  <a href="#ordercallback-modal" data-modal="ordercallback-form" class="oneclick"
                  onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special"] ? $product["special"] : $product["price"]); ?>','<?php echo $product['minimum']; ?>'); return false;">
                        <?php echo $button_cartone; ?>                      
                  </a>
              <?php } ?>
              <a href="#basketinfo-modal1" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');">&nbsp;<?php echo $button_cart; ?></a>
            </div>
          <?php } ?>
      </div>
    </div>
  <?php } ?>
</div>
<div class="all"><a href="<?php echo $langurl; ?>/articles/" title="<?php echo $text_allactions?>"><?php echo $text_allactions?></a></div>

</div>
    