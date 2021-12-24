<style>
.df2{flex-wrap:wrap;}
.df2 > div {width:50%;}
.df2 .title span{display:inline-block;font-size:24px;vertical-align:middle;}
.df2 .svg1{height:52px;margin-right: 24px;}
.df2 .i1 .title, .df2 .i2 .title~.title{color:#fd9710;margin-bottom:25px;margin-bottom:25px;}
.df2 .i2 .title{color:#00adee;margin-bottom:25px;}
.df2 .title{color:#00adee;display:flex;align-items: center;}
.df2 .text{color:#636363;font-size:15px;font-family:'Trebuchet MS';line-height:23px;display:block;}
.df2 .i1{padding-right:50px;}
.df2 .i2{padding-left:50px;}
.df2 .text{margin-bottom:25px;}
.df2 a{color:#00adee;text-decoration:underline;}
.df2 a:hover{color:#fd9710;text-decoration:none;}
@media (max-width: 576px) {/*320*/
.df2 > div{width:100%}
.df2 .i1,.df2 .i2{padding:0;}
}
</style>
<div class="dflex df2">
  <div class="i1">
    <div class="title">
      <span class="svg1"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-mozhlyvosti.svg');?></span>
      <span><?php echo $text_sub_title1; ?></span>
    </div>
    <div class="text"><?php echo $text_sub_text1; ?></div>
  </div>
  <div class="i2">
    <div class="title">
      <span class="svg1"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-contact.svg');?></span>
      <span><?php echo $text_sub_title2; ?></span>
    </div>
    <div class="text"><?php echo $text_sub_text2; ?></div>
    <div class="title">
      <span class="svg1"><?php echo file_get_contents(DIR_IMAGE.'/ico/about/pro-nas-otziv.svg');?></span>
      <span><?php echo $text_sub_title3; ?></span>
    </div>
    <div class="text"><?php echo $text_sub_text3; ?></div>
  </div>
  
</div> 