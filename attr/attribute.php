<?php

$time_start = microtime(true);
ini_set("memory_limit","512M");
ini_set('max_execution_time', 600003);
require_once('/var/www/prote/data/www/prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}
$dubli=array();
$s=0;
$a=-1;
$b=0;
$c=0;
$prod=array();
$atr=array();
$dbcnx->set_charset("utf8");

$sql = "TRUNCATE TABLE attrincatgroup ";
$dbcnx->query($sql);

$dbcnx->query("SET SQL_MODE = ''");
$sql = "SELECT * FROM `oc_category` ORDER BY `oc_category`.`GroupSite2Id` DESC";
$result = $dbcnx->query($sql);


foreach($result as $ress){
    $catid=$ress['category_id'];
    $group=$ress['GroupSite2Id'];
$sql = "SELECT * FROM `oc_product_to_category` WHERE `category_id` = $catid";
$result = $dbcnx->query($sql);

foreach($result as $produ){
    $product[$b] = $produ['product_id'];
    $sql = "SELECT * FROM `oc_product_attribute` WHERE `product_id` = $product[$b] AND `language_id` = 1";
    $resultingi = $dbcnx->query($sql);
    $b=$b+1;
    foreach($resultingi as $sttrib){
     $atrubutes = $sttrib['attribute_id'];

     $sql = "SELECT * FROM `oc_attribute_description` WHERE `attribute_id` = $atrubutes AND `language_id` = 1";
     $resultingid = $dbcnx->query($sql);
     foreach($resultingid as $st){
       
     $idatr=$st['attribute_id'];
     $nameatr=$st['name'];
     $idcat=$catid;
     $site=$group;

     if($site!=null){

     if(empty($dubli[$idatr][$site])){

        $sql = "INSERT INTO attrincatgroup (idcat, site, idattr, nameattr, lang) VALUES ('$catid', '$group', '$idatr', '$nameatr', '1')";
        $dbcnx->query($sql);
        $dubli[$idatr]=array($site=>$nameatr);
        


     }
     else{
        $prov = $dubli[$idatr][$site];

     if($prov!=$nameatr){
     $sql = "INSERT INTO attrincatgroup (idcat, site, idattr, nameattr, lang) VALUES ('$catid', '$group', '$idatr', '$nameatr', '1')";
     $dbcnx->query($sql);
   
    }}
/*
$atr[$catid]= array(
    'idatr'=>$idatr,
    'name' => $nameatr,
    'IdCAT' => $catid,
    'Site' => $group,
);
*/
}}}

}
}
/*
foreach($atr as $atribute){
    
    $atributid = $atribute['idatr'];
    $atribut = $atribute['name'];
    $catid = $atribute['IdCAT'];
   $site = $atribute['Site'];
  // echo "<p>idatr = ".$atributid."  name = ".$atribut."   IdCAT = ".$catid."  Site = ".$site."</p>";
   $sql = "INSERT INTO attrincatgroup (idcat, site, idattr, nameattr) VALUES ('$catid', '$site', '$atributid', '$atribut')";
    $dbcnx->query($sql);
}
*//*
echo "DELETing!!!!";
$siti='';
$atri='';
$sql = "SELECT * FROM `attrincatgroup` ORDER BY `attrincatgroup`.`idcat` ASC";
$result = $dbcnx->query($sql);
foreach($result as $res){

    $sit = $res['site'];
    $atr = $res['idattr'];
    $id = $res['id'];
    if($sit=$siti && $atri=$atr){
    $sql = "DELETE FROM `test.prote.ua`.`attrincatgroup` WHERE `attrincatgroup`.`id` = $id";
    $resultttt = $dbcnx->query($sql);
    $siti = $res['site'];
    $atri = $res['idattr'];

    }

}*/
echo "DONE!!!!";

?>