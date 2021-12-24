<?php echo $header; ?>
<style>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/account.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/order.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/pagination.css');?>
</style>
<style>
.product{display:flex;flex-wrap:nowrap;}
.col_title{display:flex;flex-wrap:nowrap;}
.col_title>div{border-top:1px solid #efeeee;text-align:center;font-size:12px;color:#999;}
.col_title .name{text-align:left;padding-left:20px;}
.products img{max-width:100%;margin-right:10px;}
.products .model{width:11%;justify-content:center;}
.products .name{width:46.5%;}

.products .price{width:14.7%;justify-content:center;white-space:nowrap;}
.products .quantity{width:13.7%;justify-content:center;flex-wrap:nowrap;}
.products .total{width:13.1%;justify-content:center;white-space:nowrap;}
.product>div,.col_title>div{border-right:1px solid #efeeee;border-bottom:1px solid #efeeee;padding:5px;}

.product>div:first-child, .col_title>div:first-child{border-left:1px solid #efeeee;}
.product>div{display:flex;align-items:center;color:#636363;font-size:15px;font-family:'Trebuchet MS';}
.products .product .name a{color:#00adee;font-size:14px;font-family:'Trebuchet MS';text-decoration:underline;}
.products .product .name a:hover{color:#fd9710;}
.quantity input{width:50px;border:none;margin:0 0 6px 0;text-align:center;font-size:18px;color:#333;}
.quantity .minus,.quantity .plus{cursor:pointer;}
@media (max-width: 1299px){}
@media (max-width: 991px){
    .products .quantity input{width:30px;padding:0;}
    .products .name {padding-left:5px;}
}
@media (max-width:766px){
    .products .model{display:none;}
    .products .name {padding-left:5px;width:59%;border-left:1px solid #efeeee;}
    .product>div {font-size:13px;}
    .products .product .name a{font-size:13px;}
    .products .quantity{width:16%;}
    .products .price{width:12.6%;}
    .products .total{width:12.6%;}
}
@media (max-width:575px){
    .products{padding:0 10px;}
    .products .price{display:none;}
    .products .name{width:40%;}
    .products .name img{display:none;}
    .products .image{width: 23%;}
    .products .price{width: 24%;}
    .products .quantity{width: 28%;}
    .products .total{width: 25%;}

}
</style>
<style>
.cont{border-bottom:2px solid #00adee;padding:20px;margin-bottom:35px;}

.table{display:flex;font-size:13px;line-height:17px;color:#999;}
.table>div{padding:5px;}
.t_order{font-size:15px;color:#fd9710;width:8.7%;text-decoration:underline;}
.t_info{width:46%;}
.t_data{width:15.7%;text-align:center;}
.t_quant{width:14.6%;text-align:center;}
.t_total{font-size:15px;color:#00adee;width:15%;text-align:center;}
.table b{font-size:13px;color:#333;}

.cont_products{width:71%;padding-top:30px;}
@media (max-width: 991px){.cont_products{width:100%}}
@media (max-width: 575px){
.table{flex-direction:column;}
.table>div{width:100%;text-align:left!important;}
}
</style>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  
  <div class="row" id="account">
    <div class="content">
      <div class="rowh1">
        <h1><?php echo $lastname.' '.$firstname; ?></h1>  
        <a href="<?php echo $logout; ?>"><span class="text"><?php echo $text_logout; ?></span><?php echo file_get_contents(DIR_IMAGE.'/ico/account/exit.svg');?></a>
      </div>
      <div class="content1">
        <div class="c1">
        <ul>
          <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
          <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
          <!-- <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li> -->
          <li><a href="<?php echo $order; ?>" class="button"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
        </div>
        <div class="c2">
          <h2><?php echo $heading_title; ?></h2>
          <?php if ($orders) { ?>
          <div>
              <div class="orders">
                <?php foreach ($orders as $order) { ?>
                <div class="order">
                  <div class="order_id"><a href="<?php echo $order['href']; ?>" title="<?php echo $button_view; ?>" class="btn btn-info">№ <?php echo $order['order_id']; ?></a></div>
                  <div class="data"><div class="quant"><?php echo $order['products']; ?> <?php echo $product_total; ?> </div><div class="dat"><?php echo $order['date_added']; ?></div></div>
                  <div class="status"><?php echo $order['status']; ?></div>
                  <div class="total"><?php echo $order['total']; ?></div>
                  <div class="view"><a href="<?php echo $order['order_reorder']; ?>" onclick="1return false;" data-toggle="tooltip" title="<?php echo $button_reorder; ?>" class="btn btn-info">
                    <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/account/reorder.svg');?></span>
                  </a></div>
                </div>
                <?php } ?>
              </div>
          </div>
          <div><?php echo $pagination; ?></div>
          <?php } else { ?>
          <p><?php echo $text_empty; ?></p>
          <?php } ?>
        </div>
      </div>
      <div class="cont">
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
      </div>
    
      <div class="content2 line">
        <div class="table">
          <div class="t_order">
            <?php if ($invoice_no) { ?>
            <b><?php echo $text_invoice_no; ?></b> <?php echo $invoice_no; ?><br />
            <?php } ?>
            № <?php echo $order_id; ?><br />
          </div>
          <div class="t_info">
            <?php if ($payment_method) { ?>
            <b><?php echo $text_payment_method; ?></b> <?php echo $payment_method; ?><br />
            <?php } ?>
            <?php if ($shipping_method) { ?>
            <b><?php echo $text_shipping_method; ?></b> <?php echo $shipping_method; ?>
            <?php } ?>
              <?php if ($shipping_address) { ?>
              <br><b><?php echo $text_shipping_address; ?>:</b>
              <?php echo $shipping_address; ?>
              <?php } ?>
            <?php if ($comment) { ?><br>
              <b><?php echo $text_comment; ?>:</b> <?php echo $comment; ?>
            <?php } ?>

          </div>
          <div class="t_data"><b><?php echo $text_date_added; ?></b><br><?php echo $date_added; ?></div>
          <div class="t_quant">
            <div><b><?php echo $column_quantity; ?></b></div>
            <div><?php echo count($products).' '.$product_total; ?></div>
          </div>
          <div class="t_total">
            <?php foreach ($totals as $total) { ?>
              <div>
                <div><b><?php echo $total['title']; ?>:</b></div>
                <div><?php echo $total['text']; ?></div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <div class="cont_products">
      <div style="display: unset;" class="products">
        <div class="col_title">
            
            <div class="model"><?php echo $column_model; ?></div>
            <div class="name"><?php echo $column_name; ?></div>
            <div class="price"><?php echo $column_price; ?></div>
            <div class="quantity"><?php echo $column_quantity; ?></div>
            <div class="total"><?php echo $column_total; ?></div>
        </div>
        <?php foreach ($products as $product) { ?>
        <div class="product">
            <div class="model"><?php echo $product['model']; ?></div>
            <div class="name"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"/><a href="<?php echo $product['href']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"><?php echo $product['name']; ?></a></div>
            <div class="price">
              <?php echo $product['price']; ?>
            </div>
            <div class="quantity">
                <?php echo $product['quantity']; ?>
            </div>
            <div class="total"><?php echo $product['total']; ?></div>
        </div>
        <?php } ?>
      </div>
      <?php foreach ($vouchers as $voucher) { ?>
        <div class="vouchers">
          <div class="text-left"><?php echo $voucher['description']; ?></div>
          <div class="text-left"></div>
          <div class="text-right">1</div>
          <div class="text-right"><?php echo $voucher['amount']; ?></div>
          <div class="text-right"><?php echo $voucher['amount']; ?></div>
          <?php if ($products) { ?>
          <div></div>
          <?php } ?>
        </div>
      <?php } ?>



      <?php if ($histories) { ?>
      <h2 style="margin:30px 0 0;"><?php echo $text_history; ?></h2>
      <div style="display: unset;" class="products">
        <div class="col_title">
            <div class="model"><?php echo $column_date_added; ?></div>
            <div class="price"><?php echo $column_status; ?></div>
            <div class="name"><?php echo $column_comment; ?></div>
        </div>
          <?php foreach ($histories as $history) { ?>
        <div class="product">
          <div class="model"><?php echo $history['date_added']; ?></div>
          <div class="price"><?php echo $history['status']; ?></div>
          <div class="name"><?php echo $history['comment']; ?></div>
        </div>
          <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php echo $footer; ?>