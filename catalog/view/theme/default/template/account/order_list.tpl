<?php echo $header; ?>
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/account.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/order.css');?>
</style>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  
  <div class="row" id="account">
    <div class="content">
      <div class="rowh1">
        <h1><?php echo $lastname.' '.$firstname; ?></h1>  
        <a href="<?php echo $logout; ?>"><span class="text"><?php echo $text_logout; ?></span><?php echo file_get_contents(DIR_IMAGE.'/ico/account/exit.svg');?></a>
      </div>
      <div class="content1">
        <div class="c1">
        <ul>
          <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
          <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
          <!-- <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li> -->
          <li><a href="<?php echo $order; ?>" class="button"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
        </div>
        <div class="c2">
          <h2><?php echo $heading_title; ?></h2>
          <?php if ($orders) { ?>
          <div>
              <div class="orders">
                <?php foreach ($orders as $order) { ?>
                <div class="order">
                  <div class="order_id"><a href="<?php echo $order['href']; ?>" title="<?php echo $button_view; ?>" class="btn btn-info">№ <?php echo $order['order_id']; ?></a></div>
                  <div class="data"><div class="quant"><?php echo $order['products']; ?> <?php echo $product_total; ?> </div><div class="dat"><?php echo $order['date_added']; ?></div></div>
                  <div class="status"><?php echo $order['status']; ?></div>
                  <div class="total"><?php echo $order['total']; ?></div>
                  <div class="view"><a href="<?php echo $order['order_reorder']; ?>" onclick="1return false;" data-toggle="tooltip" title="<?php echo $button_reorder; ?>" class="btn btn-info">
                    <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/reorder.svg');?></span>
                  </a></div>
                </div>
                <?php } ?>
              </div>
          </div>
          <div><?php echo $pagination; ?></div>
          <?php } else { ?>
          <p><?php echo $text_empty; ?></p>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
