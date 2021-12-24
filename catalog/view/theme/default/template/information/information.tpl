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
.row.info{display:flex;justify-content:center;width:100%}
h1{color:#fd9710;font-size:18px;font-weight:normal;margin-bottom:20px;font-family:'Trebuchet MS';padding-left:81px;line-height:40px;position:relative;}
#content{max-width:650px;}
.decription{border-top:1px solid #cecece;padding:20px 23px;color:#999;font-size:12px;line-height:13px;}
.decription h4,.decription b{color:#333;font-size:15px;font-weight:normal;display:inline-block;}
.decription p{padding:7px 0 12px;}
h1 .svg{position: absolute;left:22px;}
h1 .svg svg{width:43px;}
</style>
<div class="row info">
  <div id="content"><?php if(isset($content_top)){ echo $content_top; } ?>
    <h1><span class="svg"><?php echo $svg;?></span><?php echo $heading_title; ?></h1>
    <div class="decription">
    <?php echo $description; ?>
    </div>
    <?php if(isset($content_bottom)){ echo $content_bottom; } ?></div>

  </div>
</div>
<?php echo $footer; ?>