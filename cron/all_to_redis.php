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

$i=0;
$sql = "SELECT * FROM `oc_url_alias`";
$result = $dbcnx->query($sql);
foreach($result as $ress){
    $url = $ress['keyword'];
    $page = file_get_contents('http://192.168.199.36/'. $url);
    $url = null;
    $i++;
    $page = null;
    if($i>138200){
        echo "DONE";
exit();
    }
}
echo "DONE";
exit();



