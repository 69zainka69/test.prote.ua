<?php

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
    '1333'  => '107',        // Маршрутизаторы
    '1261'  => '108',       // Сетевые коммутаторы
    '1293'  => '109',       // Точка доступа WI_FI
    '1419'  => '110',       // Сетевые камеры
    '7332'  => '111',       // Модемы
    '1037'  => '112',       // Wi-Fi карты и адаптеры
    '7329'  => '113',       // Адаптер POE
    '8171'  => '96' ,       // Матричные принтеры
    '7328'  => '116',       // Файерволы
    '7505'  => '83',        // Ламинаторы
    '7506'  => '84',        // Биндеры

    // Компьютерные аксессуары
    '7790' => '114',        // Стабилизаторы напряжения
    '7273' => '115',        // Источники безперебойного питания
    '7682' => '117',        // Мониторы
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
    '7509' => '95',        // Вентиляторы для корпусов
        
    '8172' => '274', //+  https://test.prote.ua/office-supplies/plotter/ https://brain.com.ua/category/Plotter-c8172-461/
    '8220' => '275', //+  https://test.prote.ua/office-supplies/3d-print/ https://brain.com.ua/category/3D-printeri-c321/
    '8506' => '276', //+  https://test.prote.ua/office-supplies/nastolnyye-lampy/ https://brain.com.ua/category/Nastolnie_lampi-c683/
    '1264' => '277', //+  https://test.prote.ua/comp-accessories/materinskie-platy/ https://brain.com.ua/category/Systemni_materynski_platy-c1264-226/
    '1403' => '278', //+  https://test.prote.ua/comp-accessories/videokarty/ https://brain.com.ua/category/Videokarty-c1403/
    '1377' => '279', //+  https://test.prote.ua/comp-accessories/opticheskie-privody/ https://brain.com.ua/category/Optychni_pryvody_ODD-c1377-63/
    '1484' => '280', //+  https://test.prote.ua/comp-accessories/ssd-nakopiteli/ https://brain.com.ua/category/SSD_dysky-c1484/
    '1381' => '281', //+  https://test.prote.ua/office-supplies/ip-telefony/ https://brain.com.ua/category/IP_telefoni-c343/
    '7832' => '282', //+  https://test.prote.ua/office-supplies/stacionarnye-telefony/ https://brain.com.ua/category/Telefony_provodnye-c7832-404/
    '7831' => '283', //+  https://test.prote.ua/office-supplies/radio-telefony/ https://brain.com.ua/category/Telefony_bezdrotovi-c7831-189/
    '1258' => '284', //+  https://test.prote.ua/office-supplies/ip-atc/ https://brain.com.ua/category/IP_ATS-c339/
    '7267' => '285', //-  https://test.prote.ua/office-supplies/gsm-shlyuzy/ https://brain.com.ua/category/Mizhmerezhevi_GSM-shlyuzi-c325/
    '1562' => '286', //+  https://test.prote.ua/office-supplies/voip-shlyuzy/ https://brain.com.ua/category/VOIP-c1562-636/
    '7834' => '287', //+  https://test.prote.ua/office-supplies/mini-atc/ https://brain.com.ua/category/Mini-ATS-c340/
    '1189' => '288', //-  https://test.prote.ua/office-supplies/sistemnye-konsoli/ https://brain.com.ua/category/Sistemni_konsoli-c342/
    '7833' => '289'  //+  https://test.prote.ua/office-supplies/fax-apparaty/ https://brain.com.ua/category/Faksy-c7833-191/
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
if ($a=strpos($argv[1], 'full')!==FALSE) {
    // full synchro
    $typesyn='full';
} elseif ($a=strpos($argv[1], 'increment')!==FALSE) {
    // only changed!
    $typesyn='inc';
}

// Соединение с БД
$dblocation = "127.0.0.1"; // Имя сервера
$dbuser = "root";          // Имя пользователя
$dbpasswd = "RooT";            // Пароль
$dbname = "prote";         // Имя базы данных для Prote


$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
// $dbvmx = @mysql_connect($dblocation,$dbuser,$dbpasswd, 1);

if (!$dbcnx) // Если дескриптор равен 0 соединение не установлено
{
  echo("<P>В настоящий момент сервер базы данных не доступен, поэтому
           корректное отображение страницы невозможно.</P>");
  exit();
}

 if (!@mysql_select_db($dbname, $dbcnx))
{
  echo( "<P>В настоящий момент база данных не доступна, поэтому
            корректное отображение страницы невозможно.</P>" );
  exit();
}

$a=mysql_set_charset ('utf8', $dbcnx);

$imgpath='/var/www/prote.com.ua/image/brain';

require_once('/var/www/prote.com.ua/system/connectors/apibrain.php');


// Авторизация
$api=new Apibrain();
//
ini_set("memory_limit","256M");
//echo "memory_limit - 256M";
if (strpos($argv[1], 'cat')!==FALSE) {
    // Список категорий
    $result=$api->call('categories');
    $catlist=json_decode($result, true);
    echo count($catlist);
    echo '  /var/www/prote.com.ua/exec/catlist.txt';
    file_put_contents('/var/www/prote.com.ua/exec/catlist.txt', print_r($catlist,1) . PHP_EOL, FILE_APPEND);
    //echo '<pre>'.print_r($catlist,1).'</pre>';
    die();
}

if (strpos($argv[1], 'prod=')!==FALSE) {
    // Информация по продукту
    $prod=substr($argv[1], 5, 20);
    $result=$api->call('product/product_code/'.$prod);
    
    $prodinfo=json_decode($result, true);
    $result=$api->call('product_options/'.$prodinfo['result']['productID'], array('lang'=>'ru') );
    $prodinfo['result']['options'] =json_decode($result,true)['result'] ;

    echo '<pre>'.print_r($prodinfo,1).'</pre>';
    die();
}

if (strpos($argv[1], 'orders')!==FALSE) {
    // Список заказов
    $result=$api->call('orders');
    $catlist=json_decode($result, true);
    echo count($catlist);
    echo '<pre>'.print_r($catlist,1).'</pre>';
    die();
}

if (strpos($argv[1], 'filtr=')!==FALSE) {
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
            $f2=mysql_query($sSQL, $dbcnx);
            if (!($row = mysql_fetch_array($f2))) {
                $sSQL="select * from oc_filter_description where name like '".$f['name']."' and filter_group_id=1 and language_id=1";
                echo"\n---- sSQL 2";
                echo $sSQL."\n";
                $f1=mysql_query($sSQL, $dbcnx);
                if ($row1 = mysql_fetch_assoc($f1)) {
                    print_r($row1);
                    $sSQL="INSERT INTO prote.oc_filter_xtab(x_id,contragent_id,origin_fid,cont_fid) VALUES (0,1,'".$row1['filter_id']."','".$f['filterID']."')";
                    echo"\n---- sSQL 3";
                    echo $sSQL."\n";
                    mysql_query($sSQL, $dbcnx);
                }
            }

        }
    }
    }
    // echo count($catlist);
    // echo '<pre>'.print_r($catlist['result'][3],1).'</pre>';
    die();
}

if (strpos($argv[1], 'price')!==FALSE) {
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
    if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
    $i=0;
    while ($row = mysql_fetch_array($f)) {
        $row['upc']=substr($row['upc'], 1);
        if (isset($tmp_price[$row['upc']]) && $tmp_price[$row['upc']]['RetailPrice'] && $tmp_price[$row['upc']]['RetailPrice']<>$row['price']) {
            // Для логфайла
            echo date('Y-m-d H:i'),"\t".'['.$row['upc'].']'."\t".sprintf('%d',$row['price']).'->'.$tmp_price[$row['upc']]['RetailPrice']."\n";
            $sSQL="
                UPDATE `oc_product` SET price=".$tmp_price[$row['upc']]['RetailPrice']." WHERE `product_id`=".$row['product_id'];
                if (!(mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
        }
    }

    // echo '<pre>'.print_r($catlist,1).'</pre>';
    die();
}

if (strpos($argv[1], 'c=')!==FALSE) {
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
   
    // Список производителей товаров для категории
    $result=$api->call('vendors/'.$categoryId);

    $vendors_tmp=json_decode($result, true);

    $vendors=array();
    foreach ($vendors_tmp['result'] as $v) {
        $vendors[$v['vendorID']]=$v['name'];
    }
    // array_map('strtoupper', $vendors);
    //print_r($categoryId,1);
    //print_r($vendors);
    //die();
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
        
        /*echo "<pre>";
        print_r($result);
        echo "</pre>";*/
        
        $prodl=json_decode($result, true);

        // print_r($prodl); die();
        // Список номеров товара категории
        $numlist=array();



        foreach ($prodl['result']['list'] as $prodlitem) {
            //print_r($prodlitem['product_code']);
            /*if($prodlitem['product_code'] == 'U0219692'){
                print_r("\n***************************************\n");
                //print_r($prodlitem);
                print_r($prodlitem['product_code']);
                print_r("\n***************************************\n");
                exit;
            }*/

            // Проверка - есть ли этот продукт в списке измененных
            // gdemon - нужно отключать при добавлении новы групп
            if (!$prodIDs || in_array($prodlitem['productID'], $prodIDs, true)) {

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
        /*if($d['product_code']=='U0202743'){
            print_r("\n=========================\n");
            print_r("\n=========================\n");
            $result=$api->call('product/product_code/U0202743');

            $prodinfo=json_decode($result, true);
            $result=$api->call('product_options/'.$prodinfo['result']['productID'], array('lang'=>'ru') );
            $prodinfo['result']['options'] =json_decode($result,true)['result'] ;

            echo '<pre>'.print_r($prodinfo,1).'</pre>';

            print_r("\n=========================\n");
            print_r($d);
            print_r("\n");

        }*/

        // Отладка - выполняем только для одной карточки
        // if ($d['product_code']!=='U0000363') continue;

        // Если входная категория МФУ - распределяем их на лазерные и стуйные
        /*if ($categoryId==1190) {
            if (productCat($d)=='86018846700') $occats[$categoryId]='88';
            if (productCat($d)=='86018846800') $occats[$categoryId]='89';
        }*/

        // Отдельная ветка для БИНДЕРОВ
        if ($categoryId==7506 && $tmp_price[$d['productID']]['ClassID']!=1113) continue;

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
            if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);

            if ($row = mysql_fetch_array($f)) {
                
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
                  `quantity`=".($avail ? $avail : '0').",
                  `price`='".$addparams[$d['productID']]['retail_price_uah']."',                  
                  `mpn`='".$d['product_code']."',
                  `date_modified`=now()
                WHERE `product_id`= '" . $lastid . "'";
                // echo $sSQL;

                // if ($date_available) { echo $sSQL; die(); }
                if(!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);

                $numUpd++;
                echo "\n" . 'Обновление oc_product: ' . $d['product_code'], '#', $lastid, "\n" ;

            } elseif ($avail) {
                // Создание записи в основной таблице
                $sSQL="
                INSERT `oc_product`
                  (`sku`,`upc`, `model`, `mpn`, `status`, `quantity`, `price`,`image`,`shipping`, `date_available`, `date_added`, `src`)
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
                  'B')";

                // echo "\n" . $sSQL;
                echo "\n" . 'Вставлено oc_product' . $d['product_code'], "\n";
                if(!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);
                $lastid=mysql_insert_id($dbcnx);
                $numIns++;

                // Привзываем к магазину
                $sSQL="INSERT IGNORE INTO `oc_product_to_store` (`product_id`, `store_id`)
                VALUES ('$lastid', '0')";
                if(!(mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error'  . $sSQL);
                //

            } else {
                continue;
            }

            // Не обновляем данные для недоступных наименований
            // if ($avail==FALSE) continue;
            //


            // Привязываем к категории
            $sSQL="INSERT IGNORE INTO `oc_product_to_category` (`product_id`, `category_id`, `main_category`)
            VALUES ('$lastid', '".$occats[$categoryId]."', '0')";
            if(!(mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error'  . $sSQL);
            //



            // Обновление или создание description
            $sSQL="
            SELECT `product_id`, `language_id`, `description`
            FROM `oc_product_description`
            WHERE `product_id`='". $lastid ."' AND `language_id`='". $kode ."'";
            if(!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error'  . $sSQL);
            if ($row = mysql_fetch_array($f)) {
                // if ($row['description']=='') {
                // Обновление записи
                // ...
                //                     `description`='".mysql_real_escape_string($d['description_'.$lcode])."',
                //                     `meta_title`='".mysql_real_escape_string(substr($d['meta_title_'.$lcode],0,254))."',
                //                     `meta_h1`='".mysql_real_escape_string(substr($d['meta_h1_'.$lcode],0,254))."',
                //                     `meta_description`='".mysql_real_escape_string(substr($d['meta_description_'.$lcode],0,254))."',
                //                     `meta_keyword`='".mysql_real_escape_string(substr($d['meta_keyword_'.$lcode],0,254))."'
                //

                $sSQL="
                UPDATE `oc_product_description`
                SET
                `name`='".mysql_real_escape_string(substr($d['name'], 0, 254))."',
                `tag`='".mysql_real_escape_string($d['brief_description'])."',
                `description`='".mysql_real_escape_string($d['description'])."'
                WHERE `product_id`=".$lastid." AND `language_id`=".$kode;
                if(!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);
                // if ($lastid=='3886') {
                //    echo $sSQL;
                //    print_r($d);
                // }
                echo 'U(', $kode, ') '  ;
                // }

            } else {


            // Создание языкозависимых записей
            //                   `description`='".mysql_real_escape_string($d['description_'.$lcode])."',
            //                     `meta_title`='".mysql_real_escape_string(substr($d['meta_title_'.$lcode],0,254))."',
            //                     `meta_h1`='".mysql_real_escape_string(substr($d['meta_h1_'.$lcode],0,254))."',
            //                     `meta_description`='".mysql_real_escape_string(substr($d['meta_description_'.$lcode],0,254))."',
            //                     `meta_keyword`='".mysql_real_escape_string(substr($d['meta_keyword_'.$lcode],0,254))."'";


                $sSQL="
                INSERT `oc_product_description`
                SET
                  `product_id`=".$lastid.",
                  `language_id`=".$kode.",
                  `name`='".mysql_real_escape_string(substr($d['name'], 0, 254))."',
                  `tag`='".mysql_real_escape_string($d['brief_description'])."',
                  `description`='".mysql_real_escape_string($d['description'])."'";

                 echo 'I(', $kode, ') ';

                if(!mysql_query($sSQL, $dbcnx)) throw new Exception('MySQL error: ' . $sSQL);
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
            if(!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
            // ПОКА НЕ ВКЛЮЧАТЬ!!!
            //

            //if($lastid==18803){
                /*print_r("\n==========options===============\n");
                print_r($d['options']);
                print_r("\n");*/
            //}

            foreach ($d['options'] as $v) {
                // Чтобы отличать наши атрибуты от сторонних - добавляем "соль" - 100000
                $attribid=100000+$v['OptionID'];
                // Проверяем наличие в кросс-таблице
                $sSQL="SELECT * FROM `oc_attribute_xtab` WHERE contragent_id=1 AND cont_fid='".$attribid."' LIMIT 1";
                if(!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
                if ($row = mysql_fetch_array($f)) {
                    // echo $row['origin_fid'].'>'.$attribid;
                    $attribid = $row['origin_fid'];
                } else {
                    // Проверяем создаем запись в таблице описаний аттрибутов
                    $sSQL="SELECT * FROM `oc_attribute_description` WHERE attribute_id='".$attribid."' AND language_id='".$kode."' LIMIT 1";
                    if(!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
                    if (!($row = mysql_fetch_array($f))) {
                       $sSQL="INSERT IGNORE INTO `oc_attribute` "
                               . "(`attribute_id`, `attribute_group_id`)"
                               . "values ('".$attribid."', '1')";;
                       // echo $sSQL;
                       if(!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);

                       $sSQL="INSERT INTO `oc_attribute_description` "
                               . "(`attribute_id`, `language_id`, `name`)"
                               . "values ('".$attribid."', '". $kode."', '" . mysql_real_escape_string( $v['OptionName']) . "')"
                               . "ON DUPLICATE KEY UPDATE `name` = '" . mysql_real_escape_string( $v['OptionName']) . "'";;
                       // echo $sSQL;
                       if(!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
                    }

                }
                // echo '************'.$attribid.'**************';
                // print_r($v);
                // Создание записи в таблице аттрибутов
                $attriblist[$attribid]['ValueName'][]=$v['ValueName']; 
                $attriblist[$attribid]['ValueID']=$v['ValueID']; 
                // if ($attribid==3) print_r($v);
                // Обработка фильтров
                /*if($lastid==55418 && $v['OptionID']==3){
                    print_r("\n=========================\n");
                    print_r($v['FilterID']."\n");
                    print_r($attribid."\n");
                }*/
                if (isset($v['FilterID'])) {
                    //if($lastid==18803){
                    /*    print_r("\n========FilterID================\n");
                        print_r($v['FilterID']);
                        print_r("\n========attribid================\n");
                        print_r($attribid);
                        print_r("\n");*/
                    //}
                    if($v['OptionID']==3){
                        continue;
                    }
                    if ($attribid>100000) {

                        // Для внешних фильтров могут понадобиться свои фильтры
                        //
                        // Группы фильтров
                        $sSQL="INSERT IGNORE INTO prote.`oc_filter_group` (filter_group_id, sort_order) values ('$attribid', 0)";
                        if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
                    
                        // Описание групп фильтров
                        $sSQL="INSERT IGNORE
                            INTO prote.`oc_filter_group_description`(filter_group_id, language_id, name)
                            VALUES ('$attribid', '$kode', '" . mysql_real_escape_string( $v['OptionName']) . "')";

                        if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
                        
                        //
                    }

                    // Проверяем наличие созданных ранее фильтров
                    $sSQL="SELECT * FROM `oc_filter_xtab` WHERE `contragent_id`=1 AND `cont_fid`='".$v['FilterID']."'";

                    //if($lastid==18141 && $v['OptionID']==3){
                      //  print_r("--- sSQL 1\n".$sSQL);
                    //}

                    if (!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error' . $sSQL);
                    if (!$row = mysql_fetch_array($f)) {

                        // Такого фильтра не существует - создаем его
                        $sSQL="INSERT
                            INTO prote.`oc_filter`(filter_group_id, sort_order)
                            VALUES ('$attribid', 0)";
                        // echo $sSQL;
                        if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
                        $filter_last_id = mysql_insert_id($dbcnx);

                        // Заполняем ХТАБ
                        $sSQL="INSERT
                            INTO prote.`oc_filter_xtab`(contragent_id, origin_fid, cont_fid)
                            VALUES (1, '$filter_last_id', '" . mysql_real_escape_string( $v['FilterID']) . "')";
                        if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);

                    } else {
                        // echo '****фильтр уже есть:'.$row['origin_fid'];
                        $filter_last_id=$row['origin_fid'];
                    }
                    /*if($lastid==55418 && $v['OptionID']==3){
                        print_r( 'filter_last_id = ');
                        print_r( $filter_last_id."\n");

                    }*/
                    // Добавляем описание
                    $sSQL="INSERT
                        INTO prote.`oc_filter_description`(filter_id, filter_group_id, language_id, name)
                        VALUES ($filter_last_id, '$attribid', '$kode', '" . mysql_real_escape_string( $v['FilterName']) . "')
                        ON DUPLICATE KEY UPDATE `name` = '" . mysql_real_escape_string( $v['FilterName']) . "'";
                    

                    /*if($lastid==55418 && $v['OptionID']==3){
                        print_r( $sSQL."\n");
                    }*/

                    if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);

                    // Добавляем фильтр к продукту
                    $sSQL="INSERT IGNORE
                            INTO prote.`oc_product_filter`(`product_id`, `filter_id`)
                            VALUES ('$lastid', '$filter_last_id')"; // echo $sSQL;
                    /*echo "\n == Добавляем фильтр к продукту";
                    echo "\n sSQL1 == ".$sSQL;
                    echo "\n ";*/
                    if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
                    // echo $sSQL;
                } else {
                    
                }

            }
            /*if($lastid==55418 ){
                exit;
            }*/


            // Создаем записи в таблице из подготовленной таблицы аттрибутов.
            foreach ($attriblist as $k=>$v) {
                $attribtext=implode(',',$v['ValueName']);
                $sSQL="INSERT INTO `oc_product_attribute` "
                    . "(`product_id`, `language_id`, `attribute_id`, `text`, `ext_value_id`) "
                    . "values ('" .$lastid. "','". $kode . "','" . $k . "','" .  mysql_real_escape_string( $attribtext )."','" .  mysql_real_escape_string( $v['ValueID'] )."')"
                    . "ON DUPLICATE KEY UPDATE `text` = '" . mysql_real_escape_string( $attribtext ) . "', `ext_value_id` = '" .  mysql_real_escape_string( $v['ValueID'] )."'";

                if(!mysql_query($sSQL, $dbcnx)) throw new Exception('MySQL error: ' . $sSQL);
            }

            // Отдельно обрабатываем ситуацию с брендом
            $sSQL="SELECT * FROM `oc_filter_description` WHERE `filter_group_id`=1 AND UPPER(`name`)='".mysql_real_escape_string(strtoupper($vendors[$d['vendorID']]))."' AND `language_id`='".$kode."' ORDER BY filter_id ASC LIMIT 1";

            /*echo "\n Отдельно обрабатываем ситуацию с брендом";
            echo "\n sSQL2 == ".$sSQL;
            echo "\n ";*/

            /*if($lastid==18803){
                echo $sSQL."\n";
                //exit;
            }*/
            

            if (!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error' . $sSQL);
            if (!$row = mysql_fetch_array($f)) {
                /*if($lastid==18803){
                    print_r($row);
                }*/

                // Такого фильтра не существует - создаем его
                $sSQL="INSERT
                    INTO prote.`oc_filter`(filter_group_id, sort_order)
                    VALUES (1, 0)";
                // echo $sSQL;
                if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
                $filter_last_id = mysql_insert_id($dbcnx);

                // Добавляем описание
                $sSQL="INSERT
                    INTO prote.`oc_filter_description`(filter_id, filter_group_id, language_id, name)
                    VALUES ($filter_last_id, '1', '$kode', '" . mysql_real_escape_string( $vendors[$d['vendorID']]) . "')
                    ON DUPLICATE KEY UPDATE `name` = '" . mysql_real_escape_string( $vendors[$d['vendorID']] ) . "'";
                if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);

            } else {
                $filter_last_id=$row['filter_id'];
            }

            // Добавляем фильтр к продукту
            $sSQL="INSERT IGNORE
                    INTO prote.`oc_product_filter`(`product_id`, `filter_id`)
                    VALUES ('$lastid', '$filter_last_id')";

                    /*if($lastid==18803){
                    print_r($sSQL);
                }*/
            if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
            // echo $sSQL;

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
                        if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
                        $row = mysql_fetch_array($f);

                        $product_id=$row['product_id'];
                        echo 'Compare:',($product_id==$lastid ? 'OK': 'NO');
                        *******************/
                        
                        // Внутренний номер продукта
                        $product_id=$lastid;
                                
                        $sSQL="SELECT * from `oc_product_image`
                        WHERE `product_id` ='$product_id' AND `image`='".'brain/' . $categoryId .'/' .end($imgparts)."'";

                        if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);

                        if (!($row = mysql_fetch_array($f))) {
                            echo 'insert!';

                            $sSQL="
                                INSERT `oc_product_image`
                                    (`product_id`, `image`, `sort_order`)
                                VALUES
                                  ($product_id,
                                  '". 'brain/' . $categoryId .'/' .end($imgparts) ."',
                                  '".$imgfilerec['priority']."')";

                            if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
                        }

                        if ($mainimgupd) {
                            // Обновление "главного" изображения
                            // в качестве главного - используем первое изображение из галереи.

                            $sSQL="
                            UPDATE `oc_product`
                            SET
                              `image`='".'brain/' . $categoryId .'/' .end($imgparts) ."'
                            WHERE `product_id` = '$product_id'";
                            if(!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);

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
            $sSQL="
               SELECT *
               FROM `oc_url_alias`
               WHERE `query`='product_id=".$lastid ."'
            ";

            if (!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error' . $sSQL);

            // Запись seo_alias создается только в том случае, если ее нет
            if (mysql_num_rows($f)==0) {

                $seftext=trim(ru2Lat(trim(mb_substr($d['name'],0,50,'UTF-8'))),'-').'-'.$d['product_code'];
                $seftext=str_replace(',', '', strtolower($seftext));

                $sSQL="
                  INSERT INTO `oc_url_alias`
                  VALUES
                  (0, 'product_id=" . $lastid . "','".$seftext."')
                ";

                if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
                echo "\n SEF создан" . $seftext;
                // echo $sSQL;
            }
            // SEO

            // Отключение несинхронизировнных записей (через неделю)
            $sSQL="UPDATE `oc_product`
                SET `status`=0
                WHERE src='B' AND date_modified  <= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY) AND status=1";

            if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
            //

        // Перехват ошибки базы данных
        } catch (Exception $e) {
                echo "Исключение:", $e->getMessage(), ' в строке:', $e->getLine(), "\n";
                print_r($d);
                $errcount++;
                die();

        }
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
    mysql_query($sSQL,$dbcnx);
    $numDel=mysql_affected_rows($dbcnx);
    echo "\n" . 'Всего скрыто: '.$numDel.' записей' . "\n" ;
}

echo "\n" . 'Всего добавлено: '.$numInsTotal.' записей';
echo "\n" . 'Всего обновлено: '.$numUpdTotal.' записей' . "\n" ;


//$result=$api->call('filters_all/8170');
//print_r($result);
//// print_r($prodlist);
//
//$curl = curl_init();
//
//curl_setopt_array($curl, array(
//  CURLOPT_URL => "http://api.brain.com.ua/filters_all/8170/8d3c2pma362dmhk9ug43ik81h4",
//  CURLOPT_RETURNTRANSFER => true,
//  CURLOPT_ENCODING => "",
//  CURLOPT_MAXREDIRS => 10,
//  CURLOPT_TIMEOUT => 30,
//  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//  CURLOPT_CUSTOMREQUEST => "GET",
//  CURLOPT_HTTPHEADER => array(
//    "cache-control: no-cache",
//    "postman-token: 3ec5d7bf-7b3a-2551-d239-0cd5a1694f32"
//  ),
//));
//
//$response = curl_exec($curl);
//$err = curl_error($curl);
//
//curl_close($curl);

//if ($err) {
//  echo "cURL Error #:" . $err;
//} else {
//  echo $response;
//}









//<?php
//
///*
// * To change this license header, choose License Headers in Project Properties.
// * To change this template file, choose Tools | Templates
// * and open the template in the editor.
// */
//
//// Кросс-таблица категорий prote-brain
//$occats = array (
//   '82' =>  '8170'       // Лазерные принтеры
//);
//
//
//
//// Соединение с БД
//$dblocation = "127.0.0.1"; // Имя сервера
//$dbuser = "root";          // Имя пользователя
//$dbpasswd = "RooT";            // Пароль
//$dbname = "prote";         // Имя базы данных для Prote
//$dbnamevm = "vm";          // Имя базы данных для vm
//
//$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
//$dbvmx = @mysql_connect($dblocation,$dbuser,$dbpasswd, 1);
//
//if (!$dbcnx || !$dbcnx) // Если дескриптор равен 0 соединение не установлено
//{
//  echo("<P>В настоящий момент сервер базы данных не доступен, поэтому
//           корректное отображение страницы невозможно.</P>");
//  exit();
//}
//
// if (!@mysql_select_db($dbname, $dbcnx) || !@mysql_select_db($dbnamevm, $dbvmx))
//{
//  echo( "<P>В настоящий момент база данных не доступна, поэтому
//            корректное отображение страницы невозможно.</P>" );
//  exit();
//}
//
//$a=mysql_set_charset ('utf8', $dbcnx);
//$a=mysql_set_charset ('utf8', $dbvmx);
//
//
//$imgpath='/var/www/prote.com.ua/image/catalog/brain';
//
//require_once('/var/www/prote.com.ua/system/connectors/apibrain.php');
//echo '<pre>';
//
//// Авторизация
//$api=new Apibrain();
//
//// Список категорий
////$result=$api->call('categories');
////$catlist=json_decode($result, true);
////print_r($catlist);
//
//// Список товаров (пока для одной категории)
//$categoryId='8170';
//
//// Определение языка
//$langid='ru';
//$kode=1;
//if (0) {
//    $langid='ua';
//    $kode=2;
//}
/////////////
//
////$r=$api->call('modified_products', array('modified_time'=>'2000-01-01', 'limit'=>'10000'));
////
////print_r(json_decode($r,true));
////die();
////
////$r=$api->callpost('products/content', array('productIDs'=>'963,967'));
////
////print_r(json_decode($r,true));
////die();
//
//
//if (1) {
////
//$prodlist=array();
//$offset=0;
//$loop=1;
//
//// Разбиение идет по 100 позиций, потому читаем в цикле.
//while ($loop) {
//    $loop=0;
//    $result=$api->call('products/'.$categoryId, array('offset'=>$offset, 'lang'=>$langid));
//    $prodl=json_decode($result, true);
//
//    echo '*';
//    // Получаем дполнительную инфу
//    foreach ($prodl['result']['list'] as &$prodlitem) {
//        echo '.';
//        //$result=$api->callpost('products/content', array('productIDs'=>$prodlitem['productID'], 'lang'=>$langid));
//        //$prodlitem['details']=json_decode($result, true);
//    }
//
//
//    $prodlist=array_merge($prodlist, $prodl['result']['list']);
//    if ($prodl['result']['count']>$offset+100) {
//        $offset += 100;
//        $loop = 1;
//    }
//}
//
//// print_r($prodlist);
//// Получение всех изображений для товаров категории
//$imglist=array();
//$offset=0;
//$loop=1;
//while ($loop) {
//    $loop=0;
//    $result=$api->call('products_pictures/'.$categoryId);
//    $imgl=json_decode($result, true);
//    $imglist=array_merge($imglist,$imgl);
//    if ($imgl['result']['count']>$offset+100) {
//        $offset += 100;
//        $loop = 1;
//    }
//}
////
// // print_r($imglist); die();
//}
//
//// Проверка наличия папки для фото категори
//if (!file_exists($imgpath.'/'.$categoryId)) {
//    mkdir($imgpath.'/'.$categoryId);
//}
//if (0) {
//// Идем по списку
//foreach ($imglist['result']['list'] as $val) {
//
//    // Имя файла для копирования
//    foreach ($val['pictures'] as $imgfilerec) {
//        // $imgfile='http://opt.brain.com.ua/static/images/prod_img/4/0/U0000640_small.jpg';
//        $imgfile = $imgfilerec['large_image'];
//        $imgparts=explode('/', $imgfile);
//        $imgname=$imgpath .'/' . $categoryId .'/' .end($imgparts);
//        // print_r($val); die();
//        // Если файла нет - загружаем и создаем его.
//        if (!file_exists($imgname)) {
//            $ch = curl_init($imgfile);
//            $fp = fopen($imgname, 'wb');
//            curl_setopt($ch, CURLOPT_FILE, $fp);
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//            curl_exec($ch);
//            curl_close($ch);
//            fclose($fp);
//            echo $imgfile . ' > ' . $imgname . "\n";
//        } else {
//            echo $imgfile . ' exist: ' . $imgname . "\n";
//        }
//
//         // При необходимости добавяем запись
//
//        // Внутренний номер продукта
//        $sSQL="SELECT product_id from oc_product where `upc`='".$val['productID']."'";
//        if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
//        $row = mysql_fetch_array($f);
//
//        $product_id=$row['product_id'];
//
//        //
//        $sSQL="SELECT * from `oc_product_image`
//        WHERE `product_id` ='$product_id' AND `image`='".'image/catalog/brain/' . $categoryId .'/' .end($imgparts)."'";
//
//        if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
//
//        if (!($row = mysql_fetch_array($f))) {
//            echo 'insert!';
//
//            $sSQL="
//                INSERT `oc_product_image_brain`
//                    (`product_id`, `image`, `sort_order`)
//                VALUES
//                  ($product_id,
//                  '". 'image/catalog/brain/' . $categoryId .'/' .end($imgparts) ."',
//                  '".$imgfilerec['priority']."')";
//
//            if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
//            // die();
//        }
//
//        if ($imgfilerec['priority']==0) {
//            // Обновление "главного" изображения
//            // в качестве главного - используем первое изображение из галереи.
//
//            $sSQL="
//            UPDATE `oc_product`
//            SET
//              `image`='".'image/catalog/brain/' . $categoryId .'/' .end($imgparts) ."'
//            WHERE `product_id` = '$product_id'";
//
//            if(!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);
//        }
//
//    }
//}
//
//}
//
//
//// $result=$api->call('filters_all/'.$categoryId);
//// $tmpa=json_decode($result, true)['result'];
//// print_r($tmpa);
//
//// Детальное описание товара
//
//$attr=array();
//$options=array();
//$values=array();
//
//foreach ($prodlist as $val) {
//   // print_r($val) ;
//   // $val['options']=$api->call('product_options/'.$val['productID']);
//
//   echo '.';
//   // $attr =  array_merge($attr,json_decode($result, true)['result']);
//   // print_r(json_decode($result, true)['result']);
//   // echo 'product_options/'.$val['productID'];
//}
//
////print_r($options);
////print_r($values);
//
//
//
////
//if (1) {
//foreach ($prodlist as $k => $d)
//      {
//      try {
//          echo "Параметры записи:", $d['productID'],'/',$d['product_code'];
//
//          $sSQL="
//          SELECT `product_id` FROM `oc_product_brain`
//          WHERE `sku`= '" . $d['product_code'] . "' AND `upc`='" . $d['productID'] . "'";
//          // echo $sSQL;
//          if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
//
//          if ($row = mysql_fetch_array($f)) {
//              $lastid=$row['product_id'];
//              // Обновление записи
//              // ...
//              $sSQL="
//              UPDATE `oc_product`
//              SET
//                `model`='".$d['product_code']."',
//                `status`='1',
//                `shipping`='1',
//                `quantity`='100',
//                `price`='".$d['retail_price_uah']."',
//                `image`='".$d['large_image']."',
//                `mpn`='".$d['product_code']."',
//                `delivery_days`='".'0'."',
//                `date_modified`=now()
//              WHERE `product_id`= '" . $lastid . "'";
//              // echo $sSQL;
//              // if ($d['absnum']==63107) echo $sSQL;
//              if(!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);
//
//              $numUpd++;
//              echo "\n" . 'Обновление oc_product' . $d['product_code'], '#', $lastid, "\n" ;
//
//          } else {
//              // Создание записи в основной таблице
//              $sSQL="
//              INSERT `oc_product`
//                (`sku`,`upc`, `model`, `mpn`, `status`, `quantity`, `price`,`image`,`shipping`, `delivery_days`, `date_added`)
//              VALUES
//                ('".$d['product_code']."',
//                '".$d['productID']."',
//                '".$d['product_code']."',
//                '".$d['product_code']."',
//                '1',
//                '100',
//                ".$d['retail_price_uah'].",
//                '".$d['large_image']."',
//                '1',
//                '0',
//                now())";
//
//              // echo "\n" . $sSQL;
//              echo "\n" . 'Вставлено oc_product' . $d['product_code'], "\n";
//              if(!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);
//              $lastid=mysql_insert_id($dbcnx);
//              $numIns++;
//          }
//
//          //
//          {
//
//                $sSQL="
//                SELECT `product_id`, `language_id`, `description`
//                FROM `oc_product_description_brain`
//                WHERE `product_id`='". $lastid ."' AND `language_id`='". $kode ."'";
//                if(!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error'  . $sSQL);
//                if ($row = mysql_fetch_array($f)) {
//                    // if ($row['description']=='') {
//                    // Обновление записи
//                    // ...
////                     `description`='".mysql_real_escape_string($d['description_'.$lcode])."',
////                     `meta_title`='".mysql_real_escape_string(substr($d['meta_title_'.$lcode],0,254))."',
////                     `meta_h1`='".mysql_real_escape_string(substr($d['meta_h1_'.$lcode],0,254))."',
////                     `meta_description`='".mysql_real_escape_string(substr($d['meta_description_'.$lcode],0,254))."',
////                     `meta_keyword`='".mysql_real_escape_string(substr($d['meta_keyword_'.$lcode],0,254))."'
////
//
//                    $sSQL="
//                    UPDATE `oc_product_description_brain`
//                    SET
//                    `name`='".mysql_real_escape_string(substr($d['name'], 0, 254))."'
//                    WHERE `product_id`=".$lastid." AND `language_id`=".$kode;
//                    if(!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error: ' .  $sSQL);
//                    // if ($lastid=='3886') {
//                    //    echo $sSQL;
//                    //    print_r($d);
//                    // }
//                    echo 'U(', $kode, ') '  ;
//                    // }
//
//                } else {
//
//
//                // Создание языкозависимых записей
////                   `description`='".mysql_real_escape_string($d['description_'.$lcode])."',
////                     `meta_title`='".mysql_real_escape_string(substr($d['meta_title_'.$lcode],0,254))."',
////                     `meta_h1`='".mysql_real_escape_string(substr($d['meta_h1_'.$lcode],0,254))."',
////                     `meta_description`='".mysql_real_escape_string(substr($d['meta_description_'.$lcode],0,254))."',
////                     `meta_keyword`='".mysql_real_escape_string(substr($d['meta_keyword_'.$lcode],0,254))."'";
//
//
//                $sSQL="
//                INSERT `oc_product_description_brain`
//                SET
//                  `product_id`=".$lastid.",
//                  `language_id`=".$kode.",
//                  `name`='".mysql_real_escape_string(substr($d['name'], 0, 254))."'";
//
//                 echo 'I(', $kode, ') ';
//
//                if(!mysql_query($sSQL, $dbcnx)) throw new Exception('MySQL error: ' . $sSQL);
//                }
//              }
//
//
//            // Аттрибуты записей
//            $result=$api->call('product_options/' . $d['productID'],array('lang'=>$langid));
//            $tmpa= json_decode($result, true)['result'];
//
//            foreach ($tmpa as $v) {
//                $attribid=$v['OptionID'];
//                // Проверяем наличие в кросс-таблице
//                $sSQL="SELECT * FROM `oc_attribute_xtab` WHERE contragent_id=1 AND cont_fid='".$attribid."' LIMIT 1";
//                if(!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
//                if ($row = mysql_fetch_array($f)) {
//                    // echo $row['origin_fid'].'>'.$attribid;
//                    $attribid = $row['origin_fid'];
//                } else {
//                    // Проверяем создаем запись в таблице описаний аттрибутов
//                    $sSQL="SELECT * FROM `oc_attribute_description` WHERE attribute_id='".$attribid."' AND language_id='".$kode."' LIMIT 1";
//                    if(!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
//                    if (!($row = mysql_fetch_array($f))) {
//                       $sSQL="INSERT IGNORE INTO `oc_attribute_brain` "
//                               . "(`attribute_id`, `attribute_group_id`)"
//                               . "values ('".$attribid."', '1')";;
//                       // echo $sSQL;
//                       if(!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
//
//                       $sSQL="INSERT INTO `oc_attribute_description_brain` "
//                               . "(`attribute_id`, `language_id`, `name`)"
//                               . "values ('".$attribid."', '". $kode."', '" . mysql_real_escape_string( $v['OptionName']) . "')"
//                               . "ON DUPLICATE KEY UPDATE `name` = '" . mysql_real_escape_string( $v['OptionName']) . "'";;
//                       // echo $sSQL;
//                       if(!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
//                    }
//
//                }
//                // Создание записи в таблице аттрибутов
//                $sSQL="INSERT INTO `oc_product_attribute_brain` "
//                        . "(`product_id`, `language_id`, `attribute_id`, `text`) "
//                        . "values ('" .$lastid. "','". $kode . "','" . $attribid . "','" .  mysql_real_escape_string($v['ValueName'])."')"
//                        . "ON DUPLICATE KEY UPDATE `text` = '" . mysql_real_escape_string( $v['ValueName']) . "'";
//
//
//                if(!mysql_query($sSQL, $dbcnx)) throw new Exception('MySQL error: ' . $sSQL);
//
//
//                // Обработка фильтров
//                if ($filterid=$v['FilterID']) {
//                    // Получаем ID аттрибута
//
//                    // Группы фильтов
//                    $sSQL="INSERT IGNORE INTO prote.`oc_filter_group` (filter_group_id, sort_order) '$attribid', 0";
//
//                    if (!mysql_query($sSQL,$dbcnx)) throw new Exception('MySQL error' . $sSQL);
//
//
//
//                }
//
//
//               // $options[$v['OptionID']]=$v['OptionName'];
//               // $values[$v['ValueID']]=$v['ValueName'];
//            }
//
//
//
//
//      } catch (Exception $e) {
//              echo "Исключение:", $e->getMessage(), ' в строке:', $e->getLine(), "\n";
//              print_r($d);
//              $errcount++;
//
//            }
//      }
//}
////$result=$api->call('filters_all/8170');
////print_r($result);
////// print_r($prodlist);
////
////$curl = curl_init();
////
////curl_setopt_array($curl, array(
////  CURLOPT_URL => "http://api.brain.com.ua/filters_all/8170/8d3c2pma362dmhk9ug43ik81h4",
////  CURLOPT_RETURNTRANSFER => true,
////  CURLOPT_ENCODING => "",
////  CURLOPT_MAXREDIRS => 10,
////  CURLOPT_TIMEOUT => 30,
////  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
////  CURLOPT_CUSTOMREQUEST => "GET",
////  CURLOPT_HTTPHEADER => array(
////    "cache-control: no-cache",
////    "postman-token: 3ec5d7bf-7b3a-2551-d239-0cd5a1694f32"
////  ),
////));
////
////$response = curl_exec($curl);
////$err = curl_error($curl);
////
////curl_close($curl);
//
////if ($err) {
////  echo "cURL Error #:" . $err;
////} else {
////  echo $response;
////}
//
//
//
//echo '</pre>';
//
//
