<svg style="display:none;height:0;width:0;">
<style>
#featured{position:relative;margin-bottom:30px;width:100%;}
#featured .title {color:#00adee;font-size:17px;position:relative;padding:11px 0 13px 39px;border-bottom:3px solid #00aff2;}
#featured .title span.svg.star{display:none;}
#featured .title span.svg{position:absolute;left:0;top:3px;}
#featured .title span.svg path{fill:#00adee;}
#featured .title h1{color:#00adee;font-size:17px;font-weight:normal}
#featured .all{position:absolute;bottom:-30px;right:0px;}
#featured .all a{color:#bababa;font-size:17px;font-family:'Open Sans',sans-serif;}
@media (max-width: 576px) {/*320*/
  #featured,#featured .title{margin-top:0;}
  #featured .title{font-size:15px;}
  #featured .title .star svg{width:22px;height:21px;}
}
@media (max-width: 992px) { /*720*/
  #featured{margin-bottom:30px;margin-top:10px;}
  #featured .title{font-size:30px;padding:5px 0 18px 78px;margin-top:20px;}
  #featured .title span.svg.action{display:none;}
  #featured .title span.svg.star{display:block;z-index:9}
  #featured .title .star svg{width:42px;height:40px;left:23px;top:-6px;}
}
@media (max-width: 768px) {/*540*/
  #featured .title{font-size:20px;padding:13px 0 10px 53px;}
  #featured .title span.svg{left:16px;top:9px;}
  #featured .title .star svg{width:29px;height:27px;}
}
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/products.css');?>

<?php if($route == 'common/home'){ ?>
@media (max-width: 1300px) {.products .product:last-child{  display:none;}}
@media (max-width: 992px) {.products .product:nth-child(3n),.products .product:nth-child(4n),.product .buttons a.oneclick{display:none;}}
<?php } ?>
</style>
</svg>
<div id="featured">
<div class="title">
  <?php if($route == 'common/home'){ ?>
    <span class="svg action"><?php echo file_get_contents(DIR_IMAGE.'/ico/06-action.svg');?></span>
    <span class="svg star"><?php echo file_get_contents(DIR_IMAGE.'/ico/320-star.svg');?></span>
    <h1><?php echo $heading_title; ?></h1>
  <?php } elseif($route !== 'common/home'){ ?>
<style>
    #featured .title{padding-left:10px;}
  </style>
    <?php echo $heading_title; ?>
  <?php } ?>
</div>
<div class="products">
  <?php foreach ($products as $product) { ?>
  <div class="product<?php if($product['ifexist']==3) { ?> non<?php } ?>">
      <?php if ($product['special'] || $product['action']) { ?>
        <div class="dar">
        <img src="image/ico/favicon_prote_16x16.svg" data-original="image/ico/action/label-fire-action.svg"  alt="<?php echo $text_action; ?>" title="<?php echo $text_action; ?>"/>
        <div><?php echo $text_action; ?></div>
        </div>
      <?php } ?>
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
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
        <p class="price"><?php if (!$product['special']) { ?><?php echo $product['price']; ?><?php } else { ?><span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span><?php } ?></p>
        <?php } ?>
          <?php if($product['minimum']>1) { ?>
            <div class="product_min list block"><?php echo $text_minimum.$product['minimum'];?></div>
          <?php } ?>
          <?php if ($product['ifexist']!=2) { ?>
            <div class="button-row">
              <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                  <a href="#ordercallback-modal" data-modal="ordercallback-form" class="oneclick" onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special_float"] ? $product["special_float"] : $product["price_float"]); ?>','<?php echo $product['minimum']; ?>'); return false;">
                        <?php echo $button_cartone; ?>                      
                  </a>
              <?php } ?>
              <a href="" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
            </div>
          <?php } ?>
      </div>
    </div>
  <?php } ?>
</div>
<?php if($route == 'common/home'){ ?>
<div class="all"><a href="<?php echo $langurl; ?>/actions/" title="<?php echo $text_allactions?>"><?php echo $text_allactions?></a></div>
<?php } ?>
</div>
<?php $minimum ='1';?>
<?php include_once(DIR_APPLICATION.'view/theme/default/template/module/ordercallback_modal.tpl');?>