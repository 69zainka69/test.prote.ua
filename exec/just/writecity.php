<?php
$time_start = microtime(true);





ini_set("memory_limit","512M");
//echo ini_get("memory_limit");
ini_set('max_execution_time', 600003);
require_once('/var/www/prote/data/www/prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}

$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");


 



mb_internal_encoding("UTF-8");
        $url = "https://api.justin.ua/justin_pms/hs/v2/runRequest";
        $today = date("Y-m-d");
        $pass = '$*PSN2$f';
        $strr = $pass.":".$today;
        $str = sha1($strr);
        $data = new \stdClass();
        $data->keyAccount = "TOV_VM";
        $data->sign = $str;
        $data->request = "getData";
        $data->type = "catalog";
        $data->name = "cat_Cities";
        $data->language = "UA";



      
$content = json_encode($data);
$data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
$curl = curl_init('https://api.justin.ua/justin_pms/hs/v2/runRequest');
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($curl);
$re = json_decode($result);
curl_close($curl);
$i=0;
//var_dump($re->codeError);
$count = count($re->data);

mb_internal_encoding("UTF-8");
        $url = "https://api.justin.ua/justin_pms/hs/v2/runRequest";
        $today = date("Y-m-d");
        $pass = '$*PSN2$f';
        $strr = $pass.":".$today;
        $str = sha1($strr);
        $data = new \stdClass();
        $data->keyAccount = "TOV_VM";
        $data->sign = $str;
        $data->request = "getData";
        $data->type = "catalog";
        $data->name = "cat_Cities";
        $data->language = "RU";

      
$content = json_encode($data);
$data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
$curl = curl_init('https://api.justin.ua/justin_pms/hs/v2/runRequest');
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Content-Length: ' . strlen($data_string))
);
$resultin = curl_exec($curl);
$res = json_decode($resultin);
curl_close($curl);

$sql = "TRUNCATE TABLE just_citys ";
$dbcnx->query($sql);


for ($i = 0; $i <= $count-1; $i++) {
    $city[$i] = $re->data[$i];
    $citys[$i] = $res->data[$i];
    $name = $city[$i]->fields->descr;
    $nameru = $citys[$i]->fields->descr;
    $just_ref = $city[$i]->fields->uuid;


    $r = $city[$i]->fields->objectOwner->descr;

  
if ($r=="Дніпропетровська"){
        $region=1;
}
if ($r=="Донецька"){
        $region=2;
}
if ($r=="Запорізька"){
        $region=3;
}
if ($r=="Київська"){
        $region=4;
}
if ($r=="Полтавська"){
        $region=5;
}
if ($r=="Луганська"){
        $region=6;
}
if ($r=="Львівська"){
        $region=7;
}
if ($r=="Миколаївська"){
        $region=8;
}
if ($r=="Одеська"){
        $region=9;
}
if ($r=="АРК"){
        $region=10;
}
if ($r=="Харківська"){
        $region=11;
}
if ($r=="Херсонська"){
        $region=12;
}
if ($r=="Хмельницька"){
        $region=13;
}
if ($r=="Вінницька"){
        $region=14;
}
if ($r=="Рівненська"){
        $region=15;
}
if ($r=="Тернопільська"){
        $region=16;
}
if ($r=="Чернівецька"){
        $region=17;
}
if ($r=="Житомирська"){
        $region=18;
}
if ($r=="Волинська"){
        $region=19;
}
if ($r=="Сумська"){
        $region=20;
}
if ($r=="Чернігівська"){
        $region=21;
}
if ($r=="Івано-Франківська"){
        $region=22;
}
if ($r=="Кіровоградська"){
        $region=23;
}
if ($r=="Черкаська"){
        $region=24;
}
if ($r=="Закарпатська"){
        $region=25;
}


$sql = "INSERT INTO just_citys (name_1, name_2, region_id, just_ref) VALUES ('$name', '$nameru', '$region', '$just_ref')";
$dbcnx->query($sql);
}

echo "DONE!!!";

?>