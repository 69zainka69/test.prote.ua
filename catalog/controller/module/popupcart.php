<?php
class ControllerModulePopupCart extends Controller {

	public function index() {

		$this->load->language('common/cart');
		$this->language->load('module/popupcart');

		$data['langurl']=($this->language->get('code')=='uk'?'/ua':'');
		$language_id = $this->config->get('config_language_id');
		$data['head'] = $this->language->get('head');
		$data['button_shopping'] = $this->language->get('button_shopping');
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_checkout'] = $this->language->get('button_checkout');
		$data['text_total'] = $this->language->get('text_total');

		$data['in_stock'] = $this->language->get('text_in_stock');
		$data['left'] = $this->language->get('text_left');
		$data['left1'] = $this->language->get('text_left1');
		$data['just'] = $this->language->get('text_just');
		$data['pcs'] = $this->language->get('text_pcs');
		$data['text_total'] = $this->language->get('text_upFreeDelivSum');
		// Totals
		$this->load->model('extension/extension');

		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();

		$currency = $this->session->data['currency'];

		// Display prices
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			$sort_order = array();

			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $total_data);
		}

		$data['totals'] = array();
		$tot_pr = $this->total_pr();
		foreach ($total_data as $total) {
			$data['totals'][] = array(
				'code' => $total['code'],
				'title' => $total['title'],
				'text'  => $tot_pr
			);
		}

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_cart'] = $this->language->get('text_cart');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_recurring'] = $this->language->get('text_recurring');

		$data['text_items'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total, $currency));

		$data['text_loading'] = $this->language->get('text_loading');

		$data['button_remove'] = $this->language->get('button_remove');

		$this->load->model('catalog/product');
		//$this->load->model('extension/module/popupcart');
		$this->load->model('tool/image');
		$this->load->model('tool/upload');

		$data['products'] = array();

		//$products = array_reverse($this->cart->getProducts());
	
				$sessi = $this->session->getId();
				$product_id = $this->cache->get($sessi.'_last_pr');
				$product['image'] = $this->cache->get('_pro_img'.$product_id);
				$product['tax_class_id'] = $this->cache->get($sessi.'_pro_tax'.$product_id);
				$price = $this->cache->get('_pro_prc'.$product_id);
				$product['price'] = $price;
				$product['model'] = $this->cache->get('_pro_mod'.$product_id);
				$product['name'] = $this->cache->get('_pro_name'.$product_id);
				$product['minimum'] = $this->cache->get('_pro_min'.$product_id);
				$product['cart_id'] = $product_id;
				$product['product_id'] = $product_id;
				$product['quantity'] = $this->cache->get($sessi.'_pro_qua'.$product_id);
				$total = $price * $product['quantity'];
				$option_data = 1;

		//foreach ($products as $product) {
            if ($this->model_tool_image->isImageExists($product['image'])) {
				$image = $this->model_tool_image->resize($product['image'], 150, 150);
			} else {
				$image = $this->model_tool_image->resize('no-photo-img.png', 100, 100);
			}

			$option_data =1;;

$data['tot'] = $total;
$data['pri'] = $price;



		/*
		
		foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['value'];
				} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

					if ($upload_info) {
						$value = $upload_info['name'];
					} else {
						$value = '';
					}
				}

				$option_data[] = array(
					'name'  => $option['name'],
					'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
					'type'  => $option['type']
				);
			}*/

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $currency);
			} else {
				$price = false;
			}

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'], $currency);
			} else {
				$total = false;
			}
			
			$product['maximum'] = 9999;
			$data['products'][] = array(
				'key'       	=> $product['cart_id'],
				'id'       		=> $product['product_id'],
				'thumb'     	=> $image,
				'name'      	=> $product['name'],
				'model'     	=> $product['model'],
				//'option'   		=> $option_data,
				//'recurring'		=> ($product['recurring'] ? $product['recurring']['name'] : ''),
				//'manufacturer'	=> $product['manufacturer'],
				'quantity'  	=> $product['quantity'],
				'stock'   	 	=> $this->config->get('config_stock_checkout'),
				'minimum'    	=> $product['minimum'],
				'maximum'    	=> $product['maximum'],
				'price'     	=> $price,
				'total'     	=> $total,
				'href'      	=> $this->url->link('product/product', 'product_id=' . $product['product_id'], true)
			);
		//}
		$deff_upFreeDelivSum=str_replace(' ','',$data['totals'][1]['text']);
		$deff_upFreeDelivSum = 499-floatval(str_replace(',','.',$deff_upFreeDelivSum));
		if($deff_upFreeDelivSum>0)
			$data['upFreeDelivSum'] = str_replace("{#upFreeDelivSum#}",$deff_upFreeDelivSum,$data["text_total"]);
		else  
			$data['upFreeDelivSum']='';
		/*$data['vouchers'] = array();
		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $key => $voucher) {
				$data['vouchers'][] = array(
					'key'         => $key,
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'])
				);
			}
		}*/

		//$data['products_related'] = isset($settings['related_show']) ? $this->products_related() : array();

		$data['cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

		/*$this->load->model('extension/extension');
		//$data['checkout_buttons'] = array();
		$files = glob(DIR_APPLICATION . '/controller/total/*.php');
		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');
				$data[$extension] = $this->load->controller('total/' . $extension);
			}
		}*/

		//калькулятор к общей сумме на бесплатную доставку свыше 250 грн.
		$this->response->addHeader('Content-Type: text/html; charset=utf-8');
		$this->response->addHeader('Cache-Control:no-store, no-cache');
		$this->response->setOutput($this->load->view('default/template/module/popupcart.tpl', $data));

	}

	// оптимизация сайта, для выводя в footer
	public function loda_cart() {

		$this->load->language('common/cart');
		$this->language->load('module/popupcart');

		$data['langurl']=($this->language->get('code')=='uk'?'/ua':'');

		$language_id = $this->config->get('config_language_id');

		$data['head'] = $this->language->get('head');
		$data['button_shopping'] = $this->language->get('button_shopping');
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_checkout'] = $this->language->get('button_checkout');

		$data['text_total'] = $this->language->get('text_total');

		$data['in_stock'] = $this->language->get('text_in_stock');
		$data['left'] = $this->language->get('text_left');
		$data['left1'] = $this->language->get('text_left1');
		$data['just'] = $this->language->get('text_just');
		$data['pcs'] = $this->language->get('text_pcs');

		// Totals
		$this->load->model('extension/extension');

		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();

		$currency = $this->session->data['currency'];

		// Display prices
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			$sort_order = array();

			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $total_data);
		}

		$data['totals'] = array();
		$tot_pr = $this->total_pr();		
		foreach ($total_data as $total) {
			$data['totals'][] = array(
				'code' => $total['code'],
				'title' => $total['title'],
				'text'  => $tot_pr
			);
		}

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_cart'] = $this->language->get('text_cart');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_recurring'] = $this->language->get('text_recurring');

		$data['text_items'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total, $currency));

		$data['text_loading'] = $this->language->get('text_loading');

		$data['button_remove'] = $this->language->get('button_remove');

		$this->load->model('catalog/product');
		//$this->load->model('extension/module/popupcart');
		$this->load->model('tool/image');
		$this->load->model('tool/upload');

/*		$data['products'] = array();

		$products = array_reverse($this->cart->getProducts());*/
		
		//foreach ($products as $product) {

				$sessi = $this->session->getId();
				$product_id = $this->cache->get($sessi.'_last_pr');
				$product['image'] = $this->cache->get('_pro_img'.$product_id);
				$product['tax_class_id'] = $this->cache->get($sessi.'_pro_tax'.$product_id);
				$price = $this->cache->get('_pro_prc'.$product_id);
				$product['price'] = $price;
				$product['model'] = $this->cache->get('_pro_mod'.$product_id);
				$product['name'] = $this->cache->get('_pro_name'.$product_id);
				$product['minimum'] = $this->cache->get('_pro_min'.$product_id);
				$product['cart_id'] = $product_id;
				$product['product_id'] = $product_id;
				
				$option_data = 1;


            if ($this->model_tool_image->isImageExists($product['image'])) {
				$image = $this->model_tool_image->resize($product['image'], 100, 100);
			} else {
				$image = $this->model_tool_image->resize('no-photo-img.png', 100, 100);
			}

			$option_data = array();

		/*	foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['value'];
				} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

					if ($upload_info) {
						$value = $upload_info['name'];
					} else {
						$value = '';
					}
				}

				$option_data[] = array(
					'name'  => $option['name'],
					'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
					'type'  => $option['type']
				);
			}
			*/

	/*		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $currency);
			} else {
				$price = false;
			}  */
			$product['quantity'] = $this->cache->get($sessi.'_pro_qua'.$product_id);
			$total = $price * $product['quantity'];
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'], $currency);
			} else {
				$total = false;
			}
			
			$product['maximum'] = 9999;
			$data['products'][] = array(
				'key'       	=> $product['cart_id'],
				'id'       		=> $product['product_id'],
				'thumb'     	=> $image,
				'name'      	=> 'aaaaaaaa--'.$product['name'],
				'model'     	=> $product['model'],
				'option'   		=> $option_data,
				'quantity'  	=> $product['quantity'],
				'stock'   	 	=> $this->config->get('config_stock_checkout'),
				'minimum'    	=> $product['minimum'],
				'maximum'    	=> $product['maximum'],
				'price'     	=> $price,
				'total'     	=> $total,
				'href'      	=> $this->url->link('product/product', 'product_id=' . $product['product_id'], true)
			);
		//}
		//калькулятор к общей сумме на бесплатную доставку свыше 250 грн.
		$deff_upFreeDelivSum=str_replace(' ','',$data['totals'][1]['text']);
		$deff_upFreeDelivSum = 250-floatval(str_replace(',','.',$deff_upFreeDelivSum));
		if($deff_upFreeDelivSum>0)
			$data['upFreeDelivSum'] = str_replace("{#upFreeDelivSum#}",$deff_upFreeDelivSum,$data["text_total"]);
		else
			$data['upFreeDelivSum']='';

		$data['cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

		return $this->load->view('default/template/module/popupcart.tpl', $data);

	}
	public function total_pr(){
		$sessi = $this->session->getId();
		
			$product_cart = $this->cache->get($sessi.'_cart_pro_');
			$products = explode(",", $product_cart);	
			$count_produs = 0;
		
			$tot_pr = 0;
			foreach($products as $prod){
				$pr = $this->cache->get('_pro_prc'.$prod);
				$qua = $this->cache->get($sessi.'_pro_qua'.$prod);
				$count_produs = $count_produs+$qua;
				$tot_pr = $tot_pr + $pr*$qua;
			}
			$tot_pr = $tot_pr." грн.";
			return($tot_pr);
	}

}
?>
