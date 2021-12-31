<?php
class ControllerCheckoutCart extends Controller {
	public function index() {
		$this->load->language('checkout/cart');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('common/home'),
			'text' => $this->language->get('text_home')
		);

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('checkout/cart'),
			'text' => $this->language->get('heading_title')
		);
		$sessi = $this->session->getId();
		
		$cart_ids = $this->db->query("SELECT * FROM `oc_cart` WHERE `session_id` LIKE '$sessi'");
		
		$cnt = count($cart_ids->rows);
		
		for($i=0; $i!=$cnt; $i++){
			$cart_id = $cart_ids->rows[$i]['cart_id'];
			$this->db->query("DELETE FROM `oc_cart` WHERE `oc_cart`.`cart_id` = $cart_id");
			$cart_id = null;
		}

		$products_ids = $this->cache->get($sessi.'_cart_pro_');
		$products = explode(",", $products_ids);
		foreach($products as $prod){
			if(isset($prod) && $prod != null){
			$product_id = $prod;
			$quantity = $this->cache->get($sessi.'_pro_qua'.$product_id);
			$option = array();
			$recurring_id = 0;
			$this->cart->add($product_id, $quantity, $option, $recurring_id);
		}}
		$productse = $this->cache->get($sessi.'_cart_pro_');
		if (isset($productse) && $productse != null) {
			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_recurring_item'] = $this->language->get('text_recurring_item');
			$data['text_next'] = $this->language->get('text_next');
			$data['text_next_choice'] = $this->language->get('text_next_choice');

			$data['column_image'] = $this->language->get('column_image');
			$data['column_name'] = $this->language->get('column_name');
			$data['column_model'] = $this->language->get('column_model');
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_total'] = $this->language->get('column_total');

			$data['button_update'] = $this->language->get('button_update');
			$data['button_remove'] = $this->language->get('button_remove');
			$data['button_shopping'] = $this->language->get('button_shopping');
			$data['button_checkout'] = $this->language->get('button_checkout');
			$data['button_shopping'] = $this->language->get('button_shopping');
			$data['text_total'] = $this->language->get('text_upFreeDelivSum');


			if (!$this->cart->hasStock() && (!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning'))) {
				$data['error_warning'] = $this->language->get('error_stock');
			} elseif (isset($this->session->data['error'])) {
				$data['error_warning'] = $this->session->data['error'];

				unset($this->session->data['error']);
			} else {
				$data['error_warning'] = '';
			}

			if ($this->config->get('config_customer_price') && !$this->customer->isLogged()) {
				$data['attention'] = sprintf($this->language->get('text_login'), $this->url->link('account/login'), $this->url->link('account/register'));
			} else {
				$data['attention'] = '';
			}

			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];

				unset($this->session->data['success']);
			} else {
				$data['success'] = '';
			}

			$data['action'] = $this->url->link('checkout/cart/edit', '', true);



			if ($this->config->get('config_cart_weight')) {
				$data['weight'] = $this->weight->format($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'));
			} else {
				$data['weight'] = '';
			}
 
			$this->load->model('tool/image');
			$this->load->model('tool/upload');

			$data['products'] = array();

		//	$products = $this->cart->getProducts();


			

		/*	$this->session->data['products_cart_total'] = $this->cart->getSubTotal();
			$products_ids = ''; // для Google ремаркетинга
*/
			$products_ids = '';
			$sessi = $this->session->getId();
			//$sessi = 1;
		
			$productse = $this->cache->get($sessi.'_cart_pro_');
			$products = explode(",", $productse);
			foreach ($products as $product_id){
				if(isset($product_id) && $product_id!=null){
				
				$quantity = $this->cache->get($sessi.'_pro_qua'.$product_id);
				$images = $this->cache->get('_pro_img'.$product_id);
				if ($images) {
					$image = $this->model_tool_image->resize($images, 150,150);
				} else {
					$image = '';
				}
				$price = $this->cache->get('_pro_prc'.$product_id);
				$minimum = $this->cache->get('_pro_min'.$product_id);
				$model = $this->cache->get('_pro_mod'.$product_id);
				$name = $this->cache->get('_pro_name'.$product_id);
				$total_int = $price*$quantity;
				$total = $price*$quantity." грн.";


				$data['products'][] = array(
					'cart_id'   => $product_id,
					'thumb'     => $image,
					'name'      => $name,
					'model'     => $model,
					'minimum'     => $minimum,
					//'option'    => $option_data,
				//	'recurring' => $recurring,
					'quantity'  => $quantity,
					'stock'     => (!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
				//	'reward'    => ($product['reward'] ? sprintf($this->language->get('text_points'), $product['reward']) : ''),
					'price'     => $price,
					//'price_int'     => $price_int,
					'price_int'     => $total_int,
					'total'     => $total,
					'href'      => $this->url->link('product/product', 'product_id=' . $product_id),
				//	'you_price'      => $you_price
				);

			}
		}
		



			$this->session->data['products_cart_ids'] = trim($products_ids,','); // для Google ремаркетинга
			// Gift Voucher
			$data['vouchers'] = array();

			if (!empty($this->session->data['vouchers'])) {
				foreach ($this->session->data['vouchers'] as $key => $voucher) {
					$data['vouchers'][] = array(
						'key'         => $key,
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount']),
						'remove'      => $this->url->link('checkout/cart', 'remove=' . $key)
					);
				}
			}

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
				//vdump($results);
				foreach ($results as $result) {

					if ($this->config->get($result['code'] . '_status')) {
						$this->load->model('total/' . $result['code']);
						//vdump('model_total_' . $result['code']);
						$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
						//vdump($total_data);
					}
				}

				$sort_order = array();

				foreach ($total_data as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}

				array_multisort($sort_order, SORT_ASC, $total_data);
			}
			
			$tot_pr = $this->total_pr();			
			
			$data['totals'] = array();
			
			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'code' => $total['code'],
					'title' => $total['title'],
					'text'  => number_format((float)$total['value'], 2, '.', ''),
				);
			}
			$data['totals'][0] = array(
				'code' => 'sub_total',
				'title' => $total['title'],
				'text'  => $tot_pr,
			);
		
			//$data['continue'] = $this->url->link('common/home');
			$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
			//vdump($data['checkout']);

			$this->load->model('extension/extension');

			$data['checkout_buttons'] = array();
			$files = glob(DIR_APPLICATION . '/controller/total/*.php');

			if ($files) {
				foreach ($files as $file) {
					$extension = basename($file, '.php');
					$data[$extension] = $this->load->controller('total/' . $extension);
				}
			}

			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			//калькулятор к общей сумме на бесплатную доставку свыше 250 грн.

		$deff_upFreeDelivSum=str_replace(' ','',$data['totals'][1]['text']);
		$deff_upFreeDelivSum = 499-floatval(str_replace(',','.',$deff_upFreeDelivSum));

		$deff_upFreeDelivSum == 998;


		if($deff_upFreeDelivSum>0)
			$data['upFreeDelivSum'] = str_replace("{#upFreeDelivSum#}",$deff_upFreeDelivSum,$data["text_total"]);
		else
			$data['upFreeDelivSum']='';



			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/cart.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/cart.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/checkout/cart.tpl', $data));
			}
		} else {
			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_error'] = $this->language->get('text_empty');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			unset($this->session->data['success']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
      		$data['notfoundimg'] = 'image/catalog/cartempty.png';

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function add() {


		

		$this->load->language('checkout/cart');
		$json = array();
		if (isset($this->request->post['product_id'])) {
			$product_id = (int)$this->request->post['product_id'];
		} elseif (isset($this->request->post['prod_id'])) {
			$product_id = (int)$this->request->post['prod_id'];
		} else {
			$product_id = 0;
		}
 
		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);
		
		$sessi = $this->session->getId();
		$this->cache->del($sessi.'_last_pr');
		$this->cache->set($sessi.'_last_pr', $product_id);

		$product_cart = $this->cache->get($sessi.'_cart_pro_');
		if(isset($product_cart) && $product_cart != null){
		$products = explode(",", $product_cart);
		$rr = 'NO';
		$qty = 0;
		foreach($products as $prod){
				if($prod == $product_id){
					$rr = 'YES';
					$qty = $this->cache->get($sessi.'_pro_qua'.$product_id);
					$this->cache->set($sessi.'_cart_pro_', $product_cart);
				}
			}
			if($rr == 'NO'){
				$product_cart = $product_id.",".$product_cart;
				$this->cache->set($sessi.'_cart_pro_', $product_cart);
				}
			}else{
				$this->cache->set($sessi.'_cart_pro_', $product_id);
			}

		if ($product_info) {
			if (isset($this->request->post['quantity']) && ((int)$this->request->post['quantity'] >= $product_info['minimum'])) {
				$quantity = (int)$this->request->post['quantity'];
			} else {
				$quantity = $product_info['minimum'] ? $product_info['minimum'] : 1;
			}

			$quant = $quantity+$qty;
			$this->cache->set($sessi.'_pro_qua'.$product_id, $quant);
			$prices = $product_info['price'];

			$sSQL="SELECT * FROM `oc_product_special` WHERE `product_id` = $product_id" ;
			$temp_pr = $this->db->query($sSQL);
			foreach ($temp_pr as $_pr){
				if(isset($_pr['price'])){
				$pricess = $_pr['price'];
				$date_end = $_pr['date_end'];
			}
			}
			$today = date('Y-m-d'); 
			if(isset($pricess) && $pricess != null && $date_end >= $today){
				$prices = $pricess;
			}
			$this->cache->del('_pro_prc'.$product_id);
			$this->cache->set('_pro_prc'.$product_id, $prices);
			$this->cache->set('_pro_img'.$product_id, $product_info['image']);
			$this->cache->set('_pro_mod'.$product_id, $product_info['model']);
			$this->cache->set('_pro_name'.$product_id, $product_info['name']);
			$this->cache->set('_pro_min'.$product_id, $product_info['minimum']);
			$this->cache->set('_pro_tax_class_id_'.$product_id, $product_info['tax_class_id']);
		//	$product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);

		/*	foreach ($product_options as $product_option) {
				if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
					$json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
				}
			}
*/
			if (isset($this->request->post['recurring_id'])) {
				$recurring_id = $this->request->post['recurring_id'];
			} else {
				$recurring_id = 0;
			}

			$recurrings = $this->model_catalog_product->getProfiles($product_info['product_id']);

			if ($recurrings) {
				$recurring_ids = array();

				foreach ($recurrings as $recurring) {
					$recurring_ids[] = $recurring['recurring_id'];
				}

				if (!in_array($recurring_id, $recurring_ids)) {
					$json['error']['recurring'] = $this->language->get('error_recurring_required');
				}
			}

				

			if (!$json) {
				//$this->cart->add($this->request->post['product_id'], $quantity, $option, $recurring_id);
				//$prods = $this->cart->hasProducts();

				$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']), $product_info['name'], $this->url->link('checkout/cart'));

				// Unset all shipping and payment methods
				unset($this->session->data['shipping_method']);
				unset($this->session->data['shipping_methods']);
				unset($this->session->data['payment_method']);
				unset($this->session->data['payment_methods']);

				// Totals
				$this->load->model('extension/extension');

				$total_data = array();
				$total = 0;
				$taxes = $this->cart->getTaxes();
				$this->cache->set($sessi.'_pro_tax'.$product_id, $taxes);
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
				$tot_pr = $this->total_pr();
				$total_coun = $this->total_coun();
				$json['total'] = sprintf($this->language->get('text_items'), $total_coun, $this->currency->format($tot_pr));
								$json['totals'] = $total_coun;
			} else {
				$json['redirect'] = str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']));
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Cache-Control:no-store, no-cache');

		$this->response->setOutput(json_encode($json));
	}

	public function edit() {
		$this->load->language('checkout/cart');

		$json = array();

		$this->load->model('catalog/product');
		$product_info =false;
		$js = false;
		$product_id = $this->request->get['product_id'];
		if(isset($product_id)){
			//$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
			$js = true;
		}

		$sessi = $this->session->getId();
	
		
		if (!empty($this->request->post['quantity'])) {
            foreach ($this->request->post['quantity'] as $key => $value) {
				$this->cache->set($sessi.'_pro_qua'.$key, $value);
		
}
}
	
		/*if ($product_info) {
			if (isset($this->request->post['quantity']) &&
				((int)$this->request->post['quantity'] >= $product_info['minimum'])) {
				$quantity = (int)$this->request->post['quantity'];
			} else {
				$quantity = $product_info['minimum'] ? $product_info['minimum'] : 1;
			}
		}*/

        //exit;


		// Update


			if(!$js){
				$this->response->addHeader('Cache-Control:no-store, no-cache');
				$this->response->redirect($this->url->link('checkout/cart'));
			}
		

		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Cache-Control:no-store, no-cache');
		$this->response->setOutput(json_encode($json));
	}

	public function remove() {
		
		$this->load->language('checkout/cart');
		$sessi = $this->session->getId();
		
		$json = array();
		$product_id = $_GET["product_id"];
		preg_match_all("/\d+/", $product_id, $matches);
		$product_id = $matches[0][0];
		$pros = "";
		$product_cart = $this->cache->get($sessi.'_cart_pro_');
		$products = explode(",", $product_cart);	
		foreach ($products as $prodss){
			if($prodss == $product_id){
		$this->cache->del($sessi.'_pro_qua'.$this->request->post['key']);
		//$this->cache->del($sessi.'_pro_qua'.$prodss);
				}
		}
		foreach ($products as $prodss){
			if($prodss != $this->request->post['key']){
				$pros = $prodss.",".$pros;
			}
		}



		$this->cache->set($sessi.'_cart_pro_', $pros);


		// Remove
		if (isset($this->request->post['key'])) {
			$this->cart->remove($this->request->post['key']);

			unset($this->session->data['vouchers'][$this->request->post['key']]);

			$this->session->data['success'] = $this->language->get('text_remove');

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['reward']);

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
			
			$tot_pr = $this->total_pr();			
			$count_produs = $this->total_coun();
			$json['total'] = sprintf($this->language->get('text_items'), $count_produs ,$tot_pr);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Cache-Control:no-store, no-cache');
		$this->response->setOutput(json_encode($json));
	}

	public function you_price() {

		if(isset($this->request->post['cart_id'])){
			$this->session->data['you_price'][$this->request->post['cart_id']] = $this->request->post['you_price'];
		}

		$json = array();

		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Cache-Control:no-store, no-cache');
		$this->response->setOutput(json_encode($json));
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


	public function total_coun(){
		$sessi = $this->session->getId();
		
			$product_cart = $this->cache->get($sessi.'_cart_pro_');
			$products = explode(",", $product_cart);	
			$count_produs = 0;
		
		
			foreach($products as $prod){
				if(isset($prod) && $prod!=null){
				$qua = $this->cache->get($sessi.'_pro_qua'.$prod);
				$count_produs = $count_produs+$qua;
			}
			}
			
			return($count_produs);
	}

}
