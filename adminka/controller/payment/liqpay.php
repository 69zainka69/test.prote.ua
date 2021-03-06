<?php
class ControllerPaymentLiqPay extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/liqpay');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('liqpay', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_pay'] = $this->language->get('text_pay');
		$data['text_card'] = $this->language->get('text_card');

        $data['entry_public_key_simple'] = $this->language->get('entry_public_key_simple');
        $data['entry_private_key_simple'] = $this->language->get('entry_private_key_simple');
        $data['entry_public_key_complex'] = $this->language->get('entry_public_key_complex');
        $data['entry_private_key_complex'] = $this->language->get('entry_private_key_complex');

		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_total'] = $this->language->get('help_total');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

        if (isset($this->error['public_key_simple'])) {
            $data['error_public_key_simple'] = $this->error['public_key_simple'];
        } else {
            $data['error_public_key_simple'] = '';
        }

        if (isset($this->error['private_key_simple'])) {
            $data['error_private_key_simple'] = $this->error['private_key_simple'];
        } else {
            $data['error_private_key_simple'] = '';
        }

        if (isset($this->error['public_key_complex'])) {
            $data['error_public_key_complex'] = $this->error['public_key_complex'];
        } else {
            $data['error_public_key_complex'] = '';
        }

        if (isset($this->error['private_key_complex'])) {
            $data['error_private_key_complex'] = $this->error['private_key_complex'];
        } else {
            $data['error_private_key_complex'] = '';
        }

		if (isset($this->error['type'])) {
			$data['error_type'] = $this->error['type'];
		} else {
			$data['error_type'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/liqpay', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/liqpay', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['liqpay_public_key_simple'])) {
            $data['liqpay_public_key_simple'] = $this->request->post['liqpay_public_key_simple'];
        } else {
            $data['liqpay_public_key_simple'] = $this->config->get('liqpay_public_key_simple');
        }

        if (isset($this->request->post['liqpay_private_key_simple'])) {
            $data['liqpay_private_key_simple'] = $this->request->post['liqpay_private_key_simple'];
        } else {
            $data['liqpay_private_key_simple'] = $this->config->get('liqpay_private_key_simple');
        }

        if (isset($this->request->post['liqpay_public_key_complex'])) {
            $data['liqpay_public_key_complex'] = $this->request->post['liqpay_public_key_complex'];
        } else {
            $data['liqpay_public_key_complex'] = $this->config->get('liqpay_public_key_complex');
        }

        if (isset($this->request->post['liqpay_private_key_complex'])) {
            $data['liqpay_private_key_complex'] = $this->request->post['liqpay_private_key_complex'];
        } else {
            $data['liqpay_private_key_complex'] = $this->config->get('liqpay_private_key_complex');
        }

		if (isset($this->request->post['liqpay_type'])) {
			$data['liqpay_type'] = $this->request->post['liqpay_type'];
		} else {
			$data['liqpay_type'] = $this->config->get('liqpay_type');
		}

		if (isset($this->request->post['liqpay_total'])) {
			$data['liqpay_total'] = $this->request->post['liqpay_total'];
		} else {
			$data['liqpay_total'] = $this->config->get('liqpay_total');
		}

		if (isset($this->request->post['liqpay_order_status_id'])) {
			$data['liqpay_order_status_id'] = $this->request->post['liqpay_order_status_id'];
		} else {
			$data['liqpay_order_status_id'] = $this->config->get('liqpay_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['liqpay_geo_zone_id'])) {
			$data['liqpay_geo_zone_id'] = $this->request->post['liqpay_geo_zone_id'];
		} else {
			$data['liqpay_geo_zone_id'] = $this->config->get('liqpay_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['liqpay_status'])) {
			$data['liqpay_status'] = $this->request->post['liqpay_status'];
		} else {
			$data['liqpay_status'] = $this->config->get('liqpay_status');
		}

		if (isset($this->request->post['liqpay_sort_order'])) {
			$data['liqpay_sort_order'] = $this->request->post['liqpay_sort_order'];
		} else {
			$data['liqpay_sort_order'] = $this->config->get('liqpay_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/liqpay.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/liqpay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

        if (!$this->request->post['liqpay_public_key_simple']) {
            $this->error['public_key_simple'] = $this->language->get('error_public_key_simple');
        }

        if (!$this->request->post['liqpay_private_key_simple']) {
            $this->error['private_key_simple'] = $this->language->get('error_private_key_simple');
        }

        if (!$this->request->post['liqpay_public_key_complex']) {
            $this->error['public_key_complex'] = $this->language->get('error_public_key_complex');
        }

        if (!$this->request->post['liqpay_private_key_complex']) {
            $this->error['private_key_complex'] = $this->language->get('error_private_key_complex');
        }

		return !$this->error;
	}
}
