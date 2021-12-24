<?php
class ControllerProductCategory extends Controller {

    function selstrlen($strlist, $strlen) {
        // Выбираем самый длинный элемент из списка
        foreach ($strlist as $strItem) {
            if (mb_strlen($strItem)<$strlen) break;
        }
        return $strItem;
    }

    public function index() {
        //global $start;
        // gdemon редирект для page=1
        //vdump($this->request->get);
        if (isset($this->request->get['page'])) {
            if($this->request->get['page']==1){
                if (isset($this->request->get['filter'])) {
                    $url .= '&filter=' . $this->request->get['filter'];
                }
                if (isset($this->request->get['limit'])) {
                    $url .= '&limit=' . $this->request->get['limit'];
                }
                if (isset($this->request->get['bfilter'])) {
                    $url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
                }
                if (isset($this->request->get['sort'])) {
                    $url .= '&sort=' . $this->request->get['sort'];
                }
                if (isset($this->request->get['order'])) {
                    $url .= '&order=' . $this->request->get['order'];
                }

                $this->response->redirect($this->url->link('product/category', 'path=' . $this->request->get['path'] . $url));
            }
        }
        // end gdemon редирект для page=1


        //  *****************

        //$this->document->addScript('catalog/view/javascript/instup/jquery.maskedinput-1.3.min.js');

        //$this->document->addScript('catalog/view/javascript/instup/uikit.min.js');
        //$this->document->addScript('catalog/view/javascript/instup/instup.js');
        //$this->document->addStyle('catalog/view/javascript/instup/instup.css');

        $start = microtime(true);
        //echo '<br/>Время выполнения скрипта 0: '.round(microtime(true) - $start, 4).' сек.';

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
            $data['text_quantity1'] = $this->language->get('text_quantity1');
            
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

        // **************

        $this->load->language('product/category');
        $this->load->model('catalog/category');
        $this->load->model('catalog/product');
        $this->load->model('extension/news');
        $this->load->model('module/brainyfilter');
        $this->load->model('tool/image');

        $data['text_action'] = $this->language->get('text_action');
        $data['text_filter'] = $this->language->get('text_filter');
        $data['selection_by_device'] = $this->language->get('selection_by_device');
        
        if (isset($this->request->get['filter'])) {
            $filter = $this->request->get['filter'];
        } else {
            $filter = '';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            //$sort = 'p.sort_order';
            $sort = 'p.price';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        $redirect_from_page1=false;
        //echo '<br/>Время выполнения скрипта 1: '.round(microtime(true) - $start, 4).' сек.';
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
            if($page==1){
                $redirect_from_page1=true;
            }
        } else {
            $page = 1;
        }

        if (isset($this->request->get['limit'])) {
            $limit = (int)$this->request->get['limit'];
        } else {
            $limit = $this->config->get('config_product_limit');
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );



        if (isset($this->request->get['path'])) {

            if($this->request->get['path']==0)  $this->response->redirect($this->url->link('common/home'));

            // Отрабатываем ситуацию редиректа для категории
            $category_redir = $this->model_catalog_category->getCategoryRedirect($this->request->get['path']);

            if ($category_redir) {
                // Редирект на другую категорию
                header($this->request->server['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
                $this->response->redirect($this->url->link('product/category', 'path='.$category_redir['redirect']));
                // die();
            }

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $path = '';

            $parts = explode('_', (string)$this->request->get['path']);

            $category_id = (int)array_pop($parts);

            foreach ($parts as $path_id) {
                if (!$path) {
                    $path = (int)$path_id;
                } else {
                    $path .= '_' . (int)$path_id;
                }

                $category_info = $this->model_catalog_category->getCategory($path_id);

                if ($category_info) {
                    $data['breadcrumbs'][] = array(
                        'text' => $category_info['name'],
                        'href' => $this->url->link('product/category', 'path=' . $path . $url)
                    );
                }
            }
        } else {
            $category_id = 0;
            $this->response->redirect($this->url->link('common/home'));
        }


        $category_info = $this->model_catalog_category->getCategory($category_id);

                    /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
					if (!$category_info) {
                        $this->load->language('module/brainyfilter');
                        $category_info = array(
                            'name' => $this->language->get('text_bf_page_title'),
                            'description' => '',
                            'meta_description' => '',
                            'meta_keyword' => '',
                            'meta_title' => '',
                            'image' => '',
                        );
                        $this->request->get['path'] = 0;
                    }
                    /* Brainy Filter Pro (brainyfilter.xml) - End ->*/
                

        if(!$category_info){
            $this->response->redirect($this->url->link('error/not_found'));
        }

        if(isset($category_info['image'])){
            $this->document->setOgImage($this->model_tool_image->resize($category_info['image'],150,150));
        }

        /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
        if (!$category_info) {
            $this->load->language('module/brainyfilter');
            $category_info = array(
                'name' => $this->language->get('text_bf_page_title'),
                'description' => '',
                'meta_description' => '',
                'meta_keyword' => '',
                'meta_title' => '',
                'image' => '',
            );
            $this->request->get['path'] = 0;
        }
        /* Brainy Filter Pro (brainyfilter.xml) - End ->*/

        $data['text_view_all'] = $this->language->get('text_view_all');
    if ($category_info && is_numeric($page)) {


        // Список категорий
        $lang=$this->language->get('code');

        $data['categories'] = $this->cache->get('catalog_categories.' . $category_id .'.'. $lang . $_SERVER['HTTPS']);
        //vdump($data['categories']);

        if (!$data['categories']) {

            $data['categories'] = array();


            $results = $this->model_catalog_category->getCategories($category_id);
            // Для категории "Струйные" добавляем товары из лазерной и матричной группы
            if ($category_id==20) {
                $results30=$this->model_catalog_category->getCategories(30);
                $results40=$this->model_catalog_category->getCategories(40);
                $results=array_merge($results, $results30, $results40);
            }

            // **** тот еще костыль! ***
            foreach ($results as $result) {

                // Level 2
                $children_data = array();
                //$children = $this->model_catalog_category->getCategoriesChildren($result['category_id']);
                $children = $this->model_catalog_category->getCategories($result['category_id']);
                foreach ($children as $child) {
                    $children_data[] = array(
                        'name' => mb_ucfirst($child['name']),
                        //'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . '_' . $child['category_id'] . $url)
                        'href' => HTTPS_SERVER.$child['href']
                    );
                }

                $data['categories'][] = array(
                    'name' => $result['name'],
                    'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url),
                    'image' => $this->model_tool_image->resize($result['image'], 100,100),
                    'children' => $children_data
                );
            }

            $this->cache->set('catalog_categories.' . $category_id .'.'. $lang . $_SERVER['HTTPS'], $data['categories']);
        }


        // Добавляем в конце тегов для многостраничных документов
        $pageSuff = ($page>1 ? ' - ' . $page . ' ' . $this->language->get('text_page') : '');

        // SEO **********************
        // $landing_page=$_SERVER['REQUEST_URI'];
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        // и затем используем "левую" часть:
        $landing_page = $uri_parts[0];

        $filterConditions=$this->model_module_brainyfilter->getConditions()->filter;

        //getheadingaddition

        $ldata=array();
        $isaddfilters=0;
        $isaddfilters2=0;

        // новый модуль SEO Filter by gdemon
        $fbase_group_id='';
        $fbase_id ='';
        $data['heading_title'] ='';
        $data['description'] ='';
        $data['meta_description']='';
        $filters=array();
        foreach ($filterConditions as $key => $value) {
            if(is_array($value)){
                foreach ($value as $key2 => $val) {
                    $filters[] = $val;
                }
            } else {
                $filters[$key] = $value[0];
            }
        }
        $filterseo_info='';
        //$data['meta_title'] ='';
        $fbase_group_id_s=false;
        $fbase_group_id=false;
        $fbase_id_s=false;
        $fbase_id=false;
        $seoshild=true;
        $filterseo=false;

        if($filters){

            $filterseo_info = $this->model_catalog_product->getLandingFilterSeo($filters,$category_id);
            //vdump($filterseo_info);

            if($filterseo_info){
                $data['heading_title'] = $filterseo_info['meta_h1'];
                $data['description'] = html_entity_decode($filterseo_info['description']);
                $data['meta_title'] = html_entity_decode($filterseo_info['meta_title']);
                $seoshild = false;
                $filterseo=true;
            }

            if(!$filterseo_info && count($filters)>2){
                $filters2 = current($filters);

                foreach ($filters as $key2 => $value2) {
                    $fbase_group_id_s = $key2;
                    $fbase_id_s = $value2;
                    $isaddfilters=1;
                    $isaddfilters2=1;
                    $seoshild = false;
                    break;
                }
                //$fbase_group_id, $fbase_id

                //$filters
                $filterseo_info = $this->model_catalog_product->getLandingFilterSeo($filters2,$category_id);

                //$data['heading_title'] = $filterseo_info['meta_h1'];

               // $fbase_group_id, $fbase_id

                // для формирования H1
                if($filterseo_info){
                    $category_info['name'] = $filterseo_info['meta_h1'];
                    $seoshild = false;
                }

            }

        }

        // echo count($filterConditions, COUNT_RECURSIVE);
        // Анализирую ситуацию, когда фильтров больше 1
        $morefilter = false;
        if (count($filterConditions, COUNT_RECURSIVE)>2) {
            // Возможно, есть прописанные параметры в базе УРЛ
            $ldata=$this->model_catalog_product->getLandingSEOData($landing_page);

            if($ldata->num_rows>0){
                $morefilter = true;
            }

        }
        if(!$morefilter) {

            $getFilterSEOData = false;
            // Если не нашли там - ищем как обычно?
            if ($ldata && $ldata->num_rows==0) {
                // Нужно брать из таблицы фильтров!
                if ($filterConditions) {
                    // print_r($filterConditions);
                    // Перебираем все фильтры
                    foreach ($filterConditions as $key=>$val) {
                        // И все значения фильтров
                        foreach ($val as $v) {
                            $datafilter=array(
                               'filter_group_id'=>$key,
                               'filter_id'=>$v,
                               'language_id'=>($lang=='ru'? 1:2),
                               'category_id'=>$category_id
                            );

                            $ldata=$this->model_catalog_product->getFilterSEOData($datafilter);
                            $getFilterSEOData = true;
                            if($morefilter){
                                $parent_ldata = $ldata;
                                $ldata = array();
                            }

                            // если выбрано больше одного фильтра удаляем description
                            if (count($filterConditions, COUNT_RECURSIVE)>2) {
                                foreach ($ldata->rows as $key2 => $value) {
                                    if($value['param_name']=='description'){
                                        unset($ldata->rows[$key2]);
                                    }
                                }
                            }

                            // Для этого фильтра прописано значение
                            if ($ldata->num_rows) {
                                // Фиксируем ID основного фильтра
                                $fbase_id=$v;
                                break;
                            }
                        }
                        // Фиксируем группу основного фильтра

                        if ($fbase_id) {
                            $fbase_group_id=$key;
                            break;
                        }
                    }
                    $isaddfilters=1;
                } else {
                    // Нужно брать из таблицы УРЛов
                    $ldata=$this->model_catalog_product->getLandingSEOData($landing_page);
                }
            }
        }
        $landing_data = array();
        // echo '<pre>'; print_r($ldata->rows); echo '</pre>';
        if(isset($ldata->rows)&&count($ldata->rows)!=0) {
            $seoshild = false;
           foreach ($ldata->rows as $litem) {
               $landing_data[$litem['param_name']]=$litem['param_value'];
               $no_add_filter;
           }
        }

          //  echo $landing_data['meta_description'].'<br>';
        //}
        //*
        // Блок создания МЕТА-ДАННЫХ!!!

        $this->document->setKeywords($category_info['meta_keyword']);

        // Дополнительные тексты для МЕТА
        // Если эта страница - раздел (со списком категорий)
        if ($data['categories'] || isset($this->request->get['bfilter'])) {
            $titleAdd = $this->language->get('titleAdd2');
            $descAdd = $this->language->get('descAdd2');
        } else {
            $titleAdd = $this->language->get('titleAdd');
            $descAdd = $this->language->get('descAdd');
        }


        //gdemon 2018.09.17 - добавил условие для seoshild для формирования ХК без фильтров

        if(!$filterseo_info || !isset($data['heading_title'])){
            if($seoshild){
                if($category_info['meta_h1']){
                    $data['heading_title'] =$category_info['meta_h1'];
                } elseif($category_info['name']){
                    $data['heading_title'] =$category_info['name'];
                }
            } else{
                // H1 прописан в параметрах лендинг-урл (например, фильтра)
                if (isset($landing_data['heading_title']) && $landing_data['heading_title']) {
                    if(!$filterseo || !$data['heading_title']){
                        $data['heading_title'] = implode(' ', array(
                            $landing_data['heading_title'],
                            $this->model_catalog_category->getextendedheadingaddition($landing_data['heading_title'], ($isaddfilters ? $this->model_module_brainyfilter->getheadingaddition($fbase_group_id, $fbase_id, $fbase_group_id, $fbase_id,$landing_data['heading_title']) : '') )
                        ));
                    }
                } elseif ($category_info['meta_h1']) {    // H1 прописан в параметрах самого раздела
                    $data['heading_title'] = implode(' ', array(
                        $category_info['meta_h1'],
                        $this->model_catalog_category->getextendedheadingaddition($category_info['meta_h1'], $this->model_module_brainyfilter->getheadingaddition())
                    ));
                }
            }

            // H1 не прописан ни там ни там - включаем автогенерацию из имени и фильтров

            if (!$data['heading_title']) {
                $data['heading_title'] = $category_info['name'];
                // пример здесь https://prote.ua/bytovaya-himija/osvejiteli-vozduha-poliroli/f1656-polirol-dlya-mebeli/f4437-krem/?admin=
                // Полироли для мебели , крем (Полироли для мебели из фильтра, второе здесь добавляем)
                // Добавляем наименование фильтров
                $data['heading_title'] =  implode(' ', array(
                   $data['heading_title'],
                   $this->model_catalog_category->getextendedheadingaddition($data['heading_title'], ($isaddfilters ? $this->model_module_brainyfilter->getheadingaddition(false,false,$fbase_group_id_s, $fbase_id_s,$data['heading_title']) : ''))

                ));
                // заменяем a3,a4... на A3, A4
                $find = array(' а3',' а4',' а5');

                $replace = array(' а3' => ' A3',' а4' => ' A4',' а5' => ' A5');
                $data['heading_title'] = str_replace($find, $replace, $data['heading_title']);
                // end заменяем a3,a4... на A3, A4
            }
        }

        if(!isset($data['meta_title'])){$data['meta_title']='';}
        if(!isset($data['meta_description'])){$data['meta_description']='';}

        // Тайтл прописан в параметрах лендинг-урл (например, фильтра)
        if (isset($landing_data['title']) &&$landing_data['title']) {
            $data['title'] = implode(' ', array(
                $landing_data['title'],
                $this->model_catalog_category->getextendedheadingaddition($landing_data['title'], $pageSuff)
            ));

        } elseif ($data['heading_title'] && !$data['meta_title']) {
            // gdemon 10/07/2018
            $clen=mb_strlen(trim(implode(' ', array(trim( $data['heading_title'])))));
            $data['title'] = trim(implode(' ', array(
                trim( $data['heading_title']),
                $this->selstrlen($titleAdd, 59-$clen))));

             $data['title'] = implode(' ', array(
                 $data['title'],
                $this->model_catalog_category->getextendedheadingaddition(  $data['title'], $pageSuff)
            ));

        } elseif ( $data['meta_title']) { // Тайтл прописан в параметрах раздела
            //gdemon | в getextendedheadingaddition почемуто передается 3 параметра, должно быть 2
            // поэтому ставлю добавление $pageSuff к title
            $data['title'] = implode(' ', array(
                $data['meta_title'],
                //$this->model_catalog_category->getextendedheadingaddition($category_info['meta_title'], $this->model_module_brainyfilter->getheadingaddition(), $pageSuff)
                $this->model_catalog_category->getextendedheadingaddition( $data['meta_title'], $pageSuff)
            ));
        } elseif ($category_info['meta_title']) { // Тайтл прописан в параметрах раздела
            //gdemon | в getextendedheadingaddition почемуто передается 3 параметра, должно быть 2
            // поэтому ставлю добавление $pageSuff к title

            $data['title'] = implode(' ', array(
                $category_info['meta_title'],
                //$this->model_catalog_category->getextendedheadingaddition($category_info['meta_title'], $this->model_module_brainyfilter->getheadingaddition(), $pageSuff)
                $this->model_catalog_category->getextendedheadingaddition($category_info['meta_title'], $pageSuff)
            ));
        }

        $set_title = false;
        if ($category_info['meta_title'] && !isset($this->request->get['bfilter'])) {// Дискрипшн прописан в параметрах раздела
        	$this->document->setTitle($category_info['meta_title']);
        	$set_title = true;
        }


        // Чтоб суффикс странички не повторялся
       /* if ($pageSuff) {
            $data['heading_title'] .= ' ' . $pageSuff;
            // $pageSuff='';
        }*/
        // Тайтл не прописан - включаем автогенерацию из имени и фильтров
        if (!$data['title']) {
            $data['title'] = $data['heading_title'];
            // Добавляем наименование фильтров
            $data['title'] =  implode(' ', array(
               $data['title']
               /*,
               /$this->model_catalog_category->getextendedheadingaddition($data['title'], $this->model_module_brainyfilter->getheadingaddition())
                *
                */

            ));

            // Дополняем тайтл суффиксами страниц и текстом до нужных размеров
            // Длина "остальных" элементов
            $clen=mb_strlen(trim(implode(' ', array(trim($data['title'])))));
            $data['title'] = trim(implode(' ', array(
                trim($data['title']),
                $this->selstrlen($titleAdd, 59-$clen))));

        }

        if(!$set_title){
        	$this->document->setTitle($data['title']);
        }

        // Дискрипшн прописан в параметрах лендинг-урл (например, фильтра)
        if (isset($landing_data['meta_description']) && isset($landing_data['heading_title'])) {

            $data['meta_description'] = implode(' ', array(
                $landing_data['meta_description'],
                $this->model_catalog_category->getextendedheadingaddition($landing_data['heading_title'], $pageSuff)
            ));

         } elseif ($data['heading_title'] && !$data['meta_description']) {

           // gdemon 11/07/2017
            $data['heading_title'] = implode(' ', array(
                 $data['heading_title'],
                $this->model_catalog_category->getextendedheadingaddition(  $data['heading_title'], $pageSuff)
            ));

        } elseif ($category_info['meta_description']) {// Дискрипшн прописан в параметрах раздела
            $data['meta_description'] = implode(' ', array(
                $category_info['meta_description'],
                $this->model_catalog_category->getextendedheadingaddition($data['heading_title'], $this->model_module_brainyfilter->getheadingaddition($fbase_group_id, $fbase_id)),$pageSuff));

        }

        $set_description = false;
        if ($category_info['meta_description'] && !isset($this->request->get['bfilter'])) {// Дискрипшн прописан в параметрах раздела
        	$this->document->setDescription($category_info['meta_description']);
        	$set_description = true;
        }

        // Тайтл не прописан - включаем автогенерацию из имени и фильтров
        if (!$data['meta_description']) {
            $data['meta_description'] = $data['heading_title'];
        }

        // Дополняем дескрипшн суффиксами страниц и текстом до нужных размеров
        // Длина "остальных" элементов
        $clen=mb_strlen(trim(implode(' ', array(trim($data['meta_description'])))));




        if (isset($getFilterSEOData) && $getFilterSEOData && isset($landing_data['meta_description']) && $landing_data['meta_description']) {
            $this->document->setDescription($landing_data['meta_description']);
        } elseif(!$set_description) {
            $this->document->setDescription(
                trim(implode(' ', array(
                    trim($data['meta_description']) . '.',
                    // $this->language->get('text_seo_description'),
                    $this->selstrlen($descAdd, 159-$clen))))
            );
        }


        // СЕО описание берем из базы УРЛов

        $ldata=$this->model_catalog_product->getLandingSEOData($landing_page);
        $landurl_data=array();
        // echo '<pre>'; print_r($ldata->rows); echo '</pre>';
        if(count($ldata->rows)!=0) {
           foreach ($ldata->rows as $litem) {
               $landurl_data[$litem['param_name']]=$litem['param_value'];
           }
        }


        // СЕО-описание (внизу страницы!!!)
        // СЕО-дискрипшн в параметрах фильтра

        if(!$data['description']){
            if (isset($landing_data['description'])) {
                $data['description'] = html_entity_decode($landing_data['description']);
            // СЕО-Дискрипшн прописан в параметрах раздела
            } elseif (isset($landurl_data['description'])) {
                $data['description'] = html_entity_decode($landurl_data['description']);
            } elseif (strlen($category_info['description'])>100) {
                $data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
            }
        }

        $data['description'] = str_ireplace('prote.com.ua', 'prote.ua', $data['description']);
        /***********************/

        $data['text_minimum'] = $this->language->get('text_minimum');
        $data['text_refine'] = $this->language->get('text_refine');
        $data['text_empty'] = $this->language->get('text_empty');
        $data['text_quantity'] = $this->language->get('text_quantity');
        $data['text_manufacturer'] = $this->language->get('text_manufacturer');
        $data['text_model'] = $this->language->get('text_model');
        $data['text_price'] = $this->language->get('text_price');
        $data['text_tax'] = $this->language->get('text_tax');
        $data['text_points'] = $this->language->get('text_points');
        $data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
        $data['text_sort'] = $this->language->get('text_sort');
        $data['text_limit'] = $this->language->get('text_limit');
        $data['text_exist'] = $this->language->get('text_exist');
        $data['text_preorder'] = $this->language->get('text_preorder');
        $data['text_wait'] = $this->language->get('text_wait');
        $data['text_noexist'] = $this->language->get('text_noexist');
        $data['text_addedtobasket'] = $this->language->get('text_addedtobasket');
        $data['text_checkout'] = $this->language->get('text_checkout');
        $data['text_continue'] = $this->language->get('text_continue');
        $data['text_freedelivery'] = $this->language->get('text_freedelivery');
        $data['text_freedeliverytip'] = $this->language->get('text_freedeliverytip');
        $data['text_freedeliverykievtip'] = $this->language->get('text_freedeliverykievtip');
        $data['text_yourpricetip'] = $this->language->get('text_yourpricetip');
        $data['text_action'] = $this->language->get('text_action');
        $data['text_show_more']    = $this->language->get('text_show_more');
        $data['text_action_pextra'] = $this->language->get('text_action_pextra');
        $data['text_action_pextra_tip']= $this->language->get('text_action_pextra_tip');
        $data['text_freedelivery_paid'] = $this->language->get('text_freedelivery_paid');
        $data['button_cart'] = $this->language->get('button_cart');
        $data['button_cartone'] = $this->language->get('button_cartone');
        $data['button_clear'] = $this->language->get('button_clear');
        $data['text_bestseller'] = $this->language->get('text_bestseller');
        $data['text_action'] = $this->language->get('text_action');
        $data['text_free_delivery'] = $this->language->get('text_free_delivery');
        $data['text_show_others'] = $this->language->get('text_show_others');

        //$data['button_wishlist'] = $this->language->get('button_wishlist');
        //$data['button_compare'] = $this->language->get('button_compare');
        $data['button_continue'] = $this->language->get('button_continue');
        //$data['button_list'] = $this->language->get('button_list');
        //$data['button_grid'] = $this->language->get('button_grid');
        //$data['button_grid_list'] = $this->language->get('button_grid_list');

        // Set the last category breadcrumb
        $data['breadcrumbs'][] = array(
            //'text' => $data['heading_title'],
            'text' => $category_info['name'],
            'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'])
        );

        //Recommendation categories
        $recommendationCategoiresId = $this->model_catalog_category->getRecommendationCategories($category_id);
        $recommendationCategoires = [];
        if(isset($recommendationCategoiresId[0]) && $recommendationCategoiresId[0]!=null){
        foreach ($recommendationCategoiresId[0] as $id) {
            if((int)$id !== 0) {
                $cat_info = $this->model_catalog_category->getCategory($id);
                $cat_info['image'] = $this->model_tool_image->resize($cat_info['image'], 100, 100);
                $cat_info['link'] = $this->url->link('product/category', 'path=' . $cat_info['category_id']);

                $recommendationCategoires[] = $cat_info;
            }
        }}
        $data['recommendationCategoires'] = $recommendationCategoires;
        // gdemon 2019.03.19 - по реккомендации Волохи добавил фильтра в ХК
        $count=0;
        if($filterConditions ){
            $breadcraumb_filer ='&bfilter=';
            foreach ($filterConditions as $key_filer_group => $filters){
                $count++;
                foreach ($filters as $filter ) {
                    $sSQL='SELECT distinct fg.filter_group_id, fd.filter_id, fg.name fgname, fd.name FROM `oc_filter_description` fd LEFT JOIN `oc_filter_group_description` fg ON  fg.filter_group_id= fd.filter_group_id AND fg.language_id=fd.language_id WHERE fg.language_id=' . (int)$this->config->get('config_language_id') . ' AND fd.filter_group_id=' . $key_filer_group . ' AND filter_id='.$filter ;
                    $query = $this->db->query($sSQL);

                    if($query->row){
                        $breadcraumb_filer .= 'f'.$key_filer_group.':'.$filter.';';
                        $data['breadcrumbs'][] = array(
                            'text' => $query->row['name'],
                            'href' => $href = $this->url->link('product/category', 'path=' . $this->request->get['path'].$breadcraumb_filer  )
                        );
                    }
                }
            }
        }


        if ($category_info['image']) {
            $data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
        } else {
            $data['thumb'] = '';
        }

        //
        $data['compare'] = $this->url->link('product/compare');

        $url = '';

        if (isset($this->request->get['filter'])) {
            $url .= '&filter=' . $this->request->get['filter'];
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


        $data['products'] = array();
        $product_total = 0;

        if(empty($data['categories'])){

            $filter_data = array(
                'filter_category_id' => $category_id,
                'filter_filter'      => $filter,
                'sort'               => $sort,
                'order'              => $order,
                'start'              => ($page - 1) * $limit,

                    /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
					$settings = $this->config->get('brainyfilter_layout_basic');
					if (isset($settings['global']['subcategories_fix']) && $settings['global']['subcategories_fix']) {
						$filter_data['filter_sub_category'] = true;
					}
                    $filter_data['filter_bfilter'] = true;
                    /* Brainy Filter Pro (brainyfilter.xml) - End ->*/
                'limit'              => $limit
            );

            /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
            $settings = $this->config->get('brainyfilter_layout_basic');
            if (isset($settings['global']['subcategories_fix']) && $settings['global']['subcategories_fix']) {
                $filter_data['filter_sub_category'] = true;
            }
            $filter_data['filter_bfilter'] = true;
            /* Brainy Filter Pro (brainyfilter.xml) - End ->*/


                    /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
					$settings = $this->config->get('brainyfilter_layout_basic');
					if (isset($settings['global']['subcategories_fix']) && $settings['global']['subcategories_fix']) {
						$filter_data['filter_sub_category'] = true;
					}
                    /* Brainy Filter Pro (brainyfilter.xml) - End ->*/
            $product_total = $this->model_catalog_product->getTotalProducts($filter_data);

            //если задан page больше чем есть редирект на последнюю страницу
            if($product_total >0 && $page>ceil($product_total / $limit)){
                $url = '&page='.ceil($product_total / $limit) .$url;
                $this->response->redirect($this->url->link('product/category', 'path=' . $this->request->get['path'] . $url));
            }

            $results = $this->model_catalog_product->getProducts($filter_data);

            $products_ids = ''; // для Google ремаркетинга

            foreach ($results as $result) {
                $data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($result['product_id']);

                $data['brand'] = false;

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

                $products_ids .= ",'".$result['product_id']."'"; // для Google ремаркетинга

                if ($result['image']) {
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

                // получаем цену для определнных товаров на черную пятницу
                if(isset($this->session->data['products_pjatnica']) && array_key_exists($result['product_id'],$this->session->data['products_pjatnica'])) {
                     $special =  $this->currency->format($this->tax->calculate($this->session->data['products_pjatnica'][$result['product_id']], $product_info['tax_class_id'], $this->config->get('config_tax')));
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

                // Акции!
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

                $attribute_groups = $this->model_catalog_product->getProductAttributes($result['product_id']);
                $attributs = array();

                foreach ($attribute_groups as $key1 => $attributes) {
                    //vdump($attributes);
                    foreach ($attributes['attribute'] as $key2 => $attribute) {

                        if($attribute['attribute_id']==17873&&($attribute['text']=='Да'||$attribute['text']=='Так')){// Возможна заправка картриджа
                            if($category_id==89 || $category_id==81){
                                $attributs['17873'] = array(
                                    'image' => 'image/catalog/ico_attr/kart-mozhno-zaprav.svg',
                                    'text' => $this->language->get('text_attribute_17873')
                                );
                            } else if($category_id==88 || $category_id==82){
                                $attributs['17873'] = array(
                                    'image' => 'image/catalog/ico_attr/kart-mozhno-zaprav.svg',
                                    'text' => $this->language->get('text_attribute_17873')
                                );
                            }
                        } elseif($attribute['attribute_id']==17867&&($attribute['text']=='Доступны'||$attribute['text']=='Доступні')){ //Доступность неоригинальных картриджей
                            if($category_id==89 || $category_id==81){
                                $attributs['17867'] = array(
                                    'image' => 'image/catalog/ico_attr/dostupnyy-neorig-ink-cartr.svg',
                                    'text' => $this->language->get('text_attribute_17867')
                                );
                            } else if($category_id==88 || $category_id==82){
                                $attributs['17867'] = array(
                                    'image' => 'image/catalog/ico_attr/dostupnyy-neorig-laz-cartr.svg',
                                    'text' => $this->language->get('text_attribute_17867')
                                );
                            }
                        } elseif($attribute['attribute_id']==17870&&($attribute['text']=='Доступны'||$attribute['text']=='Доступні')){ //Доступность неоригинальных чернил
                            $attributs['17870'] = array(
                                    'image' => 'image/catalog/ico_attr/ink-drops-neorig-chornyla.svg',
                                    'text' => $this->language->get('text_attribute_17870')
                                );
                        }

                    }
                    //if($data['brand'])break;
                }
                //vdump($attribute_groups);
               // $bSQL='SELECT distinct fg.filter_group_id, fd.filter_id, fg.name fgname, fd.name FROM `oc_filter_description` fd LEFT JOIN `oc_filter_group_description` fg ON  fg.filter_group_id= fd.filter_group_id AND fg.language_id=fd.language_id WHERE fg.language_id=' . (int)$this->config->get('config_language_id') . ' AND fd.filter_group_id=' . $key_filer_group . ' AND filter_id='.$filter ;
              //  $query = $this->db->query($bSQL);
            
             if($data['brand']['text']=="Baoke") {
                $data['productsBaoke'][] = array(
                    'brand' => $data['brand']['text'],
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
                    'model'       => $result['model'],
                    //'name'        => htmlspecialchars($result['name']),
                    'name'        => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'),
                    'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                    'attributs'       => $attributs,
                    'price'       => $price,
                    'price_float'       => round($result['price'],2),
                    'special'     => $special,
                    'special_float'       => round($result['special'],2),
                    'tax'         => $tax,
                    'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                    'rating'      => $result['rating'],
                    'ifexist'     => $result['ifexist'],
                    'quantity'    => $result['quantity'],
                    'tag'         => htmlspecialchars($result['tag']),
                    'jan'         => $result['jan'],
                    'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url),
                    'action'      => $action,
                    'has_free_delivery' => $result['has_free_delivery'],
                    'attributes' => $attribute_groups,
                );

             }
             elseif($data['brand']['text']=="Comix"){
                $data['productsBaoke'][] = array(
                    'brand' => $data['brand']['text'],
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
                    'model'       => $result['model'],
                    //'name'        => htmlspecialchars($result['name']),
                    'name'        => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'),
                    'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                    'attributs'       => $attributs,
                    'price'       => $price,
                    'price_float'       => round($result['price'],2),
                    'special'     => $special,
                    'special_float'       => round($result['special'],2),
                    'tax'         => $tax,
                    'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                    'rating'      => $result['rating'],
                    'ifexist'     => $result['ifexist'],
                    'quantity'    => $result['quantity'],
                    'tag'         => htmlspecialchars($result['tag']),
                    'jan'         => $result['jan'],
                    'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url),
                    'action'      => $action,
                    'has_free_delivery' => $result['has_free_delivery'],
                    'attributes' => $attribute_groups,
                );}else{
                $data['productsOther'][] = array(
                    'brand' => $data['brand']['text'],
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
                    'model'       => $result['model'],
                    //'name'        => htmlspecialchars($result['name']),
                    'name'        => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'),
                    'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                    'attributs'       => $attributs,
                    'price'       => $price,
                    'price_float'       => round($result['price'],2),
                    'special'     => $special,
                    'special_float'       => round($result['special'],2),
                    'tax'         => $tax,
                    'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                    'rating'      => $result['rating'],
                    'ifexist'     => $result['ifexist'],
                    'quantity'    => $result['quantity'],
                    'tag'         => htmlspecialchars($result['tag']),
                    'jan'         => $result['jan'],
                    'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url),
                    'action'      => $action,
                    'has_free_delivery' => $result['has_free_delivery'],
                    'attributes' => $attribute_groups,
                );
             }

                $data['products'][] = array(
                    'brand' => $data['brand']['text'],
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
                    'model'       => $result['model'],
                    //'name'        => htmlspecialchars($result['name']),
                    'name'        => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'),
                    'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                    'attributs'       => $attributs,
                    'price'       => $price,
                    'price_float'       => round($result['price'],2),
                    'special'     => $special,
                    'special_float'       => round($result['special'],2),
                    'tax'         => $tax,
                    'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                    'rating'      => $result['rating'],
                    'ifexist'     => $result['ifexist'],
                    'quantity'    => $result['quantity'],
                    'tag'         => htmlspecialchars($result['tag']),
                    'jan'         => $result['jan'],
                    'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url),
                    'action'      => $action,
                    'has_free_delivery' => $result['has_free_delivery'],
                    'attributes' => $attribute_groups,
                );

            }

            $this->session->data['products_ids'] = trim($products_ids,','); // для Google ремаркетинга
            //vdump($products_ids);
        }




        $url = '';

        if (isset($this->request->get['filter'])) {
            $url .= '&filter=' . $this->request->get['filter'];
        }

        if (isset($this->request->get['limit'])) {
            $url .= '&limit=' . $this->request->get['limit'];
        }


        /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
        if (isset($this->request->get['bfilter'])) {
            $url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));

            if (isset($landing_data['description'])&&$landing_data['description'] || isset($filterseo_info['description']) && $filterseo_info['description']) {

            } else {
                // Убираем общее описание для страниц с фильтром
                $data['description']='';
            }
        }


        if (isset($this->request->get['sort']) || isset($this->request->get['limit']) || isset($this->request->get['bfilter']) && strpos($this->request->get['bfilter'], 'price:')!==false )  {
                $data['description']='';
        }


                /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
				if (isset($this->request->get['bfilter'])) {
					$url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
				}
                /* Brainy Filter Pro (brainyfilter.xml) - End ->*/
        $data['sorts'] = array();

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_default'),
            'value' => 'p.sort_order-ASC',
            'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
        );

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_name_asc'),
            'value' => 'pd.name-ASC',
            'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
        );

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_name_desc'),
            'value' => 'pd.name-DESC',
            'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
        );

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_price_asc'),
            'value' => 'p.price-ASC',
            'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
        );

        $data['sorts'][] = array(
            'text'  => $this->language->get('text_price_desc'),
            'value' => 'p.price-DESC',
            'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
        );

        $url = '';

        if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
        }

        if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
        }


        /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
        if (isset($this->request->get['bfilter'])) {
                $url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
        }
        /* Brainy Filter Pro (brainyfilter.xml) - End ->*/


                /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
				if (isset($this->request->get['bfilter'])) {
					$url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
				}
                /* Brainy Filter Pro (brainyfilter.xml) - End ->*/
        $data['limits'] = array();

        $limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

        sort($limits);

        foreach($limits as $value) {
            $data['limits'][] = array(
                    'text'  => $value,
                    'value' => $value,
                    'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
            );
        }

        $url = '';

        if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
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

        ///// gdemon questions ////////////////////////////////
        $data['text_question'] = $this->language->get('text_question');

        if(isset($filterseo_info['filterseo_id'])){
            $cache_name = 'questions.filterseo.' . $filterseo_info['filterseo_id'] .'.'. $lang . $_SERVER['HTTPS'];
        } else {
            $cache_name = 'questions.category.' . $category_id .'.'. $lang . $_SERVER['HTTPS'];
        }
        $data['questions'] = $this->cache->get($cache_name);

        $data['questions'] = array();

        if(!$data['questions']){
            if($filterseo_info){
                $questions= $this->model_catalog_category->getFilterseoQuestions($filterseo_info['filterseo_id']);
                $filterseo_id = $filterseo_info['filterseo_id'];
                //vdump($filterseo_id);
            } elseif (!isset($this->request->get['bfilter'])) {
                $questions= $this->model_catalog_category->getCategoryQuestions($category_id);
            } else {
                $questions = false;
            }

            if($questions && $page==1){

                foreach ($questions['questions'] as &$question){

                    /*if(isset($filterseo_id) && $filterseo_id==183){
                        $question['update_config'] = 0;
                        vdump($question);
                    }*/

                    if(empty($question['config']) || $question['config'] && !$question['update_config']){
                        //$config_temp  = array();
                        if(!empty($question['config'])) $config_temp = unserialize($question['config']);

                        if (preg_match_all('/\{.*?}/', $question['text'], $matches, PREG_OFFSET_CAPTURE)) {
                            foreach ($matches[0] as $match) {
                                $res = explode('*', str_replace(array('{','}'),'',$match[0]));
                                switch ($res[0]){
                                    case 'MINPRICE':
                                        $min_max = $this->model_module_brainyfilter->getMinMaxCategoryPrice();

                                        if(isset($min_max['min']) && $min_max['min']>0){
                                            $price = $this->currency->format($min_max['min']);
                                            $config_n[$question['question_id']]['MINPRICE'] = $price;
                                        } else {
                                            $query = $this->db->query("SELECT MIN(p.price) as price FROM oc_product p INNER JOIN oc_product_to_category ptc ON(p.product_id=ptc.product_id) WHERE ptc.category_id = '".(int)$category_id."'  AND p.price > 0");
                                            if($query->row){
                                                $price = $this->currency->format($query->row['price']);
                                                $config_n[$question['question_id']]['MINPRICE'] = $price;
                                            }
                                        }
                                        break;
                                    case 'RAND_PRODUCT':

                                        $lim = 3;
                                        if(isset($res[1])) $lim = (int)$res[1];
                                        if($lim<=0)$lim =3;

                                        $filter_data['limit'] = $lim;
                                        $filter_data['sort'] = 'rand';

                                        $results = $this->model_catalog_product->getProducts($filter_data);
                                        $prods = array();
                                        foreach ($results as $key => $value) {
                                            $prods[] = array(
                                                'product_id' =>$value['product_id']
                                            );
                                        }
                                        //vdump($prods);

                                        /*$sql = "SELECT p.product_id FROM oc_product p INNER JOIN oc_product_to_category ptc ON(p.product_id=ptc.product_id)  WHERE ptc.category_id = '".(int)$category_id."'  AND p.price>0 AND (ifexist=2 OR model LIKE 'U%') ORDER BY rand() LIMIT ".(int)$lim;
                                        $query = $this->db->query($sql );*/

                                        if($prods){
                                            $config_n[$question['question_id']]['RAND_PRODUCT']['LIMIT'] = $lim;
                                            //$config_n[$question['question_id']]['RAND_PRODUCT']['DATA'] = $query->rows;
                                            $config_n[$question['question_id']]['RAND_PRODUCT']['DATA'] = $prods;
                                        }

                                        break;
                                    case 'RAND_BRAND':
                                        $lim = 3;
                                        if(isset($res[1])) $lim = (int)$res[1];

                                        if($lim<=0)$lim =3;

                                        $key_brand = false;
                                        $filters_ = $this->model_module_brainyfilter->getFilters();

                                        if(isset($filters_[4949])){
                                            $key_brand = 4949;
                                        }elseif(isset($filters_[1])){
                                            $key_brand = 1;
                                        }

                                        if($key_brand ) {
                                            $brands = array_rand($filters_[$key_brand]['values'], $lim);

                                            if ($brands) {
                                                $config_n[$question['question_id']]['RAND_BRAND']['LIMIT'] = $lim;
                                                foreach ($brands as $brand_key) {

                                                    $br = $filters_[$key_brand]['values'][$brand_key];
                                                    $br['group_filter_id'] = $key_brand;
                                                    $config_n[$question['question_id']]['RAND_BRAND']['DATA'][]=$br;

                                                }
                                            }
                                        }

                                        break;
                                }

                            }
                        }

                        if($filterseo_info){
                            $sql = "UPDATE oc_filterseo_question SET config = '" . $this->db->escape(serialize($config_n[$question['question_id']])) . "'
                             , update_config = 1
                            WHERE filterseo_id ='".(int)$filterseo_id ."' AND question_id='".(int)$question['question_id']."'";
                        }else{
                            $sql = "UPDATE oc_category_question SET config = '" . $this->db->escape(serialize($config_n[$question['question_id']])) . "'
                             , update_config = 1
                            WHERE category_id='".(int)$category_id ."' AND question_id='".(int)$question['question_id']."'";
                        }
                        $this->db->query($sql);
                    } else {
                        $config_n[$question['question_id']] = unserialize($question['config']);
                    }
                }

                foreach ($questions['questions'] as &$question){
                    if(isset($config_n[$question['question_id']]['MINPRICE'])){
                        $question['text'] = str_replace('{MINPRICE}',$config_n[$question['question_id']]['MINPRICE'],$question['text']);
                    }
                    if(isset($config_n[$question['question_id']]['RAND_PRODUCT']['DATA'])){
                        $count = 0;
                        $html_products ='';

                        foreach($config_n[$question['question_id']]['RAND_PRODUCT']['DATA'] as $key => $row){

                            $prod_data = $this->model_catalog_product->getProduct($row['product_id']);

                            if(empty($prod_data) || isset($prod_data['ifexist']) &&  $prod_data['ifexist']==3){

                                unset($config_n[$question['question_id']]['RAND_PRODUCT']['DATA'][$key]);
                                $no_product = array();
                                foreach($config_n[$question['question_id']]['RAND_PRODUCT']['DATA'] as $row){
                                    $no_product[] = $row['product_id'];
                                }

                                /*$sql = "SELECT p.product_id FROM oc_product p INNER JOIN oc_product_to_category ptc ON(p.product_id=ptc.product_id) WHERE ptc.category_id = '".(int)$category_id."'  AND p.price>0 AND ifexist=2 AND p.product_id NOT IN(" . implode(',',$no_product) . ") ORDER BY rand() LIMIT 1";

                                $query = $this->db->query($sql);*/

                                $filter_data['limit'] = 1;
                                $filter_data['sort'] = 'rand';

                                $results = $this->model_catalog_product->getProducts($filter_data);

                                if($results){
                                    foreach($results as $rw){
                                        $config_n[$question['question_id']]['RAND_PRODUCT']['DATA'][]= $rw;
                                    }

                                    $prod_data = $this->model_catalog_product->getProduct($rw['product_id']);
                                    if($filterseo_info) {
                                        $sql = "UPDATE oc_category_question SET config = '" . $this->db->escape(serialize($config_n[$question['question_id']])) . "'
                                         , update_config = 1
                                        WHERE filterseo_id='" . (int)$filterseo_id . "' AND question_id='" . (int)$question['question_id'] . "'";
                                    }else{
                                        $sql = "UPDATE oc_category_question SET config = '" . $this->db->escape(serialize($config_n[$question['question_id']])) . "'
                                         , update_config = 1
                                        WHERE category_id='" . (int)$category_id . "' AND question_id='" . (int)$question['question_id'] . "'";
                                    }
                                    $this->db->query($sql);
                                }

                                //$sql = "UPDATE oc_category_question SET update_config = 0 WHERE category_id='".(int)$category_id ."' AND question_id='".(int)$question['question_id']."'";
                                //$this->db->query($sql);
                            }

                            $html_products .= '<a href="'. $this->url->link('product/product', 'product_id=' . $row['product_id']).'" title="'.$prod_data['name'].'">'.$prod_data['name'].'</a>';
                            $html_products .= ' - '.$this->currency->format($prod_data['price']);
                            if(count($config_n[$question['question_id']]['RAND_PRODUCT']['DATA'])!=$count+1)$html_products .=', <br>';
                            $count++;
                        }
                        $lim = $config_n[$question['question_id']]['RAND_PRODUCT']['LIMIT'];

                        $question['text'] = str_replace('{RAND_PRODUCT*'.$lim.'}',$html_products,$question['text']);
                    }
                    if(isset($config_n[$question['question_id']]['RAND_BRAND']['DATA'])){
                        $count =0;
                        $html_brands = '';
                        foreach ($config_n[$question['question_id']]['RAND_BRAND']['DATA'] as $br) {

                            $html_brands .= '<a href="'. $this->url->link('product/category', 'path=' . $this->request->get['path'].'&bfilter=f'.$br['group_filter_id'].':'.$br['id']).'" title="'.$br['name'].'">'.$br['name'].'</a>';

                            if(count($config_n[$question['question_id']]['RAND_BRAND']['DATA'])!=$count+1)$html_brands .=', ';
                            $count++;
                        }
                        $lim = $config_n[$question['question_id']]['RAND_BRAND']['LIMIT'];
                        $question['text'] = str_replace('{RAND_BRAND*'.$lim.'}',$html_brands,$question['text']);

                    }

                    $question['text'] = html_entity_decode(str_replace('{H1}', $data['heading_title'], $question['text']),ENT_QUOTES, 'UTF-8');
                    $question['name'] = str_replace('{H1}', $data['heading_title'], $question['name']);
                    $question['text'] = preg_replace('/\\{.*?}/', '', $question['text']);
                    $question['name'] = preg_replace('/\\{.*?}/', '', $question['name']);
                }


                $data['questions'] = $questions['questions'];

                $this->cache->set($cache_name, $data['questions']);
            }
        }

        //////////////////////////////////

        /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
        if (isset($this->request->get['bfilter'])) {
                $url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
        }
        /* Brainy Filter Pro (brainyfilter.xml) - End ->*/
        //echo '<br/>Время выполнения скрипта 6: '.round(microtime(true) - $start, 4).' сек.';
        if (isset($this->request->get['page']) && $this->request->get['page']>1) {
                $data['description'] = '';
        }


                /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
				if (isset($this->request->get['bfilter'])) {
					$url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
				}
                /* Brainy Filter Pro (brainyfilter.xml) - End ->*/
        $pagination = new Pagination();
        $pagination->total = $product_total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->text_first = false;
        $pagination->text_last = false;
        $pagination->text_prev = $this->language->get('text_prev');
        $pagination->text_next = $this->language->get('text_next');
        $pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');

        $data['pagination'] = $pagination->render();

        $data['page'] = $page;
        $data['count_pages'] = ceil($product_total / $limit);

        //$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));


        $url = '';
        if (isset($this->request->get['bfilter'])) {
            $url .= '&bfilter=' . urlencode(htmlspecialchars_decode($this->request->get['bfilter']));
        }
        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }


        if ($page == 1) {

            // Добавляем канонический адрес (сам на себя)
            // закоментировал (seoshild) - задача http://portal.vm.net/redmine/issues/11742
            //$this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'] . $url, 'SSL'), 'canonical');

            //$this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'] , 'SSL'), 'canonical');
            // Убираем вывод тега canonical для страниц фильтра
            //if (!isset($this->request->get['bfilter'])) {
            //    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'], 'SSL'), 'canonical');
            // }
        } elseif ($page == 2) {
            //$this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'], 'SSL'), 'prev');
            //$this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'] . $url, 'SSL'), 'canonical');
            $this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'], 'SSL'), 'canonical');
        } else {

            $this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page='. ($page - 1), 'SSL'), 'prev');
            $this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'], 'SSL'), 'canonical');
        }

        if ($limit && ceil($product_total / $limit) > $page) {

            $this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page='. ($page + 1), 'SSL'), 'next');
            //$this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'], 'SSL'), 'canonical');
        }

        // SEO перелинковка
        $ldata=$this->model_catalog_product->getSEOInterlonkData(str_replace('ua/', '', $landing_page));

        if (count($ldata->rows)!=0) {
          $interlink='<ul>';
          $langsuff=($this->language->get('code') == 'uk' ? '_ua' : '');
          $langpref=($this->language->get('code') == 'uk' ? '/ua' : '');
          foreach ($ldata->rows as $val) {
             $interlink .= '<li><a href="' . $langpref . $val['link'] . '">' . $val['title' . $langsuff] . '</a>';
          }
          $interlink.='</ul>';
        } else {
          $interlink = '';
        }
        $data['interlink']=$interlink;
        //vdump($interlink);

        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['limit'] = $limit;

        $data['continue'] = $this->url->link('common/home');

        /*
            генерация H1, title, description
            от SeoShild
        */
        // если не посадочные страницы
        if($seoshild){

                // получаем масив с названиями выбраных фильтров
             $result = $this->model_module_brainyfilter->getheadingaddition($fbase_group_id, $fbase_id, $fbase_group_id, $fbase_id,'',true);
            $filter_name_tmp ='';
             if($result){
                 $add_to_h1 = '';
                 $count = 0;
                 foreach ($result as $filter) {
                    if($count) $add_to_h1.=', ';
                    // Если бренд то с большой буквы
                    if(isset($filter['filter_group_id'])){
                    if($filter['filter_group_id'] == 4949){
                        if($filter_name_tmp == $filter['fgname']){
                            $add_to_h1 .= ucfirst($filter['name']);
                        } else {
                            $add_to_h1 .= mb_strtolower($filter['fgname']).': '.ucfirst($filter['name']);
                        }
                    }} else if(isset($filter['fgname'])){{
                        if($filter_name_tmp == $filter['fgname']){
                            $add_to_h1 .= mb_strtolower($filter['name']);
                        } else {
                            $add_to_h1 .= mb_strtolower($filter['fgname'].': '.$filter['name']);
                        }
                    }}
                    if(isset($filter['fgname'])){
                    $filter_name_tmp = $filter['fgname'];
                    }
                    $count++;
                 }

                if($category_info['meta_h1']){

                    $data['heading_title'] =$category_info['meta_h1'].' - '.$add_to_h1;
                } elseif($category_info['name']){
                    $data['heading_title'] =$category_info['name'].' - '.$add_to_h1;
                }
                $asdgf = $this->language->get('text_page2');
                $pageSuff = ($page>1 ? ' - ' . $this->language->get('text_page2').$page  : '');
                if($pageSuff) $data['heading_title'] .= ' '.$pageSuff;

                /*$title = trim($data['heading_title']).' - купить в Украине, стоимость в каталоге интернет магазина товаров для офиса prote.ua';
                $description = trim($data['heading_title'])." с доставкой в Киеве и по всей Украине в каталоге интернет магазина офисных товаров ★ prote.ua ★";*/

                $title = sprintf($this->language->get('text_title_seoshild3'), trim($data['heading_title']));
                $description = sprintf($this->language->get('text_description_seoshild3'), trim($data['heading_title']));

                if(!$set_title) $this->document->setTitle($title);
                if(!$set_description) $this->document->setDescription($description);
                //if (isset($this->request->get['admin'])) {
             //}
             } elseif(!empty($parts)){
                 foreach ($parts as $path_id) {
                    $cat_info = $this->model_catalog_category->getCategory($path_id);
                    if($cat_info['meta_h1']){
                        //$title = trim($data['heading_title'])." купить, ".trim(mb_strtolower($cat_info['meta_h1']))." по выгодным ценам в Украине - каталог интернет магазина товаров для офиса prote.ua";
                        //$description = trim($data['heading_title'])." цена в Украине с доставкой в Киеве, Одессе и Харькове 🚚 ".trim(mb_strtolower($cat_info['meta_h1']))." в каталоге интернет магазина офисных товаров ★ prote.ua ★";
                        $title = sprintf($this->language->get('text_title_seoshild1'), trim($data['heading_title']), trim(mb_strtolower($cat_info['meta_h1'])));
                        $description = sprintf($this->language->get('text_description_seoshild1'), trim($data['heading_title']), trim(mb_strtolower($cat_info['meta_h1'])));


                    } else{
                        //$title = trim($data['heading_title'])." купить, ".trim(mb_strtolower($cat_info['name']))." по выгодным ценам в Украине - каталог интернет магазина товаров для офиса prote.ua";
                        //$description = trim($data['heading_title'])." цена в Украине с доставкой в Киеве, Одессе и Харькове 🚚 ".trim(mb_strtolower($cat_info['name']))." в каталоге интернет магазина офисных товаров ★ prote.ua ★";
                        $title = sprintf($this->language->get('text_title_seoshild2'), trim($data['heading_title']), trim(mb_strtolower($cat_info['name'])));
                        $description = sprintf($this->language->get('text_description_seoshild2'), trim($data['heading_title']), trim(mb_strtolower($cat_info['name'])));
                    }
                    if(!$set_title) $this->document->setTitle($title);
                    if(!$set_description) $this->document->setDescription($description);


                }
             } elseif(empty($parts)){

                /*$cats = array(
                    '20' => 'расходные материалы',
                    '30' => 'лазерная печать',
                    '40' => 'матричная печать',
                    '50' => 'бумага и материалы',
                    '60' => 'компьютеры и аксессуары',
                    '80' => 'товары для офиса',
                    '125' => 'канцтовары',
                    '172' => 'хозтовары',
                    '200' => 'бытовая химия'
                );*/
                //if (array_key_exists($category_id, $cats)) {
                    //$title = trim($data['heading_title'])." купить, ".mb_strtolower(trim($data['heading_title']))." по выгодным ценам в каталоге интернет магазина товаров для офиса prote.ua";
                    //$description = trim($data['heading_title'])." в Киеве, Харькове и Одессе 🚚 ".mb_strtolower(trim($data['heading_title']))." с доставкой по всей Украине 🚚 цена в каталоге интернет магазина офисных товаров ★ prote.ua ★";
                    $title = sprintf($this->language->get('text_title_seoshild2'), trim($data['heading_title']), mb_strtolower(trim($data['heading_title'])));
                    $description = sprintf($this->language->get('text_description_seoshild2'), trim($data['heading_title']), mb_strtolower(trim($data['heading_title'])));

                    if(!$set_title) $this->document->setTitle($title);
                   if(!$set_description) $this->document->setDescription($description);
                //}

             }
        }


        $data['text_delivery_city'] = sprintf($this->language->get('text_delivery_city'), trim($data['heading_title']) );
        $this->load->model('localisation/zone');
        $data['cityes']= $this->model_localisation_zone->getZonesByCountryId(220);
        foreach ($data['cityes'] as $key => $city){
            $data['cityes'][$key]['href'] =$this->url->link('information/citydelivery', 'information_id=6&city=' . $city['zone_id']);

        }


        $this->document->setOgTitle(trim($data['heading_title']));
        $this->document->setOgDescription('Ищешь "'.trim($data['heading_title']).'"? Заходи и выбирай прямо сейчас!');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $data['text_populairprod'] = $this->language->get('text_populairprod');

        $data['popupcart'] ='';

        $this->response->setOutput($this->load->view('default/template/product/category.tpl', $data));

    } else {
        $url = '';

        if (isset($this->request->get['path'])) {
            $url .= '&path=' . $this->request->get['path'];
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
            'href' => $this->url->link('product/category', $url)
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

    // для gtag
    public function get_product(){

        $this->load->model('catalog/product');
        $product = array();

        if(isset($this->request->get['product_id'])) {
            $product_id = $this->request->get['product_id'];


            $result  = $this->model_catalog_product->getProduct($product_id);
            if($result){

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {$price = false;}

                $product = array(
                    'product_id'    => $result['product_id'],
                    //'category_name' => $category,
                    'name'          => $result['name'],
                    'model'         => $result['model'],
                    'price'         => $price,
                    'price_float'   => round($result['price'],2),
                    'minimum'       => $result['minimum'] > 0 ? $result['minimum'] : 1,
                    'quantity'      => $result['quantity']
                );

                $this->response->addHeader('Content-Type: application/json');
                $this->response->setOutput(json_encode($product));
            }
        }
    }
}