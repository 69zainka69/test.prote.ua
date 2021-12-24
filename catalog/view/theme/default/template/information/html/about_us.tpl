<?php echo $header; ?>
<div class="container">
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
<style>
.about {width:100%;padding-left:15px;padding-right:15px;margin-bottom:70px;}
.about a{color:#00adee;}
.about a:hover{color:#fd9710;}
h1{color:#00adee;font-size:24px;font-weight:normal;margin-bottom:20px;}
.about .decription{font-family:'Trebuchet MS';font-size:15px;padding:12px 0 0;color:#636363;line-height:22px;}
.about .decription .hi{display:inline-block;padding-bottom:3px;}
.about .decription p{padding-top:25px;}
.df1{padding-top:22px;margin-bottom:75px;}
.df1{flex-wrap:wrap;}
.df1 .item{width:25%;text-align:center;padding:24px 20px 12px;}
.df1 .item:nth-child(1){padding-right:55px;padding-left:55px;}
.df1 .item:nth-child(2){padding-right:50px;padding-left:50px;}
.df1 .svg{height:105px;}
.df1 svg{height:100%;}
.df1 .title{font-size:15px;padding-top:27px;margin-bottom:27px;font-family:'Trebuchet MS';color:#636363;}
.df1 .title span{font-size:11.5px;color:#999;font-family:'Open Sans',sans-serif;line-height:13px;display:block;padding-top:15px;}
@media (max-width: 992px){
.about .df1 .item{width:50%;padding:24px 5px 12px;}
}
@media (max-width: 576px) {/*320*/
.about .df1 .item{width:100%}
}
</style>
  <div class="row">
    <div id="content" class="about">
      <h1><?php echo $heading_title; ?></h1>
      <div class="decription">
        <?php echo $text_description; ?>
      </div>
      <div class="dflex df1">
        <div class="item">
          <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-raketa.svg');?></div>
          <div class="title"><?php echo $text_desc_item1; ?></div>
        </div>
        <div class="item">
          <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-sklad.svg');?></div>
          <div class="title"><?php echo $text_desc_item2; ?></div>
        </div>
        <div class="item">
          <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-dostavka.svg');?></div>
          <div class="title"><?php echo $text_desc_item3; ?></div>
        </div>
        <div class="item">
          <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-navchannia.svg');?></div>
          <div class="title"><?php echo $text_desc_item4; ?></div>
        </div>
      </div>
      <?php include(DIR_APPLICATION.'view/theme/default/template/information/html/about_us_bottom.tpl'); ?>
    </div>
  </div>
</div>
<?php echo $footer; ?>