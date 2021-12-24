<h2><?php echo $text_instruction; ?></h2>

<div class="well well-sm">
  <p><?php echo $text_description; ?></p>
</div>

<form action="<?php echo $action; ?>" method="post" accept-charset="utf-8">
  <input type="hidden" name="data" value="<?php echo $data; ?>">
  <input type="hidden" name="signature" value="<?php echo $signature; ?>">
  <div class="buttons">
    <div class="pull-right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" />
    </div>
  </div>
</form>
