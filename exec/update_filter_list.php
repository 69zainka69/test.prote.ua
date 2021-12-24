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



$sSQL="select * from repeat_url
left join oc_url_alias using (keyword)
where keyword like 'f%'";

if (!($f=mysql_query($sSQL, $dbcnx))) throw new Exception('MySQL error: ' .  $sSQL);
    $i=0;
    while ($row = mysql_fetch_array($f)) {
        $i++;
    }
echo $i;