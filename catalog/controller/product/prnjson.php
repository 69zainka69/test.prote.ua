<?php
class Controllerproductprnjson extends Controller {
    public function index() {
    
        $this->load->model('catalog/product');
        // $this->load->model('tool/image');
        $this->load->language('product/search');
    

        if (isset($this->request->get['brand'])) {
            $search = $this->request->get['brand'];
        } else {
            $search = '';
        }
    
        if (isset($this->request->get['category'])) {
            $category = $this->request->get['category'];
        } else {
            $category = '';
        }
    
        if (isset($this->request->get['prn'])) {
            $searchprn = $this->request->get['prn'];
        } else {
            $searchprn = '';
        }
    
        if ($search) 
        {
            $filter_data = array(
                'search'              => $search,
                'category'            => $category,
                'langid'              => !isset($this->request->get['langid'])?1:$this->request->get['langid'],
                'start'               => 0,
                'limit'               => 30
            );
            $results = $this->model_catalog_product->getPrinterCompabilityList($search, $category, $this->request->get['langid']);
        } else {
            $results = false;
        }

        $data['printers'] = array();	
        //$ret='<select name="prnprinter" id="prnprinter" class="form-control input-lg" ><option value="" disabled selected> ' .  $this->request->get['language'] . ' ' . $search . '</option>';
        $ret='<select name="prnprinter" id="prnprinter" class="chosen-select" ><option value="" disabled selected> ' .  $this->request->get['language'] . ' ' . $search . '</option>';
        if ($results) {         
            if ($searchprn) {
                foreach ($results as $result) {
                    $ret.='<option value="' . $result['absnum'] .'" data-cat="' . $result['cat_id'] .'" '.(($result['absnum'] == $searchprn) ? 'selected' : '')  . '>' . $result['title'] . '</option>';
                }
            } else {
                foreach ($results as $result) {
                    $ret.='<option value="' . $result['absnum'] .'" data-cat="' . $result['cat_id'] . '">' . $result['title'] . '</option>';
                }

            }
        }  
        $ret.='</select>';
        header('Content-Type: application/json');
        // header('Content-Type: text/html; charset=utf-8');
        header("Cache-Control: no-store, no-cache, must-revalidate"); //HTTP 1.1
        header("Pragma: no-cache"); //HTTP 1.0
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        // echo json_encode($data['printers']);
        echo json_encode($ret);

    }
}