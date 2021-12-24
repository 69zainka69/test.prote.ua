<?php
class ControllerCaptchaGoogleCaptcha extends Controller {
    public function index($error = array()) {
        $this->load->language('captcha/google_captcha');

        $data['heading_title'] = $this->language->get('heading_title');

		$data['entry_captcha'] = $this->language->get('entry_captcha');

        //$this->document->addScript('https://www.google.com/recaptcha/api.js?hl='.$this->language->get('code'), 'footer'); //);

        if (isset($error['captcha'])) {
			$data['error_captcha'] = $error['captcha'];
		} else {
			$data['error_captcha'] = '';
		}

        $data['site_key'] = $this->config->get('google_captcha_key');

        //$this->document->addScript('https://www.google.com/recaptcha/api.js?render='. $data['site_key'], 'footer'); //);

        //$data['route'] = $this->request->get['route']; 
        if (isset($this->request->get['route'])) {
            $data['route'] = str_replace('/', '_', $this->request->get['route']); 
        } else {
            $data['route']= 'common_home';
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/captcha/google_captcha.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/captcha/google_captcha.tpl', $data);
		} else {
			return $this->load->view('default/template/captcha/google_captcha.tpl', $data);
		}
    }

    public function validate() {
        $this->load->language('captcha/google_captcha');

        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('google_captcha_secret')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR'];
        $recaptcha = file_get_contents($url);

        $recaptcha = json_decode($recaptcha, true);

        /*$this->log->write($url);
        $this->log->write($this->request->post);
        $this->log->write($recaptcha);*/

        if ($recaptcha['success'] && $recaptcha['score'] > 0.5) {
            return;
        } else {
            return $this->language->get('error_captcha');
        }
    }
}
