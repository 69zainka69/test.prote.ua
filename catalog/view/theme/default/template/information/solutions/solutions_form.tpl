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
    .sol_top{display:flex;flex-wrap:nowrap;align-items:flex-start;padding:2.7% 0 4.7%;border-bottom:3px solid #fd9710;margin-bottom:4.1%;}
    .sol{min-width:210px;position:relative;box-sizing:border-box;margin:5px 2.3% 5px 4.2%;}
    .sol .txt a{display:block;padding:49px 0 0 86px;font-size:12px;font-family:'Trebuchet MS';
    line-height:14px;position: relative;}
    .sol a:hover{color:inherit;cursor:inherit;}
    .sol span.svg{position:absolute;z-index:6;}
    .sol:before{content:'';position:absolute;right:0;top:0;width:170px;height:44px;}
    
    <?php if(isset($style)){ ?>
        .s2 span.svg{<?php echo $style; ?>}
    <?php } else { ?>
        .s2 span.svg{left:11px;top:17px;}
    <?php } ?>
    <?php if(isset($style2)){ ?>
        .s2:before{<?php echo $style2; ?>}
    <?php } else { ?>
        .s2:before{background: url('/image/ico/sol_sp.jpg') -170px 0;}
    <?php } ?>
    .sol .txt:after{content:'';position: absolute;left:-2px;top:0;width:82px;height:82px;border-radius:50%;background:#fd9710;z-index:5;}
    .sol a:after{content:'';position: absolute;bottom:10px;right:2px;width: 8px;height: 8px;border-top: 1px solid #fd9710;border-right: 1px solid #fd9710;-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);-ms-transform: rotate(45deg);-o-transform: rotate(45deg);transform: rotate(45deg);}
    .sol_top .info{padding:3px 1% 5px 2.4%;;border-left:1px solid #f8f7f8;color:#999;font-size:12px;line-height:15px;}
    .info p+p{margin-top:15px;}
    .step{display:flex;margin:5px 0;}
    .step svg{width:61px;height:auto;}
    .step .txt{padding-left:18px;padding-top:5px;}
    .step.s1{min-width:257px;}
    .step.s2{min-width:197px;}

    </style>
    <div class="">
        <div class="sol_top">
            <div class="sol s2">
                <div class="txt">
                    <span class="svg"><?php echo file_get_contents(DIR_IMAGE.$svg);?></span>
                    <a href="" rel="nofollow" onclick="return false;"><?php echo $txt; ?></a>
                </div>
            </div>
            <div class="info">
                <?php echo $text_info; ?>
            </div>
            <div class="step s1">
                <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/solutions/pidibraty-osn-big.svg');?></span>
                <div class="txt">
                    <?php echo $text_step2; ?>
                </div>
            </div>
            <div class="step s2">
                <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/solutions/zamovyty-osn-big.svg');?></span>
                <div class="txt">
                    <?php echo $text_step3; ?>
                </div>
            </div>

        </div>
        <?php if(isset($categories) && $categories){ ?>
<style>
        /*.grid{margin:0 4%;}*/
        .grid-item{width:33.33%;display:flex;flex-wrap:nowrap;padding-bottom:25px;}
        .grid .image{width:126px;min-width:126px;height:126px;}
        .grid .image img{margin:0 13px;}
        .name_cat{color:#00adee;font-size:15px;font-family:'Trebuchet MS';padding-top:30px;padding-bottom:20px;}
        .child_cat{width:250px;}
        .child_cat li{line-height:19px;}
        .child_cat a{color:#636363;font-size:13px;font-family:'Trebuchet MS';line-height:19px;  display:inline-block;}
        .child_cat a:hover{color:#fd9710;text-decoration:underline;}
        @media (max-width: 1299px){
            .grid-item{width:50%;}
        }
        @media (max-width: 991px){
            .sol_top{flex-wrap:wrap;}
            .grid-item{flex-direction:column;}
            .name_cat{padding-top:0;}
            .sol_top .info{width:60%;margin-bottom:5%;}
            .step.s1{margin-left:4.2%;}
        }
        @media (max-width:766px){
            .sol_top .info{width: 50%;}
        }
        @media (max-width:575px){
            .grid-item{width:80%;margin:0 10%;}
            .sol_top .info{width:100%;margin-top:20px;}
            .step.s2{margin-left: 4.2%;}
        }
        </style>
        <div class="grid" data-masonry='{ "itemSelector": ".grid-item"}'>
            <?php foreach($categories as $category){ ?>
            <div class="grid-item">
                <div class="image">
                    <?php if($category['image']){ ?>
                    <img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $category['image']; ?>" alt="<?php echo $category['name'] ?>" title="<?php echo $category['name'] ?>">
                    <?php } ?>
                </div>
                <div class="info_cat">
                    <div class="name_cat"><?php echo $category['name'] ?> ></div>
                    <div class="child_cat">
                    <?php if(isset($category['children'])){ ?>
                    <ul>
                        <?php foreach($category['children'] as $child){ ?>
                        <li><a href="<?php echo $child['href']; ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?></a></li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
<style>
        .slog{font-size:15px;color:#636363;line-height:23px;text-align:center;margin:3.9% 0 4.8%;}
        .orange{color:#fd9710;}
        .blue{color:#00adee;}
        .slog .blue:hover{color:#fd9710;}
        </style>
        <div class="slog">
            <?php echo $text_slog; ?>
        </div>
    </div>  
  </div>
</div>
<script>
<?php echo file_get_contents(DIR_APPLICATION.'view/js/masonry.pkgd.min.js'); ?>
</script>
<?php echo $footer; ?> 