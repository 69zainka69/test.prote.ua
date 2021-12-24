<?php
class ControllerCommonSeoPro extends Controller {
    private $cache_data = null;
    private $bfilter_static = [];
    public function __construct($registry) {
        parent::__construct($registry);
        // Проверяем версию в кеше
        $this->cache_data = $this->cache->get('seo_pro', 'file');
        //$this->cache_data = $this->cache->get('seo_pro');

        //$this->cache_data = $this->cache->get('seo_pro', CACHE_DRIVER);
        if (!$this->cache_data || $this->cache_data['controls']<>count ($this->cache_data['keywords'])) {
            $query = $this->db->query("SELECT LOWER(`keyword`) as 'keyword', `query` FROM " . DB_PREFIX . "url_alias ORDER BY url_alias_id DESC");
            $this->cache_data = array();
            foreach ($query->rows as $row) {
                if (isset($this->cache_data['keywords'][$row['keyword']])){
                    $this->cache_data['keywords'][$row['query']] = $this->cache_data['keywords'][$row['keyword']];
                    //continue;
                }
                $this->cache_data['keywords'][$row['keyword']] = $row['query'];
                $this->cache_data['queries'][$row['query']] = $row['keyword'];
            }

            // Записываю дополнительное поле для контроля целостности прочитанных данных
            $this->cache_data['controls']=count($this->cache_data['keywords']);

            $this->cache->set('seo_pro', $this->cache_data, 'file');
            //$this->cache->set('seo_pro', $this->cache_data);

            //$this->cache->set('seo_pro', $this->cache_data, CACHE_DRIVER);
        }

    }

    public function index() {

        // Add rewrite to url class
        if ($this->config->get('config_seo_url')) {
            $this->url->addRewrite($this);
        } else {
            return;
        }


        // by gdemon
        if($this->config->get('config_redirects')){

            $redirects = array();
            $redirect_elements = explode(PHP_EOL, $this->config->get('config_redirects'));

            foreach($redirect_elements as $element){
                $to = explode("==", $element);
                if(count($to)!=2)continue;
                $redirects[$to[0]] = $to[1];
            }

            //$this->log->write(print_r($redirects,1));
            $server_request = substr($_SERVER["REQUEST_URI"], 1);
            $mas_uri = explode('?', $server_request);
            if(isset($mas_uri[0])){
                $server_request = $mas_uri[0];
            }
            $last_uri ='';
            if(isset($mas_uri[1])){
                $last_uri = $mas_uri[1];
            }

            if($server_request){

                if(array_key_exists($server_request, $redirects)) {
                    if($last_uri){
                        $location = HTTP_SERVER. $redirects[$server_request].'&'.htmlentities(urlencode($last_uri));
                    } else {
                        $location = HTTP_SERVER. $redirects[$server_request];
                    }

                    $this->response->redirect($location,301);
                }
            }
        }


        // Nikita_Sp Language MOD
        if(isset($this->request->get['_route_'])){
            $urllanguage = explode('/', trim(utf8_strtolower($this->request->get['_route_']), '/'));

            $this->load->model('localisation/language');
            $languages = $this->model_localisation_language->getLanguages();
            $lang = array();
            foreach($languages as $language){
                $lang[] = $language['code'];
            }

            if(isset($urllanguage[0]) && in_array($urllanguage[0], $lang)){
                if(count($urllanguage) > 1){
                    // если ua/ua/ редирект
                    if($urllanguage[0]==$urllanguage[1]){
                        $replace_lang = $urllanguage[0]."/";
                        $redirect = str_replace($replace_lang, '', $this->request->get['_route_']);
                        header($this->request->server['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
                        $this->response->redirect(HTTPS_SERVER.$replace_lang.$redirect);
                    }
                    $replace_lang = $urllanguage[0]."/";

                }else{
                        $replace_lang = $urllanguage[0];
                }
                $this->request->get['_route_'] = str_replace($replace_lang, '', $this->request->get['_route_']);
                if($this->request->get['_route_'] == ''){
                    unset($this->request->get['_route_']);
                }
            }
        }
        // End Nikita_Sp Language MOD


        //return;
        // Decode URL
        // echo $this->request->get['_route_'];
        if (!isset($this->request->get['_route_'])) {
            $this->validate();
        } else {

            if (strpos($this->request->get['_route_'],'*')!==false){
                $this->request->get['_route_'] = str_replace('*','x',$this->request->get['_route_']);
            } elseif(strpos($this->request->get['_route_'],':')!==false || strpos($this->request->get['_route_'],'%3A')!==false) {
                $this->request->get['_route_'] = str_replace(':','',$this->request->get['_route_']);
                $this->request->get['_route_'] = str_replace('%3A','',$this->request->get['_route_']);

            }
            //vdump($this->request->get['_route_']);


            // $route_ = $route = str_replace(array('----', '---', '--', '-,', ',-', ','),'-',$this->request->get['_route_']);
            // Заменил поиск использованием регулярных выражений. Так гибчее
            $route_ = $route = preg_replace('/[-|,]{1,10}/', '-', $this->request->get['_route_']);
            //  echo $this->request->get['_route_'];
            unset($this->request->get['_route_']);

            // Есть ли УРЛ для полного маршрута?
            if (isset($this->cache_data['keywords'][$route])){

                $keyword = $route;
                $parts = array($keyword);
                $rows = array(array('keyword' => $keyword, 'query' => $this->cache_data['keywords'][$keyword]));
            } else {

                $parts = explode('/', trim(utf8_strtolower($route), '/'));

                list($last_part) = explode('.', array_pop($parts));
                array_push($parts, $last_part);
                //  print_r($parts);
                $rows = array();

                foreach ($parts as $keyword) {
                    if (isset($this->cache_data['keywords'][$keyword])) {
                        $rows[] = array('keyword' => $keyword, 'query' => $this->cache_data['keywords'][$keyword]);
                    }
                }

            }

            if (count($rows) == sizeof($parts)) {

                $queries = array();
                foreach ($rows as $row) {
                    $queries[utf8_strtolower($row['keyword'])] = $row['query'];
                }
                 //vdump($queries);
                //vdump($parts);
                reset($parts);
 // echo "<pre>parts"; print_r($queries); echo "</pre>";
 // echo "<pre>parts"; print_r($parts); echo "</pre>";
                foreach ($parts as $key => $part) {
                    if(!isset($queries[$part])) return false;
                    $url = explode('=', $queries[$part], 2);
// echo "<pre>parts"; print_r($url); echo "</pre>";
                    if ($url[0] == 'manufacturer_id') {
                        $this->request->get['manufacturer_id'] = $url[1];
                    } elseif($url[0] == 'category_id' && isset($this->request->get['manufacturer_id'])) {
                        $this->request->get['categ_id'] = $url[1];

                    } elseif($url[0] == 'category_id') {
                        if (!isset($this->request->get['path'])) {
                            $this->request->get['path'] = $url[1];
                        } else {
                            if (strpos($this->request->get['path'], $url[1])===FALSE)
                                $this->request->get['path'] .= '_' . $url[1];
                        }
                    } elseif ($url[0] == 'informal_id') {
                        $this->request->get['informal_id'] = $url[1];
                    } elseif ($url[0] == 'solution_id') {
                        $this->request->get['solution_id'] = $url[1];
                    } elseif ($url[0] == 'workers_id') {
                        $this->request->get['workers_id'] = $url[1];
                    } elseif ($url[0] == 'news_id') {
                        $this->request->get['news_id'] = $url[1];
                    } elseif ($url[0] == 'articles_id') {
                        $this->request->get['articles_id'] = $url[1];
                    } elseif ($url[0] == 'brand_id') {
                        $this->request->get['brand_id'] = $url[1];
                    } elseif ($url[0] == 'prn') {
                        $this->request->get['prn'] = $url[1];
                    } elseif ($url[0] == 'city') {
                        $this->request->get['city'] = $url[1];
                    } elseif ($url[0] == 'bfilter') {
                        $bftmparray=explode(':',substr($url[1], 0, strlen($url[1])-1));
                        // echo "<pre> bftmparray "; print_r($bftmparray); echo "</pre>";
                        // $replace[] = $bftmparray[0];
                        // $bfarray[$bftmparray[0]][]=$bftmparray[1];
                        // $bftmparray2 = explode('-',$parts[$key]);
                        // $bfarray2[$bftmparray2[0]][]=$bftmparray[1];
                        // $find[] = $bftmparray2[0];
                        if(array_key_exists($bftmparray[0],$this->bfilter_static)){
                            if(!array_search ($bftmparray[1],$this->bfilter_static[$bftmparray[0]]))
                            array_push($this->bfilter_static[$bftmparray[0]],$bftmparray[1]);
                        }
                        else{
                            $this->bfilter_static[$bftmparray[0]]=[$bftmparray[1]];
                        }
                        // echo "<pre>"; print_r($parts); echo "</pre>";

    // 						if (!isset($this->request->get['bfilter'])) {
    // 							$this->request->get['bfilter'] = $url[1];
    // 						} else {
    //               if (strpos($this->request->get['bfilter'], $url[1])===FALSE)
    // 							   $this->request->get['bfilter'] .= $url[1];
    // 						}
                    } elseif (count($url) > 1) {
                        $this->request->get[$url[0]] = $url[1];
                    }
                }
// echo "<pre> maaxx"; print_r($this->bfilter_static); echo "</pre>";
                // bfilter
                if (count($this->bfilter_static)>0) {
                    // Сортировка ключей фильтра для установки однозначного порядка их следования (исключения дублей страниц)
                    // ksort($bfarray);
                    // ksort($bfarray2);
                    //  // echo "<pre>"; print_r($bfarray); echo "</pre>";
                    //  echo "<pre> bfarray2"; print_r($bfarray2); echo "</pre>";
                    //   echo "<pre> find"; print_r($find); echo "</pre>";
                    //    echo "<pre> replace"; print_r($replace); echo "</pre>";
                     // 30_31&bfilter=f10:77;f10061:7891;
                    // Игорь - 23.08.2017
                    $bfiltertxt='';
                    // foreach ($bfarray2 as $key=>$bfitem) {
                    //     $key = str_replace($find, $replace, $key);
                    //      echo "<pre>key"; print_r($key); echo "</pre>";
                    //     $bfiltertxt .= $key . ':' . implode(',', $bfitem) . ';';
                    // }
                    ksort($this->bfilter_static);
                    foreach ($this->bfilter_static as $key => $value) {
                        $bfiltertxt.=$key . ':' . implode(',', $value) . ';';
                    }
                     // echo "<pre> final"; print_r($bfiltertxt); echo "</pre>";
                    $this->request->get['bfilter'] = $bfiltertxt;
                }

            } else {
                $this->request->get['route'] = 'error/not_found';
            }

            if (isset($this->request->get['product_id'])) {
                $this->request->get['route'] = 'product/product';
                if (!isset($this->request->get['path'])) {
                        $path = $this->getPathByProduct($this->request->get['product_id']);
                        if ($path) $this->request->get['path'] = $path;
                } // echo $this->request->get['path']    ;
            } elseif (isset($this->request->get['path'])) {
                $this->request->get['route'] = 'product/category';
            } elseif (isset($this->request->get['manufacturer_id'])) {
                $this->request->get['route'] = 'product/manufacturer/info';

            } elseif (isset($this->request->get['informal_id'])) {
                $this->request->get['route'] = 'product/informal';

            } elseif (isset($this->request->get['solution_id'])) {
                $this->request->get['route'] = 'information/solutions';

            } elseif (isset($this->request->get['workers_id'])) {
                $this->request->get['route'] = 'information/workers';

            } elseif (isset($this->request->get['news_id'])) {
                $this->request->get['route'] = 'information/news/news';

            } elseif (isset($this->request->get['articles_id'])) {
                $this->request->get['route'] = 'information/articles/articles';

            } elseif (isset($this->request->get['brand_id'])) {
                $this->request->get['route'] = 'product/brand';

            } elseif (isset($this->request->get['tech_id'])) {
                $this->request->get['route'] = 'product/brand';

            } elseif (isset($this->request->get['prn'])) {
                $this->request->get['route'] = 'product/brand';
            } elseif (isset($this->request->get['city'])) {
                $this->request->get['route'] = 'information/citydelivery';
            } elseif (isset($this->request->get['information_id'])) {
                $this->request->get['route'] = 'information/information';

            } elseif(isset($this->cache_data['queries'][$route_])) {
                header($this->request->server['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
                $this->response->redirect($this->cache_data['queries'][$route_]);

            } else {
                if (isset($queries[$parts[0]])) {
                    $this->request->get['route'] = $queries[$parts[0]];
                }
            }

            $this->validate();
          //  print_r ($this->request->get);

            if (isset($this->request->get['route'])) {
                return new Action($this->request->get['route']);
            }
        }
    }



    public function rewrite($link) {
        //vdump($link);
        if (!$this->config->get('config_seo_url')) return $link;

        $seo_url = '';
    // echo $link;
    //  die();
        $component = parse_url(str_replace('&amp;', '&', $link));
        $component['scheme']="https";

        $data = array();
        //vdump($component['query']);
        parse_str($component['query'], $data);
        //vdump($data);

        $route = $data['route'];
        unset($data['route']);
    //vdump($route);
    //vdump($data);
        switch ($route) {
            case 'product/product':
                if (isset($data['product_id'])) {
                    $tmp = $data;
                    //$data = array();

                    unset($data['path']);
                    unset($data['prn']);
                    if ($this->config->get('config_seo_url_include_path')) {
                        $data['path'] = $this->getPathByProduct($tmp['product_id']);
                        if (!$data['path']) return $link;
                    }
                    $data['product_id'] = $tmp['product_id'];
                    if (isset($tmp['tracking'])) {
                        $data['tracking'] = $tmp['tracking'];
                    }
                    //vdump($data);
                }
                break;

            case 'product/category':
                if (isset($data['path'])) {
                    $category = explode('_', $data['path']);
                    $category = end($category);
                    $data['path'] = $this->getPathByCategory($category);
//  echo $data['path'];
  // echo "<pre>"; print_r($data); echo "</pre>";
                    if (!$data['path']) return $link;
                    //vdump($data);
                }
                break;
            case 'information/solutions':
                if (isset($data['solution_id'])) {
                    $data['solution_id']=$data['solution_id'];
                }
                break;
            case 'information/workers':
                if (isset($data['workers_id'])) {
                    $data['workers_id']=$data['workers_id'];
                }
                break;

            /*case 'product/manufacturer/info':
                if (isset($data['cat_id'])) {
                    $data['cat_id']=$data['cat_id'];
                }
                break; */

            case 'product/brand':
                if (isset($data['brand_id'])) {  // echo $data['brand_id'];
            // echo $link;
                    // return $link;
                        $brand_id = $data['brand_id']; // echo $link;
                        // $data['brand_id'] = $this->getPathByBrand($brand);
                        // $data['path']='brands';
                        // if (!$data['brand_id']) return $link;
                }

                if (isset($data['tech_id'])) { // echo $data['brand_id'];
            // echo $link;
                    // return $link;
                        $tech_id = $data['tech_id']; // echo $link;
                        // $data['brand_id'] = $this->getPathByBrand($brand);
                        // $data['path']='brands';
                        // if (!$data['tech_id']) return $link;
                }

                if (isset($data['prn'])) {  // echo $data['prn'];
            // echo $link;
                    // return $link;
                        $prn = $data['prn']; // echo $link;
                        // $data['brand_id'] = $this->getPathByBrand($brand);
                        // $data['path']='brands';
                        // if (!$data['prn']) return $link;
                }

                if (isset($data['category_id'])) {  // echo $data['prn'];
            // echo $link;
                    // return $link;
                        $category_id = $data['category_id']; // echo $link;
                        // $data['brand_id'] = $this->getPathByBrand($brand);
                        // $data['path']='brands';
                        // if (!$data['category_id']) return $link;
                }

                if (isset($data['cat_id'])) {  // echo $data['prn'];
            // echo $link;
                    // return $link;
                        $cat_id = $data['cat_id']; // echo $link;
                        // $data['brand_id'] = $this->getPathByBrand($brand);
                        // $data['path']='brands';
                        if (!$data['cat_id']) return $link;
                }



                break;
            case 'information/citydelivery':
                // print_r($data);
                if (isset($data['city'])) {  // echo $data['brand_id'];
            // echo $link;
                    // return $link;
                        $city_id = $data['city'];  // echo $link;
                        // $data['brand_id'] = $this->getPathByBrand($brand);
                        // $data['path']='brands';
                        // if (!$data['brand_id']) return $link;
                }
                break;

            case 'product/getajax/getProductCompabilityList':
            case 'product/product/review':
            case 'information/information/agree':
                return $link;
                break;

            default:
                break;
        }

        if ($component['scheme'] == 'https') {
            $link = $this->config->get('config_ssl');
        } else {
            $link = $this->config->get('config_url');
        }

        $link .= 'index.php?route=' . $route;

        if (count($data)) {
            $link .= '&amp;' . urldecode(http_build_query($data, '', '&amp;')); // echo $link;
        }
// print_r($data);
        /*echo "<pre>";
        print_r($data);
        echo "</pre>";*/
        //$this->request->get['route'] = 'product/manufacturer/info';
        $queries = array();
        /*if($route=='product/manufacturer/info'){
        vdump($route);
        vdump($data);
        }*/
        if(!in_array($route, array('product/search'))) {
            foreach($data as $key => $value) {
                switch($key) {
                    case 'category_id': unset($data[$key]); break;
                    case 'product_id':
                    // убрал потому что задваиваются категории
                    //  case 'category_id':
                    // ***************************************
                    case 'information_id':
                    case 'news_id':
                    case 'articles_id':
                    case 'order_id':
                    case 'group':
                        $queries[] = $key . '=' . $value;
                        unset($data[$key]);
                        $postfix = 1;
                        break;
                    case 'solution_id':
                        $queries[] = 'information/solutions';
                        $queries[] = $key . '=' . $value;
                        unset($data[$key]);
                        break;
                    case 'workers_id':
                        $queries[] = 'information/workers';
                        $queries[] = $key . '=' . $value;
                        unset($data[$key]);
                        break;
                    case 'brand_id':
                    case 'informal_id':
                    case 'tech_id':
                    case 'cat_id':
                    case 'prn':
                    case 'city':
                        $queries[] = $key . '=' . $value;
                        unset($data[$key]);
                        break;
                    case 'bfilter':
                        // echo $value;
                        // $bfilters = explode(';', substr($value, 0, strlen($value)-1));//print_r($bfilters);
                        $bfilters = explode(';', trim($value, " ;"));// print_r($bfilters);
                        foreach($bfilters as $bfilter) {
                            // обработка фильтров
                            // Выделяем номер и тело фильтра
                            $bfnum=substr($bfilter, 0, strpos($bfilter, ':')); // echo $bfilter;
                            $bfbody=substr($bfilter, strpos($bfilter, ':')+1, 40); // echo $bfbody;

                            $bfarray=explode(',', $bfbody); // print_r($bfarray);
                            foreach ($bfarray as $bfitem) {
                               $queries[] = 'bfilter=' . $bfnum . ':' . $bfitem .';' ;
                            }
                        }
                        unset($data[$key]);
                        break;
                    case 'path':
                        $categories = explode('_', $value);
                        foreach($categories as $category) {
                                $queries[] = 'category_id=' . $category;
                        }
                        // print_r($queries);
                        unset($data[$key]);
                        break;
                    case 'manufacturer_id':
                        $queries[] = $key . '=' . $value;
                        unset($data[$key]);
                        if(isset($data['categ_id'])){
                            $queries[] = 'category_id=' . $data['categ_id'];
                            unset($data['categ_id']);
                        }
                        //vdump($queries);
                        //$postfix = 1;
                        break;

                    /*case 'mcateg_id':
                        $queries[] = 'category_id=' . $value;
                        unset($data[$key]);
                        break;*/
                    default:
                        break;
                }
            }
        }
     // print_r($queries);
        if(empty($queries)) {
            $queries[] = $route;
        }

         //vdump($queries);
        $rows = array();
        foreach($queries as $query) {
            if(isset($this->cache_data['queries'][$query])) {
                $rows[] = array('query' => $query, 'keyword' => $this->cache_data['queries'][$query]);
            }
        }

        //vdump($rows);
        if(count($rows) == count($queries)) {
            $aliases = array();
            foreach($rows as $row) {
                $aliases[$row['query']] = str_replace('--','-',$row['keyword']);
            }
            foreach($queries as $query) {
                $seo_url .= '/' . rawurlencode($aliases[$query]);
            }
        }

        if ($seo_url == '') return $link;

        $seo_url = trim($seo_url, '/');
    // $seo_url = trim($seo_url, '-');

    // Language Mod by Nikita_Sp
    //$this->load->model('setting/setting');
    //$store_settings_config = $this->model_setting_setting->getSetting("config", $this->config->get('config_store_id'));

    //if(isset($this->session->data['language']) && $this->session->data['language'] != $store_settings_config['config_language']){

    if (isset($this->session->data['language']) && $this->session->data['language'] != 'ru')
    {
        $seo_url = $this->session->data['language'] . '/' . $seo_url;
    }

    // End Language Mob by Nikita_Sp
    if(!empty($data['language']) && $data['language'] != 'ru')
    {
        $seo_url = $data['language'] . '/' . $seo_url;
    }

    if ($component['scheme'] == 'https') {
            $seo_url = $this->config->get('config_ssl') . $seo_url;
    } else {
            $seo_url = $this->config->get('config_url') . $seo_url;
    }

    if (isset($postfix)) {
            $seo_url .= trim($this->config->get('config_seo_url_postfix'));
    } else {
            $seo_url .= '/';
    }
//   echo $seo_url;
    if(substr($seo_url, -2) == '//') {
            $seo_url = substr($seo_url, 0, -1);
    }

    if (count($data)) {
            $seo_url .= '?' . urldecode(http_build_query($data, '', '&amp;'));
    }
     // echo $seo_url; die();
    //vdump($seo_url);
		return $seo_url;
	}

    public function arewrite($link='') {

        $link=urldecode($_GET['url']);
        $link = $this->rewrite($link);
        $link = str_replace('&amp;', '&', $link);
        echo json_encode($link);

        //$lang=urldecode($_GET['lang']);
        /*
        if($lang=='ua'){
            echo json_encode(str_replace(HTTPS_SERVER,HTTPS_SERVER.$lang.'/',$this->rewrite($link)));
        } else {
            echo json_encode($this->rewrite($link));
        }*/

    }

	private function getPathByProduct($product_id) {
		$product_id = (int)$product_id;
		if ($product_id < 1) return false;

		static $path = null;
		if (!isset($path)) {
			$path = $this->cache->get('product.seopath');
			if (!isset($path)) $path = array();
		}

		if (!isset($path[$product_id])) {
			$query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . $product_id . "' ORDER BY main_category DESC LIMIT 1");

			$path[$product_id] = $this->getPathByCategory($query->num_rows ? (int)$query->row['category_id'] : 0);

			$this->cache->set('product.seopath', $path);
		}

		return $path[$product_id];
	}

	private function getPathByCategory($category_id) { // echo $category_id . '/';
		$category_id = (int)$category_id;
		if ($category_id < 1) return false;

		static $path = null;
		if (!isset($path)) {
			// $path = $this->cache->get('category.seopath');
			if (!isset($path)) $path = array();
		}

		if (!isset($path[$category_id])) {
			$max_level = 10;

			$sql = "SELECT CONCAT_WS('_'";
			for ($i = $max_level-1; $i >= 0; --$i) {
				$sql .= ",t$i.category_id";
			}
			$sql .= ") AS path FROM " . DB_PREFIX . "category t0";
			for ($i = 1; $i < $max_level; ++$i) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "category t$i ON (t$i.category_id = t" . ($i-1) . ".parent_id)";
			}
			$sql .= " WHERE t0.category_id = '" . $category_id . "'";
// echo $sql;
			$query = $this->db->query($sql);

			$path[$category_id] = $query->num_rows ? $query->row['path'] : false;

			$this->cache->set('category.seopath', $path);
		}
 //  echo $path[$category_id];
		return $path[$category_id];
	}

	private function getPathByBrand($brand) {

		if (!$brand) return false;

		static $path = null;
		if (!isset($path)) { // echo 2;
			$path = $this->cache->get('brand.seopath');
			if (!isset($path)) $path = array();
		}

		if (!isset($path[$brand])) { // echo 3;
//			$max_level = 10;
//
//			$sql = "SELECT CONCAT_WS('_'";
//			for ($i = $max_level-1; $i >= 0; --$i) {
//				$sql .= ",t$i.category_id";
//			}
//			$sql .= ") AS path FROM " . DB_PREFIX . "category t0";
//			for ($i = 1; $i < $max_level; ++$i) {
//				$sql .= " LEFT JOIN " . DB_PREFIX . "category t$i ON (t$i.category_id = t" . ($i-1) . ".parent_id)";
//			}
//			$sql .= " WHERE t0.category_id = '" . $category_id . "'";
//
//			$query = $this->db->query($sql);

			$path[$brand] = $brand;

			$this->cache->set('brand.seopath', $path);
		}
          // echo '>'.$path[$brand];
		return $path[$brand];
	}

	private function validate() {
		if (isset($this->request->get['route']) && $this->request->get['route'] == 'error/not_found') {
			return;
		}
		if (ltrim($this->request->server['REQUEST_URI'], '/') =='sitemap.xml') {
			$this->request->get['route'] = 'feed/google_sitemap';
			return;
		}

		if(empty($this->request->get['route'])) {
			$this->request->get['route'] = 'common/home';
		}

		if (isset($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return;
		}

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$config_ssl = substr($this->config->get('config_ssl'), 0, $this->strpos_offset('/', $this->config->get('config_ssl'), 3) + 1);

    		$url = str_replace('&amp;', '&', $config_ssl . ltrim($this->request->server['REQUEST_URI'], '/'));
      		$seo = str_replace('&amp;', '&', $this->url->link($this->request->get['route'], $this->getQueryString(array('route')), true));

            /*vdump(rawurldecode($url));
            vdump(rawurldecode($seo));
            vdump(('/' . ltrim($this->request->server['REQUEST_URI'], '/')));
            vdump($this->request->server['REQUEST_URI']);*/

		} else {
			$config_url = substr($this->config->get('config_url'), 0, $this->strpos_offset('/', $this->config->get('config_url'), 3) + 1);
			// $url = str_replace('&amp;', '&', $config_url . $this->request->server['REQUEST_URI']); // ltrim($this->request->server['REQUEST_URI'], '/'));
			$seo = str_replace('&amp;', '&', $this->url->link($this->request->get['route'], $this->getQueryString(array('route')), false));
            $url = str_replace('&amp;', '&', $config_url . ltrim($this->request->server['REQUEST_URI'], '/'));

		}
        /*vdump($seo);
        vdump($url);
        vdump(rawurldecode($url));
        vdump(rawurldecode($seo));*/

        // Проверка - если УРЛ не совпадает с преобразованным для СЕО УРЛ - нужна переадресация
		if (rawurldecode($url) != rawurldecode($seo) || ('/' . ltrim($this->request->server['REQUEST_URI'], '/') <> $this->request->server['REQUEST_URI']) ) {

			//header($this->request->server['SERVER_PROTOCOL'] . ' 301 Moved Permanently');

            ///////////////////////////

			$this->response->redirect($seo, 301);
		}

	}

	private function strpos_offset($needle, $haystack, $occurrence) {
		// explode the haystack
		$arr = explode($needle, $haystack);
		// check the needle is not out of bounds
		switch($occurrence) {
			case $occurrence == 0:
				return false;
			case $occurrence > max(array_keys($arr)):
				return false;
			default:
				return strlen(implode($needle, array_slice($arr, 0, $occurrence)));
		}
	}

    private function getQueryString($exclude = array()) {
            if (!is_array($exclude)) {
                    $exclude = array();
                    }

            return urldecode(http_build_query(array_diff_key($this->request->get, array_flip($exclude))));
            }


  private function ru2Lat($string)
  {
    $rus = array('ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я',' ', '.','+','(',')','/','\\',chr(34),chr(39));
    $lat = array('yo','zh','tc','ch','sh','sh','yu','ya','yo','zh','tc','ch','sh','sh','yu','ya', '-', '', '', '','', '', '', '', '');
    $string = str_replace($rus,$lat,$string);
    $string = str_ireplace(
    array('А','Б','В','Г','Д','Е','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ъ','Ы','Ь','Э','а','б','в','г','д','е','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ъ','ы','ь','э'),
    array('a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e','a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e'),
    $string);

    $string = str_ireplace('--','-', $string);
    return strtolower ($string);
  }
}

?>
