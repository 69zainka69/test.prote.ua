<?php
// by gdemon
// 2018.06.26
class ControllerCatalogFilterseo extends Controller {
	private $error = array();
	private $filterseo_id = 0;
	private $path = array();

	public function index() {
		$this->language->load('catalog/filterseo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/filterseo');

		$this->getList();
	}

	public function add() {
		$this->language->load('catalog/filterseo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/filterseo');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_catalog_filterseo->addFilterseo($this->request->post);

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

			$this->response->redirect($this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('catalog/filterseo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/filterseo');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_catalog_filterseo->editFilterseo($this->request->get['filterseo_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/filterseo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/filterseo');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $filterseo_id) {
				$this->model_catalog_filterseo->deleteFilterseo($filterseo_id);
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

			$this->response->redirect($this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/filterseo/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/filterseo/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['repair'] = $this->url->link('catalog/filterseo/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['filteries'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$filterseo_total = $this->model_catalog_filterseo->getTotalFilteries();

		$results = $this->model_catalog_filterseo->getFilteries($filter_data);
		
		$this->load->model('catalog/filter');

		foreach ($results as $result) {

			$res = $this->db->query("SELECT filter_id FROM `oc_filterseo_to_filter` WHERE `filterseo_id`=".(int)$result['filterseo_id']);

			$filters = array();
			foreach ($res->rows as $key => $value) {
				$filters[]= $value['filter_id'];
			}

			$filterseo_filters = array();

			foreach ($filters as $filter_id) {

				$filter_info = $this->model_catalog_filter->getFilter($filter_id);

				if ($filter_info) {
					$filterseo_filters[] = array(
						'filter_id' => $filter_info['filter_id'],
						'name'      => $filter_info['group'] . ' ['.$filter_info['filter_group_id'].'] &gt; ' . $filter_info['name'].' ['.$filter_info['filter_id'].']'
					);
				}
			}

			$data['filteries'][] = array(
				'filterseo_id' => $result['filterseo_id'],
				'category_name'        => $result['category_name'],
				'filter_group_name'        => $result['filter_group_name'],
				'filter_seo_name'        => $result['filter_seo_name'],
				'url'        => $result['url'],
				'filterseo_filters'        => $filterseo_filters,
				'edit'        => $this->url->link('catalog/filterseo/edit', 'token=' . $this->session->data['token'] . '&filterseo_id=' . $result['filterseo_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('catalog/filterseo/delete', 'token=' . $this->session->data['token'] . '&filterseo_id=' . $result['filterseo_id'] . $url, 'SSL')
			);
		}
		/*echo "<pre>";
		print_r($data['filteries']
		);
		echo "</pre>";*/

		/*if (isset($this->request->get['path'])) {
			if ($this->request->get['path'] != '') {
				$this->path = explode('_', $this->request->get['path']);
				$this->filterseo_id = end($this->path);
				$this->session->data['path'] = $this->request->get['path'];
			} else {
				unset($this->session->data['path']);
			}
		} elseif (isset($this->session->data['path'])) {
			$this->path = explode('_', $this->session->data['path']);
			$this->filterseo_id = end($this->path);
		}*/

		//$filterseo_total = count($results);

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

		$data['sort_name'] = $this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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
		$pagination->total = $filterseo_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($filterseo_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($filterseo_total - $this->config->get('config_limit_admin'))) ? $filterseo_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $filterseo_total, ceil($filterseo_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/filterseo_list.tpl', $data));
	}

	protected function getForm() {
	    //CKEditor
	    if ($this->config->get('config_editor_default')) {
	        $this->document->addScript('view/javascript/ckeditor/ckeditor.js');
	        $this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
	    }

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['filterseo_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
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
			'href' => $this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['filterseo_id'])) {
			$data['action'] = $this->url->link('catalog/filterseo/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/filterseo/edit', 'token=' . $this->session->data['token'] . '&filterseo_id=' . $this->request->get['filterseo_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['filterseo_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$filterseo_info = $this->model_catalog_filterseo->getFilterseo($this->request->get['filterseo_id']);
		}

		$data['token'] = $this->session->data['token'];
		$data['ckeditor'] = $this->config->get('config_editor_default');

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['lang'] = $this->language->get('lang');

		

		if (isset($this->request->post['filterseo_description'])) {
			$data['filterseo_description'] = $this->request->post['filterseo_description'];
		} elseif (isset($this->request->get['filterseo_id'])) {
			$data['filterseo_description'] = $this->model_catalog_filterseo->getFilterseoDescriptions($this->request->get['filterseo_id']);
		} else {
			$data['filterseo_description'] = array();
		}

		if (isset($this->request->post['filter_id'])) {
			$data['filter_id'] = $this->request->post['filter_id'];
		} elseif (!empty($filterseo_info)) {
			//$data['filter_id'] = $filterseo_info['filter_id'];
			$query = $this->db->query("SELECT filter_id FROM `oc_filterseo_to_filter` WHERE `filterseo_id`=".(int)$this->request->get['filterseo_id']);
			$data['filter_id'] = array();
			foreach ($query->rows as $key => $value) {
				$data['filter_id'][] = 	$value['filter_id'];
			}

		} else {
			$data['filter_id'] = array();
		}

		$this->load->model('catalog/filter');

		if (isset($this->request->post['filterseo_filters'])) {
			$filters= $this->request->post['filterseo_filters'];
		} elseif (isset($this->request->get['filterseo_id'])) {
			$results = $this->db->query("SELECT filter_id FROM `oc_filterseo_to_filter` WHERE `filterseo_id`=".(int)$this->request->get['filterseo_id']);
			$filters = array();
			foreach ($results->rows as $key => $value) {
				$filters[]= $value['filter_id'];
			}
		} else {
			$filters = array();
		}

		$data['filterseo_filters'] = array();



		foreach ($filters as $filter_id) {

			$filter_info = $this->model_catalog_filter->getFilter($filter_id);

			if ($filter_info) {
				$data['filterseo_filters'][] = array(
					'filter_id' => $filter_info['filter_id'],
					'name'      => $filter_info['group'] . ' ['.$filter_info['filter_group_id'].'] &gt; ' . $filter_info['name'].' ['.$filter_info['filter_id'].']'
				);
			}
		}

		if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} elseif (!empty($filterseo_info)) {
			$data['category_id'] = $filterseo_info['category_id'];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($this->request->post['filter_group_id'])) {
			$data['filter_group_id'] = $this->request->post['filter_group_id'];
			$data['filters'] = $this->getFilters($data['filter_group_id'],$data['filter_id']);

		} elseif (!empty($filterseo_info)) {
			$data['filter_group_id'] = $filterseo_info['filter_group_id'];
			$data['filters'] = $this->getFilters($data['filter_group_id'],$data['filter_id']);
		} else {
			$data['filter_group_id'] = 0;
			$data['filters'] ='';  
		}


		// Категории
        $data['categories'] = $this->getCategories();

        // Группы фильтров
        $data['filter_groups'] = $this->getFilterGroupList();
        
		// Фильтры
        //$data['filters'] = $this->getFilters();        

		$this->load->model('catalog/filter');

		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($filterseo_info)) {
			$data['keyword'] = $filterseo_info['url'];
		} else {
			$data['keyword'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($filterseo_info)) {
			$data['status'] = $filterseo_info['status'];
		} else {
			$data['status'] = true;
		}

		$this->load->model('design/layout');


        ////////////////////////////////////////
        ///// gdemon questions ////////////////////////////////

        $this->load->model('catalog/question');

        if (isset($this->request->post['questions'])) {
            $data['questions'] = $this->request->post['questions'];
        } elseif (isset($this->request->get['filterseo_id'])) {
            $data['questions'] = $this->model_catalog_filterseo->getFilterseoQuestions($this->request->get['filterseo_id']);
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

        }

        ////////////////////////////////////////////////////

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/filterseo_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/filterseo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['filterseo_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if(!isset($this->request->post['filterseo_filters'])){
			$this->error['filter'] = 'Выберите значение фильтра';
		}
		
		/*if (isset($this->request->post['filter_id']) && !empty($this->request->post['filter_id'])) {
		} else {
			$this->error['filter'] = 'Выберите группу и значение фильтра';
			
		}*/
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/filterseo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	private function getFilteries($parent_id, $parent_path = '', $indent = '') {
		$filterseo_id = array_shift($this->path);

		$output = array();

		static $href_filterseo = null;
		static $href_action = null;

		if ($href_filterseo === null) {
			$href_filterseo = $this->url->link('catalog/filterseo', 'token=' . $this->session->data['token'] . '&path=', 'SSL');
			$href_action = $this->url->link('catalog/filterseo/update', 'token=' . $this->session->data['token'] . '&filterseo_id=', 'SSL');
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

		$results = $this->model_catalog_filterseo->getCategoriesByParentId($parent_id);

		foreach ($results as $result) {
			$path = $parent_path . $result['filterseo_id'];

			$href = ($result['children']) ? $href_filterseo . $path : '';

			$name = $result['name'];

			if ($filterseo_id == $result['filterseo_id']) {
				$name = '<b>' . $name . '</b>';

				$data['breadcrumbs'][] = array(
					'text'      => $result['name'],
					'href'      => $href,
					'separator' => ' :: '
				);

				$href = '';
			}

			$selected = isset($this->request->post['selected']) && in_array($result['filterseo_id'], $this->request->post['selected']);

			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $href_action . $result['filterseo_id']
			);

			$output[$result['filterseo_id']] = array(
				'filterseo_id' => $result['filterseo_id'],
				'name'        => $name,
				'sort_order'  => $result['sort_order'],
				'selected'    => $selected,
				'action'      => $action,
				'edit'        => $this->url->link('catalog/filterseo/edit', 'token=' . $this->session->data['token'] . '&filterseo_id=' . $result['filterseo_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('catalog/filterseo/delete', 'token=' . $this->session->data['token'] . '&filterseo_id=' . $result['filterseo_id'] . $url, 'SSL'),
				'href'        => $href,
				'indent'      => $indent
			);

			if ($filterseo_id == $result['filterseo_id']) {
				$output += $this->getCategories($result['filterseo_id'], $path . '_', $indent . str_repeat('&nbsp;', 8));
			}
		}

		return $output;
	}

	private function getAllCategories($categories, $parent_id = 0, $parent_name = '') {
		$output = array();

		if (array_key_exists($parent_id, $categories)) {
			if ($parent_name != '') {
				//$parent_name .= $this->language->get('text_separator');
				$parent_name .= ' &gt; ';
			}

			foreach ($categories[$parent_id] as $filterseo) {
				$output[$filterseo['filterseo_id']] = array(
					'filterseo_id' => $filterseo['filterseo_id'],
					'name'        => $parent_name . $filterseo['name']
				);

				$output += $this->getAllCategories($categories, $filterseo['filterseo_id'], $parent_name . $filterseo['name']);
			}
		}

    uasort($output, array($this, 'sortByName'));
    
		return $output;
	}

  function sortByName($a, $b) {
    return strcmp($a['name'], $b['name']);
  }

	public function getCategories() {
        $query = $this->db->query("SELECT `category_id`, `name` FROM `oc_category_description` WHERE `language_id`='" . 1 . "' ORDER BY `name`");
        return $query->rows;
	}
	public function getFilterGroupList() {
        $query = $this->db->query("SELECT `filter_group_id`, `name` FROM `oc_filter_group_description` WHERE `language_id`='" . 1 . "' ORDER BY `name`");
        return $query->rows;
	}
	public function getFilters($filter_group_id=false,$filters_id=array()) {

		$js = false;
		if (isset($this->request->get['filter_group_id'])) {
			$filter_group_id = $this->request->get['filter_group_id'];
			$js=true;
		} 
		if($filter_group_id){
			$json=array();

			$query = $this->db->query("SELECT f.filter_id, fd.name FROM `oc_filter` f LEFT JOIN `oc_filter_description` fd ON (f.filter_id = fd.filter_id) WHERE fd.filter_group_id=".(int)$filter_group_id." AND `language_id`='" . 1 . "' ORDER BY `name`");

			$output = '';
			foreach ($query->rows as $result) {
	            $output .= '<tr>';
	              $output .= '<td class="checkbox">';
	                $output .= '<label><input type="checkbox" name="filter_id[]" value="'. $result['filter_id'] .'" data-name="'.$result['name'] .' - ['.$result['filter_id'].']"';
						
						if(in_array($result['filter_id'], $filters_id)){
							$output .= 'checked ';	
						}

	                $output .= '>&nbsp; '. $result['name'] .' - '.$result['filter_id'].'</label>';
	              $output .= '</td>';
	            $output .= '</tr>';
	        } 

			$json['options']=$output;

			//$this->response->addHeader('Content-Type: application/json');
			//$this->response->setOutput(json_encode($json));
			if($js) {
				$this->response->setOutput($output);
			} else {
				return $output;
			}
		} /*else {
			$query = $this->db->query("SELECT `filter_id`, `name` FROM `oc_filter_description` WHERE `language_id`='" . 1 . "' ORDER BY `name`");
        	return $query->rows;
		}*/
        
	}
}