<?php
$time_start = microtime(true);
set_time_limit(18000);


require_once('/var/www/prote/data/www/prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}
$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");


$sql = "SELECT * FROM `oc_product_description` ORDER BY `oc_product_description`.`ax_description` ASC";
    $resul = $dbcnx->query($sql);

    foreach($resul as $comp)
    {
      $desc = $comp['ax_description'];
      $prod = $comp['product_id'];

      if (strpos($desc, '?????') !== false) {
        $sql = "SELECT * FROM `oc_product` WHERE `product_id` = $prod ORDER BY `product_id` ASC";
        $res = $dbcnx->query($sql);
        foreach($res as $co){
      $model = $co['model'];
      
        echo 'В продукте с кодом 1С - '. $model.' не правильное описание <br>';
    }

    }}




?>