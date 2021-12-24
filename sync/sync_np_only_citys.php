<?php

define('DIR', '/var/www/prote/data/www/prote.ua/');

require DIR.'/cron/dist/NovaPoshtaApi2/Delivery/NovaPoshtaApi2.php';
require DIR.'/config.php';
require DIR.'/system/library/db/mysqli.php';
$db = new DB\MySQLi(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

$np = new LisDev\Delivery\NovaPoshtaApi2('8099937aaa3a0b74ffd733c01e8e0a4c');


// получаем города
$total = 0;
$page = 0;
$cities = null;

do {
	$request = $np->getSettlements($page);
	$cities['data'][] = $request['data'];
	foreach($request['data'] as $data) {
		$cities['data'][] = $data;
	}
	$page++;
	$total = $request['info']['totalCount'];
	echo "total : $total \n";
	echo "count data : " . count($cities['data']) . "\n";
	echo "page : $page \n"; 
} while ($total > count($cities['data']));


foreach ($cities['data'] as $city) {

	$sql = "
	INSERT INTO citys 
	SET 
		nameUa =  '" . $db->escape($city['Description']) . "',
		nameRu = '" . $db->escape($city['DescriptionRu']) . "',
		novaPoshtaRef = '" . $db->escape($city['Ref']) . "',
		regionRef = '" . $db->escape($city['Region']) . "',
		regionNameUa = '" . $db->escape($city['RegionsDescription']) . "',
		regionNameRu = '" . $db->escape($city['RegionsDescriptionRu']) . "',
		areaRef = '" . $city['Area'] . "',
		hasNpWarehouse = '" . $city['Warehouse'] . "',
		coatsu = '" . $city['IndexCOATSU1'] . "',
		longitude = '" . $db->escape($city['Longitude']) . "',
		latitude = '" . $db->escape($city['Latitude']) . "'";
		if(!$db->query($sql)) {
			$sql = "
			UPDATE INTO citys 
			SET 
				nameUa =  '" . $db->escape($city['Description']) . "',
				nameRu = '" . $db->escape($city['DescriptionRu']) . "',
				novaPoshtaRef = '" . $db->escape($city['Ref']) . "',
				regionRef = '" . $db->escape($city['Region']) . "',
				regionNameUa = '" . $db->escape($city['RegionsDescription']) . "',
				regionNameRu = '" . $db->escape($city['RegionsDescriptionRu']) . "',
				areaRef = '" . $city['Area'] . "',
				hasNpWarehouse = '" . $city['Warehouse'] . "',
				coatsu = '" . $city['IndexCOATSU1'] . "',
				longitude = '" . $db->escape($city['Longitude']) . "',
				latitude = '" . $db->escape($city['Latitude']) . "'
				
			WHERE nameUa =  '" . $db->escape($city['Description']) . "'";
			$db->query($sql);
		}
		
}

exit;
