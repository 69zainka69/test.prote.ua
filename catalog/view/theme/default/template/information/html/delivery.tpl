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
<style>
.delivery .dflex{padding-top:45px;margin-bottom:150px;}
h1, .h1{color:#00adee;font-size:24px;font-weight:normal;padding-left:15px;margin-bottom:20px;}
.h1{padding:0;line-height:36px;}
.delivery .dflex{flex-wrap:wrap;}
.delivery .dflex .item{width:25%;text-align:center;
  border:1px solid #f7f6f7;
  padding:26px 25px 12px;}
.delivery .dflex .item:hover{border:1px solid #fd9710;cursor:pointer;}
.delivery .dflex .item.col2{width:50%;display:flex;align-items:center;align-content:center;justify-content:center;text-align:left;}
.delivery .dflex .item.col2:hover{border:none;cursor:text;}
.delivery .dflex .svg{height:70px;}
.delivery .dflex svg{height:100%;}
.delivery .dflex .title{color:#636363;font-family:'Trebuchet MS';font-size:15px;padding-top:5px;margin-bottom:38px;}
.delivery .dflex .text{color:#999;font-size:11.5px;line-height:13px;margin-bottom:12px;}
.delivery .buttons{height:41px; padding: 0px;}
.delivery .button{font-family:'Trebuchet MS';font-size:15px;display:none;padding: 10px 20px;color: #fff !important;margin: 0 auto !important;text-decoration: none;display: flex;align-items: center;}

/*.delivery .dflex .item.col2 .it{width:90%;}*/
.delivery .dflex .item.col2 .text{font-family:'Trebuchet MS';font-size:15px;color:#333;line-height:23px;}
.delivery .modal-body{max-width:670px;padding:35px 27px;}
.modal-body .svg{margin-top:20px;margin:35px 0 45px;}
.modal-body .text{color:#636363;font-family:'Trebuchet MS';font-size:13px;line-height:20px;}
.modal-body .warn{color:#fd9710;margin:35px 0 45px;margin-top:45px;}
@media (min-width: 992px) {.delivery .dflex .item:hover .button{display:flex;}}
@media (max-width: 992px){
.delivery .button{padding: 10px 10px; margin: 0 auto;}
.delivery .dflex .item:focus .button{display:block;}
.delivery .dflex .item{width:50%}
.delivery .dflex .item.col2{width:100%;}
}
@media (max-width: 768px) {/*540*/}
@media (max-width: 576px) {/*320*/
.delivery .dflex .item{width:100%}
}
</style>
  <div class="row">
    <div id="content" class="delivery">
      <h1><?php echo $heading_title; ?></h1>
      <div class="dflex">
        <div class="item btn-modal" tabindex="0" data-modal="modal-delivery-kurier">
          <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/kurier.svg');?></div>
          <div class="title"><?php echo $text_kurier_tite; ?></div>
          <div class="title"><?php echo $text_delivery_title1; ?></div>
          <div class="buttons"><a class="button btn-modal" data-modal="modal-delivery-kurier"><?php echo $button_more; ?></a></div>
        </div>
        <div class="item btn-modal" tabindex="2" data-modal="modal-delivery-nova-poshta">
          <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/nova-poshta.svg');?></div>
          <div class="title"><?php echo $text_nova_poshta_tite; ?></div>
          <div class="title"><?php echo $text_delivery_title3; ?></div>
          <div class="buttons"><a class="button btn-modal" data-modal="modal-delivery-nova-poshta"><?php echo $button_more; ?></a></div>
        </div>
        <div class="item btn-modal" tabindex="3" data-modal="modal-delivery-justin">
          <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/justin.svg');?></div>
          <div class="title"><?php echo $text_justin_tite; ?></div>
          <div class="title"><?php echo $text_delivery_title3; ?></div>
          <div class="buttons"><a class="button btn-modal" data-modal="modal-delivery-justin"><?php echo $button_more; ?></a></div>
        </div>
        <div class="item btn-modal" tabindex="3" data-modal="modal-delivery-meest">
          <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/meest.svg');?></div>
          <div class="title">Meest</div>
          <div class="title"><?php echo $text_delivery_title3; ?></div>
          <div class="buttons"><a class="button btn-modal" data-modal="modal-delivery-meest"><?php echo $button_more; ?></a></div>
        </div>
        <div class="item btn-modal" tabindex="4" data-modal="modal-delivery-ukrposhta">
          <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/ukrposhta.svg');?></div>
          <div class="title"><?php echo $text_ukrposhta_tite; ?></div>
          <div class="title"><?php echo $text_delivery_title3; ?></div>
          <div class="buttons"><a class="button btn-modal" data-modal="modal-delivery-ukrposhta"><?php echo $button_more; ?></a></div>
        </div>
       
        <div class="item col1" tabindex="6">
          <div class="it">
            <div class="h1"><?php echo $text_inshi1; ?></div>
            <div class="title"><?php echo $text_inshi2; ?><br>(044) 379-09-62<br>(050) 469-95-25<br>(067) 354-56-25</div>
          </div>
        </div>
      </div>

<div class="modal modal-form modal-delivery-kurier">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php echo $text_kurier_tite2; ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/kurier.svg');?></div>
        <div class="title"><?php echo $text_kurier_description; ?></div>
    </div>
  </div>
</div>

<div class="modal modal-form modal-delivery-nova-poshta">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php echo $text_nova_poshta_tite2; ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/nova-poshta.svg');?></div>
        <div class="title"><?php echo $text_nova_poshta_description; ?>
        </div>
    </div>
  </div>
</div>


<div class="modal modal-form modal-delivery-intaim">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php echo $text_intaim_tite2; ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/intaim.svg');?></div>
        <div class="title"><?php echo $text_intaim_description; ?>
        </div>
    </div>
  </div>
</div>


<div class="modal modal-form modal-delivery-justin">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php echo $text_justin_tite2; ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/justin.svg');?></div>
        <div class="title"><?php echo $text_justin_description; ?>
        </div>
    </div>
  </div>
</div>

<div class="modal modal-form modal-delivery-meest">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php 
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (strpos($url, 'prote.ua/ua/') !== false) {
    echo 'Доставка службою "Meest"';
}
else {echo 'Доставка службой "Meest"';}

    
        ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/meest.svg');?></div>
        <div class="title"><?php 

      if (strpos($url, 'prote.ua/ua/') !== false) {
    echo 'Отримання товару в найближчому почтоматі без черг та документів.<br><br>
Час доставки замовлення до 2-х робочих днів. Зверніть увагу, що замовлення буде відправлене лише за умови 100% передплати. Мінімальна сума замовлення 100,00 грн.<br><br>
Всі замовлення, які підтверджені до 17:00 відправляються нами на наступний день. В день відправки ввечері ви отримаєте смс-повідомлення з номером товаротранспортної накладної за якою зможете відстежити вашу посилку. Для отримання товару вам необхідно буде встановити додаток Meest.
<br><br>
<span class="warn">Важливо (!) Вартість доставки завжди розраховується за тарифами Meest і не містить в собі прихованих платежів.</span>';
}
else {echo 'Получение товара в ближайшем почтомате без очередей и документов. <br><br>
Время доставки заказа до 2-х рабочих дней. Обратите внимание, что заказ будет отправлен только по 100% предоплате. Минимальная сумма заказа 100,00 грн.<br><br>
Все заказы, которые подтверждены до 17:00 отправляются нами на следующий день. В день отправки вечером вы получите смс-уведомление с номером товаротранспортной накладной по которой сможете отследить вашу посылку. Для получения товара вам необходимо будет установить приложение Meest.
<br><br>
<span class="warn">Важно (!) стоимость доставки всегда рассчитывается по тарифам Meest и не содержит в себе скрытых платежей.</span>';}
        
        
        ?>
        </div>
    </div>
  </div>
</div>


<div class="modal modal-form modal-delivery-ukrposhta">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php echo $text_ukrposhta_tite2; ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/ukrposhta.svg');?></div>
        <div class="title"><?php echo $text_ukrposhta_description; ?>
        </div>
    </div>
  </div>
</div>





    </div>
  </div>
</div>

<?php echo $footer; ?>