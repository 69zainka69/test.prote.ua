<?php
/*echo "<pre>";
print_r(gd_info());
echo "</pre>";*/
$ar = array(
	1	=> '1',
	2	=> array(
		0 => '2',
		1 => '2.1',
		2 => '2.2',
		2 => '2.3',
	),
	3	=> array(
		1	=>  array(
				1 => '3.1.1',
				2 => '3.1.2',
				2 => '3.1.3',
			)
	)
);
function fun_print($ar, $key = 0, $level = 0){
	$level = 0;
	foreach ($ar as $key => $value) {
		if(is_array($value)){
			fun_print($value,$key,$level);
		} else {
			echo (" "*$level) .$value."<br>";
		}
		$level++;

	}

}
fun_print($ar);
//phpinfo();
