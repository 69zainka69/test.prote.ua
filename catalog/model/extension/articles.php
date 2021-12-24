<?php
class ModelExtensionArticles extends Model {
	public function getArticles($articles_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "articles n LEFT JOIN " . DB_PREFIX . "articles_description nd ON n.articles_id = nd.articles_id WHERE n.articles_id = '" . (int)$articles_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getAllArticles($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "articles n LEFT JOIN " . DB_PREFIX . "articles_description nd ON n.articles_id = nd.articles_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' ORDER BY date_added DESC";

		if (isset($data['start']) && isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 10;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql); 
		return $query->rows;
	}

	public function getTotalArticles() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "articles");

		return $query->row['total'];
	}
}
