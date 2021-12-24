<?php if (!$this->registry->get('category_ajax')) : ?>
<?php echo $header; ?>
<svg style="display:none;height:0;width:0;">
<style>
@media
.apadiproduct_m {
text-decoration: none; 
width: 210px;
}
.products>div:hover .product_min {
    width: 213px !important;
}
.product:hover .pproductmi {
  position: absolute;
    top: -87px;
    width: 217px;
    border: 1px solid;
    height: 44px;
}
.textprodm{
font-size: 11px;
line-height: 12px;
color: #999999;position: absolute;
   left: 23%;
    bottom: 41%;
}

.product:hover .product__price{
  margin-bottom: 50px;
}
.products>div:hover .product_min {
  width: 218px;
}
@media screen and (max-width: 1268px) {
.product:hover .pproductmi {
    top: -56px;
}
}
@media screen and (max-width: 539px) {
  .products>div:hover .product_min {
    width: 96% !important;
}
.product:hover .pproductmi {
    width: 100% !important;
}
}
@media only screen and (min-width: 1280px) {
  #content {width: calc(100% - 231px) !important;}
}

/* gdemon changes */
#res_filter > div.filter_result > div > div:nth-child(3){
   display:none  !important;
}
@media screen and (max-width: 320px) {
.textprodm {
    font-size: 11px;
    line-height: 12px;
    color: #999999;
    position: absolute;
    left: 18%;
    bottom: 9%;
}
  
}


.breadcrumb{margin-bottom:20px;}
/*#maincontent .row{flex-wrap:nowrap;}*/
#content{flex-basis:auto;width:100%;}res_filter
h1{font-size:23px;color:#00adee;font-weight:normal;display: inline-block;vertical-align: middle;}
.rowh1{justify-content:space-between;align-items: center;margin-bottom:20px;}
</style>
</svg>

<?php if(empty($products)){ ?>
  <?php //шаблон списка категорий ?>
  <?php include_once(DIR_APPLICATION.'view/theme/default/template/product/category_no_products.tpl');?>
<?php } else { ?>
<?php //шаблон списка товаров ?>
<svg style="display:none;height:0;width:0;">
<style>
/*h1{padding-left:15px;}*/
h2{color:#333333;font-size:18px;}
#maincontent #column-left{width: 231px;flex-basis:231px;min-width: 231px;}
.rowh1{border-bottom:1px solid #00adee;}
/*.h1{padding: 5px 0 10px 15px;display:flex;    align-items: center;}
.h1 svg{  width:40px;height:45px;}
.h1 .svg{ display: inline-block;vertical-align: middle;}*/
.faq-block {max-width: 953px; width: 100%;}
.description{font-size:12px;color:#333;line-height:15px;font-family:'Trebuchet MS';}
.description h2{margin:20px 0 10px; font-family: Trebuchet MS;font-style: normal;font-size: 13px;line-height: 16px;color: #000000;font-weight: 700;}
.description p{margin-bottom:10px;}
.description a{color:#00adee;}
.description a:hover{color:#fd9710;}
.description ul{margin-bottom:15px; }
.description li{list-style:disc; margin-left: 30px; list-style: none;}
.sel_filers {position: relative;left: 14px; margin-bottom: 4px !important;}
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/select.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/pagination.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'view/js/tooltip.css'); ?>
.select__gap, .select__gap2{padding-bottom:0;}
.products>div{width:25%;}
.filter{display:none;
background: #fd9710;
padding:12px 12px 11px;
cursor:pointer;
}
.filter_close{display:none;margin-bottom:10px;}
.bf-panel-wrapper{opacity:1;position: relative;left: 5px;}

@media(max-width:1200px){
.products>div{width:33.33%;}
}
@media (max-width:991px){
.products>div{width:50%;}
}
@media (max-width:1279px){
  #column-left{display:flex;flex-wrap: wrap;flex-direction: column;}
  .filter{display:block; position: absolute; top: 5px;right: 0; }
  .rowh1{align-items:flex-start;position: relative;}
  .h1{margin-right: 50px;padding-left:0;}
  .h1 h1{font-size:19px;}
  .mcont{align-items:center;}
  .filter_close{display:block;font-size:20px;color:#FD9710;position:relative;text-align:center;cursor:pointer;}
  .filter_close:before,.filter_close:after{content:'';width:20px;height:2px;background:#FD9710;position:absolute;transform: rotate(-45deg);
    transition: transform 2s;left:30px;top:10px;}
  .filter_close:after{transform: rotate(45deg);
    transition: transform 2s;}
  .bf-panel-wrapper{opacity:0;height:0;}
  .bf-panel-wrapper.open{opacity:1;height:100%;order:-10;}
  .bf-attr-block{height:0;}
  .bf-panel-wrapper.open .bf-attr-block{height:100%;}
  #maincontent #column-left{flex-basis:auto;}
  .filter_result{flex-direction:column;}
}
@media (max-width:575px){
.products>div{width:50%;}
.select__gap, .select__gap2{margin-top:0;}
}

.ico_attr{position: absolute; bottom:0; left: 23px; }
.ico_attr .ico{width: 64px; height: 64px; background: #A1E0EA; border-radius: 100%; padding: 8px 5px; text-align:center; }
.ico_attr .ico+.ico{margin-left: 8px; }
.ico_attr .ico img {width: 27px;margin-bottom: 6px;}
.ico_attr .ico div{line-height: 7px; color:#fff; font-size: 6px; }
.ico.attr_17873{padding-top: 10px; }
.ico.attr_17873 img{margin-bottom: 3px; }
.ico.attr_17870,.ico.attr_17867{background: #FD9710; }
.ico.attr_17867 img{width: 30px; margin-bottom: 3px; }
.ico.attr_17870 img{width: 21px; margin-bottom: 2px; }

.free-delivery-plate {position:absolute;right:8px;top:4px;width:70px;height:70px;z-index:5;}
.free-delivery-plate.with-action {top: 80px;}

@media (min-width: 320px) and (max-width: 539px) {
  .breadcrumb {
    margin-left: 15px;
  }
  .pagination li {
    width: 40px;
    margin-bottom: 10px;
  }
  #showall {
    margin-bottom: 20px;
    margin-top: 12px;
    margin-right: -12px;
  }
  #brainyfilter-product-container .bottom_row {
    margin: 40px 0 50px;
  }
  .pagination .next {width: auto; display: inline-block;}
  .description, .faq-block, .cityes {display: none;}
}
@media (min-width: 540px) and (max-width: 719px) {
  .bottom_row {width: 350px;margin: 0 auto;margin-bottom: 28px;margin-top: 22px;}
  #paginate {
    width: 100%;
    margin-bottom: 18px;
  }
  .catalog__more-select .select__gap {
    left: 24px;
  }
  .pagination li {
    width: 40px;
  }
  .pagination .next {width: auto;}
  #showall {
    margin-bottom: 20px;
    margin-top: 12px;
    margin-right: 38px;
  }
}

@media (min-width: 720px) and (max-width: 995px) {
  .breadcrumb {
    margin-left: 12px;
  }
}
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/products-catalog.css');?>
</style>
</svg>
<script>
  $(function() {
    simple_tooltip(".product__free-delivery-plate","tooltip");
    simple_tooltip(".product__dar","tooltip");
    toggleBtnPrint();
    $(window).resize(function() {
        toggleBtnPrint();
    });
  function toggleBtnPrint(){
    if($(document).width() >= 320 && $(document).width() <= 1279) {
      if($('.catalog-selbyprinter')[0]) {
        $('.catalog-header__btn-print').css({'visibility' : 'visible', 'display' : 'inherit'}) 
          } else {
        $('.catalog-header__btn-print').css({'visibility' : 'hidden', 'display' : 'none'}) 
      }
    } else {
      $('.catalog-header__btn-print').css({'visibility' : 'hidden',  'display' : 'none'}) 
    }
  }
  $('.product__minus').click(function(e) {
    minus(e.target);
  });
  $('.product__plus').click(function(e) {
    plus(e.target);
  });
  $('.tobasket').click(function(e) {
    e.preventDefault();
    $idProduct = $(e.target).closest('.product').data('id-product');
    let countInput = $(e.target).closest('.product').find('.product__count-input')[0];
    cart.add($idProduct, countInput.innerHTML);
  });

  $('.product__oneclick').click(function(e) {
    e.preventDefault();
    let product = $(e.target).closest('.product');
    $idProduct = $(e.target).closest('.product').data('id-product');
    let countInput = $(e.target).closest('.product').find('.product__count-input')[0];
    let img = product.find('.image img').data('original');
    console.log(img);
    let productTitle = product.find('.product__ndesc .name')[0].innerHTML;
    console.log(productTitle);
    let price = product.find('.price')[0].innerHTML;
    ordercallback_modal_show($idProduct, img, productTitle, price.match(/((?:\d|\,)*\.?\d+)/g), countInput.innerHTML);
  });
});
  function minus(el) {
    let countInput = $(el).siblings('.product__count-input');
      if(parseInt(countInput.text()) > 1) {
          countInput.text(parseInt(countInput.text()) - 1);
      }
  }
  function plus(el) {
    let countInput = $(el).siblings('.product__count-input');
      if(parseInt(countInput.text()) >= 1) {
          countInput.text(parseInt(countInput.text()) + 1);
      }
  }

  function showSelbyprinter() {
    $('.modal-selbyprinter').show();
  }
  function closeSelbyprinter() {
    $('.modal-selbyprinter').hide();
  }

  function showFilter() {
      $('#column-left').show();
      $('#column-left').addClass('modal-filter');
      $('.bf-panel-wrapper').addClass('modal-filter__content');
      $('.modal-filter__close').show();   
      $('.filter').addClass('open');
      $('.filter_close').addClass('open');
      $('.bf-panel-wrapper').addClass('open');
      $('.megaprod').show();
  }

  function closeFilter() {
    $('#column-left').removeClass('modal-filter');
      $('.bf-panel-wrapper').css({opacity: 0, height: 0});
      $('.bf-panel-wrapper').removeClass('modal-filter__content');
      $('.modal-filter__close').hide();
      $('.filter').removeClass('open');
      $('.filter_close').removeClass('open');
      $('.bf-panel-wrapper').removeClass('open');
      $('.megaprod').hide();
  }

  $(document).ready(function() {
    $('.modal-selbyprinter').appendTo('body');
    $('.catalog-header__btn-print').click(function() {
      showSelbyprinter();
    });

    $('.modal-selbyprinter__close').click(function () {
      closeSelbyprinter();
    });
    $('.catalog-header__btn-filter').click(function() {
      showFilter();
    });

    $('.modal-filter__close').click(function () {
      closeFilter();
    });
});
</script>
<div id="maincontent" class="container">
  <div class="row">
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
  </div>     
  <div class="catalog-header row rowh1">
  <div class="catalog-header-group">
    <div class="catalog-header__title">
      <?php echo file_get_contents(DIR_IMAGE.'/ico/c-uni-icon.svg');?>
        <h1><?php echo $heading_title; ?></h1>
    </div>
    <div class="catalog-header__print-filter-block">
      <button class="catalog-header__btn-print">
        <?php echo file_get_contents(DIR_APPLICATION . 'view/theme/default/image/icons/printer-pidbir.svg');?>
        <span><?php echo $selection_by_device; ?></span>
      </button>
      <button class="catalog-header__btn-filter"><?php echo $text_filter; ?></button>
    </div>
  </div>
  <div class="catalog-filter__line2"></div>
    <div class="catalog-filter">
      <!--<div class="filter"><img src="image/ico/filter/filter.svg" alt="filter" title="filter" ></div> -->
      <div class="catalog-filter__sort sort">
        <select id="input-sort" class="catalog-filter__select sel" data-text="<?php echo $text_sort; ?>" onchange="location = this.value;">
          <?php foreach ($sorts as $sorts) { ?>
          <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
          <option value="<?php echo $sorts['href']; ?>" data-txt="<?php echo $sorts['value']; ?>===<?php echo $sort . '-' . $order; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
          <?php } else { ?>
          <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
          <?php } ?>
          <?php } ?>
        </select>
       </div>
       <a class="catalog-filter__btn-reset bf-btn-reset1" onclick="$('.bf-btn-reset').click();"><?php echo $button_clear; ?></a>
    </div>
    <div class="catalog-filter__line"></div>
    <div id="res_filter" class="catalog-filter__res"></div>
  </div>
  <div class="row mcont">

    <?php if ($interlink) { ?>
        <svg style="display:none;height:0;width:0;">
        <style>
          .megaprod {padding-top:15px;border-top:1px solid #252525;margin-top:25px;}
          .megaprod .box-heading{background:#bee9f9;line-height:40px;color:#333;font-family:'Trebuchet MS';font-weight:bold;font-size:16px;position:relative;padding:0 0 0 50px;margin-bottom:15px;}
          .megaprod .svg{position:absolute;top:7px;left:11px;}
          .megaprod li a{padding-left:4px;color:#999;font-size:13px;font-family:'Trebuchet MS';text-decoration:none;line-height:22px;display:block;}
          .megaprod li a:hover{color:#333;text-decoration:underline;}
        </style>
          </svg>
            <?php

            $interlinks='<div class="megaprod"><div class="box-heading"><span class="svg">'. file_get_contents(DIR_IMAGE.'/ico/popular-products.svg').'</span>'. $text_populairprod . '</div><div class="box-content">' . $interlink . '</div></div>';
            $column_left = str_replace('</aside>', $interlinks . "</aside>", $column_left);
    } ?>
    <?php echo $column_left; ?>
    <div id="content" class="container">
    <?php if(!empty($recommendationCategoires)) { ?>
      <div class="catalog-recommendation">
        <div class="catalog-recommendation__h1-block">
          <div class="catalog-recommendation__h1"><?php echo $text_show_others; ?>:</div>
        </div>
        <div class="catalog-recommendation__content">
          <?php foreach($recommendationCategoires as $category) { ?>
          <div class="catalog-recommendation__card">
            <img src="<?php echo $category['image']; ?>" class="catalog-recommendation__img"></img>
            <a class="catalog-recommendation__title" href="<?php echo $category['link']; ?>"><?php echo $category['name']; ?></a>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
      <?php echo $content_top; ?>
      <div id="res_filter2" class="category-filter__res"></div>

		  <div id="brainyfilter-product-container" >
        <div id="brainyfilter-product-header"  data-h1="<?php echo $heading_title; ?>"></div>


		  <?php endif; ?>
		  <div id="brainyfilter-product-container">
		  
      <?php if ($products) { ?>
      <div class="row">
        <div class="products" id="prodlines">
        
 <?php
require_once('/var/www/prote/data/www/prote.ua/dist/category.php');
?>        
          

                

 <?php
 if($specialmon == 0){
  foreach ($products as $key => $product) { ?>
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
                <?php }} ?>



        </div>

      </div>

      <div class="row bottom_row">
        <div id="paginate"><?php echo $pagination; ?></div>
        <select id="input-limit" class="sel" data-text="<?php echo $text_limit; ?>" onchange="location = this.value;">
          <?php foreach ($limits as $limits) { ?>
          <?php if ($limits['value'] == $limit) { ?>
          <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
          <?php } else { ?>
          <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
          <?php } ?>
          <?php } ?>
        </select>

        <? if ($page==1) { ?>
          <?php if (count($products)>=$limit) { ?>
              <script>
                var curp=1;
                var eol =0;
                var count_pages = <?php echo $count_pages; ?>;
                function addPage() {
                    if (eol==1) return false;
                    if (curp>=count_pages) return false;
                    window.onscroll = null;
                    $('#prodlines').append('<div class="preload"><img src="image/ico/loading.svg"></div>');
                    $.ajax({
                        type: "GET",
                        url: window.location,
                        data: { page: ++window.curp },
                        async: true,
                        success: function(data) {
                            if (!$(data).find('#prodlines').html()) {
                              window.eol=1
                            } else {
                               a=$('#prodlines')
                               b=$(data).find('#prodlines').html();
                               /*if (a.find('.product-layout').first().hasClass('product-grid')) {
                                  b=b.replace(/product-list/g,'product-grid col-lg-4 col-md-4 col-sm-6' )
                               } */
                               $('#prodlines').append(b);
                               $('#paginate').css( "display", "none");
                               $('#paginate li').each(function(i,e) {
                                   if ($(e).html().indexOf('page='+window.curp)>0 && $(e).html().indexOf('forward')==-1) {
                                      $(e).html('<span>'+window.curp+'</span>')
                                      $(e).addClass('active');
                                   }
                                   window.onscroll =  vverh;
                                });
                                $('img[src="image/ico/favicon_prote_16x16.svg"]').lazyload({
                                     threshold : 500,
                                     skip_invisible:false,
                                    effect : "fadeIn"
                                });
                                $(window).scrollTop($(window).scrollTop()+1);
                                $(window).scrollTop($(window).scrollTop()-1);
                             }
                             $('.preload').remove();
                             $('#showall').hide()
                        }
                    });
                    return false;
                }
                function vverh(event) {
                  if ((window.pageYOffset)>($('.description').offset().top-$( window ).height())) {
                      event.preventDefault();
                      addPage();
                  }

                }
              </script>
            <div class="row" style="margin-bottom: 20px;" id="showall">
              <div class="col-sm-12 text-center">
                 <button class="button" onclick="addPage(); return false;"><?php echo $text_show_more; ?></button>
              </div>
            </div>
        <?php } ?>
        <? } ?>

      </div>

      <div class="description">
        <?php echo $description; ?>
      </div>
        <?php if(!empty($questions)){ ?>
        <style>
            .faq-block__title {font-size: 20px; padding-top:30px; }
            .faq-block__question {cursor:pointer;}
            .faq-block .icon-chevron-down {position: absolute; top: 9px; right: 4px; color: #e95d2a; font-size: 9px; -webkit-transform: scaleY(1); transform: scaleY(1); -webkit-transition: .2s; transition: .2s; }
            .faq-block .icon-chevron-down:after {content: ''; position: absolute; top: 0; right: 9px; width: 8px; height: 8px; border-top: 1px solid; border-right: 1px solid; -webkit-transform: rotate(135deg); -moz-transform: rotate(135deg); -ms-transform: rotate(135deg); -o-transform: rotate(135deg); transform: rotate(135deg); }
            .faq-block__item .open .icon-chevron-down:after {-webkit-transform: rotate(-45deg); -moz-transform: rotate(-45deg); -ms-transform: rotate(-45deg); -o-transform: rotate(-45deg); transform: rotate(-45deg); }
            .faq-block .faq-block__item {margin-top: 20px; position:relative; width: 100%;}
            .acceptedAnswer{display:none;}
            .faq-block__answer a{color: #e95d2a; text-decoration: underline;}
            .faq-block__answer a:hover{color: #00aff2; text-decoration: none;}
        </style>
        <div class="faq-block" itemscope="" itemtype="https://schema.org/FAQPage">
            <h2 class="faq-block__title"><?php echo $text_question ?> <?php echo mb_strtolower($heading_title); ?></h2>
            <?php foreach($questions as $question) { ?>
            <div class="faq-block__item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="faq-block__question" itemprop="name"><?php echo $question['name'] ?><i class="icon icon-chevron-down"></i></h3>
                <div itemscope="" itemprop="acceptedAnswer" class="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="faq-block__answer" itemprop="text">
                        <?php echo $question['text'] ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <script>
            $('.faq-block__question').on('click',function(){
                $(this).toggleClass('open');
                $(this).next().slideToggle();
            });
        </script>
        <?php } ?>
      <svg style="display:none;height:0;width:0;">
      <style>
          .cityes{padding-top:40px; margin-bottom: 48px; max-width: 940px;}
          .cityes .title{font-family:'Trebuchet MS';font-size:18px;color:#333;margin-bottom: 12px;font-weight:bold;padding-top: 4px;}
          .cityes .cont{color:#999999;line-height: 18px;margin-bottom: 18px;}
          .cityes .cont a {color:#00aeef;font-family: 'Trebuchet MS';font-size: 14px;}
          .cityes .cont a:hover {color:#999999;}
      </style>
      </svg>

      <div class="cityes">
          <div class="title"><?php echo $text_delivery_city;?></div>
          <div class="cont">
              <?php foreach($cityes as $key => $city){ ?>
                  <a href="<?php echo $city['href']?>" title="<?php echo $city['name']?>"><?php echo $city['name']?></a><?php if(count($cityes)!=$key+1){ ?>&nbsp;| <?php } ?>
              <?php } ?>
          </div>
      </div>
      <? if ($page==1 && isset($description)) { ?>

      <? } ?>
      <?php } ?>

      <?php if (!$categories && !$products) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary btn-blue-shadow"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
		  </div>


		  </div>
		  <?php if (!$this->registry->get('category_ajax')) : ?>
		  
      <?php echo $content_bottom; ?></div>
      <?php echo $column_right; ?></div>
      </div>
<script>
$(document).ready(function(){
$('.sel').each(function() {
  var $this = $(this),
    selectOption = $this.find('option'),
    selectOptionLength = selectOption.length,
    //selectedOption = selectOption.filter(':selected'),
    dur = 150;
    pr=$this.data('text');
  $this.hide();
  $this.wrap('<div class="select catalog__more-select"></div>');
  $('<div>', {
    class: 'select__gap',
    text: pr
  }).insertAfter($this);

  var selectGap = $this.next('.select__gap'),
    caret = selectGap.find('.caret');
  $('<ul>', {
    class: 'select__list'
  }).insertAfter(selectGap);

  var selectList = selectGap.next('.select__list');
  // Add li - option items
  for (var i = 0; i < selectOptionLength; i++) {

    cl='';
    if(selectOption.eq(i).attr('selected')){
      cl=' selected';
      selectGap.text(pr+' '+selectOption.eq(i).text().toLowerCase());

    }

    $('<li>', {
        class: 'select__item'+cl,
        html: $('<span>', {
          text: selectOption.eq(i).text()
        })
      })
      .attr('data-value', selectOption.eq(i).val())
      .appendTo(selectList);
  }
  var selectItem = selectList.find('li');

  selectList.slideUp(0);
  selectGap.on('click', function() {
    if (!$(this).hasClass('on')) {
      $(this).addClass('on');

      selectList.slideDown(dur);

      selectItem.on('click', function() {
        var chooseItem = $(this).data('value');
        $('.select__item').removeClass('selected');
        $(this).addClass('selected');
        $('select').val(chooseItem).attr('selected', 'selected')
        pr=$this.data('text');
        selectGap.text(pr+' '+$(this).find('span').text().toLowerCase());
        //$('.select__gap').
        selectList.slideUp(dur);
        selectGap.removeClass('on');

        $this.change();
      });

    } else {
      $(this).removeClass('on');
      selectList.slideUp(dur);
    }
  });
});
});
</script>
<?php include_once(DIR_APPLICATION.'view/theme/default/template/module/ordercallback_modal.tpl');?>
<script>
$(document).ready(function(){
$('.filter, .filter_close').on('click',function(){
  if($(this).hasClass('open')) {
    $('.filter').removeClass('open');
    $('.filter_close').removeClass('open');
    $('.bf-panel-wrapper').removeClass('open');
  }else{
    $('.filter').addClass('open');
    $('.filter_close').addClass('open');
    $('.bf-panel-wrapper').addClass('open');
  }
});
<?php if($products) { ?>
$(document).ready(function(){
gtag('event', 'view_item_list', {"items": [
<?php foreach ($products as $key => $product) { ?>
{"id": "<?php echo $product['model']; ?>","name": "<?php echo str_replace('"','\"',$product['name']); ?>","list": "<?php echo $breadcrumb['text']; ?>" ,"category": "<?php echo $breadcrumb['text']; ?>","list_position":'<?php echo $key+1; ?>',"quantity": 1,"price": <?php echo $product['price_float']; ?> }<?php if(count($products) > $key+1){?>,<?php } ?>
<?php } ?>
]
}) ;
simple_tooltip(".dar, .free-delivery-plate","tooltip");
}) ;
<?php } ?>
});
</script>
<?php echo $popupcart; ?>
<?php } ?>
<?php echo $footer; ?>
<?php endif; ?>
