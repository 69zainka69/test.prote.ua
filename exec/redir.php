<?

if (!empty($_GET['code'])) {
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
  

	$sSQL="select * from oc_product where mpn='".mysql_real_escape_string($_GET['code'])."'";
  $res=mysql_query($sSQL, $dbcnx);
  $row=mysql_fetch_array($res);  
	if (!empty($row['product_id'])) { 
		// $r = sunsite('make_article',$r);
        
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: https://prote.com.ua/index.php?route=product/product&product_id=".$row['product_id']); 
		exit();
	} else {
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: https://prote.com.ua"); 
		exit();
	}
} else {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: https://prote.com.ua"); 
	exit();
}