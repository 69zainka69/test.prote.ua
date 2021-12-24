<?php

const APIKEY = 'JmmYApKoMTavwWh6N0D4MdeT7vhxQMLEWkU0QirIxYh6egTEhlqOydTBPdptwaJH3apU6t0cUuJQelovHSY3vaDfTD0W20RyckueQIn15aWy4wdv12POIRLGcwtLNBqBvEDtAFKtwtw6wQit2nsnrvjsqTBvatYLeOzTpLbUMVkasK7aZCB72ERtkFqzuoKsaBufVYXwUPafT5soXUUyACFsiZPlQKlACCPzlpvVES6ecjhYTp7BB5SMQJnWtbiw';
const USERNAME = 'axapta';


$postData = [
    'username'=>USERNAME,
    'apiKey'=>APIKEY
];

$handle = curl_init('https://prote.ua/import/addtask.php?task=full');

curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($postData));

$response = curl_exec($handle);

if($response === false) {
    echo 'Ошибка curl: ' . curl_error($handle);
}
else {
    $json = json_decode($response);
    echo print_r($json, true);
}



