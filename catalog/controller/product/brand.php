<?php
class ControllerProductBrand extends Controller {
    public function index() {

        if(count($this->request->get)==1){
            //$ordercallback_settings['modal_title'] = $this->language->get('modal_title_order');
            $this->load->language('product/brand');
            $data['text_help'] = $this->language->get('text_help');

            $data['breadcrumbs'] = array();
            $data['breadcrumbs'][] = array(
                    'text' => $this->language->get('text_home'),
                    'href' => $this->url->link('common/home')
            );
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_bread'),
                'href' => $this->url->link('product/brand')
            );
            $data['printerbrands'] = $this->load->controller('module/printerbrands');

            $this->load->language('information/html/about_us');
            $data['text_sub_title1'] = $this->language->get('text_sub_title1');
            $langurl=($this->language->get('code')=='uk'?'/ua':'');
            $data['text_sub_text1'] = sprintf($this->language->get('text_sub_text1'),$langurl,$langurl);

            $data['text_sub_title2'] = $this->language->get('text_sub_title2');
            $data['text_sub_text2'] = $this->language->get('text_sub_text2');

            $data['text_sub_title3'] = $this->language->get('text_sub_title3');
            $data['text_sub_text3'] = $this->language->get('text_sub_text3');
            $this->document->setTitle($this->language->get('meta_title'));
            $this->document->setDescription($this->language->get('meta_description'));
            $data['text_bestseller'] = $this->language->get('text_bestseller');
            $data['text_action'] = $this->language->get('text_action');
            $data['text_free_delivery'] = $this->language->get('text_free_delivery');

            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
             if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/brand.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/brand.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/product/brand.tpl', $data));
            }
        } else {
        // Категории
        $a = array(
            array(
                    20 => 'струйные',
                    30 => 'лазерные',
                    40 => 'матричные',
                    50 => 'кассовые',
                    60 => 'картриджи'
                 ),
            array(
                    20 => 'струменеві',
                    30 => 'лазерні',
                    40 => 'матричні',
                    50 => 'касові',
                    60 => 'картриджи'
                 )
            );

        $b = array(
            20 => array('81', '89'),
            30 => array('82', '88'),
            40 => array('96'),
            50 => array('92'),
            60=> array('31')
        );



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
        $data['minimum'] = 1;
        $data['price'] = 0;
        $data['thumb'] = '';
        $data['text_minimum'] = '';
        // **************


        $this->load->language('product/brand');
        $this->load->model('catalog/category');
        $this->load->model('catalog/product');
        $this->load->model('extension/news');
        $this->load->model('tool/image');

        $data['text_action'] = $this->language->get('text_action');
        //vdump($this->request->get);
        if (isset($this->request->get['prn'])) {
            $searchprn = $this->request->get['prn'];
        } else {
            $searchprn = '';
        }

        if (isset($this->request->get['brand_id'])) {
            $searchbrand = str_replace('-',' ', $this->request->get['brand_id']);
            if(isset($this->request->get['tech_id'])){
                $searchcategory = $this->request->get['tech_id'];
            } else {
                $searchcategory = false;
            }
        } else {
            // Найти бренд из названия устройства!!!
            $searchbrand = '';
        }
        if (isset($this->request->get['page'])) {
                $page = $this->request->get['page'];
        } else {
                $page = 1;
        }
        $pageSuff = ($page>1 ? ' - ' . $page . ' ' . $this->language->get('text_page') : '');
        $setTitle=false;
        // Задан критерий - бренд.
        if ($searchbrand) {
            $data['text_in_cat'] = $this->language->get('text_in_cat');

            // Выбор все ПУ бренда
            $prnlist=$this->model_catalog_product->getPrinterCompabilityList($searchbrand, $searchcategory);


            $models = array();
            if($prnlist){
                foreach ($prnlist as $prnitem) {
                    $mfirst = mb_substr($prnitem['title'],0,1);
                    //$prnitem['url']=$this->url->link('product/brand', 'prn=' . $prnitem['absnum'] . '&cat_id=' . $prnitem['cat_id']);
                    $prnitem['url']=$this->url->link('product/brand', 'prn=' . $prnitem['absnum']);
                    $models[$mfirst][]=$prnitem;
                }
            }

            $data['models']=$models;
            //heading_bread

            $data['left_column_brend'] = mb_strtolower($searchbrand);
            $setTitle=false;

            if ($searchbrand!='datecs') {

                //$data['left_column']='<img src="/image/brands/' . str_replace(' ','-', $searchbrand) .'.png" alt="'.$searchbrand.'">';
                $data['left_column']='';
                // echo $this->language->get('code');
                $data['heading_title'] = $this->language->get('heading_bread');

                if(isset($this->request->get['tech_id'])){
                    if($this->request->get['tech_id']=='20'){
                        $data['heading_title'] .= ' для '.$this->language->get('heading_bread_ink') .' ';
                        $this->document->setTitle(sprintf($this->language->get('meta_title_ink'),mb_ucfirst($searchbrand)));
                        $this->document->setDescription(sprintf($this->language->get('meta_description_ink'),mb_ucfirst($searchbrand)));
                    } elseif($this->request->get['tech_id']=='30'){
                        $data['heading_title'] .= ' для '.$this->language->get('heading_bread_laser') .' ';
                        $this->document->setTitle(sprintf($this->language->get('meta_title_laser'),mb_ucfirst($searchbrand)));
                        $this->document->setDescription(sprintf($this->language->get('meta_description_laser'),mb_ucfirst($searchbrand)));
                     } elseif($this->request->get['tech_id']=='60'){
                        $data['heading_title'] .= ' для '.$this->language->get('heading_bread_kart') .' ';
                        $this->document->setTitle(sprintf($this->language->get('meta_title_kart'),mb_ucfirst($searchbrand)));
                        $this->document->setDescription(sprintf($this->language->get('meta_description_laser'),mb_ucfirst($searchbrand)));
                    } else {
                        $data['heading_title'] .= ' для '.$this->language->get('heading_bread_matr') .' ';
                        $this->document->setTitle(sprintf($this->language->get('meta_title_matr'),mb_ucfirst($searchbrand)));
                        $this->document->setDescription(sprintf($this->language->get('meta_description_matr'),mb_ucfirst($searchbrand)));
                        //$meta_description_ink = $this->language->get('heading_bread_matr')

                    }
                    //$this->document->setTitle($data['heading_title'] . $pageSuff . ' | Prote.ua');

                    $setTitle=true;
                }
                $data['heading_title'] .= ' ' . mb_ucfirst($searchbrand);

                // . ' ' . $a[0][$searchcategory] ;
            } else {
                $data['left_column']='';
                // echo $this->language->get('code');


                if(isset($this->request->get['tech_id'])){
                    $data['heading_title'] = $this->language->get('heading_title_b') . ' ' . $a[0][$searchcategory] ;

                    if($this->request->get['tech_id']=='50'){
                        $data['heading_title'] = $this->language->get('heading_title_kassa');
                        $this->document->setTitle($this->language->get('meta_title_kassa'));
                        $this->document->setDescription($this->language->get('meta_description_kassa'));
                        $setTitle=true;
                    } else {
                        $data['heading_title'] .= ' '.$a[$this->config->get('config_language_id')-1][$this->request->get['tech_id']];
                    }

                } else {
                    $data['heading_title'] = $this->language->get('heading_title_kassa') . ' ' . $a[0][$searchcategory] ;
                }
            }

            // Список категорий бренда (лазерніе, струйніе, матричные)
            $data['brand_cat'] = array();
            $type=1;
            $results = $this->model_catalog_product->getPrinterBrandsCats($type);

            foreach ($results as $key=>$val) {

                if(mb_strtolower($key)!=mb_strtolower($searchbrand)) continue;
                $tmpcats=array();
                foreach ($val as $cat=>$catval) {
                    $tmpcats[$cat] = array(
                        //'name' => mb_ucfirst($catval).' '.$this->language->get('text_add_name'),
                        'name' => $catval.' '.$this->language->get('text_add_name'),
                        //'img'  => $this->model_tool_image->resize('/image/brands/' . str_replace(' ','-', strtolower($key)) . '.png',120,120),
                        'href'  => $this->url->link('product/brand', 'brand_id='.str_replace(' ','-', strtolower($key)).'&tech_id='.$cat )
                    );
                }
                $data['brand_cat'] = $tmpcats;

                break;
            }

            $data['searchcategory']=$searchcategory;
            if(!$setTitle){
	           $this->document->setTitle($data['heading_title'] . $pageSuff . ' | Prote.ua');
               $this->document->setDescription($data['heading_title'] . ' ' . $this->language->get('text_description_b') . $pageSuff);
            }

        } elseif ($searchprn) {

            $data['text_in_cat'] = $this->language->get('text_in_cat');
            // Выбор всех товаров к принтеру
            // $a=$this->model_catalog_product->getProductCompabilityList($searchprn,'/P');

            // Данные самого принтера
            $printer_info = $this->model_catalog_product->getProduct($searchprn);

            if(!$printer_info){

                $this->response->redirect($this->url->link('error/not_found'));
            }

            $printer_info['attributes'] = $this->model_catalog_product->getProductAttributes($printer_info['product_id']);
            // если нет фотографии...
            if (!$printer_info['image']) $printer_info['image']='printer-nofoto.png';
            //$data['left_column_brend'] = $printer_info['image'];
            $data['left_column'] = '<img src="/image/' . $printer_info['image'] .'" alt="'.$printer_info['name_short'].'">'.
                '<h3>'.$printer_info['name_short'].'</h3>';

                $this->document->setOgImage($this->model_tool_image->resize($printer_info['image'],180,180));

            // Убираем из названия принтера слова "принтер" и т.д.
            $printer_info['name_short']=str_ireplace(array(
                'МФУ','БФП','ТЕРМОПРИНТЕР','ПРИНТЕР','принтер','СТРУЙНЫЙ','струйный','СТРУМЕНЕВИЙ','струменевий','лазерный','лазерний','ЛАЗЕРНЫЙ','ЛАЗЕРНИЙ','ФИСКАЛЬНЫЙ','ФІСКАЛЬНИЙ','РЕГИСТРАТОР','РЕЄСТРАТОР','ЧЕКОВ','ЧЕКІВ','КАССОВЫЙ','КАСОВИЙ','АППАРАТ','АПАРАТ',
            ),'',$printer_info['name_short'] );
            //vdump($this->request->get);
            if (isset($this->request->get['category_id'])) {
                $category_tmp=$this->model_catalog_category->getCategory($this->request->get['category_id']);
                $data['heading_title'] = $category_tmp['name'] .  ' ' . $printer_info['name_short'];
            } elseif (isset($this->request->get['cat_id'])) {
                if(in_array($this->request->get['cat_id'],array('56','22','23','24', '31')) ){
                    $category_tmp=$this->model_catalog_category->getCategory($this->request->get['cat_id']);
                    $data['heading_title'] = $category_tmp['name'] .  ' ' . $printer_info['name_short'];
                } else {
                	$category_tmp=$this->model_catalog_category->getCategory($this->request->get['cat_id']);
                    $data['heading_title'] = $this->language->get('heading_title_') .  ' ' . $printer_info['name_short'];

                }
                $setTitle = true;

            } else {
                $data['heading_title'] = $this->language->get('heading_title_p') .  ' ' . $printer_info['name_short'];
            }

            $title =$data['heading_title'] .' '.$this->language->get('meta_title_search'). ' '.$pageSuff;
            $description = $data['heading_title'] . ' ' . $this->language->get('meta_description_search') .' '. $pageSuff;

            $this->document->setTitle($title);
            $this->document->setDescription($description);
            $this->document->setKeywords($data['heading_title'] . ' купить, ' . $data['heading_title'] . ' цена');


        }


        if (isset($this->request->get['tag'])) {
                $tag = $this->request->get['tag'];
        } elseif (isset($this->request->get['search'])) {
                $tag = $this->request->get['search'];
        } else {
                $tag = '';
        }

        if (isset($this->request->get['description'])) {
                $description = $this->request->get['description'];
        } else {
                $description = '';
        }

        if (isset($this->request->get['cat_id'])) {
                $category_id = $this->request->get['cat_id'];
        } else {
                $category_id = 0;
        }

        if (isset($this->request->get['sub_category'])) {
                $sub_category = $this->request->get['sub_category'];
        } else {
                $sub_category = '';
        }

        if (isset($this->request->get['sort'])) {
                $sort = $this->request->get['sort'];
        } else {
                $sort = 'p.price';
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

        if (isset($this->request->get['limit'])) {
                $limit = (int)$this->request->get['limit'];
        } else {
            // Если категория ЧЕРНИЛА mk меняем кол-во товаров на страницу - 30шт
            if(isset($this->request->get['cat_id']) && $this->request->get['cat_id'] == 22){
                $limit = 30;
            } else {
                $limit = $this->config->get('config_product_limit');
            }
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_bread'),
            'href' => $this->url->link('product/brand')
        );

        $url = '';

        if (isset($this->request->get['search'])) {
                $url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['brand_id'])) {
            $url .= '&brand_id=' . urlencode(html_entity_decode($this->request->get['brand_id'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['prn'])) {
            $url .= '&prn=' . urlencode(html_entity_decode($this->request->get['prn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['tag'])) {
                $url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['description'])) {
                $url .= '&description=' . $this->request->get['description'];
        }

        if (isset($this->request->get['tech_id'])) {
                $url .= '&tech_id=' . $this->request->get['tech_id'];
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

        //if ($searchprn) {
        if ($searchprn && isset($printer_info['attributes'][0]['attribute'])) {
            // Собираем данные для "хлебной крошки"
            foreach ($printer_info['attributes'][0]['attribute'] as $k=>$val) {
                if ($val['attribute_id']==10) {
                    $searchbrand=  strtolower($val['text']);
                    break;
                }
            }

            foreach ($b as $k=>$v) {
                if (in_array($printer_info['category'],$v)) {
                    $searchcategory=$k;
                    break;
                }
            }
            $data['breadcrumbs'][] = array(
                'text' => $searchbrand,
                //'text' => $searchbrand,
                //'href' => $this->url->link('product/brand', 'brand_id='.str_replace(' ','-', strtolower($searchbrand)).'&tech_id='.$searchcategory )
                'href' => $this->url->link('product/brand', 'brand_id='.str_replace(' ','-', strtolower($searchbrand)))
            );

            $data['breadcrumbs'][] = array(
                //'text' => $data['heading_title'], //$this->language->get('heading_title'),
                'text' => $data['heading_title'],
                'href' => $this->url->link('product/brand', $url)
            );



            /*$data['breadcrumbs'][] = array(
                //'text' => $this->language->get('heading_title_b') .  ' ' . $searchbrand . ' ' . $a[0][$searchcategory],
                //'text' => $searchbrand,
                'text' => $data['heading_title'],
                'href' => $this->url->link('product/brand', 'brand_id='.str_replace(' ','-', strtolower($searchbrand)).'&tech_id='.$searchcategory )
            );*/




        } else {

            $tmp_text=$searchbrand;
            if(isset($this->request->get['tech_id'])){
                $tmp_text = $searchbrand .' '. $a[$this->config->get('config_language_id')-1][$this->request->get['tech_id']];
            }


            $data['breadcrumbs'][] = array(
                //'text' => $data['heading_title'], //$this->language->get('heading_title'),
                'text' => $tmp_text,
                'href' => $this->url->link('product/brand', $url)
            );

        }


            //$seoshild=true;
            //if($seoshild){
        if(!$setTitle){
            $title = $data['heading_title'].' по отличным ценам в Киеве, купить расходники в каталоге интернет магазина товаров для офиса prote.ua';//. $pageSuff;
            $this->document->setTitle($title);
            $meta_descr = $data['heading_title'].'  по лучшим ценам с доставкой в Киеве и по Украине 🚚, большой выбор расходников для принтеров 🖨 в интернет магазине офисных 📌 принадлежностей prote.ua';//. $pageSuff;
            $this->document->setDescription($meta_descr);
        }
            //}

        $data['text_empty'] = $this->language->get('text_empty');
        $data['text_search'] = $this->language->get('text_search');
        $data['text_search_brand'] = $this->language->get('text_search_brand');
        $data['text_search_info']  = $this->language->get('text_search_info');
        $data['text_keyword'] = $this->language->get('text_keyword');
        $data['text_category'] = $this->language->get('text_category');
        $data['text_sub_category'] = $this->language->get('text_sub_category');
        $data['text_quantity'] = $this->language->get('text_quantity');
        $data['text_manufacturer'] = $this->language->get('text_manufacturer');
        $data['text_model'] = $this->language->get('text_model');
        $data['text_price'] = $this->language->get('text_price');
        $data['text_tax'] = $this->language->get('text_tax');
        $data['text_points'] = $this->language->get('text_points');
        $data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
        $data['text_sort'] = $this->language->get('text_sort');
        $data['text_limit'] = $this->language->get('text_limit');
        $data['text_searchtypes'] = $this->language->get('text_searchtypes');
        $data['text_skeyword'] = $this->language->get('text_skeyword');
        $data['text_sprinter'] = $this->language->get('text_sprinter');
        $data['text_sgeneral'] = $this->language->get('text_sgeneral');
        $data['text_resultcat'] = $this->language->get('text_resultcat');
        $data['text_searchcat'] = $this->language->get('text_searchcat');
        $data['text_selbrand'] = $this->language->get('text_selbrand');
        $data['text_selmodel'] = $this->language->get('text_selmodel');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_exist'] = $this->language->get('text_exist');
        $data['text_preorder'] = $this->language->get('text_preorder');
        $data['text_wait'] = $this->language->get('text_wait');
        $data['text_noexist'] = $this->language->get('text_noexist');

        $data['entry_search'] = $this->language->get('entry_search');
        $data['entry_description'] = $this->language->get('entry_description');

        $data['button_search'] = $this->language->get('button_search');
        $data['button_cart'] = $this->language->get('button_cart');
        $data['button_cartone'] = $this->language->get('button_cartone');
        $data['button_wishlist'] = $this->language->get('button_wishlist');
        $data['button_compare'] = $this->language->get('button_compare');
        $data['button_list'] = $this->language->get('button_list');
        $data['button_grid'] = $this->language->get('button_grid');
        $data['text_searchkey'] = $this->language->get('text_searchkey');

        $data['compare'] = $this->url->link('product/compare');

        $url='';
        if(isset($this->request->get['prn'])){
            $url.='&prn='.$this->request->get['prn'];
        }

        $this->load->model('catalog/category');



        $allcatsurl=$this->url->link('product/brand',$url);

        // Список брендов
        $data['brands'] = array();
        $results = $this->model_catalog_product->getPrinterBrands();

        foreach ($results as $result) {
            $data['brands'][] = array(
                'brand' => $result['brand'],
            );
        }

        $data['products'] = array();


        if(!isset($search)){$search='';}

        $filter_data = array(
            'filter_name'         => $search,
            'filter_brand'        => $searchbrand,
            'filter_prn'          => $searchprn,
            'filter_tag'          => $tag,
            'filter_description'  => $description,
            'filter_category_id'  => $category_id,
            'filter_sub_category' => $sub_category,
            'sort'                => $sort,
            'order'               => $order,
            'start'               => ($page - 1) * $limit,
            'limit'               => $limit
        );


        $product_total_cat = array();

        if($searchprn && !$category_id) { // print_r($filter_data);

            $results = array();
            $product_total =0;

            $product_total_cat_prev = $this->model_catalog_product->getProductCompabilityListByAbsnumCats($filter_data);

            foreach ($product_total_cat_prev as $item) {
              $product_total_cat[$item['category_id']]= $item['total'];
            }
            $data['text_view_all'] = $this->language->get('text_view_all');
            $data['text_search_in_cat'] = $this->language->get('text_search_in_cat');

        } else
        if($searchprn) {
            //vdump($filter_data);
            $results = $this->model_catalog_product->getProductCompabilityListByAbsNum($filter_data);

            $product_total = $this->model_catalog_product->getProductCompabilityListByAbsNumTotal($filter_data);

            $product_total_cat_prev = $this->model_catalog_product->getProductCompabilityListByAbsnumCats($filter_data);

            foreach ($product_total_cat_prev as $item) {
              $product_total_cat[$item['category_id']]= $item['total'];
            }

            $data['text_view_all'] = $this->language->get('text_view_all');


        } else if($search) {
            $product_total = $this->model_catalog_product->getTotalProducts($filter_data);

            // Добавляем информацию о категориях
            $product_total_cat_prev = $this->model_catalog_product->getTotalProductsByCategory($filter_data);
            $product_total_cat = array();
            foreach ($product_total_cat_prev as $item) {
              $product_total_cat[$item['category_id']]= $item['total'];
            }

            $results = $this->model_catalog_product->getProducts($filter_data);



        } else {

            $results=array();
            $product_total=0;
            $data['categories'] = null;
        }



        $this->load->model('catalog/category');
        $url='';
        if(isset($this->request->get['prn'])){
            $url.='&prn='.$this->request->get['prn'];
        }

        if($product_total_cat){

            if(isset($product_total_cat['21'])){
                $cat_add = array('53'=>'','51'=>'','73'=>'');
            //} elseif(isset($product_total_cat['31'])){
            } else{
                $cat_add = array('53'=>'','69'=>'','73'=>'');
            }

            $product_total_cat = $product_total_cat + $cat_add;

            foreach ($product_total_cat as $key => $count) {
                $category_info = $this->model_catalog_category->getCategory($key);
                if($count){
                    $href = $this->url->link('product/brand',$url.'&cat_id='.$category_info['category_id']);
                } else {
                    $href = $this->url->link('product/category','path='.$category_info['category_id']);
                }
                $product_total_cat[$key]=array(
                    'category_id'=>$category_info['category_id'],
                    'count'=>$count,
                    'name'=>$category_info['name'],
                    'image' => $this->model_tool_image->resize($category_info['image'], 100,100),
                    'href'=> $href
                );
            }
        }
        //vdump($product_total_cat);

        $data['products_sort_gramm'] = array();
        if (isset($this->request->get['cat_id']) && $this->request->get['cat_id']=='22') {
            $data['products_sort_gramm'] = array(
                '90'=>array(
                    'text1' => $this->language->get('text_90gamm1'),
                    'text2' =>$this->language->get('text_90gamm2'),
                    'color' =>'#c8effb'
                ),
                '180'=>array(
                    'text1' => $this->language->get('text_180gamm1'),
                    'text2' =>$this->language->get('text_180gamm2'),
                    'color' =>'#d6fa8b'
                ),
                'MP'=>array(
                    'text1' => $this->language->get('text_MPgamm1'),
                    'text2' =>$this->language->get('text_MPgamm2'),
                    'color' =>'#ffde00'
                ),
                '1000'=>array(
                    'text1' => $this->language->get('text_1000gamm1'),
                    'text2' =>$this->language->get('text_1000gamm2'),
                    'color' =>'#f7941d'
                ),
                '18000'=>array(
                    'text1' => $this->language->get('text_18000gamm1'),
                    'text2' =>$this->language->get('text_18000gamm2'),
                    'color' =>'#ebebeb'
                ),
                'OTHER'=>array(
                    'text1' => $this->language->get('text_OTHERgamm1'),
                    'text2' =>$this->language->get('text_OTHERgamm2'),
                    'color' =>'#ebebeb'
                )
            );
            $mas_gramm = array(
              '90'=>'/^(I-BAR\S+)(-090-|-100-|x100-|-1K)(?!(MP)$)/',
              '180'=>'/^(I-BAR\S+)(-180-|x180-)(?!(MP)$)/',
              'MP'=>'/^(I-BAR\S+)((x90-)|(MP)$)/',
              '1000'=>'/^I-BAR\S+(-1-|-1SP-)/',
              '18000'=>'/^I-BAR\S+-18-/'
            );
        }

        $data['products_sort_brand'] = array(
            'Prote'=>array(),
            'FREE Label'=>array(),
            'Patron Green Label'=>array(),
            'EXTRA Label'=>array(),
            'PATRON Extra'=>array(),
            'MAKKON'=>array(),
            'OTHER'=>array()
        );
        $data['products_sort_brand2'] = array(
            'type1'=>array(),
            'type2'=>array(),
            'type3'=>array(),
            'type4'=>array(),
            'type5'=>array()
        );
        $mas_brand = array(
          'PE'=>'Prote',
          'FL'=>'FREE Label',
          'PN-GL'=>'Patron Green Label',
          'PNGL'=>'Patron Green Label',
          'EL-R'=>'EXTRA Label',
          'ELR'=>'EXTRA Label',
          'PN-R'=>'PATRON Extra',
          'PNR'=>'PATRON Extra',
          'MA'=>'MAKKON'
        );

        //vdump($results);
        foreach ($results as $result) {
            if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
            } else {
                $image = $this->model_tool_image->resize('no-photo-img.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
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

           
            // Если категория лазерные принтеры то группируем картриджи
            if (isset($this->request->get['cat_id']) && $this->request->get['cat_id']=='31') {

                foreach($mas_brand as $key => $brand){
                  $key_brand = 'OTHER';
                    if(stristr($result['mpn'], $key) === FALSE) {} else {
                         $key_brand = $brand;
                        break;
                    }

                }
                if(!isset($action)){
                    $action = 1;
                }
                $compabil_id_prod[]=$result['product_id'];
                $child_masss[]=$result['product_id'];
                $data['products_sort_brand'][$key_brand][] = array(
                  'product_id'  => $result['product_id'],
                  'model'  => $result['model'],
                  'thumb'       => $image,
                  'name'        => $result['name'],
                  'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                  'price'       => $price,
                  'price_float'       => round($result['price'],2),
                  'special'     => $special,
                  'special_float'       => round($result['special'],2),
                  'tax'         => $tax,
                  'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                  'rating'      => $result['rating'],
                  'quantity'    => $result['quantity'],
                  'ifexist'     => $result['ifexist'],
                  'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id']),
                  'action'      => $action,
                  'has_free_delivery' => $result['has_free_delivery']
              );




                // Если категория чернила
            } elseif (isset($this->request->get['cat_id']) && $this->request->get['cat_id']=='22') {

                    foreach($mas_gramm as $key => $preg){
                      $key_brand = 'OTHER';

                        if (preg_match($preg, $result['mpn'])) {
                        	//vdump("<br>Вхождение (".$key.") ".$preg." найдено. в  ".$result['mpn']);
                            $key_brand = $key;
                            break;
                        }
                    }

                    $data['products_sort_gramm'][$key_brand]['products'][] = array(
                      'product_id'  => $result['product_id'],
                      'model'  => $result['model'],
                      'thumb'       => $image,
                      //'mpn'        => $result['mpn'],
                      'name'        => $result['name'],
                      'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                      'price'       => $price,
                      'price_float'       => round($result['price'],2),
                      'special'     => $special,
                      'special_float'       => round($result['special'],2),
                      'tax'         => $tax,
                      'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                      'rating'      => $result['rating'],
                      'quantity'    => $result['quantity'],
                      'ifexist'     => $result['ifexist'],
                      'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id']),
                      'action'      => $action,
                      'has_free_delivery' => $result['has_free_delivery']
                  );

            } else {


              $data['products'][] = array(
                  'product_id'  => $result['product_id'],
                  'model'  => $result['model'],
                  'thumb'       => $image,
                  'name'        => $result['name'],
                  'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                  'price'       => $price,
                  'price_float'       => round($result['price'],2),
                  'special'     => $special,
                  'special_float'       => round($result['special'],2),
                  'tax'         => $tax,
                  'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                  'rating'      => $result['rating'],
                  'quantity'    => $result['quantity'],
                  'ifexist'     => $result['ifexist'],
                  'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id']),
                  'action'      => $action,
                  'has_free_delivery' => $result['has_free_delivery']
              );
            }
        }
   
        
        foreach ($data['products_sort_gramm'] as $key => $value) {
            if(!isset($value['products'])){
                unset($data['products_sort_gramm'][$key]);
            }
        }
        //vdump($data['products_sort_gramm']);

        $mas1 = array();
        $mas2 = array();
        $data['products_brand'] = array();
        $prod = false;

        foreach ($data['products_sort_brand'] as  $value) {
            if($value){ $prod =true; break;}
        }
        //if($prod){
        if (isset($this->request->get['cat_id']) && $this->request->get['cat_id']=='31') {
            foreach($data['products_sort_brand'] as $key => $brand){
              foreach($brand as $key2 => $product){
                if($key=='Prote' || $key=='FREE Label'){
                    $mas1[$key]=$key;
                    $data['products_sort_brand2']['type1'][]= $product;
                    $data['text_type1'] = $this->language->get('text_type1');
                    $data['text_type1_2'] = $this->language->get('text_type1_2');
                    $data['text_type1_color'] = 'bee9f9';
                }elseif($key=='Patron Green Label' || $key=='MAKKON'){
                    $mas2[$key]=$key;
                    $data['products_sort_brand2']['type2'][]= $product;
                    $data['text_type2'] = $this->language->get('text_type2');
                    $data['text_type2_2'] = $this->language->get('text_type2_2');
                    $data['text_type2_color'] = 'd6fa8b';
                }elseif($key=='EXTRA Label'){
                    $data['products_sort_brand2']['type3'][]= $product;
                    $data['text_type3'] = $this->language->get('text_type3');
                    $data['text_type3_2'] = $this->language->get('text_type3_2');
                    $data['text_type3_color'] = 'ffde00';
                }elseif($key=='PATRON Extra'){
                    $data['products_sort_brand2']['type4'][]= $product;
                    $data['text_type4'] = $this->language->get('text_type4');
                    $data['text_type4_2'] = $this->language->get('text_type4_2');
                    $data['text_type4_color'] = 'f7941d';
                } else {
                    $data['products_sort_brand2']['type5'][]= $product;
                    $data['text_type5'] = $this->language->get('text_type5');
                    $data['text_type5_2'] = $this->language->get('text_type5_2');
                    $data['text_type5_color'] = 'ebebeb';
                }
              }

            }
          if(count($mas1)>1){
             $data['text_type1'] = $this->language->get('text_type1');
          } else {
            if(isset($mas1['Prote'])){
                $data['text_type1'] = $this->language->get('text_cartridge') . ' Prote';
            } else {
                $data['text_type1'] = $this->language->get('text_cartridge') . ' FREE Label';
            }
          }
          if(count($mas2)>1){
             $data['text_type2'] = $this->language->get('text_type2');
          } else {
            if(isset($mas2['Patron Green Label'])){
                $data['text_type2'] = $this->language->get('text_cartridge') . ' Patron Green Label';
            } else {
                $data['text_type2'] = $this->language->get('text_cartridge') . ' Makkon';
            }
          }
          $data['products_brand'] = $data['products_sort_brand2'];

        }


       // }


     	$url = '';


        if (isset($this->request->get['brand_id'])) {
            $url .= '&brand_id=' . urlencode(html_entity_decode($this->request->get['brand_id'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['prn'])) {
            $url .= '&prn=' . urlencode(html_entity_decode($this->request->get['prn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['category_id'])) {
            $url .= '&category_id=' . $this->request->get['category_id'];
        }

        if (isset($this->request->get['sub_category'])) {
            $url .= '&sub_category=' . $this->request->get['sub_category'];
        }


        if (isset($this->request->get['limit'])) {
            $url .= '&limit=' . $this->request->get['limit'];
        }
        if (isset($this->request->get['cat_id'])) {
            $url .= '&cat_id=' . $this->request->get['cat_id'];
        }


        $data['sorts'] = array();

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_default'),
            'value' => 'p.sort_order-ASC',
            'href'  => $this->url->link('product/brand', '&sort=p.sort_order&order=ASC' . $url)
        );

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_name_asc'),
            'value' => 'pd.name-ASC',
            'href'  => $this->url->link('product/brand', '&sort=pd.name&order=ASC' . $url)
        );

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_name_desc'),
            'value' => 'pd.name-DESC',
            'href'  => $this->url->link('product/brand', '&sort=pd.name&order=DESC' . $url)
        );

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_price_asc'),
            'value' => 'p.price-ASC',
            'href'  => $this->url->link('product/brand', '&sort=p.price&order=ASC' . $url)
        );

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_price_desc'),
            'value' => 'p.price-DESC',
            'href'  => $this->url->link('product/brand', '&sort=p.price&order=DESC' . $url)
        );

        $url = '';

        if (isset($this->request->get['brand_id'])) {
            $url .= '&brand_id=' . urlencode(html_entity_decode($this->request->get['brand_id'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['prn'])) {
            $url .= '&prn=' . urlencode(html_entity_decode($this->request->get['prn'], ENT_QUOTES, 'UTF-8'));
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
         if (isset($this->request->get['cat_id'])) {
            $url .= '&cat_id=' . $this->request->get['cat_id'];
        }


        $data['limits'] = array();

        $limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

        sort($limits);

        foreach($limits as $value) {
            $data['limits'][] = array(
                    'text'  => $value,
                    'value' => $value,
                    'href'  => $this->url->link('product/brand', $url . '&limit=' . $value)
            );
        }

        $url = '';


        if (isset($this->request->get['brand_id'])) {
            $url .= '&brand_id=' . urlencode(html_entity_decode($this->request->get['brand_id'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['prn'])) {
            $url .= '&prn=' . urlencode(html_entity_decode($this->request->get['prn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['category_id'])) {
            $url .= '&category_id=' . $this->request->get['category_id'];
        }

        if (isset($this->request->get['sub_category'])) {
            $url .= '&sub_category=' . $this->request->get['sub_category'];
        }

        if (isset($this->request->get['cat_id'])) {
            $url .= '&cat_id=' . $this->request->get['cat_id'];
        }

        if (isset($this->request->get['tech_id'])) {
            $url .= '&tech_id=' . $this->request->get['tech_id'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['limit'])) {
            $url .= '&limit=' . $this->request->get['limit'];
        }


        $pagination = new Pagination();
        $pagination->total = $product_total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->text_first = false;
        $pagination->text_last = false;
        $pagination->text_prev = $this->language->get('text_prev');
        $pagination->text_next = $this->language->get('text_next');
        $pagination->url = $this->url->link('product/brand', $url . '&page={page}');

        $data['pagination'] = $pagination->render();

        //$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

        // http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html

        if ($page == 1) {
            $this->document->addLink($this->url->link('product/brand', $url, 'SSL'), 'canonical');
        } elseif ($page == 2) {
            $this->document->addLink($this->url->link('product/brand', $url, 'SSL'), 'prev');
            $this->document->addLink($this->url->link('product/brand', $url. '&page='. $page, 'SSL'), 'canonical');
        } else {
            $this->document->addLink($this->url->link('product/brand', $url . '&page='. ($page - 1), 'SSL'), 'prev');
            //$this->document->addLink($this->url->link('product/brand', $url, 'SSL'), 'canonical');
        }

        if ($limit && ceil($product_total / $limit) > $page) {
            $this->document->addLink($this->url->link('product/brand', $url . '&page='. ($page + 1), 'SSL'), 'next');
        }

        $pageSuff = ($page>1 ? ' - ' . $this->language->get('text_page').$page  : '');
        if($pageSuff) $data['heading_title'] .= ' '.$pageSuff;

        $data['searchprn'] = $searchprn;
        $data['searchbrand'] = $searchbrand;

        $data['category_id'] = $category_id;

        $data['product_total_cat']=$product_total_cat;

        $data['sub_category'] = $sub_category;
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['limit'] = $limit;
        $data['allcatsurl'] = $allcatsurl;

        ///// выводим сео текст для ПУ
        //$href = $this->url->link('product/brand', 'brand_id='.str_replace(' ','-', strtolower($searchbrand)));
        $brand_id = str_replace(' ','-', strtolower($searchbrand));
        $data['description'] = '';

        /**
         * m@x
         * oc_puseo данный модуль отсутствует в системе
         * отключил из-за мусора в логах
         *
         *
         */
        // if(isset($category_id) && $brand_id ){
        //     //$url = 'https://prote.ua/'.trim(str_replace('/ua/','',$this->request->server['REQUEST_URI']),'/').'/';
        //     $sql = "SELECT pd.* FROM oc_puseo p
        //             INNER JOIN oc_puseo_description pd
        //             ON(p.puseo_id = pd.puseo_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "')
        //             WHERE p.brand_id = '".$this->db->escape($brand_id)."'
        //             AND p.category_id = '".(int)$category_id."'
        //             AND p.status = 1";
        //     $query = $this->db->query($sql);

        //     if($query->row){
        //         if($query->row['meta_h1']) {
        //             $data['heading_title'] = $query->row['meta_h1'];
        //         }
        //         if($query->row['description']) {
        //             $query->row['description'] = str_replace('{title}',$data['heading_title'],$query->row['description']);
        //             $data['description'] = html_entity_decode($query->row['description'], ENT_QUOTES, 'UTF-8');
        //         }
        //         if($query->row['meta_title']) {
        //             $this->document->setTitle($query->row['meta_title']);
        //         }
        //         if($query->row['meta_description']) {
        //             $this->document->setDescription($query->row['meta_description']);
        //         }
        //         if($query->row['meta_keyword']) {
        //             $this->document->setKeywords($query->row['meta_keyword']);
        //         }
        //     }
        // }
        /////////////////////
        $langi = $this->config->get('config_language_id');
        if(isset($searchprn) ?? $searchprn!=null){
                 $sql = "SELECT * FROM `oc_url_aliases` WHERE `prod1` = $searchprn";
                    $queryses = $this->db->query($sql);
            if(count($queryses->rows)){

                //определяем глав группу
                $sql = "SELECT * FROM `oc_url_aliases` WHERE `prod1` = $searchprn AND `prod2` = $searchprn";
                $querysesy = $this->db->query($sql);
                foreach($querysesy->rows as $producqq){
                    $tmp_grup = $producqq['id_grup'];
                    
                }
                    $sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $tmp_grup AND `lang` = $langi";
                    $querysesya = $this->db->query($sql);
                    foreach($querysesya->rows as $producqqa){
                        $data['names_grup'] = $producqqa['name_grup'];
                        $data['bread_grup'] = $producqqa['bread_grup'];
                        $data['urls'] = $producqqa['url'];
                    }
                        foreach($queryses->rows as $produc){
                    
                            $tmp_prod = $produc['prod2'];
                            //Лазер принт
                           
                            if($produc['tehnik'] == 0 ){
                                $id_grup = $produc['id_grup'];
                           $sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
                            $queryse = $this->db->query($sql);
                                $data['prodtwo'][] = $queryse;
                                //Лазер БФП
                        }
                            if($produc['tehnik'] == 1){
                              
                                $id_grupt = $produc['id_grup'];
                           $sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
                            $queryse = $this->db->query($sql);
                                $data['prodtwot'][] = $queryse;
                        }
                        if($produc['tehnik'] == 2){     
                            $id_grupts = $produc['id_grup'];
                       $sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
                        $querysea = $this->db->query($sql);
                            $data['prodtwots'][] = $querysea;
                    }
                    if($produc['tehnik'] == 3){     
                        $id_gruptse = $produc['id_grup'];
                   $sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
                    $queryseae = $this->db->query($sql);
                        $data['prodtwotse'][] = $queryseae;
                }

                if($produc['tehnik'] == 4){     
                    $id_grup4 = $produc['id_grup'];
               $sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
                $queryseae = $this->db->query($sql);
                    $data['prod4'][] = $queryseae;
            }
            if($produc['tehnik'] == 5){     
                $id_grup5 = $produc['id_grup'];
           $sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
            $queryseae = $this->db->query($sql);
                $data['prod5'][] = $queryseae;
        }
        if($produc['tehnik'] == 6){     
            $id_grup6 = $produc['id_grup'];
       $sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
        $queryseae = $this->db->query($sql);
            $data['prod6'][] = $queryseae;
    } if($produc['tehnik'] == 7){     
        $id_grup7 = $produc['id_grup'];
   $sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
    $queryseae = $this->db->query($sql);
        $data['prod7'][] = $queryseae;
} if($produc['tehnik'] == 8){     
    $id_grup8 = $produc['id_grup'];
$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
$queryseae = $this->db->query($sql);
    $data['prod8'][] = $queryseae;
} if($produc['tehnik'] == 9){     
    $id_grup9 = $produc['id_grup'];
$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
$queryseae = $this->db->query($sql);
    $data['prod9'][] = $queryseae;
} if($produc['tehnik'] == 10){     
    $id_grup10 = $produc['id_grup'];
$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
$queryseae = $this->db->query($sql);
    $data['prod10'][] = $queryseae;
} if($produc['tehnik'] == 11){     
    $id_grup11 = $produc['id_grup'];
$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
$queryseae = $this->db->query($sql);
    $data['prod11'][] = $queryseae;
} if($produc['tehnik'] == 12){     
    $id_grup12 = $produc['id_grup'];
$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
$queryseae = $this->db->query($sql);
    $data['prod12'][] = $queryseae;
} if($produc['tehnik'] == 13){     
    $id_grup13 = $produc['id_grup'];
$sql = "SELECT * FROM `oc_product_description` WHERE `product_id` =  $tmp_prod AND `language_id` = $langi";
$queryseae = $this->db->query($sql);
    $data['prod13'][] = $queryseae;
}
                        }
                       
                        $sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup AND `lang` = $langi";
                        $querysess = $this->db->query($sql);
                        foreach($querysess->rows as $producs){
                        $data['name_grup'] = $producs['name_grup'];
                     
                     } 

                    $sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grupt AND `lang` = $langi";
                    $querysess = $this->db->query($sql);
                    foreach($querysess->rows as $producs){
                        $data['name_grupt'] = $producs['name_grup'];
                    }
                    $sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grupts AND `lang` = $langi";
                    $querysess = $this->db->query($sql);
                    foreach($querysess->rows as $producs){
                        $data['name_grupts'] = $producs['name_grup'];
                    }
                    $sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_gruptse AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_gruptse'] = $producs['name_grup'];
                    }
                    $sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup4 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup4'] = $producs['name_grup'];
                    }
                    $sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup5 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup5'] = $producs['name_grup'];
                    }
                    $sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup6 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup6'] = $producs['name_grup'];
                    }$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup7 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup7'] = $producs['name_grup'];
                    }$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup8 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup8'] = $producs['name_grup'];
                    }$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup9 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup9'] = $producs['name_grup'];
                    }$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup10 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup10'] = $producs['name_grup'];
                    }$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup11 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup11'] = $producs['name_grup'];
                    }$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup12 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup12'] = $producs['name_grup'];
                    }$sql = "SELECT * FROM `oc_url_aliases_descr` WHERE `id` = $id_grup13 AND `lang` = $langi";
                    $querysesse = $this->db->query($sql);
                    foreach($querysesse->rows as $producs){
                        $data['name_grup13'] = $producs['name_grup'];
                    }

                }
                    
                    else{
                        $data['names_grup'] = null;
                        $data['name_grup'] = null;
                        $data['name_grup4'] = null;
                        $data['bread_grup'] = null;
                        $data['urls'] = null;
                        $data['name_grupt'] = null;
                        $data['name_grup5'] = null;
                        $data['name_grup6'] = null;
                        $data['name_grup7'] = null;
                        $data['name_grup8'] = null;
                        $data['name_grup9'] = null;
                        $data['name_grup10'] = null;
                        $data['name_grup11'] = null;
                        $data['name_grup12'] = null;
                        $data['name_grup13'] = null;
                    }
                }


                    $data['langurl'] =  $this->config->get('config_language_id')-1;
                    $data['column_right'] = $this->load->controller('common/column_right');
                    $data['content_bottom'] = $this->load->controller('common/content_bottom');
                    $data['footer'] = $this->load->controller('common/footer');
                    $data['header'] = $this->load->controller('common/header');


        $this->response->setOutput($this->load->view('default/template/product/brand.tpl', $data));

        }
    }

}
