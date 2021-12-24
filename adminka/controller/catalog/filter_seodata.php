<?php
class ControllerCatalogFilterSeoData extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('catalog/filter_seodata');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/filter_seodata');

		$this->getList();
	}

	public function add() {
            $this->language->load('catalog/filter_seodata');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('catalog/filter_seodata');

            if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
                // print_r($this->request->post); // die();
                $this->model_catalog_filter_seodata->addFilterSeoDataItem($this->request->post);

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
                if (isset($this->request->get['filter_category'])) {
                    $url .= '&filter_category=' . $this->request->get['filter_category'];
                }

                $this->response->redirect($this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . $url, true));
            }

            $this->getForm();
	}

	public function edit() {
		$this->language->load('catalog/filter_seodata');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/filter_seodata');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_filter_seodata->editFilterSeoDataItem($this->request->get['fsd_id'], $this->request->post);

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
            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . $this->request->get['filter_category'];
            }

			$this->response->redirect($this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
            $this->language->load('catalog/filter_seodata');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('catalog/filter_seodata');

            if (isset($this->request->post['selected']) && $this->validateDelete()) {
                foreach ($this->request->post['selected'] as $filter_seodata_id) {
                    $this->model_catalog_filter_seodata->deleteFilterSeoDataItem($filter_seodata_id);
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
                if (isset($this->request->get['filter_category'])) {
                    $url .= '&filter_category=' . $this->request->get['filter_category'];
                }

                $this->response->redirect($this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . $url, true));
            }

            $this->getList();
	}

	protected function getList() {
            
            if (isset($this->request->get['filter_category'])) {
                $filter_category = $this->request->get['filter_category'];
            } else {
                $filter_category = null;
            }
                
            if (isset($this->request->get['sort'])) {
                $sort = $this->request->get['sort'];
            } else {
                $sort = 'cd.name';
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

            $url = '';

            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
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
            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . $this->request->get['filter_category'];
            }

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . $url, true)
            );

            $data['add'] = $this->url->link('catalog/filter_seodata/add', 'token=' . $this->session->data['token'] . $url, true);
            $data['delete'] = $this->url->link('catalog/filter_seodata/delete', 'token=' . $this->session->data['token'] . $url, true);

            $data['filter_seodatas'] = array();

            $filter_data = array(
                'filter_category'    => $filter_category,
                'sort'  => $sort,
                'order' => $order,
                'start' => ($page - 1) * $this->config->get('config_limit_admin'),
                'limit' => $this->config->get('config_limit_admin')
            );

            $filter_seodata_total = $this->model_catalog_filter_seodata->getTotalFilterSeoDataItems($filter_data);

            $results = $this->model_catalog_filter_seodata->getFilterSeoDataItems($filter_data);

            foreach ($results as $result) {
                $data['filter_seodata_items'][] = array(                       
                        'id'                 => $result['id'],
                        'filter_group_id'    => $result['fgname'],
                        'filter_id'          => $result['fname'],				
                        'language_id'        => $result['language_id'],
                        'name'               => $result['name'],
                        'param_name'         => $result['param_name'],				
                        'edit'               => $this->url->link('catalog/filter_seodata/edit', 'token=' . $this->session->data['token'] . '&fsd_id=' . $result['id'] . $url, true)
                );
            }

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_list'] = $this->language->get('text_list');
            $data['text_no_results'] = $this->language->get('text_no_results');
            $data['text_confirm'] = $this->language->get('text_confirm');

            $data['column_name'] = $this->language->get('column_name');
            $data['column_filter_group'] = $this->language->get('column_filter_group');
            $data['column_filter'] = $this->language->get('column_filter');
            $data['column_paramname'] = $this->language->get('column_paramname');
            $data['column_action'] = $this->language->get('column_action');
            $data['button_filter'] = $this->language->get('button_filter');
            $data['entry_category'] = $this->language->get('entry_category');

            $data['button_add'] = $this->language->get('button_add');
            $data['button_edit'] = $this->language->get('button_edit');
            $data['button_delete'] = $this->language->get('button_delete');
            $data['token'] = $this->session->data['token'];
            $data['filter_category'] = $filter_category;

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
            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . $this->request->get['filter_category'];
            }

            $data['sort_name'] = $this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . '&sort=cd.name' . $url, true);
            $data['sort_fgname'] = $this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . '&sort=fgd.name' . $url, true);
            $data['sort_fname'] = $this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . '&sort=fd.name' . $url, true);		

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }
            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . $this->request->get['filter_category'];
            }

            $pagination = new Pagination();
            $pagination->total = $filter_seodata_total;
            $pagination->page = $page;
            $pagination->limit = $this->config->get('config_limit_admin');
            $pagination->url = $this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

            $data['pagination'] = $pagination->render();

            $data['results'] = sprintf($this->language->get('text_pagination'), ($filter_seodata_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($filter_seodata_total - $this->config->get('config_limit_admin'))) ? $filter_seodata_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $filter_seodata_total, ceil($filter_seodata_total / $this->config->get('config_limit_admin')));

            $data['sort'] = $sort;
            $data['order'] = $order;

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('catalog/filter_seodata_list.tpl', $data));
	}

	protected function getForm() { 
            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_form'] = !isset($this->request->get['fsd_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

            $data['entry_name'] = $this->language->get('entry_name');
            $data['entry_sort_order'] = $this->language->get('entry_sort_order');

            $data['button_save'] = $this->language->get('button_save');
            $data['button_cancel'] = $this->language->get('button_cancel');

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
            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . $this->request->get['filter_category'];
            }

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . $url, true)
            );

            if (!isset($this->request->get['fsd_id'])) {
                $data['action'] = $this->url->link('catalog/filter_seodata/add', 'token=' . $this->session->data['token'] . $url, true);
            } else {
                $data['action'] = $this->url->link('catalog/filter_seodata/edit', 'token=' . $this->session->data['token'] . '&fsd_id=' . $this->request->get['fsd_id'] . $url, true);
            }

            $data['cancel'] = $this->url->link('catalog/filter_seodata', 'token=' . $this->session->data['token'] . $url, true);

            if (isset($this->request->get['fsd_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
                $filter_seodata_info = $this->model_catalog_filter_seodata->getFilterSeodataItem($this->request->get['fsd_id']);
                $data['filter_seodata_info']=$filter_seodata_info;
            }
            // Фильтры
            $filters = $this->model_catalog_filter_seodata->getFilters();
            $data['filters']=$filters;
            // Группы фильтров
            $filter_groups = $this->model_catalog_filter_seodata->getFilterGroupList();
            $data['filter_groups']=$filter_groups;
            // Категории
            $categories = $this->model_catalog_filter_seodata->getCategories();
            $data['categories']=$categories;
            // Параметры
            $paramnames = array(
                'keywords',
                'description',
                'title',
                'meta_description',
                'heading_title',                    
            );                
            $data['paramnames']=$paramnames;
            // Языки
            $languages = array(
                1=>'русский',
                2=>'украинский',                    
            );                
            $data['languages']=$languages;

            // Сортировки
            if (isset($this->request->post['sort_order'])) {
                $data['sort_order'] = $this->request->post['sort_order'];
            } elseif (!empty($filter_seodata_info)) {
                $data['sort_order'] = $filter_seodata_info['sort_order'];
            } else {
                $data['sort_order'] = '';
            }

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('catalog/filter_seodata_form.tpl', $data));
	}

	protected function validateForm() {
            if (!$this->user->hasPermission('modify', 'catalog/filter_seodata')) {
                $this->error['warning'] = $this->language->get('error_permission');
            }

            return !$this->error;
	}

	protected function validateDelete() {
            if (!$this->user->hasPermission('modify', 'catalog/filter_seodata')) {
                $this->error['warning'] = $this->language->get('error_permission');
            }
            return !$this->error;
	}
}
