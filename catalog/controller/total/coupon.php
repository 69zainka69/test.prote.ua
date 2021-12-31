<?php
class ControllerTotalCoupon extends Controller {
	public function index() {
		if ($this->config->get('coupon_status')) {
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
		}
	}

	public function coupon() {
		$this->load->language('total/coupon');

		$json = array();

		$this->load->model('total/coupon');

		if (isset($this->request->post['coupon'])) {
			$coupon = $this->request->post['coupon'];
		} else {
			$coupon = '';
		}

		$coupon_info = $this->model_total_coupon->getCoupon($coupon);

		if (empty($this->request->post['coupon'])) {
			$json['error'] = $this->language->get('error_empty');

			unset($this->session->data['coupon']);
		} elseif ($coupon_info) {
			$this->session->data['coupon'] = $this->request->post['coupon'];
			$coup = $this->request->post['coupon'];
			$sessi = $this->session->getId();
			$this->cache->set($sessi.'_cup', $coup);
			$sSQL="INSERT INTO `prote.ua`.`coup_click` (`id`, `time`, `name`) VALUES (NULL, CURRENT_TIMESTAMP, '$coup')" ;
			$this->db->query($sSQL);
			
			if(isset($coup) && $coup != null){
				$sSQL="SELECT * FROM `oc_coupon` WHERE `code` LIKE '$coup'" ;
				$temp_coup = $this->db->query($sSQL);
				
					$cuponn = $temp_coup->rows[0]['discount'];
				
				$this->cache->set($sessi.'_cup_proc', $cuponn);
			}
			$this->session->data['success'] = $this->language->get('text_success');

			$json['redirect'] = $this->url->link('checkout/cart');
		} else {
			$json['error'] = $this->language->get('error_coupon');
		}
  
		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Cache-Control:no-store, no-cache');
		$this->response->setOutput(json_encode($json));
	}
}
