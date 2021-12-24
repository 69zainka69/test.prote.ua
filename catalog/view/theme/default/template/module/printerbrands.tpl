<svg style="display:none;height:0;width:0;">
<style>
#materials{margin-top:29px;width:100%;}
.materials_title {color:#333;font-size:17px;position:relative;padding:11px 0 13px 50px;border-bottom:3px solid #333;}
.materials_title svg{position:absolute;left:0;top:1px;}
.materials_title svg path{fill:#333;}
.materials_content{display:flex;-webkit-flex-wrap: wrap;flex-wrap: wrap;justify-content: space-around;padding-top:18px;}
.materials_content > div {flex-basis:145px;margin-bottom: 23px;text-align: center;height: 80px;position: relative;}
.materials_content .fcol > div { }
.materials_content > div > div {padding:0 0 12px;border:1px solid #fff;position: absolute;width: 100%;}
.materials_content > div:hover > div {border:1px solid #dfdfdf;z-index: 15;cursor:pointer;background:#fff;}
.materials_content .img{z-index:8;text-align:center;width:143px;height: 72px;display: table-cell;vertical-align: middle;}
.materials_content img{z-index:8;}
.materials_content .h{ opacity: 0;height: 0;overflow: hidden;background: #fff;border-top:none;transition: 0.3s linear;width: 100%;z-index: 55;    position: relative;padding:0 18px;}
.materials_content > div:hover .h{opacity: 1; height: auto;margin-top: 15px;}
.materials_content a {display: block;text-align: center;line-height: 40px;width: 100%;background: #bee9f9;}
.materials_content a:hover {background: #4acdfd;color:inherit;}
.materials_content a+a {margin-top: 8px;}
.kassa {color:#ff0305;font-size:12px;font-weight:bold;line-height: 20px;padding-top: 10px!important;}
.kassa a{line-height: 16px; }
</style>
</svg>
<div id="materials">
    <div class="materials_title">
        <?php echo file_get_contents(DIR_IMAGE.'/ico/14-pidbir.svg');?></span>
        <?php if($route=='product/brand'){ ?>
<style>
    h1{font-size:23px;color:#00adee;font-weight:normal;display: inline-block;vertical-align: middle;}
    .materials_title {border-color:#00adee;}
    .materials_title svg path{fill:#00adee;}
</style>
            <h1><?=$text_selbrand?></h1>
        <?php } else { ?>
            <?=$text_selbrand?>
        <?php } ?>
    </div>
    <div class="materials_content">
        <?php foreach ($brands as $key=>$value) { ?>
            <div class="fcol">
                <div class="brother">

                    <div class="img ">
                        <?php if($value['brand']!='XER') { ?>
                            <?php echo file_get_contents(DIR_IMAGE.'ico/brands/'.mb_strtolower($value['brand']).'.svg'); ?>
                        <?php } else { ?>
                            <img src="image/ico/favicon_prote_16x16.svg" data-original="/image/ico/brands/<?php echo mb_strtolower($value['brand']); ?>.png" alt="Xerox" title="Xerox">
                        <?php } ?>
                    </div>
                    <div class="h">
                        <?php foreach ($value['cats'] as $cat=>$val) { ?>
                            <a href="<?=$val['url']?>" title="<?=$val['name']?>"><?=$val['name']?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="fcol">
         <div class="kassa">
            <a href="/cash-devices/consum/"><?=$text_cassapparat?></a>
        </div>
        </div>
        
    </div>

</div>
