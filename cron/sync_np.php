<?php

define('DIR', '/var/www/prote/data/www/prote.ua/');

require DIR.'/cron/dist/NovaPoshtaApi2/Delivery/NovaPoshtaApi2.php';
require DIR.'/config.php';
require DIR.'/system/library/db/mysqli.php';
$db = new DB\MySQLi(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

$np = new LisDev\Delivery\NovaPoshtaApi2(KEY_NP);

// получаем города
$cities = $np->getCities();

$sql = "UPDATE np_citys SET upd = 0";
$sql = "UPDATE np_wh SET upd = 0";
$db->query($sql);
$c=0;
foreach ($cities['data'] as $key => $city) {
	
		$sql = "INSERT INTO np_citys SET region_id = (SELECT id FROM `np_regions` WHERE np_ref = '" . $db->escape($city['Area']) . "'), name_1 =  '" . $db->escape($city['Description']) . "', name_2 = '" . $db->escape($city['DescriptionRu']) . "', np_id = '" . (int)$city['CityID'] . "', np_ref = '" . $db->escape($city['Ref']) . "', np_pref = '" . $db->escape($city['Area']) . "', upd = 1, `show` = 1, postomat ='" . $db->escape($city['Postomat']) . "'ON DUPLICATE KEY UPDATE region_id = (SELECT id FROM `np_regions` WHERE np_ref = '" . $db->escape($city['Area']) . "'), name_1 =  '" . $db->escape($city['Description']) . "', name_2 = '" . $db->escape($city['DescriptionRu']) . "', np_id = '" . (int)$city['CityID'] . "', np_ref = '" . $db->escape($city['Ref']) . "', np_pref = '" . $db->escape($city['Area']) . "', `show` = 1, upd = 1, postomat ='" . $db->escape($city['Postomat']) . "'"; $db->query($sql);
	//	echo $city['Description']."		";

		// получаем отделения
		$warehouse = $np->getWarehouses($city['Ref']);

		foreach ($warehouse['data'] as $house) {
			echo $house['Description']."<br>";
			$sql="INSERT INTO np_wh SET city_id = (SELECT id FROM `np_citys` a WHERE a.np_ref = '" . $db->escape($city['Ref']) . "'), name_1 = '".$db->escape($house['Description'])."', name_2 = '".$db->escape($house['DescriptionRu'])."', name_3 = '".$db->escape($house['DescriptionRu'])."', number = '".$db->escape($house['Number'])."', np_city_id = (SELECT np_id FROM `np_citys` a WHERE a.np_ref = '" . $db->escape($city['Ref']) . "'), np_ref = '".$db->escape($house['Ref'])."', np_city_ref = '".$db->escape($house['CityRef'])."', np_phone = '".(int)$house['Phone']."', np_x = '".$db->escape($house['Longitude'])."', np_y = '".$db->escape($house['Latitude'])."', `show` = 1, `upd` =1 ON DUPLICATE KEY UPDATE city_id = (SELECT id FROM `np_citys` a WHERE a.np_ref = '" . $db->escape($city['Ref']) . "'), name_1 = '".$db->escape($house['Description'])."', name_2 = '".$db->escape($house['DescriptionRu'])."', name_3 = '".$db->escape($house['DescriptionRu'])."', number = '".$db->escape($house['Number'])."', np_city_id = (SELECT np_id FROM `np_citys` a WHERE a.np_ref = '" . $db->escape($city['Ref']) . "'), np_ref = '".$db->escape($house['Ref'])."', np_city_ref = '".$db->escape($house['CityRef'])."', np_phone = '".(int)$house['Phone']."', np_x = '".$db->escape($house['Longitude'])."', np_y = '".$db->escape($house['Latitude'])."', `show` = 1, `upd` =1 ";

			$db->query($sql);
			echo $house['Description'].";";
		}
		echo "\n";
	
}
// отключаем не обновленніе города и отделения
$sql = "UPDATE np_citys SET show = 0 WHERE upd = 0";
$sql = "UPDATE np_wh SET show = 0 WHERE upd = 0";

echo 'обновление НП віполнено';


exit;
