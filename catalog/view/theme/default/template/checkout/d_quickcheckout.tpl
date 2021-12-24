<?php echo $header; ?>
<style>

h1{font-size:23px;color:#00adee;font-weight:normal;display: inline-block;vertical-align: middle;border-bottom:2px solid #00adee;margin-bottom:24px;padding-bottom:24px;width:100%;padding-top:15px;padding-left: 15px;}

</style>
<style>
.panel-body, #payment_view .well{
    color: #999;
    line-height: 14px;
    display: block;
    margin-top: 5px;
    margin-bottom: 5px;
    font-family: 'Trebuchet MS';
    font-size: 12px;
}
#payment_view{display:block!important;}
#payment_view h2{
  color: #00adee;
  font-size: 14px;
  padding-bottom: 5px;
  font-weight: normal;
}

</style>
<div class="container" id="container">
  <div class="row">
  <ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
    <?php $k=0; foreach ($breadcrumbs as $breadcrumb) { ?>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <?php if ($k<count($breadcrumbs)-1) { ?> 
           <a itemprop="item" href="<?php echo $breadcrumb['href']; ?>"><span itemprop="name"><?php echo $breadcrumb['text']; ?></span></a>
        <?php } else { ?>          
          <a itemprop="item" onclick="return false;" href="<?php echo $breadcrumb['href']; ?>" style="cursor:default;">
              <span itemprop="name" id="lastbreadcrumb"><?php echo $breadcrumb['text']; ?></span>
            </a>
        <?php } ?>
          <meta itemprop="position" content="<?=++$k?>">
    </li>
    <?php } ?>
  </ul>
  </div>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row">

      <h1><?php echo $heading_title; ?></h1>
    
    <div id="content" class="content"><?php //echo $content_top; ?>

<!-- Quick Checkout v4.0 by Dreamvention.com checkout/quickcheckout.tpl -->
  <?php echo $d_quickcheckout; ?>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>