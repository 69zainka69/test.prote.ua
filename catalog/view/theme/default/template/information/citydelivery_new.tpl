<?php echo $header; ?>
<style>
    .breadcrumb{
        margin-bottom:17px;}
    .row.info{display:flex;justify-content:center;}
    h1{color:#00adee;font-size:24px;font-weight:normal;margin-bottom:20px;line-height:40px;position:relative;}
    /*#content{max-width:650px;}*/
    h2, #content .title{font-family:'Trebuchet MS';
        font-size:18px;
        color:#333;
        margin-bottom: 12px;
        font-weight:bold;
        padding-top: 4px;
    }
    h2{
        margin-bottom: 0;}
    .cityes .cont{color:#999999;line-height: 18px;margin-bottom: 18px;}
    .cityes .cont a {color:#00aeef;font-family: 'Trebuchet MS';font-size: 14px;}
    .cityes .cont a:hover {color:#999999;}
    .decription{padding:20px 0;color:#636363;font-size:15px;line-height:27px;font-family: 'Trebuchet MS';}
    /*.decription h4,.decription b{color:#333;font-size:15px;font-weight:normal;display:inline-block;}*/
    .decription p{padding:0 0 12px;}
    .decription ul li{padding-left:15px;list-style: disc;    list-style-position: inside;}
    /*h1 .svg{position: absolute;left:22px;}
    h1 .svg svg{width:43px;}*/
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

    <div class="info">
        <div id="content">
            <h1><?php echo $heading_title; ?></h1>
            <div class="cityes">
                <div class="title"><?php echo $delivery_more_city;?></div>
                <div class="cont">
                    <?php foreach($cityes as $key => $city){ ?>
                    <a href="<?php echo $city['href']?>" title="<?php echo $city['name']?>"><?php echo $city['name']?></a><?php if(count($cityes)!=$key+1){ ?>&nbsp;| <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="decription">
                <?php echo $description; ?>
                <div class="title"><?php echo $delivery_text_title;?></div>
                <?php echo $delivery_text;?>
            </div>
            <style>

                .delivery .dflex{padding-top:45px;margin-bottom:150px;}
                .delivery .dflex{flex-wrap:wrap;}
                .delivery .dflex .item{width:25%;text-align:center;
                    border:1px solid #FFF;
                    padding: 17px 25px 12px;}
                .delivery .dflex .item:hover{border:1px solid #fd9710;}

                .delivery .dflex .svg{height:70px;display:flex;align-items: center;justify-content:center}
                .delivery .dflex svg{height:100%;}
                #content .delivery .dflex .title{color:#636363;font-family:'Trebuchet MS';font-size:15px;
                    padding-top: 15px;
                    margin-bottom: 40px;
                    font-weight: normal;}
                .delivery .dflex .text{color:#999;font-size:11.5px;line-height:13px;margin-bottom:12px;}
                .delivery .buttons{height:41px;}
                .delivery .button{font-family:'Trebuchet MS';font-size:15px;display:none;}


                .delivery .modal-body{max-width:670px;padding:35px 27px;}
                @media (min-width: 992px) {.delivery .dflex .item:hover .button{display:block;}}
                @media (max-width: 992px){
                    .delivery .button{padding: 10px 10px;}
                    .delivery .dflex .item:focus .button{display:block;}
                    .delivery .dflex .item{width:50%}
                }
                @media (max-width: 768px) {/*540*/}
                @media (max-width: 576px) {/*320*/
                    .delivery .dflex .item{width:100%}
                }
            </style>
            <div class="delivery">
                <div class="dflex">
                    <div class="item">
                        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/nova-poshta.svg');?></div>
                        <div class="title"><?php echo $text_nova_poshta_tite; ?></div>
                        <div class="text"><?php echo $text_delivery_title3; ?></div>
                        <div class="buttons"><a href="<?php echo $button_delivery; ?>" class="button" title="<?php echo $text_nova_poshta_tite; ?>1"><?php echo $button_more; ?></a></div>
                    </div>
                   <!-- <div class="item">
                        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/intaim.svg');?></div>
                        <div class="title"><?php echo $text_intaim_tite; ?></div>
                        <div class="text"><?php echo $text_delivery_title3; ?></div>
                        <div class="buttons"><a href="<?php echo $button_delivery; ?>" class="button" title="<?php echo $text_intaim_tite; ?>1"><?php echo $button_more; ?></a></div>
                    </div> -->
                    <div class="item">
                        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/ukrposhta.svg');?></div>
                        <div class="title"><?php echo $text_ukrposhta_tite; ?></div>
                        <div class="text"><?php echo $text_delivery_title3; ?></div>
                        <div class="buttons"><a href="<?php echo $button_delivery; ?>" class="button" title="<?php echo $text_ukrposhta_tite; ?>1"><?php echo $button_more; ?></a></div>
                    </div>
                    <div class="item">
                        <div class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/delivery/nichnyy-ekspres.svg');?></div>
                        <div class="title"><?php echo $text_nichnyy_ekspres_tite; ?></div>
                        <div class="text"><?php echo $text_delivery_title3; ?></div>
                        <div class="buttons"><a href="<?php echo $button_delivery; ?>" class="button" title="<?php echo $text_nichnyy_ekspres_tite; ?>1"><?php echo $button_more; ?></a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php echo $footer; ?>

