<?php


function ru2Lat($string)
{
$rus = array('ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я',' ', '.','+','(',')','/','\\',chr(34),chr(39));
$lat = array('yo','zh','tc','ch','sh','sh','yu','ya','yo','zh','tc','ch','sh','sh','yu','ya', '-', '', '', '','', '', '', '', '');
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


    if (!$dbcnx) // Если дескриптор равен 0 соединение не установлено
    {
      echo("<P>В настоящий момент сервер базы данных не доступен, поэтому
               корректное отображение страницы невозможно.</P>");
      exit();
    }
    $sSQL="
      SELECT *
      FROM `oc_url_alias`
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

      while ($article = mysql_fetch_array($art))
      {
         $convtext=ru2lat($article['keyword']);
         if ($convtext!=$article['keyword']) {
         $sSQL="
            update `oc_url_alias`
            set `keyword`='".$convtext."'
            where `url_alias_id`='".$article['url_alias_id']."'";
         // echo $article['keyword'],':';
         // echo $sSQL;  $q++;
         if (mysql_query($sSQL)) { $q++; echo '<p>',$convtext,"\n"; }
         }


      }

    }
    echo 'Обновлено', $q;
    // Закрываем
    if(mysql_close($dbcnx)) // разрываем соединение
    {
      echo("Соединение с базой данных прекращено");
    }
    else
    {
      echo("Не удалось завершить соединение");
    }
?>