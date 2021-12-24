
<?php 
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


$findme = 'lazercat';

$pos = stripos($url, $findme);
if ($pos !== false) {
  if(isset($urls) && $url != $urls){
header("HTTP/1.1 301 Moved Permanently"); 
 header("Location: $urls"); 
 exit(); 
}
}

if (!$this->registry->get('category_ajax')) : ?>
<?php echo $header; ?>  
<style>
@media screen and (max-width: 545px) {
  .liness{
    border: 1px solid black ;
    padding-right: 1px !important;
    padding-left: 1px !important;
    padding-bottom: 0px !important;
    padding-top: 0px !important;
    width: 98% !important;
    margin-left: 1%;
  }
.line540{
  display:none !important;
}
.lines540{
  display:block !important;
}
.text.dflex.plashka2 {
    flex-direction: column !important;
}}
@media screen and (max-width: 967px) {
 .text.dflex.plashka2 {
    display: flex !important;
  }
.plashka{
  display:none !important;
}
}
.hovers{
  cursor: pointer;
}
.hovers:hover{
  color:#03739d;
}
.row.dflex{display:flex;flex-direction:row;flex-wrap:nowrap;}
#content{width:100%;}
<?php if(!isset($models)){ ?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/select.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/products.css');?>
<?php echo file_get_contents(DIR_APPLICATION.'/view/js/pagination.css');?>
.products {flex-wrap: wrap;}
<?php } ?>
.description{font-size:12px;color:#333;line-height:15px;font-family:'Trebuchet MS';}
.description h2{margin:20px 0 10px; }
.description p{margin-bottom:10px;}
.description a{color:#00adee;}
.description a:hover{color:#fd9710;}
.description ul{margin-bottom:15px; }
.description li{list-style:disc; margin-left: 30px;}
</style>
<div id="brands" class="container">

<?php 
if ($pos !== false) {
if($bread_grup != null){
echo $bread_grup;
}}else{
?>
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
    <?php }
    echo " </ul>";
    } ?>
 

  
  <?php if(isset($printerbrands)){ ?>
    <?php echo $printerbrands; ?>
<style>
    #materials .content{padding-top:39px!important;}
    .help{padding-bottom:18%;text-align:right;font-size:11.5px;}
    </style>
    <div class="help"><?php echo $text_help; ?></div>
    <?php include(DIR_APPLICATION.'view/theme/default/template/information/html/about_us_bottom.tpl'); ?>
  <?php } else { ?>
<style>
          #brands .content {padding-top: 39px!important;}
          h1{font-size:23px;color:#00adee;font-weight:normal;display: inline-block;vertical-align: middle;}
          .rowh1{justify-content:space-between;align-items: center;margin-bottom:20px;}
          .rowh1{border-bottom: 3px solid #00adee;}
          .h1{padding: 5px 0 10px 15px;}
          .h1 svg{margin-right:20px;}
          .h1 .svg{ display: inline-block;vertical-align: middle;}
          .h1 .svg path{fill:#00adee;}
        </style>
      
      <div class="row rowh1">
        <div class="h1">
          <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/14-pidbir.svg');?></span>


        <h1 class="hovers" onclick="openbox('box'); return false"> <?php 
          if ($pos !== false) {
          if(isset($names_grup)){ echo $names_grup;
        }}else{ echo $heading_title; } ?></h1>
        </div>



<div id="box" style="display: none;">
<?php 
if(isset($urls)){
        
if($names_grup == $name_grup){

          echo "<h3>".$name_grup."</h3>";
           foreach($prodtwo as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}

if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
  echo "<h3>".$name_gruptse."</h3>";
 foreach($prodtwotse as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }





 if($names_grup == $name_grupt){
 echo "<h3>".$name_grupt."</h3>";
           foreach($prodtwot as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
  echo "<h3>".$name_gruptse."</h3>";
 foreach($prodtwotse as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }



if($names_grup == $name_grupts){
 echo "<h3>".$name_grupts."</h3>";
           foreach($prodtwots as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_gruptse != null){
  echo "<h3>".$name_gruptse."</h3>";
 foreach($prodtwotse as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
}


if($names_grup == $name_gruptse){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
if($names_grup == $name_grup4){
 echo "<h3>".$name_grup4."</h3>";
           foreach($prod4 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
if($names_grup == $name_grup5){
 echo "<h3>".$name_grup5."</h3>";
           foreach($prod5 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
if($names_grup == $name_grup6){
 echo "<h3>".$name_grup6."</h3>";
           foreach($prod6 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup7){
 echo "<h3>".$name_grup7."</h3>";
           foreach($prod7 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup8){
 echo "<h3>".$name_grup8."</h3>";
           foreach($prod8 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup9){
 echo "<h3>".$name_grup9."</h3>";
           foreach($prod9 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup10){
 echo "<h3>".$name_grup10."</h3>";
           foreach($prod10 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup11){
 echo "<h3>".$name_grup11."</h3>";
           foreach($prod11 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }if($names_grup == $name_grup12){
 echo "<h3>".$name_grup12."</h3>";
           foreach($prod12 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }if($names_grup == $name_grup13){
 echo "<h3>".$name_grup13."</h3>";
           foreach($prod13 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }





        } ?>
</div>



<script type="text/javascript">

function openbox(id){
    display = document.getElementById(id).style.display;

    if(display=='none'){
       document.getElementById(id).style.display='block';
    }else{
       document.getElementById(id).style.display='none';
    }
}
</script>


        <?php if(!isset($models)){ ?>
        <div class="sort">
          <select id="input-sort" class="sel" data-text="<?php echo $text_sort; ?>" onchange="location = this.value;">
            <?php foreach ($sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
         </div>
         <?php } ?>
      </div>
    <div class="row dflex content">
      <?php if ($products || isset($models) || $products_sort_gramm || $products_brand) { ?>
      <style>
        #column-left{width:247px;min-width:247px;padding:0 7px 0 15px;margin-left:1%;}
        #column-left .svg svg{width:100%;height:auto;}
        #column-left img{max-width: 100%;}
      </style>

      <div id="column-left">
          <?php if(isset($left_column_brend)){ ?>
            <style>
              #column-left{margin-right:9%;}
            </style>
                <?php if($left_column_brend!='xerox') { ?>
                    <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'ico/brands/'.$left_column_brend.'.svg');?></span>
                <?php } else { ?>
                    <img src="image/ico/favicon_prote_16x16.svg" data-original="/image/ico/brands/<?php echo $left_column_brend; ?>.png">
                <?php } ?>
          <?php } ?>

          <style>
            .name-box{font-size: 16px;font-weight:bold;color:#333;font-family:'Trebuchet MS';padding:8px 0;border-bottom:1px solid #333;margin-top:15px;margin-bottom:20px;cursor:pointer;position:relative;}
            .bf-arrow:before{position:absolute;bottom:12px;right:5px;width:8px;height:8px;border-bottom:1px solid #333;border-right:1px solid #333;content:"";-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:rotate(45deg);transform:rotate(45deg);-webkit-transition:border-color 0.2s ease;-moz-transition:border-color 0.2s ease;-ms-transition:border-color 0.2s ease;-o-transition:border-color 0.2s ease;transition:border-color 0.2s ease;-webkit-transition:all 400ms;-moz-transition:all 400ms;-o-transition:all 400ms;transition:all 400ms;}
            .category-list li, .category-list a {font-family:"Trebuchet MS";font-size: 13px;color:#333;line-height:15px;display:block;}
            .category-list li{padding:3px 3px 4px;}
            .category-list .active{background:#bee9f9;}
            .category-list .qnty{padding-left:5px;color:#999;}
          </style>


        <?php if(isset($brand_cat)) { ?>
        <div class="categories">
          <div class="name-box"><?php echo $text_in_cat; ?><span class="bf-arrow">&nbsp;</span></div>
          <div class="category-list">
            <ul>
            <?php foreach($brand_cat as $key => $cat){ ?>
                <?php if($searchcategory==$key){?>
                  <li class="active"><?php echo $cat['name'];?></li>
                <? } else { ?>
                  <li><a href="<?php echo $cat['href'];?>" title="<?php echo $cat['name'];?>"><?php echo $cat['name'];?></a></li>
                <? } ?>
            <?php } ?>
            </ul>
          </div>
        </div>
        <?php } 
       
        if(isset($urls)){
          if($name_grup != null){

 echo '<img src="/image/printer-nofoto.png" alt="'.$name_grup.'">';



if($names_grup == $name_grup){

          echo "<h3>".$name_grup."</h3>";
           foreach($prodtwo as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}

if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
  echo "<h3>".$name_gruptse."</h3>";
 foreach($prodtwotse as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }





 if($names_grup == $name_grupt){
 echo "<h3>".$name_grupt."</h3>";
           foreach($prodtwot as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
  echo "<h3>".$name_gruptse."</h3>";
 foreach($prodtwotse as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }



if($names_grup == $name_grupts){
 echo "<h3>".$name_grupts."</h3>";
           foreach($prodtwots as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_gruptse != null){
  echo "<h3>".$name_gruptse."</h3>";
 foreach($prodtwotse as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
}


if($names_grup == $name_gruptse){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
if($names_grup == $name_grup4){
 echo "<h3>".$name_grup4."</h3>";
           foreach($prod4 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
if($names_grup == $name_grup5){
 echo "<h3>".$name_grup5."</h3>";
           foreach($prod5 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
if($names_grup == $name_grup6){
 echo "<h3>".$name_grup6."</h3>";
           foreach($prod6 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup7){
 echo "<h3>".$name_grup7."</h3>";
           foreach($prod7 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup8){
 echo "<h3>".$name_grup8."</h3>";
           foreach($prod8 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup9){
 echo "<h3>".$name_grup9."</h3>";
           foreach($prod9 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup10){
 echo "<h3>".$name_grup10."</h3>";
           foreach($prod10 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 if($names_grup == $name_grup11){
 echo "<h3>".$name_grup11."</h3>";
           foreach($prod11 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }if($names_grup == $name_grup12){
 echo "<h3>".$name_grup12."</h3>";
           foreach($prod12 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup13 != null){
  echo "<h3>".$name_grup13."</h3>";
 foreach($prod13 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }if($names_grup == $name_grup13){
 echo "<h3>".$name_grup13."</h3>";
           foreach($prod13 as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }
if($name_grup != null){
  echo "<h3>".$name_grup."</h3>";
 foreach($prodtwo as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupt != null){
  echo "<h3>".$name_grupt."</h3>";
 foreach($prodtwot as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grupts != null){
  echo "<h3>".$name_grupts."</h3>";
 foreach($prodtwots as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_gruptse != null){
 echo "<h3>".$name_gruptse."</h3>";
           foreach($prodtwotse as $produc){
            echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup5 != null){
  echo "<h3>".$name_grup5."</h3>";
 foreach($prod5 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
if($name_grup6 != null){
  echo "<h3>".$name_grup6."</h3>";
 foreach($prod6 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup7 != null){
  echo "<h3>".$name_grup7."</h3>";
 foreach($prod7 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup8 != null){
  echo "<h3>".$name_grup8."</h3>";
 foreach($prod8 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup9 != null){
  echo "<h3>".$name_grup9."</h3>";
 foreach($prod9 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup10 != null){
  echo "<h3>".$name_grup10."</h3>";
 foreach($prod10 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup11 != null){
  echo "<h3>".$name_grup11."</h3>";
 foreach($prod11 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup12 != null){
  echo "<h3>".$name_grup12."</h3>";
 foreach($prod12 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 if($name_grup4 != null){
  echo "<h3>".$name_grup4."</h3>";
 foreach($prod4 as $produc){
   echo '<span>'.$produc->row['name'].'</span><br>';
 }}
 }
 }
        }else{
          echo $left_column;
        }

?>
          <?php if ($product_total_cat) { ?>
          <div class="categories">
            <div class="name-box"><?php echo $text_in_cat; ?><span class="bf-arrow">&nbsp;</span></div>
            <div class="category-list">
            <ul>
              <?php foreach ($product_total_cat as $category) { if(!$category['count']) continue; ?>
                <?php if ($category['category_id'] == $category_id) {  ?>
                  <li class="active"><?php echo $category['name'] ; ?> <span class="qnty">(<?php echo $category['count']; ?>)</span></li>
                  <?php } else { ?>
                  <li><a href="<?php echo $category['href']; ?>" title="<?php echo $category['name']; ?>"><?php echo $category['name']; ?> <span class="qnty">(<?php echo $category['count']; ?>)</span></a></li>
                <?php } ?>
              <?php } ?> 
            </ul>
            </div>
          </div>
          <?php } ?>
        
        
      </div>
      <?php } ?>
      
      <div id="content">
        

        <?php if (isset($models)) { ?>
        <style>
          #searchp-brand{position:relative;width:50%;}
          #searchp-brand input{width:100%;line-height:25px;padding:0 9px;display:block;font-size:11px;border:1px solid #e3e9ef;border-top:1px solid #abadb3;}
          #searchp-brand .input-group-btn{position:absolute;right:1px;top: 1px;}
          #searchp-brand button{background:none;padding-top:4px;}
          .search-info{font-size:11.5px;color:333;margin-bottom:25px;}
          #result-search-brand-autocomplete{position:absolute;background:#fff;z-index:1000;top:25px;}
          .show-result{max-height:220px;}
          .show-result li {display: flex;padding: 5px;border: 1px solid #e3e9ef;border-bottom: none;border-radius: 2px;}
          .show-result a {color: #333;font-size: 12px;line-height: 13px;}
          .show-result a:hover {text-decoration: underline;color: #00adee;}
          .relative{position:relative;}
        </style>
        <div class="relative">
          <div id="searchp-brand" class="input-group searchp">
            <input type="text" id="searchp-brand-input" name="search-brand" value="" placeholder="<?php echo $text_search_brand; ?>" class="form-control input-lg search-autocomplete grey" />
            <span class="input-group-btn">
              <button type="button" id="search-btn2">
                  <span class="svg"><?php echo file_get_contents(DIR_IMAGE.'/ico/00-magn-glass.svg');?></span>
              </button>
            </span>
          </div>
          <div id="result-search-brand-autocomplete" class="result-search-brand-autocomplete">
              <ul class="show-result" id="show-result-brand"></ul>
          </div>
        </div>

          <div class="search-info">
              * <?php echo $text_search_info; ?>
          </div>
        <?php } ?>

        
        <?php if (isset($models)) { ?>  
          <style>
          .plist-head{width:100%;background:#bee9f9;line-height:31px;text-align:center;font-size:16px;color:#333;font-family:'Trebuchet MS';font-weight:700;}
          .plist-list{display:flex;flex-direction:row;flex-wrap:wrap;margin:15px 0 30px;}
          .plist-list li{width:40%;margin-left:2%;}
          .plist-list li a{line-height:17px;color:11px;color:#999;font-size:11px;}
          .plist-list li a:hover{text-decoration:underline;color:#00adee;}
          </style>
    
          <?php foreach ($models as $key=>$prnlist) { ?>
          <h3 class='plist-head'><?php echo $key; ?></h3>
          <ul class='plist-list'>
              <?php foreach ($prnlist as $prnitem) { ?>
                   <li><a href="<?php echo $prnitem['url']?>"><?php echo $prnitem['title']?></a></li>
              <?php } ?>
          </ul>
          <?php } ?>
        <?php }  elseif ($products) { ?>     

                  <div class="">
                    <div class="products">
                      <?php foreach ($products as $product) { ?>
                        <div class="product">
                            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
                            <?php if($product['ifexist']<>3) { ?>
                              <?php switch ($product['ifexist']) {
                                  case 0: ?>
                                     <p class="ifexist product__ifexist ico0"><?php echo $text_exist; ?></p>
                                 <?php break; case 1: ?>
                                     <p class="ifexist product__ifexist ico1"><?php echo $text_preorder; ?></p>
                                 <?php break; case 2: ?>
                                     <p class="ifwait product__ifexist ico2"><?php echo $text_wait; ?></p>
                                 <?php break; default: ?>
                                 <?php } ?>
                              <?php } else { ?>
                                  <p class="ifexist product__ifexist ico3"><?php echo $text_noexist; ?></p>
                              <?php } ?>
                        
                            <div class="ndesc product__ndesc">
                              <a class="name" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                            </div>
                            <?php if ($product['price']) { ?>
                              <div class="product__price">
                                <p class="price"><?php if (!$product['special']) { ?><?php echo $text_price; ?> <?php echo $product['price']; ?>
                                  <?php } else { ?>
                                  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                                  <?php } ?>
                                </p>
                              </div>
                              <?php } ?>
                            <div class="buttons product__block-buttons">
                                <?php if($product['minimum']>1) { ?>
                                  <div class="product_min list block"><?php echo $text_minimum.$product['minimum'];?></div>
                                <?php } ?>
                                <?php if ($product['ifexist']!=2) { ?>
                                    <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                                        <a href="#ordercallback-modal" data-modal="ordercallback-form" class="product__oneclick oneclick" onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special_float"] ? $product["special_float"] : $product["price_float"]); ?>','<?php echo $product['minimum']; ?>'); return false;">
                                              <?php echo $button_cartone; ?>                      
                                        </a>
                                    <?php } ?>
                                    <a href="" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
                                <?php } ?>
                            </div>
                          </div>
                      <?php } ?>
                    </div>
                    
                  </div>

                  <div class="row bottom_row">
                    <div id="paginate"><?php echo $pagination; ?></div>
                    <select id="input-limit" class="sel" data-text="<?php echo $text_limit; ?>" onchange="location = this.value;">
                      <?php foreach ($limits as $limits) { ?>
                      <?php if ($limits['value'] == $limit) { ?>
                      <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>

        <?php } elseif ($products_sort_gramm) { ?> 
               <div>
                <style>
                .text.dflex{display:flex;flex-direction: row;font-size:14px;line-height:15px;color:#333;margin:0 10px;}
                .products+.text.dflex{margin-top:40px;}
                .text.dflex>div{padding:15px 20px;width:50%;}
                .text.dflex>div:first-child{padding-left:6%;font-size:20px;line-height:30px;}
                .text.dflex>div:last-child{font-family:'Trebuchet MS';}
                </style>
                <?php foreach ($products_sort_gramm as $key => $products) { if(empty($products)) continue;  ?>
                
                  <div class="text dflex plashka2" style="border-radius: 20px; display:none; background: <?php echo $products_sort_gramm[$key]['color']; ?>">
                      <div style="width:75%"><?php echo $products_sort_gramm[$key]['text1']; ?> </div>
                    <div class="liness" style="width:2%">
                    <svg class="line540" width="2" height="60" viewBox="0 0 1 60" fill="none" xmlns="http://www.w3.org/2000/svg">
<line x1="0.5" y1="60" x2="0.500003" y2="-2.18557e-08" stroke="#333333"/>
</svg>


</div>

                      <div style="width:75%"><?php echo $products_sort_gramm[$key]['text2'];?></div>
                  </div>

                  <div class="products">


                  <div class="text dflex plashka" style="display:block; flex-direction: column; border-radius: 29px;
    height: 370px; background: <?php echo $products_sort_gramm[$key]['color']; ?>">
                      <div style="padding-top:56px; padding-left: 16%; text-align: left; width: 222px; font-size: 20px;
line-height: 25px;"><?php echo $products_sort_gramm[$key]['text1']; ?> </div>
                      <svg style="margin-left: auto;
    margin-right: auto;" width="165" height="2" viewBox="0 0 165 1" fill="none" xmlns="http://www.w3.org/2000/svg">
<line x1="4.37114e-08" y1="0.5" x2="165" y2="0.500014" stroke="#333333"/>
</svg>

                      <div style="text-align: left; width: 222px; padding-left: 16%; font-size: 13px;
line-height: 15px;"><?php echo $products_sort_gramm[$key]['text2'];?></div>
                  </div>



                    <?php foreach ($products['products'] as $product) { ?>
                      <div class="product">
                          <div class="image"><a href="<?php echo $product['href']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
                          <?php if($product['ifexist']<>3) { ?>
                            <?php switch ($product['ifexist']) {
                                case 0: ?>
                                   <p class="ifexist product__ifexist ico0"><?php echo $text_exist; ?></p>
                               <?php break; case 1: ?>
                                   <p class="ifexist product__ifexist ico1"><?php echo $text_preorder; ?></p>
                               <?php break; case 2: ?>
                                   <p class="ifwait product__ifexist ico2"><?php echo $text_wait; ?></p>
                               <?php break; default: ?>
                               <?php } ?>
                            <?php } else { ?>
                                <p class="ifexist product__ifexist ico3"><?php echo $text_noexist; ?></p>
                            <?php } ?>
                      
                          <div class="ndesc product__ndesc">
                            <a class="name" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                          </div>
                          <?php if ($product['price']) { ?>
                            <div class="product__price">
                              <p class="price"><?php if (!$product['special']) { ?><?php echo $text_price; ?> <?php echo $product['price']; ?>
                                <?php } else { ?>
                                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                                <?php } ?>
                              </p>
                            </div>
                            <?php } ?>
                          <div class="buttons product__block-buttons">
                              <?php if($product['minimum']>1) { ?>
                                <div class="product_min list block"><?php echo $text_minimum.$product['minimum'];?></div>
                              <?php } ?>
                              <?php if ($product['ifexist']!=2) { ?>
                                  <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                                      <a href="#ordercallback-modal" data-modal="ordercallback-form" class="product__oneclick oneclick" onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special_float"] ? $product["special_float"] : $product["price_float"]); ?>','<?php echo $product['minimum']; ?>'); return false;">
                                            <?php echo $button_cartone; ?>                      
                                      </a>
                                  <?php } ?>
                                  <a href="" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
                              <?php } ?>
                          </div>
                        </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              
                <div class="row bottom_row">
                  <div id="paginate"><?php echo $pagination; ?></div>
                  <select id="input-limit" class="sel" data-text="<?php echo $text_limit; ?>" onchange="location = this.value;">
                    <?php foreach ($limits as $limits) { ?>
                    <?php if ($limits['value'] == $limit) { ?>
                    <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div> 
              </div> 
        <?php } elseif ($products_brand) { ?> 
               <div>
                <style>
                .text.dflex{display:flex;flex-direction: row;font-size:14px;line-height:15px;color:#333;margin:0 10px;}
                .products+.text.dflex{margin-top:40px;}
                .text.dflex>div{padding:15px 20px;width:50%;}
                .text.dflex>div:first-child{padding-left:6%;font-size:20px;line-height:30px;}
                .text.dflex>div:last-child{font-family:'Trebuchet MS';}
                </style>
                <?php foreach ($products_brand as $key => $products) { if(empty($products)) continue;  ?>
                
                  <div class="text dflex plashka2" style="border-radius:20px; display:none; background: #<?php echo ${'text_'.$key.'_color'}; ?>">
                      <div <?php if(!${'text_' . $key}){?> style="width:0;"<?php } ?>><?php echo ${'text_' . $key}; ?> </div>
                     <svg style="margin-top: auto;
    margin-bottom: auto;" width="1" height="60" viewBox="0 0 1 60" fill="none" xmlns="http://www.w3.org/2000/svg">
<line x1="0.5" y1="60" x2="0.500003" y2="-2.18557e-08" stroke="#333333"/>
</svg>

 <div><?php echo ${'text_' . $key.'_2'}; ?></div>
                  </div>

                  <div class="products">

 <div class="text dflex plashka" style="display:block; flex-direction: column; border-radius: 29px;
    height: 370px; background: #<?php echo ${'text_'.$key.'_color'}; ?>">
                      <div style="padding-top:56px; padding-left: 16%; text-align: left; width: 222px; font-size: 20px;
line-height: 25px;" <?php if(!${'text_' . $key}){?> style="width:0;"<?php } ?>><?php echo ${'text_' . $key}; ?> </div>
<svg style="margin-left: auto;
    margin-right: auto;" width="165" height="2" viewBox="0 0 165 1" fill="none" xmlns="http://www.w3.org/2000/svg">
<line x1="4.37114e-08" y1="0.5" x2="165" y2="0.500014" stroke="#333333"/>
</svg>

                      <div style="text-align: left; width: 222px; padding-left: 16%; font-size: 13px;
line-height: 15px;"><?php echo ${'text_' . $key.'_2'}; ?></div>
                  </div>

                    <?php foreach ($products as $product) { ?>
                      <div class="product">
                          <div class="image"><a href="<?php echo $product['href']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
                          <?php if($product['ifexist']<>3) { ?>
                            <?php switch ($product['ifexist']) {
                                case 0: ?>
                                   <p class="ifexist product__ifexist ico0"><?php echo $text_exist; ?></p>
                               <?php break; case 1: ?>
                                   <p class="ifexist product__ifexist ico1"><?php echo $text_preorder; ?></p>
                               <?php break; case 2: ?>
                                   <p class="ifwait product__ifexist ico2"><?php echo $text_wait; ?></p>
                               <?php break; default: ?>
                               <?php } ?>
                            <?php } else { ?>
                                <p class="ifexist product__ifexist ico3"><?php echo $text_noexist; ?></p>
                            <?php } ?>
                      
                          <div class="ndesc product__ndesc">
                            <a class="name" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                          </div>
                          <?php if ($product['price']) { ?>
                            <div class="product__price">
                              <p class="price"><?php if (!$product['special']) { ?><?php echo $text_price; ?> <?php echo $product['price']; ?>
                                <?php } else { ?>
                                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                                <?php } ?>
                              </p>
                            </div>
                            <?php } ?>
                          <div class="buttons product__block-buttons">
                              <?php if($product['minimum']>1) { ?>
                                <div class="product_min list block"><?php echo $text_minimum.$product['minimum'];?></div>
                              <?php } ?>
                              <?php if ($product['ifexist']!=2) { ?>
                                  <?php if ($ordercallback_use_module && $ordercallback_as_order) { ?>
                                      <a href="#ordercallback-modal" data-modal="ordercallback-form" class="product__oneclick oneclick" onclick="ordercallback_modal_show('<?php echo $product['product_id']; ?>','<?php echo $product['thumb']; ?>','<?php echo $product['name']; ?>','<?php echo ($product["special_float"] ? $product["special_float"] : $product["price_float"]); ?>','<?php echo $product['minimum']; ?>'); return false;">
                                            <?php echo $button_cartone; ?>                      
                                      </a>
                                  <?php } ?>
                                  <a href="" class="tobasket" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');return false;">&nbsp;<?php echo $button_cart; ?></a>
                              <?php } ?>
                          </div>
                        </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              
                <div class="row bottom_row">
                  <div id="paginate"><?php echo $pagination; ?></div>
                  <select id="input-limit" class="sel" data-text="<?php echo $text_limit; ?>" onchange="location = this.value;">
                    <?php foreach ($limits as $limits) { ?>
                    <?php if ($limits['value'] == $limit) { ?>
                    <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div> 
              </div> 
        <?php } elseif (!$products) { ?>    

            <?php if ($product_total_cat) { ?>

             <style>
                .cats{padding-bottom: 70px;}
                .dflex{ display:flex;flex-wrap: wrap;}
                .dflex .item{width:20%; display:flex; flex-wrap: wrap; border:1px solid #f7f6f7; }
                .dflex .item:hover{border-color:#fd9d1f;}  
                .dflex .item .thumb,
                .dflex .item .name{width:50%;}
                .dflex .item .thumb{text-align: center;}
                .dflex .item .name{padding-top:40px;padding-right:10px;}
                .dflex .item .name a{color:#00aff2;font-size:13px;font-family:'Trebuchet MS';line-height:20px}
                .dflex .item:hover .name a{color:#fd9d1f;-webkit-transition-duration:0.2s;-o-transition-duration:0.2s;-moz-transition-duration:0.2s;transition-duration:0.2s;}
                .dflex .item .thumb img{margin:10px 0;}
                .dflex .item:hover .thumb img{filter:none;}
                .dflex .item .c_cats{width:100%;padding-left:34px;padding-bottom:25px;}
                .dflex .item .c_cats a{color:#333;font-size:13px;font-family:'Trebuchet MS';line-height:22px;display:block;}
                .dflex .item .c_cats a:hover{color:#fd9d1f;text-decoration:underline;}
                .cats .qnty{display:none;}
                .description{font-size:12px;color:#333;line-height:15px;font-family:'Trebuchet MS';}
                .description h2{margin:20px 0 10px; }
                .description p{margin-bottom:10px;}
                .description a{color:#00adee;}
                .description a:hover{color:#fd9710;}
                .description ul{margin-bottom:15px; }
                .description li{list-style:disc; margin-left: 30px;}
                @media (max-width:1299px){.dflex .item{width:25%;}}
                @media (max-width: 992px){.dflex .item{width:33%;}}
                @media (max-width: 768px){/*540*/.dflex .item{width:50%;}}
                @media (max-width: 576px){/*320*/.dflex .item{width:100%;}}
                .title{
                  color:#00aeef;
                  font-size: 23px;
                  text-align: center;
                  padding-bottom: 22px;
                }
                
              </style> 

              <div class="title"><?php echo $text_search_in_cat; ?></div>
              <div class="cats dflex">
                <?php foreach ($product_total_cat as $category) { ?>
                  <div class="item">
                    <div class="thumb">
                      <a href="<?php echo $category['href']; ?>"><img src="image/ico/favicon_prote_16x16.svg" data-original="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>"></a>
                    </div>
                    <div class="name">
                      <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                    </div>
                    <div class="c_cats">
                        <a href="<?php echo $category['href']; ?>"><?php echo $text_view_all; ?> <span class="qnty">(<?php echo $category['count']; ?>)</span>&nbsp;&nbsp;></a>
                    </div>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

        <?php } else { ?>
        <p><?php echo $text_empty; ?></p>
        <?php } ?>

            <div class="description">
                <?php echo $description; ?>
            </div>

  		  </div>
        </div>
  		  
  		  
        <?php echo $content_bottom; ?>
      <?php echo $column_right; ?>
      </div>


<?php include_once(DIR_APPLICATION.'view/theme/default/template/module/ordercallback_modal.tpl');?>
<script>

  

<?php if($products_brand) { ?>

  <?php foreach ($products_brand as $products) { ?>
<?php foreach ($products as $product) { ?>
<?php $prods[] = $product; ?>
<?php } ?>
<?php } ?>


gtag('event', 'view_item_list', {"items": [
<?php $products = $prods; foreach ($products as $key => $product) { ?>
{"id": "<?php echo $product['model']; ?>","name": "<?php echo $product['name']; ?>","list": "<?php echo $breadcrumb['text']; ?>" ,"category": "<?php echo $breadcrumb['text']; ?>","list_position": <?php echo $key+1; ?>,
"quantity": 1,"price": <?php echo $product['price_float']; ?> }<?php if(count($products) > $key+1){?>,<?php } ?>
<?php } ?>
]
});
<?php } ?>
</script>

    <script>

        var delay = (function(){
        var timer = 0;
        return function(callback, ms){
          clearTimeout (timer);
          timer = setTimeout(callback, ms);
        };
        })();


        if($('#searchp-brand').length) {
            var width_search = document.getElementById("searchp-brand").offsetWidth;
            $('#result-search-brand-autocomplete').css({"width":width_search});
            $('#searchp-brand-input').keyup(function(event) {

            // Запуск с задержкой
            delay(function(){
                var search = $('input[name=search-brand]').val();
                var html = ''
                var count = 0

                $('.plist-list>li>a').each( function(i,v) {
                  
                    //value=$(v).context;
                    //console.log(value);
                    if ($(v).html().indexOf(search)>0) {
                        html += '<li><a href="'+$(v).attr('href')+'">'+$(v).html()+'</a></li>';
                        count++;
                    }
                });

                if (count>0) {
                    $('#result-search-brand-autocomplete').css({"display":"block"});
                    $('#result-search-brand-autocomplete  ul').css({"overflow-y" : (count>5 ? "scroll" : "hidden")});

                } else {
                    $('#result-search-brand-autocomplete').css({"display":"none"});
                }
                            

                $('#show-result-brand').html(html);
                   
              		
              }, 300 );
          });
        }

    </script>
  <?php } ?>

<?php if(!isset($models)){ ?>
<script>
$(document).ready(function(){
$('.sel').each(function() {
  var $this = $(this),
    selectOption = $this.find('option'),
    selectOptionLength = selectOption.length,
    //selectedOption = selectOption.filter(':selected'),
    dur = 150;
    pr=$this.data('text');
  $this.hide();
  $this.wrap('<div class="select"></div>');
  $('<div>', {
    class: 'select__gap',
    text: pr
  }).insertAfter($this);

  var selectGap = $this.next('.select__gap'),
    caret = selectGap.find('.caret');
  $('<ul>', {
    class: 'select__list'
  }).insertAfter(selectGap);

  var selectList = selectGap.next('.select__list');
  // Add li - option items
  for (var i = 0; i < selectOptionLength; i++) {
    
    cl='';
    if(selectOption.eq(i).attr('selected')){
      cl=' selected';
      selectGap.text(pr+' '+selectOption.eq(i).text().toLowerCase());
      
    }

    $('<li>', {
        class: 'select__item'+cl,
        html: $('<span>', {
          text: selectOption.eq(i).text()
        })
      })
      .attr('data-value', selectOption.eq(i).val())
      .appendTo(selectList);
  }
  var selectItem = selectList.find('li');

  selectList.slideUp(0);
  selectGap.on('click', function() {
    if (!$(this).hasClass('on')) {
      $(this).addClass('on');

      selectList.slideDown(dur);

      selectItem.on('click', function() {
        var chooseItem = $(this).data('value');
        $('.select__item').removeClass('selected');
        $(this).addClass('selected');
        $('select').val(chooseItem).attr('selected', 'selected')
        pr=$this.data('text');
        selectGap.text(pr+' '+$(this).find('span').text().toLowerCase());
        //$('.select__gap').
        selectList.slideUp(dur);
        selectGap.removeClass('on');
        
        $this.change();
      });

    } else {
      $(this).removeClass('on');
      selectList.slideUp(dur);
    }
  });
});
});
</script>
<?php } ?>
</div>
<?php echo $footer; ?>
<?php endif; ?>






<ul itemscope="" itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
    <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="https://prote.ua/"><span itemprop="name">Магазин товарів для офісу</span></a>                   
      <meta itemprop="position" content="1">
    </li>
    <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">                      
      <a itemprop="item" href="https://prote.ua/ua/brands/"><span itemprop="name">Пошук витратних матеріалів</span></a>
      <meta itemprop="position" content="2">
    </li>
    <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="https://prote.ua/ua/hp/"><span itemprop="name">hp</span></a>
      <meta itemprop="position" content="3">
    </li>
    <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
      <a itemprop="item" onclick="return false;" href="https://prote.ua/ua/rashod-mfu-hp-lj-pro-m225/lazercat/" style="cursor:default;">
      <span itemprop="name" id="lastbreadcrumb">Картриджі лазерні HP LJ ProM225</span></a>
      <meta itemprop="position" content="4">
    </li>
</ul>




<ul itemscope="" itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
    <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="https://prote.ua/"><span itemprop="name">Магазин товаров для офиса</span></a>                   
      <meta itemprop="position" content="1">
    </li>
    <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">                      
      <a itemprop="item" href="https://prote.ua/brands/"><span itemprop="name">Поиск расходных материалов</span></a>
      <meta itemprop="position" content="2">
    </li>
    <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="https://prote.ua/hp/"><span itemprop="name">hp</span></a>
      <meta itemprop="position" content="3">
    </li>
    <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
      <a itemprop="item" onclick="return false;" href="https://prote.ua/rashod-mfu-hp-lj-pro-m225/lazercat/" style="cursor:default;">
      <span itemprop="name" id="lastbreadcrumb">Картриджи лазерные HP LJ ProM225</span></a>
      <meta itemprop="position" content="4">
    </li>
</ul>