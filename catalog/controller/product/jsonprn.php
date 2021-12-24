<?php
class ControllerProductJsonprn extends Controller {
    public function index() {

        $this->load->model('catalog/product');
        // $this->load->model('tool/image');

        if (isset($this->request->get['search'])) {
            $search = $this->request->get['search'];
        } else {
            $search = '';
        }

         $filter_data = array(
                'search'              => $search,
                'langid'              => $this->request->get['langid'],
                'start'               => 0,
                'limit'               => 30
         );

        if ($search)
        {
            $results = $this->model_catalog_product->getPrinterCompabilityListSearch($filter_data);
        }
        else
        {
            $results = array();
        }

        $data['products'] = array();
        foreach ($results as $result) {
            $image = '/image/img/article/' . $result['image'];
            if (!file_exists(DIR_ROOT.$image)) {
                //    $image=$this->model_tool_image->resize('/var/www/prote.com.ua'.$image, $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                // if ($result['image']) {
                //		$image = '/image/img/article/' . $result['image'] ; $this->model_tool_image->resize('/image/img/article/'.$result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                // } else {
                $image = '/image/placeholder.png'; // $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
            }

            $href= $this->url->link('product/brand', 'prn='.$result['product_id'].'&cat_id='.$result['category_id']);
            if ($this->request->get['langid']==2) $href=str_replace('prote.ua/', 'prote.ua/ua/', $href);
            
            $data['products'][] = array(
                // 'brand'       => $result['brand'],
                'product_id'  => $result['product_id'],
                // 'title'       => $result['title'],
                'title'       => preg_replace('/('. $search .')/iu', '<strong class="search-excerpt">\0</strong>', $result['title']),
                'image'       => $image,
                // 'code'        => $result['code'],
                // 'absnum'      => $result['absnum'],
                'url'         => $href,
                // ...
            );
        }
        header('Content-Type: application/json');
        header('Content-Type: text/html; charset=utf-8');
        echo json_encode($data['products']);

    }
}
