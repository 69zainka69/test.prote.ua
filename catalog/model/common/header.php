<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModelCommonHeader extends Model {
    
    public function getCatalogMenu($catmenu_id=false) {

        $sql ="SELECT * FROM " . DB_PREFIX . "catmenu a LEFT JOIN " . DB_PREFIX . "catmenu_description b ON a.catmenu_id=b.catmenu_id AND b.language_id = '" . (int)$this->config->get('config_language_id') . "' WHERE a.active=1 ";
        if($catmenu_id){
            $sql .=" AND a.catmenu_id = '".$catmenu_id."'";
        }
        $sql .=" ORDER by a.parent_id, a.sort";

        $query = $this->db->query($sql);
        if($catmenu_id){
            return $query->row;
        } else {
            return $query->rows;
        }
    }
    public function getCatalogMenu_new($parent_id) {

    	$sql = "SELECT * FROM " . DB_PREFIX . "catmenu a LEFT JOIN " . DB_PREFIX . "catmenu_description b ON a.catmenu_id=b.catmenu_id AND b.language_id = '" . (int)$this->config->get('config_language_id') . "' WHERE a.active=1 and a.parent_id='".(int)$parent_id."' ORDER by a.sort,a.parent_id";
    	//echo  $sql.'<br>';
        $query = $this->db->query($sql);

        return $query->rows;
    }
    public function total_pr($sessi){
		
			$product_cart = $this->cache->get($sessi.'_cart_pro_');
			$products = explode(",", $product_cart);	
			$count_produs = 0;
		
			$tot_pr = 0;
			foreach($products as $prod){
				$pr = $this->cache->get('_pro_prc'.$prod);
				$qua = $this->cache->get($sessi.'_pro_qua'.$prod);
				$count_produs = $count_produs+$qua;
				$tot_pr = $tot_pr + $pr*$qua;
			}
			$tot_pr = $tot_pr." грн.";
			return($tot_pr);
	}


	public function total_coun($sessi){
		
			$product_cart = $this->cache->get($sessi.'_cart_pro_');
			$products = explode(",", $product_cart);	
			$count_produs = 0;
		
		
			foreach($products as $prod){
				if(is_int($prod)){
				$qua = $this->cache->get($sessi.'_pro_qua'.$prod);
				$count_produs = $count_produs+$qua;
			}
			}
			
			return($count_produs);
	}
}