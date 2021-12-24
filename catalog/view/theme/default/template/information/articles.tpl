<?php echo $header; ?>
<style>
#content{width:100%;}
.breadcrumb {margin-bottom: 20px;}
.title{font-size:23px;color:#00adee;font-weight:normal;display:block;margin-bottom:20px;font-family:'Open Sans',sans-serif;    line-height:28px;border-bottom:3px solid #00adee;width:100%;}
h1{font-size:23px;color:#00adee;font-weight:normal;display:block;margin-bottom:20px;font-family:'Open Sans',sans-serif;    line-height:28px;}
h2{font-size:18px;color:#00adee;font-weight:normal;display:block;margin:20px 10px 10px;font-family:'Open Sans',sans-serif;    line-height:28px;}
#content a{color:#fd9710;}
#content a:hover{color:#00adee;}
.desсription{display:flex;flex-direction:row;margin-bottom:30px;}
.desc{margin-right:3%;color:#999;font-size:13px;font-family:'Trebuchet MS';line-height:17px;}
.thumb{margin-right:3%;text-align:center;}
.date{font-size:12px;color:#999;font-family:'Trebuchet MS';text-align:center;margin:30px 0;}
@media (max-width: 992px){
.desсription{flex-direction:column}
}

</style>

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
  <div class="row">
    <div class="title"><?php echo $data['text_articles']; ?></div>
    <div id="content">
      <div class="desсription">
        <div class="thumb">
            <?php if ($image) { ?>
                <img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $image; ?>" alt="<?php echo $heading_title; ?>" />
            <?php } ?>
     
        </div>
        <div class="desc">
          <h1><?php echo $heading_title; ?></h1>
          <div class=""><?php echo $description; ?></div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php echo $footer; ?>