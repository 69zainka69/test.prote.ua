<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($_GET['cat']) {
// Соединение с БД
$dblocation = "127.0.0.1"; // Имя сервера
$dbuser = "root";          // Имя пользователя
$dbpasswd = "RooT";            // Пароль
$dbname = "prote";         // Имя базы данных для Prote
$dbnamevm = "vm";          // Имя базы данных для vm

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

echo $_GET['cat'];

$sSQL="
    SELECT DISTINCT filter_id
      FROM oc_product_to_category LEFT JOIN oc_product_filter USING (product_id)
    WHERE category_id IN (".$_GET['cat'].")";

$res=mysql_query($sSQL,$dbcnx);
$flist=array();
while ($row = mysql_fetch_array($res)) {
    if ($row['filter_id']) $flist[]=$row['filter_id'];
}

$flist=implode(',', $flist);

$sSQL='
    INSERT ignore INTO oc_filter (SELECT *
      FROM `oc_filter_20171117`
    WHERE filter_id IN ('.$flist.'))';

mysql_query($sSQL,$dbcnx);
echo 'filters:', mysql_affected_rows($dbcnx);

$sSQL='
    INSERT ignore INTO oc_filter_group (SELECT *
      FROM `oc_filter_group_20171117`
    WHERE filter_group_id IN (SELECT distinct filter_group_id
      FROM `oc_filter_20171117`
    WHERE filter_id in ('.$flist.')))';

mysql_query($sSQL,$dbcnx);
echo ' filter groups:', mysql_affected_rows($dbcnx)."\n";
// Закрываем
mysql_close($dbcnx);
}
