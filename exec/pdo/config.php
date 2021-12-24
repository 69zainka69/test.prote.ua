<?php

$host = '192.168.200.170';
$db = 'VMDB-1';
$user = 'partnersite';
$password = 'part#10_911';


$port = '3306';



$dsn = "sqlsrv:Server=" . $host . ";Database=" . $db;

/*
try {
    $pdo = new \PDO("sqlsrv:Server=" . $host . ";Database=" . $db, $user, $password, array(\PDO::ATTR_ERRMODE => true));
    if ($pdo) {
		echo "Connected to the $db database successfully!";
	}
} catch(\PDOException $e) {
    throw new \Exception('Failed to connect to database. Reason: \'' . $e->getMessage() . '\'');
}

*/

try {
	
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

	if ($pdo) {
		echo "Connected to the $db database successfully!";
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}





















/*
define('DO_DEBUG', '0');
define('SERVER_IP', '192.168.200.170');
define('SERVER_PORT', '8081');
define('DO_TRACE', '0');
define('LOG_DIR', DIR_ROOT.'system/storage/logs/');
define('AXAPTA_URL', 'http://192.168.200.170:8081/service/Service.asmx/daxProcessRequest');


define('DB_AX_DRIVER', 'mpdo');
define('DB_AX_HOSTNAME', '192.168.200.170');
define('DB_AX_USERNAME', 'partnersite');
define('DB_AX_PASSWORD', 'part#10_911');
define('DB_AX_DATABASE', 'VMDB-1');
define('DB_AX_PORT', '');




function __construct($hostname, $username, $password, $database, $port = '3306') {

    try {
        $this->connection = new \PDO("sqlsrv:Server=" . $hostname . ";Database=" . $database, $username, $password, array(\PDO::SQLSRV_ATTR_DIRECT_QUERY => true));
    } catch(\PDOException $e) {
        throw new \Exception('Failed to connect to database. Reason: \'' . $e->getMessage() . '\'');
    }

    $this->connection->exec("SET NAMES 'utf8'");
    $this->connection->exec("SET CHARACTER SET utf8");
    $this->connection->exec("SET CHARACTER_SET_CONNECTION=utf8");
    $this->connection->exec("SET SQL_MODE = ''");
}
*/