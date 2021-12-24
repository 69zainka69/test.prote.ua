<?php
class ControllerModuleBestSeller extends Controller {
	public function index($setting) {
		$this->load->language('module/bestseller');

		$data['langurl']=($this->language->get('code')=='uk'?'/ua':'');

		if (isset($this->request->get['route'])) {
		    $data['route'] = $this->request->get['route'];
		} else {
		    $data['route'] = 'common/home';
		}
		if($data['route'] == 'common/home'){
			$data['heading_title'] = $this->language->get('heading_title');
		} elseif(isset($setting['title'])){
			$data['heading_title'] = $setting['title'];
		} else {
			$data['heading_title'] = $setting['name'];
		}

		$data['text_action'] = $this->language->get('text_action');
		$data['button_cart'] = $this->language->get('button_cart');
		$data['text_exist'] = $this->language->get('text_exist');
		$data['text_noexist'] = $this->language->get('text_noexist');
		$data['text_preorder'] = $this->language->get('text_preorder');
		$data['text_wait'] = $this->language->get('text_wait');
		$data['text_allactions'] = $this->language->get('text_allactions');
		$data['text_minimum'] = $this->language->get('text_minimum');
		$data['text_free_delivery'] = $this->language->get('text_free_delivery');
		$data['text_bestseller'] = $this->language->get('text_bestseller');
		$data['text_price'] = $this->language->get('text_price');

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
            $data['text_quantity'] = $this->language->get('text_quantity');
			$data['button_cartone'] = $this->language->get('button_cartone');
            $data['message_system_error'] = $this->language->get('message_system_error');
        } else {
            $data['ordercallback_use_module'] = false;
        }

        $data['ordercallback_settings'] = $ordercallback_settings;
        $data['minimum'] = 1;
        $data['price'] = 0;
        $data['thumb'] = '';
        $data['text_minimum'] = '';
		

		$this->load->model('catalog/product');

		$this->load->model('tool/image'); 

		

		$data['products'] = array();
		//$products = $this->model_catalog_product->getBestSellerProductsLastWeek($setting['limit']);
		$products = $this->model_catalog_product->getBestSellerProductsOur($setting['limit']);

		


		if ($products) {
			foreach ($products as $product) {
				if ($product['image']) {
					$image = $this->model_tool_image->resize($product['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$product['special']) {
					$special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$product['special'] ? $product['special'] : $product['price']);
				} else {
					$tax = false;
				}
				$this->load->model('extension/news');
				
				//акции
				$action = array();
            if ($product['news']) {
                $newslist = explode(',', $product['news']);
				$action_news = $this->model_extension_news->getNewsByArrayId($newslist);
				if ($action_news) {
					$action = reset($action_news);
					$action['url'] = $this->url->link('extension/news', 'news_id=' . $action['news_id']);		
				}
            }
		
				$data['products'][] = array(
					'product_id'  => $product['product_id'],
					'thumb'       => $image,
					'name'        => $product['name'],
					'price'       => $price,
					'has_free_delivery' => $product['has_free_delivery'],
					'special'     => $special,
					'price_float'  => round($product['price'],2),
					'special_float'=> round($product['special'],2),
					'minimum'     => $product['minimum'] > 0 ? $product['minimum'] : 1,
					'ifexist'     => $product['ifexist'],
					'href'        => $this->url->link('product/product', 'product_id=' . $product['product_id']),
					'action'      => $action
				);
			}
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/bestseller.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/bestseller.tpl', $data);
		} else {
			return $this->load->view('default/template/module/bestseller.tpl', $data);
		}
	}
}
