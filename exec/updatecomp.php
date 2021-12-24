<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Соединение с БД
$dblocation = "127.0.0.1"; // Имя сервера
$dbuser = "root";          // Имя пользователя
$dbpasswd = "RooT";            // Пароль
$dbname = "prote";         // Имя базы данных для Prote
$dbnamevm = "vm";          // Имя базы данных для vm

$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
$dbvmx = @mysql_connect($dblocation,$dbuser,$dbpasswd, 1);

if (!$dbcnx || !$dbcnx) // Если дескриптор равен 0 соединение не установлено
{
  echo("<P>В настоящий момент сервер базы данных не доступен, поэтому
           корректное отображение страницы невозможно.</P>");
  exit();
}

 if (!@mysql_select_db($dbname, $dbcnx) || !@mysql_select_db($dbnamevm, $dbvmx))
{
  echo( "<P>В настоящий момент база данных не доступна, поэтому
            корректное отображение страницы невозможно.</P>" );
  exit();
}

$a=mysql_set_charset ('utf8', $dbcnx);
$a=mysql_set_charset ('utf8', $dbvmx);

// Очищаем таблицу совместимости
$sSQL="TRUNCATE `oc_product_compability`";
mysql_query($sSQL, $dbcnx);

// Копируем данные из БД ВМ
$sSQL="insert into `oc_product_compability` (SELECT *, 0, 0 from vm.`axapta_compability`)";
mysql_query($sSQL, $dbcnx);

// Строим переходную таблицу absnum-product_id
$sSQL="select product_id, upc from `oc_product`";
$abstab=array();    
if($absnums=mysql_query($sSQL, $dbcnx)) {
    while ($absrow = mysql_fetch_array($absnums)) {       
       $abstab[$absrow['upc']]=$absrow['product_id']; 
    }    
}    

// Получение списка уникальных номеров товаров (АХ)
$sSQL="SELECT DISTINCT absnum FROM `oc_product_compability`";
if($absnums=mysql_query($sSQL, $dbcnx)) {

    while ($absrow = mysql_fetch_array($absnums)) {
        if (isset($abstab[$absrow['absnum']])) {
            $sSQL="UPDATE `oc_product_compability` SET product_id='".$abstab[$absrow['absnum']]."' WHERE absnum='".$absrow['absnum']."'";
            mysql_query($sSQL, $dbcnx);
            $sSQL="UPDATE `oc_product_compability` SET child_product_id='".$abstab[$absrow['absnum']]."' WHERE child_absnum='".$absrow['absnum']."'";
            mysql_query($sSQL, $dbcnx);
        }   
    }
 }
 // Удаляем строки с неопределенными продуктами
 $sSQL="DELETE FROM `oc_product_compability` WHERE `product_id`=0 OR `child_product_id`=0";
 mysql_query($sSQL, $dbcnx);
 echo 'Compability table was build!'."\n";