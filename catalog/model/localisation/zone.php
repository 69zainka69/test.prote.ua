<?php
class ModelLocalisationZone extends Model {
	public function getZone($zone_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$zone_id . "' AND status = '1'");

		return $query->row;
	}

	public function getZonesByCountryId($country_id) {
		$zone_data = $this->cache->get('zone.' . (int)$country_id);

		if (!$zone_data) {
			$sql = "SELECT z.*, zd.name FROM " . DB_PREFIX . "zone z
			LEFT JOIN  " . DB_PREFIX . "zone_description zd ON(z.zone_id = zd.zone_id) 
			WHERE z.country_id = '" . (int)$country_id . "'
			AND zd.language_id = '" . (int)$this->config->get('config_language_id') . "'
			AND z.status = '1' ORDER BY z.name";

            $query = $this->db->query($sql);

			$zone_data = $query->rows;

			$this->cache->set('zone.' . (int)$country_id, $zone_data);
		}

		return $zone_data;
	}
    public function getZoneDescription($zone_id) {
	    $sql = "SELECT zd.* FROM " . DB_PREFIX . "zone_description zd 
	    LEFT JOIN " . DB_PREFIX . "zone z ON(z.zone_id = zd.zone_id) 
	    WHERE z.zone_id = '" . (int)$zone_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'  AND z.status = '1'";

	    $query = $this->db->query($sql);

        return $query->row;
    }
}