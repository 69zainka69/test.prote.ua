<?php
class ControllerProductSearch extends Controller {
	public function index() {

		/*  header("HTTP/1.1 301 Moved Permanently"); 
		  header("Location: http://www.host.ru"); 
		  exit(); 
*/
	    $this->language->load('module/ordercallback');
	    //$this->document->addScript('catalog/view/javascript/instup/jquery.validate.min.js');

	    $this->load->model('setting/setting');
	    $ordercallback_settings = $this->model_setting_setting->getSetting('ordercallback');

	    $ordercallback_settings['modal_title'] = '';

		if ($ordercallback_settings['ordercallback_use_module']) {
	        $data['ordercallback_use_module'] = true;

	        if ($ordercallback_settings['ordercallback_module_works_as'] == 'order') {
	            $data['ordercallback_as_order'] = true;
	            $ordercallback_settings['modal_title'] = $this->language->get('modal_title_order');
	        } else {
	            $data['ordercallback_as_order'] = false;
	            $ordercallback_settings['modal_title'] = $this->language->get('modal_title_call');
	        }
	        $ordercallback_settings['ordercallback_field_comment_show'] = true;

	        $data['modal_field_name'] = $this->language->get('modal_field_name');
	        $data['modal_field_phone'] = $this->language->get('modal_field_phone');
	        $data['modal_field_email'] = $this->language->get('modal_field_email');
	        $data['modal_field_comment'] = $this->language->get('modal_field_comment');
	        $data['button_cancel'] = $this->language->get('button_cancel');
	        $data['button_send'] = $this->language->get('button_send');
	        $data['button_buy']  = $this->language->get('button_buy');
	        $data['modal_title_order']  = $this->language->get('modal_title_order');
	        $data['modal_timetable']  = $this->language->get('modal_timetable');
            $data['modal_min_order_sum'] = $this->language->get('modal_min_order_sum');
	        $data['text_quantity1'] = $this->language->get('text_quantity1');

	        $data['message_system_error'] = $this->language->get('message_system_error');
	    } else {
	        $data['ordercallback_use_module'] = false;
	    }
		    $data['ordercallback_settings'] = $ordercallback_settings;
		$data['minimum'] = 1;
        $data['price'] = 0;
        $data['thumb'] = '';
	    // **************


		
//Сверяем поиск по нашей таблице перевода поиска

$langurl = $this->config->get('config_language_id');
$arr_prod=array();
$prodone = array();
$prodtwo = array();
$searches_data = html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8');
$sql = "SELECT * FROM `oc_url_alias_search` WHERE `search` LIKE '%".$searches_data."%'";
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$groups = $rowsa['grup'];
$truesearch = $rowsa['truesearch'];
}

if(isset($truesearch)){
$sql = "SELECT * FROM `oc_url_aliases` WHERE `id_grup` = ".$groups." limit 1;";
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
	$poisk = $rowsa['prod1'];
}
$sql = "SELECT * FROM `oc_url_aliases` WHERE `prod1` = ".$poisk;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
	
	if($rowsa['tehnik']==0){
		$arr_prods[] = $rowsa['prod2'];
		$ids_grups[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==1){
		$arr_prod[] = $rowsa['prod2'];
		$ids_grup[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==2){
		$arr_prodse[] = $rowsa['prod2'];
		$ids_grupse[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==3){
		$arr_prodsea[] = $rowsa['prod2'];
		$ids_grupsea[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==4){
		$arr_prodseas[] = $rowsa['prod2'];
		$ids_grupseas[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==5){
		$arr_prodsix[] = $rowsa['prod2'];
		$ids_grupsix[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==6){
		$arr_prodseven[] = $rowsa['prod2'];
		$ids_grupseven[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==7){
		$arr_prodeight[] = $rowsa['prod2'];
		$ids_grupeight[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==8){
		$arr_prodnine[] = $rowsa['prod2'];
		$ids_grupnine[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==9){
		$arr_prodten[] = $rowsa['prod2'];
		$ids_grupten[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==10){
		$arr_prodelew[] = $rowsa['prod2'];
		$ids_grupelew[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==11){
		$arr_prodtwel[] = $rowsa['prod2'];
		$ids_gruptwel[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==12){
		$arr_prodsert[] = $rowsa['prod2'];
		$ids_grupsert[] = $rowsa['id_grup'];
	}
	if($rowsa['tehnik']==13){
		$arr_prodfort[] = $rowsa['prod2'];
		$ids_grupfort[] = $rowsa['id_grup'];
	}
	/*else{
	$arr_prod[] = $rowsa['prod2'];
	$ids_grup[] = $rowsa['id_grup'];
	}*/
}
	$prod_arrsea = array_unique($arr_prodsea);
	$prod_arrseas = array_unique($arr_prodseas);
	$prod_arrse = array_unique($arr_prodse);
	$prod_arr = array_unique($arr_prod);
	$prods_arrs = array_unique($arr_prods);
	$ids_grupse = array_unique($ids_grupse);
	$ids_grupsea = array_unique($ids_grupsea);
	$ids_grupseas = array_unique($ids_grupseas);
	$ids_grups = array_unique($ids_grups);
	$ids_grup = array_unique($ids_grup);
	$ids_grupsix = array_unique($ids_grupsix);
	$ids_grupseven = array_unique($ids_grupseven);
	$prod_arrseven = array_unique($arr_prodseven);
	$prod_arrsix = array_unique($arr_prodsix);
	$ids_grupeight = array_unique($ids_grupeight);
	$prod_arreight = array_unique($arr_prodeight);

	$ids_grupnine = array_unique($ids_grupnine);
	$prod_arrnine = array_unique($arr_prodnine);

	$ids_grupten = array_unique($ids_grupten);
	$prod_arrten = array_unique($arr_prodten);

	$ids_grupelew = array_unique($ids_grupelew);
	$prod_arrelew = array_unique($arr_prodelew);

	$ids_gruptwel = array_unique($ids_gruptwel);
	$prod_arrtwel = array_unique($arr_prodtwel);

	$ids_grupsert = array_unique($ids_grupsert);
	$prod_arrsert = array_unique($arr_prodsert);

	$ids_grupfort = array_unique($ids_grupfort);
	$prod_arrfort = array_unique($arr_prodfort);
$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grup[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catone = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupnine[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catnine = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupten[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catten = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupelew[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catelew = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_gruptwel[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$cattwel = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupsert[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catsert = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupfort[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catfort = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupseven[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catseven = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupeight[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$cateight = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupsix[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catsix = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grups[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$cattwo = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupse[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catthree = $rowsa['name_grup'];
}

$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupsea[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catfour = $rowsa['name_grup'];
}
$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = ".$ids_grupseas[0]." AND `lang` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$catfive = $rowsa['name_grup'];
}

foreach($prod_arr as $names_prod){
$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$prodone[] = $rowsa['name'];
}}
 
foreach($prod_arrse as $names_prod){
	$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
	$query = $this->db->query($sql);
	foreach($query->rows as $rowsa){
	$prodthree[] = $rowsa['name'];
	}}
 
	foreach($prod_arrsea as $names_prod){
		$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
		$query = $this->db->query($sql);
		foreach($query->rows as $rowsa){
		$prodfour[] = $rowsa['name'];
		}}
	foreach($prod_arrseas as $names_prod){
			$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
			$query = $this->db->query($sql);
			foreach($query->rows as $rowsa){
			$prodfive[] = $rowsa['name'];
			}}
			foreach($prod_arrsix as $names_prod){
				$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
				$query = $this->db->query($sql);
				foreach($query->rows as $rowsa){
				$prodsix[] = $rowsa['name'];
				}}
				foreach($prod_arrseven as $names_prod){
					$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
					$query = $this->db->query($sql);
					foreach($query->rows as $rowsa){
					$prodseven[] = $rowsa['name'];
					}}
					foreach($prod_arreight as $names_prod){
						$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
						$query = $this->db->query($sql);
						foreach($query->rows as $rowsa){
						$prodeight[] = $rowsa['name'];
						}}
						foreach($prod_arrnine as $names_prod){
							$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
							$query = $this->db->query($sql);
							foreach($query->rows as $rowsa){
							$prodnine[] = $rowsa['name'];
							}}
							foreach($prod_arrten as $names_prod){
								$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
								$query = $this->db->query($sql);
								foreach($query->rows as $rowsa){
								$prodten[] = $rowsa['name'];
								}}
								foreach($prod_arrelew as $names_prod){
									$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
									$query = $this->db->query($sql);
									foreach($query->rows as $rowsa){
									$prodelew[] = $rowsa['name'];
									}}
									foreach($prod_arrtwel as $names_prod){
										$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
										$query = $this->db->query($sql);
										foreach($query->rows as $rowsa){
										$prodtwel[] = $rowsa['name'];
										}}
										foreach($prod_arrsert as $names_prod){
											$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
											$query = $this->db->query($sql);
											foreach($query->rows as $rowsa){
											$prodsert[] = $rowsa['name'];
											}}
											foreach($prod_arrfort as $names_prod){
												$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
												$query = $this->db->query($sql);
												foreach($query->rows as $rowsa){
												$prodfort[] = $rowsa['name'];
												}}
foreach($prods_arrs as $names_prod){
$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` = ".$names_prod." AND `language_id` = ".$langurl;
$query = $this->db->query($sql);
foreach($query->rows as $rowsa){
$prodtwo[] = $rowsa['name'];
}}
$prodone = array_unique($prodone);
$prodtwo = array_unique($prodtwo);
$prodfour = array_unique($prodfour);
$prodfive = array_unique($prodfive);
$prodthree = array_unique($prodthree);
$prodsix = array_unique($prodsix);
$prodseven = array_unique($prodseven);
$prodeight = array_unique($prodeight);
$prodeight = array_unique($prodnine);
$prodeight = array_unique($prodten);
$prodeight = array_unique($prodelew);
$prodeight = array_unique($prodtwel);
$prodeight = array_unique($prodsert);
$prodeight = array_unique($prodfort);
}

else{
	$prodone=null;
	$prodtwo=null;
	$prodthree=null;
	$prodfour=null;
	$prodfive=null;
	$prodsix=null;
	$prodseven=null;
	$prodeight=null;
	$prodnine=null;
	$prodten=null;
	$prodelew=null;
	$prodtwel=null;
	$prodsert=null;
	$prodfort=null;
	$cattwo=null;
	$catthree=null;
	$catfour=null;
	$catfive=null;
	$catone=null;
	$catsix=null;
	$catseven=null;
	$cateight=null;
	$catnine=null;
	$catten=null;
	$catelew=null;
	$cattwel=null;
	$catsert=null;
	$catfort=null;
}

//Конец поиска и нахождение принтеров

		$this->load->language('product/search');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
        $this->load->model('extension/news');

        $data['text_action'] = $this->language->get('text_action');


		if (isset($this->request->get['search'])) {
			if(isset($truesearch)){
			$search = $truesearch;
		}else{
			$search = $this->request->get['search'];
		}
		} else {
			$search = '';
		}

	    if (isset($this->request->get['prn'])) {
	      $searchprn = $this->request->get['prn'];
		} else {
      		$searchprn = '';
		}

	    if (isset($this->request->get['br'])) {
	      $searchbrand = $this->request->get['br'];
		} else {
      // Найти бренд из названия устройства!!!
      $searchbrand = '';

		}

		if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
		} elseif (isset($this->request->get['search'])) {
		
if(isset($truesearch)){
	$tag = $truesearch;
} else{			
			$tag = $this->request->get['search'];
		}} else {
			$tag = '';
		}

		if (isset($this->request->get['description'])) {
			$description = $this->request->get['description'];
		} else {
			$description = '';
		}

		if (isset($this->request->get['category_id'])) {
			$category_id = $this->request->get['category_id'];
		} elseif(isset($truesearch)){
			$category_id = 31;
		} else{
			$category_id = 0;
		}

		if (isset($this->request->get['sub_category'])) {
			$sub_category = $this->request->get['sub_category'];
		} else {
			$sub_category = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.price';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}

		if (isset($this->request->get['search'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ':"' . $this->request->get['search']).'"';
		} elseif (isset($this->request->get['tag'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ':"' . $this->language->get('heading_tag') . $this->request->get['tag']).'"';
		} else {
			$this->document->setTitle($this->language->get('heading_title'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$url = '';

		/*if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}*/

    	if (isset($this->request->get['br'])) {
			$url .= '&br=' . urlencode(html_entity_decode($this->request->get['br'], ENT_QUOTES, 'UTF-8'));
		}

    	if (isset($this->request->get['prn'])) {
			$url .= '&prn=' . urlencode(html_entity_decode($this->request->get['prn'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['tag'])) {
			$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['description'])) {
			$url .= '&description=' . $this->request->get['description'];
		}

		if (isset($this->request->get['category_id'])) {
			$url .= '&category_id=' . $this->request->get['category_id'];
		}
		if(isset($truesearch) && !isset($this->request->get['category_id'])){
			$url .= '&category_id=31';
		}
		if(isset($truesearch)) {
			$url .= '&truezap='.$truesearch;
		}
		

		/*if (isset($this->request->get['sub_category'])) {
			$url .= '&sub_category=' . $this->request->get['sub_category'];
		}*/

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}


		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('product/search', $url)
		);

		if (isset($this->request->get['search'])) {
			$data['heading_title'] = $this->language->get('heading_title') .  ':"' . $this->request->get['search'].'"';
		} else {
			$data['heading_title'] = $this->language->get('heading_title');
		}

		$data['text_minimum'] = $this->language->get('text_minimum');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_search'] = $this->language->get('text_search');
		$data['text_keyword'] = $this->language->get('text_keyword');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_sub_category'] = $this->language->get('text_sub_category');
		$data['text_quantity'] = $this->language->get('text_quantity');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_model'] = $this->language->get('text_model');
		$data['text_price'] = $this->language->get('text_price');
		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_points'] = $this->language->get('text_points');
		$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$data['text_sort'] = $this->language->get('text_sort');
		$data['text_limit'] = $this->language->get('text_limit');
	    $data['text_searchtypes'] = $this->language->get('text_searchtypes');
	    $data['text_skeyword'] = $this->language->get('text_skeyword');
	    $data['text_sprinter'] = $this->language->get('text_sprinter');
	    $data['text_sgeneral'] = $this->language->get('text_sgeneral');
	    $data['text_resultcat'] = $this->language->get('text_resultcat');
	    $data['text_searchcat'] = $this->language->get('text_searchcat');
	    $data['text_selbrand'] = $this->language->get('text_selbrand');
	    $data['text_selmodel'] = $this->language->get('text_selmodel');
	    $data['text_select'] = $this->language->get('text_select');
	    $data['text_exist'] = $this->language->get('text_exist');
	    $data['text_preorder'] = $this->language->get('text_preorder');
	    $data['text_wait'] = $this->language->get('text_wait');
	    $data['text_noexist'] = $this->language->get('text_noexist');

		$data['entry_search'] = $this->language->get('entry_search');
		$data['entry_description'] = $this->language->get('entry_description');

		$data['button_search'] = $this->language->get('button_search');
		$data['button_cart'] = $this->language->get('button_cart');
    	$data['button_cartone'] = $this->language->get('button_cartone');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['button_list'] = $this->language->get('button_list');
		$data['button_grid'] = $this->language->get('button_grid');
    	$data['text_searchkey'] = $this->language->get('text_searchkey');

		$data['compare'] = $this->url->link('product/compare');

		$this->load->model('catalog/category');


		// 3 Level Category Search
		$data['categories'] = array();

		$categories_1 = $this->model_catalog_category->getCategories(0);

		foreach ($categories_1 as $category_1) {
			$level_2_data = array();

			$categories_2 = $this->model_catalog_category->getCategories($category_1['category_id']);

			foreach ($categories_2 as $category_2) {
				$level_3_data = array();

				$categories_3 = $this->model_catalog_category->getCategories($category_2['category_id']);

				foreach ($categories_3 as $category_3) {
					$level_3_data[] = array(
						'category_id' => $category_3['category_id'],
						'name'        => $category_3['name'],
					);
				}

				$level_2_data[] = array(
					'category_id' => $category_2['category_id'],
					'name'        => $category_2['name'],
					'children'    => $level_3_data,
				);
			}

			$data['categories'][] = array(
				'category_id' => $category_1['category_id'],
				'name'        => $category_1['name'],
				'children'    => $level_2_data,
			);
		}


	    // Список брендов
	    $data['brands'] = array();
	    $results = $this->model_catalog_product->getPrinterBrands();

		foreach ($results as $result) {
			$data['brands'][] = array(
				'brand' => $result['brand'],
			);
		}

		$data['products'] = array();


        /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
        /* Show product list in any case */
		if (true) {
        /* Brainy Filter Pro (brainyfilter.xml) - End ->*/

			$filter_data = array(
				'filter_name'         => $search,
                'filter_brand'        => $searchbrand,
                'filter_prn'          => $searchprn,
				'filter_tag'          => $tag,
				'filter_description'  => $description,
				'filter_category_id'  => $category_id,
				'filter_sub_category' => $sub_category,
				'price_min'                => 0,
				'sort'                => $sort,
				'order'               => $order,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
			);


	        /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
			$settings = $this->config->get('brainyfilter_layout_basic');
			if (isset($settings['global']['subcategories_fix']) && $settings['global']['subcategories_fix']) {
				$filter_data['filter_sub_category'] = true;
			}
	        // $filter_data['filter_bfilter'] = true;
	        $filter_data['filter_bfilter'] = false;
	        /* Brainy Filter Pro (brainyfilter.xml) - End ->*/


		    if($searchprn) {
		          $results = $this->model_catalog_product->getProductCompabilityListByAbsNum($filter_data);
		          $product_total = $this->model_catalog_product->getProductCompabilityListByAbsNumTotal($filter_data);
		          // echo $product_total;  //count($results);
		          $data['categories'] = null;
		    } else if($search) {
                    $filter_data_n = $filter_data;

		          $product_total = $this->model_catalog_product->getTotalProducts($filter_data_n);
		          // Добавляем информацию о категориях
		          unset($filter_data_n['filter_category_id']);
		          $product_total_cat_prev = $this->model_catalog_product->getTotalProductsByCategory($filter_data_n);

		          $product_total_cat = array();
		          foreach ($product_total_cat_prev as $item) {
		              $product_total_cat[$item['category_id']]= $item['total'];
		   		  }

		          $results = $this->model_catalog_product->getProducts($filter_data);
		          // $product_total = count ($result);
                //vdump($results);
		    } else {
		          $results=array();
		          $product_total=0;
		          $data['categories'] = null;
		    }

	        $data['products_sort_brand'] = array(
	            'Prote'=>array(),
	            'FREE Label'=>array(),
	            'PATRON GREEN Label'=>array(),
	            'EXTRA Label'=>array(),
	            'PATRON Extra'=>array(),
	            'MAKKON'=>array(),
	            'OTHER'=>array()
	        );
	        $data['products_sort_brand2'] = array(
	            'type1'=>array(),
	            'type2'=>array(),
	            'type3'=>array(),
	            'type4'=>array(),
	            'type5'=>array()
	        );
	        $mas_brand = array(
	          'PE'=>'Prote',
	          'FL'=>'FREE Label',
	          'PN-GL'=>'PATRON GREEN Label',
	          'PNGL'=>'PATRON GREEN Label',
	          'EL-R'=>'EXTRA Label',
	          'ELR'=>'EXTRA Label',
	          'PN-R'=>'PATRON Extra',
	          'PNR'=>'PATRON Extra',
	          'MA'=>'MAKKON'
	        );

	        $products_ids = ''; // для Google ремаркетинга

			foreach ($results as $result) {

				$products_ids .= ",'".$result['product_id']."'"; // для Google ремаркетинга

                if ($this->model_tool_image->isImageExists($result['image'])) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('no-photo-img.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

                // Акции!
                 $action=array();
                if ($result['news']) {
                    $newslist=  explode(',', $result['news']);
                    foreach ($newslist as $news) {
                        $atcion_news = $this->model_extension_news->getNews($news);
                        if($atcion_news){
                           if (is_numeric($news)) $action[]=$atcion_news;
                        }
                    }
                }
					if(!isset($this->request->get['category_id'])){
						if(isset($truesearch)){
					$data['realsearch']= $searches_data;
					$data['prodone'] = $prodone;
					$data['catone'] = $catone;
					$data['prodtwo'] = $prodtwo;
					$data['cattwo'] = $cattwo;
					$data['prodthree'] = $prodthree;
					$data['catthree'] = $catthree;
					$data['prodfour'] = $prodfour;
					$data['catfour'] = $catfour;
					$data['prodfive'] = $prodfive;
					$data['catfive'] = $catfive;
					$data['prodsix'] = $prodsix;
					$data['catsix'] = $catsix;
					$data['prodseven'] = $prodseven;
					$data['catseven'] = $catseven;
					$data['prodeight'] = $prodeight;
					$data['cateight'] = $cateight;
					$data['catnine'] = $catnine;
					$data['prodnine'] = $prodnine;
					$data['catten'] = $catten;
					$data['prodten'] = $prodten;
					$data['catelew'] = $catelew;
					$data['prodelew'] = $prodelew;
					$data['cattwel'] = $cattwel;
					$data['prodtwel'] = $prodtwel;
					$data['catsert'] = $catsert;
					$data['prodsert'] = $prodsert;
					$data['catfort'] = $catfort;
					$data['prodfort'] = $prodfort;
						}
					}
                // Если категория лазерные принтеры то группируем картриджи
                if (isset($this->request->get['category_id']) && $this->request->get['category_id']=='31') {


					$data['realsearch']= $searches_data;
					$data['prodone'] = $prodone;
					$data['catone'] = $catone;
					$data['prodtwo'] = $prodtwo;
					$data['cattwo'] = $cattwo;
					$data['prodthree'] = $prodthree;
					$data['catthree'] = $catthree;
					$data['prodfour'] = $prodfour;
					$data['catfour'] = $catfour;
					$data['prodfive'] = $prodfive;
					$data['catfive'] = $catfive;
					$data['prodsix'] = $prodsix;
					$data['catsix'] = $catsix;
					$data['prodseven'] = $prodseven;
					$data['catseven'] = $catseven;
					$data['prodeight'] = $prodeight;
					$data['cateight'] = $cateight;
					$data['catnine'] = $catnine;
					$data['prodnine'] = $prodnine;
					$data['catten'] = $catten;
					$data['prodten'] = $prodten;
					$data['catelew'] = $catelew;
					$data['prodelew'] = $prodelew;
					$data['cattwel'] = $cattwel;
					$data['prodtwel'] = $prodtwel;
					$data['catsert'] = $catsert;
					$data['prodsert'] = $prodsert;
					$data['catfort'] = $catfort;
					$data['prodfort'] = $prodfort;

                    foreach($mas_brand as $key => $brand){
                      $key_brand = 'OTHER';
                        if(stristr($result['mpn'], $key) === FALSE) {} else {
                             $key_brand = $brand;
                            break;
                        }

                    }

                    $data['products_sort_brand'][$key_brand][] = array(
                      'product_id'  => $result['product_id'],
                      'thumb'       => $image,
                      'model'       => $result['model'],
                      'name'        => $result['name'],
                      'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                      'price'       => $price,
                      'price_float'       => round($result['price'],2),
                      'special'     => $special,
                      'special_float'       => round($result['special'],2),
                      'tax'         => $tax,
                      'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                      'rating'      => $result['rating'],
                      'ifexist'     => $result['ifexist'],
                      'quantity'    => $result['quantity'],
                      'ifexist'     => $result['ifexist'],
                      'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] . $url),
                      'action'      => $action
                  );

                } else {

    				$data['products'][] = array(
    					'product_id'  => $result['product_id'],
    					'thumb'       => $image,
    					'name'        => $result['name'],
    					'model'       => $result['model'],
    					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
    					'price'       => $price,
	                    'price_float'       => round($result['price'],2),
	                    'special'     => $special,
	                    'special_float'       => round($result['special'],2),
    					'tax'         => $tax,
    					'ifexist'     => $result['ifexist'],
                        'quantity'    => $result['quantity'],
    					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
    					'rating'      => $result['rating'],
                                            'quantity'    => $result['quantity'],
                                            'ifexist'     => $result['ifexist'],
    					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] . $url),
                                            'action'      => $action

    				);
                }
			}
			//vdump($data['products']);

			$this->session->data['products_ids'] = trim($products_ids,','); // для Google ремаркетинга

            $mas1 = array();
        	$mas2 = array();
        	$data['products_brand'] = array();
        	$prod = false;

        	foreach ($data['products_sort_brand'] as  $value) {
        		if($value){ $prod =true; break;}
        	}
        	if($prod){
	            foreach($data['products_sort_brand'] as $key => $brand){
	              foreach($brand as $key2 => $product){
	                if($key=='Prote' || $key=='FREE Label'){
	                    $mas1[$key]=$key;
	                    $data['products_sort_brand2']['type1'][]= $product;
	                    $data['text_type1'] = $this->language->get('text_type1');
	                    $data['text_type1_2'] = $this->language->get('text_type1_2');
	                    $data['text_type1_color'] = 'bee9f9';
	                }elseif($key=='PATRON GREEN Label' || $key=='MAKKON'){
	                    $mas2[$key]=$key;
	                    $data['products_sort_brand2']['type2'][]= $product;
	                    $data['text_type2'] = $this->language->get('text_type2');
	                    $data['text_type2_2'] = $this->language->get('text_type2_2');
	                    $data['text_type2_color'] = 'd6fa8b';
	                }elseif($key=='EXTRA Label'){
	                    $data['products_sort_brand2']['type3'][]= $product;
	                    $data['text_type3'] = $this->language->get('text_type3');
	                    $data['text_type3_2'] = $this->language->get('text_type3_2');
	                    $data['text_type3_color'] = 'ffde00';
	                }elseif($key=='PATRON Extra'){
	                    $data['products_sort_brand2']['type4'][]= $product;
	                    $data['text_type4'] = $this->language->get('text_type4');
	                    $data['text_type4_2'] = $this->language->get('text_type4_2');
	                    $data['text_type4_color'] = 'f7941d';
	                } else {
	                    $data['products_sort_brand2']['type5'][]= $product;
	                    $data['text_type5'] = $this->language->get('text_type5');
	                    $data['text_type5_2'] = $this->language->get('text_type5_2');
	                    $data['text_type5_color'] = 'ebebeb';
	                }
	              }

	            }
              $data['products_brand'] = $data['products_sort_brand2'];

            } else{
            	// для формы поиска
            	$this->language->load('error/not_found');

            	if($this->request->get['search']){
	            	$data['text_search1'] = $this->request->get['search'];
	            } else {}
	            if (isset($this->request->get['search'])) {
					$data['text_search1'] = '"'.$this->request->get['search'].'"';
				} elseif (isset($this->request->get['tag'])) {
					$data['text_search1'] = '"'.$this->request->get['tag'].'"';
				} else {
					$data['text_search1'] = $this->language->get('text_search1');
				}
            	$data['text_form'] = $this->language->get('text_form');
            	$data['text_send'] = $this->language->get('text_send');
            	$data['text_search'] = $this->language->get('text_empty_input');
            	$data['text_send_message'] = $this->language->get('text_send_message');
            	$data['text_send_callback'] = $this->language->get('text_send_callback');
            }


          if(count($mas1)>1){
             $data['text_type1'] = $this->language->get('text_type1');
          } else {
            if(isset($mas1['Prote'])){
                $data['text_type1'] = $this->language->get('text_cartridge') . ' Prote';
            } else {
                $data['text_type1'] = $this->language->get('text_cartridge') . ' FREE Label';
            }
          }
          if(count($mas2)>1){
             $data['text_type2'] = $this->language->get('text_type2');
          } else {
            if(isset($mas2['PATRON GREEN Label'])){
                $data['text_type2'] = $this->language->get('text_cartridge') . ' PATRON GREEN Label';
            } else {
                $data['text_type2'] = $this->language->get('text_cartridge') . ' Makkon';
            }
          }


     		$url = '';

			if (isset($this->request->get['search'])) {
	
				if(isset($truesearch)){
					$url .= '&search=' .$truesearch;
				}else{
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}}

	      if (isset($this->request->get['br'])) {
				$url .= '&br=' . urlencode(html_entity_decode($this->request->get['br'], ENT_QUOTES, 'UTF-8'));
	  		}

	      if (isset($this->request->get['prn'])) {
	  			$url .= '&prn=' . urlencode(html_entity_decode($this->request->get['prn'], ENT_QUOTES, 'UTF-8'));
	  		}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			if(isset($truesearch)){
				if(!isset($this->request->get['category_id'])){
				$url .= '&category_id=31';
			}}
			if(isset($truesearch)){
				$url .= '&truezap='. $truesearch;
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

            /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
			if (isset($this->request->get['bfilter'])) {
				$url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
			}
            /* Brainy Filter Pro (brainyfilter.xml) - End ->*/

	        $data['sorts'] = array();

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_default'),
	            'value' => 'p.sort_order-ASC',
	            'href'  => $this->url->link('product/search', 'sort=p.sort_order&order=ASC' . $url)
	        );

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_name_asc'),
	            'value' => 'pd.name-ASC',
	            'href'  => $this->url->link('product/search', '&sort=pd.name&order=ASC' . $url)
	        );

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_name_desc'),
	            'value' => 'pd.name-DESC',
	            'href'  => $this->url->link('product/search', '&sort=pd.name&order=DESC' . $url)
	        );

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_price_asc'),
	            'value' => 'p.price-ASC',
	            'href'  => $this->url->link('product/search', '&sort=p.price&order=ASC' . $url)
	        );

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_price_desc'),
	            'value' => 'p.price-DESC',
	            'href'  => $this->url->link('product/search', '&sort=p.price&order=DESC' . $url)
	        );

			$url = '';

			if (isset($this->request->get['search'])) {
			
				if(isset($truesearch)){
					$url .= '&search=' .	$truesearch;
				}else{
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}}

	      	if (isset($this->request->get['br'])) {
				$url .= '&br=' . urlencode(html_entity_decode($this->request->get['br'], ENT_QUOTES, 'UTF-8'));
	  		}

	      	if (isset($this->request->get['prn'])) {
	  			$url .= '&prn=' . urlencode(html_entity_decode($this->request->get['prn'], ENT_QUOTES, 'UTF-8'));
	  		}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			if(isset($truesearch)){
				if(!isset($this->request->get['category_id'])){
				$url .= '&category_id=31';
			}}
			if(isset($truesearch))
			{
				$url .= '&truezap='.$truesearch;
			}
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}


        /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
				if (isset($this->request->get['bfilter'])) {
					$url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
				}
        /* Brainy Filter Pro (brainyfilter.xml) - End ->*/

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/search', $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['search'])) {
				if(isset($truesearch)){
					$url .= '&search=' .	$truesearch;
				}else{
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}}

		      if (isset($this->request->get['br'])) {
					$url .= '&br=' . urlencode(html_entity_decode($this->request->get['br'], ENT_QUOTES, 'UTF-8'));
		  		}

		      if (isset($this->request->get['prn'])) {
	  			$url .= '&prn=' . urlencode(html_entity_decode($this->request->get['prn'], ENT_QUOTES, 'UTF-8'));
	  		}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}if(isset($truesearch)){
				if(!isset($this->request->get['category_id'])){
				$url .= '&category_id=31';
			}}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}
			if(isset($truesearch)){
				$url .= '&truezap='. $truesearch;
			}
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}


            /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
			if (isset($this->request->get['bfilter'])) {
				$url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
			}
            /* Brainy Filter Pro (brainyfilter.xml) - End ->*/

			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text_first = false;
        	$pagination->text_last = false;
			$pagination->text_prev = $this->language->get('text_prev');
        	$pagination->text_next = $this->language->get('text_next');
			$pagination->url = $this->url->link('product/search', $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('product/search', '', 'SSL'), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('product/search', '', 'SSL'), 'prev');
			} else {
			    $this->document->addLink($this->url->link('product/search', $url . '&page='. ($page - 1), 'SSL'), 'prev');
			}

			if ($limit && ceil($product_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('product/search', $url . '&page='. ($page + 1), 'SSL'), 'next');
			}
		}

		$data['search'] = $search;
    	$data['searchprn'] = $searchprn;
    	$data['searchbrand'] = $searchbrand;

		$data['description'] = $description;
		$data['category_id'] = $category_id;
		$data['sub_category'] = $sub_category;
    	$data['product_total_cat']=$product_total_cat;

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		/*$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');*/
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/search.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/search.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/search.tpl', $data));
		}
	}
}












