<?php
// Прайс-лист для загрузки на HOTLINE акции
class ControllerFeedXmlPricelistHotlineActions extends Controller {
    
    private $datestamp;
    private $firmname;
    private $firmid;
    private $categories;
    private $start;
  
    public function index() {

        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        set_time_limit (1800);


        $this->start = microtime(true);

        
        // Константы
        $this->datestamp=date('Y-m-d H:i');
        $this->firmname='Магазин доступной печати Prote';
        $this->firmid  ='30726';
        /*$this->categories = array(
            '21'=>array('94'), // Оригинальные!
            '31'=>array('94'), // Оригинальные!
            '70'=>array(),
            '53'=>array(),     // Офисная бумага
            '81'=>array(), //Струйные принтеры
            '82'=>array(), //Лазерные принтеры
            '88'=>array(), //Лазерный МФУ
            '89'=>array() //Струйный МФУ
        );
        $this->no_special=array('263','205','81','82','88','89');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');        
        $this->load->model('catalog/category');
      
        // Канцотовары
        $results = $this->model_catalog_category->getCategories(125);
        foreach ($results as $res) {
            $this->categories[$res['category_id']]=array();
        }
        // Хозтовары
        $results = $this->model_catalog_category->getCategories(172);
        foreach ($results as $res) {
            $this->categories[$res['category_id']]=array();
        }
        // Бытовая химия
        $results = $this->model_catalog_category->getCategories(200);
        foreach ($results as $res) {
            $this->categories[$res['category_id']]=array();
        }*/

        $this->load->model('extension/news');
        $this->load->model('catalog/product');

        $all_news = $this->model_extension_news->getAllNews();
        
        $data['all_news'] = array();

        $sales_xml = '';
        $count =0;
            $count2 =0;
     
        foreach ($all_news as $news) {
            if(!$news['type'])continue;
     // print_r($news);
            $title = html_entity_decode($news['title'], ENT_QUOTES);
            /*$all_news[] = array (
                'title'         => html_entity_decode($news['title'], ENT_QUOTES),
                //'image'         => $this->model_tool_image->resize($news['image'], 400, 237),
                //'description'   =>  (strlen(strip_tags(html_entity_decode($news['short_description'], ENT_QUOTES))) > 50 ? mb_substr(strip_tags(html_entity_decode($news['short_description'], ENT_QUOTES)), 0, 50) . '...' : strip_tags(html_entity_decode($news['short_description'], ENT_QUOTES))),
                //'view'          => $this->url->link('information/news/news', 'news_id=' . $news['news_id']),
                //'date_added'    => date($this->language->get('date_format_short'), strtotime($news['date_added']))
            );*/
            
            $product_ids = $this->model_extension_news->getNewsRelatedProducts($news['news_id']);
            //vdump($product_ids);
            foreach ($product_ids as $key => $prod_id) {
                
                $result = $this->model_catalog_product->getProduct($prod_id['product_id']);

                if(empty($result))continue;

                //$count2++;

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = (int)$result['price'];
                    //$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    //continue;
                }

                if ((float)$result['special']) {
                    $special = (int)$result['special'];
                    //$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    //continue;
                }
                //$count++;

                $sales_xml .= 
                '<sale>
                    <title>'.$title.'</title>
                    <url><![CDATA['.$this->url->link('information/news/news', 'news_id=' . $news['news_id']).']]></url>
                    <date_start><![CDATA[' . $news['date_start'] . ']]></date_start>
                    <date_end><![CDATA[' . $news['date_end'] . ']]></date_end>';
                
                    // <happy_day><![CDATA[Черная пятница]]></happy_day>
                if($news['type']==3&&$news['gift']){
                    $sales_xml .= '
                    <type><![CDATA[Подарок к покупке]]></type>';
                    /*
                    <present_products>
                         Обязательный блок параметров для акции типа - “Подарок к покупке”

                        <product id=”123456”>
                        Адрес страницы подарочного товара на сайте продавца. id - уникальный идентификатор товара продавца, который не меняет своего значения при обновлении XML-файла акций.
                        Либо адрес, либо id должны быть указаны обязательно (указание id более предпочтительно). Допускается указание и адреса страницы и id.

                        Допускается указание только одного подарка.
                        </product>
                    </present_products>
                        или
                    <custom_present>
                        <present_title>
                        Название подарка (услуги). До 100 символов.
                        </present_title>

                        <present_image>
                        Фото подарка. Форматы файлов: jpg, gif или png. Размер: до 3 МБ.
                        </present_image>

                    </custom_present>
                                        */
                    $sales_xml .= '
                    <custom_present><present_title>'. $news['gift']. '</present_title></custom_present>';                    

                } elseif($news['type']==1){
                    $sales_xml .= '<type><![CDATA[Скидка на товар]]></type>';
                } elseif($news['type']==2){
                    $sales_xml .= '<type><![CDATA[Скидка на следующий товар]]></type>';
                } 
                $sales_xml .= '
                    <products>
                        <discount_old_price>'.$price.'</discount_old_price>
                        <product id="'.$prod_id['product_id'].'"><![CDATA['.$this->url->link('product/product', '&product_id=' . $result['product_id']).']]></product>
                    </products>
                </sale>';


            }
        }
        //vdump($count);
        //vdump($count2);

        
        // Общий заголовок        
        $output  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
                '<sales>' . "\n" .
                $sales_xml .'</sales>';
        
        /*// Категории
        $output .= '<categories>' . "\n" . $this->getCategories(0) . '</categories>' . "\n";
        //$time = microtime(true) - $this->start;
        //printf('<br>2 Скрипт выполнялся %.4F сек.', $time);
        
        // Список товаров
        foreach ($this->categories as $category=>$filter) {
            $output .= '<items>' . "\n" . $this->getProducts($category) . '</items>' . "\n";
        }
        //$time = microtime(true) - $this->start;
        //printf('<br>END Скрипт выполнялся %.4F сек.', $time);

        $output .= '</price>' . "\n";*/

        //echo $output;

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
            
                $output .= '<category>' . "\n";
                $output .= '<id>' . $result['category_id'] . '</id>' . "\n";
                // $output .= '<cp>' . $new_path . '</cp>' . "\n";
                //if ($parent_id) 
                //    $output .= '<parentid>' . $parent_id . '</parentid>' . "\n"; 

                $output .= '<name>' . $result['name'] . '</name>' . "\n";

                $output .= '</category>' . "\n";
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
            // gdemon 2019.03.26 - отключил т.к. ошибка 500
            /*$products = $this->model_catalog_product->getProductsPrice(array(
                    'categories' => array($category_id),
                    'filters' => $this->categories[$category_id])
            );*/
            $sql = "SELECT p.product_id, p.model, p.mpn, pd.name, p.price, p.image
            /*, 
            p.quantity,  pd.meta_h1 ,pd.ax_description */
                    ,(SELECT price FROM " . DB_PREFIX . "product_special ps 
                    WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND 
                    ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) 
                    AND ps.price>0 ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special 
                    FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
                    /*LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) */
                    LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) 
                    WHERE p2c.category_id= '".$category_id."'
                        AND pd.language_id = '1' 
                        AND p.quantity > 0
                        AND p.status = '1' AND p.date_available <= NOW()
                         /*AND p2s.store_id = '0'*/
                         ";

            $query = $this->db->query($sql);
            
            $products = array();
            if($query->rows){
                $products = $query->rows;

            }

            //$time = microtime(true) - $this->start;
            //printf('<br>3 Скрипт выполнялся %.4F сек. - '.count($products), $time);

            //img/gallery/153/61/3946799_main.jpg
            //image/cache/img/gallery/153/61/3946799_main-1024x1024.jpg

            foreach ($products as $product){
                
                // если special и category_id!=263 // 263 - бойлеры
                if($product['special'] && !in_array($category_id,$this->no_special)) $product['price']=$product['special'];

                $attr = $this->model_catalog_product->getProductAttributesPrice($product['product_id']);                        
                $brand = '';
                $warranty = 'Есть';                        
                foreach($attr as $key=>$val) {                            
                    if ($val['attribute_id']=='1' || $val['attribute_id']=='4949') $brand=$val['text'];
                    if ($val['attribute_id']==953) $warranty=$val['text'];
                }

                $output .= '<item>'."\n";
                $output .= '<id>' . $product['model'] . '</id>' . "\n";
                $output .= '<categoryId>' . $category_id . '</categoryId>' . "\n";
                $output .= '<code>' . $product['mpn'] . '</code>' . "\n";
                $output .= '<name>' . htmlspecialchars($product['name']) . '</name>' . "\n";
                $output .= '<priceRUAH>' . sprintf('%01.2f', $product['price']) . '</priceRUAH>' . "\n";
                if ($brand) $output .= '<vendor>' . htmlspecialchars($brand) . '</vendor>' . "\n";
                $output .= '<stock>В наличии</stock>' . "\n";
                $output .= '<param name="Оригинальность">Оригинал</param>' . "\n";
                
                // Блок "гарантия"
                //$num=intval($warranty);
                //if ($num>=0 && $num<=3) $num=$num*12;
                //if ($num>0) $output .= '<guarantee>' . $num . '</guarantee>' . "\n";
                $output .= '<guarantee>От производителя</guarantee>' . "\n";
                //else $output .= '<guarantee>' . $product['warranty'] . '</guarantee>' . "\n";
                ///

                $output .= '<url>' . $this->url->link('product/product', 'path=' . $new_path . '&product_id=' . $product['product_id'], 'SSL') . '</url>'."\n";

                $image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
                $output .= '<image>'. $image . '</image>';
                $output .= '</item>'."\n";
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
