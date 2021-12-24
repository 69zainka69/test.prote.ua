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
    #solutions{width:100%;}

    #solutions .content{padding:3.4% 0 2% 0;display:flex;flex-wrap:wrap;}
    #solutions .content>div{width:26.3%;}
    #solutions .content .text_buttons{padding:0 0 0 4.5%;margin-top:-9px;width:21%;}
    #solutions .content .text{font-size:13px;line-height:17px;padding-bottom:40px;margin-top:9px;}
    #solutions .text p{margin-bottom:10px;}
    
    #solutions .ssolutions{position:relative;}
    #solutions .sol{width:210px;position:relative;height:84px;box-sizing:border-box;margin:auto;}
    #solutions .sol+.sol{margin-top:26px;}
    #solutions .ssolutions+.ssolutions:after{content:'';position:absolute;height:93%;width:0;border-left:1px solid #f9f8f9;top:3.5%;left:0;}
    #solutions .sol:before{content:'';position:absolute;right:0;top:0;width:170px;height:44px;}
    #solutions .s1:before{background: url('/image/ico/sol_sp.jpg') 0 0;}
    #solutions .s2:before{background: url('/image/ico/sol_sp.jpg') -170px 0;}
    #solutions .s3:before{background: url('/image/ico/sol_sp.jpg') -340px 0;}
    #solutions .s4:before{background: url('/image/ico/sol_sp.jpg') 0 -44px;}
    #solutions .s5:before{background: url('/image/ico/sol_sp.jpg') -170px -44px;}
    #solutions .s6:before{background: url('/image/ico/sol_sp.jpg') -340px -44px;}
    #solutions .txt{position:relative;}
    #solutions .txt a{display:block;padding:49px 0 0 86px;font-size:12px;font-family:'Trebuchet MS';
    line-height:14px;position: relative;}
    #solutions .sol a:hover{color:#fd9710;text-decoration:underline;}
    #solutions .sol span.svg{position:absolute;z-index:6;}
    #solutions .s1 span.svg{left:16px;top:17px;}
    #solutions .s2 span.svg{left:11px;top:17px;}
    #solutions .s3 span.svg{left:15px;top:17px;}
    #solutions .s4 span.svg{left:8px;top:20px;}
    #solutions .s5 span.svg{left:12px;top:11px;}
    #solutions .s6 span.svg{left:26px;top:16px;}
    #solutions .sol .txt:after{content:'';position: absolute;left:-2px;top:0;width:82px;height:82px;border-radius:50%;background:#fd9710;z-index:5;}
    #solutions .sol a:after{content:'';position: absolute;bottom:10px;right:2px;width: 8px;height: 8px;border-top: 1px solid #fd9710;border-right: 1px solid #fd9710;-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);-ms-transform: rotate(45deg);-o-transform: rotate(45deg);transform: rotate(45deg);}
    .steps{border-top:3px solid #fd9710;display:flex;justify-content:center;flex-wrap:wrap;}
    .steps>div{width:29%;margin:4.3% 0;text-align:center;position:relative;}
    .steps>div+div:before{content:'';position:absolute;height:93%;width:0;border-left:1px solid #f9f8f9;top:3.5%;left:0;}
    .steps .txt{padding-top:17px;line-height:23px;font-family:'Trebuchet MS';font-size:15px;color:#636363;}
    .dflex .item.col_2{padding:32px 17px 20px;flex-direction: column;width:50%;display:flex;align-content:center;justify-content:center;text-align:left;border:none;padding-bottom:0;}
    .item.col_2 .r{display:flex;align-items: center;}
    .col_2 .svg{padding-right:13px;}
    .col_2 .title{font-size:24px;color:#00adee;font-family: 'Open Sans',sans-serif;}
    .col_2+.col_2{padding-left:30px;}
    .col_2+.col_2 .title{color:#fd9710;}
    .col_2 .text{padding-top:19px;font-family:'Trebuchet MS';font-size:15px;color:#636363;line-height:23px;}
    .slog{font-size:15px;color:#636363;line-height:23px;text-align:center;margin:3.9% 0 4.8%;}
    .orange{color:#fd9710;}
    .blue{color:#00adee;}
    .blue:hover{color:#fd9710;}
    .readycart{margin-bottom:8%;flex-wrap:wrap;}
    @media (max-width: 991px){
    #solutions .content{flex-wrap: wrap-reverse;}
    #solutions .content>div{width:33.33%;}
    #solutions .content .text_buttons{width:100%;}
    #solutions .content .text{padding:30px 0 0;}
        
    }
    @media (max-width:766px){
    #solutions .content .text_buttons{width:50%;}
    #solutions .content>div{width:50%;margin-bottom:30px;}
    #solutions .ssolutions:nth-child(3):after{border-left:none;}
    .steps>div{width:33%;}
    }
    @media (max-width:575px){
    #solutions .content .text_buttons{width:100%;}
    #solutions .content>div{width:100%;}
    #solutions .ssolutions:after{border-left:none!important;}
    .steps>div{width:100%;}
    .dflex .item.col_2{width:100%;}
    }
    </style>
    <div id="solutions">
        <div class="content">
            <div class="text_buttons">
                <div class="text"><?php echo $text_description; ?>
                </div>
            </div>
            <div class="ssolutions">
                <div class="sol s1">
                    <div class="txt">
                        <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/17-pidpryemstva.svg');?></span>
                        <a href="<?php echo $langurl; ?>/gotovye-reshenija/promyshlennye-predprijatija/"><?php echo $text_usluga1; ?></a></div>
                </div>
                <div class="sol s2">
                    <div class="txt">
                        <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/19-osvita.svg');?></span>
                        <a href="<?php echo $langurl; ?>/gotovye-reshenija/uchrezhdenija-obrazovanija/"><?php echo $text_usluga2; ?></a></div>
                </div>
            </div>
            <div class="ssolutions">
                <div class="sol s3">
                    <div class="txt">
                        <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/21-med.svg');?></span>
                        <a href="<?php echo $langurl; ?>/gotovye-reshenija/uchrezhdenija-zdravoohranenija/"><?php echo $text_usluga3; ?></a></div>
                </div>
                <div class="sol s4">
                    <div class="txt">
                        <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/18-hotel.svg');?></span>
                        <a href="<?php echo $langurl; ?>/gotovye-reshenija/gostinicy-restorany-kafe/"><?php echo $text_usluga4; ?></a></div>
                </div>
            </div>
            <div class="ssolutions">
                <div class="sol s5">
                    <div class="txt">
                        <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/20-shop.svg');?></span>
                        <a href="<?php echo $langurl; ?>/gotovye-reshenija/predprijatie-torgovli-i-logistiki/"><?php echo $text_usluga5; ?></a></div>
                </div>
                <div class="sol s6">
                    <div class="txt">
                        <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/22-bank.svg');?></span>
                        <a href="<?php echo $langurl; ?>/gotovye-reshenija/banki-i-ofisy/"><?php echo $text_usluga6; ?></a></div>
                </div>
            </div>
        </div>
        <div class="steps">
            <div class="step1">
                <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/solutions/obraty-galuz-osn-big.svg');?></span>
                <div class="txt">
                    <?php echo $text_step1; ?>
                </div>
            </div>
            <div class="step2">
                <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/solutions/pidibraty-osn-big.svg');?></span>
                <div class="txt">
                    <?php echo $text_step2; ?>
                </div>
            </div>
            <div class="step3">
                <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/solutions/zamovyty-osn-big.svg');?></span>
                <div class="txt">
                    <?php echo $text_step3; ?>
                </div>
            </div>
        </div>
        <div class="slog">
            <?php echo $text_slog; ?>
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

    </div>  

  </div>
</div>
<?php echo $footer; ?> 