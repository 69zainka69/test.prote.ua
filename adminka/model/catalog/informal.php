<?php 
class ModelCatalogInformal extends Model {
	public function addInformal($data) {
		$this->event->trigger('pre.admin.informal.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "informal SET parent_id = '" . $this->db->escape($data['parent_id']) . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$informal_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "informal SET image = '" . $this->db->escape($data['image']) . "' WHERE informal_id = '" . (int)$informal_id . "'");
		}

		foreach ($data['informal_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "informal_description SET informal_id = '" . (int)$informal_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', dop_pole = '" . $this->db->escape($value['dop_pole']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		/*$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "informal_path` WHERE informal_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "informal_path` SET `informal_id` = '" . (int)$informal_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "informal_path` SET `informal_id` = '" . (int)$informal_id . "', `path_id` = '" . (int)$informal_id . "', `level` = '" . (int)$level . "'");*/

		if (isset($data['informal_filter'])) {
			foreach ($data['informal_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "informal_filter SET informal_id = '" . (int)$informal_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['informal_store'])) {
			foreach ($data['informal_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "informal_to_store SET informal_id = '" . (int)$informal_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		// Set which layout to use with this informal
		if (isset($data['informal_layout'])) {
			foreach ($data['informal_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "informal_to_layout SET informal_id = '" . (int)$informal_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'informal_id=" . (int)$informal_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('informal');

		$this->event->trigger('post.admin.informal.add', $informal_id);

		return $informal_id;
	}

	public function editinformal($informal_id, $data) {
		$this->event->trigger('pre.admin.informal.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "informal SET parent_id = '" . $this->db->escape($data['parent_id']) . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE informal_id = '" . (int)$informal_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "informal SET image = '" . $this->db->escape($data['image']) . "' WHERE informal_id = '" . (int)$informal_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "informal_description WHERE informal_id = '" . (int)$informal_id . "'");

		foreach ($data['informal_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "informal_description SET informal_id = '" . (int)$informal_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', dop_pole = '" . $this->db->escape($value['dop_pole']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "informal_path` WHERE path_id = '" . (int)$informal_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $informal_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "informal_path` WHERE informal_id = '" . (int)$informal_path['informal_id'] . "' AND level < '" . (int)$informal_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "informal_path` WHERE informal_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "informal_path` WHERE informal_id = '" . (int)$informal_path['informal_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "informal_path` SET informal_id = '" . (int)$informal_path['informal_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "informal_path` WHERE informal_id = '" . (int)$informal_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "informal_path` WHERE informal_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "informal_path` SET informal_id = '" . (int)$informal_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "informal_path` SET informal_id = '" . (int)$informal_id . "', `path_id` = '" . (int)$informal_id . "', level = '" . (int)$level . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "informal_filter WHERE informal_id = '" . (int)$informal_id . "'");

		if (isset($data['informal_filter'])) {
			foreach ($data['informal_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "informal_filter SET informal_id = '" . (int)$informal_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "informal_to_store WHERE informal_id = '" . (int)$informal_id . "'");

		if (isset($data['informal_store'])) {
			foreach ($data['informal_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "informal_to_store SET informal_id = '" . (int)$informal_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "informal_to_layout WHERE informal_id = '" . (int)$informal_id . "'");

		if (isset($data['informal_layout'])) {
			foreach ($data['informal_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "informal_to_layout SET informal_id = '" . (int)$informal_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'informal_id=" . (int)$informal_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'informal_id=" . (int)$informal_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('informal');

		$this->event->trigger('post.admin.informal.edit', $informal_id);
	}

	public function deleteinformal($informal_id) {
		$this->event->trigger('pre.admin.informal.delete', $informal_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "informal_path WHERE informal_id = '" . (int)$informal_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "informal_path WHERE path_id = '" . (int)$informal_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteinformal($result['informal_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "informal WHERE informal_id = '" . (int)$informal_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "informal_description WHERE informal_id = '" . (int)$informal_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "informal_filter WHERE informal_id = '" . (int)$informal_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "informal_to_store WHERE informal_id = '" . (int)$informal_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "informal_to_layout WHERE informal_id = '" . (int)$informal_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_informal WHERE informal_id = '" . (int)$informal_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'informal_id=" . (int)$informal_id . "'");

		$this->cache->delete('informal');

		$this->event->trigger('post.admin.informal.delete', $informal_id);
	}

	public function repairInformals($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "informal WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $informal) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "informal_path` WHERE informal_id = '" . (int)$informal['informal_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "informal_path` WHERE informal_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "informal_path` SET informal_id = '" . (int)$informal['informal_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "informal_path` SET informal_id = '" . (int)$informal['informal_id'] . "', `path_id` = '" . (int)$informal['informal_id'] . "', level = '" . (int)$level . "'");

			$this->repairInformals($informal['informal_id']);
		}
	}

	public function getinformal($informal_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "informal_path cp LEFT JOIN " . DB_PREFIX . "informal_description cd1 ON (cp.path_id = cd1.informal_id AND cp.informal_id != cp.path_id) WHERE cp.informal_id = c.informal_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.informal_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'informal_id=" . (int)$informal_id . "') AS keyword FROM " . DB_PREFIX . "informal c LEFT JOIN " . DB_PREFIX . "informal_description cd2 ON (c.informal_id = cd2.informal_id) WHERE c.informal_id = '" . (int)$informal_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getInformalsByParentId($parent_id = 0) {
		$query = $this->db->query("SELECT *, (SELECT COUNT(parent_id) FROM " . DB_PREFIX . "informal WHERE parent_id = c.informal_id) AS children FROM " . DB_PREFIX . "informal c LEFT JOIN " . DB_PREFIX . "informal_description cd ON (c.informal_id = cd.informal_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name");

		return $query->rows;
	}

	public function getInformals($data = array()) {
		$sql = "SELECT cp.informal_id AS informal_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order, c1.status FROM " . DB_PREFIX . "informal_path cp LEFT JOIN " . DB_PREFIX . "informal c1 ON (cp.informal_id = c1.informal_id) LEFT JOIN " . DB_PREFIX . "informal c2 ON (cp.path_id = c2.informal_id) LEFT JOIN " . DB_PREFIX . "informal_description cd1 ON (cp.path_id = cd1.informal_id) LEFT JOIN " . DB_PREFIX . "informal_description cd2 ON (cp.informal_id = cd2.informal_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cp.informal_id";

		$sort_data = array(
			'product_count',
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
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

	public function getinformalDescriptions($informal_id) {
		$informal_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "informal_description WHERE informal_id = '" . (int)$informal_id . "'");

		foreach ($query->rows as $result) {
			$informal_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'          => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description'],
                'dop_pole'      => $result['dop_pole']
			);
		}

		return $informal_description_data;
	}

	public function getinformalFilters($informal_id) {
		$informal_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "informal_filter WHERE informal_id = '" . (int)$informal_id . "'");

		foreach ($query->rows as $result) {
			$informal_filter_data[] = $result['filter_id'];
		}

		return $informal_filter_data;
	}

	public function getinformalStores($informal_id) {
		$informal_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "informal_to_store WHERE informal_id = '" . (int)$informal_id . "'");

		foreach ($query->rows as $result) {
			$informal_store_data[] = $result['store_id'];
		}

		return $informal_store_data;
	}

	public function getinformalLayouts($informal_id) {
		$informal_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "informal_to_layout WHERE informal_id = '" . (int)$informal_id . "'");

		foreach ($query->rows as $result) {
			$informal_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $informal_layout_data;
	}

	public function getTotalInformals() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "informal");

		return $query->row['total'];
	}

	public function getAllInformals() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "informal c LEFT JOIN " . DB_PREFIX . "informal_description cd ON (c.informal_id = cd.informal_id) LEFT JOIN " . DB_PREFIX . "informal_to_store c2s ON (c.informal_id = c2s.informal_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  ORDER BY c.parent_id, c.sort_order, cd.name");

		$informal_data = array();
		foreach ($query->rows as $row) {
			$informal_data[$row['parent_id']][$row['informal_id']] = $row;
		}

		return $informal_data;
	}
	
	public function getTotalInformalsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "informal_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}
