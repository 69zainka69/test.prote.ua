<?php 
class ModelCatalogWorkers extends Model {
	public function addWorkers($data) {
		$this->event->trigger('pre.admin.workers.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "workers SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "'");

		$workers_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "workers SET image = '" . $this->db->escape($data['image']) . "' WHERE workers_id = '" . (int)$workers_id . "'");
		}

		foreach ($data['workers_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "workers_description SET workers_id = '" . (int)$workers_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		foreach ($data['products'] as $product) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "workers_product SET workers_id = '" . (int)$workers_id . "', product_id = '" . (int)$product_id . "', quantity = '" . (int)$value['quantity'] . "', sort_order = '" . (int)$value['sort_order'] . "'");
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'workers_id=" . (int)$workers_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('workers');
		$this->event->trigger('post.admin.workers.add', $workers_id);
		return $workers_id;
	}

	public function editWorkers($workers_id, $data) {
		$this->event->trigger('pre.admin.workers.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "workers SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE workers_id = '" . (int)$workers_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "workers SET image = '" . $this->db->escape($data['image']) . "' WHERE workers_id = '" . (int)$workers_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "workers_product WHERE workers_id = '" . (int)$workers_id . "'");
		foreach ($data['products'] as $product) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "workers_product SET workers_id = '" . (int)$workers_id . "', product_id = '" . (int)$product['product_id'] . "', quantity = '" . (int)$product['quantity'] . "', sort_order = '" . (int)$product['sort_order'] . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "workers_description WHERE workers_id = '" . (int)$workers_id . "'");
		foreach ($data['workers_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "workers_description SET workers_id = '" . (int)$workers_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}


		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'workers_id=" . (int)$workers_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'workers_id=" . (int)$workers_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('workers');
		$this->event->trigger('post.admin.workers.edit', $workers_id);
	}

	public function deleteWorkers($workers_id) {
		$this->event->trigger('pre.admin.workers.delete', $workers_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "workers WHERE workers_id = '" . (int)$workers_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "workers_description WHERE workers_id = '" . (int)$workers_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "workers_product WHERE workers_id = '" . (int)$workers_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'workers_id=" . (int)$workers_id . "'");

		$this->cache->delete('workers');

		$this->event->trigger('post.admin.workers.delete', $workers_id);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////

	public function getWorkerss($data = array()) {
		$sql = "SELECT *FROM " . DB_PREFIX . "workers w LEFT JOIN " . DB_PREFIX . "workers_description wd ON (w.workers_id = wd.workers_id) WHERE wd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sql .= " GROUP BY w.workers_id";

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getworkersDescriptions($workers_id) {
		$workers_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "workers_description WHERE workers_id = '" . (int)$workers_id . "'");

		foreach ($query->rows as $result) {
			$workers_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'          => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $workers_description_data;
	}

	public function getworkersProducts($workers_id) {
		//$workers_description_data = array();
		$products = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "workers_product WHERE workers_id = '" . (int)$workers_id . "'");
		
		foreach ($query->rows as $result) {

			$query2 = $this->db->query("SELECT name FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$result['product_id'] . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

			$products[] = array(
				'product_id'		=> $result['product_id'],
				'name'		=> $query2->row['name'],
				'quantity'		=> $result['quantity'],
				'sort_order'		=> $result['sort_order']
			);
		}

		return $products;
	}

	public function getWorkers($workers_id) {
		$query = $this->db->query("SELECT DISTINCT *, 
				(SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'workers_id=" . (int)$workers_id . "') AS keyword FROM " . DB_PREFIX . "workers c LEFT JOIN " . DB_PREFIX . "workers_description cd2 ON (c.workers_id = cd2.workers_id) WHERE c.workers_id = '" . (int)$workers_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
/*echo "<pre>";
print_r($query->row
);
echo "</pre>";

		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "workers_path cp LEFT JOIN " . DB_PREFIX . "workers_description cd1 ON (cp.path_id = cd1.workers_id AND cp.workers_id != cp.path_id) WHERE cp.workers_id = c.workers_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.workers_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'workers_id=" . (int)$workers_id . "') AS keyword FROM " . DB_PREFIX . "workers c LEFT JOIN " . DB_PREFIX . "workers_description cd2 ON (c.workers_id = cd2.workers_id) WHERE c.workers_id = '" . (int)$workers_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");*/

		return $query->row;
	}

}
