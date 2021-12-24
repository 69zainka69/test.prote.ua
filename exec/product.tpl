

<?php echo $header; ?>
<?php
require_once('/var/www/prote/data/www/prote.ua/dostavka.php');
?>

<style>
.allatributes{
font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 14px;
line-height: 19px;
color: #00AEEF;
}
.otherattrib{
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 24px;
line-height: 35px;
color: #C4C4C4;
}
.symistpadleft{
  margin-left:25px;
}
.textakcict{
  margin-left: 129px;
    width: 357px;
    margin-top: -69px;
    font-family: Trebuchet MS;
    font-style: normal;
    font-weight: bold;
    font-size: 15px;
    line-height: 18px;
    color: #fcb7d4;
}
.clockss{
  padding-right: 18px;
    float: right;
    margin-top: -69px;
}
.akciaact{
  height: 100px;
    border: 2px solid #fcb7d4;
    border-radius: 5px;
    width: 100%;
    margin-bottom: 25px;
}
.dar div {
    color: black !important;
}
.aaaq{
  display:none !important;
}
.prodsumist{
  display:none !important;
}
.comp_pu{
  display:none !important;
}
.quantity span{
  cursor: pointer;
}
.swiper-container {
    padding-bottom: 50px !important;
}
.featured_title{
  font-family: Open Sans !important;
font-style: normal !important;
font-weight: normal !important;
font-size: 18px !important;
line-height: 17px !important;
color: #333333 !important;
}
.prodsumistss{
font-family: Open Sans;
font-style: normal;
font-weight: bold;
font-size: 20px;
line-height: 27px;
color: #333333 !important;
}
.panel-heading div{
  font-family: Open Sans;
font-style: normal;
font-weight: bold;
font-size: 14px;
line-height: 19px;
color: #333333;
}
.aaaq{
  padding-top: 19px !important;
    padding-left: 65px !important;
    height: 60px !important;
    color: black !important;
    background: #BEE9F9 !important;
    border-radius: 5px !important;

    font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 18px;
line-height: 17px;
}
h2{
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 24px;
line-height: 33px;
color: #00AEEF;
}

#product > div.form-group > input[type=text]:nth-child(2){
  margin: 0; width: 40px; border: none; padding: 0; text-align: center; line-height: 14px; color: #333; font-size: 18px; font-family: 'Open Sans',sans-serif; display: inline-block; vertical-align: middle;
}
#product > div.form-group{
border: solid 2px #E9E9E9;
border-radius: 5px;
width: 100%;
}

.left-price{
  
font-family: Trebuchet MS;
    float: left;
    font-style: normal;
    font-weight: normal;
    font-size: 45px;
    line-height: 52px;
    color: #333333;
    text-align: left !important;
    margin-bottom: -32px;
    margin-top: -15px;
}
.fasovkas{
  opacity: 0;
  font-family: Trebuchet MS;
font-style: normal;
font-weight: normal;
font-size: 14px;
line-height: 15px;
color: #C4C4C4;
}
.xarakfull{
    font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 24px;
line-height: 33px;
color: #C4C4C4;
}
.osnovxar{padding-top: 37px;
    padding-bottom: 30px;}
.xarakteristic{

color: #00AEEF;
}
.osnovxartext{
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 24px;
line-height: 35px;
color: #C4C4C4;
}
  @media only screen and (min-width: 1500px){
.adaptive{
    max-width: 1490px !important;
}
}
.fortitleleft{
  float:right;
  padding-top: 10px;
}
.starleft{
  padding-left:17px;
}
.borfercol{
  border: 1px solid #FD9710;
  padding-top: 10px;
    padding-bottom: 5px;
    padding-left: 9px;
    padding-right: 9px;
}
.item.active {
    background: none !important;
}
.altpanel .item:hover {
    background: none !important;
    -webkit-transition-property: background;
    -webkit-transition-duration: 0.5s;
    -webkit-transition-timing-function: ease;
}.titles{font-family: Open Sans; display: inline;
font-style: normal;
font-weight: normal;
font-size: 24px;
line-height: 36px;
color: #00AEEF;}
</style>



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
                  <div>  
                  <h1 class="titles"><?php echo $heading_title; ?>
                  </h1>    
                      <span class="fortitleleft"><span><?php echo $text_model; ?>   
                                <span><?php echo $sku; ?></span>
                      </span> 

                    <span class="starleft"> <?php if ($review_status) { ?>
  
              <?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($rating < $i) { ?>
              <span class="star"></span>
              <?php } else { ?>
              <span class="star ok"></span>
              <?php } ?>
              <?php } ?>
              <a href="#tab-review" onclick="$('html, body').animate({scrollTop: $('#tab-review').offset().top}, 350); return false;"><?php echo $reviews; ?></a>
          
        <?php } ?>
        </span>
     </span>
</div> 

<svg style="display:none;height:0;width:0;">
<style>
.titlefeatur{
  font-size: 22px !important;
  color:black !important;
}
.featured_title{font-size: 22px !important;
  color:black !important;
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
h1{color:#00adee;font-size:24px;line-height:36px;margin:10px 0;font-weight:normal;} h2{line-height:31px;} #content{margin-bottom:30px;display:flex;flex-wrap:nowrap;} .prod_left{width:65%;display:flex;} .prod_right{width:35%;} .prod_images{position: relative;}.prod_price{font-family:'Trebuchet MS';color:#333;width:100%;padding-right:50px} .prod_price .price{margin:54px 0 29px;font-size:30px;} .special_price{font-family:'Trebuchet MS';font-size:30px;color:#fd9710;margin-bottom:25px;} .old_price{font-family:'Trebuchet MS';font-size:20px;color:#d9d9d9;text-decoration:line-through;margin:40px 0 15px;} .model{font-size:15px;margin:10px 0;} .exist span{display:inline-block;vertical-align:middle;height:25px;padding-right: 5px;} .exist p{color:#999;font-family:'Trebuchet MS';font-size:15px;text-transform:lowercase;line-height:25px;display:inline-block;vertical-align:middle;} .image-additional{margin-top:20px;display:inline-block;} #button-cart{cursor:pointer;font-size:16px;line-height:28px;padding:5px 40px 5px 35px;margin-top:12px;} #button-cart .svg{display:inline-block;vertical-align:middle;width:28px;height:28px;} #button-cart svg{width:28px;height:28px;} .actions{padding-top:20px;} .actions a{color:#00adee;font-size:15px;font-family:'Trebuchet MS';display:block;padding:2px 0; } .actions a:hover{color:#fd9710;} .attributes{font-size:15px;font-family:'Trebuchet MS';line-height:23px;color:#333;margin-top:25px;}
.attr_text{color:#999;font-size:15px;font-family:'Trebuchet MS';}
.attr_text a{color:#f28b1c;text-decoration:underline;}.attr_text a:hover{text-decoration:none;}
.thumbnails li{list-style:none!important;margin:0!important;} .prod_right .category_name{display:inline-block;margin-top:14px;font-size:12px;color:#999;font-family:'Trebuchet MS';text-decoration:underline;} .prod_right .rating{text-align:right;margin:14px 40px 0;display:inline-block;float:right;} .prod_right .rating a{color:#00adee;text-decoration:underline;margin-left:30px;} .star{width: 0;height: 0;margin: 2px 0;position: relative;display: inline-block; border-right: 6px solid transparent;border-bottom: 4px solid #999;border-left: 6px solid transparent; -moz-transform: rotate(35deg);-webkit-transform: rotate(35deg);-ms-transform: rotate(35deg);-o-transform: rotate(35deg);} .star:before{content: '';height: 0;width: 0;position: absolute;display: block;top: -3px;left: -4px; border-bottom: 4px solid #999;border-left: 2px solid transparent;border-right: 2px solid transparent; -webkit-transform: rotate(-35deg);-moz-transform: rotate(-35deg);-ms-transform: rotate(-35deg);-o-transform: rotate(-35deg);} .star:after {content: '';width: 0;height: 0;position: absolute;display: block;top: 0;left: -6px; border-right: 6px solid transparent;border-bottom: 4px solid #999;border-left: 6px solid transparent; -webkit-transform: rotate(-70deg);-moz-transform: rotate(-70deg);-ms-transform: rotate(-70deg);-o-transform: rotate(-70deg);} .star.ok,.star.ok:before,.star.ok:after{border-bottom: 4px solid #00adee;} .htabs{height:40px;line-height:16px;border-bottom:3px solid #00adee;width:100%;} .info{display:flex;} .info .col_left{width:50%;} .info .col_right{width:50%;} .info .col_right .tab-content{padding-left:0;} .tab-content ul li{padding-left:15px;list-style: disc;    list-style-position: inside;} .htabs a{padding:12px 12px 11px;float: left;font-size: 13px;text-decoration: none;color: #00adee;margin-right: 2px;display: none;} .htabs a.selected {padding-bottom:9px;background:#00aff2;color:#fff;} #tabs2{padding-left:10px;} #tabs2 a{background:#bee9f9;color:#00adee;border-bottom:2px solid #00aff2;} #tab-description a{color:#00adee;} #tab-description a:hover{color:#fd9710;} #tab-description ul{margin-bottom:15px; } #tab-description li{list-style:disc; margin-left: 30px;} .tab-content{padding:25px 15px 20px;margin-bottom: 20px;z-index: 2;overflow: auto;width:100%;font-size:13px;color:#999;line-height:21px;font-family:'Trebuchet MS';} .tab-content p{color:#999;margin: 10px 0;}.tab-content td{color:#999;} .del_pay{padding-right:30px;} .del_pay .dflex{flex-wrap:wrap;margin-bottom:20px;border-top:1px solid #f2f2f2;} .h1{color:#00adee;font-size:13px;font-weight:normal;padding-left:15px;; padding:5px 0;line-height:36px;}
.brand{color:#999;font-family:'Trebuchet MS';padding-top:7px;}
.brand a{color:#f28b1c;text-decoration:underline;}.brand a:hover{text-decoration:none;}
.del_pay .dflex .item{justify-content: space-between;width:23%;text-align:center;padding:18px 5% 15px 0;} .del_pay .dflex .svg{padding-right:50px;} .del_pay .dflex svg{height:100%;min-height:56px;max-width:83px;} .del_pay .dflex .title{text-align:left;color:#999;font-family:'Trebuchet MS';font-size:11px;padding-top:15px;margin-bottom:5px;line-height:13px;} .del_pay .dflex .text{color:#cccccc;font-size:11px;line-height:16px;margin-bottom:12px;text-align:left;} .delivery .s1 svg{width:47px;} .delivery .s2 svg{width:35px;} .delivery .s3 svg{width:83px;} .delivery .s4 svg{width:79px;} .delivery .s5 svg{width:83px;} .delivery .s6 svg{width:50px;} .readycart, .preorder{display: flex; align-items: center; float: left; } .readycart a, .preorder a{font-size:12px; line-height: 14px; display: block; } .preorder a{color:#f28b1c;} .preorder:hover a{color:#00adee;} .readycart path{fill:#00adee;} .preorder path{fill:#f28b1c;} .readycart:hover path{fill:#f28b1c;} .readycart:hover a{color:#f28b1c;} .preorder:hover path{fill:#00adee;} .readycart .svg, .preorder .svg{width: 40px; } .pay .dflex svg{height:100%;min-height:62px;} .pay .nal svg{width:30px;} .pay .beznal svg{width:33px;} .pay .card svg{width:53px;} .oneclick.button{background:#bee9f9;color:#333;padding:10px 25px 10px 26px;} [lang="uk"] .oneclick.button{padding:10px 28px 10px 28px;} .oneclick.button:hover{background:#dbdbdb;} .thumbnail{position:relative;display: block;} .dar{z-index:5;margin-left: 15px;
    margin-top: 15px;width:70px;height:70px;} .dar div{color: #fff;text-align: center;position: absolute;margin-top: -27px;width: 100%;font-size: 12px;} #tab-description .comp_pu a{color:#999;} #tab-description .comp_pu a:hover{text-decoration:underline;color:#fd9710;} <?php if ($special || isset($action)&&$action) { ?>
<?php echo file_get_contents(DIR_APPLICATION.'view/js/tooltip.css'); ?>
<?php } ?>
@media (max-width: 1300px){#content{margin-bottom:64px;} .prod_price{margin-left:10px;padding-right:30px;} .prod_left{width:70%;} .prod_right{width:30%;} .price{margin: 44px 0;} .prod_right .category_name,.prod_right .rating,.ratingg label{display:none;} h1{font-size:20px;line-height:25px;height:110px;} .attributes{line-height:25px;} .info .col_left{width:68%;} .info .col_right{width:32%;} .reviews{padding-left:15px;} } @media (max-width: 991px){.del_pay .dflex .item{width:50%} #content{flex-wrap:wrap;} .prod_left{width:100%;} .prod_right{width:100%;} h1{height:auto;padding-top:30px;} } @media (max-width: 767px){.info{flex-wrap:wrap;} .info .col_left{width:100%;} .info .col_right{width:100%;} .prod_left>div{width:50%;} .prod_images img{max-width: 100%;} } @media (max-width: 576px) {/*320*/ .del_pay .dflex .item{width:100%} .prod_left{flex-wrap:wrap;} .prod_left>div{width:100%;} .htabs{display:flex;height:auto;} .prod_images img{max-width:100%;} } .ico_attr{position: absolute; bottom: -6px; left: 23px; } .ico{width: 114px; height: 114px; background: #A1E0EA; border-radius: 100%; padding: 20px 10px; text-align:center; z-index: 9; } .ico+.ico{margin-left: 12px; } .ico img {width: 50px;margin-bottom: 6px;} .ico div{line-height: 12px; color:#fff; font-size: 10px; } .ico.attr_17867{background: #FD9710; } .ico.attr_17867 img{width: 58px; margin-bottom: 4px; } .ico.attr_17870{background: #FD9710; } .ico.attr_17870 img{width: 32px; margin-bottom: 4px; }
.tooltip{position:absolute;z-index:999;left:-9999px;background-color:#ECF7FB;padding:5px;border:1px solid #BEE9F9;width:235px;padding:18px 16px;border-radius:16px;}
.tooltip:after,.tooltip:before{content:"";font-size: 0;line-height: 0;border-top: 20px solid transparent;border-bottom: 0 solid transparent;border-right: 21px solid #ECF7FB;position: absolute;bottom: 14px;left: -19px;}
.tooltip:before{border-right: 21px solid #BEE9F9;bottom: 13px;left: -21px;}
.tooltip p{margin:0;padding:0;color:#000;padding:2px 7px;font-size:12px;line-height: 17px;}
.dar img{pointer-events:none;}

.form-group{
  padding-bottom: 18px;
    padding-top: 6px;
}
#button-cart{
  width:50%;
  margin-left: 26%;
}
.readycart{
  display:none;
  }
  .preorder{display:none;}
  .product_minn {font-weight: normal;
font-size: 14px;
line-height: 15px;
    padding-left: 24px !important;
    margin: 0 0 0 !important;
  }
  .free-delivery-icon{
float:left;
    margin-left: 15px;
  }
  .exist{
    text-align: left;
    padding-bottom: 15px;
  }

.countdown-title {
  color: #396;
  font-weight: 100;
  font-size: 40px;
  margin: 40px 0px 20px;
}

.countdown {
width:170px;
height:55px;
border-radius:3px;
      background-color: #79d9f7;
  font-family: sans-serif;
  color: #fff;
  display: inline-block;
  font-weight: 100;
  text-align: center;
  font-size: 30px;
}

.countdown-number {

  border-radius: 3px;
  background: #79D9F7;
  display: inline-block;
}

.countdown-time {
 
  padding: 4px;
  padding-top:15px;
  border-radius: 3px;
  background: #79D9F7;
  display: inline-block;
  font-family: Open Sans;
font-style: normal;
font-weight: bold;
font-size: 20px;
line-height: 13px;
}

.countdown-text {
  padding-top:3px;
  display: block;
 font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 11px;
line-height: 15px;
text-align: center;
color: #333333;
}
.yexyclok{
    margin-left: 142px;
    width: 376px;
    margin-top: 15px;
    font-family: Trebuchet MS;
    font-style: normal;
    font-weight: bold;
    font-size: 15px;
    line-height: 18px;
    color: #00AEEF;
}
body > div:nth-child(11) > div:nth-child(3) > span > span:nth-child(1){
  padding-left:11px;
  padding-right:11px;
}
#product > div.exist > p{
  background-color: #F2F2F2;
  padding-left:11px;
  padding-right:11px;
}
.prod_price{
  width: 50%;
  padding-right: 0px;
}
body > div:nth-child(11) > div:nth-child(3) > span > span:nth-child(1){
  background-color: #F2F2F2;
}
.actionfreedel{
  height: 100px;
    border: 2px solid #79D9F7;
    border-radius: 5px;
    width: 100%;
    margin-bottom: 25px;
}
.yslovdel{
  z-index:99999999999;
 font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 13px;
line-height: 18px;
color: #999999;
}
</style>
</svg>
  
  <div style="display:block; flex-wrap: inherit;" class="row" id="content">
    <?php echo $content_top;?>
      <div style="width: 100%;" class="prod_left">
        <div style="position: sticky; text-align: center; width: 50%;" class="prod_images">
        
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
            <?php $numimag=0; ?>
            <?php foreach ($images as $image) { ?>
            <li style="display: flex;
    top: <?php echo $numimag; ?>8%;
    position: absolute;" class="image-additional"><a class="thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title, ' Фото ', $imgnum++; ?>"> <img alt="<?php echo $heading_title, ' Фото ', $imgnum++; ?>" class="" src="<?php echo $image['additional']; ?>" title="<?php echo $heading_title, ' Фото ', $imgnum; ?>" /></a></li>
            <?php $numimag=$numimag+2;
            if($numimag>10){
              $numimag=0;
            }
            } ?>
            <?php } ?>
          </ul>
        <?php } ?>
        </div>



        <div style="width: 50%;" id="product" class="prod_price">



<?php if ($special || isset($action) && $action) { ?>
        <div class="akciaact">
            <div class="dar" <?php if(isset($action[0]['short_description'])){ ?> data-tooltip="<?php echo $action[0]['short_description']; ?>" <? } ?> >
                <a href="<?php echo $action[0]['url']; ?>">
                    <img style="width: 65px;"
                        src="image/ico/favicon_prote_16x16.svg"
                        data-original="image/ico/action/label-fire-action.svg"
                        alt="<?php echo $text_action; ?>"
                        title="<?php echo $text_action; ?>"
                    />
                </a>
                <p class="textakcict">Купуйте будь-який комплект чорнила Barva - отримуйте знижку на фотопапір Barva -50%<br><br><a href="/ua/skidka-na-fotobumagu.html" 
                class="yslovdel">
                <?php echo $ymovakc; ?></a></p>
                <div style="text-align: left;
    margin-left: 15px;"><?php echo $text_action; ?></div>
            </div>
        </div>
        <?php } ?>




<div class="actionfreedel">
  <div
                class="free-delivery-plate <?php echo ($special || isset($action) && $action) ? 'with-action' : '' ?>"
                data-tooltip="<?php echo $text_freedelivery_paid; ?>"
            >
                <img style="width: 65px;"
                    class="free-delivery-icon"
                    src="image/ico/action/free-delivery-action.svg"
                    data-original="image/ico/action/free-delivery-action.svg"
                /> 
<p class="yexyclok"><?php echo $actdeliver; ?></p>
              
                <div class="clockss">
                
                <div id="countdown" class="countdown">
  <div class="countdown-number">
    <span class="days countdown-time"></span>
    <span class="countdown-text">дни</span>
  </div>
  <div class="countdown-number">
    <span class="hours countdown-time"></span>
    <span class="countdown-text">часы</span>
  </div>
  <div class="countdown-number">
    <span class="minutes countdown-time"></span>
    <span class="countdown-text">мин</span>
  </div>
  <div class="countdown-number">
    <span class="seconds countdown-time"></span>
    <span class="countdown-text">сек</span>
  </div>
</div></div>
                
                
                </div>
</div>


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
                    <p class="ifexist ico3"><?php echo $text_noexist; ?></p>
                <?php break; default: ?>
                    <p class="ifexist ico4"></p>
            <?php } ?>
             <?php if ($minimum > 1) { ?>
                <svg style="display:none;height:0;width:0;">
                  <style>
                  .product_minn{padding-left:35px;background:url('image/ico/min-order.svg')0 2px no-repeat;color:#fd9710;font-family:'Trebuchet MS';font-size:15px;line-height:15px;text-align:left;margin:24px 0 0;}
                  </style>
                </svg>
                  <div style="font-style: normal;
font-weight: normal;
font-size: 14px;
line-height: 15px; float:right;" class="product_minn"><?php echo $text_minimum; ?></div>
                <?php } ?>
          </div>
  






<?php if (isset($altpack) || isset($altcolors) || isset($altpack_color_Canon)) { ?>
           
            <svg style="display:none;height:0;width:0;">
            <style>
            .altpack, a.altpack{display:inline-block;font-family:'Trebuchet MS';color:#999;border:1px solid #999;margin-right:18px;font-size: 15px;min-width:60px;padding: 5px 9px;text-align:center;} .ac-active{color:#00adee;border-color:#00adee} a.altpack:hover{color:#00adee;border-color:#00adee} .altcolors{width:30px;height:30px;display:inline-block;} .item a{display:inline-block;vertical-align:middle;} .item .namecolor{padding-left:17px;color:#999;} .item a.namecolor{padding-left:14px;} .altpanel{margin-bottom:20px;} .altpanel .item{padding:2px 8px 2px;cursor:pointer;-webkit-transition-property: background;-webkit-transition-duration: 0.5s;-webkit-transition-timing-function: ease;} .item.active{background:#f4f3f5;cursor:default;} .altpanel .item:hover{background:#f4f3f5;-webkit-transition-property: background;-webkit-transition-duration: 0.5s;-webkit-transition-timing-function: ease;} .altpanel .item>div{display:inline-block;vertical-align:middle;} .altcol{border:1px solid #dadada;padding-top:2px;padding-bottom:2px;} .ac-black, .ac-photoblack{background:#000;} .ac-cyan{background:#00bff3;} .ac-lightcyan{background:#d0effc;} .ac-lightmagenta{background: #fed5ed;} .ac-magenta{background:#ec008c;} .ac-yellow {background:#fff200;} .ac-grey {background:#b7b7b7;} .ac-lightblack {background:#555;} .ac-matteblack {background:#acacac;} .ac-lightlightblack {background:#ebebeb;} @media (max-width: 1230px){.altpack, a.altpack{margin:0 0 5px;} }
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
                      <div class="altcolors ac-active ac-<?php echo $item['color'];?>">
                        <?php if (strpos($item['color'], 'b-c-m-y')!==false) { ?>
                          <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/multicolor.svg'); ?></span>
                        <?php } ?>
                      </div>
                        <div class="namecolor">- <?php echo $item['color_name']; ?></div>
                    <?php } else { ?>
                      <a href="<?php echo $item['href']; ?>" title="<?php echo $item['color'];?>" class="altcolors ac-<?php echo $item['color'];?>">
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

         
          <?php if (isset($altcolors) && !empty($altcolors)) { ?>
            <div style="border:none !important;" class="altpanel altcol" title="<?=$text_selaltcolor?>">
            <?php foreach ($altcolors as $item) { ?>
            <?php if(!isset($item['color'])) { continue;} ?>
              <div style="display: inline; border:none;" class="item<?php if ($item['active']) { ?> active<?php } ?>">
                <?php if ($item['active']) { ?>
                 <div class="borfercol"> <div display="display: inline; border:none;" class="altcolors ac-active ac-<?php echo $item['color'];?>">
                    <?php if (strpos($item['color'], 'b-c-m-y')!==false) { ?>
                      <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/multicolor.svg'); ?></span>
                    <?php } ?>
                  </div></div>
                    <div style="display:none;" class="namecolor">- <?php echo $item['color_name']; ?></div>
                <?php } else { ?>
                  <a href="<?php echo $item['href']; ?>" title="<?php echo $item['color'];?>" class="altcolors ac-<?php echo $item['color'];?>">
                    <?php if (strpos($item['color'], 'b-c-m-y')!==false) { ?>
                      <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/multicolor.svg'); ?></span>
                    <?php } ?>
                  </a>
                  <a href="<?php echo $item['href']; ?>" title="<?php echo $item['color'];?>" style="display:none;" class="namecolor">
                  - <?php echo (strpos($item['color'], 'b-c-m-y')!==false)?$text_multicolor:$item['color_name']; ?>
                  </a>
                <?php } ?>
              </div>
            <?php } ?>
            </div>
          <?php } ?>
          <?php if ($price) { ?>
            <?php if (!$special) { ?>
            <div class='price'><p class="left-price"><?php echo $price; ?></p>    
            <?php if (isset($altpack)) { 
            echo '<div style="float:right;"> <span class="fasovkas">'.$text_selaltpack.'</span>';  ?>
              <?php foreach ($altpack as $item) { ?> <style>.fasovkas{opacity:1 !important;}</style>
              <?php if ($item['active']) { ?>
           
                <span class="altpack <?php if ($item['active']) echo 'ac-active'; ?>">  <?php echo $item['packing']; ?></span>
              <?php } else { ?>
                  <a href="<?php echo $item['href']; ?>" title="<?php echo $item['packing']; ?>" class="altpack"><?php echo $item['packing']; ?></a>
              <?php } ?>
              <?php } ?>
            </div>
          <?php } ?></div>
            <?php } else { ?>
            <div class="old_price"><?php echo $price; ?></div>
            <div class="special_price"><?php echo $special; ?></div>
            <?php } ?>
          <?php } ?>
         

         <div class="form-group">
            <?php if($ifexist<2) { ?>

              <!-- <label class="control-label" for="input-quantity"><?php echo $entry_qty; ?></label> -->
              <div style="font-style: normal;
font-weight: bold;
font-size: 28.2609px;
line-height: 19px; position: absolute; margin-left: 20px; margin-top: 12px;" class="quantity">
							<span style="color: #fd9710;" onclick="updateCart('215', '22486', '-')">-</span>
							<input type="text" style="width: 53% !important;
    border: none;
    color: #fd9710;
    text-align: center;
    font-style: normal;
    font-weight: bold;
    font-size: 28.2609px;
    line-height: 19px;" name="22486" size="2" value="1" onkeyup="updateCart('215', '22486')">
															<span style="color: #fd9710;" onclick="updateCart('215', '22486', '+')">+</span>



                              
							
						</div>
              <input type="hidden" name="quantity" value="<?php echo $minimum; ?>" id="input-quantity" class="form-control" />
              <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
              <a href="#" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" onclick="cart.add('<?php echo $product_id; ?>', '<?php echo $minimum; ?>');return false;" class="button">
         
              <?php echo $button_cart; ?></a>
                <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                    <a href="#ordercallback-modal" data-modal="ordercallback-form" style="margin-top:10px;" class="oneclick button"
                          onclick="ordercallback_modal_show('<?php echo $product_id; ?>','<?php echo $thumb; ?>','<?php echo $heading_title; ?>','<?php echo ($special_float ? $special_float : $price_float); ?>','<?php echo $minimum; ?>'); return false;">
                          <?php echo strip_tags($button_cartone); ?>
                          </a>
                <?php } ?>

                
               
            <?php } ?>

</div>



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


      

        <div style="display:none;" class="category_name">
          <?php if($category_info){ ?>
              <a href="<?php echo $category_info['href']; ?>" title="<?php echo $category_info['text']; ?>"><?php echo $category_info['text']; ?></a>
          <? } ?> /
        </div>
        
        <?php if($brand){ ?>
          <div style="display:none;" class="brand"><a href="<?php echo $brand['href']; ?>" title="<?php echo $brand['text']; ?>"><?php echo $brand['text']; ?></a></div>
        <?php } ?>
     


  <div class="row info">
    <div class="col_left">
    

      <div id="tab-description" class="tab-content">
        <?=(strip_tags($description)<>'' ? $description : ($ax_description<>'' ? $ax_description : $tag))?>
        
        <div class="attributes"> 
        <p class="xarakfull"><span class="xarakteristic">Характеристики </span><?php echo $heading_title; ?></p>

  <div class="osnovxar">
        <p class="osnovxartext">Основні характеристики:</p>
   </div>
            <?php foreach ($attribute_groups as $attribute_group) { ?> 
            <?php foreach ($attribute_group['attribute'] as $attribute) { ?> 









<?php
echo "<p>dddd</p>";
$time_start = microtime(true);
ini_set("memory_limit","512M");
ini_set('max_execution_time', 600003);
require_once('/var/www/prote/data/www/test.prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}

echo "<p>qqq</p>";
$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");
$sql = "SELECT * FROM `oc_product_to_category` WHERE `product_id` = $product_id";
$result = $dbcnx->query($sql);

echo "<p>еееее</p>";
foreach($result as $ress){
    $catid=$ress['category_id'];
}
$sql = "SELECT * FROM `attrincatgroup` WHERE `idcat` = $catid AND `view` = 1 ORDER BY `attrincatgroup`.`sort` ASC";
$resultinger = $dbcnx->query($sql);

echo "<p>щщщ</p>";
foreach($resultinger as $re){
    $name=$re['nameattr'];
    $sort=$re['sort'];
    $firstattrib[$name]=array("$name", "$sort");
}

echo "<p>ттттттт</p>";
if(empty($firstattrib[$name][1])){

echo "<p>ддддддгш</p>";
?>
 <div><span class="attr_name"><?php echo $attribute['name']; ?>:</span>
                  <?php if($attribute['href']){ ?>
                    <span class="attr_text"><a href="<?php echo $attribute['href']; ?>" title="<?php echo $attribute['text']; ?>"><?php echo $attribute['color_atr']?$attribute['color_atr']:$attribute['text']; ?></a></span>
                  <?php } else { ?>
                    <span class="attr_text"><?php echo $attribute['color_atr']?$attribute['color_atr']:$attribute['text']; ?></span>
                  <?php } ?>
              </div>
                  <?php

}
else{

$sql = "SELECT * FROM `attrincatgroup` WHERE `idcat` = $catid AND `view` = 0 ORDER BY `attrincatgroup`.`sort` ASC";
$resulting = $dbcnx->query($sql);
foreach($resulting as $resp){
  $name=$resp['nameattr'];
  $sort=$resp['sort'];
  $otherattrib[$name]=array("$name", "$sort");
}

$name = $attribute['name'];
$link = $attribute['href'];
$value = $attribute['text'];
$color = $attribute['color_atr'];
$atributesort[$name]= array("$name", "$link", "$value", "$color");
$sortirnumber = $firstattrib[$name][1]-1;
$otsort[$sortirnumber] = array("$name", "$link", "$value", "$color");
$sortirnumber = $otherattrib[$name][1]-1;
$otsortotherattrib[$sortirnumber] = array("$name", "$link", "$value", "$color");
}
}
for($i=0; $i!=30; $i++){
if(isset($otsort[$i][0])){
?>
<div>
      <span class="attr_name"><?php echo $otsort[$i][0]; ?>:</span> 
<?php if($otsort[$i][1]){ ?> 
      <span class="attr_text">
            <a href="<?php echo $otsort[$i][1]; ?>" title="<?php echo $otsort[$i][2]; ?>">
            <?php echo $otsort[$i][3]?$$otsort[$i][3]:$otsort[$i][2]; ?></a></span> 
<?php } else { ?> <span class="attr_text"><?php echo $otsort[$i][3]?$otsort[$i][3]:$otsort[$i][2]; ?></span> 
<?php } ?> </div> <?php }}} ?> 


<?php
$countotherattrib = count($otsortotherattrib);
if($countotherattrib>1){


echo '<a onclick="openbox'; echo "('box'); "; echo 'return false">Всі характеристики  >><i class="mdi mdi-chevron-down f_right"></i></a>';

echo '<div id="box" style="display: none;"><p class="otherattrib">Інші характеристики:</p>';



for($i=0; $i!=50; $i++){
if(isset($otsortotherattrib[$i][0])){
?>

<div class="dropdown-block">
      <span class="attr_name"><?php echo $otsortotherattrib[$i][0]; ?>:</span> 
<?php if($otsortotherattrib[$i][1]){ ?> 
      <span class="attr_text">
            <a href="<?php echo $otsortotherattrib[$i][1]; ?>" title="<?php echo $otsortotherattrib[$i][2]; ?>">
            <?php echo $otsortotherattrib[$i][3]?$$otsortotherattrib[$i][3]:$otsortotherattrib[$i][2]; ?></a></span> 
<?php } else { ?> <span class="attr_text"><?php echo $otsortotherattrib[$i][3]?$otsortotherattrib[$i][3]:$otsortotherattrib[$i][2]; ?></span> 
<?php } ?> </div>


 <?php }}
 
 echo "</div>";
 }?>



</div>

            
      
      <script type="text/javascript">

function openbox(id){
    display = document.getElementById(id).style.display;

    if(display=='none'){
       document.getElementById(id).style.display='block';
    }else{
       document.getElementById(id).style.display='none';
    }
}
</script>

    
       <p class="aaaq">Сумісність</p>
 </div>
      <div id="tab-compability" class="tab-content" style="display:none;"></div>
      <?php if($video){ ?>
      <div id="tab-video" class="tab-content">
      	<style> #tab-video iframe{max-width: 100%; } </style>
        <?php echo $video; ?>
      </div>
      <?php } ?>

    </div>








    <div class="col_right">



<style>

.dostavka{
  width:100%
  height: 380px;
  border:1px solid #E9E9E9;
  border-radius:5px;
  margin-bottom: 15px;
}
.obmin-povern{
float:right;
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 12px;
line-height: 13px;
color: #999999;
}
.dostcity{
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 13px;
line-height: 18px;
color: #333333;
  border-bottom: 1px dotted #FD9710; 
}

.info .col_right {
    width: 49% !important;
}
tr, td, th, table{
  border:none;
  text-align:left;
}
.titletable{
  vertical-align: sub;
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 12px;
line-height: 13px;
color: #999999;
}
.texttable tr{
   vertical-align: sub;
}
.texttable tr td{
   vertical-align: sub;
}
.texttable td{
  vertical-align: sub;
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 13px;
line-height: 18px;
color: #333333;
}
.texttable{
  padding-left: 24px;
  vertical-align: sub;
  padding-top: 7px;
  padding-bottom: 7px;
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 13px;
line-height: 18px;
color: #333333;
}
.commentdostavka{
  padding-left:15px;
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 12px;
line-height: 13px;
color: #999999;
}
.texttable td svg{
  vertical-align: sub;
}
.obmin-povern{
  padding-top:8px;
}
.oplatadost{
  margin-bottom:25px;
  width: 100%;
  height:143px;
  border:1px solid #E9E9E9;
  border-radius:5px;
}
.oplatadostup{
  border:1px solid #E9E9E9;
}
.oplatadostniz{
      padding-top: 11px;
    padding-left: 24px;
    padding-right: 20px;
  height: 68px;
  
}
.oplatadostniz table tbody tr td{
  padding-left: 6px;
    padding-right: 6px;
  font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 11px;
line-height: 13px;
color: #333333;
}
.etxtovkaopl{
  padding-left:15px;
font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 12px;
line-height: 14px;
color: #999999;
}
.textopl{
  padding-left:18px;
font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 15px;
line-height: 18px;
color: #333333;
}
.tabledost{
   border:1px solid #E9E9E9;
  height: 330px;
}
.dostithead{
  height:48px;
  padding-left:24px;
  padding-right:26px;
  padding-top: 11px;
  border:1px solid #E9E9E9;
}
.panel-titles{
      font-family: Open Sans;
font-style: normal;
font-weight: bold;
font-size: 14px;
line-height: 19px;
color: #333333;
    }
    .symlink{
        color: #00adee;
        cursor: pointer;
    }
    .symlink:hover{
    color: #f28b1c;
    }
</style>
<div class="dostavka">

 
<div class="dostithead"><p><?php echo $dostav; ?><svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M6.33808 0C2.83814 0 0 2.45897 0 6.08832C0 10.2024 6.33808 17 6.33808 17C6.33808 17 12.6762 10.3206 12.6762 6.08832C12.6762 2.45897 9.83802 0 6.33808 0ZM6.33951 1.7851C3.78137 1.7851 1.71959 3.58204 1.71959 6.23016C1.71959 9.17383 6.32678 14.1863 6.32678 14.1863C6.32678 14.1863 10.9467 9.43391 10.9467 6.23016C10.9467 3.59386 8.89764 1.7851 6.33951 1.7851Z" fill="#FD9710"/>
<path d="M6.33774 8.08623C7.60295 8.08623 8.62861 7.13351 8.62861 5.95828C8.62861 4.78304 7.60295 3.83032 6.33774 3.83032C5.07253 3.83032 4.04688 4.78304 4.04688 5.95828C4.04688 7.13351 5.07253 8.08623 6.33774 8.08623Z" fill="#FD9710"/>
</svg> <span class="dostcity top-panel__city-name" style="display: contents;" data-city>

<?php 
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (strpos($url, 'prote.ua/ua/') !== false) {
echo $_COOKIE['city_UA'];
}
else {
  echo $_COOKIE['city_RU'];
}      
                  ?>

</span> <span class="obmin-povern"><?php echo $obmin; ?></span></p> </div>
<div class="tabledost">
<table style="width: 100%;" border="1">
   
   <tr>
   <th style="padding-left: 3%;" class="titletable" colspan="2"><?php echo $typeperevoz; ?></th>
    <th style="width: 125px;" class="titletable"><?php echo $dateotp; ?></th>
    <th class="titletable"><?php echo $primernopribude;  ?></th>
    <th class="titletable"><?php echo $stoimost; ?></th>
   </tr>
   <tr class="texttable"><td class="texttable"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.9727 6.1682L20.6413 0.532728C20.5706 0.220135 20.3001 0 19.9964 0H2.68848C2.38475 0 2.11432 0.220135 2.04359 0.532728L0.712209 6.1682C0.699727 6.22543 0.691406 6.28267 0.691406 6.3399C0.691406 7.51983 1.2198 8.56327 2.02279 9.20166V19.0197C2.02279 19.4071 2.32235 19.7241 2.68848 19.7241H9.34537C9.7115 19.7241 10.0111 19.4071 10.0111 19.0197V14.0887H12.6738V19.0197C12.6738 19.4071 12.9734 19.7241 13.3395 19.7241H19.9964C20.3625 19.7241 20.6621 19.4071 20.6621 19.0197V9.20166C21.4651 8.56327 21.9935 7.51983 21.9935 6.3399C21.9935 6.28267 21.9852 6.22543 21.9727 6.1682ZM19.3307 18.3153H14.0052V13.3842C14.0052 12.9968 13.7056 12.6798 13.3395 12.6798H9.34537C8.97924 12.6798 8.67968 12.9968 8.67968 13.3842V18.3153H3.35416V9.80483C3.51643 9.83565 3.68285 9.86207 3.85343 9.86207C4.86861 9.86207 5.77145 9.32934 6.34977 8.50163C6.92809 9.32934 7.83093 9.86207 8.8461 9.86207C9.86128 9.86207 10.7641 9.32934 11.3424 8.50163C11.9208 9.32934 12.8236 9.86207 13.8388 9.86207C14.854 9.86207 15.7568 9.32934 16.3351 8.50163C16.9134 9.32934 17.8163 9.86207 18.8314 9.86207C19.002 9.86207 19.1685 9.83565 19.3307 9.80483V18.3153ZM18.8314 8.4532C17.8204 8.4532 17.0008 7.50662 17.0008 6.3399C17.0008 5.95246 16.7012 5.63547 16.3351 5.63547C15.969 5.63547 15.6694 5.95246 15.6694 6.3399C15.6694 7.50662 14.8498 8.4532 13.8388 8.4532C12.8278 8.4532 12.0081 7.50662 12.0081 6.3399C12.0081 5.95246 11.7086 5.63547 11.3424 5.63547C10.9763 5.63547 10.6768 5.95246 10.6768 6.3399C10.6768 7.50662 9.85712 8.4532 8.8461 8.4532C7.83509 8.4532 7.01546 7.50662 7.01546 6.3399C7.01546 5.95246 6.7159 5.63547 6.34977 5.63547C5.98364 5.63547 5.68408 5.95246 5.68408 6.3399C5.68408 7.50662 4.86445 8.4532 3.85343 8.4532C2.86738 8.4532 2.06023 7.55065 2.02279 6.42355L3.20855 1.40887H19.4763L20.6621 6.42355C20.6247 7.55065 19.8175 8.4532 18.8314 8.4532Z" fill="#FD9710"/>
</svg></td><td style="width: 206px;">
<?php echo $samos; ?></td>
<td><?php echo $samosotpr; ?></td>
<td><?php echo $samospolych; ?></td>
<td><?php echo $besplatka;  ?></td>
</tr>
   <tr  class="texttable"><td class="texttable"><svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.6591 11.1991V1.13486C2.6591 0.776504 2.95058 0.48291 3.31602 0.48291H20.8702C21.2313 0.48291 21.5271 0.772187 21.5271 1.13486V12.0022C21.8447 12.0496 22.1536 12.1705 22.4276 12.3691C23.289 12.9736 23.4935 14.3336 22.7713 15.1712L19.8217 18.7203C17.9945 20.8402 16.0542 21.1036 13.1698 21.1036C10.6944 21.1036 9.58505 21.1165 7.43157 20.6286L5.33029 20.1278C4.99095 20.5984 4.44715 20.905 3.84243 20.905H2.80702C1.78031 20.905 0.940666 20.0285 0.940666 18.9534V13.142C0.931965 12.1187 1.6933 11.2725 2.6591 11.1991ZM5.60437 12.5375L6.47882 12.0971C7.91447 11.3761 9.572 11.3502 11.0338 12.0237C11.4297 12.1792 12.2997 12.7016 12.7478 12.6843H15.7758C16.7807 12.6843 17.5986 13.496 17.5986 14.4934V14.9683C17.603 14.964 17.6117 14.9554 17.616 14.951L19.7782 12.6196C19.9087 12.4771 20.0566 12.3605 20.2132 12.2655V5.81078H14.8535V8.19407C14.8535 8.55243 14.562 8.84602 14.1965 8.84602H10.0636C9.70251 8.84602 9.40668 8.55674 9.40668 8.19407V5.81078H3.96859V11.1991C4.73428 11.2595 5.37379 11.8035 5.60437 12.5375ZM13.5396 5.81078H10.7162V7.54212H13.5396V5.81078ZM3.96859 4.51119H9.40668V1.7825H3.96859V4.51119ZM10.7162 1.7825V4.51119H13.5396V1.7825H10.7162ZM14.8535 1.7825V4.51119H20.2132V1.7825H14.8535ZM7.7274 19.3636C9.71992 19.8169 10.9206 19.7997 13.1394 19.7997C15.8497 19.7997 17.1549 19.7565 18.8037 17.8956L21.7577 14.3423C22.271 13.6774 21.34 12.8959 20.744 13.496L18.5818 15.8275C18.0119 16.4277 17.2897 16.7558 16.4022 16.7731H10.4029C10.0419 16.7731 9.74602 16.4838 9.74602 16.1211C9.74602 15.7584 10.0375 15.4692 10.4029 15.4692H16.2891V14.4847C16.2891 14.2041 16.0585 13.9753 15.7758 13.9753H12.7478C12.0648 14.0228 11.0816 13.4572 10.4812 13.1938C9.38928 12.6886 8.14505 12.7102 7.07048 13.2456L5.70008 13.9364V18.8671L7.7274 19.3636ZM2.24146 18.9577C2.24146 19.3161 2.48943 19.6054 2.79397 19.6054H3.82938C4.13391 19.6054 4.38189 19.3161 4.38189 18.9577V13.142C4.38189 12.7836 4.13391 12.4944 3.82938 12.4944H2.79397C2.48943 12.4944 2.24146 12.7836 2.24146 13.142V18.9577Z" fill="#FD9710"/>
</svg></td><td><?php echo $kyrkyiv;  ?></td>
 <td><?php echo $kyrotp; ?></td>
 <td><?php echo $kypolych; ?></td>
 <td>60 грн.</td></tr>
   <tr  class="texttable"><td class="texttable"><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19.3999 7.79605C19.4636 7.76481 19.5591 7.82728 19.6547 7.95222C19.6547 7.95222 19.6547 7.95222 24.0183 12.1064C24.2731 12.3563 24.2731 12.7311 24.0183 12.9185C24.0183 12.9185 24.0183 12.9185 19.6547 17.1352C19.5591 17.2602 19.4636 17.2914 19.3999 17.2602C19.3362 17.2289 19.2725 17.104 19.2725 16.9478V8.07716C19.2725 7.92098 19.3362 7.82728 19.3999 7.79605Z" fill="#ED1C24"/>
<path d="M11.9504 0.862061H12.2689L12.5556 0.986999C12.5556 0.986999 12.5556 0.987 17.0466 5.32862C17.2377 5.5785 17.174 5.76591 16.8555 5.76591C16.8555 5.76591 16.8555 5.76591 15.0081 5.76591C14.6896 5.76591 14.4348 6.01579 14.4348 6.32813C14.4348 6.32813 14.4348 6.32813 14.4348 9.54531C14.4348 9.85766 14.18 10.1075 13.7977 10.1075C13.7977 10.1075 13.7977 10.1075 10.5489 10.1075C10.2304 10.1075 9.97561 9.85766 9.97561 9.54531C9.97561 9.54531 9.97561 9.54531 9.97561 6.32813C9.97561 6.01579 9.7208 5.76591 9.40228 5.76591H7.42751C7.109 5.76591 7.0453 5.5785 7.2364 5.32862C7.2364 5.32862 7.2364 5.32862 11.7274 0.986999C11.6637 0.986999 11.9504 0.862061 11.9504 0.862061Z" fill="#ED1C24"/>
<path d="M4.94084 7.70243C5.03639 7.73366 5.06824 7.8586 5.06824 8.01478V17.0728C5.06824 17.229 5.00454 17.3227 4.94084 17.354C4.87714 17.3852 4.74973 17.354 4.62233 17.2603C4.62233 17.2603 4.62233 17.2603 0.195013 12.9186C-0.0597961 12.7312 -0.0597961 12.3564 0.195013 12.1065C0.195013 12.1065 0.195013 12.1065 4.62233 7.82737C4.74973 7.70243 4.84529 7.67119 4.94084 7.70243Z" fill="#ED1C24"/>
<path d="M10.5166 14.8552C10.5166 14.8552 10.5166 14.8552 13.7654 14.8552C14.1476 14.8552 14.4024 15.1051 14.4024 15.4174C14.4024 15.4174 14.4024 15.4174 14.4024 18.822C14.4024 19.1968 14.6572 19.4467 14.9757 19.4467H16.6957C17.0142 19.4467 17.1416 19.6341 16.8868 19.8215C16.8868 19.8215 16.8868 19.8215 12.5232 24.1007C12.4277 24.2256 12.2684 24.2881 12.1091 24.2881C11.9499 24.2881 11.7906 24.2256 11.6632 24.1007C11.6632 24.1007 11.6632 24.1007 7.29961 19.8215C7.0448 19.6341 7.17221 19.4467 7.49072 19.4467C7.49072 19.4467 7.49072 19.4467 9.33809 19.4467C9.6566 19.4467 9.91141 19.1968 9.91141 18.822C9.91141 18.822 9.91141 18.822 9.91141 15.4174C9.94326 15.1051 10.1981 14.8552 10.5166 14.8552Z" fill="#ED1C24"/>
</svg></td><td><?php echo $vidnp; ?></td>
<td><?php echo $nichotp; ?></td>
<td><?php echo $nichpolych; ?></td>
<td><?php echo $tarperevoz; ?> </td>
</tr>
   <tr class="texttable"><td class="texttable"><svg width="27" height="19" viewBox="0 0 27 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.0303 1.8135L13.0537 10.4734C12.4744 13.0544 9.88438 14.6505 7.29437 14.0732C4.70435 13.4958 3.10263 10.9149 3.68197 8.33388C4.26132 5.7529 6.85134 4.15676 9.40728 4.73409C10.7023 5.03973 11.7587 5.82082 12.4062 6.83963C12.4403 6.87359 12.4744 6.87359 12.5085 6.87359C12.5766 6.87359 12.6107 6.83963 12.6107 6.77171L13.4968 2.93419C13.5309 2.83231 13.4968 2.76439 13.3945 2.69647C11.9973 1.6437 10.2252 0.998457 8.31674 0.998457C3.92053 1.03242 0.274053 4.49637 0.00141953 8.9112C0.00141953 8.94516 0.00141954 9.18289 0.00141954 9.28477C-0.0326596 11.1865 0.546687 13.1562 1.73946 14.8882C4.77251 19.2012 10.7704 20.2539 15.0985 17.2315L26.1061 9.52249C26.1402 9.48853 26.1742 9.42061 26.1742 9.38665C26.1742 9.31873 26.1402 9.28477 26.1061 9.25081L15.303 1.71162C15.2689 1.67766 15.2348 1.67766 15.2007 1.67766C15.1326 1.67766 15.0644 1.71162 15.0303 1.8135Z" fill="#FABC26"/>
</svg></td><td><?php echo $vidurkp; ?></td><td><?php echo $ukrotp; ?></td><td><?php echo $ukrpolych; ?></td><td><?php echo $tarperevoz; ?> </td></tr>

   <tr class="texttable">
   <td class="texttable"><svg width="23" height="28" viewBox="0 0 23 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.6657 27.6117C17.4897 27.3315 17.3272 27.0714 17.1715 26.8046C16.3184 25.3571 15.472 23.9096 14.6257 22.4555C14.2262 21.7751 14.2059 21.7685 13.5085 22.1687C12.933 22.4955 12.3575 22.8157 11.7617 23.1092C11.6195 23.1826 11.3758 23.1692 11.2268 23.1025C10.6513 22.829 10.0893 22.5155 9.52737 22.2087C9.21592 22.0353 9.13467 22.0753 9.1279 22.4355C9.12113 22.9224 9.11436 23.416 9.13467 23.903C9.14821 24.1765 9.05342 24.2632 8.76906 24.2632C7.11024 24.2498 5.45142 24.2565 3.7926 24.2565C3.31865 24.2565 3.29157 24.2765 3.29157 24.7434C3.29157 25.2237 3.29834 25.6973 3.29157 26.1776C3.27803 26.9847 2.78377 27.4716 1.98483 27.4649C1.24682 27.4649 0.766104 26.9647 0.766104 26.1709C0.759333 24.8235 0.772875 23.4827 0.759333 22.1353C0.752562 21.8218 0.867664 21.7418 1.17235 21.7484C2.81762 21.7618 4.46967 21.7551 6.11495 21.7551C6.55504 21.7551 6.56858 21.7151 6.60244 21.2749C6.64306 20.8079 6.48733 20.5478 6.04047 20.321C4.36811 19.4605 2.72283 18.54 1.05724 17.6529C0.840581 17.5395 0.772875 17.4061 0.772875 17.1793C0.772875 15.5917 0.766104 13.9975 0.752562 12.41C0.739021 10.6423 0.73225 8.87469 0.691626 7.11372C0.684856 6.68681 0.833811 6.46669 1.21297 6.26658C3.35251 5.15264 5.47173 4.01201 7.59773 2.87805C8.7826 2.24437 9.97424 1.61068 11.1659 0.990342C11.3013 0.923638 11.5383 0.903627 11.6601 0.970331C13.82 2.11096 15.9663 3.2716 18.1194 4.42557C19.311 5.06592 20.5027 5.71294 21.7078 6.32662C22.0464 6.50004 22.1953 6.68014 22.1953 7.08703C22.175 10.3889 22.1818 13.6907 22.1886 16.9925C22.1886 17.3327 22.0938 17.5261 21.7755 17.6929C20.0964 18.5734 18.4444 19.4872 16.772 20.3877C16.5283 20.5144 16.4335 20.6545 16.596 20.9147C17.2053 21.9219 17.8147 22.9358 18.4105 23.9497C18.5595 24.2098 18.7017 24.2632 18.9725 24.0964C19.3652 23.8629 19.7782 23.6562 20.1912 23.4561C20.8615 23.1159 21.6401 23.3093 21.9448 23.9296C22.2021 24.4566 22.1818 25.2704 21.3896 25.6706C20.7667 25.9841 20.1573 26.311 19.5412 26.6311C18.9386 26.9446 18.3293 27.2582 17.6657 27.6117ZM10.1774 15.8785C10.1841 14.7579 10.1774 13.6306 10.1841 12.51C10.1841 12.2966 10.1503 12.1298 9.92684 12.0164C9.16853 11.6495 8.42375 11.2627 7.6722 10.8891C6.36546 10.2421 5.05195 9.60842 3.74521 8.9614C3.32542 8.75462 3.24418 8.78797 3.24418 9.26157C3.2374 11.3827 3.23063 13.5106 3.24418 15.6317C3.24418 15.7985 3.37959 16.0253 3.52177 16.112C4.04312 16.4322 4.59831 16.7123 5.13997 16.9992C6.68368 17.8263 8.2274 18.6467 9.77112 19.4739C10.0758 19.6339 10.1774 19.5873 10.1774 19.2471C10.1774 18.1265 10.1774 17.0058 10.1774 15.8785ZM15.1403 13.8908C15.1267 13.684 15.12 13.5639 15.12 13.4439C15.12 12.7968 15.1267 12.1565 15.12 11.5095C15.1132 11.0959 15.0319 11.0492 14.6596 11.216C14.1179 11.4628 13.583 11.7229 13.0346 11.9497C12.7434 12.0698 12.6351 12.2365 12.6351 12.5567C12.6487 14.7446 12.6487 16.9325 12.6487 19.1203C12.6487 19.207 12.6487 19.3004 12.6554 19.3871C12.669 19.5939 12.7705 19.6673 12.9669 19.5739C13.1768 19.4739 13.3867 19.3671 13.5966 19.2604C15.4788 18.2665 17.3611 17.266 19.2501 16.2921C19.6022 16.112 19.7308 15.8986 19.724 15.5117C19.7105 13.6907 19.7173 11.8697 19.7173 10.042C19.7173 9.72849 19.724 9.42165 19.7105 9.10815C19.7037 8.8947 19.6022 8.80131 19.3787 8.90137C18.9115 9.12149 18.4511 9.35495 17.984 9.5684C17.7334 9.6818 17.6454 9.8619 17.6454 10.122C17.6522 10.6423 17.5913 11.176 17.659 11.6896C17.7538 12.4166 17.5642 12.8769 16.8059 13.117C16.2574 13.2971 15.7429 13.604 15.1403 13.8908ZM13.3393 9.15484C13.0955 8.99475 12.9601 8.90137 12.8179 8.82132C11.0914 7.88748 9.37165 6.95363 7.63835 6.03312C7.4894 5.95308 7.25242 5.89971 7.11701 5.95975C6.56181 6.19988 6.02693 6.4867 5.48527 6.76019C5.27538 6.86691 5.21445 7.00032 5.4785 7.13373C5.99984 7.39387 6.52119 7.66068 7.03576 7.92083C8.21386 8.51449 9.4055 9.10148 10.5768 9.71515C11.0982 9.98863 11.5924 10.2688 12.1409 9.78852C12.1612 9.76851 12.2086 9.76851 12.2356 9.75517C12.5742 9.5684 12.9127 9.38163 13.3393 9.15484ZM9.93361 4.46559C10.0961 4.57232 10.1774 4.63235 10.2586 4.67237C11.9377 5.59288 13.6304 6.50004 15.2892 7.4539C15.8241 7.76074 16.2913 7.86747 16.8262 7.52061C17.1105 7.34051 17.4355 7.21377 17.8282 7.02033C17.5845 6.86024 17.4288 6.74685 17.2527 6.65346C15.6481 5.78632 14.0231 4.94585 12.4388 4.03869C11.8565 3.70517 11.3825 3.59845 10.8206 4.00534C10.5836 4.19211 10.2789 4.29216 9.93361 4.46559Z" fill="#304FFE"/>
</svg></td><td><?php echo $vidjust;  ?></td>
 <td><?php echo $nichotp; ?></td>
 <td><?php echo $nichpolych; ?></td>
 <td><?php echo $tarperevoz; ?></td>
 </tr>
   <tr class="texttable">
<td class="texttable"><svg width="17" height="23" viewBox="0 0 17 23" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.488281 14.5653H5.61775V8.23108H0.488281V14.5653Z" fill="#0862AF"/>
<path d="M10.9572 0.817067L16.6254 11.3981L10.9572 22.0272H5.21873L10.8869 11.3981L5.19531 0.817067H10.9572C10.9572 0.793074 10.9572 0.793074 10.9572 0.817067Z" fill="#ED1C24"/>
</svg></td>
<td> <?php echo $vidilmeest;  ?></td>
<td><?php echo $nichotp; ?></td>
<td><?php echo $nichpolych; ?></td>
<td><?php echo $tarperevoz; ?> </td>
</tr>
   <tr class="texttable">
   <td class="texttable"><svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.2902 0.379395H11.7632L12.0577 1.09481L12.4365 0.505644L13.9515 0.842308L13.9936 1.51564L14.4985 1.01064L15.9715 1.68397L15.8031 2.39938L16.4344 1.93647L17.781 2.90438L17.4864 3.53562L18.1598 3.24104L19.2539 4.41937L18.8331 5.05061L19.5064 4.92436L20.3481 6.22894L19.7168 6.86018L20.6006 6.8181L21.1056 8.24892L20.4323 8.71184L21.1898 8.88017L21.2739 10.4372L20.6006 10.7318L21.316 10.9843L21.1477 12.5835L20.3481 12.6256L21.0635 13.1306L20.6006 14.6035L19.8431 14.6455L20.3902 15.1926L19.5064 16.5393L18.8331 16.2868L19.2118 16.9601L18.0756 18.1384L17.4864 17.8439L17.7389 18.5172L16.3923 19.4851L15.8031 19.0222L15.9294 19.7797L14.4985 20.453L13.9515 19.8638V20.5793L12.3944 20.958L12.0577 20.2847L11.8052 21.0001H10.2902L10.0377 20.1584L9.70108 20.9159L8.14401 20.5372L8.18609 19.7797L7.59693 20.3268L6.20819 19.7376L6.25027 19.0222L5.66111 19.443L4.35654 18.5172L4.73528 17.7597L3.93571 18.1384L2.84155 16.9601L3.30446 16.3289L2.54697 16.4551L1.70531 15.1085L2.37863 14.5614H1.45281L0.989894 13.1306L1.70531 12.6676L0.863645 12.5835L0.695312 11.0264L1.41072 10.6897L0.737396 10.311L0.905728 8.796L1.74739 8.71184L1.03198 8.20684L1.53697 6.77602L2.42072 6.86018L1.74739 6.22894L2.63113 4.8402L3.34654 5.13478L2.88363 4.37728L3.97779 3.19896L4.65112 3.61979L4.35654 2.86229L5.66111 1.89438L6.29236 2.44146L6.08194 1.64189L7.63901 0.884391L8.18609 1.68397L8.14401 0.716059L9.70108 0.421478L10.0377 1.26314L10.2902 0.379395Z" fill="#231F20"/>
<path d="M12.2337 7.70178V8.83802H10.9291V7.70178H10.2979V8.83802V9.3851V10.353H10.9291V9.3851H12.2337V10.353H12.8228V7.70178H12.2337Z" fill="#FFC114"/>
<path d="M7.13799 7.70178H6.54883V10.353H7.13799V7.70178Z" fill="#FFC114"/>
<path d="M5.58133 7.70178V8.83802H4.23467V7.70178H3.64551V10.353H4.23467V9.3851H5.58133V10.353H6.21257V7.70178H5.58133Z" fill="#FFC114"/>
<path d="M12.1493 10.6055H9.96103H9.91895V13.2567H10.5502V11.1105H11.6023V13.2567H12.1914V10.6055H12.1493Z" fill="#FFC114"/>
<path d="M15.6409 12.7517V12.2046H16.7772V11.6575H15.6409V11.1105H16.9034V10.6055H15.6409H15.0518V11.1105V11.6575V12.2046V12.7517V13.2567H16.9876V12.7517H15.6409Z" fill="#FFC114"/>
<path d="M15.1751 7.70178V7.74387L13.8705 9.30094V7.70178H13.2393V10.353H13.8705L15.1751 8.83802V10.353H15.7642V7.70178H15.1751Z" fill="#FFC114"/>
<path d="M18.1642 7.70178V7.74387L16.8597 9.30094V7.70178H16.2705V10.353H16.8597L18.1642 8.75386V10.353H18.7534V7.70178H18.1642Z" fill="#FFC114"/>
<path d="M8.18575 13.2146L6.88118 11.91L8.01742 10.6055H7.30201L6.41826 11.6155V10.6055H5.8291V13.2567H6.41826V12.1625L7.38617 13.2146H8.18575Z" fill="#FFC114"/>
<path d="M9.24201 7.7439V8.92222H8.35826C8.31618 8.92222 8.18993 8.88014 8.10576 8.71181V7.7439H7.5166V8.75389C7.5166 8.75389 7.5166 8.83806 7.55868 8.92222C7.60077 9.13264 7.81118 9.51138 8.2741 9.51138H9.24201V10.4372H9.83117V7.78598L9.24201 7.7439Z" fill="#FFC114"/>
<path d="M4.27675 12.7517V12.2046H5.413V11.6575H4.27675V11.1105H5.49716V10.6055H4.27675H3.64551V11.1105V11.6575V12.2046V12.7517V13.2567H5.58133V12.7517H4.27675Z" fill="#FFC114"/>
<path d="M18.837 12.5834C18.7108 12.6676 18.5424 12.7517 18.3741 12.7517C17.9533 12.7517 17.6166 12.4151 17.6166 11.9942C17.6166 11.5734 17.9533 11.2367 18.3741 11.2367C18.5424 11.2367 18.7108 11.2788 18.837 11.4051V10.7317C18.7108 10.6897 18.5424 10.6476 18.3741 10.6476C17.6166 10.6476 16.9854 11.2788 16.9854 12.0363C16.9854 12.7938 17.6166 13.4251 18.3741 13.4251C18.5424 13.4251 18.6687 13.383 18.837 13.3409V12.5834Z" fill="#FFC114"/>
<path d="M9.62607 12.5834C9.49982 12.6676 9.33149 12.7517 9.16315 12.7517C8.74232 12.7517 8.40566 12.4151 8.40566 11.9942C8.40566 11.5734 8.74232 11.2367 9.16315 11.2367C9.33149 11.2367 9.49982 11.2788 9.62607 11.4051V10.7317C9.49982 10.6897 9.33149 10.6476 9.16315 10.6476C8.40566 10.6476 7.77441 11.2788 7.77441 12.0363C7.77441 12.7938 8.40566 13.4251 9.16315 13.4251C9.33149 13.4251 9.45774 13.383 9.62607 13.3409C9.62607 13.2567 9.62607 12.5834 9.62607 12.5834Z" fill="#FFC114"/>
<path d="M13.6634 10.6055C13.4951 10.6055 13.3688 10.6055 13.1584 10.6055H12.6113V13.8038H13.2005V13.2567C13.3267 13.2988 13.4109 13.2988 13.5372 13.2988C14.2946 13.2988 14.9259 12.7517 14.9259 11.9943C14.8838 11.2368 14.4209 10.5634 13.6634 10.6055ZM13.4951 12.6676C13.3688 12.6676 13.2847 12.6255 13.1584 12.5834V11.2788C13.2426 11.2368 13.3688 11.1947 13.4951 11.1947C13.9159 11.1947 14.2105 11.4472 14.2105 11.868C14.2105 12.2888 13.9159 12.6676 13.4951 12.6676Z" fill="#FFC114"/>
<path d="M13.4062 4.50348C13.4062 4.50348 15.3842 2.86224 17.1516 4.62973C18.6666 6.31305 17.4041 7.95429 17.4041 7.95429C17.4041 7.95429 18.0775 6.22889 16.6887 4.92431C15.3 3.61974 13.4062 4.50348 13.4062 4.50348Z" fill="#FFC114"/>
<path d="M4.22738 6.60769L4.10113 6.8181L3.84863 6.69185L4.26946 5.97644L4.47988 6.14477L4.35363 6.35519L5.40571 6.94435L5.27946 7.19685L4.22738 6.60769Z" fill="#A7A9AC"/>
<path d="M5.44847 5.8081L5.23805 6.0606L5.57472 6.31309L5.78513 6.01851L5.99555 6.18684L5.6168 6.69184L4.43848 5.8081L4.81722 5.3031L5.02764 5.47143L4.81722 5.76601L5.06972 5.97643L5.28014 5.72393L5.44847 5.8081Z" fill="#A7A9AC"/>
<path d="M5.0293 5.05068C5.07138 4.96652 5.15555 4.88235 5.19763 4.79818C5.32388 4.67193 5.40804 4.58777 5.57638 4.58777C5.70263 4.58777 5.82887 4.62985 5.91304 4.71402C6.03929 4.84027 6.08137 4.92443 6.08137 5.05068C6.08137 5.17693 5.99721 5.30318 5.95512 5.38735L5.91304 5.42943L6.29179 5.80818L6.08137 6.01859L5.0293 5.05068ZM5.70263 5.30318C5.70263 5.30318 5.74471 5.2611 5.70263 5.30318C5.82887 5.17693 5.82887 5.05068 5.70263 4.96652C5.61846 4.88235 5.49221 4.84027 5.40804 4.92443L5.36596 4.96652L5.70263 5.30318Z" fill="#A7A9AC"/>
<path d="M7.09159 4.46138C7.00743 4.33513 6.88118 4.20888 6.79701 4.08263C6.88118 4.20888 6.96534 4.37721 7.00743 4.50346L7.21784 5.00846L7.04951 5.13471L6.62868 4.79804C6.54451 4.71388 6.37618 4.58763 6.29202 4.50346C6.37618 4.62971 6.50243 4.79805 6.5866 4.92429L6.88118 5.34512L6.62868 5.42929L5.8291 4.1668L6.0816 3.99847L6.50243 4.33513C6.62868 4.46138 6.79701 4.58763 6.88118 4.6718C6.79701 4.54555 6.71285 4.37721 6.62868 4.20888L6.41826 3.74597L6.67076 3.57764L7.63867 4.71388L7.42826 4.84013L7.09159 4.46138Z" fill="#A7A9AC"/>
<path d="M7.26129 3.19897L7.9767 4.50355L7.7242 4.6298L7.00879 3.36731L7.26129 3.19897Z" fill="#A7A9AC"/>
<path d="M7.85025 2.90435L8.10274 3.45143L8.39732 3.32518L8.14483 2.7781L8.39732 2.65186L8.98649 3.99851L8.69191 4.16684L8.43941 3.57768L8.14483 3.70393L8.39732 4.29309L8.14483 4.41934L7.55566 3.07269L7.85025 2.90435Z" fill="#A7A9AC"/>
<path d="M9.78141 3.03059C9.90766 3.57767 9.78141 3.83017 9.52891 3.91433C9.19224 3.9985 8.98183 3.70392 8.89766 3.28309C8.8135 2.90434 8.85558 2.52559 9.19224 2.44143C9.48683 2.35726 9.69724 2.69392 9.78141 3.03059ZM9.15016 3.241C9.23433 3.57767 9.36058 3.70392 9.44474 3.70392C9.57099 3.66183 9.57099 3.45142 9.48682 3.15684C9.40266 2.90434 9.31849 2.69392 9.19224 2.73601C9.06599 2.73601 9.06599 2.90434 9.15016 3.241Z" fill="#A7A9AC"/>
<path d="M9.90723 2.31512C9.99139 2.27304 10.1176 2.27304 10.2439 2.23096C10.3701 2.23096 10.4964 2.23096 10.6226 2.27304C10.7068 2.31512 10.7489 2.44137 10.7489 2.52554C10.7489 2.65179 10.7068 2.77804 10.5806 2.8622C10.7489 2.90429 10.8751 3.03053 10.8751 3.19887C10.8751 3.32512 10.8751 3.40928 10.791 3.49345C10.7068 3.6197 10.5806 3.66178 10.3281 3.70386C10.2018 3.70386 10.1176 3.70386 10.0756 3.70386L9.90723 2.31512ZM10.2439 2.8622H10.286C10.3701 2.8622 10.4543 2.73595 10.4543 2.65179C10.4543 2.52554 10.3701 2.48346 10.286 2.48346C10.2439 2.48346 10.2439 2.48346 10.2018 2.48346L10.2439 2.8622ZM10.3281 3.53553C10.3281 3.53553 10.3701 3.53553 10.4122 3.53553C10.5385 3.53553 10.6226 3.45137 10.5806 3.28303C10.5806 3.15678 10.4543 3.07262 10.3281 3.07262H10.286L10.3281 3.53553Z" fill="#A7A9AC"/>
<path d="M11.3385 2.18896V3.66187H11.0439V2.18896H11.3385Z" fill="#A7A9AC"/>
<path d="M5.36478 14.435L4.14437 15.0663L4.06021 14.8558L5.0702 14.3088L4.90187 14.0563L3.89187 14.6033L3.76562 14.3509L4.98603 13.7196L5.36478 14.435Z" fill="#A7A9AC"/>
<path d="M5.15505 15.4451L4.98671 15.1926L4.69213 15.403L4.90255 15.6976L4.73422 15.8239L4.35547 15.3189L5.49171 14.5193L5.82838 14.9822L5.66004 15.1085L5.44963 14.856L5.19713 15.0243L5.36546 15.2768L5.15505 15.4451Z" fill="#A7A9AC"/>
<path d="M5.8264 15.1084C5.86848 15.1505 5.95265 15.2346 6.03681 15.2767C6.16306 15.403 6.20515 15.4871 6.20515 15.6134C6.20515 15.7396 6.16306 15.8238 6.0789 15.908C5.95265 15.9921 5.86848 16.0342 5.74223 16.0342C5.61598 16.0342 5.48973 15.9501 5.40557 15.8659L5.36349 15.8238L4.98474 16.1605L4.81641 15.9501L5.8264 15.1084ZM5.5739 15.7396C5.70015 15.8659 5.78432 15.8659 5.91057 15.7817C5.99473 15.6976 6.03681 15.6134 5.95265 15.5292L5.91057 15.4871L5.5739 15.7396Z" fill="#A7A9AC"/>
<path d="M6.33394 16.6655L6.08144 16.455L5.82894 16.7496L6.08144 17.0021L5.91311 17.1704L5.4502 16.7496L6.37602 15.7396L6.83894 16.1184L6.6706 16.2867L6.41811 16.0763L6.20769 16.3288L6.46019 16.5392L6.33394 16.6655Z" fill="#A7A9AC"/>
<path d="M6.92369 16.2026C7.00786 16.2447 7.09202 16.2868 7.17619 16.371C7.30244 16.4551 7.38661 16.5393 7.38661 16.6656C7.42869 16.7497 7.38661 16.8339 7.34452 16.918C7.26036 17.0022 7.13411 17.0864 7.00786 17.0443C7.09202 17.1705 7.09202 17.3389 7.00786 17.4651C6.92369 17.5493 6.88161 17.5914 6.75536 17.6335C6.62911 17.6755 6.50286 17.6335 6.29245 17.5072C6.20828 17.4651 6.12411 17.381 6.08203 17.3389L6.92369 16.2026ZM6.50286 17.2547L6.54494 17.2968C6.62911 17.3389 6.75536 17.3389 6.83953 17.2547C6.92369 17.1285 6.88161 17.0443 6.79744 16.9601L6.75536 16.918L6.50286 17.2547ZM6.83953 16.7918L6.88161 16.8339C6.96577 16.876 7.04994 16.876 7.13411 16.7918C7.17619 16.7076 7.21827 16.6235 7.09202 16.5393C7.04994 16.5393 7.04994 16.4972 7.04994 16.4972L6.83953 16.7918Z" fill="#A7A9AC"/>
<path d="M7.80348 17.5914L7.5089 17.4231L7.34057 17.7598L7.63515 17.9281L7.5089 18.1385L7.00391 17.8439L7.63515 16.6235L8.14015 16.9181L8.0139 17.1285L7.71932 16.9602L7.55099 17.2548L7.84557 17.4231L7.80348 17.5914Z" fill="#A7A9AC"/>
<path d="M8.22677 17.0442C8.31093 17.0442 8.43718 17.0442 8.52135 17.0863C8.77385 17.1704 8.81593 17.3809 8.73176 17.5492C8.68968 17.6754 8.52135 17.7596 8.3951 17.7596C8.52135 17.8438 8.60551 18.0121 8.52135 18.1804C8.43718 18.4329 8.1426 18.475 7.93219 18.3908C7.80594 18.3488 7.76385 18.3067 7.67969 18.2225L7.80594 18.0542C7.84802 18.0963 7.93219 18.1383 7.97427 18.1804C8.10052 18.2225 8.22677 18.1804 8.26885 18.0963C8.31093 17.97 8.22677 17.8438 8.10052 17.8017H8.05843L8.1426 17.6334H8.18468C8.31093 17.6754 8.43718 17.6754 8.47927 17.5492C8.52135 17.465 8.47926 17.3809 8.3951 17.3388C8.35302 17.2967 8.26885 17.2967 8.18468 17.3388L8.22677 17.0442Z" fill="#A7A9AC"/>
<path d="M9.32088 18.1384L9.0263 18.0542L8.94213 18.3908L9.2788 18.475L9.19463 18.6854L8.60547 18.5171L8.98422 17.2125L9.57338 17.3809L9.48921 17.6334L9.15255 17.5492L9.06838 17.8438L9.36296 17.9279L9.32088 18.1384Z" fill="#A7A9AC"/>
<path d="M9.90734 17.5072L9.82317 18.0543L10.1178 18.0963L10.2019 17.5493L10.4544 17.5913L10.244 18.938L9.94942 18.8959L10.0336 18.3488L9.73901 18.3067L9.65484 18.8538L9.40234 18.8117L9.61276 17.4651L9.90734 17.5072Z" fill="#A7A9AC"/>
<path d="M10.8336 17.5913V18.1384H11.1282V17.5913H11.3807L11.3386 18.938H11.0861V18.3488H10.7916V18.938H10.5391L10.5811 17.5913H10.8336Z" fill="#A7A9AC"/>
<path d="M11.546 18.9801C11.546 18.9381 11.5881 18.896 11.5881 18.8118C11.6302 18.6856 11.5881 18.4751 11.6722 18.3489C11.7143 18.3068 11.7143 18.3068 11.7564 18.2647C11.5881 18.2226 11.5039 18.1385 11.5039 17.9701C11.5039 17.8439 11.546 17.7176 11.5881 17.6756C11.6722 17.5914 11.7985 17.5493 11.9247 17.5493C12.0089 17.5493 12.1352 17.5493 12.2193 17.5493L12.3456 18.896H12.0931L12.051 18.3489H12.0089C11.9668 18.3489 11.9247 18.391 11.9247 18.391C11.8827 18.4751 11.8827 18.6856 11.8827 18.7697C11.8827 18.8118 11.8827 18.8539 11.8406 18.896L11.546 18.9801ZM11.9668 17.7597H11.9247C11.7985 17.7597 11.7564 17.886 11.7564 17.9701C11.7564 18.0964 11.8406 18.1806 11.9668 18.1806H12.0089L11.9668 17.7597Z" fill="#A7A9AC"/>
<path d="M12.6016 17.4651C12.6857 17.423 12.7699 17.3809 12.8961 17.3388C13.0224 17.2967 13.1486 17.2967 13.2749 17.3388C13.3591 17.3809 13.4011 17.4651 13.4432 17.5492C13.4853 17.6755 13.4432 17.8017 13.317 17.8859C13.4853 17.8859 13.6116 17.9701 13.6536 18.1384C13.6957 18.2646 13.6536 18.3488 13.6116 18.433C13.5695 18.5592 13.4432 18.6434 13.2328 18.6855C13.1486 18.7276 13.0645 18.7276 12.9803 18.7276L12.6016 17.4651ZM13.0224 17.928H13.0645C13.1486 17.8859 13.1907 17.8017 13.1907 17.7176C13.1486 17.6334 13.1066 17.5492 12.9803 17.5913C12.9382 17.5913 12.9382 17.5913 12.8961 17.6334L13.0224 17.928ZM13.1907 18.5171H13.2328C13.317 18.4751 13.4011 18.3909 13.3591 18.2646C13.317 18.1384 13.2328 18.0963 13.1066 18.1384H13.0645L13.1907 18.5171Z" fill="#A7A9AC"/>
<path d="M14.0341 18.0963L14.1183 18.3909L13.8658 18.4751L13.6133 17.0863L13.9079 16.9601L14.7074 18.0963L14.4549 18.1805L14.2866 17.928L14.0341 18.0963ZM14.1604 17.8017L13.992 17.5492C13.9499 17.4651 13.8658 17.3809 13.8237 17.2967C13.8658 17.3809 13.8658 17.5072 13.9079 17.5913L13.992 17.8859L14.1604 17.8017Z" fill="#A7A9AC"/>
<path d="M14.4135 16.7496L14.7081 17.2125L14.9606 17.0862L14.666 16.6233L14.8765 16.4971L15.5498 17.6754L15.3394 17.8016L15.0448 17.2966L14.7923 17.4229L15.0869 17.9279L14.8765 18.0541L14.2031 16.8758L14.4135 16.7496Z" fill="#A7A9AC"/>
<path d="M15.2528 16.4972L15.0424 16.6234L14.874 16.413L15.4632 15.9501L15.6315 16.1605L15.4211 16.3288L16.0944 17.2126L15.884 17.3809L15.2528 16.4972Z" fill="#A7A9AC"/>
<path d="M16.3482 16.6655L16.5166 16.918L16.3482 17.0864L15.6328 15.908L15.8853 15.6976L17.0216 16.4972L16.8532 16.6655L16.6007 16.4972L16.3482 16.6655ZM16.3903 16.3289L16.1799 16.1605C16.0957 16.1185 16.0116 16.0343 15.9274 15.9501C15.9695 16.0343 16.0536 16.1605 16.0957 16.2026L16.2641 16.4551L16.3903 16.3289Z" fill="#A7A9AC"/>
<path d="M16.223 15.3188L16.8543 15.4872L16.3914 15.1084L16.5597 14.898L17.0226 15.2768L16.6859 14.7297L16.8543 14.4772L17.1068 15.1505C17.233 15.0243 17.4434 15.1084 17.6118 15.1505C17.738 15.1926 17.8222 15.2768 17.9484 15.2768L17.7801 15.4872C17.6959 15.4451 17.5697 15.403 17.5276 15.3609C17.4013 15.3188 17.233 15.2347 17.1488 15.3609L17.6118 15.6976L17.4434 15.9501L16.9805 15.6134C16.8963 15.7397 16.9805 15.8659 17.0647 15.9922C17.1068 16.0763 17.1909 16.1605 17.233 16.2447L17.1068 16.413C17.0226 16.3288 16.9805 16.2026 16.8963 16.1184C16.7701 15.9922 16.6859 15.8238 16.7701 15.6555L16.0547 15.5713L16.223 15.3188Z" fill="#A7A9AC"/>
<path d="M16.9778 14.2246L18.1561 14.94L18.0299 15.1504L16.8516 14.435L16.9778 14.2246Z" fill="#A7A9AC"/>
<path d="M17.1055 14.0984C17.1055 14.0143 17.1476 13.9301 17.1896 13.8038C17.2317 13.6776 17.3159 13.5934 17.4421 13.5513C17.5263 13.5093 17.6105 13.5093 17.6946 13.5513C17.8209 13.5934 17.905 13.7197 17.863 13.8459C17.9892 13.7197 18.1155 13.7197 18.2838 13.7618C18.368 13.8038 18.4521 13.888 18.4942 13.9722C18.5363 14.0984 18.5363 14.2247 18.41 14.4351C18.368 14.5192 18.3259 14.6034 18.2838 14.6455L17.1055 14.0984ZM17.6946 14.0984L17.7367 14.0563C17.7788 13.9722 17.7367 13.888 17.6525 13.8038C17.5684 13.7618 17.4842 13.7618 17.4421 13.888C17.4421 13.9301 17.4421 13.9301 17.4001 13.9722L17.6946 14.0984ZM18.2417 14.3509C18.2417 14.3509 18.2417 14.3088 18.2838 14.3088C18.3259 14.2247 18.3259 14.0984 18.1996 14.0563C18.0734 14.0143 17.9892 14.0563 17.905 14.1405L17.863 14.1826L18.2417 14.3509Z" fill="#A7A9AC"/>
<path d="M15.805 13.7621C14.7529 15.235 13.0696 16.245 11.0917 16.245C9.19795 16.245 7.51463 15.3192 6.46255 13.8883H6.16797C7.26213 15.4875 9.02962 16.4975 11.0917 16.4975C13.1117 16.4975 14.9212 15.4875 16.0154 13.8883C15.9733 13.8463 15.8892 13.8042 15.805 13.7621Z" fill="#A7A9AC"/>
<path d="M6.58755 7.02868C7.63963 5.63994 9.28086 4.75619 11.1325 4.75619C11.385 4.75619 11.5954 4.75619 11.8058 4.79827V4.58786C11.5954 4.54578 11.3429 4.54578 11.1325 4.54578C9.15462 4.54578 7.38713 5.55577 6.29297 7.07076L6.58755 7.02868Z" fill="#A7A9AC"/>
</svg></td>
<td><?php echo $viddilnich; ?></td>
  <td><?php echo $nichotp; ?></td>
  <td><?php echo $nichpolych; ?></td>
  <td><?php echo $tarperevoz; ?> </td>
  </tr>
  </table>
<p class="commentdostavka"><?php echo $etenshin; ?></p>
</div>
</div>

<div class="oplatadost">
<div class="oplatadostup">
<table>
<tr>
<td class="textopl">&nbsp;Оплата</td>
<td>&nbsp;&nbsp;<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.5 17C13.1944 17 17 13.1944 17 8.5C17 3.80558 13.1944 0 8.5 0C3.80558 0 0 3.80558 0 8.5C0 13.1944 3.80558 17 8.5 17Z" fill="#C4C4C4"/>
<path d="M8.68779 8.2534C9.31869 7.67985 10.0012 7.1866 10.0012 6.25745C10.0012 5.46595 9.4162 4.8924 8.57882 4.8924C7.37436 4.8924 6.95567 5.7814 6.92699 6.831H5.35547C5.4415 4.88093 6.47963 3.55603 8.60749 3.55603C10.4486 3.55603 11.6645 4.6343 11.6645 6.26318C11.6645 7.51926 11.0336 8.05266 10.1733 8.79254C9.28428 9.55536 9.21545 9.5955 9.21545 10.7885H7.74143C7.74717 9.70448 7.86761 9.02196 8.68779 8.2534ZM7.59805 11.7406H9.35884V13.4727H7.59805V11.7406Z" fill="white"/>
</svg>&nbsp;&nbsp;
</td>
<td class="etxtovkaopl"><?php echo $dosttext; ?></td>
</tr>
</table>
</div>
<div class="oplatadostniz">
<table>
<tr>
<td><svg width="33" height="30" viewBox="0 0 33 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M32.606 23.6962C32.606 21.1964 32.606 18.6966 32.606 16.1968C32.606 15.0012 32.3887 14.7838 31.1931 14.4578C31.1931 13.3709 31.1931 12.1754 31.1931 11.0885C31.1931 10.3277 30.7584 9.89294 29.9976 9.89294C29.8889 9.89294 29.8889 9.89294 29.7802 9.89294H29.6715C29.5628 9.89294 29.5628 9.89294 29.4541 9.89294C29.3454 9.89294 29.3454 9.89294 29.2367 9.89294H29.0194V9.56688C29.0194 9.56688 29.0194 9.56688 29.0194 9.45819V8.04527C29.0194 7.93658 29.0194 7.82789 29.0194 7.61052C29.0194 6.74102 28.5846 6.30628 27.6064 6.30628C26.4109 6.30628 25.2153 6.30628 24.0198 6.30628C23.585 6.30628 23.3677 6.19759 23.259 5.76284C22.6069 4.34991 21.846 2.93699 21.0852 1.52406C20.5418 0.545876 20.1071 0.328502 19.0202 0.871936C15.6509 2.71961 12.1729 4.34991 8.80363 6.0889C8.47757 6.30628 8.15151 6.30628 7.82545 6.30628C5.7604 6.30628 3.69535 6.30628 1.6303 6.30628C0.32606 6.41496 0 6.74102 0 7.93658C0 14.7838 0 21.7398 0 28.5871C0 29.6739 0.32606 30 1.41293 30C10.8687 30 20.3244 30 29.6715 30C30.6497 30 31.0844 29.5653 31.0844 28.5871C31.0844 27.5002 31.0844 26.4133 31.0844 25.4352C32.3887 25.2178 32.606 25.0004 32.606 23.6962ZM26.8456 8.5887V9.89294H25.324C25.324 9.89294 24.7806 8.91476 24.5632 8.5887C24.8893 8.5887 26.8456 8.5887 26.8456 8.5887ZM19.4549 3.15436C20.5418 5.43678 21.7374 7.61052 22.8242 9.89294C17.2812 9.89294 11.7382 9.89294 6.30383 9.89294V9.78425C10.6513 7.61052 14.9988 5.43678 19.4549 3.15436ZM2.17374 8.5887C2.60848 8.5887 3.15192 8.5887 3.58666 8.5887V8.69739C3.2606 8.91476 2.71717 9.13213 2.17374 9.45819C2.17374 9.13213 2.17374 8.91476 2.17374 8.5887ZM29.0194 27.5002C29.0194 27.6089 28.802 27.8263 28.5846 27.935C28.4759 28.0436 28.3673 27.935 28.2586 27.935C19.781 27.935 11.4121 27.935 2.93454 27.935C2.71717 27.935 2.4998 27.935 2.28242 27.935C2.28242 22.6093 2.28242 17.501 2.28242 12.1754C11.1947 12.1754 20.1071 12.1754 29.0194 12.1754C29.0194 12.9362 29.0194 13.8057 29.0194 14.5665C28.802 14.5665 28.5846 14.5665 28.3673 14.5665C25.8675 14.5665 23.259 14.5665 20.7592 14.5665C17.1725 14.5665 14.564 17.8271 15.4335 21.3051C15.977 23.5875 18.2594 25.3265 20.6505 25.3265C23.1503 25.3265 25.7588 25.3265 28.2586 25.3265C28.4759 25.3265 28.6933 25.3265 29.0194 25.3265C29.0194 26.0873 29.0194 26.8481 29.0194 27.5002ZM30.4323 23.1527C30.3236 23.1527 30.2149 23.1527 30.1062 23.1527C26.9543 23.1527 23.8024 23.1527 20.5418 23.1527C19.0202 23.1527 17.716 22.0659 17.3899 20.6529C17.0638 19.1313 17.8246 17.7184 19.1289 17.0663C19.4549 16.9576 19.8897 16.7402 20.2157 16.7402C23.585 16.7402 26.8456 16.7402 30.3236 16.7402C30.4323 18.9139 30.4323 20.979 30.4323 23.1527Z" fill="#00AEEF"/>
<path d="M20.9733 17.175C19.4517 17.175 18.1475 18.4793 18.1475 20.0009C18.1475 21.5225 19.4517 22.7181 20.9733 22.7181C22.4949 22.7181 23.7992 21.4138 23.7992 20.0009C23.7992 18.4793 22.4949 17.2837 20.9733 17.175ZM20.9733 20.7617C20.5386 20.7617 20.2125 20.4357 20.2125 20.0009C20.2125 19.5662 20.5386 19.2401 20.9733 19.2401C21.4081 19.2401 21.7341 19.5662 21.7341 20.0009C21.7341 20.4357 21.4081 20.7617 20.9733 20.7617Z" fill="#00AEEF"/>
</svg>
</td>
<td><?php echo $oplgot; ?></td>
<td><svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M30.8157 3.744C29.994 3.744 29.2749 3.744 28.4532 3.744H24.4471V3.12C24.4471 1.04 23.4199 0 21.2628 0C20.7492 0 20.2356 0 19.6193 0H17.0514C16.5378 0 16.1269 0 15.6133 0C15.0997 0 14.6888 0 14.1752 0C13.4562 0 12.8399 0 12.2236 0C10.3746 0 9.34743 1.04 9.24471 2.912C9.24471 3.12 9.24471 3.328 9.24471 3.64H5.23867C4.41692 3.64 3.69789 3.64 2.87613 3.64C1.02719 3.744 0 4.784 0 6.656C0 12.064 0 17.576 0 22.984C0 24.96 1.02719 26 3.08157 26C7.80665 26 12.5317 26 17.3595 26C21.8792 26 26.3988 26 30.9184 26C32.9728 26 34 24.96 34 22.984C34 17.576 34 12.064 34 6.656C33.8973 4.784 32.7674 3.744 30.8157 3.744ZM15.5106 15.912V14.872H18.3867V15.912H15.5106ZM2.36254 11.336C5.44411 13.104 8.93656 14.248 13.2508 14.664V14.768C13.2508 15.288 13.2508 16.016 13.2508 16.328C13.2508 17.368 14.0725 18.096 15.2024 18.2C16.435 18.2 17.6677 18.2 18.9003 18.2C20.0302 18.2 20.7492 17.472 20.852 16.328C20.852 16.016 20.852 15.288 20.852 14.768V14.664C25.1662 14.144 28.5559 13.104 31.7402 11.336C31.7402 15.184 31.7402 19.136 31.7402 22.984C31.7402 23.712 31.7402 23.712 30.9184 23.712C21.6737 23.712 12.429 23.712 3.28701 23.712C2.46526 23.712 2.46526 23.712 2.46526 22.984C2.46526 20.176 2.46526 17.368 2.46526 14.56C2.36254 14.56 2.36254 11.336 2.36254 11.336ZM31.5347 7.176C31.5347 7.904 31.5347 8.32 31.432 8.632C31.3293 8.84 30.9184 9.048 30.1994 9.464C27.2205 11.128 23.9335 12.064 20.1329 12.48C19.3112 12.584 18.5921 12.584 17.9758 12.584C17.7704 12.584 17.565 12.584 17.3595 12.584C11.8127 12.48 7.60121 11.544 3.8006 9.464H3.69789C3.08157 9.048 2.6707 8.84 2.46526 8.632C2.36254 8.32 2.36254 7.904 2.36254 7.072V6.864C2.36254 6.656 2.36254 6.552 2.36254 6.344C2.36254 6.136 2.46526 6.032 2.67069 6.032C2.77341 6.032 2.87613 6.032 2.87613 6.032H3.18429H16.9486H30.713C30.9184 6.032 31.432 6.032 31.5347 6.136C31.6375 6.24 31.6375 6.76 31.6375 6.864V7.072L31.5347 7.176ZM11.71 2.6C11.71 2.392 11.71 2.288 12.3263 2.288C12.8399 2.288 13.2508 2.288 13.7643 2.288H15.6133H19.003C19.8248 2.288 20.5438 2.288 21.3656 2.288C22.1873 2.288 22.1873 2.288 22.1873 3.12V3.64H11.71C11.71 3.64 11.71 3.64 11.71 3.536C11.71 3.224 11.71 2.912 11.71 2.6Z" fill="#00AEEF"/>
</svg>
</td>
<td><?php echo $oplbezgot; ?></td>
<td><svg width="39" height="27" viewBox="0 0 39 27" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M3.87135 26.2759H35.1526C37.0444 26.2759 38.5786 24.7543 38.5786 22.8782V3.67361C38.5786 1.79747 37.0444 0.275879 35.1526 0.275879H3.87135C1.97958 0.275879 0.445312 1.79747 0.445312 3.67361V22.8782C0.445312 24.7543 1.97958 26.2759 3.87135 26.2759ZM2.82865 3.67361C2.82865 3.10486 3.29786 2.63952 3.87135 2.63952H35.1526C35.7261 2.63952 36.1953 3.10486 36.1953 3.67361V22.8782C36.1953 23.4469 35.7261 23.9122 35.1526 23.9122H3.87135C3.29786 23.9122 2.82865 23.4469 2.82865 22.8782V3.67361ZM26.9441 16.4004C27.1601 16.5703 27.4207 16.6515 27.6814 16.6515C28.0315 16.6515 28.3815 16.4964 28.6199 16.201C29.2753 15.3737 29.6402 14.3322 29.6402 13.276C29.6402 12.2197 29.2827 11.1783 28.6199 10.351C28.2102 9.83394 27.458 9.74531 26.9441 10.1516C26.4227 10.5578 26.3333 11.3038 26.743 11.8135C27.0781 12.2345 27.2569 12.7368 27.2569 13.276C27.2569 13.8152 27.0781 14.3175 26.743 14.7385C26.3408 15.2555 26.4302 15.9942 26.9441 16.4004ZM30.6419 19.5837C30.3589 19.5837 30.0758 19.4803 29.845 19.2808C29.3534 18.845 29.3162 18.099 29.7556 17.6115C30.8355 16.4149 31.4314 14.8786 31.4314 13.2757C31.4314 11.6729 30.8355 10.1291 29.7556 8.93991C29.3162 8.45241 29.3534 7.70638 29.845 7.27059C30.3365 6.83479 31.0888 6.87172 31.5282 7.35922C33.0029 8.98423 33.8147 11.0893 33.8147 13.2757C33.8147 15.4621 33.0029 17.5672 31.5282 19.1922C31.2973 19.4507 30.9696 19.5837 30.6419 19.5837ZM7.89391 13.2759H9.68141C11.1635 13.2759 12.3627 12.0867 12.3627 10.6169V8.84413C12.3627 7.37424 11.1635 6.18504 9.68141 6.18504H7.89391C6.41177 6.18504 5.21266 7.37424 5.21266 8.84413V10.6169C5.21266 12.0867 6.41177 13.2759 7.89391 13.2759ZM7.59599 8.84413C7.59599 8.68163 7.73005 8.54868 7.89391 8.54868H9.68141C9.84526 8.54868 9.97932 8.68163 9.97932 8.84413V10.6169C9.97932 10.7794 9.84526 10.9123 9.68141 10.9123H7.89391C7.73005 10.9123 7.59599 10.7794 7.59599 10.6169V8.84413Z" fill="#00AEEF"/>
</svg>
</td>
<td><?php echo $oplcart; ?></td>
<td><svg width="343" height="33" viewBox="0 0 343 33" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M26.8338 6.61768H15.4102V27.0589H26.8338V6.61768Z" fill="#FF5F00"/>
<path d="M16.126 16.8251C16.126 12.6734 18.0919 8.99765 21.094 6.61769C18.8889 4.89883 16.0994 3.84106 13.0442 3.84106C5.84467 3.84106 0 9.65875 0 16.8251C0 23.9914 5.84467 29.8091 13.0442 29.8091C16.0994 29.8091 18.8889 28.7513 21.094 27.0325C18.0919 24.7054 16.126 20.9768 16.126 16.8251Z" fill="#EB001B"/>
<path d="M42.2443 16.8251C42.2443 24.0179 36.3997 29.8091 29.2001 29.8091C26.1449 29.8091 23.3554 28.7513 21.1504 27.0325C24.2056 24.6525 26.1184 20.9768 26.1184 16.8251C26.1184 12.6734 24.1524 8.99765 21.1504 6.61769C23.3554 4.89883 26.1449 3.84106 29.2001 3.84106C36.3997 3.84106 42.2443 9.6852 42.2443 16.8251Z" fill="#F79E1B"/>
<path d="M69.2527 6.07983L63.7009 20.7129L63.106 17.7863C61.718 14.0792 58.7438 10.1771 55.373 8.81134L60.3301 27.5417H66.2785L75.2012 6.07983H69.2527Z" fill="#1B548E"/>
<path d="M74.0156 27.5417L77.5847 6.07983H83.1366L79.5675 27.5417H74.0156Z" fill="#1B548E"/>
<path d="M99.9877 6.66523C98.9963 6.07991 97.2118 5.6897 95.0307 5.6897C89.4788 5.6897 85.5132 8.61631 85.5132 12.7136C85.5132 15.8353 88.2891 17.5912 90.4702 18.5668C92.6513 19.5423 93.4444 20.3228 93.4444 21.2983C93.4444 22.664 91.6599 23.4445 90.0736 23.4445C87.8925 23.4445 86.7028 23.0543 84.72 22.2738L83.9269 21.8836L83.1338 26.7613C84.5218 27.3466 86.9011 27.9319 89.4788 27.9319C95.4272 27.9319 99.1946 25.0053 99.3928 20.5179C99.3928 17.9815 98.0049 16.2255 94.6341 14.6646C92.6513 13.6891 91.4616 13.1038 91.4616 11.9331C91.4616 10.9576 92.453 10.1772 94.6341 10.1772C96.4186 10.1772 97.8066 10.5674 98.798 10.9576L99.3928 11.1527L99.9877 6.66523ZM114.462 6.07991H110.1C108.712 6.07991 107.721 6.47013 107.126 7.83588L98.798 27.5417H104.746C104.746 27.5417 105.738 24.8102 105.936 24.2249C106.531 24.2249 112.281 24.2249 113.074 24.2249C113.273 25.0053 113.669 27.3466 113.669 27.3466H118.824L114.462 6.07991ZM107.522 19.9325C107.919 18.7619 109.703 13.8842 109.703 13.8842C109.703 13.8842 110.1 12.7136 110.497 11.9331L110.893 13.6891C110.893 13.6891 111.885 18.7619 112.281 19.9325H107.522Z" fill="#1B548E"/>
<path d="M58.5467 6.07898H49.4258V6.46919C56.5639 8.22516 61.1244 12.5175 63.1072 17.7854L61.1244 7.83495C60.7278 6.46919 59.7364 6.07898 58.5467 6.07898Z" fill="#E89F3E"/>
<path d="M328.336 23.2606L328.152 23.0763C327.66 22.6463 327.537 21.8477 328.029 21.2948L333.557 15.029C333.987 14.5375 334.786 14.4147 335.339 14.9061L335.523 15.0904C336.015 15.5204 336.137 16.319 335.646 16.8719L330.179 23.1377C329.687 23.6291 328.889 23.6906 328.336 23.2606Z" fill="url(#paint0_linear)"/>
<path opacity="0.4" d="M332.763 16.1347L332.64 16.0118L331.78 16.9947L331.903 17.0561C333.377 18.5305 332.763 19.9433 332.395 20.4962L332.517 20.3734C332.702 20.1276 333.009 19.8205 333.316 19.4519C333.685 18.8376 334.176 17.4862 332.763 16.1347Z" fill="url(#paint1_linear)"/>
<path opacity="0.4" d="M334.601 18.039L334.847 17.7932C334.847 17.7318 334.908 17.7318 334.908 17.7318C334.662 17.9775 334.417 18.2847 334.171 18.5918C334.294 18.3461 334.478 18.1618 334.601 18.039Z" fill="url(#paint2_radial)"/>
<path d="M335.646 15.2131L330.117 8.94731C329.687 8.45587 328.889 8.33301 328.336 8.82445L328.152 9.00874C327.66 9.43874 327.537 10.2373 328.029 10.7902L332.636 16.0732L332.759 16.196C334.11 17.5475 333.68 18.9604 333.312 19.5132C333.557 19.2061 333.865 18.8989 334.11 18.5918C334.356 18.2846 334.602 18.0389 334.847 17.7318C335.093 17.486 335.339 17.1789 335.462 17.056C336.015 16.4417 336.137 15.766 335.646 15.2131Z" fill="url(#paint3_linear)"/>
<path d="M335.342 23.2604L335.157 23.0761C334.666 22.6461 334.543 21.8476 335.035 21.2947L340.563 15.0288C340.993 14.5374 341.792 14.4146 342.345 14.906L342.529 15.0903C343.02 15.5203 343.143 16.3189 342.652 16.8717L337.123 23.1376C336.632 23.629 335.895 23.6904 335.342 23.2604Z" fill="url(#paint4_linear)"/>
<path opacity="0.4" d="M339.823 16.0731L339.7 15.9502L338.84 16.9331L338.901 17.0559C340.376 18.5302 339.761 19.9431 339.393 20.496L339.516 20.3731C339.7 20.1274 340.007 19.8203 340.314 19.4517C340.744 18.776 341.174 17.4245 339.823 16.0731Z" fill="url(#paint5_linear)"/>
<path opacity="0.4" d="M341.542 18.0388L341.788 17.7931C341.788 17.7317 341.849 17.7317 341.849 17.7317C341.604 17.9774 341.358 18.2846 341.112 18.5917C341.297 18.346 341.419 18.1617 341.542 18.0388Z" fill="url(#paint6_radial)"/>
<path d="M342.587 15.2131L337.059 8.94731C336.629 8.45587 335.83 8.33301 335.277 8.82445L335.093 9.00874C334.601 9.43874 334.479 10.2373 334.97 10.7902L339.577 16.0732L339.7 16.196C341.052 17.5475 340.622 18.9604 340.253 19.5132C340.499 19.2061 340.806 18.8989 341.052 18.5918C341.297 18.2846 341.543 18.0389 341.789 17.7318C342.035 17.486 342.28 17.1789 342.403 17.056C343.017 16.4417 343.079 15.766 342.587 15.2131Z" fill="url(#paint7_linear)"/>
<path d="M251.119 23.1992C250.934 23.0149 250.812 22.6463 250.812 22.2778V9.86894C250.812 9.43893 250.934 9.13178 251.18 8.88606C251.426 8.57891 251.733 8.51748 252.163 8.51748C252.593 8.51748 252.962 8.64034 253.146 8.88606C253.392 9.13178 253.514 9.43893 253.514 9.86894V21.3563H259.473C260.333 21.3563 260.763 21.7249 260.763 22.462C260.763 23.1992 260.333 23.5678 259.473 23.5678H252.102C251.672 23.5678 251.364 23.4449 251.119 23.1992ZM262.913 23.2606C262.667 23.0149 262.545 22.6463 262.545 22.2778V9.80751C262.545 9.3775 262.667 9.07035 262.913 8.82463C263.159 8.57891 263.527 8.45605 263.896 8.45605C264.265 8.45605 264.695 8.57891 264.879 8.82463C265.125 9.07035 265.248 9.3775 265.248 9.80751V22.2778C265.248 22.7078 265.125 23.0149 264.879 23.2606C264.633 23.5063 264.265 23.6292 263.896 23.6292C263.527 23.6906 263.159 23.5678 262.913 23.2606Z" fill="#4B4C4B"/>
<path d="M280.792 25.595C280.915 25.8407 281.038 26.0864 281.038 26.3321C281.038 26.6393 280.915 26.9464 280.669 27.1307C280.424 27.315 280.055 27.4993 279.748 27.4993C279.502 27.4993 279.256 27.4379 279.011 27.315C278.826 27.1921 278.581 27.0078 278.458 26.7621L277.229 24.7349C277.045 24.4278 276.799 24.1821 276.431 23.9978C276.123 23.8749 275.693 23.7521 275.202 23.7521C273.728 23.7521 272.499 23.4449 271.393 22.8306C270.349 22.2163 269.489 21.2949 268.936 20.1891C268.383 19.022 268.076 17.6705 268.076 16.1348C268.076 14.599 268.383 13.2476 268.936 12.0804C269.489 10.9132 270.349 10.0532 271.393 9.43893C272.438 8.82463 273.728 8.51748 275.202 8.51748C276.615 8.51748 277.905 8.82463 278.949 9.43893C279.994 10.0532 280.854 10.9747 281.406 12.0804C281.959 13.2476 282.266 14.599 282.266 16.1348C282.266 17.7934 281.959 19.2677 281.284 20.4963C280.608 21.7249 279.625 22.5849 278.396 23.1378C279.072 23.3221 279.564 23.8135 279.994 24.5507C279.994 24.4892 280.792 25.595 280.792 25.595ZM278.396 20.1277C279.195 19.2063 279.564 17.7934 279.564 16.0733C279.564 14.2919 279.195 12.9404 278.396 12.019C277.598 11.0361 276.553 10.6061 275.202 10.6061C273.789 10.6061 272.745 11.0975 271.946 12.019C271.148 13.0019 270.779 14.2919 270.779 16.0733C270.779 17.8548 271.148 19.2063 271.946 20.1277C272.745 21.0492 273.789 21.5406 275.202 21.5406C276.553 21.5406 277.598 21.1106 278.396 20.1277ZM285.645 23.2606C285.399 23.0149 285.277 22.6463 285.277 22.2778V9.86894C285.277 9.43893 285.399 9.13178 285.645 8.94749C285.891 8.7632 286.198 8.64034 286.628 8.64034H291.85C293.447 8.64034 294.675 9.00892 295.597 9.86894C296.395 10.6061 296.887 11.7118 296.887 13.1247C296.887 14.5376 296.457 15.7048 295.535 16.5034C294.675 17.3019 293.385 17.732 291.788 17.732H287.979V22.2778C287.979 22.7078 287.857 23.0763 287.611 23.2606C287.365 23.5063 286.997 23.6292 286.628 23.6292C286.198 23.6906 285.829 23.5678 285.645 23.2606ZM291.419 15.6433C293.262 15.6433 294.245 14.7833 294.245 13.1861C294.245 11.589 293.262 10.729 291.419 10.729H287.979V15.6433H291.419ZM311.323 22.462C311.323 22.7692 311.2 23.0763 310.954 23.3221C310.708 23.5063 310.401 23.6292 310.033 23.6292C309.848 23.6292 309.603 23.5678 309.418 23.4449C309.234 23.3221 309.05 23.1378 308.927 22.8921L307.637 20.0663H300.204L298.914 22.8921C298.791 23.1378 298.668 23.3221 298.422 23.4449C298.177 23.5678 297.992 23.6292 297.747 23.6292C297.44 23.6292 297.132 23.5063 296.887 23.3221C296.641 23.1378 296.518 22.8306 296.518 22.462C296.518 22.2778 296.58 22.0935 296.641 21.9092L302.477 9.31607C302.6 9.07035 302.784 8.82463 303.091 8.64034C303.337 8.51748 303.583 8.45605 303.89 8.45605C304.197 8.45605 304.443 8.51748 304.75 8.64034C304.995 8.7632 305.18 9.00892 305.364 9.31607L311.261 21.9092C311.261 22.0935 311.323 22.2778 311.323 22.462ZM301.125 17.9162H306.716L303.89 11.6504L301.125 17.9162Z" fill="#4B4C4B"/>
<path d="M321.891 8.51748C322.199 8.51748 322.506 8.64034 322.751 8.88606C322.997 9.13178 323.12 9.43893 323.12 9.80751C323.12 10.0532 322.997 10.3604 322.813 10.6061L318.021 16.5034V22.4006C318.021 22.8306 317.898 23.1992 317.653 23.4449C317.407 23.6906 317.1 23.8135 316.67 23.8135C316.24 23.8135 315.933 23.6906 315.687 23.4449C315.441 23.1992 315.318 22.8921 315.318 22.4006V16.4419L310.527 10.5447C310.343 10.2989 310.22 9.9918 310.22 9.74608C310.22 9.43893 310.343 9.13178 310.588 8.82463C310.773 8.57891 311.08 8.45605 311.387 8.45605C311.755 8.45605 312.063 8.57891 312.308 8.94749L316.67 14.3533L320.97 8.94749C321.216 8.64034 321.523 8.51748 321.891 8.51748Z" fill="#4B4C4B"/>
<path d="M170.707 9.88513H176.047C177.375 9.88513 178.416 10.1984 179.182 10.8147C179.948 11.4411 180.336 12.3606 180.336 13.5933C180.336 14.7553 179.979 15.6747 179.264 16.3517C178.549 17.0287 177.579 17.3722 176.344 17.3722H172.872V22.0605H170.707V9.88513ZM172.872 11.6735V15.6646H175.884C177.457 15.6646 178.233 14.9978 178.233 13.664C178.233 12.3404 177.385 11.6836 175.69 11.6836L172.872 11.6735Z" fill="black"/>
<path d="M186.75 13.0673V14.9365C186.403 14.9062 186.178 14.886 186.056 14.886C184.34 14.886 183.483 15.9873 183.483 18.19V22.0699H181.532V13.239H183.38V14.9971C184.014 13.6836 185.014 13.0269 186.372 13.0269L186.75 13.0673Z" fill="black"/>
<path d="M189.962 9.83411V11.7539H187.991V9.83411H189.962ZM189.962 13.2392V22.0701H187.991V13.2392H189.962Z" fill="black"/>
<path d="M191.361 13.239H193.506L195.793 20.0289L197.988 13.239H200.031L196.835 22.0901H194.619L191.361 13.239Z" fill="black"/>
<path d="M200.707 15.9671C200.912 13.9665 202.219 12.9763 204.618 12.9763C205.731 12.9763 206.63 13.1885 207.294 13.623C207.957 14.0574 208.284 14.7344 208.284 15.6438V20.1199C208.284 20.3725 208.315 20.5442 208.376 20.6352C208.437 20.7261 208.56 20.7766 208.744 20.7766C208.886 20.7766 209.029 20.7665 209.193 20.7463V22.1204C208.682 22.2417 208.264 22.3124 207.916 22.3124C207.079 22.3124 206.589 21.9588 206.466 21.2515C205.721 21.9588 204.669 22.3124 203.332 22.3124C202.413 22.3124 201.677 22.08 201.136 21.6051C200.595 21.1303 200.319 20.4937 200.319 19.6753C200.319 19.4227 200.35 19.1903 200.401 18.9781C200.462 18.7659 200.524 18.5739 200.605 18.4123C200.677 18.2506 200.799 18.1092 200.973 17.9677C201.136 17.8262 201.279 17.7151 201.392 17.6242C201.504 17.5332 201.677 17.4524 201.933 17.3716C202.178 17.2907 202.362 17.2301 202.484 17.1897C202.607 17.1493 202.811 17.1089 203.117 17.0583C203.413 17.0179 203.618 16.9775 203.709 16.9674C203.812 16.9472 204.016 16.927 204.322 16.8866C205.027 16.7956 205.507 16.7148 205.762 16.6542C206.017 16.5936 206.191 16.4925 206.283 16.3713C206.364 16.2803 206.405 16.0681 206.405 15.7347C206.405 14.8456 205.793 14.401 204.567 14.401C203.924 14.401 203.454 14.5222 203.148 14.7647C202.852 15.0072 202.658 15.4114 202.576 15.9772H200.707V15.9671ZM206.375 17.6444C206.221 17.7252 206.048 17.7959 205.854 17.8566C205.66 17.9172 205.496 17.9576 205.374 17.9778C205.251 17.998 205.068 18.0182 204.802 18.0586C204.547 18.0889 204.373 18.1193 204.291 18.1294C204.046 18.1597 203.863 18.2001 203.72 18.2203C203.577 18.2506 203.413 18.3011 203.209 18.3618C203.005 18.4325 202.852 18.5133 202.739 18.6144C202.627 18.7154 202.535 18.8467 202.453 19.0084C202.372 19.1701 202.331 19.3722 202.331 19.5944C202.331 20.0188 202.474 20.3421 202.75 20.5644C203.035 20.7968 203.424 20.908 203.934 20.908C204.812 20.908 205.486 20.6756 205.956 20.2108C206.221 19.9481 206.354 19.4429 206.354 18.6851V17.6444H206.375Z" fill="black"/>
<path d="M214.846 13.239V14.6637H213.049V19.3115C213.049 19.5843 213.059 19.7763 213.069 19.8875C213.079 19.9986 213.11 20.1199 213.171 20.2512C213.232 20.3826 213.334 20.4735 213.477 20.5139C213.62 20.5644 213.825 20.5846 214.07 20.5846C214.396 20.5846 214.652 20.5745 214.846 20.5543V22.0901C214.458 22.1306 214.008 22.1609 213.518 22.1609C213.171 22.1609 212.865 22.1306 212.609 22.08C212.354 22.0295 212.129 21.9689 211.956 21.8982C211.782 21.8274 211.639 21.7163 211.527 21.5445C211.415 21.3829 211.323 21.2414 211.262 21.1303C211.2 21.0191 211.149 20.8271 211.119 20.5543C211.088 20.2815 211.078 20.0693 211.078 19.9279C211.078 19.7864 211.078 19.5338 211.078 19.1802C211.078 19.1398 211.078 19.0993 211.078 19.069C211.078 19.0387 211.078 19.0084 211.078 18.968C211.078 18.9276 211.078 18.8872 211.078 18.8569V14.6637H209.587V13.239H211.078V10.5817H213.049V13.239H214.846Z" fill="black"/>
<path d="M225.215 20.3422V22.0699H216.954C216.964 21.5344 217.036 21.0393 217.179 20.5948C217.322 20.1502 217.475 19.7662 217.659 19.453C217.832 19.1398 218.098 18.8164 218.455 18.4931C218.802 18.1698 219.119 17.897 219.405 17.6848C219.691 17.4726 220.079 17.1998 220.569 16.8765C220.599 16.8563 220.773 16.7451 221.079 16.543C221.386 16.341 221.57 16.2197 221.641 16.1692C221.712 16.1187 221.866 15.9974 222.111 15.8055C222.356 15.6135 222.509 15.4619 222.591 15.3508C222.662 15.2396 222.764 15.078 222.897 14.886C223.03 14.694 223.122 14.4919 223.162 14.3C223.203 14.0979 223.234 13.8857 223.234 13.6634C223.234 13.037 223.06 12.5419 222.703 12.1882C222.356 11.8245 221.876 11.6527 221.273 11.6527C220.926 11.6527 220.63 11.7032 220.375 11.8144C220.12 11.9255 219.926 12.067 219.783 12.2286C219.64 12.4004 219.517 12.6227 219.425 12.8854C219.333 13.1582 219.272 13.4108 219.241 13.6432C219.211 13.8857 219.19 14.1585 219.18 14.4818H217.26V14.1787C217.26 12.8854 217.628 11.8649 218.363 11.1071C219.098 10.3493 220.089 9.96533 221.324 9.96533C222.499 9.96533 223.448 10.2887 224.163 10.9454C224.878 11.6022 225.235 12.4711 225.235 13.5523C225.235 13.9867 225.164 14.401 225.031 14.7849C224.888 15.1689 224.745 15.4821 224.592 15.7246C224.439 15.9671 224.163 16.2399 223.785 16.5633C223.408 16.8866 223.122 17.1089 222.938 17.2301C222.754 17.3514 222.417 17.5838 221.917 17.9172C220.477 18.8367 219.609 19.645 219.323 20.332H225.215V20.3422Z" fill="black"/>
<path d="M234.609 17.5838V19.2308H233.067V22.07H231.167L231.147 19.2308H226.011V17.3009L231.198 9.99573H233.067V17.5939L234.609 17.5838ZM231.178 17.5838V12.4005L227.634 17.5838H231.178Z" fill="black"/>
<path d="M146.346 31.3354C154.703 31.3354 161.479 24.6312 161.479 16.3612C161.479 8.09123 154.703 1.38708 146.346 1.38708C137.988 1.38708 131.213 8.09123 131.213 16.3612C131.213 24.6312 137.988 31.3354 146.346 31.3354Z" fill="#1D1D1D"/>
<path d="M146.347 32.1943C137.524 32.1943 130.346 25.0912 130.346 16.3613C130.346 7.63144 137.524 0.52832 146.347 0.52832C155.169 0.52832 162.347 7.63144 162.347 16.3613C162.347 25.0912 155.169 32.1943 146.347 32.1943ZM146.347 2.246C138.484 2.246 132.082 8.58121 132.082 16.3613C132.082 24.1414 138.484 30.4766 146.347 30.4766C154.209 30.4766 160.612 24.1414 160.612 16.3613C160.612 8.58121 154.209 2.246 146.347 2.246Z" fill="#8DC641"/>
<path d="M145.634 21.5143H138.221C138.302 19.059 139.62 18.089 141.458 16.8665C142.54 16.1491 143.847 15.4721 143.847 13.9767C143.847 12.8552 143.183 12.1681 142.091 12.1681C140.498 12.1681 140.243 13.4614 140.212 14.7143H138.507V14.4415C138.507 12.1378 139.916 10.6626 142.152 10.6626C144.266 10.6626 145.654 11.9357 145.654 13.8858C145.654 15.9066 144.194 16.8058 142.673 17.796C141.887 18.3012 140.722 19.0691 140.345 19.9583H145.634V21.5143Z" fill="white"/>
<path d="M154.587 18.968H153.209V21.5142H151.504L151.483 18.968H146.878V17.2301L151.534 10.6726H153.209V17.4827H154.587V18.968ZM151.514 12.845L148.338 17.4928H151.514V12.845Z" fill="white"/>
<defs>
<linearGradient id="paint0_linear" x1="328.73" y1="21.1917" x2="335.216" y2="17.4515" gradientUnits="userSpaceOnUse">
<stop stop-color="#1FADC3"/>
<stop offset="0.7072" stop-color="#36B98F"/>
</linearGradient>
<linearGradient id="paint1_linear" x1="332.757" y1="17.7522" x2="333.424" y2="17.1944" gradientUnits="userSpaceOnUse">
<stop stop-color="#123F06" stop-opacity="0"/>
<stop offset="1" stop-color="#123F06"/>
</linearGradient>
<radialGradient id="paint2_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(331.556 18.8002) scale(3.6833 3.683)">
<stop offset="0.4185" stop-color="#123F06" stop-opacity="0"/>
<stop offset="1" stop-color="#123F06"/>
</radialGradient>
<linearGradient id="paint3_linear" x1="328.991" y1="11.1836" x2="334.837" y2="14.7583" gradientUnits="userSpaceOnUse">
<stop stop-color="#9FDB57"/>
<stop offset="1" stop-color="#71CA5E"/>
</linearGradient>
<linearGradient id="paint4_linear" x1="335.705" y1="21.1961" x2="342.192" y2="17.4558" gradientUnits="userSpaceOnUse">
<stop stop-color="#1FADC3"/>
<stop offset="0.7072" stop-color="#36B98F"/>
</linearGradient>
<linearGradient id="paint5_linear" x1="339.777" y1="17.6923" x2="340.444" y2="17.1348" gradientUnits="userSpaceOnUse">
<stop stop-color="#123F06" stop-opacity="0"/>
<stop offset="1" stop-color="#123F06"/>
</linearGradient>
<radialGradient id="paint6_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(338.526 18.8001) scale(3.6833 3.683)">
<stop offset="0.4185" stop-color="#123F06" stop-opacity="0"/>
<stop offset="1" stop-color="#123F06"/>
</radialGradient>
<linearGradient id="paint7_linear" x1="335.959" y1="11.1869" x2="341.805" y2="14.7608" gradientUnits="userSpaceOnUse">
<stop stop-color="#9FDB57"/>
<stop offset="1" stop-color="#71CA5E"/>
</linearGradient>
</defs>
</svg>
</td>

</tr>
</table>
</div>
</div>




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
    .featured_title{color:#00adee; font-size:22px; margin-bottom:10px; }
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

<?php
require_once('/var/www/prote/data/www/test.prote.ua/symist.php');
?>

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
















<script>
function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

var deadline="January 01 2018 00:00:00 GMT+0300"; //for Ukraine
var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000); // for endless timer
initializeClock('countdown', deadline);
</script>

</div>


<?php echo $footer; ?>