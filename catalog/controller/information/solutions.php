<?php
class ControllerInformationSolutions extends Controller {
	public function index() {
		$this->load->language('information/solutions');

		//$this->load->model('catalog/solutions');

		$data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
              'text' => $this->language->get('text_home'),
              'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('information/solutions')
        );

  		if (isset($this->request->get['solution_id'])) {
    			$solution_id = (int)$this->request->get['solution_id'];
  		} else {
    			$solution_id = false;
          $this->document->setTitle($this->language->get('meta_tite'));
          $this->document->setDescription($this->language->get('meta_descpription'));

  		}

      $data['text_usluga1'] = $this->language->get('text_usluga1');
      $data['text_usluga2'] = $this->language->get('text_usluga2');
      $data['text_usluga3'] = $this->language->get('text_usluga3');
      $data['text_usluga4'] = $this->language->get('text_usluga4');
      $data['text_usluga5'] = $this->language->get('text_usluga5');
      $data['text_usluga6'] = $this->language->get('text_usluga6');
      $data['text_step1'] = $this->language->get('text_step1');
      $data['text_step2'] = $this->language->get('text_step2');
      $data['text_step3'] = $this->language->get('text_step3');
      
      $data['langurl']=$langurl=($this->language->get('code')=='uk'?'/ua':'');

      $data['text_slog'] = sprintf($this->language->get('text_slog'),$langurl,$langurl);
      
      $data['text_description'] = $this->language->get('text_description');
      $data['text_info'] = $this->language->get('text_info');

		
		  if(!$solution_id){

            $data['heading_title'] = $this->language->get('heading_title');
              $this->document->setTitle($data['heading_title']);
            
            /* тянем с readycart */
            $this->load->language('information/readycart');
            $data['text_title1'] = $this->language->get('text_title1');
            $data['text_title2'] = $this->language->get('text_title2');
            $data['text_text1_1'] = $this->language->get('text_text1_1');
            $data['text_text2_1'] = $this->language->get('text_text2_1');

            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            $this->response->setOutput($this->load->view('default/template/information/solutions/solutions_list.tpl', $data));
        } else {

            $this->load->model('common/header');
            
            $catmenu = $this->model_common_header->getCatalogMenu($solution_id);
            
            if($catmenu){

                $data['heading_title'] = $catmenu['title'];
                $this->document->setTitle($catmenu['meta_title']);
                $this->document->setDescription($catmenu['meta_description']);

                $data['breadcrumbs'][] = array(
                    'text' => $catmenu['title'],
                    'href' => $this->url->link('information/solutions','solution_id='.$solution_id)
                );

                $data['categories'] = $this->cache->get('menu_solution_id-' . $solution_id .'-' . $this->language->get('code'));
                //$data['categories'] = false;
                if (!$data['categories']) {
                    $data['categories'] = $this->getCatalogMenu_new($solution_id);
                
                    foreach ($data['categories'] as $key => $category) {
                        $data['categories'][$key]['children']=$this->getCatalogMenu_new($key);
                    }     
                    $this->cache->set('menu_solution_id-' . $solution_id .'-' . $this->language->get('code'), $data['categories']);
                }
                //450 449 448 
                //362 437 447
                if($solution_id==450){//Промислові підприємтсва
                  $data['svg'] = '/ico/17-pidpryemstva.svg';
                  $data['txt'] = $data['text_usluga1'];
                  $data['style'] = 'left:15px;top:16px;';
                  $data['style2'] = "background: url('/image/ico/sol_sp.jpg') 0 0;";
                }elseif($solution_id==362){//Учреждения образования
                  $data['svg'] = '/ico/19-osvita.svg';
                  $data['txt'] = $data['text_usluga2'];
                  $data['style'] = 'left:13px;top:17px;';
                  $data['style2'] = "background: url('/image/ico/sol_sp.jpg') -170px 0;";
                }elseif($solution_id==449){//Установи охорони здоров'я
                  $data['svg'] = '/ico/21-med.svg';
                  $data['txt'] = $data['text_usluga3'];
                  $data['style'] = 'left:16px;top: 17px;';
                  $data['style2'] = "background: url('/image/ico/sol_sp.jpg') -340px 0;";
                }elseif($solution_id==437){//Гостиницы, рестораны, кафе
                  $data['svg'] = '/ico/18-hotel.svg';
                  $data['txt'] = $data['text_usluga4'];
                  $data['style'] = 'left:9px;top:20px;';
                  $data['style2'] = "background: url('/image/ico/sol_sp.jpg') 0 -44px;";
                }elseif($solution_id==448){//Підприємства торгівлі та логістики
                  $data['svg'] = '/ico/20-shop.svg';
                  $data['txt'] = $data['text_usluga5'];
                  $data['style'] = 'left:14px;top:10px;';
                  $data['style2'] = "background: url('/image/ico/sol_sp.jpg') -170px -44px;";
                }elseif($solution_id==447){//Банки та офіси
                  $data['svg'] = '/ico/22-bank.svg';
                  $data['txt'] = $data['text_usluga6'];
                  $data['style'] = 'left:26px;top:16px;';
                  $data['style2'] = "background: url('/image/ico/sol_sp.jpg') -340px -44px;";
                }

            } else {
                // error
                $not_found =true;
            }
                
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
                  
            $this->response->setOutput($this->load->view('default/template/information/solutions/solutions_form.tpl', $data));
		}
    
    if(isset($not_found)){
		
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/solutions', 'solution_id=' . $solution_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');
      $data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');
			$data['continue'] = $this->url->link('common/home');
			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
			
			$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			
		}
	}

      protected function getCatalogMenu_new($catmenu_id){
            $result = array();
            $catmenu = $this->model_common_header->getCatalogMenu_new($catmenu_id);
            foreach ($catmenu as $menu) {
                  if(!$menu['catmenu_id'])continue;
                  $image='';
                  if($menu['image']){
                      $image='image/'.$menu['image'];
                  }
                  $result[$menu['catmenu_id']] = array(
                  'name'  => $menu['title'],
                  'image'  => $image,
                  'href'  => $menu['url']
                  );
            }
            return $result;
      }

}