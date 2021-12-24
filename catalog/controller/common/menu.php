<?php
class ControllerCommonMenu extends Controller {
	public function index() {

		/// gdemon 
        //$this->load->model('tool/image');
        //$data['catalogmenu_new']=false;

        //$data['catalogmenu_new'] = $this->cache->get('menu_categories' . $lang . $_SERVER['HTTPS']);
        //if (!$data['catalogmenu_new']) {

			$lang = $this->language->get('code'); 
			$langurl=($lang=='uk'?'/ua':'');
            $data['langurl'] = $langurl;

			$this->load->language('common/header');

			$data['text_action4'] = $this->language->get('text_action4');
        	$data['text_action5'] = sprintf($this->language->get('text_action5'), $langurl.'/');
            $data['text_home'] = $this->language->get('text_home');
            $data['text_category_mobile'] = $this->language->get('text_category_mobile');
            $data['text_delivery'] = $this->language->get('text_delivery');
            $data['text_pay'] = $this->language->get('text_pay');
            $data['text_signin'] = $this->language->get('text_signin');
            $data['text_profile'] = $this->language->get('text_profile');
            $data['text_shopping_cart_mobile'] = $this->language->get('text_shopping_cart_mobile');
            $data['text_callback'] = $this->language->get('text_callback');
            $data['modal_btn_call'] = $this->language->get('modal_btn_call');
            $data['text_city_select_mobile'] = $this->language->get('text_city_select_mobile');
            $data['text_select_city_mobile'] = $this->language->get('text_select_city_mobile');
            $data['lang'] = $lang;
            $data['cart_mobile'] = $this->load->controller('common/cart', true);
            //$data['login_html'] = $this->load->controller('account/login/get_login', 'header');
            $data['login_modal_html'] = $this->load->controller('account/login/get_login', 'modal');
            $data['login_mobile_html'] = $this->load->controller('account/login/get_login', 'mobile');
            $data['logged'] = $this->customer->isLogged();
            $this->load->model('common/header');
            $this->load->model('tool/image');
            
            $catalogmenu_new = $this->model_common_header->getCatalogMenu_new(361);
            foreach ($catalogmenu_new as $category) {
                // Level 2
                $children_data = array();

                $children = $this->model_common_header->getCatalogMenu_new($category['catmenu_id']);
                
                foreach ($children as $child) {
                    // Level 3
                    $children_data2 = array();
                    $children2 = $this->model_common_header->getCatalogMenu_new($child['catmenu_id']);
                    foreach ($children2 as $child2) {
                        if(!$child2['catmenu_id'])continue;
                        $children_data2[] = array(
                            'name'  => $child2['title'],
                            'href'  => (substr($child2['url'] ,-1,1)=='/')?$child2['url']:$child2['url'].'/'
                        );
                    }
                    $children_data[] = array(
                        'name'  => $child['title'],
                        'children' => $children_data2,
                        'href'  => $child['url'].(substr($child['url'] ,-1,1)=='/')?$child['url']:$child['url'].'/'
                    );
                }

                /*if($category['image1']) {$image1 = 'image/'.$category['image1'];}else{$image1=false;}
                if($category['image2']) {$image2 = 'image/'.$category['image2'];}else{$image2=false;}*/
                if($category['image1']) {
                    $image1 = $this->model_tool_image->resize($category['image1'], 220, 140);

                }else{$image1=false;}   

                if($category['image2']) {$image2 = $this->model_tool_image->resize($category['image2'], 220, 140);}else{$image2=false;}
                // Level 1
                $data['catalogmenu_new'][] = array(
                    'name'     => $category['title'],
                    'thumb'    => $category['image'],
                    'image1'     => $image1,
                    'image2'     => $image2,
                    'catmenu_id' => $category['catmenu_id'],
                    'class'      => $this->getStyleCategory($category['catmenu_id']),
                    'description1'     => html_entity_decode($category['description1'], ENT_QUOTES, 'UTF-8'),
                    'description2'     => html_entity_decode($category['description2'], ENT_QUOTES, 'UTF-8'),
                    'href1'     => $category['href1'],
                    'href2'     => $category['href2'],
                    'children' => $children_data,
                    //'column'   => $category['column'] ? $category['column'] : 1,
                    'href'  => (substr($category['url'] ,-1,1)=='/')?$category['url']:$category['url'].'/'
                );
                
            }
            
        if (isset($this->request->get['route'])) {
            $route=$this->request->get['route'];
            $data['route']=$this->request->get['route'];
        }
        $this->cache->set('menu_categories' . $lang . $_SERVER['HTTPS'], $data['catalogmenu_new']);
        //}

		return $this->load->view($this->config->get('config_template') . '/template/common/menu.tpl', $data);
		
	}

    private function getStyleCategory($id){ // возвращает стили для категорий в меню
        $cssClasses = [
            1 => 'general-menu__bumaga', // Бумага и бумажная продукция
            10 => 'general-menu__fotobumaga', // Фотобумага и пленки
            360 => 'general-menu__struynaya-pechat', // Струйная печать
            5 => 'general-menu__kantselyarskie-tvoaryi', // Канцелярские твоары
            11 => 'general-menu__rashodnyie-materialyi', // Расходные материалы для принтеров и МФУ
            3 => 'general-menu__ofisnaya-tehnika', // Офисная техника
            4 => 'general-menu__kompyuternaya-tehnika', // Ноутбуки и компьютерная техника
            848 => 'general-menu__byitovaya-tehnika', // Бытовая техника
            845 => 'general-menu__prezentatsii', // Презентации и выставки
            246 => 'general-menu__byitovaya-himiya', // Бытовая химия
            245 => 'general-menu__hoztovaryi', // Хозтовары

        ];
        if(isset($cssClasses[$id])){
            return $cssClasses[$id];
        }
    }
}