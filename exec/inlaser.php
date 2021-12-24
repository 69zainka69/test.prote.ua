<?php
    // Со
    $dblocation = "127.0.0.1"; // Имя сервера
    $dbuser = "root";          // Имя пользователя
    $dbpasswd = "RooT";            // Пароль
    $dbname = "prote";
    $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);

    $vmcat= '3282';

    $vmcats=array(
       '3277'=> '53',   // Фотобумага
       '3286'=> '22',
       '3275'=> '51',   // Офисная бумага
       '3281'=> '31',   // Картриджи и тонер-картриджи
       '3282'=> '21'    // Картриджи струйные
    );

$occats=array(
// '20' =>
'21' => array( '3282', 'Картриджи струйные'),
'22' => array( '3286', 'Чернила'),
'23' => array( '3287', 'СНПЧ'),
'24' => array( '3288', 'ПЗК'),
'25' => array( '3302', ''),
// ''30' => array('),
'31' => array( '3280,3281', 'Картриджи и тонер-картриджи'),  // 3281
'32' => array( '3290,3291', 'Тонер') , // '3291'  3290
'33' => array( '3292,3293', 'Фотобарабаны'),  // Добавить - 3293!
'34' => array( '3295', 'Валы и оболочки'),
'35' => array( '3296', 'Чипы и микросхемы'),
'36' => array( '3294', 'Лезвия'),
'37' => array( '3298', 'ЗЧ для лазерных'),
// ''40' => array('),
'41' => array( '3283', 'Картриджи и ленты для матричных принтеров'),
'42' => array( '3284', 'Пленки для факсов'),
// ''50' => array('),
'51' => array( '3275', 'Офисная бумага'),
'52' => array( '3276', 'Холсты'),
'53' => array( '3277', 'Фотобумага'),
'54' => array( '3278', 'Материалы для творчества'),
'55' => array( '6337', 'Самоклеющиеся этикетки'),
'56' => array( '6382', 'Ленты для кассовых'),
'57' => array( '6448', 'Наклейки для авто'),
// 60' => array('),
'61' => array( '6325', 'Аккустические колонки'),
'62' => array( '6323', ' Веб-камері'),
'63' => array( '6327', 'Наушники'),
'64' => array( '3316', 'Клавиатурі и наборі'),
'65' => array( '6328', 'USB хабы и адаптеры'),
'66' => array( '3312', 'Флеш-память'),
'67' => array( '3310', ' CD'),
'68' => array( '3319', 'Батарейки'),
'69' => array( '6434', 'Фильтры и удлинители'),
'70' => array( '6352', 'Батареи для ИБП'),
'71' => array( '3315', 'USB кабели и переходники'),
'72' => array( '6362', 'Мыши'),
'73' => array( '3318', 'Чистящие средства'),
'74' => array( '6341', 'Разное'),
'75' => array('6326', 'Карты памяти'),
//''80' => array('),
'81' => array( '3304', 'Струйные принтеры и МФУ'),
'82' => array( '3305', 'Лазерные принтеры и МФУ'),
'83' => array( '6412', 'Ламинатры и расходные'),
'84' => array( '6413', 'Биндеры и расходные'),
);

$occat='81';




    // Категории
    // $vmcat='3277'; // 3286'; //3275';
    // $occat='53'; //22'; // 51';
    // $vmcat='3286'; //3275';
    // $occat='22'; // 51';
    //$vmcat='3275';
    // $occat= '51';
    // Картриджи и тонер-картриджи

    $vmcat= $occats[$occat][0];
    //

    if (!$dbcnx) // Если дескриптор равен 0 соединение не установлено
    {
      echo("<P>В настоящий момент сервер базы данных не доступен, поэтому
               корректное отображение страницы невозможно.</P>");
      exit();
    }
    $sSQL="
      SELECT *
      FROM `articles` a
      WHERE `category` in (".$vmcat.") 
      ORDER by a.absnum, a.langid

    ";
    
    
    $langcodes=array(1=>'ru', 2=>'ua', 3=>'en');

    if (!@mysql_select_db($dbname, $dbcnx))
    {
      echo( "<P>В настоящий момент база данных не доступна, поэтому
                корректное отображение страницы невозможно.</P>" );
      exit();
    }

    $a=mysql_set_charset ('utf8', $dbcnx);


    $art = mysql_query($sSQL);

    if($art)
    {

      $currentAbsnum=0;

      while ($article = mysql_fetch_array($art))
      {
          if ($article['absnum']!=$currentAbsnum)
          {
             $currentAbsnum=$article['absnum'];
             $data[$currentAbsnum]=array(
                 'absnum'   => $article['absnum'],
                 'alias'    => $article['alias'],

                 'axapta_code' => $article['axapta_code'],
                 'axapta_article' => $article['axapta_article'],
                 'axapta_alias' => $article['axapta_alias'],
                 'price' => 0
                 );
          }
          if (isset($langcodes[$article['langid']]))
          {
            $langcode=($langcodes[$article['langid']]);
            $data[$currentAbsnum]['name_'.$langcode]=$article['title'];
            $data[$currentAbsnum]['description_'.$langcode]=$article['body'];
            $data[$currentAbsnum]['meta_title_'.$langcode]=$article['meta_title'];
            $data[$currentAbsnum]['meta_h1_'.$langcode]=$article['meta_h1'];
            $data[$currentAbsnum]['meta_keywords_'.$langcode]=$article['meta_keywords'];
            $data[$currentAbsnum]['meta_description_'.$langcode]=$article['meta_description'];
          }

      }
        echo '<pre>';
        // print_r($data);
        echo count($data);
        echo '</pre>';

        

      try {
      $ins=$upd=0;
      foreach ($data as $k => $d)
      {

          $imgdecode=substr($d['absnum']+'', 0, 3).'/'.(int)substr($d['absnum'], 3, 5);

          $sSQL="
          SELECT `product_id` FROM `oc_product`
          WHERE `sku`= '" . $d['axapta_article'] . "' AND `upc`='" . $d['absnum'] . "'";

          if (!($f=mysql_query($sSQL))) throw new Exception('MySQL error');

          if ($row = mysql_fetch_array($f)) {
              $lastid=$row['product_id'];
              // Обновление записи
              // ...
              $upd++;
          } else {
              // Создание записи в основнуй таблице
              $sSQL="
              INSERT `oc_product`
                (`sku`,`upc`, `status`,`price`,`image`,`date_added`)
              VALUES
                ('".$d['axapta_article']."',
                '".$d['absnum']."',
                1,
                ".$d['price'].",
                'img/article/".$imgdecode."_main.jpg',
                now())";

              if(!mysql_query($sSQL)) throw new Exception('MySQL error');
              $lastid=mysql_insert_id();
              $ins++;
          }




            echo '#';
            // Создание языкозависимых записей
            foreach ($langcodes as $kode => $lcode)
            {
              if(isset($d['name_'.$lcode]) OR
              isset($d['description_'.$lcode]) OR
              isset($d['meta_title_'.$lcode]) OR
              isset($d['meta_h1_'.$lcode]) OR
              isset($d['meta_description_'.$lcode]))
              {

                $sSQL="
                SELECT `product_id`, `language_id`
                FROM `oc_product_description`
                WHERE `product_id`='". $lastid ."' AND `language_id`='". $kode ."'";
                if(!($f=mysql_query($sSQL))) throw new Exception('MySQL error');
                if ($row = mysql_fetch_array($f)) {

                    // Обновление записи
                    // ...
                } else {


                // Создание языкозависимых записей
                $sSQL="
                INSERT `oc_product_description`
                SET
                  `product_id`=".$lastid.",
                  `language_id`=".$kode.",
                  `name`='".mysql_real_escape_string(substr($d['name_'.$lcode], 0, 254))."',
                  `description`='".mysql_real_escape_string($d['description_'.$lcode])."',
                  `meta_title`='".mysql_real_escape_string(substr($d['meta_title_'.$lcode],0,254))."',
                  `meta_h1`='".mysql_real_escape_string(substr($d['meta_h1_'.$lcode],0,254))."',
                  `meta_description`='".mysql_real_escape_string(substr($d['meta_description_'.$lcode],0,254))."',
                  `meta_keyword`='".mysql_real_escape_string(substr($d['meta_keyword_'.$lcode],0,254))."'";

                if(!mysql_query($sSQL)) throw new Exception('MySQL error');
                }
              }
              }

              // Добавление изображений
              $imglist=array();
              $sSQL="SELECT * FROM `articles_gallery` where parent=".$d['absnum'];
              if($imgl=mysql_query($sSQL))
              {
                 while ($imgrow = mysql_fetch_array($imgl))
                 {
                    $imglist[]=array($imgrow['absnum'],$imgrow['position']);
                 }

                 foreach($imglist as $imgitem) {
                    $sSQL="
                        INSERT `oc_product_image`
                        SET
                        `product_id`=".$lastid.",
                        `image`='img/gallery/".$imgdecode."/".$imgitem[0]."_main.jpg',
                        `sort_order`=".$imgitem[1];
                    mysql_query($sSQL);

                 }
              }

              // Привязка к магазину
              $sSQL="
                  INSERT `oc_product_to_store`
                  SET
                  `product_id`=".$lastid.",
                  `store_id`=0";
              mysql_query($sSQL);

              // Привязка к категории
              $sSQL="
                  INSERT `oc_product_to_category`
                  SET
                  `product_id`=".$lastid.",
                  `category_id`=".$occat.",
                  `main_category`=0";
              mysql_query($sSQL);

            //



          

      }
    } catch (Exception $e) {
        echo "Исключение:", $e->getMessage(), "\n";
    }
    }
    echo $ins, 'inserted';
    echo $upd, 'updated';
    
    // Закрываем
    if(mysql_close($dbcnx)) // разрываем соединение
    {
      echo("Соединение с базой данных прекращено");
    }
    else
    {
      echo("Не удалось завершить соединение");
    }
    echo 'В категорию '.$occats[$occat][1].' ';
    echo 'Добавлено: '.count($data).' записей';
?>