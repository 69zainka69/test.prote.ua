<?php
class ControllerModuleDiscount extends Controller {
	private $error = array(); 
	 
	public function index() {

	
		$this->load->language('module/discount');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		$this->load->model('catalog/discount');
		$this->load->model('catalog/manufacturer');
		$this->load->model('customer/customer_group');
		
		
		
		$data['discount_data'] = $this->model_catalog_discount->getSetting('discount');
		
		
		if(($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->validate()){
		    $data['error'] = $this->validate(true);
      		$data['discount_data'] = $_POST['discount'];
    	}
    
		
		
		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()){
			$this->model_catalog_discount->editSetting('discount', $this->request->post['discount']);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
      
      
			//DEBUG //$this->redirect($this->url->link('module/discount', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
    
    
  
    
    
    
    
    
		$primary_currency                     = $this->model_catalog_discount->getPrimaryCurrency();
		$data['primary_currency_code']  = $primary_currency['code'];
		$data['manufacturers']          = $this->model_catalog_manufacturer->getManufacturers();
		$data['customer_groups']        = $this->model_customer_customer_group->getCustomerGroups();


  //language
		$data['heading_title']                  = $this->language->get('heading_title');
		$data['text_enabled']                   = $this->language->get('text_enabled');
		$data['text_disabled']                  = $this->language->get('text_disabled');
		$data['text_status']                    = $this->language->get('text_status');
		$data['button_save']                    = $this->language->get('button_save');
		$data['button_cancel']                  = $this->language->get('button_cancel');
		$data['text_status_i']                  = $this->language->get('text_status_i');
		$data['text_fulltime_discount']         = $this->language->get('text_fulltime_discount');
		$data['text_fulltime_discount_i']       = $this->language->get('text_fulltime_i');
		$data['text_discount_date']             = $this->language->get('text_discount_date');
		$data['text_discount_date_i']           = $this->language->get('text_discount_date_i');
		$data['text_discount_date_start']       = $this->language->get('text_discount_date_start');
		$data['text_discount_date_end']         = $this->language->get('text_discount_date_end');
		$data['text_discount_type']             = $this->language->get('text_discount_type');
		$data['text_discount_type_i']           = $this->language->get('text_discount_type_i');
		$data['text_percentage']                = $this->language->get('text_percentage');
		$data['text_fixed']                     = $this->language->get('text_fixed');
		$data['text_discount_value']            = $this->language->get('text_discount_value');
		$data['text_discount_value_i']          = $this->language->get('text_discount_value_i');
		$data['text_enabled']                   = $this->language->get('text_enabled');
		$data['text_disabled']                  = $this->language->get('text_disabled');
		$data['text_type_of_discount']          = $this->language->get('text_type_of_discount');
		$data['text_fulltime']                  = $this->language->get('text_fulltime');
		$data['text_category']                  = $this->language->get('text_category');
		$data['text_action']                    = $this->language->get('text_action');
		$data['text_include_subcategories']     = $this->language->get('text_include_subcategories');
		$data['text_remove']                    = $this->language->get('text_remove');
		$data['text_add_category']              = $this->language->get('text_add_category');
		$data['text_add_manufacturer']          = $this->language->get('text_add_manufacturer');
		$data['text_add_customer_group']        = $this->language->get('text_add_customer_group');
		$data['text_manufacturer']              = $this->language->get('text_manufacturer');
		$data['text_select_manufacturer']       = $this->language->get('text_select_manufacturer');
		$data['text_select_customer_group']     = $this->language->get('text_select_customer_group');
		$data['text_customer_group']            = $this->language->get('text_customer_group');
		$data['text_module_setting']            = $this->language->get('text_module_setting');
		$data['text_include_special']           = $this->language->get('text_include_special');
		$data['text_include_special_i']         = $this->language->get('text_include_special_i');
		$data['text_include_options']           = $this->language->get('text_include_options');
		$data['text_include_options_i']         = $this->language->get('text_include_options_i');
		$data['text_yes']                       = $this->language->get('text_yes');
		$data['text_no']                        = $this->language->get('text_no');
		$data['text_discount_total']            = $this->language->get('text_discount_total');
		$data['text_discount_category']         = $this->language->get('text_discount_category');
		$data['text_discount_customer_group']   = $this->language->get('text_discount_customer_group');
		$data['text_discount_manufacturer']     = $this->language->get('text_discount_manufacturer');
		$data['text_module_status']             = $this->language->get('text_module_status');
		
		
		
		$this->load->model('catalog/category');
		
    
    
		$filter_data = array(
			'sort'  => 'name',
			'order' => 'ASC',
			'start' => 0,
			'limit' => 999999
		);
		$data['categories'] = $this->model_catalog_category->getCategories($filter_data);
    
    
    
		
		
		
		

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}


		$data['breadcrumbs'] = array();
 		$data['breadcrumbs'][] = array(
   		'text'      => $this->language->get('text_home'),
  		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
  		'separator' => false
 		);

 		$data['breadcrumbs'][] = array(
   		'text'      => $this->language->get('text_module'),
    	'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
   		'separator' => ' :: '
 		);
	
 		$data['breadcrumbs'][] = array(
   		'text'      => $this->language->get('heading_title'),
  		'href'      => $this->url->link('module/discount', 'token=' . $this->session->data['token'], 'SSL'),
  		'separator' => ' :: '
 		);
		
		
		$data['action'] = $this->url->link('module/discount', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$data['token'] = $this->session->data['token'];


		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/discount.tpl', $data));
	}
	

	 function validate($get_errors = false) {
	 
	    $data['error'] = false;
	  
  	  if(isset($data['discount_data']['setting']['status']) AND $data['discount_data']['setting']['status'] == '0'){
  	    return true;
   	  }else{
		
      if (!$this->user->hasPermission('modify', 'module/discount')) {
  			$this->error['warning'] = $this->language->get('error_permission');
  		}
		
      $data['discount_data'] = $this->request->post['discount'];
  		
  		
  		
  	  if(isset($data['discount_data']['setting']['discount_type']) AND $data['discount_data']['setting']['discount_type'] == 'customer_group'){
     	 $i = 1;
     	 $discount_type = 'customer_group';
     	 if(isset($data['discount_data'][$discount_type])){
      	 foreach($data['discount_data'][$discount_type] as $customer_group){
           if(!isset($customer_group['fulltime']) AND $customer_group['discount_start'] == ""){
      			 $data['error'][$discount_type][$i]['discount_start'] = true;
           }
           if(!isset($customer_group['fulltime']) AND $customer_group['discount_stop'] == ""){
      			 $data['error'][$discount_type][$i]['discount_stop'] = true;
           }
           if(!isset($customer_group['discount_value']) || $customer_group['discount_value'] == ""){
      		 	 $data['error'][$discount_type][$i]['discount_value'] = true;
           }
           $i++;
          }
        }
      }
   
		
  	 
  	  if(isset($data['discount_data']['setting']['discount_type']) AND $data['discount_data']['setting']['discount_type'] == 'manufacturer'){
    	  $i = 1;
    	  $discount_type = 'manufacturer';
    	  if(isset($data['discount_data'][$discount_type])){
      	  foreach($data['discount_data'][$discount_type] as $manufacturer){
            if(!isset($manufacturer['fulltime']) AND $manufacturer['discount_start'] == ""){
      		 	  $data['error'][$discount_type][$i]['discount_start'] = true;
            }
            if(!isset($manufacturer['fulltime']) AND $manufacturer['discount_stop'] == ""){
      			  $data['error'][$discount_type][$i]['discount_stop'] = true;
            }
            if(!isset($manufacturer['discount_value']) || $manufacturer['discount_value'] == ""){
      			  $data['error'][$discount_type][$i]['discount_value'] = true;
            }
          $i++;
         }
        }
      }
    		
  	
  	  if(isset($data['discount_data']['setting']['discount_type']) AND $data['discount_data']['setting']['discount_type'] == 'category'){
    	  $i = 1;
    	  $discount_type = 'category';
    	  if(isset($data['discount_data'][$discount_type])){
      	  foreach($data['discount_data'][$discount_type] as $category){
            if(!isset($category['category_id']) || $category['category_id'] == ""){
      			  $data['error'][$discount_type][$i]['category_id'] = true;
            }
            if(!isset($category['fulltime']) AND $category['discount_start'] == ""){
      			  $data['error'][$discount_type][$i]['discount_start'] = true;
            }
            if(!isset($category['fulltime']) AND $category['discount_stop'] == ""){
      			  $data['error'][$discount_type][$i]['discount_stop'] = true;
            }
            if(!isset($category['discount_value']) || $category['discount_value'] == ""){
      			  $data['error'][$discount_type][$i]['discount_value'] = true;
            }
            $i++;
          }
        }
      }
     
     
  	  if(isset($data['discount_data']['setting']['discount_type']) AND $data['discount_data']['setting']['discount_type'] == 'total'){
    	  $discount_type = 'total';
        if((!isset($data['discount_data'][$discount_type]['fulltime']) || $data['discount_data'][$discount_type]['fulltime'] == 0) AND $data['discount_data'][$discount_type]['discount_start'] == ""){
    		  $data['error'][$discount_type]['discount_start'] = true;
        }
        if((!isset($data['discount_data'][$discount_type]['fulltime']) || $data['discount_data'][$discount_type]['fulltime'] == 0) AND $data['discount_data'][$discount_type]['discount_stop'] == ""){
    		  $data['error'][$discount_type]['discount_stop'] = true;
        }
        if(!isset($data['discount_data'][$discount_type]['discount_value']) || $data['discount_data'][$discount_type]['discount_value'] == ""){
    		  $data['error'][$discount_type]['discount_value'] = true;
        }
      }
     
     
 		  if($data['error']){
	 		  $this->error['warning'] = $this->language->get('error_form');
		  }
	
      
      if($get_errors){
        return $data['error'];
      }
  
  		if (!$this->error) {
  			return true;
  		}else{
  			return false;
  		}
		
  	}
	}
	
}
?>