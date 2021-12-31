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



    global $model_api_axapta;
    $product_id = '91206';
    $product_images = $model_api_axapta->getProductImages($product_id);

    $count=0;

    if($product_images){
       
        foreach ($product_images as $image) {

            $foto_ax = DIR_AX_DOCS_IMAGE.$image['ax_filename'];
           
            if (file_exists($foto_ax) && $image['image']) {
                echo "<br>paaaaaath<br>";
                $image_old = $foto_ax;
                $image_new = $image['image'];
               
                    $path = '';
                    $directories = explode('/', dirname($image_new));
                    foreach ($directories as $directory) {
                        $path = $path . '/' . $directory;
                        echo "<br>path<br>";
                        var_dump($path);
                        if (!is_dir(DIR_IMAGE . $path)) {
                            @mkdir(DIR_IMAGE . $path, 0777);
                        }
                    }
                    echo "<br>image_old<br>";
                    var_dump($image_old);
                    echo "<br>DIRgggg_IMAGE<br>";
                    var_dump(DIR_IMAGE);
                    echo "<br>image_new<br>";
                    var_dump($image_new);
                    copy($image_old, DIR_IMAGE . $image_new);
                    echo '#';
                }
               // $this->copyImage($image_old,$image_new);
            }
 
        }
    

/*
    echo "copy image\n";
    if (!is_file(DIR_IMAGE . $image_new) || (filemtime($image_old) > filemtime(DIR_IMAGE . $image_new))) {
        echo "copy \n";
        $path = '';
        $directories = explode('/', dirname($image_new));
        foreach ($directories as $directory) {
            $path = $path . '/' . $directory;
            echo "<br>path<br>";
            var_dump($path);
            if (!is_dir(DIR_IMAGE . $path)) {
                @mkdir(DIR_IMAGE . $path, 0777);
            }
        }
        echo "<br>image_old<br>";
        var_dump($image_old);
        echo "<br>DIR_IMAGE<br>";
        var_dump(DIR_IMAGE);
        echo "<br>image_new<br>";
        var_dump($image_new);
        copy($image_old, DIR_IMAGE . $image_new);
        echo '#';
    }

*/

