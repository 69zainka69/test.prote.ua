<?php
class ControllerProductinformal extends Controller {
	public function index() {
		$this->load->language('product/informal');

		$this->load->model('catalog/informal');

		$this->load->model('tool/image');


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['informal_id'])) {
			$informal_id = (int)$this->request->get['informal_id'];

		} else {
			$informal_id = 0;
		}   

		$informal_info = $this->model_catalog_informal->getinformal($informal_id);

		if ($informal_info) {

			$data['text_call'] = $this->language->get('text_call');
			$data['text_view_all'] = $this->language->get('text_view_all');

			if ($informal_info['meta_title']) {
				$this->document->setTitle($informal_info['meta_title']);
			} else {
				$this->document->setTitle($informal_info['name']);
			}

			$this->document->setDescription($informal_info['meta_description']);
			$this->document->setKeywords($informal_info['meta_keyword']);

			if ($informal_info['meta_h1']) {
				$data['heading_title'] = $informal_info['meta_h1'];
			} else {
				$data['heading_title'] = $informal_info['name'];
			}

			// Set the last informal breadcrumb
			$data['breadcrumbs'][] = array(
				'text' => $informal_info['name'],
				'href' => $this->url->link('product/informal', 'informal_id=' . $this->request->get['informal_id'])
			);

                                    
			if ($informal_info['image']) {
				//$data['thumb'] = $this->model_tool_image->resize($informal_info['image'],670,349);
                $data['thumb'] = HTTPS_SERVER.'image/'.$informal_info['image'];
                
			} else {
				$data['thumb'] = '';
			}

			$data['description'] = html_entity_decode($informal_info['description'], ENT_QUOTES, 'UTF-8');
            $data['dop_pole'] = html_entity_decode($informal_info['dop_pole'], ENT_QUOTES, 'UTF-8');
            
            $data['categories'] = array();
            $results = explode(',',$informal_info['parent_id']);

			foreach ($results as $result) {
                $categ_info = $this->model_catalog_informal->getCategory($result);
 
				$data['categories'][] = array(
					'name' => $categ_info['name'],
                    'thumb' => $this->model_tool_image->resize($categ_info['image'],100,100),
					'href' => $this->url->link('product/category', 'path=' . $informal_info['parent_id'] . '_' . $categ_info['category_id'])
				);
			}
             

			// $data['column_left'] = $this->load->controller('common/column_left');
			// $data['column_right'] = $this->load->controller('common/column_right');
			// $data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['content_reviews'] = $this->load->controller('information/shop_rating', true);
			$data['footer'] = $this->load->controller('common/footer');
			
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('default/template/product/informal.tpl', $data));
			
		} else {
			$url = '';

			if (isset($this->request->get['informal_id'])) {
				$url .= '&path=' . $this->request->get['informal_id'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
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

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/informal', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			
			$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			
		}
	}
}
