<?php
// by gdemon
// 2018.06.26
class ModelCatalogPuseo extends Model {
	public function addpuseo($data) {
		
		$this->event->trigger('pre.admin.puseo.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "puseo SET 
		     status = '" . (int)$data['status'] . "', 
			 url = '" . $this->db->escape($data['keyword']) . "',
			 brand_id = '" . $this->db->escape($data['brand_id']) . "',
			 category_id	 = '" . (int)$data['category_id'] . "',
			 date_modified = NOW(), date_added = NOW()");

		$puseo_id = $this->db->getLastId();

		foreach ($data['puseo_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "puseo_description SET 
			puseo_id = '" . (int)$puseo_id . "', 
			language_id = '" . (int)$language_id . "', 
			name = '" . $this->db->escape($value['name']) . "', 
			description = '" . $this->db->escape($value['description']) . "', 
			meta_title = '" . $this->db->escape($value['meta_title']) . "', 
			meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', 
			meta_description = '" . $this->db->escape($value['meta_description']) . "', 
			meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
			");
		}

        ///// gdemon questions ////////////////////////////////
        /*if (isset($data['question'])) {
            if(method_exists($this->db,'set_charset_utf8mb4')){
                $this->db->set_charset_utf8mb4();
            } else {
                $this->db->query("SET CHARACTER SET utf8mb4");
            }
            foreach ($data['question'] as $question) {
                $sql = "INSERT INTO " . DB_PREFIX . "puseo_question SET puseo_id = '" . (int)$puseo_id . "', question_id = '" . (int)$question['question_id'] . "', config = '" . $this->db->escape($question['config']) . "'";
                $this->db->query($sql);
                foreach ($question['question_description'] as $language_id => $description) {
                    $sql = "INSERT INTO " . DB_PREFIX . "puseo_question_description SET puseo_id = '" . (int)$puseo_id . "', question_id = '" . (int)$question['question_id'] . "', `name` = '" . $this->db->escape($description['name']) . "', text = '" . $this->db->escape($description['text']) . "', language_id = '" . (int)$language_id . "'";
                    $this->db->query($sql);
                }
            }
        }*/
        //////////////////////////////
		//$this->cache->delete('questions');
		$this->cache->delete('puseo');

		$this->event->trigger('post.admin.puseo.add', $puseo_id);

		return $puseo_id;
	}

	public function editpuseo($puseo_id, $data) {

		$this->event->trigger('pre.admin.puseo.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "puseo SET status = '" . (int)$data['status'] . "', 
			url = '" . $this->db->escape($data['keyword']) . "', 
			brand_id = '" . $this->db->escape($data['brand_id']) . "',
			category_id	 = '" . (int)$data['category_id'] . "',
			date_modified = NOW() WHERE puseo_id = '" . (int)$puseo_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "puseo_description WHERE puseo_id = '" . (int)$puseo_id . "'");

		foreach ($data['puseo_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "puseo_description SET puseo_id = '" . (int)$puseo_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

        ///// gdemon questions ////////////////////////////////
        /*$this->db->query("DELETE FROM " . DB_PREFIX . "puseo_question WHERE puseo_id = '" . (int)$puseo_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "puseo_question_description WHERE puseo_id = '" . (int)$puseo_id . "'");

        if (isset($data['question'])) {
            if(method_exists($this->db,'set_charset_utf8mb4')){
                $this->db->set_charset_utf8mb4();
            } else {
                $this->db->query("SET CHARACTER SET utf8mb4");
            }
            foreach ($data['question'] as $question) {
                $sql = "INSERT INTO " . DB_PREFIX . "puseo_question SET puseo_id = '" . (int)$puseo_id . "', question_id = '" . (int)$question['question_id'] . "', config = '" . $this->db->escape($question['config']) . "'";
                $this->db->query($sql);
                foreach ($question['question_description'] as $language_id => $description) {
                    $sql = "INSERT INTO " . DB_PREFIX . "puseo_question_description SET puseo_id = '" . (int)$puseo_id . "', question_id = '" . (int)$question['question_id'] . "', `name` = '" . $this->db->escape($description['name']) . "', text = '" . $this->db->escape($description['text']) . "', language_id = '" . (int)$language_id . "'";
                    $this->db->query($sql);
                }
            }
        }*/
        //////////////////////////////
        //$this->cache->delete('questions');
		$this->cache->delete('puseo');

		$this->event->trigger('post.admin.puseo.edit', $puseo_id);
	}

	public function deletepuseo($puseo_id) {
		$this->event->trigger('pre.admin.puseo.delete', $puseo_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "puseo WHERE puseo_id = '" . (int)$puseo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "puseo_description WHERE puseo_id = '" . (int)$puseo_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "puseo_question WHERE puseo_id = '" . (int)$puseo_id . "'");
        //$this->db->query("DELETE FROM " . DB_PREFIX . "puseo_question_description WHERE puseo_id = '" . (int)$puseo_id . "'");
		$this->cache->delete('questions');
		$this->cache->delete('puseo');

		$this->event->trigger('post.admin.puseo.delete', $puseo_id);
	}

	

	public function getpuseo($puseo_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "puseo f LEFT JOIN " . DB_PREFIX . "puseo_description fd2 ON (f.puseo_id = fd2.puseo_id) WHERE f.puseo_id = '" . (int)$puseo_id . "' AND fd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getPuseos($data = array()) {
		$sql = "SELECT f.puseo_id, f.url, fsd.name, f.brand_id, cd.name as category_name
		FROM " . DB_PREFIX . "puseo f 
		LEFT JOIN " . DB_PREFIX . "puseo_description fsd ON (f.puseo_id = fsd.puseo_id)
		LEFT JOIN " . DB_PREFIX . "category_description cd ON (f.category_id = cd.category_id)
		WHERE fsd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND (fsd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR fsd.meta_title LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR fsd.meta_h1 LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR f.url LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " )";
		}

		$sql .= " GROUP BY f.puseo_id ";

		$sort_data = array(
			'fsd.name',
			'fsd.url'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY fsd.name";
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

	public function getPuseoDescriptions($puseo_id) {
		$puseo_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "puseo_description WHERE puseo_id = '" . (int)$puseo_id . "'");

		foreach ($query->rows as $result) {
			$puseo_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'          => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $puseo_description_data;
	}

	public function getTotalPuseos() {
		$sql = "SELECT COUNT(*) AS total 
		FROM " . DB_PREFIX . "puseo f 
		LEFT JOIN " . DB_PREFIX . "puseo_description fsd ON (f.puseo_id = fsd.puseo_id) 
		WHERE fsd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND (fsd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR fsd.meta_title LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR fsd.meta_h1 LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR f.url LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " )";
		}

		$sql .= " GROUP BY f.puseo_id ";
		$query = $this->db->query($sql);

		return $query->row['total'];
	}

    ///// gdemon questions ////////////////////////////////
    /*public function getpuseoQuestions($puseo_id) {

        if(method_exists($this->db,'set_charset_utf8mb4')){
            $this->db->set_charset_utf8mb4();
        } else {
            $this->db->query("SET CHARACTER SET utf8mb4");
        }

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "puseo_question WHERE puseo_id = '" . (int)$puseo_id . "'");


        foreach ($query->rows as $result) {

            $query2 = $this->db->query("SELECT * FROM " . DB_PREFIX . "puseo_question_description WHERE puseo_id = '" . (int)$puseo_id . "' AND question_id = '" . $result['question_id'] ."'");

            $desc_data = array();
            foreach ($query2->rows as $row) {
                $desc_data[$row['language_id']] = $row;
            }

            $question_data[] = array(
                'puseo_id' => $result['puseo_id'],
                'question_id' => $result['question_id'],
                'config' => $result['config'],
                'question_description' => $desc_data

            );
        }

        return $question_data;
    }*/
    /////////////////////////////////////
}
