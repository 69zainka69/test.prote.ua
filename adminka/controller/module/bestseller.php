<?php
class ControllerModuleBestSeller extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/bestseller');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('bestseller', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			$this->cache->delete('product');

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_prodone'] = $this->language->get('entry_prodone');
		$data['entry_prodotwo'] = $this->language->get('entry_prodotwo');
		$data['entry_prodthree'] = $this->language->get('entry_prodthree');
		$data['entry_prodfour'] = $this->language->get('entry_prodfour');
		$data['entry_prodfive'] = $this->language->get('entry_prodfive');
		$data['entry_prodsix'] = $this->language->get('entry_prodsix');
		$data['entry_status'] = $this->language->get('entry_status');


		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['prodone'])) {
			$data['error_prodone'] = $this->error['prodone'];
		} else {
			$data['error_prodone'] = '';
		}
		if (isset($this->error['prodotwo'])) {
			$data['error_prodotwo'] = $this->error['prodotwo'];
		} else {
			$data['error_prodotwo'] = '';
		}
		if (isset($this->error['prodthree'])) {
			$data['error_prodthree'] = $this->error['prodthree'];
		} else {
			$data['error_prodthree'] = '';
		}


		if (isset($this->error['prodfour'])) {
			$data['error_prodfour'] = $this->error['prodfour'];
		} else {
			$data['error_prodfour'] = '';
		}
		if (isset($this->error['prodfive'])) {
			$data['error_prodfive'] = $this->error['prodfive'];
		} else {
			$data['error_prodfive'] = '';
		}
		if (isset($this->error['prodsix'])) {
			$data['error_prodsix'] = $this->error['prodsix'];
		} else {
			$data['error_prodsix'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}

		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/bestseller', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/bestseller', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/bestseller', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/bestseller', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = 5;
		}

		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = 200;
		}

		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = 200;
		}




		//Свой топ за прошлую неделю
		//******************************************************
		//****************************************************** */
		if (isset($this->request->post['prodone'])) {
			$data['prodone'] = $this->request->post['prodone'];
		} elseif (!empty($module_info)) {
			$data['prodone'] = $module_info['prodone'];
		//	$prodone = $module_info['prodone'];
		} else {
			$data['prodone'] = 0;
		}
		if (isset($this->request->post['prodotwo'])) {
			$data['prodotwo'] = $this->request->post['prodotwo'];
		} elseif (!empty($module_info)) {
			$data['prodotwo'] = $module_info['prodotwo'];
		//	$prodotwo = $module_info['prodotwo'];
		} else {
			$data['prodotwo'] = 0;
		}
		if (isset($this->request->post['prodthree'])) {
			$data['prodthree'] = $this->request->post['prodthree'];
		} elseif (!empty($module_info)) {
			$data['prodthree'] = $module_info['prodthree'];
		//	$prodthree = $module_info['prodthree'];
		} else {
			$data['prodthree'] = 0;
		}if (isset($this->request->post['prodfour'])) {
			$data['prodfour'] = $this->request->post['prodfour'];
		} elseif (!empty($module_info)) {
			$data['prodfour'] = $module_info['prodfour'];
		//	$prodfour = $module_info['prodfour'];
		} else {
			$data['prodfour'] = 0;
		}if (isset($this->request->post['prodfive'])) {
			$data['prodfive'] = $this->request->post['prodfive'];
		} elseif (!empty($module_info)) {
			$data['prodfive'] = $module_info['prodfive'];
		//	$prodfive = $module_info['prodfive'];
		} else {
			$data['prodfive'] = 0;
		}if (isset($this->request->post['prodsix'])) {
			$data['prodsix'] = $this->request->post['prodsix'];
		} elseif (!empty($module_info)) {
			$data['prodsix'] = $module_info['prodsix'];
		//	$prodsix = $module_info['prodsix'];
		} else {
			$data['prodsix'] = 0;
		}

		//Свой топ за прошлую неделю
		//******************************************************
		//****************************************************** */


		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');





		







		$this->response->setOutput($this->load->view('module/bestseller.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/bestseller')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}
		if (!$this->request->post['prodone']) {
			$this->error['prodone'] = $this->language->get('error_prodone');
		}
		if (!$this->request->post['prodotwo']) {
			$this->error['prodotwo'] = $this->language->get('error_prodotwo');
		}
		if (!$this->request->post['prodthree']) {
			$this->error['prodthree'] = $this->language->get('error_prodthree');
		}
		if (!$this->request->post['prodfour']) {
			$this->error['prodfour'] = $this->language->get('error_prodfour');
		}
		if (!$this->request->post['prodfive']) {
			$this->error['prodfive'] = $this->language->get('error_prodfive');
		}
		if (!$this->request->post['prodsix']) {
			$this->error['prodsix'] = $this->language->get('error_prodsix');
		}
		if (!$this->request->post['height']) {
			$this->error['height'] = $this->language->get('error_height');
		}

		$prodone = $this->request->post['prodone'];
		$prodotwo = $this->request->post['prodotwo'];
		$prodthree = $this->request->post['prodthree'];
		$prodfour = $this->request->post['prodfour'];
		$prodfive = $this->request->post['prodfive'];
		$prodsix = $this->request->post['prodsix'];
		$this->db->query("TRUNCATE `prote.ua`.`bestaellerproductsour`");


		$query = $this->db->query("SELECT * FROM `oc_product` WHERE `model` LIKE '$prodone' ORDER BY `date_modified` DESC");
		foreach ($query->rows as $result) {
			$prodone = $result['product_id'];
		}
		$this->db->query("INSERT INTO `bestaellerproductsour` (`id`, `product_id`) VALUES (NULL, '$prodone');");
		$query = $this->db->query("SELECT * FROM `oc_product` WHERE `model` LIKE '$prodotwo' ORDER BY `date_modified` DESC");
		foreach ($query->rows as $result) {
			$prodotwo = $result['product_id'];
		}
		$this->db->query("INSERT INTO `bestaellerproductsour` (`id`, `product_id`) VALUES (NULL, '$prodotwo');");
		$query = $this->db->query("SELECT * FROM `oc_product` WHERE `model` LIKE '$prodthree' ORDER BY `date_modified` DESC");
		foreach ($query->rows as $result) {
			$prodthree = $result['product_id'];
		}
		$this->db->query("INSERT INTO `bestaellerproductsour` (`id`, `product_id`) VALUES (NULL, '$prodthree');");
		$query = $this->db->query("SELECT * FROM `oc_product` WHERE `model` LIKE '$prodfour' ORDER BY `date_modified` DESC");
		foreach ($query->rows as $result) {
			$prodfour = $result['product_id'];
		}
		$this->db->query("INSERT INTO `bestaellerproductsour` (`id`, `product_id`) VALUES (NULL, '$prodfour');");
		$query = $this->db->query("SELECT * FROM `oc_product` WHERE `model` LIKE '$prodfive' ORDER BY `date_modified` DESC");
		foreach ($query->rows as $result) {
			$prodfive = $result['product_id'];
		}
		$this->db->query("INSERT INTO `bestaellerproductsour` (`id`, `product_id`) VALUES (NULL, '$prodfive');");
		$query = $this->db->query("SELECT * FROM `oc_product` WHERE `model` LIKE '$prodsix' ORDER BY `date_modified` DESC");
		foreach ($query->rows as $result) {
			$prodsix = $result['product_id'];
		}
		$this->db->query("INSERT INTO `bestaellerproductsour` (`id`, `product_id`) VALUES (NULL, '$prodsix');");
		$this->cache->del('products.bestseller.');












		return !$this->error;
	}
}
