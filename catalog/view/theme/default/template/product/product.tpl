

<?php echo $header; ?>
<div class="container">
  <div class="row">
  <ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
    <?php $breadcrumbs_text ='';?>
    <?php $k=0; foreach ($breadcrumbs as $breadcrumb) { ?>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <?php if ($k<count($breadcrumbs)-1) { ?>
          <?php if ($k>0) { ?>
            <?php if ($k<count($breadcrumbs)-2) { ?>
              <?php $breadcrumbs_text .= $breadcrumb['text'].' > '; ?>
            <?php } else { ?>
              <?php $breadcrumbs_text .= $breadcrumb['text']; ?>
            <?php } ?>
          <?php } ?>
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
  <?php $last_breadcraumb = end($breadcrumbs); ?>
  <script type="application/ld+json">{
    "@context": "https://schema.org/", "@type": "Product",
    "name": "<?php echo str_replace('"','\"',$heading_title); ?>",
    "image": "<?php echo $popup; ?>",
    "description": "<?php echo str_replace('"','\"',strip_tags(strip_tags($description)<>'' ? $description : ($ax_description<>'' ? $ax_description: $tag))); ?>",
     "mpn": "<?php echo $sku; ?>",
     "sku": "<?php echo $sku; ?>",
     <?php if($brand){ ?> "brand":"<?php echo $brand['text']; ?>", <?php } ?>
     <?php if($reviewss){ ?> "review":[
     <?php foreach($reviewss as $key => $review){ ?> {
       "@type": "Review",
       "author": {
       "@type": "Person",
        "name": "<?php echo $review['author']; ?>"},
        "datePublished": "<?php echo $review['date_added']; ?>",
         "reviewBody": "<?php echo $review['text']; ?>",
         "reviewRating": {
           "@type": "Rating",
           "bestRating": "5",
           "ratingValue": "<?php echo $review['rating']; ?>",
           "worstRating": "1"
         }
       }<?php if(count($reviewss)!=$key+1){?> ,<?php } ?> <?php } //break; } ?> ],
        <?php } ?> <?php if ((int)$reviews) { ?> "aggregateRating": {
        "@type": "AggregateRating", "ratingValue": <?php echo $rating; ?>,
        "reviewCount": <?php echo (int)$reviews; ?>,
        "bestRating": "5",
        "worstRating": "1"},
        <?php } ?> "offers": {
        "@type": "Offer", "price": "<?php echo floatval(str_replace(" ", "", $price)); ?>",
         "priceCurrency": "UAH",
         "priceValidUntil": "<?php echo date('Y-m-d', strtotime('+7 days')); ?>",
          "itemCondition": "https://schema.org/NewCondition",
          "availability": "<?php echo $availability; ?>",
          "url": "<?php echo $last_breadcraumb['href']; ?>",
           "seller": {"@type": "Organization", "name": "prote.ua"} } }
  </script>
<svg style="display:none;height:0;width:0;">
<style>
.featured_title .titlefeatur{
  font-size: 22px !important;
  color:black !important;
}
.featured_title{
  padding-top: 19px !important;
    padding-left: 65px !important;
      width: 1540px !important;
height: 60px !important;
color:black !important;
background: #BEE9F9 !important;
border-radius: 5px !important;
    }
.price{
  padding-bottom:15px;
  text-align: center !important;
}
.buttons {
    flex-direction: column !important;
    }
.product .ifexist, .product .ifwait {
    
    padding-top: 20px;
    }
.swiper-viewport {
    opacity: 1 !important;
}
.swiper-button-next{
display:none !important;
}
.swiper-button-prev{
  display:none !important;
}
.leftprice{
  text-align:left !important;
}
.product .buttons .button-row {
   
    justify-content: center;
}
h1{color:#00adee;font-size:24px;line-height:36px;margin:10px 0;font-weight:normal;} h2{line-height:31px;} #content{margin-bottom:30px;display:flex;flex-wrap:nowrap;} .prod_left{width:65%;display:flex;} .prod_right{width:35%;} .prod_images{position: relative;}.prod_price{margin-left:105px;font-family:'Trebuchet MS';color:#333;width:100%;padding-right:50px} .prod_price .price{margin:54px 0 29px;font-size:30px;} .special_price{font-family:'Trebuchet MS';font-size:30px;color:#fd9710;margin-bottom:25px;} .old_price{font-family:'Trebuchet MS';font-size:20px;color:#d9d9d9;text-decoration:line-through;margin:40px 0 15px;} .model{font-size:15px;margin:10px 0;} .exist span{display:inline-block;vertical-align:middle;height:25px;padding-right: 5px;} .exist p{color:#999;font-family:'Trebuchet MS';font-size:15px;text-transform:lowercase;line-height:25px;display:inline-block;vertical-align:middle;} .image-additional{margin-top:20px;display:inline-block;} #button-cart{cursor:pointer;font-size:16px;line-height:28px;padding:5px 40px 5px 35px;margin-top:12px;} #button-cart .svg{display:inline-block;vertical-align:middle;width:28px;height:28px;} #button-cart svg{width:28px;height:28px;} .actions{padding-top:20px;} .actions a{color:#00adee;font-size:15px;font-family:'Trebuchet MS';display:block;padding:2px 0; } .actions a:hover{color:#fd9710;} .attributes{font-size:15px;font-family:'Trebuchet MS';line-height:23px;color:#333;margin-top:25px;}
.attr_text{color:#999;font-size:15px;font-family:'Trebuchet MS';}
.attr_text a{color:#f28b1c;text-decoration:underline;}.attr_text a:hover{text-decoration:none;}
.thumbnails li{list-style:none!important;margin:0!important;} .prod_right .category_name{display:inline-block;margin-top:14px;font-size:12px;color:#999;font-family:'Trebuchet MS';text-decoration:underline;} .prod_right .rating{text-align:right;margin:14px 40px 0;display:inline-block;float:right;} .prod_right .rating a{color:#00adee;text-decoration:underline;margin-left:30px;} .star{width: 0;height: 0;margin: 2px 0;position: relative;display: inline-block; border-right: 6px solid transparent;border-bottom: 4px solid #999;border-left: 6px solid transparent; -moz-transform: rotate(35deg);-webkit-transform: rotate(35deg);-ms-transform: rotate(35deg);-o-transform: rotate(35deg);} .star:before{content: '';height: 0;width: 0;position: absolute;display: block;top: -3px;left: -4px; border-bottom: 4px solid #999;border-left: 2px solid transparent;border-right: 2px solid transparent; -webkit-transform: rotate(-35deg);-moz-transform: rotate(-35deg);-ms-transform: rotate(-35deg);-o-transform: rotate(-35deg);} .star:after {content: '';width: 0;height: 0;position: absolute;display: block;top: 0;left: -6px; border-right: 6px solid transparent;border-bottom: 4px solid #999;border-left: 6px solid transparent; -webkit-transform: rotate(-70deg);-moz-transform: rotate(-70deg);-ms-transform: rotate(-70deg);-o-transform: rotate(-70deg);} .star.ok,.star.ok:before,.star.ok:after{border-bottom: 4px solid #00adee;} .htabs{height:40px;line-height:16px;border-bottom:3px solid #00adee;width:100%;} .info{display:flex;} .info .col_left{width:64%;} .info .col_right{width:36%;} .info .col_right .tab-content{padding-left:0;} .tab-content ul li{padding-left:15px;list-style: disc;    list-style-position: inside;} .htabs a{padding:12px 12px 11px;float: left;font-size: 13px;text-decoration: none;color: #00adee;margin-right: 2px;display: none;} .htabs a.selected {padding-bottom:9px;background:#00aff2;color:#fff;} #tabs2{padding-left:10px;} #tabs2 a{background:#bee9f9;color:#00adee;border-bottom:2px solid #00aff2;} #tab-description a{color:#00adee;} #tab-description a:hover{color:#fd9710;} #tab-description ul{margin-bottom:15px; } #tab-description li{list-style:disc; margin-left: 30px;} .tab-content{padding:25px 15px 20px;margin-bottom: 20px;z-index: 2;overflow: auto;width:100%;font-size:13px;color:#999;line-height:21px;font-family:'Trebuchet MS';} .tab-content p{color:#999;margin: 10px 0;}.tab-content td{color:#999;} .del_pay{padding-right:30px;} .del_pay .dflex{flex-wrap:wrap;margin-bottom:20px;border-top:1px solid #f2f2f2;} .h1{color:#00adee;font-size:13px;font-weight:normal;padding-left:15px;; padding:5px 0;line-height:36px;}
.brand{color:#999;font-family:'Trebuchet MS';padding-top:7px;}
.brand a{color:#f28b1c;text-decoration:underline;}.brand a:hover{text-decoration:none;}
.del_pay .dflex .item{justify-content: space-between;width:23%;text-align:center;padding:18px 5% 15px 0;} .del_pay .dflex .svg{padding-right:50px;} .del_pay .dflex svg{height:100%;min-height:56px;max-width:83px;} .del_pay .dflex .title{text-align:left;color:#999;font-family:'Trebuchet MS';font-size:11px;padding-top:15px;margin-bottom:5px;line-height:13px;} .del_pay .dflex .text{color:#cccccc;font-size:11px;line-height:16px;margin-bottom:12px;text-align:left;} .delivery .s1 svg{width:47px;} .delivery .s2 svg{width:35px;} .delivery .s3 svg{width:83px;} .delivery .s4 svg{width:79px;} .delivery .s5 svg{width:83px;} .delivery .s6 svg{width:50px;} .readycart, .preorder{display: flex; align-items: center; float: left; } .readycart a, .preorder a{font-size:12px; line-height: 14px; display: block; } .preorder a{color:#f28b1c;} .preorder:hover a{color:#00adee;} .readycart path{fill:#00adee;} .preorder path{fill:#f28b1c;} .readycart:hover path{fill:#f28b1c;} .readycart:hover a{color:#f28b1c;} .preorder:hover path{fill:#00adee;} .readycart .svg, .preorder .svg{width: 40px; } .pay .dflex svg{height:100%;min-height:62px;} .pay .nal svg{width:30px;} .pay .beznal svg{width:33px;} .pay .card svg{width:53px;} .oneclick.button{background:#bee9f9;color:#333;padding:10px 25px 10px 26px;} [lang="uk"] .oneclick.button{padding:10px 28px 10px 28px;} .oneclick.button:hover{background:#dbdbdb;} .thumbnail{position:relative;display: block;} .dar{z-index:5;position:absolute;right:8px;top:4px;width:70px;height:70px;} .dar div{color: #fff;text-align: center;position: absolute;margin-top: -27px;width: 100%;font-size: 12px;} #tab-description .comp_pu a{color:#999;} #tab-description .comp_pu a:hover{text-decoration:underline;color:#fd9710;} <?php if ($special || isset($action)&&$action) { ?>
<?php echo file_get_contents(DIR_APPLICATION.'view/js/tooltip.css'); ?>
<?php } ?>
@media (max-width: 1300px){#content{margin-bottom:64px;} .prod_price{margin-left:10px;padding-right:30px;} .prod_left{width:70%;} .prod_right{width:30%;} .price{margin: 44px 0;} .prod_right .category_name,.prod_right .rating,.ratingg label{display:none;} h1{font-size:20px;line-height:25px;height:110px;} .attributes{line-height:25px;} .info .col_left{width:68%;} .info .col_right{width:32%;} .reviews{padding-left:15px;} } @media (max-width: 991px){.del_pay .dflex .item{width:50%} #content{flex-wrap:wrap;} .prod_left{width:100%;} .prod_right{width:100%;} h1{height:auto;padding-top:30px;} } @media (max-width: 767px){.info{flex-wrap:wrap;} .info .col_left{width:100%;} .info .col_right{width:100%;} .prod_left>div{width:50%;} .prod_images img{max-width: 100%;} } @media (max-width: 576px) {/*320*/ .del_pay .dflex .item{width:100%} .prod_left{flex-wrap:wrap;} .prod_left>div{width:100%;} .htabs{display:flex;height:auto;} .prod_images img{max-width:100%;} } .ico_attr{position: absolute; bottom: -6px; left: 23px; } .ico{width: 114px; height: 114px; background: #A1E0EA; border-radius: 100%; padding: 20px 10px; text-align:center; z-index: 9; } .ico+.ico{margin-left: 12px; } .ico img {width: 50px;margin-bottom: 6px;} .ico div{line-height: 12px; color:#fff; font-size: 10px; } .ico.attr_17867{background: #FD9710; } .ico.attr_17867 img{width: 58px; margin-bottom: 4px; } .ico.attr_17870{background: #FD9710; } .ico.attr_17870 img{width: 32px; margin-bottom: 4px; }
.tooltip{position:absolute;z-index:999;left:-9999px;background-color:#ECF7FB;padding:5px;border:1px solid #BEE9F9;width:235px;padding:18px 16px;border-radius:16px;}
.tooltip:after,.tooltip:before{content:"";font-size: 0;line-height: 0;border-top: 20px solid transparent;border-bottom: 0 solid transparent;border-right: 21px solid #ECF7FB;position: absolute;bottom: 14px;left: -19px;}
.tooltip:before{border-right: 21px solid #BEE9F9;bottom: 13px;left: -21px;}
.tooltip p{margin:0;padding:0;color:#000;padding:2px 7px;font-size:12px;line-height: 17px;}
.dar img{pointer-events:none;}
.free-delivery-plate {position:absolute;right:8px;top:4px;width:70px;height:70px;z-index:5;}
.free-delivery-plate.with-action {top: 80px;}
@media (max-width: 640px){
.tooltip{
  left:0px !important;
}
}
</style>
</svg>
  <div class="row" id="content">
    <?php echo $content_top;?>
      <div class="prod_left">
        <div class="prod_images">
        <?php if ($has_free_delivery) { ?>
            <div
                class="free-delivery-plate <?php echo ($special || isset($action) && $action) ? 'with-action' : '' ?>"
                data-tooltip="<?php echo $text_freedelivery_paid; ?>"
            >
            <div class="product__text-delivery"><?php $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (strpos($url, 'prote.ua/ua/') !== false) {
    echo 'доставка безкоштовна';
}
else {echo 'доставка бесплатная';}
 ?> </div>
                <img
                    class="free-delivery-icon"
                    src="image/ico/favicon_prote_16x16.svg"
                    data-original="image/ico/action/free-delivery-action.svg"
                />
            </div>
        <?php } ?>
        <?php if ($special || isset($action) && $action) { ?>
            <div class="dar" <?php if(isset($action[0]['short_description'])){ ?> data-tooltip="<?php echo $action[0]['short_description']; ?>" <? } ?> >
                <a href="<?php echo $action[0]['url']; ?>">
                    <img
                        src="image/ico/favicon_prote_16x16.svg"
                        data-original="image/ico/action/label-fire-action.svg"
                        alt="<?php echo $text_action; ?>"
                        title="<?php echo $text_action; ?>"
                    />
                </a>
                <div><?php echo $text_action; ?></div>
            </div>
        <?php } ?>
        <?php if ($thumb || $images) { ?>
          <ul class="thumbnails">
            <?php if ($thumb) { ?>
            <li><a class="thumbnail first" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img alt="<?php echo $heading_title; ?>" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" />
              <?php if($attributs){ ?>
                <div class="ico_attr dflex">
                  <?php foreach ($attributs as $key => $attribut) { ?>
                    <div class="ico attr_<?php echo $key; ?>"><img src="<?php echo $attribut['image']; ?>" alt="<?php echo $attribut['text']; ?>" title="<?php echo $attribut['text']; ?>"><div><?php echo $attribut['text']; ?></div></div>
                  <?php } ?>
                </div>
              <?php } ?>
              </a>
            </li>
            <?php unset($images[0]); ?>
            <?php } ?>
            <?php if ($images) { ?>
            <?php $imgnum=0; ?>
            <?php foreach ($images as $image) { ?>
            <li class="image-additional"><a class="thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title, ' Фото ', $imgnum++; ?>"> <img alt="<?php echo $heading_title, ' Фото ', $imgnum++; ?>" class="" src="<?php echo $image['additional']; ?>" title="<?php echo $heading_title, ' Фото ', $imgnum; ?>" /></a></li>
            <?php } ?>
            <?php } ?>
          </ul>
        <?php } ?>
        </div>
        <div id="product" class="prod_price">
          <?php if ($price) { ?>
            <?php if (!$special) { ?>
            <div class='price leftprice'><?php echo $price; ?></div>
            <?php } else { ?>
            <div class="old_price"><?php echo $price; ?></div>
            <div class="special_price"><?php echo $special; ?></div>
            <?php } ?>
          <?php } ?>
          <?php if (isset($altpack) || isset($altcolors) || isset($altpack_color_Canon)) { ?>
            <svg style="display:none;height:0;width:0;">
            <style>
            .altpack, a.altpack{display:inline-block;font-family:'Trebuchet MS';color:#999;border:1px solid #999;margin-right:6px;font-size: 15px;min-width:60px;padding: 5px 9px;text-align:center;} .ac-active{color:#00adee;border-color:#00adee} a.altpack:hover{color:#00adee;border-color:#00adee} .altcolors{width:30px;height:30px;display:inline-block;} .item a{display:inline-block;vertical-align:middle;} .item .namecolor{padding-left:17px;color:#999;} .item a.namecolor{padding-left:14px;} .altpanel{margin-bottom:20px;} .altpanel .item{padding:2px 8px 2px;cursor:pointer;-webkit-transition-property: background;-webkit-transition-duration: 0.5s;-webkit-transition-timing-function: ease;} .item.active{background:#f4f3f5;cursor:default;} .altpanel .item:hover{background:#f4f3f5;-webkit-transition-property: background;-webkit-transition-duration: 0.5s;-webkit-transition-timing-function: ease;} .altpanel .item>div{display:inline-block;vertical-align:middle;} .altcol{border:1px solid #dadada;padding-top:2px;padding-bottom:2px;} .ac-black, .ac-photoblack{background:#000;} .ac-cyan{background:#00bff3;} .ac-lightcyan{background:#d0effc;} .ac-lightmagenta{background: #fed5ed;} .ac-magenta{background:#ec008c;} .ac-yellow {background:#fff200;} .ac-grey {background:#b7b7b7;} .ac-lightblack {background:#555;} .ac-matteblack {background:#acacac;} .ac-lightlightblack {background:#ebebeb;} @media (max-width: 1230px){.altpack, a.altpack{margin:0 0 5px;} }
            </style>
              </svg>
          <?php } ?>

          <?php if ($altpack_color_Canon) { ?>
          <svg style="display:none;height:0;width:0;">
            <style>
              #tabs3{display:flex;} #tabs3 a{white-space: nowrap;min-width: auto;padding: 5px 6px;} #tabs3 .selected{color:#00adee;border-color:#00adee} .tab-content.t2{padding:15px 0px 0px;}
            </style>
          </svg>

            <div id="tabs3" class="altpack_color">
              <?php $count=0; foreach($altpack_color_Canon as $pack_name => $value){ ?>
                <a class="altpack<?php if($count==0){?> ac-active<?php } ?>" href="#tab-pack<?php echo $count?>"><?php echo $pack_name; ?></a>
              <?php $count++;} ?>
            </div>
            <?php $count=0; foreach($altpack_color_Canon as $pack_name => $colors){ ?>
                <div id="tab-pack<?php echo $count?>" class="tab-content t2 <?php if($count==0){?> active<?php } ?>" >
                  <div class="altpanel altcol" title="<?=$text_selaltcolor?>">
                  <?php foreach($colors as $key => $item){ ?>
                   <div class="item<?php if ($item['active']) { ?> active<?php } ?>">
                    <?php if ($item['active']) { ?>
                      <div class="altcolors ac-active ac-<?php 
                      if($item['color']=="Чорний"){echo 'black';
                      } else{
                      echo $item['color'];}
                      
                      ?>">">
                        <?php if (strpos($item['color'], 'b-c-m-y')!==false) { ?>
                          <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/multicolor.svg'); ?></span>
                        <?php } ?>
                      </div>
                        <div class="namecolor">- <?php echo $item['color_name']; ?></div>
                    <?php } else { ?>
                      <a href="<?php echo $item['href']; ?>" title="<?php echo $item['color'];?>" class="altcolors ss ac-<?php 
                      if($item['color']=="Чорний"){echo 'black';
                      } else{
                      echo $item['color'];}
                      
                      ?>">
                        <?php if (strpos($item['color'], 'b-c-m-y')!==false) { ?>
                          <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/multicolor.svg'); ?></span>
                        <?php } ?>
                      </a>
                      <a href="<?php echo $item['href']; ?>" title="<?php echo $item['color'];?>" class="namecolor">
                      <?php //echo (strpos($item['color'], 'b-c-m-y')!==false)?$text_multicolor:$item['color_name']; ?>
                      - <?php echo $item['color_name']; ?>
                      </a>
                    <?php } ?>
                  </div>

                  <?php } ?>
                  </div>
                </div>
              <?php $count++;} ?>

          <?php } ?>

          <?php if (isset($altpack)) { ?>
            <div class="altpanel" title="<?=$text_selaltpack?>">
              <?php foreach ($altpack as $item) { ?>
              <?php if ($item['active']) { ?>
                <div class="altpack <?php if ($item['active']) echo 'ac-active'; ?>"><?php echo $item['packing']; ?></div>
              <?php } else { ?>
                  <a href="<?php echo $item['href']; ?>" title="<?php echo $item['packing']; ?>" class="altpack"><?php echo $item['packing']; ?></a>
              <?php } ?>
              <?php } ?>
            </div>
          <?php } ?>
          <?php if (isset($altcolors) && !empty($altcolors)) { ?>
            <div class="altpanel altcol" title="<?=$text_selaltcolor?>">
            <?php foreach ($altcolors as $item) { ?>
            <?php if(!isset($item['color'])) { continue;} ?>
              <div class="item<?php if ($item['active']) { ?> active<?php } ?>">
                <?php if ($item['active']) { ?>
                  <div class="altcolors ac-active ac-<?php 
               
                   if($item['color']=="Черный" || $item['color']=="Чорний" ){
                    echo "black";
                  } else{
                  if($item['color']=="Жовтий" || $item['color']=="Желтый"){
                    echo "yellow";
                  }
             
                  else{
                  echo $item['color'];
                  } }
                  ?>">
                    <?php if (strpos($item['color'], 'b-c-m-y')!==false) { ?>
                      <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/multicolor.svg'); ?></span>
                    <?php } ?>
                  </div>
                    <div class="namecolor">- <?php echo $item['color_name']; ?></div>
                <?php } else { ?>
                  <a href="<?php echo $item['href']; ?>" title="<?php echo $item['color'];?>" class="altcolors ac-<?php 
               
                   if($item['color']=="Черный" || $item['color']=="Чорний" ){
                    echo "black";
                  } else{
                  if($item['color']=="Жовтий" || $item['color']=="Желтый"){
                    echo "yellow";
                  }
             
                  else{
                  echo $item['color'];
                  } }
                  ?>">
                    <?php if (strpos($item['color'], 'b-c-m-y')!==false) { ?>
                      <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/multicolor.svg'); ?></span>
                    <?php } ?>
                  </a>
                  <a href="<?php echo $item['href']; ?>" title="<?php echo $item['color'];?>" class="namecolor">
                  - <?php echo (strpos($item['color'], 'b-c-m-y')!==false)?$text_multicolor:$item['color_name']; ?>
                  </a>
                <?php } ?>
              </div>
            <?php } ?>
            </div>
          <?php } ?>

          <div class="model"><?php echo $text_model; ?> <span><?php echo $sku; ?></span></div>
          <div class="exist">
            <?php switch ($ifexist) {
                 case 0: ?>
                    <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/00-v-nayavnosti-big.svg'); ?></span>
                    <p class="ifexist ico0">  <?php echo $text_exist; ?></p>
                <?php break; case 1: ?>
                
                    <p class="ifexist ico1"><?php echo $text_preorder; ?></p>
                <?php break; case 2: ?>
                    <p class="ifexist ico2"><?php echo $text_wait; ?></p>
                <?php break; case 3: ?>
                    <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/00-nema-v-nayavnosti-big.svg'); ?></span>
                    <p class="ifexist ico3"><?php echo $text_noexist; ?><?php 
                    if($category_info['text'] == "Мониторы" ||  $category_info['text'] == "Монітори"){
                    
                    echo $text_noexist; 
                    $url = $_SERVER['REQUEST_URI'];
                    $url = explode('?', $url);
                    $url = $url[0];
                    if (strpos($url, 'monitor-') !== false) {
                  
                     header("HTTP/1.1 301 Moved Permanently"); 
                     header("Location: https://prote.ua/comp-accessories/monitors/"); 
                    exit(); 
                   }}
?>

<?php 
                    if($category_info['text'] == "Материнские платы" ||  $category_info['text'] == "Материнські плати"){
                    
                    echo $text_noexist; 
                    $url = $_SERVER['REQUEST_URI'];
                    $url = explode('?', $url);
                    $url = $url[0];
                    if (strpos($url, 'materinskaya-') !== false) {
                  
                     header("HTTP/1.1 301 Moved Permanently"); 
                     header("Location: https://prote.ua/comp-accessories/materinskie-platy/"); 
                    exit(); 
                   }}
?></p>
                <?php break; default: ?>
                    <p class="ifexist ico4"></p>
            <?php } ?>
          </div>
          <div class="form-group">
            <?php if($ifexist<2) { ?>

              <!-- <label class="control-label" for="input-quantity"><?php echo $entry_qty; ?></label> -->
              <input type="hidden" name="quantity" value="<?php echo $minimum; ?>" id="input-quantity" class="form-control" />
              <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
              <a href="#" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" onclick="cart.add('<?php echo $product_id; ?>', '<?php echo $minimum; ?>');return false;" class="button"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/04-cart-buy.svg'); ?></span><?php echo $button_cart; ?></a>
                <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                    <a href="#ordercallback-modal" data-modal="ordercallback-form" style="margin-top:10px;" class="oneclick button"
                          onclick="ordercallback_modal_show('<?php echo $product_id; ?>','<?php echo $thumb; ?>','<?php echo $heading_title; ?>','<?php echo ($special_float ? $special_float : $price_float); ?>','<?php echo $minimum; ?>'); return false;">
                                <?php echo strip_tags($button_cartone); ?>
                          </a>
                <?php } ?>
                <?php if ($minimum > 1) { ?>
                <svg style="display:none;height:0;width:0;">
                  <style>
                  .product_minn{padding-left:35px;background:url('image/ico/min-order.svg')0 2px no-repeat;color:#fd9710;font-family:'Trebuchet MS';font-size:15px;line-height:15px;text-align:left;margin:24px 0 0;}
                  </style>
                </svg>
                  <div class="product_minn"><?php echo $text_minimum; ?></div>
                <?php } ?>

            <?php } ?>
            <div class="actions">
                <?php if (isset($action) && $action) { ?>
                  <?php foreach ($action as $act) { ?>
                  <a href="<?php echo $act['url'];?>" data-tooltip="<?php echo $act['short_description']; ?>"><?php echo $text_actions; ?></a>
                  <?php } ?>
                <?php } ?>
                <?php if ($price>=750 && $jan!='A' && (stripos($heading_title, 'PATRON')!==FALSE || stripos($heading_title, 'BARVA')!==FALSE)) { ?>
                   <a href="#" class="btn-modal" data-modal="modal-info"" onclick="return false;"><?php echo strip_tags($text_freedelivery); ?></a>
                   <div class="modal modal-form modal-info">
                    <div class="body">
                      <div class="modal-overlay"></div>
                      <div class="modal-body">
                        <div class="modal-close">+</div>
                        <form id="modal-info" method="post" name="form-callback-modal" class="callback-form form send">
                            <div class="modal__title"><?php echo strip_tags($text_freedelivery); ?></div>
                          <div class="text-info" style="max-width:400px;"><?php echo $text_freedeliverytip; ?></div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <!-- <a href="#" onclick="$('#button-cart').click(); return false;"><?php echo $text_button_cart; ?></a> -->
                <div class="readycart">
                  <a href="<?php echo $readycart; ?>" aria-label="Услуга 'Готовая корзина'" class="svg" title='<?php echo $text_button_readycart; ?>'><?php echo file_get_contents(DIR_IMAGE.'/ico/05-ready-cart-service.svg');?></a>
                  <a href="<?php echo $readycart; ?>" data-tooltip="<?php echo $text_button_readycart_desc; ?>" title='<?php echo $text_button_readycart; ?>'><?php echo $text_button_readycart; ?></a>
                </div>
                <div class="preorder">
                  <a href="<?php echo $preorder; ?>" aria-label="<?php echo $text_button_preorder_desc; ?>" class="svg" title="<?php echo $text_button_preorder_desc; ?>"><?php echo file_get_contents(DIR_IMAGE.'/ico/13-parachut.svg');?></a>
                  <a href="<?php echo $preorder; ?>" data-tooltip="<?php echo $text_button_preorder_desc; ?>" title="<?php echo $text_button_preorder_desc; ?>"><?php echo $text_button_preorder; ?></a>
                </div>
             </div>
          </div>

        </div>
      </div>

      <div class="prod_right">

        <div class="category_name">
          <?php if($category_info){ ?>
              <a href="<?php echo $category_info['href']; ?>" title="<?php echo $category_info['text']; ?>"><?php echo $category_info['text']; ?></a>
          <? } ?> /
        </div>
        <?php if ($review_status) { ?>
          <div class="rating">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($rating < $i) { ?>
              <span class="star"></span>
              <?php } else { ?>
              <span class="star ok"></span>
              <?php } ?>
              <?php } ?>
              <a href="#tab-review" onclick="$('html, body').animate({scrollTop: $('#tab-review').offset().top}, 350); return false;"><?php echo $reviews; ?></a>

          </div>
        <?php } ?>

        <h1><?php echo $heading_title; ?></h1>
        <?php if($brand){ ?>
          <div class="brand"><a href="<?php echo $brand['href']; ?>" title="<?php echo $brand['text']; ?>"><?php echo $brand['text']; ?></a></div>
        <?php } ?>

        <div class="attributes">
          <?php foreach ($attribute_groups as $attribute_group) { ?>

            <?php foreach ($attribute_group['attribute'] as $attribute) { ?>

              <div><span class="attr_name"><?php echo $attribute['name']; ?>:</span>
                  <?php if($attribute['href']){ ?>
                    <span class="attr_text"><a href="<?php echo $attribute['href']; ?>" title="<?php echo $attribute['text']; ?>">
                    <?php if($attribute['text']=="Совместимый"){ echo "Совместимый (аналог)";}
                    elseif($attribute['text']=="Сумісний"){ echo "Сумісний (аналог)";}else{
                    echo $attribute['color_atr']?$attribute['color_atr']:$attribute['text']; }
                    ?>
                    </a></span>
                  <?php } else { ?>
                    <span class="attr_text"><?php echo $attribute['color_atr']?$attribute['color_atr']:$attribute['text']; ?></span>
                  <?php } ?>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>

  </div>
  <div class="row info">
    <div class="col_left">
      <div id="tabs" class="htabs">
          <a href="#tab-description" data-toggle="tab"><?php echo $tab_description; ?></a>
          <?php if ($product_docs) { ?>
          <a href="#tab-docs" data-toggle="tab"><?php echo $tab_docs; ?></a>
          <?php } ?>
          <?php //if ($productsCompability) { ?>
          <svg style="display:none;height:0;width:0;">
          <style>
           a[href="#tab-compability"]{display:block!important; width: 0; overflow:hidden; padding:12px 0 11px; -webkit-transition: all 0.6s ease;; -moz-transition: all 0.6s ease; -o-transition: all 0.6s ease; transition: all 0.6s ease; }
          </style>
          </svg>
          <a href="#tab-compability" data-toggle="tab"><?php echo $text_cartcom; ?></a>
          <?php //} ?>
          <a href="#tab-shipping" data-toggle="tab"><?php echo $text_tab_shipping; ?></a>
          <!-- <a href="#tab-payment" data-toggle="tab"><?php echo $text_tab_payment; ?></a> -->
          <a href="#tab-contacts" data-toggle="tab"><?php echo $text_tab_contacts; ?></a>
          <?php if($video){ ?>
          <a href="#tab-video" data-toggle="tab"><?php echo $text_tab_video; ?></a>
          <?php } ?>
      </div>

      <div id="tab-description" class="tab-content">
        <?=(strip_tags($description)<>'' ? $description : ($ax_description<>'' ? $ax_description : $tag))?>
        <? echo $seo_text; ?>
      </div>
      <?php if ($product_docs) { ?>
        <div id="tab-docs" class="tab-content"><?php echo $product_docs; ?></div>
      <?php } ?>

      <div id="tab-shipping" class="tab-content del_pay">
        <div class="delivery">
         <div class="h1">Доставка:</div>
      	 <div class="description">
           <div class="dflex">
              <div class="item">
                <div class="svg s1"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/kurier.svg');?></div>
                <div class="title"><?php echo $text_kurier_tite; ?></div>
                <div class="text"><?php echo $text_delivery_title1; ?></div>
              </div>
             
              <div class="item">
                <div class="svg s3"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/nova-poshta.svg');?></div>
                <div class="title"><?php echo $text_nova_poshta_tite; ?></div>
                <div class="text"><?php echo $text_delivery_title3; ?></div>
              </div>

              <div class="item">
                <div class="svg s5"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/ukrposhta.svg');?></div>
                <div class="title"><?php echo $text_ukrposhta_tite; ?></div>
                <div class="text"><?php echo $text_delivery_title3; ?></div>
              </div>
              <div class="item">
                <div class="svg s6"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/nichnyy-ekspres.svg');?></div>
                <div class="title"><?php echo $text_nichnyy_ekspres_tite; ?></div>
                <div class="text"><?php echo $text_delivery_title3; ?></div>
              </div>
              <div class="item">
                <div style="height: 77px;" class="svg s7"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/justin.svg');?></div>
                <div class="title"><?php echo $text_justin_tite; ?></div>
                <div class="text"><?php echo $text_delivery_title3; ?></div>
              </div>

               <div class="item">
                <div style="height: 77px;" class="svg s7"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/meest.svg');?></div>
                <div class="title"><?php echo $text_meest_tite; ?></div>
                <div class="text"><?php echo $text_delivery_title3; ?></div>
              </div>



            </div>

         </div>
        </div>
        <div class="pay">
          <div class="h1">Оплата:</div>
          <div class="dflex">
            <div class="item">
              <div class="svg nal"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/gotivka.svg');?></div>
              <div class="title"><?php echo $text_nal_tite; ?></div>
              <div class="text"><?php echo $text_nal_text; ?></div>
            </div>
            <div class="item">
              <div class="svg nal"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/bezgotivka.svg');?></div>
              <div class="title"><?php echo $text_beznal_tite; ?></div>
              <div class="text"><?php echo $text_beznal_text; ?></div>
            </div>
            <div class="item">
              <div class="svg beznal"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/bezgotivka-PDV.svg');?></div>
              <div class="title"><?php echo $text_beznal_tite_NDS; ?></div>
              <div class="text"><?php echo $text_beznal_text_NDS; ?></div>
            </div>
            <div class="item">
              <div class="svg card"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/card.svg');?></div>
              <div class="title"><?php echo $text_card_tite; ?></div>
              <div class="text"><?php echo $text_card_text; ?></div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div id="tab-payment" class="tab-content"></div> -->
      <div id="tab-contacts" class="tab-content">
        <svg style="display:none;height:0;width:0;">
        <style>
        .contact {width:100%;} .contact .dflex{flex-wrap:wrap;margin-bottom:83px;} .contact .dflex .item{width:25%;text-align:left;padding:12px 25px 12px 0;font-family:'Trebuchet MS';} .contact .dflex .svg{height:40px;} .contact .dflex svg{height:100%;max-height:40px;} .contact .dflex svg path{fill:#999999;} .contact .sv1 svg{width:37px;} .contact .sv2 svg{width:39px;} .contact .sv3 svg{width:41px;} .contact .sv4 svg{width:39px;} .contact .dflex .title{font-size:13px;padding-top:21px;margin-bottom:4px;color:#333;} .contact .dflex .text{color:#999999;font-size:15px;line-height:21px;} @media (max-width: 992px){.contact .dflex .item{width:50%} }
        </style>
        </svg>
        <div class="contact">
          <div class="dflex">
            <div class="item">
              <div class="svg sv1"><?php echo file_get_contents(DIR_IMAGE.'/ico/contacts/telephone.svg');?></div>
              <div class="title"><?php echo $text_telephone; ?></div>
              <div class="text">(044) 379 09 62<br>(050) 469 95 75<br>(067) 354 56 25</div>
            </div>
            <div class="item">
              <div class="svg sv2"><?php echo file_get_contents(DIR_IMAGE.'/ico/contacts/mail.svg');?></div>
              <div class="title"><?php echo $text_mail; ?></div>
              <div class="text"><a href="mailto:info@prote.ua">info@prote.ua</a></div>
            </div>
            <div class="item">
              <div class="svg sv4"><?php echo file_get_contents(DIR_IMAGE.'/ico/contacts/point.svg');?></div>
              <div class="title"><?php echo $text_point; ?></div>
              <div class="text"><?php echo $text_adress; ?></div>
            </div>
            <div class="item">
              <div class="svg sv3"><?php echo file_get_contents(DIR_IMAGE.'/ico/contacts/clock.svg');?></div>
              <div class="title"><?php echo $text_clock; ?></div>
              <div class="text">пн. - пт. 9:00 - 20:00<br>сб. 11:00 - 17:00</div>
            </div>
          </div>
        </div>

      </div>

      <div id="tab-compability" class="tab-content"></div>
      <?php if($video){ ?>
      <div id="tab-video" class="tab-content">
      	<style> #tab-video iframe{max-width: 100%; } </style>
        <?php echo $video; ?>
      </div>
      <?php } ?>

    </div>
    <div class="col_right">
    	<div id="tabs2" class="htabs">
          <?php if ($review_status) { ?>
          <a href="#tab-review" data-toggle="tab"><?php echo $tab_review; ?></a>
          <?php } ?>
        </div>
        <?php if ($review_status) { ?>

	      <div id="tab-review" class="tab-content">
	        <form class="form-horizontal" id="form-review">
	          <div id="review">
	          </div>
	          <p class="h2 title"><?php echo $text_write2; ?></p>
	          <?php if ($review_guest) { ?>
	          <div class="form">
		          <div class="form-group">
		              <label for="input-name"><?php echo $entry_name; ?></label>
		              <input type="text" name="name" value="" id="input-name" class="form-control" required/>
		          </div>
		          <div class="form-group">
		              <label for="input-review"><?php echo $entry_review; ?>:</label>
		              <textarea name="text" rows="5" id="input-review" class="form-control" required></textarea>
		          </div>
		          <div class="form-group ratingg"> <label class="control-label"><?php echo $entry_rating; ?></label> &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp; <input type="radio" name="rating" value="1" aria-label="1"/> &nbsp; <input type="radio" name="rating" value="2" aria-label="2" /> &nbsp; <input type="radio" name="rating" value="3" aria-label="3" /> &nbsp; <input type="radio" name="rating" value="4" aria-label="4" /> &nbsp; <input type="radio" name="rating" value="5" aria-label="5" /> &nbsp;<?php echo $entry_good; ?> </div>
		          <?php //echo $captcha; ?>
		          <div class="buttons">
		              <button type="submit" id="button-review" onclick="return false;" data-loading-text="<?php echo $text_loading; ?>" class="buttonb"><?php echo $button_send_r; ?></button>
		          </div>
		          <?php } else { ?>
		          <?php echo $text_login; ?>
		          <?php } ?>
		      </div>
	        </form>
	      </div>
	    <?php } ?>
    </div>
  </div>

<?php if($featured){ ?>
<svg style="display:none;height:0;width:0;">
<style>
    <?php echo file_get_contents(DIR_APPLICATION.'/view/js/products.css');?>
    
    .swiper-slide{height:auto;}
</style>
</svg>
  <div class="row1 reatured">
      <div class="featured_title"><p class="titlefeatur"><?php echo $text_related; ?></p></div>

      <div class="" style="max-width: 100%;">
          <div class="swiper-viewport">
              <div id="slideshow0" class="swiper-container">
                  <div class="swiper-wrapper">
                      <?php foreach ($featured as $key=> $product) { ?>
                          <div class="product-layout swiper-slide product<?php if($product['ifexist']==3) { ?> non<?php } ?>" data-prodid="<?php echo $product['product_id']; ?>" data-position="<?php echo $key; ?>">
                              <?php if ($product['special']) { ?>
                                  <div class="dar">
                                      <img src="image/ico/favicon_prote_16x16.svg" data-original="image/ico/action/label-fire-action.svg"  alt="<?php echo $text_action; ?>" title="<?php echo $text_action; ?>"/>
                                      <div><?php echo $text_action; ?></div>
                                  </div>
                              <?php } ?>
                              <div class="image">
                                  <a href="<?php echo $product['href']; ?>"><img alt="<?php echo $product['name']; ?>" src="image/ico/favicon_prote_16x16.svg" data-src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" class="swiper-lazy" />
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
<?php } ?>
<div id="compabilities"></div>

<?php /* if ($review_status) {
<div class="row">
    <div class="product-card">

        <div class="rating">
          <div class="addthis_toolbox addthis_default_style">
            <embed data-fb="like" data-layout="button_count" />
            <a class="addthis_button_facebook_like"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_pinterest_pinit"></a>
            <a class="addthis_counter addthis_pill_style"></a>
          </div>
          <script async src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
        </div>

    </div>
</div>
} */ ?>

</div>
<?php echo $content_bottom; ?>
<?php echo $column_right; ?>
<?php if($featured){ ?>
<script>
  $(document).ready(function(){
    var swiper1 = new Swiper('#slideshow0', {
        mode:'horizontal',
        slidesPerView:5,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        autoplay: {
          delay: 4000,
          disableOnInteraction: true,
        },
        loop:true,
        lazy: {
          loadPrevNext: true,
        },
        breakpoints: {
          300: {
              slidesPerView: 1,
              spaceBetween: 8
          },
          576: {
              slidesPerView: 2,
              spaceBetween: 8
          },
          768: {
              slidesPerView: 3,
              spaceBetween: 8
          },
          991: {
              slidesPerView: 3
          },
          1299: {
              slidesPerView: 5
          }
        }
    });
  });
</script>
<?php } ?>
<script>
$(document).ready(function(){
  jQuery.getScript('catalog/view/js/jquery.magnific-popup.min.js',function(){
    start_magnificPopup();
  });
});
</script>

<link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" media="screen" />
<script>
<?php if($video){ ?>
$(document).ready(function(){
vid_string = '<?php echo $video; ?>';
vid_string2 = vid_string.substring(vid_string.indexOf('embed/')+6,vid_string.indexOf('" f'));
html = '<li class="image-additional"><a class="video" href="https://www.youtube.com/watch?v='+vid_string2+'"><img class="video-link" src="https://i1.ytimg.com/vi/'+vid_string2+'/default.jpg" /></a></li>';
$('.thumbnails').append(html);
});

function start_magnificPopup(){
$('.thumbnails').magnificPopup({
    type:'image',
    delegate: 'a',
    gallery: {
      enabled:true
    },
    callbacks: {
        elementParse: function(item) {
           console.log(item.el[0].className);
            if(item.el[0].className == 'video') {
              item.type = 'iframe',
              item.iframe = {
                 patterns: {
                   youtube: {
                     index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                     id: 'v=', <? // String that splits URL in a two parts, second part should be %id%
                      // Or null - full URL will be returned
                      // Or a function that should return %id%, for example:
                      // id: function(url) { return 'parsed id'; } ?>

                     src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
                   } <? /*,
                   vimeo: {
                     index: 'vimeo.com/',
                     id: '/',
                     src: '//player.vimeo.com/video/%id%?autoplay=1'
                   },
                   gmaps: {
                     index: '//maps.google.',
                     src: '%id%&output=embed'
                   }*/ ?>
                 }
              }
            } else {
               item.type = 'image',
               item.tLoading = 'Загрузка рисунка #%curr%...',
               item.mainClass = 'mfp-img-mobile',
               item.image = {
                 tError: '<a href="%url%">Рисунок #%curr%</a> может быть загружен.'
               }
            }
        }
    }

  });
}
<?php } else { ?>
//$(document).ready(function() {
  function start_magnificPopup(){
  $('.thumbnails').magnificPopup({
    type:'image',
    delegate: 'a',
    gallery: {
      enabled:true
    }
  });
}
//});
<?php } ?>
$(document).ready(function(){
  $.fn.tabs = function() {
    var selector = this;
    this.each(function() {
      var obj = $(this);
      $(obj.attr('href')).hide();
      obj.click(function() {
        $(selector).removeClass('selected');
        $(this).addClass('selected');
        $($(this).attr('href')).fadeIn();
        $(selector).not(this).each(function(i, element) {
          $($(element).attr('href')).hide();
        });
        return false;
      });
    });
    $(this).show();
    $(this).first().click();
  };

  $('input[name="quantity"]').on('keyup',function(){
      q = parseInt($(this).val());
    if(q < <?php echo $minimum; ?>){
      $('.alert-info').attr('id','blink2');
      setInterval(function() {
          $('.alert-info').removeAttr('id');
          $('input[name="quantity"]').val(<?php echo $minimum; ?>);
      }, 3000 );

    }
  });


  $('#tabs a').tabs();
  $('#tabs2 a').tabs();
  $('#tabs3 a').tabs();


  $('.oneclick').on('click', function() {
      $('#ordercallback_qtyset').val($('#input-quantity').val());
      $('#ordercallback_qty').html('<b>'+$('#input-quantity').val()+' шт.'+'</b>');
      $('#ordercallback_price').html('<b>'+($('#input-quantity').val()*parseFloat($('.productprice').text())).toFixed(2)+' грн.'+'</b>');
  });

  $('#review').delegate('.pagination a', 'click', function(e) {
      e.preventDefault();
      $('#review').fadeOut('fast');
      $('#review').load(this.href);
      $('#review').fadeIn('fast');
  });

  $('.card-action-wrapper').click(function(e) {
      e.preventDefault();
      var url=$(this).data('url');
      if (url) {
          window.location=url;
      }
  });

  $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>&lang=<?php echo str_replace('/','',$langurl); ?>');
  $('#button-review').on('click', function() {
  	var label = $("#button-review").html();
  	$.ajax({
  		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
  		type: 'post',
  		dataType: 'json',
  		data: $("#form-review").serialize(),
  		beforeSend: function() {
  			$( "#button-review" ).html($("#button-review").data('loading-text'));
  		},
  		complete: function() {
  			$( "#button-review" ).html(label);
  		},
  		success: function(json) {
  			//console.log(json);
  			$('.success, .error').remove();
  			if (json['error']){
  				if (json['error']['name']) {
  					$('#form-review input[name="name"]').after('<div class="error">' + json['error']['name'] + '</div>');
  				}
  				if (json['error']['text']) {
  					$('#form-review textarea[name="text"]').after('<div class="error">' + json['error']['text'] + '</div>');
  				}
  				if (json['error']['rating']) {
  					$('#form-review .ratingg').after('<div class="error">' + json['error']['rating'] + '</div>');
  				}
  			}

  			if (json['success']) {
  				$('#form-review').after('<div class="success">' + json['success'] + '</div>');
  				$('input[name=\'name\']').val('');
  				$('textarea[name=\'text\']').val('');
  				$('input[name=\'rating\']:checked').prop('checked', false);
  			}
  			return false;
  		},
  		error: function(xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
  		}
  	});
  });

   $('#ordercallback_qtyset').on('keyup',function(){
      $('#ordercallback-button-send').show();
      $('.qerror').remove();
      if( parseInt($(this).val()) < <?php echo $minimum; ?>) {
        $('#ordercallback_qtyset').after('<div class="qerror"> <i class="fa fa-info-circle"></i>&nbsp;<?php echo $text_minimum2; ?><?php echo $minimum; ?> </div>');
        $('#ordercallback-button-send').hide();
      }
   });
});

$(document).ready(function() {

  gtag('event', 'view_item', {"items": [{"id": "<?php echo $model; ?>",
    "name": "<?php echo  str_replace('"', '\\"', $heading_title); ?>",
    "category": "<?php echo $breadcrumbs[count($breadcrumbs)-2]['text']; ?>","quantity": <?php echo $minimum; ?>,"price": '<?php echo floatval(str_replace(" ", "", $price)); ?>'}]});

  <?php if($featured) { ?>
  gtag('event', 'view_item_list', {"items": [<?php foreach ($featured as $key => $product) { ?>

  {"id": "<?php echo $product['model']; ?>",
  "name": "<?php echo str_replace('"','\"',$product['name']); ?>",
  "list": "Вместе с этим товаром покупают" ,
  "category": "<?php echo $breadcrumbs[count($breadcrumbs)-2]['text']; ?>",
  "list_position": <?php echo $key+1; ?>,"quantity": 1,
  "price": <?php echo $product['price_float']; ?> }<?php if(count($featured) != $key+1){?>,<?php } ?>
  <?php } ?>
  ]
  });
  <?php } ?>

<?php if (isset($action)&&$action) { ?>
  simple_tooltip(".actions a, .dar","tooltip");
  $(".thumbnail.first").removeAttr("title");
<?php } ?>
  simple_tooltip("[data-tooltip]","tooltip");
setTimeout(function() {
  fbq('track', 'ViewContent', {content_name: '<?php echo $heading_title; ?>', content_category: '<?php echo $breadcrumbs_text; ?>', content_ids: ['<?php echo $model; ?>'], content_type: 'product', value: '<?php echo floatval(str_replace(" ", "", $price)); ?>', currency: 'UAH'}
  );
}, 4000);

}) ;
</script>
<?php // для Google ремаркетинга  ?>
<input type="hidden" id="price_int" value="<?php echo ($special_int)? $special_int : $price_int;?>">
<?php include_once(DIR_APPLICATION.'view/theme/default/template/module/ordercallback_modal.tpl');?>

<script>
$(document).ready(function() {
var lang='';
language = jQuery('html').attr('lang');
if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
  $.ajax({
    url: 'index.php?route=product/getajax/getProductCompabilityList&product_id='+<?php echo $product_id; ?>+'&category_id='+<?php echo $category_id; ?>+lang,
    type: 'post',
    data: '',
    dataType: 'json',
    success: function(json) {
      if (json['error']) {$('#tab-compability, a[href="#tab-compability"]').remove();}
      if (json['html']) {
         $('#compabilities').append(json['html']);
      }

      if (json['html_pu']) {
         $('#tab-description').append(json['html_pu']);
      }
    },
      error: function(xhr, ajaxOptions, thrownError) {
          console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
  });
});
</script>
<?php echo $footer; ?>