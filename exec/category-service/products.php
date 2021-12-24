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
$cat_id = htmlspecialchars($_GET["catid"]);
$sql = "SELECT * FROM `oc_category_description` WHERE `category_id` = $cat_id AND `language_id` = 2";
$result = $dbcnx->query($sql);

foreach($result as $categoryes){
$categoryname = $categoryes['name'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Продукты категории - <?php echo $categoryname; ?></title>
</head>
<body>
    


<div>


<?php
echo "<h1>".$categoryname."</h1>";



$sql = "SELECT * FROM `oc_product_to_category` WHERE `category_id` = $cat_id";
$result = $dbcnx->query($sql);

foreach($result as $products){
    $product_id=$products['product_id'];

  $qwer = "product_id=".$product_id;

    $sql = "SELECT * FROM `oc_url_alias` WHERE `query` LIKE '$qwer'";
    $ali = $dbcnx->query($sql);
    $alis = mysqli_fetch_array($ali)['keyword'];
    echo '<p><a href="https://prote.ua/ua/'.$alis.'.html">https://prote.ua/ua/'.$alis.'.html</a></p>';
} 
?>

</div>
</body>
</html>
