<h2><?php echo $text_instruction; ?></h2>

<div class="well well-sm">
  <p><?php echo $text_description; ?></p>
</div>


<!--
<form action="<?php echo $action; ?>" method="post">
            <input type="hidden" name="amt" value="<?php echo $amt; ?>"/>
            <input type="hidden" name="ccy" value="<?php echo $ccy; ?>" />
            <input type="hidden" name="merchant" value="<?php echo $merchant; ?>" />
            <input type="hidden" name="order" value="<?php echo $order; ?>" />
            <input type="hidden" name="details" value="<?php echo $details; ?>" />
            <input type="hidden" name="ext_details" value="" />
            <input type="hidden" name="pay_way" value="privat24" />
            <input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
            <input type="hidden" name="server_url" value="<?php echo $server_url; ?>" />
-->
  <div class="buttons">
    <div class="pull-right">
      <input type="button" id="button-confirm" value="<?php echo $button_confirm; ?>" class="btn btn-primary" />
    </div>
  </div>

<script><!--
$('#button-confirm').on('click', function() {
	$.ajax({
		type: 'get',
		url: 'index.php?route=payment/privat24/confirm',
		cache: false,
		beforeSend: function() {
			$('#button-confirm').button('loading');
		},
		complete: function() {
			$('#button-confirm').button('reset');
		},
		success: function() {
			location = '<?php echo $continue; ?>';
		}
	});
});
//--></script>
