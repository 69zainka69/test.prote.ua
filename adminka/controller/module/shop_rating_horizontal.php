<?php
class ControllerModuleShopRatingHorizontal extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('module/shop_rating_horizontal');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/shop_rating');

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('shop_rating_horizontal', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_settings_success');

            $this->response->redirect($this->url->link('module/shop_rating_horizontal', 'token=' . $this->session->data['token'], 'SSL'));
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['settings_block_title'] = $this->language->get('settings_block_title');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_count'] = $this->language->get('entry_count');
        $data['entry_show_rating'] = $this->language->get('entry_show_rating');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
        );
        $data['action'] = $this->url->link('module/shop_rating_horizontal', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        if (!isset($this->request->get['module_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('module/shop_rating_horizontal', 'token=' . $this->session->data['token'], 'SSL')
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('module/shop_rating_horizontal', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
            );
        }


        if (isset($this->request->post['shop_rating_horizontal_status'])) {
            $data['shop_rating_horizontal_status'] = $this->request->post['shop_rating_horizontal_status'];
        } else {
            $data['shop_rating_horizontal_status'] = $this->config->get('shop_rating_horizontal_status');
        }
        if (isset($this->request->post['shop_rating_horizontal_count'])) {
            $data['shop_rating_horizontal_count'] = $this->request->post['shop_rating_horizontal_count'];
        } else {
            $data['shop_rating_horizontal_count'] = $this->config->get('shop_rating_horizontal_count');
        }
        if (isset($this->request->post['shop_rating_horizontal_show_rating'])) {
            $data['shop_rating_horizontal_show_rating'] = $this->request->post['shop_rating_horizontal_show_rating'];
        } else {
            $data['shop_rating_horizontal_show_rating'] = $this->config->get('shop_rating_horizontal_show_rating');
        }


        $data['heading_title'] = $this->language->get('heading_title');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/shop_rating_horizontal.tpl', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/shop_rating_horizontal')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
?>