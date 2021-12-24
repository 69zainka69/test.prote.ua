<svg style="display:none;height:0;width:0;">
  <style>
  #bestseller{margin-bottom:30px;width:100%;}
  #bestseller .title {color:#00adee;font-size:17px;position:relative;}
  #bestseller .title span.svg.star{display:none;}
  #bestseller .title span.svg{position:absolute;left:0;top:3px;}
  #bestseller .title span.svg path{fill:#00adee;}
  #bestseller .title h1{color:#00adee;font-size:17px;font-weight:normal; margin: none !;}
  #bestseller .all{position:absolute;bottom:-30px;right:0px;}
  #bestseller .all a{color:#bababa;font-size:17px;font-family:'Open Sans',sans-serif;}
  #bestseller .title h1 {margin-left: 0px;}
  @media only screen and (min-width: 996px) and (max-width: 1919px)  {
    #bestseller .title h1 {margin-left: 20px;}
  }
  @media only screen and (min-width: 996px) and (max-width: 1279px)  {
    .bestseller_container {max-width: calc(100% - 12px) !important;}
  }
  @media only screen and (min-width: 720px) and (max-width: 995px)  {
    .bestseller_container {max-width: calc(100% - 14px) !important;}
    #bestseller .title h1 {margin-left: 20px;}
  }
  @media only screen and (min-width: 540px) and (max-width: 719px)  {
    .products {margin-top: 40px;}
    #bestseller .title h1 {margin-left: 20px;}
    .bestseller_container {max-width: calc(100% - 16px) !important;}
  }
  @media only screen and (min-width: 320px) and (max-width: 539px)  {
    .bestseller_container {max-width: calc(100% - 16px) !important;}
    #bestseller .title h1 {font-size: 15px; margin-left: 10px;}
  }

  <?php echo file_get_contents(DIR_APPLICATION.'/view/js/products.css');  $text_freedelivery_paid='';?>
.product__price {
    margin-bottom: 65px;
}.product_min {
    display: none;
    position: absolute;
    top: 2px;
    left: 39px;
     color: #999999;
    }

.products:hover > div > div.buttons.product__block-buttons > div > p{
   border: 2px solid #999999;
}
.ss {
   position: absolute;
       top: -43px;
    left: 0;
    text-align: center;
    width: 100%;
    height: 37px;
    color: #999999;
    }

product:hover .ss{
  color: #999999;
  position: absolute;
    top: -87px;
    width: 217px;
    height: 44px;
}

  </style>
  </svg>
  <div class="container bestseller_container">
    <div class="row">
  <div id="bestseller">
  <div class="title">
    <?php if($route == 'common/home'){ ?>
      <h1><?php echo $heading_title; ?></h1>
    <?php } elseif($route !== 'common/home'){ ?>
  <style>
      #bestseller .title{padding-left:10px;}
    </style>
      <?php echo $heading_title; ?>
    <?php } ?>
  </div>
  <div class="products">
    <?php foreach ($products as $product) { ?>
    <div class="product">
      <div class="product__lable">
        <?php if ($product['has_free_delivery'] && ($product['special'] || $product['action'])) { ?>
          <?php if ($product['has_free_delivery']) { ?>
            <div
                class="product__free-delivery-plate <?php echo ($product['special'] || isset($product['action']) && $product['action']) ? 'with-action' : '' ?>"
                data-tooltip="<?php echo $text_freedelivery_paid; ?>"
            >
            <div class="product__text-delivery"><?php echo $text_free_delivery; ?></div>
                <img
                    class="free-delivery-icon lazy"
                    data-original="image/ico/favicon_prote_16x16.svg"
                    data-src="image/ico/action/free-delivery-action.svg"
                    alt="<?php echo $text_free_delivery; ?>"
                    title="<?php echo $text_free_delivery; ?>"
                />
            </div>
        <?php } 
              if ($product['special'] || !empty($product['action'])) { ?>
            <div class="product__dar dar" <?php if(isset($product['action']['short_description'])){ ?> data-tooltip="<?php echo $product['action']['short_description']; ?>" <? } ?> >
              <a href="<?php echo $product['action']['url']; ?>">
                    <img
                    class="lazy"
                        data-original="image/ico/favicon_prote_16x16.svg"
                        data-src="image/ico/action/label-fire-action.svg"
                        alt="<?php echo $text_action; ?>"
                        title="<?php echo $text_action; ?>"
                    />
                    <div class="product__text-dar"><?php echo $text_action; ?></div>
                </a>
            </div>
        <?php } ?>
      <?php } else { ?>
        <div
              class="product__bestseller<?php echo ($product['special'] || isset($product['action']) && $product['action']) ? 'with-action' : '' ?>"
              data-tooltip="<?php echo $text_freedelivery_paid; ?>"
          >
          <div class="product__text-bestseller"><?php echo $text_bestseller; ?></div>
              <img
                  class="free-delivery-icon lazy"
                  data-original="image/ico/favicon_prote_16x16.svg"
                  data-src="image/ico/action/top.svg"
                  alt="<?php echo $text_bestseller; ?>"
                  title="<?php echo $text_bestseller; ?>"
              />
          </div>
        <?php if ($product['has_free_delivery']) { ?>
            <div
                class="product__free-delivery-plate <?php echo ($product['special'] || isset($product['action']) && $product['action']) ? 'with-action' : '' ?>"
                data-tooltip="<?php echo $text_freedelivery_paid; ?>"
            >
            <div class="product__text-delivery"><?php echo $text_free_delivery; ?></div>
                <img
                    class="free-delivery-icon lazy"
                    data-original="image/ico/favicon_prote_16x16.svg"
                    data-src="image/ico/action/free-delivery-action.svg"
                    alt="<?php echo $text_free_delivery; ?>"
                    title="<?php echo $text_free_delivery; ?>"
                />
            </div>
        <?php } elseif ($product['special'] || !empty($product['action'])) { ?>
            <div class="product__dar" <?php if(isset($product['action']['short_description'])){ ?> data-tooltip="<?php echo $product['action']['short_description']; ?>" <? } ?> >
              <a href="<?php echo $product['action']['url']; ?>">
                    <img
                    class="lazy"
                        data-original="image/ico/favicon_prote_16x16.svg"
                        data-src="image/ico/action/label-fire-action.svg"
                        alt="<?php echo $text_action; ?>"
                        title="<?php echo $text_action; ?>"
                    />
                    <div class="product__text-dar"><?php echo $text_action; ?></div>
                </a>
            </div>
        <?php } } ?>
</div>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img data-original="image/ico/favicon_prote_16x16.svg" data-src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive lazy" /></a></div>
        <?php if($product['ifexist']<>3) { ?>
          <?php switch ($product['ifexist']) {
              case 0: ?>
                 <p class="ifexist product__ifexist ico0"><?php echo $text_exist; ?></p>
             <?php break; case 1: ?>
                 <p class="ifexist product__ifexist ico1"><?php echo $text_preorder; ?></p>
             <?php break; case 2: ?>
                 <p class="ifwait product__ifexist ico2"><?php echo $text_wait; ?></p>
             <?php break; default: ?>
             <?php } ?>
          <?php } else { ?>
              <p class="ifexist product__ifexist ico3"><?php echo $text_noexist; ?></p>
          <?php } ?>
    
        <div class="ndesc product__ndesc">
          <a class="name" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
        </div>
        <?php if ($product['price']) { ?>
          <div class="product__price">
            <p class="price"><?php if (!$product['special']) { ?><?php echo $text_price; ?>: <?php echo $product['price']; ?>
              <?php } else { ?>
              <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
              <?php } ?>
            </p>
          </div>
          <?php } ?>
        <div class="buttons product__block-buttons">
            <?php if($product['minimum']>1) { ?>
              <div class=" list block"><p class="ss"><span class="product_min"><?php  $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
              if ($url == "https://prote.ua/ua/") {
              echo "Мін. кількість: ".$text_minimum.$product['minimum']." шт";
              }
              else{
                echo "Минимальный заказ: ".$text_minimum.$product['minimum']." шт";
              }
              ?><span></p>
             </div>
            <?php } ?>
            <?php if ($product['ifexist']!=2) { ?>
                <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                    <a href="#ordercallback-modal" data-modal="ordercallback-form" class="product__oneclick oneclick" onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special_float"] ? $product["special_float"] : $product["price_float"]); ?>','<?php echo $product['minimum']; ?>'); return false;">
                          <?php echo $button_cartone; ?>                      
                    </a>
                <?php } ?>
                <a href="" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
            <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
  </div>
  </div>
<script>
  $(function() {
    simple_tooltip(".product__dar","tooltip");
});
</script>

<style>
  <?php echo file_get_contents(DIR_APPLICATION.'view/js/tooltip.css'); ?>
</style>
  <?php $minimum ='1';?>
  <?php require_once(DIR_APPLICATION.'view/theme/default/template/module/ordercallback_modal.tpl');?>