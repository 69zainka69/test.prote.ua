<?php
class ControllerCheckoutSuccess extends Controller {
	public function index() {
		$this->load->language('checkout/success');
		$activity_data = array('order_id'=>'');
        $this->log->write($this->session);
		if (isset($this->session->data['order_id'])) {
            $data['purchase'] = '';

            //if (isset($this->request->get['admin'])) {
            //getOrder($this->session->data['order_id']);
            $this->load->model('checkout/order');
            $this->load->model('account/order');
            $order_data = $this->model_checkout_order->getOrder($this->session->data['order_id']);

            $order_products = $this->model_account_order->getOrderProducts($this->session->data['order_id']);

            $data['order_id'] = $this->session->data['order_id'];
            if ($this->customer->isLogged()) {
            	$data['email'] = $this->session->data['guest']['email']??'';
            } else {
            	$data['email'] = $this->session->data['payment_address']['email']??'';
            }

            $data['google_reviews_products'] = '';

            //$order_total = $this->model_account_order->getOrderTotals('1926');
            //if(isset($order_total[0]))$order_total=$order_total[0];

            $purchase  = '"transaction_id": "'.$this->session->data['order_id'].'",';
            $purchase .= '"affiliation": "Prote.ua",';
            $purchase .= '"value": '.$order_data['total'].',';
            $purchase .= '"currency": "UAH",';
            //$purchase += '"tax": 1.24,';
            $purchase .= '"shipping": 0,';
            $purchase .= '"items": [';

            foreach ($order_products as $key => $product) {

                $query = $this->db->query("SELECT name FROM `oc_product_to_category` ptc LEFT JOIN `oc_category_description`cd ON(ptc.category_id=cd.category_id) WHERE product_id=".$product['product_id']." AND language_id=1");

            	$data['google_reviews_products'] .= '{"gtin":"'.$product['model'].'"}';
                $purchase .= "{";
                $purchase .= '"id":"'.$product['model'].'",';
                $purchase .= '"name":"'.$product['name'].'",';
                //$purchase += '"list_name": "Search Results",';
                //$purchase += '"brand": "Google",';
                if(isset($query->row['name'])){
                    $purchase .= '"category":"'.$query->row['name'].'",';
                }
                //$purchas += '"variant": "Black",';
                $purchase .= '"list_position":'.$key.',';
                $purchase .= '"quantity":'.$product['quantity'].',';
                $purchase .= '"price":"'.round($product['price'],2).'"';
                $purchase .= '}';
                if(count($order_products)-1>$key){
                	$purchase .= ',';
                	$data['google_reviews_products'] .= ',';
                }

            }

            $purchase .= ']';
            $data['purchase'] = $purchase;

			$this->cart->clear();

			// Add to activity log
			$this->load->model('account/activity');

			if ($this->customer->isLogged()) {
				$activity_data = array(
					'customer_id' => $this->customer->getId(),
					'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
					'order_id'    => $this->session->data['order_id']
				);

				$this->model_account_activity->addActivity('order_account', $activity_data);
			} else {
				$activity_data = array(
					'name'     => $this->session->data['guest']['firstname'] . ' ' . $this->session->data['guest']['lastname'],
					'order_id' => $this->session->data['order_id']
				);

				$this->model_account_activity->addActivity('order_guest', $activity_data);
			}

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
			unset($this->session->data['totals']);
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_basket'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_checkout'),
			'href' => $this->url->link('checkout/checkout', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_success'),
			'href' => $this->url->link('checkout/success')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		if ($this->customer->isLogged()) {
			// $data['text_message'] = sprintf($this->language->get('text_customer'), $this->url->link('account/account', '', 'SSL'), $this->url->link('account/order', '', 'SSL'), $this->url->link('account/download', '', 'SSL'), $this->url->link('information/contact'));
      		$data['text_message'] = sprintf($this->language->get('text_customer'), $activity_data['order_id']);
		} else {
			// $data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
      		$data['text_message'] = sprintf($this->language->get('text_guest'), $activity_data['order_id']);
		}

		/*$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');*/
		$data['content_top'] = $this->load->controller('common/content_top');
		//$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['column_left'] ='';
		$data['column_right'] ='';
		$data['content_bottom'] ='';
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
    	$data['order_id']=$activity_data['order_id'];

    	$this->load->language('information/html/about_us');
    	$data['text_sub_title1'] = $this->language->get('text_sub_title1');
    	$langurl=($this->language->get('code')=='uk'?'/ua':'');
        $data['text_sub_text1'] = sprintf($this->language->get('text_sub_text1'),$langurl,$langurl);
    	$data['text_sub_title2'] = $this->language->get('text_sub_title2');
    	$data['text_sub_text2'] = $this->language->get('text_sub_text2');
    	$data['text_sub_title3'] = $this->language->get('text_sub_title3');
    	$data['text_sub_text3'] = $this->language->get('text_sub_text3');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
		}
	}
}
