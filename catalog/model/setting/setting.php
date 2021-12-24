<?php
class ModelSettingSetting extends Model {
	public function getSetting($code, $store_id = 0) {
		$data = array();
		$sql = "SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `code` = '" . $this->db->escape($code) . "'";
		//vdump($sql);
		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			if (!$result['serialized']) {
				$data[$result['key']] = $result['value'];
			} else {
				$data[$result['key']] = json_decode($result['value'], true);
			}
		}

		return $data;
	}
}