<?php echo $header; ?>
<style>
.breadcrumb{margin-bottom: 20px;}
h1{color:#00adee;font-size:24px;font-weight:normal;margin-bottom:25px;padding-left:19px;margin-top:5px;}
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
    #works{width:100%;}
    #works .content a{color:#00adee;}
    #works .content a:hover{color:#fd9710;}
    #works .content{font-size:15px;line-height:23px;padding-bottom:36px;margin-top:9px;padding-left:19px;font-family:'Trebuchet MS';}
    #works .content p{margin-bottom:24px;}
    .steps{display:flex;justify-content:center;flex-wrap:wrap;}
    .steps>div{width:29%;text-align:center;position:relative;margin-bottom:6.8%;}
    .steps>div+div:before{content:'';position:absolute;height:57%;width:0;border-left:1px solid #f9f8f9;top:2.5%;left:0;}
    .steps svg{width:119px;height:auto;}
    .steps .step2 svg path{fill:#fd9710;}
    .steps .txt{padding-top:17px;padding-bottom:13%;line-height:23px;font-family:'Trebuchet MS';font-size:15px;color:#636363;}
    #works .button{font-family:'Trebuchet MS';font-size:15px;color:#00adee;text-align:left;background:none;border-radius: 5px;border:2px solid #00aeef;width: 100%;padding:9px 5px 9px 10px;position: relative;line-height: 40px;text-align: center;background:none;width:180px;}
    #works .button:hover{border-color:#fd9710;color:#fd9710;}
    #works .b2 .button{border-color:#fd9710;color:#fd9710;}
    #works .b2 .button:hover{border-color:#00adee;color:#00adee;}
    .slog{font-size:15px;color:#636363;line-height:23px;text-align:center;margin:3.9% 0 4.8%;}
    a.orange,a.blue:hover{color:#fd9710;}
    a.blue,a.orange:hover{color:#00adee;}
    .dflex .item.col_2{padding:32px 17px 20px;flex-direction: column;width:50%;display:flex;align-content:center;justify-content:center;text-align:left;border:none;padding-bottom:0;}
    .item.col_2 .r{display:flex;align-items: center;}
    .col_2 .svg{padding-right:13px;}
    .col_2 .title{font-size:24px;color:#00adee;font-family: 'Open Sans',sans-serif;}
    .col_2+.col_2{padding-left:30px;}
    .col_2+.col_2 .title{color:#fd9710;}
    .col_2 .text{padding-top:19px;font-family:'Trebuchet MS';font-size:15px;color:#636363;line-height:23px;}
    .readycart{flex-wrap:wrap;margin-bottom: 5.5%;}
    @media (max-width:766px){
        #works .button{width:95%;}
    }
    @media (max-width:575px){
    .dflex .item.col_2{width:100%;}
    .steps>div{width:100%;}
    }
    </style>
    <div id="works">
        <div class="content">
            <?php if (isset($text_description)){
            echo $text_description; 
            }
            ?>
        </div>
        <div class="steps">
            <div class="step1">
                <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/workers/do25sm.svg');?></span>
                <div class="txt"><?php echo $text_1; ?></div>
                <div class="buttons">
                  <a href="<?php echo $langurl; ?>/workers/do-25-sotrudnikov/" title="до 25-ти сотрудников" class="button"><?php echo $text_ul; ?></a>
                </div>
            </div>
            <div class="step2">
                <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/workers/do50sm.svg');?></span>
                <div class="txt"><?php echo $text_2; ?></div>
                <div class="buttons b2">
                  <a href="<?php echo $langurl; ?>/workers/do-50-sotrudnikov/" title="" class="button"><?php echo $text_ul; ?></a>
                </div>
            </div>
            <div class="step3">
                <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/workers/ponad50sm.svg');?></span>
                <div class="txt"><?php echo $text_3; ?></div>
                <div class="buttons">
                  <a href="<?php echo $langurl; ?>/workers/do-75-sotrudnikov/" title="" class="button"><?php echo $text_ul; ?></a>
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