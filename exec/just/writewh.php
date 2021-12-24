<?php
ini_set('max_execution_time', 1500);


require_once('/var/www/prote/data/www/prote.ua/config.php');
$dbcnx = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($dbcnx->connect_error) {
  trigger_error('Error: Could not make a database link (' . $dbcnx->connect_errno . ') ' . $dbcnx->connect_error);
  exit();
}

$dbcnx->set_charset("utf8");
$dbcnx->query("SET SQL_MODE = ''");

 

  $language = array(
      'language' =>"UA",
  );


  $sql = "TRUNCATE TABLE just_wh ";
  $dbcnx->query($sql);



  $a = $dbcnx->query("SELECT * FROM just_citys");

    
       foreach($a as $sit){

        $val=$sit["just_ref"];
        $number = $sit["id"];
        $name_1=$sit["name_1"];

        $filter = array ( array(
            'name' => "city",
            'comparison' => "equal",
            'leftValue' => "$val"));
      
       
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
        $data->type = "request";
        $data->name = "req_DepartmentsLang";
        $data->language = "UA";
        $data->params = $language;
        $data->filter = $filter;


      
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


if (isset($re->data)) {
$count = count($re->data);



for ($i = 0; $i <= $count-1; $i++) {
    
    $city[$i] = $re->data[$i];
    $name = $city[$i]->fields->descr;
    $addr = $city[$i]->fields->address;
    $names= $name." ".$addr;
    $just_city_ref = $val=$sit["just_ref"];
   // $just_ref = $city[$i]->fields->Depart->uuid;
    $numbers = $city[$i]->fields->departNumber;

   
    $sityys =  $name_1;

    $dev_number = explode("№", $name);
    $dev_number = explode(" ", $dev_number[1]);
    $just_numb = preg_replace('/[^0-9]/', '', $dev_number[0]);
    $str = $sityys." ".$just_numb;
    $Delive = sha1($str);
    $just_ref = $Delive;

$sql = "INSERT INTO just_wh (name_1, name_2, number, city_id, just_city_ref, just_ref) VALUES ('$names', '$names', $numbers, '$number', '$just_city_ref', '$just_ref')";
$dbcnx->query($sql); 
}

}

}

echo "DONE!!!";

?>