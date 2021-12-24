<?php
class ControllerAccountSuccess extends Controller {
	public function index() {
		$this->load->language('account/success');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_success'),
			'href' => $this->url->link('account/success')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('account/customer_group');

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->config->get('config_customer_group_id'));

		/*if ($customer_group_info && !$customer_group_info['approval']) {
			$data['text_message'] = sprintf($this->language->get('text_message'), $this->url->link('information/contact'));
		} else {
			$data['text_message'] = sprintf($this->language->get('text_approval'), $this->config->get('config_name'), $this->url->link('information/contact'));
		}*/
		$data['text_message'] = sprintf($this->language->get('text_message'), $this->url->link('information/contact'));

		$data['button_continue'] = $this->language->get('button_continue');

		//if ($this->cart->hasProducts()) {
			$data['cart'] = $this->url->link('checkout/cart');
		//} else {
			$data['account'] = $this->url->link('account/account', '', 'SSL');
		//}
 		
 		$data['text_go_account'] = $this->language->get('text_go_account');
 		$data['text_go_cart'] = $this->language->get('text_go_cart');

	    $this->load->language('information/html/about_us');
        $data['text_sub_title1'] = $this->language->get('text_sub_title1');
        
        $langurl=($this->language->get('code')=='uk'?'/ua':'');
        $data['text_sub_text1'] = sprintf($this->language->get('text_sub_text1'),$langurl,$langurl);

        $data['text_sub_title2'] = $this->language->get('text_sub_title2');
        $data['text_sub_text2'] = $this->language->get('text_sub_text2');

        $data['text_sub_title3'] = $this->language->get('text_sub_title3');
        $data['text_sub_text3'] = $this->language->get('text_sub_text3');


		//$data['column_left'] = $this->load->controller('common/column_left');
		//$data['column_right'] = $this->load->controller('common/column_right');
		//$data['content_top'] = $this->load->controller('common/content_top');
		//$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('default/template/account/success.tpl', $data));
	}
}