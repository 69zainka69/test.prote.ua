<style>
#jvlabelWrap,.wrap_mW,.button_72f,.button_00f{display:none!important;}
jdiv .overlay_b26{display:none!important;}
.flex-row {display: flex; flex-direction: row; } #g-widget {-webkit-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none } #g-widget .g-message-button {width:70px; position:absolute; height:70px; background-color:#f6731c; border-radius:50px; box-sizing:border-box; display:flex; align-items:center; justify-content:center; cursor:pointer } #g-widget .g-message-button .static {position:absolute; -webkit-animation:show-stat 6s infinite; animation:show-stat 6s infinite; display:flex; flex-direction:column; justify-content:center; align-items:center } #g-widget .g-message-button .static img {display:inline } #g-widget .g-message-button p {text-align:center;padding:0;color:#fff; font-weight:700; font-size:10px; line-height:11px; margin:0 } #g-widget .g-message-button .pulsation {width:84px; height:84px; background-color:#f6731c; border-radius:50px; position:absolute; left:-7px; top:-7px; z-index:-1; transform:scale(0); -webkit-animation:pulse 2s infinite; animation:pulse 2s infinite } #g-widget .g-message-button .pulsation:nth-of-type(2n) {-webkit-animation-delay:.5s; animation-delay:.5s } #g-widget .g-message-button .pulsation.stop {-webkit-animation:none; animation:none } 
#g-widget.g-message {z-index:15151; right:150px; 
bottom: 142px;
position:fixed!important } #g-widget .callback-state, #g-widget .close, #g-widget .icons, #g-widget .static {-webkit-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none } #g-widget .callback-state, #g-widget .g-message-button .icons {background-color:#fff; width:44px; height:44px; border-radius:50px; position:absolute; overflow:hidden; -webkit-animation:show-icons 6s infinite; animation:show-icons 6s infinite } #g-widget .icons-line {top:10px; left:12px; height:24px; display:flex; position:absolute; -webkit-animation:icon-change 6s infinite; animation:icon-change 6s infinite; transition:cubic-bezier(.13,1.49,.14,-.4); -webkit-animation-delay:0s; animation-delay:0s; transform:translateX(30px) } #g-widget .icons-line.stop {-webkit-animation-play-state:paused; animation-play-state:paused } #g-widget .icons-line img {margin-right:50px; -webkit-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none } #g-widget .icons.hide, #g-widget .static.hide {display:none } @-webkit-keyframes pulse {0% {transform:scale(0); opacity:1 } 50% {opacity:.5 } to {transform:scale(1); opacity:0 } } @keyframes pulse {0% {transform:scale(0); opacity:1 } 50% {opacity:.5 } to {transform:scale(1); opacity:0 } } @-webkit-keyframes show-stat {0%, 20% {transform:scale(1) } 21%, 84% {transform:scale(0) } 85%, to {transform:scale(1) } } @keyframes show-stat {0%, 20% {transform:scale(1) } 21%, 84% {transform:scale(0) } 85%, to {transform:scale(1) } } @-webkit-keyframes show-icons {0%, 20% {transform:scale(0) } 21%, 84% {transform:scale(1) } 85%, to {transform:scale(0) } } @keyframes show-icons {0%, 20% {transform:scale(0) } 21%, 84% {transform:scale(1) } 85%, to {transform:scale(0) } } @-webkit-keyframes icon-change {0%, 5% {transform:translateX(30px) } 10%, 25% {transform:translateX(0) } 30%, 35% {transform:translateX(-70px) } 40%, 45% {transform:translateX(-145px) } 50%, 55% {transform:translateX(-216px) } 60%, 65% {transform:translateX(-287px) } 70%, 75% {transform:translateX(-360px) } 80%, 85% {transform:translateX(-433px) } 90%, to {transform:translateX(-480px) } } @keyframes icon-change {0%, 5% {transform:translateX(30px) } 10%, 25% {transform:translateX(0) } 30%, 35% {transform:translateX(-70px) } 40%, 45% {transform:translateX(-145px) } 50%, 55% {transform:translateX(-216px) } 60%, 65% {transform:translateX(-287px) } 70%, 75% {transform:translateX(-360px) } 80%, 85% {transform:translateX(-433px) } 90%, to {transform:translateX(-480px) } } #g-widget .icons .icon:first-of-type {margin-left:0 } #g-widget .close img {transform:rotate(180deg) scale(0); transition:all .12s ease-in } #g-widget .close.show-messageners-block {position:absolute; top:34%; left:42% } #g-widget .close.show-messageners-block img {transform:rotate(0) scale(1) } #g-widget .messangers-block {
width:235px; /*height:430px;*/ 
/*background:url(image/widget/bg_s.svg) no-repeat 50%; */
position:absolute; bottom:0; left:-150px; display:flex; flex-direction:column; align-items:flex-start; box-sizing:border-box; border-radius:7px; transform-origin:80% 105%; transform:scale(0); transition:all .12s ease-out; z-index:9 background } #g-widget .messangers-block.show-messageners-block {transform:scale(1) } #g-widget .messanger {align-items:center; margin:8px 0; cursor:pointer; text-decoration:none } #g-widget .messanger:before {content:""; display:block; width:40px; height:40px; border-radius:50px; margin-right:10px; background:#0084ff no-repeat 50% } #g-widget .messanger p {margin:0; font-size:14px; color:rgba(0,0,0,.87) } #g-widget .messanger.fb:before {background-image:url(image/widget/fb_w.svg) } #g-widget .messanger.viber:before {background:#7c529d url(image/widget/viber_w.svg) no-repeat 50% } #g-widget .messanger.telegram:before {background:#2ca5e0 url(image/widget/telegram_w.svg) no-repeat 43% } #g-widget .messanger.skype:before {background:#31c4ed url(image/widget/skype_w.svg) no-repeat 45% 45% } #g-widget .messanger.support:before {background:#ff8400 url(image/widget/supp_w.svg) no-repeat 50% } #g-widget .messanger.tech-support:before {background:#7eb105 url(image/widget/tech_w.svg) no-repeat 50%; flex-shrink:0 } #g-widget .messanger.call-back:before {background:#54cd81 url(image/widget/cback_w.svg) no-repeat 50% } #g-widget .callback-countdown-block {width:410px; height:150px; background-repeat:no-repeat; background-position:50%; position:absolute; bottom:-12px; left:-320px; flex-direction:column; align-items:center; box-sizing:border-box; border-radius:7px; transform-origin:80% 105%; transform:scale(1); transition:all .12s ease-out; z-index:9; color:#fff; padding-top:5px; padding-left:8px; padding-right:19px; display:none } #g-widget .callback-state {display:none; -webkit-animation:none; animation:none } #g-widget .callback-state .callback-state-img {position:absolute; top:12px; left:12px } #g-widget .callback-countdown-block .callback-countdown-block-phone {font-family:Roboto,sans-serif; font-size:14px; line-height:16px; flex-direction:column; justify-content:center; align-items:center; height:115px; display:none } #g-widget .callback-countdown-block .callback-countdown-block-phone p {text-align:center; margin-bottom:10px; margin-top:3px; color:#fff } #g-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group {display:flex; align-items:center } #g-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group input[type=tel] {font-size:14px; line-height:16px; border-radius:4px; border:none; width:203px; height:36px; box-sizing:border-box; padding:10px 11px 9px } #g-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group input[type=submit] {border-radius:4px; border:none; background-color:#f6731c; color:#fff; font-size:14px; cursor:pointer; width:132px; height:36px } #g-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group input[type=submit]:hover {background-color:#fd893c } #g-widget .callback-countdown-block .callback-countdown-block-timer {flex-direction:column; justify-content:center; align-items:center; height:115px; display:none } #g-widget .callback-countdown-block .callback-countdown-block-timer p {font-size:14px; line-height:16px; text-align:center; margin-bottom:5px; margin-top:7px; color:#fff } #g-widget .callback-countdown-block .callback-countdown-block-timer_timer {font-size:40px; line-height:46px; text-align:center; color:#fff; font-weight:300; margin:0 } #g-widget .callback-countdown-block .callback-countdown-block-sorry {height:110px; align-items:center; display:none } #g-widget .callback-countdown-block .callback-countdown-block-sorry p {font-size:16px; line-height:18px; text-align:center; margin-bottom:5px; margin-top:7px; color:#fff } #g-widget .callback-countdown-block .callback-countdown-block-close {position:absolute; top:-10px; right:6px; cursor:pointer } #g-widget .animation-pause {-webkit-animation-play-state:paused; animation-play-state:paused } #g-widget input {margin:5px } #g-widget .callback-countdown-block .callback-countdown-block-phone.display-flex, #g-widget .callback-countdown-block .callback-countdown-block-sorry.display-flex, #g-widget .callback-countdown-block .callback-countdown-block-timer.display-flex, #g-widget .callback-countdown-block.display-flex, #g-widget .callback-state.display-flex {display:flex } /*@media only screen and (max-width:1023px) {#g-widget {display:none } }*/ 
.g-countdown_bg,.g-messangers_bg{
  position: absolute;
  height: 100%;
  width: 100%;
}
.g-countdown_bg{
z-index: -1;
}
.callback-body{padding:10px 0 36px;}
.g-buttons{padding:14px 30px 25px;position: relative;}
@media only screen and (max-width:500px) {
#g-widget .callback-countdown-block{
  width: 300px;
  height: auto;
  left: -154px;
      background-size: cover;
} 
#g-widget .callback-countdown-block .callback-countdown-block-phone{
  height: auto;
}
#g-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group{
  flex-direction:column;
}
}

</style>

 <div id="g-widget" class="g-message">
  <div class="callback-countdown-block">
    <img src="image/widget/call_back_background_n.svg" class="g-countdown_bg">
    <div class="callback-countdown-block-close"><img src="image/widget/cb_close.svg" alt="Закрыть"></div> 
    <div class="callback-body">
      <div class="callback-countdown-block-phone">
        <p><?php echo $widget_block_phone; ?></p> 
        <form action="" id="g-widget-form"><div class="callback-countdown-block-form-group">
          <input type="hidden" value="Жду звонка - 30 секунд!!!" name="title" >
          <input type="hidden" value="tel" name="validate" >
          <input type="hidden" name="g-recaptcha-response" >
          <input type="tel" id="g-widget-form-tel" placeholder="+38(___)___-__-__" required="required" data-mask="+38(###)###-##-##" data-previous-value="" value="" name="tel"> <input type="submit" id="g-message-callback-phone-submit" value="<?php echo $widget_button; ?>"></div>
        </form>
      </div> 
      <div class="callback-countdown-block-timer"><p><span><?php echo $widget_block_timer; ?></span> <br><span></span></p> <p class="callback-countdown-block-timer_timer"></p></div> 
      <div class="callback-countdown-block-sorry"><p><?php echo $widget_block_sorry; ?></p></div>
      <div class="callback-block-error"></div>
    </div>
  </div> 
  <div class="messangers-block">
    <img src="image/widget/bg_s_n.svg" class="g-messangers_bg" alt="messangers" title="messangers">
    <div class="g-buttons">
      <a target="_blank" rel="noopener noreferrer nofollow" href="https://www.facebook.com/Prote-289486441413364/" class="messanger flex-row fb"><p>Facebook</p></a> 
      <a target="_blank" rel="nofollow" href="viber://chat?number=%2B380504699575" class="messanger flex-row viber"><p>Viber</p></a> 
      <a target="_blank" rel="nofollow" href="skype:live:.cid.fce31b86d68fb498?chat" class="messanger flex-row skype"><p>Skype</p></a> 
      <a target="_blank" rel="nofollow" href="mailto:info@prote.ua" class="messanger flex-row support"><p>info@prote.ua</p></a> 
      <a class="messanger flex-row call-back"><p><?php echo $widget_callback; ?></p></a>
      <?php /* <a target="_blank" rel="nofollow" href="https://m.me/g.ua" class="messanger flex-row fb"><p>Messenger</p></a> 
      <a target="_blank" rel="nofollow" href="https://t.me/g_ua_bot" class="messanger flex-row telegram"><p>Telegram</p></a> 
      <a target="_blank" rel="nofollow" href="skype:Prote.UA?chat" class="messanger flex-row skype"><p>Skype</p></a> 
      <a target="_blank" rel="nofollow" href="skype:live:.cid.fce31b86d68fb498?chat" class="messanger flex-row skype"><p>Skype</p></a> 
      <a target="_blank" rel="nofollow" href="/support/tickets" class="messanger flex-row tech-support"><p>Написать в службу поддержки</p></a> */ ?>
    </div>
  </div> 
    
    <div class="g-message-button">
        <div class="static"><img alt="<?php echo strip_tags($widget_msg); ?>Связаться с Проте" data-src="image/widget/msg.svg" src="image/widget/msg.svg" lazy="loaded"> 
          <p><?php echo $widget_msg; ?></p></div>
        <div class="callback-state">
          <img alt="Обратный звонок" data-src="image/widget/cback.svg" class="callback-state-img" src="image/widget/cback.svg" lazy="loaded">
        </div> 
        <div class="icons">
          <div class="icons-line">
            <img alt="Callback" data-src="image/widget/cback.svg" draggable="false" src="image/widget/cback.svg" lazy="loaded"> 
            <img alt="Viber" data-src="image/widget/viber.svg" draggable="false" src="image/widget/viber.svg" lazy="loaded">
            <img alt="Telephone" data-src="image/widget/tel.svg" draggable="false" src="image/widget/tel.svg" lazy="loaded"> 
            <img alt="Skype" data-src="image/widget/skype.svg" draggable="false" src="image/widget/skype.svg" lazy="loaded">
            <img alt="Support" data-src="image/widget/supp.svg" draggable="false" src="image/widget/supp.svg" lazy="loaded"> 
            <img alt="Tech Support" data-src="image/widget/tech.svg" draggable="false" src="image/widget/tech.svg" lazy="loaded"> 
            <img alt="Facebook" data-src="image/widget/fb.svg" draggable="false" src="image/widget/fb.svg" lazy="loaded">
          </div>
        </div>
        <div class="close"><img src="image/widget/close.svg" alt="Close"></div> 
        <div class="pulsation"></div> 
        <div class="pulsation"></div>
    </div>
 </div>
<script>
  
  function jivo_onLoadCallback(){$('.g-buttons').append('<a class="messanger flex-row tech-support" onclick="jivo_api.open();return"><p>Чат</p></a>');} 

  $('#g-widget-form').on('submit',function(){var lang=''; language = jQuery('html').attr('lang'); if(language=='uk'){lang='&lang=ua';} $.ajax({url: 'index.php?route=information/callback'+lang, type: 'post', data: $('#g-widget-form').serialize(), dataType: 'json', success: function(json) {
    error_text='';
    if(json['error']){
      if(json['error']['tel']){error_text = json['error']['tel'];}
      if(json['error']['captcha']){error_text = json['error']['captcha'];}
    }
    
    if(error_text){
      text = $('.callback-countdown-block-phone p').html(); 
      $('.callback-countdown-block-phone p').html('<span style="color:#f6731c;">'+error_text+'</span>'); 
      setTimeout(function(){$('.callback-countdown-block-phone p').html(text); }, 3000); 
    } else {
      document.querySelector(".callback-countdown-block-phone").classList.remove("display-flex"); document.querySelector(".callback-countdown-block-timer").classList.add("display-flex"); startCounter(); } }, error: function(xhr, ajaxOptions, thrownError) {console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText); } }); return false; }); document.querySelector(".g-message-button").addEventListener("click", function() {if(document.querySelector(".messangers-block").classList.contains("show-messageners-block")){wClose(); } else {wOpen(); } }); document.querySelector(".messanger.call-back").addEventListener("click",function() {messangerOpen(); wClose(); }); document.querySelector(".callback-countdown-block-close").addEventListener("click", function() {messangerClose(); }); function wOpen(){document.querySelector("#g-widget .messangers-block").classList.add("show-messageners-block"); document.querySelector("#g-widget .close").classList.add("show-messageners-block"); document.querySelector("#g-widget .icons").classList.add("hide"); document.querySelector("#g-widget .pulsation").classList.add("stop"); document.querySelector("#g-widget .static").classList.add("hide"); } function wClose(){document.querySelector("#g-widget .messangers-block").classList.remove("show-messageners-block"); document.querySelector("#g-widget .close").classList.remove("show-messageners-block"); document.querySelector("#g-widget .icons").classList.remove("hide"); document.querySelector("#g-widget .pulsation").classList.remove("stop"); document.querySelector("#g-widget .static").classList.remove("hide"); } function messangerOpen(){document.querySelector(".callback-countdown-block").classList.add("display-flex"); document.querySelector(".callback-countdown-block-phone").classList.add("display-flex"); } function messangerClose(){document.querySelector(".callback-countdown-block").classList.remove("display-flex"); document.querySelector(".callback-countdown-block-phone").classList.remove("display-flex"); } function startCounter(){var millis = 1800000; function displaytimer(){var hours = Math.floor(millis / 36e5), mins = Math.floor((millis % 36e5) / 6e4), secs = Math.floor((millis % 6e4) / 1000); if(secs<10)secs='0'+secs; document.querySelector('.callback-countdown-block-timer_timer').textContent=mins+':'+secs; } refreshIntervalId = setInterval(function(){millis -= 600; if(millis>0){displaytimer(); } else {clearInterval(refreshIntervalId); hideTimer(); } }, 10); } function hideTimer(){document.querySelector(".callback-countdown-block-timer").classList.remove("display-flex"); document.querySelector(".callback-countdown-block-sorry").classList.add("display-flex"); }
</script>