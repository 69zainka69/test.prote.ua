<?php
require_once DIR_ROOT . '/system/library/TimeAgo.php';
require_once DIR_ROOT . '/system/library/TimeAgo/Language.php';
require_once DIR_ROOT . '/system/library/TimeAgo/Translations/Uk.php';

use Westsworld\TimeAgo\Translations\Uk;
use Westsworld\TimeAgo;
use Westsworld\TimeAgo\Language;
class ControllerInformationShopRating extends Controller {

    private $error = array();

    public function index($homePageTpl = false) {
        $this->load->language('information/shop_rating');

        $this->load->model('catalog/shop_rating');
        if(!$homePageTpl) {
            $this->document->setTitle($this->language->get('heading_title'));
        }
        $this->document->addStyle('view/theme/default/stylesheet/remodal/remodal.css');
        $this->document->addStyle('view/theme/default/stylesheet/remodal/remodal-default-theme.css');
        $this->document->addStyle('view/theme/default/stylesheet/shop_rate.css');
        $lang = $this->language->get('code'); 
		if ($lang == 'uk') {
            setlocale(LC_ALL, 'uk_UA.UTF-8');
        } else {
            setlocale(LC_ALL, 'ru_RU.UTF-8');
        }
       /* $this->document->addScript('https://www.google.com/recaptcha/api.js');
        if ($this->config->get('config_google_captcha_status')) {
            $this->document->addScript('https://www.google.com/recaptcha/api.js');
        }*/

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            if ($this->validate()) {
            $rating_id = $this->model_catalog_shop_rating->addRating($this->request->post);

            if($rating_id > 0){
                if($this->config->get('shop_rating_moderate')){
                    $msg = $this->language->get('shop_rating_success_text_moderate');
                }else{
                   $msg = $this->language->get('shop_rating_success_text');
                }
                $this->session->data['rating_send'] = true;
            }
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode(['success' => $msg]));
            return;
        } else {
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode(['error' => $this->error]));
            return;
        }
    }


        if(isset($this->session->data['shop_rating_success_text'])){
            $data['success'] = $this->session->data['shop_rating_success_text'];
            unset($this->session->data['shop_rating_success_text']);
        }else{
            $data['success'] = '';
        }
        if(isset($this->session->data['rating_send'])){
            $data['rating_send'] = false;
            $this->session->data['rating_send']= false;
        }else{
            $data['rating_send'] = false;
        }
        //$data['rating_send'] = false;

        $data['heading_title'] = $this->language->get('heading_title');
        $data['module_description'] = $this->language->get('module_description');
        $data['send_rating'] = $this->language->get('send_rating');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home','','SSL')
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('information/shop_rating','','SSL')
        );

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');



        $data['text_rate'] = $this->language->get('text_rate');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_comment'] = $this->language->get('entry_comment');
        $data['entry_good'] = $this->language->get('entry_good');
        $data['entry_bad'] = $this->language->get('entry_bad');
        $data['entry_rate'] = $this->language->get('entry_rate');
        $data['entry_site_rate'] = $this->language->get('entry_site_rate');
        $data['button_submit'] = $this->language->get('button_send');
        $data['button_close'] = $this->language->get('button_close');
        $data['god_bad_desc'] = $this->language->get('god_bad_desc');
        $data['registered_customer_text'] = $this->language->get('registered_customer_text');
        $data['answer'] = $this->language->get('answer');
        $data['text_summary'] = $this->language->get('text_summary');
        $data['text_count'] = $this->language->get('text_count');
        $data['text_will_send'] = $this->language->get('text_will_send');
        $data['text_email_desc'] = $this->language->get('text_email_desc');
        $data['error_star_empty'] = $this->language->get('error_star_empty');
        $data['total'] = $this->model_catalog_shop_rating->getStoreRatingsTotal();
        $data['planing_buy'] = round((100 / $data['total']) * $this->model_catalog_shop_rating->getCountCutomerPlaningBuy());

        $data['text_reviews_about'] = $this->language->get('text_reviews_about');
        $data['text_reviews_count'] = $this->language->get('text_reviews_count');
        $data['text_count_sended'] = $this->language->get('text_count_sended');
        $data['text_recomendation'] = $this->language->get('text_recomendation');
        $data['text_count_planingbuy'] = $this->language->get('text_count_planingbuy');
        $data['text_all_ratings'] = $this->language->get('text_all_ratings');
        $data['text_service_rate'] = $this->language->get('text_service_rate');
        $data['text_mind']  = $this->language->get('text_mind');
        $data['title_service']  = $this->language->get('title_service');
        $data['title_delivery'] = $this->language->get('title_delivery');
        $data['title_product'] = $this->language->get('title_product');
        $data['title_leavereview'] = $this->language->get('title_leavereview');
        $data['text_appreciate'] = $this->language->get('text_appreciate');
        $data['text_planinglable'] = $this->language->get('text_planinglable');
        $data['title_male'] = $this->language->get('title_male');
        $data['title_famale'] = $this->language->get('title_famale');
        $data['title_name'] = $this->language->get('title_name');
        $data['title_city'] = $this->language->get('title_city');
        $data['title_review'] = $this->language->get('title_review');
        $data['title_more'] = $this->language->get('title_more');
        $data['title_manager'] = $this->language->get('title_manager');
        $data['title_read_more'] = $this->language->get('title_read_more');
        
        $data['action'] = $this->url->link('information/shop_rating', '', 'SSL');
        $url = '';
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        if($homePageTpl) {
            $filter_count = 15;
        } else {
            $filter_count = 9;
        }
        if($this->config->get('shop_rating_count')){
            $filter_count = $this->config->get('shop_rating_count');
        }
        $filter_data = array(
            'start'             => ($page - 1) * $filter_count,
            'limit'             => $filter_count
        );

        $total = $this->model_catalog_shop_rating->getStoreRatingsTotal($filter_data);
        $data['ratings'] = $this->model_catalog_shop_rating->getStoreRatings($filter_data);
        $data['ratings_home'] = $data['ratings'];
        $idLang = $this->config->get('config_language_id');
        foreach($data['ratings'] as $key=>$rating_item){
            $data['ratings'][$key]['customs'] = $this->model_catalog_shop_rating->getRateCustomRatings($rating_item['rate_id']);
        }
        foreach($data['ratings_home'] as &$rating) {
            $rating['date_added'] = $this->time_elapsed_string($rating['date_added'], $lang);
         }
      //  $data['general']['count'] = 0;
        $data['general']['1'] = 0;
        $data['general']['2'] = 0;
        $data['general']['3'] = 0;
        $data['general']['4'] = 0;
        $data['general']['5'] = 0;
        $x = [
            'service' => 0,
            'goods' => 0,
            'delivery' => 0
        ];

        $summ = [
            'service' => 0,
            'goods' => 0,
            'delivery' => 0
        ];


        foreach($this->model_catalog_shop_rating->getStoreRatingsAll() as $rate){
            if(isset($rate['service_rate']) && $rate['service_rate'] > 0){
                $data['general'][$rate['service_rate']]++;
                $summ['service'] = $summ['service'] + $rate['service_rate'];
                $x['service']++;
            }

            if(isset($rate['goods_rate']) && $rate['goods_rate'] > 0){
                $data['general'][$rate['goods_rate']]++;
                $summ['goods'] = $summ['goods'] + $rate['goods_rate'];
                $x['goods']++;
            }

            if(isset($rate['delivery_rate']) && $rate['delivery_rate'] > 0){
                $data['general'][$rate['delivery_rate']]++;
                $summ['delivery'] = $summ['delivery'] + $rate['delivery_rate'];
                $x['delivery']++;
            }
        }
        $data['general']['count']['service'] = $x['service'];
        $data['general']['count']['goods'] = $x['goods'];
        $data['general']['count']['delivery'] = $x['delivery'];
        foreach($x as $key => $value) {
            if($value > 0 ){
                $data['general']['summ'][$key] = str_replace('.', ',', round($summ[$key]/$x[$key], 1));
                $data['general']['summ_perc'][$key] = round($summ[$key]/$x[$key], 1)*100/5;
            }else{
                $data['general']['summ'][$key] = 0;
                $data['general']['summ_perc'][$key] = 0;
            }
        }
        
        $answers = $this->model_catalog_shop_rating->getRatingAnswers();
        $data['rating_answers'] = $answers;

        $data['shop_rating_moderate'] = $this->config->get('shop_rating_moderate');
        $data['shop_rating_authorized'] = $this->config->get('shop_rating_authorized');
        $data['shop_rating_summary'] = $this->config->get('shop_rating_summary');
        $data['shop_rating_shop_rating'] = $this->config->get('shop_rating_shop_rating');
        $data['shop_rating_site_rating'] = $this->config->get('shop_rating_site_rating');
        $data['shop_rating_good_bad'] = $this->config->get('shop_rating_good_bad');

        $data['form_custom_types'] = $this->model_catalog_shop_rating->getCustomTypes();
        $data['text_login'] = sprintf($this->language->get('text_login_error'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));

        $data['customer_id'] = $this->customer->getId();


        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
        }
        if (isset($this->error['comment'])) {
            $data['error_comment'] = $this->error['comment'];
        } else {
            $data['error_comment'] = '';
        }
        if (isset($this->error['captcha'])) {
            $data['error_captcha'] = $this->error['captcha'];
        } else {
            $data['error_captcha'] = '';
        }


        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } else {
            $data['name'] = $this->customer->getFirstName();
        }

        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } else {
            $data['email'] = $this->customer->getEmail();
        }
        if (isset($this->request->post['comment'])) {
            $data['comment'] = $this->request->post['comment'];
        } else {
            $data['comment'] = '';
        }
        if (isset($this->request->post['good'])) {
            $data['good'] = $this->request->post['good'];
        } else {
            $data['good'] = '';
        }
        if (isset($this->request->post['bad'])) {
            $data['bad'] = $this->request->post['bad'];
        } else {
            $data['bad'] = '';
        }
        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } else {
            $data['name'] = $this->customer->getFirstName();
        }

        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } else {
            $data['email'] = $this->customer->getEmail();
        }

        if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {

            $data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'), $this->error);

        } elseif ($this->config->get('config_google_captcha_status')) {
                $data['site_key'] = $this->config->get('config_google_captcha_public');
                $data['captcha'] = '<div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="g-recaptcha" data-sitekey="'.$data['site_key'].'"></div>';
                if ($data['error_captcha']){
                    $data['captcha'] .=' <div class="text-danger">'.$data['error_captcha'].'</div>';
                }
                $data['captcha'] .='</div></div>';
            } else {
                $data['captcha'] = '';
            }



        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
$a=1;
        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $filter_count;
        $pagination->url = $this->url->link('information/shop_rating', $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();
        if($homePageTpl) {
           return $this->load->view('default/template/information/shop_rating_home.tpl', $data);
        } elseif(isset($this->request->get['ajax'])){ 
            if($this->request->get['ajax']==1){ 
                $this->response->addHeader('Content-Type: text/html');
                $this->response->setOutput($this->load->view('default/template/information/shop_rating_ajax.tpl', $data));
        }
     
        
        } elseif (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/shop_rating.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/shop_rating.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/information/shop_rating.tpl', $data));
            
        }
       
    }
    

    protected function validate() {

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if ((utf8_strlen($this->request->post['city']) < 3) || (utf8_strlen($this->request->post['city']) > 32)) {
            $this->error['city'] = $this->language->get('error_city');
        }

        // Captcha
        if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
            $captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

            if ($captcha) {
                $this->error['captcha'] = $captcha;
            }
        } elseif ($this->config->get('config_google_captcha_status')) {
            $recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('config_google_captcha_secret')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR']);

            $recaptcha = json_decode($recaptcha, true);

            if (!$recaptcha['success']) {
                $this->error['captcha'] = $this->language->get('error_captcha');
            }
            }


        return !$this->error;
    }

    public function calculateRating(array $reviews){
        $x = 0;
        $summ = 0;
        foreach($reviews as $rate){
            if(isset($rate['service_rate']) && $rate['service_rate'] > 0) {
                $reviews[$rate['service_rate']]++;
                $summ = $summ + $rate['service_rate'];
                $x++;
            }
        }

        $reviews['count'] = $x;
        if($x > 0 ){
            $reviews['summ'] = str_replace('.', ',', round($summ/$x, 1));
        }else{
            $reviews['summ'] = 0;
        }

        return $reviews;
    }
    
    function time_elapsed_string($datetime,$lang, $full = false) {
        $myLang = new Westsworld\TimeAgo\Translations\Uk();
        $timeAgo = new Westsworld\TimeAgo($myLang);
        return $timeAgo->inWords(new DateTime($datetime));
    }
}
?>