<?php
// by gdemon
// 2018.06.26
class ModelCatalogFilterseo extends Model {
	public function addFilterseo($data) {
		
		$this->event->trigger('pre.admin.filterseo.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "filterseo SET status = '" . (int)$data['status'] . "',category_id = '" . (int)$data['category_id'] . "', 
			/*filter_group_id = '" . (int)$data['filter_group_id'] . "',*/
			 url = '" . $this->db->escape($data['keyword']) . "', date_modified = NOW(), date_added = NOW()");

		$filterseo_id = $this->db->getLastId();


		foreach ($data['filterseo_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "filterseo_description SET filterseo_id = '" . (int)$filterseo_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['filterseo_filters'])) {
            foreach ($data['filterseo_filters'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "filterseo_to_filter SET filterseo_id = '" . (int)$filterseo_id . "',  filter_id = '" . (int)$filter_id . "'");
            }
        }

        ///// gdemon questions ////////////////////////////////
        if (isset($data['question'])) {
            if(method_exists($this->db,'set_charset_utf8mb4')){
                $this->db->set_charset_utf8mb4();
            } else {
                $this->db->query("SET CHARACTER SET utf8mb4");
            }
            foreach ($data['question'] as $question) {
                $sql = "INSERT INTO " . DB_PREFIX . "filterseo_question SET filterseo_id = '" . (int)$filterseo_id . "', question_id = '" . (int)$question['question_id'] . "', config = '" . $this->db->escape($question['config']) . "'";
                $this->db->query($sql);
                foreach ($question['question_description'] as $language_id => $description) {
                    $sql = "INSERT INTO " . DB_PREFIX . "filterseo_question_description SET filterseo_id = '" . (int)$filterseo_id . "', question_id = '" . (int)$question['question_id'] . "', `name` = '" . $this->db->escape($description['name']) . "', text = '" . $this->db->escape($description['text']) . "', language_id = '" . (int)$language_id . "'";
                    $this->db->query($sql);
                }
            }
        }
        //////////////////////////////
		$this->cache->delete('questions');
		$this->cache->delete('filterseo');

		$this->event->trigger('post.admin.filterseo.add', $filterseo_id);

		return $filterseo_id;
	}

	public function editFilterseo($filterseo_id, $data) {
		/*vdump($filterseo_id);
		vdump($data);
		exit;*/
		$this->event->trigger('pre.admin.filterseo.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "filterseo SET status = '" . (int)$data['status'] . "', category_id = '" . (int)$data['category_id'] . "', 
			/*filter_group_id = '" . (int)$data['filter_group_id'] . "', */
			url = '" . $this->db->escape($data['keyword']) . "', date_modified = NOW() WHERE filterseo_id = '" . (int)$filterseo_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "filterseo_description WHERE filterseo_id = '" . (int)$filterseo_id . "'");

		foreach ($data['filterseo_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "filterseo_description SET filterseo_id = '" . (int)$filterseo_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "filterseo_to_filter WHERE filterseo_id = '" . (int)$filterseo_id . "'");

		if (isset($data['filterseo_filters'])) {
            foreach ($data['filterseo_filters'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "filterseo_to_filter SET filterseo_id = '" . (int)$filterseo_id . "',  filter_id = '" . (int)$filter_id . "'");
            }
        }

        ///// gdemon questions ////////////////////////////////
        $this->db->query("DELETE FROM " . DB_PREFIX . "filterseo_question WHERE filterseo_id = '" . (int)$filterseo_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "filterseo_question_description WHERE filterseo_id = '" . (int)$filterseo_id . "'");

        if (isset($data['question'])) {
            if(method_exists($this->db,'set_charset_utf8mb4')){
                $this->db->set_charset_utf8mb4();
            } else {
                $this->db->query("SET CHARACTER SET utf8mb4");
            }
            foreach ($data['question'] as $question) {
                $sql = "INSERT INTO " . DB_PREFIX . "filterseo_question SET filterseo_id = '" . (int)$filterseo_id . "', question_id = '" . (int)$question['question_id'] . "', config = '" . $this->db->escape($question['config']) . "'";
                $this->db->query($sql);
                foreach ($question['question_description'] as $language_id => $description) {
                    $sql = "INSERT INTO " . DB_PREFIX . "filterseo_question_description SET filterseo_id = '" . (int)$filterseo_id . "', question_id = '" . (int)$question['question_id'] . "', `name` = '" . $this->db->escape($description['name']) . "', text = '" . $this->db->escape($description['text']) . "', language_id = '" . (int)$language_id . "'";
                    $this->db->query($sql);
                }
            }
        }
        //////////////////////////////
        $this->cache->delete('questions');
		$this->cache->delete('filterseo');

		$this->event->trigger('post.admin.filterseo.edit', $filterseo_id);
	}

	public function deleteFilterseo($filterseo_id) {
		$this->event->trigger('pre.admin.filterseo.delete', $filterseo_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "filterseo WHERE filterseo_id = '" . (int)$filterseo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filterseo_description WHERE filterseo_id = '" . (int)$filterseo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filterseo_to_filter WHERE filterseo_id = '" . (int)$filterseo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "filterseo_question WHERE filterseo_id = '" . (int)$filterseo_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "filterseo_question_description WHERE filterseo_id = '" . (int)$filterseo_id . "'");
		$this->cache->delete('questions');
		$this->cache->delete('filterseo');

		$this->event->trigger('post.admin.filterseo.delete', $filterseo_id);
	}

	

	public function getFilterseo($filterseo_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "filterseo f LEFT JOIN " . DB_PREFIX . "filterseo_description fd2 ON (f.filterseo_id = fd2.filterseo_id) WHERE f.filterseo_id = '" . (int)$filterseo_id . "' AND fd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getFilteries($data = array()) {
		$sql = "SELECT f.filterseo_id, f.url, f.category_id, f.filter_group_id, cd.name as category_name, fd.name as filter_group_name, fsd.name as filter_seo_name 
		FROM " . DB_PREFIX . "filterseo f 
		LEFT JOIN " . DB_PREFIX . "filterseo_description fsd ON (f.filterseo_id = fsd.filterseo_id) 
		LEFT JOIN " . DB_PREFIX . "category_description cd ON (f.category_id = cd.category_id) 
		LEFT JOIN " . DB_PREFIX . "filter_group_description fd ON (f.filter_group_id = fd.filter_group_id) 

		WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND (cd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR cd.meta_title LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR cd.meta_h1 LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR f.url LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " )";
		}

		$sql .= " GROUP BY f.filterseo_id ";

		$sort_data = array(
			'product_count',
			'cd.name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			//$sql .= " ORDER BY sort_order";
			$sql .= " ORDER BY cd.name";
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

	public function getFilterseoDescriptions($filterseo_id) {
		$filterseo_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filterseo_description WHERE filterseo_id = '" . (int)$filterseo_id . "'");

		foreach ($query->rows as $result) {
			$filterseo_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'          => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $filterseo_description_data;
	}

	/*public function getFilterseoFilters($filterseo_id) {
		$filterseo_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filterseo_filter WHERE filterseo_id = '" . (int)$filterseo_id . "'");

		foreach ($query->rows as $result) {
			$filterseo_filter_data[] = $result['filter_id'];
		}

		return $filterseo_filter_data;
	}*/


	public function getTotalFilteries() {
		//$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "filterseo");
		$sql = "SELECT COUNT(*) AS total 
		FROM " . DB_PREFIX . "filterseo f 
		LEFT JOIN " . DB_PREFIX . "filterseo_description fsd ON (f.filterseo_id = fsd.filterseo_id) 
		LEFT JOIN " . DB_PREFIX . "category_description cd ON (f.category_id = cd.category_id) 
		LEFT JOIN " . DB_PREFIX . "filter_group_description fd ON (f.filter_group_id = fd.filter_group_id) 

		WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND (cd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR cd.meta_title LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR cd.meta_h1 LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR f.url LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " )";
		}

		$sql .= " GROUP BY f.filterseo_id ";

		$query = $this->db->query($sql);

		//return $query->rows;

		return $query->row['total'];
	}

    ///// gdemon questions ////////////////////////////////
    public function getFilterseoQuestions($filterseo_id) {

        if(method_exists($this->db,'set_charset_utf8mb4')){
            $this->db->set_charset_utf8mb4();
        } else {
            $this->db->query("SET CHARACTER SET utf8mb4");
        }

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filterseo_question WHERE filterseo_id = '" . (int)$filterseo_id . "'");


        foreach ($query->rows as $result) {

            $query2 = $this->db->query("SELECT * FROM " . DB_PREFIX . "filterseo_question_description WHERE filterseo_id = '" . (int)$filterseo_id . "' AND question_id = '" . $result['question_id'] ."'");

            $desc_data = array();
            foreach ($query2->rows as $row) {
                $desc_data[$row['language_id']] = $row;
            }

            $question_data[] = array(
                'filterseo_id' => $result['filterseo_id'],
                'question_id' => $result['question_id'],
                'config' => $result['config'],
                'question_description' => $desc_data

            );
        }

        return $question_data;
    }
    /////////////////////////////////////
}
