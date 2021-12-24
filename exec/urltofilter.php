<?php

// exit('!!!');

// Соединение с БД
$dblocation = "127.0.0.1"; // Имя сервера
$dbuser = "root";          // Имя пользователя
$dbpasswd = "RooT";            // Пароль
$dbname = "prote";         // Имя базы данных для Prote


$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);


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

$sSQL="SELECT * FROM `oc_landing_seo_data` ";

$flt=mysql_query($sSQL, $dbcnx);

while ($fltrow = mysql_fetch_array($flt)) {
    
    // Определяем параметры фильтра
    if (preg_match('/f(\d+)-.*\//', $fltrow['uri'], $matches)) {
        $filter_url=trim($matches[0],'/');
        $filter_group=$matches[1];
        
        // Расшифровка параметров фильтра
        $sSQL="SELECT `query` FROM oc_url_alias where `keyword`='".$filter_url."'";        
        $alias=mysql_query($sSQL, $dbcnx);
        $al=mysql_fetch_array($alias);
        // Ищем номер группы и фильтра
        // echo $al[0];
        preg_match('/:(\d+);/', $al[0], $matches);
        $filter_id=$matches[1]; 
        preg_match('/=f(\d+):/', $al[0], $matches);
        $filter_group_id_new=$matches[1]; 
        //echo $filter_group_id;
    }
    
    // Определяем категорию
    $segments=explode('/', str_replace($filter_url, '', $fltrow['uri']));
    $category=$segments[count($segments)-3];
    $sSQL="SELECT `query` FROM oc_url_alias where `keyword`='".$category."'"; 
    $alias=mysql_query($sSQL, $dbcnx);
    $al=mysql_fetch_array($alias);
    
    $category_id=str_replace('category_id=', '', $al[0]);
    
    // Код языка
    if (strpos($fltrow['uri'],'/ua/')!==FALSE) {
        $lang=2;
    } else {
        $lang=1;
    }
    // if ($category_id) continue;
    echo '<p>'.$fltrow['uri'], ': f-group:' ,$filter_group, ', f-id: ' ,$filter_id, ', category: ', $category_id,', lang:', $lang;
    // $sSQL="delete from `oc_landing_seo_data` where `id`=".$fltrow['id'];
    // if (mysql_query($sSQL, $dbcnx)) echo 'deleted!';
    if ($filter_group && $filter_id && $category_id) {
        // Создание записи в БД
        $sSQL="UPDATE `oc_filter_seo_data`
         SET  filter_group_id = ".$filter_group_id_new."  
         WHERE filter_group_id=".$filter_group." AND filter_id=".$filter_id." AND category_id=".$category_id." AND language_id=".$lang;
        // echo $sSQL;
        if (mysql_query($sSQL, $dbcnx)) echo 'updated!';
    }    
    
        
}