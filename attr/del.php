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
$dbcnx->set_charset("utf8");


$srav=array();

$sql = "SELECT * FROM `attrincatgroup` WHERE `site` LIKE 'null' ORDER BY `id` DESC";
$result = $dbcnx->query($sql);



foreach($result as $res){

    $id = $res['id'];
  
      $sql = "DELETE FROM `prote.ua`.`attrincatgroup` WHERE `attrincatgroup`.`id` = $id";
      $result = $dbcnx->query($sql);


}

echo "DONE!!!!";

$sql = "SELECT * FROM `attrincatgroup` WHERE `lang` = 2 ORDER BY `attrincatgroup`.`site` DESC";
$result = $dbcnx->query($sql);



foreach($result as $res){

$id = $res['id'];
$name = $res['nameattr'];
$site = $res['site'];
$idattr = $res['idattr'];
$prov = $srav[$site][$idattr];

if($prov=$name){
  $sql = "DELETE FROM `prote.ua`.`attrincatgroup` WHERE `attrincatgroup`.`id` = $id";
  $resu = $dbcnx->query($sql);

}

$srav[$site]=array($idattr=>$name);

}


?>