<svg style="display:none;height:0;width:0;">
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/popupcart.css');?>
</style>
</svg>
<?php if(!isset($voucher))$voucher=false; ?>
<?php if(!isset($vouchers))$vouchers=false; ?>
<?php if(!isset($coupon))$coupon=false; ?>
<?php if(!isset($reward))$reward=false; ?>

<div id="popupcart_extended" class="modal modal-form modal-cart">
	<div>
	<div class="body">
	  <div class="modal-overlay"></div>
	  <div class="modal-body">
	    <div class="modal-close" onclick="$('#popupcart_extended').popup('hide')"><?php if ($products || $vouchers) { ?><?php echo $button_shopping; ?><?php } ?></div>
	    <div class="form">
		
	<div class="modal__title"><a href="<?php echo $langurl; ?>/cart/"><div class="svg"><?php echo  file_get_contents(DIR_IMAGE.'/ico/04-cart.svg'); ?></div><?php echo $head; ?></a></div>
	<?php if ($products || $vouchers) { ?>
		<div class="popupcart_info">
			<table>
				<?php foreach ($products as $key => $product) { ?>
					<tr class="row_<?php echo $key; ?>_<?php echo $product['id']; ?>" id="pr_id_<?php echo $product['id']; ?>">
						<td class="image">
							<?php if ($product['thumb']) { ?>
								<img src="<?php echo $product['thumb']; ?>" onclick="location='<?php echo $product['href']; ?>'" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
							<?php } ?>
						</td>
						<td class="name">
							<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
							<div class="model">Артикул: <?php echo $product['model']; ?></div>
							<div>
							
							</div>
							<?php if (!$product['stock']) { ?>
								<?php if ($product['quantity'] >= $product['maximum']) { ?>
									<span><?php echo $in_stock; ?> <?php echo ($product['maximum'] > 1) ? $left : $left1; ?> <?php echo $just; ?> <?php echo $product['maximum']; ?> <?php echo $pcs; ?></span>
								<?php } ?>
							<?php } ?>
						</td>
						<td class="quantity">
							<span onclick="updateCart('<?php echo $product['id']; ?>', '<?php echo $product['key']; ?>', '-')">-</span>
							<input type="text" name="<?php echo $product['key']; ?>" size="2" value="<?php echo $product['quantity']; ?>" onkeyup="updateCart('<?php echo $product['id']; ?>', '<?php echo $product['key']; ?>')" />
							<?php if (!$product['stock']) { ?>
								<?php if ($product['quantity'] < $product['maximum']) { ?>
									<span onclick="updateCart('<?php echo $product['id']; ?>', '<?php echo $product['key']; ?>', '+')">+</span>
								<?php } else { ?>
									<span style="opacity:0.5;">+</span>
								<?php } ?>
							<?php } else { ?>
								<span onclick="updateCart('<?php echo $product['id']; ?>', '<?php echo $product['key']; ?>', '+')">+</span>
							<?php } ?>

						</td>
						<td class="price"><?php echo $product['total']; ?></td>
						<td class="remove"><div class="del" onclick="$(this).parent().prev().prev().find('input').val(''); updateCart('<?php echo $product['id']; ?>', '<?php echo $product['key']; ?>')" ></div></td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div class="total">
			<?php if ($coupon || $voucher || $reward) { ?>
			<div class="coupon">
				<input type="text" name="promocod" value="" placeholder="Введіть промокод">
				<button type="button" class="button orage" onclick=""><?php echo $button_checkout; ?></button>

			      <?php echo $coupon; ?><?php echo $voucher; ?><?php echo $reward; ?>

		    </div>
		    <?php } ?>
			<div class="popupcart_total">
				<table>
					<?php foreach($totals as $total) { ?>
						<tr class="code_<?php echo $total['code']; ?>">
							<td class="name"><?php echo $total['title']; ?></td> <td><?php echo $total['text']; ?></td>
						</tr>
					<?php } ?>
				</table>
			</div>
 
		</div>
		<style type="text/css">
							.upFreeDelivSum{
								color: #00aeef;
							    font-size: 14px;
							    font-weight: normal;
							    padding-bottom: 15px;
							    display: inline-block;
							    width: 50%;
							    float: right;
							}
							.upFreeDelivSum span{
								color: #fd9710;
							}
						</style>
						<div class="upFreeDelivSum"	>
							<?= $upFreeDelivSum;?>
						</div>

		<div class="popupcart_buttons">
			<button type="button" class="button orage" onclick="location='<?php echo $cart; ?>'"><?php echo $button_checkout; ?></button>
		</div>
	<?php } else { ?>
		<div class="empty"><?php echo $text_empty; ?></div>
	<?php } ?>
	<input type="hidden" name="addtocart_logic" value="<?php if(isset($addtocart_logic)) echo $addtocart_logic; ?>" />
	<input type="hidden" name="click_on_cart" value="<?php if(isset($click_on_cart))echo $click_on_cart; ?>" />
</div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
	$('#popupcart_extended').popup({transition: 'all 0.3s',	scrolllock: true});
});
</script>
