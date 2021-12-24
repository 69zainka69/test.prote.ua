<?php

$bfp = array();
$bfpurl = array();
$strymn = array();
$strymnurl = array();
$bf='';
$stry='';
$a=0;
$b=0;
$sql = "SELECT * FROM `oc_product_compability` WHERE `product_id` = $product_id AND `connection_type` LIKE '/P'";
    $resul = $dbcnx->query($sql);

foreach($resul as $comp)
{

  $child = $comp['child_model'];
  $childurl = $comp['child_product_id'];
if (strpos($child, 'MFD-') !== false) {
   $bfp[$a] = $child;
   $bfpurl[$a] = $childurl;
   $a = $a+1;
}
  if (strpos($child, 'PRINK-') !== false){
$strymn[$b] = $child;
$strymnurl[$b] = $childurl;
$b = $b+1;
}
}

$countbfp=count($bfp);
$countstrymn = count($strymn);
if ($countbfp>0 || $countstrymn>0){
  echo '<div class="row1 reatured"> <div class="featured_title"><p class="titlefeatur">'.$symista.'</p>
  </div><div class="symistpadleft"><p class="prodsumistss">'.$heading_title.'</p><p class="prodsumist">'.$heading_title.'</p>';

if($countbfp>0){
  echo '<br><p class="panel-titles">'.$symistbfp.'</p><br><p>';
          for($bb=0; $bb!=$countbfp; $bb++){
            $names = substr("$bfp[$bb]", 4);
            $url = "prn=".$bfpurl[$bb];
           
            $sql = "SELECT * FROM `oc_url_alias` WHERE `query` LIKE '$url'";
            $ids = $dbcnx->query($sql);
            foreach($ids as $idss){
                $id = $idss['keyword'];
            }

            $bf=$bf.'<a href="'.$id.'" class="symlink">'.$names.'</a>, ';
              

           }
           $bf = substr($bf,0,-2);
           echo $bf."</p>";
}

if($countstrymn>0){
  echo '<br><p class="panel-titles">'.$symiststrym.'</p><br><p>';
          for($g=0; $g!=$countstrymn; $g++){
            $name = substr("$strymn[$g]", 6);
            $url = "prn=".$strymn[$g];

            $sql = "SELECT * FROM `oc_url_alias` WHERE `query` LIKE '$url'";
            $ids = $dbcnx->query($sql);
            foreach($ids as $idss){
                $id = $idss['keyword'];
            }
              $stry= $stry.' <a href="'.$id.'" class="symlink">'.$name.'</a>, ';
           }
           $stry = substr($stry,0,-2);
           echo $stry."</p>";
}

        echo '</div><div style="padding-top:25px;"></div></div>';
}   

$sql = "SELECT COUNT(1) FROM `oc_profitable_offer` WHERE `id_product` = $product_id";
$sl = $dbcnx->query($sql);
$b = mysqli_fetch_array( $sl );
if($b[0]>0){
$sql = "SELECT * FROM `oc_profitable_offer` WHERE `id_product` = $product_id";
$childer_profitable = $dbcnx->query($sql);
  ?>
<div class=""profitable>
<div style="background: #fbedde !important;" class="featured_title"><?php echo $block_act; ?></div>
<div style="height:30px;"></div>
<div style="height: 400px; margin-left:auto; margin-right:auto;">
<?php  
foreach($childer_profitable as $childrens){
$chil_id = $childrens['id_child_product'];
$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = $chil_id AND `language_id` = $langs ORDER BY `name` ASC";
$childer_prods = $dbcnx->query($sql);

foreach($childer_prods as $chils){
  $sql = "SELECT * FROM `oc_product` WHERE `product_id` = $chil_id";
  $childer_model = $dbcnx->query($sql);
foreach($childer_model as $models){
$childmode = $models['mpn'];
$chilpprice = $models['price'];
}
$sql = "SELECT * FROM `oc_product_price_list` WHERE `model` LIKE '$childmode' AND `PriceGroupId` LIKE 'Опт-1' ORDER BY `PriceGroupId` DESC";
$childer_prise = $dbcnx->query($sql);
foreach($childer_prise as $prices){
$pricese = $prices['PriceUa'];

}

$name = $chils['name'];
$sql = "SELECT * FROM `oc_product` WHERE `product_id` = $chil_id";
$childer_photo = $dbcnx->query($sql);
foreach($childer_photo as $photos){
  $childimg = $photos['image'];
}


?>

<div class="profitablechild borderscarts">
  <div><span class="profitableleft"> 
    <img style="margin-right: 25px; float:left; margin-left: 53px;" width="110px" alt="<?php echo $heading_title; ?>" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" /> 
  </span>
  <span style=" font-family: Trebuchet MS;font-style: normal;font-weight: normal;font-size: 13px;line-height: 21px;color: #333333; text-align:center;"><? echo $heading_title; ?> <br>
  <span style="width:15%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="margin-left:47px; font-family: Trebuchet MS;font-style: normal;font-weight: bold;font-size: 20px;line-height: 21px;text-decoration-line: line-through;color: #999999;"><? echo "<br>".$price;  ?></span></span>
</div>

<div style="padding-top: 50px; padding-bottom: 50px;">
  <p style="float: left; padding-left: 23%; text-align:center; font-family: Trebuchet MS; font-style: normal; font-weight: bold; font-size: 35px; line-height: 16px; color: #FD9710;">  + </p>
</div>
<div class="profitableleft">
  <span>
      <img style="margin-right: 25px; float:left; margin-left: 53px;" width="110px" alt="<?php echo $name; ?>" src="https://prote.ua/image/<?php echo $childimg; ?>" title="<?php echo $name; ?>" />
  </span>

<?php
$skidka = $chilpprice - $pricese;
if($skidka==$chilpprice){
  $skidka = 0;
}
echo '<span style=" font-family: Trebuchet MS;
font-style: normal;
font-weight: normal;
font-size: 13px;
line-height: 21px;
color: #333333; text-align:center;">'.$name.'<br></span><span style="font-family: Trebuchet MS;
font-style: normal;
font-weight: bold;
font-size: 20px;
line-height: 21px;
text-decoration-line: line-through;
color: #999999;">'.(int)$chilpprice." грн.</span>";
$cina = $price + $chilpprice - $skidka;
?>


</div>


<p style=" text-align: center; width: 100%; padding-bottom: 10px; padding-top: 87px; width:100%;">
<span style="font-family: Trebuchet MS;
font-style: normal;
font-weight: bold;
font-size: 30px;
line-height: 16px;
color: #FD9710;"><?php echo $cinas;?>: <?php echo $cina; ?> грн. </span> <span style="font-family: Trebuchet MS;
font-style: normal;
font-weight: bold;
font-size: 12px;
line-height: 14px;
color: #C4C4C4;">  - <?php echo $skidka; ?>грн. <?php echo $znijka;?></span></p>


<p name="<?php echo $childmode; ?>" onclick="cart.add('<?php echo $product_id.'.'.$chil_id; ?>', '1');cart.add('<?php echo $chil_id.'.'.$product_id; ?>', '1'); return false;" class="textdowncarts"><?php echo $komplect; ?></p>
</div>



<?php
}
}
?>




<?php 
}
?>
</div></div>
<div style="height:30px;"></div>

<style>
.textdowncarts{font-family: Trebuchet MS;
  cursor: pointer;
font-style: normal;
font-weight: normal;
font-size: 16px;
line-height: 14px;
text-align: center;
color: #333333;
  background: #F2F2F2; width: 270px; margin-left: auto;
    margin-right: auto; height: 39px;padding-top: 12px; 
}
.borderscarts{margin-top: 25px;
    margin-bottom: 25px;
  border: 1px solid #E9E9E9; margin-left: 15px; width:430px; height:400px; margin-right: 15px; float:left
}
.borderscarts:hover{
  border: 1px solid #FD9710;
}
.borderscarts:hover .textdowncarts{
  background: #FD9710;
color: #FFFFFF;
}
  </style>