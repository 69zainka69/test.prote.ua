<?php 
class ControllerOcteamToolsCache extends Controller {
    private $error = array();
    private $version = '1.2.ocs2101';

    public function __construct($registry) {
        parent::__construct($registry);
        $this->load->language('octeam_tools/cache');
    }

    public function index() {
        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title']      = $this->language->get('heading_title');
        $data['button_image']       = $this->language->get('button_image');
        $data['button_system']      = $this->language->get('button_system');
        $data['button_seourl']      = $this->language->get('button_seourl');
        $data['button_price']      = $this->language->get('button_price');
        $data['button_back']        = $this->language->get('button_back');
        $data['text_delete']        = $this->language->get('text_delete');
        $data['text_cache']         = $this->language->get('text_cache');
        $data['text_cleared']       = $this->language->get('text_cleared');
        $data['text_title_image']   = sprintf($this->language->get('text_buttons_help'), 'image/cache/');
        $data['text_title_system']  = sprintf($this->language->get('text_buttons_help'), 'system/storage/cache/');
        $data['text_title_seourl']  = sprintf($this->language->get('text_buttons_help'), 'SeoPro');

        $data['action'] = str_replace('&amp;', '&', $this->url->link('octeam_tools/cache/remove', 'token=' . $this->session->data['token'], 'SSL'));
        $data['back'] = $this->url->link('octeam/toolset', 'token=' . $this->session->data['token'], 'SSL');
        $data['token']  = $this->session->data['token'];

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
          'text'    => $this->language->get('text_octeam_toolset'),
          'href'    => $this->url->link('octeam/toolset', 'token=' . $this->session->data['token'], 'SSL'),
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('octeam_tools/cache', 'token=' . $this->session->data['token'], 'SSL')
          );
        
        $data['header']       = $this->load->controller('common/header');
        $data['column_left']  = $this->load->controller('common/column_left');
        $data['footer']       = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('octeam_tools/cache.tpl', $data));
    }

    public function remove() {
      $json = array();

      if ($this->user->hasPermission('modify', 'octeam_tools/cache')) {

          if (isset($this->request->get['type']) &&  $this->request->get['type'] == 'image') {
              $json['success'] = $this->cleanDirectory(DIR_IMAGE . 'cache/');
          } else if (isset($this->request->get['type']) &&  $this->request->get['type'] == 'system') {
              $json['success'] = $this->cleanDirectory(DIR_CACHE);
          } else if (isset($this->request->get['type']) &&  $this->request->get['type'] == 'seourl') {
              $json['success'] = $this->cleanSeopro();
          } else if (isset($this->request->get['type']) &&  $this->request->get['type'] == 'price') {
              $json['success'] = $this->updatePrice();
          } else {
              $json['success'] = $this->language->get('error_not_found');
          }

      } else {
          $json['error'] = $this->language->get('error_permission');
      }

      $this->response->addHeader('Content-Type: application/json');
      $this->response->setOutput(json_encode($json));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'octeam_tools/cache')) {
            $this->error['warning'] = sprintf($this->language->get('error_permission'), $this->language->get('heading_title'));
        }
        return !$this->error;
    }

    protected function cleanDirectory($directory){
        if (file_exists($directory)) {
            $result = '';
            $it = new RecursiveDirectoryIterator($directory);
            $files = new RecursiveIteratorIterator($it,
                         RecursiveIteratorIterator::CHILD_FIRST);

            foreach($files as $file) {
                if (($file->getFilename() === '.') || ($file->getFilename() === '..') ||
                    ($file->getFilename() === 'index.html') || ($file->getFilename() === 'index.htm')) {
                    continue;
                }

                if ($file->isDir()){
                    @rmdir($file->getRealPath());
                    $result .= 'Remove folder `' . $file . '`' . PHP_EOL;
                } else {
                    @unlink($file->getRealPath());
                    $result .= 'Remove file `' . $file . '`' . PHP_EOL;
                }
            }

        } else {
            $result = sprintf($this->language->get('text_folder_not_found'), $directory);
        }

        return $result;
    }
    
    protected function cleanSeopro(){
       
        
        $this->cache->delete('seo_pro');
        
        $result = sprintf('Cache SeoPro successfully clean!');
        

        return $result;
    }
       

    public function updatePrice() {

        global $db_vm;
        global $db_prote;

        $db_vm = new \mysqli(DB_VM_HOSTNAME, DB_VM_USERNAME, DB_VM_PASSWORD, DB_VM_DATABASE, DB_VM_PORT);

        if ($db_vm->connect_error) {
          trigger_error('Error: Could not make a database link (' . $db_vm->connect_errno . ') ' . $db_vm->connect_error);
          exit();
        } 

        $db_vm->set_charset("utf8");
        $db_vm->query("SET SQL_MODE = ''");

        ini_set("memory_limit","256M");

        // echo "Обновление cont_2130\n";
        $sql = 'SELECT * FROM `cont_2130` WHERE price_group>=14 AND langid=1 AND currency=1';
        $result = $this->getQuery($sql, $db_vm);

        if($result->rows){

            $sql = 'TRUNCATE TABLE `cont_2130`';
            $this->db->query($sql);

            foreach ($result->rows as $key => $value) {
                $sql = "INSERT INTO cont_2130 SET 
                absnum = '".$value['absnum']."', 
                model = '".$value['model']."', 
                langid = '".$value['langid']."', 
                price_group = '".$value['price_group']."', 
                amount = '".$value['amount']."', 
                currency = '".$value['currency']."', 
                date_update = '".$value['date_update']."'";
                $this->db->query($sql);
                
            }

        }

        $sSQL="update
                `cont_2130` b
                INNER JOIN `oc_product` a on b.`absnum`=a.`upc`
                set a.`price`=b.`amount`
             WHERE
                b.model=15 AND
                b.langid=1 AND
                b.price_group=15 AND
                b.currency=1 AND
                b.amount<>a.price AND
                a.status=1 AND 
                a.`upc` NOT LIKE '%B%'
                ";

        $a=$this->db->query($sSQL);
        if ($a) {
            $result='Обновлено записей: '.$this->db->countAffected()."\n";
        } else {
            $result='Ощибка обновления прайсов!!'."\n".$sSQL."\n";
        }

        $sSQL="SELECT p.product_id, /*a.absnum,*/ /*a.axapta_code, a.axapta_article, */c.amount AS special 
            FROM `cont_2130` c
            /*LEFT JOIN vm.`articles` a ON(a.absnum=c.absnum) */
            LEFT JOIN `oc_product` p ON(c.absnum=p.upc) 
            WHERE c.price_group=14 AND c.currency=1 AND c.langid=1 AND c.amount>0 
            /*AND a.absnum IS NOT NULL */
            GROUP BY c.absnum";    
                /* INNER JOIN prote.`oc_product` b on a.`absnum`=b.`upc` 
                LEFT JOIN  c ON a.absnum=c.absnum AND a.langid=c.langid AND  b.status=1 AND c.amount IS NOT NULL AND  GROUP BY a.`absnum`  AND a.absnum = 85024
                ORDER BY `c`.`amount`  DESC*/

        

        $b=$this->db->query($sSQL);
        
        $sSQL="DELETE FROM `oc_product_special`";
        $this->db->query($sSQL);
        $count=0;
        if($b->rows){
            foreach ($b->rows as $key => $row) {
                 if($row['product_id'] && is_numeric($row['product_id'])){
                    $count++;
                    $sSQL=" INSERT INTO `oc_product_special` SET product_id = ".(int)$row['product_id'].", 
                    customer_group_id = 1, priority = 1, price='".$row['special']."',
                    date_start = ".date('Y-m-d').", date_end=".date('Y-m-d', strtotime("+2 days"));
                    $this->db->query($sSQL);
                }
            }
        }
        
        $result.='Обновлено акионных товаров: '.$count."\n";
        
        return $result;
    }

    public function getQuery($sql,$link) {
      $query = $link->query($sql);
      if (!$link->errno) {
          if ($query instanceof \mysqli_result) {
            $data = array();

            while ($row = $query->fetch_assoc()) {
              $data[] = $row;
            }

            $result = new \stdClass();
            $result->num_rows = $query->num_rows;
            $result->row = isset($data[0]) ? $data[0] : array();
            $result->rows = $data;

            $query->close();

            return $result;
          } else {
            return true;
          }
        } else {
          trigger_error('Error: ' . $link->error  . '<br />Error No: ' . $link->errno . '<br />' . $sql);
        }
    }
}
?>