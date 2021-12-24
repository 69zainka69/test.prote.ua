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
}