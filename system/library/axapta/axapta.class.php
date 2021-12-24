<?php
//
//require_once(ROOT.'/lib/axapta.lib.php');
//require_once(ROOT.'/lib/classes/axpost.class.php');
require_once(DIR_SYSTEM.'library/axapta/axpost.class.php');
/*******************************************************************************
 *
 *
 *
 ***/
class Axapta {
    public $session;
    public $xml_str;
    public $pages_names = array();
    public $values_names = array();
    public $attr_names = array();
    public $brand_names = array();
    public $item_names = array();
    public $active = true;
    public $errors = array();
    public $log_fle = 'sync';
    public $asort_values = array('АССОРТИМЕНТ'=>0,'Под заказ'=>1);  //////////////// АССОРТИМЕНТ
    public $langs_list = array( 'en-us'=>3, 'en'=>3, 'ua'=>2, 'ru'=>1, 'UA'=>2, 'RU'=>1  ); //////////////////// Языки из Ах
    
    // Таблица для кеширования информации о файлах
    public $InventTableDocu = array();
    
    function __construct($login='prote', $pass='web-prote', $test=false){
    
        //$file_ax_sesion = ROOT.'/lib/axapta.session';
      $file_ax_sesion = DIR_CACHE.'axapta.session';
      //echo $file_ax_sesion;
      
      if (!$this->session) {
		     $this->session = file_get_contents($file_ax_sesion);
		     if (!$this->ChecSession($this->session)) {
          $this->session ='';
			     $this->Login($login, $pass);
			     file_put_contents($file_ax_sesion, $this->session);
			   }
		  }
      //echo $this->session;
    }
    
    
    function Login($login='prote', $pass='web-prote', $test=false){

        if ($login) {

            $xml = $this->createXml('LoginShop', array(
               'User'=>$login,
               'Password'=>$pass,
               'IPAddress'=>'91.207.66.27' )
            );

            $res = $this->sendRequest($xml);
            //$res = $this->post($xml);
            $this->session = (string) $res->Session;
        }
    }

    
    function ChecSession($session) {
        if ($session){
            $this->session = $session;
            
            
            $xml = $this->post($this->createXml('SessionTimeout', null));


            if ( (string)$xml->record->Timeout  ) {
               return true;
            } else {
               $this->session = '';
               return false; 
            }

        }
    }

    public function createXml($method, $params=null, $action='run', $class=null) {

       $xml = '<?xml version="1.0" encoding="utf-8"?'.'>
        <daxrequest>
        
          <action>'.$action.'</action>
          <method>'.$method.'</method>';
       if ($class) {
        $xml .= '<class>'.$class.'</class>'; }
       $xml .= '<params>
            <Session>'.$this->session.'</Session>';
       if ($params) {


          foreach ($params AS $key=>$val) {

              if($key=='OrderLines'){
                $xml .= "<".$key.">"; 
                foreach ($val AS $line => $val2) {
                  $xml .= "<OrderLine>"; 
                  foreach ($val2 AS $key2 => $val3) {
                    $xml .= "<".$key2.">".htmlspecialchars($val3)."</".$key2.">"; 
                  }
                  $xml .= "</OrderLine>"; 
                }
                $xml .= "</".$key.">"; 
              } else {

               $val  = htmlspecialchars($val);
               $xml .= "<$key>$val</$key>"; 
             }
          } 
       }
       $xml .= '</params></daxrequest>';
       return $xml;
    }

    private function sendRequest($content) {
    //vdump($this->method);
      ///////////////
      $handle = fopen(DIR_LOGS . 'ax_response.txt', 'a');
      fwrite($handle, date('Y-m-d G:i:s') . ' content - ' . print_r($content, true) . "\n");


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
        // echo $content; die();
        // Получение времени выполнения команд аксаптой
      $fp = fsockopen(SERVER_IP, SERVER_PORT,$errno,$errstr,60);
  
        
      if (!$fp) return;                 
      fwrite($fp, $str);

      $response = "";
      while (!feof($fp)) {
        $response .= fread($fp, 128);
      }
      fclose($fp);
      
      $res = explode("\r\n\r\n", $response, 2);
      $response = array_pop($res);
      $response = new SimpleXMLElement($response);
      ///////////////
      fwrite($handle, date('Y-m-d G:i:s') . ' response - ' . print_r($response, true) . "\n");
      fclose($handle);
      ///////////////

      return $response;
  
    }

    ////////////////////////////////////////////////////
    private function post($xml_request, $parse=true) { // return false; 
        //global $phrase;

        $axPost = new axPost();
        $axPost->set_post_body(array(
            'xmlRequest' => $xml_request ));
            
        for ($i=0;$i<3;$i++) {
           $xml_str = $axPost->start_transfer(AXAPTA_URL);
           if (!$xml_str) {
              //echo "\n\n -------- Пустой Ответ $i -------- по Запросу -------- \n $xml_request \n\n"; 
              usleep(50000);
              continue; }
           if(substr($xml_str, 0, 5) == "<?xml") { break; // Все ОК ------------
           } else {
              //echo "\n\n -------- Ошибка в Аксапте $i -------- \n $xml_str \n"; 
              //echo " -------- ошибка по Запросу -------- \n $xml_request \n\n"; 
              lib_sendMailErrorList(array(
                      //'mail_to'=>array('webadmin@vm.ua','Sergey.Pinjaz@vm.ua'), // 'marketing@vm.ua',
                      'mail_to'=>array('gdemonm@vm.ua'), // 'marketing@vm.ua',
                      'subject'=>'-------- Ошибка в Аксапте '.$i.' --- '.date('d.m.Y H:i'),
                      'body'=>"запрос в аксапту:".$xml_request."\n ---- получен ответ:".$xml_str )
                );
            }
           usleep(500);
        }
        
        //file_put_contents(LOGS . date('Y_m_d') ."_ax_{$this->log_fle}_log.txt", "\n == ". date('d.m.Y H:i:s') ." == \n{$xml_request}\n-----------\n{$xml_str}\n", FILE_APPEND);

        if (!$xml_str) {
            $this->active = false;

            $last_time = (int) @file_get_contents(PHPECHO.'error.mail');

            if ((time()-3600)>$last_time) {
                /*require_once($_SERVER['DOCUMENT_ROOT'].'/lib/classes/sendemail.class.php');

                lib_sendMailErrorList(array(
                      'mail_to'=>array('webadmin@vm.ua','Sergey.Pinjaz@vm.ua'), // 'marketing@vm.ua',
                      'subject'=>'ИНТЕРФЕЙС НЕДОСТУПЕН! '.date('d.m.Y H:i'),
                      'body'=>'Это письмо было отправлено, так как интерфейс для обмена данными с axapta не отвечает на запросы.' )
                );
                lib_sendMailError(array(
                      'subject'=>'ИНТЕРФЕЙС НЕДОСТУПЕН! '.date('d.m.Y H:i'),
                      'body'=>"Это письмо было отправлено, так как интерфейс для обмена данными с axapta не отвечает на запросы. <br /><br /> $xml_request <br /><br /> $xml_str ")
                );
                file_put_contents(PHPECHO.'error.mail', time());*/
            } 
            return false;
        }

        $this->xml_str = $xml_str;
        
        if ($parse) {
            if (strpos($xml_str, '<')===false) {
                //echo "[".$xml_request."]\n";
                //echo "[".$xml_str."]\n";
                $xml = array();
            } else {
                $xml = new SimpleXMLElement($xml_str);
           if (strpos($xml_str,'<daxresponse />')===true) {
              echo "\n\n -------- Пустой [daxresponse] -------------------------- \n\n"; }  
            }
            return $xml;
        } //*/
        
        return $this->xml_str;
        
        
    }

    public function shopCustInsert($name,$email,$phone,$discount='',$address='') {

        $xml = $this->createXml('shopCustInsert', array(
            'Name'=>$name,
            'Address'=>$address,
            'Email'=>$email,
            'Phone'=>$phone,
            //'DiscountId'=>$discount,
            'SalesPool'=>'prote.ua',
          ),'run','Web_Cust'
        );

        /*$handle = fopen(DIR_LOGS . 'ax_response.txt', 'a');
        fwrite($handle, date('Y-m-d G:i:s') . ' xml shopCustInsert - ' . print_r($xml, true) . "\n");
        fclose($handle);*/

        
        $xml = $this->sendRequest($xml);

        
        $priceGroup = '';
        if (!$xml->error) {
          $result = array(
            'CustAccount' => (string)$xml->record->CustAccount,
            'Comment' => (string)$xml->record->Comment
          );
          
          return $result;
        } else {
         $this->errors[] = (string) $xml->error; 
        }
        return false;
    }
    public function createSalesOrderShop($param) {
        $xml = $this->createXml('createSalesOrderShop', $param,'run','Web_Order');

        $handle = fopen(DIR_LOGS . 'ax_response_createSalesOrderShop.txt', 'a');
        fwrite($handle, date('Y-m-d G:i:s') . ' xml createSalesOrderShop - ' . print_r($xml, true) . "\n");
        fclose($handle);
        
        $xml = $this->sendRequest($xml);

        $handle = fopen(DIR_LOGS . 'ax_response_createSalesOrderShop.txt', 'a');
        fwrite($handle, date('Y-m-d G:i:s') . ' xml responce - ' . print_r($xml, true) . "\n");
        fclose($handle);
        
        $item = array();
        if (!$xml->error) {
           foreach ($xml->record as $i=>$r) {    
               $item['orderId'] = (string) $r->SalesOrder;
             //  $item['Item']    = (string) $r->Item; 
           }
           return $item;
        } else {
         $this->errors[] = (string) $xml->error; 
        }
        return false;
    }
    

    /////////////////////////////////////
    
    // Получение таблицы файлов с кешированием результатов
    function getInventTableDocu($item) {
        if (!isset($this->InventTableDocu[$item])) {
              $this->InventTableDocu[$item] = $this->post( $this->createXml('InventTableDocu', array(
                  'Item'=>$item )
              ));
              // print_r($this->InventTableDocu[$item]);
        }    
        return $this->InventTableDocu[$item];
    }
    
    public function getPages($lang_code='ru'){
        $xml = $this->post( $this->createXml('InventProductGroupName', null) );

        $names = array();
        foreach ($xml->record as $i=>$r) {
            $groupId = (string) $r->Attr;
            $name    = (string) $r->Name;
            $lang    = (string) $r->Language; //RU
            if ($lang==$lang_code) {
                $names[$groupId] = $name; }
            $this->pages_names[$groupId][$lang] = $name;
        }

        $xml = $this->post( $this->createXml('InventProductGroup', null) );

        $pages = array();
        foreach ($xml->record as $i=>$r) {
            $groupId = (string) $r->Group;
            $parent  = (string) $r->ParentGroup;
            if (empty($parent)) {
                $parent = 0; }
            $pages[$parent][$groupId] = $names[$groupId];
        }
        
        return $pages;
    }
    
    public function getOrderStatus($order) {
        
        $xml = $this->post('<?xml version="1.0" encoding="utf-8"?'.'>
        <daxrequest>
          <action>run</action>
          <class>Web_Order</class>
          <method>getOrderStatus</method>
          <params>
            <Session>'.$this->session.'</Session>
            <SalesOrder>'.$order.'</SalesOrder>
            <SalesPriceTemplate>catalog.php</SalesPriceTemplate>
          </params>
        </daxrequest>');
        if ($xml->record) {        
        foreach ($xml->record as $i=>$r) {
                $status[0] = (string) $r->Status;
                $status[1] = (string) $r->Editable;
                                                
            }
        } 
        if ($xml->error) {
            
            $status[0] = "Не найден";
            $status[1] = "false";
            }
        return $status;
    }
    
    public function getSetup() {
        $xml = $this->post( $this->createXml('InventAttributeSetup', null) );
        
        $setup = array();
            foreach ($xml->record as $i=>$r) {
                $aid = (string) $r->Attr;
                $g   = (string) $r->Groups;
                $a   = (string) $r->Values;
                
                $groups = explode(';',$g);
                $values = explode(';', $a);
                foreach($groups as $group) {
                    $setup[$group][] = array('aid'=>$aid, 'values'=>$values);
                }
            }
        return $setup;
    }

    public function InventAttrSetupGroup() {
        $xml = $this->post( $this->createXml('InventAttrSetupGroup', null) );
        
        $setup = array();
        foreach ($xml->record as $i=>$r) {
            $aid       = (string) $r->Attr;
            $group     = (string) $r->Group;
            $filter    = (string) $r->Filter;
            $attribute = (string) $r->Attribute;
            
            $setup[$group][$aid] = array('aid'=>$aid, 'filter'=>$filter,'attribute'=>$attribute);
        }

        return $setup;
    }

    public function InventAttrSetup() {
        $setup = $this->InventAttrSetupGroup();
        $xml   = $this->post( $this->createXml('InventAttrSetup', null) );

            foreach ($xml->record as $i=>$r) {
                $aid = (string) $r->Attr;
                $a   = (string) $r->Values;

                $values = explode(';', $a);
                foreach($setup as $g => $d) {
                    foreach ($d as $d_aid => $data) {
                        if ($d_aid==$aid) {
                            $setup[$g][$d_aid]['values'] = $values; }
                    }
                }
            }
        return $setup;
    }
    
    public function getAttributes($lang_code='ru') {
        $xml = $this->post( $this->createXml('InventAttributeName', null) );

        $attr = array();
        foreach ($xml->record as $i=>$r) {
            $aid    = (string) $r->Attr;
            $lang   = (string) $r->Language;
            $name   = (string) $r->Name;
            
            if ($lang==$lang_code) {
                $attr[$aid] = $name; }
            $this->attr_names[$aid][$lang] = $name;
        }
        return $attr;
    }
    //'.($currency?'<Currency>'.$currency.'</Currency>':'').'
    public function PriceListShop($name,$currency='') { //,$currencys) {
        //$currency='UA';
        /* $xml = $this->post( $this->createXml('PriceListShop', array(
            'PriceGroup'=>$name )
        )); //*/
        //$xml = $this->_createXML('PriceListShop', array('Session'=>$this->session,'PriceGroup'=>$name)); // ТУДУ: Почему не работает предидущая!!
         $xml = $this->post('<?xml version="1.0" encoding="utf-8"?'.'>
        <daxrequest>
          <action>run</action>
          <method>PriceListShop</method> 
          <params>
            <Session>'.$this->session.'</Session>
            <PriceGroup>'.$name.'</PriceGroup> 
            '.($currency?'<Currency>'.$currency.'</Currency>':'').'           
          </params>
        </daxrequest>');
        
        // print_r($xml);
        $values = array();
        foreach ($xml->record as $i=>$r) {
            // $values[ (string)$r->Item ][ (string)$r->Currency ] = (string)$r->Amount;            
            $values[ (string)$r->Item ][ 'UA'  ] = (string)$r->PriceUa;
            $values[ (string)$r->Item ][ 'UAH' ] = (string)$r->PriceUah;
            // 
        }
        // print_r($values);
        return $values;
    }
    
    public function PriceItemShop($name, $axapta_code) { //,$currencys) {
        /* $xml = $this->post( $this->createXml('PriceListShop', array(
            'PriceGroup'=>$name )
        )); */
        $xml = $this->_createXML(
          'PriceListShop', 
          array(
            'Session'=>$this->session,
            'Item'=>htmlspecialchars($axapta_code),
            'PriceGroup'=>$name,
          )
        ); // ТУДУ: Почему не работает предидущая!!
        //print_r($xml);
        //echo $xml->asXML();
        $values = array();
        foreach ($xml->record as $i=>$r) {
            // $values[ (string)$r->Item ][ (string)$r->Currency ] = (string)$r->Amount;
            $values[ (string)$r->Item ][ 'UA' ]  = (string)$r->PriceUa;
            $values[ (string)$r->Item ][ 'UAH' ] = (string)$r->PriceUah;            
        }
        // print_r($values);
        return $values;
    }

    public function PricesItemShop($price_groups, $axapta_code) { //,$currencys) {

        $line_groups = implode(';', $price_groups);
          $q  = '<?xml version="1.0" encoding="utf-8"?'.'>'.
           '<daxrequest>'.
           '   <action>run</action>'.
           '   <method>PricesListShop</method>'.
           '   <params>'.
           '     <Session>'.$this->session.'</Session>'.
           '     <Item>'.htmlspecialchars($axapta_code).'</Item>'.
           '     <PriceGroups>'.$line_groups.'</PriceGroups>';
          $q .=   '   </params>'.
            '</daxrequest>';
        //print_r($q);
        $xml = $this->post($q);

        //print_r($xml);
        //echo $xml->asXML();
        
        $values = array();
        foreach ($xml->record as $i=>$r) {
            // $values[ (string)$r->Item ][ (string)$r->Currency ] = (string)$r->Amount;
            $values[(string)$r->PriceGroupId ][ 'UA' ]  = (string)$r->PriceUa;
            $values[(string)$r->PriceGroupId ][ 'UAH' ] = (string)$r->PriceUah;            
        }
        // print_r($values);
        return $values;
    }

    public function PriceGroupList() {
        $xml = $this->post( $this->createXml('PriceGroupListShop', null) );
        
        $values = array();
        $index  = 1;
        foreach ($xml->record as $i=>$r) {
            $values[$index] = (string) $r->PriceGroup;
            $index++;
        }
        return $values;
    }
    
    public function getValues($lang_code='ru') {
        $xml = $this->post( $this->createXml('InventAttributeValueName', null) );
        
        $values = array();
        foreach ($xml->record as $i=>$r) {
            $valId = (string) $r->Value;
            $name    = (string) $r->Name;
            $lang    = (string) $r->Language; //RU
            
            if ($lang==$lang_code) {
                $values[$valId] = $name; }
            $this->values_names[$valId][$lang] = $name; //////////////////////// -- ?
        }
        return $values;
    }
    
    public function getProps($group,$item='') {
        $xml = $this->post( $this->createXml('InventAttributeList', array(
            'Group'=>$group,
				'Item'=>$item )
        ));
        
        $values = array();
        foreach ($xml->record as $i=>$r) {
            $item  = (string) $r->Item;
            $attr  = (string) $r->Attr;
            $value = (string) $r->Value;
            $values[$item][] = array('attr'=>$attr, 'value'=>$value);
        }
        return $values;
    }
    
    public function getTable($group='') {
        $xml = $this->post( $this->createXml(
          'InventTable', 
          array('Group'=>$group )
        ));
        
        $values = array();
        
        if (!$xml) return $values; 
        
        foreach ($xml->record as $i=>$r) {
            $item  = (string) $r->Item;
            $brand = '';// (string) $r->Brand;   // Закомменчено потому что  (31.07.2015 11:00:37 - IV)
            $avail = (string) $r->Avail;
            $article = (string) $r->Article;
            $asort = (string) $r->Assortment;
            $date  = (string) $r->CreatedDate;
            // Новые поля для доставки от партнеров
            $dlvdays = (string) $r->DlvDays;
            $extavail = (string) $r->ExtAvail;
            $extdlvdays = (string) $r->ExtDlvDays;
            //if ($item=='MB-ASUS-MAX-IX-HERO') echo  '!>>>', $asort;
            if (!$date) {
				   $date = '01.01.2001'; }
            $date = strtotime($date);
            $values[$item] = array('brand'=>$brand, 'avail'=>$avail, 'article'=>$article, 'adate' => $date, 'asort' => ($this->asort_values[$asort] ? $this->asort_values[$asort] : 0), 'dlvdays' => $dlvdays, 'extavail' => $extavail, 'extdlvdays' => $extdlvdays);
        }
        return $values;
    }
    
    
    public function getCompability($item) {
        $xml = $this->post( $this->createXml('InventCompatibility', array(
            'Item'=>$item,
            'Compatible'=>'' )
        ));
        
        $values = array();
        foreach ($xml->record as $i=>$r) {
           $values[] = array('connection_type'=>(string)$r->Compatible, 'child'=>(string)$r->ItemChild); }
        return $values;
    }
    

    public function getBrands($lang_code='ru') {
        $xml = $this->post( $this->createXml('inventBrandName', null) );
        
        $values = array();
        foreach ($xml->record as $i=>$r) {     
           $valId = (string) $r->Brand;
           $name    = (string) $r->Name;
           $lang    = (string) $r->Language; //RU
           if ($lang==$lang_code) {
              $values[$valId] = $name; }
           $this->brand_names[$valId][$lang] = $name;
        }
        return $values;
    }


    public function getDocuCert($item) {        
             
      //             $xml = $this->post( $this->createXml('InventTableDocu', array(
      //                 'Item'=>$item )
      //             ));

        $xml=$this->getInventTableDocu($item);
        $values = array();
        foreach ($xml->record as $i=>$r) {     
           $file     = (string) $r->FileName;
           $type     = (string) $r->Type;
           $name     = (string) $r->DocuName;
           $refid    = (string) $r->refId;
           $cdate    = strtotime ((string) $r->updDate);
           $new      = 0;
            //            echo $file;
            //            echo filectime(ROOT.'/user/import/'.$file);
            //            echo $cdate;
            //            var_dump (file_exists(ROOT.'/user/import/'.$file));
            //            var_dump (filectime(ROOT.'/user/import/'.$file)>$cdate);
           
           if ($type=='Инструкции' || $type=='Сертификат' || $type=='Файл' ) {
              if (!(file_exists(ROOT.'/user/import/'.$file) && filectime(ROOT.'/user/import/'.$file)>$cdate)) {
                 // $this->getDocuFtp($item, $file);
                 $this->getDocuFtpRefid($refid);
                 $new = 1; 
              }
              $values[] = array('file'=>$file, 'type'=>$type, 'name'=>$name, 'new'=>$new);
           }
        }
        return $values;
    }
    
    
    public function getDocuDescr($item) {
    
      //         $xml = $this->post( $this->createXml('InventTableDocu', array(
      //             'Item'=>$item )
      //         ));

        $xml=$this->getInventTableDocu($item);
    
        $values = array();
        foreach ($xml->record as $i=>$r) {
                
           $file     = (string) $r->FileName;
           $type     = (string) $r->Type;
           $name     = (string) $r->DocuName;
           $refid    = (string) $r->refId;
           $dest     = (int) $r->forPatronService + 2 * (int) $r->forProte;
           $cdate    = strtotime ((string) $r->updDate); 
           $new      = 0;
                      
           if ( $type=='Описание' || $type=='ОписаниеUA' || $type=='ОписаниеEN' ) {
              // Проработать - как быть в случае изменения файла на стороне АХ.!
              if (!(file_exists(ROOT.'/user/import/'.$file) && filectime(ROOT.'/user/import/'.$file)>$cdate)) { 
                 // $this->getDocuFtp($item, $file);
                 $this->getDocuFtpRefid($refid);
                 $new = 1; }
              $values[] = array('file'=>$file, 'type'=>$type, 'name'=>$name, 'dest'=>$dest, 'new'=>$new);              
           }
        }
        return $values;
    }
    

    public function getDocuFoto($item) {
      //         $xml = $this->post( $this->createXml('InventTableDocu', array(
      //             'Item'=>$item )
      //         ));

        $xml=$this->getInventTableDocu($item);
        //print_r($xml);
        $values = array();
        $values['sert']=array();
        $values['descr']=array();
        $values['images']=array();

        
        foreach ($xml->record as $i=>$r) { // ---------------------------------- Сначала основное изображение (супер костыль)
           $file     = (string) $r->FileName;
           $type     = (string) $r->Type;
           $name     = (string) $r->DocuName;
           $refid    = (string) $r->refId;
           $dest     = (int) $r->forPatronService + 2 * (int) $r->forProte;
           $cdate    = strtotime ((string) $r->updDate);
           $new      = 0;        


            if ($type=='Инструкции' || $type=='Сертификат' || $type=='Файл' ) {
              if (!(file_exists(ROOT.'/user/import/'.$file) && filectime(ROOT.'/user/import/'.$file)>$cdate)) {
                 // $this->getDocuFtp($item, $file);
                 $this->getDocuFtpRefid($refid);
                 $new = 1; }
              $values['sert'][] = array('file'=>$file, 'type'=>$type, 'name'=>$name, 'new'=>$new);
           } elseif ( $type=='Описание' || $type=='ОписаниеUA' || $type=='ОписаниеEN' ) {
              // Проработать - как быть в случае изменения файла на стороне АХ.!
              if (!(file_exists(ROOT.'/user/import/'.$file) && filectime(ROOT.'/user/import/'.$file)>$cdate)) { 
                 // $this->getDocuFtp($item, $file);
                 $this->getDocuFtpRefid($refid);
                 $new = 1; }
              $values['descr'][] = array('file'=>$file, 'type'=>$type, 'name'=>$name, 'dest'=>$dest, 'new'=>$new);              
           } elseif ($type=='Изображения') {
              if (!(file_exists(ROOT.'/user/import/'.$file) && filectime(ROOT.'/user/import/'.$file)>$cdate)) { // echo "\n---- ". ROOT.'/user/import/'.$file." ------------ \n\n";
                 // $this->getDocuFtp($item, $file);
                 $this->getDocuFtpRefid($refid);
                 $new = 1; }
              $values['images'][] = array('file'=>$file, 'type'=>$type, 'name'=>$name, 'new'=>$new, 'dest'=>$dest);
           }

        }
        //print_r($values);
        foreach ($xml->record as $i=>$r) { // ---------------------------------- Потом дополнительные (супер костыль)
           $file     = (string) $r->FileName;
           $type     = (string) $r->Type;
           $name     = (string) $r->DocuName;
           $refid    = (string) $r->refId;
           $dest     = (int) $r->forPatronService + 2 * (int) $r->forProte;
           $cdate    = strtotime ((string) $r->updDate);
           $new      = 0;
           if ($type=='Изображения дополнительные') { //echo "\n---- ". ROOT.'/user/import/'.$file." ------------ \n\n";
              if (!(file_exists(ROOT.'/user/import/'.$file) && filectime(ROOT.'/user/import/'.$file)>$cdate)) {
                 // $this->getDocuFtp($item, $file);
                 $this->getDocuFtpRefid($refid);
                 $new = 1; }
              $values['images'][] = array('file'=>$file, 'type'=>$type, 'name'=>$name, 'new'=>$new, 'dest'=>$dest);
           }
        }
        
        // free memory!!
        unset($this->InventTableDocu[$item]);
        
        return $values;
    }

    
    public function getDocuFtp($item, $file) {
        $xml = $this->post( $this->createXml('InventTableDocuFtp', array(
            'Item'=>$item,
            'FileName'=>$file )
        ));
    }
    
    // Получение файла по его Refid
    public function getDocuFtpRefid($refid) {   
        $xml = $this->post( $this->createXml('InventTableDocuFtpRefId', array(
            'refId'=>$refid,
            )
        ));

        print_r($xml);
    }

    public function getItem($item,$lang_code='ru') {
        $xml = $this->post( $this->createXml('InventTableName', array(
            'Item'=>$item )
        ));
        
        if (!$xml) return false;  

        $values = array();
        foreach ($xml->record as $i=>$r) {
            $title  = mysql_real_escape_string($r->Name);
            $alias  = mysql_real_escape_string($r->Alias);
            $body   = mysql_real_escape_string($r->Txt);
            $lang   = (string) $r->Language;
            if ($lang==$lang_code) {
               $values = array('title'=>$title, 'header'=>$body, 'alias'=>$alias);
            }
            $this->item_names[$item][$lang] = array('title'=>$title, 'header'=>$body, 'alias'=>$alias);
        }
        return $values;
    } //*/

    
    public function shopCustInfo($absnum) {
        $xml = $this->post( $this->createXml('shopCustInfo', array(
            'CustAccount'=>$absnum )
        ));
        
        $customer = array();
        if (!$xml->error) {
            if ( isSet($xml->record) && !empty($xml->record) && count($xml->record[0])>0 ) {
               foreach ($xml->record[0] as $i=>$r) {
                   $customer[$i] = (string) $r; }
               return (object)$customer;
            }
        }
        return false;
    }
    
    
    public function custInfoShopAll($absnum, $email='', $phone='', $update=0) { // -------------- NIK
        $xml = $this->post( $this->createXml('custInfoShop', array(
            'CustAccount'=>$absnum,
            'Phone'=>$phone,
            'Email'=>$email,
            'Update'=>$update,
            'Discount'=>'' )
        ));

        if (!$xml->error) { 
            if (isSet($xml->record) && !empty($xml->record)) { 
                return $xml->record;
            } else { echo "пустой ответ для [$absnum]..."; }
        }
        return false;
    }

    

    
    
    public function shopCustUpdate($data) { //$absnum,$o_name,$o_addres,$o_email,$o_phone,$o_discount,$name,$addres,$email,$phone,$discount) {
        file_put_contents('/var/www/dev.vm.ua/loy.txt', 'shopCustUpdate'.print_r($data,1), FILE_APPEND);
        $xml = $this->post( $this->createXml('shopCustUpdate', array(
            'CustAccount'    => $data['absnum'],
				'origName'       => $data['o_name'],
				'origAddress'    => $data['o_addres'],
				'origEmail'      => $data['o_email'],
				'origPhone'      => $data['o_phone'],
				'origDiscountId' => $data['o_discount'],
				'Name'           => $data['name'],
				'Address'        => $data['addres'],
				'Email'          => $data['email'],
				'Phone'          => $data['phone'],
				'DiscountId'     => $data['discount'],
        'DiscountChecked'=> $data['discountchecked'] )
        ));

        $a=$this->createXml('shopCustUpdate', array(
            'CustAccount'    => $data['absnum'],
				'origName'       => $data['o_name'],
				'origAddress'    => $data['o_addres'],
				'origEmail'      => $data['o_email'],
				'origPhone'      => $data['o_phone'],
				'origDiscountId' => $data['o_discount'],
				'Name'           => $data['name'],
				'Address'        => $data['addres'],
				'Email'          => $data['email'],
				'Phone'          => $data['phone'],
				'DiscountId'     => $data['discount'] )
        );

        // file_put_contents('/var/www/dev.vm.ua/loy.txt', $a, FILE_APPEND);

        $customer = array();
        if (!$xml->error) {
            if (isSet($xml->record) && !empty($xml->record)) {
               foreach ($xml->record[0] as $i=>$r) {     
                   $customer[$i] = (string) $r; }
               return (object)$customer;
            }
        }
        // file_put_contents('/var/www/dev.vm.ua/loy.txt', print_r($xml, 1), FILE_APPEND);
        return false;
    }
     
     
///-----params
///Session          ;                                  ; string
///Mark             ; Оценка качества обслуживания     ; int
///FreqCartCharge   ; Частота замены картриджа         ; int
///Wish             ; Пожелание                        ; string
///PrintFoto        ; Фотографии                       ; int
///PrintDoc         ; Документы                        ; int
///PrintOther       ; Прочее                           ; int
///PatronLaserGr    ; Товары ТМ Patron лазерная группа ; int
///PatronInkGr      ; Товары ТМ Patron струйная группа ; int
///Barva            ; Товары ТМ Barva                  ; int
///ChargeRecovLasCart     ; Заправка и восстановление лазерных картриджей           ; int
///ChargeRecovInkCart     ; Заправка и восстановление струйных картриджей           ; int
///OtherStr         ; Другое                           ; string

// public str LoyalityInfoUpdate()     
     
//     shopCustLoyalityInfoUpdate
    public function shopCustLoyalityInfoUpdate($data) { //$absnum,$o_name,$o_addres,$o_email,$o_phone,$o_discount,$name,$addres,$email,$phone,$discount) {
         
        // print_r($data);
        $xml = $this->post( $this->createXml('LoyalityInfoUpdate', array(
        'CustAccount'       => $data['CustAccount'],
        'Mark'              => $data['Mark'],
				'FreqCartCharge'    => $data['FreqCartCharge'],
				'Wish'              => $data['Wish'],
				'PrintFoto'         => $data['PrintFoto'],
				'PrintDoc'          => $data['PrintDoc'],
				'PrintOther'        => $data['PrintOther'],
        'SrcInfo1'          => $data['SrcInfo1'],
        'SrcInfo2'          => $data['SrcInfo2'],
        'SrcInfo3'          => $data['SrcInfo3'],
        'SrcInfo4'          => $data['SrcInfo4'],
        'SrcInfo5'          => $data['SrcInfo5'], 
				'PatronLaserGr'     => $data['PatronLaserGr'],
				'PatronInkGr'       => $data['PatronInkGr'],
				'Barva'             => $data['Barva'],
				'ChargeRecovLasCart'=> $data['ChargeRecovLasCart'],  
        'ChargeRecovInkCart'=> $data['ChargeRecovInkCart'],
				'OtherStr'          => $data['OtherStr'] )
        ));
        // print_r($xml);
        $customer = array();
        if (!$xml->error) {
            if (isSet($xml->record) && !empty($xml->record)) {
               foreach ($xml->record[0] as $i=>$r) {     
                   $customer[$i] = (string) $r; }
               return (object)$customer;
            }
        }
        return false;
    }
    
 
    public function setOrderQtyShop($absnum,$deliveryAddress,$paymentType,$deliveryType,$orderType,$itemAbsnum,$num,$priceGroup,$price,$orderId='',$comment='',$edrpou='') {
        $xml = $this->post( $this->createXml('setOrderQtyShop', array(
            'CustAccount'     => $absnum,
            'EDRPOU'          => $edrpou,
            'DeliveryAddress' => $deliveryAddress,
            'CustPaymMode'    => mb_substr($paymentType,0,40,'UTF-8'),
            'DeliveryMode'    => mb_substr($deliveryType,0,40,'UTF-8'),
            'SalesType'       => mb_substr($orderType,0,40,'UTF-8'),
            'SalesOrder'      => $orderId,
            'Item'            => $itemAbsnum,
            'OrderQty'        => $num,
            'PriceGroup'      => $priceGroup,
            'Price'           => $price,
            'CommentLine'     => $comment, ) //,'run','Web_Order'
        ));

        $item = array();
        if (!$xml->error) {
           foreach ($xml->record as $i=>$r) {    
               $item['orderId'] = (string) $r->SalesOrder;
               $item['Item']    = (string) $r->Item; }
           return $item;
        } else {
		     $this->errors[] = (string) $xml->error; }
        return false;
    }
    
    
    public function salesOrderConfirm($absnum,$orderId,$comment='') {
        $xml = $this->post( $this->createXml('salesOrderConfirm', array(
            'SalesOrder'=>$orderId,
            'Currency'=>'',
            'Comment'=>$comment,
            'CustAccount'=>$absnum ),'run','Web_Order'
        ));

        $axapta_code = '';
        foreach ($xml->record as $i=>$r) {
            $axapta_code = (string) $r->SalesOrder; }

        return $axapta_code;
    }
    

    public function salesOrderPaymShop($absnum,$axapta_code) {
        $xml = $this->post( $this->createXml('salesOrderPaym', array(
            'CustAccount'=>$absnum,
            'SalesOrder'=>$axapta_code ),'run','Web_Order'
        ));

        $file_code = '';
        foreach ($xml->record as $i=>$r) {     
            $file_code = (string) $r->SalesOrder; }

        if ($file_code) {
            $xml = $this->post( $this->createXml('salesOrderPaym2ftp', array(
               'CustAccount'=>$absnum,
               'SalesOrder'=>$axapta_code )
            ));
            
            $file = '';
            foreach ($xml->record as $i=>$r) {     
                $file = (string) $r->File;
            }
            return $file;
        }
        return false;
    }
    

    public function RelatedProduct($item) {
        $xml = $this->post( $this->createXml('RelatedProduct', array(
            'Item'=>$item )
        ));
        $child = '';
        foreach ($xml->record as $i=>$r) {     
            $child = (string) $r->ItemChild; }
        if ($child) {
            $childs = explode(',',$child);
        } else {
            $childs = array(); }
        return $childs;
    }
    
    
    public function PositionsOnOrder($item='') {
        $xml = $this->post( $this->createXml('PositionsOnOrder', array(
            'Item'=>$item )
        ));
        $out = array();
        foreach ($xml->record as $i=>$r) {
           $out[] = array('Item'=>(string) $r->Item, 'Val'=> (string) $r->DeliveryDate); }
        return $out;
    }
    
    
    public function MailingList() {
        $xml = $this->post( $this->createXmlClass('MailingList', null, 'run', 'Web_CRM') );
        $out = array();
        foreach ($xml->record as $i=>$r) {
           $out[] = array('ID'=>(string) $r->MailingListId, 'Name'=> (string) $r->Description); }
        return $out;
    }
    
    
    public function MailingListPerson($item='') {
        $xml = $this->post( $this->createXmlClass('MailingListPerson', array( 'MailingListId '=>$item ), 'run', 'Web_CRM') );
        $out = array();
        foreach ($xml->record as $i=>$r) {
           $out[] = array('Email'=>(string) $r->Email , 'Name'=> (string) $r->Name); }
        return $out;
    }
    
    
    public function AddNews($Header, $Summary, $Text) {
        $xml = $this->post( $this->createXml('News', array(
            'Update'=>true,
            'Header'=>$Header,
				'Summary'=>$Summary,
				'Text'=>$Text,
				'RelType' =>2)
        ));
        //print_r($xml);
        $out = array();
        //foreach ($xml->record as $i=>$r) {
           //$out[] = array('Item'=>(string) $r->Item, 'Val'=> (string) $r->DeliveryDate); }
        return $out;
    }
    
    public function AmountCurInvoices($absnum) {
        $xml = $this->post( $this->createXml('AmountCurInvoices', array(
            'CustAccount'=>$absnum ),'run','Web_Cust'
        ));
        
        //print_r($xml); die('aaa');

        $amount = '';
        foreach ($xml->record as $i=>$r) {     
            $amount = (string) $r->Amount; }
        return $amount;
    }
    
// Вызов аналогично:
// setOrderQtyShop
// SalesOrderPaym2ftp
// 
// Функция:
// serviceSalesOrderStatus
// Параметры:
// SalesOrder       ; #№ заказа                         ; string
// PhoneNumber ; #№ мобильного                     ; string
// Возвращаяет поля:
// SalesOrder       ; Номер заказа                      ; string
// AcceptDate       ; Дата приемки                      ; date
// StatusId         ; Код статуса выполнения работ      ; string
// StatusName       ; Описание статуса выполнения работ ; string
// ReadyDate        ; Ожидаемая дата готовности         ; date    
    
    
    
    public function serviceSalesOrderStatus($data) { 
        // print_r($data);
        // echo $this->createXml('serviceSalesOrderStatus', $data, 'run', null);
        // file_put_contents('/var/www/vm.ua/tttt.log', $this->createXml('serviceSalesOrderStatus', $data, 'run', null), FILE_APPEND);
        $xml = $this->post( $this->createXml('serviceSalesOrderStatus', $data, 'run', null) );
        file_put_contents('/var/www/vm.ua/ssdo.log', print_r($xml,1), FILE_APPEND);
        if ($xml->error) { 
            $out['error']=$xml->error;
        } else {
            $out = array();
            foreach ($xml->record as $i=>$r) {
               $out[] = array('SalesOrder'=>(string) $r->SalesOrder, 
                  'AcceptDate'=> (string) $r->AcceptDate,
                  'StatusId'=> (string) $r->StatusId,
                  'StatusName'=> (string) $r->StatusName,
                  'StatusDate'=> (string) $r->StatusDate,
                  'ReadyDate'=> (string) $r->ReadyDate,              
                  'AuthorEmail'=> (string) $r->AuthorEmail,
                  'AcceptorEmail'=> (string) $r->AcceptorEmail,
                  ); 
            }
        }        
        return $out;
    }
    
    
    public function test() { /// -------------------------------------------------------------------
        $xml = $this->post( $this->createXml('custInfoShop', null) );

        $pos = strpos($this->xml_str, 'Invalid Session');

        if ($pos) {
            return false;
        } else {
            return true;
        }
    }
    
    // Внешние коды номенклатур
    public function getExtVendItemList(){
        $xml = $this->post( $this->createXml('ExtVendItemList', array('VendAccount'=>'КОМЕЛ')));

        $names = array();
        foreach ($xml->record as $i=>$r) {
            $Item = (string) $r->Item;
            $ItemExt    = (string) $r->ItemExt;
            $names[$Item]= $ItemExt;            
        }

        return $names;
    }
    
    // Внешние коды номенклатур
    public function VacationInfo(){
        $xml = $this->post( $this->createXml('VacationInfo', array('osLogin'=>'igor-m'), 'run', 'Web_CRM'));
        // print_r($xml);
        $names = array();
        foreach ($xml->record as $i=>$r) {
            // print_r($r);
            // 
            //$fio = (string) $r->FIO;
            //$period  = (string) $r->Period;
            
            //$names[$Item]= $ItemExt;            
        }

        return $names;
    }
    
    

    public function createXmlClass($method, $params=null, $action='run', $class='') {
       $xml = '<?xml version="1.0" encoding="utf-8"?'.'>
        <daxrequest>
          <action>'.$action.'</action>
          <method>'.$method.'</method>
          <class>'.$class.'</class>
          <params>
            <Session>'.$this->session.'</Session>';
       if ($params) {
          foreach ($params AS $key=>$val) {
             $val  = htmlspecialchars($val);
             $xml .= "<$key>$val</$key>"; } }
       $xml .= '</params></daxrequest>';
       return $xml;
    }
    
    public function _createXML($method='', $params=array()) {
       $q  = '<?xml version="1.0" encoding="utf-8"?'.'>'.
		       '<daxrequest>'.
		 	    '   <action>run</action>'.
             '   <method>'. $method .'</method>'.
             '   <params>';
       foreach($params AS $param=>$val) {
		    $q .= "<{$param}>{$val}</{$param}>\n";
		 }
		 $q .= '   </params>'.
             '</daxrequest>';
        
        return $this->post($q);
    }
    
    

    function close($test=false){
       //
    }
}
