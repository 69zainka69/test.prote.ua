<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="/catalog/view/javascript/instup/jquery.validate.min.js"></script>

<div id="spinner-callback-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-text-center"><img src="./image/spinner.gif" alt="Waiting..."/></div>
    </div>
</div>
<div id="callback-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-header">
            <p class="header uk-h2">
              <i class="fa fa-shopping-cart"></i>&nbsp;<?php echo $ordercallback_settings['modal_title'];?>
            </p>
        </div>
        <form class="uk-form" id="callback-form">
           
            <fieldset>                                   
                    <div class="uk-form-row">
                      <?php echo $modal_field_name; ?>
                      <input name="callback-name" type="text"<?php echo ($ordercallback_settings['ordercallback_field_name_required']) ? ' required' : ''; ?> placeholder="<?php echo $modal_field_name; ?>">
                    </div>
                
                    <div class="uk-form-row">
                      <?php echo $modal_field_phone; ?>
                      <input name="callback-phone" type="text"<?php echo ($ordercallback_settings['ordercallback_field_phone_required']) ? ' required' : ''; ?> placeholder="+38(__)_______">
                      <p>Напр. +38(050)1234567</p>
                    </div>
               
                    <div class="uk-form-row">
                      <?php echo $modal_field_comment; ?>
                      <textarea name="callback-comment"<?php echo ($ordercallback_settings['ordercallback_field_comment_required']) ? ' required' : ''; ?> rows="3" placeholder="<?php echo $modal_field_comment; ?>"></textarea>
                    </div>
              
            </fieldset>
            <div class="g-recaptcha" data-sitekey="6LcEnBEUAAAAANNBnQrmwRRIcsqDyzWdRstlASQW"></div>
        </form>
        <div style="margin-top: 20px;">
            <p><?php echo $modal_timetable; ?></p>
        </div>
        <div class="uk-modal-footer uk-text-right">           
            <button id="callback-button-send" type="button" class="uk-button uk-button-primary"><?php echo $button_send ?></button>
        </div>
    </div>
</div>
<script>
    $(function () {
        // $('input[name="ordercallback-phone"]').mask("<?php echo isset($ordercallback_settings['ordercallback_field_phone_mask']) ? $ordercallback_settings['ordercallback_field_phone_mask'] : '(999)-999-9999';?>");

        $('#callback-button-send').bind('click', function () {            
            var validator = $('#callback-form').validate({
                errorClass: 'uk-form-danger',
                messages: {
                    "callback-name": '',
                    "callback-phone": '',
                    "callback-comment": '',
                    "g-recaptcha-response": '',
                }
            });
            if (!validator.form()) {  
                return false;
            }
            
            var modal = UIkit.modal("#callback-modal");
            if (modal.isActive()) {
                modal.hide();
            }

            //modal = UIkit.modal("#spinner-modal");
            //modal.options.bgclose = false;
            //modal.show();
                       
            $.ajax({
                url: 'index.php?route=module/ordercallback',
                type: 'post',
                data: $('input[name="callback-name"], input[name="callback-phone"], textarea[name="callback-comment"]'),
                dataType: 'json',
                success: function(json) {
                    modal.hide();
                    $('.success, .warning, .attention, .information, .error').remove();

                    if (json['error']) {
                        $('#notification').html('<div class="warning" style="display: none;">' + json['error'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                        $('.warning').fadeIn('slow');
                    }

                    if (json['success']) {
                        $('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        // $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                        $('.success').fadeIn('slow');
                    }

                    $('html, body').animate({scrollTop: 0}, 'slow');
                },
                error: function (error) {
                    modal.hide();
                    console.log(error);
                    $('.success, .warning, .attention, .information, .error').remove();
                    $('#notification').html('<div class="warning" style="display: none;"><?php echo $message_system_error;?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                    $('.warning').fadeIn('slow');
                }
            });
        });
    });
</script>