<div class="ulogin_form">
    <svg style="display:none;height:0;width:0;">
    <style>
    .ulogin{display:flex;flex-direction:column;width:100%;}
    .ulogin>div{height:40px;width:100%;padding:0 10%;line-height:40px;display:flex;
    color:#fff;font-size:14px;
    margin-top:12px;cursor:pointer;}
    .ulogin .svg{padding-top:6px;}
    .ulogin-button-facebook{background:#44619d;}
    .ulogin-button-google{background:#ed1c24;}
    .text_login{width:100%;text-align:center;}
    </style>
    </svg>
    <!-- <script async src="https://ulogin.ru/js/ulogin.js"></script> -->
    <script async src="/catalog/view/javascript/ulogin.min.js"></script>
    <script async src="/catalog/view/javascript/ulogin.js"></script>
    <?/*<!-- <link href="catalog/view/theme/default/stylesheet/ulogin.css"/> -->
    <!-- <link href="https://ulogin.ru/css/providers.css"/> --> */ ?>
    <?php if (empty($uloginid)) { ?>
        <div data-ulogin="display=panel;fields=first_name,last_name,email;optional=phone,city,country,nickname,sex,photo_big,bdate,photo;providers=facebook,twitter,instagram,vkontakte,odnoklassniki,mailru;hidden=other;redirect_uri=<?php echo $redirect_uri; ?>;callback=<?php echo $callback; ?>"></div>
    <?php } else { ?>
        <? /*<!-- <div data-uloginid="<?php echo $uloginid; ?>" data-ulogin="display=panel;fields=first_name,last_name,email;providers=facebook,google;theme=flat;hidden=;redirect_uri=<?php echo $redirect_uri; ?>;callback=<?php echo $callback; ?>"></div> --> */ ?>
        <div class="ulogin" data-uloginid="<?php echo $uloginid; ?>" data-ulogin="display=buttons;fields=first_name,last_name,email;providers=facebook,google;theme=flat;hidden=;redirect_uri=<?php echo $redirect_uri; ?>;callback=<?php echo $callback; ?>">
            <!-- <div class="ulogin-button-facebook" data-uloginbutton="facebook">
                <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/fb.svg');?></div>
                <div class="text_login"><?php echo $text_login_fb;?></div>
            </div> -->
            <button class="login-form__btn-google" data-uloginbutton="google">
                <div class="login-form__btn-icon"><?php echo file_get_contents(DIR_IMAGE.'/ico/google.svg');?></div>
                Google
            </button>
        </div>
    <?php } ?>
    </div>
    