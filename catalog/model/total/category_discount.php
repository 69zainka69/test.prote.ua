<?php
class ModelTotalCategoryDiscount extends Model {
	private $total_sum = 0;
	private $total_discount = 0;
	public function getTotal(&$total_data, &$total, &$taxes) {
		
		vdump($this->config->get('module_discounts_pack_status'));
		vdump($this->cart->hasProducts());
		vdump($this->config->get('total_category_discount_status'));

		if ($this->config->get('module_discounts_pack_status') && $this->cart->hasProducts() && $this->config->get('total_category_discount_status')) {

		}
		
		//category
	    //if($setting['discount_type'] == 'category'){

		$query      = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `code` = 'discount' AND `key` = 'category'");

	    $categories_disc = unserialize($query->row['value']);
	    
	    $current_discount = false;

	    foreach ($categories_disc as $key => $discount) {
	    	$in_categories[] = $discount['category_id'];
	    	if(isset($discount['subcategories']) && $discount['subcategories']){
	    		$query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "category WHERE `parent_id` = '".(int)$discount['category_id']."'");
	    		if($query->rows){
	    			//vdump($query);
	    			foreach ($query->rows as $cat) {
	    				$in_categories[] = $cat['category_id'];
	    			}
	    		}
	    		$categories_disc[$key]['in_categories'] = $in_categories;
	    	}
	    }


	    $products = $this->cart->getProducts();

	    foreach ($categories_disc as $key => $discount) {
	    	if(isset($discount['in_categories']) && $discount['in_categories']){
				foreach ($products as $product) {
					if(in_array($product['category_id'],$discount['in_categories'])){
						//vdump($product['total']);
						$categories_disc[$key]['total'] +=$product['total'];
					}
				}
			}
		}

		$discount_value = false;
		foreach ($categories_disc as $key => $discount) {
			if(isset($discount['total']) && $discount['total']>$discount['amount_from']){
				//$discount_value = $discount['total'];
			}
		}
	    
	    
	    //if($current_discount){

		/*$products = $this->cart->getProducts();

			foreach ($products as $key => $product) {
				vdump($product);
				$discount = $this->getCategoryDiscountSetting($product['product_id'],$product['total']);
				vdump($this->total_discount);
				vdump($discount);
				if($discount){
					$total_sum+=$product['total'];
				}
		        
		        
		        if($discount){
		            $discount_available = $this->isDiscountAvailable($discount['discount_start'],$discount['discount_stop']);
		        }
			}*/
		//}
	        
	    //}
	}

	public function getCategoryDiscountSetting($product_id,$total){
  
	  
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
	        	foreach ( $query->rows as $key => $row) {
		          $actual_category = $row;
		          $parent_id = $actual_category['category_id'];
		          $discount_categories[] = $actual_category['category_id'];
		          $subcategories[$discount_category['category_id']][] = $actual_category['category_id'];

		      
		      
		          $continue_to_subcategory = true;
		          while($continue_to_subcategory){
		            $query2           = $this->db->query("SELECT parent_id,category_id FROM " . DB_PREFIX . "category WHERE `parent_id` = '".(int)$parent_id."'");
		          
		            if($query2->row){
		            	
		              $parent_category = $query2->row;
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

	    }
	    vdump($discount_categories);
	    
	    
	    
	    
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
	        	vdump($category);
	          if($category['category_id'] == $discount_category_id){
	            if(isset($category['fulltime']) AND $category['fulltime'] == 1){
	              $category_setting[$discount_category_id]['fulltime']       = true;
	              $category_setting[$discount_category_id]['discount_start'] = false;
	              $category_setting[$discount_category_id]['discount_stop']  = false;
	            }else{
	              $category_setting[$discount_category_id]['fulltime']       = false;
	              $category_setting[$discount_category_id]['discount_start'] = $category['discount_start'];
	              $category_setting[$discount_category_id]['discount_stop']  = $category['discount_stop'];
	            }
	            $category_setting[$discount_category_id]['discount_type']    = $category['discount_type'];
	            $category_setting[$discount_category_id]['discount_from']    = $category['discount_from'];
	            $category_setting[$discount_category_id]['amount_from']   = $category['amount_from'];
	            $category_setting[$discount_category_id]['amount_to']   = $category['amount_to'];
	            $category_setting[$discount_category_id]['total']   += $total;
	          }
	        }

	    }
	    
	    
	    
	  	return $category_setting;

	  }
	
	public function getTotal1($total) {

			/*if ($this->config->get('module_discounts_pack_status') && $this->cart->hasProducts() && $this->config->get('total_category_discount_status')) {
				$this->load->language('extension/total/category_discount');
				$this->load->model('extension/module/discount');
			
				$discount_total = 0;
						
				foreach ($this->cart->getProducts() as $product) {
					$discount = 0;

					$category_discount = $this->model_extension_module_discount->getCategoryDiscount($product['product_id']);

					if ($category_discount) {
						$discount = $product['total'] / 100 * $category_discount['percentage'];

						if (!empty($this->config->get('module_discounts_pack_rounding'))) {
							if ($this->config->get('module_discounts_pack_rounding') != 'none') {
								$precision =  !empty($this->config->get('module_discounts_pack_rounding_precision')) ? (int)$this->config->get('module_discounts_pack_rounding_precision') : 0 ;
								$mode = $this->config->get('module_discounts_pack_rounding') == 'up' ? PHP_ROUND_HALF_UP : PHP_ROUND_HALF_DOWN ;
								$discount = round((float)$discount,$precision,$mode);
							}
						}
						
						if ($product['tax_class_id']) {
							$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);

							foreach ($tax_rates as $tax_rate) {
								if ($tax_rate['type'] == 'P') {
									if (version_compare(VERSION, '2.2', '>=') && !empty($total['taxes'][$tax_rate['tax_rate_id']])) { 
										$total['taxes'][$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
									} elseif (!empty($taxes[$tax_rate['tax_rate_id']])) {
										$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
									}
								}
							}
			
						}
			
						if (empty($discount_data[strtolower($category_discount['name'])])) {
						
							$parts = explode('.', $category_discount['percentage']);
							$discount_data[strtolower($category_discount['name'])] = array(
								'code'       => 'category_discount',
								'title'      => sprintf($this->language->get('text_category_discount'), '-' . (($parts[1]) == '0000' ? $parts[0] : number_format($category_discount['percentage'], 2)). '%', $category_discount['name']),
								'value'      => -$discount,
								'sort_order' => $this->config->get('total_category_discount_sort_order')
							);	
						} else {
							$discount_data[strtolower($category_discount['name'])]['value'] += -$discount;
			
						}
			
						$discount_total += $discount;
					}
				}
				if (!empty($discount_data)) {
					foreach ($discount_data as $key) {
						
						if (version_compare(VERSION, '2.2', '>=')) { 
							$total['totals'][] = array(
								'code'       => $key['code'],
								'title'      => $key['title'],
								'value'      => $key['value'],
								'sort_order' => $key['sort_order']
							);
						} else {
							$total_data[] = array(
								'code'       => $key['code'],
								'title'      => $key['title'],
								'value'      => $key['value'],
								'sort_order' => $key['sort_order']
							);
						}
					}
				}
				if (version_compare(VERSION, '2.2', '>=')) { 
					$total['total'] -= $discount_total;
				} else {
					$total -= $discount_total;
				}
			}*/
	}
}