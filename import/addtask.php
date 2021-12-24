<?php
error_reporting(E_ALL);

if (!session_id()) {
    session_start();
}
    set_time_limit(0);

if (is_file('../config.php')) {
    require_once('../config.php');
}

if($_POST) {
    $handle = fopen(DIR_ROOT.'import/log_post.txt', 'a');
    fwrite($handle, date('Y-m-d G:i:s') . $_SERVER['REMOTE_ADDR'] . ' - ' . print_r($_POST, true) . "\n");
    fclose($handle);
}

$username = htmlspecialchars($_POST['username'] ?? '');
$apiKey = htmlspecialchars($_POST['apiKey'] ?? '');

if(!$username || !$apiKey) {
    return;
}


include('./OpenCartAPI/OpenCart.php');
$oc = new OpenCart\OpenCart(HTTPS_SERVER, 'cookiejar');
$res = $oc->login($username,$apiKey);

if($res) {
  $result = $oc->addTask();

  header('Content-Type: application/json');
  echo json_encode($result);
}
else {
  $result['error'] = $oc->getLastError();
  header('Content-Type: application/json');
  echo json_encode($result);
}
