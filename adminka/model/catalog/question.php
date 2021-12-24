<?php
class ModelCatalogQuestion extends Model {
	public function addQuestion($data) {
		$this->event->trigger('pre.admin.question.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "question SET sort_order = '" . (int)$data['sort_order'] . "'");

		$question_id = $this->db->getLastId();

        if(method_exists($this->db,'set_charset_utf8mb4')){
            $this->db->set_charset_utf8mb4();
        } else {
            $this->db->query("SET CHARACTER SET utf8mb4");
        }
		foreach ($data['question_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "question_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', text = '" . $this->db->escape($value['text']) . "'");
		}

		$this->event->trigger('post.admin.question.add', $question_id);

		return $question_id;
	}

	public function editQuestion($question_id, $data) {
		$this->event->trigger('pre.admin.question.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "question SET sort_order = '" . (int)$data['sort_order'] . "' WHERE question_id = '" . (int)$question_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "question_description WHERE question_id = '" . (int)$question_id . "'");

        if(method_exists($this->db,'set_charset_utf8mb4')){
            $this->db->set_charset_utf8mb4();
        } else {
            $this->db->query("SET CHARACTER SET utf8mb4");
        }
		foreach ($data['question_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "question_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', text = '" . $this->db->escape($value['text']) . "'");
		}

		$this->event->trigger('post.admin.question.edit', $question_id);
	}

	public function deleteQuestion($question_id) {
		$this->event->trigger('pre.admin.question.delete', $question_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "question WHERE question_id = '" . (int)$question_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "question_description WHERE question_id = '" . (int)$question_id . "'");

		$this->event->trigger('post.admin.question.delete', $question_id);
	}

	public function getQuestion($question_id) {
        if(method_exists($this->db,'set_charset_utf8mb4')){
            $this->db->set_charset_utf8mb4();
        } else {
            $this->db->query("SET CHARACTER SET utf8mb4");
        }
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "question a LEFT JOIN " . DB_PREFIX . "question_description ad ON (a.question_id = ad.question_id) WHERE a.question_id = '" . (int)$question_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getQuestions($data = array()) {
	    if(method_exists($this->db,'set_charset_utf8mb4')){
            $this->db->set_charset_utf8mb4();
        } else {
            $this->db->query("SET CHARACTER SET utf8mb4");
        }
		$sql = "SELECT * FROM " . DB_PREFIX . "question a LEFT JOIN " . DB_PREFIX . "question_description ad ON (a.question_id = ad.question_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND ad.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}


		$sort_data = array(
			'ad.name',
			'a.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY ad.name";
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

	public function getQuestionDescriptions($question_id) {
		$question_data = array();

        if(method_exists($this->db,'set_charset_utf8mb4')){
            $this->db->set_charset_utf8mb4();
        } else {
            $this->db->query("SET CHARACTER SET utf8mb4");
        }
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "question_description WHERE question_id = '" . (int)$question_id . "'");

		foreach ($query->rows as $result) {
			$question_data[$result['language_id']] = array('name' => $result['name'],'text' => $result['text']);
		}

		return $question_data;
	}

	public function getTotalQuestions() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "question");

		return $query->row['total'];
	}

    public function getTotalCategoryByQuestionId($question_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category_question WHERE question_id = '" . (int)$question_id . "'");

        return $query->row['total'];
    }

}