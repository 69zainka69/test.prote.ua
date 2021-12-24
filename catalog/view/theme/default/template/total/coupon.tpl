    <div class="panel-body">
      <label for="input-coupon"><?php echo $entry_coupon; ?></label>
      <div class="input-group erro">
        <input type="text" name="coupon" value="<?php echo $coupon; ?>" placeholder="<?php echo $entry_coupon; ?>" class="form-control" />
        <input type="button" value="<?php echo $button_coupon; ?>" id="button-coupon" data-loading-text="<?php echo $text_loading; ?>"  class="button lblue" />
        </div>
      <script><!--
      block=false;
$('#button-coupon').on('click', function() {
	if(block)return false;
	block=true;
var lang=''; language = jQuery('html').attr('lang'); if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
$('.error').remove();
	$.ajax({
		url: 'index.php?route=total/coupon/coupon'+lang,
		type: 'post',
		data: 'coupon=' + encodeURIComponent($('input[name=\'coupon\']').val()),
		dataType: 'json',
		beforeSend: function() {

			//$('#button-coupon').button('loading');
		},
		complete: function() {
			//$('#button-coupon').button('reset');
		},
		success: function(json) {
			

			if (json['error']) {
				$('.erro').before('<div class="error"> ' + json['error'] + '</div>');
				//$('html, body').animate({ scrollTop: 0 }, 'slow');
			}
			if (json['redirect']) {
				location = json['redirect'];
			}
		}
	});
});
//--></script>
    </div>

