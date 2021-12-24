<?php
class ControllerModuleBestSellerCat extends Controller {
	public function index($setting) {
		static $module1 = 0;
		$this->load->language('module/bestsellercat');

		$data['heading_title'] = $setting['name'];

		//$data['text_tax'] = $this->language->get('text_tax');

		//$data['button_cart'] = $this->language->get('button_cart');
		//$data['button_wishlist'] = $this->language->get('button_wishlist');
		//$data['button_compare'] = $this->language->get('button_compare');
    	//$data['category'] = $setting['category'];
    
		//$this->load->model('catalog/product');

		//$this->load->model('tool/image');

		$data['products'] = array();

	    $data['title'] = $setting['description'][$this->config->get('config_language_id')]['title'];
	    //$data['subtitle'] = $setting['description'][$this->config->get('config_language_id')]['subtitle'];
	    $data['description'] = html_entity_decode($setting['description'][$this->config->get('config_language_id')]['description']);

		$data['module1'] = $module1++;

		return $this->load->view('default/template/module/bestsellercat.tpl', $data);
	}
}
