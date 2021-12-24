<?php echo $header; ?>
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/articles.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/pagination.css');?>
.breadcrumb{margin-bottom: 20px;}
#articles{margin-top:3px;}
h1{font-size:23px;color:#00adee;font-weight:normal;display:block;vertical-align: middle;padding:3px 0 10px 12px;border-bottom:3px solid #00adee;}
#articles .content{background:none;margin-bottom:30px;}
#articles .content > div{border-bottom:3px solid #00aff2;padding-bottom:75px;}
#articles .content .descr{max-height:36px;overflow:hidden;}
@media(max-width:1300px){
#articles{display:block;}
}
@media (max-width:991px){
#articles .content > div{width:33.33%;}
}
@media (max-width:575px){
#articles .content > div{width:100%;}
#articles .content .name{min-height:auto;}
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

    <div id="articles">
        <h1><?php echo $heading_title; ?></h1>
        <div class="content">
            <?php foreach ($all_articles as $articles) { ?>
                <div class="article">
                    <div class="img"><a href="<?php echo $articles['view']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $articles['image']; ?>" title="<?php echo $articles['title']; ?>" alt="<?php echo $articles['title']; ?>" class="img-responsive"></a></div>
                    <?php /*<div class="date"><?php echo $articles['date_added']; ?></div>*/ ?>
                    <div class="name"><a href="<?php echo $articles['view']; ?>"><?php echo $articles['title']; ?></a></div>
                    <div class="descr"><?php echo $articles['description']; ?></div>
                </div>
            <?php } ?>
        </div>
        <div id="paginate"><?php echo $pagination; ?></div>
    </div>

</div>
</div>
<?php echo $footer; ?>