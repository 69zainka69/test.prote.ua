<?php
class ControllerModuleSlideshowprn extends Controller {
    public function index($setting) {
        static $module = 0;

        $this->load->model('design/banner');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        $this->load->language('common/slideshowprn');
        // $this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
        // $this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
      //  $this->document->addStyle('https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css');
        $this->document->addStyle('https://prote.ua/catalog/view/css/owl.carousel.css');
        //$this->document->addScript('https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js');
        
        $this->document->addScript('https://prote.ua/catalog/view/js/owl-carousel/owl.carousel.min.js');


        // Список баннеров
        $data['banners'] = array();
        $results = $this->model_design_banner->getBanner($setting['banner_id']);

        foreach ($results as $result) {
            if (is_file(DIR_IMAGE . $result['image'])) {
                $data['banners'][] = array(
                    'title' => $result['title'],
                    'link'  => $result['link'],
                    'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
                );
            }
        }

        // Список брендов
        $data['brands'] = array();    
        $results = $this->model_catalog_product->getPrinterBrands();

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
        $data['lang'] = (int)$this->config->get('config_language_id');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/slideshowprn.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/slideshowprn.tpl', $data);
        } else {
            return $this->load->view('default/template/module/slideshowprn.tpl', $data);
        }
    }
}
