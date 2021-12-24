<?php
class ControllerCommonFooter extends Controller {
    public function index() {
        $this->load->language('common/footer');

        $data['langurl']=($this->language->get('code')=='uk'?'/ua':'');
        //$this->document->addScript('catalog/view/javascript/popupcart.js','footer','async');


        //всплывающая корзина
        //$this->document->addStyle('catalog/view/theme/default/stylesheet/popupcart.css?ver=1');
        //$this->document->addScript('catalog/view/js/popupcart.js?v=4','footer','async');

        // ***********************************************
        // для Google ремаркетинга
        $data['products_ids'] = false;
        if(isset($this->session->data['products_ids'])){
            $data['products_ids'] = $this->session->data['products_ids'];
        };
        if(isset($this->session->data['products_cart_total'])){
            $data['products_cart_total'] = $this->session->data['products_cart_total'] ;
        };
        if(isset($this->session->data['products_cart_ids'])){
            $data['products_cart_ids'] = $this->session->data['products_cart_ids'] ;
        };
        //vdump($data['products_ids']);
        // ***********************************************


        $this->load->model('setting/setting');
        $ordercallback_settings = $this->model_setting_setting->getSetting('ordercallback');

        $ordercallback_settings['modal_title'] = '';

        if ($ordercallback_settings['ordercallback_use_module']) {
            $this->load->language('module/ordercallback');

            $data['ordercallback_use_module'] = true;

            $data['ordercallback_as_order'] = false;
            $ordercallback_settings['modal_title'] = $this->language->get('modal_title_call');

            $data['modal_field_name'] = $this->language->get('modal_field_name');
            $data['modal_field_phone'] = $this->language->get('modal_field_phone');
            $data['modal_field_email'] = $this->language->get('modal_field_email');
            $data['modal_field_comment'] = $this->language->get('modal_field_comment');
            $data['button_cancel'] = $this->language->get('button_cancel');
            $data['button_send'] = $this->language->get('button_send');
            $data['button_buy'] = $this->language->get('button_buy');
            $data['message_system_error'] = $this->language->get('message_system_error');
            $data['modal_timetable'] = $this->language->get('modal_timetable');

        } else {
            $data['ordercallback_use_module'] = false;
        }

        $data['ordercallback_settings'] = $ordercallback_settings;
        // **************

        //$data['scripts'] = $this->document->getScripts('footer');

        $data['text_information'] = $this->language->get('text_information');
        $data['text_service'] = $this->language->get('text_service');
        $data['text_extra'] = $this->language->get('text_extra');
        $data['text_contact'] = $this->language->get('text_contact');
        $data['text_return'] = $this->language->get('text_return');
        $data['text_sitemap'] = $this->language->get('text_sitemap');
        $data['text_manufacturer'] = $this->language->get('text_manufacturer');
        $data['text_voucher'] = $this->language->get('text_voucher');
        $data['text_affiliate'] = $this->language->get('text_affiliate');
        $data['text_special'] = $this->language->get('text_special');
        $data['text_account'] = $this->language->get('text_account');
        $data['text_order'] = $this->language->get('text_order');
        $data['text_wishlist'] = $this->language->get('text_wishlist');
        $data['text_newsletter'] = $this->language->get('text_newsletter');
        $data['lang'] = $this->language->get('code');


        $data['text_chat'] = $this->language->get('text_chat');
        $data['text_actions'] = $this->language->get('text_actions');
        $data['text_oferta'] = $this->language->get('text_oferta');
        $data['text_return'] = $this->language->get('text_return');
        $data['text_agreement'] = $this->language->get('text_agreement');
        $data['text_search'] = $this->language->get('text_search');
        $data['text_contacts'] = $this->language->get('text_contacts');
        $data['text_callback'] = $this->language->get('text_callback');
        $data['text_addedtobasket'] = $this->language->get('text_addedtobasket');
        $data['text_checkout'] = $this->language->get('text_checkout');
        $data['text_continue'] = $this->language->get('text_continue');

        $data['text_delivery'] = $this->language->get('text_delivery');
        $data['text_articles'] = $this->language->get('text_articles');
        $data['text_pay'] = $this->language->get('text_pay');
        $data['text_warranty'] = $this->language->get('text_warranty');
        $data['text_contacts'] = $this->language->get('text_contacts');
        $data['text_about'] = $this->language->get('text_about');
        $data['text_bonus'] = $this->language->get('text_bonus');
        $data['text_readybasket'] = $this->language->get('text_readybasket');
        $data['text_material'] = $this->language->get('text_material');
        $data['text_help'] = $this->language->get('text_help');
        $data['text_services'] = $this->language->get('text_services');
        $data['text_info'] = $this->language->get('text_info');
        $data['text_time'] = $this->language->get('text_time');
        $data['text_call'] = $this->language->get('text_call');
        $data['telephone'] = $this->config->get('config_telephone');
        $data['text_write'] = $this->language->get('text_write');
        $data['text_addresstitle'] = $this->language->get('text_addresstitle');
        $data['text_address'] = $this->language->get('text_address');
        $data['text_waitforyou'] = $this->language->get('text_waitforyou');
        $data['text_worktime'] = $this->language->get('text_worktime');
        $data['text_addresstime'] = $this->language->get('text_addresstime');
        $data['text_addrmobtitle'] = $this->language->get('text_addrmobtitle');
        $data['text_copyname'] = $this->language->get('text_copyname');

        // модальное окно
        $data['modal_title'] = $this->language->get('modal_title');
        $data['modal_tel'] = $this->language->get('modal_tel');
        $data['modal_name'] = $this->language->get('modal_name');
        $data['modal_info'] = $this->language->get('modal_info');
        $data['modal_time'] = $this->language->get('modal_time');

        $data['widget_callback'] = $this->language->get('widget_callback');
        $data['widget_block_sorry'] = $this->language->get('widget_block_sorry');
        $data['widget_block_timer'] = $this->language->get('widget_block_timer');
        $data['widget_block_phone'] = $this->language->get('widget_block_phone');
        $data['widget_msg'] = $this->language->get('widget_msg');
        $data['widget_error_tel'] = $this->language->get('widget_error_tel');
        $data['widget_button'] = $this->language->get('widget_button');

		$data['button_submit'] = $this->language->get('button_submit');

        $data['search_action'] = $this->url->link('product/json', '' );
        $data['search_action_prn'] = $this->url->link('product/jsonprn', '');
        $data['lang_id']= (int)$this->config->get('config_language_id');
        $data['logged'] = $this->customer->isLogged();
        $data['city_modal'] = $this->load->controller('information/city');

        if (isset($this->request->get['route'])) {
            $data['route'] = (string)$this->request->get['route'];
        } else {
            $data['route'] = 'common/home';
        }

        // ***********************************************
        // для Google ремаркетинга
        $data['products_ids'] = false;
        if(isset($this->session->data['products_ids'])){
            $data['products_ids'] = $this->session->data['products_ids'];
        };
        if(isset($this->session->data['products_cart_total'])){
            $data['products_cart_total'] = $this->session->data['products_cart_total'] ;
        };
        if(isset($this->session->data['products_cart_ids'])){
            $data['products_cart_ids'] = $this->session->data['products_cart_ids'] ;
        };
        if($data['route']=='checkout/success'){
            unset($this->session->data['products_ids']);
            unset($this->session->data['products_cart_total']);
            unset($this->session->data['products_cart_ids']);
        }

        $data['product_id'] = '';
        if($data['route']=='product/product' && isset($this->request->get['product_id'])) {
            $data['product_id'] = $this->request->get['product_id'];
        }

        $get_login = true;
        //$login_html = $this->load->controller('account/login',$get_login);
        //$data['login_html'] = $this->load->controller('account/login/get_login');
        $data['popupcart'] = $this->load->controller('module/popupcart/loda_cart');
        //vdump($data['popupcart']);

        //$data['blackfriday'] ='';

        //if(vdump()){
            //$data['blackfriday'] = $this->load->controller('module/blackfridey');
        //}
        //vdump($data['products_ids']);
        // ***********************************************

        // Captcha
        //if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
            $data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'), $this->error);
        /*} else {
            $data['captcha'] = '';
        }*/

        //vdump($this->config->get('config_captcha'));
        $data['scripts'] = $this->document->getScripts('footer');
        //vdump($data['captcha']);


		return $this->load->view('default/template/common/footer.tpl', $data);
	}
}
