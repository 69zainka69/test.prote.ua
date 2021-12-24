<?php
$categc = "false";
$categb = "false";
$categh = "false";
$specialmon = 0;
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$Comix = array(
    0 => "ruchki-sharikovie",
    1 => "markeri-dlya-videleniya-teksta",
    2 => "korrektor-ruchka",
    3 => "stepleri",
    4 => "dirokoli",
    5 => "nozhnitci",
    6 => "gubki-magnity",
    7 => "klipbordi-plansheti",
    8 => "fajli-dlya-dokumentov",
    9 => "papki-registratori",
    10 => "papki-s-prizhimom",
    11 => "papki-na-knopkah",
    12 => "papki-na-rezinkah",
    13 => "papki-portfeli",
    14 => "papki",
);
$Baoke = array (
    0 => "ruchki-sharikovie",
    1 => "ruchki-gelevie",
    2 => "maslyanie-ruchki",
    3 => "grafitovie-karandashi",
    4 => "mehanicheskie-karandashi",
    5 => "lastiki",
    6 => "tochilki",
    7 => "markeri-permanentni",
    8 => "markeri-dlya-videleniya-teksta",
    9 => "markeri-dlya-magnitnih-dosok-i-flipchartov",
    10 => "skobi-dlya-steplerov",
    11 => "stepleri",
    12 => "skotch",
    13 => "papki",
);
$h_tones = array (
  0 => "ruchki-sharikovie",
  1 => "grafitovie-karandashi",
  2 => "linejki",
  3 => "markeri-dlya-videleniya-teksta",
  4 => "nastolnie-pribori-podstavki",
  5 => "nabori-nastolnie-s-napolneniem",
  6 => "klej-karandash",
  7 => "korrektor-s-kistochkoy",
  8 => "korrektor-ruchka",
  9 => "stepleri",
  10 => "skrepki",
  11 => "bejdzhi",
  12 => "boksi-dlya-bumazhnih-blokov",
  13 => "lotki-vertikalnie",
  14 => "lotki-gorizontalnie",
  15 => "gubki-magnity",
  16 => "papki",
  17 => "korziny-dlja-bumag",
  18 => "doski-flipcharty",
  19 => "kantcelyarskie-nozhi",
);

for($i=0; $i!=14; $i++){
    if (strpos($url, $Baoke[$i]) !== false) {
       $categb = "true";
    }
}

for($i=0; $i!=15; $i++){
    if (strpos($url, $Comix[$i]) !== false) {
        $categc = "true";
    }
}
for($i=0; $i!=20; $i++){
  if (strpos($url, $h_tones[$i]) !== false) {
      $categh = "true";
  }
}


if( $categb == "true" || $categc == "true" || $categh == "true"){
    $specialmon = 1;


     foreach ($productsBaoke as $key => $product) { ?>
        <div class="product" data-id-product="<?php echo $product['product_id']; ?>">
                      <div class="product__lable">
                          <?php if ($product['has_free_delivery']) { ?>
                            <div
                                class="product__free-delivery-plate <?php echo ($product['special'] || isset($product['action']) && $product['action']) ? 'with-action' : '' ?>"
                                data-tooltip="<?php echo $text_freedelivery_paid; ?>"
                            >
                            <div class="product__text-delivery"><?php echo $text_free_delivery; ?></div>
                                <img
                                    class="free-delivery-icon"
                                    src="image/ico/favicon_prote_16x16.svg"
                                    data-original="image/ico/action/free-delivery-action.svg"
                                    alt="<?php echo $text_free_delivery; ?>"
                                    title="<?php echo $text_free_delivery; ?>"
                                />
                            </div>
                        <?php } 
        
                              if ($product['special'] || !empty($product['action'])) { ?>
                            <div class="product__dar dar" <?php if(isset($product['action']['short_description'])){ ?> data-tooltip="<?php echo $product['action']['short_description']; ?>" <? } ?> >
                            
                              <a <?php //echo 'href="'.$product['action']['url'].'"'; ?> >
        
                                    <img
                                        src="image/ico/favicon_prote_16x16.svg"
                                        data-original="image/ico/action/label-fire-action.svg"
                                        alt="<?php echo $text_action; ?>"
                                        title="<?php echo $text_action; ?>"
                                    />
                                    <div class="product__text-dar"><?php echo $text_action; ?></div>
                                </a>
                            </div>
                        <?php } ?>
        
                        </div>
                        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
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
                            <p class="price"><?php if (!$product['special']) { ?><?php echo $text_price; ?> <?php echo $product['price']; ?>
                              <?php } else { ?>
                                <?php echo $text_price; ?> <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                              <?php } ?>
                            </p>
                          </div>
                          <?php } ?>
                          <div class="product__absolute">
                          <div class="product__counter">
                            <button class="product__minus">-</button>
                            <span class="product__count-input">1</span>
                            <button class="product__plus">+</button>
                          </div>
                        <div class="buttons product__block-buttons">
                            <?php if($product['minimum']>1) { ?>
                              <div class="list block">
                              <div class="pproductmi bordformincount">
                              <a class="apadiproduct_m product_min"><span class="textprodm"><?php echo $text_minimum.$product['minimum'];?> шт<span></a>
                              </div>
                              </div>
                            <?php } ?>
                            <?php if ($product['ifexist']!=2) { ?>
                              <div class="button-row">
                                <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                                    <a href="#ordercallback-modal" data-modal="ordercallback-form" class="product__oneclick oneclick">
                                          <?php echo $button_cartone; ?>                      
                                    </a>
                                <?php } ?>
                                <a href="" class="tobasket"><?php echo $button_cart; ?></a>
                              </div>
                            <?php } ?>
                        </div>
                        <?php if(count($attribute_groups) != 0) { ?>
                        <div class="product__attributes"> 
                          <div class="product__attributes-content">
                          <?php foreach ($attribute_groups as $attribute_group) { ?>
                            <div class="product__wrap">
                            <?php 
                              $i = 0; foreach ($product['attributes']['0']['attribute'] as $attribute) { 
                                if ($i != 5) { 
                                  $i++;
                              ?>
                              <span class="attr_name"><?php echo $attribute['name']; ?>:</span>
                                  <?php if( isset($attribute['href'])){ ?>
                                    <span class="attr_text"><a href="<?php echo $attribute['href']; ?>" title="<?php echo $attribute['text']; ?>"><?php echo $attribute['color_atr']?$attribute['color_atr']:$attribute['text']; ?></a></span>
                                  <?php } else { ?>
                                    <span class="attr_text"><?php echo $attribute['color_atr']?$attribute['color_atr']:$attribute['text']; ?></span>
                                  <?php } ?>
                             <?php echo ($i === 4) ? '' : '/'; ?>
                            <?php } } ?>
                          </div>
                          <?php } ?>
                          </div>
                        </div>
                        <?php } else { ?>
                          <div class="product__attributes">
                            <div class="product__attributes-content product__empty-attr"> 
                              <div class="product__wrap"></div>
                            </div>
                          </div>
                        <?php } ?>
                        </div>
                      </div>
                        <?php }
                         
 
                  

                       foreach ($productsOther as $key => $product) {     ?>
                        <div class="product" data-id-product="<?php echo $product['product_id']; ?>">
                                      <div class="product__lable">
                                          <?php if ($product['has_free_delivery']) { ?>
                                            <div
                                                class="product__free-delivery-plate <?php echo ($product['special'] || isset($product['action']) && $product['action']) ? 'with-action' : '' ?>"
                                                data-tooltip="<?php echo $text_freedelivery_paid; ?>"
                                            >
                                            <div class="product__text-delivery"><?php echo $text_free_delivery; ?></div>
                                                <img
                                                    class="free-delivery-icon"
                                                    src="image/ico/favicon_prote_16x16.svg"
                                                    data-original="image/ico/action/free-delivery-action.svg"
                                                    alt="<?php echo $text_free_delivery; ?>"
                                                    title="<?php echo $text_free_delivery; ?>"
                                                />
                                            </div>
                                        <?php } 
                        
                                              if ($product['special'] || !empty($product['action'])) { ?>
                                            <div class="product__dar dar" <?php if(isset($product['action']['short_description'])){ ?> data-tooltip="<?php echo $product['action']['short_description']; ?>" <? } ?> >
                                            
                                              <a <?php //echo 'href="'.$product['action']['url'].'"'; ?> >
                        
                                                    <img
                                                        src="image/ico/favicon_prote_16x16.svg"
                                                        data-original="image/ico/action/label-fire-action.svg"
                                                        alt="<?php echo $text_action; ?>"
                                                        title="<?php echo $text_action; ?>"
                                                    />
                                                    <div class="product__text-dar"><?php echo $text_action; ?></div>
                                                </a>
                                            </div>
                                        <?php } ?>
                        
                                        </div>
                                        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
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
                                            <p class="price"><?php if (!$product['special']) { ?><?php echo $text_price; ?> <?php echo $product['price']; ?>
                                              <?php } else { ?>
                                                <?php echo $text_price; ?> <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                                              <?php } ?>
                                            </p>
                                          </div>
                                          <?php } ?>
                                          <div class="product__absolute">
                                          <div class="product__counter">
                                            <button class="product__minus">-</button>
                                            <span class="product__count-input">1</span>
                                            <button class="product__plus">+</button>
                                          </div>
                                        <div class="buttons product__block-buttons">
                                            <?php if($product['minimum']>1) { ?>
                                              <div class="list block">
                                              <div class="pproductmi bordformincount">
                                              <a class="apadiproduct_m product_min"><span class="textprodm"><?php echo $text_minimum.$product['minimum'];?> шт<span></a>
                                              </div>
                                              </div>
                                            <?php } ?>
                                            <?php if ($product['ifexist']!=2) { ?>
                                              <div class="button-row">
                                                <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                                                    <a href="#ordercallback-modal" data-modal="ordercallback-form" class="product__oneclick oneclick">
                                                          <?php echo $button_cartone; ?>                      
                                                    </a>
                                                <?php } ?>
                                                <a href="" class="tobasket"><?php echo $button_cart; ?></a>
                                              </div>
                                            <?php } ?>
                                        </div>
                                        <?php if(count($attribute_groups) != 0) { ?>
                                        <div class="product__attributes"> 
                                          <div class="product__attributes-content">
                                          <?php foreach ($attribute_groups as $attribute_group) { ?>
                                            <div class="product__wrap">
                                            <?php 
                                              $i = 0; foreach ($product['attributes']['0']['attribute'] as $attribute) { 
                                                if ($i != 5) { 
                                                  $i++;
                                              ?>
                                              <span class="attr_name"><?php echo $attribute['name']; ?>:</span>
                                                  <?php if( isset($attribute['href'])){ ?>
                                                    <span class="attr_text"><a href="<?php echo $attribute['href']; ?>" title="<?php echo $attribute['text']; ?>"><?php echo $attribute['color_atr']?$attribute['color_atr']:$attribute['text']; ?></a></span>
                                                  <?php } else { ?>
                                                    <span class="attr_text"><?php echo $attribute['color_atr']?$attribute['color_atr']:$attribute['text']; ?></span>
                                                  <?php } ?>
                                             <?php echo ($i === 4) ? '' : '/'; ?>
                                            <?php } } ?>
                                          </div>
                                          <?php } ?>
                                          </div>
                                        </div>
                                        <?php } else { ?>
                                          <div class="product__attributes">
                                            <div class="product__attributes-content product__empty-attr"> 
                                              <div class="product__wrap"></div>
                                            </div>
                                          </div>
                                        <?php } ?>
                                        </div>
                                      </div>
                                        <?php }

    }
                                    
                                      
                                    
                                    



?>


