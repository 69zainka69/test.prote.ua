<?php
// by gdemon
// 2018.06.26
class ControllerCatalogPuseo extends Controller {
	private $error = array();
	private $puseo_id = 0;
	private $path = array();

	public function index() {
		$this->language->load('catalog/puseo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/puseo');

		$this->getList();
	}

	public function add() {
		$this->language->load('catalog/puseo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/puseo');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_catalog_puseo->addpuseo($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/puseo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('catalog/puseo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/puseo');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_catalog_puseo->editpuseo($this->request->get['puseo_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/puseo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/puseo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/puseo');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $puseo_id) {
				$this->model_catalog_puseo->deletepuseo($puseo_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/puseo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
			$data['filter_name'] = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
			$data['filter_name'] ='';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['token'] = $this->session->data['token'];

		$url = '';
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/puseo', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/puseo/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/puseo/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['repair'] = $this->url->link('catalog/puseo/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $filter_data = array(
            'filter_name'	  => $filter_name,
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

		$puseo_total = $this->model_catalog_puseo->getTotalPuseos();

		$results = $this->model_catalog_puseo->getPuseos($filter_data);

		$this->load->model('catalog/filter');

		$data['puseos'] = array();

		foreach ($results as $result) {
			$data['puseos'][] = array(
				'puseo_id' => $result['puseo_id'],
				'name'        => $result['name'],
				'url'        => $result['brand_id'].' -> '.$result['category_name'],
				'edit'        => $this->url->link('catalog/puseo/edit', 'token=' . $this->session->data['token'] . '&puseo_id=' . $result['puseo_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('catalog/puseo/delete', 'token=' . $this->session->data['token'] . '&puseo_id=' . $result['puseo_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_rebuild'] = $this->language->get('button_rebuild');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/puseo', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('catalog/puseo', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['path'])) {
			$url .= '&path=' . $this->request->get['path'];
		}

		$pagination = new Pagination();
		$pagination->total = $puseo_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/puseo', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($puseo_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($puseo_total - $this->config->get('config_limit_admin'))) ? $puseo_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $puseo_total, ceil($puseo_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/puseo_list.tpl', $data));
	}

	protected function getForm() {
	    //CKEditor
	    if ($this->config->get('config_editor_default')) {
	        $this->document->addScript('view/javascript/ckeditor/ckeditor.js');
	        $this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
	    }

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['puseo_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_h1'] = $this->language->get('entry_meta_h1');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_parent'] = $this->language->get('entry_parent');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_top'] = $this->language->get('entry_top');
		$data['entry_column'] = $this->language->get('entry_column');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_layout'] = $this->language->get('entry_layout');

		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_top'] = $this->language->get('help_top');
		$data['help_column'] = $this->language->get('help_column');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_design'] = $this->language->get('tab_design');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}
		if (isset($this->error['filter'])) {
			$data['error_filter'] = $this->error['filter'];
		} else {
			$data['error_filter'] = '';
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/puseo', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['puseo_id'])) {
			$data['action'] = $this->url->link('catalog/puseo/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/puseo/edit', 'token=' . $this->session->data['token'] . '&puseo_id=' . $this->request->get['puseo_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/puseo', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['puseo_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$puseo_info = $this->model_catalog_puseo->getpuseo($this->request->get['puseo_id']);
		}

        $sSQL="SELECT DISTINCT `text` as brand, ROUND(pc.category_id, -1) AS category_id
            FROM oc_product p 
            LEFT JOIN `oc_product_attribute` pa on pa.product_id=p.product_id AND pa.language_id=1 AND pa.attribute_id=10
            INNER JOIN oc_product_compability p2c ON pa.product_id = p2c.product_id AND connection_type =  '/P'
            LEFT JOIN `oc_product_to_category` pc on pa.product_id=pc.product_id
            WHERE  p.status=1 AND 
            `text` NOT IN (
                'Citizen', 'Develop', 'Fujitsu', 'IBM', 'Lanier', 'Nashuatec', 'Ocp', 'Dell', 'Olivetti', 'Pantum', 'Printronix', 'Rex Rotary', 'Riso', 'Tally', 'Hewlett Packard', 'Oce', 'Star','Utax') 
                AND !(`text`='Panasonic' AND pc.category_id=42) AND !(`text`='Xerox' AND pc.category_id=21)
                GROUP BY text
                order by text, category_id";

        $query = $this->db->query($sSQL);
        $data['brands'] = $query->rows;

        $data['cats'] = array(
            '31' => 'Лазерные картриджи',
            '21' => 'Струйные картриджи',
            '22' => 'Чернила'
        );

		$data['token'] = $this->session->data['token'];
		$data['ckeditor'] = $this->config->get('config_editor_default');

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['lang'] = $this->language->get('lang');

		if (isset($this->request->post['puseo_description'])) {
			$data['puseo_description'] = $this->request->post['puseo_description'];
		} elseif (isset($this->request->get['puseo_id'])) {
			$data['puseo_description'] = $this->model_catalog_puseo->getpuseoDescriptions($this->request->get['puseo_id']);
		} else {
			$data['puseo_description'] = array();
		}

      	$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($puseo_info)) {
			$data['keyword'] = $puseo_info['url'];
		} else {
			$data['keyword'] = '';
		}

		if (isset($this->request->post['brand_id'])) {
			$data['brand_id'] = $this->request->post['brand_id'];
		} elseif (!empty($puseo_info)) {
			$data['brand_id'] = $puseo_info['brand_id'];
		} else {
			$data['brand_id'] = '';
		}

		if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} elseif (!empty($puseo_info)) {
			$data['category_id'] = $puseo_info['category_id'];
		} else {
			$data['category_id'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($puseo_info)) {
			$data['status'] = $puseo_info['status'];
		} else {
			$data['status'] = true;
		}

		$this->load->model('design/layout');


        ////////////////////////////////////////
        ///// gdemon questions ////////////////////////////////

        /*$this->load->model('catalog/question');

        if (isset($this->request->post['questions'])) {
            $data['questions'] = $this->request->post['questions'];
        } elseif (isset($this->request->get['puseo_id'])) {
            $data['questions'] = $this->model_catalog_puseo->getpuseoQuestions($this->request->get['puseo_id']);
        } else {
            $data['questions'] = array();
        }

        $data_question = array(
            'start' => 0,
            'limit' => 99999
        );
        $data['all_question']  = $this->model_catalog_question->getQuestions($data_question);

        foreach ($data['all_question'] as &$question){
            $question['question_description']  = $this->model_catalog_question->getQuestionDescriptions($question['question_id']);

        }*/

        ////////////////////////////////////////////////////

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/puseo_form.tpl', $data));
	}

	protected function validateForm() {

		if (!$this->user->hasPermission('modify', 'catalog/puseo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['puseo_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/puseo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}



  function sortByName($a, $b) {
    return strcmp($a['name'], $b['name']);
  }

}