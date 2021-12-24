<!-- start compability -->
<style>
/* #tab-compability{padding-left:0;height:400px;margin-top:50px;padding-top: 0;} */
#compabilities .panel{color:#999;font-size:10px;padding-right:10px;}
.panel-title{font-family:'Trebuchet MS';line-height:16px;color:#00aff2;font-size:20px;margin:20px 0 5px;}
#compabilities .text{line-height:17px;}
/*#compabilities a{color:#999;}*/
@media (min-width: 1230px){
#compabilities .panel{flex: 1 1 0;}
}
/*@media (max-width: 1230px){
  #compabilities .panel{width: 50%;}
}*/
@media (max-width:991px){
  #compabilities{flex-wrap:wrap;}
}
</style>
    <?php $count =0; ?>
    <?php // print_r ($productsCompability); ?>
    
    <?php 
        $compcodes = array(
            '_INK_rec_' => array('h'=>$text_inkrec, 'l'=>1),
            '_C' => array('h'=>$text_cartcom, 'l'=>1),
            '_P' => array('h'=>$text_prncom, 'l'=>0),
            '_T' => array('h'=>$text_toncom, 'l'=>0),
            //'_CIR' => array('h'=>$text_circom, 'l'=>1),
            '_INK' => array('h'=>$text_inkcom, 'l'=>1),
        );
    ?>

    <?php if (0) { ?>
    <div class="panel-group" id="compabilities">
        <?php foreach($compcodes as $code=>$params) { $count++;?>
            <?php if (isset($productsCompability[$code])) { ?>
                <?php $a=array(); ?>
                <?php foreach($productsCompability[$code] as $pcItem) {
                   //$a[] =$pcItem['name'];
                   $list[] = '<a href="'.$pcItem['href'].'" title="'.$pcItem['name'].'">'.$pcItem['name'].'</a>';
                } ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"><?=$params['h'];?></div>
                    </div>
                </div>
                <div id="collapse<?php echo $code;?>" class="text"><?php echo implode(', ', $list);?></div>                        
            <?php } ?>
        <?php } ?>
    </div>
    <?php } else  { ?>
    
    <div class="panel-group" id="compabilities">
        <?php if (isset($productsCompability['_INK_rec_'])) { $count++;?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title"><?=$text_inkrec;?></div>
                </div>
                <div id="collapse1" class="text">            
                    <?php foreach($productsCompability['_INK_rec_'] as $pcItem) { ?>
                        <?php $pcItem['name']=str_replace(array('ЧЕРНИЛА ', 'ЧОРНИЛА '), '', $pcItem['name']); ?>
                        <?=$pcItem['name'];?>&nbsp;
                        <?php if ($pcItem['color_code'] && strpos($pcItem['color_code'], ',')===FALSE) { ?>
                           <div class="icolor" style="background-color:<?=$pcItem['color_code'];?>" title="<?=$pcItem['color'];?>"></div>
                        <?php } else { ?>
                        [<?=$pcItem['color'];?>]
                        <?php } ?>

                    <?php } ?>
                </div>
            </div>
        <?php } ?>
       
        
        <?php if (isset($productsCompability['_C'])) { $count++; ?>
            <?php $a=array(); ?>


            <div class="row1 reatured">
                <div class="featured_title"><?=$text_cartcom;?></div>

                <div class="" style="max-width: 100%;">
                    <div class="swiper-viewport">
                        <div id="slideshow_C" class="swiper-container">
                            <div class="swiper-wrapper">

            <?php foreach($productsCompability['_C'] as $product) { ?>

                <?php $product['name']=str_replace(array('КАРТРИДЖ '), '', $product['name']); ?>
                <?php $list[] = '<a href="'.$product['href'].'" title="'.$product['name'].'">'.$product['name'].'</a>'; ?>
            
                                
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
                                            <?php if ($product['ifexist']!=2) { ?>
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
                        <div class="swiper-pagination slideshow0"></div>
                        <div class="swiper-pager">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
              $('#slideshow_C').swiper({
                mode:'horizontal',
                slidesPerView:5,
                nextButton:'.swiper-button-next',
                prevButton:'.swiper-button-prev',
                spaceBetween:0,
                autoplay:4000,
                autoplayDisableOnInteraction:true,
                //loop:true,
                lazy: true,
                autoplay:4000,
                breakpoints: {
                  576: {
                      slidesPerView: 1,
                      spaceBetween: 8
                  },
                  768: {
                      //slidesPerView: 'auto',
                      slidesPerView: 2,
                      spaceBetween: 8
                  },
                  991: {
                      slidesPerView: 3//,
                      //spaceBetween: 30
                  },
                  1299: {
                      slidesPerView: 4//,
                      //spaceBetween: 30
                  }
                },
                onSlideChangeStart: function () {
                    $(window).scrollTop($(window).scrollTop()-1);
                    $(window).scrollTop($(window).scrollTop()+1);
                }
            });
            </script>

            <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="panel-title" data-p="_C"><?=$text_cartcom;?></div>
              </div>
              <div id="collapse2" class="text"><?php echo '' . implode(', ', $list);?></div>
            </div>

        <?php } ?>

        <?php if (isset($productsCompability['_P'])) { $count++; ?>
            <?php $a=array(); ?>
            <?php $list=array(); ?>
            <?php foreach($productsCompability['_P'] as $pcItem) {
               // $pcItem['name']=str_replace(array('ПРИНТЕР ', 'МФУ ', 'БФП ', 'СТРУЙНЫЙ ', 'СТРУМЕНЕВИЙ ', 'ЛАЗЕРНЫЙ ', 'ЛАЗЕРНИЙ '), '', $pcItem['name']);
               //$a[] =$pcItem['name'];
               $list[] = '<a href="'.$pcItem['href'].'" title="'.$pcItem['name'].'">'.$pcItem['name'].'</a>';
            } ?>


            <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="panel-title" data-p="_P"><?=$text_prncom;?></div>
              </div>
              <div id="collapse3" class="text"><?php echo '' . implode(', ', $list);?></div>
            </div>
          
        <?php } ?>
        
        <?php if (isset($productsCompability['_T'])) { $count++; ?>

            <?php $a=array(); ?>
            <?php $list=array(); ?>
            <?php foreach($productsCompability['_T'] as $pcItem) {
               // $pcItem['name']=str_replace(array('ПРИНТЕР ', 'МФУ ', 'БФП ', 'СТРУЙНЫЙ ', 'СТРУМЕНЕВИЙ ', 'ЛАЗЕРНЫЙ ', 'ЛАЗЕРНИЙ '), '', $pcItem['name']);
               //$a[] =$pcItem['name'];
               $list[] = '<a href="'.$pcItem['href'].'" title="'.$pcItem['name'].'">'.$pcItem['name'].'</a>';
            } ?>

            <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="panel-title"><?=$text_toncom;?></div>
              </div>
              <div id="collapse3a" class="text ty"><?php echo '' . implode(', ', $list);?></div>
            </div>

        <?php } ?>
        
    
        <?php if (isset($productsCompability['_INK'])) { $count++; ?>
            <?php $a=array(); ?>
            <?php $list=array(); ?>
            <?php foreach($productsCompability['_INK'] as $pcItem) {
               // $pcItem['name']=str_replace(array('ЧЕРНИЛА ', 'ЧОРНИЛА '), '', $pcItem['name']);
               // $a[] ="<a href='" . $pcItem['href'] . "'>" . $pcItem['name'] . "</a>";
               //$a[] = $pcItem['name'];
               $list[] = '<a href="'.$pcItem['href'].'" title="'.$pcItem['name'].'">'.$pcItem['name'].'</a>';
            } ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="panel-title"><?=$text_inkcom;?></div>
              </div>
              <div id="collapse5" class="text"><?php echo '' . implode(', ', $list);?></div>
            </div>
        <?php } ?>

   </div>
    <?php } ?>
<!--  end compability -->
