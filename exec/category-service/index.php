<!DOCTYPE html>
<html lang="en">
<head>
<meta name="googlebot" content="noindex" />
<meta name="robots" content="noindex, nofollow" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Категории</title>
</head>
<body>
    


<div>


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

$dbcnx->query("SET SQL_MODE = ''");
$sql = "SELECT * FROM `oc_category_description` WHERE `language_id` = 2";
$result = $dbcnx->query($sql);

foreach($result as $categoryes){
    $catid=$categoryes['category_id'];
    $categoryname = $categoryes['name'];

?>
<p><a href="<?php echo "https://prote.ua/exec/category-service/products.php?catid=".$catid; ?>"><?php echo $categoryname;  ?></a></p>


<?php } ?>

</div>
</body>
</html>
