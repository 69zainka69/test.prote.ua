<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModelCatalogCitydelivery extends Model {
    
	public function getCity($city_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "delivery_cities WHERE city_id = '" . (int)$city_id . "'");

		return $query->row;
	}

	public function getText($text_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "delivery_texts WHERE text_id = '" . (int)$text_id . "' AND language_id='".$langid = ($this->language->get('code')=='ru'?1:2)."'");

		return $query->row;
	}

        public function getCityList() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "delivery_cities ORDER by city_id");

		return $query->row;
	}
	
}
