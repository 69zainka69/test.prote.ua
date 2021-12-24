<?php echo $header; ?>
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/account.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/edanger.css');?>
.e-danger{width:50%;}
@media(max-width:1024px){
.e-danger{position:relative;left:0;margin-left:0;margin-top:5px;width:100%;}
.e-danger:after{border-bottom: 10px solid #ecf7fb;border-left: 10px solid transparent;border-right: 10px solid transparent;border-top: none;top: -10px;left: 10px;}
}
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
          <li><a href="<?php echo $password1; ?>" class="button"><?php echo $text_password; ?></a></li>
          <!-- <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li> -->
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
        </div>
        <div class="c2">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <h2><?php echo $text_password; ?></h2>
              <div>
                <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
                <div class="relative">
                  <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                  <?php if ($error_password) { ?>
                  <div class="e-danger"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/attention.svg');?></span><span><?php echo $error_password; ?></span></div>
                  <?php } ?>
                </div>
              </div>
              <div>
                <label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
                <div class="relative">
                  <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
                  <?php if ($error_confirm) { ?>
                  <div class="e-danger"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/attention.svg');?></span><span><?php echo $error_confirm; ?></span></div>
                  <?php } ?>
                </div>
              </div>
            <div class="buttons">
                <input type="submit" value="<?php echo $button_save; ?>" class="button" />
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php echo $footer; ?>