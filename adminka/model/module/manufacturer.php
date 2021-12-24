<?php
class ModelModuleManufacturer extends Model {
	public function getManufacturers($data) {

		//$sql = "SELECT DISTINCT `text` FROM " . DB_PREFIX . "product_attribute WHERE attribute_id =1 AND language_id = 1";
		$sql = "SELECT * FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON(f.filter_id = fd.filter_id) WHERE fd.filter_group_id = 1 AND language_id = '" . (int)$this->config->get('config_language_id') . "'";
		if(isset($data['filter_name'])){
			$sql .= " AND `name` LIKE '%".$this->db->escape($data['filter_name'])."%'";
		}
		$sql .= " AND ext_filter_id IS NOT NULL";
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		//vdump($sql);
		/*echo "<pre>";
		print_r($sql);
		echo "</pre>";*/
		$query = $this->db->query($sql);
		//vdump($query);
		return $query->rows;
	}
}