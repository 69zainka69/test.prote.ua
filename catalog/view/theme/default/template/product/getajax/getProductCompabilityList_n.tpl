<!-- start compability -->
<style>
#tab-compability{padding-left:0;height:400px;margin-top:50px;padding-top: 0;}
#compabilities .panel{color:#999;font-size:10px;padding-right:10px;}
.panel-title{font-family:'Trebuchet MS';line-height:16px;color:#00aff2;font-size:20px;margin:20px 0 5px;}
#compabilities .text{line-height:17px;}
/*#compabilities a{color:#999;}*/
@media (min-width: 1230px){
#compabilities .panel{flex: 1 1 0;}
}
@media (max-width:991px){
  #compabilities{flex-wrap:wrap;}
}
</style>
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/products.css');?>
.featured_title{color:#00adee; font-size:22px; margin-bottom:10px; }
.swiper-slide{height:auto;}
</style>
<?php if($productsCompability){ ?>
  <div id="compabilities">
  <?php foreach($productsCompability as $key => $products ){ if(count($products)<1)continue;?>
      <div class="row1 reatured">
        <div class="featured_title"><?php echo $data['titles_n'][$key]; ?></div>
        <div style="max-width: 100%;">
            <div class="swiper-viewport">
                <div id="slideshow<?php echo $key; ?>" class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach($products as $product) { ?>
                            <div class="product-layout swiper-slide product<?php if($product['ifexist']==3) { ?> non<?php } ?>" data-prodid="<?php echo $product['product_id']; ?>" data-position="<?php echo $key; ?>">
                                <?php if ($product['special']) { ?>
                                    <div class="dar">
                                        <img src="image/ico/action/label-fire-action.svg"  alt="<?php echo $text_action; ?>" title="<?php echo $text_action; ?>"/>
                                        <div><?php echo $text_action; ?></div>
                                    </div>
                                <?php } ?>
                                <div class="image">
                                    <a href="<?php echo $product['href']; ?>"><img alt="<?php echo $product['name']; ?>" src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
                                    </a>
                                </div>
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
                                    <?php if ($product['ifexist']==3) { ?>
                                    <?php } elseif ($product['ifexist']!=2) { ?>
                                        <div class="button-row">
                                            <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                                                <a href="#ordercallback-modal" data-modal="ordercallback-form" class="oneclick"
                                                   onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special_float"] ? $product["special_float"] : $product["price_float"]); ?>','<?php echo $product['minimum']; ?>'); return false;">
                                                    <?php echo $button_cartone; ?>
                                                </a>
                                            <?php } ?>
                                            <a href="#basketinfo-modal1" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="swiper-pagination slideshow<?php echo $key; ?>"></div>
                <div class="swiper-pager">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
      </div>
  <?php } ?>
  </div>
<script>
$(document).ready(function() {
<?php foreach($productsCompability as $key => $products ){ ?>

var swiper<?php echo $key; ?> = new Swiper('#slideshow<?php echo $key; ?>', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.slideshow0',
      clickable: true,
    },
    autoplay: {
      delay: 4000,
      disableOnInteraction: true,
    },
    mode:'horizontal',
    // slidesPerView:4,
    loop:false,
    lazy: {
      loadPrevNext: true,
    },
   breakpoints: {
      576: {
          slidesPerView: 1,
          spaceBetween: 1
      },
      768: {
          slidesPerView: 2,
          spaceBetween: 2
      },
      991: {
          slidesPerView: 4,
          spaceBetween: 2
      },
      1299: {
           slidesPerView: 4,
          spaceBetween: 3
      }
    },
    onSlideChangeStart: function () {
      $(window).scrollTop($(window).scrollTop()-1);
      $(window).scrollTop($(window).scrollTop()+1);
    }
});

<?php } ?>
});
</script>

<?php } ?>
<!--  end compability -->