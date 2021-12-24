<?php
class ModelCatalogCatmenu extends Model {
    public function addCatmenu($data) {

        $this->db->query("INSERT INTO " . DB_PREFIX . "catmenu SET parent_id = '" . (int)$data['parent_id'] . "', image = '" . $this->db->escape($data['image']) . "', sort = '" . (int)$data['sort_order'] . "', active = '" . (int)$data['status'] . "'");
        $catmenu_id = $this->db->getLastId();

        foreach ($data['category_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "catmenu_description SET catmenu_id = '" . (int)$catmenu_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['name']) . "',
                meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', 
             image1 = '" . $this->db->escape($value['image1']) . "', 
             image2 = '" . $this->db->escape($value['image2']) . "', 
             description1 = '" . $this->db->escape($value['description1']) . "', 
             description2 = '" . $this->db->escape($value['description2']) . "', 
             href1 = '" . $this->db->escape($value['href1']) . "', 
             href2 = '" . $this->db->escape($value['href2']) . "', 
             url = '" . $value['url'] . "'");
        }

        if (isset($data['keyword'])) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'solution_id=" . (int)$catmenu_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }
        $this->cache->delete('seo_pro');
        //$this->cache->delete('menu_categoriesru1');
        //$this->cache->delete('menu_categoriesuk1');
        $this->cache->delete('menu_html_ru');
        $this->cache->delete('menu_html_uk');
        return $catmenu_id;
    }

    public function editCatmenu($catmenu_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "catmenu SET parent_id = '" . (int)$data['parent_id'] . "', image = '" . $this->db->escape($data['image']) . "', sort = '" . (int)$data['sort_order'] . "', active = '" . (int)$data['status'] . "' WHERE catmenu_id = '" . (int)$catmenu_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "catmenu_description WHERE catmenu_id = '" . (int)$catmenu_id . "'");

        foreach ($data['category_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "catmenu_description SET catmenu_id = '" . (int)$catmenu_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['name']) . "', image1 = '" . $this->db->escape($value['image1']) . "', 
                meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', 
             image2 = '" . $this->db->escape($value['image2']) . "', 
             description1 = '" . $this->db->escape($value['description1']) . "', 
             description2 = '" . $this->db->escape($value['description2']) . "', 
             href1 = '" . $this->db->escape($value['href1']) . "', 
             href2 = '" . $this->db->escape($value['href2']) . "', 
              url = '" . $value['url'] . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'solution_id=" . (int)$catmenu_id . "'");

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'solution_id=" . (int)$catmenu_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }
        $this->cache->delete('seo_pro');
        //$this->cache->delete('menu_categoriesru1');
        //$this->cache->delete('menu_categoriesuk1');
        $this->cache->delete('menu_html_ru');
        $this->cache->delete('menu_html_uk');
    }

    public function deleteCatmenu($catmenu_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "catmenu WHERE catmenu_id = '" . (int)$catmenu_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "catmenu_description WHERE catmenu_id = '" . (int)$catmenu_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE solution_id = '" . (int)$catmenu_id . "'");
        $this->cache->delete('seo_pro');
        //$this->cache->delete('menu_categories');
        $this->cache->delete('menu_html_ru');
        $this->cache->delete('menu_html_uk');

    }

    public function getCatmenu($catmenu_id) {
        $query = $this->db->query("SELECT *, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'solution_id=" . (int)$catmenu_id . "') AS keyword FROM " . DB_PREFIX . "catmenu a LEFT JOIN " . DB_PREFIX . "catmenu_description b ON (a.catmenu_id = b.catmenu_id AND b.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE a.catmenu_id = '" . (int)$catmenu_id  ."'");
        return $query->row;
    }

    public function getCatmenusByParentId($parent_id = 0) {
        $query = $this->db->query("SELECT *, (SELECT COUNT(parent_id) FROM " . DB_PREFIX . "catmenu WHERE parent_id = c.catmenu_id) AS children FROM " . DB_PREFIX . "catmenu c LEFT JOIN " . DB_PREFIX . "catmenu_description cd ON (c.catmenu_id = cd.catmenu_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort, cd.title");
        return $query->rows;
    }

    public function getCatmenus($data = array()) {
        $sql = "SELECT a.catmenu_id, b.title, a.parent_id, a.sort, a.active FROM " . DB_PREFIX . "catmenu a LEFT JOIN " . DB_PREFIX . "catmenu_description b ON (a.catmenu_id = b.catmenu_id) WHERE b.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        /*
        if (!empty($data['filter_name'])) {
                $sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }
         *
         */

        $sql .= " GROUP BY a.catmenu_id";

        $sort_data = array(
            'title',
            'sort'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
        } else {
                $sql .= " ORDER BY sort";
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

    public function getCatmenuDescriptions($catmenu_id) {
        $category_description_data = array();
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "catmenu_description WHERE catmenu_id = '" . (int)$catmenu_id . "'");

        foreach ($query->rows as $result) {
                $category_description_data[$result['language_id']] = array(
                        'name'             => $result['title'],
                        'meta_title'             => $result['meta_title'],
                        'meta_h1'             => $result['meta_h1'],
                        'meta_description'             => $result['meta_description'],
                        'image1'             => $result['image1'],
                        'image2'             => $result['image2'],
                        'description1'             => $result['description1'],
                        'description2'             => $result['description2'],
                        'href1'             => $result['href1'],
                        'href2'             => $result['href2'],
                        'url'              => $result['url'],
                );
        }

        return $category_description_data;
    }


    public function getTotalCatmenus() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "catmenu");
        return $query->row['total'];
    }

    public function getAllCatmenus() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "catmenu c LEFT JOIN " . DB_PREFIX . "catmenu_description cd ON (c.catmenu_id = cd.catmenu_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.parent_id, c.sort, cd.title");

        $category_data = array();
        foreach ($query->rows as $row) {
                $category_data[$row['parent_id']][$row['catmenu_id']] = $row;
        }

        return $category_data;
    }

    public function getTotalCategoriesByLayoutId($layout_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

        return $query->row['total'];
    }
}
