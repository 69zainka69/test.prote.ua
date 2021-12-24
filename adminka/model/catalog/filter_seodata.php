<?php
class ModelCatalogFilterSeoData extends Model {
	public function addFilterSeoDataItem($data) {		
            
            $this->db->query("INSERT INTO " . DB_PREFIX . "filter_seo_data "        
                    . "(id, filter_group_id, filter_id, language_id, category_id, param_name, param_value)"
                    . "VALUES (NULL, "
                    . (int)$data['filter_group_id'] . ", "
                    . (int)$data['filter_id'] . ", "
                    . (int)$data['language_id'] . ", "
                    . (int)$data['category_id'] . ", "
                    . "'" . $data['param_name'] . "', "
                    . "'" . $data['param_value'] . "')");

            $fsd_id = $this->db->getLastId();

            return $fsd_id;
	}

	public function editFilterSeoDataItem($fsd_id, $data) {	           
            $this->db->query("UPDATE " . DB_PREFIX . "filter_seo_data "
                    . "SET "
                    . "filter_group_id = " . (int)$data['filter_group_id'] . ", "
                    . "filter_id = " . (int)$data['filter_id'] . ", "
                    . "language_id = " . (int)$data['language_id'] . ", "
                    . "category_id = " . (int)$data['category_id'] . ", "
                    . "param_name = '" . $data['param_name'] . "', "
                    . "param_value = '" . $data['param_value'] . "' "
                    . "WHERE id = '" . (int)$fsd_id . "'");
        }

	public function deleteFilterSeoDataItem($fsd_id) {            
            $this->db->query("DELETE FROM " . DB_PREFIX . "filter_seo_data WHERE id = '" . (int)$fsd_id . "'");
	}

	public function getFilterSeoDataItem($fsd_id) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_seo_data WHERE id = '" . (int)$fsd_id . "'");
            return $query->row;
	}
        
        public function getFilterGroupList() {
            $query = $this->db->query("SELECT `filter_group_id`, `name` FROM `oc_filter_group_description` WHERE `language_id`='" . 1 . "' ORDER BY `name`");
            return $query->rows;
	}
        public function getFilters() {
            $query = $this->db->query("SELECT `filter_id`, `name` FROM `oc_filter_description` WHERE `language_id`='" . 1 . "' ORDER BY `name`");
            return $query->rows;
	}
        public function getCategories() {
            $query = $this->db->query("SELECT `category_id`, `name` FROM `oc_category_description` WHERE `language_id`='" . 1 . "' ORDER BY `name`");
            return $query->rows;
	}
        

	public function getFilterSeoDataItems($data = array()) {
            $sql = "SELECT id, cd.name, fgd.name as fgname, fd.name as fname, param_name FROM " . DB_PREFIX . "filter_seo_data fsd LEFT JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = fsd.category_id AND cd.language_id=fsd.language_id) LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (fgd.filter_group_id = fsd.filter_group_id AND fgd.language_id=fsd.language_id) LEFT JOIN " . DB_PREFIX . "filter_description fd ON (fd.filter_id = fsd.filter_id AND fd.language_id=fsd.language_id)";
            
            if (!empty($data['filter_category'])) {
                $sql .= " WHERE cd.name LIKE '" . $this->db->escape($data['filter_category']) . "%'";
            }
                
            $sort_data = array(
                'cd.name',
                'fgd.name',
                'fd.name'                    
            );

            
            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
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

	public function getTotalFilterSeoDataItems($data = array()) {
            
            $sql="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "filter_seo_data fsd LEFT JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = fsd.category_id AND cd.language_id=fsd.language_id)";
            
            if (!empty($data['filter_category'])) {
                $sql .= " WHERE cd.name LIKE '" . $this->db->escape($data['filter_category']) . "%'";
            }
            
            $query = $this->db->query($sql);

            return $query->row['total'];
	}
}