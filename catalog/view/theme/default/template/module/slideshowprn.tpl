<div class="row carouselback hidden-xs hidden-sm">
<div class="col-sm-6 nopadding" style="padding-left:30px;">
  <div class="panel-header">
  <p class="h3"><img src="/catalog/view/theme/default/image/ipodbor.png" alt="Подбор по принтеру">&nbsp;&nbsp;&nbsp;<span style="font-weight: 600;"><?=$text_searchcat?></span></p>
  </div>
  <div id="selectbrand-home" class="input-group">
    <select name="prnbrand" id="prnbrand" class="form-control input-lg" >
        <option value="" disabled selected><?=$text_selbrand?></option>
        <?php foreach ($brands as $key=>$value) {  
            echo '<option value="' . $value['brand'] . '">' . $value['brand'] . '</option>';              	
        }?>        
    </select>
<!--    
    <span class="input-group-btn">
      <button type="button" id="prnbrandbtn" class="btn btn-default btn-lg"><i class="fa fa-arrow-down"></i></button>
    </span>
-->    
  </div>
  <br/>
  
  <div id="selectprn" class="input-group">
    <div id="prnlist-home">
    <select name="prnprinter" id="prnprinter" class="form-control input-lg" >
        <option value="" disabled selected><?=$text_selmodel?></option>
    </select>
    </div>
<!--     
    <span class="input-group-btn">
      <button type="button" id="selectprnbtn" class="btn btn-default btn-lg"><i class="fa fa-arrow-down"></i></button>
    </span>
-->    
  </div>  

  <div class="text-left" style="margin-top: 30px;">    
    <button type="button" id="button-filter" class="btn btn-primary btn-blue-shadow" style="font-size: 18px; font-weight: 600; padding: 10px 20px; border: 0;"><?=$text_select?>!</button>
  </div>
  
</div>
<script>
   $('#selectbrand-home').change(function() {  
      brandval=$('#selectbrand-home option:selected').text();
            
      $.get( "/index.php?route=product/prnjson/", { brand : brandval, langid: <?=$lang?>, language: '<?php echo $text_selmodel;?>' } ).done (function( data ) {
          $( "#prnlist-home" ).html( data );      
      }); 
      
   });

   $('#button-filter').click(function() { 
       window.location.href = '/search?prn=' + $('#prnprinter option:selected').val() + '&cat_id='+$('#prnprinter option:selected').data('cat');
   });
   //?br='+$('#selectbrand option:selected').text().toLowerCase()+'
</script>


<div class="col-sm-6 nopadding">

<div id="slideshow<?php echo $module; ?>" class="owl-carousel" style="opacity: 1;">
  <?php foreach ($banners as $banner) { ?>
  <div class="item">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img class="banner-image owl-lazy" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
    <?php } else { ?>
    <img class="banner-image owl-lazy" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
</div>
</div>
<script><!--
jQuery(document).ready(function($) {
$('#slideshow<?php echo $module; ?>').owlCarousel({
	items: 6,
	autoPlay: 3000,
	singleItem: true,
	navigation: false,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: true,
        // lazyLoad: true,
});
});
--></script>