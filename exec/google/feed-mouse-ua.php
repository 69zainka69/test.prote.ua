<?php
set_time_limit(18000);
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

$output  = '<?xml version="1.0" encoding="UTF-8" ?>';
			$output .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">';
			$output .= '<channel>';
			$output .= "<title>Prote – комп'ютерна миша, канцтовари, картриджі, папір, чорнило. Все, що потрібне офісу.</title>";
			$output .= '<link>' . HTTPS_SERVER . '</link>';
            $output .= '<description>Створимо готовий товарний кошик під вашу заявку. Привеземо товар "на замовлення"</description>';
    $prodarray = array();
    $limit = 99999;
    $lang = 2;
    $brand = 'Logitech';
    $prods = array("3985", "12956", "30808", "30742", "13523", "12957", "12955", "12958", "12959", "12960", "10148", "10150", "10149", "90720", "90721", "90722", "90723", "12988", "12989", "12961", "12962", "12963", "12997", "9526");


    $breadcr = "Головна > Комп'ютери та аксесуари > Комп'ютерна миша";
   


foreach($prods as $pr){
    $sql = "SELECT * FROM `oc_product` WHERE `product_id` = $pr";
        $result = $dbcnx->query($sql);
    foreach($result as $idprod){
        $a = $idprod['quantity'];
    if($a>0){
        $output .= "<item>";
        $ssql = "SELECT * FROM `oc_product_description` WHERE `product_id` = $pr AND `language_id` = $lang";
        $results = $dbcnx->query($ssql);
        foreach($results as $title){
            $output .= "<title>".$title['name']."</title>";
    }$ssqls = "SELECT * FROM `oc_url_alias` WHERE `query` LIKE 'product_id=$pr'";
    $resultss = $dbcnx->query($ssqls);
    foreach($resultss as $url){
       $linkss = $url['keyword'];
    }
    $output .= "<link>https://prote.ua/ua/".$linkss.".html</link>";
    $GFEED = $title['description'];
                //Убираем лишнее чтобы не ломался XML файл
    $healthy = array("</ strong>", "</strong>", "<strong>", "<br>", "Procter & Gamble", "^", "�");
    $yummy   = array(" "," ", " ", " ", "Procter and Gamble", " ", "");
    

    $newphrase = str_replace($healthy, $yummy, $GFEED);
    $new_desk = mb_strimwidth("$newphrase", 0, 150, "...");
    if($newphrase !=null){
        $output .= "<description>".$new_desk."</description>";
    }else{
        $output .= "<description>".$title['name']."</description>";
    }
    
    $output .= "<g:brand>".$brand."</g:brand>";
    $output .= "<g:condition>new</g:condition>";
    $output .= "<g:id>".$pr."</g:id>";
    $output .= "<g:image_link>https://prote.ua/image/".$idprod['image']."</g:image_link>";
    $output .= "<g:model_number>".$idprod['model']."</g:model_number>";
    $output .= "<g:mpn>".$idprod['mpn']."</g:mpn>";
    $output .= "<g:price>".$idprod['price']." UAH</g:price>";
    $output .= "<g:product_type>".$breadcr."</g:product_type>";
    $output .= "<g:quantity>".$idprod['quantity']."</g:quantity>";
    $output .= "<g:availability>". ($idprod['quantity'] ? 'in stock' : 'out of stock') ."</g:availability>";
    $output .= "</item>";
    }}
    }
    $output .= "</channel>
    </rss>";


$file=fopen("/var/www/prote/data/www/prote.ua/exec/google/feed-mouse-ua.xml", "w+");
fputs($file,$output);
fclose($file);


header("Location: https://prote.ua/exec/google/feed-mouse-ua.xml");
exit();

?>