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
.pay .dflex{padding-top:45px;margin-bottom:150px;}
h1, .h1{color:#00adee;font-size:24px;font-weight:normal;padding-left:15px;margin-bottom:20px;}
.h1{padding:0;line-height:36px;}
.pay .dflex{flex-wrap:wrap;}
.pay .dflex .item{width:25%;text-align:center;
  border:1px solid #f7f6f7;
  padding:26px 25px 12px;}
.buttons {display: flex;align-items: center;}
.pay .dflex .item:hover{border:1px solid #00adee;cursor:pointer;}

.pay .dflex .svg{height:70px;}
.pay .dflex svg{height:100%;}
.pay .dflex .nal svg{width:44px;}
.pay .dflex .beznal svg{width:47px;}
.pay .dflex .beznal_nds svg{width:63px;}
.pay .dflex .card svg{width:63px;height:75px;margin-top:-13px;}
.pay .dflex .title{color:#636363;font-family:'Trebuchet MS';font-size:15px;padding-top:5px;margin-bottom:38px;}
.pay .dflex .text{color:#999;font-size:11.5px;line-height:13px;margin-bottom:12px;}
.pay .buttons{height:41px;padding: 0px;}
.pay .button{font-family:'Trebuchet MS';font-size:15px;display:none;}
.pay .button.blue{background:#00adee; padding: 10px 20px;color: #fff !important;margin: 0 auto;text-decoration: none;}
.pay .button.blue:hover{background:#017ead;}
.pay .modal-body{max-width:670px;padding:35px 27px;}
.pay .modal-body .svg{margin-top:20px;margin:35px 0 45px;}
.pay .modal-body .text{color:#636363;font-family:'Trebuchet MS';font-size:13px;line-height:20px;}
.pay .modal-body .bl{color:#00adee;text-decoration:underline;}
.pay .modal-body .b{color:#333;}
@media (min-width: 992px) {.pay .dflex .item:hover .button{display:inline-block;}}
@media (max-width: 992px){
.pay .button{padding: 10px 10px;}  
.pay .dflex .item:focus .button{display:block;}
.pay .dflex .item{width:50%}
.pay .dflex .item.col2{width:100%;}
}
@media (max-width: 768px) {/*540*/}
@media (max-width: 576px) {/*320*/
.pay .dflex .item{width:100%}
}

</style>
  <div class="row">
    <div id="content" class="pay">
      <h1><?php echo $heading_title; ?></h1>
      <div class="dflex">
        <div class="item btn-modal" tabindex="0" data-modal="modal-pay-nal">
          <div class="svg nal"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/gotivka.svg');?></div>
          <div class="title"><?php echo $text_nal_tite; ?></div>
          <div class="text"><?php echo $text_nal_text; ?></div>
          <div class="buttons"><a class="button btn-modal blue" data-modal="modal-pay-nal"><?php echo $button_more; ?></a></div>
        </div>
        <div class="item btn-modal" tabindex="1" data-modal="modal-pay-beznal">
          <div class="svg beznal"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/bezgotivka.svg');?></div>
          <div class="title"><?php echo $text_beznal_tite; ?></div>
          <div class="text"><?php echo $text_beznal_text; ?></div>
          <div class="buttons"><a class="button btn-modal blue" data-modal="modal-pay-beznal"><?php echo $button_more; ?></a></div>
        </div>
        <div class="item btn-modal" tabindex="2" data-modal="modal-pay-beznal-NDS">
          <div class="svg beznal_nds"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/bezgotivka-PDV.svg');?></div>
          <div class="title"><?php echo $text_beznal_tite_NDS; ?></div>
          <div class="text"><?php echo $text_beznal_text_NDS; ?></div>
          <div class="buttons"><a class="button btn-modal blue" data-modal="modal-pay-beznal-NDS"><?php echo $button_more; ?></a></div>
        </div>
        <div class="item btn-modal" tabindex="3" data-modal="modal-pay-card">
          <div class="svg card"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/card.svg');?></div>
          <div class="title"><?php echo $text_card_tite; ?></div>
          <div class="text"><?php echo $text_card_text; ?></div>
          <div class="buttons"><a class="button btn-modal blue" data-modal="modal-pay-card"><?php echo $button_more; ?></a></div>
        </div>
        
      </div>


<div class="modal modal-form modal-pay-nal">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php echo $text_nal_tite2; ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/gotivka.svg');?></div>
        <div class="text"><?php echo $text_nal_desc; ?></div>
    </div>
  </div>
</div>   
<div class="modal modal-form modal-pay-beznal">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php echo $text_beznal_tite; ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/bezgotivka.svg');?></div>
        <div class="text"><?php echo $text_beznal_desc; ?></div>
    </div>
  </div>
</div>   
 <div class="modal modal-form modal-pay-beznal-NDS">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php echo $text_beznal_tite_NDS; ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/bezgotivka-PDV.svg');?></div>
        <div class="text"><?php echo $text_beznal_desc_NDS; ?></div>
    </div>
  </div>
</div>      
<div class="modal modal-form modal-pay-card">
  <div class="body">
    <div class="modal-overlay"></div>
    <div class="modal-body">
      <div class="modal-close">+</div>
        <div class="title h1"><?php echo $text_card_tite; ?></div>
        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/payment/card.svg');?></div>
        <div class="text"><?php echo $text_card_desc; ?>
        </div>
    </div>
  </div>
</div> 

      
      
      

    </div>
  </div>
</div>

<?php echo $footer; ?>