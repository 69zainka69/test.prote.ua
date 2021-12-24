<?php
class ControllerPaymentPortmone extends Controller {
	public function index() {
		$data['button_confirm'] = $this->language->get('button_confirm');

        $this->load->language('payment/portmone');

		$data['text_instruction'] = $this->language->get('text_instruction');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_payment'] = $this->language->get('text_payment');
		$data['text_loading'] = $this->language->get('text_loading');

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		$data['action'] = 'https://www.portmone.com.ua/gateway/';
		$data['payee_id'] = $this->config->get('portmone_payee_id');
		$data['shop_order_number'] = $this->session->data['order_id'];
		$data['bill_amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
		$data['description'] = 'Оплата в интернет магазине';
		$data['success_url'] = $this->url->link('payment/portmone/callback', '', 'SSL');
		$data['failure_url'] = $this->url->link('payment/portmone/callback', '', 'SSL');
		$data['lang'] = $this->language->get('code');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/portmone.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/portmone.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/portmone.tpl', $data);
		}
	}

	public function callback() {
		$result = $this->request->post['RESULT'];
		$isSuccess = (isset($result) && $result == 0) ? true : false;

		if($isSuccess) {
			$this->load->model('checkout/order');
			$order_id = $this->request->post['SHOPORDERNUMBER'];
			$amount = $this->request->post['BILL_AMOUNT'];
			$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
			$receipt_url = $this->request->post['RECEIPT_URL'];
		}

		if ($isSuccess && $order_id == $order_info['order_id'] && $amount == $order_info['total']) {
			$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('portmone_order_status_id'), $receipt_url);
			$this->response->redirect($this->url->link('checkout/success'));
		} else {
			$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('portmone_order_status_id_failure'), $result);
			$this->response->redirect($this->url->link('checkout/failure'));
		}

	}
}
