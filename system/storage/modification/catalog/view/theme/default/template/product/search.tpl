
<?php if (!$this->registry->get('category_ajax')) : ?>
<?php if (!$this->registry->get('category_ajax')) : ?>
<?php echo $header; ?>  
<style>
#column-left, #res_filter2, .catalog-recommendation {
    display: block !important;
}
.dar{
  position: absolute !important;
    top: 10% !important;
    right: 0 !important;
}
.products {
    flex-wrap: wrap !important;
}
#category-list li span {
    color: #00aeef !important;
}
#category-list li:hover {
    background: #bee9f9 !important;
}
.product .buttons .button-row {
    justify-content: center !important;
    }
  .price {
    text-align:center !important;
}

#maincontent .row{flex-wrap:nowrap;}
.row.dflex{display:flex;flex-direction:row;flex-wrap:nowrap;}
#column-left{width:247px;flex-basis:247px;min-width:247px;padding:0 7px 0 15px;}
#content{flex-basis:auto;width:100%;}
h1{font-size:23px;color:#00adee;font-weight:normal;display:inline-block;vertical-align:middle;padding-left:17px;}
.rowh1{justify-content:space-between;align-items:center;margin-bottom:20px;border-bottom:4px solid #00adee;}
.h1{padding: 5px 0 10px 15px;}
.h1 .svg{ display: inline-block;vertical-align: middle;}
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/select.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/products.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/pagination.css');?>
.products>div {width: 246px;}
@media(max-width:1200px){
.products>div{width:33.33%;}
}
@media (max-width:991px){
.products>div{width:50%;}
}
@media (max-width: 767px){
.row.dflex{flex-direction:column;}
}

@media (max-width:575px){
.products>div{width:50%;}
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
  <?php if ($categories && $products || $products_brand) { ?>
  <div class="row rowh1">
    <div class="h1">
      <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/search/poshuk-icon.svg');?></span>
      <h1><?php echo $heading_title; ?></h1>
    </div>
    <div class="sort">
      
      <select id="input-sort" class="sel" data-text="<?php echo $text_sort; ?>" onchange="location = this.value;">
        <?php foreach ($sorts as $sorts) { ?>
        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
        <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
      
     </div>
  </div>
  <?php } else{ ?>
<style>
    h1{font-size:36px;color:#00adee;font-weight:normal;display:block;margin-bottom:20px;line-height:40px;text-align:center;}
    #content{width: 560px;margin:auto;margin-bottom:7%;}
    .text-center{text-align:center;}
  </style>
  <h1 class="text-center"><?php echo $text_empty; ?></h1>
  <?php } ?>
  <div class="row dflex">
    <?php if ($categories && $products || $products_brand) { ?>

<style>
    .search-all{font-size:16px;font-weight:bold;color:#333;font-family:'Trebuchet MS';padding:8px 0;border-bottom:1px solid #333;margin-top:15px;margin-bottom:20px;cursor:pointer;position:relative;}
    #category-list li{font-family:'Trebuchet MS';color:#333;font-size:13px;cursor:pointer;line-height:13px;padding:5px 0;    }
    #category-list li.active{    background: #bee9f9;}
    #category-list li span{padding-left:10px;color:#999;}
    </style>
      <div id="column-left">


<?php
if(isset($catone))
{
  echo '<img src="/image/printer-nofoto.png">';
  echo "<h3>".$catone."</h3>";
foreach ($prodone as $nameone){
  echo "<p>".$nameone."</p>";
}}
if(isset($cattwo))
{
  echo "<h3>".$cattwo."</h3>";
foreach ($prodtwo as $nametwo){
  echo "<p>".$nametwo."</p>";
}}
if(isset($catthree))
{
  echo "<h3>".$catthree."</h3>";
foreach ($prodthree as $namethree){
  echo "<p>".$namethree."</p>";
}}
if(isset($catfour))
{
  echo "<h3>".$catfour."</h3>";
foreach ($prodfour as $namefour){
  echo "<p>".$namefour."</p>";
}}
?>


















        <ul id="category-list" class="search-cat-block search-cat-block-list">
          <li data-val="0" class="search-all"><?php echo $text_category; ?></li>  
          <?php foreach ($categories as $category_1) { ?>           
         
          <?php foreach ($category_1['children'] as $category_2) { ?>
          <?php $numadd=isset($product_total_cat[$category_2['category_id']]) ? '&nbsp;<span class="search-count">('.$product_total_cat[$category_2['category_id']].')</span>' : '';  ?>
          <?php $numadd=isset($product_total_cat[$category_2['category_id']]) ? '<span class="search-count-div">('.$product_total_cat[$category_2['category_id']].')</span>' : '';  ?>
          <?php if ($numadd) { ?> 
          <?php if ($category_2['category_id'] == $category_id) { ?>
              <li data-val="<?php echo $category_2['category_id']; ?>" class="active"><?php echo $category_2['name'] . $numadd; ?></li>
          <?php } else { ?>
            <li data-val="<?php echo $category_2['category_id']; ?>"><?php echo $category_2['name'] . $numadd; ?></li>
          <?php } ?>
          <?php } ?>            
          <?php } ?> 
          <?php } ?>
        
        </ul>  
      </div>
    <?php } ?>
    <? /*<!-- <div class="hidden-md hidden-sm hidden-xs">
    <?php //echo $text_searchtypes; ?>
    </div> --> */ ?>
    <div id="content" class="content-search">
      <? /*<!-- <div id="brainyfilter-product-container">
          </div> --> */ ?>

		  <?php endif; ?>
		  <div id="brainyfilter-product-container">
		  
      <?php if ($products) { ?>
      
      <div class="products">
        <?php foreach ($products as $product) { ?>
        <div class="product<?php if($product['ifexist']==3) { ?> non<?php } ?>">
              <?php if ($product['special'] || $product['action']) { ?>
                <div class="dar">
                <img src="image/ico/favicon_prote_16x16.svg" data-original="image/ico/action/label-fire-action.svg"  alt="<?php echo $text_action; ?>" title="<?php echo $text_action; ?>"/>
                <div><?php echo $text_action; ?></div>
                </div>
              <?php } ?>

            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
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
            <?php if ($product['price']) { ?>
              <p class="price">Ціна:
                <?php if (!$product['special']) { ?>
                <?php echo $product['price']; ?>
                <?php } else { ?>
                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                <?php } ?>
              </p>
              <?php } ?>
            <div class="buttons">
              

                <?php if($product['minimum']>1) { ?>
                  <div class="product_min list block"><?php echo $text_minimum.$product['minimum'];?></div>
                <?php } ?>
                <?php if ($product['ifexist']!=2) { ?>
                  <div class="button-row">
                    <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                        <a href="#ordercallback-modal" data-modal="ordercallback-form" class="oneclick"
                        onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special"] ? $product["special"] : $product["price"]); ?>','<?php echo $product['minimum']; ?>'); return false;">
                              <?php echo $button_cartone; ?>                      
                        </a>
                    <?php } ?>
                    <a href="#basketinfo-modal1" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
                  </div>
                <?php } ?>
            </div>
          </div>
        <?php } ?>
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
      </div>
      
      <?php } elseif ($products_brand) { ?>
      <div>
<style>
        .text.dflex{display:flex;flex-direction: row;font-size:14px;line-height:15px;color:#333;margin:0 10px;}
        .products+.text.dflex{margin-top:40px;}
        .text.dflex>div{padding:15px 20px;width:50%;}
        .text.dflex>div:first-child{padding-left:6%;font-size:20px;line-height:30px;}
        .text.dflex>div:last-child{font-family:'Trebuchet MS';}
       
        </style>
        <?php foreach ($products_brand as $key => $products) { if(empty($products)) continue;  ?>
        
          
          <div class="products">
          <div class="text dflex" style="flex-direction: column; border-radius: 29px;
    height: 370px; background: #<?php echo ${'text_'.$key.'_color'}; ?>">
              <div style="padding-top:56px; padding-left: 16%; text-align: left; width: 222px; font-size: 20px;
line-height: 25px;" <?php if(!${'text_' . $key}){?> style="width:0;"<?php } ?>><?php echo ${'text_' . $key}; ?> </div>
              <svg style="margin-left: auto;
    margin-right: auto;" width="165" height="2" viewBox="0 0 165 1" fill="none" xmlns="http://www.w3.org/2000/svg">
<line x1="4.37114e-08" y1="0.5" x2="165" y2="0.500014" stroke="#333333"/>
</svg> 
<div style="text-align: left; width: 222px; padding-left: 16%; font-size: 13px;
line-height: 15px;"><?php echo ${'text_' . $key.'_2'}; ?>
<?php
$asd = ${'text_' . $key};

if (strpos($asd, 'PATRON GREEN') !== false){
  echo '<p style="padding-top: 34px;"><img src="/image/patron/patrongreen.svg" ></p>';
}
if (strpos($asd, 'Patron Extra') !== false){
  echo '<p style="padding-top: 34px;"><img src="/image/patron/patronextra.svg" ></p>';
}
?>
</div>
          </div>
            <?php foreach ($products as $product) { ?>
            <div class="product<?php if($product['ifexist']==3) { ?> non<?php } ?>">
              <?php if ($product['special'] || $product['action']) { ?>
                <div class="dar">
                <img src="image/ico/favicon_prote_16x16.svg" data-original="image/ico/action/label-fire-action.svg"  alt="<?php echo $text_action; ?>" title="<?php echo $text_action; ?>"/>
                <div><?php echo $text_action; ?></div>
                </div>
              <?php } ?>
                <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
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
                <?php if ($product['price']) { ?>
                  <p class="price">
                    <?php if (!$product['special']) { ?>
                    <?php echo $product['price']; ?>
                    <?php } else { ?>
                    <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                    <?php } ?>
                  </p>
                  <?php } ?>
                <div class="buttons">
                  

                    <?php if($product['minimum']>1) { ?>
                      <div class="product_min list block"><?php echo $text_minimum.$product['minimum'];?></div>
                    <?php } ?>
                    <?php if ($product['ifexist']!=2) { ?>
                      <div class="button-row">
                        <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                            <a href="#ordercallback-modal" data-modal="ordercallback-form" class="oneclick"
                            onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special"] ? $product["special"] : $product["price"]); ?>','<?php echo $product['minimum']; ?>'); return false;">
                                  <?php echo $button_cartone; ?>                      
                            </a>
                        <?php } ?>
                        <a href="#basketinfo-modal1" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
                      </div>
                    <?php } ?>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      
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
        </div> 
      </div> 
        
      
      <?php } else { ?> 
<style>.row.dflex{display:flex;flex-direction:row;flex-wrap:nowrap;justify-content:center;}</style>
        <?php include(DIR_APPLICATION.'/view/theme/default/template/error/error_search.tpl');?>
      <?php } ?>

		  </div>
      </div>
		  
		  
    
</div>
</div>

<?php include_once(DIR_APPLICATION.'view/theme/default/template/module/ordercallback_modal.tpl');?>

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
$(document).ready(function(){  
$('#category-list li').click(function () {
    window.location.search='category_id='+$(this).data('val')+'&sub_category=true'+'&search=<?php echo $search; ?>';
});
});
</script>
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
});
<?php } ?>
</script>

<?php echo $footer; ?>
<?php endif; ?>
<?php endif; ?>