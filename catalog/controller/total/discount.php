<?php
class ControllerTotalDiscount extends Controller {
	public function index() {
		/*if ($this->config->get('coupon_status')) {
			$this->load->language('total/coupon');

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_loading'] = $this->language->get('text_loading');

			$data['entry_coupon'] = $this->language->get('entry_coupon');

			$data['button_coupon'] = $this->language->get('button_coupon');

			if (isset($this->session->data['coupon'])) {
				$data['coupon'] = $this->session->data['coupon'];
			} else {
				$data['coupon'] = '';
			}

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/total/coupon.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/total/coupon.tpl', $data);
			} else {
				return $this->load->view('default/template/total/coupon.tpl', $data);
			}
		}*/
	}

}
