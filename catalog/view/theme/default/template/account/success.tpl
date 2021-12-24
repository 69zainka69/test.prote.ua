<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
<style>
    h1{font-size:36px;color:#fd9710;font-weight:normal;margin-bottom:32px;}
    #content{margin-top:7%;}
    .dflex2{display:flex;}
    #content svg{max-width:100%;}
    #content .dflex{margin-top:15%;}
    #content .dflex2>div{width:40%;}
    .c1{text-align:right;padding-right:10%;padding-right:4.6%;padding-top:12px;}
    .c2{padding-left:0.6%;}
    #content p{font-family:'Trebuchet MS';font-size:15px;color:#636363;line-height:23px;margin-bottom:23px;}
    .button+.button{margin-left:25px;}
    @media(max-width:1299px){
      #content .dflex2 .c2{width:50%;}
    }
    @media(max-width:992px){
     #content .dflex2 .c1{width:30%;} 
     #content .dflex2 .c2{width:70%;} 
     h1{font-size:23px;}
     #content p{font-size:13px;}
     .button+.button{margin-left:0;}
    }
    @media(max-width:576px){
      #content .dflex2{flex-direction:column;}
      #content .dflex2 .c1{width:100%;text-align:center;}
      #content .dflex2 .c2{width:100%;}
      .button+.button{margin-top:15px;}
    }
  </style>
  <div id="content">
    <div class="dflex2">
      <div class="svg c1">
        <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/thankyou.svg');?></span>
      </div>
      <div class="c2">
          <h1><?php echo $heading_title; ?></h1>
          <p><?php echo $text_message; ?></p>
        <div class="buttons">
          <a href="<?php echo $account; ?>" class="button blue"><?php echo $text_go_account; ?></a>
          <a href="/<?php //echo $cart; ?>" class="button"><?php echo $text_go_cart; ?></a>
        </div>
      </div>
    </div>      
    <?php include(DIR_APPLICATION.'view/theme/default/template/information/html/about_us_bottom.tpl'); ?>
  </div>
</div>
<?php echo $footer; ?>