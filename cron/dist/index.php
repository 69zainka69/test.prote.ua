<?php
$time_start = microtime(true);

ini_set("memory_limit","512M");
//echo ini_get("memory_limit");
ini_set('max_execution_time', 600003);

$import_prote = true;

define('DIR', '/var/www/prote/data/www/prote.ua/');
require DIR.'config.php';
include_once DIR_ROOT.'function.php';
require DIR.'system/library/db/mysqli.php';
require DIR.'catalog/model/api/axapta.php';
require DIR.'catalog/model/catalog/category.php';

$db = new DB\MySQLi(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
//$db_ax = new DB\mPDO(DB_AX_HOSTNAME, DB_AX_USERNAME, DB_AX_PASSWORD, DB_AX_DATABASE, DB_AX_PORT);


class Model {}
$object = new Model;
$model_api_axapta = new ModelApiAxapta;
//$model_catalog_category = new ModelCatalogCategory;
$model_api_axapta->db = $db;
$object->db = $db;
$fullupdate = true;
$GroupSite2List = $model_api_axapta->getGroupSite2List();

$categories = array();
// формируем массив без [LanguageId] => en-us
foreach ($GroupSite2List as $groupsite2) {
  if($groupsite2['LanguageId']=='en-us')continue;
  //$categories[$groupsite2['GroupSite2Id']][getlanguageId($groupsite2['LanguageId'])] = $groupsite2;
  $categories[] = $groupsite2;
}
unset($GroupSite2List);
    //обновляем категории
   // $model_api_axapta->updateCategories($categories);

    //////////////////////////////////////////////////

    $categories = $model_api_axapta->getCategories();
    $allowGroupSiteId = array(
        'Site_032', // Лазерные принтеры
        'Site_105', // Лазерные МФУ
        'Site_031', // Струйные принтеры
        'Site_065', // Струйные МФУ
        'Site_034', // Матричные принтеры
    );
  
    $category['GroupSite2Id'] = "Site_".htmlspecialchars($_GET["site"]); //312 312
    $category['category_id'] = htmlspecialchars($_GET["cat"]); //344 347
  
    $ProductByGroupSite2 = $model_api_axapta->getProductByGroupSite2($category['GroupSite2Id']);

    $products = array();
    // формируем массив по языкам
    $i=0;
    foreach ($ProductByGroupSite2 as $product) {
      if($product['LanguageId']=='en-us')continue;
      $i++;
echo "<p>".$i." - ".$product['ItemName']."</p>";

      if($product['LanguageId']=='ru'){
        $products[$product['ItemId']] = $product;
      }
      $products[$product['ItemId']]['product_description'][getlanguageId($product['LanguageId'])] = array(
         'ItemName' =>  $product['ItemName'],
         'ItemDescription' => $product['ItemDescription']
      );

    }
    unset($ProductByGroupSite2);

     // получаем наличие
    $ProductAvailability = $model_api_axapta->getProductAvailabilityWeb($category['GroupSite2Id']);
echo "<h1>".$category['GroupSite2Id']."</h1><p>отрабатывает - $ ProductAvailability = $ model_api_axapta->getProductAvailabilityWeb($ category['GroupSite2Id']);</p><p>Смотрим что поместилось в ProductAvailability</p>";
   var_dump($ProductAvailability); $a=0;
    foreach ($ProductAvailability as $key => $p_avail) {
      $a++;
      $product_avail[$p_avail['Item']] = $p_avail;
      echo "<p>".$a." - p_avail = ".var_dump($p_avail)."</p>";
    }
    unset($ProductAvailability);

    //$model_api_axapta->setImageDisable();


    foreach ($products as $ItemId => $product) {
        /*if($ItemId=='SPONGE-KUH-44-5'){
            print_r($Documents[$ItemId]);
        } else {
            continue;
        }*/

      //if(!isset($Prices[$ItemId]['price'])) continue;
      
      if(!isset($Prices[$ItemId]['price']) && !in_array($category['GroupSite2Id'], $allowGroupSiteId)) continue;

      if(isset($Documents[$ItemId]['Описание'][0]['FileName'])){
        $file = DIR_AX_DOCS_Description.$Documents[$ItemId]['Описание'][0]['FileName'];
        $product['product_description']['1']['ax_description'] = file_get_contents($file);
      } else {$product['product_description']['1']['ax_description'] ='';}
      if(isset($Documents[$ItemId]['ОписаниеUA'][0]['FileName'])){
        $file = DIR_AX_DOCS_Description.$Documents[$ItemId]['ОписаниеUA'][0]['FileName'];
        $product['product_description']['2']['ax_description'] = file_get_contents($file);
      } else {
        $product['product_description']['2']['ax_description'] ='';
      }

      $product['price'] = $Prices[$ItemId]['price']??0;
      $product['special'] = $Prices[$ItemId]['special']??'';
      $product['points'] = $Prices[$ItemId]['points']??'';

      

      //$product['product_images'] = array();

      $n_images =array();

      $img_forProte = array();
      $img_forPatronService = array();
      if(isset($Documents[$ItemId]['Фото'])){
        foreach ($Documents[$ItemId]['Фото'] as $img){
            if($img['forProte']){
                $img_forProte[$img['FileName']] = $img;
            } elseif ($img['forPatronService']){
                $img_forPatronService[$img['FileName']] = $img;
            }
        }
        
      }

      
      if(isset( $Documents[$ItemId]['Фото доп'])) {
        foreach ($Documents[$ItemId]['Фото доп'] as $img){
              if($img['forProte']){
                  $img_forProte[$img['FileName']] = $img;
              } elseif ($img['forPatronService']){
                  $img_forPatronService[$img['FileName']] = $img;
              }
          }
         
      }
      
      if($img_forProte){
          $n_images = $img_forProte;
      } elseif($img_forPatronService) {
          $n_images = $img_forPatronService;
      }

      if(isset($n_images[array_key_first($n_images)]['FileName'])){
          $product['image'] = 'img/gallery_ax/'.$n_images[array_key_first($n_images)]['FileName'];
      } else{
          $product['image'] = '';
      }
echo "<p>PHOTO - ". $product['image']."</p>";
      $product['product_images'] = $n_images;

      $instructions=array();
      if(isset($Documents[$ItemId]['Инструкции'])){$instructions +=$Documents[$ItemId]['Инструкции']; }
      if(isset($Documents[$ItemId]['Сертификат'])){$instructions +=$Documents[$ItemId]['Сертификат']; }
      if(isset($Documents[$ItemId]['Файл'])){$instructions +=$Documents[$ItemId]['Файл']; }
      $product['instructions'] = $instructions;

      if(!isset($product_avail[$ItemId]))continue;
      
      $product = $product+$product_avail[$ItemId];

      unset($Prices[$ItemId]);
      unset($product_avail[$ItemId]);
      unset($Documents[$ItemId]);

      echo "#";
      //print_r($product);
      $model_api_axapta->updateProduct($category['category_id'],$product);
      echo "<h1>прод - ".$product." CATEG - ".$category['category_id']."</h1>";
        //echo "#=====================================";
      //exit;
    }
    unset($products);

    //$model_api_axapta->deleteImageDisable();

  
    function getlanguageId($LanguageId) {
        $myArray = array('ru' => '1', 'ua' => '2');
        return $myArray[$LanguageId];
    }
exit();
?>