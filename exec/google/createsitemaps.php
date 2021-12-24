<?php


$start = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$today = date("Y-m-d");
$finish = '</urlset>';
$tet='';
$urls='';
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
$dbcnx->query("SET SQL_MODE = ''");
$sql = "SELECT * FROM `oc_url_alias` WHERE `query` LIKE '%prn=%'";
$result = $dbcnx->query($sql);
foreach($result as $ress){
   $id = $ress['query'];
   $aliase = 'https://prote.ua/'.$ress['keyword'];
   $str = substr($id, 4);
   $sql = "SELECT * FROM `oc_product_to_category` WHERE `product_id` = $str";
   $resultin = $dbcnx->query($sql);
foreach($resultin as $re){
$cat = $re['category_id'];
if($cat == 88 || $cat == 82){
$urls = $aliase.'/lazercat/';
}
elseif($cat == 89 || $cat == 81){
    $urls = $aliase.'/inkcat/';
}
else{
    $urls=null;
}
}

if($urls != null){
$url = '<url>
 <loc>'.$urls.'</loc>
 <lastmod>'.$today.'</lastmod>
 <changefreq>weekly</changefreq>
 <priority>0.7</priority>
 </url>';
$tet .=$url;
}
}

$newphrase = $start.$tet.$finish;

echo $newphrase;


$file=fopen("/var/www/prote/data/www/prote.ua/exec/google/sitemapkart.xml", "w+");
fputs($file,$newphrase);
fclose($file);





    ?>