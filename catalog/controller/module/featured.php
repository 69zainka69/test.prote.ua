<?php
class ControllerModuleFeatured extends Controller {
	public function index($setting) {
		$this->load->language('module/featured');

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

            $data['message_system_error'] = $this->language->get('message_system_error');
        } else {
            $data['ordercallback_use_module'] = false;
        }

        $data['ordercallback_settings'] = $ordercallback_settings;
        $query = $this->db->query("SELECT order_id FROM `" . DB_PREFIX . "order` ORDER BY order_id DESC LIMIT 1");
        $data['last_order_id'] = $query->row['order_id'];
        // **************

		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$this->load->model('extension/news');

		$data['langurl']=($this->language->get('code')=='uk'?'/ua':'');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['product'])) {
			$products = array_slice($setting['product'], 0, (int)$setting['limit']);
			foreach ($products as $product_id) {

				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info) {
					if ($product_info['image']) {
						$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					}

					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}

					if ((float)$product_info['special']) {
						$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}

					// Акции!
	                $action=array();
	                if ($product_info['news']) {
	                    $newslist=  explode(',', $product_info['news']);
	                    foreach ($newslist as $news) {
	                        $atcion_news = $this->model_extension_news->getNews($news);
	                        if($atcion_news){
	                           if (is_numeric($news)) $action[]=$atcion_news;
	                        }
	                    }
	                }

					$data['products'][] = array(
						'product_id'  => $product_info['product_id'],
						'thumb'       => $image,
						'name'        => $product_info['name'],
						'price'       => $price,
						'special'     => $special,
						'price_float'  => round($product_info['price'],2),
						'special_float'=> round($product_info['special'],2),
						'minimum'     => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
						'ifexist'     => $product_info['ifexist'],
						'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
						'action'      => $action
					);
				}
			}
		}

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
        // **************

		if ($data['products']) {
			//return $this->response->minify_html($this->load->view('default/template/module/featured.tpl', $data));
			return $this->load->view('default/template/module/featured.tpl', $data);
		}
	}
}