<?php
class ControllerCommonHeader extends Controller {

    public function index() {

   

        $route ='';

        //$information_id = false;
        if (isset($this->request->get['route'])) {
            $route=$this->request->get['route'];
            $data['route']=$this->request->get['route'];
        }
        /*if (isset($this->request->get['information_id'])) {
            $information_id=$this->request->get['information_id'];
        }*/

        // gdemon 11/07/2018  noindex, follow для страниц по требованию Алены
        //<meta name="robots" content="noindex, follow"/>
        $data['noindex'] = false;


        $count_filter = 0;
        if(isset($this->request->get['bfilter'])){
        $params = explode(';', $this->request->get['bfilter']);
        foreach ($params as $param) {
            if (!empty($param)){
                $p = explode(':', $param);
                $p = explode(',', $p[1]);
                $count_filter+=count($p);
            }
        }
        }


        
        if(isset($this->request->get['bfilter']) && stripos($this->request->get['bfilter'],'price') !== FALSE || $count_filter>2){
            

            switch ($this->request->get['bfilter']){
                case 'f5:70,72;f59:119;': // gdemon 29/10/2018 добавил условие по задаче http://pager.seoshield.ru/project/5b55c6289a2a1c404f8b50e4/discussion/5bd71c879a2a1c26078b4eb6
                case 'f3:9392;f84:9391;f87:128;': // paper-materials/photo-paper/f3-500/f84-10x15/f13-matovaya/
                case 'f3:9392;f84:9391;f87:126;': // paper-materials/photo-paper/f3-500/f84-10x15/f13-glyantcevaya/
                    break;
                default:
                    $data['noindex'] = '<meta name="robots" content="noindex,nofollow"/>';
            }


        } elseif (
            $route=='product/search'||
               isset($this->request->get['sort'])
            || isset($this->request->get['order'])
            || isset($this->request->get['limit'])
            || isset($this->request->get['utm']) || isset($this->request->get['gclid']) || isset($this->request->get['UAH'])
            || isset($this->request->get['RUR']) || isset($this->request->get['WMZ']) || isset($this->request->get['USD'])
            || isset($this->request->get['utm'])
            || isset($this->request->get['search']) || isset($this->request->get['sort'])
        ) {
            //$data['noindex'] = '<meta name="robots" content="noindex, follow"/>';
            // gdemon 06/09/2018  заменил с noindex,follow на noindex, nofollow для страниц по требованию seoshield
            $data['noindex'] = '<meta name="robots" content="noindex,nofollow"/>';

        } elseif($route=='account/login'|| $route=='account/register'|| $route=='checkout/checkout'|| $route=='checkout/cart'|| $route=='checkout/register'||$route=='checkout/success'){
            $data['noindex'] = '<meta name="robots" content="noindex, nofollow, noarchive"/>';
        }
     

        global $start;

        // Идентификатор языка. Используется для кеширования и т.д.
        $lang = $this->language->get('code');

        // Analytics
        $this->load->model('extension/extension');
        $this->load->language('common/header');

        // $data['main_menu'] = $this->cache->get('menu_html_' . $lang);
        //$data['main_menu'] = false;

        if (!isset($data['main_menu'])) {

            $data['main_menu'] = $this->response->minify_html($this->load->controller('common/menu'));
            //$this->cache->set('menu_html_' . $lang, $data['main_menu']);
            //vdump($data['main_menu']);
        }

        if ($this->request->server['HTTPS']) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }

        /*if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
            $this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
        }*/

        //$this->document->addLink(HTTPS_SERVER . 'image/ico/favicon_prote_16x16.svg', 'icon');

        $data['title'] = $this->document->getTitle();
        $data['base'] = $server;
        $data['description'] = $this->document->getDescription();
        $data['keywords'] = $this->document->getKeywords();
        $data['links'] = $this->document->getLinks();
        $data['styles'] = $this->document->getStyles();
        $data['scripts'] = $this->document->getScripts();
        $data['lang'] = $lang;
        if($lang=='uk'){
             $data['lang_loc'] = "uk-UA";
        } else {
            $data['lang_loc'] = "ru-UA";
        }
        $langurl=($lang=='uk'?'/ua':'');
        $data['direction'] = $this->language->get('direction');

        $data['name'] = $this->config->get('config_name');

        if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
            $data['logo'] = $server . 'image/' . $this->config->get('config_logo');
        } else {
            $data['logo'] = '';
        }


        $data['og_url'] = (isset($this->request->server['HTTPS']) ? HTTPS_SERVER : HTTP_SERVER) . substr($this->request->server['REQUEST_URI'], 1, (strlen($this->request->server['REQUEST_URI'])-1));
        $data['og_image'] = $this->document->getOgImage();
        $data['og_title'] = $this->document->getOgTitle();
        $data['og_description'] = htmlspecialchars($this->document->getOgDescription(),ENT_QUOTES);

        $data['text_home'] = $this->language->get('text_home');


        $data['text_account'] = $this->language->get('text_account');
        $data['text_register'] = $this->language->get('text_register');
        $data['text_login_first_line'] = $this->language->get('text_login_first_line');
        $data['text_login_second_line'] = $this->language->get('text_login_second_line');
        $data['text_order'] = $this->language->get('text_order');
        //$data['text_transaction'] = $this->language->get('text_transaction');
        //$data['text_download'] = $this->language->get('text_download');
        $data['text_logout'] = $this->language->get('text_logout');
        //$data['text_checkout'] = $this->language->get('text_checkout');
        $data['text_callback'] = $this->language->get('text_callback');
        $data['text_timetable'] = $this->language->get('text_timetable');
        //$data['text_page'] = $this->language->get('text_page');
        $data['text_category'] = $this->language->get('text_category');
        $data['text_all'] = $this->language->get('text_all');
        $data['text_delivery'] = $this->language->get('text_delivery');
        $data['text_articles'] = $this->language->get('text_articles');
        $data['text_pay'] = $this->language->get('text_pay');
        $data['text_warranty'] = $this->language->get('text_warranty');
        $data['text_contacts'] = $this->language->get('text_contacts');
        $data['text_bonus'] = $this->language->get('text_bonus');
        $data['text_about'] = $this->language->get('text_about');
        $data['text_select_city'] = $this->language->get('text_select_city');
        //$data['text_addedtobasket'] = $this->language->get('text_addedtobasket');
        //$data['text_checkout'] = $this->language->get('text_checkout');
        //$data['text_continue'] = $this->language->get('text_continue');
        $data['text_sitename'] = $this->language->get('text_sitename');
        $data['text_menu'] = $this->language->get('text_menu');
        $data['text_menu2'] = $this->language->get('text_menu2');
        $data['text_menu2'][7] = sprintf($data['text_menu2'][7], $this->url->link('information/readycart', '', 'SSL'));
        $data['text_menu_bublik'] = $this->language->get('text_menu_bublik');
        $data['text_action1'] = $this->language->get('text_action');
        $data['text_action2'] = $this->language->get('text_action2');

        $data['text_action3'] = sprintf($this->language->get('text_action3'),$this->url->link('information/news', '', 'SSL'));
        $data['text_action4'] = $this->language->get('text_action4');
        $data['text_action5'] = sprintf($this->language->get('text_action5'), $langurl.'/');
        $data['text_readycart'] = $this->language->get('text_readycart');
        $data['text_readycart_'] = $this->language->get('text_readycart_');
        $data['text_readycart2'] = $this->language->get('text_readycart2');
        $data['text_sl1'] = $this->language->get('text_sl1');
        $data['text_sl2'] = $this->language->get('text_sl2');
        $data['text_sl3'] = $this->language->get('text_sl3');
        $data['text_sl4'] = $this->language->get('text_sl4');
        $data['text_sl5'] = $this->language->get('text_sl5');

        
        // модальное окно
        $data['modal_title'] = $this->language->get('modal_title');
        $data['modal_tel'] = $this->language->get('modal_tel');
        $data['modal_name'] = $this->language->get('modal_name');
        $data['modal_info'] = $this->language->get('modal_info');
        $data['modal_time'] = $this->language->get('modal_time');
        $data['modal_btn_call'] = $this->language->get('modal_btn_call');

        $data['home'] = $this->url->link('common/home');
        //$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
        $data['logged'] = $this->customer->isLogged();
        if($data['logged']){
            $data['name'] =$this->customer->getFirstname().' '.$this->customer->getLastname();
        }
        $data['account'] = $this->url->link('account/account', '', 'SSL');
        $data['register'] = $this->url->link('account/register', '', 'SSL');
        $data['login'] = $this->url->link('account/login', '', 'SSL');
        $data['order'] = $this->url->link('account/order', '', 'SSL');
        //$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
        //$data['download'] = $this->url->link('account/download', '', 'SSL');
        $data['logout'] = $this->url->link('account/logout', '', 'SSL');
        $data['shopping_cart'] = $this->url->link('checkout/cart', '', 'SSL');
        $data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
        $data['contact'] = $this->url->link('information/contact', '', 'SSL');
        $data['readycart'] = $this->url->link('information/readycart', '', 'SSL');
        $data['telephone'] = $this->config->get('config_telephone');
        $data['login_html'] = $this->load->controller('account/login/get_login', 'header');

        $status = true;

        if (isset($this->request->server['HTTP_USER_AGENT'])) {
            $robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

            foreach ($robots as $robot) {
                if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
                    $status = false;

                    break;
                }
            }
        }


        // Переключатель языков
        /*$current_url=$_SERVER['REQUEST_URI'];
        if ($lang=='uk') {
            $current_url=str_replace('/ua/','',$current_url);
            $langswitch="<div id='langswitchmob'><strong>УКР&nbsp;&nbsp;<a href='$current_url'>РУС</a></strong></div>";
        } else {
            $current_url='/ua'.$current_url;
            $langswitch="<div id='langswitchmob'><strong><a href='$current_url'>УКР</a>&nbsp;&nbsp;РУС</strong></div>";
        }*/


        //$data['language'] = $this->load->controller('common/language');
        //$data['currency'] = $this->load->controller('common/currency');
        $data['search'] = $this->load->controller('common/search');
        $data['cart'] = $this->load->controller('common/cart');
        //$data['langswitch'] = $langswitch;

        // For page specific css
        if (isset($this->request->get['route'])) {
            if (isset($this->request->get['product_id'])) {
                $class = '-' . $this->request->get['product_id'];
            } elseif (isset($this->request->get['path'])) {
                $class = '-' . $this->request->get['path'];
            } elseif (isset($this->request->get['manufacturer_id'])) {
                $class = '-' . $this->request->get['manufacturer_id'];
            } else {
                $class = '';
            }

            $data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
        } else {
            $data['class'] = 'common-home';
        }

        if($data['class']=='common-home'){

            $this->load->model('design/banner');
            $results = $this->model_design_banner->getBanner(9);

            $data['banners'] = array();

            foreach ($results as $result) {
                if (is_file(DIR_IMAGE . $result['image'])) {
                    $data['banners'][] = array(
                        'title' => $result['title'],
                        'link'  => $result['link'],
                        'image' => $this->model_tool_image->resize($result['image'], 1260, 430)
                    );
                }
            }

        }


        return $this->load->view('default/template/common/header.tpl', $data);

    }

}
