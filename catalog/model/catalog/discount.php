<?php
class ModelCatalogDiscount extends Model {
	
  public function getMultiDiscountPrice($product_id,$price,$special,$manufacturer_id,$option = false){
  
    $return            = false;
    $discount_available = true;
    
    
    $setting = $this->getMultiDiscountSetting('setting');
    
    
    if(isset($setting['status']) AND $setting['status'] == 1){

    //total
      if($setting['discount_type'] == 'total'){
        $discount = $this->getMultiDiscountSetting('total');
        $discount_available = $this->isDiscountAvailable($discount['discount_start'],$discount['discount_stop']);
      }
      
    //manufacturer
      if($setting['discount_type'] == 'manufacturer'){
        if(isset($manufacturer_id)){
          $discount = $this->getManufacturerDiscountSetting($manufacturer_id);
          if($discount){
            $discount_available = $this->isDiscountAvailable($discount['discount_start'],$discount['discount_stop']);
          }
        }
      }
      
    //category
      if($setting['discount_type'] == 'category'){
          $discount = $this->getCategoryDiscountSetting($product_id);
          if($discount){
            $discount_available = $this->isDiscountAvailable($discount['discount_start'],$discount['discount_stop']);
          }
      }
      
    //customer_group
      if($setting['discount_type'] == 'customer_group'){
      
      
        if(isset($_SESSION['customer_id']) AND (int)$_SESSION['customer_id'] != 0){
          $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE `customer_id` = '".(int)$_SESSION['customer_id']."'");
      		$customer_group_id = $query->row['customer_group_id'];
          
          
      	}else{
          $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `key` = 'config_customer_group_id'");
      		$customer_group_id = $query->row['value'];
      	}
        
        
        if(isset($customer_group_id)){
          $discount = $this->getCustomerGroupDiscountSetting($customer_group_id);
          if($discount){
            $discount_available = $this->isDiscountAvailable($discount['discount_start'],$discount['discount_stop']);
          }
        }
      }
      
    
      if(isset($discount['fulltime']) AND $discount['fulltime'] == 1){
        $discount_available = true;
      }
  
  
      if($discount_available AND isset($discount)){
        if($special){
        
          if($setting['special']){
            if($discount['discount_type'] == "percentage"){
              $return['price'] = $price;
              $return['special'] = $special-($special*($discount['discount_value']/100));
            }
            if($discount['discount_type'] == "fixed"){
              $return['price'] = $price;
              $return['special'] = $special-$discount['discount_value'];
            }
          }else{
            $return['price'] = $price;
            $return['special'] = $special;
          }
        }else{
          if($discount['discount_type'] == "percentage"){
            $return['price'] = $price;
            $return['special'] = $price-($price*($discount['discount_value']/100));
          }
          
          if($discount['discount_type'] == "fixed"){
            $return['price'] = $price;
            $return['special'] = $price-$discount['discount_value'];
          }
        }
      }
      
      
     if($option AND isset($setting['options']) AND $setting['options'] == 1){
       $return['option_price'] = $return['special'];
     }elseif($option AND (!isset($setting['options']) || $setting['options'] == 0)){
       $return['option_price'] = $return['price'];
     }
     
     return $return;
  
    }else{
      return false;
    }
  }
  
  
  
  
  
  
  
  public function isDiscountAvailable($date_start,$date_stop){
    $date_start = strtotime($date_start);
    $date_stop  = strtotime($date_stop);
    if(time() >= $date_start AND time() <= $date_stop){
      return true;
    }else{
      return false;
    }
  }  
  
  
  
  
  
  public function getManufacturerDiscountSetting($manufacturer_id){
  
		$manufacturer_setting = false;
		
		if(isset($manufacturer_id)){
      $query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `code` = 'discount' AND `key` = 'manufacturer'");
      $manufacturers = unserialize($query->row['value']);
      foreach($manufacturers as $manufacturer){
        if($manufacturer['manufacturer_id'] == $manufacturer_id){
          if(isset($manufacturer['fulltime']) AND $manufacturer['fulltime'] == 1){
            $manufacturer_setting['fulltime']     = true;
          $manufacturer_setting['discount_start'] = false;
          $manufacturer_setting['discount_stop']  = false;
          }else{
            $manufacturer_setting['fulltime']     = false;
          $manufacturer_setting['discount_start'] = $manufacturer['discount_start'];
          $manufacturer_setting['discount_stop']  = $manufacturer['discount_stop'];
          }
          $manufacturer_setting['discount_type'] = $manufacturer['discount_type'];
          $manufacturer_setting['discount_value'] = $manufacturer['discount_value'];
        }
      
      }
    }
		return $manufacturer_setting;
  }
  
  
  
  
  
  public function getCategoryDiscountSetting($product_id){
  
  
    $product_in_categories = array();
    $query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE `product_id` = '".(int)$product_id."'");
    if($query->rows){
      foreach($query->rows as $product_category_id){
        $product_in_categories[] = $product_category_id['category_id'];
      }
    }
    
  
  
  
  
  
  
    $query      = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `code` = 'discount' AND `key` = 'category'");
    $categories = unserialize($query->row['value']);
    
      
      
    $discount_categories = array();
    foreach($categories as $discount_category){
      $discount_categories[] = $discount_category['category_id'];
      
      
      if(isset($discount_category['subcategories'])){
        $query = $this->db->query("SELECT parent_id,category_id FROM " . DB_PREFIX . "category WHERE `parent_id` = '".(int)$discount_category['category_id']."'");
        if($query->row){
          $actual_category = $query->row;
          $parent_id = $actual_category['category_id'];
          $discount_categories[] = $actual_category['category_id'];
          $subcategories[$discount_category['category_id']][] = $actual_category['category_id'];
      
      
          $continue_to_subcategory = true;
          while($continue_to_subcategory){
            $query           = $this->db->query("SELECT parent_id,category_id FROM " . DB_PREFIX . "category WHERE `parent_id` = '".(int)$parent_id."'");
            if($query->row){
              $parent_category = $query->row;
              $parent_id       = $parent_category['category_id'];
              $discount_categories[] = $parent_category['category_id'];
              $subcategories[$discount_category['category_id']][] = $parent_category['category_id'];
            }else{
              $continue_to_subcategory = false;
            }
          }
        }
      }
    }
    
    
    
    
    // DUMPING
    /*
    foreach($discount_categories as $c){
      echo $c."<br />";
    }
    */
    
    
    //check if is in discount category
    /*
    $have_category_discount = false;
    if (in_array($category_id, $discount_categories)) {
      $have_category_discount = true;
    }
    */
    
    
  //check subcategories
    $discount_category_id = false;
    $have_category_discount = false;
    if(isset($subcategories)){
      foreach($subcategories as $key => $subcategory){
        foreach($product_in_categories as $product_category_id){
          if (in_array($product_category_id, $subcategory) || $key == $product_category_id) {
            $discount_category_id = $key;
            $have_category_discount = true;
          }
        }
      }
    }else{ //doesn't have subcategory
      if(isset($discount_categories)){
        foreach($product_in_categories as $product_category_id){
          if (in_array($product_category_id, $discount_categories)) {
            $discount_category_id = $product_category_id;
            $have_category_discount = true;
          }
        }
      }
    }
    
    
    
    $category_setting = false;
    if($have_category_discount AND isset($discount_category_id)){
        $query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `code` = 'discount' AND `key` = 'category'");
        $categories = unserialize($query->row['value']);
        foreach($categories as $category){
          if($category['category_id'] == $discount_category_id){
            if(isset($category['fulltime']) AND $category['fulltime'] == 1){
              $category_setting['fulltime']       = true;
              $category_setting['discount_start'] = false;
              $category_setting['discount_stop']  = false;
            }else{
              $category_setting['fulltime']       = false;
              $category_setting['discount_start'] = $category['discount_start'];
              $category_setting['discount_stop']  = $category['discount_stop'];
            }
            $category_setting['discount_type']    = $category['discount_type'];
            $category_setting['discount_value']   = $category['discount_value'];
          }
        }
    }
    
    
  	return $category_setting;

  }
  
  
  public function getProductPrice(){
		$query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `code` = 'discount' AND `key` = 'setting'");
	  $price = $query->row['price'];
  		if ((float)$product_info['special']) {
				$this->data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$this->data['special'] = false;
			}
		return $price;
  }
  
  
  
  
  
  public function getMultiDiscountSetting($key){
		$query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `code` = 'discount' AND `key` = '".$key."'");
		if($query->row){
		  return unserialize($query->row['value']);
		}else{
      return false;
    }
  }
  
  
  public function getCustomerGroupDiscountSetting($customer_group_id){
		$customer_group_setting = false;
		if(isset($customer_group_id)){
      $query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `code` = 'discount' AND `key` = 'customer_group'");
      $customer_groups = unserialize($query->row['value']);
      foreach($customer_groups as $customer_group){
        if($customer_group['customer_group_id'] == $customer_group_id){
          if(isset($customer_group['fulltime']) AND $customer_group['fulltime'] == 1){
            $customer_group_setting['fulltime']     = true;
            $customer_group_setting['discount_start'] = false;
            $customer_group_setting['discount_stop']  = false;
          }else{
            $customer_group_setting['fulltime']     = false;
            $customer_group_setting['discount_start'] = $customer_group['discount_start'];
            $customer_group_setting['discount_stop']  = $customer_group['discount_stop'];
          }
            $customer_group_setting['discount_type'] = $customer_group['discount_type'];
            $customer_group_setting['discount_value'] = $customer_group['discount_value'];
        }
      
      }
    }
		return $customer_group_setting;
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

}
?>