<?php
class ControllerModuleManufacturer extends Controller {
	public function index($setting) {
		$this->load->language('module/manufacturer');

		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('catalog/manufacturer');

		$this->load->model('tool/image');

		$data['products'] = array();

		//$module_info = $this->model_setting_setting->getSetting('manufacturer');
		$filter_data = array(
			'limit'		=> $setting['limit'],
			'sort'		=> 'm.sort_order'
		);

		$manufacturers = $this->model_catalog_manufacturer->getManufacturers($filter_data);
		$data['manufacturers'] = array();
		if ($manufacturers) {
			foreach ($manufacturers as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				$data['manufacturers'][] = array(
					//'manufacturer_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'href'        => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
				);
			}
			//vdump($data['manufacturers']);
			
			return $this->load->view('default/template/module/manufacturer.tpl', $data);
		}
	}
}
