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
								<img style="width:75px; height:75px;" src="<?php echo $product['thumb']; ?>" onclick="location='<?php echo $product['href']; ?>'" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
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
						<td class="remove"><div class="del" onclick="$(this).parent().prev().prev().find('input').val(''); updateCart('<?php echo $product['id']; ?>', '<?php echo $product['key']; ?>')" >
							<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M13.841 3.07727H19.2251C19.6486 3.07727 20 3.41518 20 3.84321C20 4.27123 19.6531 4.61365 19.2296 4.61365H18.3915L16.9227 20.8335C16.8867 21.23 16.5533 21.5319 16.1523 21.5319H3.84771C3.44672 21.5319 3.11331 21.23 3.07727 20.8335L1.60847 4.61365H0.770444C0.342419 4.61365 0 4.26673 0 3.84321C0 3.41969 0.342419 3.07727 0.770444 3.07727H6.15003V2.30683C6.15003 1.03176 7.1818 0 8.45686 0H11.5341C12.8092 0 13.841 1.03176 13.841 2.30683V3.07727ZM8.46136 1.53638C8.03334 1.53638 7.69092 1.88331 7.69092 2.30683V3.07727H12.3046V2.30683C12.3046 1.8788 11.9576 1.53638 11.5341 1.53638H8.46136ZM4.54607 19.991H15.4449L16.8416 4.61365H6.92048H3.15386L4.54607 19.991ZM6.92032 6.86723L7.69077 17.6354C7.7178 18.0589 7.39791 18.4239 6.97439 18.4554H6.92032C6.51483 18.4554 6.17691 18.14 6.14988 17.7391L5.37943 6.97536C5.3524 6.55185 5.67229 6.18239 6.09581 6.15085C6.51933 6.12382 6.88878 6.44371 6.92032 6.86723ZM9.99819 6.14926C9.57467 6.14926 9.22775 6.49168 9.22775 6.9197V17.6834C9.22775 18.1069 9.57016 18.4538 9.99819 18.4538C10.4262 18.4538 10.7686 18.1114 10.7686 17.6834V6.9197C10.7641 6.49619 10.4217 6.14926 9.99819 6.14926ZM13.0712 6.86778C13.1028 6.43976 13.4722 6.11987 13.8957 6.15141C14.3193 6.18294 14.6392 6.5524 14.6121 6.97592L13.8417 17.7396C13.8101 18.1451 13.4767 18.456 13.0712 18.456H13.0172H13.0127C12.5891 18.4244 12.2693 18.055 12.3008 17.6315L13.0712 6.86778Z" fill="#C4C4C4"/>
</svg>
						 </div>
						</td>
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
	$('#popupcart_extended').popup({transition: 'all 1.3s',	scrolllock: true});
});
</script>
