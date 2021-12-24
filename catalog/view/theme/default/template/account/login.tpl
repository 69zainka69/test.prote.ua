<?php if(!$ajax){ ?>
<?php echo $header; ?>
<style>.breadcrumb{margin-bottom:20px;}
h1{color:#00adee;font-size:18px;font-weight:normal;margin-bottom:7px;border-bottom:2px solid #00adee;padding-bottom:6px;margin-bottom:16px;}
.contents{width:300px;padding:17px 25px 25px;}
.logins{display:flex;justify-content:center;margin-bottom:6%;}
.logins input[type="submit"]{width:100%;margin-top:3px;}
.add_link{display:flex;justify-content:space-between;margin:13px 0 23px;}
.add_link a{color:#999;font-size:12.5px;text-decoration:underline;}
.add_link a:hover{color:#fd9710;text-decoration:none;}
.logins .error {font-size:12px;line-height:13px;padding-bottom:3px;}
</style>

<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  <?php } else { ?>
  <style>
  .hh1{color:#333;font-size:16px;font-weight:normal;margin-bottom:7px;padding-bottom:8px;margin-bottom:16px;}
  </style>
  <?php } ?>
  <style>
  .contents{width:300px;padding:17px 25px 25px;}
  .logins{display:flex;justify-content:center;margin-bottom:6%;}
  .logins input[type="submit"]{width:100%;margin-top:3px;}
  .add_link{display:flex;justify-content:space-between;margin:13px 0 23px;}
  .add_link a{color:#999;font-size:12.5px;text-decoration:underline;}
  .add_link a:hover{color:#fd9710;text-decoration:none;}
  .logins .error {font-size:12px;line-height:13px;padding-bottom:3px;}
  </style>
  <?php 
    $uri = $_SERVER['REQUEST_URI'];
    $isLogin = preg_match('/login/', $uri);
    if ($isLogin) {
  ?>
  <script>
    $(function() {
      let forms = $('.login-form--desktop');
      if (forms[1]) {
            $(forms[1]).remove();
        }
    });
  </script>
  <?php } ?>
    <div class="login-form login-form--desktop login-form--hide" class="row">
      <div class="login-form__tabs">
        <div class="login-form__tab login-form__tab--active">
          <?=$text_login?>
        </div>
        <div class="login-form__tab">
          <?=$text_register?>
        </div>
      </div>
      <div class="login-form__content login-form__content--active">
          <form action="<?php echo $action; ?>&json=1" method="post" id="login_<?php if($ajax){ ?>ajax<?php }else{ ?>noajax<?php } ?>">
            <div>
              <?php if ($error_warning) { ?>
              <div class="login-form__error"><?php echo $error_warning; ?></div>
              <?php } ?>
              <input class="login-form__input" type="email" name="email" value="<?php echo $email; ?>" minlength="3" placeholder="<?php echo $entry_email; ?>" autocomplete=​"username"/>
            </div>
            <div>
              <input class="login-form__input" type="password" name="password" value="<?php echo $password; ?>" minlength="3" maxlength="32" placeholder="<?php echo $entry_password; ?>" autocomplete="current-password"/>
            </div>
            <input type="submit" value="<?php echo $text_login; ?>" class="login-form__submit" />
            <?php if ($redirect) { ?>
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
            <?php } ?>
          </form>
            <a class="login-form__forgotten" href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
        <div>
          <?php echo $content_top; ?>
        </div>
      </div>
       <div class="login-form__content">
         <?php echo $register_html; ?>
        </div>
    </div>
    <script> 
  $(document).ready(function(){    
      function checkInput() {
        let form = $("#register_ajax");
  
        let inputs = ['.login-form__input[type="email"]', '.login-form__input[type="password:]'];
  
        inputs.forEach(function(item) {
        if ($(item).val() != '') {
            $(this).removeClass('login-form__input--invalid');
        } else {
            $(item).addClass('login-form__input--invalid');
        }
      });
    };
  
   $("#login_ajax input").on('input', function () {
    let item = $(this),
      value = item.val();
      if(value != '') {
        $(this).removeClass('login-form__input--invalid');
      } else {
        $(this).addClass('login-form__input--invalid');
      }
  });
  
  let btnLogin = $('.top-panel__login-btn');
        let loginForm = $('.login-form');
  
  $(btnLogin).click(() => {
     loginForm.removeClass('login-form--hide');
  });
  if ($(window).width() > 996) {
  
   $(document).mouseup(function (e) { // отслеживаем событие клика по веб-документу
          if (!loginForm.is(e.target) // проверка условия если клик был не по нашему блоку
              && loginForm.has(e.target).length === 0) { // проверка условия если клик не по его дочерним элементам
              loginForm.addClass('login-form--hide'); // если условия выполняются - скрываем наш элемент
          }
      });
    }
  
    $('.login-form__tabs').on('click', '.login-form__tab:not(.login-form__tab--active)', function() {
      $(this)
        .addClass('login-form__tab--active').siblings().removeClass('login-form__tab--active')
        .closest('.login-form').find('.login-form__content').removeClass('login-form__content--active').eq($(this).index()).addClass('login-form__content--active');
    });
  
  
  $("#login_ajax, #login_noajax").submit(function(e){
    e.preventDefault();
    checkInput();
    let sizeEmpty = $("#login_ajax").find('.login-form__input--invalid').length;
    if(sizeEmpty === 0){
      id=$(this).attr('id');
      $.ajax({
          url: '<?php echo $action; ?>?json=1',
          type: 'post',
          data: $(this).serialize(),
          dataType: 'json',
          beforeSend: function() {
            $('.login-form__error').slideToggle('fast');
          },
          success: function(json) {
            console.log(json);
            $('.login-form__error').remove();
            if(json['error']){
            $('#'+id+' input[type=email]').before('<div class="login-form__error" style="display:none;">'+json['error']+'</div>');
            $('.login-form__error').slideToggle('fast');
            }else if(json['redirect']){location=json['redirect'];}
            return false;
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
      });
    }
    return false;
  });
  });
  </script>
  
  <?php if(!$ajax){ ?>
  </div>
  <?php echo $footer; ?>
  <?php } ?>  

  