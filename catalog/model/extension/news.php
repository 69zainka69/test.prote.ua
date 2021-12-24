<?php
class ModelExtensionNews extends Model {	
    public function getNews($news_id,$forse=false) {
        $sql = "SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON n.news_id = nd.news_id WHERE n.news_id = '" . (int)$news_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id')."'";
        if(!$forse) {
            $sql .=" AND n.status = '1'";
        }
        $query = $this->db->query($sql);
        return $query->row; 
    }

    public function getNewsByArrayId(array $id, $forse=false) {
        $news_id = null;
       foreach($id as $ids){
           if($ids!=null && isset($ids)){
            $news_id = $ids.", ".$news_id;
           }
       }
     
        if(substr($news_id,-2)==", " && substr($news_id,-1)==" "){
            $news_id = substr($news_id,0,-2);
        }
      
        $sql = "SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON n.news_id = nd.news_id WHERE n.news_id IN($news_id) AND nd.language_id = '" . (int)$this->config->get('config_language_id')."'";
        if(!$forse) {
            $sql .=" AND n.status = '1'";
        }
        $query = $this->db->query($sql);
        return $query->rows; 
    }
    
    public function getNewsRelated($news_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_news pn LEFT JOIN " . DB_PREFIX . "product p using (product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON p.product_id = pd.product_id WHERE p.status=1 AND pn.news_id = '" . (int)$news_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        return $query->rows;
    }

    public function getNewsRelatedProducts($news_id) {
        $query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_news pn LEFT JOIN " . DB_PREFIX . "product p using (product_id) WHERE p.status=1 AND pn.news_id = '" . (int)$news_id . "' ORDER BY (p.quantity>0) DESC, p.price ASC");
        return $query->rows;
    }


    public function getAllNews($data=array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON n.news_id = nd.news_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' ORDER BY date_added DESC";

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

    public function getTotalNews() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news WHERE status=1" );

        return $query->row['total'];
    }
}
