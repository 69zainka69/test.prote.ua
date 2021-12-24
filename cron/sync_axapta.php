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

$check_task = false;
$fullupdate = false;

if(isset($argv[1]) && $argv[1]=='start') {
    $check_task = true;
} elseif(isset($argv[1]) && $argv[1]=='full') {
    $fullupdate = true;
}

$db = new DB\MySQLi(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
//$db_ax = new DB\mPDO(DB_AX_HOSTNAME, DB_AX_USERNAME, DB_AX_PASSWORD, DB_AX_DATABASE, DB_AX_PORT);
 

class Model {}
$object = new Model;
$model_api_axapta = new ModelApiAxapta;
//$model_catalog_category = new ModelCatalogCategory;
$model_api_axapta->db = $db;
$object->db = $db;

if($check_task){

    $task = $model_api_axapta->getTasks();

    if($task&&$task['task_type']==0){

        if($task['task_type']=='full'){// полное обновление
            //начало выполнения
            $model_api_axapta->udateTask($task['task_id'],'1');
            $fullupdate = true;

        } else{
            exit;
        }
    } else {
        exit;
    }

} elseif($fullupdate) {

} else {
    exit;
}

$fullupdate = true;

if($fullupdate){

    /*echo "\n" . 'Обновляем совместимость';
    importCompability();
     echo "Время работы скрипта ". number_format(microtime(true) - $time_start, 2). " сек.\n";
    exit;*/

    // Получаем группы товаров на сайте2
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
    $model_api_axapta->updateCategories($categories);

    //////////////////////////////////////////////////

    $categories = $model_api_axapta->getCategories();
    //vdump($categories['Site_254']);
    // получаем документы
    $Documents = $model_api_axapta->getProductDocuments();
    foreach ($Documents as $document) {
      $Documents_n[$document['ItemId']][$document['TypeId']][] = $document;
    }
    $Documents = $Documents_n;unset($Documents_n);
    /////////////////


    $Prices = getPrices();
    $model_api_axapta->updateAvailableStart();
    $allowGroupSiteId = array(
        'Site_032', // Лазерные принтеры
        'Site_105', // Лазерные МФУ
        'Site_031', // Струйные принтеры
        'Site_065', // Струйные МФУ
        'Site_034', // Матричные принтеры
    );
    //////////////////////////////////////
    foreach ($categories as $key => $category) {
        //if($category['GroupSite2Id']!='Site_200') continue;
        //vdump($category);
          if(!$category['GroupSite2Id']) continue;
          echo "\nОбновляем " . $category['GroupSite2Id'] . "\n";

        // получаем номенклатуры
        $ProductByGroupSite2 = $model_api_axapta->getProductByGroupSite2($category['GroupSite2Id']);

        $products = array();
        // формируем массив по языкам
        foreach ($ProductByGroupSite2 as $product) {
          if($product['LanguageId']=='en-us')continue;


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

        foreach ($ProductAvailability as $key => $p_avail) {
          $product_avail[$p_avail['Item']] = $p_avail;
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
          if($category['category_id']=="88"){
            echo date("F j, Y, g:i a");
            echo "\n data[ExtAvail] " . $product['ItemKod1C'] . "\n";
            echo "\n data[Avail] " . $product['Avail'] . "\n";
            echo "\n data[DlvDays] " . $product['DlvDays'] . "\n";
            echo "\n data[ExtAvail] " . $product['ExtAvail'] . "\n";


          }
          $model_api_axapta->updateProduct($category['category_id'],$product);
            //echo "#=====================================";
          //exit;
        }
        unset($products);

        //$model_api_axapta->deleteImageDisable();

    }

    $model_api_axapta->updateAvailableEnd();

    // Добавление СЕО-урлов для совместимости принтеров
    $model_api_axapta->addUrlPrn();

    echo "\n\n";
    //echo "\n" . 'Обновляем атрибуты';
    updateAttributes();
    echo "\n" . 'Обновляем совместимость';
    importCompability();

    copyImages();

    echo "\n" . 'Очищаем кеш brainyfilter и Генерируем seo_text... ';
    refresh_brainyfilter_cache();

    echo "Время работы скрипта ". number_format(microtime(true) - $time_start, 2). " сек.\n";
    
    if($check_task) {
        $model_api_axapta->udateTask($task['task_id'], '2');
    }
    exit;
}

//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////

function getlanguageId($LanguageId) {
    $myArray = array('ru' => '1', 'ua' => '2');
    return $myArray[$LanguageId];
}

function getPrices(){
    global $model_api_axapta;
    // получаем цены 'Опт-1
    $opt_1 = $model_api_axapta->getPrices('Опт-1');
    foreach ($opt_1 as $key => $price) {
        $Prices_n[$price['ItemId']] = $price;
    }
    $opt_1 = $Prices_n;unset($Prices_n);

    $cupon20 = $model_api_axapta->getPrices('КУПОН20');
    foreach ($cupon20 as $key => $price) {
        $Prices_n[$price['ItemId']] = $price;
    }
    $cupon20 = $Prices_n;unset($Prices_n);

    // получаем цены 'Розн-Prote
    $Prices = $model_api_axapta->getPrices('Розн-Prote');
    foreach ($Prices as $key => $price) {
        $Prices_n[$price['ItemId']]['price'] = $price['PriceUa'];
        $Prices_n[$price['ItemId']]['special'] = isset($cupon20[$price['ItemId']]['PriceUa'])?$cupon20[$price['ItemId']]['PriceUa']:0;
        $Prices_n[$price['ItemId']]['points'] = isset($opt_1[$price['ItemId']]['PriceUa'])?$price['PriceUa']-$opt_1[$price['ItemId']]['PriceUa']:0;
        $Prices_n[$price['ItemId']]['price_opt1'] = isset($opt_1[$price['ItemId']]['PriceUa'])?$opt_1[$price['ItemId']]['PriceUa']:0;
    }
    $Prices = $Prices_n;
    unset($Prices_n);
    unset($opt_1);
    return$Prices;
}

function updateAttributes() {
	global $model_api_axapta;
	global $getlanguageId;
	//ini_set('max_execution_time', 600003);

	//получаем группы атрибутов
	$attributes_res = $model_api_axapta->getGroupSite2AttributesSetup();

	$filters = array();
	$attributes = array();
	// формируем массивы с атрибутами и фильтрами
	$filters_GroupSite2Id = array();
	$attributes_GroupSite2Id = array();
	foreach ($attributes_res as $key => $result) {
		if($result['isFilter']){
			$filters[$result['AttributeId']] = array(
					'AttributeId'=>$result['AttributeId'],
					'isFilter'=>$result['isFilter']
				);
			$filters_GroupSite2Id[$result['GroupSite2Id']][] = $result['AttributeId'];
		} 

		if($result['isAttribute']){
			$attributes[$result['AttributeId']] = array(
					'AttributeId'=>$result['AttributeId'],
					'isAttribute'=>$result['isAttribute']
				);
			$attributes_GroupSite2Id[$result['GroupSite2Id']][] = $result['AttributeId'];
		}
	}
	unset($attributes_res);

	
	// получаем названия атрибутов
	$attributes_name = $model_api_axapta->getAttributeName();
	$attributes_name_new = array();
	foreach ($attributes_name as $key => $value) {
		if($value['LanguageId']=='en-us')continue;
		$language_id = getlanguageId($value['LanguageId']);	
		$attributes_name_new[$value['AttributeId']]['attribute_name'][$language_id]= $value['AttributeName'];
	}
	$attributes_name = $attributes_name_new;
	unset($attributes_name_new);

	// добавляем названия атрибутов в массивы
	$filters_new=array();
	$attributes_new=array();
	foreach($filters as $key => $value){
	    $filters_new[$key] = array_merge($filters[$key], $attributes_name[$key]);
	}
	foreach($attributes as $key => $value){
	    $attributes_new[$key] = array_merge($attributes[$key], $attributes_name[$key]);
	}
	$filters = $filters_new;
	$attributes = $attributes_new;
	unset($filters_new);
	unset($attributes_new);

	//получаем значения атрибутов
	$attrValues = $model_api_axapta->getAttributeValues();
	$attrValuesName = $model_api_axapta->getAttributeValueName();

	// массив атрибутов со значениями + названия
	$ar_attrValuesName = array();
	$ar_filterValuesName = array();
	foreach ($attrValuesName as $key => $attrValueName) {
		if($attrValueName['LanguageId']=='en-us')continue;
		$language_id = getlanguageId($attrValueName['LanguageId']);

		$ar_attrValuesName[$attrValueName['ValueId']][$language_id]=$attrValueName['ValueName'];
		$ar_filterValuesName[$attrValueName['ValueId']][$language_id]=$attrValueName['ValueName'];
	}

	$ar_attrValues = array();
	$ar_filterValues = array();
	foreach ($attrValues as $key => $attrValue) {
		$ar_attrValues[$attrValue['AttributeId']][$attrValue['ValueId']]['name']=$ar_attrValuesName[$attrValue['ValueId']];
		$ar_filterValues[$attrValue['AttributeId']][$attrValue['ValueId']]['name']=$ar_filterValuesName[$attrValue['ValueId']];
		
	}

	// обновляем группы Фильтров
    echo "Обновляем группы фильтра\n";
	$model_api_axapta->updateFiltersGroup($filters);

	// обновляем Атрибуты
    echo "Обновляем атрибуты\n";
	$model_api_axapta->updateAttributes($attributes);
	// обновляем значения фильтров
    echo "Обновляем значения атрибутов\n";
	$model_api_axapta->updateFiltersValue($ar_filterValues);

	$prods_filters=array();
	$prods_attributes=array();
	// получаем атрибуты номенклатур
	$categories = $model_api_axapta->getCategories();
	
	foreach ($categories as $key => $category) {

		$products_attr = $model_api_axapta->getGroupSite2Attributes($category['GroupSite2Id']);
		if(empty($products_attr)) continue;

		// получаем номенклатуры и формируем массивы товаров с атрибутами и фильтрами
		foreach ($products_attr as $attr) {
			if(!$attr['ValueId'])continue;
			
			if(isset($attributes_GroupSite2Id[$category['GroupSite2Id']]) && in_array($attr['AttributeId'],$attributes_GroupSite2Id[$category['GroupSite2Id']])){
            	if( array_key_exists($attr['ValueId'], $ar_attrValues[$attr['AttributeId']]) ){
            		$prods_attributes[$attr['ItemId']][] = array(
            			'AttributeId'	=> $attr['AttributeId'],
            			'ValueId'	=> $attr['ValueId'],
            			'name'		=>$ar_attrValues[$attr['AttributeId']][$attr['ValueId']]['name']
            		);
            	}
            }
            if(isset($filters_GroupSite2Id[$category['GroupSite2Id']]) && in_array($attr['AttributeId'],$filters_GroupSite2Id[$category['GroupSite2Id']])){
            	if( array_key_exists($attr['ValueId'], $ar_filterValues[$attr['AttributeId']]) ){

                	$prods_filters[$attr['ItemId']][] = array(
            			'FilterId'	=> $attr['AttributeId'],
            			'ValueId'	=> $attr['ValueId']/*,
            			'name'		=>$ar_filterValues[$attr['AttributeId']][$attr['ValueId']]['name']*/
            		);
                }
            }
			
		}

	}
	unset($attributes_GroupSite2Id);

	// обновляем фильтры и атрибуты товаров
	echo "Обновляем фильтры товаров\n";
	$model_api_axapta->udateProductFilters($prods_filters);
	unset($prods_filters);

	
	echo "Обновляем атрибуты товаров\n";
	$model_api_axapta->udateProductAttributes($prods_attributes);
	unset($prods_attributes);

}


function importCompability() {
    global $model_api_axapta;

    //получаем все совместимости
    $products = $model_api_axapta->getProductCompatibility();
    $model_api_axapta->updateCompatibility($products);
}


function copyImages($product_id = false) {
    global $model_api_axapta;

    $product_images = $model_api_axapta->getProductImages($product_id);

    $count=0;

    if($product_images){
        echo "copy image\n";
        foreach ($product_images as $image) {

            $foto_ax = DIR_AX_DOCS_IMAGE.$image['ax_filename'];

            if (file_exists($foto_ax) && $image['image']) {

                $image_old = $foto_ax;
                $image_new = $image['image'];

                copyImage($image_old,$image_new);
            }

        }
    }

}

function copyImage($image_old,$image_new){
    if (!is_file(DIR_IMAGE . $image_new) || (filemtime($image_old) > filemtime(DIR_IMAGE . $image_new))) {
        $path = '';
        $directories = explode('/', dirname($image_new));
        foreach ($directories as $directory) {
            $path = $path . '/' . $directory;

            if (!is_dir(DIR_IMAGE . $path)) {
                @mkdir(DIR_IMAGE . $path, 0777);
            }
        }
        copy($image_old, DIR_IMAGE . $image_new);
        echo '#';
    }
}

function refresh_brainyfilter_cache() {
    
    $username = 'gdemon';
    $password = 'demon68510';
    $apiKey = 'get_api';
    $domen = HTTPS_SERVER_ADMIN;

    $loginUrl = $domen.'index.php?route=common/login/';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $loginUrl);
    curl_setopt($ch, CURLOPT_POST, true );

    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'username='.$username.'&password='.$password.'&apiKey='.$apiKey);
    curl_setopt($ch , CURLOPT_COOKIEJAR, DIR_ROOT.'cron/cookies_.txt');
    curl_setopt($ch , CURLOPT_COOKIEFILE, DIR_ROOT.'cron/cookies_.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = json_decode(curl_exec( $ch ));
    print_r(curl_error($ch));
    if(curl_errno($ch)){
        print_r(curl_error($ch));
        throw new Exception(curl_error($ch));
    }

    $token = $response->token;
    echo "\nToken = ".$token."\n";

    if($response->token){
        // чистим кеш фильтра

        $loginUrl = $domen.'index.php?route=module/brainyfilter/refresh&token='.$token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $loginUrl);
        curl_setopt($ch , CURLOPT_COOKIEJAR, DIR_ROOT.'cron/cookies_.txt');
        curl_setopt($ch , CURLOPT_COOKIEFILE, DIR_ROOT.'cron/cookies_.txt');
        //$response = curl_exec( $ch );
        curl_exec( $ch );
        echo "\nКеш brainyfilter очищен!\n";
        //curl_close($ch);
        // генерируем сео-текст
        $loginUrl = $domen.'index.php?route=catalog/product/seoshild_generate_seotext&token='.$token;
        //$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $loginUrl);
        curl_setopt($ch , CURLOPT_COOKIEJAR, DIR_ROOT.'cron/cookies_.txt');
        curl_setopt($ch , CURLOPT_COOKIEFILE, DIR_ROOT.'cron/cookies_.txt');
        curl_exec( $ch );
        //echo "\nСео-текст сгенерирован!\n";
        //Создание УРЛ фильтров
        $loginUrl = $domen.'index.php?route=catalog/product/make_filters&token='.$token;
        curl_setopt($ch, CURLOPT_URL, $loginUrl);
        curl_setopt($ch , CURLOPT_COOKIEJAR, DIR_ROOT.'cron/cookies_.txt');
        curl_setopt($ch , CURLOPT_COOKIEFILE, DIR_ROOT.'cron/cookies_.txt');
        curl_exec( $ch );
        echo "\nУРЛ для фильтров созданы!\n";
        //print_r($response);
        curl_close($ch);

        //echo "\n" . 'Cгенерирован seo_text!';
        return 'ok';
    }

}



