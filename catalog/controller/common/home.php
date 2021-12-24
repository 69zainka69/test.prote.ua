<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title')[$this->config->get('config_language_id')]['title']);
		$this->document->setDescription($this->config->get('config_meta_description')[$this->config->get('config_language_id')]['title']);
		$this->document->setKeywords($this->config->get('config_meta_keyword')[$this->config->get('config_language_id')]['title']);

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTPS_SERVER, 'canonical');
		}
		//vdump($this->request->get);

		$this->load->language('common/home');

		// Статьи
		$this->load->model('extension/articles');
		$this->load->model('tool/image');

		$data['text_articles'] = $this->language->get('text_articles');
		$data['text_allarticles'] = $this->language->get('text_allarticles');
		$data['text_allbrands'] = $this->language->get('text_allbrands');
		$data['text_seo1'] = $this->language->get('text_seo1');
		$data['text_seo2'] = $this->language->get('text_seo2');
		$data['text_seo3'] = $this->language->get('text_seo3');
		$data['text_seo3_title'] = $this->language->get('text_seo3_title');
		$data['text_sl1'] = $this->language->get('text_sl1');
		$data['text_sl2'] = $this->language->get('text_sl2');
		$data['text_sl3'] = $this->language->get('text_sl3');
		$data['text_sl4'] = $this->language->get('text_sl4');
		$data['text_sl5'] = $this->language->get('text_sl5');
		
		$data['text_sol_title'] = $this->language->get('text_sol_title');
		$data['text_sol_title_seo'] = $this->language->get('text_sol_title_seo');
		$data['text_sol_descr'] = $this->language->get('text_sol_descr');
		$data['text_sol_href1'] = $this->language->get('text_sol_href1');
		$data['text_sol_href2'] = $this->language->get('text_sol_href2');
		$data['text_sol_1'] = $this->language->get('text_sol_1');
		$data['text_sol_2'] = $this->language->get('text_sol_2');
		$data['text_sol_3'] = $this->language->get('text_sol_3');
		$data['text_sol_4'] = $this->language->get('text_sol_4');
		$data['text_sol_5'] = $this->language->get('text_sol_5');
		$data['text_sol_6'] = $this->language->get('text_sol_6');

		$data['text_action'] = $this->language->get('text_action');
		$data['text_readybasket'] = $this->language->get('text_readybasket');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_selection'] = $this->language->get('text_selection');
		$data['text_readysolutions'] = $this->language->get('text_readysolutions');
		$data['text_orderbycount'] = $this->language->get('text_orderbycount');
		
        $filter_data = array(
            'start'=>0,
            'limit'=>5,
        );

        
        $all_articles = $this->model_extension_articles->getAllArticles($filter_data);
		
        $data['all_articles'] = array();
        foreach ($all_articles as $articles) {
            $data['all_articles'][] = array (
                'title' 		=> html_entity_decode($articles['title'], ENT_QUOTES),
                'description' 	=> (strlen(strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES))) > 100 ? mb_substr(strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES)), 0, 100) . '...' : strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES))),
                'href' 			=> $this->url->link('information/articles/articles', 'articles_id=' . $articles['articles_id']),
                'image'     =>   $this->model_tool_image->resize($articles['image'],220,220),
                'date_added' 	=> date($this->language->get('date_format_short'), strtotime($articles['date_added']))
                );
        }

        $data['langurl']=($this->language->get('code')=='uk'?'/ua':'');

		// вытаскиваем сеошные тексты
		$modules = array(
			array('code' => 'bestsellercat.34'),
			array('code' => 'bestsellercat.35')//,
			//array('code' => 'advantages.59')
		);
		$this->load->model('extension/module');
        foreach ($modules as $module) {
			$part = explode('.', $module['code']);

			if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
				$data['modules'][] = $this->load->controller('module/' . $part[0]);
			}

			if (isset($part[1])) {
				$setting_info = $this->model_extension_module->getModule($part[1]);
				if ($setting_info && $setting_info['status']) {
					$data['mod'][$module['code']] = $this->load->controller('module/' . $part[0], $setting_info);
				}
			}
		}


		$data['column_right'] = $this->load->controller('common/column_right');
		$data['printerbrands'] = $this->load->controller('module/printerbrands');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['content_reviews'] = $this->load->controller('information/shop_rating', true);
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
	}

	public function clearMemCache() { 		 		 		 		

			if(!isset($this->session->data['token'])) $this->session->data['token'] = '';

		$this->session->data['clear_memcache'] = true;

		$this->cache->flush();

		//$this->redirect(HTTPS_SERVER . 'index.php?route=common/home&#038;token=' . $this->session->data['token']);
	}
}