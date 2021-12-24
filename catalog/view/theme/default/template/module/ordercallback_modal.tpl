<svg style="display:none;height:0;width:0;">
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/popupcart.css');?>
.none{display:none;} .uk-form-danger{border-color: #dc8d99 !important;background: #fff7f8 !important;color: #d85030 !important;} .ordercallback-form .modal-body{width:380px;} #ordercallback_thumb{width:100px;height:auto;} .ordercallback-form .name{color:#333;font-family:'Trebuchet MS';font-size:13px;line-height:20px;max-width:180px;} #sum{color:#fd9710;font-family:'Trebuchet MS';font-size:23px;} .dflex.pr{justify-content:space-between;align-items:center;padding:25px 0 30px;} .ordercallback-form .quantity{font-size:14px;color:#333;} .ordercallback-form .nameq{display:inline;padding-right:15px;} .timetable{font-size:11.5px;color:#999;line-height:14px;} .dflex.b{justify-content:space-between;align-items:center;} .modal-cart.ordercallback-form .popupcart_info{border:none;margin-bottom:0;} </style>
</svg> 
<div class="modal modal-form modal-cart ordercallback-form">
    <div class="body">
      <div class="modal-overlay"></div>
      <div class="modal-body">
        <div class="modal-close"></div>
        <div class="form popupcart_info">
            <div class="modal__title"><div class="svg"><?php echo  file_get_contents(DIR_IMAGE.'/ico/04-cart.svg'); ?></div><?php echo $modal_title_order; ?></div>
            <form id="ordercallback-form">
                <div>
                    <?php if ($ordercallback_as_order) { ?>
                        <div class="dflex">
                            <div class="image">
                                <img id="ordercallback_thumb" src="#" alt="<?php echo $heading_title;?>">
                            </div>
                            <div id="ordercallback_name" class="name">
                                <?php echo $heading_title;?>
                            </div>
                        </div>
                        <span class="none" id="ordercallback_qtyset"><b><?php if(isset($minimum)){echo $minimum;} ?> шт.</b></span>
                        <div class="none" id="ordercallback_price"><b><?php if(isset($minimum) && isset($price) && is_numeric($price)) {
                            echo $price*$minimum;
                        } ?> грн.</b></div>
                        <input id="ordercallback_product" name="ordercallback-product" type="hidden" value="<?php echo $heading_title; ?>">
                        <?php  $button_send = $button_buy;?>
                    <?php } ?>
                    <div class="dflex pr">
                        <input id="pricefloat" name="ordercallback_pricefloat" type="hidden" value="">
                        <?php /*<input id="ordercallback_qtyset" name="ordercallback-qtyset" type="text" data-min="1" placeholder="" value="<?php echo $minimum; ?>">*/ ?>
                        <div id="sum">
                            <span></span> грн.
                        </div>
                        <div class="quantity">
                            <div class="nameq"><?php if(isset($text_quantity1)) echo $text_quantity1; ?></div>
                            <span onclick="
                            if($(this).next().val()>=2 && $(this).next().data('min')<$(this).next().val()){$(this).next().val(~~jQuery(this).next().val()-1).change()}; return false;">-</span>
                            <input type="text" id="ordercallback_qtyset" name="ordercallback-qtyset" data-min="1" placeholder="" value="<?php if(isset($minimum)){echo $minimum;} else {echo '1';} ?>" onkeyup="" />
                            <span onclick="jQuery(this).prev().val(~~jQuery(this).prev().val()+1).change();">+</span>
                            <input type="hidden" id="ordercallback_product_id" name="ordercallback-product_id" value="">
                        </div>
                    </div>
                    <?php if ($ordercallback_settings['ordercallback_field_phone_show']) { ?>
                        <div class="uk-form-row">
                          <?php //echo $modal_field_phone; ?>
                          <input name="ordercallback-phone" type="tel" <?php echo ($ordercallback_settings['ordercallback_field_phone_required']) ? ' required' : ''; ?> placeholder="+38(__)___-__-__">
                          <!-- <input id="phone" maxlength="17" name="phone" type="text" class="required phone" tabindex="10" value=""> -->
                        </div>
                    <?php } ?>
                    <?php if ($ordercallback_settings['ordercallback_field_name_show']) { ?>
                        <div class="uk-form-row">
                          <?php //echo $modal_field_name; ?>
                          <input name="ordercallback-name" type="text"<?php echo ($ordercallback_settings['ordercallback_field_name_required']) ? ' required' : ''; ?> placeholder="<?php echo $modal_field_name; ?>">
                        </div>
                    <?php } ?>

                    <?php if ($ordercallback_settings['ordercallback_field_email_show']) { ?>
                        <div class="uk-form-row">
                          <?php echo $modal_field_email; ?>
                          <input name="ordercallback-email" type="email"<?php echo ($ordercallback_settings['ordercallback_field_email_required']) ? ' required' : ''; ?> placeholder="<?php echo $modal_field_email; ?>">
                        </div>
                    <?php } ?>
                    <?php //if ($ordercallback_settings['ordercallback_field_comment_show']) { ?>
                        <div class="uk-form-row">
                          <?php //echo $modal_field_comment; ?>
                          <textarea name="ordercallback-comment"<?php echo ($ordercallback_settings['ordercallback_field_comment_required']) ? ' required' : ''; ?> rows="3" placeholder="<?php echo $modal_field_comment; ?>"></textarea>
                        </div>
                    <?php //} ?>
                </div>
            </form>
            <div class="dflex b">
                <div class="timetable">
                    <?php echo $modal_timetable; ?>
                </div>
                <div class="buttons">
                    <button id="ordercallback-button-send" type="button" class="button"><?php echo $button_send ?></button>
                    <div class="order-sum-tooltip">
                        <p><?php echo $modal_min_order_sum; ?></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<script>
price = 0;
function ordercallback_modal_show(product_id, thumb, name, price, minimum) {
  $('#ordercallback_product_id').val(product_id);
  $('#ordercallback_thumb').attr('src', thumb);
  $('#ordercallback_name').text(name);
  $('#ordercallback_qty').text(minimum+' шт.');
  $('input#ordercallback_qtyset').val(minimum).attr('data-min', minimum);
  $('#ordercallback_product').val(name);
  tot = (parseFloat(price)*minimum).toFixed(2);
  $('#pricefloat').val(price);
  $('#sum span').html(tot);
  $('#ordercallback_price').text(tot+' грн.');
  //$('#ordercallback-modal').toggle();
  $('#ordercallback-button-send').show();
}

$(document).ready(function(){
    $('input#ordercallback_qtyset').on('change', function() {
        var quantityValue = parseInt($(this).val());
        var minQuantityValue = parseInt($(this).data('min'));

        if (quantityValue < minQuantityValue) {
            quantityValue = minQuantityValue;
            $(this).val(quantityValue);
        }

        var sum = quantityValue * parseFloat($('#pricefloat').val());
        $('#sum span').html(sum.toFixed(2));
    });

    $('body').on('click', function () {
        if ($('.order-sum-tooltip').hasClass('active')) {
            $('.order-sum-tooltip').removeClass('active');
        }
    });

   

});
</script>