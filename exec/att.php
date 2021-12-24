<?php
    die();
    // Со
    $dblocation = "127.0.0.1"; // Имя сервера
    $dbuser = "root";          // Имя пользователя
    $dbpasswd = "RooT";            // Пароль
    $dbname = "prote";
    $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);


    if (!$dbcnx) // Если дескриптор равен 0 соединение не установлено
    {
      echo("<P>В настоящий момент сервер базы данных не доступен, поэтому
               корректное отображение страницы невозможно.</P>");
      exit();
    }

    $occat=33;

    $sSQL="
      SELECT *
      FROM `oc_product` p, `oc_product_to_category` c
      WHERE p.product_id=c.product_id AND c.category_id='".$occat."'";

    $o=0;

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

      while ($article = mysql_fetch_array($art))
      {
         foreach ($langcodes as $key => $lcode) {
           $sSQL ="
             SELECT *
             FROM `axapta_props` p
             left join `axapta_values_names` v on v.value_id=p.value_id AND langid='".$key."'
             left join `ax_to_oc_prop` ax on ax.prop_id=p.prop_id
             WHERE absnum='".$article['upc']."'
             having v.value_id is not null
           ";

           $aprops = mysql_query($sSQL);
           echo '<p>' .  $article['upc'] . '====';
           // Вставляем аттрибуты!
           while ($aprop = mysql_fetch_array($aprops)) {
               $sSQL = "insert `oc_product_attribute` values ('" . $article['product_id'] . "', '" . $aprop['attribute_id'] . "', '" . $key . "', '" . $aprop['name'] ."')";
               // echo $sSQL;
               // if ($ap = mysql_query($sSQL)) $o++;;
               // Вставить фильтры!!
               //
               $sSQL = "
               select *
               from `oc_filter_description`
               where filter_group_id='" . $aprop['attribute_id'] . "' AND
               language_id='" . $key . "' AND
               name='" . $aprop['name'] . "'";
               // echo $sSQL;
               $afilters = mysql_query($sSQL);

               while ($afilter = mysql_fetch_array($afilters)) {
                  $sSQL = "insert IGNORE `oc_product_filter` values ('" . $article['product_id'] . "', '" . $afilter['filter_id'] . "')";
                  // echo $sSQL;
                  $ap = mysql_query($sSQL);
                  echo $article['product_id'] . '-' . $afilter['filter_id'];
               }


           }
         }
      }

    }
    echo $o;
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