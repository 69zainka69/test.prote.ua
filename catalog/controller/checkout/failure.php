<?php
class ControllerCheckoutFailure extends Controller {
	public function index() {
		$this->load->language('checkout/failure');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_basket'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_checkout'),
			'href' => $this->url->link('checkout/checkout', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_failure'),
			'href' => $this->url->link('checkout/failure')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_message'] = sprintf($this->language->get('text_message'), $this->url->link('information/contact'));

		$this->load->language('information/html/about_us');
    	$data['text_sub_title1'] = $this->language->get('text_sub_title1');
    	$langurl=($this->language->get('code')=='uk'?'/ua':'');
        $data['text_sub_text1'] = sprintf($this->language->get('text_sub_text1'),$langurl,$langurl);
    	$data['text_sub_title2'] = $this->language->get('text_sub_title2');
    	$data['text_sub_text2'] = $this->language->get('text_sub_text2');
    	$data['text_sub_title3'] = $this->language->get('text_sub_title3');
    	$data['text_sub_text3'] = $this->language->get('text_sub_text3');

		/*$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');*/
		$data['column_left'] ='';
		$data['column_right'] ='';
		$data['content_top'] ='';
		$data['content_bottom'] ='';
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
		}
	}
}