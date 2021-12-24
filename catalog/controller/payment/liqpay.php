<?php
class ControllerPaymentLiqPay extends Controller {

    private $version = 3;
    private $action  = 'pay';
    private $api_url = 'https://www.liqpay.ua/api/3/checkout';

	public function index() {
		$data['button_confirm'] = $this->language->get('button_confirm');

        $this->load->language('payment/liqpay');

        $data['text_instruction'] = $this->language->get('text_instruction');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_payment'] = $this->language->get('text_payment');
        $data['text_loading'] = $this->language->get('text_loading');

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		$data['action'] = $this->api_url;
        $public_key     = !empty($order_info['is_complex']) ? $this->config->get('liqpay_public_key_complex') : $this->config->get('liqpay_public_key_simple');
        $private_key    = !empty($order_info['is_complex']) ? $this->config->get('liqpay_private_key_complex') : $this->config->get('liqpay_private_key_simple');

        $version        = $this->version;
        $action         = $this->action;
        $amount         = $this->currency->format(
            $order_info['total'],
            $order_info['currency_code'],
            $order_info['currency_value'],
            false
        );
        $currency       = $order_info['currency_code'];
        if ($currency == 'RUR') { $currency = 'RUB'; }
        $description    = $this->config->get('config_name') . ' ' . $order_info['payment_firstname'] . ' ' . $order_info['payment_lastname'] . ' ' . $order_info['payment_address_1'] . ' ' . $order_info['payment_city'] . ' ' . $order_info['email'];
        $order_id       = $order_info['order_id'] . '_' . time();

        $language       = $order_info['language_code'] === 'ua' ? 'uk' : 'ru';
        $result_url     = $this->url->link('payment/liqpay/callback', '', 'SSL');
        $params            = compact('public_key', 'version', 'action', 'amount', 'currency', 'description', 'order_id');
        $optional_params   = compact('language', 'result_url');
        if(!empty($optional_params)){
            $params = array_merge($params, $optional_params);
        }

        $data['data']      = $this->calculateData($params);
		$data['signature'] = $this->calculateSignature($data['data'], $private_key);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/liqpay.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/liqpay.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/liqpay.tpl', $data);
		}
	}

	public function callback() {
        $data        = $this->request->post['data'];
        $parsed_data = $this->parseData($data);
        $order_id    = strstr($parsed_data['order_id'], '_', true);
        $isSuccess = isset($parsed_data['status']) && $parsed_data['status'] == 'success';

        if (!empty($order_id)) {
            $this->load->model('checkout/order');
            $order_info = $this->model_checkout_order->getOrder($order_id);
            if (!empty($order_info['is_complex'])) {
                $private_key = $this->config->get('liqpay_private_key_complex');
                $comment = 'Complex';
            } else {
                $private_key = $this->config->get('liqpay_private_key_simple');
                $comment = 'Simple';
            }
            $signature   = $this->calculateSignature($data, $private_key);
        }

        if(!empty($parsed_data['language'])){
            $language = $parsed_data['language'] == 'uk' ? 'ua' : 'ru';
        } else {
            $language = $this->config->get('config_language');
        }

        if ($isSuccess && !empty($signature) && !empty($comment) && $signature === $this->request->post['signature']) {
            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('liqpay_order_status_id'), $comment);
            $this->response->redirect($this->url->link('checkout/success', 'language=' . $language));
        } else {
            $this->response->redirect($this->url->link('checkout/failure', 'language=' . $language));
        }
	}

    private function calculateSignature($data, $private_key)
    {
        return base64_encode(sha1($private_key . $data . $private_key, true));
    }

    private function calculateData($data)
    {
        return base64_encode(json_encode($data));
    }

    private function parseData($data)
    {
        return json_decode(base64_decode($data), true);
    }
}
