<?php


function ru2Lat($string)
{
$rus = array('ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я',' ', '.','+','(',')','/','\\',chr(34),chr(39),',', '?','№','&');
$lat = array('yo','zh','tc','ch','sh','sh','yu','ya','yo','zh','tc','ch','sh','sh','yu','ya', '-', '', '', '','', '', '', '', '','', '', 'N', '');
$string = str_replace($rus,$lat,$string);
$string = str_ireplace(
array('А','Б','В','Г','Д','Е','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ъ','Ы','Ь','Э','а','б','в','г','д','е','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ъ','ы','ь','э'),
array('a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e','a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e'),
$string);

$string = str_ireplace('--','-', $string);
return strtolower ($string);
}

    // Со
    $dblocation = "127.0.0.1"; // Имя сервера
    $dbuser = "root";          // Имя пользователя
    $dbpasswd = "RooT";            // Пароль
    $dbname = "prote";
    $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);

    $vmcat= '3282';

    $vmcats=array(
       //'3277'=> '53',   // Фотобумага
       //'3286'=> '22',
       //'3275'=> '51',   // Офисная бумага
       '3281'=> '31',   // Картриджи и тонер-картриджи
       //'3282'=> '21'    // Картриджи струйные
    );



    if (!$dbcnx) // Если дескриптор равен 0 соединение не установлено
    {
      echo("<P>В настоящий момент сервер базы данных не доступен, поэтому
               корректное отображение страницы невозможно.</P>");
      exit();
    }
    $sSQL="
      SELECT *
      FROM `oc_product_description` a
      join `oc_product` b on a.product_id=b.product_id
      where a.language_id=1 
    ";


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
      $q=0;
      $currentAbsnum=0;

      while ($article = mysql_fetch_array($art))
      {
         // $seftext=substr(ru2Lat($article['name']),0,50).'-'.$article['sku'];
         $seftext=trim(ru2Lat(trim(mb_substr($article['name'], 0, 50, 'UTF-8'))),'-').'-'.$article['sku'];
        $sSQL="
               select * from `oc_url_alias`
               where `query`='product_id=".$article['product_id']."'
            ";
         
         // mysql_query($sSQL);
         if (!($f=mysql_query($sSQL,$dbcnx))) throw new Exception('MySQL error' . $sSQL);
         
         if (mysql_num_rows($f)==0) {
            
         $sSQL="
            insert into `oc_url_alias` values
            (0, 'product_id=".$article['product_id']."','".$seftext."')
          ";
         // if (strpos($seftext, '--')) { 
         // if (mysql_query($sSQL)) { $q++; echo '<p>',$seftext,"\n"; }
         echo "\n".$seftext;
//          echo "\n".mb_substr($article['name'], 0, 50, 'UTF-8');
//          echo "\n".ru2Lat(trim(mb_substr($article['name'], 0, 50, 'UTF-8')));
        
         
         // }
         $q++;
         }
      }

    }
    echo 'Добавлено', $q;
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