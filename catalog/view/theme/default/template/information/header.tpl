<?php $langurl=($lang=='uk'?'/ua':'') ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="uk-UA<?php //echo $lang_loc; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="uk-UA<?php //echo $lang_loc; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang_loc; ?>">
<!--<![endif]-->
<head>
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-76966033-1', 'auto', {'allowLinker': true});
  ga('require', 'linker');
  ga('linker:autoLink', ['new-partner.vm.ua'] );
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-76966033-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-76966033-1');
</script>

<?php
   header("Content-Security-Policy-Report-Only");
?>
<!--<![endif]-->
<?php if($noindex){ ?>
  <?php echo $noindex; ?>
<?php } else{ ?>
<meta name="robots" content="index, follow">
<?php } ?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, height=device-height, initial-scale=1.0, maximum-scale=2.0, user-scalable=0">
<link rel="canonical" href="<?php $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
echo "https://prote.ua".$url;   ?>" />
<meta name="google-site-verification" content="rUlWDf1WeJWigBSSmRn_3l6ECIAd8G1qfVvEVW6IcF8" />
<meta name="google-site-verification" content="G5mYWysDttDucw37MKM_1FoCJnU7Os6NPt2rAn1Ukj4" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="theme-color" content="#fd9710">
<link rel="alternate" hreflang="<?=($lang=='uk'? 'ru':'uk')?>" href="<?=($lang=='uk' ? str_replace('prote.ua/ua', 'prote.ua', $og_url) :str_replace('prote.ua', 'prote.ua/ua', $og_url))?>" />
<link rel="icon" type="image/png" href="https://prote.ua/image/favicon.png"/>
<link rel="apple-touch-icon-precomposed" href="https://prote.ua/image/favicon-apple-touch.png"/>
                                                                          <base href="<?php echo $base; ?>" />
<title><?php echo $title; ?></title>
<?php if ($description){ ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords){ ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $og_title; ?>"/>
<meta property="og:url" content="<?php echo $og_url; ?>"/>
<meta property="og:description" content='<?php echo $og_description; ?>'/>
<meta property="article:author" content="https://www.facebook.com/Prote-289486441413364/"/>
<?php if ($og_image){ ?>
<meta property="og:image" content="<?php echo $og_image; ?>"/>
<?php } else{ ?>
<meta property="og:image" content="<?php echo $logo; ?>"/>
<?php } ?>
<meta property="og:publisher" content="https://www.facebook.com/Prote-289486441413364/"/>
<meta property="og:site_name" content="<?php echo $name; ?>"/>
  <link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/oldstyle.css">

  <link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/theme.css?v=1.4">
  <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
<?php /* <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap&subset=cyrillic" rel="stylesheet"> --> */ ?>
<link rel="preload" href="/catalog/view/js/chosen/chosen.min.css" as="style" />

<link rel="manifest" href="/catalog/view/js/manifest.json">
<?php $langpref=($lang=='uk' ?  '/ua':''); ?>
<style>
.callback-modal__call:hover{
background: #F6731C;
}
.top-panel__login:hover span{
  border-bottom: none !important;
  color: #00aff2;
}
.general-menu__def-link:hover{
  color: #FD9710;
}
.bf-attr-filter:hover{
background: #bee9f9 !important;
}
.bf-attr-filter:hover label{
color: #fd9710;
}
.bf-count{
 color: #00aeef;
}
.reatured{
      padding-bottom: 25px;

}
.general-menu__brand-ico:hover{
    margin-top: -10px;
     transition: 1s;
}
#cssmenu li:hover > div {
transition: 1s;
}

@font-face {font-family: 'Open Sans'; font-style: normal; font-weight: 400; font-display: swap; src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v17/mem8YaGs126MiZpBA-UFUZ0bbck.woff2) format('woff2'); unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116; } @font-face {font-family: 'Open Sans'; font-style: normal; font-weight: 700; font-display: swap; src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v17/mem5YaGs126MiZpBA-UN7rgOVuhpOqc.woff2) format('woff2'); unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116; }
@-ms-viewport{width:device-width;} *,html{box-sizing:border-box;-ms-overflow-style:scrollbar;} html{min-width:320px;} *{outline:none}:after,:before{box-sizing:inherit} body{overflow-x:hidden;font-family:'Open Sans',sans-serif;font-size:14px;line-height:1.5em;color:#333333;background-color:#fff;position:relative;} body,h1,h2,h3,h4,h5,h6,li,ol,p,ul{margin:0;padding:0} ol,ul{list-style:none} button{outline:none;cursor:pointer;} button,img{border:none} .alert button.close{background:none;} a{text-decoration:none;color:inherit}[contenteditable=true]:empty:before{content:attr(data-placeholder);color:#131313;font-size:inherit;display:block;} a:hover,polygon,path{color:#00aff2;transition-duration:0.3s;} li{list-style:none;} img{vertical-align:middle;  border-style:none;} input::placeholder{opacity:1; transition:opacity 0.3s ease;} input:focus::placeholder{opacity:0; transition:opacity 0.3s ease;} textarea::placeholder{opacity:1; transition:opacity 0.3s ease;} textarea:focus::placeholder{opacity:0; transition:opacity 0.3s ease;} input,button,select,optgroup,textarea{margin:0;font-family:inherit;font-size:inherit;line-height:inherit; transition-duration:0.5s;} input{border:1px solid #cecece;} input:not([type="submit"]):invalid:not(:focus):not(:placeholder-shown){border:2px solid #fd9710;} input[type="submit"]{border:none;} button,input{overflow:visible;} button,select{text-transform:none;} button,html [type="button"],[type="reset"],[type="submit"]{-webkit-appearance:button;} button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner{padding:0;border-style:none;} [type="submit"]{border:none;} input[type="radio"],input[type="checkbox"]{box-sizing:border-box;padding:0;} textarea{overflow:auto;resize:vertical;line-height:30px;padding:0 10px;width:100%;font-size:11.5px;color:#999;} input[type="text"], select, input[type="tel"], input[type="number"] {line-height:30px;padding:0 10px;width:100%;font-size:11.5px;color:#999;margin-bottom:10px;} select{height:30px;color:#333;} textarea{overflow:auto;resize:vertical;line-height:30px;padding:0 10px;width:100%;font-size:11.5px;color:#999;} .container{width:100%;max-width: calc(100% - 30px);padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto;position:relative;} img[src="image/ico/favicon_prote_16x16.svg"]{max-width:30px;margin:auto;} .dflex{display:flex;} .dtable{display:table;} .dtablecell{display:table-cell;} .img-responsive{width:100%; height:auto;} .row{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;} .top .menu{float:right;} .menu li{font-size:11px;} .menu li a{padding:16px 13px 7px;line-height:30px;color:#fff;} .menu li a:hover{color:#fff200;} .top li.lang a,.top li.lang span{padding:16px 3px 7px;} .top li.lang.ua a, .top li.lang.ua span{padding:16px 0 7px 3px;} .lang.active{color:#fff200;text-decoration:underline;}
#search-btn1{background:none;padding-top:3px;cursor:pointer;} #searchp-prn{display:none;} .header .logo{width:168px;margin-right:116px;} .header .search{width:444px;padding:0 12px;margin-right:76px;position:relative;}  #searchp .input-group-btn, #searchp-prn{position:absolute; right:0;top:0;} .usermenu{line-height:13px;flex-direction:column;justify-content:center;position:relative;padding-left:50px;min-height:34px;padding-top:1px;} .usermenu span.svg{position:absolute;left:0;top:0px;} .usermenu .svg.person{display:none;} .usermenu>div{height:13px;font-size:12px;color:#919191;} .usermenu a{line-height:13px;font-size:12px;text-decoration:underline;} .usermenu a:hover{text-decoration:none;} .usermenu .login a{color:#fd9710;} .usermenu .register a{color:#00aff2;} .header .row>div.callback{display:none;} .header .cart ul{display:none;} .header .cart{position:absolute;right:0; width: 121px;} #cart{cursor:pointer;} #cart-total{display:flex;color:#999999;font-size:11px;line-height:13px;position:relative;} #cart-total .svg{position:absolute;top:0;}  #cart-total .total{padding-top:6px;width:56px;} .rowmenu > div .dflex{display:none;} .mainmenu{background:#ecf7fb;height:62px;padding-top:1px;margin-bottom:50px;max-width: 1260px;width: 100%;margin-left: 260px;} .rowmenu > div:hover:before{color:#00adee;} .rowmenu a{font-size:11.5px;line-height:13px;display:block;position:relative;} .rowmenu a:hover{color:#00adee;} .menu-catalog{width:60px;margin-right:1px;background:#a1e0ea;border-right:1px solid #ecf7fb;cursor:pointer;} html[lang="ru"] .menu-catalog{width:69px;} .menu-gotr{width:181px;background:#bee9f9;} html[lang="ru"] .menu-gotr{width:183px;} .menu-gotr a{padding-left:64px;text-decoration:underline;} html[lang="ru"] .menu-gotr > a{padding-left:60px;} .menu-action{background:#fd9710;width:104px;vertical-align:middle;} .menu-action a{color:#fff;padding:20px 0 20px 53px;font-size:14px;} .menu-action:hover{background:#fff;} .rowmenu > div.menu-got-resh{display:none;} .menu-catalog svg{left:16px;top:16px;width:28px;height:21px;} .menu-action svg{left:14px;top:12px;} .menu-action:hover svg path{fill:#fd9710;} .menu-action:hover a{color:#fd9710;} .menu-paper svg{left:34px;top:7px;} .menu-print svg{left:34px;top:8px;} .menu-tech svg{left:34px;top:5px;} .menu-pens svg{left:34px;top:16px;} .menu-himija svg{left:34px;top:6px;} .menu-food svg{left:36px;top:5px;} .rowmenu > div:hover svg path{fill:#00adee;} .rowmenu > div:hover:nth-child(2n+1) svg path{fill:#fd9710;} .rowmenu > div:hover:nth-child(2n+1) a{color:#fd9710;} .mainmenu .line{position:relative;} .mainmenu .line:after{position:absolute;left:-14px;top:16px;content:'';background:#b7b7b7;height:32px;width:1px;border-left:1px solid #dce4e7;border-right:1px solid #d0d5d7; }

<?php if ($route=='common/home'){?>
.m_hov{width:242px;}#cssmenu .m{width:100%;}.header .row
<?php } else { ?>
#cssmenu .m{display: none;}
<?php } ?>
.b{font-weight:bold;} .error{color:red;} .button{padding:10px 20px;background:#fd9710;color:#fff;display:inline-block;} .buttonb{background:#00aff2;color:#fff;padding:10px 22px;font-size:13px;font-size:14px;} .buttonb:hover{background:#017ead;} .button:hover{color:#fff;background:#da7e05;} .success{color:#5bb75b;} .button.blue{background:#00adee;} .button.blue:hover{background:#017ead;} #slider .info a:hover{text-decoration:underline;} .svg_search{width:18px;height:18px;}.svg_person{width:63px;height:63px;}.svg_cart{width:40px;height:40px;}.svg_callback{width:65px;height:65px;} .svg_ready_cart{width:32px;height:32px;} .svg_action{width:30px;height:28px;} </style>
<?php if ($route=='common/home'){ ?>
<style>
@media (max-width: 640px){
.tooltip{
  left:0px !important;
}
.catalog-recommendation__card:hover{
  margin-top: -10px;
     transition: 1s;
}
#slider{max-width:1260px;padding-top:7px;z-index:1;} #slider span.svg{position:absolute;left:8px;top:3px;} #slider .info{margin-top:0px;padding-top:10px;} #slider .info > div{position:relative;} #slider .info a{padding-left:54px;display:block;padding-top:8px;line-height:16px;padding-right:15px;font-size:13px;} #slider .info a:hover{color:inherit;} .col2 a{padding-left:62px;} [lang="uk"] .col2 a{padding-right:28px;} .col3 a{padding-left:66px;} .col4 a{padding-left:74px;} .col0{display:none;} .col11{display:none;} .col1{color:#f28b1c;width:223px;} .col2{width:287px;} .col3{color:#00aff2;width:220px;} .col4{color:#f28b1c;width:260px;} .col0 span.svg{top:3px;} .col1 span.svg{} .col11 span.svg{top:3px;} .col2 span.svg{top:6px;left:12px;} .col3 span.svg{top:2px;left:15px;} .col4 span.svg{top:10px;left:17px;} .col1 span.svg path{fill:#fd9710;} .col2 span.svg path{fill:#333333;} .col3 span.svg path{fill:#00adee;} .col4 span.svg path{fill:#fd9710;} #slider .info >div:after{content:'';position:absolute;top:20px;right:9px;width:8px;height:8px;border-top:1px solid;border-right:1px solid;-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:rotate(45deg);transform:rotate(45deg);} .col1:after{border-color:#f28b1c;} .col3:after{border-color:#00aff2;} .col4:after{border-color:#f28b1c;} @media (max-width:1300px){#slider .info a{padding-top:0;} }
@media (max-width:1300px){#slider{max-width:100%;} #slider{margin-top:0;padding-top:7px;} #slider .info{margin-top:10px;padding-top:0!important;margin-bottom:18px;background:#ecf7fb;height:61px;overflow:hidden;} #slider .info > div{width:auto;} #slider .info > div span.hide{display:none;} .col0,.col11,.col1,.col2,.col3  {display:flex;align-items: center} #slider .info a{font-size:11px;line-height:14px;padding-right:22px;} .col0{-webkit-order:1;order:1;} .col11{-webkit-order:2;order:2;} .col1{-webkit-order:3;order:3;} .col2{-webkit-order:6;order:6;} .col3{-webkit-order:5;order:5;} .col4{-webkit-order:4;order:4;} .col0 span.svg{top:16px;left:15px;} .col1 span.svg{top:11px;left:7px;} .col11 span.svg{top:16px;left:8px;} .col2 span.svg{top:12px;left:15px;} .col3 span.svg{top:10px;left:8px;} .col4{display: none} .col0 span.svg path,.col4 span.svg path{fill:#fd9710;} .col1 span.svg path,.col2 span.svg path{fill:#333333;} .col11 span.svg path,.col3 span.svg path{fill:#00adee;} .col0:hover,.col4:hover{background:#ffeacf} .col1:hover,.col2:hover{background:#dfdfdf} .col11:hover,.col3:hover{background:#bee9f9} .col0 a,.col0 a:hover{color:#fd9710;padding-right:30px;} .col1 a,.col1 a:hover{color:#333333;padding-left:44px;} .col11 a,.col11 a:hover{color:#00adee;padding-left:52px;} .col2 a,.col2 a:hover{color:#333333;padding-left:58px;} .col3 a,.col3 a:hover{color:#00adee;padding-left:55px;} .col4 a,.col4 a:hover{color:#fd9710;padding-left:48px;} .col0 svg{width:25px;}.col1 svg{width:28px}.col11 svg{width:33px}.col2 svg{width:29px}.col3 svg{width:35px}.col4 svg{width:27px} #slider .info >div:after{top:50%;margin-top:-5px;right:13px;width:7px;height:7px;} .col0:after, .col4:after{border-color:#f28b1c;} .col1:after, .col2:after{border-color:#333333;} .col11:after, .col3:after{border-color:#00aff2;}
}
@media (max-width:992px){#slider{width:100%;padding-top:0;} #slider .info{display:none} }
@media (max-width:768px){#slider .content{padding-bottom:0;} }
</style>
<?php } ?>
<style>
@media (max-width:1300px){.hidden960{display:none!important;} .telmain{display:block;position:relative;} .telmain:after{content:'';position:absolute;right:0;top:12px;width:0;height:0;border-style:solid;border-width:8px 5px 0 5px;border-color:#ffffff transparent transparent transparent;  } .telhidden{height:0;opacity:0;display:block;background:#fd9710;transition:0.5s linear;padding:0 25px;margin:-1px 0 0 -25px;border:none;} .top_tel:hover .telhidden{height:auto;opacity:1;} .top_tel:hover{opacity:1;} .top .row .cons{display:inline-block;} .header .logo{margin-right:70px;} .header .search{width:344px;margin-right:0;} .usermenu{padding-left:37px;} .usermenu span.svg{display:none;} .header .cart{width:121px;} .m_hov{display:none;} }
@media (max-width:992px){#cssmenu .m > ul.aim{display:none;} .top .row{text-align:right;max-width:none;} .top .cons,.top .callback,.top .time_work,.top .menu{display:none!important;} .top_tel{color:#000;font-size:14px;margin-top:7px;} .top_tel span.svg{top:5px;} .top_tel span.svg svg{width:21px;height:21px;} .top_tel path{fill:#000;} .top_tel .telmain{display:inline-block;} .top_tel .hidden960{display:inline-block!important;} .top_tel .telhidden{opacity:1;display:inline-block;height:auto;background:none;margin:0;padding:0;} .top_tel .telmain:after{border:none;} .header .logo{width:303px;height:96px;margin-right:115px;} .header .row{padding:0 0 0px;max-width:none;} .header .row >div{align-self:start;} .header .logo img{width:284px;height:96px;margin-left:11px;} .header .search{position:absolute;top:105px;right:-4px;width:auto;height:66px;padding:6px 0 8px;z-index:30;} #searchp{margin:0} #searchp input{height:100%;background:#fd9710;border:none;width:0px;z-index:20;transition:0.5s;} #searchp input.open{background:#fff;width:630px;} #searchp input.open + .input-group-btn span.svg path{fill:#000;} #result-search-autocomplete,#result-search-autocomplete-prn{display:none;} .usermenu{margin-top:28px;width:71px;height:62px;} .usermenu .svg.bag{display:none;} .usermenu .svg.person{display:block;} .usermenu span.svg{display:block;width:71px;height:62px;} .usermenu span.svg svg{height:59px;width:59px;margin-top:3px;margin-left:10px;} .usermenu span.svg path{fill:#333;} .usermenu .login,.usermenu .register{display:none;} .header .row>div.callback{display:block;margin-left:46px;margin-top:26px;} .header .row>div.callback svg{margin-top:0px;} .header .cart{margin-top:28px;right:18px;width:auto;} #cart-total .total{display:none;} #cart-total .svg svg{width:56px;height:58px;} #cart-total .count{padding-left:10px;} #cart-total .count span{width:26px;height:26px;font-size:12px;line-height:25px; position: relative; top:-7px;} .mainmenu{background:#fd9710;margin-bottom:0;} .rowmenu a{color:#fff;font-size:30px;font-family:'Trebuchet MS';} .rowmenu a:hover{color:#fff;} .rowmenu > div:hover svg path{fill:#fff;} .menu-catalog{background:none;border-right:none;} .mainmenu{height:auto;} .menu-action{display:block!important;} .menu-paper,.menu-print,.menu-tech,.menu-pens,.menu-himija,.menu-food{display:none!important;} .menu-catalog svg{top:10px;left:20px;width:62px;height:46px;} .menu-catalog:hover svg path{fill:#fff!important;} .menu-catalog{width:105px;height:100%;} .menu-action{width:206px;} .menu-action svg{top:6px;left:28px;} .menu-action svg{width:60px;height:49px;} .menu-action a{padding-left:97px;line-height:40px;padding-right:20px;} .rowmenu > div.menu-got-resh{display:table-cell;} .menu-got-resh a{padding-left:73px;} .menu-got-resh svg{width:46px;height:46px;} .menu-got-resh svg path{fill:#fff;} }
@media (max-width:768px){.rowmenu>div{height:auto;} .top_tel{font-size:19px;margin-top:5px;} .top_tel span.svg{top:4px;left:-15px;} .top_tel span.svg svg{width:27px;height:28px;} .header .logo{width:auto;height:auto;margin-right:87px;} .header .logo img{width:213px;height:71px;} .usermenu{margin-top:9px;} .usermenu span.svg svg{width:47px;height:47px;margin-left:15px;} .header .row>div.callback{margin-left:25px;margin-top:10px;} .header .row>div.callback svg{width:50px;height:50px} .header .cart{margin-top:13px;right:3px;} #cart-total .count{padding-left:8px;padding-top:1px;} #cart-total .count span{width:23px;height:23px;} #cart-total .svg svg{width:46px;height:46px;} .mainmenu{height:53px;} .rowmenu a{padding:5px 0 5px 58px;font-size:22px;} .mainmenu span.svg{top:7px;left:11px;} .menu-catalog svg{width:46px;height:35px;top:8px;} .menu-catalog{width:85px;} .menu-action{width:155px;} .menu-action svg{width:42px;height:40px;left:20px;top:4px;} .menu-action a{padding:5px 0 5px 72px;} .menu-got-resh svg{width:37px;height:37px;} .header .search{top:82px;right:-9px;height:53px;} #searchp input.open{background:#fff;width:460px;} }
@media (max-width:576px){.top_tel{font-size:11px;margin:0;} .top_tel span.svg{left:-3px;top:5px;} .top_tel span.svg svg{width:16px;height:16px;} .top .row > div{line-height:25px;} .header .logo{margin-right:50px;} .header .logo img{margin:4px 0 0 6px;width:126px;height:42px;} .header .row>div.callback svg,.usermenu span.svg svg{width:30px;height:29px;margin:0;} .usermenu,.usermenu span.svg{width:auto;height:auto;} .header .row>div.callback{margin-left:10px;} .header .cart{margin-top:10px;} #cart-total .svg svg{height:29px!important;} #cart-total .count span{width:12px;height:12px;font-size:8px;line-height:12px;min-width:12px;margin-left:7px;} .mainmenu{height:31px;} .rowmenu a{font-size:13px;padding:0 0 0 35px;} .mainmenu svg{top:4px;} .menu-catalog svg{top:4px;left:10px;width:27px;height:21px;} .menu-catalog{width:45px;} .menu-catalog{width:45px;padding:0} .menu-action{width:auto;} .menu-action a{padding:0 10px 0 46px;left:0;font-size:13px;line-height:30px;} .menu-action svg{left:17px;width:24px;height:22px;} .menu-got-resh svg{width:22px;height:22px;left: 10px;} .rowmenu > div:hover .dflex.nohover{display:none;} .header .search{top:52px;height:30px;padding:4px;} .header #searchp input{line-height:14px;padding:4px 8px;} .menu-catalog{width:60px!important;} .header #searchp input.open{background:#fff;width:280px;} }
.swiper-viewport{opacity:0;} .modal{display:none;} .result-search-autocomplete{top:40px;display:none;position:absolute;z-index:9999;background-color:#FFF;top:31px;min-width:300px;max-width:600px;} .show-result .search_result{display:flex;border:1px solid #e3e9ef;} .show-result .result_categories{width: 178px;padding:15px 10px 64px 25px;} .show-result .result_categories .title{font-size: 12px;color:#333;font-weight:bold;padding-bottom:8px;} .show-result .result_categories .item {padding-left:0;} .show-result .result_categories .name a{ color:#fd9710; font-size: 12px;line-height: 16px;padding:8px 0;display:block;} .show-result .result_categories .text {padding-left:0;} .show-result .result_products{width: 418px;border-left:1px solid #e3e9ef;} .show-result .item{display:flex;padding:5px;} .show-result .result_products .item+.item{border-top:1px solid #e3e9ef;border-bottom:none;border-radius: 0;} .show-result .result_products .text{margin-left:4.2%;display:flex;align-items:center;} .show-result .name a{color:#333;font-size:12px;line-height:13px;} .show-result .name a:hover{text-decoration:underline;color:#00adee;} .show-result .price{color:#fd9710;font-size:12px;padding-top:3px;} .allres{position: absolute;bottom:18px;} .allres a{color:#00adee;display:block;font-size:14px;text-decoration:underline;line-height:16px;font-family: 'Trebuchet MS';} .st0{fill:#FFFFFF;} .desсription ul{margin-bottom: 15px;} .desсription li{list-style: disc;margin-left: 30px;} .desсription p{margin-bottom: 10px;} .search_result .result_not_found {color:#333;font-size:12px;line-height:13px;padding:5px;padding-top:7px;}
@media (max-width: 1300px) {.result-search-autocomplete{max-width: 600px; } }
@media (max-width: 992px) {.result-search-autocomplete{top:58px;right:0;} .result-search-autocomplete{max-width: 600px; } }
@media (max-width: 768px) {.result-search-autocomplete{top:45px;right:0;} }
@media (max-width: 576px) {.result-search-autocomplete{top:26px;right:4px;} .show-result .result_categories{display:none;} .show-result .result_products{border-left:none;width: 320px;} }
</style>
<?php if ($route=='checkout/checkout'){ ?>
<script src="/catalog/view/js/jquery-3.5.1.min.js"></script>
<?php } ?>
<!-- <script>//document.addEventListener('touchstart', ontouchstart,{passive:true});
//window.addEventListener('touchstart', e => e.preventDefault(),{passive:true });</script> -->
</head>
<body class="<?php echo $class; ?>">


<script type="application/ld+json">/*<![CDATA[*/{"@context":"http://schema.org","@type":"WebSite","url":"https://prote.ua/","potentialAction":{"@type":"SearchAction","target":"https://prote.ua/search/?search={query}","query-input":"required name=query"}}/*]]>*/</script>





<div class="pre_container top">
  <div class="top-panel">
    <div class="container">
        <div class="row">
          <div class="top-panel__container">
            <div class="top-panel__menu-icon">
              <?php echo file_get_contents(DIR_IMAGE.'/ico/menu.svg');?>
            </div>
            <div class="top-panel__menu-title">Каталог</div>
            <div class="top-panel__logo">
              <?php if ($home == $og_url){ ?>
              <img src="/image/ico/logo-<?php echo $lang; ?>.svg" title="<?php echo $text_sitename; ?>" alt="<?php echo $text_sitename; ?>" class="top-panel__logo-img" />
              <img src="/image/ico/logo-light-<?php echo $lang; ?>.svg" title="<?php echo $text_sitename; ?>" alt="<?php echo $text_sitename; ?>" class="top-panel__logo-img--light" />
              <img src="/image/ico/logo-light-tablet-<?php echo $lang; ?>.svg" title="<?php echo $text_sitename; ?>" alt="<?php echo $text_sitename; ?>" class="top-panel__logo-img-tablet--light" />
              <?php } else { ?>
              <a href="<?php echo $home; ?>"><img src="/image/ico/logo-<?php echo $lang; ?>.svg" title="<?php echo $text_sitename; ?>" alt="<?php echo $text_sitename; ?>" class="top-panel__logo-img" /></a>
              <a href="<?php echo $home; ?>"><img src="/image/ico/logo-light-<?php echo $lang; ?>.svg" title="<?php echo $text_sitename; ?>" alt="<?php echo $text_sitename; ?>" class="top-panel__logo-img--light" /></a>
              <a href="<?php echo $home; ?>"><img src="/image/ico/logo-light-tablet-<?php echo $lang; ?>.svg" title="<?php echo $text_sitename; ?>" alt="<?php echo $text_sitename; ?>" class="top-panel__logo-img-tablet--light" /></a>
              <?php } ?>
            </div>
            <div class="cart top-panel__cart">
              <a href ="<?php echo $langpref;?>/cart/">
              <?php echo $cart; ?>
              </a>
            </div>
            <div class="top-panel__city">
              <span class="top-panel__city-name">Київ</span>
            </div>
            <div class="top-panel__menu">
              <a href="<?php echo $langpref;?>/about_us.html" title="<?php echo $text_about; ?>" class="top-panel__link"><?php echo $text_about; ?></a>
              <a href="<?php echo $langpref;?>/delivery.html" title="<?php echo $text_delivery; ?>" class="top-panel__link"><?php echo $text_delivery; ?></a>
              <a href="<?php echo $langpref;?>/payment.html" title="<?php echo $text_pay; ?>" class="top-panel__link"><?php echo $text_pay; ?></a>
              <a href="<?php echo $langpref;?>/contacts.html" title="<?php echo $text_contacts; ?>" class="top-panel__link"><?php echo $text_contacts; ?></a>
              <!-- <a href="#" class="top-panel__link" style="display: none"><?php echo $text_bonus ?></a> -->
            </div>
            <div class="top-panel__phone callback">
              <div class="top-panel__phone--selected"><?=$telephone?></div>
              <div class="top-panel__arrow"></div>
              <?php require(DIR_APPLICATION.'/view/js/modal/callback.tpl');?>
            </div>
            <div class="top-panel__lang">

              <?php $current_url=$_SERVER['REQUEST_URI'];
                 if ($lang=='uk'){
                     $current_url=str_replace('/ua/','/',$current_url); ?>
              <div class="top-panel__lang--select">Укр<div class="top-panel__arrow--dark"></div>
              </div>
            <div class="lang-select">
              <div class="lang-select__item"><a href="<?php echo '/ru' . $current_url; ?>" class="top-panel__lang-link">Рус</a></div>
            </div>
              <? } else {
                     $current_url='/ua'.$current_url; ?>
              <div class="top-panel__lang--select">Рус<div class="top-panel__arrow--dark"></div>
           </div>
          <div class="lang-select">
            <div class="lang-select__item"><a href="<?php echo '/ua' . $current_url; ?>" class="top-panel__lang-link">Укр</a></div>
          </div>
              <? } ?>
            </div>
            <div class="top-panel__login">
              <?php if ($logged){ ?>
              <div class="top-panel__register">
                <a href="<?php echo $account; ?>" rel="nofollow"><?php echo $name; ?></a>
              </div>
              <?php } else { ?>
              <span class="top-panel__login-line1 top-panel__login-btn"><?php echo $text_login_first_line; ?></span>
              <span class="top-panel__login-line2 top-panel__login-btn"><?php echo $text_login_second_line; ?></span>
              <?php echo $login_html; ?>
              <?php // echo $text_register; ?>
              <?php } ?>
            </div>
          </div>
        </div>
          <!--<div class="top_tel tel" itemscope itemtype="https://schema.org/Organization">
            <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/01-tel.svg');?></span>
            <meta itemprop="name" content="Prote.com.ua - магазин доступной печати">
            <meta itemprop="url" content="<?php echo $og_url; ?>">
            <img itemprop="logo" src="/image/ico/logo-ru.svg" alt="Prote.ua" style="display:none;"/>
            <span itemprop="address" itemscope  itemtype="https://schema.org/PostalAddress"> <meta itemprop="addressCountry" content="Украина"> <meta itemprop="addressLocality" content="Киев"> <meta itemprop="streetAddress" content="ст. м. «Арсенальна»">
            </span>
            <span itemprop="telephone" data-href="tel://+380443790962" class="telmain"><a href="tel:+380443790962">(044)&nbsp;379-09-62</a></span> <span class="hidden960">|</span>
            <span itemprop="telephone" data-href="tel://+380504699575" class="telhidden"><a href="tel:+380504699575">(050)&nbsp;469-95-75</a></span> <span class="hidden960">|</span>
            <span itemprop="telephone" data-href="tel://+380673545625" class="telhidden"><a href="tel:+380673545625">(067)&nbsp;354-56-25</a></span>
          </div>
          <div class="cons">Онлайн-консультант</div>
          <div class="callback btn-modal" data-modal="modal-callback"><?php echo $text_callback; ?></div>
          <?php /* <div class="time_work"><?php //echo $text_timetable; ?></div> */ ?>
          <div class="menu">
              <ul class="dflex">
                <li><a href="<?php echo $langpref;?>/delivery.html" title="<?php echo $text_delivery; ?>"><?php echo $text_delivery; ?></a></li>
                <li><a href="<?php echo $langpref;?>/payment.html" title="<?php echo $text_pay; ?>"><?php echo $text_pay; ?></a></li>
                <li><a href="<?php echo $langpref;?>/contacts.html" title="<?php echo $text_contacts; ?>"><?php echo $text_contacts; ?></a></li>
                <li class="hidden960"><a href="<?php echo $langpref;?>/warranty.html" title="<?php echo $text_warranty; ?>"><?php echo $text_warranty; ?></a></li>
                <li class="hidden960"><a href="<?php echo $langpref;?>/about_us.html" title="<?php echo $text_about; ?>"><?php echo $text_about; ?></a></li>
                <li><a href="<?php echo $langpref;?>/articles/" title="title"><?php echo $text_articles; ?></a></li>
                 <?php $current_url=$_SERVER['REQUEST_URI'];
                 if ($lang=='uk'){
                     $current_url=str_replace('/ua/','/',$current_url); ?>
                    <li class="lang ru"><a href="<?php echo $current_url; ?>" title="RU">RU</a></li>
                    <li class="lang ua active"><span>UA</span></li>
                 <? } else {
                     $current_url='/ua'.$current_url; ?>
                    <li class="lang ru active"><span>RU</span></li>
                    <li class="lang ua"><a href="<?php echo $current_url; ?>" title="UA">UA</a></li>
                 <? } ?>
              </ul>
          </div>
        </div> -->
    </div>
</div>
  <div class="header">
    <div class="container">
    <div class="row">
      <div class="header__catalog">
        <div class="header__menu-icon">
          <?php echo file_get_contents(DIR_IMAGE.'/ico/menu.svg');?>
        </div>
        <div class="header__catalog-title">Каталог</div>
      </div>
      <div class="header__search"><?php echo $search; ?></div>
      <div class="callback">
        <a href="" class="btn-modal" data-modal="modal-callback" aria-label="Обратный звонок">
          <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/720-callback.svg');?></span>
        </a>
      </div>
      <div class="cart">
        <a href ="<?php echo $langpref;?>/cart/">
          <?php echo $cart; ?>
        </a>
      </div>
    </div>
</div>
  </div>
  


<? /* отключил не работало добавление товара в корзину <script>window.addEventListener('touchstart', e => e.preventDefault(),{passive:true });</script> */ ?>

<script>
<?php //echo file_get_contents(DIR_APPLICATION.'view/js/jquery-3.4.1.min.js'); ?>

</script>
<div class="container">
    <svg style="display:none;height:0;width:0;">
    <style>
        <?php echo file_get_contents(DIR_APPLICATION.'view/js/menu.css'); ?>
    </style>
    </svg>
    <div class="row">
    <div class="menu-slider">
      <div id="cssmenu">
        <?php echo $main_menu; ?>
        </div>
      <?php if ($route=='common/home'){ ?>
  <div class="swiper-container slider-home">
    <div class="promo-banner">
          <a href="<?=$langurl;?>/brands/" class="promo-banner__link"><?php echo file_get_contents(DIR_IMAGE.'/ico/banner-pidbir-1.svg');?></a>
      </div>
    <div class="swiper-wrapper">
      <?php foreach($data['banners'] as $banner){?>
      <div class="swiper-slide">
        <?php if($banner['link']){?>
          <a href="<?php echo $banner['link']; ?>">
            <img src="<?php echo $banner['image']; ?>" data-src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive swiper-lazy" />
          </a>
          <?php } else{ ?>
              <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
            <?php } ?>
        </div>
      <?php } ?>
    </div>
    <div class="swiper-pagination slider-home__pagination swiper-pagination"></div> 
  </div>      
      <?php } ?>
    </div>
    <?php if ($route=='common/home'){?>
    <div class="pre_container mainmenu">
        <div class="rowmenu line-menu">
          <div class="menu-paper line line-menu__block line-menu__block--blue">
            <?php echo file_get_contents(DIR_IMAGE.'/ico/07-page.svg');?>
            <a class="line-menu__link line-menu__blue" href="<?=$langurl?>/ne-na-chem-pechatat/"><?=$text_menu_bublik[0]?></a>
            <div class="dflex nohover">
              <div class="bg">
                <div class="bublik"><?=$text_menu_bublik[0]?></div>
                <div class="text"><a href="<?=$langurl?>/ne-na-chem-pechatat/"><?php echo $text_menu2[0]; ?></div>
              </div>
            </div>
          </div>
          <div class="menu-print line line-menu__block line-menu__block--grey">
            <?php echo file_get_contents(DIR_IMAGE.'/ico/08-cartridge.svg');?>
            <a class="line-menu__link" href="<?=$langurl?>/nechem-pechatat/"><?php echo $text_menu_bublik[1]; ?></a>
            <div class="dflex nohover">
              <div class="bg">
                <div class="bublik"><?=$text_menu_bublik[1]?></div>
                <div class="text"><a href="<?=$langurl?>/nechem-pechatat/"><?php echo $text_menu2[1]; ?></div>
              </div>
            </div>
          </div>
          <div class="menu-tech line line-menu__block line-menu__block--yellow">
            <?php echo file_get_contents(DIR_IMAGE.'/ico/09-printer.svg');?>
            <a class="line-menu__link line-menu__yellow" href="<?=$langurl?>/ne-hvataet-tehniki/"><?=$text_menu_bublik[2]?></a>
            <div class="dflex nohover">
              <div class="bg">
                <div class="bublik"><?=$text_menu_bublik[2]?></div>
                <div class="text"><a href="<?=$langurl?>/ne-hvataet-tehniki/"><?php echo $text_menu2[2]; ?></div>
              </div>
            </div>
          </div>
          <div class="menu-pens line line-menu__block line-menu__block--blue">
            <?php echo file_get_contents(DIR_IMAGE.'/ico/11-stationery.svg');?>
            <a class="line-menu__link line-menu__blue" href="<?=$langurl?>/nechem-pisat/"><?=$text_menu_bublik[3]?></a>
            <div class="dflex nohover">
              <div class="bg">
                <div class="bublik"><?=$text_menu_bublik[3]?></div>
                <div class="text"><a href="<?=$langurl?>/nechem-pisat/"><?php echo $text_menu2[3]; ?></div>
              </div>
            </div>
          </div>
          <div class="menu-himija line line-menu__block line-menu__block--grey">
            <?php echo file_get_contents(DIR_IMAGE.'/ico/10-cleaning.svg');?>
            <a class="line-menu__link" href="<?=$langurl?>/planiruete-uborku/"><?=$text_menu_bublik[4]?></a>
            <div class="dflex nohover">
              <div class="bg">
                <div class="bublik"><?=$text_menu_bublik[4]?></div>
                <div class="text"><a href="<?=$langurl?>/planiruete-uborku/"><?php echo $text_menu2[4]; ?></div>
              </div>
            </div>
          </div>
          <div class="menu-food line line-menu__block line-menu line-menu__block--yellow">
            <?php echo file_get_contents(DIR_IMAGE.'/ico/presentation-planning-icon.svg');?>
            <a class="line-menu__link line-menu__yellow" href="<?=$langurl?>/vse-dlya-prezentatsiy/"><?=$text_menu_bublik[5]?></a>
            <div class="dflex nohover">
              <div class="bg">
                <div class="bublik"><?=$text_menu_bublik[5]?></div>
                <div class="text"><a href="<?=$langurl?>/vse-dlya-prezentatsiy/"><?php echo $text_menu2[5]; ?></div>
              </div>
            </div>
          </div>
        </div>
  </div>
  <?php } ?>
  </div>
    </div>
</div>

<div class="container">
<div class="row">
<div id="notification"></div>
</div>
</div>

<script>
<?php echo file_get_contents(DIR_APPLICATION.'view/js/menu.js'); ?>
if(typeof jQuery.migrateMute === "undefined" ){jQuery.migrateMute = true;}
</script>

<?php foreach ($scripts as $script){?>
    <script <?=($script[1]=='async' ? 'async' :'')?> src="<?php echo $script[0]; ?>"></script>
<?php } ?>

<script>
$(document).ready(function(){
   resizeSubNav();
function resizeSubNav(){
  let subNav = $('.general-menu__sub-nav');
  let needWidth = $('.line-menu').width() + 24;
  subNav.each((index, nav) => {
    let categoryBlock = $(nav).find('.general-menu__category-block');
    if(categoryBlock.find('li').length === 0){
      $(nav).css({'column-count' : 1})      
    } else if(categoryBlock.length >= 4) {
      if(categoryBlock.length == 4) {
        $(nav).css({'column-count': 4, 'width': needWidth});
      } else if(categoryBlock.length == 5) {
        if($(window).width() > 1500) {
          $(nav).css({'column-count': 5, 'width': needWidth});
        } else {
          $(nav).css({'column-count': 4, 'width': needWidth});
        }
      } else {
        $(nav).css({'width': needWidth});
      }
    } else {
      $(nav).css({'column-count': categoryBlock.length});
    }
  });
};
  $('.mainli').hover(
    function(){
      $('.action_box').css({'opacity':0,'display':'none'});
      id = $(this).data('id');
      $('#action'+id).css({'opacity':1,'display':'flex'});
    }, function(){
  
    }
  );

  $('.general-menu__sub-nav').mouseenter(() => {
    $('.dark-layer').show();
  });
  $('.general-menu__sub-nav').mouseleave(() => {
    $('.dark-layer').hide();
  });

  $(".mainmenu a").hover(function(e){
      $(".mainmenu .dflex").addClass("nohover");
    },
    function(e){
      $(this).parent().next().removeClass('nohover');
  });

  $(".mainmenu .dflex").hover( function (e){
      },function (e){
          $(this).removeClass('nohover');
      }
    );

  $( window ).resize(function(){
    resize_memnu();
  });
  resize_memnu();
  var rowmenu_width =0;
  function resize_memnu(){
    rowmenu_width_tmp = rowmenu_width;
    var rowmenu_width = $('.rowmenu').width();
    if(rowmenu_width_tmp!=rowmenu_width){
      var menu_action = $('.menu-action').position();
      $('.rowmenu > div').each(function(){
        var menu_intem = $(this).position();
        if(rowmenu_width>960){
          var i =260 - menu_intem.left;
          var w =rowmenu_width;
        } else{
          var i =260 - menu_intem.left;
          var w =rowmenu_width;
        }
        $(this).find('.dflex').css('left', i + 'px');
        $(this).find('.dflex').css('width', w + 'px');
      });
    }
  }
});
</script>
<?php if ($route!='common/home'){ ?>

<style>
.breadcrumb{margin-bottom: 11px !important; margin-top: 8px !important;}
.breadcrumb li{display:inline-block;}
.breadcrumb span{font-size:12px;color:#999;font-family:'Trebuchet MS';}
.breadcrumb li:not(:last-child) span{text-decoration:underline;}
.breadcrumb li:not(:last-child):hover span{color:#fd9710;}
.breadcrumb li:first-child:before{display:none;}
.breadcrumb li:before{content:'/';margin:0px 1px 0 5px;display:inline-block;vertical-align:middle;font-size:14px;color:#999;line-height:1;}
</style>

<?php } ?>

<?php if ($route!='checkout/checkout'){ ?>
<?php /* async не ставить, aim грузился быстрее !!! */ ?>
<script src="/catalog/view/js/jquery-3.5.1.min.js"></script>
<?php } ?>