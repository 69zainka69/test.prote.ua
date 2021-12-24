<?php echo $header; ?>
<style>
.price{
  position: absolute;
    bottom: 50px;
    left: 30%;
}
.dar{
  position: absolute;
    right: 11px;
}
h1{font-size:23px;color:#00adee;font-weight:normal;display:block;margin-bottom:20px;font-family:'Open Sans',sans-serif;    line-height:28px;}
#content{width:100%;}
.desсription{display:flex;flex-direction:row;margin-bottom:30px;justify-content:space-between;}
.desсription a{color:#00adee;}
.desсription a:hover{color:#fd9710;}
.desc{margin-right:3%;color:#999999;font-size:13px;font-family:'Trebuchet MS';line-height:17px;}
.title {color:#00adee;font-size:17px;position:relative;padding:11px 0 13px 39px;border-bottom:3px solid #00aff2;}
.title h3{font-weight:400;font-size:13px;}
.title span.svg{position:absolute;left:0;top:4px;}
.title span.svg path{fill:#00adee;}
h2{font-weight:400;font-size:17px;display:block;padding-top:20px;color:#00adee;}
.products.hidden{display:none;}
.products .more{margin-top;display:flex;justify-content: center;width:100%;margin-top:20px;}
.products .more:hover{border-color:#fff;}
.moreproduct{margin-bottom:10px;cursor:pointer;display:inline-block;padding:10px 20px;}
/*#content a{color:#fd9710;}*/
.desсription img{max-width:100%;}
.thumb{min-width:400px;}
@media (max-width: 992px) {
.desсription{flex-direction:column-reverse;}
}
.desсription p{padding:0 0 5px 0;}
.buttons {
    padding-top: 27px !important;
}
@media (max-width:575px){
#content{margin:0 10px;}
.thumb{max-width:100%;min-width:auto;}
}
.dcateg{
  display: flex;
  flex-wrap: wrap;
}
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/products.css');?>
</style>
<div class="container">
  <ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
    <?php $k=0; foreach ($breadcrumbs as $breadcrumb) { ?>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <?php if ($k<count($breadcrumbs)-1) { ?> 
           <a itemprop="item" href="<?php echo $breadcrumb['href']; ?>"><span itemprop="name"><?php echo $breadcrumb['text']; ?></span></a>
        <?php } else { ?>          
          <a itemprop="item" onclick="return false;" href="<?php echo $breadcrumb['href']; ?>" style="cursor:default;">
              <span itemprop="name" id="lastbreadcrumb"><?php echo $breadcrumb['text']; ?></span>
            </a>
        <?php } ?>
          <meta itemprop="position" content="<?=++$k?>">
    </li>
    <?php } ?>
  </ul>
  <div class="row"><?php //echo $column_left; ?>
    
    <div id="content"><?php //echo $content_top; ?>
      <div class="desсription">
        <div class="desc">
          <h1><?php echo $heading_title; ?></h1>
          <div class=""><?php echo $description; ?></div>
        </div>
        <?php if ($image) { ?>
        <div class="thumb">
           <img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $image; ?>" alt="<?php echo $heading_title; ?>" /> 
        </div>
        <?php } ?>

      </div>
    
          <?php if ($products) { ?>
            <div class="title">
                <span class="svg action"><?php echo file_get_contents(DIR_IMAGE.'/ico/06-action.svg');?></span>
                <h3><?=$text_related?></h3>
            </div>
          
              <div class="">
              <?php foreach ($products as $key => $category) { ?>
                <div class="dcateg">
                  <?php if(isset($category[0]['category_name'])){ ?>
                  <div class="category_name"><h2><?php echo $category[0]['category_name']; ?></h2></div>
                  <?php } ?>
                  <?php $count=0; ?>    
                  <?php $count_tmp=0; ?>    
                    
                    <div class="products">
                      <?php foreach ($category as $product) { ?>
                      
                      <?php $count_tpm=$count-1; ?>
                      <?php if($count && $count_tpm && $count%10==0) {?>
                        <div class="more">
                          <div class="button moreproduct" onclick="prod_show(this);"><?php echo $txt_more_products; ?></div>
                        </div>
                    </div>
                    <div class="products hidden">
                        <?php } ?>
                        
                        <?php $count++; ?>
                        <div class="product<?php if($product['ifexist']==3) { ?> non<?php } ?>" data-tmp="<?php echo $count%10; ?>">
                          <?php if ($product['special']) { ?>
                            <div class="dar">
                            <img src="image/ico/favicon_prote_16x16.svg" data-original="image/ico/action/label-fire-action.svg"  alt="<?php echo $text_action; ?>" title="<?php echo $text_action; ?>"/>
                            <div><?php echo $text_action; ?></div>
                            </div>
                          <?php } ?>
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
              <?php } ?>
              </div>
          <?php } ?>
    <?php //echo $content_bottom; ?></div>
    <?php //echo $column_right; ?></div>
</div>
<?php include_once ('/var/www/prote/data/www/prote.ua/catalog/view/theme/default/template/module/ordercallback_modal.tpl'); ?>
<script>
function prod_show(t){
  $(t).slideToggle();
  ob =$(t).parent().parent().next();
  ob.slideToggle('fast').css('display','flex');
  var target = ob;
    target = target.length ? target:'';
    if (ob) {
        $('html,body').animate({
          scrollTop: ob.offset().top
        }, 1000);
        return false;
    }
  ob.toggleClass('hidden');
  
  //$(window).scrollTop($(window).scrollTop()+1);
  //$(window).scrollTop($(window).scrollTop()-1);
}
</script>
<script>
$(document).ready(function() {
<?php if($products) { ?>
gtag('event', 'view_item_list', {"items": [
<?php foreach ($products as $key => $product) { ?>
{"id": "<?php echo $product['model']; ?>","name": "<?php echo $product['name']; ?>","list": "<?php echo $breadcrumb['text']; ?>" ,"category": "<?php echo $breadcrumb['text']; ?>","list_position": <?php echo $key+1; ?>,
"quantity": 1,"price": '<?php echo $product['price_float']; ?>' }

<?php if(count($products) != $key+1){?>,<?php } ?>

<?php } ?>
]
});
<?php } ?>
});
</script>
<?php echo $footer; ?> 