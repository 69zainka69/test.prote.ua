<?php
$serverName = "192.168.200.170"; 
$options = array(  "UID" => "partnersite",  "PWD" => "part#10_911",  "Database" => "VMDB-1");
$conn = sqlsrv_connect($serverName, $options);

#$database = "VMDB-1";
#$server = "192.168.200.170";
#$username = "partnersite";
#$password = "part#10_911";
#$hostname = "192.168.200.170";


#$conn = new \PDO("sqlsrv:Server=" . $hostname . ";Database=" . $database, $username, $password, array(\PDO::SQLSRV_ATTR_DIRECT_QUERY => true));
#echo "connection"echo "connection1";
#$this->connection = new \PDO("sqlsrv:Server=" . $hostname . ";Database=" . $database, $username, $password, array(\PDO::SQLSRV_ATTR_DIRECT_QUERY => true));
#echo "connection"echo "connection2";


if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
//?>
