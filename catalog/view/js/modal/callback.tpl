<div class="callback-modal">
    <div class="callback-modal__phone">050 469 95 75</div>
    <div class="callback-modal__phone">067 354 56 25</div>
    <div class="callback-modal__description">
       <?php echo $modal_time; ?>
    </div>
    <div class="callback-modal__title"><?php echo $modal_title; ?></div>
    <form id="modal-callback-header" method="post" name="form-callback-modal" class="callback-form">
        <input type="text" name="tel" id="phone" class="callback-modal__input" autocomplete="off" placeholder="+38(___)___-____">
        <input type="hidden" name="validate" value="tel" autocomplete="off">
        <input type="hidden" name="g-recaptcha-response" >
    </form>
    <button form="modal-callback-header" class="callback-modal__call" type="submit"><?php echo $modal_btn_call; ?></button>
</div>
<script>
  $(function() {
      
    let lang = '';
    language = jQuery('html').attr('lang');
    if (language == 'uk') {
        lang = '&lang=ua';
    }
    $('.callback-modal .callback-form').on('submit', function(e) {
        e.preventDefault();
        if($('.callback-modal__input').val() != '') {
        $('.callback-modal__input').removeClass('callback-modal__input--invalid');
        $.ajax({
            url: 'index.php?route=information/callback' + lang,
            type: 'post',
            data: $('#' + $(this).attr('id')).serialize(),
            dataType: 'json',
            success: function(json) {
                if (json['success']) {
                    $('.callback-modal__call').addClass('m-menu__btn-call--sended').prop('disabled', true);
                    $('.callback-modal__input').addClass('menu__telephone--sended');
                } else if (json['error']) {
                    if (json['error']['tel']) {
                        $('.callback-modal__input').addClass('callback-modal__input--invalid');
                    }
                }
            }
        })
    } else {
        $('.callback-modal__input').addClass('callback-modal__input--invalid');
    }
    });
    
    $(".callback-modal__input").on('keyup focusout', function () {
    let item = $(this),
    value = item.val();
    if(value != '+38(___)___-____') {
      $(this).removeClass('callback-modal__input--invalid');
    } else {
      $(this).addClass('callback-modal__input--invalid');
    }
});
    let btnCallback = $('.top-panel__phone .top-panel__arrow');
    let formCallback = $('.callback-modal');
    $('.top-panel__phone').mouseenter(function(e){
        $('.top-panel__phone::before').css('z-index', 13);
        $('.top-panel__phone--selected').css('z-index', 13);
        toggleCallback();
    });
    $('.top-panel__phone').mouseleave(function(e){
        $('.top-panel__phone::before').css('z-index', 3);
        $('.top-panel__phone--selected').css('z-index', 3);
        toggleCallback()();
    });
    function toggleCallback(){
        formCallback.toggleClass('callback-modal--open');
            btnCallback.toggleClass('top-panel__arrow--dark--open');
            $('.callback-modal__call').removeClass('m-menu__btn-call--sended').prop('disabled', false);
            $('.callback-modal__input').removeClass('menu__telephone--sended');
            $('.callback-modal__input').val('');
    }

        $('#phone').mask('+38(999)999-9999', {autoclear: true});
    });
</script>