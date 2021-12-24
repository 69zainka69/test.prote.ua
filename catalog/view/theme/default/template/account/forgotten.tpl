<?php echo $header; ?>
<style>
.breadcrumb{margin-bottom:20px;}
h1{color:#00adee!important;font-size:18px;font-weight:normal;margin-bottom:7px;border-bottom:2px solid #00adee;padding-bottom:6px;margin-bottom:16px;}
.contents{width:300px;padding:17px 25px 25px;}
.logins{display:flex;justify-content:center;margin-bottom:6%;}
.logins input { width: 100% }
.logins input[type="submit"]{width:100%;margin-top:3px;}
.logins .error {font-size:12px;line-height:13px;padding-bottom:3px;}
.logins p{color: #999;font-family: 'Trebuchet MS';font-size: 12px;line-height:13px;padding-bottom: 12px;}
.login-form__btn-google:after {display: none;}
.login-form__btn-google {margin-top: 4px;}
input[type="email"] {
  line-height: 30px;
  padding: 0 10px;
  width: 100%;
  font-size: 11.5px;
  color: #999;
  margin-bottom: 10px;
}
</style>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>
  <div class="logins" class="row">

    <div class="contents">
      <h1><?php echo $heading_title; ?></h1>
      <p><?php echo $text_email; ?></p>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div>
          <?php if ($error_warning) { ?>
          <div class="error"><?php echo $error_warning; ?></div>
          <?php } ?>
          <input type="email" name="email" value="" placeholder="<?php echo $entry_email; ?>" minlength="3" required/>
        </div>
        <div>
          <input type="submit" value="<?php echo $button_continue; ?>" class="button" />
        </div>
        <div>
          <?php echo $content_top; ?>
        </div>
      </form>
      </div>
    </div>
</div>
<?php echo $footer; ?>
