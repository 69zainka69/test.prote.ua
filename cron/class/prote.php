<?php
//class Axapta extends Axapta {
class Prote {

	private $statement = null;
	private $db = null;

	public function __construct() {

		$DB_DRIVER	=	DB_DRIVER;
		$DB_HOSTNAME=	DB_HOSTNAME;
		$DB_USERNAME=	DB_USERNAME;
		$DB_PASSWORD=	DB_PASSWORD;
		$DB_DATABASE=	DB_DATABASE;
		$DB_PORT	=	DB_PORT;
		include_once(DIR_SYSTEM.'library/db/mysqli.php');
		$class = 'DB\\' . $DB_DRIVER;
		$this->db = new $class($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE,$DB_PORT);
		
	}

	public function getProducts() {
		$sql = "SELECT product_id, mpn, upc, image FROM oc_product";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getProductImages($product_id=false) {
		$sql = "SELECT `product_id`, `image`, `ax_filename` FROM `oc_product_image` WHERE ax_filename<>''";
		if($product_id){
			$sql .= " AND `product_id`='". $product_id ."'";
		}
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getProductDocList() {

		//"SELECT REPLACE( file,  '/user/files',  '/instructions' ) as file, name FROM `axapta_files` WHERE type='$doctype' AND absnum='".$upc."'"*/
		//$sql = "SELECT file, name FROM `axapta_files` WHERE absnum='".$upc."'";
		$sql = "SELECT file, name, alias, ax_filename FROM `axapta_files` GROUP BY file";

		$query = $this->db->query($sql);
		return $query->rows;
	}
	

	/*public function getArticlesImages($absnum) {

		//$sql="SELECT * FROM `articles_gallery` where parent=".$absnum." AND `dest` & 2 = 2";
		$sql="SELECT * FROM `articles_gallery` where parent=".$absnum." AND `dest`";
		echo $sql;
        //$query = $this->db->query($sql);

		//$sql_prote="SELECT `product_id`, `image` FROM `oc_product_image` WHERE `product_id`='". $product_id ."'";
		//$query = $this->db->query($sql);
		//return $query->rows;
	}*/


}