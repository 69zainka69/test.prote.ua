<?php echo $header; ?>
<style>
h1{font-size:36px;color:#00adee;font-weight:normal;display:block;margin-bottom:20px;line-height:40px;}
#content{max-width:560px;margin:auto;margin-bottom:7%;}
.dflex{display:flex;justify-content:center;}
.text-center{text-align:center;}
</style>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row dflex">
    <div id="content" class="content404">
      <h1 class="text-center"><?php echo $heading_title; ?></h1>
      <?php if(isset($text_error)){ ?>
        <p style="font-size:16px; line-height:26px;"><?php echo $text_error; ?></p>
      <?php } else { ?>
      <?php include(DIR_APPLICATION.'/view/theme/default/template/error/error_search.tpl');?>
      <?php } ?>
    </div>
  </div>
</div>
<?php echo $footer; ?>