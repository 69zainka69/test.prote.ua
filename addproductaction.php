<?php
ini_set("memory_limit","512M");
ini_set('max_execution_time', 600003);
require_once('/var/www/prote/data/www/prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}

$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");

$method = $_POST['method'];
$url = $_POST['url'];

if($method=="add"){

$new_child = $_POST['new_child'];
$prod_id = $_POST['prod_id'];
$token = $_POST['token'];
$product_id = $prod_id.".".$new_child;


$sql = "SELECT * FROM `oc_product` WHERE `model` LIKE '$new_child'";
$chilidss = $dbcnx->query($sql);
foreach($chilidss as $childs){
    $chaild = $childs['product_id'];
    $chaimpn = $childs['mpn'];
}

$sql = "SELECT * FROM `oc_product_price_list` WHERE `model` LIKE '$chaimpn'";
$mpns = $dbcnx->query($sql);
foreach($mpns as $mpni){
$mpn = $mpni['PriceGroupId'];

if($mpn == 'Опт-3'){
   
    $sql = "INSERT INTO `oc_profitable_offer` (`id`, `id_product`, `id_child_product`, `product_id`) VALUES (NULL, '$prod_id', '$chaild', '$product_id');";
    $dbcnx->query($sql);
}}

header("HTTP/1.1 301 Moved Permanently"); 
 header("Location: $url"); 
 exit(); 
}


if($method=="del"){
    $prod_id = $_POST['prod_id'];


for($i=0; $i!=10; $i++){
    $child_id = $_POST["id$i"];
    $del_child = isset($_POST["horns$i"]) ? $_POST["horns$i"] : '';
    if(!empty($del_child)){
        

if ($_POST["horns$i"] == "on"){
  

    $child_id = isset($_POST["id$i"]) ? $_POST["id$i"] : ''; 
   echo $child_id;
    $sql = "SELECT * FROM `oc_profitable_offer` WHERE `id_product` = $prod_id AND `id_child_product` = $child_id";
    $res = $dbcnx->query($sql);
foreach($res as $deliting){
    $del_id = $deliting['id'];
    $sql = "DELETE FROM `oc_profitable_offer` WHERE `oc_profitable_offer`.`id` = $del_id";
    $dbcnx->query($sql);
}}
}}
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: $url"); 
    exit(); 

}






?>