<?php
class ControllerCommonSearch extends Controller {
    public function index() {
        $this->load->language('common/search');

        $data['text_search'] = $this->language->get('text_search');
        $data['print_search'] = $this->language->get('print_search');
        $data['cart_search']  = $this->language->get('cart_search');
        $data['button_cart']  = $this->language->get('button_cart');;

        if (isset($this->request->get['search'])) {
            $data['search'] = $this->request->get['search'];
        } else {
            $data['search'] = '';
        }
    
        if (isset($this->request->get['searchprn'])) {
            $data['searchprn'] = $this->request->get['searchprn'];
        } else {
            $data['searchprn'] = '';
        }
    
        /* Search autocomplete */
        //$data['search_action'] = $this->url->link('product/json', '' );
        //$data['search_action_prn'] = $this->url->link('product/jsonprn', '');
        $data['button_cart'] = $this->language->get('button_cart');
        //$data['lang']= (int)$this->config->get('config_language_id');
        /* end search autocomplete */

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/search.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/common/search.tpl', $data);
        } else {
            return $this->load->view('default/template/common/search.tpl', $data);
        }
    }
}