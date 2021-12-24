<?php
class ControllerProductManufacturer extends Controller {
	public function index() {
		exit;
		$this->load->language('product/manufacturer');

		$this->load->model('catalog/manufacturer');

		$this->load->model('tool/image');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_index'] = $this->language->get('text_index');
		$data['text_empty'] = $this->language->get('text_empty');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_brand'),
			'href' => $this->url->link('product/manufacturer')
		);

		$data['categories'] = array();

		$results = $this->model_catalog_manufacturer->getManufacturers();

		foreach ($results as $result) {
			if ($result['meta_h1']) {
				$name = $result['meta_h1'];
			} else {
				$name = $result['name'];
			}

			if (is_numeric(utf8_substr($name, 0, 1))) {
				$key = '0 - 9';
			} else {
				$key = utf8_substr(utf8_strtoupper($name), 0, 1);
			}

			if (!isset($data['categories'][$key])) {
				$data['categories'][$key]['name'] = $key;
			}

			$data['categories'][$key]['manufacturer'][] = array(
				'name' => $name,
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
			);
		}

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/manufacturer_list.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/manufacturer_list.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/manufacturer_list.tpl', $data));
		}
	}

	public function info() {
		$this->load->language('product/manufacturer');

		$this->load->model('catalog/manufacturer');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');


		if (isset($this->request->get['manufacturer_id'])) {
			$manufacturer_id = (int)$this->request->get['manufacturer_id'];
		} else {
			$manufacturer_id = 0;
		}
		if (isset($this->request->get['categ_id'])) {
			$category_id = (int)$this->request->get['categ_id'];
		} else {
			$category_id = '';
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

		$redirect_from_page1=false;

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
            if($page==1){
                $redirect_from_page1=true;
            }
        } else {
            $page = 1;
        }

        if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = (int)$this->config->get('config_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

		if ($manufacturer_info) {

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
	        $query = $this->db->query("SELECT order_id FROM `" . DB_PREFIX . "order` ORDER BY order_id DESC LIMIT 1");
	        $data['last_order_id'] = $query->row['order_id'];
	        $data['minimum'] = 1;
	        $data['price'] = 0;
	        $data['thumb'] = '';

	        // **************

			$this->document->setTitle($manufacturer_info['name']);

			$url = '';

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
				'text' => $manufacturer_info['name'],
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)
			);

			if ($manufacturer_info['meta_title']) {
				$this->document->setTitle($manufacturer_info['meta_title']);
			} else {
				$this->document->setTitle($manufacturer_info['name']);
			}

			$this->document->setDescription($manufacturer_info['meta_description']);
			$this->document->setKeywords($manufacturer_info['meta_keyword']);

			if ($manufacturer_info['meta_h1']) {
				$data['heading_title'] = $data['heading_title'] . $manufacturer_info['meta_h1'];
			} else {
				$data['heading_title'] = $manufacturer_info['name'];
			}

			if ($manufacturer_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($manufacturer_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$data['thumb'] = '';
			}

			if($category_id){
				$data['description'] = '';
			} else {
				$data['description'] = html_entity_decode($manufacturer_info['description'], ENT_QUOTES, 'UTF-8');
			}

			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_price'] = $this->language->get('text_price');

			$data['text_in_cat'] = $this->language->get('text_in_cat');
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');
			$data['text_minimum'] = $this->language->get('text_minimum');

			$data['text_action'] = $this->language->get('text_action');
			$data['text_exist'] = $this->language->get('text_exist');
			$data['text_preorder'] = $this->language->get('text_preorder');
			$data['text_wait'] = $this->language->get('text_wait');
			$data['text_noexist'] = $this->language->get('text_noexist');

			$data['button_cart'] = $this->language->get('button_cart');

			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_cartone'] = $this->language->get('button_cartone');
			$data['txt_more_products'] = $this->language->get('txt_more_products');


				$filter_ids = explode(',',$manufacturer_info['filter_ids']);

				foreach ($filter_ids as $key => $filter_id) {
					$filter = $this->model_catalog_product->getFilter($filter_id);


					$sql = "SELECT c.category_id, c.image, cd.name , cnt.count
							FROM oc_category c
							INNER JOIN (
										SELECT p2c.category_id, COUNT(*) as count
										FROM oc_product_to_category p2c, oc_product_attribute pa
										WHERE pa.attribute_id IN(".$this->db->escape($filter['filter_group_id']).")
											AND pa.language_id = " . (int)$this->config->get('config_language_id') . "
											AND p2c.product_id = pa.product_id
											AND pa.text IN('". $filter['name']."')
											AND EXISTS (
												SELECT * FROM oc_product p WHERE p.product_id = pa.product_id AND price > 0
											)
										GROUP BY p2c.category_id
										) as cnt ON (cnt.category_id = c.category_id)
							LEFT JOIN oc_category_description cd ON (c.category_id = cd.category_id AND cd.language_id = '1')
							WHERE c.status = '1'";
					$query = $this->db->query($sql);
					if($query->rows){
						foreach ($query->rows as $key => $category) {

							$category['filter'] = $filter;
							$data['filter_name'] = $filter['name'];

							$categories[] = $category;
						}

					}

				}


    		$data['category_info'] = array();
    		$data['categories'] = array();

    		foreach ($categories as $category) {

    		    $image = false;

				if($category_id == $category['category_id']){

	    			$data['category_info'] = $category;
	    			$data['breadcrumbs'][] = array(
						'text' =>  $category['name'],
						'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer_id . '&categ_id=' . $category['category_id'])
					);

	    		}


		    		$sql = "SELECT pc.product_id FROM oc_product_to_category pc
		    		WHERE pc.category_id='".(int)$category['category_id']."'
		    		AND EXISTS (
		    			SELECT * FROM oc_product_filter pf WHERE
		    			pc.product_id=pf.product_id AND pf.filter_id='".(int)$category['filter']['filter_id']."'
		    		)
		    		AND pc.main_category = 1 LIMIT 1";

		    		$query = $this->db->query($sql);
		    		if($query->row){
		    			$url = '&bfilter=f'.$category['filter']['filter_group_id'].':'.$category['filter']['filter_id'];
		    		} else {
		    			$url = '';
		    		}



    			$data['categories'][] = array(
    				'category_id'		=> $category['category_id'],
    				'name'		=> $category['name'],
    				'count'		=> $category['count'],
    				'filter'		=> $category['filter'],
    				'image'		=> $image,
    				'href'		=> $this->url->link('product/category', 'path=' . $category['category_id'].$url),
    				'products'		=> array()
    			);
    		}

    		$data['category_id'] =$category_id;


    		$data['products'] = array();

			$product_total = 0;



			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_default'),
	            'value' => 'p.price-ASC',
	            'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.price&order=ASC' . $url)
	        );

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_name_asc'),
	            'value' => 'pd.name-ASC',
	            'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=pd.name&order=ASC' . $url)
	        );

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_name_desc'),
	            'value' => 'pd.name-DESC',
	            'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=pd.name&order=DESC' . $url)
	        );

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_price_asc'),
	            'value' => 'p.price-ASC',
	            'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.price&order=ASC' . $url)
	        );

	        $data['sorts'][] = array(
	            'text'  => $this->language->get('text_price_desc'),
	            'value' => 'p.price-DESC',
	            'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.price&order=DESC' . $url)
	        );



			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text_first = false;
        	$pagination->text_last = false;
			$pagination->text_prev = $this->language->get('text_prev');
        	$pagination->text_next = $this->language->get('text_next');
			$pagination->url = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] .  $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'], 'SSL'), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'], 'SSL'), 'prev');
			} else {
			    $this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url . '&page='. ($page - 1), 'SSL'), 'prev');
            	$this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'], 'SSL'), 'canonical');
			}

			if ($limit && ceil($product_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url . '&page='. ($page + 1), 'SSL'), 'next');
			}

			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('default/template/product/manufacturer_info.tpl', $data));

		} else {
			$url = '';

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

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
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/manufacturer/info', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['header'] = $this->load->controller('common/header');
			$data['footer'] = $this->load->controller('common/footer');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function getProduct($result){

		if ($result['image']) {
			$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
		} else {
			$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
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

            }
            //if($data['brand'])break;
        }

		//$data['products'][] = array(
		return array(
			'product_id'  => $result['product_id'],
			'thumb'       => $image,
			'name'        => $result['name'],
			'model'       => $result['model'],
			'price'       => $price,
            'price_float'       => round($result['price'],2),
            'special'     => $special,
            'special_float'       => round($result['special'],2),
            'quantity'    => $result['quantity'],
			'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
			'attributs'       => $attributs,
            'quantity'    => $result['quantity'],
            'ifexist'     => $result['ifexist'],
			'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id']),
            'action'      => $action
		);
	}

	public function getProducts(){

		if (isset($this->request->post['category_id'])) {
			$category_id = (int)$this->request->post['category_id'];
		} else {
			$json = '';
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
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
		if (isset($this->request->post['filter_group_id'])) {
			$filter_group_id = $this->request->post['filter_group_id'];
		} else {
			$filter_group_id = '';
		}
		if (isset($this->request->post['filter_id'])) {
			$filter_id = $this->request->post['filter_id'];
		} else {
			$filter_id = '';
		}
		if (isset($this->request->post['filter_name'])) {
			$filter_name = $this->request->post['filter_name'];
		} else {
			$filter_name = '';
		}


		$filter_data = array(
			//'filter_manufacturer_id' => $manufacturer_id,
			//'filter_attribute_id' => $manufacturer_info['filter_id'],
			'filter_category_id' => $category_id,
			'filter_attribute_id' => $filter_group_id,
			//'filter_id' => $filter_id,
			'filter_attribute_name' => $filter_name,
			'sort'                   => $sort,
			'order'                  => $order,
			'status'                   => '1',
			'start'                  => 0,
			'price_min'              => 0,
			'limit'                  => 4
		);

		//vdump($filter_data);
		/*$this->log->write($this->request->post);
		$this->log->write($filter_data);*/


		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$this->load->model('extension/news');
		//vdump($filter_data);

		$results = $this->model_catalog_product->getProducts($filter_data);
		//vdump($results);

		/*echo "<pre>";
		print_r($results);
		echo "</pre>";*/

		$products = array();
		if($results){

			$this->load->language('product/manufacturer');
			$data['text_action'] = $this->language->get('text_action');
            $data['text_exist'] = $this->language->get('text_exist');
            $data['text_preorder'] = $this->language->get('text_preorder');
            $data['text_wait'] = $this->language->get('text_wait');
            $data['text_noexist'] = $this->language->get('text_noexist');
            $data['text_minimum'] = $this->language->get('text_minimum');
            $data['button_cartone'] = $this->language->get('button_cartone');
            $data['button_cart'] = $this->language->get('button_cart');

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
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

                    }
                    //if($data['brand'])break;
                }

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'model'       => $result['model'],
					//'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'attributs'       => $attributs,
					'price'       => $price,
	                'price_float'       => round($result['price'],2),
	                'special'     => $special,
	                'special_float'       => round($result['special'],2),
					//'tax'         => $tax,
	                'quantity'    => $result['quantity'],
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					//'rating'      => $result['rating'],
	                'quantity'    => $result['quantity'],
	                'ifexist'     => $result['ifexist'],
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id']),
	                'action'      => $action
				);
			}
			$json = $this->load->view('default/template/product/getajax/getProduct.tpl', $data);

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		} else {
			$json = '';
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}



		//return ;
	}


}
