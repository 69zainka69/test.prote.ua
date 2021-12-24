<?php
class Rpc {
	private $structure;
	private $full_structure;
	private $data;
	private $data_xml;
	private $params;
	private $error = null;
	
	private $xmls;
	private $method;
	private $axclass;
	private $input_params;
	private $data_list;
	
	private $header;
	private $footer;
	
	private $data_start = 0;
	private $data_limit = 50;
	private $session_data = 50;
	private $request;
	
	public function __construct($method, $input_params=null, $axclass=null,$registry=null) {
		//echo $method;
	//public function __construct($registry) {
		$this->method = $method;
		if (!empty($input_params)) {
			$this->input_params = $input_params; }
		if (!empty($axclass)) {
			$this->axclass = $axclass;	}
		$this->session = false;
		if($registry){
			$sessiondata= $registry->get('session');
			$this->session_data= $sessiondata->data;
			$this->request= $registry->get('request');
		}
	}
	
	public function getError() {
		if (!empty($this->error)) {
			return $this->error;
		} else {
			return false;
		}		
	}
	
	private function sendRequest($content) {
		//vdump($this->method);

	    $tracenum=rand(10000,99999);
	    $con=$content;

		$start = microtime(true);

	    //vdump($content);
	    $content = urlencode($content);
	    $content = "xmlRequest={$content}&btnProcessRequest=Process";

		$str  = "POST /service/Service.asmx/daxProcessRequest HTTP/1.1\r\n";
		$str .= "Host: ".SERVER_IP.":".SERVER_PORT."\r\n";
		$str .= "Connection: close\r\n";
		$str .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$str .= "Content-Length: ".(strlen($content))."\r\n\r\n".$content;
		//echo $str;
	    // echo $content; die();
	    // Получение времени выполнения команд аксаптой
	    $fp = fsockopen(SERVER_IP, SERVER_PORT,$errno,$errstr,60);
	    
	    // $time = microtime(true) - $start;
	    // printf($this->method.' - Скрипт1 выполнялся %.4F сек.', $time);		   
	    
		if (!$fp) return;                 
		fwrite($fp, $str);

		// $time = microtime(true) - $start;
	 //    printf($this->method.' - Скрипт2 выполнялся %.4F сек.', $time);		   

		$response = "";
		while (!feof($fp)) {
			$response .= fread($fp, 128);
		}
		fclose($fp);
		
		// $time = microtime(true) - $start;
	 //    printf($this->method.' - Скрипт3 выполнялся %.4F сек.', $time);		   
    	//vdump($response);
		$res = explode("\r\n\r\n", $response, 2);
		$response = array_pop($res);
		//vdump($response);
		
		$ar = array(
			'account/login_ax',
			'account/logout_ax',
		);
		if(isset($this->request->get['route'])){
			//vdump('no route: class Rpc: method = '.$this->method);
		}

		if(!is_array($response) && isset($this->request->get['route']) && !in_array($this->request->get['route'],$ar)){
			$pos = strpos($response,'Invalid Session');
			//echo $this->method;
			//echo 'this->method';
			if ($pos == true && $this->method=='createSalesOrder') {
				//return array('error'=>'Invalid Session');
				
				//$response = array();
				$res['error'] = 'Invalid Session';
				return $response;
			}elseif ($pos == true) {
				//echo 'Invalid Session';
				//echo $_SERVER['REQUEST_URI'];
				header('Location: '.HTTPS_SERVER.'index.php?route=account/logout_ax', true, 302);
				exit();
			} 
		}
		
  		// $time = microtime(true) - $start;
		// printf($this->method.' - Скрипт5 выполнялся %.4F сек.', $time);		

      	return $response;
	}
	
	
	private function run($action) {
		//vdump($action);
		//if (!isset($this->xmls[$action])) { //lazy initialization

			$xml = new DOMDocument("1.0", "utf-8");
		
			$root = $xml->createElement("daxrequest");
			$xml->appendChild($root);
			
			$root->appendChild($xml->createElement("action", $action));
			$root->appendChild($xml->createElement("method", $this->method));
			
			if ($this->axclass) {
			   $root->appendChild($xml->createElement("class", $this->axclass)); }

			
			if (count($this->input_params) > 0) {
                $params = $xml->createElement("params");
                $root->appendChild($params);
                
                foreach ($this->input_params as $key => $val) {
                	if ($key == "OrderLines") {
                		// для формирования заказа 
                		$OrderLines = $xml->createElement($key,'');
                		
                		foreach ($val as $key2 => $value) {
                			$OrderLine = $xml->createElement('OrderLine','');
                			$key2 = htmlspecialchars($key2,ENT_QUOTES,'UTF-8');
                			$value = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
                			$OrderLine->appendChild($xml->createElement('ID', $key2));
                			$OrderLine->appendChild($xml->createElement('OrderQty', $value));
                			$OrderLines->appendChild($OrderLine);
                		}
                		$params->appendChild($OrderLines);
                	} elseif ($key == "Data") {
                        $ch = new DOMDocument();
                        $ch->loadXML("<Data>{$val}</Data>");

                        $ch = $xml->importNode($ch->firstChild, true);
                    } elseif ($key == '') {
                      continue;
                    } else {
                        $val = htmlspecialchars($val,ENT_QUOTES,'UTF-8');
                        $ch = $xml->createElement($key, $val);
                    }
                    $params->appendChild($ch);
                }
			}

	      $trycount=2; // Раньше было 5 - уменьшил 04.04.2016 10:01:51

	      //$t2log='';
	      $w2log=0;
      do {
        // file_put_contents('/var/www/data/tmp/DAX1.txt', date('Y-m-d H:i:s').'do..'."\n", FILE_APPEND);
        //$t2log.=date('Y-m-d H:i:s').'do..'."\n";
        $trysuccess=1;

        // Вынес за скобки!!!
        $xmlr=$xml->saveXML();
        echo "<pre>";
        print_r($xmlr
        );
        echo "</pre>";

        /*$handle = fopen(DIR_LOGS . 'xml_xmlr.txt', 'a');
        fwrite($handle, date('Y-m-d G:i:s') . ' - ' . print_r($xmlr, true) . "\n");
        fclose($handle);*/

        try {
           	$trycount--;
           	
            $response = $this->sendRequest($xmlr);      // file_put_contents('/var/www/data/tmp/DAX001.txt', 
            $handle = fopen(DIR_LOGS . 'xml_response.txt', 'a');
            fwrite($handle, date('Y-m-d G:i:s') . ' - ' . print_r($response, true) . "\n");
            fclose($handle);
            /*echo "<pre>";
            print_r($response);
            echo "</pre>";*/

            $xml = new SimpleXMLElement($response);
            //vdump($xml);
            $this->xmls[$action] = $xml;
            
        } catch (Exception $e) {
            
            $w2log=1;
           	if($trycount==0) {
              	//$t2log.= date('Y-m-d H:i:s').'Error!!'.'<pre>'. $response . '</pre><br />'. $e."\n";
              	//gemon закомментировал
              	//$smarty->assign('error', '<pre>'. $response . '<br /><br />'. $e);
           	}
            $trysuccess=0;
            // Записывать в лог для возможного анализа причины
           	//$t2log.= date('Y-m-d H:i:s').'2[*'.$trycount.'*]'.'!!!!'.$response.print_r($xml->saveXML(), 1)."\n";
        }
        //$t2log.=date('Y-m-d H:i:s').'['.$trycount.']/['.$trysuccess.'] Loop'."\n";
      } while ($trysuccess==0 && $trycount>0);

      // Повторный запрос в случае не успешного запроса или сброса счетчика повтора в -0-
      //$t2log.=date('Y-m-d H:i:s').'exit..'."\n";

      // Запись блока данных в ЛОГ только в случае возникновения ошибки
      //if($w2log==1)
         //file_put_contents('/var/www/data/tmp/DAX2.txt', $t2log, FILE_APPEND);
			
        if (!empty($xml->error)) {
                $this->error = array(
                    'code' => (string)$xml->error,
                    'message' => (string)$xml->error->details
                );
                
                if (strstr($this->error['code'], "Invalid Session") && $this->method != "SessionTimeout") {
                   	//header("Location: login.php");
                }
        }
		//}		
		$result = $this->xmls[$action];

		return $result;
	}

	public function getData($params = null) {
		
		//if (empty($this->data)) { //lazy initialization
			if (!empty($params)) {
            foreach ($params AS $key=>&$val) {
               if (empty($val) && isSet($_SESSION['USER'][$key])) {
                  $val = $_SESSION['USER'][$key]; }
            }
				$this->input_params = $params;
			}
			
     	 
			$this->data = $this->run("run");
			
			$this->data_xml = $this->data;
			$this->data = $this->xml2array($this->data);
		//}
		
		return $this->data;
	}

	public function xml2array($xmlObject){
		$out = array();
		foreach ((array)$xmlObject as $index1 => $nodes ){
			
			if(is_array($nodes)){
				foreach ((array)$nodes as $index2 => $node ){
			        if(is_object($node)){
			        	$out[$index1][$index2] = $this->xml2array($node);
			        } else {
			        	$out[$index1][$index2] = $node;
			        }
		        }
			} else {
				//echo $index1.'--<br>';
				if(is_object($nodes)){
		        	//echo 'q';
		        	$out[$index1] = $this->xml2array($nodes);
		        } else {
		        	$out[$index1] = $nodes;
		        }
			}
	    }

	    return $out;
	}

}
?>