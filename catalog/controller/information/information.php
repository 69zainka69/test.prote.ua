<?php
class ControllerInformationInformation extends Controller {
	public function index() {

//vdump($this->request->get);
		$this->load->language('information/information');

		$this->load->model('catalog/information');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['information_id'])) {
			$information_id = (int)$this->request->get['information_id'];
		} else {
			$information_id = 0;
		}


		$information_info = $this->model_catalog_information->getInformation($information_id);

		if ($information_info) {

                  if($information_id==10){
                        $data['svg'] = file_get_contents(DIR_IMAGE.'ico/povern.svg');
                  } else {
                        $data['svg'] = file_get_contents(DIR_IMAGE.'ico/polit.svg');
                  }


			/*if ($information_info['meta_title']) {
				$this->document->setTitle($information_info['meta_title']);
			} else {
				$this->document->setTitle($information_info['title'] . ' ' . $this->language->get('text_seo_title'));
			}*/

			// 2018.09.18 óáðàë description äëÿ seoshild
		      /*if ($information_info['meta_description']) {
		         $this->document->setDescription($information_info['meta_description']);
		      } else {
					   $this->document->setDescription($information_info['title'] . $this->language->get('text_seo_description'));
		      }*/

			$this->document->setKeywords($information_info['meta_keyword']);

			$data['breadcrumbs'][] = array(
				'text' => $information_info['title'],
				'href' => $this->url->link('information/information', 'information_id=' .  $information_id)
			);

                  $this->document->addLink($this->url->link('information/information', 'information_id=' .  $information_id), 'canonical');

			if ($information_info['meta_h1']) {
				$data['heading_title'] = $information_info['meta_h1'];
			} else {
				$data['heading_title'] = $information_info['title'];
			}

			// формируем title от seoshild
                  $title = $data['heading_title'].'  - интернет магазин prote.ua';
                  $this->document->setTitle($title);

			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_more'] = $this->language->get('button_more');

			$data['description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');

			$data['continue'] = $this->url->link('common/home');

			//$data['column_left'] = $this->load->controller('common/column_left');
			//$data['column_right'] = $this->load->controller('common/column_right');
			//$data['content_top'] = $this->load->controller('common/content_top');
			//$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
			$data['content_reviews'] = $this->load->controller('information/shop_rating', true);
            if ($information_id==11) {
                $data['heading_title']='';
                $data['column_right'] = '';
            }
            //echo $information_id;
            if($information_id==6){
            	$this->load->language('information/html/delivery');
            	$data['text_kurier_tite'] = $this->language->get('text_kurier_tite');
            	$data['text_kurier_tite2'] = $this->language->get('text_kurier_tite2');
            	$data['text_kurier_description'] = $this->language->get('text_kurier_description');
            	$data['text_samovyviz_tite'] = $this->language->get('text_samovyviz_tite');
            	$data['text_samovyviz_description'] = $this->language->get('text_samovyviz_description');
            	$data['text_nova_poshta_tite'] = $this->language->get('text_nova_poshta_tite');
            	$data['text_nova_poshta_tite2'] = $this->language->get('text_nova_poshta_tite2');
            	$data['text_nova_poshta_description'] = $this->language->get('text_nova_poshta_description');
            	// $data['text_intaim_tite'] = $this->language->get('text_intaim_tite');
            	// $data['text_intaim_tite2'] = $this->language->get('text_intaim_tite2');
                  // $data['text_intaim_description'] = $this->language->get('text_intaim_description');

                  $data['text_justin_tite'] = $this->language->get('text_justin_tite');
                  $data['text_justin_tite2'] = $this->language->get('text_justin_tite2');
                  $data['text_justin_description'] = $this->language->get('text_justin_description');


            	$data['text_ukrposhta_tite'] = $this->language->get('text_ukrposhta_tite');
            	$data['text_ukrposhta_tite2'] = $this->language->get('text_ukrposhta_tite2');
            	$data['text_ukrposhta_description'] = $this->language->get('text_ukrposhta_description');
            	$data['text_nichnyy_ekspres_tite'] = $this->language->get('text_nichnyy_ekspres_tite');
            	$data['text_nichnyy_ekspres_tite2'] = $this->language->get('text_nichnyy_ekspres_tite2');
            	$data['text_nichnyy_ekspres_description'] = $this->language->get('text_nichnyy_ekspres_description');
            	$data['text_delivery_title1'] = $this->language->get('text_delivery_title1');
            	$data['text_delivery_title2'] = $this->language->get('text_delivery_title2');
                  $data['text_delivery_title3'] = $this->language->get('text_delivery_title3');
                  $data['text_inshi1'] = $this->language->get('text_inshi1');
            	$data['text_inshi2'] = $this->language->get('text_inshi2');
				$this->response->setOutput($this->load->view('default/template/information/html/delivery.tpl', $data));
			} elseif($information_id==9){
				$this->load->language('information/html/contacts');
            	$data['text_telephone'] = $this->language->get('text_telephone');
            	$data['text_mail'] = $this->language->get('text_mail');
            	$data['text_clock'] = $this->language->get('text_clock');
            	$data['text_point'] = $this->language->get('text_point');
            	$data['text_adress'] = $this->language->get('text_adress');
            	$this->response->setOutput($this->load->view('default/template/information/html/contacts.tpl', $data));
			} elseif($information_id==4){
				$this->load->language('information/html/about_us');
            	$data['text_description'] = $this->language->get('text_description');
            	$data['text_desc_item1'] = $this->language->get('text_desc_item1');
            	$data['text_desc_item2'] = $this->language->get('text_desc_item2');
            	$data['text_desc_item3'] = $this->language->get('text_desc_item3');
            	$data['text_desc_item4'] = $this->language->get('text_desc_item4');
            	$data['text_sub_title1'] = $this->language->get('text_sub_title1');

                  $langurl=($this->language->get('code')=='uk'?'/ua':'');
            	$data['text_sub_text1'] = sprintf($this->language->get('text_sub_text1'),$langurl,$langurl);

            	$data['text_sub_title2'] = $this->language->get('text_sub_title2');
            	$data['text_sub_text2'] = $this->language->get('text_sub_text2');
            	$data['text_sub_title3'] = $this->language->get('text_sub_title3');
            	$data['text_sub_text3'] = $this->language->get('text_sub_text3');
            	$this->response->setOutput($this->load->view('default/template/information/html/about_us.tpl', $data));
            } elseif($information_id==7){
				$this->load->language('information/html/warranty');
            	$data['text_description'] = $this->language->get('text_description');
            	$data['text_title1'] = $this->language->get('text_title1');
            	$data['text_name11'] = $this->language->get('text_name11');
            	$data['text_descr11'] = $this->language->get('text_descr11');
            	$data['text_name12'] = $this->language->get('text_name12');
            	$data['text_descr12'] = $this->language->get('text_descr12');
            	$data['text_name13'] = $this->language->get('text_name13');
            	$data['text_descr13'] = $this->language->get('text_descr13');
            	$data['text_name14'] = $this->language->get('text_name14');
            	$data['text_descr14'] = $this->language->get('text_descr14');

            	$data['text_title2'] = $this->language->get('text_title2');
            	$data['text_name21'] = $this->language->get('text_name21');
            	$data['text_descr21'] = $this->language->get('text_descr21');//text_descr22 - text_descr23
            	$data['text_name22'] = $this->language->get('text_name22');
            	$data['text_name23'] = $this->language->get('text_name23');

            	$data['text_title3'] = $this->language->get('text_title3');
            	$data['text_descr3'] = $this->language->get('text_descr3');
            	$data['text_title4'] = $this->language->get('text_title4');
            	$data['text_descr4'] = $this->language->get('text_descr4');
            	$data['text_title5'] = $this->language->get('text_title5');
            	$data['text_descr5'] = $this->language->get('text_descr5');
            	$data['text_title6'] = $this->language->get('text_title6');
            	$data['text_descr6'] = $this->language->get('text_descr6');
            	$data['text_title7'] = $this->language->get('text_title7');
            	$data['text_descr7'] = $this->language->get('text_descr7');

            	$data['text_title8'] = $this->language->get('text_title8');
            	$data['text_name81'] = $this->language->get('text_name81');
            	$data['text_descr81'] = $this->language->get('text_descr81');//text_descr82
            	$data['text_name83'] = $this->language->get('text_name83');
            	$data['text_name82'] = $this->language->get('text_name82');
            	$data['text_descr83'] = $this->language->get('text_descr83');

            	$this->response->setOutput($this->load->view('default/template/information/html/warranty.tpl', $data));
            } elseif($information_id==8){
            	$this->load->language('information/html/payment');

            	$data['text_nal_tite'] = $this->language->get('text_nal_tite');
            	$data['text_nal_tite2'] = $this->language->get('text_nal_tite2');
            	$data['text_nal_text'] = $this->language->get('text_nal_text');
            	$data['text_nal_desc'] = $this->language->get('text_nal_desc');
                $data['text_beznal_tite'] = $this->language->get('text_beznal_tite');
            	$data['text_beznal_text'] = $this->language->get('text_beznal_text');
            	$data['text_beznal_desc'] = $this->language->get('text_beznal_desc');
                $data['text_beznal_tite_NDS'] = $this->language->get('text_beznal_tite_NDS');
                $data['text_beznal_desc_NDS'] = $this->language->get('text_beznal_desc_NDS');
                $data['text_beznal_text_NDS'] = $this->language->get('text_beznal_text_NDS');
            	$data['text_card_tite'] = $this->language->get('text_card_tite');
            	$data['text_card_text'] = $this->language->get('text_card_text');
            	$data['text_card_desc'] = $this->language->get('text_card_desc');

            	$this->response->setOutput($this->load->view('default/template/information/html/payment.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/information/information.tpl', $data));
			}
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/information', 'information_id=' . $information_id)
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




			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function agree() {
		$this->load->model('catalog/information');

		if (isset($this->request->get['information_id'])) {
			$information_id = (int)$this->request->get['information_id'];
		} else {
			$information_id = 0;
		}

		$output = '';

		$information_info = $this->model_catalog_information->getInformation($information_id);

		if ($information_info) {
			$output .= html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8') . "\n";
		}

		$this->response->setOutput($output);
	}
}
