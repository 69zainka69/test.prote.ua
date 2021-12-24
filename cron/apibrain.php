<?php

require_once('/var/www/prote/data/www/prote.ua/config.php');

// Преобразование русских в латиницу
function ru2Lat($string)
{
  $rus = array('ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я',' ', '.','+','(',')','/','\\',chr(34),chr(39),'?','№','&', '#','!','*','|',':','�',' ');
  $lat = array('yo','zh','tc','ch','sh','sh','yu','ya','yo','zh','tc','ch','sh','sh','yu','ya', '-', '', '', '','', '', '', '','','','N','','' ,'','x','','-','','-');
  $string = str_replace($rus,$lat,$string);
  $string = str_ireplace(
  array('А','Б','В','Г','Д','Е','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ъ','Ы','Ь','Э','а','б','в','г','д','е','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ъ','ы','ь','э'),
  array('a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e','a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e'),
  $string);

  $string = str_ireplace('--','-', $string);
  // gdemon 2019.05.03
  $string = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $string);
  return strtolower ($string);
}

function productCat($product) {

    foreach($product['options'] as $k=>$v) {
        if ($v['OptionID']==120) return $v['ValueID'];
    }
    return false;
}

//
// Кросс-таблица категорий prote-brain
$occats = array (

    //     =>  '1190',       // МФУ (струйные и лазерные)
    //отключили по задаче http://portal.vm.net/redmine/issues/11675
    //'1193' => '81',       // Струйные принтеры
    //'8170' => '82',       // Лазерные принтеры
    ///////////////////////////////////////////

    '7938' => '87' ,      // Принтеры чеков
    '7939' => '85' ,      // Принтеры этикеток
    '1265' => '91' ,      // Сканнеры
    '7940' => '94' ,      // Сканнеры кодов
    '7508' => '97' ,      // Резаки и триммеры
    '8101' => '98' ,      // Нумераторы
    '7844' => '99' ,      // Проекторы
    '7846' => '100' ,     // Кронштейны для проекторов
    '7847' => '101' ,      // Лампы к проекторам
    '7848' => '102' ,     // Презентеры
    '7850'  => '103',       // LCD панели
    '7845'  => '104',       // Проекциаонные экраны
    '7849'  => '105',       // Интерактивные доски
    '8177'  => '106',       // Подставки для интерактивной доски
  //  '1333'  => '107',        // Маршрутизаторы
   // '1261'  => '108',       // Сетевые коммутаторы
    '1293'  => '109',       // Точка доступа WI_FI
    '1419'  => '110',       // Сетевые камеры
    '7332'  => '111',       // Модемы
    '1037'  => '112',       // Wi-Fi карты и адаптеры
    '7329'  => '113',       // Адаптер POE
    '8171'  => '96' ,       // Матричные принтеры
    '7328'  => '116',       // Файерволы
   // '7505'  => '83',        // Ламинаторы
    '7506'  => '84',        // Биндеры

    // Компьютерные аксессуары
    '7790' => '114',        // Стабилизаторы напряжения
    '7273' => '115',        // Источники безперебойного питания


   // '7682' => '117',        // Мониторы
   


    '1365' => '63',         // Наушники и гарнитуры
    '1038' => '61',         // Аккустические системы
    '1360' => '62',         // Веб-камеры
    '1363' => '118',        // Микрофоны
    '1040' => '119',        // Коврики для мышек
    '1269' => '64',         // Клавиатуры
    '1272' => '72',         // Мышки
    '1441' => '78',         // Корпуса
    '1334' => '120',        // ОЗУ
    '1442' => '121',        // Блоки питания
    '1361' => '122',        // Жесткие диски
    '1180' => '66',         // Флеш накопители
    '1260' => '75',         // Карты памяти
    '1108' => '123',        // Вентиляторы для процессоров
    '1443' => '124',        // Вентиляторы для корпусов
    //'7509' => '95',        // Вентиляторы для корпусов

    '8172' => '274', //+  https://prote.ua/office-supplies/plotter/ https://brain.com.ua/category/Plotter-c8172-461/
    '8220' => '275', //+  https://prote.ua/office-supplies/3d-print/ https://brain.com.ua/category/3D-printeri-c321/
    '8506' => '276', //+  https://prote.ua/office-supplies/nastolnyye-lampy/ https://brain.com.ua/category/Nastolnie_lampi-c683/
 //   '1264' => '277', //+  https://prote.ua/comp-accessories/materinskie-platy/ https://brain.com.ua/category/Systemni_materynski_platy-c1264-226/
    '1403' => '278', //+  https://prote.ua/comp-accessories/videokarty/ https://brain.com.ua/category/Videokarty-c1403/
    '1377' => '279', //+  https://prote.ua/comp-accessories/opticheskie-privody/ https://brain.com.ua/category/Optychni_pryvody_ODD-c1377-63/
   // '1484' => '280', //+  https://prote.ua/comp-accessories/ssd-nakopiteli/ https://brain.com.ua/category/SSD_dysky-c1484/
    '1381' => '281', //+  https://prote.ua/office-supplies/ip-telefony/ https://brain.com.ua/category/IP_telefoni-c343/
    '7832' => '282', //+  https://prote.ua/office-supplies/stacionarnye-telefony/ https://brain.com.ua/category/Telefony_provodnye-c7832-404/
    '7831' => '283', //+  https://prote.ua/office-supplies/radio-telefony/ https://brain.com.ua/category/Telefony_bezdrotovi-c7831-189/
    '1258' => '284', //+  https://prote.ua/office-supplies/ip-atc/ https://brain.com.ua/category/IP_ATS-c339/
    '7267' => '285', //-  https://prote.ua/office-supplies/gsm-shlyuzy/ https://brain.com.ua/category/Mizhmerezhevi_GSM-shlyuzi-c325/
    '1562' => '286', //+  https://prote.ua/office-supplies/voip-shlyuzy/ https://brain.com.ua/category/VOIP-c1562-636/
    '7834' => '287', //+  https://prote.ua/office-supplies/mini-atc/ https://brain.com.ua/category/Mini-ATS-c340/
    '1189' => '288', //-  https://prote.ua/office-supplies/sistemnye-konsoli/ https://brain.com.ua/category/Sistemni_konsoli-c342/
    '7833' => '289'  //+  https://prote.ua/office-supplies/fax-apparaty/ https://brain.com.ua/category/Faksy-c7833-191/
);

//$occats = array('1293'  => '109');

$lcodes = [
   1=>'ru',
   2=>'ua'
];

// Синхронизация по умолчанию
$typesyn='inc';
// Разбор входных параметров
//print_r($argv);
if(!isset($argv[1])){
    $typesyn = 'full';
}elseif ($a=strpos($argv[1], 'full')!==FALSE) {
    // full synchro
    $typesyn='full';
} elseif ($a=strpos($argv[1], 'increment')!==FALSE) {
    // only changed!
    $typesyn='inc';
}

// Соединение с БД
/*$dblocation = "127.0.0.1"; // Имя сервера
$dbuser = "root";          // Имя пользователя
$dbpasswd = "RooT";            // Пароль
$dbname = "prote";         // Имя базы данных для Prote


$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
*/
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}

$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");

//$a=mysql_set_charset ('utf8', $dbcnx);

$imgpath=DIR_ROOT.'image/brain';

require_once(DIR_ROOT.'system/connectors/apibrain.php');


// Авторизация
$api=new Apibrain();
//
ini_set("memory_limit","256M");
//echo "memory_limit - 256M";
if (isset($argv[1])&&strpos($argv[1], 'cat')!==FALSE) {
    // Список категорий
    $result=$api->call('categories');
    $catlist=json_decode($result, true);
    echo count($catlist);
    echo DIR_ROOT.'  /exec/catlist.txt';
    file_put_contents(DIR_ROOT.'cron/catlist_log.txt', print_r($catlist,1) . PHP_EOL, FILE_APPEND);
    //echo '<pre>'.print_r($catlist,1).'</pre>';
    die();
}

if (isset($argv[1])&&strpos($argv[1], 'prod=')!==FALSE) {
    // Информация по продукту
    $prod=substr($argv[1], 5, 20);
    $result=$api->call('product/product_code/'.$prod);

    $prodinfo=json_decode($result, true);
    $result=$api->call('product_options/'.$prodinfo['result']['productID'], array('lang'=>'ru') );
    $prodinfo['result']['options'] =json_decode($result,true)['result'] ;

    echo '<pre>'.print_r($prodinfo,1).'</pre>';
    die();
}

if (isset($argv[1])&&strpos($argv[1], 'orders')!==FALSE) {
    // Список заказов
    $result=$api->call('orders');
    $catlist=json_decode($result, true);
    echo count($catlist);
    echo '<pre>'.print_r($catlist,1).'</pre>';
    die();
}

if (isset($argv[1])&&strpos($argv[1], 'filtr=')!==FALSE) {
    // Список категорий
    $cat=substr($argv[1], 6, 20);

    foreach ($occats as $key=>$v) {
    $cat=$key;

    $result=$api->call('filters_all/'.$cat, array('lang'=>'ru'));
    $catlist=json_decode($result, true);

    // print_r($catlist['result']);
    // Поиск блока "производители"
    foreach ($catlist['result'] as $f4) {
        if ($f4['optionID']==3) {
            $m=$f4['filters'];
            break;
        }
    }
    if ($m) {
        // Обновление фильтров
        foreach ($m as $f) {
            print_r($f);
            $sSQL="select * from oc_filter_xtab where cont_fid='".$f['filterID']."'";
            echo"\n---- sSQL 1";
            echo $sSQL."\n";

            $f2 = getQuery($sSQL, $dbcnx);
            if (!($f2->row)) {
                $sSQL="select * from oc_filter_description where name like '".$f['name']."' and filter_group_id=1 and language_id=1";
                echo"\n---- sSQL 2";
                echo $sSQL."\n";
                $f1=getQuery($sSQL, $dbcnx);
                if ($f1->row) {
                    $sSQL="INSERT INTO oc_filter_xtab(x_id,contragent_id,origin_fid,cont_fid) VALUES (0,1,'".$f1->row['filter_id']."','".$f->row['filterID']."')";
                    echo"\n---- sSQL 3";
                    echo $sSQL."\n";
                    //getQuery($sSQL, $dbcnx);
                    //getQuery($sSQL, $dbcnx);
                }
            }

        }
    }
    }
    // echo count($catlist);
    // echo '<pre>'.print_r($catlist['result'][3],1).'</pre>';
    die();
}

if (isset($argv[1])&&strpos($argv[1], 'price')!==FALSE) {
    echo date('Y-m-d H:i'),"\t",'CHECK'."\n";
    // Получение прайс-листа
    $result=$api->call('pricelists/29/json');

    $priceurl=json_decode($result, true)['url'];
    $tmp_price=json_decode(file_get_contents($priceurl), true);

    // Получаем список товаров
    $sSQL="
        SELECT `product_id`, `sku`, `upc`, `price` FROM `oc_product`
        WHERE `src`= 'B' AND `status`='1'";
            // echo $sSQL;
    //if (!()) throw new Exception('MySQL error: ' .  $sSQL);
    $i=0;
    $f=getQuery($sSQL, $dbcnx);
    //while ($row = mysql_fetch_array($f)) {
    foreach ($f->rows as $row) {
        $row['upc']=substr($row['upc'], 1);
        if (isset($tmp_price[$row['upc']]) && $tmp_price[$row['upc']]['RetailPrice'] && $tmp_price[$row['upc']]['RetailPrice']<>$row['price']) {
            // Для логфайла
            echo date('Y-m-d H:i'),"\t".'['.$row['upc'].']'."\t".sprintf('%d',$row['price']).'->'.$tmp_price[$row['upc']]['RetailPrice']."\n";

            $sSQL="UPDATE `oc_product` SET price=".$tmp_price[$row['upc']]['RetailPrice']." WHERE `product_id`=".$row['product_id'];
            getQuery($sSQL, $dbcnx);
                //if (!(getQuery($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
        }
    }

    // echo '<pre>'.print_r($catlist,1).'</pre>';
    die();
}
$fullattrib=0;
if (isset($argv[1])&&strpos($argv[1], 'c=')!==FALSE) {
    $tmpcat=substr($argv[1], 2, 10);
    $typesyn='full';
    $fullattrib=1;
    // Список категорий
    if (isset($occats[$tmpcat])) {
        $occats = array ($tmpcat => $occats[$tmpcat]);
    } else {
        echo 'Wrong category: '. $tmpcat;
        die();
    }
}


// Расширенный список аттрибутов
/* 01.07.2021


if (in_array('-fa', $argv)) {
    $fullattrib=1;
}

// Обновляем только цены
if (in_array('-p', $argv)) {
    $priceonly=1;
}


// Обновляем изобрвжения
if (in_array('-i', $argv)) {
    $imagesupd=1;
}
*/
// Список складов
//$result=$api->call('targets');
//$catlist=json_decode($result, true);
//echo '<pre>' . print_r($catlist,1) . '</pre>';
////
// die();

if ($typesyn=='inc') {
    // Список измененных товаров
    $result=$api->call('modified_products');
    $catlist=json_decode($result, true);
    $prodIDs=$catlist['result']['productIDs'];
    // echo '<pre>' . print_r($prodIDs,1) . '</pre>';
    // die();
}

foreach ($occats as $categoryId => $categoryValue) {
    //if($categoryId!=7833)continue;
    //if($categoryId!=1272)continue;

    // Список производителей товаров для категории
    $result=$api->call('vendors/'.$categoryId);

    $vendors_tmp=json_decode($result, true);

    $vendors=array();
    foreach ($vendors_tmp['result'] as $v) {
        $vendors[$v['vendorID']]=$v['name'];
    }

    // Запускаем процедуру для двух языков
    for ($kode=1; $kode<=2; $kode++) {

        $langid=$lcodes[$kode];


    //
    $prodlist=array();
    $addparams=array();
    $offset=0;
    $loop=1;

    // Разбиение идет по 100 позиций, потому читаем в цикле.
    while ($loop) {
        $loop=0;
        $result=$api->call('products/'.$categoryId, array('offset'=>$offset, 'lang'=>$langid));

        $prodl=json_decode($result, true);

        // print_r($prodl); die();
        // Список номеров товара категории
        $numlist=array();



        foreach ($prodl['result']['list'] as $prodlitem) {
            //print_r($prodlitem['product_code']);

            // Проверка - есть ли этот продукт в списке измененных
            // gdemon - нужно отключать при добавлении новы групп
            if (!isset($prodIDs) || in_array($prodlitem['productID'], $prodIDs, true)) {

                // Отбираем
                $addparams[$prodlitem['productID']]=array(
                    'retail_price_uah'=>$prodlitem['retail_price_uah'],
                    'available'=>$prodlitem['available'],
                    'stocks_expected'=>$prodlitem['stocks_expected']
                );
                $numlist[]=$prodlitem['productID'];
            }
        }

        // print_r($numlist); die();
        if ($numlist) {
            // Получаем дполнительную инфу для списка товара
            $result=$api->callpost('products/content', array('productIDs'=>implode(',',$numlist), 'lang'=>$langid));
            $ddd = json_decode($result,true);
            foreach ($ddd['result']['list']  as $itemm) {
                /*echo $itemm['product_code'];
                if($itemm['product_code'] == 'U0219692'){
                    print_r("\n***************************************\n");
                    //print_r($prodlitem);
                    print_r($itemm);
                    print_r("\n***************************************\n");
                    exit;
                }*/
               /* print_r("\n***************************************\n");
                //print_r($prodlitem);
                print_r($itemm);
                print_r("\n***************************************\n");
                exit;*/
            }


            // Добавляем в общий список
            $prodlist=array_merge($prodlist, json_decode($result,true)['result']['list']);
        }

        if ($prodl['result']['count']>$offset+100) {
            $offset += 100;
            $loop = 1;
        }
    }


    //    echo '<pre>'.count($prodlist).'</pre>';
    //    die();

    // Проверка наличия папки для фото категори
    if (!file_exists($imgpath.'/'.$categoryId)) {
        //echo $imgpath.'/'.$categoryId;
        mkdir($imgpath.'/'.$categoryId);
    }

    // Детальное описание товара
    $errcount=0;
    $attr=array();
    $options=array();
    $values=array();
    $numIns=0;
    $numUpd=0;
    $numInsTotal=0;
    $numUpdTotal=0;
    $av=0;
    $avs=array();
    // Для тестов берем первые 10 элементов!!!
//    $prodlist=array_slice($prodlist, 0, 10);
//    //
//    echo '<pre>'.print_r($prodlist,1).'</pre>';
//    die();

    // Биндеры - берутся как фильтр из более общей категории
    if ($categoryId==7506) {

        // Для этой категории необходимо загружать прайс для определения класса товара
        // ***
        // Получение прайс-листа
        $result=$api->call('pricelists/29/json');

        $priceurl=json_decode($result, true)['url'];
        // unset($tmp_price);
        $tmp_price=json_decode(file_get_contents($priceurl), true);
        foreach ($tmp_price as $k=>$tp) {
            if ($tp['CategoryID']!=7506) unset($tmp_price[$k]);
        }
        // print_r($tmp_price);
        // die();

    }



    foreach ($prodlist as $k => $d) {

        // Отладка - выполняем только для одной карточки
        // if ($d['product_code']!=='U0000363') continue;

        // Если входная категория МФУ - распределяем их на лазерные и стуйные
        /*if ($categoryId==1190) {
            if (productCat($d)=='86018846700') $occats[$categoryId]='88';
            if (productCat($d)=='86018846800') $occats[$categoryId]='89';
        }*/

        // Отдельная ветка для БИНДЕРОВ
        if ($categoryId==7506 && isset($tmp_price[$d['productID']]['ClassID'])&&$tmp_price[$d['productID']]['ClassID']!=1113) continue;

        //
        //    foreach($addparams[$d['productID']]['available'] as $key=>$val) {
        //        if (isset($avs[$key])) $avs[$key]++;
        //        else $avs[$key]=1;
        //
        //    }

        // Товар доступен на складе
        $avail = (isset($addparams[$d['productID']]['available'][1]) ? $addparams[$d['productID']]['available'][1] : false);

        // Товар ожидается на складе...
        if (isset($addparams[$d['productID']]['stocks_expected'][1])) {
           $date_available=$addparams[$d['productID']]['stocks_expected'][1];
           $avail=1;
        }

        if ($avail) $av++;

        try {
            echo "#$k:",$d['productID'],'/',$d['product_code'];

            $sSQL="
            SELECT `product_id` FROM `oc_product`
            WHERE `sku`= '" . $d['product_code'] . "' AND `upc`='B" . $d['productID'] . "'";
             // echo $sSQL;
            //if (!($f=getQuery($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);

            $f=getQuery($sSQL, $dbcnx);

            //if ($row = mysql_fetch_array($f)) {
            if ($row = $f->row) {

                $lastid=$row['product_id'];

            //if($lastid!=18141)continue;

                // Обновление записи
                // ...
                $sSQL="
                UPDATE `oc_product`
                SET
                  `model`='".$d['product_code']."',
                  `status`='".($avail ? 1 : 0)."',
                  `date_available`='".(0 && $date_available ? $date_available : '0000-00-00 00:00:00')."',
                  `shipping`='1',
                  `is_complex`='1',
                  `quantity`=".($avail ? $avail : '0').",
                  `price`='".$addparams[$d['productID']]['retail_price_uah']."',
                  `mpn`='".$d['product_code']."',
                  `date_modified`=now()
                WHERE `product_id`= '" . $lastid . "'";
                // echo $sSQL;

                // if ($date_available) { echo $sSQL; die(); }
                getQuery($sSQL,$dbcnx);
                //if(!getQuery($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);

                $numUpd++;
                echo "\n" . 'Обновление oc_product: ' . $d['product_code'], '#', $lastid, "\n" ;

            } elseif ($avail) {
                // Создание записи в основной таблице
                $sSQL="
                INSERT `oc_product`
                  (`sku`,`upc`, `model`, `mpn`, `status`, `quantity`, `price`,`image`,`shipping`, `date_available`, `date_added`, `src`, `is_complex`)
                VALUES
                  ('".$d['product_code']."',
                  'B".$d['productID']."',
                  '".$d['product_code']."',
                  '".$d['product_code']."',
                  '".($avail ? 1 : 0)."',
                  '".($avail ? $avail : '0')."',
                  ".$addparams[$d['productID']]['retail_price_uah'].",
                  '',
                  '1',
                  '".($date_available ? $date_available : '0000-00-00 00:00:00')."',
                  now(),
                  'B',
                  '1')";

                // echo "\n" . $sSQL;
                echo "\n" . 'Вставлено oc_product' . $d['product_code'], "\n";
                //if(!getQuery($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);
                //$lastid=mysql_insert_id($dbcnx);
                getQuery($sSQL,$dbcnx);
                $lastid = $dbcnx->insert_id;

                $numIns++;

                // Привзываем к магазину
                $sSQL="INSERT IGNORE INTO `oc_product_to_store` (`product_id`, `store_id`) VALUES ('$lastid', '0')";
                getQuery($sSQL, $dbcnx);
                //if(!(getQuery($sSQL, $dbcnx))) throw new Exception('MySQL error'  . $sSQL);
                //

            } else {
                continue;
            }

            // Не обновляем данные для недоступных наименований
            // if ($avail==FALSE) continue;
            // Привязываем к категории
            $sSQL="INSERT IGNORE INTO `oc_product_to_category` (`product_id`, `category_id`, `main_category`) VALUES ('$lastid', '".$occats[$categoryId]."', '1')";
            getQuery($sSQL, $dbcnx);

            // Обновление или создание description
            $sSQL="
            SELECT `product_id`, `language_id`, `description`
            FROM `oc_product_description`
            WHERE `product_id`='". $lastid ."' AND `language_id`='". $kode ."'";

            $f = getQuery($sSQL, $dbcnx);
            //if(!($f=getQuery($sSQL, $dbcnx))) throw new Exception('MySQL error'  . $sSQL);
            //if ($row = mysql_fetch_array($f)) {
            if ($row = $f->row) {

                $sSQL="UPDATE `oc_product_description` SET `name`='".escape(substr($d['name'], 0, 254))."', `tag`='".escape($d['brief_description'])."', `description`='".escape($d['description'])."'WHERE `product_id`=".$lastid." AND `language_id`=".$kode;
                //if(!getQuery($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);
                getQuery($sSQL, $dbcnx);

                echo 'U(', $kode, ') '  ;
                // }

            } else {


                $sSQL="
                INSERT `oc_product_description` SET `product_id`=".$lastid.", `language_id`=".$kode.", `name`='".escape(substr($d['name'], 0, 254))."', `tag`='".escape($d['brief_description'])."', `description`='".escape($d['description'])."'";

                 echo 'I(', $kode, ') ';

                //if(!getQuery($sSQL, $dbcnx)) throw new Exception('MySQL error: ' . $sSQL);
                getQuery($sSQL, $dbcnx);
            }



            // Аттрибуты записей + фильтры
            // Включить для полной синхронизации атрибутов!!!
            if ($fullattrib) {
                $result=$api->call('product_options/'.$d['productID'], array('lang'=>$langid) );
                $d['options'] =json_decode($result,true)['result'] ;
            }
            //
            // print_r($d['options']);
            $attriblist=array();



            // Необходимо удалять аттрибуты и фильтры перед тем, как вставлять новые
            $sSQL="DELETE FROM `oc_product_filter` WHERE product_id=".$lastid;
            // echo $sSQL;
            //if(!($f=getQuery($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
            getQuery($sSQL, $dbcnx);
            // ПОКА НЕ ВКЛЮЧАТЬ!!!
            //
            foreach ($d['options'] as $v) {
                // Чтобы отличать наши атрибуты от сторонних - добавляем "соль" - 100000
                $attribid=100000+$v['OptionID'];
                // Проверяем наличие в кросс-таблице
                $sSQL="SELECT * FROM `oc_attribute_xtab` WHERE contragent_id=1 AND cont_fid='".$attribid."' LIMIT 1";

                $f = getQuery($sSQL, $dbcnx);
                //if(!($f=getQuery($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
                if ($row = $f->row) {
                    // echo $row['origin_fid'].'>'.$attribid;
                    $attribid = $row['origin_fid'];
                } else {
                    // Проверяем создаем запись в таблице описаний аттрибутов
                    $sSQL="SELECT * FROM `oc_attribute_description` WHERE attribute_id='".$attribid."' AND language_id='".$kode."' LIMIT 1";
                    //if(!($f=getQuery($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
                    $f=getQuery($sSQL,$dbcnx);
                    if (!$f->row) {
                       $sSQL="INSERT IGNORE INTO `oc_attribute` ". "(`attribute_id`, `attribute_group_id`)". "values ('".$attribid."', '1')";;
                       // echo $sSQL;
                        getQuery($sSQL,$dbcnx);

                       $sSQL="INSERT INTO `oc_attribute_description` ". "(`attribute_id`, `language_id`, `name`)". "values ('".$attribid."', '". $kode."', '" . escape( $v['OptionName']) . "')". "ON DUPLICATE KEY UPDATE
                       `attribute_id` = '".$attribid."',
                       `language_id` = '". $kode."',
                       `name` = '" . escape( $v['OptionName']) . "',
                       `updated` = now()";

                        getQuery($sSQL,$dbcnx);
                    }

                }
                // echo '************'.$attribid.'**************';
                // print_r($v);
                // Создание записи в таблице аттрибутов
                $attriblist[$attribid]['ValueName'][]=$v['ValueName'];
                $attriblist[$attribid]['ValueID']=$v['ValueID'];
                // if ($attribid==3) print_r($v);
                // Обработка фильтров

                if (isset($v['FilterID'])) {
                    if($v['OptionID']==3){
                        continue;
                    }
                    if ($attribid>100000) {
                        // Для внешних фильтров могут понадобиться свои фильтры
                        // Группы фильтров
                        $sSQL="INSERT IGNORE INTO `oc_filter_group` (filter_group_id, sort_order) values ('$attribid', 0)";
                        getQuery($sSQL,$dbcnx);

                        // Описание групп фильтров
                        $sSQL="INSERT IGNORE INTO `oc_filter_group_description`(filter_group_id, language_id, name) VALUES ('$attribid', '$kode', '" . escape( $v['OptionName']) . "')";
                        getQuery($sSQL,$dbcnx);
                    }

                    // Проверяем наличие созданных ранее фильтров
                    $sSQL="SELECT * FROM `oc_filter_xtab` WHERE `contragent_id`=1 AND `cont_fid`='".$v['FilterID']."'";

                    $f=getQuery($sSQL,$dbcnx);

                    if (!$row = $f->row) {

                        // Такого фильтра не существует - создаем его
                        $sSQL="INSERT INTO `oc_filter`(filter_group_id, sort_order) VALUES ('$attribid', 0)";
                        getQuery($sSQL,$dbcnx);
                        $filter_last_id = $dbcnx->insert_id;

                        // Заполняем ХТАБ
                        $sSQL="INSERT INTO `oc_filter_xtab`(contragent_id, origin_fid, cont_fid) VALUES (1, '$filter_last_id', '" . escape( $v['FilterID']) . "')";
                        getQuery($sSQL,$dbcnx);

                    } else {
                        // echo '****фильтр уже есть:'.$row['origin_fid'];
                        $filter_last_id=$row['origin_fid'];
                    }

                    // Добавляем описание
                    $sSQL="INSERT INTO `oc_filter_description`(filter_id, filter_group_id, language_id, name) VALUES ($filter_last_id, '$attribid', '$kode', '" . escape( $v['FilterName']) . "') ON DUPLICATE KEY UPDATE `name` = '" . escape( $v['FilterName']) . "'";
                    getQuery($sSQL,$dbcnx);

                    // Добавляем фильтр к продукту
                    $sSQL="INSERT IGNORE INTO `oc_product_filter`(`product_id`, `filter_id`) VALUES ('$lastid', '$filter_last_id')"; //
                    getQuery($sSQL,$dbcnx);

                } else {

                }

            }
            /*if($lastid==55418 ){
                exit;
            }*/


            // Создаем записи в таблице из подготовленной таблицы аттрибутов.
            foreach ($attriblist as $k=>$v) {
                $attribtext=implode(',',$v['ValueName']);
                $sSQL="INSERT INTO `oc_product_attribute` ". "(`product_id`, `language_id`, `attribute_id`, `text`, `ext_value_id`) ". "values ('" .$lastid. "','". $kode . "','" . $k . "','" .  escape( $attribtext )."','" .  escape( $v['ValueID'] )."')". "ON DUPLICATE KEY UPDATE `text` = '" . escape( $attribtext ) . "', `ext_value_id` = '" .  escape( $v['ValueID'] )."'";
                getQuery($sSQL,$dbcnx);
            }


            // Отдельно обрабатываем ситуацию с брендом
            if(isset($vendors[$d['vendorID']])) {
                $sSQL="SELECT * FROM `oc_filter_description` WHERE `filter_group_id`=1
                AND UPPER(`name`)='".escape(strtoupper($vendors[$d['vendorID']]))."' AND `language_id`='".$kode."' ORDER BY filter_id ASC LIMIT 1";

                /*echo "\n Отдельно обрабатываем ситуацию с брендом";
                */
                //if (!($f=getQuery($sSQL,$dbcnx))) throw new Exception('MySQL error' . $sSQL);
                $f = getQuery($sSQL,$dbcnx);

                if (!$row = $f->row) {
                    /*if($lastid==18803){
                        print_r($row);
                    }*/

                    // Такого фильтра не существует - создаем его
                    $sSQL="INSERT INTO `oc_filter`(filter_group_id, sort_order) VALUES (1, 0)";
                    getQuery($sSQL,$dbcnx);
                    $filter_last_id = $dbcnx->insert_id;

                    // Добавляем описание
                    $sSQL="INSERT INTO `oc_filter_description`(filter_id, filter_group_id, language_id, name) VALUES ($filter_last_id, '1', '$kode', '" . escape( $vendors[$d['vendorID']]) . "') ON DUPLICATE KEY UPDATE `name` = '" . escape( $vendors[$d['vendorID']] ) . "'";
                    getQuery($sSQL,$dbcnx);

                } else {
                    $filter_last_id=$row['filter_id'];
                }
            }

            // Добавляем фильтр к продукту
            $sSQL="INSERT IGNORE INTO `oc_product_filter`(`product_id`, `filter_id`) VALUES ('$lastid', '$filter_last_id')";
            getQuery($sSQL,$dbcnx);

            // Аттрибуты - фильтры
            if ($imagesupd=true) {
                // Изображение товароа
                $mainimgupd=1;
                foreach ($d['images'] as $imgfilerec) {
                    // $imgfile='http://opt.brain.com.ua/static/images/prod_img/4/0/U0000640_small.jpg';
                    $fiexist=0;
                    $imgfile = $imgfilerec['large_image'];
                    $imgparts=explode('/', $imgfile);
                    $imgname=$imgpath .'/' . $categoryId .'/' .end($imgparts);
                    // print_r($val); die();
                    // Если файла нет - загружаем и создаем его.
                    //



                    // временное отключение проверки присутсвия файла maxis
                    if (!file_exists($imgname)) {
                        $ch = curl_init($imgfile);
                        $fp = fopen($imgname, 'wb');
                        curl_setopt($ch, CURLOPT_FILE, $fp);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_exec($ch);
                        $filesize=curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
                        curl_close($ch);
                        fclose($fp);

                        // Проверка типа файла
                        if ($filesize>5000) {
                            echo 'new: ' . end($imgparts) . 'Size: ' . $filesize ."\n";
                            $fiexist=1;
                        }
                    } else {
                        echo 'exist: ' . end($imgparts) . "\n";
                        $fiexist=1;
                    }

                    if ($fiexist) {
                        // При необходимости добавяем запись

                        /* УБРАЛ, использую $lastid
                        // Внутренний номер продукта
                        $sSQL="SELECT product_id from oc_product where `upc`='B".$d['productID']."' and `src`='B'";
                        if (!($f=getQuery($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
                        $row = mysql_fetch_array($f);

                        $product_id=$row['product_id'];
                        echo 'Compare:',($product_id==$lastid ? 'OK': 'NO');
                        *******************/

                        // Внутренний номер продукта
                        $product_id=$lastid;

                        $sSQL="SELECT * from `oc_product_image`
                        WHERE `product_id` ='$product_id' AND `image`='".'brain/' . $categoryId .'/' .end($imgparts)."'";

                        $f = getQuery($sSQL,$dbcnx);
                        //if (!($f=getQuery($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);

                        if (!$f->row) {
                            echo 'insert!';
                            $sSQL="INSERT `oc_product_image` (`product_id`, `image`, `sort_order`) VALUES ($product_id, '". 'brain/' . $categoryId .'/' .end($imgparts) ."',
                                  '".$imgfilerec['priority']."')";
                            getQuery($sSQL,$dbcnx);
                            //if (!($f=getQuery($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
                        }

                        if ($mainimgupd) {
                            // Обновление "главного" изображения
                            // в качестве главного - используем первое изображение из галереи.

                            $sSQL="UPDATE `oc_product` SET `image`='".'brain/' . $categoryId .'/' .end($imgparts) ."' WHERE `product_id` = '$product_id'";
                            getQuery($sSQL,$dbcnx);

                            // обновление главной картинки выполнено...
                            $mainimgupd=0;
                        }
                    // die();
                    }
                }
            }
            // Изображения

            // Generate SEO URL
            // Нужно продумать как быть при смене наименования
            $sSQL="SELECT * FROM `oc_url_alias` WHERE `query`='product_id=".$lastid ."'";
            //if (!($f=getQuery($sSQL,$dbcnx))) throw new Exception('MySQL error' . $sSQL);
            $f = getQuery($sSQL,$dbcnx);

            // Запись seo_alias создается только в том случае, если ее нет
            if (!$f->row) {

                $seftext=trim(ru2Lat(trim(mb_substr($d['name'],0,50,'UTF-8'))),'-').'-'.$d['product_code'];
                $seftext=str_replace(',', '', strtolower($seftext));

                $sSQL="INSERT INTO `oc_url_alias` VALUES (0, 'product_id=" . $lastid . "','".$seftext."', now()) ";
                getQuery($sSQL,$dbcnx);

                //if (!getQuery($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
                echo "\n SEF создан" . $seftext;
                // echo $sSQL;
            }
            // SEO

            //if (!getQuery($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
            //

        // Перехват ошибки базы данных
        } catch (Exception $e) {
                echo "Исключение:", $e->getMessage(), ' в строке:', $e->getLine(), "\n";
                print_r($d);
                $errcount++;
                die();

        }

        // Отключение несинхронизировнных записей (через неделю)
        //$sSQL="UPDATE `oc_product` SET `status`=0 WHERE src='B' AND date_modified  <= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY) AND status=1";
        $sSQL="UPDATE `oc_product` SET `status`=0, price = 0 WHERE src='B' AND date_modified  <= DATE_SUB(CURRENT_DATE, INTERVAL 2 DAY)";
        getQuery($sSQL,$dbcnx);


        $numInsTotal+=$numIns;
        $numUpdTotal+=$numUpd;
    }
    echo "\n" . 'Тип синхронизации: '.$typesyn;
    echo "\n" . 'В категорию '.$categoryId.' ['.$langid.']';
    echo "\n" . 'Добавлено: '.$numIns.' записей';
    echo "\n" . 'Обновлено: '.$numUpd.' записей';
    echo "\n" . 'Доступно: '.$av.' записей';
    echo "\n" . 'Количество исключений' . $errcount;
    echo "\n" ;

    } // for ... $kode

} // for ... $occat

// Отключаем те товары, которые не были просинхронизированы (в случае полной синхронизации)

if ($typesyn=='full') {
    $sSQL = 'UPDATE `oc_product` set `status`=0 where date_modified<'.date ('Y-m-d').'  AND `status`=1';
    $f = getQuery($sSQL,$dbcnx);
    //$numDel=mysql_affected_rows($dbcnx);
    echo "\n" . 'Всего скрыто: '.$f.' записей' . "\n" ;
}

echo "\n" . 'Всего добавлено: '.$numInsTotal.' записей';
echo "\n" . 'Всего обновлено: '.$numUpdTotal.' записей' . "\n" ;

function escape($value) {
  global $dbcnx;
    return $dbcnx->real_escape_string($value);
}

function getQuery($sql,$link) {

    //file_put_contents(DIR_ROOT.'cron/logs/braine_sql_'.Date('Y-m-d h').'.log', ''.Date('Y-m-d h:i:s').' - sql = '.$sql. "\n", FILE_APPEND);
  $query = $link->query($sql);
  if (!$link->errno) {
      if ($query instanceof \mysqli_result) {
        $data = array();

        while ($row = $query->fetch_assoc()) {
          $data[] = $row;
        }

        $result = new \stdClass();
        $result->num_rows = $query->num_rows;
        $result->row = isset($data[0]) ? $data[0] : array();
        $result->rows = $data;

        $query->close();

        return $result;
      } else {
        return true;
      }
    } else {
      trigger_error('Error: ' . $link->error  . '<br />Error No: ' . $link->errno . '<br />' . $sql);
    }
}
