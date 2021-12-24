<?php

/**
 * Opencart module: Order callback
 * For Opencart 1.5.x version
 *
 * @copyright Instup.com
 * @author LIAL (dev@instup.com)
 * @vesrion 1.0
 *
 */
class ControllerModuleOrdercallback extends Controller
{
    private $error = array();

    public function index() {

        $this->load->language('module/ordercallback');
        $this->load->model('setting/setting');

        $this->document->setTitle($this->language->get('heading_title_nolink'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('ordercallback', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title_nolink');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title_nolink'),
            'href'      => $this->url->link('module/ordercallback', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['action'] = $this->url->link('module/ordercallback', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        $data['token'] = $this->session->data['token'];

        if (isset($this->request->post['ordercallback_use_module'])) {
            $data['ordercallback_use_module'] = $this->request->post['ordercallback_use_module'];
        } else {
            $data['ordercallback_use_module'] = $this->config->get('ordercallback_use_module');
        }

        if (isset($this->request->post['ordercallback_module_works_as'])) {
            $data['module_works_as'] = $this->request->post['ordercallback_module_works_as'];
        } elseif ($this->config->get('ordercallback_module_works_as')) {
            $data['module_works_as'] = $this->config->get('ordercallback_module_works_as');
        } else {
            $data['module_works_as'] = 'call';
        }

        if (isset($this->request->post['ordercallback_button_caption'])) {
            $data['button_caption'] = $this->request->post['ordercallback_button_caption'];
        } elseif ($this->config->get('ordercallback_button_caption')) {
            $data['button_caption'] = $this->config->get('ordercallback_button_caption');
        } else {
            $data['button_caption'] = $this->language->get('tab_button_default_caption');
        }

        if (isset($this->request->post['ordercallback_send_notification_to_email'])) {
            $data['send_notification_to_email'] = $this->request->post['ordercallback_send_notification_to_email'];
        } else {
            $data['send_notification_to_email'] = $this->config->get('ordercallback_send_notification_to_email');
        }

        if (isset($this->request->post['ordercallback_send_notification_to_sms'])) {
            $data['send_notification_to_sms'] = $this->request->post['ordercallback_send_notification_to_sms'];
        } else {
            $data['send_notification_to_sms'] = $this->config->get('ordercallback_send_notification_to_sms');
        }

        if (isset($this->request->post['ordercallback_field_name_show'])) {
            $data['field_name_show'] = $this->request->post['ordercallback_field_name_show'];
        } else {
            $data['field_name_show'] = $this->config->get('ordercallback_field_name_show');
        }
        if (isset($this->request->post['ordercallback_field_name_required'])) {
            $data['field_name_required'] = $this->request->post['ordercallback_field_name_required'];
        } else {
            $data['field_name_required'] = $this->config->get('ordercallback_field_name_required');
        }

        if (isset($this->request->post['ordercallback_field_phone_show'])) {
            $data['field_phone_show'] = $this->request->post['ordercallback_field_phone_show'];
        } else {
            $data['field_phone_show'] = $this->config->get('ordercallback_field_phone_show');
        }
        if (isset($this->request->post['ordercallback_field_phone_required'])) {
            $data['field_phone_required'] = $this->request->post['ordercallback_field_phone_required'];
        } else {
            $data['field_phone_required'] = $this->config->get('ordercallback_field_phone_required');
        }

        if (isset($this->request->post['ordercallback_field_email_show'])) {
            $data['field_email_show'] = $this->request->post['ordercallback_field_email_show'];
        } else {
            $data['field_email_show'] = $this->config->get('ordercallback_field_email_show');
        }
        if (isset($this->request->post['ordercallback_field_email_required'])) {
            $data['field_email_required'] = $this->request->post['ordercallback_field_email_required'];
        } else {
            $data['field_email_required'] = $this->config->get('ordercallback_field_email_required');
        }

        if (isset($this->request->post['ordercallback_field_comment_show'])) {
            $data['field_comment_show'] = $this->request->post['ordercallback_field_comment_show'];
        } else {
            $data['field_comment_show'] = $this->config->get('ordercallback_field_comment_show');
        }
        if (isset($this->request->post['ordercallback_field_comment_required'])) {
            $data['field_comment_required'] = $this->request->post['ordercallback_field_comment_required'];
        } else {
            $data['field_comment_required'] = $this->config->get('ordercallback_field_comment_required');
        }

        if (isset($this->request->post['ordercallback_field_phone_mask'])) {
            $data['field_phone_mask'] = $this->request->post['ordercallback_field_phone_mask'];
        } elseif ($this->config->get('field_phone_mask')) {
            $data['field_phone_mask'] = $this->config->get('ordercallback_field_phone_mask');
        } else {
            $data['field_phone_mask'] = '';
        }

        if (isset($this->request->post['ordercallback_email_text'])) {
            $data['email_text'] = $this->request->post['ordercallback_email_text'];
        } elseif ($this->config->get('ordercallback_email_text')) {
            $data['email_text'] = $this->config->get('ordercallback_email_text');
        } else {
            $data['email_text'] = '';
        }

        $data['tab_text_common'] = $this->language->get('tab_text_common');
        $data['tab_text_fields'] = $this->language->get('tab_text_fields');
        $data['tab_button_default_caption'] = $this->language->get('tab_button_default_caption');

        $data['entry_use_module'] = $this->language->get('entry_use_module');
        $data['entry_module_works_as'] = $this->language->get('entry_module_works_as');
        $data['entry_button_caption'] = $this->language->get('entry_button_caption');
        $data['entry_send_notification_to_email'] = $this->language->get('entry_send_notification_to_email');
        $data['entry_send_notification_to_sms'] = $this->language->get('entry_send_notification_to_sms');
        $data['entry_field_name_show'] = $this->language->get('entry_field_name_show');
        $data['entry_field_name_required'] = $this->language->get('entry_field_name_required');
        $data['entry_field_phone_show'] = $this->language->get('entry_field_phone_show');
        $data['entry_field_phone_required'] = $this->language->get('entry_field_phone_required');
        $data['entry_field_email_show'] = $this->language->get('entry_field_email_show');
        $data['entry_field_email_required'] = $this->language->get('entry_field_email_required');
        $data['entry_field_comment_show'] = $this->language->get('entry_field_comment_show');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_phone_mask'] = $this->language->get('entry_field_phone_mask');
        $data['entry_field_phone_mask_help'] = $this->language->get('entry_field_phone_mask_help');
        $data['entry_email_text'] = $this->language->get('entry_email_text');
        $data['entry_email_text_help'] = $this->language->get('entry_email_text_help');

        $data['text_module_works_as_call'] = $this->language->get('text_module_works_as_call');
        $data['text_module_works_as_order'] = $this->language->get('text_module_works_as_order');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');
        $data['entry_field_comment_required'] = $this->language->get('entry_field_comment_required');

        $this->template = 'module/ordercallback.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $data['header'] = $this->load->controller('common/header');
		    $data['column_left'] = $this->load->controller('common/column_left');
		    $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/ordercallback.tpl', $data));
    }

    public function install() {
        $this->load->model('setting/setting');
        $this->load->language('module/ordercallback');

        $settings = array(
            //Common
            'ordercallback_use_module'   => 1, //(0/1)
            'module_works_as'            => 'call', //(call|order)
            'button_caption'             => $this->language->get('tab_button_default_caption'),
            'send_notification_to_email' => 1, //(0/1)
            'send_notification_to_sms'   => 0, //(0/1)
            'email_text'                 => 'Visitor {name} of your shop, asks to call by phone {phone} or write message to email {email}.' . "\n" . 'Comment: {comment}',

            //Fields
            'field_name_show'            => 1, //(0/1)
            'field_name_required'        => 0, //(0/1)
            'field_phone_show'           => 1, //(0/1)
            'field_phone_required'       => 1, //(0/1)
            'field_email_show'           => 0, //(0/1)
            'field_email_required'       => 0, //(0/1)
            'field_comment_show'         => 1, //(0/1)
            'field_comment_required'     => 0, //(0/1)
            'field_phone_mask'           => '+7-(999)-999-9999',
        );

        $this->model_setting_setting->editSetting('ordercallback', $settings);
    }

    public function uninstall() {
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('ordercallback');
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/ordercallback')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
