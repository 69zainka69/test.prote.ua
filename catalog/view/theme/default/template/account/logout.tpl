<?php echo $header; ?>
<style>
.breadcrumb{margin-bottom:20px;}
h1{color:#00adee!important;font-size:18px;font-weight:normal;margin-bottom:7px;border-bottom:2px solid #00adee;padding-bottom:6px;margin-bottom:16px;}
.contents{width:300px;padding:17px 25px 25px;}
.logins{display:flex;justify-content:center;margin-bottom:6%;}
.logins p{color: #999;font-family: 'Trebuchet MS';font-size: 12px;line-height:13px;padding-bottom: 12px;}
</style>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="logins" class="row">
    <div class="contents">
      <div>
        <h1><?php echo $heading_title; ?></h1>
        <?php echo $text_message; ?>
      </div>      
      <div class="buttons">
        <a href="<?php echo $continue; ?>" class="button" style="display:block;text-align: center;"><?php echo $button_continue; ?></a>
      </div>
      <?php echo $content_top; ?>
    </div>
  </div>
</div>
<?php echo $footer; ?>