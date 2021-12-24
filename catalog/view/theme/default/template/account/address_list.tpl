<?php echo $header; ?>
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/account.css');?>
h2{color:#00adee;}
.addreses{margin-top:14px;}
.head{display:flex;justify-content:space-between;}
.address{display:flex;border:1px solid #78d4f6;padding:12px;color:#999;font-size:13px;line-height:16px;margin-bottom:20px;}
.name_address{color:#fd9710;font-size:15px;}
.edit{color:#00aff2;}
.delete{}
.buts span{display:inline-block;font-size:12px;font-family:'Trebuchet MS';}
#account .svg{display:block;margin-right:5px;padding-top:2px;}
#account .buts{display:flex;justify-content:flex-end;padding-bottom:3px;}
#account .buts a{display:flex;}
#account .buts .delete{margin-left:20px;color:#999;justify-content:center;}
.alert-success{color:green;}
.alert-warning{color:red;}
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
          <li><a href="<?php echo $edit; ?>"><?php echo $text_edit1; ?></a></li>
          <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
          <!-- <li><a href="<?php echo $address; ?>" class="button"><?php echo $text_address; ?></a></li> -->
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
        </div>
        <div class="c2">
          <h2><?php echo $text_address_book; ?></h2>

          <?php if ($success) { ?>
          <div class="alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
          <?php } ?>
          <?php if ($error_warning) { ?>
          <div class="alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
          <?php } ?>
          <?php if ($addresses) { ?>
            
            <?php foreach ($addresses as $key => $result) { ?>
            <div class="addreses">
              <div class="head">
                <div class="name_address"><?php if($defautl_address_id==$result['address_id']){echo $entry_address_1.' '.($key+1).' ('.$text_address_defautl.')';}else{echo $entry_address_1.' '.($key+1);} ?></div>
                <div class="buts">
                  <a href="<?php echo $result['update']; ?>" class="btn edit"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/edit.svg');?></span><span><?php echo $button_edit; ?></span></a>
                  <a href="<?php echo $result['delete']; ?>" class="btn delete"><span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/del.svg');?></span><span><?php echo $button_delete; ?></span></a>
                </div>
              </div>
              <div class="address">
                <?php echo $result['address']; ?>  
              </div>
            </div>
            
            <?php } ?>
            
            <?php } else { ?>
            <p><?php echo $text_empty; ?></p>
            <?php } ?>
            <div class="buttons">
              <a href="<?php echo $add; ?>" class="button"><?php echo $button_new_address; ?></a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>