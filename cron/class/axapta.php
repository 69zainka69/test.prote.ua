<?php
//class Axapta extends Axapta {
class Axapta {

	private $statement = null;
	private $db_ax = null;

	public function __construct() {

		$DB_DRIVER	=	DB_AX_DRIVER;
		$DB_HOSTNAME=	DB_AX_HOSTNAME;
		$DB_USERNAME=	DB_AX_USERNAME;
		$DB_PASSWORD=	DB_AX_PASSWORD;
		$DB_DATABASE=	DB_AX_DATABASE;
		$DB_PORT	=	'';
		include_once(DIR_SYSTEM.'library/db/mpdo.php');
		$class = 'DB2\\' . $DB_DRIVER;
		$this->db_ax = new $class($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE,$DB_PORT);
		

	}

	public function getProductDocuments() {
		//$this->connect();
		$sql = "EXEC dbo.p_getProductDocuments";
		$query = $this->db_ax->query($sql);
		return $query->rows;
	}


}