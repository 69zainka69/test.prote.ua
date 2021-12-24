<div id="banner<?php echo $module; ?>" class="owl-carousel">
  <?php foreach ($banners as $banner) { ?>
  <div class="item">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img data-src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive lazy" /></a>
    <?php } else { ?>
    <img data-src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive lazy" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
<script><!--
$('#banner<?php echo $module; ?>').owlCarousel({
	items: 6,
	autoPlay: 3000,
	singleItem: true,
	navigation: false,
	pagination: false,
	transitionStyle: 'fade'
});
--></script>
