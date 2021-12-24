<?php
class ControllerInformationNews extends Controller {
	public function index() {     
		$this->language->load('information/news');
		
		$this->load->model('extension/news');
	 
		$this->document->setTitle($this->language->get('heading_title')); 
	  
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' 		=> $this->language->get('text_home'),
			'href' 		=> $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' 		=> $this->language->get('heading_title'),
			'href' 		=> $this->url->link('information/news')
		);
		  
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}	

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}
		
		$filter_data = array(
			'page' 	=> $page,
			'limit' => 10,
			'start' => 10 * ($page - 1),
		);
		
		$total = $this->model_extension_news->getTotalNews();
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('information/news', 'page={page}');
		
		$data['pagination'] = $pagination->render();
	 
		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($total - 10)) ? $total : ((($page - 1) * 10) + 10), $total, ceil($total / 10));

		$data['heading_title'] = $this->language->get('heading_title');
		//$data['text_title'] = $this->language->get('text_title');
		//$data['text_description'] = $this->language->get('text_description');
		//$data['text_date'] = $this->language->get('text_date');
		//$data['text_view'] = $this->language->get('text_view');		

        $this->document->setTitle($this->language->get('meta_title'));
        $this->document->setDescription($this->language->get('meta_description'));
        // $this->document->setKeywords($this->language->get('meta_keywords'));
        $this->document->addLink($this->url->link('information/news', '', 'SSL'), 'canonical');
	 	
		$all_news = $this->model_extension_news->getAllNews($filter_data);
	 
		$data['all_news'] = array();
		
		$this->load->model('tool/image');
	 
		foreach ($all_news as $news) {
     // print_r($news);
            $data['all_news'][] = array (
                'title' 		=> html_entity_decode($news['title'], ENT_QUOTES),
                'image'			=> $this->model_tool_image->resize($news['image'], 400, 237),
                'description' 	=>  (strlen(strip_tags(html_entity_decode($news['short_description'], ENT_QUOTES))) > 50 ? mb_substr(strip_tags(html_entity_decode($news['short_description'], ENT_QUOTES)), 0, 50) . '...' : strip_tags(html_entity_decode($news['short_description'], ENT_QUOTES))),
                'view' 			=> $this->url->link('information/news/news', 'news_id=' . $news['news_id']),
                'date_added' 	=> date($this->language->get('date_format_short'), strtotime($news['date_added']))
            );
		}
	 // print_r($all_news);
		//$data['column_left'] = $this->load->controller('common/column_left');
		//$data['column_right'] = $this->load->controller('common/column_right');
		//$data['content_top'] = $this->load->controller('common/content_top');
		//$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (version_compare(VERSION, '2.2.0.0', '<')) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/news_list.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/news_list.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/information/news_list.tpl', $data));
			}
		} else {
			$this->response->setOutput($this->load->view('information/news_list', $data));
		}
	}
 
	public function news() {
		$this->load->model('extension/news');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
	  
		$this->language->load('information/news');
 
		if (isset($this->request->get['news_id']) && !empty($this->request->get['news_id'])) {
			$news_id = $this->request->get['news_id'];
		} else {
			$news_id = 0;
		}
 
		$news = $this->model_extension_news->getNews($news_id);
 
		$data['breadcrumbs'] = array();
	  
		$data['breadcrumbs'][] = array(
			'text' 			=> $this->language->get('text_home'),
			'href' 			=> $this->url->link('common/home')
		);
	  
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/news')
		);

		if ($news) {
			$data['breadcrumbs'][] = array(
				'text' 		=> $news['title'],
				'href' 		=> $this->url->link('information/news/news', 'news_id=' . $news_id, 'SSL')
			);


			$this->language->load('module/ordercallback');


	        $data['text_action'] = $this->language->get('text_action');

	        // Order call back setting
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

	            $data['modal_field_name'] = $this->language->get('modal_field_name');
	            $data['modal_field_phone'] = $this->language->get('modal_field_phone');
	            $data['modal_field_email'] = $this->language->get('modal_field_email');
	            $data['modal_field_comment'] = $this->language->get('modal_field_comment');
	            $data['button_cancel'] = $this->language->get('button_cancel');
	            $data['button_send'] = $this->language->get('button_send');
	            $data['button_buy']  = $this->language->get('button_buy');

	            $data['message_system_error'] = $this->language->get('message_system_error');

	            $data['button_cartone'] = $this->language->get('button_cartone');
	            
	        } else {
	            $data['ordercallback_use_module'] = false;
	        }

	        $data['ordercallback_settings'] = $ordercallback_settings;
	        // **************
 
            // Связанные продукты к акции
            $related_prod_id = $this->model_extension_news->getNewsRelatedProducts($news_id);

            foreach ($related_prod_id as $key => $prod_id) {

            	$result = $this->model_catalog_product->getProduct($prod_id['product_id']);
            	if(empty($result))continue;
            	
            	if ($result['image']) {
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
	                foreach ($newslist as $n) {
	                    $atcion_news = $this->model_extension_news->getNews($n);
	                    if($atcion_news){
	                        if (is_numeric($n)) $action[]=$atcion_news;            
	                    }

	                }                
	            }

	            $category_info = $this->model_catalog_category->getCategory($result['category']);

	            $data['products'][$result['category']][] = array(
	                'product_id'  => $result['product_id'],
	                'thumb'       => $image,
	                'category_name'        => $category_info['name'],
	                'name'        => htmlspecialchars($result['name']),
	                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
	                'price'       => $price,
	                'special'     => $special,
	                'price_float'  => round($result['price'],2),
	                'special_float'=> round($result['special'],2),
	                'tax'         => $tax,
	                'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
	                'rating'      => $result['rating'],
	                'ifexist'     => $result['ifexist'],
	                'quantity'    => $result['quantity'],
	                'tag'         => htmlspecialchars($result['tag']),
	                'jan'         => $result['jan'],                
	                'href'        => $this->url->link('product/product', '&product_id=' . $result['product_id']),
	                'action'      => $action
	                
	            );

            }
            $data['button_cart'] = $this->language->get('button_cart');
            $data['text_noexist'] = $this->language->get('text_noexist');
            $data['text_minimum'] = $this->language->get('text_minimum');
            $data['text_wait'] = $this->language->get('text_wait');
            $data['text_preorder'] = $this->language->get('text_preorder');
            $data['text_exist'] = $this->language->get('text_exist');
            $data['text_tax'] = $this->language->get('text_tax');
            $data['text_price'] = $this->language->get('text_price');
            $data['text_freedelivery'] = $this->language->get('text_freedelivery');
            $data['text_moreproduct'] = $this->language->get('text_moreproduct');
            $data['text_minimum'] = $this->language->get('text_minimum');
            $data['txt_more_products'] = $this->language->get('txt_more_products');

            /*$related = $this->model_extension_news->getNewsRelated($news_id);
            $products = array();
            if ($related) {
                foreach ($related as $product) {
                    $products[] = array(
                        'name' => $product['name'], 
                        'url' =>  $this->url->link('catalog/product', 'product_id=' . $product['product_id'])
                    );
                } 
                $data['products']= $products;
            } */                       

			if ($news['meta_title']) $this->document->setTitle($news['meta_title']);
                        else $this->document->setTitle($news['title'] . ' | prote.ua');
                        if ($news['meta_description']) $this->document->setDescription($news['meta_description']);
                        else $this->document->setDescription($news['title'] . $this->language->get('meta_description'));
                        $this->document->addLink($this->url->link('information/news/news', 'news_id=' . $news_id, 'SSL'), 'canonical');
			
			$this->load->model('tool/image');
			
			$data['image'] = $this->model_tool_image->resize($news['image'], 400, 237);
			//$data['image'] = 'image/'.$news['image'];
 
			$data['heading_title'] = html_entity_decode($news['title'], ENT_QUOTES);
			$data['description'] = html_entity_decode($news['description'], ENT_QUOTES);
                        
            $data['description'] = str_ireplace('prote.com.ua', 'prote.ua',$data['description']);
	        $data['text_related'] = $this->language->get('text_related');
			//$data['column_left'] = $this->load->controller('common/column_left');
			//$data['column_right'] = $this->load->controller('common/column_right');
			//$data['content_top'] = $this->load->controller('common/content_top');
			//$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header'); 

			
			$this->response->setOutput($this->load->view('default/template/information/news.tpl', $data));
			
		} else {
			
			$this->response->redirect($this->url->link('error/not_found'),301);

			$data['breadcrumbs'][] = array(
				'text' 		=> $this->language->get('text_error'),
				'href' 		=> $this->url->link('information/news', 'news_id=' . $news_id)
			);
	 
			$this->document->setTitle($this->language->get('text_error'));
	 
			$data['heading_title'] = $this->language->get('text_error');
			$data['text_error'] = $this->language->get('text_error');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['continue'] = $this->url->link('common/home');
	 
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (version_compare(VERSION, '2.2.0.0', '<')) {
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
				} else {
					$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
				}
			} else {
				$this->response->setOutput($this->load->view('error/not_found', $data));
			}
		}
	}
}