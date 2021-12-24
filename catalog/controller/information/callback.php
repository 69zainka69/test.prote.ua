<?php 
class ControllerInformationCallback extends Controller {
	private $error = array(); 
	private $email = 'gdemonm@gmail.com'; 
	    
  	public function index() {

		$json = array();
		$this->language->load('information/callback');

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->post['validate']) && $this->validate($this->request->post['validate'])) {

			$subject = 'Prote - ';
			$text = '';
			if(isset($this->request->post['title'])){
				$subject .= $this->request->post['title'];
				$text = "\nФорма: ".$this->request->post['title'];
			}

			$new_filename ='';
	  		if(isset($this->request->post['file']) && $this->request->post['file']){

				$this->load->model('tool/upload');
		  		$upload_info = $this->model_tool_upload->getUploadByCode($this->request->post['file']);

				$filename = $upload_info['filename'];
				$new_filename = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));

				rename(DIR_UPLOAD . $filename, DIR_UPLOAD . $new_filename);
			}

			if(isset($this->request->post['name'])){
				$text .= "\n\nИмя: ".$this->request->post['name'];
			}
			if(isset($this->request->post['tel'])){
				$text .= "\nТелефон: ".$this->request->post['tel'];
			}
			if(isset($this->request->post['email'])){
				$text .= "\nE-mail: ".$this->request->post['email'];
			}
			if(isset($this->request->post['comment'])){
				$text .= "\nСообщение: ".$this->request->post['comment'];
			}
			if(!isset($this->request->post['name'])){
				$this->request->post['name'] = 'prote.ua';
			}
			
			$mail = new Mail();
			
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');			
			
			$mail->setTo($this->config->get('config_email'));
			//$mail->setTo('gdemonm@gmail.com');
			$mail->setFrom($this->config->get('config_email'));
	  		$mail->setSender($this->request->post['name']);
	  		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
	  		$mail->setText(strip_tags(html_entity_decode($text, ENT_QUOTES, 'UTF-8')));

			if($new_filename){
				$mail->addAttachment(DIR_UPLOAD.$new_filename);
			}
			
      		$mail->send();
      		/*$mail->setTo('gdemonm@gmail.com');
      		$mail->send();*/

      		/*$emails = explode(',', $this->config->get('config_mail_alert'));
				
			foreach ($emails as $email) {
				if ($email && preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email)) {
					$mail->setTo($email);
					$mail->send();
				}
			}*/

      		$json['success'] = $this->language->get('text_success');

    	} else {
    		if ($this->error) {
    			$json['error']= $this->error;
			}
    	}
    	$this->response->setOutput(json_encode($json));
    }	
  	protected function validate($validate=false) {
		$this->language->load('information/callback');
    	
    	$results = explode(',', $validate);
    	foreach ($results as $key => $value) {
    		if($value=='email') {
    			if (isset($this->request->post['email']) && !preg_match($this->config->get('config_mail_regexp'), $this->request->post['email'])) {
					$this->error['email'] = $this->language->get('error_email');
				}
			} elseif ($value=='name') {
					if (isset($this->request->post['name']) && ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32))) {
			      		$this->error['name'] = $this->language->get('error_name');
			    	}
	    	} elseif ($value=='tel') {
	    		if(!isset($this->request->post['tel']) || iconv_strlen(str_replace(array('+','(',' ',')','-','_'),'',$this->request->post['tel']))!=12){
	    			$this->error['tel'] = $this->language->get('error_tel');
	    		} else {
			    	if ((utf8_strlen($this->request->post['tel']) < 3) || (utf8_strlen($this->request->post['tel']) > 32)) {
			      		$this->error['tel'] = $this->language->get('error_tel');
			    	}
		    	}
    		} else {
    			$this->error['error'] = 'Поле не описано';
    		}
    	}

    	$captcha = $this->load->controller('captcha/google_captcha/validate');

		if ($captcha) {
			$this->error['captcha'] = $captcha;
		}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  	  
  	}

  	
  }
?>
