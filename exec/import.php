<?php

/*define('DIR_IMAGE', '/var/www/prote/data/www/prote.ua/image/');
define('DIR_CACHE', '/var/www/prote/data/www/prote.ua/system/storage/cache/');
define('DIR_ROOT' , '/var/www/prote/data/www/prote.ua/');*/

$import_prote = true;


require_once('/var/www/prote/data/www/prote.ua/config.php');

// Список категорий
$occats=array(
// '20' =>
'21' => array( '3282', 'Картриджи струйные'),
'22' => array( '3286', 'Чернила'),
'23' => array( '3287', 'СНПЧ'),
'24' => array( '3288', 'ПЗК'),
// '25' => array( '3302', 'Компоненты для СНПЧ'),
// ''30' => array('),
'31' => array( '3280,3281', 'Картриджи и тонер-картриджи'),  // 3281
//'32' => array( '3290,3291', 'Тонер') , // '3291'  3290
//'33' => array( '3292,3293', 'Фотобарабан019985ы'),  // Добавить - 3293!
//'34' => array( '3295', 'Валы и оболочки'),
//'35' => array( '3296', 'Чипы и микросхемы'),
//'36' => array( '3294', 'Лезвия'),
//'37' => array( '3298', 'ЗЧ для лазерных'),
// ''40' => array('),
'41' => array( '3283', 'Картриджи и ленты для матричных принтеров'),
'42' => array( '3284', 'Пленки для факсов'),
// ''50' => array('),
'51' => array( '3275', 'Фотобумага'),
'52' => array( '3276', 'Холсты'),
'53' => array( '3277', 'Офисная бумага'),
'54' => array( '3278', 'Материалы для творчества'),
'55' => array( '6337', 'Самоклеющиеся этикетки'),
'56' => array( '6382', 'Ленты для кассовых'),
'57' => array( '6448', 'Наклейки для авто'),
'128'=> array( '6567', 'Конверты'),
'126'=> array( '6565', 'Блоки бумаги для заметок'),
'127'=> array( '6566', 'Блоки бумаги с клейким слоем, закладки'),
'270'=> array( '6805', 'Ватманы'),
'271'=> array( '6804', 'Цветная бумага'),
'272'=> array( '6803', 'Копировальная бумага'),
'273'=> array( '6808', 'Ценники'),



// 60' => array('),
'61' => array( '6325', 'Аккустические колонки'),
'62' => array( '6323', 'Веб-камеры'),
'63' => array( '6327', 'Наушники'),
'64' => array( '3316', 'Клавиатурі и наборі'),
'65' => array( '6328', 'USB хабы и адаптеры'),
'66' => array( '3312', 'Флеш-память'),
'67' => array( '3310', 'CD'),
'68' => array( '3319', 'Батарейки'),
'69' => array( '6434', 'Фильтры и удлинители'),
'70' => array( '6352', 'Батареи для ИБП'),
'71' => array( '3315', 'USB кабели и переходники'),
'72' => array( '6362', 'Мыши'),
'73' => array( '3318', 'Чистящие средства'),
'74' => array( '6341', 'Разное'),
'75' => array('6326', 'Карты памяти'),
'76' => array('6486', 'Персональные компьютеры'),
'77' => array('6519', 'Внешние аккумуляторы'),
'78' => array('6535', 'Компьютерные корпуса'),
'315' => array('6818', 'Програмное обеспечение'),


//''80' => array('),
'81' => array( '3304', 'Струйные принтеры'),
'82' => array( '3305', 'Лазерные принтеры'),
'83' => array( '6412', 'Ламинатры и расходные'),
'84' => array( '6413', 'Биндеры и расходные'),
'96' => array( '3307', 'Матричные принтеры'),


// 90  - Письменные принадлежности
// '86' => array( '6484,6485', 'Письменные принадлежности'),
'89' => array( '6311', 'Струйные МФУ'),
'88' => array( '6505', 'Лазерные МФУ'),
'92' => array( '6555', 'Кассовые аппараты' ),
'93' => array( '6521', 'Штемпельная краска'),
'95' => array( '6549', 'Уничтожители бумаг' ),

'253' => array( '6747', 'Кофемолки'),
'254' => array( '6748', 'Кофемашины'),
'255' => array( '6749', 'Электрочайники'),
'256' => array( '6750', 'Термопоты'),
'257' => array( '6751', 'Весы кухонные'),
'258' => array( '6752', 'Сэндвичницы'),
'259' => array( '6753', 'Электрогрили'),
'260' => array( '6754', 'Микроволновые печи'),
'261' => array( '6755', 'Тостеры'),
'262' => array( '6756', 'Пылесосы'),
'263' => array( '6761', 'Бойлеры'),
'266' => array( '6759', 'Кондиционеры'),

'267' => array( '6763', 'Очистители воздуха'),
'268' => array( '6762', 'Сушилки для рук'),
'269' => array( '6764', 'Увлажнители воздуха'),
'264' => array( '6758', 'Вентилятори'),
'265' => array( '6760', 'Обогреватели'),
    
// 125 - канцтовары
'132' => array( '6564', 'Графитовые карандаши' ),
'131' => array( '6563', 'Ручки шариковые' ),
'129' => array( '6561', 'Ручки гелевые' ),
'130' => array( '6562', 'Ручки масляные' ),
'133' => array( '6568', 'Карандаши механические' ),
'134' => array( '6569', 'Маркеры для магнитных досок и флипчартов' ),
'135' => array( '6570', 'Маркеры перманентные' ),
'136' => array( '6571', 'Маркеры текстовые' ),
'137' => array( '6572', 'Дестеплеры (Расшиватели скоб)' ),

    
'138' => array( '6573', 'Дыроколы' ),
'139' => array( '6574', 'Канцелярские ножи' ),
'140' => array( '6575', 'Ножницы' ),
'141' => array( '6576', 'Степлеры' ),
'143' => array( '6577', 'Биндеры (зажимы)' ),
'144' => array( '6578', 'Клей ПВА' ),
'145' => array( '6579', 'Клей-карандаш' ),
'146' => array( '6580', 'Кнопки, булавки канцелярские' ),
'171' => array( '6581', 'Корректор с кисточкой' ),
'148' => array( '6582', 'Корректор-ручка' ),
'149' => array( '6583', 'Ластик' ),
'150' => array( '6584', 'Линейки' ),
'151' => array( '6585', 'Резинки для денег' ),
'152' => array( '6586', 'Скобы для степлера' ),
'153' => array( '6587', 'Скотч' ),
'154' => array( '6588', 'Скрепки' ),
'155' => array( '6589', 'Точилки' ),
'156' => array( '6590', 'Увлажнители для пальцев' ),
'164' => array( '6591', 'Клипборды' ),
'165' => array( '6592', 'Папки с прижимом' ),
'166' => array( '6593', 'Папка регистратор' ),
'167' => array( '6594', 'Папка на завязках' ),
'168' => array( '6595', 'Папка на кнопках' ),
'169' => array( '6596', 'Папка на резинках' ),
'170' => array( '6597', 'Файлы для документов' ),
'142' => array( '6598', 'Бейджи' ),
'147' => array( '6599', 'Корректор ленточный' ),
'157' => array( '6600', 'Боксы для бумажных блоков' ),
'158' => array( '6601', 'Боксы для скрепок' ),
'159' => array( '6602', 'Лоток вертикальный' ),
'160' => array( '6603', 'Лоток горизонтальный' ),
'161' => array( '6604', 'Набор настольный с наполненнием' ),
'162' => array( '6605', 'Настольные наборы, подставки' ),
'163' => array( '6606', 'Блокноты' ),
'202' => array( '6650', 'Блоки для флипчартов' ),
'203' => array( '6651', 'Калькуляторы' ),
'204' => array( '6652', 'Губки, магниты для досок' ),
'205' => array( '6649', 'Доски, флипчарты' ),
'305' => array( '6558', 'Календари, планинги' ),

'306' => array( '6810', 'Рамки плакатные'),
'307' => array( '6811', 'Штендеры'),
'308' => array( '6812', 'Стойки для баннеров'),
'309' => array( '6813', 'Стойки для брошюр'),
'310' => array( '6814', 'Дверные и настенные таблички'),
'312' => array( '6815', 'Информационные стойки'),
 // ***
'206' => array( '6741', 'Подарочные ручки' ),
'207' => array( '6739', 'Стержни для ручек' ),
'208' => array( '6743', 'Корзины для бумаг' ),
'209' => array( '6742', 'Настольные наборы и аксессуары' ),
'210' => array( '6736', 'Папки-портфели' ),
'211' => array( '6737', 'Глобусы' ),
'212' => array( '6738', 'Боксы и короба для архивации' ),
'213' => array( '6740', 'Штампы и печати' ),

// Хозтовары 
'173' => array( '6624', 'Тарелки' ),
'174' => array( '6625', 'Скатерти' ),
'175' => array( '6615', 'Cредства для стирки и пятен' ),
'176' => array( '6616', 'Средства для мытья посуды' ),
'177' => array( '6617', 'Освежители воздуха, полироли' ),
'178' => array( '6618', 'Средства для мойки стекл и зеркал' ),
'179' => array( '6619', 'Средства для мытья полов' ),
'180' => array( '6620', 'Универсальные средства для чистки, дезинфекции' ),
'181' => array( '6621', 'Туалетное мыло' ),
'182' => array( '6622', 'Наборы посуды' ),
'183' => array( '6623', 'Стаканчики' ),

'198' => array( '6626', 'Приборы, палочки для размешивания'), //	14	salfetki-6628
'199' => array( '6627', 'Пищевая пленка, пакеты'), //	14	salfetki-6628
'184' => array( '6628', 'Салфетки'), //	14	salfetki-6628
'185' => array( '6629', 'Бумажные полотенца'), //	15	bumajnye-polotenca-6629
'186' => array( '6630', 'Туалетная бумага'), //	16	tualetnaya-bumaga-6630
'187' => array( '6631', 'Пакеты для мусора'), //	17	pakety-dlya-musora-6631
'188' => array( '6632', 'Перчатки'), //	18	perchatki-6632
'189' => array( '6633', 'Губки, салфетки, скребки'), //	19	gubki-salfetki-skrebki-6633
'190' => array( '6634', 'Щетки'), //	20	schetki-6634
'191' => array( '6635', 'Насадки для швабр, мопы'), //	21	nasadki-dlya-shvabr-mopy-6635
'192' => array( '6636', 'Швабры, ведра, совки'), //	22	shvabry-vedra-sovki-6636
'241' => array( '6794', 'Бумагодержатели'),
'242' => array( '6795', 'Держатели бумажных полотенец'),
'243' => array( '6796', 'Дозаторы для мыла'),

// Продтовары
'193' => array( '6637', 'Чай, кофе'), //	23	chay-kofe-6637
'194' => array( '6638', 'Сахар, соль, молоко, сливки'), //	24	sahar-sol-moloko-slivki-6638
'195' => array( '6639', 'Вода'), //	25	voda-6639
'196' => array( '6640', 'Снэки, сладости, фрукты'), //	26	sneki-sladosti-frukty-6640
'197' => array( '6641', 'Еда быстрого приготовления'), //	27	eda-bystrogo-prigotovleniya-6641

'215' => array( '6765', 'Галогенные лампы'),
'216' => array( '6766', 'Люминесцентные лампы'),
'217' => array( '6767', 'Лампы накаливания'),
'218' => array( '6768', 'Светодиодные лампы'),
'219' => array( '6769', 'Энергосберегающие лампы'),
'220' => array( '6770', 'Лестницы (стремянки)'),
'221' => array( '6771', 'Лопаты'),
'222' => array( '6772', 'Топоры'),


'290' => array( '6559', 'Газетная бумага'),
'293' => array( '6557', 'Офсетная бумага')


);

$seo_cache_update=0;

// Коды языков
$langcodes=array(1=>'ru', 2=>'ua', 3=>'en');


// Получение и анализ аргументов
if (($a=strpos($argv[1], 'category=')!==FALSE) || ($a=strpos($argv[1], 'cat=')!==FALSE) || ($a=strpos($argv[1], 'c=')!==FALSE)) {
  $params=explode('=', $argv[1]);
  $occat=$params[1];   
} elseif ($a=strpos($argv[1], 'all')!==FALSE) {
  $occat='all';
} elseif ($a=strpos($argv[1], 'filters')!==FALSE) {
  $occat='filters';  
} elseif ($a=strpos($argv[1], 'caturl')!==FALSE) {
  $occat='caturl';
} else {
  echo "Wrong parameters!\n";
  echo "Usage: import.php category=NN or import.php all\n";
  echo "Category list:\n"; 
  foreach ($occats as $key=>$val) {
      echo  '        ' . $key . ' ' . $val[1] . ' [' . $val[0] . ']' . "\n" ;
  }
  // print_r($occats);
  echo "Filters: import.php filters\n";
  die();
}
//echo "occat=". $occat."\n";

// Соединение с БД
$db_prote = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
$db_vm = new \mysqli(DB_VM_HOSTNAME, DB_VM_USERNAME, DB_VM_PASSWORD, DB_VM_DATABASE, DB_VM_PORT);

if ($db_prote->connect_error) {
  trigger_error('Error: Could not make a database link (' . $db_prote->connect_errno . ') ' . $db_prote->connect_error);
  exit();
}

$db_prote->set_charset("utf8");
$db_prote->query("SET SQL_MODE = ''");

if ($db_vm->connect_error) {
  trigger_error('Error: Could not make a database link (' . $db_vm->connect_errno . ') ' . $db_vm->connect_error);
  exit();
} 

$db_vm->set_charset("utf8");
$db_vm->query("SET SQL_MODE = ''");

if ($occat=='all') {
//  updateNP(); 
}

updatePrice();
updateAttribute();
updateAxaptaFiles();

if (0&&$occat=='caturl') {
    $sSQL="SELECT *
        FROM  `oc_category` a
        LEFT JOIN oc_url_alias b ON CONCAT(  'category_id=', a.category_id ) = b.query
        LEFT JOIN oc_category_description c on c.category_id=a.category_id and c.language_id=1
        HAVING b.keyword IS NULL
        LIMIT 0 , 30";
    if($flt=getQuery($sSQL, $db_prote)) {

        while ($fltrow = mysql_fetch_array($flt)) {

            $utmp= ru2Lat($fltrow['name']);

            $utmp=str_replace(array(' ', ',','%',',','*','--','_-'),array('_','-','-','-','x','-','-'),$utmp);
            $utmp=trim($utmp, '-*,_ ');
            // echo $utmp."\n";
            $sSQL="INSERT INTO `oc_url_alias` values (0, 'category_id=" . $fltrow['category_id'] . "','".$utmp."')";
            //echo $sSQL;
            $ins=getQuery($sSQL, $db_prote);           
        }
    }

    die();
}

if (0&&$occat=='filters') {
    //
    // Создание УРЛ фильтров
    echo 'Создание УРЛ фильтров';
    $sSQL="SELECT CONCAT(  'bfilter=f', a.filter_group_id,  ':', b.filter_id ,';') uri, a.filter_group_id, name, c.url_alias_id
        FROM  `oc_filter_group` a
        INNER JOIN  `oc_filter_description` b ON a.filter_group_id = b.filter_group_id
        LEFT JOIN `oc_url_alias` c on c.query=CONCAT(  'bfilter=f', a.filter_group_id,  ':', b.filter_id, ';' )
        WHERE b.language_id =1
        HAVING c.url_alias_id is NULL
    ";
    // echo $sSQL;
    //
    if($flt=getQuery($sSQL, $db_prote)) {
        
        while ($fltrow = mysql_fetch_array($flt)) {
           
           $utmp= ru2Lat($fltrow['name']);
           
           $utmp=str_replace(array(' ', ',','%',',','*','--','_-'),array('_','-','-','-','x','-','-'),$utmp);
           $utmp='f' . $fltrow['filter_group_id'] . '-' . trim($utmp,' -_'); 
           echo $fltrow['uri'], $utmp."\n";
           // Добавление в БД
           $sSQL="INSERT INTO `oc_url_alias` values (0, '" . $fltrow['uri'] . "','".$utmp."')";
           $ins=getQuery($sSQL, $db_prote);
        }
        
        // Чтоб обновились сео фильтры
        $seo_cache_update=1; 
    }

} else { 

if ($occat<>'all') {
   $occats=array($occat=>$occats[$occat]);
}

$numcateg=0;

foreach ($occats as $key=>$val) {
  echo "\n\n Обновление категории ".$key." = ".$val['0'].' - '.$val['1']."\n";
   
    $occat=$key;

    $vmcat= $occats[$occat][0];

    // b.price_group=1 - товары для сайта ПС
    // b.price_group=15 - товары для сайта Проте
    $sql_vm="
      SELECT a.*, b.amount, c.amount AS special
      FROM `articles` a 
      LEFT JOIN `cont_2130` b ON a.absnum=b.absnum AND a.langid=b.langid AND b.price_group=15 AND b.currency=1
      LEFT JOIN `cont_2130` c ON a.absnum=c.absnum AND a.langid=c.langid AND c.price_group=14 AND c.currency=1
      WHERE a.category in (".$vmcat.") /* AND a.approved=1 */ ORDER by a.absnum, a.langid ";

    $articles = getQuery($sql_vm, $db_vm);
    
    if($articles){
      

        
      $numIns=0;
      $numUpd=0;

      $currentAbsnum=0;

      $products =  array();
      foreach ($articles->rows as $key => $article) {

          if ($article['absnum']!=$currentAbsnum){
             $currentAbsnum=$article['absnum'];
             $products[$currentAbsnum]=array(
                 'absnum'   => $article['absnum'],
                 'alias'    => $article['alias'],
                 'axapta_code' => $article['axapta_code'],
                 'axapta_article' => $article['axapta_article'],
                 'axapta_alias' => $article['axapta_alias'],
                 'price' => $article['amount'] ? $article['amount'] : 0,
                 'special' => $article['special'] ? $article['special'] : 0,
                 // 'avail' => $article['avail']==1 ? 1 : ($article['delivery_days']<=3 && $article['delivery_days']>0 ? 1 : 0),
                 'avail' => $article['avail'],
                 'asort' => $article['asort'],
                 'status' => $article['amount'] && $article['approved'] ? 1 : 0, 
                 // 'delivery_days' => 100*$article['asort']+$article['delivery_days'],
                 'delivery_days' => $article['deliv_days'],                 
                 'extavail' => $article['extavail'],
                 'extdlvdays' => $article['extdlvdays'],
                                    
                 );
          }

          if (isset($langcodes[$article['langid']]))
            $langcode=($langcodes[$article['langid']]);
            $products[$currentAbsnum]['name_'.$langcode]=$article['title'];
            $products[$currentAbsnum]['description_'.$langcode]=$article['body'];
            $products[$currentAbsnum]['meta_title_'.$langcode]=$article['meta_title'];
            $products[$currentAbsnum]['meta_h1_'.$langcode]=$article['meta_h1'];
            $products[$currentAbsnum]['meta_keywords_'.$langcode]=$article['meta_keywords'];
            $products[$currentAbsnum]['meta_description_'.$langcode]=$article['meta_description'];
            $products[$currentAbsnum]['ax_description_'.$langcode]=$article['body_prote'];
            // $data[$currentAbsnum]['delivery_days']=100*$article['asort']+$article['delivery_days'];
          }

      }

      $errcount=0;
      
      foreach ($products as $k => $d){
      try {
          echo "#";
          // echo "Параметры записи:", $d['absnum'],'/',$d['axapta_article'];
          $imgdecode=substr($d['absnum'], 0, 3).'/'.(int)substr($d['absnum'], 3, 5);
          /*$imgdecode=substr($d['absnum'], 0, 3).'/'.(int)substr($d['absnum'], 3, 5);
          $imgdecodefull='img/article/' . $imgdecode . "_main.jpg";*/

          // определяем статус номенклатуры для будущей сортировки

          $ifexist=2; 
          $delivery_days=$d['delivery_days'] % 100; 

          $quantity = (string)100*($d['avail']+$d['extavail']);

          if ($quantity==0) {
              if($d['asort']==1) {
                  if ($delivery_days>2) {
                      $ifexist=1;
                  } elseif ($delivery_days==0) {
                      $ifexist=0;
                  }
              } else {
                  $ifexist=0;
              }
          }
          if ($d['price']==0) $ifexist=0;
          
          /*file_put_contents(DIR_ROOT.'cron/logs/prote_update_available_'.Date('Y-m-d h').'.log', ''.Date('Y-m-d h:i:s').' - product_id = , axapta_article='.$d['axapta_article']. ' , import_article=' . $import_article ."<\n", FILE_APPEND);*/

          //if( !file_exists(DIR_IMAGE . $imgdecodefull)) 
          $imgdecodefull='';

          $sql_prote="SELECT `product_id` FROM `oc_product` WHERE `sku`= '" . $d['axapta_article'] . "' AND `upc`='" . $d['absnum'] . "'";
          $result = getQuery($sql_prote, $db_prote);
          	
          if ($result->row) {

              $product_id=$result->row['product_id'];

              //if($row['product_id']!='13525') continue;

              // Обновление записи
              $sql_prote="UPDATE `oc_product` SET `model`='".$d['axapta_article']."', `status`='". $d['status'] ."', `shipping`='1', `quantity`='" . $quantity . "', `price`='".$d['price']."', `image`='".$imgdecodefull."', `mpn`='".$d['axapta_code']."', `delivery_days`='".$d['delivery_days']."', `extavail`='".$d['extavail']."', `extdlvdays`='".$d['extdlvdays']."', `asort`='".$d['asort']."', `date_modified`=now(), ifexist='".$ifexist."'WHERE `product_id`= '" . $product_id . "'";
              getQuery($sql_prote, $db_prote);
              
              $numUpd++;
              //echo "\n" . 'Обновление kod1С=' . $d['axapta_article']. ' | product_id='. $product_id;
              //echo "" . ' | status = ' . $d['status'];
          } else {
              // Создание записи в основной таблице
              $sql_prote="INSERT INTO `oc_product` (`sku`,`upc`, `model`, `mpn`, `status`, `quantity`, `price`,`image`,`shipping`, `delivery_days`, `extavail`, `extdlvdays`, `date_added`, `ifexist`) VALUES ('".$d['axapta_article']."', '".$d['absnum']."', '".$d['axapta_article']."', '".$d['axapta_code']."', '".$d['status']."', '" . $quantity ."', ".$d['price'].", '".$imgdecodefull."', '1', '".$d['delivery_days']."', '".$d['extavail']."', '".$d['extdlvdays']."', now(), '".$ifexist."')";

              //echo "\n" . 'Добавлено oc_product' . $d['axapta_article'];
              getQuery($sql_prote, $db_prote);
              $product_id=mysqli_insert_id($db_prote);
              $numIns++;
          }

            // Создание языкозависимых записей
            //echo "" . ' |  update description =' . $product_id . ':';
            foreach ($langcodes as $kode => $lcode) {
              if(isset($d['name_'.$lcode]) OR isset($d['description_'.$lcode]) OR isset($d['meta_title_'.$lcode]) OR isset($d['meta_h1_'.$lcode]) OR isset($d['meta_description_'.$lcode])) {

                $sql_prote="SELECT `product_id`, `language_id`, `description` FROM `oc_product_description` WHERE `product_id`='". $product_id ."' AND `language_id`='". $kode ."'";
                $query = getQuery($sql_prote, $db_prote);

                if ($query->row) {
                                        
                    $sql_prote="UPDATE `oc_product_description` SET `name`='".escape(substr($d['name_'.$lcode], 0, 254))."', `ax_description`='".escape($d['ax_description_'.$lcode])."'
                    WHERE `product_id`=".$product_id." AND `language_id`=".$kode;
                    
                    getQuery($sql_prote, $db_prote);
                    //echo 'U(', $kode, ') '  ;
                    
                } else {

                    $sql_prote="INSERT `oc_product_description` SET `product_id`=".$product_id.", `language_id`=".$kode.", `name`='".escape(substr($d['name_'.$lcode], 0, 254))."', `ax_description`='".escape($d['ax_description_'.$lcode])."'";
                  
                    //echo 'I(', $kode, ') ';

                    getQuery($sql_prote, $db_prote);
                }
              }
            }

              // Добавление изображений
              // **********************
              $imglist=array();
              
              // Проверка изображений ТОЛЬКО для проте!
              $sql_vm="SELECT * FROM `articles_gallery` where parent=".$d['absnum']." AND `dest` & 2 = 2";
              $query = getQuery($sql_vm, $db_vm);

              // В результате запроса - 0, используем "общие" изображения
              if(!$query->row) {
                  $sql_vm="SELECT * FROM `articles_gallery` where parent=".$d['absnum'];
                  $query = getQuery($sql_vm, $db_vm);
              } 
              
              // Обработка результатов 
              foreach ($query->rows as $imgrow) {
                  $imglist[]=array($imgrow['absnum'],$imgrow['position'],$imgrow['ax_filename']);
              }
             
              // Изображение в описании товара
              //echo ' | image #' . $product_id . ':';

              $imglistout=array();             

              $sql_prote="DELETE FROM `oc_product_image` WHERE `product_id`=".$product_id;
              getQuery($sql_prote, $db_prote);
              
              if(!empty($imglist)) {
                
                //$main_image = array_shift($imglist);
                $main_image = $imglist[0];
                $main_img = "img/gallery/".$imgdecode."/".$main_image[0]."_main.jpg";
                $sql_prote="UPDATE `oc_product` SET `image`='".$main_img."' WHERE `product_id`= '" . $product_id . "'";     

                getQuery($sql_prote, $db_prote);
              }
              
              foreach($imglist as $im_key => $imgitem) {
                
                  $sql_prote="INSERT `oc_product_image` SET `product_id`=".$product_id.", `ax_filename`='".$imgitem[2]."', `image`='img/gallery/".$imgdecode."/".$imgitem[0]."_main.jpg', `sort_order`=".$imgitem[1];

                   getQuery($sql_prote, $db_prote);
              }
            
            
              // Привязка к магазину
              $sql_prote="INSERT IGNORE INTO `oc_product_to_store` SET `product_id`=".$product_id.", `store_id`=0";
              getQuery($sql_prote, $db_prote);

              // Привязка к категории
              // Удаление старой привязки
              $sql_prote="DELETE from `oc_product_to_category` WHERE `product_id`=".$product_id." AND category_id<>".$occat;
              getQuery($sql_prote, $db_prote);

              $sql_prote="INSERT IGNORE INTO `oc_product_to_category` SET `product_id`=".$product_id.", `category_id`=".$occat.", `main_category`=0";
              getQuery($sql_prote, $db_prote);
                  

              // Generate SEO URL
              // Нужно продумать как быть при смене наименования
              $sql_prote="SELECT * FROM `oc_url_alias` WHERE `query`='product_id=".$product_id ."'";

              $query = getQuery($sql_prote, $db_prote);
            
              // Запись seo_alias создается только в том случае, если ее нет
              if (!$query->row) {
                  
                  $seo_cache_update=1;
                  
                  $seftext=trim(ru2Lat(trim(mb_substr($d['name_ru'],0,50,'UTF-8'))),'-').'-'.$d['axapta_article'];

                  $seftext=preg_replace("#[^a-zA-Z0-9]+#", "-", $seftext);
                  $seftext=preg_replace("#(-){2,}#", "$1", $seftext);

                  // Проверка - нет ли, случайно, такого же УРЛа
                  $sql_prote="SELECT * FROM `oc_url_alias` WHERE `keyword`='".$seftext ."'";

                  $query = getQuery($sql_prote, $db_prote);
                  if ($query->row) {
                      // Добавляем случайную последовательность символов
                      $seftext .= '-' . substr(md5(date('H:i:s')), 0, 5);
                      //echo "\n  seo_url повторяется!" . $seftext;
                  }
                 
                  // Добавляем в БД
                  $sql_prote="INSERT INTO `oc_url_alias` SET 
                  query = 'product_id=" . $product_id . "',
                  keyword = '".escape($seftext)."',
                  date_added = now()"; // добавляем дату для отслеживания

                  getQuery($sql_prote, $db_prote);
                  //echo "\n  seo_url создан" . $seftext;
                  
              }
            
            // Необходимо удалять аттрибуты перед тем, как вставлять новые

            $sql_prote="DELETE FROM `oc_product_attribute` WHERE product_id=".$product_id;
            getQuery($sql_prote, $db_prote);
            // Добавление аттрибутов к товарам


            
            $sql_prote="INSERT INTO oc_product_attribute 
                (SELECT ".$product_id.", langid, (right(a.prop_id, 6))*1, b.name, a.value_id FROM axapta_props a
                 LEFT JOIN axapta_values_names b 
                 ON a.value_id = b.value_id 
                 WHERE a.absnum=".$d['absnum']." AND langid<>0 AND b.name<>'' AND a.attribute=1)
                 ON DUPLICATE KEY UPDATE `text`=b.name, ext_value_id=a.value_id";
            
            getQuery($sql_prote, $db_prote);
            //echo "\n  Аттрибуты установлены";

            // исправил ошибку игоря
            // если атрибут отключали то в фильтр товар но попадал
            $sql_prote="SELECT c.filter_id, a.* 
                    FROM (
                        SELECT (right(a.prop_id, 6))*1 as `attribute_id`, langid as `language_id`, b.name as `text`, a.prop_id AS `ext_prop_id`, a.value_id AS `ext_value_id`
                          FROM axapta_props a
                          LEFT JOIN axapta_values_names b 
                          ON a.value_id = b.value_id 
                          WHERE a.absnum=".$d['absnum']." AND langid<>0 AND b.name<>'' AND a.filter=1) a
                          LEFT JOIN `oc_filter` c 
                          ON a.ext_value_id=c.ext_filter_id
                          ORDER BY a.attribute_id, a.language_id";


            $query = getQuery($sql_prote, $db_prote);

            if($query->row){
                 
                $prev_att_id='';
                $prev_filter_id='';

                // Необходимо удалять фильтры товаров перед тем, как вставлять новые
                $sql_prote="DELETE FROM `oc_product_filter` WHERE product_id=".$product_id;
                getQuery($sql_prote, $db_prote);

                foreach ($query->rows as  $proprow) {
                    
                    if($proprow['filter_id']===NULL) {

                        // This is a filter? - если фильтр - нужно создавать
                        $sql_prote="SELECT `filter`, `value_id` FROM  `axapta_props` WHERE absnum =" . $d['absnum'] . " AND CAST(substr(`prop_id`, 3, 20) as SIGNED) = " .$proprow['attribute_id'];

                        $query2 = getQuery($sql_prote, $db_prote);

                        $row = $query2->row;

                        if ($row['filter']==1) {

                            if ($prev_att_id==$proprow['attribute_id']) {

                               // same filter_id, other language
                               $sql_prote="INSERT INTO `oc_filter_description`
                               VALUES ('".$prev_filter_id."','".$proprow['language_id']."','".$proprow['attribute_id']."','".escape($proprow['text'])."', now()) 
                               ON DUPLICATE KEY UPDATE `name`='".escape($proprow['text'])."', `updated`=now()";

                               getQuery($sql_prote, $db_prote);

                            } else { 
                              
                                 $sql_prote="INSERT INTO `oc_filter` VALUES (NULL, '".$proprow['attribute_id']."',0, now(),'".$row['value_id']."')";
                               
                                 getQuery($sql_prote, $db_prote);
                                 $prev_filter_id=mysqli_insert_id($db_prote);


                               // create new filter description
                               $sql_prote="INSERT INTO `oc_filter_description` VALUES ('".$prev_filter_id."','".$proprow['language_id']."','".$proprow['attribute_id']."','".escape($proprow['text'])."', now()) "
                                       . "ON DUPLICATE KEY UPDATE `name`='" . escape($proprow['text'])."', `updated`=now()";
                               
                               getQuery($sql_prote, $db_prote);
                               $prev_att_id=$proprow['attribute_id'];
                            }                        
                            
                            // Generate SEO URL - из русского языка
                            if ($proprow['language_id']==1) {
                                $urlquery="bfilter=f".$proprow['attribute_id'].":".$prev_filter_id .";";
                                // echo $urlquery;
                                $sql_prote="SELECT * FROM `oc_url_alias` WHERE `query`='".$urlquery."'";

                                echo $sql_prote."\n";


                                $query3 = getQuery($sql_prote, $db_prote);

                                // Запись seo_alias создается только в том случае, если ее нет
                                if (!$query3->row) {

                                    $seo_cache_update=1;
                                    $seftext='f'.$proprow['attribute_id']."-".trim(ru2Lat(trim(mb_substr($proprow['text'],0,50,'UTF-8'))),'-');                                
                                    $seftext=preg_replace("#[^a-zA-Z0-9]+#", "-", $seftext);
                                    $seftext=preg_replace("#(-){2,}#", "$1", $seftext);

                                    // Проверка - нет ли, случайно, такого же УРЛа
                                    $sql_prote="SELECT * FROM `oc_url_alias` WHERE `keyword`='".$seftext ."'";
                                    
                                    echo $sql_prote."\n";
                                    $f = getQuery($sql_prote, $db_prote);

                                    if ($f->row) {
                                        // Добавляем случайную последовательность символов
                                        // $seftext .= '-' . substr(md5(date('H:i:s')), 0, 5);
                                        // echo "\n  SEF повторяется!" . $seftext;
                                    } else {
                                        // Добавляем в БД
                                        //echo "\n\nДобавляем в БД oc_url_alias\n";

                                        //$sql_prote="INSERT INTO `oc_url_alias` VALUES (0, '$urlquery')";
                                        $sql_prote="INSERT INTO `oc_url_alias` SET 
                                                    query = '" . $urlquery . "',
                                                    keyword = '".escape($seftext)."',
                                                    date_added = now()"; // добавляем дату для отслеживания
                                        echo $sql_prote."\n";

                                        getQuery($sql_prote, $db_prote);
                                        //echo "\n  SEF для фильтра создан" . $seftext;

                                    }
                                }
                            }
                        }
                    } else {
                        
                        $sql_prote="INSERT INTO `oc_filter_description`
                                   VALUES ('".$proprow['filter_id']."','".$proprow['language_id']."','".$proprow['attribute_id']."','".escape($proprow['text'])."', now()) 
                                   ON DUPLICATE KEY UPDATE `name`='".escape($proprow['text'])."', `updated`=now()";

                         getQuery($sql_prote, $db_prote);
                        
                        $prev_filter_id = $proprow['filter_id'];
                        $prev_att_id=$proprow['attribute_id'];
                    }     

                      //if($product_id==30756){
                      // gdemon проверяем фильтр // 09.07.2018
                      // проверяем на примере категории 167 - Папки на завязках
                      // если фильтр был включен но его отключили в аксапте, то его не нужно добавлять на проте
                       $sql_prote="SELECT `filter`, `value_id` FROM  `axapta_props` WHERE absnum =" . $d['absnum'] . " AND CAST(substr(`prop_id`, 3, 20) as SIGNED) = " .$proprow['attribute_id'];
                         
                        $res = getQuery($sql_prote, $db_prote);
                        	
                          if($res && $res->row['filter']){
                            // link filter with current product
                            $sql_prote="INSERT IGNORE INTO `oc_product_filter` (`product_id`,`filter_id`, `updated`) VALUES ('".$product_id."', '".$prev_filter_id."', now())";
                            
                            getQuery($sql_prote, $db_prote);
                          }
                      // gdemon END проверяем фильтр // 09.07.2018
                      //}
                    
                }
                //echo "\n  Фильтры  установлены";
            }

            // Добавление/удаление записей о скидках
            if($d['special']){
                // Если такая запись уже есть - передвигаем дату окончания акции
                $sql_prote="SELECT * FROM `oc_product_special` WHERE `product_id`=".$product_id." ORDER BY date_end DESC LIMIT 1";
                $result = getQuery($sql_prote, $db_prote);

                if ($result->row) {

                    $specnum=$result->row['product_special_id'];
                    $sql_prote="UPDATE `oc_product_special` SET date_end='".date('Y-m-d', strtotime("+2 days"))."', `price`='".$d['special']."' WHERE product_special_id='".$specnum."'"; 
                    //echo "\n  Акция продлена";
                } else {
                    $sql_prote=" INSERT INTO `oc_product_special` 
                            VALUES (NULL, '".$product_id."',1,1,'".$d['special']."','".date('Y-m-d')."','".date('Y-m-d', strtotime("+2 days"))."')";
                    //echo "\n  Акция добавлена";
                }
                getQuery($sql_prote, $db_prote);
                
            } else {
                $sql_prote="DELETE FROM `oc_product_special` WHERE `product_id`=".$product_id;
                getQuery($sql_prote, $db_prote);
            }
                          
          } catch (Exception $e) {
              echo "Исключение:", $e->getMessage(), ' в строке:', $e->getLine(), "\n";
              print_r($d);
              $errcount++;              
        }
      } 
      echo "\n" . 'В категорию: '.$occats[$occat][1];
      echo "\n" .   'Добавлено: '.$numIns.' записей';
      echo "\n" .   'Обновлено: '.$numUpd.' записей';
      echo "\n" .   'Исключений: ' . $errcount;
      
      $numcateg++;   
    }
    
    }

    // Добавление СЕО-урлов для совместимости принтеров    
    $sql_prote = 'INSERT INTO `oc_url_alias` (
        SELECT 0, CONCAT("prn=", CAST(`product_id` AS CHAR)), CONCAT("rashod-", b.keyword), now() FROM `oc_product_to_category` 
        LEFT JOIN `oc_url_alias` a ON a.`query`=CONCAT("prn=", CAST(`product_id` AS CHAR))
        LEFT JOIN `oc_url_alias` b on b.`query`=CONCAT("product_id=", CAST(`product_id` AS CHAR))
        WHERE `category_id` IN (81,82,88,89,96) AND a.`query` IS NULL)';
    
    getQuery($sql_prote, $db_prote);
    
    // Очиска кеша сео-про
    $files = glob(DIR_CACHE . 'cache.' . 'seo_pro' . '.*');
    
    if ($files) {
        foreach ($files as $file) {
            if (file_exists($file)) {
              @unlink($file);
            }
        }
    }        
    echo "\nSEO cache deleted!\n";

    /***** gmon ********/
    // Создание УРЛ фильтров 
    
    /*foreach ($sSQL as $sSQLline) {
       if (!getQuery($sSQLline, $db_prote)) throw new Exception('MySQL error' . $sSQL);   
    }*/
    // ****
    
    if ($numcateg>1) {
      echo "\n\n" . 'Обработано категорий: '.$numcateg;
    }
    echo "\n" . 'ФФФФФФФ Очищаем кеш brainyfilter и Генерируем seo_text... ';
    $res = refresh_brainyfilter_cache();

    getFiles();// копируем изображения и мануалы

    echo "\nКонец импорта!\n\n";

///////////////////////////////////////////////////////////////////////////////
function escape($value,$db_prote=false) {
  global $db_prote;
    return $db_prote->real_escape_string($value);
}

function updatePrice(){
  global $db_vm;
  global $db_prote;
  echo "Обновление cont_2130\n";
  $sql = 'SELECT * FROM `cont_2130` WHERE price_group>=14 AND langid=1 AND currency=1';
  $result = getQuery($sql, $db_vm);

  if($result->rows){
    
    $sql = 'TRUNCATE TABLE `cont_2130`';
    getQuery($sql, $db_prote);
    
    foreach ($result->rows as $key => $value) {
      $sql = "INSERT INTO cont_2130 SET 
      absnum = '".$value['absnum']."', 
      model = '".$value['model']."', 
      langid = '".$value['langid']."', 
      price_group = '".$value['price_group']."', 
      amount = '".$value['amount']."', 
      currency = '".$value['currency']."', 
      date_update = '".$value['date_update']."'";
      
      getQuery($sql, $db_prote);
    }
    
  }
}

function updateNP(){
  global $db_vm;
  global $db_prote;
    // Обновление таблиц Новой почты
    echo "Обновление НП np_wh\n";
    $sql = 'SELECT * FROM `np_wh`';
    $result = getQuery($sql, $db_vm);
    if($result->rows){
      
      $sql = 'TRUNCATE TABLE `np_wh`';
      getQuery($sql, $db_prote);
      
      foreach ($result->rows as $key => $value) {
        $sql = "INSERT INTO np_wh SET city_id = '".$value['city_id']."', name_1 = '".escape($value['name_1'])."', name_2 = '".escape($value['name_2'])."', name_3 = '".escape($value['name_3'])."', number = '".$value['number']."', np_whid = '".$value['np_whid']."', np_city_id = '".$value['np_city_id']."', np_ref = '".$value['np_ref']."', np_city_ref = '".$value['np_city_ref']."', np_phone = '".$value['np_phone']."', np_x = '".$value['np_x']."', np_y = '".$value['np_y']."', `show` = '".$value['show']."', upd = '".$value['upd']."', old_np_ref = '".$value['old_np_ref']."'";
        getQuery($sql, $db_prote);
      }
      
    }

    echo "Обновление НП np_citys\n";
    $sql = 'SELECT * FROM `np_citys`';
    $result = getQuery($sql, $db_vm);
    if($result->rows){
      
      $sql = 'TRUNCATE TABLE `np_citys`';
      getQuery($sql, $db_prote);
      
      foreach ($result->rows as $key => $value) {
        $sql = "INSERT INTO np_citys SET region_id = '".$value['region_id']."', name_1 = '".escape($value['name_1'])."', name_2 = '".escape($value['name_2'])."', name_3 = '".escape($value['name_3'])."', np_id = '".$value['np_id']."', np_pid = '".$value['np_pid']."', np_ref = '".$value['np_ref']."', np_pref = '".$value['np_pref']."', `show` = '".$value['show']."', upd = '".$value['upd']."'";
        getQuery($sql, $db_prote);
      }
    }

    echo "Обновление НП np_regions\n";
    $sql = 'SELECT * FROM `np_regions`';
    $result = getQuery($sql, $db_vm);
    if($result->rows){
      
      $sql = 'TRUNCATE TABLE `np_regions`';
      getQuery($sql, $db_prote);
      
      foreach ($result->rows as $key => $value) {
        $sql = "INSERT INTO np_regions SET name_1 = '".escape($value['name_1'])."', name_2 = '".escape($value['name_2'])."', name_3 = '".escape($value['name_3'])."', np_ref = '".$value['np_ref']."', `show`= '".$value['show']."'";
        getQuery($sql, $db_prote);
      }
      
    }
}

function updateAttribute(){

    global $db_vm;
    global $db_prote;

    $sql_vm = "SELECT * FROM `axapta_props`";
    $attributes = getQuery($sql_vm, $db_vm);
    //$attributes = false;
    if($attributes){
      //$sql_prote = 'TRUNCATE TABLE vm.`axapta_props`';
      $sql_prote = 'TRUNCATE TABLE `axapta_props`';
      getQuery($sql_prote, $db_prote);

      echo "Перенос таблицы axapta_props\n";

      for ($i = 0; $i < count($attributes->rows);) { 
        
        $sql_prote = "INSERT INTO `axapta_props` (`absnum`, `prop_id`, `value_id`, `page_absnum`, `approved`, `filter`, `attribute`) VALUES ";
        
        $j = $i + 100; 
        for (; $i < $j; $i++) {
           if (isset($attributes->rows[$i])) { 
              //echo $attributes->rows[$i]['href']; echo $attributes->rows[$i]['name']; 
              $sql_prote .= " 
              ('".escape($attributes->rows[$i]['absnum'])."', '".escape($attributes->rows[$i]['prop_id'])."', '".escape($attributes->rows[$i]['value_id'])."', '".escape($attributes->rows[$i]['page_absnum'])."', '".escape($attributes->rows[$i]['approved'])."', '".escape($attributes->rows[$i]['filter'])."', '".escape($attributes->rows[$i]['attribute'])."')";

              if($i+1<count($attributes->rows) && $i+1!=$j){
                $sql_prote .= ", ";
              }
              
           } 
        } 
        getQuery($sql_prote, $db_prote);
     
      } 

      /*foreach ($attributes->rows as $key => $value) {
        //$sql_prote = "INSERT INTO vm.`axapta_props` SET 
        $sql_prote = "INSERT INTO `axapta_props` SET absnum = '".escape($value['absnum'])."', prop_id = '".escape($value['prop_id'])."', value_id = '".escape($value['value_id'])."', page_absnum = '".escape($value['page_absnum'])."', approved = '".escape($value['approved'])."', filter = '".escape($value['filter'])."', attribute = '".escape($value['attribute'])."'";
        getQuery($sql_prote, $db_prote);
      }*/
    }

    $sql_vm = "SELECT * FROM `axapta_values_names` WHERE langid<3";
    $axapta_values_names = getQuery($sql_vm, $db_vm);

    if($axapta_values_names->rows){
      //$sql_prote = 'TRUNCATE TABLE vm.`axapta_props_names`';
      $sql_prote = 'TRUNCATE TABLE `axapta_values_names`';
      getQuery($sql_prote, $db_prote);

      echo "Перенос таблицы axapta_values_names\n";
      foreach ($axapta_values_names->rows as $key => $value) {
        //$sql_prote = "INSERT INTO vm.`axapta_props_names` SET 
        $sql_prote = "INSERT INTO `axapta_values_names` SET 
        id = '".escape($value['id'])."', 
        value_id = '".escape($value['value_id'])."', 
        name = '".escape($value['name'])."', 
        langid = '".escape($value['langid'])."',
         uri = '".escape($value['uri'])."'";
        getQuery($sql_prote, $db_prote);
      }
    }
    

    $sql_vm = "SELECT * FROM `axapta_props_names` WHERE langid<3";
    $attributes_table = getQuery($sql_vm, $db_vm);

    if($attributes_table->rows){
      //$sql_prote = 'TRUNCATE TABLE vm.`axapta_props_names`';
      $sql_prote = 'TRUNCATE TABLE `axapta_props_names`';
      getQuery($sql_prote, $db_prote);

      echo "Перенос таблицы axapta_props_names\n";
      foreach ($attributes_table->rows as $key => $value) {
        //$sql_prote = "INSERT INTO vm.`axapta_props_names` SET 
        $sql_prote = "INSERT INTO `axapta_props_names` SET prop_id = '".escape($value['prop_id'])."', name = '".escape($value['name'])."', langid = '".escape($value['langid'])."', tip = '".escape($value['tip'])."', uri = '".escape($value['uri'])."'";
        getQuery($sql_prote, $db_prote);
      }
      ///////////////////////////
      echo "Обновление аттрибутов в oc_attribute\n";
      $sql_prote="INSERT INTO `oc_attribute` (attribute_id, attribute_group_id, sort_order, updated, ext_attribute_id)
                SELECT distinct CAST(substr(prop_id, 3,10) AS SIGNED) AS ID, 1, 0, now(), prop_id
                  FROM  `axapta_props_names` apn
                  ON DUPLICATE KEY UPDATE updated = now(), ext_attribute_id= prop_id"; 
                  //FROM  vm.`axapta_props_names` apn"; 
      
      getQuery($sql_prote, $db_prote);

      //////////////////////////
      echo "Обновление описаний в oc_attribute_description\n";
      //$sql_prote="INSERT INTO `oc_attribute_description` (attribute_id, language_id, name) SELECT CAST(substr(prop_id, 3, 10) AS SIGNED) AS ID, langid, name FROM vm.`axapta_props_names` apn ON DUPLICATE KEY UPDATE `name`=apn.`name`"; 
      $sql_prote="INSERT INTO `oc_attribute_description` (attribute_id, language_id, name) SELECT CAST(substr(prop_id, 3, 10) AS SIGNED) AS ID, langid, name FROM `axapta_props_names` apn ON DUPLICATE KEY UPDATE `name`=apn.`name`"; 
      getQuery($sql_prote, $db_prote);

      //////////////////////////
      echo "Обновление группы фильтов  в oc_filter_group\n";
      /*$sql_prote="INSERT IGNORE INTO `oc_filter_group` (filter_group_id, sort_order)
              SELECT distinct CAST(substr(prop_id, 3,10) AS SIGNED) AS ID,  0,
               FROM  `axapta_props_names` apn";*/
               //FROM  vm.`axapta_props_names` apn";
      $sql_prote="INSERT INTO `oc_filter_group` (filter_group_id, sort_order,updated,ext_filter_group_id)
              SELECT distinct CAST(substr(prop_id, 3,10) AS SIGNED) AS ID,  0, now(), prop_id
               FROM  `axapta_props_names` apn 
               ON DUPLICATE KEY UPDATE updated = now(), ext_filter_group_id= prop_id" ;
               //duplicate
               //FROM  vm.`axapta_props_names` apn";
      getQuery($sql_prote, $db_prote);
      

      //////////////////////////
      echo "Обновление описание групп фильтров в oc_filter_group_description\n";
      $sql_prote="INSERT INTO `oc_filter_group_description`(filter_group_id, language_id, name, updated) SELECT CAST(substr(prop_id, 3, 10) AS UNSIGNED) AS ID, langid, apn.name, now() ";
      //$sql_prote.=" FROM vm.`axapta_props_names` apn ";
      $sql_prote.=" FROM `axapta_props_names` apn ";
      $sql_prote.=" LEFT JOIN oc_filter_group_description fd ON fd.filter_group_id=CAST(substr(prop_id, 3, 10) AS UNSIGNED) AND apn.langid = fd.language_id
          WHERE apn.langid<>0 
          ON DUPLICATE KEY UPDATE `name`=apn.`name`, updated=now()";
      getQuery($sql_prote, $db_prote);

    }
}    

function updateAxaptaFiles(){
  // Копируем документы 
  echo "Обновление документов в axapta_files\n";
  global $db_vm;
  global $db_prote;
  $sql_vm = "SELECT * FROM `axapta_files` WHERE status='1'";
  $files  = getQuery($sql_vm, $db_vm);
  
  if($files->rows){
    $sql_prote="TRUNCATE TABLE `axapta_files`";
    getQuery($sql_prote, $db_prote);
    
    foreach ($files->rows as $key => $value) {
      $sql_prote="INSERT INTO `axapta_files` SET absnum = '".escape($value['absnum'])."', file = '".escape($value['file'])."', type = '".escape($value['type'])."', name = '".escape($value['name'])."', alias = '".escape($value['alias'])."', langid = '".escape($value['langid'])."',
        ax_filename = '".escape($value['ax_filename'])."'";

      getQuery($sql_prote, $db_prote);
    }
  }
}

function refresh_brainyfilter_cache() {
  //require_once('/var/www/prote/data/www/prote.ua/config.php');
  $username = 'gdemon';
  $password = 'demon68510';
  $apiKey = 'get_api';
  $domen = HTTPS_SERVER_ADMIN;
  //new url
  $loginUrl = $domen.'index.php?route=common/login/';
  $ch = curl_init();
  print_r($loginUrl);
  curl_setopt($ch, CURLOPT_URL, $loginUrl);
  curl_setopt($ch, CURLOPT_POST, true );
  // follows a location header redirect
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'username='.$username.'&password='.$password.'&apiKey='.$apiKey);
  curl_setopt($ch , CURLOPT_COOKIEJAR, DIR_ROOT.'exec/cookies.txt');
  curl_setopt($ch , CURLOPT_COOKIEFILE, DIR_ROOT.'exec/cookies.txt');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
  $response = json_decode(curl_exec( $ch )); 
  print_r(curl_error($ch));
  if(curl_errno($ch)){
    print_r(curl_error($ch));
      throw new Exception(curl_error($ch));
  }
  print_r($response);
  $token = $response->token;
  echo "\nToken = ".$token."\n";

  if($response->token){
    // чистим кеш фильтра

    $loginUrl = $domen.'index.php?route=module/brainyfilter/refresh&token='.$token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $loginUrl);
    curl_setopt($ch , CURLOPT_COOKIEJAR, DIR_ROOT.'exec/cookies.txt');
    curl_setopt($ch , CURLOPT_COOKIEFILE, DIR_ROOT.'exec/cookies.txt');
    //$response = curl_exec( $ch ); 
    curl_exec( $ch ); 
    echo "\nКеш brainyfilter очищен!\n";
    //curl_close($ch); 
    // генерируем сео-текст
    $loginUrl = $domen.'index.php?route=catalog/product/seoshild_generate_seotext&token='.$token;
    //$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $loginUrl);
    curl_setopt($ch , CURLOPT_COOKIEJAR, DIR_ROOT.'exec/cookies.txt');
    curl_setopt($ch , CURLOPT_COOKIEFILE, DIR_ROOT.'exec/cookies.txt');
    curl_exec( $ch ); 
    //echo "\nСео-текст сгенерирован!\n";
    //Создание УРЛ фильтров
    $loginUrl = $domen.'index.php?route=catalog/product/make_filters&token='.$token;
    curl_setopt($ch, CURLOPT_URL, $loginUrl);
    curl_setopt($ch , CURLOPT_COOKIEJAR, DIR_ROOT.'exec/cookies.txt');
    curl_setopt($ch , CURLOPT_COOKIEFILE, DIR_ROOT.'exec/cookies.txt');
    curl_exec( $ch ); 
    echo "\nУРЛ для фильтров созданы!\n";
    //print_r($response);
    curl_close($ch); 

    //echo "\n" . 'Cгенерирован seo_text!';
    return 'ok';
  }

}

function getQuery($sql,$link) {
  $query = $link->query($sql);
  //file_put_contents(DIR_ROOT.'cron/logs/prote_sql_'.Date('Y-m-d h').'.log', ''.Date('Y-m-d h:i:s').' - sql = '.$sql. "<\n", FILE_APPEND);
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
function ru2Lat($string) {
  $string=str_replace(array('+'),array('-плюс'),$string);
  $rus = array('ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я',' ', '.','+','(',')','/','\\',chr(34),chr(39),'?','№','&','!', '*', '|', ':');
  $lat = array('yo','zh','tc','ch','sh','sh','yu','ya','yo','zh','tc','ch','sh','sh','yu','ya', '-', '', '', '','', '', '', '', '', '','N','','','x','','');
  $string = str_replace($rus,$lat,$string);
  $string = str_ireplace(
  array('А','Б','В','Г','Д','Е','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ъ','Ы','Ь','Э','а','б','в','г','д','е','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ъ','ы','ь','э'),
  array('a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e','a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e'),
  $string);

  $string = str_ireplace('--','-', $string);
  return strtolower ($string);
}

///////////////////////////////
// новая функция копирования файлов и изображений
// gdemon 2020.02.26
///////////////////////////////
function getFiles(){
  require_once(DIR_ROOT.'cron/connect.php');
}
