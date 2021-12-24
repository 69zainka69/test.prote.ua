<?php echo $header; ?>
<style>
.breadcrumb {margin-bottom: 10px;}
#content{width:70%;margin:auto;position: relative;}
h1{font-size:23px;color:#00adee;padding-bottom:25px;padding-top:10px;margin-bottom:20px;border-bottom:2px solid #00adee;font-weight:normal;padding-left:19px;}
/*.popupcart_info1 {padding: 15px 0;}*/
#cart_in td{padding:15px;vertical-align:top;width:auto;}
#cart_in .image{padding-left:0;padding-top:0;width:13%;}
#cart_in .name {width:48%;}
#cart_in .name a{color:#333;font-size:13px;font-family:'Trebuchet MS';}
#cart_in .name .model{color:#999;font-size:13px;font-family:'Trebuchet MS';}
#cart_in .quantity{white-space:nowrap;width:17%;}
#cart_in .quantity .btn-block{display:flex;align-items:center;}
#cart_in .quantity span{cursor:pointer;border:none;display:inline-block;width:22px;height:22px;line-height:14px;text-align:center;vertical-align:middle;height:27px;}
#cart_in .quantity input {margin:0;width:40px;border:none;padding:0;text-align:center;line-height:14px;color: #333;font-size: 18px;font-family: 'Open Sans',sans-serif;display: inline-block;vertical-align: middle;}
#cart_in .price{font-size:22px;font-family:'Open Sans',sans-serif;color: #333;width:17%;white-space: nowrap;}
#cart_in .del{background:none;top:0;width:22px;height:22px;cursor:pointer;width:5%;}
#cart_in .popupcart_info1 td{border-bottom:1px solid #ebebeb;}

#cart_in .total td+td{display:flex;justify-content:flex-end;text-align: right;margin-bottom:50px;white-space: nowrap;}
#cart_in .code_sub_total{display:none;}
#cart_in .total .name{padding-right:40px;}
#cart_in .total td{padding-top:10px;}
#cart_in .code_total{font-size:32px;color:#333;}
#cart_in .buttons{text-align:center;}
#cart_in .button{padding-left:50px;padding-right:50px;}
#cart_in {margin-bottom:25px;}
@media (max-width: 991px){
#content{width:100%;}
}
@media (max-width:766px){
#cart_in td{padding:5px;}
}
@media (max-width:575px){
#cart_in .name{width:78%;}
#cart_in .image{display:none;}
#cart_in .price {padding-bottom: 40px;}
#cart_in .quantity{position: absolute;margin-left: 3px;margin-top: 40px;border: none !important;}
#cart_in .quantity span {width: 14px;height: 14px;}
#cart_in .quantity span svg {height: 14px !important;width: 14px !important;}
#cart_in .quantity input {font-size: 14px;width: auto;padding: 0 5px;min-width: 36px;}
#cart_in .popupcart_info1 tr {position: relative;}
}
.white{background:#fff;border:1px solid #00adee;color:#00adee;padding:9px 20px;margin-right:20px}
.white:hover{background:#dbdbdb;}
.goback{position: absolute;right:0;top:6px;font-size: 16px;color: #999;line-height: 30px;}
</style>
<div class="container">
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
  <?php if ($attention) { ?>
  <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row" id="cart_in">
    <div id="content"><?php //echo $content_top; ?>
      <h1><?php echo $heading_title; ?>
        <?php if ($weight) { ?>
        &nbsp;(<?php echo $weight; ?>)
        <?php } ?>
      </h1>
      <a href="/"  onclick="history.back(); return false;" class="goback"><?php echo $button_shopping; ?></a>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="popupcart_info1">
          <table>
              <?php foreach ($products as $product) { ?>
              <tr>
                <td class="image"><?php if ($product['thumb']) { ?>
                  <a href="<?php echo $product['href']; ?>">
                  <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"/></a>
                  <?php } ?></td> 
                <td class="name">
                  <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                  <div class="model">Артикул: <?php echo $product['model']; ?></div>
                  <?php if (!isset($product['stock'])) { ?>
                  <span class="text-danger">***</span>
                  <?php } ?>
                  <?php //if ($product['option']) { ?>
                  <?php //foreach ($product['option'] as $option) { ?>
                  
                  <small><?php //echo $option['name']; ?> <?php // echo $option['value']; ?></small>
                  <?php //} ?>
                  <?php //} ?>
                  <?php //if ($product['reward']) { ?>
                  
                  <small><?php //echo $product['reward']; ?></small>
                  <?php //} ?>
                  <?php if(isset($product['recurring'])){
                     if ($product['recurring']) { ?>
                  <br />
                  <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
                  <?php }} ?></td>
                <td class="quantity">
                  <div class="input-group btn-block">

                      
                    <span class="minus" onclick="if(jQuery(this).next().val()>1){jQuery(this).next().val(~~jQuery(this).next().val()-1).change();$('.fa-refresh').click();}"><?php echo file_get_contents(DIR_IMAGE.'/ico/workers/minus.svg');?></span>
                
                    <input type="text" name="quantity[<?php echo $product['cart_id']; ?>]" id="cart_id_<?php echo $product['cart_id']; ?>" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
                    <?php if (!isset($product['stock'])) { ?>
                      <?php if (isset($product['quantity'])) { ?>
                        <span class="plus" onclick="jQuery(this).prev().val(~~jQuery(this).prev().val()+1).change();"><?php echo file_get_contents(DIR_IMAGE.'/ico/workers/plus.svg');?></span>
                      <?php } else { ?>
                        <span style="opacity:0.5;">+</span>
                      <?php } ?>
                    <?php } else { ?>
                      <span class="plus" onclick="jQuery(this).prev().val(~~jQuery(this).prev().val()+1).change();$('.fa-refresh').click();"><?php echo file_get_contents(DIR_IMAGE.'/ico/workers/plus.svg');?></span>
                    <?php } ?>
                  </div></td>
                <td style="display:none;"><?php echo $product['price']; ?></td>
                <td class="price">
                  <style>
                    .price input{
                      max-width:100px;
                      border:none;
                    }
                    .price img{
                      cursor:pointer;
                    }
                    .price .active{
                      border: 1px solid #cecece;
                    }
                  </style>
                 
                    <?php echo $product['total']; ?>
                 
                  <!-- <span><?php echo $product['total']; ?></span> -->

                </td>
                <td class="remove">
                  <span>
                    <button style="display:none;" type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary "><i class="fa fa-refresh"></i></button>
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="del" onclick="cart.remove('<?php echo $product['cart_id']; ?>');$('.fa-refresh').click();"><i class="fa fa-times-circle"></i></button></span>
                </td>
              </tr>
              <?php } ?>
              <?php foreach ($vouchers as $vouchers) { ?>
              <tr>
                <td class="text-left"></td>
                <td class="text-left"><?php echo $vouchers['description']; ?></td>
                <td class="text-left"></td>
                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                    <span class="input-group-btn"><button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="voucher.remove('<?php echo $vouchers['key']; ?>');"><i class="fa fa-times-circle"></i></button></span></div></td>
                <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                <td class="text-right"><?php echo $vouchers['amount']; ?></td>
              </tr>
              <?php } ?>

          </table>
        </div>
      </form>
<script>
$('.edit_price').on('click',function(){
  id=$(this).data('id');
  price_int=$(this).data('price_int');

  //$("#edit_"+id).attr('data-price_int',price_int);

  $('#price_'+id).val(price_int).removeAttr('readonly').addClass('active').focus();
  //console.log(id);
});
$('.price_input').focusout(function(eventObject){
    pr = $(this).val();
    if(pr==''){
      id=$(this).data('id');
      console.log(id);
      pr = $("#edit_"+id).data('price_int');
      console.log(pr);
      if(!pr)return;
    }
    quantity = $("#cart_id_"+id).val();
    var quantity = typeof(quantity) != 'undefined' ? quantity : 1;
    price=parseFloat(pr/quantity);
    console.log(price);

    $(this).val(parseFloat(pr) + " грн.").removeClass('active');
    id=$(this).data('id');
    $.ajax({
        url: 'index.php?route=checkout/cart/you_price',
        type: 'post',
        data: {'cart_id':id,'you_price':price},
        dataType: 'json',

        success: function(json) {

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
</script>
      <div class="flex">
      <?php if($coupon || $voucher || $reward || $shipping) { ?>
<style>
      #content .flex{display:flex;}
      .flex .coupons{width:60%;padding-left:25px;}
      .flex .total{width:40%}
      .coupons .input-group{display:flex;max-width:360px;}
      .coupons label{font-family:'Trebuchet MS';font-size:13px;color:#333;padding-bottom:10px;display:block;}
      .coupons input{height:40px;}
      .coupons input[type="text"]:focus{font-family:'Trebuchet MS';font-size:18px;color:#00adee;}
      .coupons .lblue{background: #bee9f9;color: #333;border:none;font-size:13px;color:333;font-family:'Trebuchet MS';}
      .coupons .lblue:hover{background:#dbdbdb;}
      .popupcart_info1{margin-bottom:40px;}
      @media (max-width: 991px){
        .flex .coupons{padding:0;width:50%;}
      }
      @media (max-width:766px){
        #cart_in .total td{display:block}
      }
      @media (max-width:575px){
        #content .flex{flex-wrap:wrap;}
        .flex .coupons{width:100%;}
        .flex .total{width:100%;}
        #cart_in .total td{display:table-cell;}
        #cart_in .buttons{
          display: flex;
          flex-direction: column;
          justify-content:center;
        }
        #cart_in .buttons a {
          width:90%;
          margin: 0 auto 10px;

        }
      }
      </style>
        <div class="coupons"><?php echo $coupon; ?><?php echo $voucher; ?><?php echo $reward; ?><?php echo $shipping; ?></div>
      <?php } ?>

        <div class="total">
          <div class="">
            <table>
              <?php foreach($totals as $total) { ?>
                <tr class="code_<?php echo $total['code']; ?>">
                  <td class="name"><?php echo $total['title']; ?></td> <td><?php echo $total['text']; ?></td>
                </tr>
              <?php } ?>
            </table>
            <style type="text/css">
              .upFreeDelivSum{
                color: #00aeef;
                  font-size: 14px;
                  font-weight: normal;
                  padding-bottom: 15px;
                  display: inline-block;
                  width: 100%;
                  float: right;
              }
              .upFreeDelivSum span{
                color: #fd9710;
              }
            </style>
            <div class="upFreeDelivSum" >
              <?= $upFreeDelivSum;?>
            </div>
        </div>
        </div>
      </div>

      <div class="buttons">
        <a href="/"  onclick="history.back(); return false;" class="button white"><?php echo $button_shopping; ?></a>
        <a href="<?php echo $checkout; ?>" class="button"><?php echo $button_checkout; ?></a>
      </div>
      </div>
    </div>
</div>
<script>
  $('form input').keyup(
    function(eventObject){
      val = $(this).val();
      if(val=='')continue;
      $('#'+$(this).attr('id')).val(parseInt(val));
      $(this).next().find('button[type="submit"]').click();
    }
  );
</script>
<?php echo $footer; ?>
