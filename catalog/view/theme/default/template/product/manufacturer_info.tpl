<?php echo $header; ?>
<svg style="display:none;height:0;width:0;">
<style>
.breadcrumb{margin-bottom:20px;}
#maincontent .row{flex-wrap:nowrap;}
#content{flex-basis:auto;width:100%;}
h1{font-size:23px;color:#00adee;font-weight:normal;display: inline-block;vertical-align: middle;}
.rowh1{justify-content:space-between;align-items: center;margin-bottom:20px;}
.more{padding:55px 0 60px;}
</style>
</svg>


<?php //шаблон списка товаров ?>
<svg style="display:none;height:0;width:0;">
<style>
h1{padding-left:15px;}
h2{color:#333333;font-size:18px;}
.j-center{justify-content: center;}
#maincontent #column-left{width: 247px;flex-basis:247px;min-width: 247px;padding:0 7px 0 14px;}
.rowh1{border-bottom:3px solid #00adee;}
.h1{padding: 5px 0 10px 15px;display:flex;    align-items: center;}
.h1 svg{  width:40px;height:45px;}
.h1 .svg{ display: inline-block;vertical-align: middle;}

.description{color:#333; line-height: 16px; padding:9px 0 10px;font-size: 13px;padding-left:55px;}
.description h2{margin:20px 0 10px; }
.description p{margin-bottom:10px;}
.description a{color:#00adee;}
.description a:hover{color:#fd9710;}
.description ul{margin-bottom:15px; }
.description li{list-style:disc; margin-left: 30px;}

<?php echo file_get_contents(DIR_APPLICATION.'/view/js/select.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/products.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/pagination.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'view/js/tooltip.css'); ?>
.select__gap{padding-bottom:0;}
.products>div{width:25%;}
.filter{display:none;
background: #fd9710;
padding:12px 12px 11px;
cursor:pointer;
}
.filter_close{display:none;margin-bottom:10px;}
.bf-panel-wrapper{opacity:1;}
.ico_attr{position: absolute; bottom:0; left: 23px; }
.ico_attr .ico{width: 64px; height: 64px; background: #A1E0EA; border-radius: 100%; padding: 8px 5px; text-align:center; }
.ico_attr .ico+.ico{margin-left: 8px; }
.ico_attr .ico img {width: 27px;margin-bottom: 6px;}
.ico_attr .ico div{line-height: 7px; color:#fff; font-size: 6px; }
.ico.attr_17873{padding-top: 10px; }
.ico.attr_17873 img{margin-bottom: 3px; }
.ico.attr_17870,.ico.attr_17867{background: #FD9710; }
.ico.attr_17867 img{width: 30px; margin-bottom: 3px; }
.ico.attr_17870 img{width: 21px; margin-bottom: 2px; }



/*.search-all{font-size:16px;font-weight:bold;color:#333;
  padding:8px 0;border-bottom:1px solid #333;margin-top:15px;margin-bottom:20px;cursor:pointer;position:relative;}*/
#category-list li a{display:block; color:#333;font-size:13px;cursor:pointer;line-height:18px;padding:10px 10px 10px 15px;}
#category-list li a:hover,#category-list li.active a{background: #fd9710;color:#fff;}

.bf-attr-header{font-size: 15px; color: #333; padding: 0 0 16px; border-bottom: 1px solid #333; margin-top: 5px; margin-bottom: 11px; cursor: pointer; position: relative; }
.bf-arrow:before{position:absolute;bottom:22px;right:5px;width:8px;height:8px;border-bottom:1px solid #333;border-right:1px solid #333;content:""; -webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:rotate(45deg);transform:rotate(45deg); -webkit-transition:border-color 0.2s ease;-moz-transition:border-color 0.2s ease;-ms-transition:border-color 0.2s ease;-o-transition:border-color 0.2s ease;transition:border-color 0.2s ease; -webkit-transition:all 400ms; -moz-transition:all 400ms; -o-transition:all 400ms; transition:all 400ms; }

#column-left .thumb{padding:77px 0 80px;}
#column-left .thumb img{max-width: 140px;}
.category_name{color: #00adee; font-size: 22px; margin-bottom: 10px;padding-left:55px;}
.sort_line{display:none;    border-bottom: 3px solid #00adee;}
    

@media(max-width:1200px){
.products>div{width:33.33%;}
}
@media (max-width:991px){
.products>div{width:50%;}
#column-left .thumb {padding: 16px 0 44px;}
.description {padding: 0px 0 10px; }
}
@media (max-width:768px){
  #column-left{display:flex;flex-wrap: wrap;flex-direction: column;}
  .filter{display:block; position: absolute; top: 5px;right: 0; }
  .rowh1{align-items:flex-start;position: relative;border-bottom:none;margin-bottom: 34px;}
  .h1{margin-right: 50px;padding-left:0;}
  .h1 h1{font-size:19px;}
  .mcont{align-items:center;}
  .filter_close{display:block;font-size:20px;color:#FD9710;position:relative;text-align:center;cursor:pointer;}
  .filter_close:before,.filter_close:after{content:'';width:20px;height:2px;background:#FD9710;position:absolute;transform: rotate(-45deg);
    transition: transform 2s;left:30px;top:10px;}
  .filter_close:after{transform: rotate(45deg);
    transition: transform 2s;}
  .bf-panel-wrapper{opacity:0;height:0;}
  .bf-panel-wrapper.open{opacity:1;height:100%;order:-10;}
  .bf-attr-block{height:0;}
  .bf-panel-wrapper.open .bf-attr-block{height:100%;}
  #maincontent #column-left{flex-basis:auto;width:100%;flex-wrap: nowrap;padding: 0 7px 0 0;}
  .bf-attr-content{max-height: 434px;overflow: scroll;}
  .filter_result{flex-direction:column;}
  .sort{display:none;}
  #column-left .thumb {display:none;}
  .bf-attr-header{color: #00aeef; font-size:23px;border-bottom:none;}
  .bf-arrow:before{display:none;}
  #category-list li a {font-size:20px;    padding: 16px 10px 16px 22px;}
  .description {display:none; }
  #content{padding: 30px 0;}
  .sort_line{display:block;margin-bottom:40px;margin-top:5px;}
  .sort_line .sort{display:block;}
}

@media (max-width:575px){
.products>div{width:50%;}
.select__gap{margin-top:0;}
.bf-attr-header{font-size:18px;}
#category-list li a {font-size:15px;    padding:10px 10px 10px 15px;}
.bf-attr-header{padding-bottom: 0}
.bf-attr-content{max-height:316px;}
}


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
      <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/search/poshuk-icon.svg');?></span>
      <h1><?php echo $heading_title; ?></h1>
    </div>
    <div class="filter"><img src="image/ico/filter/filter.svg" alt="filter" title="filter" ></div>
    <div class="sort">
      <select id="input-sort" class="sel" data-text="<?php echo $text_sort; ?>" onchange="location = this.value;">
        <?php foreach ($sorts as $sortss) { ?>
        <?php if ($sortss['value'] == $sort . '-' . $order) { ?>
        <option value="<?php echo $sortss['href']; ?>" data-txt="<?php echo $sortss['value']; ?>===<?php echo $sort . '-' . $order; ?>" selected="selected"><?php echo $sortss['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $sortss['href']; ?>"><?php echo $sortss['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
     </div>
  </div>
  <div class="row mcont">

    <div id="column-left" class="bf-panel-wrapper">
      <?php if($thumb){ ?>
        <div class="thumb"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>"></div>
      <?php } ?>
      <?php if($categories){ ?>
      <div class="bf-attr-header"><?php echo $text_in_cat; ?><span class="bf-arrow open" style="background-position: 50% -153px;">&nbsp;</span></div>
      <div class="bf-attr-content">
        <ul id="category-list" class="">
          <?php foreach ($categories as $category) { ?>           
            <?php if ($category['category_id'] == $category_id) { ?>
                <li class="active"><a href="<?php echo $category['href']; ?>" title="<?php echo $category['name'] ?>"><?php echo $category['name']; ?></a></li>
            <?php } else { ?>
                <li><a href="<?php echo $category['href']; ?>" title="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
          <?php } ?>
        </ul>  
      </div>
      <?php } ?>
    </div>

    <div id="content" class="container">
      <div class="sort_line">
        <div class="sort">
        <select id="input-sort" class="sel" data-text="<?php echo $text_sort; ?>" onchange="location = this.value;">
          <?php foreach ($sorts as $sortss) { ?>
          <?php if ($sortss['value'] == $sort . '-' . $order) { ?>
          <option value="<?php echo $sortss['href']; ?>" data-txt="<?php echo $sortss['value']; ?>===<?php echo $sort . '-' . $order; ?>" selected="selected"><?php echo $sortss['text']; ?></option>
          <?php } else { ?>
          <option value="<?php echo $sortss['href']; ?>"><?php echo $sortss['text']; ?></option>
          <?php } ?>
          <?php } ?>
        </select>
       </div>
     </div>
      <?php if ($description) { ?>
      <div class="description"><?php echo $description; ?></div>
      <?php } ?>
        <?php if ($products) { ?>
          <div class="category_name"><?php echo $category_info['name']; ?> </div>
          <div class="row">
            <div class="products" id="prodlines">
              <?php foreach ($products as $key => $product) { ?>
                <div class="product-layout product<?php if($product['ifexist']==3) { ?> non<?php } ?>" data-prodid="<?php echo $product['product_id']; ?>" data-position="<?php echo $key; ?>">
    	           <?php if ($product['special'] || $product['action']) { ?>
                    <div class="dar"  <?php if(isset($product['action'][0]['short_description'])){ ?> data-tooltip="<?php echo $product['action'][0]['short_description']; ?>" <? } ?>>
                    <img src="image/ico/favicon_prote_16x16.svg" data-original="image/ico/action/label-fire-action.svg"  alt="<?php echo $text_action; ?>" title="<?php echo $text_action; ?>"/>
                    <div><?php echo $text_action; ?></div>
                    </div>
                  <?php } ?>
                  <div class="image"><a href="<?php echo $product['href']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                    <?php if($product['attributs']) { ?>
                    <div class="ico_attr dflex">
                      <?php foreach ($product['attributs'] as $key => $attribut) { ?>
                        <div class="ico attr_<?php echo $key; ?>"><img src="<?php echo $attribut['image']; ?>" alt="<?php echo $attribut['text']; ?>" title="<?php echo $attribut['text']; ?>"><div><?php echo $attribut['text']; ?></div></div>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                  <?php if($product['ifexist']<>3) { ?>
                  <?php switch ($product['ifexist']) {
                      case 0: ?>
                         <p class="ifexist ico0"><?php echo $text_exist; ?></p>
                     <?php break; case 1: ?>
                         <p class="ifexist ico1"><?php echo $text_preorder; ?></p>
                     <?php break; case 2: ?>
                         <p class="ifwait ico2"><?php echo $text_wait; ?></p>
                     <?php break; default: ?>
                     <?php } ?>
                  <?php } else { ?>
                      <p class="ifexist ico3"><?php echo $text_noexist; ?></p>
                  <?php } ?>
                  <div class="ndesc">
                    <a class="name" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                  </div>
                  <div class="buttons">
                    <?php if ($product['price']) { ?>
                    <p class="price"><?php if (!$product['special']) { ?><?php echo $product['price']; ?><?php } else { ?>
                      <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                      <?php } ?></p>
                    <?php } ?>

                      <?php if($product['minimum']>1) { ?>
                        <div class="product_min list block"><?php echo $text_minimum.$product['minimum'];?></div>
                      <?php } ?>
                      <?php if ($product['ifexist']!=2) { ?>
                        <div class="button-row">
                          <?php if ($ordercallback_use_module && $ordercallback_as_order || 1) { ?>
                              <a href="#ordercallback-modal" data-modal="ordercallback-form" class="oneclick" onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special_float"] ? $product["special_float"] : $product["price_float"]); ?>','<?php echo $product['minimum']; ?>'); return false;"><?php echo $button_cartone; ?></a>
                          <?php } ?>
                          <a href="#basketinfo-modal1" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
                        </div>
                      <?php } ?>
                  </div>
                </div>
              <?php } ?>
            </div>
            
          </div>

          <div class="row bottom_row">
            <div id="paginate"><?php echo $pagination; ?></div>
            <select id="input-limit" class="sel" data-text="<?php echo $text_limit; ?>" onchange="location = this.value;">
              <?php foreach ($limits as $limits) { ?>
              <?php if ($limits['value'] == $limit) { ?>
              <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>

            <? if ($page==1) { ?>       
              <?php if (count($products)>=$limit) { ?>
                  <script>
                    var curp=1;
                    var eol =0;
                    var count_pages = <?php echo $count_pages; ?>;
                    function addPage() {
                        if (eol==1) return false; 
                        if (curp>=count_pages) return false; 
                        window.onscroll = null;
                        $('#prodlines').append('<div class="preload"><img src="image/ico/loading.svg"></div>');
                        $.ajax({
                            type: "GET",                  
                            url: window.location,
                            data: { page: ++window.curp },
                            async: true,
                            success: function(data) {
                                if (!$(data).find('#prodlines').html()) {
                                  window.eol=1 
                                } else { 
                                   a=$('#prodlines')
                                   b=$(data).find('#prodlines').html();
                                   /*if (a.find('.product-layout').first().hasClass('product-grid')) {                         
                                      b=b.replace(/product-list/g,'product-grid col-lg-4 col-md-4 col-sm-6' ) 
                                   } */
                                   $('#prodlines').append(b);
                                   $('#paginate').css( "display", "none");
                                   $('#paginate li').each(function(i,e) {
                                       if ($(e).html().indexOf('page='+window.curp)>0 && $(e).html().indexOf('forward')==-1) {
                                          $(e).html('<span>'+window.curp+'</span>')
                                          $(e).addClass('active'); 
                                       }
                                       window.onscroll =  vverh;                     
                                    });   
                                    $('img[src="image/ico/favicon_prote_16x16.svg"]').lazyload({
                                         threshold : 500,
                                         skip_invisible:false,
                                        effect : "fadeIn"
                                    });
                                    $(window).scrollTop($(window).scrollTop()+1);
                                    $(window).scrollTop($(window).scrollTop()-1);                      
                                 }  
                                 $('.preload').remove();
                                 $('#showall').hide() 
                            }
                        });
                        return false;
                    }
                    function vverh(event) {
                      if ((window.pageYOffset)>($('.description').offset().top-$( window ).height())) {
                          event.preventDefault();                
                          addPage();                   
                      }    
                                  
                    }
                  </script>
                <div class="row" style="margin-bottom: 20px;" id="showall">
                  <div class="col-sm-12 text-center">
                     <button class="button" onclick="addPage(); return false;"><?php echo $text_show_more; ?></button>
                  </div>
                </div>
            <?php } ?>
            <? } ?>

          </div>

          <? if ($page==1 && isset($description)) { ?>       
          
          <? } ?>  
        <?php } else { ?>
          <?php //no products ?>
          <style>
            .none{opacity: 0;}
          </style>
          <?php foreach ($categories as $category) { ?>
            <div class="none cat_<?php echo $category['category_id']; ?>" data-cat_id="<?php echo $category['category_id']; ?>" data-fg_id="<?php echo $category['filter']['filter_group_id']; ?>" data-f_id="<?php echo $category['filter']['filter_id']; ?>">
              <div class="category_name"><?php echo $category['name']; ?> </div>
                <div class="products" id="prodlines_<?php echo $category['category_id']; ?>">
                </div>
                <div class="more dflex j-center">
                  <a href="<?php echo $category['href']; ?>" class="button moreproduct" title="<?php echo $category['name']; ?>"><?php echo $txt_more_products; ?></a>
                </div>
            </div>
          <?php } ?>

          <script>
          limit =5;
          climit = 0;
          $(window).scroll(function() {
            $('div[data-cat_id]').each(function(index) {
              var cat_id = $( this ).data('cat_id');
              var fg_id = $(this).data('fg_id');
              var f_id = $(this).data('f_id');
              var objj = $( this ).offset();
                if($(window).scrollTop()+$(window).height()>=(objj.top-0) && cat_id){
                  if(climit>=limit)return;
                  climit++;
                  getProducts(cat_id,fg_id,f_id);
                }
            });
          });
          </script>
        <?php } ?>
		  
    </div>
  </div>
</div> 
<script>
//$(document).ready(function(){
el = $('div[data-cat_id]:first');
var cat_id = $(el).data('cat_id');
var fg_id = $(el).data('fg_id');
var f_id = $(el).data('f_id');
getProducts(cat_id,fg_id,f_id);

function getProducts(cat_id,fg_id,f_id){
  $('div[data-cat_id="'+cat_id+'"]').removeAttr('data-cat_id');
  //$('div[data-fg_id="'+fg_id+'"]').removeAttr('data-fg_id');
  //$('div[data-f_id="'+f_id+'"]').removeAttr('data-f_id');
  $.ajax({
      url: 'index.php?route=product/manufacturer/getProducts&cat_id='+cat_id,
      method: 'POST',
      data: {"category_id" : cat_id, "filter_group_id" : fg_id, "filter_id" : f_id, "filter_name" : '<?php echo $filter_name; ?>'},
      success: function(html) {
        climit--;
        if(html.length){
          $('.cat_'+cat_id+' .products').append(html);
          $('.cat_'+cat_id).fadeTo("slow",1);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
  });  
}
//});
</script>
<script>
$(document).ready(function(){
$('.sel').each(function() {
  var $this = $(this),
    selectOption = $this.find('option'),
    selectOptionLength = selectOption.length,
    //selectedOption = selectOption.filter(':selected'),
    dur = 150;
    pr=$this.data('text');
  $this.hide();
  $this.wrap('<div class="select"></div>');
  $('<div>', {
    class: 'select__gap',
    text: pr
  }).insertAfter($this);

  var selectGap = $this.next('.select__gap'),
    caret = selectGap.find('.caret');
  $('<ul>', {
    class: 'select__list'
  }).insertAfter(selectGap);

  var selectList = selectGap.next('.select__list');
  // Add li - option items
  for (var i = 0; i < selectOptionLength; i++) {
    
    cl='';
    if(selectOption.eq(i).attr('selected')){
      cl=' selected';
      selectGap.text(pr+' '+selectOption.eq(i).text().toLowerCase());
      
    }

    $('<li>', {
        class: 'select__item'+cl,
        html: $('<span>', {
          text: selectOption.eq(i).text()
        })
      })
      .attr('data-value', selectOption.eq(i).val())
      .appendTo(selectList);
  }
  var selectItem = selectList.find('li');

  selectList.slideUp(0);
  selectGap.on('click', function() {
    if (!$(this).hasClass('on')) {
      $(this).addClass('on');

      selectList.slideDown(dur);

      selectItem.on('click', function() {
        var chooseItem = $(this).data('value');
        $('.select__item').removeClass('selected');
        $(this).addClass('selected');
        $('select').val(chooseItem).attr('selected', 'selected')
        pr=$this.data('text');
        selectGap.text(pr+' '+$(this).find('span').text().toLowerCase());
        //$('.select__gap').
        selectList.slideUp(dur);
        selectGap.removeClass('on');
        
        $this.change();
      });

    } else {
      $(this).removeClass('on');
      selectList.slideUp(dur);
    }
  });
});
});
</script>
<?php include_once(DIR_APPLICATION.'view/theme/default/template/module/ordercallback_modal.tpl');?>
<script>
<?php if($products) { ?>
$(document).ready(function(){  
gtag('event', 'view_item_list', {"items": [
<?php foreach ($products as $key => $product) { ?>
{"id": "<?php echo $product['model']; ?>","name": "<?php echo $product['name']; ?>","list": "<?php echo $breadcrumb['text']; ?>" ,"category": "<?php echo $breadcrumb['text']; ?>","list_position": <?php echo $key+1; ?>,
"quantity": 1,"price": <?php echo $product['price_float']; ?> }<?php if(count($products) > $key+1){?>,<?php } ?>
<?php } ?>
]
});

simple_tooltip(".dar","tooltip");
});
<?php } ?>

$('.filter, .filter_close').on('click',function(){
  if($(this).hasClass('open')) {
    //$(this).removeClass('open');
    $('.filter').removeClass('open');
    $('.filter_close').removeClass('open');
    $('.bf-panel-wrapper').removeClass('open');
    //$('.bf-panel-wrapper').slideToggle();
  }else{
    //$(this).addClass('open');
    $('.filter').addClass('open');
    $('.filter_close').addClass('open');
    $('.bf-panel-wrapper').addClass('open');
    //$('.bf-panel-wrapper').slideToggle();
  }
});
</script>
<?php //echo $popupcart; ?>
<script>
  
</script>
<?php echo $footer; ?>
