<?php
class ControllerProductProduct extends Controller {
	private $error = array();

    function selstrlen($strlist, $strlen) {
        // Выбираем самый длинный элемент из списка
        foreach ($strlist as $strItem) {
            if (mb_strlen($strItem)<$strlen) break;
        }
        return $strItem;
    }

    public function index() {
	    //  *****************

	    $data['langurl']=$langurl=($this->language->get('code')=='uk'?'/ua':'');

    	$start = microtime(true);
    	//echo '<br/>Время выполнения скрипта 0: '.round(microtime(true) - $start, 4).' сек.';

    	$this->language->load('module/ordercallback');
    	$this->load->language('information/html/delivery');
    	$this->load->language('information/html/payment');
    	$this->load->language('information/html/contacts');

    	$data['text_no_reviews'] = $this->language->get('text_no_reviews');

    	$data['text_kurier_tite'] = $this->language->get('text_kurier_tite');
    	$data['text_samovyviz_tite'] = $this->language->get('text_samovyviz_tite');
    	$data['text_nova_poshta_tite'] = $this->language->get('text_nova_poshta_tite');
    	// $data['text_intaim_tite'] = $this->language->get('text_intaim_tite');
    	$data['text_justin_tite'] = $this->language->get('text_justin_tite');
    	$data['text_ukrposhta_tite'] = $this->language->get('text_ukrposhta_tite');
    	$data['text_nichnyy_ekspres_tite'] = $this->language->get('text_nichnyy_ekspres_tite');
    	$data['text_delivery_title1'] = $this->language->get('text_delivery_title1');
    	$data['text_delivery_title2'] = $this->language->get('text_delivery_title2');
    	$data['text_delivery_title3'] = $this->language->get('text_delivery_title3');

    	$data['text_nal_tite'] = $this->language->get('text_nal_tite');
    	$data['text_nal_text'] = $this->language->get('text_nal_text');
    	$data['text_beznal_tite'] = $this->language->get('text_beznal_tite');
    	$data['text_beznal_text'] = $this->language->get('text_beznal_text');
    	$data['text_beznal_tite_NDS'] = $this->language->get('text_beznal_tite_NDS');
    	$data['text_beznal_text_NDS'] = $this->language->get('text_beznal_text_NDS');
    	$data['text_card_tite'] = $this->language->get('text_card_tite');
    	$data['text_card_text'] = $this->language->get('text_card_text');

    	$data['text_telephone'] = $this->language->get('text_telephone');
    	$data['text_mail'] = $this->language->get('text_mail');
    	$data['text_clock'] = $this->language->get('text_clock');
    	$data['text_point'] = $this->language->get('text_point');
    	$data['text_adress'] = $this->language->get('text_adress');




    // Order call back setting
        $this->document->addScript('catalog/view/javascript/instup/jquery.validate.min.js','footer');
        $this->language->load('module/ordercallback');
        $this->load->model('setting/setting');
        $ordercallback_settings = $this->model_setting_setting->getSetting('ordercallback');

        $ordercallback_settings['modal_title'] = '';

        if ($ordercallback_settings['ordercallback_use_module']) {
            $data['ordercallback_use_module'] = true;

            if ($ordercallback_settings['ordercallback_module_works_as'] == 'order') {
                $data['ordercallback_as_order'] = true;
                $ordercallback_settings['modal_title'] = $this->language->get('modal_title_order');
            } else {
                $data['ordercallback_as_order'] = false;
                $ordercallback_settings['modal_title'] = $this->language->get('modal_title_call');
            }
            $ordercallback_settings['ordercallback_field_comment_show'] = true;

            $data['modal_field_name'] = $this->language->get('modal_field_name');
            $data['modal_field_phone'] = $this->language->get('modal_field_phone');
            $data['modal_field_email'] = $this->language->get('modal_field_email');
            $data['modal_field_comment'] = $this->language->get('modal_field_comment');
            $data['button_cancel'] = $this->language->get('button_cancel');
            $data['button_send'] = $this->language->get('button_send');
            $data['button_buy']  = $this->language->get('button_buy');
            $data['modal_title_order']  = $this->language->get('modal_title_order');
            $data['modal_timetable']  = $this->language->get('modal_timetable');
            $data['modal_min_order_sum'] = $this->language->get('modal_min_order_sum');
            $data['text_quantity'] = $this->language->get('text_quantity');

            $data['message_system_error'] = $this->language->get('message_system_error');
        } else {
            $data['ordercallback_use_module'] = false;
        }

        $data['ordercallback_settings'] = $ordercallback_settings;
        $query = $this->db->query("SELECT order_id FROM `" . DB_PREFIX . "order` ORDER BY order_id DESC LIMIT 1");
        $data['last_order_id'] = $query->row['order_id'];
    // **************

		$this->load->language('product/product');
		$data['text_button_cart'] = $this->language->get('text_button_cart');
		$data['text_actions'] = $this->language->get('text_actions');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$this->load->model('catalog/category');

		if (isset($this->request->get['path'])) {

            // Отрабатываем ситуацию редиректа для категории
            $category_redir = $this->model_catalog_category->getCategoryRedirect($this->request->get['path']);

            if ($category_redir) {
                // Редирект на другую категорию
                $this->response->redirect($this->url->link('product/category', 'path='.$category_redir['redirect']),301);
                // die();
            }

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);
			//$first_category_id = reset($parts);

			$category_id = (int)array_pop($parts);
			$data['category_id'] = $category_id;
			$main_category_name ='';

			foreach ($parts as $key => $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path)
					);
				}
				if($key==0){
					$main_category_name = $category_info['name'];
				}
			}
//echo '<br/>Время выполнения скрипта 2: '.round(microtime(true) - $start, 4).' сек.';
			// Set the last category breadcrumb
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
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

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['breadcrumbs'][] = array(
					'text' => $category_info['name'],
					'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url)
				);
			}
		}

		/*$data['category_name'] ='';
		if(isset($category_info['name']))$data['category_name'] = $category_info['name'];*/
        $data['category_info'] = array();
        if(array_key_exists(count($data['breadcrumbs'])-1,$data['breadcrumbs'])){
            $data['category_info'] = $data['breadcrumbs'][count($data['breadcrumbs'])-1];
        }


//echo '<br/>Время выполнения скрипта 3: '.round(microtime(true) - $start, 4).' сек.';
		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';

			if (isset($this->request->get['search'])) {
                            $url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
                            $url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
                            $url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
                            $url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
                            $url .= '&sub_category=' . $this->request->get['sub_category'];
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
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('product/search', $url)
			);
		}

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}


		$this->load->model('catalog/product');
		$this->load->model('extension/news');
		//echo '<br/>Время выполнения скрипта 4: '.round(microtime(true) - $start, 4).' сек.';
		$product_info = $this->model_catalog_product->getProduct($product_id);

		$this->session->data['products_ids'] = "'".$product_info['product_id']."'"; // для Google ремаркетинга

		if ($product_info) {

            // Переадресация на категорию (если товар неактивен)
            /*if ($product_info['status']==0) {
                $this->response->redirect($this->url->link('product/category', 'path='.$product_info['category']), 301);
            }*/

            $product_docs = $this->model_catalog_product->getProductDocList($product_info['upc']);

			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			/*if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}*/

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
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
				'text' => $product_info['name'],
				'href' => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id'])
			);

            $titleAdd = $this->language->get('titleAdd');

            $descAdd = $this->language->get('descAdd');

            /*if (isset($this->request->get['admin'])) {
            	echo $product_info['meta_title'];
            }*/

			if ($product_info['meta_title']) {
				$this->document->setTitle($product_info['meta_title']);
			} else {
                $clen=mb_strlen($product_info['name']);

                $this->document->setTitle($product_info['name'].' '.$this->selstrlen($titleAdd, 59-$clen));
			    // $this->document->setTitle(sprintf($this->language->get('text_seo_title'), $product_info['name']));
			}

			//echo '<br/>Время выполнения скрипта 5: '.round(microtime(true) - $start, 4).' сек.';

	      if ($product_info['meta_description']) {
	            $this->document->setDescription($product_info['meta_description']);
	      } else {
	            $clen=mb_strlen($product_info['name']);
	            $this->document->setDescription($product_info['name'].' '.$this->selstrlen($descAdd, 159-$clen));
	            // $this->document->setDescription(sprintf($this->language->get('text_seo_description'), $product_info['name']));
	      }

		  if ($product_info['meta_keyword']) {
	          $this->document->setKeywords($product_info['meta_keyword']);
	      } else {
	          $this->document->setKeywords(vsprintf($this->language->get('text_seo_keywords'), array_fill(0, 5, $product_info['name'])));
	      }

			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');

			if ($product_info['meta_h1']) {
				$data['heading_title'] = str_replace("\n",'',$product_info['meta_h1']);
			} else {
				$data['heading_title'] = str_replace("\n",'',$product_info['name']);
			}



			$data['text_write2'] = $this->language->get('text_write2');
			$data['button_send_r'] = $this->language->get('button_send_r');
			// seoshild
                $cat_info = $this->model_catalog_category->getCategory($category_id);
                /*if($cat_info['meta_h1']){
                    $title = trim($data['heading_title'])." купить в Киеве, ".trim(mb_strtolower($cat_info['meta_h1']))." в каталоге интернет магазина товаров для офиса prote.ua";
                    $description = trim($data['heading_title'])." с доставкой в Киеве 🚚 ".trim(mb_strtolower($cat_info['meta_h1']))." цена в Харькове, Одессе и Днепре - в каталоге интернет магазина офисных товаров ★ prote.ua ★";
                } else{
                    $title = trim($data['heading_title'])." купить в Киеве, ".trim(mb_strtolower($cat_info['name']))." в каталоге интернет магазина товаров для офиса prote.ua";
                    $description = trim($data['heading_title'])." с доставкой в Киеве 🚚 ".trim(mb_strtolower($cat_info['name']))." цена в Харькове, Одессе и Днепре - в каталоге интернет магазина офисных товаров ★ prote.ua ★";
                } */

                $title = sprintf(
                	$this->language->get('text_title_seoshild'),
                	trim($data['heading_title']),
                	trim(mb_strtolower(($cat_info['meta_h1'])?$cat_info['meta_h1']:$cat_info['name']))
                );
                $description = sprintf(
                	$this->language->get('text_description_seoshild'),
                	trim($data['heading_title']),
                	trim(mb_strtolower(($cat_info['meta_h1'])?$cat_info['meta_h1']:$cat_info['name']))
                );

                $this->document->setTitle($title);
                $this->document->setDescription($description);
            // end seoshild

			$data['text_select'] = $this->language->get('text_select');
			//$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_reward'] = $this->language->get('text_reward');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_stock'] = $this->language->get('text_stock');
			$data['text_discount'] = $this->language->get('text_discount');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_option'] = $this->language->get('text_option');
			$data['text_minimum2'] = $this->language->get('text_minimum2');
			$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$data['text_write'] = $this->language->get('text_write');
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
			$data['text_note'] = $this->language->get('text_note');
			$data['text_tags'] = $this->language->get('text_tags');
			$data['text_related'] = $this->language->get('text_related');
			$data['text_payment_recurring'] = $this->language->get('text_payment_recurring');
			$data['text_loading'] = $this->language->get('text_loading');
			$data['text_info'] = $this->language->get('text_info');

			$data['text_tab_video'] = $this->language->get('text_tab_video');
			$data['text_tab_shipping'] = $this->language->get('text_tab_shipping');
			$data['text_tab_payment'] = $this->language->get('text_tab_payment');
			$data['text_tab_contacts'] = $this->language->get('text_tab_contacts');
			$data['text_info_shipping'] = $this->language->get('text_info_shipping');
			$data['text_info_payment'] = $this->language->get('text_info_payment');
			$data['text_info_contacts'] = $this->language->get('text_info_contacts');


			$data['text_exist'] = $this->language->get('text_exist');
			$data['text_preorder'] = $this->language->get('text_preorder');
			$data['text_noexist'] = $this->language->get('text_noexist');
			$data['text_wait'] = $this->language->get('text_wait');
			      $data['text_inkrec'] = $this->language->get('text_inkrec');
			$data['text_cartcom'] = $this->language->get('text_cartcom');
			//$data['text_circom'] = $this->language->get('text_circom');
			//$data['text_prncom'] = $this->language->get('text_prncom');
			//$data['text_inkcom'] = $this->language->get('text_inkcom');
			//$data['text_inkrec'] = $this->language->get('text_inkrec');
			//$data['text_toncom'] = $this->language->get('text_toncom');
			$data['text_selaltpack'] = $this->language->get('text_selaltpack');
			$data['text_selaltcolor'] = $this->language->get('text_selaltcolor');

			$data['text_populairprod'] = $this->language->get('text_populairprod');
			$data['text_freedelivery'] = $this->language->get('text_freedelivery');
			$data['text_freedeliverytip'] = $this->language->get('text_freedeliverytip');
			$data['text_freedeliverykievtip'] = $this->language->get('text_freedeliverykievtip');
			$data['text_yourpricetip'] = $this->language->get('text_yourpricetip');
			$data['text_action'] = $this->language->get('text_action');
			$data['text_action_more'] = $this->language->get('text_action_more');
			$data['text_action_pextra'] = $this->language->get('text_action_pextra');
			$data['text_action_pextra_tip'] = $this->language->get('text_action_pextra_tip');
            $data['text_freedelivery_paid'] = $this->language->get('text_freedelivery_paid');

		$data['entry_qty'] = $this->language->get('entry_qty');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_review'] = $this->language->get('entry_review');
		$data['entry_rating'] = $this->language->get('entry_rating');
		$data['entry_good'] = $this->language->get('entry_good');
		$data['entry_bad'] = $this->language->get('entry_bad');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
  		$data['button_cartone'] = $this->language->get('button_cartone');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_continue'] = $this->language->get('button_continue');

		$this->load->model('catalog/review');

		$data['tab_description'] = $this->language->get('tab_description');
		$data['tab_attribute'] = $this->language->get('tab_attribute');
  		$data['tab_docs'] = $this->language->get('tab_docs');
		$data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

		$data['product_id'] = (int)$this->request->get['product_id'];


		$data['model'] = $product_info['model'];
		$data['reward'] = $product_info['reward'];
		$data['points'] = $product_info['points'];
      $data['sku']    = $product_info['sku'];
      $data['jan']    = $product_info['jan'];
      $data['news']    = $product_info['news'];
      $data['tag']    = html_entity_decode(str_ireplace('{TITLE}', $product_info['name'], $product_info['tag']), ENT_QUOTES, 'UTF-8');
      $data['description'] = html_entity_decode(str_ireplace('{TITLE}', $product_info['name'], $product_info['description']), ENT_QUOTES, 'UTF-8');
      $data['description'] = str_ireplace('prote.com.ua', 'prote.ua',$data['description']);
      $data['description'] = str_ireplace('http://', 'https://',$data['description']);

	  $data['description'] = preg_replace('#<a.*>.*</a>#USi', '', $data['description']);
      $data['ax_description'] = html_entity_decode(str_ireplace('{TITLE}', $product_info['name'], $product_info['ax_description']), ENT_QUOTES, 'UTF-8');
      $data['ax_description'] = str_ireplace('prote.com.ua', 'prote.ua',$data['ax_description']);
      $data['ax_description'] = str_ireplace('http://', 'https://',$data['ax_description']);
	  $data['ax_description'] = str_ireplace('href="https://patronservice', 'rel="nofollow" href="https://patronservice',$data['ax_description']);
      $data['ifexist'] = $product_info['ifexist'];
      $data['has_free_delivery'] = $product_info['has_free_delivery'];

      //0 есть в наличии - 1 под заказ - 2 ожидается - 3 нет в наличии
      $data['availability']='';
      if($data['ifexist']==0){
      	$data['availability'] = 'https://schema.org/InStock';
      	//$data['availability'] = 'in stock';
      } elseif($data['ifexist']==1){
      	$data['availability'] = 'https://schema.org/PreOrder';
      	//$data['availability'] = 'preorder';
      } elseif($data['ifexist']==2){
      	$data['availability'] = 'https://schema.org/OutOfStock';
      	//$data['availability'] = 'out of stock';
      } elseif($data['ifexist']==3){
		$data['availability'] = 'https://schema.org/OutOfStock';
		//$data['availability'] = 'out of stock';
      }
        // echo $product_info['ax_description'];
        // Формирование инвариантного текста (по шаблону)
      $matches=array();
      $descripstr=$data['ax_description'];
      if (preg_match_all('/\{#.*?#}/', $descripstr, $matches, PREG_OFFSET_CAPTURE)) {
          // Порядковый номер (псевдослучайный) последняя цифра кода 1С + 1
          $pnum = substr($product_info['model'],-1)+1;    // echo $product_info['model']; echo $pnum;
          foreach (array_reverse($matches[0]) as $val) {
              //
              $variants = explode('|', trim($val[0],' {}#'));    // print_r($variants);
              $nvariant = ceil(count($variants)*$pnum/10)-1;    // echo $nvariant; echo count($variants);
              $descripstr = substr_replace($descripstr, $variants[$nvariant], $val[1], strlen($val[0]));
          }
          $data['ax_description']=$descripstr;
      }


// echo $data['ax_description'];
//echo '<br/>Время выполнения скрипта 6: '.round(microtime(true) - $start, 4).' сек.';
        if ($product_info['quantity'] <= 0) {
            $data['stock'] = $product_info['stock_status'];
        } elseif ($this->config->get('config_stock_display')) {
                $data['stock'] = $product_info['quantity'];
        } else {
            $data['stock'] = $this->language->get('text_instock');
        }

        $data['quantity'] = $product_info['quantity'];

        $this->load->model('tool/image');

			$data['images'] = array();

		    $results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
			foreach ($results as $result) {
		        if($result['image']) {
					$data['images'][] = array(
						'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
						'thumb' => $this->model_tool_image->resize($result['image'], 375,375),
		          		'additional' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height')),
						);
		        }
			}

			if(empty($data['images'])) {
				if ($product_info['image']) {
			        $data['images'][] = array(
		  				'popup' => $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
		  				'thumb' => $this->model_tool_image->resize($product_info['image'], 375,375),
		            	'additional' => $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
					);
			    }

			}

		    if (count($data['images'])==0) {
		        $data['images'][] = array(
		  			'popup' => $this->model_tool_image->resize('no-photo-img.png', $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
		  			'thumb' => $this->model_tool_image->resize('no-photo-img.png', 375,375),
		            'additional' => $this->model_tool_image->resize('no-photo-img.png', $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
				);
		    }

		      // Замена превью на первую картинку из галереи... 22.03.2016 16:54:20 - игорь
		      $data['popup'] = $data['images'][0]['popup'];
		      $data['thumb'] = $data['images'][0]['thumb'];
		      $data['additional'] = $data['images'][0]['additional'];

		      $this->document->setOgImage($data['thumb']);


			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$data['price'] = false;
			}

			//echo '<br/>Время выполнения скрипта 7: '.round(microtime(true) - $start, 4).' сек.';
			if ((float)$product_info['special']) {
				$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$data['special'] = false;
			}

			$data['price_float'] = round($product_info['price'],2);
			$data['special_float'] = round($product_info['special'],2);
			$data['price_int'] = round($product_info['price'],0);
			$data['special_int'] = round($product_info['special'],0);
			// получаем цену для определнных товаров на верную пятницу
			if(isset($this->session->data['products_pjatnica']) && array_key_exists($product_id,$this->session->data['products_pjatnica'])) {
				$data['special'] =  $this->currency->format($this->tax->calculate($this->session->data['products_pjatnica'][$product_id], $product_info['tax_class_id'], $this->config->get('config_tax')));
			}

			//echo '<br/>Время выполнения скрипта 9: '.round(microtime(true) - $start, 4).' сек.';
			if ($product_info['minimum']) {
				$data['minimum'] = $product_info['minimum'];
			} else {
				$data['minimum'] = 1;
			}
			if ($product_info['video']) {
				$data['video'] = html_entity_decode($product_info['video'], ENT_QUOTES, 'UTF-8');
			} else {
				$data['video'] = '';
			}

			$data['review_status'] = $this->config->get('config_review_status');

			if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
				$data['review_guest'] = true;
			} else {
				$data['review_guest'] = false;
			}

			/*if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}*/

			$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			$data['rating'] = (int)$product_info['rating'];

			/////////////
            /// // Рекоммендации Волохи получаем отзывы для структуры документа
            $this->load->model('catalog/review');
            $data['reviewss'] = array();
            //$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

            $results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], 0, 100);

            foreach ($results as $result) {
                $data['reviewss'][] = array(
                    'author'     => $result['author'],
                    'text'       => nl2br($result['text']),
                    'rating'     => (int)$result['rating'],
                    //'date_added' => date($this->language->get('datetime_format'), strtotime($result['date_added']))
                    'date_added' => date('Y-m-d', strtotime($result['date_added']))
                );
            }

			/////////////


			// Captcha
			/*if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'));
			} else {
				$data['captcha'] = '';
			}*/

			$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
			$data['brand']=false;

			$data['attr_17873'] = false;// Возможна заправка картриджа
			$data['attr_17867'] = false;//Доступность неоригинальных картриджей
			$data['attr_17870'] = false;//Доступность неоригинальных чернил

			$data['category_id'] = $category_id;
			//vdump($category_id);
			$data['attributs'] = array();
			//$add_name = '';
			foreach ($data['attribute_groups'] as $key1 => &$attributes) {

				foreach ($attributes['attribute'] as $key2 => &$attribute) {
					// Бренд=4949; Производитель=1
					/*if(($category_id=='31'||$category_id=='21') &&$attribute['attribute_id']==13 &&($attribute['text']=='Совместимый'||$attribute['text']=='Сумісний')){
					    $data['heading_title'] .= ' аналог';
					}*/
                    if(!is_null($attribute['filter_id'])){
                        $attribute['href'] =$this->url->link('product/category', 'path=' .$this->request->get['path'].'&bfilter=f'. $attribute['attribute_id'].':'. $attribute['filter_id'].';');
                    } else {
                        $attribute['href'] ='';
                    }

                    if($attribute['attribute_id']==4949 || $attribute['attribute_id']==1){
					    //vdump($attribute);
						$data['brand']['text'] = $attribute['text'];
                        $data['brand']['href'] = $attribute['href'];
						unset($data['attribute_groups'][$key1]['attribute'][$key2]);
						//break;
					}
					//vdump($attribute);
					if($attribute['attribute_id']==17873&&($attribute['text']=='Да'||$attribute['text']=='Так')){// Возможна заправка картриджа
                        if($category_id==89 || $category_id==81){
                            $data['attributs']['17873'] = array(
                                'image' => 'image/catalog/ico_attr/kart-mozhno-zaprav.svg',
                                'text' => $this->language->get('text_attribute_17873')
                            );
                        } else if($category_id==88 || $category_id==82){
                            $data['attributs']['17873'] = array(
                                'image' => 'image/catalog/ico_attr/kart-mozhno-zaprav.svg',
                                'text' => $this->language->get('text_attribute_17873')
                            );
                        }
                    } elseif($attribute['attribute_id']==17867&&($attribute['text']=='Доступны'||$attribute['text']=='Доступні')){ //Доступность неоригинальных картриджей
                        if($category_id==89 || $category_id==81){
                            $data['attributs']['17867'] = array(
                                'image' => 'image/catalog/ico_attr/dostupnyy-neorig-ink-cartr.svg',
                                'text' => $this->language->get('text_attribute_17867')
                            );
                        } else if($category_id==88 || $category_id==82){
                            $data['attributs']['17867'] = array(
                                'image' => 'image/catalog/ico_attr/dostupnyy-neorig-laz-cartr.svg',
                                'text' => $this->language->get('text_attribute_17867')
                            );
                        }
                    } elseif($attribute['attribute_id']==17870&&($attribute['text']=='Доступны'||$attribute['text']=='Доступні')){ //Доступность неоригинальных чернил
                        $data['attributs']['17870'] = array(
                                'image' => 'image/catalog/ico_attr/ink-drops-neorig-chornyla.svg',
                                'text' => $this->language->get('text_attribute_17870')
                            );
                    }

				}

				if($data['brand'])break;
			}

	        //************************************************************
	        // gdemon по просьбе Мохонько
	        //получаем товары для блока "Вместе с этим товаром покупают"
	        $mas_featured = $this->get_featured_from_bfilter();

	        $data['featured'] = array();
	        //echo $product_id;
	        foreach ($mas_featured as $key => $value) {
	        	//разбираем фильтр
	        	$value = $this->explode_bfiler($value);
	        	if(!isset($value['filter_id']) || !isset($value['category_id']) )continue;

	        	if($value['category_id']==$category_id){
					$mas_filter_id = explode(',', $value['filter_id']);
					$tmp_sql = " AND (";
					foreach ($mas_filter_id as $k => $val) {
						if($k>0) {$tmp_sql .= " OR";}
						$tmp_sql .= " pf.filter_id ='".$val."'";
					}
					$tmp_sql .= ")";
	        		$sql = "SELECT *  FROM `oc_product_filter` pf LEFT JOIN `oc_filter` f ON (pf.filter_id = f.filter_id) WHERE `product_id` = ".$product_id." AND filter_group_id='".$value['filter_group_id']."' ". $tmp_sql;
            		$query = $this->db->query($sql);

            		if($query->num_rows) {
            			// ищем товары в с фильтрами

            			$results = $this->find_product_in_filer($value);
						// получаем товары
						if($results){
							$data['featured'] = $this->get_products($results);
						}

						break;
					}

	        	}


	        }

	        //если не нашли в масиве с фильтрами продолжаем поиск рекомендуемых в масиве без фильтров
	        if(empty($data['featured'])){
	        	$mas_featured = $this->get_featured();
		        //$mas_featured = $this->get_featured();
		        $data['featured'] = array();
		        //if($product_id==29866){
		        foreach ($mas_featured as $key => $value) {
		        	//разбираем фильтр
		        	$value = $this->explode_bfiler($value);
		        	if(isset($value['category_id'])&&$value['category_id']==$category_id){
            			// ищем товары в с фильтрами
            			//$results = $this->find_product_in_filer($value);
            			$results = $this->find_product_in_filer($value);
						// получаем товары
						if($results){
							$data['featured'] = $this->get_products($results);
						}
						break;
		        	}

		        }

	        }
	        //vdump($data['featured']);


	        //************************************************************


			//$data['products'] = array();

			/*$results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);

			//echo '<br/>Время выполнения скрипта 10: '.round(microtime(true) - $start, 4).' сек.';
			foreach ($results as $result) {
                // **********************
                // file_put_contents( '/var/www/prote.com.ua/l.log', $result['image'], FILE_APPEND);
				if ($result['image'] && file_exists('/var/www/prote.com.ua/image/' . $result['image'] )) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}
				$price_float = round($result['price'],2);
				$special_float = round($result['special'],2);

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'price_float'  => $price_float,
					'special_float'=> $special_float,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}*/

		      /*if($results = $this->model_catalog_product->getProductCompabilityList($this->request->get['product_id'])) {  //,'/INK(rec)'
		           //  print_r($results);
		           foreach ($results as &$result) {
		              foreach ($result as &$result0) {
		                 $result0['href']=$this->url->link('product/product', 'product_id=' . $result0['child_product_id']);

		              }
		           }
		            $data['productsCompability'] = $results;
		            // 2018.11.08 отключил по просьбе Наташи
		            unset($data['productsCompability']['_INK_rec_']); // Рекомендуемые чернила
		            unset($data['productsCompability']['_INK']); //Применимость чернил
		            ////////////////////////
		      }
		      */


	      // SEO перелинковка
      	  // gdemon отключил по просьбе Наташи 25.03.2019
	      /*$landing_page=$_SERVER['REQUEST_URI'];
	      $ldata=$this->model_catalog_product->getSEOInterlonkData($landing_page);
	      $interlink='';
	      if (count($ldata->rows)!=0) {
	        foreach ($ldata->rows as $val) {
	           $interlink .= '<li><a href="' . $val['link'] . '">' . $val['title'] . '</a>';
	        }
	      }
	      $data['interlink']=$interlink;*/

		//$data['recurrings'] = $this->model_catalog_product->getProfiles($this->request->get['product_id']);

		//$this->model_catalog_product->updateViewed($this->request->get['product_id']);

        // Для чернил - альтернативная фасовка и цвета
		$data['altpack'] = array();
		$data['altcolors'] = array();
		$data['altpack_color_Canon'] = array();

        if ($category_id==22) {

            // прописали вручную для некоторых картриджей Canon и Epson
            $get_array_altpacking_altcolor = $this->get_array_altpacking_altcolor($product_info['mpn']);

            $text_colors = $this->language->get('text_colors');
			//vdump($text_colors);
	        if(array_key_exists($product_info['mpn'],$get_array_altpacking_altcolor)){
            	$data['altpack_color_Canon'] = $this->model_catalog_product->get_altpacking_altcolor_Canon($get_array_altpacking_altcolor[$product_info['mpn']]);
            	foreach ($data['altpack_color_Canon'] as $key1 => $pack) {
	            	foreach ($pack as $key2 => $val) {
	            		if(array_key_exists(trim($val['color']), $text_colors)){
		            		$data['altpack_color_Canon'][$key1][$key2]['color_name'] = $text_colors[$val['color']];
		            	} else {
		            		$data['altpack_color_Canon'][$key1][$key2]['color_name'] = $val['color'];
		            	}
	            	}
            	}
            	//vdump($data['altpack_color_Canon']);
            } else {
            	$multicolors = array('blackpigment-cyan-magenta-yellow','black-cyan-magenta-yellow','blackpigment-b-c-m-y-grey','blackpigment-b-c-m-y');

	            $data['altpack'] = $this->model_catalog_product->getAltPacking($product_info['mpn']);
	            $data['altcolors'] = $this->model_catalog_product->getAltColors($product_info['mpn']);

	            //vdump($text_colors);
	            $data['text_multicolor'] = $this->language->get('text_multicolor');
	            foreach ($data['altcolors'] as $key => $val) {

	            	if(!isset($val['color'])){
	            		unset($data['altcolors'][$key]);
	            	} else {

	            		$val['color'] = str_replace($multicolors,'b-c-m-y',$val['color']);
	            		$data['altcolors'][$key]['color'] = $val['color'];

		            	if(array_key_exists(trim($val['color']), $text_colors)){
		            		$data['altcolors'][$key]['color_name'] = $text_colors[$val['color']];
		            	} else {
		            		$data['altcolors'][$key]['color_name'] = $val['color'];
		            	}
	            	}
	            }
            }

        }

  		//echo '<br/>Время выполнения скрипта 14: '.round(microtime(true) - $start, 4).' сек.';
        // Акции (если есть)
        $action =false;
        if ($data['news']) {
            $newslist=  explode(',', $data['news']);
            foreach ($newslist as $news) {
                if (is_numeric($news)) {
                    $action=$this->model_extension_news->getNews($news);
                    if($action){
	                    $action['url']=$this->url->link('extension/news', 'news_id=' . $action['news_id']);
	                    $data['action'][]=$action;
                    }
                }
            }
        }
        //vdump($data['action']);

			// генерируем сео текст
        	$find = array(
				'{h1}',
				'{price}',
				'{category_name}'
			);

			$replace = array(
				'h1' => $data['heading_title'],
				'price'  => $data['price'],
				'category_name'   => $data['breadcrumbs'][count($data['breadcrumbs'])-2]['text']
			);

		  	$seo_text = trim(str_replace($find, $replace, $product_info['seo_text']));
	      	$seo_text =html_entity_decode($seo_text, ENT_QUOTES, 'UTF-8');

	  		$data['seo_text'] ='<div class="shild_text">'.$seo_text.'</div>';

	  		// gdemon 2019.03.26 - для укр.языка заменяем "тонер-картридж" на "тонер картридж"
	  		// также добавляем "для" к слову картридж
	  		if($this->config->get('config_language_id')==2){
	  			$search = array(
	  				"онер-картридж",
	  				"ОНЕР-КАРТРИДЖ",
	  				"Проектор ",
	  				"Корпус ",
	  				"КОРПУС ",
	  				"Веб-камера ",
	  				"ВЕБ-КАМЕРА ",
	  				"Маршрутизатор ",
	  				"Модем ",
	  				"Сканер ",
	  				"Ретранслятор ",
	  				"Адаптер ",
	  				"АДАПТЕР ",
	  				"Презентер ",
	  				"Мультимейкер ",
	  				"LCD панель ",
	  				"Тепловентилятор "
	  			);
	  			$replace = array(
	  				"онер картридж",
	  				"онер картридж",
	  				"Проектор (projektor) ",
	  				"Корпус (case) ",
	  				"Корпус (case) ",
	  				"Веб-камера (webcam) ",
	  				"Веб-камера (webcam) ",
	  				"Маршрутизатор (router) ",
	  				"Модем (modem) ",
	  				"Сканер (scanner) ",
	  				"Ретранслятор (repeater) ",
	  				"Адаптер (adapter) ",
	  				"Адаптер (adapter) ",
	  				"Презентер для проектора ",
	  				"Мультимейкер (бутербродниця) ",
	  				"LCD (РК) панель ",
	  				"Тепловентилятор (обігрівач) "
	  			);
	  			$data['heading_title'] = str_replace($search,$replace, $data['heading_title']);


	  			if (strpos($data['heading_title'], 'для') === false && strpos(strtolower( $data['heading_title']), 'картридж') == 0) {
	  				$search = array("Картридж ","КАРТРИДЖ ","-картридж ","-КАРТРИДЖ ");
		  			$replace = array("Картридж ","Картридж  ","-картридж  ","-картридж ");
					  //$replace = array("Картридж для ","Картридж для ","-картридж для ","-картридж для");
		  			$data['heading_title'] = str_replace($search,$replace, $data['heading_title']);
	  			}
	  			//vdump($data['heading_title']);
	  		}



	  		$this->document->setOgTitle(trim($data['heading_title']));
        	$this->document->setOgDescription('Ищешь '.trim($data['heading_title']).'? Заходи и выбирай прямо сейчас!');

        	$data['readycart'] = $this->url->link('information/readycart', '', 'SSL');
			$data['preorder'] = $this->url->link('information/preorder', '', 'SSL');
			$data['text_button_readycart'] = $this->language->get('text_button_readycart');
			$data['text_button_preorder'] = $this->language->get('text_button_preorder');
			$data['text_button_readycart_desc'] = $this->language->get('text_button_readycart_desc');
			$data['text_button_preorder_desc'] = $this->language->get('text_button_preorder_desc');

			//$data['column_left'] = $this->load->controller('common/column_left');
			//echo '<br/>Время выполнения скрипта column_left: '.round(microtime(true) - $start, 4).' сек.';

			$data['column_right'] = $this->load->controller('common/column_right');
			//echo '<br/>Время выполнения скрипта column_right: '.round(microtime(true) - $start, 4).' сек.';

			$data['content_top'] = $this->load->controller('common/content_top');
			//echo '<br/>Время выполнения скрипта content_top: '.round(microtime(true) - $start, 4).' сек.';

			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			//echo '<br/>Время выполнения скрипта content_bottom: '.round(microtime(true) - $start, 4).' сек.';

      		$data['product_docs']  = $product_docs;
			$data['footer'] = $this->load->controller('common/footer');
			//echo '<br/>Время выполнения скрипта footer: '.round(microtime(true) - $start, 4).' сек.';
			$data['header'] = $this->load->controller('common/header');
			//echo '<br/>Время выполнения скрипта header: '.round(microtime(true) - $start, 4).' сек.';

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/product.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/product/product.tpl', $data));
			}
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			/*if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}*/

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
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
				'href' => $this->url->link('product/product', $url . '&product_id=' . $product_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');
			$data['text_error'] = $this->language->get('text_error');
      		$data['product_docs']  = $product_docs;

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

	public function review() {
		$this->load->language('product/product');

		$this->load->model('catalog/review');

		$data['text_no_reviews'] = $this->language->get('text_no_reviews');


		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['reviews'] = array();


		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);

		foreach ($results as $result) {
			$data['reviews'][] = array(
				'author'     => $result['author'],
				'text'       => nl2br($result['text']),
				'rating'     => (int)$result['rating'],
				'date_added' => date($this->language->get('datetime_format'), strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->text_first = false;
        $pagination->text_last = false;
		$pagination->text_prev = $this->language->get('text_prev');
        $pagination->text_next = $this->language->get('text_next');
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($review_total - 5)) ? $review_total : ((($page - 1) * 5) + 5), $review_total, ceil($review_total / 5));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/review.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/review.tpl', $data));
		}
	}

	public function write() {
		$this->load->language('product/product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error']['name'] = $this->language->get('error_name');
			}

			if ((utf8_strlen($this->request->post['text']) < 2) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error']['text'] = $this->language->get('error_text');
			}

			if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
				$json['error']['rating'] = $this->language->get('error_rating');
			}

			// Captcha
			/*if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$json['error']['captcha'] = $captcha;
				}
			}*/

			if (!isset($json['error'])) {
				$this->load->model('catalog/review');

				$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getRecurringDescription() {
		$this->language->load('product/product');
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->post['recurring_id'])) {
			$recurring_id = $this->request->post['recurring_id'];
		} else {
			$recurring_id = 0;
		}

		if (isset($this->request->post['quantity'])) {
			$quantity = $this->request->post['quantity'];
		} else {
			$quantity = 1;
		}

		$product_info = $this->model_catalog_product->getProduct($product_id);
		$recurring_info = $this->model_catalog_product->getProfile($product_id, $recurring_id);

		$json = array();

		if ($product_info && $recurring_info) {
			if (!$json) {
				$frequencies = array(
					'day'        => $this->language->get('text_day'),
					'week'       => $this->language->get('text_week'),
					'semi_month' => $this->language->get('text_semi_month'),
					'month'      => $this->language->get('text_month'),
					'year'       => $this->language->get('text_year'),
				);

				if ($recurring_info['trial_status'] == 1) {
					$price = $this->currency->format($this->tax->calculate($recurring_info['trial_price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')));
					$trial_text = sprintf($this->language->get('text_trial_description'), $price, $recurring_info['trial_cycle'], $frequencies[$recurring_info['trial_frequency']], $recurring_info['trial_duration']) . ' ';
				} else {
					$trial_text = '';
				}

				$price = $this->currency->format($this->tax->calculate($recurring_info['price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')));

				if ($recurring_info['duration']) {
					$text = $trial_text . sprintf($this->language->get('text_payment_description'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				} else {
					$text = $trial_text . sprintf($this->language->get('text_payment_cancel'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				}

				$json['success'] = $text;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function get_array_altpacking_altcolor($mpn=''){

        $canon_ink['I-BAR-CPGI520-CMP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CPGI520-090-B','I-BAR-CPGI520-090-BP');
        $canon_ink['I-BAR-CPGI520-CMP'][] = array('I-BAR-CPGI520-090-MP');
        $canon_ink['I-BAR-CPGI520-CMP'][] = array('I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CPGI520-180-B','I-BAR-CPGI520-180-BP');
        $canon_ink['I-BAR-CPGI520-CMP'][] = array('I-BAR-CPGI520-180-MP');
        $canon_ink['I-BAR-CPGI520-CMP'][] = array('I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-1-B');
        $canon_ink['I-BAR-CPGI520-CMP'][] = array('I-BAR-CPGI520-18-B');


        //I-BAR-CPG445-CMP
        $canon_ink['I-BAR-CPG445-CMP'] = array(
        'I-BAR-CCL446-090-C' => array(),'I-BAR-CCL446-090-M' => array(),'I-BAR-CCL446-090-Y' => array(),'I-BAR-CPG445-090-B' => array(),'I-BAR-CPG445-090-MP' => array(),
        'I-BAR-CCL446-180-C' => array(),'I-BAR-CCL446-180-M' => array(),'I-BAR-CCL446-180-Y' => array(),'I-BAR-CPG445-180-B' => array(),'I-BAR-CPG445-180-MP' => array(),
        'I-BARE-CCL446-1-C' => array(),'I-BARE-CCL446-1-M' => array(),'I-BARE-CCL446-1-Y' => array(),'I-BARE-CPG445-1-B' => array(),'I-BAR-CCL446-18-C' => array(),
        'I-BAR-CCL446-18-M' => array(),'I-BAR-CCL446-18-Y' => array(),'I-BAR-CPG445-18-B' => array()
        );
        //I-BAR-CU4-CMP
        $canon_ink['I-BAR-CU4-CMP'] = array(
        'I-BAR-CU4-090-B' => array(),'I-BAR-CU4-090-C' => array(),'I-BAR-CU4-090-M' => array(),'I-BAR-CU4-090-Y' => array(),'I-BAR-CU4-090-MP' => array(),
        'I-BAR-CU4-180-B' => array(),'I-BAR-CU4-180-C' => array(),'I-BAR-CU4-180-M' => array(),'I-BAR-CU4-180-Y' => array(),
        //'I-BAR-CU4-180-MP' => array()
        'I-BAR-CU4-1-B' => array(),'I-BAR-CU4-1-C' => array(),'I-BAR-CU4-1-M' => array(),'I-BAR-CU4-1-Y' => array(),
        'I-BARE-CU4-1SP-B' => array(),'I-BARE-CU4-1SP-C' => array(),'I-BARE-CU4-1SP-M' => array(),'I-BARE-CU4-1SP-Y' => array(),
        'I-BAR-CU4-18-B' => array(),'I-BAR-CU4-18-C' => array(),'I-BAR-CU4-18-M' => array(),'I-BAR-CU4-18-Y' => array()
        );
        //I-BAR-EU1-CMP
        $canon_ink['I-BAR-EU1-CMP'] = array(
        'I-BARE-EU1-1SP-B' => array(),'I-BARE-EU1-1SP-C' => array(),'I-BARE-EU1-1SP-M' => array(),'I-BARE-EU1-1SP-Y' => array(),
        'I-BAR-EU1-090-B' => array(),'I-BAR-EU1-090-C' => array(),'I-BAR-EU1-090-M' => array(),'I-BAR-EU1-090-MP' => array(),'I-BAR-EU1-090-Y' => array(),
        'I-BAR-EU1-180-B' => array(),'I-BAR-EU1-180-C' => array(),'I-BAR-EU1-180-M' => array(),'I-BAR-EU1-180-MP' => array(),'I-BAR-EU1-180-Y' => array(),
        'I-BAR-EU1-18-B' => array(),'I-BAR-EU1-18-C' => array(),'I-BAR-EU1-18-M' => array(),'I-BAR-EU1-18-Y' => array(),
        'I-BAR-EU1-1-B' => array(),'I-BAR-EU1-1-C' => array(),'I-BAR-EU1-1-M' => array(),'I-BAR-EU1-1-Y' => array()
        );
        //I-BAR-HU3-CMP
        $canon_ink['I-BAR-HU3-CMP'] = array(
        'I-BAR-HU3-090-B' => array(),'I-BAR-HU3-090-C' => array(),'I-BAR-HU3-090-M' => array(),'I-BAR-HU3-090-MP' => array(),'I-BAR-HU3-090-Y' => array(),
        'I-BAR-HU3-180-B' => array(),'I-BAR-HU3-180-C' => array(),'I-BAR-HU3-180-M' => array(),'I-BAR-HU3-180-MP' => array(),'I-BAR-HU3-180-Y' => array(),
        'I-BAR-HU3-18-B' => array(),'I-BAR-HU3-18-C' => array(),'I-BAR-HU3-18-M' => array(),'I-BAR-HU3-18-Y' => array(),
        'I-BAR-HU3-1-B' => array(),'I-BAR-HU3-1-C' => array(),'I-BAR-HU3-1-M' => array(),'I-BAR-HU3-1-Y' => array()
        );

        $canon_ink['I-BAR-CPGI520-180-B'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CPGI520-090-B','I-BAR-CPGI520-090-BP','I-BAR-CPGI520-090-MP');
		$canon_ink['I-BAR-CPGI520-180-B'][] = array('I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-180-MP');
		$canon_ink['I-BAR-CPGI520-180-B'][] = array('I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-1-B');
		$canon_ink['I-BAR-CPGI520-180-B'][] = array('I-BAR-CPGI520-18-B');

		$canon_ink['I-BAR-CPGI520-180-BP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CPGI520-090-B','I-BAR-CPGI520-090-BP','I-BAR-CPGI520-090-MP');
		$canon_ink['I-BAR-CPGI520-180-BP'][] = array('I-BAR-CPGI520-180-B','I-BAR-CPGI520-180-MP','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y');
		$canon_ink['I-BAR-CPGI520-180-BP'][] = array('I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-1-B');
		$canon_ink['I-BAR-CPGI520-180-BP'][] = array('I-BAR-CPGI520-18-B');

		$canon_ink['I-BAR-CPGI520-090-B'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-B','I-BAR-CPGI520-090-BP','I-BAR-CPGI520-090-MP','I-BAR-CPGI520-180-MP','I-BAR-CPGI520-18-B','I-BAR-CPGI520-1-B');
		$canon_ink['I-BAR-CPGI520-090-BP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-B','I-BAR-CPGI520-090-B','I-BAR-CPGI520-090-MP','I-BAR-CPGI520-180-MP','I-BAR-CPGI520-18-B','I-BAR-CPGI520-1-B');
		$canon_ink['I-BAR-CPGI520-180-MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-B','I-BAR-CPGI520-090-B','I-BAR-CPGI520-090-MP','I-BAR-CPGI520-18-B','I-BAR-CPGI520-1-B');
		$canon_ink['I-BAR-CPGI520-090-MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-B','I-BAR-CPGI520-090-B','I-BAR-CPGI520-180-MP','I-BAR-CPGI520-18-B','I-BAR-CPGI520-1-B');
		$canon_ink['I-BAR-CPG40-180-B'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPG40-090-MP');
		$canon_ink['I-BAR-CPG40-090-B'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y');
		$canon_ink['I-BAR-CPG40-1-B'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPG40-090-MP');
		$canon_ink['I-BAR-CPG40-090-B-P'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPG40-090-B','I-BAR-CPG40-180-B','I-BAR-CPG40-090-MP','I-BAR-CPG40-180-B-P');
		$canon_ink['I-BAR-CPG40-180-B-P'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPG40-090-B','I-BAR-CPG40-180-B','I-BAR-CPG40-090-MP','I-BAR-CPG40-090-B-P');
		$canon_ink['I-BAR-CPGI520-1-B'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-B','I-BAR-CPGI520-090-BP','I-BAR-CPGI520-090-MP','I-BAR-CPGI520-180-MP','I-BAR-CPGI520-18-B','I-BAR-CPGI520-180-B');
		$canon_ink['I-BAR-CPGI520-18-B'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-B','I-BAR-CPGI520-090-BP','I-BAR-CPGI520-090-MP','I-BAR-CPGI520-180-MP','I-BAR-CPGI520-1-B','I-BAR-CPGI520-180-B');
		$canon_ink['I-BAR-CPGI450-5090MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-BP','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-B');
		$canon_ink['I-BAR-CPGI450-6090MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-BP','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-B','I-BAR-CCLI521-090-GY','I-BAR-CCLI521-180-GY');
		$canon_ink['I-BAR-CPGI470-090-BP'][] = array('I-BAR-CCLI471-090-B','I-BAR-CCLI471-090-C','I-BAR-CCLI471-090-GY','I-BAR-CCLI471-090-M','I-BAR-CCLI471-090-Y','I-BAR-CPG470-090-MP');
		$canon_ink['I-BAR-CPG440-090-MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-BP','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-B');
		$canon_ink['I-BAR-CPG510-090-MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-BP');
		$canon_ink['I-BAR-CBCI3-090-MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-B');
		$canon_ink['I-BAR-CPGI5-5-090-MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-BP','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-B');
		$canon_ink['I-BAR-CPG40-090-MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPG40-090-B-P','I-BAR-CPG40-180-B-P');
		$canon_ink['I-BAR-CPGI425-5090MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-BP','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-B');
		$canon_ink['I-BAR-CPGI425-6090MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-BP','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-B','I-BAR-CCLI521-090-GY','I-BAR-CCLI521-180-GY');
		$canon_ink['I-BAR-CPGI425-6090MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-BP','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-B','I-BAR-CCLI521-090-GY','I-BAR-CCLI521-180-GY');
		$canon_ink['I-BAR-CPGI520-5090MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y','I-BAR-CPGI520-180-BP','I-BAR-CPGI520-090-BP','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-B');
		$canon_ink['I-BAR-CPGI520-6090MP'][] = array('I-BAR-CCLI521-090-C','I-BAR-CCLI521-090-M','I-BAR-CCLI521-090-Y','I-BAR-CCLI521-090-GY','I-BAR-CPGI520-090-BP','I-BAR-CCLI521-090-B','I-BAR-CCLI521-180-C','I-BAR-CCLI521-180-M','I-BAR-CCLI521-180-Y','I-BAR-CPGI520-180-BP','I-BAR-CCLI521-180-B','I-BAR-CCLI521-180-GY','I-BAR-CCLI521-1-C','I-BAR-CCLI521-1-M','I-BAR-CCLI521-1-Y');

        return $canon_ink;
    }

    protected function get_featured_from_bfilter(){


    	$mas_featured = array();
    	$mas_featured[] = array(
        	'category_id' => '175','from_bfilter'=>'bfilter=f4497:5238;',
        	//'to_category_id' => '175','to_bfilter' => 'bfilter=f4497:5235;'
        	// отключил 2018,12,06 'to_category_id' => '175','to_bfilter' => 'bfilter=f4497:5235;f4949:7566,7563,7565;'
        	'to_category_id' => '175','to_bfilter' => 'bfilter=f4497:5235;f4949:7566;'
        );
        $mas_featured[] = array(
        	'category_id' => '175','from_bfilter'=>'bfilter=f4497:5235;',
        	//'to_category_id' => '175','to_bfilter' => 'bfilter=f4497:5231;'
        	'to_category_id' => '175','to_bfilter' => 'bfilter=f4497:5238;f4949:7564;'
        );
        $mas_featured[] = array(
        	'category_id' => '175','from_bfilter'=>'bfilter=f4497:5243;',
        	//'to_category_id' => '175','to_bfilter' => 'bfilter=f4497:5238;'
        	'to_category_id' => '175','to_bfilter' => 'bfilter=f4497:5238;f4949:7564;'
        );
        $mas_featured[] = array(
        	'category_id' => '175','from_bfilter'=>'bfilter=f4497:5231;',
        	'to_category_id' => '175','to_bfilter' => 'bfilter=f4497:5235;'
        );
        $mas_featured[] = array(
        	'category_id' => '179','from_bfilter'=>'bfilter=f4437:5494;',
        	//'to_category_id' => '180','to_bfilter' => 'bfilter=f1656:5321;'
        	'to_category_id' => '179','to_bfilter' => 'bfilter=f4437:5494;f4949:7580;'
        );
        $mas_featured[] = array(
        	'category_id' => '178','from_bfilter'=>'bfilter=f1656:5323;',
        	'to_category_id' => '176','to_bfilter' => 'bfilter=f4437:4858;'
        	//'to_category_id' => '176','to_bfilter' => 'bfilter=f4437:4923;f4949:7570,7563;'
        );
        $mas_featured[] = array(
        	'category_id' => '176','from_bfilter'=>'bfilter=f4437:4923;',
        	//'to_category_id' => '180','to_bfilter' => 'bfilter=f1656:5323;'
        	// 2018,12,06 отключил 'to_category_id' => '176','to_bfilter' => 'bfilter=f4437:4858;f4949:7570,7563;'
        	'to_category_id' => '176','to_bfilter' => 'bfilter=f4437:4858;f4949:7570;'
        );
        $mas_featured[] = array(
        	'category_id' => '176','from_bfilter'=>'bfilter=f4437:4858;',
        	//'to_category_id' => '176','to_bfilter' => 'bfilter=f4437:4923;'
        	// 2018,12,06 отключил 'to_category_id' => '176','to_bfilter' => 'bfilter=f4437:4923;f4949:7570,7563;'
        	'to_category_id' => '176','to_bfilter' => 'bfilter=f4437:4858;f4949:7570;'
        );
        $mas_featured[] = array(
        	'category_id' => '179','from_bfilter'=>'bfilter=f4437:4862;',
        	//'to_category_id' => '179','to_bfilter' => 'bfilter=f4437:5494;'
        	'to_category_id' => '179','to_bfilter' => 'bfilter=f4437:5494;f4949:7580;'
        );
        $mas_featured[] = array(
        	'category_id' => '180','from_bfilter'=>'bfilter=f1656:5321;',
        	'to_category_id' => '179','to_bfilter' => 'bfilter=f4437:5494;'
        );
        $mas_featured[] = array(
        	'category_id' => '180','from_bfilter'=>'bfilter=f1656:5323;',
        	'to_category_id' => '176','to_bfilter' => 'bfilter=f4437:4923;f4949:7570,7563;'
        );
        $mas_featured[] = array(
        	'category_id' => '180','from_bfilter'=>'bfilter=f1656:5324;',
        	'to_category_id' => '180','to_bfilter' => 'bfilter=f1656:5322;'
        );
        $mas_featured[] = array(
        	'category_id' => '180','from_bfilter'=>'bfilter=f1656:5322;',
        	'to_category_id' => '180','to_bfilter' => 'bfilter=f1656:5324;'
        );
        $mas_featured[] = array(
        	'category_id' => '84','from_bfilter'=>'bfilter=f1285:9837;',
        	'to_category_id' => '84','to_bfilter' => 'bfilter=f1285:879;'
        );
        $mas_featured[] = array('category_id' => '176','from_bfilter'=>'bfilter=f4437:7522;','to_category_id' => '189');
		$mas_featured[] = array(
			'category_id' => '178','from_bfilter'=>'bfilter=f4437:4934;',
			'to_category_id' => '178','to_bfilter' => 'bfilter=f4437:7493,4935;');
        $mas_featured[] = array(
        	'category_id' => '178','from_bfilter'=>'bfilter=f4437:7493,4935;',
        	'to_category_id' => '178','to_bfilter' => 'bfilter=f4437:4934;');
		$mas_featured[] = array(
        	'category_id' => '180','from_bfilter'=>'bfilter=f1656:5326;',
        	'to_category_id' => '190');
 		$mas_featured[] = array(
        	'category_id' => '181','from_bfilter'=>'bfilter=f4437:5289;',
        	'to_category_id' => '185');
 		$mas_featured[] = array(
        	'category_id' => '181','from_bfilter'=>'bfilter=f4437:5292;',
        	'to_category_id' => '186');
 		$mas_featured[] = array(
        	'category_id' => '181','from_bfilter'=>'bfilter=f4437:5290;',
        	'to_category_id' => '175','to_bfilter' => 'bfilter=f4497:5235;');
 		$mas_featured[] = array(
        	'category_id' => '177','from_bfilter'=>'bfilter=f1656:4927;',
        	'to_category_id' => '186');
		$mas_featured[] = array(
        	'category_id' => '177','from_bfilter'=>'bfilter=f1656:4929;',
        	'to_category_id' => '189','to_bfilter' => 'bfilter=f1120:5387;');
		$mas_featured[] = array(
        	'category_id' => '57',
        	'to_category_id' => '73','to_bfilter' => 'bfilter=f59:835,834;');
		$mas_featured[] = array(
        	'category_id' => '84','from_bfilter'=>'bfilter=f1285:879;',
        	'to_category_id' => '84','to_bfilter' => 'bfilter=f1285:9837;');
		$mas_featured[] = array(
        	'category_id' => '84','from_bfilter'=>'bfilter=f1285:9837;',
        	'to_category_id' => '84','to_bfilter' => 'bfilter=f1285:879;'
        );
         return $mas_featured;
    }
    protected function get_featured(){

        $mas_featured[] = array('category_id' => '53','to_category_id' => '170');
        $mas_featured[] = array('category_id' => '55','to_category_id' => '128');
        $mas_featured[] = array('category_id' => '56','to_category_id' => '273');

        $mas_featured[] = array('category_id' => '126','to_category_id' => '157');
        $mas_featured[] = array('category_id' => '127','to_category_id' => '163');
        //$mas_featured[] = array('category_id' => '128','to_category_id' => '55');
        $mas_featured[] = array('category_id' => '128','to_category_id' => '55','to_bfilter' => 'bfilter=f1:10359;');
        $mas_featured[] = array('category_id' => '129','to_category_id' => '148');
        $mas_featured[] = array('category_id' => '130','to_category_id' => '162','to_bfilter' => 'bfilter=f2428:4751;');
        $mas_featured[] = array('category_id' => '131','to_category_id' => '207');
        $mas_featured[] = array('category_id' => '132','to_category_id' => '155');
        $mas_featured[] = array('category_id' => '133','to_category_id' => '149');
        $mas_featured[] = array('category_id' => '134','to_category_id' => '205');
        $mas_featured[] = array('category_id' => '135','to_category_id' => '153');
        $mas_featured[] = array('category_id' => '136','to_category_id' => '163');
        $mas_featured[] = array('category_id' => '138','to_category_id' => '165','to_bfilter' => 'bfilter=f2484:8576;');
        $mas_featured[] = array('category_id' => '137','to_category_id' => '152');
        $mas_featured[] = array('category_id' => '139','to_category_id' => '153');
        $mas_featured[] = array('category_id' => '140','to_category_id' => '144');
        $mas_featured[] = array('category_id' => '141','to_category_id' => '152');
        $mas_featured[] = array('category_id' => '142','to_category_id' => '83','to_bfilter' => 'bfilter=f1285:876;');
        $mas_featured[] = array('category_id' => '143','to_category_id' => '145');
        $mas_featured[] = array('category_id' => '144','to_category_id' => '140');
        $mas_featured[] = array('category_id' => '145','to_category_id' => '140');
        $mas_featured[] = array('category_id' => '146','to_category_id' => '205','to_bfilter' => 'bfilter=f1120:4843;');

        $mas_featured[] = array('category_id' => '147','to_category_id' => '154');
        $mas_featured[] = array('category_id' => '148','to_category_id' => '136');
        $mas_featured[] = array('category_id' => '149','to_category_id' => '150');
        $mas_featured[] = array('category_id' => '150','to_category_id' => '149');
        $mas_featured[] = array('category_id' => '151','to_category_id' => '143');
        $mas_featured[] = array('category_id' => '152','to_category_id' => '137');
        $mas_featured[] = array('category_id' => '153','to_category_id' => '139');
        $mas_featured[] = array('category_id' => '154','to_category_id' => '158');
        $mas_featured[] = array('category_id' => '155','to_category_id' => '149');
        $mas_featured[] = array('category_id' => '156','to_category_id' => '144');

        $mas_featured[] = array('category_id' => '157','to_category_id' => '126');
        $mas_featured[] = array('category_id' => '158','to_category_id' => '154');
        $mas_featured[] = array('category_id' => '159','to_category_id' => '166');
        $mas_featured[] = array('category_id' => '160','to_category_id' => '167');
        $mas_featured[] = array('category_id' => '161','to_category_id' => '162','to_bfilter' => 'bfilter=f2428:4752;');
        $mas_featured[] = array('category_id' => '162','to_category_id' => '132');
        $mas_featured[] = array('category_id' => '163','to_category_id' => '136');
        $mas_featured[] = array('category_id' => '164','to_category_id' => '205','to_bfilter' => 'bfilter=f1120:4845;');
        $mas_featured[] = array('category_id' => '165','to_category_id' => '170');
        $mas_featured[] = array('category_id' => '166','to_category_id' => '170');
        $mas_featured[] = array('category_id' => '167','to_category_id' => '141');
        $mas_featured[] = array('category_id' => '168','to_category_id' => '141');
        $mas_featured[] = array('category_id' => '169','to_category_id' => '170');
        $mas_featured[] = array('category_id' => '170','to_category_id' => '53','to_bfilter' => 'bfilter=f84:9390,9334,9400;');
        $mas_featured[] = array('category_id' => '171','to_category_id' => '151');
        $mas_featured[] = array('category_id' => '173','to_category_id' => '198','to_bfilter' => 'bfilter=f1120:5352,5351,5355,5354,7973;');
        $mas_featured[] = array('category_id' => '174','to_category_id' => '184','to_bfilter' => 'bfilter=f1120:5360;');
        $mas_featured[] = array('category_id' => '179','to_category_id' => '176','to_bfilter' => 'bfilter=f4949:7570;');
        $mas_featured[] = array('category_id' => '180','to_category_id' => '189');
        $mas_featured[] = array('category_id' => '182','to_category_id' => '199','to_bfilter' => 'bfilter=f1120:8014,8018,8021;');
        $mas_featured[] = array('category_id' => '183','to_category_id' => '198','to_bfilter' => 'bfilter=f1120:5355,5358,5356;');
        $mas_featured[] = array('category_id' => '184','to_category_id' => '189');
        $mas_featured[] = array('category_id' => '185','to_category_id' => '189');
        $mas_featured[] = array('category_id' => '186','to_category_id' => '188','to_bfilter' => 'bfilter=f1120:7901,5385,5386,7898,5383;');
        $mas_featured[] = array('category_id' => '187','to_category_id' => '185');
        $mas_featured[] = array('category_id' => '188','to_category_id' => '189');
        $mas_featured[] = array('category_id' => '189','to_category_id' => '188','to_bfilter' => 'bfilter=f1120:7901,5385,5386,7898,5383;');
        $mas_featured[] = array('category_id' => '190','to_category_id' => '188','to_bfilter' => 'bfilter=f1120:7901,5385,5386,7898,5383;');
        $mas_featured[] = array('category_id' => '191','to_category_id' => '192');
        $mas_featured[] = array('category_id' => '192','to_category_id' => '191');


        $mas_featured[] = array('category_id' => '198','to_category_id' => '173');
        $mas_featured[] = array('category_id' => '199','to_category_id' => '185');
        //$mas_featured[] = array('category_id' => '202','to_category_id' => '134');
        $mas_featured[] = array('category_id' => '202','to_category_id' => '134','to_bfilter' => 'bfilter=f1120:4618;');
        $mas_featured[] = array('category_id' => '203','to_category_id' => '156');
        $mas_featured[] = array('category_id' => '204','to_category_id' => '127','to_bfilter' => 'bfilter=f1120:4528;');
        $mas_featured[] = array('category_id' => '205','to_category_id' => '204');
        $mas_featured[] = array('category_id' => '206','to_category_id' => '211');
        $mas_featured[] = array('category_id' => '207','to_category_id' => '131');
        $mas_featured[] = array('category_id' => '208','to_category_id' => '187');

        $mas_featured[] = array('category_id' => '210','to_category_id' => '169');
        $mas_featured[] = array('category_id' => '211','to_category_id' => '206');
		$mas_featured[] = array('category_id' => '212','to_category_id' => '166');
        $mas_featured[] = array('category_id' => '213','to_category_id' => '93');

        $mas_featured[] = array('category_id' => '270','to_category_id' => '150');
        $mas_featured[] = array('category_id' => '271','to_category_id' => '140');
        $mas_featured[] = array('category_id' => '272','to_category_id' => '167');
        $mas_featured[] = array('category_id' => '273','to_category_id' => '56');

        return $mas_featured;
    }

    protected function explode_bfiler($value){

    	if(isset($value['from_bfilter'])){
    		$from_bfilter = explode('=f', $value['from_bfilter']);
    		$from_bfilter = str_replace(';', '', $from_bfilter[1]);
    		$from_bfilter = explode(':', $from_bfilter);
    		$value['filter_group_id'] = $from_bfilter[0];
    		$value['filter_id'] = $from_bfilter[1];
    	}
    	if(isset($value['to_bfilter'])){

			$from_bfilter = explode('=f', $value['to_bfilter']);
    		$from_bfilter = str_replace(';', '', $from_bfilter[1]);
    		$from_bfilter = explode(':', $from_bfilter);

    		$value['to_filter_group_id'] = $from_bfilter[0];
    		$value['to_filter_id'] = $from_bfilter[1];

    	}
    	return $value;
    }

	protected function get_products($products=false){
		$this->load->model('extension/news');
		$featured = array();
		$ajax=false;
		if(!$products && isset($this->request->get['product_id'])) {
			$products[] = array('product_id'=>$this->request->get['product_id']);
			$ajax=true;
		}

		foreach ($products as $result) {

		    if($ajax) {
				$result  = $this->model_catalog_product->getProduct($result['product_id']);
			}

			if($result['ifexist']!=0)continue;//если не в наличии то пропускаем

			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], 150,150);

			} else {
				$image = $this->model_tool_image->resize('placeholder.png', 150,150);
			}

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {$price = false;}

			if ((float)$result['special']) {
				$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {$special = false;}

			if ($this->config->get('config_tax')) {
				$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
			} else {$tax = false;}

			if ($this->config->get('config_review_status')) {
				$rating = (int)$result['rating'];
			} else {$rating = false;}

			$action=array();
            if ($result['news']) {
                $newslist=  explode(',', $result['news']);
                foreach ($newslist as $news) {
                    $atcion_news = $this->model_extension_news->getNews($news);
                    if($atcion_news){
                        if (is_numeric($news)) $action[]=$atcion_news;
                    }

                }
            }
            $price_float = str_replace(',','.',round($result['price'],2));

			$special_float = round($result['special'],2);

			$featured[] = array(
				'product_id'  => $result['product_id'],
				'thumb'       => $image,
				'name'        => str_replace("\n","",$result['name']),
				'model'        => $result['model'],
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
				'price'       => $price,
				'price_float'  => $price_float,
				'special_float'=> $special_float,
				'special'     => $special,
				'tax'         => $tax,
				'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
				'rating'      => $rating,
				'ifexist'     => $result['ifexist'],
				'quantity'    => $result['quantity'],
				'tag'         => htmlspecialchars($result['tag']),
                'jan'         => $result['jan'],
				'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id']),
				'action'      => $action
			);
		}
		return $featured;
	}

	protected function find_product_in_filer($value){

			if(isset($value['to_bfilter'])){
				$filter_bfilter = true;
			}else{
				$filter_bfilter = false;
			}
			 $filter_data = array(
			 	'filter_category_id'=> $value['to_category_id'],
			 	'filter_filter' => '',
	    		'sort' => 'p.price',
	    		'order' => 'ASC',
	    		'start' => 0,
	    		'limit' => 10,
	    		'filter_bfilter' => $filter_bfilter
			 );
			if($filter_bfilter){
				$str_bfilter = str_replace('bfilter=', '', $value['to_bfilter']);
				$this->load->model('module/brainyfilter');
		        $this->model_module_brainyfilter->_parseBFilterParam($str_bfilter);
		        $this->model_module_brainyfilter->setData($filter_data);
	        }

	        $results = $this->model_catalog_product->getProducts($filter_data);

	        return $results;
	    //}


	}
}