<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ControllerModulePrinterbrands extends Controller {
    public function index($setting) {
        static $module = 0;

        if (isset($this->request->get['route'])) {
            $data['route']=$this->request->get['route'];
        } else {
            $data['route'] = 'common/home';
        }

        $this->load->model('extension/articles');
        
        $this->load->language('common/printerbrands');

        $lang=$this->language->get('code');
        // Список брендов
        $data['brands']=$this->cache->get('home_brands_' . $lang . $_SERVER['HTTPS']);
        if (!$data['brands']) {
            $this->load->model('catalog/product');
            $this->load->model('tool/image');
            $data['brands'] = array();
            $results = $this->model_catalog_product->getPrinterBrandsCats();

            foreach ($results as $key=>$val) {
                $tmpcats=array();
                foreach ($val as $cat=>$catval) {
                    $tmpcats[$cat] = array(
                        'name' => $catval,
                        'img'  => $this->model_tool_image->resize('/image/brands/' . str_replace(' ','-', strtolower($key)) . '.png',120,120),
                        'url'  => $this->url->link('product/brand', 'brand_id='.str_replace(' ','-', strtolower($key)).'&tech_id='.$cat )
                    );
                }
                $data['brands'][] = array(
                    'brand' => $key,
                    'cats'  => $tmpcats

                );
            }
            $this->cache->set('home_brands_' . $lang . $_SERVER['HTTPS'], $data['brands']);
        }

        $data['module'] = $module++;

        $data['text_searchcat'] = $this->language->get('text_searchcat');
        $data['text_selbrand'] = $this->language->get('text_selbrand');        
        $data['text_selmodel'] = $this->language->get('text_selmodel');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_articles'] = $this->language->get('text_articles');
        $data['text_readmore'] = $this->language->get('text_readmore');
        $data['text_readall']  = $this->language->get('text_readall');
        $data['text_cassapparat']  = $this->language->get('text_cassapparat');
        $data['text_casscons']  = $this->language->get('text_casscons');

        



        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/printerbrands.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/printerbrands.tpl', $data);
        } else {
            return $this->load->view('default/template/module/printerbrands.tpl', $data);
        }
    }
}


