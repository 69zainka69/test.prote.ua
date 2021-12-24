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

if(mail($_POST['id'],'тестовый заголовок письма',$_POST['sort'],'Content-type: text/html; charset=utf-8')){
  echo 'Сообщение отправлено!';
  exit();
}
else{
  echo 'Ошибка отправки сообщения.';
  exit();
}


//$id = $_POST["id"];
//$sort = $_POST["sort"];
//$view = $_POST["view"];
//$url = $_POST["url"];

$dbcnx->query("SET SQL_MODE = ''");
$sql = "UPDATE `prote.ua`.`attrincatgroup` SET `sort` = '$sort' WHERE `attrincatgroup`.`id` = $id;";
$res = $dbcnx->query($sql);



$sql = "UPDATE `prote.ua`.`attrincatgroup` SET `view` = '$view' WHERE `attrincatgroup`.`id` = $id;";
$res = $dbcnx->query($sql);

//header("Location: $url");
//exit();
  
?>