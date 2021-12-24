<svg style="display:none;height:0;width:0;">
<style>
#maincontent 
.dflex{ display:flex;flex-wrap: wrap;}
.dflex .item{
  width:20%;
  display:flex;
  flex-wrap: wrap;
  border:1px solid #f7f6f7;
}
.dflex .item:hover{border-color:#fd9d1f;}

.dflex .item .thumb,
.dflex .item .name{width:50%;}
.dflex .item .thumb{text-align: center;}
.dflex .item .name{padding-top:40px;padding-right:10px;}
.dflex .item .name a{color:#00aff2;font-size:13px;font-family:'Trebuchet MS';line-height:20px}
.dflex .item:hover .name a{color:#fd9d1f;-webkit-transition-duration:0.2s;-o-transition-duration:0.2s;-moz-transition-duration:0.2s;transition-duration:0.2s;}
.dflex .item .thumb img{margin:10px 0;}
.dflex .item:hover .thumb img{filter:none;}
.dflex .item .c_cats{width:100%;padding-left:34px;padding-bottom:25px;}
.dflex .item .c_cats a{color:#333;font-size:13px;font-family:'Trebuchet MS';line-height:22px;display:block;}
.dflex .item .c_cats a:hover{color:#fd9d1f;text-decoration:underline;}
.description{font-size:12px;color:#333;line-height:15px;font-family:'Trebuchet MS';}
.description h2{margin:20px 0 10px; }
.description p{margin-bottom:10px;}
.description a{color:#00adee;}
.description a:hover{color:#fd9710;}
.description ul{margin-bottom:15px; }
.description li{list-style:disc; margin-left: 30px;}
.megaprod {display: none;}
@media (max-width:1299px){.dflex .item{width:25%;}}
@media (max-width: 992px){.dflex .item{width:33%;}}
@media (max-width: 768px){/*540*/.dflex .item{width:50%;}}
@media (max-width: 576px){/*320*/.dflex .item{width:100%;}}
</style>
</svg>

<div id="maincontent" class="container">
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

  <div class="row rowh1">
    <div class="h1">
      <h1><?php echo $heading_title; ?></h1>
    </div>
  </div>

  <div class="row">
    <div id="content" class="container">
      <?php if ($categories) { ?>
        <div class="cats dflex">
          <?php foreach ($categories as $category) { ?>
            <div class="item">
              <div class="thumb">
                <a href="<?php echo $category['href']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>"></a>
              </div>
              <div class="name">
                <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
              </div>
              <div class="c_cats">
                <?php if($category['children']){ ?> 
                  <?php foreach ($category['children'] as $child) { ?>
                  <a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?> ></a>
                  <?php } ?>  
                <?php } else { ?>
                  <a href="<?php echo $category['href']; ?>"><?php echo $text_view_all; ?> ></a>
                <?php } ?>
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
      <div class="description">
        <!--seo_text_start-->
        <?php echo $description; ?>        
        <!--seo_text_end-->
      </div>
      <?php if ($interlink) { ?>
      <svg style="display:none;height:0;width:0;">
        <style>
          .megaprod {padding-top:15px;border-top:1px solid #252525;margin-top:25px;}
          .megaprod .box-heading{background:#bee9f9;line-height:40px;color:#333;font-family:'Trebuchet MS';font-weight:bold;font-size:16px;position:relative;padding-left:50px;margin-bottom:15px;}
          .megaprod .svg{position:absolute;top:7px;left:11px;}
          .megaprod li a{padding-left:4px;color:#999;font-size:13px;font-family:'Trebuchet MS';text-decoration:none;line-height:22px;}
          .megaprod li a:hover{color:#333;text-decoration:underline;}
        </style>
      </svg>
            <?php 

            $interlinks='<div class="megaprod"><div class="box-heading"><span class="svg">'. file_get_contents(DIR_IMAGE.'/ico/popular-products.svg').'</span>'. $text_populairprod . '</div><div class="box-content">' . $interlink . '</div></div>';
            echo $interlinks;
            
      } ?>    
    </div>
  </div>
</div> 
