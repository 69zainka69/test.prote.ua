<?php
class ModelExtensionNews extends Model {
	public function addNews($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "', date_added = NOW(), status = '" . (int)$data['status'] . "',
			date_start = '" . $this->db->escape($data['date_start']) . "',
			date_end = '" . $this->db->escape($data['date_end']) . "',
			type = '" . (int)$data['type'] . "', 
			gift = '" . $this->db->escape($data['gift']) . "'
		 ");
		
		$news_id = $this->db->getLastId();
		
		foreach ($data['news'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		$this->cache->delete('seo_pro');
	}
	
	public function editNews($news_id, $data) {
                // file_put_contents('/var/www/prote.com.ua/newsupdate.log', print_r($data,1), FILE_APPEND);
		$this->db->query("UPDATE " . DB_PREFIX . "news SET status = '" . (int)$data['status'] . "', 
			date_start = '" . $this->db->escape($data['date_start']) . "',
			date_end = '" . $this->db->escape($data['date_end']) . "',
			type = '" . (int)$data['type'] . "',
			gift = '" . $this->db->escape($data['gift']) . "' 
			WHERE news_id = '" . (int)$news_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id. "'");
		
		foreach ($data['news'] as $key => $value) {
		   $this->db->query("INSERT INTO " . DB_PREFIX ."news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', `image` = '" . $this->db->escape($value['image']) . "'");
                   file_put_contents('/var/www/prote.com.ua/newsupdate.log', "INSERT INTO " . DB_PREFIX ."news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . ", `image` = '" . $this->db->escape($value['image']) . "'", FILE_APPEND);

		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id. "'");
		
		if ($data['keyword']) {
		    $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		$this->cache->delete('seo_pro');
	}
	
	public function getNews($news_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id . "') AS keyword FROM " . DB_PREFIX . "news WHERE news_id = '" . (int)$news_id . "'"); 
 
		if ($query->num_rows) {
			return $query->row;
		} else {
			return false;
		}
	}
        
	public function getRelated($news_id) {
		$query = $this->db->query("SELECT `product_id` FROM `" . DB_PREFIX . "product_to_news` WHERE `news_id`='" .(int)$news_id . "'"); 
                 
		if ($query->num_rows) {
			return $query->rows;
		} else {
			return false;
		}
	}
   
	public function getNewsDescription($news_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'"); 
		
		foreach ($query->rows as $result) {
			$news_description[$result['language_id']] = array(
				'title'       			=> $result['title'],
				'short_description'		=> $result['short_description'],
				'description' 			=> $result['description'],
                                'meta_description'              => $result['meta_description'],
				'meta_h1'                       => $result['meta_h1'],
				'meta_title'                    => $result['meta_title'],
				'meta_keyword'                  => $result['meta_keyword'],
				'image'                         => $result['image'],

			);
		}
		
		return $news_description;
	}
 
	public function getAllNews($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON n.news_id = nd.news_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY date_added DESC";
		
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
   
	public function deleteNews($news_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id. "'");
	}
   
	public function getTotalNews() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news");
	
		return $query->row['total'];
	}
        
        public function getProductBy($product_id) {
            $query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE product_id='".$product_id."' OR mpn='".$product_id."' OR sku='".$product_id."' LIMIT 1" );           
            if ($query->num_rows) {                
                return $query->row;
            } else {
                return false;
            }
        }
        
        public function addRelatedProduct ($news_id, $product_id) {
            $query = $this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_news SET product_id = " . (int)$product_id . ", news_id = '" . $news_id . "'"); 
        }
        
        public function delRelatedProduct ($news_id, $product_id) {
            $query = $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_news WHERE product_id = " . (int)$product_id . " AND news_id = '" . $news_id . "'");            
        }
}