<?php
class ControllerModuleMyModul extends Controller {
	protected function index() {

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mymodul.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/mymodul.tpl';
		} else {
			$this->template = 'default/template/module/mymodul.tpl';
		}		
		$this->render();
	}
}
?>
