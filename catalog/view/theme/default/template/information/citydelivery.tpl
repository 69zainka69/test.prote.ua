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
    <div class="row"><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
        <h1><?php echo $heading_title; ?></h1>
        <img src="/image/delivery4ukraine/callme-banner.png" alt="<?php echo $heading_title; ?>"/>
        <?php if ($image) { ?>
            <div class="text-center">
               <img src="<?php echo $image; ?>" alt="<?php echo $heading_title; ?>" />
            </div>
        <?php } ?>
        <?php echo $description; ?>
        <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 