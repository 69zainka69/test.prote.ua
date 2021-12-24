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
.warranty {width:100%;}
.warranty a{color:#00adee;}
.warranty a:hover{color:#fd9710;}
.warranty .decription{font-family:'Trebuchet MS';font-size:15px;padding:12px 0 0 15px;color:#636363;line-height:22px;}
.warranty .dflex.main{margin-top:32px;margin-bottom:83px;flex-direction:column;border: 1px solid #f7f6f7;}
h1{color:#00adee;font-size:24px;font-weight:normal;padding-left:15px;margin-bottom:20px;}
.item_row{flex-wrap:wrap;flex-direction:row;}
.item_col{flex-direction:row;padding: 15px 0;overflow:hidden;}
.item_col.si1{width:25%;padding-right:1%;display:table;}
.item_col.si2{width:75%;padding-left:2%;flex-wrap:wrap;align-items:center;}
.item_col.si2>div{margin:11px 0;}
.item_col.si1>div{display:inline-block;vertical-align:middle;display:table-cell;}
.item_col .name{width:31%;padding-right:20px;line-height:19px;}
.item_col .desc{width:69%;line-height:13px;padding-left:2%;}
.item_row .svg{width:91px;text-align:center;padding:0 12px 0 25px;min-width:91px;}
.item_row .title{font-family:'Trebuchet MS';font-size:15px;}
.item_row:nth-child(odd) .title{color:#00adee;}
.item_row:nth-child(even) .title{color:#fd9710;}
.item_row .name{font-family:'Trebuchet MS';color:#636363;font-size:15px;}
.item_row .desc{font-size:11.5px;color:#999;position:relative;}
.item_row .desc:before{content: "";height: 200px;width: 1px;position: absolute;top: -60px;background:#f7f6f7;left:0;}
.item_row+.item_row{border-top: 1px solid #f7f6f7;}
.item_col+.item_col{border-left: 1px solid #f7f6f7;}



/*.warranty .dflex .svg{height:85px;}
.warranty .dflex svg{height:100%;}*/
/*.warranty .dflex .title{font-size:24px;padding-top:30px;margin-bottom:27px;}
.warranty .dflex .item:nth-child(odd) .title{color:#fd9710;}
.warranty .dflex .item:nth-child(even) .title{color:#00adee;}
.warranty .dflex .text{color:#636363;font-size:15px;line-height:23px;margin-bottom:12px;font-family:'Trebuchet MS';}*/

@media (max-width: 992px){
.item_col{flex-direction: column;}
.item_col .name,.item_col .desc{width:100%;}
.item_row .desc:before{background:none;}
.item_col .name{padding-left:2%;}
.item_col.si2{padding-left:0;}
.item_row .name~.name{border-top: 1px solid #f7f6f7;}
.item_col.si2>div{margin:0;}
.item_col.si2>div{padding-top:11px;padding-bottom:11px;}
.item_row .svg{padding:0 12px 0 5px;min-width:71px;width:71px;}
.row3 .name,.row4 .name,.row5 .name,.row6 .name,.row7 .name{display:none;}
.item_col.si2 .name{padding-bottom:0;}
}
@media (max-width: 768px) {/*540*/
.item_col.si1{width:35%;}
.item_col.si2{width:65%;}
}
@media (max-width: 576px) {/*320*/
.item_col.si1{width:100%;}
.item_col.si2{width:100%;}
.item_col+.item_col{border-top:1px solid #f7f6f7;border-left:none;}
}


</style>
  <div class="row">
    <div id="content" class="warranty">
      <h1><?php echo $heading_title; ?></h1>
      <div class="decription">
        <?php echo $text_description; ?>
      </div>
      <div class="dflex main">
        <div class="item_row dflex row1">
          <div class="item_col si1 dflex">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/warranty/garantiya-cart.svg');?></div>
            <div class="title"><?php echo $text_title1; ?></div>
          </div>
          <div class="item_col si2 dflex">
            <div class="name"><?php echo $text_name11; ?></div>
            <div class="desc"><?php echo $text_descr11; ?></div>
            <div class="name"><?php echo $text_name12; ?></div>
            <div class="desc"><?php echo $text_descr12; ?></div>
            <div class="name"><?php echo $text_name13; ?></div>
            <div class="desc"><?php echo $text_descr13; ?></div>
            <div class="name"><?php echo $text_name14; ?></div>
            <div class="desc"><?php echo $text_descr14; ?></div>
          </div>
        </div>
        <div class="item_row dflex row2">
          <div class="item_col si1 dflex">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/warranty/garantiya-papir.svg');?></div>
            <div class="title"><?php echo $text_title2; ?></div>
          </div>
          <div class="item_col si2 dflex">
            <div class="name"><?php echo $text_name21; ?></div>
            <div class="desc"><?php echo $text_descr21; ?></div>
            <div class="name"><?php echo $text_name22; ?></div>
            <div class="desc"><?php echo $text_descr21; ?></div>
            <div class="name"><?php echo $text_name23; ?></div>
            <div class="desc"><?php echo $text_descr21; ?></div>
          </div>
        </div>
        <div class="item_row dflex row3">
          <div class="item_col si1 dflex">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/warranty/garantiya-chornyla.svg');?></div>
            <div class="title"><?php echo $text_title3; ?></div>
          </div>
          <div class="item_col si2 dflex">
            <div class="name"></div>
            <div class="desc"><?php echo $text_descr3; ?></div>
          </div>
        </div>
        <div class="item_row dflex row4">
          <div class="item_col si1 dflex">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/warranty/garantiya-chystylky.svg');?></div>
            <div class="title"><?php echo $text_title4; ?></div>
          </div>
          <div class="item_col si2 dflex">
            <div class="name"></div>
            <div class="desc"><?php echo $text_descr4; ?></div>
          </div>
        </div>
        <div class="item_row dflex row5">
          <div class="item_col si1 dflex">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/warranty/garantiya-pk.svg');?></div>
            <div class="title"><?php echo $text_title5; ?></div>
          </div>
          <div class="item_col si2 dflex">
            <div class="name"></div>
            <div class="desc"><?php echo $text_descr5; ?></div>
          </div>
        </div>
        <div class="item_row dflex row6">
          <div class="item_col si1 dflex">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/warranty/garantiya-snpch.svg');?></div>
            <div class="title"><?php echo $text_title6; ?></div>
          </div>
          <div class="item_col si2 dflex">
            <div class="name"></div>
            <div class="desc"><?php echo $text_descr6; ?></div>
          </div>
        </div>
        <div class="item_row dflex row7">
          <div class="item_col si1 dflex">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/warranty/garantiya-pzk.svg');?></div>
            <div class="title"><?php echo $text_title7; ?></div>
          </div>
          <div class="item_col si2 dflex">
            <div class="name"></div>
            <div class="desc"><?php echo $text_descr7; ?></div>
          </div>
        </div>
        <div class="item_row dflex row8">
          <div class="item_col si1 dflex">
            <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/warranty/garantiya-nosiyi.svg');?></div>
            <div class="title"><?php echo $text_title8; ?></div>
          </div>
          <div class="item_col si2 dflex">
            <div class="name"><?php echo $text_name81; ?></div>
            <div class="desc"><?php echo $text_descr81; ?></div>
            <div class="name"><?php echo $text_name82; ?></div>
            <div class="desc"><?php echo $text_descr81; ?></div>
            <div class="name"><?php echo $text_name83; ?></div>
            <div class="desc"><?php echo $text_descr83; ?></div>
          </div>
        </div>

      </div>

 
    </div>
  </div>
</div>
<?php echo $footer; ?>