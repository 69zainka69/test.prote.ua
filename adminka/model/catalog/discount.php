<?php
class ModelCatalogDiscount extends Model {


	public function getPrimaryCurrency(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE value = '1'");
		return $query->row;
	}
	
	
	
	
	public function editSetting($group, $data, $store_id = 0) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `code` = '" . $this->db->escape($group) . "'");

		foreach ($data as $key => $value) {
			if (!is_array($value)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `code` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape($value) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `code` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape(serialize($value)) . "'");
			}
		}
	}
	
	
		public function getSetting($group, $store_id = 0) {
		$data = array(); 
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `code` = '" . $this->db->escape($group) . "'");
		
		
		
		
		foreach ($query->rows as $result) {
      $data[$result['key']] = unserialize($result['value']);
		}

		return $data;
	}
	
	
	
	
	
	
}
?>