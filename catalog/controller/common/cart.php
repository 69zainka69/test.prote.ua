<?php
class ControllerCommonCart extends Controller {
	public function index($mobile = false) { 
             // $lang=(int)$this->config->get('config_language_id');
            //$language = new Language('ukrainian');
            //$language->load('ukrainian');
            //$language->load('common/cart');
            // $registry->set('language', $language);
             // $this->config->set('config_language_id',2);
        //$data['langurl']=($this->language->get('code')=='uk'?'/ua':'');
             // var_dump($language);
		$this->load->language('common/cart');

		// Totals
		$this->load->model('extension/extension');

		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();

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

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_cart'] = $this->language->get('text_cart');
		// $data['text_cart'] = $language->get('text_cart');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_recurring'] = $this->language->get('text_recurring');
        /*if ($this->cart->countProducts()) {
            $data['text_items'] = sprintf($this->language->get('text_items'), $this->vidminok($this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->language->get('text_tovars')),$this->currency->format($total));;
                    
        } else {
            $data['text_items'] = $this->language->get('text_empty');
        }*/
        
		$sessi = $this->session->getId();
		$product_cart = $this->cache->get($sessi.'_cart_pro_');
		$products = explode(",", $product_cart);	
		$count_produs = 0;
		$cup = $this->cache->get($sessi.'_cup_proc');
		if(isset($cup) && $cup!=0 && $cup != null){
			$tot_pr = 0;
			foreach($products as $prod){
				$pr = $this->cache->get('_pro_prc'.$prod);
				$qua = $this->cache->get($sessi.'_pro_qua'.$prod);
				$count_produs = $count_produs+$qua;
				$tot_pr = $tot_pr + $pr*$qua;
			}
			$tot_pr = (100-$cup)*$tot_pr / 100;
			$tot_pr = number_format((float)$tot_pr, 2, '.', '');
		}else{

		$tot_pr = 0;
		foreach($products as $prod){
			$pr = $this->cache->get('_pro_prc'.$prod);
			$qua = $this->cache->get($sessi.'_pro_qua'.$prod);
			$count_produs = $count_produs+$qua;
			$tot_pr = $tot_pr + $pr*$qua;
		}
	}
		$tot_pr = $tot_pr." ??????.";
	




        $data['text_items'] = sprintf($this->language->get('text_items'), $count_produs ,$tot_pr);
		$data['text_items_mobile'] = sprintf($this->language->get('text_items_mobile'),$this->currency->format($total), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0));


    // $data['text_']=$this->cart->countProducts();
		$data['text_loading'] = $this->language->get('text_loading');

		$data['button_remove'] = $this->language->get('button_remove');

		$this->load->model('tool/image');
		$this->load->model('tool/upload');

		$data['products'] = array();

		foreach ($this->cart->getProducts() as $product) {
			if ($product['image']) {
				$image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			} else {
				$image = '';
			}

			$option_data = array();

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
			}

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
			} else {
				$total = false;
			}

			$data['products'][] = array(
				'cart_id'   => $product['cart_id'],
				'thumb'     => $image,
				'name'      => $product['name'],
				'model'     => $product['model'],
				'option'    => $option_data,
				'recurring' => ($product['recurring'] ? $product['recurring']['name'] : ''),
				'quantity'  => $product['quantity'],
				'price'     => $price,
				'total'     => $total,
				'href'      => $this->url->link('product/product', 'product_id=' . $product['product_id'])
			);
		}

		// Gift Voucher
		$data['vouchers'] = array();

		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $key => $voucher) {
				$data['vouchers'][] = array(
					'key'         => $key,
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'])
				);
			}
		}

		$data['totals'] = array();

		foreach ($total_data as $result) {
      if ($result['code']=='total') {
			$data['totals'][] = array(
				'title' => $result['title'],
				'text'  => $this->currency->format($result['value']),
			);
      }
		}

		$data['cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		/*if (isset($this->request->get['admin'])) {
			return $this->load->view('default/template/common/cart_new.tpl', $data);
		}*/

		/*if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/cart.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/cart.tpl', $data);
		} else {*/
			if(!$mobile) {
				return $this->load->view('default/template/common/cart.tpl', $data);
			} else {
				return $this->load->view('default/template/common/cart_mobile.tpl', $data);
			}
		//}
	}

	public function info() {
		//$this->response->setOutput($this->index());
	}
        
        function vidminok($number,$titles,$x=FALSE) {      
            $cases = array (2, 0, 1, 1, 1, 2);        
            return ((!$x)?$number." ":FALSE).$titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
        }
}
