<?php 
if (!function_exists('translit')) {
function translit($str_in) {
	$repls=array(
		'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ё'=>'e', 'ж'=>'j', 'з'=>'z', 'и'=>'i', 'й'=>'j', 'к'=>'k', 'л'=>'l',
		'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p', 'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f',
		'х'=>'h', 'ц'=>'c', 'ч'=>'ch', 'ш'=>'sh', 'щ'=>'sch','ь'=>'','ъ'=>'','ы'=>'y', 'э'=>'e', 'ю'=>'u', 'я'=>'ja',
		'!'=>'', '@'=>'', '#'=>'', '$'=>'', '%'=>'', '^'=>'', '&'=>'', '*'=>'',
		'('=>'', ')'=>'', 
		'='=>'', '.'=>'', ','=>'', '?'=>'', '/'=>'-', "+" => '-', 
		'\\'=>'-', '|'=>'', '"'=>'', "'"=>'', ' '=>'-', '"'=>'',"\""=>'',"'"=>'',"&quot;"=>'',"quot;"=>'',"<br/>"=>''
	);

	$str_in=mb_strtolower($str_in,'UTF-8');
	//echo $str_in;
	//$str_in = html_entity_decode($str_in, ENT_QUOTES, 'UTF-8');
	$str_out=strtr($str_in,$repls);

	$str_out= str_replace("----", "-", $str_out);
	$str_out= str_replace("---", "-", $str_out);
	$str_out= str_replace("--", "-", $str_out);
	/*if(substr($str_out, -1)=='-'){
		$str_out = substr($str_out,0,-1).'<br/>';
	}*/
	return $str_out;
}
}
if (!function_exists('ru2Lat')) {
	function ru2Lat($string) {
		$string=str_replace(array('+'),array('-плюс'),$string);
		$rus = array('ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я',' ', '.','+','(',')','/','\\',chr(34),chr(39),'?','№','&');
		$lat = array('yo','zh','tc','ch','sh','sh','yu','ya','yo','zh','tc','ch','sh','sh','yu','ya', '-', '', '', '','', '', '', '', '', '','N','');
		$string = str_replace($rus,$lat,$string);
		$string = str_ireplace(
		array('А','Б','В','Г','Д','Е','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ъ','Ы','Ь','Э','а','б','в','г','д','е','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ъ','ы','ь','э'),
		array('a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e','a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e'),
		$string);

		$string = str_ireplace('--','-', $string);
		return strtolower ($string);
	}
}