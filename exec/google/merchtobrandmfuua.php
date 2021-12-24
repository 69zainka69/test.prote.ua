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
			$output .= '<title>Prote - канцтовари, картриджі, папір, чорнило. Все, що потрібно офісу.</title>';
			$output .= '<link>' . HTTPS_SERVER . '</link>';
            $output .= '<description>Створимо готову товарну кошик під вашу заявку. Привеземо товар "під замовлення"</description>';

$prodarray = array();
$prod = array();
//МФУ HP и Pantum, Принтеры лазерные HP и Pantum
$limit = 99999;
$categone = ['88', '89',];
$bran = ['Hewlett Packard', 'Pantum'];
//$cattwo = 82;

$lang = 2;

    $cattwo = 88;
   
        $breadcr = "Головна > Офісна техніка > Лазерні БФП";


    $sql = "SELECT * FROM `oc_product_to_category` WHERE `category_id` = $cattwo";
    $result = $dbcnx->query($sql);
    foreach($result as $ress){
    $prod[] = $ress['product_id'];
    }
    foreach($bran as $brand){
        $prodarray = null;
        $sq = "SELECT * FROM `oc_product_attribute` WHERE `language_id` = $lang AND `attribute_id` = 1 AND `text` LIKE '$brand'";
        $res = $dbcnx->query($sq);
        foreach($res as $wh){
        
            $prodarray[] = $wh['product_id'];
        
        
        }
    
    $prods = (array_uintersect($prodarray, $prod, "strcasecmp"));
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
        $output .= "<link>https://prote.ua/".$linkss.".html</link>";
        $GFEED = $title['description'];
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
          
        }
        
        }
        
        }
        
        
        }
        $result = null;
        $res = null;
        $prod = null;
        $prod[] = null;
        $prodarray = null;
        $prodarray[] = null;
        $cattwo = 89;
        $breadcr = "Головна > Офісна техніка > Струменеві БФП"; 
        $sql = "SELECT * FROM `oc_product_to_category` WHERE `category_id` = $cattwo";
        $result = $dbcnx->query($sql);
        foreach($result as $ress){
        $prod[] = $ress['product_id'];
        }
        foreach($bran as $brand){
            $prodarray = null;
            $sq = "SELECT * FROM `oc_product_attribute` WHERE `language_id` = $lang AND `attribute_id` = 1 AND `text` LIKE '$brand'";
            $res = $dbcnx->query($sq);
            foreach($res as $wh){
        
                $prodarray[] = $wh['product_id'];
        
            }
        
        $prods = (array_uintersect($prodarray, $prod, "strcasecmp"));
        foreach($prods as $pr){
            if($pr == 89273 || $pr == 52237 || $pr == 67309){}else{
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
            $output .= "<link>https://prote.ua/".$linkss.".html</link>";
            $GFEED = $title['description'];
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
              
            }
            
            }
            
            }
        }
            
            
            }

        
        $output .= "</channel>
        </rss>";
    




$file=fopen("/var/www/prote/data/www/prote.ua/exec/google/merchbrandmfuua.xml", "w+");
fputs($file,$output);
fclose($file);


header("Location: https://prote.ua/exec/google/merchbrandmfuua.xml");
exit();

?>