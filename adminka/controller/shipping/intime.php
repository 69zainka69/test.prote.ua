<?php

class ControllerShippingintime extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('shipping/intime');

        //$this->document->title = $this->language->get('heading_title');
	  $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->model_setting_setting->editSetting('intime', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect(HTTPS_SERVER . 'index.php?route=extension/shipping&token=' . $this->session->data['token']);
        }

        // установка языковых переменных
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');
        $data['text_none'] = $this->language->get('text_none');

        $data['entry_tax'] = $this->language->get('entry_tax');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['entry_delivery_price'] = $this->language->get('entry_delivery_price');
        $data['entry_min_total_for_free_delivery'] = $this->language->get('entry_min_total_for_free_delivery');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        // хлебные крошки
        $this->document->breadcrumbs = array();

        $this->document->breadcrumbs[] = array(
            'href' => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
            'text' => $this->language->get('text_home'),
            'separator' => FALSE
        );

        $this->document->breadcrumbs[] = array(
            'href' => HTTPS_SERVER . 'index.php?route=extension/shipping&token=' . $this->session->data['token'],
            'text' => $this->language->get('text_shipping'),
            'separator' => ' :: '
        );

        $this->document->breadcrumbs[] = array(
            'href' => HTTPS_SERVER . 'index.php?route=shipping/intime&token=' . $this->session->data['token'],
            'text' => $this->language->get('heading_title'),
            'separator' => ' :: '
        );

        // ссылки для кнопок Сохранить и Отменить
        $data['action'] = HTTPS_SERVER . 'index.php?route=shipping/intime&token=' . $this->session->data['token'];

        $data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/shipping&token=' . $this->session->data['token'];

        if (isset($this->request->post['intime_min_total_for_free_delivery'])) {
            $data['intime_min_total_for_free_delivery'] = $this->request->post['intime_min_total_for_free_delivery'];
        } else {
            $data['intime_min_total_for_free_delivery'] = $this->config->get('intime_min_total_for_free_delivery');
        }

        if (isset($this->request->post['intime_delivery_price'])) {
            $data['intime_delivery_price'] = $this->request->post['intime_delivery_price'];
        } else {
            $data['intime_delivery_price'] = $this->config->get('intime_delivery_price');
        }

        if (isset($this->request->post['intime_geo_zone_id'])) {
            $data['intime_geo_zone_id'] = $this->request->post['intime_geo_zone_id'];
        } else {
            $data['intime_geo_zone_id'] = $this->config->get('intime_geo_zone_id');
        }

        if (isset($this->request->post['intime_status'])) {
            $data['intime_status'] = $this->request->post['intime_status'];
        } else {
            $data['intime_status'] = $this->config->get('intime_status');
        }

        if (isset($this->request->post['intime_sort_order'])) {
            $data['intime_sort_order'] = $this->request->post['intime_sort_order'];
        } else {
            $data['intime_sort_order'] = $this->config->get('intime_sort_order');
        }

        $this->load->model('localisation/geo_zone');

        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        //$this->template = 'shipping/intime.tpl';

		/*
        $this->data['column_left'] = $this->load->controller('common/column_left');
		$this->data['column_right'] = $this->load->controller('common/column_right');
		$this->data['content_top'] = $this->load->controller('common/content_top');
		$this->data['content_bottom'] = $this->load->controller('common/content_bottom');
		*/
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		$this->response->setOutput($this->load->view('shipping/intime.tpl',$data));

        //$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'shipping/intime')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>