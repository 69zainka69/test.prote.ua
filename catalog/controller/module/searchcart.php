<?php
class ControllerModuleSearchcart extends Controller {
	public function index() {
		$this->load->language('module/searchcart');

		
    $data['text_search'] = $this->language->get('text_search'); 
		if (isset($this->request->get['search'])) {
			$data['search'] = $this->request->get['search'];
		} else {
			$data['search'] = '';      
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/searchcart.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/searchcart.tpl', $data);
		} else {
			return $this->load->view('default/template/module/searchcart.tpl', $data);
		}
	}
}