<?php
class ControllerPaymentBankTransfer2 extends Controller {
	public function index() {
		$this->load->language('payment/bank_transfer2');

		$data['text_instruction'] = $this->language->get('text_instruction');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_payment'] = $this->language->get('text_payment');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['bank'] = nl2br($this->config->get('bank_transfer2_bank' . $this->config->get('config_language_id')));

		$data['continue'] = $this->url->link('checkout/success');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/bank_transfer2.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/bank_transfer2.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/bank_transfer2.tpl', $data);
		}
	}

	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'bank_transfer2') {
			$this->load->language('payment/bank_transfer2');

			$this->load->model('checkout/order');

			$comment  = $this->language->get('text_instruction') . "\n\n";
			$comment .= $this->config->get('bank_transfer2_bank' . $this->config->get('config_language_id')) . "\n\n";
			$comment .= $this->language->get('text_payment');
			/*$this->log->write('order_id');
			$this->log->write($this->session->data['order_id']);
			$this->log->write('bank_transfer2_order_status_id');
			$this->log->write($this->config->get('bank_transfer2_order_status_id'));
			$this->log->write('comment');
			$this->log->write($comment);*/

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('bank_transfer2_order_status_id'), $comment, true);
		}
	}
}