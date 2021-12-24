<?php

class ModelInformationWorkers extends Model {
    
	public function getWorkers($workers_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "workers w
			LEFT JOIN " . DB_PREFIX . "workers_description wd ON(w.workers_id=wd.workers_id)
			WHERE w.workers_id = '" . (int)$workers_id . "' AND wd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND status=1");
		if($query->row){
			$query2 = $this->db->query("SELECT * FROM " . DB_PREFIX . "workers_product WHERE workers_id = '" . (int)$workers_id . "' ORDER BY sort_order");	
			$query->row['products'] = $query2->rows;
		}
		return $query->row;
	}
}
