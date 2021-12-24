<?php echo $header; ?>
      <style>
       .thumb{
        
        width:50%;
      }
      .thumb svg{
        width:84px !important;
      }
      .item:hover  .st0 {
        fill: #00aeef;
    }
  #Layer_1{
    width:81%;
  }
  .st0 {
        fill: #FD9710;
    }
 .cats .item .name a {
    font-family: Open Sans;
font-style: normal;
font-weight: normal;
font-size: 12px;
line-height: 80%;
color: #333333;
    }
      .item:hover .cat_name{
        color:#00aeef;
      }

#cart-total .count span {
   width: 24px  !important;
    height: 24px !important;
}
      .footer {
    margin-top: 0px !important;
}
      .item{
        width:240px;
      margin-bottom:40px;
      }
      .informal .dflex{flex-direction:row;width:100%;justify-content:space-between;}
      .informal .thumb{padding-right:30px;}
      .informal .thumb img{width:100%;max-width:670px;}
      .informal .description{max-width:370px;margin-right:16%;}
      .informal .call{margin: 14px 0 20px;font-size: 12px;color: #999;font-family: 'Trebuchet MS';text-decoration: underline;cursor:pointer;}
      .informal .call:hover{color:#fd9710;}
      h1{color:#00adee;font-size:24px;font-weight:normal;margin-bottom:30px;}
      .informal p{font-size:15px;color:#333;font-family: 'Trebuchet MS';line-height:23px;padding-bottom:25px;}
      p.blueb{color:#fd9710;}
      .cats .dflex{padding:40px 0 70px;display:flex;flex-wrap: wrap;justify-content:left;}
      .cats .item{width:240px;display:flex;flex-wrap: wrap;border:1px solid #f7f6f7;margin-left: 1px;
    margin-right: 15px;}
      .cats .item:hover{border-color:#fd9d1f;}
      .cats .item .thumb,
      .cats .item .name{width:50%;}
      .cats .item .thumb{text-align: center;}
      .cats .item:hover .name a{-webkit-transition-duration:0.2s;-o-transition-duration:0.2s;-moz-transition-duration:0.2s;transition-duration:0.2s; color:#00aeef;}
      .cats .item .c_cats{width:100%;padding-left:34px;}
      .cats .item .c_cats a{color:#333;font-size:13px;font-family:'Trebuchet MS';line-height:22px;display:block;}
      .cats .item .c_cats a:hover{text-decoration:underline;}
      @media (max-width:1299px){.cats .item{width:231px;}.informal .description{max-width:470px;margin-right:0;}}
      @media (min-width: 960px){.cats .item{width:224px;}.informal .dflex{flex-direction: column;}.informal .dflex {
    flex-direction: row;
}}
      @media (max-width: 900px){/*540*/.cats .item{width:224px;} .informal .dflex {
    flex-direction: column !important;
}}
       .cats .item{margin-left: 1px; margin-right: 4px;}
      .thumb {
    width: 100%;
}
.informal .description {
    max-width: 100%;}
      }
      @media (max-width: 576px){/*320*/.cats .item{width:224px;}
       .cats .item{margin-left: 1px; margin-right: 24px;}

      
      }
     @media (max-width: 320px){/*320*/.cats .item{width:224px;}
       .cats .item{margin-left: auto; margin-right: auto;}

      
      }
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
  
</div>
<div class="container" id="content">
  <div class="row informal">
    <?php if ($thumb || $description) { ?>

    <div class="dflex">       
      <?php if ($thumb) { ?>
      <div class="thumb"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>"/></div>
      <?php } ?>
      <div class="description">
          <div class="call btn-modal" data-modal="modal-callback"><?php echo $text_call; ?></div>
          <h1><?php echo $heading_title; ?></h1>
          <?php echo $description; ?>
      </div>
    </div> 
    <?php } ?>
  </div> 

   <div class="row cats">
    <?php if ($categories) { ?>
      <div class="dflex">
        <?php foreach ($categories as $category) { ?>
          <div class="item">
            <div class="thumb">
              <a href="<?php echo $category['href']; ?>">
        <?php 
        $catname= $category['name'];
        $time_start = microtime(true);
ini_set("memory_limit","512M");
ini_set('max_execution_time', 600003);
require_once('/var/www/prote/data/www/prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}
$athumb = $category['thumb'];
$aname= $category['name'];
$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");
$sql = "SELECT * FROM `oc_category_description` WHERE `name` LIKE '$catname'";
$result = $dbcnx->query($sql);
foreach ($result as $val){
  if(isset($val['alt_img'])){
        $img = $val['alt_img'];
      $img = file_get_contents("https://prote.ua$img");
        echo $img;
break;
        }
        else{
echo '<img height="60" class="imageicons" src="image/ico/favicon_prote_16x16.svg" data-original="'.$athumb.'" alt="'.$aname.'" title="'.$aname.'">';
        }
        }
         ?>
           
              
              </a>
            </div>
            <div class="name">
              <a class="cat_name" href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
            </div>
           
          </div>
        <?php } ?>
      </div>
    <?php } ?>
    
    <?php if ($dop_pole=false) { ?>
<style>
      .dop_pole a{text-decoration:underline;}
      .dop_pole{justify-content:center;}
    </style>
      <div class="dflex dop_pole">
         <?php echo $dop_pole; ?>
      </div>
    <?php } ?>
  </div>

  <?php if(0){ ?>
  <div class="row">
<style>
      #content .products>div{width:20%!important;}
      @media (max-width: 992px){#content .products>div{width:33%!important;}}
      @media (max-width: 768px){/*540*/#content .products>div{width:50%!important;}}
      @media (max-width: 576px){/*320*/#content .products>div{width:100%!important;}}
    </style>
    <?php //echo $content_bottom; ?>
  </div>
  <?php } ?>
</div> 
<?php echo $content_reviews; ?>

<style>
/**
 * Swiper 6.5.6
 * Most modern mobile touch slider and framework with hardware accelerated transitions
 * https://swiperjs.com
 *
 * Copyright 2014-2021 Vladimir Kharlampidi
 *
 * Released under the MIT License
 *
 * Released on: April 9, 2021
 */

 @font-face{font-family:swiper-icons;src:url('data:application/font-woff;charset=utf-8;base64, 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') format('woff');font-weight:400;font-style:normal}:root{--swiper-theme-color:#007aff}.swiper-container{margin-left:auto;margin-right:auto;position:relative;overflow:hidden;list-style:none;padding:0;z-index:1}.swiper-container-vertical&gt;.swiper-wrapper{flex-direction:column}.swiper-wrapper{position:relative;width:100%;height:100%;z-index:1;display:flex;transition-property:transform;box-sizing:content-box}.swiper-container-android .swiper-slide,.swiper-wrapper{transform:translate3d(0px,0,0)}.swiper-container-multirow&gt;.swiper-wrapper{flex-wrap:wrap}.swiper-container-multirow-column&gt;.swiper-wrapper{flex-wrap:wrap;flex-direction:column}.swiper-container-free-mode&gt;.swiper-wrapper{transition-timing-function:ease-out;margin:0 auto}.swiper-container-pointer-events{touch-action:pan-y}.swiper-container-pointer-events.swiper-container-vertical{touch-action:pan-x}.swiper-slide{flex-shrink:0;width:100%;height:100%;position:relative;transition-property:transform}.swiper-slide-invisible-blank{visibility:hidden}.swiper-container-autoheight,.swiper-container-autoheight .swiper-slide{height:auto}.swiper-container-autoheight .swiper-wrapper{align-items:flex-start;transition-property:transform,height}.swiper-container-3d{perspective:1200px}.swiper-container-3d .swiper-cube-shadow,.swiper-container-3d .swiper-slide,.swiper-container-3d .swiper-slide-shadow-bottom,.swiper-container-3d .swiper-slide-shadow-left,.swiper-container-3d .swiper-slide-shadow-right,.swiper-container-3d .swiper-slide-shadow-top,.swiper-container-3d .swiper-wrapper{transform-style:preserve-3d}.swiper-container-3d .swiper-slide-shadow-bottom,.swiper-container-3d .swiper-slide-shadow-left,.swiper-container-3d .swiper-slide-shadow-right,.swiper-container-3d .swiper-slide-shadow-top{position:absolute;left:0;top:0;width:100%;height:100%;pointer-events:none;z-index:10}.swiper-container-3d .swiper-slide-shadow-left{background-image:linear-gradient(to left,rgba(0,0,0,.5),rgba(0,0,0,0))}.swiper-container-3d .swiper-slide-shadow-right{background-image:linear-gradient(to right,rgba(0,0,0,.5),rgba(0,0,0,0))}.swiper-container-3d .swiper-slide-shadow-top{background-image:linear-gradient(to top,rgba(0,0,0,.5),rgba(0,0,0,0))}.swiper-container-3d .swiper-slide-shadow-bottom{background-image:linear-gradient(to bottom,rgba(0,0,0,.5),rgba(0,0,0,0))}.swiper-container-css-mode&gt;.swiper-wrapper{overflow:auto;scrollbar-width:none;-ms-overflow-style:none}.swiper-container-css-mode&gt;.swiper-wrapper::-webkit-scrollbar{display:none}.swiper-container-css-mode&gt;.swiper-wrapper&gt;.swiper-slide{scroll-snap-align:start start}.swiper-container-horizontal.swiper-container-css-mode&gt;.swiper-wrapper{scroll-snap-type:x mandatory}.swiper-container-vertical.swiper-container-css-mode&gt;.swiper-wrapper{scroll-snap-type:y mandatory}:root{--swiper-navigation-size:44px}.swiper-button-next,.swiper-button-prev{position:absolute;top:50%;width:calc(var(--swiper-navigation-size)/ 44 * 27);height:var(--swiper-navigation-size);margin-top:calc(0px - (var(--swiper-navigation-size)/ 2));z-index:10;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--swiper-navigation-color,var(--swiper-theme-color))}.swiper-button-next.swiper-button-disabled,.swiper-button-prev.swiper-button-disabled{opacity:.35;cursor:auto;pointer-events:none}.swiper-button-next:after,.swiper-button-prev:after{font-family:swiper-icons;font-size:var(--swiper-navigation-size);text-transform:none!important;letter-spacing:0;text-transform:none;font-variant:initial;line-height:1}.swiper-button-prev,.swiper-container-rtl .swiper-button-next{left:10px;right:auto}.swiper-button-prev:after,.swiper-container-rtl .swiper-button-next:after{content:'prev'}.swiper-button-next,.swiper-container-rtl .swiper-button-prev{right:10px;left:auto}.swiper-button-next:after,.swiper-container-rtl .swiper-button-prev:after{content:'next'}.swiper-button-next.swiper-button-white,.swiper-button-prev.swiper-button-white{--swiper-navigation-color:#ffffff}.swiper-button-next.swiper-button-black,.swiper-button-prev.swiper-button-black{--swiper-navigation-color:#000000}.swiper-button-lock{display:none}.swiper-pagination{position:absolute;text-align:center;transition:.3s opacity;transform:translate3d(0,0,0);z-index:10}.swiper-pagination.swiper-pagination-hidden{opacity:0}.swiper-container-horizontal&gt;.swiper-pagination-bullets,.swiper-pagination-custom,.swiper-pagination-fraction{bottom:10px;left:0;width:100%}.swiper-pagination-bullets-dynamic{overflow:hidden;font-size:0}.swiper-pagination-bullets-dynamic .swiper-pagination-bullet{transform:scale(.33);position:relative}.swiper-pagination-bullets-dynamic .swiper-pagination-bullet-active{transform:scale(1)}.swiper-pagination-bullets-dynamic .swiper-pagination-bullet-active-main{transform:scale(1)}.swiper-pagination-bullets-dynamic .swiper-pagination-bullet-active-prev{transform:scale(.66)}.swiper-pagination-bullets-dynamic .swiper-pagination-bullet-active-prev-prev{transform:scale(.33)}.swiper-pagination-bullets-dynamic .swiper-pagination-bullet-active-next{transform:scale(.66)}.swiper-pagination-bullets-dynamic .swiper-pagination-bullet-active-next-next{transform:scale(.33)}.swiper-pagination-bullet{width:8px;height:8px;display:inline-block;border-radius:50%;background:#000;opacity:.2}button.swiper-pagination-bullet{border:none;margin:0;padding:0;box-shadow:none;-webkit-appearance:none;appearance:none}.swiper-pagination-clickable .swiper-pagination-bullet{cursor:pointer}.swiper-pagination-bullet-active{opacity:1;background:var(--swiper-pagination-color,var(--swiper-theme-color))}.swiper-container-vertical&gt;.swiper-pagination-bullets{right:10px;top:50%;transform:translate3d(0px,-50%,0)}.swiper-container-vertical&gt;.swiper-pagination-bullets .swiper-pagination-bullet{margin:6px 0;display:block}.swiper-container-vertical&gt;.swiper-pagination-bullets.swiper-pagination-bullets-dynamic{top:50%;transform:translateY(-50%);width:8px}.swiper-container-vertical&gt;.swiper-pagination-bullets.swiper-pagination-bullets-dynamic .swiper-pagination-bullet{display:inline-block;transition:.2s transform,.2s top}.swiper-container-horizontal&gt;.swiper-pagination-bullets .swiper-pagination-bullet{margin:0 4px}.swiper-container-horizontal&gt;.swiper-pagination-bullets.swiper-pagination-bullets-dynamic{left:50%;transform:translateX(-50%);white-space:nowrap}.swiper-container-horizontal&gt;.swiper-pagination-bullets.swiper-pagination-bullets-dynamic .swiper-pagination-bullet{transition:.2s transform,.2s left}.swiper-container-horizontal.swiper-container-rtl&gt;.swiper-pagination-bullets-dynamic .swiper-pagination-bullet{transition:.2s transform,.2s right}.swiper-pagination-progressbar{background:rgba(0,0,0,.25);position:absolute}.swiper-pagination-progressbar .swiper-pagination-progressbar-fill{background:var(--swiper-pagination-color,var(--swiper-theme-color));position:absolute;left:0;top:0;width:100%;height:100%;transform:scale(0);transform-origin:left top}.swiper-container-rtl .swiper-pagination-progressbar .swiper-pagination-progressbar-fill{transform-origin:right top}.swiper-container-horizontal&gt;.swiper-pagination-progressbar,.swiper-container-vertical&gt;.swiper-pagination-progressbar.swiper-pagination-progressbar-opposite{width:100%;height:4px;left:0;top:0}.swiper-container-horizontal&gt;.swiper-pagination-progressbar.swiper-pagination-progressbar-opposite,.swiper-container-vertical&gt;.swiper-pagination-progressbar{width:4px;height:100%;left:0;top:0}.swiper-pagination-white{--swiper-pagination-color:#ffffff}.swiper-pagination-black{--swiper-pagination-color:#000000}.swiper-pagination-lock{display:none}.swiper-scrollbar{border-radius:10px;position:relative;-ms-touch-action:none;background:rgba(0,0,0,.1)}.swiper-container-horizontal&gt;.swiper-scrollbar{position:absolute;left:1%;bottom:3px;z-index:50;height:5px;width:98%}.swiper-container-vertical&gt;.swiper-scrollbar{position:absolute;right:3px;top:1%;z-index:50;width:5px;height:98%}.swiper-scrollbar-drag{height:100%;width:100%;position:relative;background:rgba(0,0,0,.5);border-radius:10px;left:0;top:0}.swiper-scrollbar-cursor-drag{cursor:move}.swiper-scrollbar-lock{display:none}.swiper-zoom-container{width:100%;height:100%;display:flex;justify-content:center;align-items:center;text-align:center}.swiper-zoom-container&gt;canvas,.swiper-zoom-container&gt;img,.swiper-zoom-container&gt;svg{max-width:100%;max-height:100%;object-fit:contain}.swiper-slide-zoomed{cursor:move}.swiper-lazy-preloader{width:42px;height:42px;position:absolute;left:50%;top:50%;margin-left:-21px;margin-top:-21px;z-index:10;transform-origin:50%;animation:swiper-preloader-spin 1s infinite linear;box-sizing:border-box;border:4px solid var(--swiper-preloader-color,var(--swiper-theme-color));border-radius:50%;border-top-color:transparent}.swiper-lazy-preloader-white{--swiper-preloader-color:#fff}.swiper-lazy-preloader-black{--swiper-preloader-color:#000}@keyframes swiper-preloader-spin{100%{transform:rotate(360deg)}}.swiper-container .swiper-notification{position:absolute;left:0;top:0;pointer-events:none;opacity:0;z-index:-1000}.swiper-container-fade.swiper-container-free-mode .swiper-slide{transition-timing-function:ease-out}.swiper-container-fade .swiper-slide{pointer-events:none;transition-property:opacity}.swiper-container-fade .swiper-slide .swiper-slide{pointer-events:none}.swiper-container-fade .swiper-slide-active,.swiper-container-fade .swiper-slide-active .swiper-slide-active{pointer-events:auto}.swiper-container-cube{overflow:visible}.swiper-container-cube .swiper-slide{pointer-events:none;-webkit-backface-visibility:hidden;backface-visibility:hidden;z-index:1;visibility:hidden;transform-origin:0 0;width:100%;height:100%}.swiper-container-cube .swiper-slide .swiper-slide{pointer-events:none}.swiper-container-cube.swiper-container-rtl .swiper-slide{transform-origin:100% 0}.swiper-container-cube .swiper-slide-active,.swiper-container-cube .swiper-slide-active .swiper-slide-active{pointer-events:auto}.swiper-container-cube .swiper-slide-active,.swiper-container-cube .swiper-slide-next,.swiper-container-cube .swiper-slide-next+.swiper-slide,.swiper-container-cube .swiper-slide-prev{pointer-events:auto;visibility:visible}.swiper-container-cube .swiper-slide-shadow-bottom,.swiper-container-cube .swiper-slide-shadow-left,.swiper-container-cube .swiper-slide-shadow-right,.swiper-container-cube .swiper-slide-shadow-top{z-index:0;-webkit-backface-visibility:hidden;backface-visibility:hidden}.swiper-container-cube .swiper-cube-shadow{position:absolute;left:0;bottom:0px;width:100%;height:100%;opacity:.6;z-index:0}.swiper-container-cube .swiper-cube-shadow:before{content:'';background:#000;position:absolute;left:0;top:0;bottom:0;right:0;filter:blur(50px)}.swiper-container-flip{overflow:visible}.swiper-container-flip .swiper-slide{pointer-events:none;-webkit-backface-visibility:hidden;backface-visibility:hidden;z-index:1}.swiper-container-flip .swiper-slide .swiper-slide{pointer-events:none}.swiper-container-flip .swiper-slide-active,.swiper-container-flip .swiper-slide-active .swiper-slide-active{pointer-events:auto}.swiper-container-flip .swiper-slide-shadow-bottom,.swiper-container-flip .swiper-slide-shadow-left,.swiper-container-flip .swiper-slide-shadow-right,.swiper-container-flip .swiper-slide-shadow-top{z-index:0;-webkit-backface-visibility:hidden;backface-visibility:hidden}



.top_tel span.svg{left:-3px;top:5px;} .top_tel span.svg svg{width:16px;height:16px;} .top .row > div{line-height:25px;} .header .logo{margin-right:50px;} .header .logo img{margin:4px 0 0 6px;width:126px;height:42px;} .header .row>div.callback svg,.usermenu span.svg svg{width:30px;height:29px;margin:0;} .usermenu,.usermenu span.svg{width:auto;height:auto;} .header .row>div.callback{margin-left:10px;} .header .cart{margin-top:10px;} #cart-total .svg svg{height:29px!important;} #cart-total .count span{width:12px;height:12px;font-size:8px;line-height:12px;min-width:12px;margin-left:7px;} .mainmenu{height:31px;} .rowmenu a{font-size:13px;padding:0 0 0 35px;} .mainmenu svg{top:4px;} .menu-catalog svg{top:4px;left:10px;width:27px;height:21px;} .menu-catalog{width:45px;} .menu-catalog{width:45px;padding:0} .menu-action{width:auto;} .menu-action a{padding:0 10px 0 46px;left:0;font-size:13px;line-height:30px;} .menu-action svg{left:17px;width:24px;height:22px;} .menu-got-resh svg{width:22px;height:22px;left: 10px;} .rowmenu > div:hover .dflex.nohover{display:none;} .header .search{top:52px;height:30px;padding:4px;} .header #searchp input{line-height:14px;padding:4px 8px;} .menu-catalog{width:60px!important;} .header #searchp input.open{background:#fff;width:280px;} }
.swiper-viewport{opacity:0;} .modal{display:none;} .result-search-autocomplete{top:40px;display:none;position:absolute;z-index:9999;background-color:#FFF;top:31px;min-width:300px;max-width:600px;} .show-result .search_result{display:flex;border:1px solid #e3e9ef;} .show-result .result_categories{width: 178px;padding:15px 10px 64px 25px;} .show-result .result_categories .title{font-size: 12px;color:#333;font-weight:bold;padding-bottom:8px;} .show-result .result_categories .item {padding-left:0;} 













    .reviews-home .swiper-pagination-bullet {
        background: #fff;
        opacity: 1;
        margin: 0px 8px !important;
    }
    .reviews-home .swiper-pagination-bullet:last-child {
        margin-right: 0px !important;
    }
    .reviews-home .swiper-pagination-bullet:first-child {
        margin-left: 0px !important;
    }
    .reviews-home .swiper-pagination-bullet-active {
        background: #00AFF2;
        opacity: 1;
    }

    .store-reviews-stat__info--column {
        flex-direction: column;
    }

    .store-reviews-stat__stat-description--hide {
        display: none;
    }

    .store-reviews-stat {
        margin-bottom: 0px !important;
    }

    .store-reviews-stat__ratings {
        width: max-content !important;
    }

    .store-reviews-stat__link-all--right,
    .store-reviews-stat__link-all--bottom {
        display: flex;
        width: 180px;
        height: 60px;
        background: #FDE700;
        border-radius: 3px;
        font-family: Trebuchet MS;
        font-style: normal;
        font-weight: normal;
        font-size: 20px;
        text-align: center;
        color: #333333;
        align-items: center;
        justify-content: center;
        align-self: center;
    }
    .store-reviews-stat__link-all--bottom:hover, .store-reviews-stat__link-all--right:hover {
        color: inherit;
    }
    .store-reviews-stat__block--4 {
        margin-top: 42px;
    }
    .store-reviews-stat__block:nth-child(1) {
        width: auto;
    }

    .store-reviews-stat__block--3 {
        flex-direction: row;
        justify-content: right;
    }

    .row .store-reviews-stat__link-all {
        display: none;
    }

    .store-reviews-stat__full-stars svg,
    .store-reviews-stat__empty-stars svg {
        width: 33px;
        height: 33px;
    }
    @media (min-width: 1280px) {
        .store-reviews-stat__block--4 {
            height: 60px;
            margin-top: 48px;
        }

        .store-reviews-stat__stat-description--col3 {
            width: 86px;
        }
    }

    @media (min-width: 996px) and (max-width: 1279px) {
        .store-reviews-stat__title {
            font-size: 18px;
            line-height: 25px;
            margin-bottom: 22px;
            padding-left: 13px !important
        }
        .store-reviews-stat__stat-text {
            line-height: 30px;
        }
        .store-reviews-stat__content {
            padding: 52px 36px 41px 38px !important;
        }
        .store-reviews-stat__block--4 {
            height: 44px;
            margin-top: 42px;
        }

        .store-reviews-stat__link-all--right {
            width: 128px;
            height: 44px;
            font-size: 15px;
        }
    }

    @media (min-width: 720px) and (max-width: 995px) {
        .store-reviews-stat__title {
            font-size: 18px;
            line-height: 25px;
            margin-bottom: 23px;
            padding-left: 12px;
        }
        .store-reviews-stat__stat-text {
            line-height: 30px;
        }
        .store-reviews-stat__stat-description--hide {
            width: auto;
            display: flex !important;
        }
        .store-reviews-stat__stat-description {
            margin-top: 11px;
        }
        .store-reviews-stat__stat-description--col3 {
            margin-top: -3px;
        }
        .store-reviews-stat__content {
            flex-direction: row;
            flex-wrap: initial;
            padding: 51px 21px 45px 29px;
        }
        .store-reviews-stat__block {
            margin-bottom: 36px;
            margin: 0px;
            justify-content: center;
        }
        .store-reviews-stat__block--1 {
            order: initial;
            width: initial;
        }

        .store-reviews-stat__block--2 {
            order: initial;
        }

        .store-reviews-stat__block--3 {
            order: initial;
            width: initial;
            position: initial;
            top: initial;
        }

        .store-reviews-stat__block--4 {
            height: 44px;
            margin-top: 18px;
        }

        .store-reviews-stat__stat-description--col3 {
            display: none;
        }

        .store-reviews-stat__block-title {
            font-size: 15px;
            margin: 0px;
            height: 40px;
            margin-bottom: 17px;
        }

        .store-reviews-stat__block:nth-child(1) {
            width: auto;
        }

        .store-reviews-stat__block:nth-child(2) {
            width: auto !important;
        }

        .store-reviews-stat__block--1>.store-reviews-stat__block-title {
            width: 72px;
        }

        .store-reviews-stat__block--2>.store-reviews-stat__block-title {
            width: 180px;
        }

        .store-reviews-stat__block {
            align-self: flex-start;
        }

        .store-reviews-stat__info {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__col .store-reviews-stat__block:nth-child(2) {
            margin-top: 0px;
        }

        .store-reviews-stat__col {
            flex-direction: row;
        }

        .store-reviews-stat__info-row {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__full-stars svg,
        .store-reviews-stat__empty-stars svg {
            width: 24px;
        }

        .store-reviews-stat__link-all--right {
            margin: 0px;
            width: 104px;
            height: 62px;
            font-size: 15px;
            padding: 16px;
        }

        .store-reviews-stat__link-all--bottom {
            display: none;
        }

        .store-reviews-stat__block:nth-child(2) {
            justify-content: space-evenly;
            display: flex;
            width: 50%;
        }
    }

    @media (min-width: 540px) and (max-width: 719px) {
        .store-reviews-stat__title {
            font-size: 18px;
            line-height: 25px;
            margin-top: 10px;
            margin-bottom: 23px;
            padding-left: 12px;
        }
        .store-reviews-stat__stat-description--hide {
            width: auto;
            display: flex !important;
        }

        .store-reviews-stat__stat-description--col3 {
            display: none;
            margin-top: -3px !important;
        }

        .store-reviews-stat__block-title {
            font-size: 15px;
            margin: 0px;
            height: 40px;
            margin-bottom: 17px;
        }
        .store-reviews-stat__stat-description {
            line-height: 13px;
            margin-top: 11px;
        }
        .store-reviews-stat__link-all--right {
            display: none;
        }

        .store-reviews-stat__content {
            padding: 40px 21px 0px 28px;
        }
        .store-reviews-stat__stat-text {
            line-height: 30px;
        }
        .store-reviews-stat__block--1>.store-reviews-stat__block-title {
            width: 72px;
        }

        .store-reviews-stat__block--2>.store-reviews-stat__block-title {
            width: 180px;
        }

        .store-reviews-stat__block {
            align-self: flex-start;
        }

        .store-reviews-stat__info {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__col .store-reviews-stat__block:nth-child(2) {
            margin-top: 0px;
        }

        .store-reviews-stat__col {
            flex-direction: row;
            width: 312px;
        }

        .store-reviews-stat__info-row {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__full-stars svg,
        .store-reviews-stat__empty-stars svg {
            width: 24px;
        }

        .store-reviews-stat__block--3>.store-reviews-stat__link-all--right {
            margin: 0px;
            width: 104px;
            height: 62px;
            font-size: 15px;
            padding: 16px;
            display: none;
        }

        .store-reviews-stat__block:nth-child(2) {
            justify-content: space-evenly;
            display: flex;
        }

        .store-reviews-stat__link-all--bottom {
            display: flex;
            width: 454px;
            margin-top: -17px !important;
            height: 42px;
            margin: 0 auto;
            margin-bottom: 0px;
            margin-bottom: 15px;
            font-size: 15px;
            line-height: 17px;
        }
    }

    @media (min-width: 320px) and (max-width: 539px) {
        .store-reviews-stat__stat-text {
            line-height: 30px
        }
        .store-reviews-stat__stat-description {
            margin-top: 11px;
            line-height: 13px;
        }
        .store-reviews-stat__content {
            padding-left: 10px;
            padding-right: 14px;
            padding-bottom: 8px;
        }
        .store-reviews-stat__stat-description--col3 {
            margin-top: -5px !important;
        }
        .reviews-home__read {
            margin-top: 66px;
        }
        .reviews-home__pearson {
            left: 13px;
        }
        .reviews-home__comment-content {
            width: 100%;
            max-height: 72px;
            overflow: hidden;
        }
        .store-reviews-stat__block--4 {
            position: relative;
            left: 9px;
            top: 6px;
        }
        .store-reviews-stat__block:nth-child(2) {
            width: 160px !important;
        }
        .store-reviews-stat__link-all--right {
            padding: 0px 14px
        }
        .reviews-home__comment-block {
            padding: 20px 20px 20px 28px;
        }

        .store-reviews-stat__block-title {
            font-size: 15px;
            margin: 0px;
            height: 40px;
            margin-bottom: 17px;
        }

        .store-reviews-stat__block--4 {
            order: 4;
            justify-content: right;
            align-self: flex-end;
            width: auto !important;
        }
        .store-reviews-stat__link-all--right {
            order: 4;
            width: 102px;
            height: 50px;
            font-size: 15px;
            margin-left: auto;
        }

        .store-reviews-stat__stat-description--hide {
            width: auto;
            display: flex !important;
        }

        .store-reviews-stat__stat-description--col3 {
            display: none;
        }

        .store-reviews-stat__block {
            width: 50%;
        }

        .store-reviews-stat__block:nth-child(1) {
            width: auto;
        }

        .store-reviews-stat__block:nth-child(2) {
            order: 3;
        }

        .store-reviews-stat__link-all--bottom {
            display: none !important;
        }

        .store-reviews-stat__block--1>.store-reviews-stat__block-title {
            width: 72px;
        }

        .store-reviews-stat__block--2>.store-reviews-stat__block-title {
            width: 180px;
        }

        .store-reviews-stat__info {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__col .store-reviews-stat__block:nth-child(2) {
            margin-top: 0px;
        }

        .store-reviews-stat__col {
            flex-direction: row;
            width: 312px;
        }

        .store-reviews-stat__info-row {
            flex-direction: column;
            margin-top: 0px;
        }

        .store-reviews-stat__full-stars svg,
        .store-reviews-stat__empty-stars svg {
            width: 24px;
        }

        .store-reviews-stat__block--3>.store-reviews-stat__link-all--right {
            margin: 0px;
            width: 104px;
            height: 62px;
            font-size: 15px;
            padding: 16px;
            display: none;
        }

        .store-reviews-stat__block:nth-child(2) {
            justify-content: space-evenly;
            display: flex;
            width: 50%;
        }

        .store-reviews-stat__link-all--bottom {
            display: flex;
            width: 100%;
            height: 42px;
            margin: 0 auto;
            margin-bottom: 0px;
            margin-bottom: 15px;
        }
    }




</style>
<script src="catalog/view/js/swiper/js/swiper.min.js"></script>
<script>
    const swiper = new Swiper('.swiper-container', {
      direction: 'horizontal',
      speed: 300,
      spaceBetween: 30,
      slidesPerView: 1,
      centeredSlides: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false
      },
      loop: true,
      slidesPerView: 1,
      pagination: {
          el: '.swiper-pagination',
        },
      scrollbar: {
      el: '.swiper-scrollbar',
      },
    });
  </script>
<script>
$(document).ready(function(){var swiper = new Swiper('#slideshow0', {spaceBetween:30, centeredSlides: true, navigation: {nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev', }, pagination: {el: '.slideshow0', clickable: true, }, autoplay: {delay: 4000, disableOnInteraction: true, }, mode:'horizontal', slidesPerView:1, loop:true, lazy: {loadPrevNext: true, }, }); });
</script>
<?php echo $footer; ?>





