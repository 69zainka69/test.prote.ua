<?php echo $header; ?>
<style>
.breadcrumb{margin-bottom: 20px;}
h1{color:#00adee;font-size:24px;font-weight:normal;margin-bottom:20px;padding-left:4.5%;margin-top:3.3%;}
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
    <h1><?php echo $heading_title; ?></h1>
<style>
    .sol_top{display:flex;flex-wrap:nowrap;align-items:flex-start;padding:2.7% 0 4.7%;border-bottom:3px solid #fd9710;margin-bottom:4.1%;align-items:center;}
    .sol_top .info{padding:0 3% 0 4.5%;color:#636363;font-size:15px;font-family:'Trebuchet MS';line-height:23px;width:53%;position:relative;}
    .sol_top .info:after{content:'';position:absolute;top:10%;right:0;border-right:1px solid #f8f7f8;height:80%;width:0;}
    .info p+p{margin-top:15px;}
    .sol_top .info2{padding:0 2% 0 4.5%;color:#00adee;font-size:50px;font-family:'Trebuchet MS';position:relative;width:290px;line-height:45px;}
    .sol_top .svg{}
    
    </style>
    <div class="">
        <div class="sol_top">
            <div class="info"><?php echo $workers['description']; ?></div>
            <div class="info2"><?php echo $text_quant; ?></div>
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/workers/do25sm.svg');?></div>
        </div>
        <style>
        .product{display:flex;flex-wrap:nowrap;}
        .col_title{display:flex;flex-wrap:nowrap;}
        .col_title>div{border-top:1px solid #efeeee;text-align:center;font-size:12px;color:#999;}
        .col_title .name{text-align:left;padding-left:20px;}
        .products .image{width:9.3%;justify-content:center;}
        .image img{max-width:100%;}
        .products .model{width:7.5%;justify-content:center;}
        .products .name{width:50%;padding-left:20px;}

        .products .price{width:11.1%;justify-content:center;white-space:nowrap;}
        .products .quantity{width:19.1%;justify-content:center;flex-wrap:nowrap;}
        .products .total{width:11.1%;justify-content:center;white-space:nowrap;}
        .product>div,.col_title>div{border-right:1px solid #efeeee;border-bottom:1px solid #efeeee;padding:5px;}
        
        .product>div:first-child, .col_title>div:first-child{border-left:1px solid #efeeee;}
        .product>div{display:flex;align-items:center;color:#636363;font-size:15px;font-family:'Trebuchet MS';}
        .products .product .name a{color:#00adee;font-size:15px;font-family:'Trebuchet MS';text-decoration:underline;}
        .products .product .name a:hover{color:#fd9710;}
        .quantity input{width:50px;border:none;margin:0 0 6px 0;text-align:center;font-size:18px;color:#333;}
        .quantity .minus,.quantity .plus{cursor:pointer;}
        .totals{font-size:32px;color:#00adee;font-family:'Trebuchet MS';margin-top:46px;margin-top:3.7%;text-align: right;}
        .buttons{display:flex;justify-content:center;}
        #sendOrder{line-height:45px;padding:0 45px;margin:3.7% auto 6.4%;background:#fd9710;color:#fff;font-family:'Trebuchet MS';font-size:15px;cursor:pointer;}
        .dflex .item.col_2{padding:3.8% 17px 20px;flex-direction: column;width:50%;display:flex;align-content:center;justify-content:center;text-align:left;border:none;padding-bottom:0;}
        .item.col_2 .r{display:flex;align-items: center;}
        .col_2 .svg{padding-right:13px;}
        .col_2 .title{font-size:24px;color:#00adee;font-family: 'Open Sans',sans-serif;}
        .col_2+.col_2{padding-left:30px;}
        .col_2+.col_2 .title{color:#fd9710;}
        .col_2 .text{padding-top:19px;font-family:'Trebuchet MS';font-size:15px;color:#636363;line-height:23px;}
        .readycart{flex-wrap:wrap;margin-bottom: 5.5%;position:relative;}
        .readycart:before{content:'';position:absolute;top:0;width:96%;left:2%;height:0;border-top:1px solid #f8f7f8;}
        @media (max-width: 1299px){}
        @media (max-width: 991px){
            .quantity input{width:30px;padding:0;}
            .products .name {padding-left:5px;width:41%;}
        }
        @media (max-width:766px){
            .sol_top{flex-wrap:wrap;}
            .sol_top .info{width:100%;padding-bottom:25px;justify-content: center;}
            .products .model{display:none;}
            .products .name {padding-left:5px;width:50%;}
            .product>div {font-size:13px;}
            .products .product .name a{font-size:13px;}
            .products .quantity{width:16%;}
            .products .price{width:12.6%;}
            .products .total{width:12.6%;}
        }
        @media (max-width:575px){
            .products{padding:0 10px;}
            .products .name{display:none;}
            .products .image{width: 23%;}
            .products .price{width: 24%;}
            .products .quantity{width: 28%;}
            .products .total{width: 25%;}
        }
        .products .del{width:3%;}
        .butdel{position:relative;width:22px;height:22px;cursor:pointer;}
        .butdel:after,.butdel:before{content:"";position:absolute;left:50%;top:50%;width:22px;height:1px;background-color:rgba(153,153,153,.8);transition:all .2s linear}
        .butdel:after{transform:translate(-50%,-50%) rotate(45deg)}
        .butdel:before{transform:translate(-50%,-50%) rotate(-45deg)}
        </style>
        <?php if(isset($workers['products']) && $workers['products']){ ?>


        <div class="products">
            <div class="col_title">
                <div class="image"><?php echo $text_image; ?></div>
                <div class="model"><?php echo $text_model; ?></div>
                <div class="name"><?php echo $text_name; ?></div>
                <div class="price"><?php echo $text_price; ?></div>
                <div class="quantity"><?php echo $text_quantity; ?></div>
                <div class="total"><?php echo $text_total; ?></div>
                <div class="del"></div>
            </div>
            <?php foreach($workers['products'] as $product){ ?>
            <div class="product">
                <div class="image"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"/></div>
                <div class="model"><?php echo $product['model']; ?></div>
                <div class="name"><a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>"><?php echo $product['name']; ?></a></div>
                <div class="price"><?php 
                    if($product['special']){ ?>
                    <span class="old-price"><?php echo $product['price']; ?></span>
                    <span class="new-price"><?php echo $product['special']; ?></span>
                    <?php }else{ ?>
                        <?php echo $product['price']; ?>
                    <?php }?>
                </div>
                <div class="quantity">
                    <span class="minus" onclick="if(jQuery(this).next().val()>=1){jQuery(this).next().val(~~jQuery(this).next().val()-1).change()};"><?php echo file_get_contents(DIR_IMAGE.'/ico/workers/minus.svg');?></span>
                    <input type="text" name="quantity" value="<?php echo $product['quantity']; ?>" data-product_id="<?php echo $product['product_id']; ?>" data-price="<?php echo $product['price_float']; ?>" data-price-start="<?php echo $product['price_float']; ?>"/>
                    <span class="plus" onclick="jQuery(this).prev().val(~~jQuery(this).prev().val()+1).change();"><?php echo file_get_contents(DIR_IMAGE.'/ico/workers/plus.svg');?></span>
                </div>
                <div class="total"><span id="prod_id_<?php echo $product['product_id']; ?>"><?php echo $product['total']; ?></span></div>
                <div class="del"><div class="butdel"></div></div>
            </div>
            <?php } ?>
        </div>
        <div class="totals"><?php echo $text_total; ?>: <span id="totals"><?php echo $totals; ?></span></div>
        <div class="buttons">
            <div id="sendOrder"><?php echo $send_button; ?></div>
        </div>
          <div class="dflex readycart">
              <div class="item col_2">
                <div class="r">
                  <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-contact.svg');?></div>
                  <div class="title"><?php echo $text_title1; ?></div>
                </div>
                <div class="text"><?php echo $text_text1_1; ?></div>
              </div>
              <div class="item col_2">
                <div class="r">
                  <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-otziv.svg');?></div>
                  <div class="title"><?php echo $text_title2; ?></div>
                </div>
                <div class="text"><?php echo $text_text2_1; ?></div>
              </div>          
            </div>
        

        <script>
            $('.butdel').on('click',function(){
                $(this).parent().parent().remove();
                //alert($('input[name="quantity"]').first().attr('value'));
                $('input[name="quantity"]').first().change();
            });
            $('#sendOrder').on('click', function() {
                c = $('.quantity input[name=quantity]').length;
                $('.quantity input[name=quantity]').each(function(index,element){
                   $.ajax({
                        url: 'index.php?route=checkout/cart/add',
                        type: 'post',
                        data: "product_id="+$(this).data('product_id')+"&quantity="+parseInt($(this).val()),
                        dataType: 'json',
                        success: function(json) {
                            if(c==index+1){location='checkout/';}
                        }
                    });
                });
            });

            $('.quantity').on('change','input',function(){
                
                if($(this).val()){val = $(this).val()} else {val =0;}
                total = parseFloat($(this).data('price')) * parseInt(val);
                obj = this;
                id= '#prod_id_'+$(obj).data('product_id');
                totals=0;
                animatePrice(total,$(obj).data('price-start'));
                $('input[name="quantity"]').each(function(){
                    if($(this).val()){val = $(this).val()} else {val =0;}
                    totals = totals + parseFloat($(this).data('price')) * parseInt(val) ;
                    $('#totals').html(price_format(totals));
                });
            });
            animate_delay = 20;
            final_price = 0;
            start_price = 0;
            step = 0;
            timeout_id = 0;

            function animateMainPrice() {
                start_price += step;
                
                if ((step > 0) && (start_price > final_price)){
                    start_price = final_price;
                } else if ((step < 0) && (start_price < final_price)) {
                    start_price = final_price;
                } else if (step == 0) {
                    start_price = final_price;
                }
                $(id).html( price_format(start_price) );
                if (start_price != final_price) {
                    timeout_id = setTimeout(animateMainPrice, animate_delay);
                }
            }
            function animatePrice(price,start_price) {
                start_price = final_price;
                final_price = price;
                step = (final_price - start_price) / 10;
                
                clearTimeout(timeout_id);
                timeout_id = setTimeout(animateMainPrice, animate_delay);
            }
            function price_format(n){ 
                c = 0;
                d = '.'; // decimal separator
                t = ' '; // thousands separator
                s_left = '';
                s_right = ' грн';
                n = n * 1.00000000;
                //extracting the absolute value of the integer part of the number and converting to string
                i = parseInt(n = Math.abs(n).toFixed(c)) + ''; 
                j = ((j = i.length) > 3) ? j % 3 : 0; 
                return s_left + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '') + s_right; 
            }
        </script>

        <?php } ?>

    </div>  
  </div>
</div>
<?php echo $footer; ?> 