<?php
class Rpc {
	private $structure;
	private $full_structure;
	private $data;
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
	
	public function __construct($method, $input_params=null, $axclass=null) {
		$this->method = $method;
		if (!empty($input_params)) {
			$this->input_params = $input_params; }
		if (!empty($axclass)) {
			$this->axclass = $axclass;	}
	}
	
	public function getError() {
		if (!empty($this->error)) {
			return $this->error;
		} else {
			return false;
		}		
	}
	
	private function sendRequest($content) {
	    $tracenum=rand(10000,99999);
	    $con=$content;
	    if (DO_DEBUG>1) {
	      global $debug;      
	      if (strpos($content,'SessionTimeout') === false )
	        $debug .= "<pre>". htmlentities( str_replace('><', ">\n  <", $content) ). "!-----------------------------------------------------------------------------------------------------<br /></pre>";
	    }
	    $content = urlencode($content);
	    
			$content = "xmlRequest={$content}&btnProcessRequest=Process";
			$str  = "POST /service/Service.asmx/daxProcessRequest HTTP/1.1\r\n";
			$str .= "Host: ".SERVER_IP.":".SERVER_PORT."\r\n";
			$str .= "Connection: close\r\n";
			$str .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$str .= "Content-Length: ".(strlen($content))."\r\n\r\n".$content;
	    // echo $content; die();
	    // Получение времени выполнения команд аксаптой
	    $time_start = microtime(1);
	    $fp = fsockopen(SERVER_IP, SERVER_PORT,$errno,$errstr,60);
	    $time_spent=round(microtime(1)-$time_start, 3);    
	    // file_put_contents('/var/log/axapta/rrr.log', date("H:i:s").'-'.$tracenum.':'.$_SESSION['UserLogin'].'-'."xmlRequest".'('.$time_spent.') - errno:'.$errno." errstr:".$errstr."\n", FILE_APPEND);    
		if (!$fp) return;                 
		fwrite($fp, $str);

		if (DO_TRACE) {
		    $fop = fopen(LOG_DIR.'/request.log', 'a+t');
		    fwrite($fop, urldecode($str));
		    fclose($fop);
		    $fop = fopen(LOG_DIR.'/traffic.log', 'a+t');
		    fwrite($fop, "\n\n=== Request ===\n".urldecode($str)."\n========================\n");
		    fclose($fop);
		}
		
		$response = "";
		while (!feof($fp)) {
			$response .= fread($fp, 128);
		}
		fclose($fp);
    
		if (DO_TRACE) {
		    $fp = fopen(LOG_DIR."/response.log", "a+t");
		    fwrite($fp, $response."\n\n\n");
		    fclose($fp);
		    $fop = fopen(LOG_DIR.'/traffic.log', 'a+t');
		    fwrite($fop, "\n\n=== Response ===\n".$response."\n========================\n");
		    fclose($fop);
		}
		
		$res = explode("\r\n\r\n", $response, 2);
		
		$response = array_pop($res);
		
		    // if (@$_SESSION['UserLogin'] == 'it4') {
		       //echo "\n". $response ."\n====================================================================================\n";
		       //echo "<pre>". htmlentities($response,ENT_QUOTES,'UTF-8') ."<br /><br />====================================================================================<br /><br /></pre>";
			  // }
		   
		   // file_put_contents('/var/log/axapta/'. date('Y_m_d') .'_'. $_SESSION['UserLogin'] .'_log.txt', "\n==========================\n". $response ."\n==========================\n", FILE_APPEND);
   
    
    	if (DO_DEBUG>1) {
	        if (strpos($content,'SessionTimeout') === false )
			    $debug .= "<pre>". htmlentities($response,ENT_QUOTES,'UTF-8') ."<br /><br />======================================================================<br /><br /></pre>";
   		}		
      	return $response;
	}
	
	public function setPager($page, $limit) {            
		if (!empty($limit)) {
			$this->data_limit = $limit;
		}
		
		if (!empty($page)) {
			$this->data_start = ($page - 1) * $this->data_limit;
		}
	}
	
	private function run($action) {
		if (!isset($this->xmls[$action])) { //lazy initialization
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
                    if ($key == "Data") {
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

	      $t2log='';
	      $w2log=0;
      do {
        // file_put_contents('/var/www/data/tmp/DAX1.txt', date('Y-m-d H:i:s').'do..'."\n", FILE_APPEND);
        $t2log.=date('Y-m-d H:i:s').'do..'."\n";
        $trysuccess=1;


  			// file_put_contents('/var/www/api.partner.vm.ua/www/logs/transfer-best.txt', date('Y-m-d h:m:s')."xml= ".print_r($xml->saveXML(), true), FILE_APPEND);
        // file_put_contents('/var/www/api.partner.vm.ua/www/logs/transfer-best.txt', date('Y-m-d h:m:s')."response= ".print_r($response, true), FILE_APPEND);

  			//echo htmlspecialchars($xml->saveXML()) ."<br /><br /><br />";
  			//echo htmlspecialchars($response) ."<br /><br /><br />";
        // if($trycount<>5) file_put_contents('/var/www/data/tmp/DAX.txt', date('Y-m-d H:i:s').'1['.$trycount.'] Retry!!!'."\n", FILE_APPEND);

        // Вынес за скобки!!!
        $xmlr=$xml->saveXML();
        try {
           	$trycount--;
            $response = $this->sendRequest($xmlr);      // file_put_contents('/var/www/data/tmp/DAX001.txt', 
            $xml = new SimpleXMLElement($response);
            $this->xmls[$action] = $xml;

        } catch (Exception $e) {
            $t2log.=date('Y-m-d H:i:s').'ExEntry-[#'.$trycount.'#]'."\n";
            $w2log=1;
           	if($trycount==0) {
              	$t2log.= date('Y-m-d H:i:s').'Error!!'.'<pre>'. $response . '</pre><br />'. $e."\n";
              	//$smarty->assign('error', '<pre>'. $response . '<br /><br />'. $e);
           	}
            $trysuccess=0;
            // Записывать в лог для возможного анализа причины
           	$t2log.= date('Y-m-d H:i:s').'2[*'.$trycount.'*]'.'!!!!'.$response.print_r($xml->saveXML(), 1)."\n";
        }
        $t2log.=date('Y-m-d H:i:s').'['.$trycount.']/['.$trysuccess.'] Loop'."\n";
      } while ($trysuccess==0 && $trycount>0);

      // Повторный запрос в случае не успешного запроса или сброса счетчика повтора в -0-
      $t2log.=date('Y-m-d H:i:s').'exit..'."\n";

      // Запись блока данных в ЛОГ только в случае возникновения ошибки
      if($w2log==1)
         file_put_contents('/var/www/data/tmp/DAX2.txt', $t2log, FILE_APPEND);
			
        if (!empty($xml->error)) {
                $this->error = array(
                    'code' => (string)$xml->error,
                    'message' => (string)$xml->error->details
                );

                if (strstr($this->error['code'], "Invalid Session") && $this->method != "SessionTimeout") {
                   	header("Location: login.php");
                }
        }
		}		
		
		return $this->xmls[$action];
	}
	
	public function getParams() {
		if (empty($this->params)) { //lazy initialization
			$params = $this->run('info')->params;
			foreach ($params->children() as $param => $param_text) {
			//				$key = $params->$param->children()->getName();  //----------------------------------------------------------------!!!!!!!!!!
        	$key = $param;
				$title = strip_tags($params->$param->asXML());
				$attribs = $params->$param->attributes();
				switch ((string)$attribs['type']) {
					case "external" :						
						$res = new Rpc((string)$attribs['method'], array('Session' => SESSION));
            if ($param.'' == 'PrintDevice')
    				$dt = $res->getData(array('PrintProducer'=>$_SESSION['USER']['PrintProducer'],'PrintTechType'=>$_SESSION['USER']['PrintTechType'],'Session' => SESSION));
            else if ($param.'' == 'Cartridge')
          		$dt = $res->getData(array('PrintProducer'=>$_SESSION['USER']['PrintProducer'],'PrintTechType'=>$_SESSION['USER']['PrintTechType'],'Session' => SESSION));   
            else if ($param.'' == 'PrintProducer')
    				$dt = $res->getData(array('PrintTechType'=>$_SESSION['USER']['PrintTechType'],'Session' => SESSION));    
            else
    						$dt = $res->getData();
						
						$ids = $vals = array();
						$data = array();
						foreach ($dt as $el) {
							$data[strip_tags($el->ID->asXML())] = strip_tags($el->Name->asXML());
						}						
						break;
					default :
						$data = "";
						break;
				}
				
				$data_params[$key] = array(
					'title' => !empty($title) ? trim($title) : "",
					'type' => (string)$attribs['type'],
					'data' => $data
				);
				
				$this->params = $data_params;
			}
		}
		return $this->params;
	}
	
	public function getData($params = null) {
		if (empty($this->data)) { //lazy initialization
			if (!empty($params)) {
            foreach ($params AS $key=>&$val) {
               if (empty($val) && isSet($_SESSION['USER'][$key])) {
                  $val = $_SESSION['USER'][$key]; }
            }
				$this->input_params = $params;
			}
     	 
			$this->data = $this->run("run");
		}
		
		return $this->data;		
	}
	
	public function getFullStructure() {
		if (empty($this->full_structure)) { //lazy initialization      
			$this->full_structure = $this->run("info")->fields;      
		}
		
		return $this->full_structure;
	}
	
	public function getStructure() {
		if (empty($this->structure)) { //lazy initialization
			$data = $this->getDataTable();
			if (!is_array($data)) return false;
			
			$data_sample = array_keys(array_shift($data));
			$fs = $this->getFullStructure();
			
			foreach ($data_sample as $el) {
				$attr = $fs->$el->attributes();
        //echo ' ['; print_r($attr); echo $el; echo '] ';
				$this->structure[$el] = array(
					'title' => (string)$fs->$el,
					'type' => (string)$attr['type'],
					'id' => $el,
					'doctype' => (string)$attr['DocumentType'],
					'editable' => (string)$attr['editable'],
				);
			}
		}
		
		return $this->structure;
	}
	
	public function getDataTable($isLine = 0, $params = null, & $total_records = null) {

        //////////////
        $ffss = $this->getFullStructure();

        if (empty($this->data_list)) { //lazy initialization

            // Список прикрепленных файлов
            $k=0;
            $flist=array();

            while ($of=$this->getData($params)->recordFiles[$k++]) {
                // print_r($of);
                // echo "\n";
                $flist[]=(array)$of;
            };

            $fields = array();
            $data_limit=count($this->getData($params)->record);
            // for ($i = $this->data_start; $i < $this->data_start + $this->data_limit; $i++) {
            // Перешли на новую модеь постраничной навигации 27.11.17 - Игорь
            for ($i = 0; $i < $data_limit; $i++) {
                $r = $this->getData($params)->record[$i];
                if (!$r) continue;

                if ($r->children()) {
                    foreach ($r as $key => $val) {

		                ///////////////////
		                $attr = $ffss->$key->attributes();
		                if ( (string)$attr['type'] ==  'decimal')  {
		                    $val = str_replace(".", $_SESSION['delimiter'], $val);
		                }
		                  ////////////////////

                        $quotes = array("'", '"');
                        $fields[$key] = array(
                                'title' => !in_array($this->method, array("News", "SalesOrderImport"))
                                                                ? htmlspecialchars((string)$val)
                                                                : (string)$val,
                                'id' => (string)$key
                        );

                        //be aware - hardcoded region
                        if (in_array($key, array("SalesOrder", "PurchOrder", "PaymInvoice", "Invoice", "TaxInvoice", "MainSalesOrder"))) {
                                foreach ($r->$key->children() as $k => $v) {
                                        $fields[$key]['data'][] = (string)$v;
                                }

                                if (empty($fields[$key]['data'])) {
                                        $fields[$key]['data'][] = htmlspecialchars((string)$val);
                                }
                        }

                    }
                }

                $this->data_list[] = $fields;
            }
			
			if ($isLine) {   
				$this->data_list = @array_shift($this->data_list);
			}
		}

               

        // Новый алгоритм получения числа записей!
        $total_records = (int)$this->data->header->RowsCount;
		
		return $this->data_list;
	}

    public function getDataFiles($isLine = 0, $params = null, & $total_records = null) {
      // $debug->debug("Вход в процедуру getDataFiles");
      //////////////
      $ffss = $this->getFullStructure();

      // Список прикрепленных файлов
        $k=0;
        $flist=array();
  			while ($of=$this->getData($params)->recordFiles[$k++]) {
            // print_r($of);
            // echo "\n";
            $b=(array)$of;
            $b['DocFile']=urlencode(str_rot13(base64_encode($b['DocFile'])));
            $flist[]=$b;
        };
 		return $flist;
	}

    public function getDataCount() {
       return 50;
    }

	public function getHeader() {
		if (empty($this->header)) { //lazy initialization
			$r = @$this->getData(@$this->params)->header;
			//print_r($r);
			if(!isset($r[0])) return array();
			//echo 'Ku';

			$fields = array();
			foreach ($r->children() as $key => $val) {
				$fs = $this->getFullStructure();
   		    	$fields[$key]['title'] = (string)$fs->$key;

				   ///////
               $attr = $fs->$key->attributes();
               if ( (string)$attr['type'] ==  'decimal')  {
                  $val = str_replace(".", $_SESSION['delimiter'], $val);
               }
               ///////

				//be aware - hardcoded region
				if (in_array($key, array("SalesOrder", "PaymInvoice", "Invoice", "TaxInvoice"))) {
					foreach ($r->$key->children() as $k => $v) {
						$fields[$key]['data'][] = (string)$v;
					}
					
					if (empty($fields[$key]['data'])) {
						$fields[$key]['data'][] = htmlspecialchars((string)$val);
					}
				} else{
					$fields[$key]['data'] = (string)$val;
				}
			}			
			
			$this->header = $fields;
		}
		
		return $this->header;
	}
	
	public function getFooter() {
		if (empty($this->footer)) { //lazy initialization
			$r = $this->getData($this->params)->footer;
			if(!isset($r[0])) return "";			
			$fields = array();
			foreach ($r->children() as $key => $val) {
				$fs = $this->getFullStructure();				
				$fields[$key]['title'] = (string)$fs->$key;
				
               ///////
               $attr = $fs->$key->attributes();
               if ( (string)$attr['type'] ==  'decimal')  {
                  $val = str_replace(".", $_SESSION['delimiter'], $val);
               }
               ///////

				//be aware - hardcoded region
				if (in_array($key, array("SalesOrder", "PaymInvoice", "Invoice", "TaxInvoice"))) {
					foreach ($r->$key->children() as $k => $v) {
						$fields[$key]['data'][] = (string)$v;
					}
					
					if (empty($fields[$key]['data'])) {
						$fields[$key]['data'][] = htmlspecialchars((string)$val);
					}
				} else{
					$fields[$key]['data'] = (string)$val;
				}
			}			
			
			$this->header = $fields;
		}
		
		return $this->header;
	}
}
?>