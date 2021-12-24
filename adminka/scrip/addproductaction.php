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
$token = $_POST['token'];
$method = $_POST['method'];
$url = $_POST['url'];
$redir = "https://prote.ua/adminka/index.php?route=module/bestseller&token=".$token;


if($method=="add"){

$new_child = $_POST['new_child'];



$sql = "SELECT * FROM `oc_product` WHERE `model` LIKE '$new_child'";
$chilidss = $dbcnx->query($sql);
foreach($chilidss as $childs){
    $chaild = $childs['new_child'];
}
    $sql = "INSERT INTO `bestaellerproductsour` (`id`, `product_id`) VALUES (NULL, '$chaild');";
    $dbcnx->query($sql);
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: $redir");
    exit();
}


if($method=="del"){
    $del_id = $_POST['prodid'];
    $sql = "DELETE FROM `bestaellerproductsour` WHERE `bestaellerproductsour`.`id` = $del_id";
    $dbcnx->query($sql);
   header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: $redir"); 
    exit();
}





?>