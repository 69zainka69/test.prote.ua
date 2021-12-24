<?php  
class ControllerModuleArticles extends Controller {
    
    function selstrlen($strlist, $strlen) {         
        // Выбираем самый длинный элемент из списка
        foreach ($strlist as $strItem) {                                 
            if (mb_strlen($strItem)<$strlen) break;                
        }        
        return $strItem;            
    }
    
	public function index() { 
		$this->language->load('module/articles');
		$this->load->model('extension/articles');

		$filter_data = array(
			'page' => 1,
			'limit' => 5,
			'start' => 0,
		); 

		$data['heading_title'] = $this->language->get('heading_title');

		$all_articles = $this->model_extension_articles->getAllArticles($filter_data);

		$data['all_articles'] = array();
		foreach ($all_articles as $articles) {
			$data['all_articles'][] = array (
				'title' 		=> html_entity_decode($articles['title'], ENT_QUOTES),
				'description' 	=> (strlen(strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES))) > 50 ? mb_substr(strip_tags(html_entity_decode($news['short_description'], ENT_QUOTES)), 0, 50) . '...' : strip_tags(html_entity_decode($articles['short_description'], ENT_QUOTES))),
				'view' 			=> $this->url->link('information/articles/articles', 'articles_id=' . $articles['articles_id']),
        'image'     => $articles['image'],
				'date_added' 	=> date($this->language->get('date_format_short'), strtotime($articles['date_added']))
			);
		}

		if (version_compare(VERSION, '2.2.0.0', '<')) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/articles.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/articles.tpl', $data);
			} else {
				return $this->load->view('default/template/module/articles.tpl', $data);
			}
		} else {
			return $this->load->view('module/articles', $data);
		}
	}
}