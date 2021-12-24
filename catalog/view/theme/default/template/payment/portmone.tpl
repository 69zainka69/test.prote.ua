<h2><?php echo $text_instruction; ?></h2>

<div class="well well-sm">
  <p><?php echo $text_description; ?></p>
</div>

<form action="<?php echo $action; ?>" method="post">
  <input type="hidden" name="payee_id" value="<?php echo $payee_id; ?>">
  <input type="hidden" name="shop_order_number" value="<?php echo $shop_order_number; ?>">
  <input type="hidden" name="bill_amount" value="<?php echo $bill_amount; ?>">
  <input type="hidden" name="description" value="<?php echo $description; ?>">
  <input type="hidden" name="success_url" value="<?php echo $success_url; ?>">
  <input type="hidden" name="failure_url" value="<?php echo $failure_url; ?>">
  <input type="hidden" name="lang" value="ru">
  <input type="hidden" name="encoding" value="cp1251">

  <div class="buttons">
    <div class="pull-right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" />
    </div>
  </div>
</form>
