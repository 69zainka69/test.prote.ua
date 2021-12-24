<?php if ($route=='common/home' || $route=='product/product'){ ?>
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
  
  <svg style="display:none;height:0;width:0;">
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/modal.css');?>
<?php  echo file_get_contents(DIR_APPLICATION.'view/js/swiper/css/swiper.min.css'); ?>
</style>
</svg>
<?php } ?>

<?php if ($route=='common/home'){ ?>
<script>
$(document).ready(function(){var swiper = new Swiper('#slideshow0', {spaceBetween:30, centeredSlides: true, navigation: {nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev', }, pagination: {el: '.slideshow0', clickable: true, }, autoplay: {delay: 4000, disableOnInteraction: true, }, mode:'horizontal', slidesPerView:1, loop:true, lazy: {loadPrevNext: true, }, }); });
</script>
<?php } ?>

<svg style="display:none;height:0;width:0;">
<style>
@media (max-width: 640px){
.tooltip{
  left:0px !important;
}}
.catalog-recommendation__card:hover{
  margin-top: -10px;
     transition: 1s;
}
.footer{
  margin-top: 50px;
}
#prnprinter_chosen > a > span{
  text-transform: lowercase;
  line-height: 30px;
  width: 100%;
  font-size: 11.5px;
}
.active-result{
  text-transform: lowercase;
  line-height: 30px;
  width: 100%;
  font-size: 11.5px;
}
.box-heading .txt{
  font-size: 16px;
    font-weight: bold;
    color: #333;
    font-family: 'Trebuchet MS';
    cursor: pointer;
    position: relative;
}
#prnbrand option:hover{
 color: #fd9710;
}
body > div.swiper-container.reviews-home.swiper-container-initialized.swiper-container-horizontal{
height: 50%;
}
.cart:hover .header__amount{
  color: #00aff2;
  font-size: 14px;
}
.solutions__ico:hover svg{
  margin-top: -10px;
     transition: 1s;
}
.footer__soc a:hover svg{
  margin-top: -10px !important;
     transition: 1s;
}
.manufacturers__link:hover img{
    margin-top: -10px !important;
     transition: 1s;
}
.promo-banner__link:hover{
  border: 4px solid rgb(253 231 0);
  box-shadow: 2px 2px 20px rgb(0 0 0 / 30%), -5px -2px 1px rgb(255 255 255 / 50%);
}
.grecaptcha-badge{display:none;}
#jvlabelWrap{display:none;}
/*.globalClass_ET{display:none;}*/
#notification{width:100%;} #notification button{background:none;float:right;} .alert{padding: 8px 14px 8px 14px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;} .alert-success {color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;} .rowmenu > div .dflex{display:flex;flex-direction: row;} .rowmenu > div .dflex {font-size:15px;width: 100%;left: 0;position: absolute;top: 62px;opacity: 0;visibility: hidden;z-index:15;-webkit-transition: opacity 0.3s, margin-top 0.3s, visibility 0s linear 0.3s;-moz-transition: opacity 0.3s, margin-top 0.3s, visibility 0s linear 0.3s;-o-transition: opacity 0.3s, margin-top 0.3s, visibility 0s linear 0.3s;transition: opacity 0.3s, margin-top 0.3s, visibility 0s linear 0.3s;} .mainmenu .bg{width: 100%;padding:13px;display:flex;display:flex;justify-content:space-between;padding-right:20px;} .rowmenu > div:hover .dflex.nohover {margin-top:0;opacity: 1;visibility: visible;-webkit-transition-delay: 0s;-moz-transition-delay: 0s;-o-transition-delay: 0s;transition-delay: 0s;align-items:center;} .rowmenu > div:hover .dflex a {color:#fff;font-size:15px;} .rowmenu > div:hover .dflex a:hover{text-decoration:none;} .menu-action .bg{background:#fd9710;} .menu-gotr .bg,.menu-paper .bg,.menu-tech .bg,.menu-himija .bg{background:#3fc7f2;} .menu-print .bg,.menu-pens .bg,.menu-food .bg{background:#fecb88;} .mainmenu .dflex a{display:inline;padding:0} .mainmenu .dflex .bublik {font-size:25px;color:#fff;padding: 11px 13px 0 15px;min-height: 44px;position:relative;} .menu-action .dflex .bublik:before{background-color:#fd9710!important;} .menu-print .dflex .bublik:before,.menu-pens .dflex .bublik:before,.menu-food .dflex .bublik:before{background-color:#fecb88!important;} .mainmenu .dflex .text{width:550px;padding-right:20px;} html[lang="ru"] .mainmenu .dflex .text{width:563px;} .mainmenu .dflex .text a{text-decoration:underline;color:#000;} @media (max-width: 1300px) {.mainmenu .dflex .text{width:500px;} } @media (max-width:992px){#footer .logo{flex-basis:30%;} #footer .info{flex-basis:70%;} }</style>
</svg>
<div id="footer" class="footer">
  <div class="container">
     <div class="footer__columns">
        <div class="footer__hide-col">
           <div class="footer__col1">
              <div class="footer__logo logo">
                 <img src="/image/ico/logo-f-light.svg" title="prote.ua" alt="prote.ua" class="footer__logo-img" />
                 <span class="footer__copy">&copy; <?php echo date("Y");?></span>
              </div>
              <div class="footer__phones-block">
                 <span class="footer__phone-title"><?php echo $text_call ?>:</span>
                 <ul>
                    <li class="footer__number"><?=$telephone?></li>
                    <li class="footer__number">050 469 95 75</li>
                    <li class="footer__number">067 354 56 25</li>
                 </ul>
               
                 <div class="footer__worktime--mobile">
                    <?php echo $text_worktime; ?>
                 </div>
                
              </div>
           </div>
           <div class="footer__col2">
              <div class="footer__writeus">
                 <span class="footer__title"><?php echo $text_write?>:</span>
                 <span class="footer__description footer__description--blue">info@prote.ua</span>
              </div>
              <div class="footer__address">
                 <span class="footer__title"><?php echo $text_addresstitle; ?>:</span>
                 <span class="footer__description"><?php echo $text_time; ?></span>  
             
              </div>
           </div>
        </div>
        <div class="footer__col3">
           <div class="footer__menu">
              <div class="footer__paysoc-block footer__soc--top">
                 <div class="footer__soc">
                    <a target="_blank" href="https://www.facebook.com/people/Prote/100063606332432/"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/fb.svg');?></a>
                    <a target="_blank" href="viber://chat?number=%2B380504699575"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/viber.svg');?></a>
                    <a target="_blank" href="skype:live:.cid.fce31b86d68fb498?chat"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/skype.svg');?></a>
                    <a target="_blank" href="mailto:info@prote.ua"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/saw.svg');?></a>
                    <a onclick="jivo_api.open();return"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/ics.svg');?></a>
                 </div>
              </div>
              <div class="footer__help-block">
                 <div class="footer__menu-title">
                    <?php echo $text_help; ?>
                 </div>
                 <ul>
                    <li><a href="<?php echo $langurl; ?>/delivery.html" class="footer__link" title="<?php echo $text_delivery; ?>"><?php echo $text_delivery; ?></a></li>
                    <li><a href="<?php echo $langurl; ?>/payment.html" class="footer__link" title="<?php echo $text_pay; ?>"><?php echo $text_pay; ?></a></li>
                    <li><a href="<?php echo $langurl;?>/warranty.html" class="footer__link" title="<?php echo $text_warranty; ?>"><?php echo $text_warranty; ?></a></li>
                    <li><a href="<?php echo $langurl;?>/ex_return.html" class="footer__link" title="<?php echo $text_ex_return; ?>"><?php echo $text_return; ?></a></li>
                    <div class="footer__services-block--720">
                      <li><a href="<?php echo $langurl;?>/about_us.html" class="footer__link" title="<?php echo $text_about; ?>"><?php echo $text_about; ?></a></li>
                      <li><a href="<?php echo $langurl; ?>/public-oferta.html" class="footer__link" title="<?php echo $text_oferta; ?>"><?php echo $text_oferta; ?></a></li>
                      <!-- <li><a href="<?php echo $langurl; ?>/" class="footer__link"><?php echo $text_sitemap; ?></a></li> -->
                      <li><a href="<?php echo $langurl; ?>/articles/" class="footer__link"><?php echo $text_articles; ?></a></li>
                    </div>
                  </ul>
              </div>
              <div class="footer__services-block">
                 <div class="footer__menu-title">
                    <?php echo $text_services; ?>
                 </div>
                 <ul>
                    <li><a href="<?php echo $langurl; ?>/actions/" class="footer__link" title="<?php echo $text_actions; ?>"><?php echo $text_actions; ?></a></li>
                    <!--<li><a href="<?php echo $langurl; ?>/" class="footer__link" title="<?php echo $text_bonus; ?>"><?php echo $text_bonus; ?></a></li> -->
                    <li><a href="<?php echo $langurl; ?>/readycart/" class="footer__link" title="<?php echo $text_readybasket; ?>"><?php echo $text_readybasket; ?></a></li>
                    <li><a href="<?php echo $langurl; ?>/brands/" class="footer__link" title="<?php echo $text_material; ?>"><?php echo $text_material; ?></a></li>
                  </ul>
              </div>
              <div class="footer__info-block">
                 <div class="footer__menu-title">
                    <?php echo $text_info; ?>
                 </div>
                 <ul>
                    <li><a href="<?php echo $langurl;?>/about_us.html" class="footer__link" title="<?php echo $text_about; ?>"><?php echo $text_about; ?></a></li>
                    <li><a href="<?php echo $langurl; ?>/public-oferta.html" class="footer__link" title="<?php echo $text_oferta; ?>"><?php echo $text_oferta; ?></a></li>
                    <!-- <li><a href="<?php echo $langurl; ?>/" class="footer__link"><?php echo $text_sitemap; ?></a></li> -->
                    <li><a href="<?php echo $langurl; ?>/articles/" class="footer__link"><?php echo $text_articles; ?></a></li>
                 </ul>
              </div>
           </div>
           <div class="footer__paysoc-block">
              <div class="footer__payment">
                 <?php echo file_get_contents(DIR_IMAGE.'/ico/payment/mastercard.svg');?>
                 <?php echo file_get_contents(DIR_IMAGE.'/ico/payment/verifiedbyvisa.svg');?>
              </div>
              <div class="footer__soc">
                 <a target="_blank" href="https://www.facebook.com/people/Prote/100063606332432/"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/fb.svg');?></a>
                 <a target="_blank" href="viber://chat?number=%2B380504699575"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/viber.svg');?></a>
                 <a target="_blank" href="skype:live:.cid.fce31b86d68fb498?chat"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/skype.svg');?></a>
                 <a target="_blank" href="mailto:info@prote.ua"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/saw.svg');?></a>
                 <a onclick="jivo_api.open();return"><?php echo file_get_contents(DIR_IMAGE.'/ico/soc/ics.svg');?></a>
              </div>
           </div>
        </div>
     </div>
     <div class="footer__copy-bottom"><?php echo $text_copyname; ?> &copy; <?php echo date("Y");?></div>
  </div>
</div>
<div id="button-up"><?php echo file_get_contents(DIR_ROOT.'/catalog/view/theme/default/image/icons/arrow-up.svg');?></div>
<script>
  $(document).ready(function() { 
    var button = $('#button-up');	
    $(window).scroll (function () {
      if ($(this).scrollTop () > 300) {
        button.fadeIn();
      } else {
        button.fadeOut();
      }
  });	 
  button.on('click', function(){
  $('body, html').animate({
  scrollTop: 0
  }, 800);
  return false;
  });		 
  });
  </script>	
    
      </div>
    </div>
<div id="load_cart"><?php echo $popupcart;?></div>

<?php if ($route=='checkout/cart'){ ?>
<script>
$(document).ready(function() {
gtag('event', 'conversion',{'send_to':'G-Q9895JH48V/dFchCJfLy4UBEJiajscD','transaction_id':''});
});
</script>
<?php } ?>
<script>
$(document).ready(function() {
  $('#cart').on('click',function(){
    url = $('base').attr('href')+'<?php echo str_replace('/','',$langurl);?>/cart/';
    location = url;
  });
  $("#search-btn1").click(function(e){
    if ($(window).width() <= 992) {
      if($('#searchp-input').hasClass('open')){
          window.location='/search/?search=' + $("#searchp-input").val();
      }else{
          var elem = $("#searchp-input");
          $('#searchp-input').toggleClass('open');
          return false;
      }
    }else{
      window.location='/search/?search=' + $("#searchp-input").val();
    }
  });
  $(document).mouseup(function (e){
    var div = $("#searchp");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
        $('#searchp-input').removeClass('open');
    }
    var div = $("#cssmenu");
    if (!div.is(e.target) && div.has(e.target).length === 0&&$("#menu-button").hasClass('menu-opened')) { // и не по его дочерним элементам
        $("#menu-button").click();
    }
  });
  $("#searchp-input").keypress(function(e){
       if (e.keyCode==13) {
            var langcode = window.location.pathname.substr(1,2) == 'ua' ? '/ua' : '';
            window.location = langcode + '/search/?search=' + $("#searchp-input").val();
       }
  });
  $(document).click(function(event) {
    if ($(event.target).closest("#searchp-input,.result-search-autocomplete").length) return;
    $(".result-search-autocomplete").hide("slow");
    //$('#popupcart_extended_background').css({visibility:"hidden",opacity: 0,background: "none"});
    event.stopPropagation();
  });
});
function debounce(func, wait = 100) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            func.apply(this, args);
        }, wait);
    };
}
$(document).ready(function() {
    var searchCache = {};
    var searchRequestsCount = 0;
    var finalRequestId = null;
    var debounceDelay = 300;
    var $searchInput = $('#searchp-input');
    var $searchResult = $('#show-result');
    var $searchResultContainer = $('#result-search-autocomplete');
    function applySearchResult(resultHtml) {
        if (resultHtml) {
            $searchResult.html(resultHtml);
            $searchResultContainer.css({"display":"block"});
        } else {
            $searchResult.html('');
        }
    }
    $searchInput.on('input', debounce(function() {
        applySearchResult(null);
        searchRequestsCount++;
        var currentRequestId = searchRequestsCount;
        finalRequestId = currentRequestId;
        var search = $searchInput.val();
        if (search.length < 2) {
            return
        }
        if (search in searchCache) {
            applySearchResult(searchCache[ search ]);
            return;
        }
        $.ajax({
            method: "GET",
            url: "<?php echo $search_action; ?>",
            data: { search : search, langid: <?php echo $lang_id;?> },
            dataType:'json',
            success: function(result) {
                searchCache[ search ] = result['html'];
                if (currentRequestId === finalRequestId) {
                    applySearchResult(result['html']);
                }
            },
        });
    }, debounceDelay));
});
/*! Lazy Load 1.9.3 - MIT license - Copyright 2010-2013 Mika Tuupola */
!function(a,b,c,d){var e=a(b);a.fn.lazyload=function(f){function g(){var b=0;i.each(function(){var c=a(this);if(!j.skip_invisible||c.is(":visible"))if(a.abovethetop(this,j)||a.leftofbegin(this,j));else if(a.belowthefold(this,j)||a.rightoffold(this,j)){if(++b>j.failure_limit)return!1}else c.trigger("appear"),b=0})}var h,i=this,j={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!0,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return f&&(d!==f.failurelimit&&(f.failure_limit=f.failurelimit,delete f.failurelimit),d!==f.effectspeed&&(f.effect_speed=f.effectspeed,delete f.effectspeed),a.extend(j,f)),h=j.container===d||j.container===b?e:a(j.container),0===j.event.indexOf("scroll")&&h.bind(j.event,function(){return g()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,(c.attr("src")===d||c.attr("src")===!1)&&c.is("img")&&c.attr("src",j.placeholder),c.one("appear",function(){if(!this.loaded){if(j.appear){var d=i.length;j.appear.call(b,d,j)}a("<img />").bind("load",function(){var d=c.attr("data-"+j.data_attribute);c.hide(),c.is("img")?c.attr("src",d):c.css("background-image","url('"+d+"')"),c[j.effect](j.effect_speed),b.loaded=!0;var e=a.grep(i,function(a){return!a.loaded});if(i=a(e),j.load){var f=i.length;j.load.call(b,f,j)}}).attr("src",c.attr("data-"+j.data_attribute))}}),0!==j.event.indexOf("scroll")&&c.bind(j.event,function(){b.loaded||c.trigger("appear")})}),e.bind("resize",function(){g()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&e.bind("pageshow",function(b){b.originalEvent&&b.originalEvent.persisted&&i.each(function(){a(this).trigger("appear")})}),a(c).ready(function(){g()}),this},a.belowthefold=function(c,f){var g;return g=f.container===d||f.container===b?(b.innerHeight?b.innerHeight:e.height())+e.scrollTop():a(f.container).offset().top+a(f.container).height(),g<=a(c).offset().top-f.threshold},a.rightoffold=function(c,f){var g;return g=f.container===d||f.container===b?e.width()+e.scrollLeft():a(f.container).offset().left+a(f.container).width(),g<=a(c).offset().left-f.threshold},a.abovethetop=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollTop():a(f.container).offset().top,g>=a(c).offset().top+f.threshold+a(c).height()},a.leftofbegin=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollLeft():a(f.container).offset().left,g>=a(c).offset().left+f.threshold+a(c).width()},a.inviewport=function(b,c){return!(a.rightoffold(b,c)||a.leftofbegin(b,c)||a.belowthefold(b,c)||a.abovethetop(b,c))},a.extend(a.expr[":"],{"below-the-fold":function(b){return a.belowthefold(b,{threshold:0})},"above-the-top":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-screen":function(b){return a.rightoffold(b,{threshold:0})},"left-of-screen":function(b){return!a.rightoffold(b,{threshold:0})},"in-viewport":function(b){return a.inviewport(b,{threshold:0})},"above-the-fold":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-fold":function(b){return a.rightoffold(b,{threshold:0})},"left-of-fold":function(b){return!a.rightoffold(b,{threshold:0})}})}(jQuery,window,document);
$("img[data-original]").lazyload({threshold : 500, skip_invisible:false, effect : "fadeIn"});$(window).scrollTop($(window).scrollTop()+1);$(window).scrollTop($(window).scrollTop()-1);
function loaded(){
  $("#cssmenu ul").menuAim({
    activate: function(row){
        $(row).find('.subnav:first').show();
        $(row).find('.subnav:first').addClass('hoverr');
    },
    deactivate: function(row){
        $(row).find('.subnav:first').hide();
        $(row).find('.subnav:first').removeClass('hoverr');
    }
  });
$('input[type="tel"]').mask("+38(999) 999-99-99",{autoclear: false});
$('input[type="tel"]').caret(0);
}
</script>
<!--  end search  -->
<script async src="catalog/view/js/js.js?v9" onload="loaded();"></script>
<?php /*
<!-- <script sync src="catalog/view/js/current-device.min.js"></script> -->
<!-- <script async src="catalog/view/js/jquery.menu-aim.js" onload=""></script> -->
<!-- <script src="catalog/view/js/jquery.maskedinput.min.js"></script> -->
<!-- <script async src="catalog/view/js/chosen/chosen.jquery.min.js"></script> -->
<!-- <script async src="catalog/view/js/popupcart.js?1"></script> -->
<!-- <script defer src="catalog/view/javascript/common.js"></script> -->
<!-- <script async src="catalog/view/js/callback.js"></script> -->
*/ ?>
  <?php foreach ($scripts as $script) {  ?>
  	<?php if ($route=='checkout/checkout'){ ?>
     <script src="<?php echo $script[0]; ?>"></script>
     <?php } else { ?>
     <script async src="<?php echo $script[0]; ?>"></script>
  	<?php } ?>
  <?php } ?>
<script>
var simple_tooltip_counter = 1;
function simple_tooltip(target_items, name){
    $(target_items).each(function() {
        if ($(this).attr('data-tooltip')) {
            $("body").append("<div class='"+name+"' id='"+name+simple_tooltip_counter+"'><p>"+$(this).attr('data-tooltip')+"</p></div>");
            var my_tooltip = $("#"+name+simple_tooltip_counter);
            $(this).removeAttr('title').removeAttr("data-tooltip");
            $(this).mouseover(function(e) {
                my_tooltip.css({opacity:1, display:"none"}).fadeIn(400);
                ht = my_tooltip.outerHeight();
            }).mousemove(function(kmouse){
                my_tooltip.css({left:kmouse.pageX+30, top:kmouse.pageY-ht+10});
            }).mouseout(function(){
                my_tooltip.fadeOut(400);
            });
            simple_tooltip_counter++;
        }
    });
}
$(document).ready(function() {
  $("head").append("<link rel='stylesheet' type='text/css' href='/catalog/view/js/chosen/chosen.min.css' />");
});
</script>
<?php include(DIR_APPLICATION.'view/js/modal/modal.tpl');?>
<?php echo $city_modal; ?>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ document.jivositeloaded=0;var widget_id = 'kSSFHO2GeB';var d=document;var w=window;function l(){var s = d.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}//эта строка обычная для кода JivoSite
function zy(){
    //удаляем EventListeners
    if(w.detachEvent){//поддержка IE8
        w.detachEvent('onscroll',zy);
        w.detachEvent('onmousemove',zy);
        w.detachEvent('ontouchmove',zy);
        w.detachEvent('onresize',zy);
    }else {
        w.removeEventListener("scroll", zy, false);
        w.removeEventListener("mousemove", zy, false);
        w.removeEventListener("touchmove", zy, false);
        w.removeEventListener("resize", zy, false);
    }
    //запускаем функцию загрузки JivoSite
    if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}
    //Устанавливаем куку по которой отличаем первый и второй хит
    var cookie_date = new Date ( );
    cookie_date.setTime ( cookie_date.getTime()+60*60*28*1000); //24 часа для Москвы
    d.cookie = "JivoSiteLoaded=1;path=/;expires=" + cookie_date.toGMTString();
}
if (d.cookie.search ( 'JivoSiteLoaded' )<0){//проверяем, первый ли это визит на наш сайт, если да, то назначаем EventListeners на события прокрутки, изменения размера окна браузера и скроллинга на ПК и мобильных устройствах, для отложенной загрузке JivoSite.
    if(w.attachEvent){// поддержка IE8
        w.attachEvent('onscroll',zy);
        w.attachEvent('onmousemove',zy);
        w.attachEvent('ontouchmove',zy);
        w.attachEvent('onresize',zy);
    }else {
        w.addEventListener("scroll", zy, {capture: false, passive: true});
        w.addEventListener("mousemove", zy, {capture: false, passive: true});
        w.addEventListener("touchmove", zy, {capture: false, passive: true});
        w.addEventListener("resize", zy, {capture: false, passive: true});
    }
}else {zy();}
})();</script>

<?php if($route=='checkout/checkout' || $route=='checkout/success'){ ?>
<?php }else{ ?>
<script>
catname='none';
position='none';
obj_cat = $('#lastbreadcrumb');
if(obj_cat.length){catname = obj_cat.html();}
function addcart_gtag(product_id,position,quantity){
    get_gtag('add_to_cart',product_id,position,quantity);
}
function removecart_gtag(product_id,position,quantity){
    get_gtag('remove_from_cart',product_id,position,quantity);
}
$('.product-layout').on('click', 'a',function(event){
    if($(this).hasClass('tobasket') || $(this).hasClass('oneclick')) return true;
    prodid = $(event.delegateTarget).data('prodid');
    position = $(event.delegateTarget).data('position');
    get_gtag('select_content',prodid,position);
});

</script>
<?php } ?>
<?php if ($route=='checkout/cart') { ?>
<script>
$(document).ready(function() {
gtag('event', 'conversion', {
    'send_to': 'AW-954436888',
    'transaction_id': ''
});
});
</script>
<?php } ?>
<script>
<?php
if(!isset($products_cart_ids))$products_cart_ids=false;
if(!isset($products_cart_total))$products_cart_total=false;
if ($products_ids){ ?>
var products_ids = [<?php echo $products_ids; ?>];
<?php } else { ?>
var products_ids = false;
<?php } ?>
<?php if ($products_cart_ids){ ?>
var products_cart_ids = [<?php echo $products_cart_ids; ?>];
<?php } else { ?>
var products_cart_ids = false;
<?php } ?>
<?php if ($products_cart_total){ ?>
var products_cart_total = "<?php echo $products_cart_total; ?>";
<?php } else { ?>
var products_cart_total = false;
<?php } ?>
$(document).ready(function() {
gtag('event','page_view', {
'send_to':'AW-954436888',
<?php if ($route=='common/home') { ?>
'ecomm_pagetype' : 'home'
<?php } elseif ($products_ids && $route=='product/category') {  ?>
'ecomm_prodid':products_ids,
'ecomm_pagetype':'category'
<?php } elseif ($products_ids && $route=='product/search') { ?>
'ecomm_prodid':products_ids,
'ecomm_pagetype':'searchresults'
<?php } elseif ($products_ids && $route=='product/product') { ?>
'ecomm_prodid': products_ids,
'ecomm_pagetype':'product',
'ecomm_totalvalue': $('#price_int').val()
<?php } elseif ($products_cart_ids && $products_cart_total && ($route=='checkout/cart' || $route=='checkout/checkout')) { ?>
'ecomm_prodid': products_cart_ids,
'ecomm_pagetype':'cart',
'ecomm_totalvalue':products_cart_total
<?php } elseif ($route=='checkout/success') { ?>
'ecomm_prodid' : products_cart_ids,
'ecomm_pagetype': 'purchase',
'ecomm_totalvalue' : products_cart_total
<?php } else { ?>
'ecomm_pagetype': 'other'
<?php } ?>
});
});
</script>
<?php //echo $blackfriday; ?>
 <script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
<?php require_once(DIR_APPLICATION.'view/js/widget/widget.tpl'); ?>
<?php echo $captcha; ?>
<script async src="catalog/view/js/top-header.js"></script>

<script>document.addEventListener("DOMContentLoaded", function() {
  var lazyloadImages = document.querySelectorAll("img.lazy");    
  var lazyloadThrottleTimeout;
  
  function lazyload () {
    if(lazyloadThrottleTimeout) {
      clearTimeout(lazyloadThrottleTimeout);
    }    
    
    lazyloadThrottleTimeout = setTimeout(function() {
        var scrollTop = window.pageYOffset;
        lazyloadImages.forEach(function(img) {
            if(img.offsetTop < (window.innerHeight + scrollTop)) {
              img.src = img.dataset.src;
              img.classList.remove('lazy');
            }
        });
        if(lazyloadImages.length == 0) { 
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }
    }, 20);
  }
  document.addEventListener("scroll", lazyload);
  window.addEventListener("resize", lazyload);
  window.addEventListener("orientationChange", lazyload);
});</script>
</body>
</html>