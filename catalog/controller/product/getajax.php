<?php
class ControllerProductGetajax extends Controller {
	public function index(){
		
	}
	public function getProductCompabilityList(){
		if (isset($this->request->get['product_id'])) {

			// Order call back setting
		        $this->document->addScript('catalog/view/javascript/instup/jquery.validate.min.js','footer');
		        $this->language->load('module/ordercallback');
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

		            $data['message_system_error'] = $this->language->get('message_system_error');
		        } else {
		            $data['ordercallback_use_module'] = false;
		        }

		        $data['ordercallback_settings'] = $ordercallback_settings;
		    // **************
			
			$product_id = $this->request->get['product_id'];

			if (isset($this->request->get['category_id'])){
				$category_id = $this->request->get['category_id'];
			} else {
				$category_id=false;
			}
			$original_product = false;
			$this->load->model('catalog/product');
			$this->load->model('extension/news');

			if($results = $this->model_catalog_product->getProductCompabilityList_n($product_id)){
				//vdump($results);
				unset($results['_CIR']);
				$this->load->language('product/product');

	            /*$data['titles'] = array(
                	'_INK_rec_'=>$this->language->get('text_inkrec'),
                	'_C'=>$this->language->get('text_cartcom'),
                	'_C0'=>$this->language->get('text_cartcom0'),
                	'_C1'=>$this->language->get('text_cartcom1'),
                	'_P'=>$this->language->get('text_prncom'),// ПУ
                	'_P0'=>$this->language->get('text_prncom0'),// ПУ
                	'_P1'=>$this->language->get('text_prncom1'),// ПУ
                	'_T'=>$this->language->get('text_toncom'),
                	'_T0'=>$this->language->get('text_toncom0'),
                	'_T1'=>$this->language->get('text_toncom1'),
                	'_INK'=>$this->language->get('text_inkcom')
                );*/
                $cat_comp = array(
                	'ink_cart'=> array(21), // стрйные карт
                	'laser_cart'=> array(31), // лаз. картриджи
                	'ink'=>array(22), // чернила
                	'pu'=>array(82,88,81,89), // устройства
                );
                $pu=array(82,88,81,89);
                $data['titles_n'] = $this->language->get('text_titles_n');
	            
				// 21 - струйные картиджи
	            // 22 - чернила
	            //vdump($results);
				//if($category_id==21 && isset($results[21]) && !array_key_exists('22', $search_array)) {
				if($category_id==21 && isset($results[21]) || $category_id==31 && isset($results[31])) {
					// если не находим чернила ищем оригиналоьный картридж и у него будем брать совместимые чернила
					foreach ($results[$category_id] as $product) {
						if($product_id==$product['product_id'])continue;
						$sql = "SELECT product_id FROM oc_product_attribute WHERE product_id=".$product['product_id']." AND attribute_id=13 AND `text`='Оригинальный' AND language_id=1";
						
						$query = $this->db->query($sql);

	          			if($query->row){
	          				//$res = $this->model_catalog_product->getProductCompabilityList($product['child_product_id'],'/C',$direct,$category_id);
	          				//if($res = $this->model_catalog_product->getProductCompabilityList_n($product['product_id'],22)){
	          				if($res = $this->model_catalog_product->getProductCompabilityList_n($product['product_id'])){
	          					$results = $results + $res;
	          					foreach ($res as $cat_id => $category) {
	          						unset($category[$product_id]);
	          						if(isset($results[$cat_id])){
	          							//$results[$cat_id] = array_merge($results[$cat_id],$category);
	          							$results[$cat_id] = $results[$cat_id] + $category;
	          						} else {
			          					$results[$cat_id] = $res[$cat_id];
	          						}
	          					}
	          				}
	          				
				          	break;
	          			}
          			}
				}
	            //vdump($results);
				/*if($category_id==31 && isset($results[31])) {
					foreach ($results[31] as $product) {
						$sql = "SELECT product_id FROM oc_product_attribute WHERE product_id=".$product['product_id']." AND attribute_id=13 AND `text`='Оригинальный' AND language_id=1";
						
						$query = $this->db->query($sql);
	          			if($query->row){
	          				//$res = $this->model_catalog_product->getProductCompabilityList($product['child_product_id'],'/C',$direct,$category_id);
	          				if($res = $this->model_catalog_product->getProductCompabilityList_n($product['product_id'])){
	          					$results = $results + $res;
	          					foreach ($res as $cat_id => $category) {
	          						if(isset($results[$cat_id])){
	          							$results[$cat_id] = array_merge($results[$cat_id],$category);
	          						} else {
			          					$results[$cat_id] = $res[$cat_id];
	          						}
	          					}
	          				}
				          	break;
	          			}
          			}
          	
				}*/

				$this->load->model('catalog/product');
				$this->load->model('tool/image');

				$replace_ar = array(
					'СТРУЙНЫЙ ПРИНТЕР', 
					'СТРУМЕНЕВИЙ ПРИНТЕР', 
					'ЛАЗЕРНЫЙ ПРИНТЕР', 
					'ЛАЗЕРНИЙ ПРИНТЕР', 
					'МФУ', 
					'лазерный принтер', 
					'лазерний принтер', 
					'струменевий принтер', 
					'БФП', 
					'МФУ', 
				);

				$results_n=array();
				foreach ($results as $cat_id => $products) {
					$prod = array();
					foreach ($products as $key => $product) {
						
						
						/*if($product_id==$product['child_product_id']){
							unset($results[$key_con_type][$key]);
							continue;
						}*/

						$result = $this->model_catalog_product->getProduct($product['product_id']); 
						
						
						if( !in_array($cat_id,$pu) && $result['price']==0 || // убираем архивные
							$result['category']==24 || // Убираем ПЗК
							$result['category']==23 // Убираем СНПЧ
						){
							unset($results[$cat_id][$key]);
		                	continue;
		                }

		                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
	                        $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
		                } else {
		                    $price = false;
		                }

						if ($result['image']) {
		                    $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
		                } else {
		                    $image = $this->model_tool_image->resize('no-photo-img.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
		                }

		                if ((float)$result['special']) {
		                        $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
		                } else {
		                        $special = false;
		                }

		                // получаем цену для определнных товаров на черную пятницу
		                if(isset($this->session->data['products_pjatnica']) && array_key_exists($result['product_id'],$this->session->data['products_pjatnica'])) {
		                     $special =  $this->currency->format($this->tax->calculate($this->session->data['products_pjatnica'][$result['product_id']], $product_info['tax_class_id'], $this->config->get('config_tax')));
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

		                $attribute_groups = $this->model_catalog_product->getProductAttributes($result['product_id']);
		                $attributs = array();

		                foreach ($attribute_groups as $key1 => $attributes) {
		                    //vdump($attributes);
		                    foreach ($attributes['attribute'] as $key2 => $attribute) {
		                        
		                        if($attribute['attribute_id']==17873&&($attribute['text']=='Да'||$attribute['text']=='Так')){// Возможна заправка картриджа
		                            if($category_id==89 || $category_id==81){
		                                $attributs['17873'] = array(
		                                    'image' => 'image/catalog/ico_attr/kart-mozhno-zaprav.svg',
		                                    'text' => $this->language->get('text_attribute_17873')
		                                );
		                            } else if($category_id==88 || $category_id==82){
		                                $attributs['17873'] = array(
		                                    'image' => 'image/catalog/ico_attr/kart-mozhno-zaprav.svg',
		                                    'text' => $this->language->get('text_attribute_17873')
		                                );
		                            }
		                        } elseif($attribute['attribute_id']==17867&&($attribute['text']=='Доступны'||$attribute['text']=='Доступні')){ //Доступность неоригинальных картриджей
		                            if($category_id==89 || $category_id==81){
		                                $attributs['17867'] = array(
		                                    'image' => 'image/catalog/ico_attr/dostupnyy-neorig-ink-cartr.svg',
		                                    'text' => $this->language->get('text_attribute_17867')
		                                );
		                            } else if($category_id==88 || $category_id==82){
		                                $attributs['17867'] = array(
		                                    'image' => 'image/catalog/ico_attr/dostupnyy-neorig-laz-cartr.svg',
		                                    'text' => $this->language->get('text_attribute_17867')
		                                );
		                            }
		                        } elseif($attribute['attribute_id']==17870&&($attribute['text']=='Доступны'||$attribute['text']=='Доступні')){ //Доступность неоригинальных чернил
		                            $attributs['17870'] = array(
		                                    'image' => 'image/catalog/ico_attr/ink-drops-neorig-chornyla.svg',
		                                    'text' => $this->language->get('text_attribute_17870')
		                                );
		                        }

		                        /*if($attribute['attribute_id']==2 && ($attribute['text']=='Оригинальный' || $attribute['text']=='Оригінальний')){

		                        }*/
		                        
		                    }
		                    //if($data['brand'])break;
		                }

		                $name = html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8');
		                $name = trim(str_replace($replace_ar,'',$name));
		                /*if($key_con_type=='_INK_rec_'){
							$name=str_replace(array('ЧЕРНИЛА ', 'ЧОРНИЛА '), '', $name);
		                } elseif($key_con_type=='_C'){
		                	$name=str_replace(array('КАРТРИДЖ '), '', $name);
		                }*/
		                
		                $prod = array(
		                    'thumb'       => $image,
		                    'model'       => $result['model'],
		                    'name'        => $name,
		                    //'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
		                    'attributs'       => $attributs,
		                    'price'       => $price,
		                    'price_float'       => round($result['price'],2),
		                    'special'     => $special,
		                    'special_float'       => round($result['special'],2),
		                    //'tax'         => $tax,
		                    'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
		                    //'rating'      => $result['rating'],
		                    'ifexist'     => $result['ifexist'],
		                    'quantity'    => $result['quantity'],
		                    //'tag'         => htmlspecialchars($result['tag']),
		                    //'jan'         => $result['jan'],                
		                    //'href'        => $href,
		                    'action'      => $action
		                );

		                $results[$cat_id][$key] = array_merge($results[$cat_id][$key],$prod);
		                //$results_n[$cat_id.$results[$cat_id][$key]['direct']][$key] = $results[$cat_id][$key];
						
					}
				}

				//vdump($results);
				//vdump($results_n);

				//$results =  $results_n;
				$html_pu = '';
				foreach ($results as $cat_id => $category) {
						if(isset($data['titles_n'][$cat_id])){
							$title = $data['titles_n'][$cat_id];
						} else {
							$title = 'совместимость';
						}
					
						if(in_array($cat_id, $cat_comp['pu'])){
					
							$list = array();

							foreach ($category as $key => $product) {
								$list[] = '<a href="'.$product['href'].'" title="'.$product['name'].'">'.$product['name'].'</a>';
							}
							$html_pu .= '<div class="comp_pu">';
				            $html_pu .= '  <div class="panel-heading">';
				            $html_pu .= '      <div class="panel-title" data-p="_P">'.$title.'</div>';
				            $html_pu .= '  </div>';
				            $html_pu .= '  <div class="text">'. implode(', ', $list) .'</div>';
				            $html_pu .= '</div>';
					     	unset($results[$cat_id]);   
						}
					
				}

	           //$data['text_circom'] = $this->language->get('text_circom');
	           //$data['text_inkcom'] = $this->language->get('text_inkcom');
	           $data['text_action'] = $this->language->get('text_action');
	           $data['text_exist'] = $this->language->get('text_exist');
	           $data['text_preorder'] = $this->language->get('text_preorder');
	           $data['text_wait'] = $this->language->get('text_wait');
	           $data['text_noexist'] = $this->language->get('text_noexist');
	           $data['button_cartone'] = $this->language->get('button_cartone');
	           $data['button_cart'] = $this->language->get('button_cart');

	           $data['productsCompability'] = $results;

	           //$html = $this->load->view('default/template/product/getajax/getProductCompabilityList.tpl', $data);
	           //if(ISADMIN){
	           	$html = $this->load->view('default/template/product/getajax/getProductCompabilityList_n.tpl', $data);
	           //}
	           $json['html'] = $html;
	           $json['html_pu'] = $html_pu;
	           //vdump($json);

	           //  
	       } else {
			  $json['error'] = 1;	       	
	       }
	       //https://prote-centos.vm.net/index.php?route=product/getajax/getProductCompabilityList&product_id_=175
	       //echo json_encode($json);
	       $this->response->addHeader('Content-Type: application/json');
		   $this->response->setOutput(json_encode($json));
	   }

	}
        
}
