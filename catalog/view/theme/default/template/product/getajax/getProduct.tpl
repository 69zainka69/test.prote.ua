<?php foreach ($products as $key => $product) { ?>
<div class="product-layout product<?php if($product['ifexist']==3) { ?> non<?php } ?>" data-prodid="<?php echo $product['product_id']; ?>" data-position="<?php echo $key; ?>">
 <?php if ($product['special'] || $product['action']) { ?>
    <div class="dar"  <?php if(isset($product['action'][0]['short_description'])){ ?> data-tooltip="<?php echo $product['action'][0]['short_description']; ?>" <?php } ?>>
    <img src="image/ico/action/label-fire-action.svg"  alt="<?php echo $text_action; ?>" title="<?php echo $text_action; ?>"/>
    <div><?php echo $text_action; ?></div>
    </div>
  <?php } ?>
  <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
    <?php if($product['attributs']) { ?>
    <div class="ico_attr dflex">
      <?php foreach ($product['attributs'] as $key => $attribut) { ?>
        <div class="ico attr_<?php echo $key; ?>"><img src="<?php echo $attribut['image']; ?>" alt="<?php echo $attribut['text']; ?>" title="<?php echo $attribut['text']; ?>"><div><?php echo $attribut['text']; ?></div></div>
      <?php } ?>
    </div>
    <?php } ?>
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
    <p class="price"><?php if (!$product['special']) { ?><?php echo $product['price']; ?><?php } else { ?>
      <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
      <?php } ?></p>
    <?php } ?>

      <?php if($product['minimum']>1) { ?>
        <div class="product_min list block"><?php echo $text_minimum.$product['minimum'];?></div>
      <?php } ?>
      <?php if ($product['ifexist']!=2) { ?>
        <div class="button-row">
      <?php  if (isset($ordercallback_use_module)){
         if ($ordercallback_use_module && $ordercallback_as_order || 1) { ?>
              <a href="#ordercallback-modal" data-modal="ordercallback-form" class="oneclick" onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special_float"] ? $product["special_float"] : $product["price_float"]); ?>','<?php echo $product['minimum']; ?>'); return false;"><?php echo $button_cartone; ?></a>
          <?php }} ?>
          <a href="#basketinfo-modal1" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
        </div>
      <?php } ?>
  </div>
</div>
<?php } ?>