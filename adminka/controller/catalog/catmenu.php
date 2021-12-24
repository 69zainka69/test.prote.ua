<?php
class ControllerCatalogCatmenu extends Controller {
    private $error = array();
    private $category_id = 0;
    private $path = array();

    public function index() {
        $this->language->load('catalog/catmenu');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/catmenu');

        $this->getList();
    }

    public function add() {
            $this->language->load('catalog/catmenu');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('catalog/catmenu');

            if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
                    $this->model_catalog_catmenu->addCatmenu($this->request->post);

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

                    $this->response->redirect($this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . $url, 'SSL'));
            }

            $this->getForm();
    }

    public function edit() {
            $this->language->load('catalog/catmenu');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('catalog/catmenu');

            if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

                    $this->model_catalog_catmenu->editCatmenu($this->request->get['catmenu_id'], $this->request->post);

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

                    $this->response->redirect($this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . $url, 'SSL'));
            }

            $this->getForm();
    }

    public function delete() {
            $this->language->load('catalog/catmenu');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('catalog/catmenu');

            if (isset($this->request->post['selected']) && $this->validateDelete()) {
                    foreach ($this->request->post['selected'] as $catmenu_id) {
                            $this->model_catalog_catmenu->deleteCatmenu($catmenu_id);
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

                    $this->response->redirect($this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . $url, 'SSL'));
            }

            $this->getList();
    }

    public function repair() {
            $this->language->load('catalog/category');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('catalog/category');

            if ($this->validateRepair()) {
                    $this->model_catalog_category->repairCategories();

                    $this->session->data['success'] = $this->language->get('text_success');

                    $this->response->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL'));
            }

            $this->getList();
    }

    protected function getList() {
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
                    'href' => $this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . $url, 'SSL')
            );

            $data['add'] = $this->url->link('catalog/catmenu/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
            $data['delete'] = $this->url->link('catalog/catmenu/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
            $data['repair'] = $this->url->link('catalog/catmenu/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

            $data['categories'] = array();

            $filter_data = array(
                    'sort'  => $sort,
                    'order' => $order,
                    'start' => ($page - 1) * $this->config->get('config_limit_admin'),
                    'limit' => $this->config->get('config_limit_admin')
            );

            $category_total = $this->model_catalog_catmenu->getTotalCatmenus();

            $results = $this->model_catalog_catmenu->getCatmenus($filter_data);

            foreach ($results as $result) {
                    $data['categories'][] = array(
                            'category_id' => $result['catmenu_id'],
                            'name'        => $result['title'],
                            'sort_order'  => $result['sort'],
                            'edit'        => $this->url->link('catalog/catmenu/edit', 'token=' . $this->session->data['token'] . '&category_id=' . $result['catmenu_id'] . $url, 'SSL'),
                            'delete'      => $this->url->link('catalog/catmenu/delete', 'token=' . $this->session->data['token'] . '&category_id=' . $result['catmenu_id'] . $url, 'SSL')
                    );
            }

            if (isset($this->request->get['path'])) {
                    if ($this->request->get['path'] != '') {
                            $this->path = explode('_', $this->request->get['path']);
                            $this->catmenu_id = end($this->path);
                            $this->session->data['path'] = $this->request->get['path'];
                    } else {
                            unset($this->session->data['path']);
                    }
            } elseif (isset($this->session->data['path'])) {
                    $this->path = explode('_', $this->session->data['path']);
                    $this->category_id = end($this->path);
            }

            $data['categories'] = $this->getCatmenus(0);//print_r($data['categories']);

            $category_total = count($data['categories']);

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

            $data['sort_name'] = $this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
            $data['sort_sort_order'] = $this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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
            $pagination->total = $category_total;
            $pagination->page = $page;
            $pagination->limit = $this->config->get('config_limit_admin');
            $pagination->url = $this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

            $data['pagination'] = $pagination->render();

            $data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));

            $data['sort'] = $sort;
            $data['order'] = $order;

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('catalog/catmenu_list.tpl', $data));
    }

protected function getForm() {
        //CKEditor
        if ($this->config->get('config_editor_default')) {
            $this->document->addScript('view/javascript/ckeditor/ckeditor.js');
            $this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
        }

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_form'] = !isset($this->request->get['category_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
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
                    'href' => $this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . $url, 'SSL')
            );

            if (!isset($this->request->get['catmenu_id'])) {
                    $data['action'] = $this->url->link('catalog/catmenu/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
            } else {
                    $data['action'] = $this->url->link('catalog/catmenu/edit', 'token=' . $this->session->data['token'] . '&catmenu_id=' . $this->request->get['catmenu_id'] . $url, 'SSL');
            }

            $data['cancel'] = $this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . $url, 'SSL');

            if (isset($this->request->get['catmenu_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
                $category_info = $this->model_catalog_catmenu->getCatmenu($this->request->get['catmenu_id']);
            }

            $data['token'] = $this->session->data['token'];
            $data['ckeditor'] = $this->config->get('config_editor_default');

            $this->load->model('localisation/language');

            $data['languages'] = $this->model_localisation_language->getLanguages();

            $data['lang'] = $this->language->get('lang');

            if (isset($this->request->post['category_description'])) {
                    $data['category_description'] = $this->request->post['category_description'];
            } elseif (isset($this->request->get['catmenu_id'])) {
                    
                    $data['category_description'] = $this->model_catalog_catmenu->getCatmenuDescriptions($this->request->get['catmenu_id']);
                   
                    
            } else {
                    $data['category_description'] = array();
            }

            $this->load->model('tool/image');
            foreach ($data['category_description'] as $key => $lang) {
                if ($lang['image1']) {
                    $data['category_description'][$key]['thumb1'] = $this->model_tool_image->resize($lang['image1'], 100, 100);
                } else {
                    $data['category_description'][$key]['thumb1'] = $this->model_tool_image->resize('no_image.png', 100, 100);
                }
                if ($lang['image2']) {
                    $data['category_description'][$key]['thumb2'] = $this->model_tool_image->resize($lang['image2'], 100, 100);
                } else {
                    $data['category_description'][$key]['thumb2'] = $this->model_tool_image->resize('no_image.png', 100, 100);
                }
            }

            // Categories
            $catmenus = $this->model_catalog_catmenu->getAllCatmenus();

            $data['categories'] = $this->getAllCatmenus($catmenus);

            if (isset($category_info)) {
                unset($data['categories'][$category_info['catmenu_id']]);
            }

            if (isset($this->request->post['parent_id'])) {
                $data['parent_id'] = $this->request->post['parent_id'];
            } elseif (!empty($category_info)) {
                $data['parent_id'] = $category_info['parent_id']; 
            } else {
                $data['parent_id'] = 0;
            }


            if (isset($this->request->post['image'])) {
                $data['image'] = $this->request->post['image'];
            } elseif (!empty($category_info)) {
                $data['image'] = $category_info['image'];
            } else {
                $data['image'] = '';
            }

            $this->load->model('tool/image');

            if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
                $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
            } elseif (!empty($category_info) && is_file(DIR_IMAGE . $category_info['image'])) {
                $data['thumb'] = $this->model_tool_image->resize($category_info['image'], 100, 100);
            } else {
                $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
            }

            $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

            if (isset($this->request->post['keyword'])) {
                $data['keyword'] = $this->request->post['keyword'];
            } elseif (!empty($category_info)) {
                $data['keyword'] = $category_info['keyword'];
            } else {
                $data['keyword'] = '';
            }
            //$data['keyword'] = '';


            if (isset($this->request->post['sort_order'])) {
                    $data['sort_order'] = $this->request->post['sort_order'];
            } elseif (!empty($category_info)) {
                    $data['sort_order'] = $category_info['sort'];
            } else {
                    $data['sort_order'] = 0;
            }

            if (isset($this->request->post['status'])) {
                    $data['status'] = $this->request->post['status'];
            } elseif (!empty($category_info)) {
                    $data['status'] = $category_info['active'];
            } else {
                    $data['status'] = true;
            }

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('catalog/catmenu_form.tpl', $data));
    }

    protected function validateForm() {
            if (!$this->user->hasPermission('modify', 'catalog/catmenu')) {
                    $this->error['warning'] = $this->language->get('error_permission');
            }

            foreach ($this->request->post['category_description'] as $language_id => $value) {
                if($language_id==3)continue;
                    if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
                            $this->error['name'][$language_id] = $this->language->get('error_name');
                    }
            }
            
            return !$this->error;
    }

    protected function validateDelete() {
            if (!$this->user->hasPermission('modify', 'catalog/catmenu')) {
                    $this->error['warning'] = $this->language->get('error_permission');
            }

            return !$this->error;
    }

    protected function validateRepair() {
            if (!$this->user->hasPermission('modify', 'catalog/catmenu')) {
                    $this->error['warning'] = $this->language->get('error_permission');
            }

            return !$this->error;
    }

    private function getCatmenus($parent_id, $parent_path = '', $indent = '') {
            $catmenu_id = array_shift($this->path);

            $output = array();

            static $href_category = null;
            static $href_action = null;

            if ($href_category === null) {
                    $href_category = $this->url->link('catalog/catmenu', 'token=' . $this->session->data['token'] . '&path=', 'SSL');
                    $href_action = $this->url->link('catalog/catmenu/update', 'token=' . $this->session->data['token'] . '&catmenu_id=', 'SSL');
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

            $results = $this->model_catalog_catmenu->getCatmenusByParentId($parent_id);
// print_r($results);
            foreach ($results as $result) {
                    $path = $parent_path . $result['catmenu_id'];

                    $href = ($result['children']) ? $href_category . $path : '';

                    $name = $result['title'];

                    if ($catmenu_id == $result['catmenu_id']) {
                            $name = '<b>' . $name . '</b>';

                            $data['breadcrumbs'][] = array(
                                    'text'      => $name,
                                    'href'      => $href,
                                    'separator' => ' :: '
                            );

                            $href = '';
                    }

                    $selected = isset($this->request->post['selected']) && in_array($result['catmenu_id'], $this->request->post['selected']);

                    $action = array();

                    $action[] = array(
                            'text' => $this->language->get('text_edit'),
                            'href' => $href_action . $result['catmenu_id']
                    );

                    $output[$result['catmenu_id']] = array(
                            'category_id' => $result['catmenu_id'],
                            'name'        => $name,
                            'sort_order'  => $result['sort'],
                            'selected'    => $selected,
                            'action'      => $action,
                            'edit'        => $this->url->link('catalog/catmenu/edit', 'token=' . $this->session->data['token'] . '&catmenu_id=' . $result['catmenu_id'] . $url, 'SSL'),
                            'delete'      => $this->url->link('catalog/catmenu/delete', 'token=' . $this->session->data['token'] . '&catmenu_id=' . $result['catmenu_id'] . $url, 'SSL'),
                            'href'        => $href,
                            'indent'      => $indent
                    );

                    if ($catmenu_id == $result['catmenu_id']) {
                            $output += $this->getCatmenus($result['catmenu_id'], $path . '_', $indent . str_repeat('&nbsp;', 8));
                    }
            }

            return $output;
    }

    private function getAllCatmenus($categories, $parent_id = 0, $parent_name = '') {
            $output = array();

            if (array_key_exists($parent_id, $categories)) {
                    if ($parent_name != '') {
                            //$parent_name .= $this->language->get('text_separator');
                            $parent_name .= ' &gt; ';
                    }

                    foreach ($categories[$parent_id] as $category) {
                            $output[$category['catmenu_id']] = array(
                                    'catmenu_id' => $category['catmenu_id'],
                                    'name'        => $parent_name . $category['title']
                            );

                            $output += $this->getAllCatmenus($categories, $category['catmenu_id'], $parent_name . $category['title']);
                    }
            }

uasort($output, array($this, 'sortByName'));

            return $output;
    }

function sortByName($a, $b) {
return strcmp($a['name'], $b['name']);
}

    public function autocomplete() {
            $json = array();

            if (isset($this->request->get['filter_name'])) {
                    $this->load->model('catalog/category');

                    $filter_data = array(
                            'filter_name' => $this->request->get['filter_name'],
                            'sort'        => 'name',
                            'order'       => 'ASC',
                            'start'       => 0,
                            'limit'       => 5
                    );

                    $results = $this->model_catalog_category->getCategories($filter_data);

                    foreach ($results as $result) {
                            $json[] = array(
                                    'category_id' => $result['category_id'],
                                    'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
                            );
                    }
            }

            $sort_order = array();

            foreach ($json as $key => $value) {
                    $sort_order[$key] = $value['name'];
            }

            array_multisort($sort_order, SORT_ASC, $json);

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
    }
}