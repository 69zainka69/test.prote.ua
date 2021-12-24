<?php
// Прайс-лист для загрузки на PRICEUA
class ControllerFeedXmlPriceua extends Controller {

    private $datestamp;
    private $firmname;
    private $firmid;
    private $categories;

    public function index() {
        set_time_limit (1800);

        // Константы
        $this->datestamp=date('Y-m-d H:i');
        $this->firmname='Магазин доступной печати Prote';
        $this->firmurl ='https://prote.ua';
        $this->firmid  ='30726';
        // список категорий (статика)
        $this->categories = array(
            '67'=>array(),      // СД-ДВД
            '71'=>array(),      // USB-и удлинители
            '70'=>array(),      // Батареи для ИБП
            '57'=>array(),      // Наклейки для авто
            '73'=>array(),      // Чистящие средства
            '77'=>array(),      // Внешние аккумулятор
            '263'=>array()      // Бойлеры
            );        
        

        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        $this->load->model('catalog/category');

        // Общий заголовок
        $output  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
                   . '<pricelist>' . "\n";
                // . '<currency code="UAH" rate="1"/>' . "\n";
                
                
        // список категорий        
        $results = $this->model_catalog_category->getCategories();
        foreach ($results as $k=>$v) {
            if (in_array($v['category_id'], array(20,30,40,50,125))) {
                $result = $this->model_catalog_category->getCategories($v['category_id']);
                // print_r($result);
                foreach ($result as $key=>$val)
                   $this->categories[$val['category_id']]=array();
            }

        }
        
        // Категории
        $output .= '<catalog>' . "\n" . $this->getCategories(0) . '</catalog>' . "\n";

        // Список товаров
        foreach ($this->categories as $category=>$filter) {
            $output .= '<items>' . "\n" . $this->getProducts($category) . '</items>';
        }
        $output .= '</pricelist>';

//        print_r($this->categories);
//        die();

        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($output);

    }


    protected function getCategories($parent_id, $current_path = '') {

        $output = '';

        $results = $this->model_catalog_category->getCategories($parent_id);

        foreach ($results as $result) {

            if (!$current_path) {
                $new_path = $result['category_id'];
            } else {
                $new_path = $current_path . '_' . $result['category_id'];
            }

            if (isset($this->categories[$result['category_id']])) {

                $output .= '<category id="' . $result['category_id'] . '">' . $result['name'] . '</category>' . "\n";
                
            }
            // $outputa[$result['category_id']] = $output;



            //if (($result['category_id']==21 || $result['category_id']==31))
//                $outputmain .= $output;
//            else ;

            $output .= $this->getCategories($result['category_id'], $new_path);

	}

//        array_walk($outputa, function ($val, $key) {
//            if (($key==21 || $key==31)) { echo $key;
//               $outputmain .= $val;
//            }
//        });


        return $output;
    }

    // Получение списка продуктов для прайслиста (по категориям)
    protected function getProducts($category_id) {

            $output='';
            // Продукты
            $products = $this->model_catalog_product->getProductsPrice(array(
                    'categories' => array($category_id),
                    'filters' => $this->categories[$category_id])
            );
            if($products){
                foreach ($products as $product) {
                    if($product['special']) $product['price']=$product['special'];
                    $output .= '<item id="' . $product['model'] .'">' . "\n";
                    $output .= '<categoryId>' . $category_id . '</categoryId>' . "\n";                
                    $output .= '<name>' . htmlspecialchars($product['name']) . '</name>' . "\n";
                    // $output .= '<vendorCode>' . $product['model'] . '</vendorCode>' . "\n";
                    $output .= '<description>' . htmlspecialchars(strip_tags($product['tag'])) . '</description>' . "\n";
                    $output .= '<priceuah>' . sprintf('%01.2f', $product['price']) . '</priceuah>' . "\n";
                    if ($product['brand']) $output .= '<vendor>' . htmlspecialchars($product['brand']) . '</vendor>' . "\n";
                    // $output .= '<available>true</available>' . "\n";
                    // $output .= '<param name="Оригинальность">Оригинал</param>' . "\n";

                    // Блок "гарантия"
                    /*
                    $num=intval($product['warranty']);
                    if ($num>=0 && $num<=3) $num=$num*12;
                    if ($num>0) $output .= '<guarantee>' . $num . '</guarantee>' . "\n";
                    else $output .= '<guarantee>' . $product['warranty'] . '</guarantee>' . "\n";
                     * 
                     */
                    ///

                    //$output .= '<url>' . $this->url->link('product/product', 'path=' . $new_path . '&product_id=' . $product['product_id'], 'SSL') . '</url>' . "\n";
                    $output .= '<url>' . $this->url->link('product/product', '&product_id=' . $product['product_id'], 'SSL') . '</url>' . "\n";

                    $images = $this->model_catalog_product->getProductImages($product['product_id']);

                    
                    if(isset($images[0])){
                        $path_str= '/image/cache/' . $images[0]['image'];
                        $path_parts=pathinfo($path_str);

                        $path_name=$path_parts['dirname'] . '/' .
                        $path_parts['filename'] . '-'.
                        $this->config->get('config_image_popup_width') . 'x' .
                        $this->config->get('config_image_popup_height') . '.' .
                        $path_parts['extension'];
                        //if  (file_exists('/var/www/prote.com.ua' . $path_name))
                        if  (file_exists(DIR_ROOT . $path_name)) 
                            $output .= '<image>'. $this->firmurl . $path_name . '</image>';
                    } 

                    $output .= '</item>'."\n";

                }
            }
        return $output;
    }


     private static function _arrayReplaceRecursive($array, $array1)
    {
        if (is_array($array1) && count($array1)) {
            foreach ($array1 as $key => $value) {
                if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
                    $array[$key] = array();
                }

                if (is_array($value)) {
                    $value = self::_arrayReplaceRecursive($array[$key], $value);
                }
                $array[$key] = $value;
            }
        }
        return $array;
    }

}
