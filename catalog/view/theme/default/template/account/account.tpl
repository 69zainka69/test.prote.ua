<?php echo $header; ?>
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/account.css');?>
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
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
        </div>
        <div class="c2">
          <?php if ($success) { ?>
          <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
