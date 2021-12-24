<?php
//фид для Google Merchant Center
class ControllerFeedGoogleBase extends Controller {
	public function index() {
		if ($this->config->get('google_base_status')) {

			set_time_limit(18000);

			$desc = $this->config->get('config_meta_description');

			$output  = '<?xml version="1.0" encoding="UTF-8" ?>';
			$output .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">';
			$output .= '<channel>';
			$output .= '<title>Prote - канцтовари, картриджі, папір, чорнило. Все, що потрібно офісу.</title>';
			$output .= '<link>' . HTTPS_SERVER . '</link>';
            $output .= '<description>Створимо готову товарну кошик під вашу заявку. Привеземо товар "під замовлення"</description>';

			$this->load->model('feed/google_base');
			$this->load->model('catalog/category');
			$this->load->model('catalog/product');

			$this->load->model('tool/image');

			$product_data = array();
			//
			//20 125
            //20 картриджи, чернила ()
            //30 картриджи
            $cats=array(20,30,125,200,172);
			$cats2=array(41,51,53,56,73); // 2020-09-07 9:29 Added 41,53 
            $skip=array(21,24,23,31);
			//$cats2=array(51,56,73);
			foreach ($cats as $key => $cat) {

			    $google_base_categories = $this->model_catalog_category->getCategories($cat);
			    //$google_base_categories = $this->model_feed_google_base->getCategories();
                foreach ($google_base_categories as $google_base_category) {
                    /*$filter_data = array(
                        'filter_category_id' => $google_base_category['category_id'],
                        'filter_filter'      => false
                    );*/
                    if(in_array($google_base_category['category_id'],$skip))continue;
                    
                    $output .= $this->get_product($google_base_category);
                    //vdump($google_base_category);
                    //echo "--".$google_base_category['category_id'];
                }
			}
            
            foreach ($cats2 as $key => $cat) {

                $category_info = $this->model_catalog_category->getCategory($cat);
                $output .= $this->get_product($category_info);
                //echo "==".$category_info['category_id'];
            }
            //exit;

			$output .= '</channel>';
			$output .= '</rss>';

			$this->response->addHeader('Content-Type: application/rss+xml');
			$this->response->setOutput($output);
		}
	}

	protected function getPath($parent_id, $current_path = '') {
		$category_info = $this->model_catalog_category->getCategory($parent_id);

		if ($category_info) {
			if (!$current_path) {
				$new_path = $category_info['category_id'];
			} else {
				$new_path = $category_info['category_id'] . '_' . $current_path;
			}

			$path = $this->getPath($category_info['parent_id'], $new_path);

			if ($path) {
				return $path;
			} else {
				return $new_path;
			}
		}
	}

	protected function get_product($google_base_category){

        //$products = $this->model_catalog_product->getProducts($filter_data);

        $sql = "SELECT p.product_id, p.image, p.price, p.quantity, p.model, p.mpn, pd.name, pd.meta_h1 ,pd.ax_description ,
					(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) AND ps.price>0 ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special
					FROM " . DB_PREFIX . "product p 
                    INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id AND pd.language_id = '2' ) 
					/*LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) */
					INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) 
					WHERE p2c.category_id= '".(int)$google_base_category['category_id']."'
						AND p.quantity > 0
						AND p.status = '1' /*AND p.date_available <= NOW()*/
						 /*AND p2s.store_id = '0'*/
						 ";

        $query = $this->db->query($sql);

        $output ='';
        //foreach ($products as $product) {
        foreach ($query->rows as $product) {
            //if($product['product_id']!=30664) continue;

            //$product['ax_description'] = strip_tags(str_replace('<h2>{title} описание</h2>', '',html_entity_decode($product['ax_description'], ENT_QUOTES, 'UTF-8')));
            $product['ax_description'] = str_replace('<h2>{title} опис</h2>', '',html_entity_decode($product['ax_description'], ENT_QUOTES, 'UTF-8'));
            // 2020.04.27 оказалось что не выводятся товары у которых нет описнаия
            // но проверку не просто так добавили, возвращаю обрано (убираю проверку)
            //if (!in_array($product['product_id'], $product_data)) {
            //if (!in_array($product['product_id'], $product_data) && $product['ax_description']) {
            if (!in_array($product['product_id'], $product_data)) {
                //получаем производителя
                $attribute_groups = $this->model_catalog_product->getProductAttributes($product['product_id']);
                $brand='';
                //$break = false;
                $analog = '';
                
                foreach ($attribute_groups as $attribute_group) {
                    foreach ($attribute_group['attribute'] as $attribute) {

                        if($attribute['attribute_id']==4949){
                            $brand = $attribute['text'];
                            $break = true;
                        } elseif($attribute['attribute_id']==1){
                            $brand = $attribute['text'];
                            $break = true;
                        }
                        
                        if($attribute['attribute_id']==13 && ($attribute['text']=='Совместимый'||$attribute['text']=='Сумісний')){
                        /*if($attribute['attribute_id']==13){*/

                            if($attribute['text']=='Сумісний'){
                                $analog='Сумісний';
                                
                            } else {
                                $analog='Совместимый';
                            }/*elseif($attribute['text']=='Оригинальный'){
                                $analog=='Оригинальный';
                            }*/
                            //$analog = $attribute['text'];
                        }
                    }
                    //if($break)break;
                }
                //echo $brand;

                if($product['meta_h1']){
                    $product['name'] = $product['meta_h1'];
                }
                //////////////////////////
                $category_id = $google_base_category['category_id'];
                if(($category_id=='31'||$category_id=='21') && $analog){
                    $product['name'] = str_replace(array('КАРТРИДЖ','Картридж'), $analog.' картридж',$product['name']);
                    $product['name'] = str_replace(array('ТОНЕР-КАРТРИДЖ','Тонер-картридж'), $analog.' тонер-картридж',$product['name']);
                } elseif(($category_id=='31'||$category_id=='21')){
                    $product['name'] = str_replace('КАРТРИДЖ', 'Картридж',$product['name']);
                    $product['name'] = str_replace('ТОНЕР-КАРТРИДЖ', 'Тонер-картридж',$product['name']);
                }
                
                //////////////////////////

                $product['ax_description'] = str_replace(array('{TITLE}','{title}'),$product['name'],$product['ax_description']);
                
                $descripstr=$product['ax_description'];
                if (preg_match_all('/\{#.*?#}/', $descripstr, $matches, PREG_OFFSET_CAPTURE)) {
                    // Порядковый номер (псевдослучайный) последняя цифра кода 1С + 1
                    $pnum = substr($product_info['model'],-1)+1;    // echo $product_info['model']; echo $pnum;
                    foreach (array_reverse($matches[0]) as $val) { 
                        //               
                        $variants = explode('|', trim($val[0],' {}#'));    // print_r($variants);
                        $nvariant = ceil(count($variants)*$pnum/10)-1;    // echo $nvariant; echo count($variants);
                        $descripstr = substr_replace($descripstr, $variants[$nvariant], $val[1], strlen($val[0]));              
                    }
                    $product['ax_description']=$descripstr;
                }
$linkses = $this->url->link('product/product', 'product_id=' . $product['product_id']);
$linkies = explode("prote.ua/", $linkses);
$linakses = $linkies[0]."prote.ua/ua/".$linkies[1];
                $output .= '<item>';
                //$output .= '<title><![CDATA[' . $product['name']  . ']]></title>';
                $output .= '<title>' . htmlspecialchars($product['name']) . '</title>';
                $output .= '<link>' . $linakses. '</link>';
                $output .= '<description>' . strip_tags($product['ax_description']) . '</description>';
                $output .= '<g:brand>' . $brand . '</g:brand>';
                //$output .= '<g:brand><![CDATA[' . html_entity_decode($product['manufacturer'], ENT_QUOTES, 'UTF-8') . ']]></g:brand>';
                //$output .= '<g:brand><![CDATA[' . $brand . ']]></g:brand>';
                $output .= '<g:condition>new</g:condition>';
                $output .= '<g:id>' . $product['product_id'] . '</g:id>';

                if ($product['image']) {
                    $output .= '<g:image_link>' . $this->model_tool_image->resize($product['image'], 500, 500) . '</g:image_link>';
                } else {
                    $output .= '<g:image_link></g:image_link>';
                }

                $output .= '<g:model_number>' . $product['model'] . '</g:model_number>';

                if ($product['mpn']) {
                    $output .= '<g:mpn>' . $product['mpn'] . '</g:mpn>' ;
                } else {
                    $output .= '<g:identifier_exists>false</g:identifier_exists>';
                }

                /*if ($product['upc']) {
                    //$output .= '<g:upc>' . $product['upc'] . '</g:upc>';
                }

                if ($product['ean']) {
                    $output .= '<g:ean>' . $product['ean'] . '</g:ean>';
                }*/

                $currencies = array(
                    'USD',
                    'EUR',
                    'UAH',
                    'GBP'
                );

                if (in_array($this->currency->getCode(), $currencies)) {
                    $currency_code = $this->currency->getCode();
                    $currency_value = $this->currency->getValue();
                } else {
                    $currency_code = 'USD';
                    $currency_value = $this->currency->getValue('USD');
                }

                if ((float)$product['special']) {
                    $output .= '<g:sale_price>' .  $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id']), $currency_code, $currency_value, false) . ' '.$currency_code.'</g:sale_price>';
                    $output .= '<g:price>' . $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id']), $currency_code, $currency_value, false) . ' '.$currency_code.'</g:price>';
                } else {
                    $output .= '<g:price>' . $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id']), $currency_code, $currency_value, false) . ' '.$currency_code.'</g:price>';
                }

                //$output .= '<g:google_product_category>' . $google_base_category['google_base_category_id'] . '</g:google_product_category>';

                $categories = $this->model_catalog_product->getCategories($product['product_id']);

                foreach ($categories as $category) {
                    $path = $this->getPath($category['category_id']);

                    if ($path) {
                        $string = '';

                        foreach (explode('_', $path) as $path_id) {
                            $category_info = $this->model_catalog_category->getCategoryer($path_id);

                            if ($category_info) {
                                if (!$string) {
                                    $string = $category_info['name'];
                                } else {
                                    $string .= ' > ' . $category_info['name'];
                                }
                            }
                        }













                        $output .= '<g:product_type>Головна > ' . $string . '</g:product_type>';
                    }
                }

                $output .= '<g:quantity>' . $product['quantity'] . '</g:quantity>';
                //$output .= '<g:weight>' . $this->weight->format($product['weight'], $product['weight_class_id']) . '</g:weight>';
                $output .= '<g:availability>' . ($product['quantity'] ? 'in stock' : 'out of stock') . '</g:availability>';
                $output .= '</item>';
            }
        }

        return $output;
    }
}
