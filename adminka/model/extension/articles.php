<?php
class ModelExtensionArticles extends Model {
	public function addArticles($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "articles SET image = '" . $this->db->escape($data['image']) . "', date_added = NOW(), status = '" . (int)$data['status'] . "'");

		$articles_id = $this->db->getLastId();

		foreach ($data['articles'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."articles_description SET articles_id = '" . (int)$articles_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'articles_id=" . (int)$articles_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		$this->cache->delete('seo_pro');
	}

	public function editArticles($articles_id, $data) { 
		$this->db->query("UPDATE " . DB_PREFIX . "articles SET image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "' WHERE articles_id = '" . (int)$articles_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "articles_description WHERE articles_id = '" . (int)$articles_id. "'");

		foreach ($data['articles'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."articles_description SET articles_id = '" . (int)$articles_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'articles_id=" . (int)$articles_id. "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'articles_id=" . (int)$articles_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		$this->cache->delete('seo_pro');
	}

	public function getArticles($articles_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'articles_id=" . (int)$articles_id . "') AS keyword FROM " . DB_PREFIX . "articles WHERE articles_id = '" . (int)$articles_id . "'");

		if ($query->num_rows) {
			return $query->row;
		} else {
			return false;
		}
	}

	public function getArticlesDescription($articles_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "articles_description WHERE articles_id = '" . (int)$articles_id . "'");

		foreach ($query->rows as $result) {
			$articles_description[$result['language_id']] = array(
				'title'       			=> $result['title'],
				'short_description'		=> $result['short_description'],
				'description' 			=> $result['description'],
                                'meta_description'	=> $result['meta_description'],
				'meta_h1'	=> $result['meta_h1'],
				'meta_title'	=> $result['meta_title'],
				'meta_keyword'	=> $result['meta_keyword'],
			);
		}

		return $articles_description;
	}

	public function getAllArticles($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "articles n LEFT JOIN " . DB_PREFIX . "articles_description nd ON n.articles_id = nd.articles_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY date_added DESC";

		if (isset($data['start']) && isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function deleteArticles($articles_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "articles WHERE articles_id = '" . (int)$articles_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "articles_description WHERE articles_id = '" . (int)$articles_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'articles_id=" . (int)$articles_id. "'");
	}

	public function getTotalArticles() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "articles");

		return $query->row['total'];
	}
}