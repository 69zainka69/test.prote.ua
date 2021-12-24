<?php if(!$ajax){ ?>
<?php echo $header; ?>
<style>
.breadcrumb{margin-bottom:20px;}
h1{color:#00adee;font-size:18px;font-weight:normal;margin-bottom:7px;border-bottom:2px solid #00adee;padding-bottom:6px;margin-bottom:16px;}
</style>

<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><?php echo $success; ?></div>
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
  <div class="login-form login-form--hide" class="row">
    <div class="login-form__tabs">
      <div class="login-form__tab login-form__tab--active">
        <?=$text_login?>
      </div>
      <div class="login-form__tab">
        <?=$text_register?>
      </div>
    </div>
    <div class="login-form__content login-form__content--active">
        <form action="<?php echo $action; ?>&json=1" method="post" id="login_mobile_ajax">
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
      <!-- <button class="login-form__btn-google">
      <div class="login-form__btn-icon"><?php echo file_get_contents(DIR_IMAGE.'/ico/google.svg');?></div>Google</button> -->
        <?php echo $content_top; ?>
      </div>
    </div>
     <div class="login-form__content">
       <?php echo $register_mobile_html; ?>
      </div>
  </div>
  <script> 
$(document).ready(function(){    
  let inputs = ['#login_mobile_ajax .login-form__input[type="email"]', '#login_mobile_ajax .login-form__input[type="password"]'];

    function checkInput() {
      let form = $("#login_mobile_ajax");

      inputs.forEach(function(item) {
      if ($(item).val() != '') {
          $(this).removeClass('login-form__input--invalid');
      } else {
          $(item).addClass('login-form__input--invalid');
      }
    });
  };
  inputs.forEach(function(selector) {
      validateField(selector);
    });

  function validateField(element) {
    $(element).on('focusout', (e) => {
      if ($(e.target).val() != '') {
        $(this).removeClass('register-form__input--invalid');
      } else {
        $(element).addClass('register-form__input--invalid');
      }
    });
  }


 $("#login_mobile_ajax input").on('input', function () {
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

  $('.login-form__tabs').on('click', '.login-form__tab:not(.login-form__tab--active)', function() {
    $(this)
      .addClass('login-form__tab--active').siblings().removeClass('login-form__tab--active')
      .closest('.login-form').find('.login-form__content').removeClass('login-form__content--active').eq($(this).index()).addClass('login-form__content--active');
  });


$("#login_mobile_ajax, #login_noajax").submit(function(e){
  e.preventDefault();
  checkInput();
  let sizeEmpty = $("#login_mobile_ajax").find('.login-form__input--invalid').length;
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

