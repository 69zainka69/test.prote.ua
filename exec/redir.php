<?

if (!empty($_GET['code'])) {
  // ���������� � ��
  $dblocation = "127.0.0.1"; // ��� �������
  $dbuser = "root";          // ��� ������������
  $dbpasswd = "RooT";            // ������
  $dbname = "prote";         // ��� ���� ������ ��� Prote  
  
  $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
  
  if (!$dbcnx) // ���� ���������� ����� 0 ���������� �� �����������
  {
    echo("<P>� ��������� ������ ������ ���� ������ �� ��������, �������
             ���������� ����������� �������� ����������.</P>");
    exit();
  }
  
   if (!@mysql_select_db($dbname, $dbcnx))
  {
    echo( "<P>� ��������� ������ ���� ������ �� ��������, �������
              ���������� ����������� �������� ����������.</P>" );
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