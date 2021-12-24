<?php
$time_start = microtime(true);
set_time_limit(208000);
ini_set('max_execution_time', 208000);
$idi=0;

function transliterate($st) {
        $st = strtr($st,
          "абвгдежзийклмнопрстуфыэАБВГДЕЖЗИЙКЛМНОПРСТУФЫЭ",
          "abvgdegziyklmnoprstufieABVGDEGZIYKLMNOPRSTUFIE"
        );
        $st = strtr($st, array(
          'ё'=>"yo",    'х'=>"h",  'ц'=>"ts",  'ч'=>"ch", 'ш'=>"sh",
          'щ'=>"shch",  'ъ'=>'',   'ь'=>'',    'ю'=>"yu", 'я'=>"ya",
          'Ё'=>"Yo",    'Х'=>"H",  'Ц'=>"Ts",  'Ч'=>"Ch", 'Ш'=>"Sh",
          'Щ'=>"Shch",  'Ъ'=>'',   'Ь'=>'',    'Ю'=>"Yu", 'Я'=>"Ya",
          'і'=>"i",    'ї'=>"ii",  'є'=>"e",  'І'=>"i",    'Ї'=>"ii",  'Є'=>"e",
        ));
        return $st;
      }
      
require_once('/var/www/prote/data/www/prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}

$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");

$sql = "TRUNCATE TABLE meest_citys ";
$dbcnx->query($sql);
$sql = "TRUNCATE TABLE meest_wh ";
$dbcnx->query($sql);

mb_internal_encoding("UTF-8");
        $url = "https://publicapi.meest.com/branches";
        $data = new \stdClass();
        $data->keyAccount = "TOV_VM";
 
$content = json_encode($data);
$data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
$curl = curl_init('https://publicapi.meest.com/branches');
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


$count = count($res->result);
$count = $count-1;
//$count = 20; //Добавить до 100-та отделений
$cityses=array();


for ($ii=0; $ii!=$count; $ii++ ){
        $nomerviddilen=$res->result[$ii]->num;
     
       // echo  $nomerviddilen;


mb_internal_encoding("UTF-8");
        $url = "https://publicapi.meest.com/branches/$nomerviddilen";
        $data = new \stdClass();
        $data->keyAccount = "TOV_VM";
    

      
$content = json_encode($data);
$data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
$curl = curl_init("https://publicapi.meest.com/branches/$nomerviddilen");
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Content-Length: ' . strlen($data_string))
);
$resultin = curl_exec($curl);

$re = json_decode($resultin);
curl_close($curl);
if ($re->status==1){
      
  
        $cityua = $re->result[0]->city->ua;
       
$name = transliterate("$cityua");


if (array_key_exists($name,$cityses)){
        $idcity = $cityses[$name];
        $ref = $re->result[0]->city_id;
                $street = $re->result[0]->street->ua;
                $street2 = $re->result[0]->street->ru;
        $street_number = $re->result[0]->street_number;
        $num = $re->result[0]->num;
        $cityru = $re->result[0]->city->ru;
        $r = $re->result[0]->region->ua;
        $ru = $re->result[0]->region->ru;




$name_1 = 'Відділення №'.$num.' '.$r.', '.$cityua.', '.$street . ' '.$street_number;
$name_2 = 'Отделение №'.$num.' '.$ru.', '. $cityru.', '.$street2 . ' '.$street_number;
        $ref_wh = $re->result[0]->br_id;
        $sql = "INSERT INTO meest_wh (name_1, name_2, city_id, number, meest_ref, meest_city_ref) VALUES ('$name_1', '$name_2', '$idcity', '$num', '$ref_wh', '$ref')";
        $dbcnx->query($sql);
        
}
else{
        $idi = $idi+1;
        $cityses[$name]=$idi;
        $r = $re->result[0]->region->ua;
        $cityru = $re->result[0]->city->ru;
        $ref = $re->result[0]->city_id;
       

        if ($r=="ДНІПРОПЕТРОВСЬКА"){
                $region=1;
        }
        if ($r=="Донецька"){
                $region=2;
        }
        if ($r=="ЗАПОРІЗЬКА"){
                $region=3;
        }
        if ($r=="КИЇВСЬКА"){
                $region=4;
        }
        if ($r=="ПОЛТАВСЬКА"){
                $region=5;
        }
        if ($r=="ЛУГАНСЬКА"){
                $region=6;
        }
        if ($r=="ЛЬВІВСЬКА"){
                $region=7;
        }
        if ($r=="МИКОЛАЇВСЬКА"){
                $region=8;
        }
        if ($r=="ОДЕСЬКА"){
                $region=9;
        }
        if ($r=="АРК"){
                $region=10;
        }
        if ($r=="ХАРКІВСЬКА"){
                $region=11;
        }
        if ($r=="ХЕРСОНСЬКА"){
                $region=12;
        }
        if ($r=="ХМЕЛЬНИЦЬКА"){
                $region=13;
        }
        if ($r=="ВІННИЦЬКА"){
                $region=14;
        }
        if ($r=="РІВНЕНСЬКА"){
                $region=15;
        }
        if ($r=="ТЕРНОПІЛЬСЬКА"){
                $region=16;
        }
        if ($r=="ЧЕРНІВЕЦЬКА"){
                $region=17;
        }
        if ($r=="ЖИТОМИРСЬКА"){
                $region=18;
        }
        if ($r=="ВОЛИНСЬКА"){
                $region=19;
        }
        if ($r=="СУМСЬКА"){
                $region=20;
        }
        if ($r=="ЧЕРНІГІВСЬКА"){
                $region=21;
        }
        if ($r=="ІВАНО-ФРАНКІВСЬКА"){
                $region=22;
        }
        if ($r=="КІРОВОГРАДСЬКА"){
                $region=23;
        }
        if ($r=="ЧЕРКАСЬКА"){
                $region=24;
        }
        if ($r=="ЗАКАРПАТСЬКА"){
                $region=25;
        }
        
        $sql = "INSERT INTO meest_citys (name_1, name_2, region_id, meest_ref) VALUES ('$cityua', '$cityru', '$region', '$ref')";
        $dbcnx->query($sql);
        
                $street = $re->result[0]->street->ua;
                $street2 = $re->result[0]->street->ru;

        $num = $re->result[0]->num;
        $street_number = $re->result[0]->street_number;
        $r = $re->result[0]->region->ua;
        $ru = $re->result[0]->region->ru;

$name_1 = 'Відділення №'.$num.' '.$r.', '.$cityua.', '.$street . ' '.$street_number;
$name_2 = 'Отделение №'.$num.' '.$ru.', '. $cityru.', '.$street2 . ' '.$street_number;
        $ref_wh = $re->result[0]->br_id;


        $sql = "INSERT INTO meest_wh (name_1, name_2, city_id, number, meest_ref, meest_city_ref) VALUES ('$name_1', '$name_2', '$idi', '$num', '$ref_wh', '$ref')";
                $dbcnx->query($sql);
                
}
}}

//header("Location: https://prote.ua/exec/meest/meest2.php?vidileniya=$count");
echo "DONE!!!!! ----$count";
?>