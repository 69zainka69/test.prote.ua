<?php echo $header; ?>
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/account.css');?>
input[type="checkbox"]{display:none;}
input[type="checkbox"] + label {cursor:pointer;position:relative;padding-left:27px;color:#999!important;}
input[type="checkbox"]:checked + label::before{content:"";width:16px;height:7px;border-left:3px solid #fd9710;border-bottom:3px solid #fd9710;position:absolute;left:2px;top:0px;z-index:1;transform:rotate(-45deg);}
input[type="checkbox"] + label::after{content:"";position:absolute;width:15px;height:15px;background:#ebebeb;top:0;left:0px;}
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
          <li><a href="<?php echo $newsletter1; ?>" class="button"><?php echo $text_newsletter1; ?></a></li>
        </ul>
        </div>
        <div class="c2">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group">
                <h2><?php echo $heading_title; ?></h2>

                <input type="checkbox" name="news" style="display:none" onclick="chengenews();" <?php if (!$newsletter) { ?> checked <?php } ?>/>
                  <label onclick="$(this).prev().click();">
                  <?php echo $entry_newsletter; ?>
                </label>
                <script>
                  function chengenews(){
                      $('input[name=\"newsletter\"]:not(:checked)').click();
                  }
                </script>
                <div style="display:none;">
                  <?php if ($newsletter) { ?>
                  <label>
                    <input type="radio" name="newsletter" value="1" checked="checked" />
                    <?php echo $text_yes; ?> </label>
                  <label>
                    <input type="radio" name="newsletter" value="0" />
                    <?php echo $text_no; ?></label>
                  <?php } else { ?>
                  <label>
                    <input type="radio" name="newsletter" value="1" />
                    <?php echo $text_yes; ?> </label>
                  <label>
                    <input type="radio" name="newsletter" value="0" checked="checked" />
                    <?php echo $text_no; ?></label>
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