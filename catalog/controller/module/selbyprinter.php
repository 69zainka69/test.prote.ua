<?php
class ControllerModuleSelbyprinter extends Controller {
	public function index($setting) {
		static $module = 0;
    
    // print_r($this->Document);
    // Определяем категорию
    $categoryId = false;
    if (isset($this->request->get['category_id'])) {
        $categoryId = $this->request->get['category_id'];
    } elseif(isset($this->request->get['path'])) {
     	$parts = explode('_', (string)$this->request->get['path']);
  		$categoryId = array_pop($parts);
		}
    
    // Показываем только для расходных по печати
    if (!in_array($categoryId, array(21,22,23,24,25,31,32,33,34,35,37,37, 41,42)))  return;

    $this->load->model('catalog/product');
    //$this->load->model('tool/image');
    $this->load->language('common/selbyprinter');

    // Список брендов
    $data['brands'] = array();    
    $results = $this->model_catalog_product->getPrinterBrands($categoryId);

		foreach ($results as $result) {		
			$data['brands'][] = array(
				'brand' => $result['brand'],				
			);			
		}
    
		$data['module'] = $module++;

    $data['text_searchcat'] = $this->language->get('text_searchcat');
    $data['text_selbrand'] = $this->language->get('text_selbrand');
    $data['text_selmodel'] = $this->language->get('text_selmodel');
    $data['text_select'] = $this->language->get('text_select');
    $data['categoryId'] = $categoryId;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/selbyprinter.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/selbyprinter.tpl', $data);
		} else {
			return $this->load->view('default/template/module/selbyprinter.tpl', $data);
		}
	}
}
