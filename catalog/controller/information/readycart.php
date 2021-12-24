<?php
class ControllerInformationReadycart extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('information/readycart');

		//$this->document->setTitle($this->language->get('heading_title'));
		$this->document->setTitle($this->language->get('meta_tite'));
		$this->document->setDescription($this->language->get('meta_descpription'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/readycart')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text1'] = $this->language->get('text1');
		$data['text2'] = $this->language->get('text2');
		$data['text3'] = $this->language->get('text3');
		$data['text4'] = $this->language->get('text4');
		$data['text_descr'] = $this->language->get('text_descr');
		$data['text_button'] = $this->language->get('text_button');
		$data['text_title1'] = $this->language->get('text_title1');
		$data['text_text1_1'] = $this->language->get('text_text1_1');
		$data['text_title2'] = $this->language->get('text_title2');
		$data['text_text2_1'] = $this->language->get('text_text2_1');
		$data['modal_tel'] = $this->language->get('modal_tel');
		$data['modal_name'] = $this->language->get('modal_name');
		$data['modal_info'] = $this->language->get('modal_info');
		$data['modal_time'] = $this->language->get('modal_time');
		$data['modal_email'] = $this->language->get('modal_email');
		$data['button_submit'] = $this->language->get('button_submit');


		/*$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');*/
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('default/template/information/readycart.tpl', $data));
		
	}

	/*public function success() {
		$this->load->language('information/contact');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/contact')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_message'] = $this->language->get('text_success');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
		}
	}*/
}
