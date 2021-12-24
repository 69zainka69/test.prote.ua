<?php echo $header; ?>
<style>
h1{font-size:23px;color:#00adee;font-weight:normal;display:block;vertical-align: middle;padding:5px 0 10px 15px;border-bottom: 4px solid #00adee;margin-bottom:20px;}
#content{width:100%;}
.newslist{display:flex;flex-direction:row;flex-wrap:wrap;justify-content:space-between;}
.news{width:32.5%;font-size:13px;font-family:'Trebuchet MS';margin-bottom:40px;max-width:400px;}
.news img{width:100%;}
.news .title a{font-size:13px;color:#00aff2;text-decoration:underline;line-height:16px;padding-top:20px;display:block;}
@media (max-width:575px){
.newslist{flex-direction:column;padding:0 10px;}
.news{width:auto;}
}
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/pagination.css');?>
</style>
<div class="container">
  <div class="row1">
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
  <div class="row"><?php //echo $column_left; ?>
    <div id="content"><?php //echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <div class="newslist">
        <?php foreach ($all_news as $news) { ?>
          <div class="news">
           <div class="thumb"><?php if($news['image']) { ?><a href="<?php echo $news['view']; ?>" title="<?php echo $news['title']; ?>"><img src="<?php echo $news['image']; ?>" alt="<?php echo $news['title']; ?>"/></a><?php } ?></div>
           <div class="title"><a href="<?php echo $news['view']; ?>" title="<?php echo $news['title']; ?>"><?php echo $news['title']; ?></a></div>
           <!-- <div class="date"><?php //echo $news['date_added']; ?></div> -->
           <div class="descr"><?php echo $news['description']; ?></div>
          </div>
        <?php } ?>
      </div>
      <div id="paginate"><?php echo $pagination; ?></div>
    </div>
    </div>
</div>
<?php echo $footer; ?> 