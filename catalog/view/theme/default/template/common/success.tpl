<?php echo $header; ?>
<div class="container">
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
<style>
h1{color:#fd9710;font-size:36px;font-weight:normal;margin-bottom:33px;}
.successs.dflex{justify-content:center;flex-wrap:wrap;}
.cols1{width:20%;padding-top:1%;}
.cols2{width:50%;}
.message {color:#636363;font-size:15px;line-height:22px;}
.message span{color:#fd9710;}
.message div{padding-top:30px;font-size:28px;color:#999;}
.successs.dflex{
  margin: 7% 0 16.5%;
}
.df2 .i2{border-left:1px solid #f8f7f8;}
@media(max-width:992px){
.cols1{width:40%;}
.cols2{width:60%;}
h1{line-height:40px;text-align:center;}
}
@media(max-width:576px){
.cols1{width:100%;text-align:center;}
.cols1 svg{width:40%;}
.cols2{width:100%;} 
}
</style>  
    <div id="content"><?php echo $content_top; ?>
      
      <div class="successs dflex">
         <div class="cols1">
            <?php echo file_get_contents(DIR_IMAGE.'/ico/checkout/thankyou.svg');?>
         </div>
         <div class="cols2">
            <h1><?php echo $heading_title; ?></h1>
            <div class="message"><?php echo $text_message; ?></div>
         </div>

      </div>      
      <?php include(DIR_APPLICATION.'view/theme/default/template/information/html/about_us_bottom.tpl'); ?>
    </div>
</div>
<?php if(isset($purchase)){ ?>
    <script>
      $(document).ready(function() {
      gtag('event','purchase',{<?php echo $purchase; ?>});
      });
    </script>
<?php } ?>
<?php if(isset($google_reviews_products)){ ?>

<script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>

<script>
  window.renderOptIn = function() {
    window.gapi.load('surveyoptin', function() {
      window.gapi.surveyoptin.render(
        {
          // REQUIRED FIELDS
          "merchant_id": 127130486,
          "order_id": "<?php echo $order_id; ?>",
          "email": "<?php echo $email; ?>",
          "delivery_country": "uk",
          "estimated_delivery_date": "<?php echo date('Y-m-d',strtotime('+3 day')); ?>",

          // OPTIONAL FIELDS
          //"products": [<?php echo $google_reviews_products;?>]
        });
    });
  }
</script>
<?php } ?>
<?php echo $footer; ?>