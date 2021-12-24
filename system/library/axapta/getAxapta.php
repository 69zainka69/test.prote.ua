<?
require_once(DIR_SYSTEM.'ax_class/axpost.class.php');
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
    
    function __construct($login='web', $pass='web', $test=false){
    
      //$file_ax_sesion = ROOT.'/lib/axapta.session';
      //$file_ax_sesion = DIR_CACHE.'axapta.session';

      $file_ax_sesion = DIR_CACHE.'axapta.session';
      if (file_exists($file_ax_sesion)) {
          file_put_contents($file_ax_sesion,'');
      } else {
          file_put_contents($file_ax_sesion, $this->session);
      }
    
      if (!$this->session) {
         $ses = file_get_contents($file_ax_sesion);
         if (!$this->ChecSession($ses)) {
           $this->Login('web', 'web');
           file_put_contents($file_ax_sesion, $this->session);
        }
      }
    }
    
    function Login($login='web', $pass='web', $test=false){
        if ($login) {
            $xml = $this->post( $this->createXml('LoginShop', array(
               'User'=>$login,
               'Password'=>$pass,
               'IPAddress'=>'192.168.200.1' )
            ));
            $this->session = (string) $xml->Session;
        }
    }
    
    function ChecSession($session) {
        if ($session) {
            $this->session = $session;
            $xml = $this->post( $this->createXml('SessionTimeout', null) );

            if ( (string)$xml->record->Timeout  ) {
               return true;
            } else {
               $this->session = '';
               return false; }
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
             $val  = htmlspecialchars($val);
             $xml .= "<$key>$val</$key>"; } }
       $xml .= '</params></daxrequest>';
       return $xml;
    }

    /*public function serviceSalesOrderStatus($data) { 
        // print_r($data);
        // echo $this->createXml('serviceSalesOrderStatus', $data, 'run', null);
        // file_put_contents('/var/www/vm.ua/tttt.log', $this->createXml('serviceSalesOrderStatus', $data, 'run', null), FILE_APPEND);
        $xml = $this->post($this->createXml('serviceSalesOrderStatus', $data, 'run', null));
        //file_put_contents('/var/www/vm.ua/ssdo.log', print_r($xml,1), FILE_APPEND);
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
    }*/

    public function serviceSalesOrderLineStatus($data) { 

        $xml = $this->post($this->createXml('serviceSalesOrderLineStatus', $data, 'run', null));
        if ($xml->error) { 
            $out['error']=$xml->error;
        } else {
            $out = array();
            foreach ($xml->record as $i=>$r) {
               $out[] = array('SalesOrder'=>(string) $r->SalesOrder, 
                  'AcceptDate'=> (string) $r->AcceptDate,
                  'ServicesList'=> (string) $r->ServicesList,
                  'StatusId'=> (string) $r->StatusId,
                  'StatusName'=> (string) $r->StatusName,
                  'StatusDate'=> (string) $r->StatusDate,
                  'ReadyDate'=> (string) $r->ReadyDate,              
                  'Amount'=> (int) $r->Amount,              
                  'AuthorEmail'=> (string) $r->AuthorEmail,
                  'AcceptorEmail'=> (string) $r->AcceptorEmail,
                  ); 
            }
        }        
        return $out;
    }

    private function post($xml_request, $parse=true) { // return false; 

      
        //global $phrase;
        
        $axPost = new axPost();
        $axPost->set_post_body(array(
            'xmlRequest' => $xml_request ));
            
        for ($i=0;$i<3;$i++) {
           $xml_str = $axPost->start_transfer(AXAPTA_URL);
           if (!$xml_str) {
              echo "\n\n -------- Пустой Ответ $i -------- \n\n";
              usleep(50000);
              continue; }
           if(substr($xml_str, 0, 5) == "<?xml") { break; // Все ОК ------------
           } else {
              echo "\n\n -------- Ошибка в Аксапте $i -------- \n\n $xml_str \n\n"; }
           usleep(500);
        }
        
        //file_put_contents(LOGS . date('Y_m_d') ."_ax_{$this->log_fle}_log.txt", "\n == ". date('d.m.Y H:i:s') ." == \n{$xml_request}\n-----------\n{$xml_str}\n", FILE_APPEND);

        if (!$xml_str) {
            $this->active = false;

            $last_time = (int) @file_get_contents(PHPECHO.'error.mail');

            if ((time()-3600)>$last_time) {
                require_once(DIR_SYSTEM.'ax_class/sendemail.class.php');

                lib_sendMailErrorList(array(
                      'mail_to'=>array('webadmin@vm.ua','Sergey.Pinjaz@vm.ua'), // 'marketing@vm.ua',
                      'subject'=>'ИНТЕРФЕЙС НЕДОСТУПЕН! '.date('d.m.Y H:i'),
                      'body'=>'Это письмо было отправлено, так как интерфейс для обмена данными с axapta не отвечает на запросы.' )
                );
                lib_sendMailError(array(
                      'subject'=>'ИНТЕРФЕЙС НЕДОСТУПЕН! '.date('d.m.Y H:i'),
                      'body'=>"Это письмо было отправлено, так как интерфейс для обмена данными с axapta не отвечает на запросы. <br /><br /> $xml_request <br /><br /> $xml_str ")
                );
                file_put_contents(PHPECHO.'error.mail', time());
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
        } //
        
        return $this->xml_str;
        
        
        
    }
}

?>