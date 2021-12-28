<?php
class ModelCatalogProduct extends Model {
    public function updateViewed($product_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = (viewed + 1) WHERE product_id = '" . (int)$product_id . "'");
    }

    // Получение списка альтернативных фасовок для чернил
    function getAltPacking($acode)
    {

        // Поиск признака фасовки в коде
        $count = null;
        $returnValue = preg_replace('/-(18|1|090|180|6x90|2X090|CMP)(-|$)/', '-%$2', $acode, -1, $count); // echo $returnValue;
        // Запрос
        $sSQL = "SELECT `product_id`, `mpn` FROM " . DB_PREFIX . "product WHERE `mpn` LIKE '$returnValue' AND status=1";
        $res=$this->db->query($sSQL);
        $data = array();

        foreach ($res->rows as $result) {
            $item = $this->getProduct($result['product_id']);

            $attr = $this->getProductAttributes($result['product_id']);
            $attr = $attr[0]['attribute'];
            // print_r($attr);
            foreach ($attr as $at) {
                if ($at['attribute_id']==526) {
                    if($at['text']=='90'||$at['text']=='180')$at['text'].=' мл';
                    $item['packing']=$at['text'];
                    break;
                }
            }

            $item['href']=$this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id']);
            $item['active'] = ($result['mpn']==$acode);
            $data[] = $item;
            // print_r($item);
        }
        // print_r ($data);
        return $data;

    } // END function getaltpacking

    // Получение списка альтернативных цветов
    function getAltColors($acode)
    {
        // echo $acode;
        $matches = null;
        $returnValue = preg_match('/^I-BAR-ET(.*)-(.*)-(.*)$/', $acode, $matches);
        if ($returnValue) {
            // Чернила EPSON - шаблон I-BARE-ET0812-180-C
            $matches[1][strlen($matches[1])-1]='%';
            $returnValue='I-BAR-ET' . $matches[1] . '-' . $matches[2] . '-%';

            // echo $returnValue;
        } else {
            $matches = null;
            $returnValue = preg_match('/^I-BAR-(CCL|CPG)(.*)-(.*)-(.*)$/', $acode, $matches);
            if ($returnValue) {
                // Чернила CANON - шаблон I-BAR-CCL446-090-M
                $matches[2][strlen($matches[1])-1]='%';
                $returnValue='I-BAR-C%' . $matches[2] . '-' . $matches[3] . '-%';
                // echo $returnValue;
            } else {
                // Остальные чернила
                $count = null;
                // Поиск признака цвета в коде: последние три элемента
                $returnValue = preg_replace('/-([A-Z]{1,3}|B-P|Y-P|C-P|B-SP)$/', '-%', $acode, -1, $count);
            }
        }
        // Запрос
        $sSQL = "SELECT `product_id`, `mpn` FROM " . DB_PREFIX . "product WHERE `mpn` LIKE '$returnValue' AND status=1"; // echo $sSQL;
        $res=$this->db->query($sSQL);

        $data = array();

        foreach ($res->rows as $result) {
            $item = $this->getProduct($result['product_id']);
            $attr = $this->getProductAttributes($result['product_id']);
            $attr = $attr[0]['attribute'];
            foreach ($attr as $at) {
                if ($at['attribute_id']==165) {
                   $item['color']=  str_replace(array(',',' '), array('-',''), strtolower($at['text']));
                   $item['color']=  str_replace(array(
                    'black-cyan-magenta-yellow',
                    'blackpigment-cyan-magenta-yellow'
                ), 'b-c-m-y', $item['color']);

                   break;
               }
           }
            // echo $item['color'];
            // echo '<pre>'; print_r($attr);
            // print_r(array_keys($attr[0]['attribute']),165);
            // print_r($attr);
           $item['href'] = $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id']);
           $item['active'] = ($result['mpn']==$acode);
           $data[] = $item;
       }

       return $data;

    } // END function getaltcolors

    function get_altpacking_altcolor_Canon($packing){

       $find = false;
       $return_array = array();

       foreach ($packing as $key => $pack) {
        foreach ($pack as $key2 => $axcode) {

                $sql = "SELECT `product_id`,mpn FROM " . DB_PREFIX . "product WHERE mpn= '".$axcode."' AND status=1"; // echo $sSQL;
                $res=$this->db->query($sql);
                $data = array();

                foreach ($res->rows as $result) {
                    $item = $this->getProduct($result['product_id']);

                    // получаем цвета и фасовку
                    $attr = $this->getProductAttributes($result['product_id']);
                    $attr = $attr[0]['attribute'];
                    foreach ($attr as $at) {
                        if ($at['attribute_id']==165) {

                           $color=  str_replace(array(',',' '), array('-',''), strtolower($at['text']));
                           $color = str_replace(
                            array('blackpigment-black-cyan-magenta-yellow', 'blackpigment-cyan-magenta-yellow', 'black-cyan-magenta-yellow-lightcyan-lightmagenta', 'black-cyan-magenta-yellow'),
                            array('bp-b-c-m-y', 'b-c-m-y', 'b-c-m-y-lc-lm', 'b-c-m-y'), $color
                        );
                           //break;
                       }
                       if ($at['attribute_id']==526) {
                        $key_fasovka = $at['text'];
                    }
                }

                $return_array[$key_fasovka][] = array(
                    'product_id'    => $result['product_id'],
                    'name'    => $item['name'],
                    'model'    => $item['model'],
                    'mpn'    => $item['mpn'],
                        //'href'    => $item['href'],
                    'color'    => $color,
                    'active'    => ($this->request->get['path']==$result['mpn'])?1:0,
                    'href'    => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'])
                );
            }
        }
    }
    return $return_array;
    } // END function get_altpacking_altcolor_Canon


    public function getProduct($product_id,$language_id=false) {
        /*if($language_id){
            $this->config->set('config_language_id',$language_id);
        }*/

        $sql ="SELECT DISTINCT *, p.product_id as product_id, pd.name AS name, p.image, m.name AS manufacturer,
        (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id
        AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1'
        AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW()))
        ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, ";

        $sql .="(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id
        -- AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'
        AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC,
        ps.price ASC LIMIT 1) AS special, ";
        /* (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id
        AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward, */
        $sql .="(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order, p2c.category_id as category, (SELECT GROUP_CONCAT(DISTINCT news_id SEPARATOR ',') FROM " . DB_PREFIX . "product_to_news pn where pn.`product_id`=p.`product_id`) as `news` FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' /* AND p.status = '1' */ AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

        //vdump($sql);

        $query = $this->db->query($sql);

        // echo "SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
        // print_r($query);
        if ($query->num_rows) {

            // Замена стандартного названия именем из пользовательского H1
            if ($query->row['meta_h1']) {
               $query->row['name'] = $query->row['meta_h1'];
           }

            // Статусная строка наличия товара
            // 0 - в наличии
            // 1 - предзаказ
            // 2 - ожидается (нет в наличии)
            // 3 - архивные
            //

           $ifexist=0;
           $delivery_days=$query->row['delivery_days'] % 100;

            //
           if ($query->row['quantity']==0) {
            if($query->row['asort']==1) {
                if ($delivery_days>2) {
                    $ifexist=1;
                } elseif ($delivery_days==0) {
                    $ifexist=2;
                }
            } else {
                $ifexist=2;
            }
        }

            //

            // Если нет цены - не продается :-)
        if ($query->row['price']==0) $ifexist=3;

            //
            // echo $query->row['name'].$query->row['jan'];

            // проверяем на битый файл
            /*if(strpos($query->row['image'], 'image/img/gallery') === false){
                $query->row['image'] = '';

            }*/
            /*echo DIR_IMAGE . $query->row['image'].'<br>';*/

            /*if (!file_exists(DIR_IMAGE . $query->row['image'])) {
                $query->row['image'] = '';
            }*/
            /*if(!exif_imagetype(DIR_IMAGE . $row['image'])){*/
            /*if(!getimagesize(DIR_IMAGE . $query->row['image'])){
                $query->row['image'] = '';
            }*/
            /*if(!exif_imagetype(DIR_IMAGE . $row['image'])){*/

            /*if($product_id==37){
                vdump($query->row['image']);
            }*/

            if (!USE_EXTERNAL_STATIC_SERVER) {
                if ($query->row['image'] && !exif_imagetype(DIR_IMAGE . $query->row['image'])){
                    $query->row['image'] = '';
                }
            }
            /*if($product_id==37){
                vdump($query->row['image']);
            }*/

            return array(
                'product_id'       => $query->row['product_id'],
                // 'name'             => ($this->expandName($query->row['name'], $this->config->get('config_language_id'), $query->row['category'])),
                'name'             => $query->row['name'],
                'name_short'       => $query->row['name'],

                // Вырезаем паразитные теги ворда из текстов (для валидации)
                'description'      => preg_replace('/(<span style=\"color.*<\/span>)|(<span id=\"copyinfo.*<\/span>)|(border=\".*\")|(cellspacing=\".*\")|(cellpadding=\".*\")|(width=\".*\")/', '', htmlspecialchars_decode($query->row['description'])),
                //'ax_description'   => preg_replace('/(<span style=\"color.*<\/span>)|(<span id=\"copyinfo.*<\/span>)|(border=\".*\")|(cellspacing=\".*\")|(cellpadding=\".*\")|(width=\".*\")/', '', htmlspecialchars_decode($query->row['ax_description'])),
                'ax_description'   => preg_replace('/(<span style=\"color.*<\/span>)|(<span id=\"copyinfo.*<\/span>)/', '', htmlspecialchars_decode($query->row['ax_description'])),
                //

                'meta_title'       => $query->row['meta_title'],
                'meta_h1'          => $query->row['meta_h1'],
                'meta_description' => $query->row['meta_description'],
                'meta_keyword'     => $query->row['meta_keyword'],
                'seo_text'     => $query->row['seo_text'],
                'tag'              => $query->row['tag'],
                'model'            => $query->row['model'],
                'sku'              => ($query->row['upc'])?substr($query->row['upc'], 1, 3) . '-' . $query->row['sku']:$query->row['sku'],
                'upc'              => $query->row['upc'],
                'ean'              => $query->row['ean'],
                'jan'              => $query->row['jan'],
                'isbn'             => $query->row['isbn'],
                'video'              => $query->row['video'],
                'mpn'              => $query->row['mpn'],
                'location'         => $query->row['location'],
                'category'         => $query->row['category'],
                'quantity'         => $query->row['quantity'],
                'delivery_days'         => $query->row['delivery_days'],
                'stock_status'     => $query->row['stock_status'],
                'image'            => $query->row['image'],
                'manufacturer_id'  => $query->row['manufacturer_id'],
                'manufacturer'     => $query->row['manufacturer'],
                'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
                'special'          => $query->row['special'],
                //'reward'           => $query->row['reward'],
                'reward'           => '',
                'points'           => $query->row['points'],
                'tax_class_id'     => $query->row['tax_class_id'],
                'date_available'   => $query->row['date_available'],
                'weight'           => $query->row['weight'],
                'weight_class_id'  => $query->row['weight_class_id'],
                'length'           => $query->row['length'],
                'width'            => $query->row['width'],
                'height'           => $query->row['height'],
                'length_class_id'  => $query->row['length_class_id'],
                'subtract'         => $query->row['subtract'],
                'rating'           => round($query->row['rating']),
                'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
                'minimum'          => $query->row['minimum'],
                'sort_order'       => $query->row['sort_order'],
                'status'           => $query->row['status'],
                'ifexist'          => $ifexist,
                'date_added'       => $query->row['date_added'],
                'date_modified'    => $query->row['date_modified'],
                'viewed'           => $query->row['viewed'],
                'news'             => $query->row['news'],
                'has_free_delivery' => $this->hasProductFreeDelivery($query->row['category'] ?? null),
            );
} else {
    return false;
}
}

public function hasProductFreeDelivery($product_category_id)
{
    $product_category_id = intval($product_category_id);
    if (!$product_category_id) {
        return false;
    }

    $cache_key = 'HasProductFreeDelivery';
    $categories = $this->cache->get($cache_key);
    if ($categories === false) {
        $query = $this->db->query("
            SELECT category_id, parent_id FROM " . DB_PREFIX . "category
            ");

        $categories = [];
        foreach ($query->rows as $row) {
            if (intval($row['category_id'])) {
                $categories[ intval($row['category_id']) ] = intval($row['parent_id']);
            }
        }

        $this->cache->set($cache_key, $categories);
    }

    $product_categories = [];
    $current_category_id = $product_category_id;

    while (isset($categories[ $current_category_id ])) {
        $product_categories[] = $current_category_id;
        $current_category_id = $categories[ $current_category_id ];
    }

    $free_delivery_categories = [
            20, // Расходные материалы для печати
            30, // Лазерная печать
            40, // Матричная печать и факсы
            50, // Бумага и материалы для творчества
            125, // Канцтовары
            172, // Хозтовары
            200, // Бытовая химия
        ];

        foreach ($product_categories as $category_id) {
            if (in_array($category_id, $free_delivery_categories)) {
                return true;
            }
        }

        return false;
    }

    public function getProductCompabilityList_n($product_id, $category_id=false) {

        $sql = "SELECT DISTINCT pc.product_id, pc.child_product_id, p2c.category_id, pc.connection_type, pd.name, p.mpn
        FROM " . DB_PREFIX . "product_compability pc

        INNER JOIN oc_product p ON(p.product_id = pc.child_product_id)
        INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id
        AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "')
        INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)
        WHERE pc.child_product_id = p.product_id
        AND pc.product_id = '" . (int)$product_id . "'";

        $query = $this->db->query($sql);
        $data = array();

        foreach ($query->rows as $result) {

            //если ПУ формируем ссылку на ПУ
            if(in_array($result['category_id'],array(82,81,88,89))) {
                $href= $this->url->link('product/product', 'prn=' . $result['child_product_id']);
            } else{
                $href= $this->url->link('product/product', 'product_id=' . $result['child_product_id']);
            }

            $data[$result['category_id']][$result['child_product_id']]=array(
                'product_id' => $result['child_product_id'],
                'name'             => $result['name'],
                'ax_name'          => $result['mpn'],
                'connection_type'  => $result['connection_type'],
                // 'direct'           => $result['direct'],
                'href'           => $href
            );
        }

        if($category_id){
            if(isset($data[$category_id])){
                return $data[$category_id];
            } else {
                return array();
            }
        } else {
            return $data;
        }
    }

    public function getProductDocList($upc, $doctype='doc') {

    	$query = $this->db->query("SELECT REPLACE( file,  '/user/files',  '/instructions' ) as file, name FROM `axapta_files` WHERE type='$doctype' AND absnum='".$upc."'");

        // SELECT distinctrow p.product_id, pc.connection_type, pc.direct, pd.name FROM " . DB_PREFIX . "product_compability pc, " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE (pc.child_product_id=p.product_id OR pc.product_id=p.product_id) AND pc.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        $data = array();


        $ret='';
        if ($query->num_rows) {

            $ret.="<table class='table' ><tbody>";
            foreach ($query->rows as $result) {
           // определение типа файла
               $ext = explode('.', $result['file']);
               if ( count($ext) > 1 && !empty($ext[count($ext)-1]) ) {
                  $ext = $ext[count($ext)-1];
              } else {
                  $ext = 'pdf';
              }
              $ret.='<tr><td style="width:25%;"><img src="/image/icon/'.$ext.'.png" height="34" width="34" alt="'. $result['name'] .'"></td>
              <td style="width:75%;"><a href="'.$result['file'].'" target=new>'.$result['name'].'</a></td></tr>';

              $data[]=array(
                'file'  => $result['file'],
                'name'  => $result['name'],
              //...
            );
          }
          $ret.='</tbody></table>';
          return $ret;
      } else {
         return false;
     }
 }

 public function getProductCompabilityListByAbsnum($data = array()) {

    $absnum = $data['filter_prn'];
    $category_id=$data['filter_category_id'];

    $sql = "SELECT p.product_id
    FROM oc_product_compability pc
    INNER JOIN oc_product p ON (pc.product_id = p.product_id)
    INNER JOIN oc_product_to_category p2c ON (p.product_id = p2c.product_id)
    WHERE pc.child_product_id = '".(int)$absnum."' AND p.status=1";

    if ($category_id) $sql .= " AND p2c.category_id=$category_id";

    $sort_data = array(
      'pd.name',
      'p.model',
      'p.quantity',
      'p.price',
        		// 'rating',
      'p.sort_order',
      'p.date_added'
  );

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
        if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
            $sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
        } elseif ($data['sort'] == 'p.price') {
                // $sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
            $sql .= " ORDER BY p.price";
        } else {
            $sql .= " ORDER BY " . $data['sort'];
        }
    } else {
        $sql .= " ORDER BY p.sort_order";
    }

    if (isset($data['order']) && ($data['order'] == 'DESC')) {
            //$sql .= " DESC, LCASE(pd.name) DESC";
        $sql .= " DESC";
    } else {
            //$sql .= " ASC, LCASE(pd.name) ASC";
        $sql .= " ASC";
    }

    if (isset($data['start']) || isset($data['limit'])) {
        if ($data['start'] < 0) {
            $data['start'] = 0;
        }

        if ($data['limit'] < 1) {
            $data['limit'] = 20;
        }

        $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
    }

    $query = $this->db->query($sql);

    $data = array();

    foreach ($query->rows as $result) {
        $data[] = $this->getProduct($result['product_id']);
    }
    return $data;
}

public function getProductCompabilityListByAbsnumTotal($data = array()) {

    $absnum = $data['filter_prn'];
    $category_id=$data['filter_category_id'];

    $sql = "SELECT count(DISTINCT p.product_id) as cnt
    FROM oc_product_compability pc
    INNER JOIN oc_product p ON (pc.product_id = p.product_id)
    INNER JOIN oc_product_to_category p2c ON (p.product_id = p2c.product_id)
    WHERE pc.child_product_id = '".(int)$absnum."' AND p2c.category_id='" . (int)$category_id . "' AND p.status=1";

    $query = $this->db->query($sql);

          return $query->rows[0]['cnt']; //$data;
      }

      public function getProductCompabilityListByAbsnumCats($data = array()) {

        $absnum = $data['filter_prn'];

        $sql = "SELECT p2c.category_id, count(DISTINCT p.product_id) AS total
        FROM oc_product_compability pc
        INNER JOIN oc_product p ON (pc.product_id = p.product_id)
        INNER JOIN oc_product_to_category p2c ON (p.product_id = p2c.product_id)
        WHERE pc.child_product_id = '".(int)$absnum."' AND p.status=1 GROUP BY p2c.category_id";

        $query = $this->db->query($sql);

        $data = array();

        foreach ($query->rows as $result) {
            $data[] = $result;
        }

        return $data;
    }

    public function getPrinterCompabilityListSearch($data = array()) {
     $search=$data['search'];
     $langid=$data['langid'];
        // $query = $this->db->query("SELECT distinctrow * FROM " . DB_PREFIX . "af where title like '%" . $search . "%' order by title limit 30");

        // * Увеличил лимит
        // * Поменял отбор категории -min(p4c.category_id)- вместо отбора всех
        // *

     $sql =  "SELECT pd.product_id, pc.absnum, pd.name as title, min(p4c.category_id) category_id
     FROM oc_product_to_category p2c
     INNER JOIN oc_product_description pd on p2c.product_id = pd.product_id AND pd.language_id={$langid} AND INSTR(pd.name, '".$search."')>0
     INNER JOIN oc_product_compability pc USE INDEX (product_id) on p2c.product_id = pc.product_id AND pc.connection_type='/P'
     LEFT JOIN oc_product_to_category p4c on p4c.product_id=pc.child_product_id
     WHERE p2c.category_id IN (81, 82, 89, 96, 88, 92)
     GROUP BY pd.product_id, pc.absnum, pd.name
     ORDER BY pd.name, p4c.category_id DESC
     LIMIT 30";

     $query = $this->db->query($sql);

     $data = array();

     foreach ($query->rows as $result) {
       $data[$result['product_id']]=array(
                // 'brand'       => $result['brand'] ? $result['brand'] : '-',
        'product_id'  => $result['product_id'],
        'title'       => $result['title'],
        'image'       => substr($result['absnum'], 0, 3) .'/'. (int)substr($result['absnum'], 3, 2) . '_tn.jpg',
                // 'code'        => $result['axapta_alias'],
        'absnum'      => $result['absnum'],
        'category_id' => $result['category_id'],
                //...
    );
   }
   return $data;
}

public function getPrinterCompabilityList($brand, $category, $langid=0) {

    // Фильтры для типов печати
    $typefilters = array (
        '20' => "81, 89",
        '30' => "82, 88",
        '40' => "96",
        '90' => "92"
    );

    if ($langid) $this->config->set('config_language_id', $langid);

    // Список категорий
    $catlist=array(21,22,23,24,31,41,42,56);   // убрал 36 - оттуда приходят "чужие принтера" 07.09.2017 17:54:15 - еще убрал 32,33,34,35,37

    // Если не задана категория (вызов с главной) - задаем полный список
    if (!(isset($category) && $category<>''))
        $categorylist=implode (',',$catlist);
    else {
        $c=array_filter($catlist, function ($var) use ($category) {
            return floor($var/10)==floor($category/10);
        });
        $categorylist = implode (',', $c);
        if($categorylist==31){$categorylist.=',42';}
        $typefilter = $typefilters[$category];
    }
    // Добавил проверку наличия товара - чтоб не показывать принтера с пустыми страницами товаров
    //
    $sql = "
    SELECT DISTINCT ac.child_product_id, p.product_id as prod_id, pd.name, min(a.category_id) AS cat_id
    FROM " . DB_PREFIX . "product_to_category a
    INNER JOIN " . DB_PREFIX . "product_compability ac
    ON ac.product_id = a.product_id AND ac.connection_type = '/P'
    INNER JOIN " . DB_PREFIX . "product p
    ON p.product_id = a.product_id AND p.status = '1' "
    . ($brand!='datecs' ? "INNER JOIN " . DB_PREFIX . "product_attribute pa
       ON pa.product_id = ac.child_product_id
       AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "'
       AND pa.attribute_id = 10
       AND pa.`text` = '$brand'" : '') .
    "LEFT JOIN " . DB_PREFIX . "product_description pd
    ON pd.product_id = ac.child_product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'" .
    ($typefilter ? "INNER JOIN " . DB_PREFIX . "product_to_category pc ON pc.product_id = ac.child_product_id AND pc.category_id IN ( ".$typefilter." )" : '') .
    " WHERE a.category_id in ($categorylist) ".
    " GROUP BY ac.`child_product_id`";

    //vdump($sql);

    $query = $this->db->query($sql);

    /*if (isset($this->request->get['admin'])) {
          echo $sql;
      } */


    //$query = $this->db->query1($sql);


    // 07.09.2017 17:54:15 - Игорь
    // Добавить проверку на соответствие возвращаемых товаров целевой категории
    // INNER JOIN oc_product_to_category pc ON pc.product_id = ac.child_product_id AND  pc.category_id in (81)
    // 81, 89 - струйные
    // 82 - лазерные
    // и т.д. (уточнить список!)

      $data = array();
      if ($query->num_rows) {
        foreach ($query->rows as $result) {
            $sql = "SELECT name FROM
            " . DB_PREFIX . "product_description WHERE product_id=".$result['child_product_id']." AND language_id = '" . (int)$this->config->get('config_language_id') . "'";
            $query = $this->db->query($sql);
            $data[]=array(
                //'brand'       => $result['text'],
                'prod_id'       => $result['prod_id'],
                //'product_id'       => $result['product_id'],
                'child_product_id'       => $result['child_product_id'],
                'title'       => $result['name'],
                'absnum'      => $result['child_product_id'],
                //'category_id' => $result['category_id'],
                'cat_id' => $result['cat_id'],

              //...
            );
        }
        // print_r($data);
        return $data;

    } else {
        return false;
    }

}

public function getPrinterBrands($categoryId=false) {

    //vdump($categoryId);


    // Разные запросы если есть категория или если нет
    if (!(isset($categoryId) && $categoryId<>'')) $categoryId='21,22,23,24,31,32,33,34,35,37';

    /*$sql = "select distinct pa.`text` as brand
          from (select product_id from oc_product_to_category where category_id in(".$categoryId.")) a
          join oc_product_compability ac on ac.product_id=a.product_id AND ac.connection_type='/P'
          join oc_product_attribute pa on pa.product_id = ac.product_id and pa.attribute_id=10 and pa.language_id=1
          order by pa.text";*/

          $sql = "SELECT DISTINCT pa.`text` as brand
          FROM  oc_product_attribute pa
          WHERE pa.attribute_id=10 AND pa.language_id=1
          AND EXISTS(
          SELECT * FROM oc_product_to_category p2c
          WHERE p2c.product_id=pa.product_id AND p2c.category_id in(".$categoryId.")
          )
          AND EXISTS(
          SELECT * FROM oc_product_compability pc
          WHERE pc.product_id=pa.product_id AND pc.connection_type='/P'
          )
          order by pa.text";

          $query = $this->db->query($sql);
    //vdump($query);

          $data = array();
          if ($query->num_rows) {
            foreach ($query->rows as $result) {
                $data[]=array(
                    'brand'  => $result['brand'],
              //...
                );
            }
            return $data;
        } else {
            return false;
        }
    }

    public function getPrinterBrandsCats($type=0) {
        // Категории
        if($type==1){
            $a = array(
                1=>array(
                 20 => 'Cтруйные принтеры и МФУ',
                 30 => 'Лазерные принтеры и МФУ',
                 40 => 'Матричне принтеры',
             ),
                2=>array(
                    20 => 'Струменеві принтери та БФП',
                    30 => 'Лазерні принтери та БФП',
                    40 => 'Матричні принтери',
                )
            );
        } else {
            $a = array(
                1=>array(
                    20 => 'струйные',
                    30 => 'лазерные',
                    40 => 'матричные'
                ),
                2=>array(
                    20 => 'струменеві',
                    30 => 'лазерні',
                    40 => 'матричні'
                )
            );
        }

        $sSQL="SELECT DISTINCT `text` as brand, ROUND(pc.category_id, -1) AS category_id
        FROM oc_product p
        LEFT JOIN `oc_product_attribute` pa on pa.product_id=p.product_id AND pa.language_id=1 AND pa.attribute_id=10
        INNER JOIN oc_product_compability p2c ON pa.product_id = p2c.product_id AND connection_type =  '/P'
        LEFT JOIN `oc_product_to_category` pc on pa.product_id=pc.product_id
        WHERE  p.status=1 AND
        `text` NOT IN (
        'Citizen',
        'Develop',
        'Fujitsu',
        'IBM',
        'Lanier',
        'Nashuatec',
        'Ocp',
        'Dell',
        'Olivetti',
        'Pantum',
        'Printronix',
        'Rex Rotary',
        'Riso',
        'Tally',
        'Hewlett Packard',
        'Oce',
        'Star',
        'Utax') AND !(`text`='Panasonic' AND pc.category_id=42) AND !(`text`='Xerox' AND pc.category_id=21) order by text, category_id";

        $query = $this->db->query($sSQL);

        $data = array();
        if ($query->num_rows) {
            foreach ($query->rows as $result) {
                if ($result['category_id']<50) {
                   $catid = $result['category_id']; // - ($result['category_id'] % 10);
                   $data[$result['brand']][$catid]=$a[$this->config->get('config_language_id')][$catid];

               }
           }
           return $data;
       } else {
        return false;
    }

}
    // Products data for Price list
    //
public function getProductsPrice($data = array()) {

    $filters = implode (',', $data['filters']);
    $categories = implode (',', $data['categories']);
    $sql="SELECT distinct p.product_id
    FROM `oc_product` p, `oc_product_to_category` pc
    LEFT JOIN `oc_product_filter` pf USING (product_id)
    WHERE     p.product_id = pc.product_id

    AND pc.category_id in (" . $categories . ")".
    ($filters ? "AND pf.filter_id in (" . $filters . ")" : '').
    "AND p.quantity>0
    AND p.price>0";

    $query = $this->db->query($sql);

    $product_data = array();

    foreach ($query->rows as $result) {
        $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
        $attr = $this->getProductAttributesPrice($result['product_id']);
        $brand = '';
        $warranty = 'Есть';
        foreach($attr as $key=>$val) {
            if ($val['attribute_id']=='1' || $val['attribute_id']=='4949') $brand=$val['text'];
            if ($val['attribute_id']==953) $warranty=$val['text'];
        }
        $product_data[$result['product_id']]['brand'] = $brand;
        $product_data[$result['product_id']]['warranty'] = $warranty;
    }

    return $product_data;
}

public function getProducts($data = array()) {
                // file_put_contents('/var/www/vm.ua/dirs.log', print_r($data, 1), FILE_APPEND);
    if(!isset($data['filter_name'])){
        $data['filter_name'] ='';
    }
        //$sql = "SELECT p.product_id, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity >0 AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) AND ps.price>0 ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, IF (pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%', 1, 0) AS namefound";
    $sql = "SELECT p.product_id,

    (SELECT price FROM " . DB_PREFIX . "product_discount pd2
    WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'
    AND pd2.quantity >0 AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW()))
    ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1)
    AS discount,
    (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id
    AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'
    AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW())
    AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) AND ps.price>0 ORDER BY ps.priority ASC, ps.price ASC LIMIT 1)
    AS special,
    IF (pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%', 1, 0) AS namefound";
        // echo $sql;

    if (!empty($data['filter_category_id'])) {
       if (!empty($data['filter_sub_category'])) {
        $sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
    } else {
        $sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
    }

    if (!empty($data['filter_filter'])) {
        $sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
    } else {
        $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
    }
        //} elseif (isset($data['filter_attribute_id'])) {
            //$sql .= " FROM " . DB_PREFIX . "product_filter pf LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
            //$sql .= " FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "product p ON (pa.product_id = p.product_id)";
} else {
   $sql .= " FROM " . DB_PREFIX . "product p";
}

$languageFilter = empty($data['filter_name']) ? ("pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND") : "";

        //$sql .= " LEFT JOIN ";
$sql .= " INNER JOIN ";
$sql .= " " . DB_PREFIX . "product_description pd ON (". $languageFilter ." p.product_id = pd.product_id)
WHERE p.date_available <= NOW()
";
if (!empty($data['status'])) {
    $sql .= " AND p.status = '".(int)$data['status']."'";
}
if (!empty($data['filter_category_id'])) {
   if (!empty($data['filter_sub_category'])) {
    $sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
} else {
    $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
}

if (!empty($data['filter_filter'])) {
    $implode = array();

    $filters = explode(',', $data['filter_filter']);

    foreach ($filters as $filter_id) {
     $implode[] = (int)$filter_id;
 }

 $sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";

}
}

if (isset($data['filter_attribute_id'])) {

    $sql .= " AND EXISTS (
    SELECT *
    FROM oc_product_attribute pa
    WHERE
    pa.language_id =1 AND
    pa.text = '" . $this->db->escape($data['filter_attribute_name']) . "'
    AND pa.attribute_id = '" . (int)$data['filter_attribute_id'] . "'
    AND pa.product_id = p.product_id
)";

if (isset($data['price_min'])) {
    $sql .= " AND p.price>".$data['price_min'];
}

}

if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
    if (isset($data['price_min'])) {
        $sql .= " AND p.price>".$data['price_min'];
    }

    if (!empty($data['filter_name'])) {
        $this->load->model('module/search_engine');
        $condition = $this->model_module_search_engine->getSearchCondition($data['filter_name']);
        $sql .= " AND " . $condition;
    }

    $sql .= " AND p.status = '1'";
}

if (!empty($data['filter_manufacturer_id'])) {
   $sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
}

		//$sql .= " GROUP BY p.product_id";


$sort_data = array(
   'pd.name',
   'p.model',
   'p.quantity',
   'p.price',
   'rating',
   'p.sort_order',
   'p.date_added',
   'rand'
);
        //$sql .= " ORDER BY namefound DESC, (p.quantity>0) DESC";
$sql .= " ORDER BY ";
        //$sql .= " ORDER BY p.price DESC, p.delivery_days ASC";

if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {

   if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
    $sql .= " p.quantity DESC, LCASE(" . $data['sort'] . ")";
} elseif ($data['sort'] == 'p.price') {

    if (isset($data['order']) && ($data['order'] == 'DESC')) {
        $order = " DESC";
    } else {
        $order = " ASC";
    }
    $sql .= "ifexist DESC, (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END) ".$order.", p.quantity DESC";
} elseif ($data['sort'] == 'rand') {
    $sql .= " rand()";

} else {
    $sql .= " p.quantity, " . $data['sort'];

}
} else {
			//$sql .= ",  p.sort_order";

    $sql .= " p.price DESC, p.delivery_days ASC";
}

		/*if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
		}*/

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
        // echo $sql;
		$product_data = array();

        // Отлкючил БФ - он давал неверные результаты 16.01.2017 11:18:55
        // **************************************************************
        /* Brainy Filter Pro (brainyfilter.xml) - Start ->*/
        //vdump($sql);
        //vdump($data);

        if (isset($data['filter_bfilter']) && $data['filter_bfilter']) {
           $this->load->model('module/brainyfilter');

            // p.sort_order по умолчанию
           $this->model_module_brainyfilter->setData($data);
           $sql = $this->model_module_brainyfilter->prepareQueryForCategory();
           /* Brainy Filter Pro (brainyfilter.xml) - End ->*/
       }

       $query = $this->db->query($sql);



    foreach ($query->rows as $result) {
      $prod = $this->getProduct($result['product_id']);
      $product_data[$result['product_id']] = $prod;
  }

  return $product_data;
}

public function getProductsByFilter($data = array()) {
                // file_put_contents('/var/www/vm.ua/dirs.log', print_r($data, 1), FILE_APPEND);
                // file_put_contents('/var/www/vm.ua/dirs.log', print_r($data, 1), FILE_APPEND);
        // Язык для поиска передается в качестве параметра!!!
    if (isset($data['langid'])) $this->config->set('config_language_id', $data['langid']);
        ///
    $sql = "SELECT p.product_id, pd.language_id, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) AND ps.price>0 ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, IF (pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%', 1, 0) AS namefound";
        // echo $sql;

    $sql .= " FROM " . DB_PREFIX . "product p";
    $sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
    LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
    WHERE
    /*pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND */
    p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

    if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
        $sql .= " AND (";

        if (!empty($data['filter_name'])) {
            $implode = array();

            $words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

            foreach ($words as $word) {
                $implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
                $implodeseo[] = "pd.meta_h1 LIKE '%" . $this->db->escape($word) . "%'";
            }

            if ($implode) {
                $sql .= " " . implode(" AND ", $implode) . "";
            }

            if ($implodeseo) {
                $sql .= " OR (" . implode(" AND ", $implodeseo) . ")";
            }

            if (!empty($data['filter_description'])) {
                $sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
            }
        }

        if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
                //$sql .= " OR ";
        }

            /*if (!empty($data['filter_tag'])) {
                $sql .= " OR pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
            }*/

            if (!empty($data['filter_name']) &&
                ((strlen((int)$data['filter_name'])<7 || strlen((int)$data['filter_name'])>4) || (mb_strtolower($data['filter_name']{0})=='u' && strlen((int)$data['filter_name'])>4))
            ) {
                $sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
                //$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
                //$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
        }

        $sql .= ")";
    }


    $sql .= " GROUP BY p.product_id";

    $sql .= " ORDER BY namefound DESC, (p.quantity>0) DESC,  p.sort_order";


    if (isset($data['start']) || isset($data['limit'])) {
        if ($data['start'] < 0) {
            $data['start'] = 0;
        }

        if ($data['limit'] < 1) {
            $data['limit'] = 20;
        }

        $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
    }

    $product_data = array();
        //$this->log->write($sql);


        //vdump($sql);

    $query = $this->db->query($sql);


    foreach ($query->rows as $result) {

        $this->config->set('config_language_id', $result['language_id']);

        $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
    }

    return $product_data;
}

public function getProductsSearchFullText($data = array()) {

    if (isset($data['langid'])) {
        $this->config->set('config_language_id', $data['langid']);
    }

    $sql = "SELECT pd.product_id, pd.name ";

    $sql .= " FROM oc_product_description pd";
    $sql .= " INNER JOIN oc_product p ON (p.product_id = pd.product_id) ";
    $sql .= " WHERE ";

    if (!empty($data['filter_name'])) {
        $this->load->model('module/search_engine');
        $condition = $this->model_module_search_engine->getSearchCondition($data['filter_name']);
        $sql .= $condition . " AND ";
    }

    $sql .= " p.status = '1' AND p.price > 0 AND p.date_available <= NOW() ";

    $sql .= " GROUP BY p.product_id";
    $sql .= " ORDER BY pd.name DESC, (p.quantity>0) DESC,  p.sort_order";


    if (isset($data['start']) || isset($data['limit'])) {
        if (!isset($data['start']) || isset($data['start']) &&$data['start'] < 0) {
            $data['start'] = 0;
        }

        if (!isset($data['limit']) || isset($data['limit'])&& $data['limit']< 1) {
            $data['limit'] = 20;
        }

        $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
    } else {
        $sql .= " LIMIT 0,4";
    }

    $product_data = array();

    $query = $this->db->query($sql);

    foreach ($query->rows as $result) {
            //$this->config->set('config_language_id', $result['language_id']);

        $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
    }

    return $product_data;
}



public function getProductList($data = array()) {
 $this->getProducts($data);
}

public function getProductSpecials($data = array()) {
  $sql = "SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.product_id";

  $sort_data = array(
   'pd.name',
   'p.model',
   'ps.price',
   'rating',
   'p.sort_order'
);

  if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
   if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
    $sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
} else {
    $sql .= " ORDER BY " . $data['sort'];
}
} else {
   $sql .= " ORDER BY p.sort_order";
}

if (isset($data['order']) && ($data['order'] == 'DESC')) {
   $sql .= " DESC, LCASE(pd.name) DESC";
} else {
   $sql .= " ASC, LCASE(pd.name) ASC";
}

if (isset($data['start']) || isset($data['limit'])) {
   if ($data['start'] < 0) {
    $data['start'] = 0;
}

if ($data['limit'] < 1) {
    $data['limit'] = 20;
}

$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
}

$product_data = array();

$query = $this->db->query($sql);

foreach ($query->rows as $result) {
   $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
}

return $product_data;
}

public function getLatestProducts($limit) {
  $product_data = $this->cache->get('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

  if (!$product_data) {
   $query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);

   foreach ($query->rows as $result) {
    $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
}

$this->cache->set('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
}

return $product_data;
}

public function getPopularProducts($limit) {
  $product_data = array();

  $query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed DESC, p.date_added DESC LIMIT " . (int)$limit);

  foreach ($query->rows as $result) {
   $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
}

return $product_data;
}
public function getBestSellerProductsOur($limit) {
    $product_data = $this->cache->get('products.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);
 
    if(!$product_data) {
        $product_data = [];
       
        $query = $this->db->query("SELECT * FROM `bestaellerproductsour` LIMIT $limit;");

        foreach ($query->rows as $result) {
            $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
        }
        $this->cache->set('products.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data, 9000);
    }
    return $product_data;
}

public function getBestSellerProductsLastWeek($limit) {
    $product_data = $this->cache->get('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);
 
     if(!$product_data) {
         $product_data = [];
         $previous_week = strtotime("-1 week");
         $start_week = strtotime("last monday midnight", $previous_week);
         $end_week = strtotime("next sunday", $start_week);
         $start_week = date("Y-m-d 00:00:00",strtotime('Monday last week'));
         $end_week = date("Y-m-d 23:59:59",strtotime('Sunday last week'));

         $query = $this->db->query("
         SELECT op.product_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_product op 
         LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) 
         LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) 
         WHERE o.order_status_id IN ('1','2') AND p.status = '1' AND p.quantity > 0 AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' 
         AND o.date_added >= '" . (string)$start_week . "' AND o.date_added <= '" . (string)$end_week . "'
         GROUP BY op.product_id 
         ORDER BY total DESC 
         LIMIT " . (int)$limit);
 
         foreach ($query->rows as $result) {
             $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
         }
         $this->cache->set('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data, 9000);
     }
     return $product_data;
 }

 public function getBestSellerProducts($limit) {
    $product_data = $this->cache->get('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);
  
    if (!$product_data) {
     $product_data = array();
  
     $query = $this->db->query("SELECT op.product_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.quantity > 0 AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);
  
     foreach ($query->rows as $result) {
      $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
    }
}
}

public function getBestSellerProductsCats($cat, $limit) {

  $product_data = $this->cache->get('product.bestsellercat.' . $cat . '.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

  if (!$product_data) {
   $product_data = array();

   $sql = "SELECT op.product_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND p2c.category_id = '" . (int)$cat . "' AND .p.quantity > 0 GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit;
   $query = $this->db->query($sql);
   foreach ($query->rows as $result) {
    $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
}

$this->cache->set('product.bestsellercat.' . $cat . '.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
}

return $product_data;
}

public function getProductAttributes($product_id) {
  $product_attribute_group_data = array();

  $product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.product_id = '" . (int)$product_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

  foreach ($product_attribute_group_query->rows as $product_attribute_group) {
   $product_attribute_data = array();

   $sql = "SELECT a.attribute_id, ad.name, pa.text, ";
   $sql .= "
   (SELECT value  FROM `oc_bf_aggregate_filters` bff
   WHERE bff.product_id = '" . (int)$product_id . "' AND bff.group_id = a.attribute_id LIMIT 1) as filter_id ";
   $sql .= "FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name";

            //vdump($sql);
   $product_attribute_query = $this->db->query($sql);

   if($product_attribute_query->rows){
       foreach ($product_attribute_query->rows as $product_attribute) {
        $product_attribute_data[] = array(
         'attribute_id' => $product_attribute['attribute_id'],
         'name'         => $product_attribute['name'],
         'text'         => $product_attribute['text'],
         'color_atr'         => !empty($this->getProductAttributesColorCyrillic($product_attribute['text']))?$this->getProductAttributesColorCyrillic($product_attribute['text']):false,
         'filter_id'         => $product_attribute['filter_id']
     );
    }
}

$product_attribute_group_data[] = array(
    'attribute_group_id' => $product_attribute_group['attribute_group_id'],
    'name'               => $product_attribute_group['name'],
    'attribute'          => $product_attribute_data
);
}

return $product_attribute_group_data;
}

public function getProductAttributesColorCyrillic($str){
        // vdump($str);

    $replace_colors = $this->language->get('replace_colors');
    if(is_string($str)){
        $res=trim($str);
        $res=str_replace('--','-',preg_replace('/\PL/u', '-',  $res));
	
	if(empty($replace_colors[$res])) {
            return false;
        }

        return $replace_colors[$res];

//        return !empty($res)?$res:false;
    }
    return false;
}
public function getBrainyFiltersAttributesColorCyrillic($arr){
    if(is_array($arr)){
     $replace_colors = $this->language->get('replace_colors');
     foreach ($arr as $key => $value) {
        foreach ($value as $k => $v) {
            if($k=='values')
                foreach ($v as $kk => $vv) {
                    $vv['name']=trim($vv['name']);
                    $res=str_replace('--','-',preg_replace('/\PL/u', '-',  $vv['name']));
                    if(array_key_exists($res,$replace_colors) ){
                       $arr[$key][$k][$kk]['name']=$replace_colors[$res];
                   }
               }
           }
       }
       return $arr;
   }
   return $arr;
}

public function getProductAttributesPrice($product_id) {

    $product_attribute_query = $this->db->query("SELECT attribute_id, `text` FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id IN (1, 953, 4949) AND language_id = 1");
    return $product_attribute_query->rows;
}
public function total_pr($sessi){
		
    $product_cart = $this->cache->get($sessi.'_cart_pro_');
    $products = explode(",", $product_cart);	
    $count_produs = 0;

    $tot_pr = 0;
    foreach($products as $prod){
        $pr = $this->cache->get('_pro_prc'.$prod);
        $qua = $this->cache->get($sessi.'_pro_qua'.$prod);
        $count_produs = $count_produs+$qua;
        $tot_pr = $tot_pr + $pr*$qua;
    }
    $tot_pr = $tot_pr." грн.";
    return($tot_pr);
}


public function total_coun($sessi){

    $product_cart = $this->cache->get($sessi.'_cart_pro_');
    $products = explode(",", $product_cart);	
    $count_produs = 0;


    foreach($products as $prod){
        if(is_int($prod)){
        $qua = $this->cache->get($sessi.'_pro_qua'.$prod);
        $count_produs = $count_produs+$qua;
    }
    }
    
    return($count_produs);
}
public function getProductOptions($product_id) {
  $product_option_data = array();

  $product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

  foreach ($product_option_query->rows as $product_option) {
   $product_option_value_data = array();

   $product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

   foreach ($product_option_value_query->rows as $product_option_value) {
    $product_option_value_data[] = array(
     'product_option_value_id' => $product_option_value['product_option_value_id'],
     'option_value_id'         => $product_option_value['option_value_id'],
     'name'                    => $product_option_value['name'],
     'image'                   => $product_option_value['image'],
     'quantity'                => $product_option_value['quantity'],
     'subtract'                => $product_option_value['subtract'],
     'price'                   => $product_option_value['price'],
     'price_prefix'            => $product_option_value['price_prefix'],
     'weight'                  => $product_option_value['weight'],
     'weight_prefix'           => $product_option_value['weight_prefix']
 );
}

$product_option_data[] = array(
    'product_option_id'    => $product_option['product_option_id'],
    'product_option_value' => $product_option_value_data,
    'option_id'            => $product_option['option_id'],
    'name'                 => $product_option['name'],
    'type'                 => $product_option['type'],
    'value'                => $product_option['value'],
    'required'             => $product_option['required']
);
}

return $product_option_data;
}

public function getProductDiscounts($product_id) {
  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

  return $query->rows;
}

public function getProductImages($product_id) {
  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY `image` ASC");

        foreach ($query->rows as $key => $row) { // проверяем на битые файлы
            //if(!exif_imagetype(DIR_IMAGE . $row['image'])){



            if(!getimagesize(DIR_IMAGE . $row['image'])){
                unset($query->rows[$key]);
            }

           // }
        }

        return $query->rows;
    }

    public function getProductRelated($product_id) {
      $product_data = array();

      $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pr.product_id = '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

      foreach ($query->rows as $result) {
       $product_data[$result['related_id']] = $this->getProduct($result['related_id']);
   }

   return $product_data;
}

public function getProductLayoutId($product_id) {
  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

  if ($query->num_rows) {
   return $query->row['layout_id'];
} else {
   return 0;
}
}

public function getCategories($product_id) {
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

    return $query->rows;
}

public function getTotalProducts($data = array()) {
  $sql = "SELECT COUNT(DISTINCT p.product_id) AS total";

  if (!empty($data['filter_category_id'])) {
   if (!empty($data['filter_sub_category'])) {
    $sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
} else {
    $sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
}

if (!empty($data['filter_filter'])) {
    $sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
} else {
    $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
}
} else {
   $sql .= " FROM " . DB_PREFIX . "product p";
}

$languageFilter = empty($data['filter_name']) ? ("pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND") : "";

$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE " . $languageFilter . " p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

if (!empty($data['filter_category_id'])) {
   if (!empty($data['filter_sub_category'])) {
    $sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
} else {
    $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
}

if (!empty($data['filter_filter'])) {
    $implode = array();

    $filters = explode(',', $data['filter_filter']);

    foreach ($filters as $filter_id) {
     $implode[] = (int)$filter_id;
 }

 $sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
}
}

if (isset($data['filter_attribute_id'])) {

    $sql .= " AND EXISTS (
    SELECT *
    FROM oc_product_attribute pa
    WHERE
    pa.language_id =1 AND
    pa.text = '" . $this->db->escape($data['filter_attribute_name']) . "'
    AND pa.attribute_id = '" . (int)$data['filter_attribute_id'] . "'
    AND pa.product_id = p.product_id
)";

if (isset($data['price_min'])) {
    $sql .= " AND p.price>".$data['price_min'];
}

}

if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
   if (!empty($data['filter_name'])) {
    $this->load->model('module/search_engine');
    $condition = $this->model_module_search_engine->getSearchCondition($data['filter_name']);
    $sql .= " AND " . $condition;
}

$sql .= " AND p.status = '1'";
}

        // Отлкючил БФ - он давал неверные результаты 16.01.2017 11:18:55
        // **************************************************************
/* Brainy Filter Pro (brainyfilter.xml) - Start -> */
if (isset($data['filter_bfilter']) && $data['filter_bfilter']) {
   $this->load->model('module/brainyfilter');
   $this->model_module_brainyfilter->setData($data);
   $sql = $this->model_module_brainyfilter->prepareQueryForTotal();
}
/* Brainy Filter Pro (brainyfilter.xml) - End ->*/

$query = $this->db->query($sql);

return $query->row['total'];
}

public function getTotalProductsByCategory($data = array()) {
  $sql = "SELECT p22c.category_id AS category_id, COUNT(DISTINCT p.product_id) AS total";

  if (!empty($data['filter_category_id'])) {
   if (!empty($data['filter_sub_category'])) {
    $sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
} else {
    $sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
}

if (!empty($data['filter_filter'])) {
    $sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
} else {
    $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
}
} else {
   $sql .= " FROM " . DB_PREFIX . "product p";
}

$languageFilter = empty($data['filter_name']) ? ("pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND") : "";

$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p22c ON (p.product_id = p22c.product_id)";
$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE " . $languageFilter . " p.status = '1' AND p.date_available <= NOW()";

if (!empty($data['filter_category_id'])) {
   if (!empty($data['filter_sub_category'])) {
    $sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
} else {
    $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
}

if (!empty($data['filter_filter'])) {
    $implode = array();

    $filters = explode(',', $data['filter_filter']);

    foreach ($filters as $filter_id) {
     $implode[] = (int)$filter_id;
 }

 $sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
}
}

if (!empty($data['filter_name'])) {
    $this->load->model('module/search_engine');
    $condition = $this->model_module_search_engine->getSearchCondition($data['filter_name']);
    $sql .= " AND " . $condition;
}

$sql .= " group by p22c.category_id";

$query = $this->db->query($sql);

return $query->rows;
}


public function getProfile($product_id, $recurring_id) {
  return $this->db->query("SELECT * FROM `" . DB_PREFIX . "recurring` `p` JOIN `" . DB_PREFIX . "product_recurring` `pp` ON `pp`.`recurring_id` = `p`.`recurring_id` AND `pp`.`product_id` = " . (int)$product_id . " WHERE `pp`.`recurring_id` = " . (int)$recurring_id . " AND `status` = 1 AND `pp`.`customer_group_id` = " . (int)$this->config->get('config_customer_group_id'))->row;
}

public function getProfiles($product_id) {
  return $this->db->query("SELECT `pd`.* FROM `" . DB_PREFIX . "product_recurring` `pp` JOIN `" . DB_PREFIX . "recurring_description` `pd` ON `pd`.`language_id` = " . (int)$this->config->get('config_language_id') . " AND `pd`.`recurring_id` = `pp`.`recurring_id` JOIN `" . DB_PREFIX . "recurring` `p` ON `p`.`recurring_id` = `pd`.`recurring_id` WHERE `product_id` = " . (int)$product_id . " AND `status` = 1 AND `customer_group_id` = " . (int)$this->config->get('config_customer_group_id') . " ORDER BY `sort_order` ASC")->rows;
}

public function getTotalProductSpecials() {
  $query = $this->db->query("SELECT COUNT(DISTINCT ps.product_id) AS total FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");

  if (isset($query->row['total'])) {
   return $query->row['total'];
} else {
   return 0;
}
}

function expandName ($nname, $langid=1, $categoryId) {

    $rept=array (
        'ЧЕРНИЛА' => array('(КРАСКА)', '(ФАРБА)', 22),
        'ЧОРНИЛО' => array('(КРАСКА)', '(ФАРБА)', 22),
        'ТОНЕР'  => array('(ПОРОШОК)', '(ПОРОШОК)', 32),
        'DRUM UNIT' => array('(ФОТОБАРАБАН)', '(ФОТОБАРАБАН)'),
        'BARVA'  => array('(БАРВА)', '(БАРВА)'),
        'PATRON' => array('(ПАТРОН)', '(ПАТРОН)'),
        'CANON'  => array('(КЭНОН)', '(КЕНОН)'),
        'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),
        'EPSON'  => array('(ЭПСОН)', '(ЕПСОН)'),
        'BROTHER'=> array('(БРАЗЕР)', '(БРАЗЕР)'),
        'PANASONIC' => array('(ПАНАСОНИК)', '(ПАНАСОНІК)'),
        'НР'      => array('(ХП)', '(ХП)'),
        'RICOH'  => array('(РИКОХ)', '(РІКОХ)'),

        'Матовая'=> array('(MATT)', '(MATT)'),
        'Матовий'=> array('(MATT)', '(MATT)'),
        'Глянцевая' => array('(GLOSSY)', '(GLOSSY)'),
        'Глянцевий' => array('(GLOSSY)', '(GLOSSY)'),
        'MATTE'     => array('(МАТОВЫЙ)', '(МАТОВИЙ)'),


        'BLACK'  => array('(ЧEРНЫЙ)', '(ЧОРНИЙ)'),
        'CYAN'   => array('(СИНИЙ)', '(СИНІЙ)'),
        'YELLOW' => array('(ЖEЛТЫЙ)', '(ЖОВТИЙ)'),
        'LIGHT MAGENTA'=> array('(РОЗОВЫЙ)', '(РОЗОВИЙ)'),
        'MAGENTA'=> array('(КРАСНЫЙ)', '(ЧЕРВОНИЙ)'),
        'GREY'   => array('(СЕРЫЙ)', '(СІРИЙ)'),

//     'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),
//     'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),
//     'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),
//     'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),
//     'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),
//     'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),
//     'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),
//     'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),
//     'XEROX'  => array('(КСЕРОКС)', '(КСЕРОКС)'),

    );
    foreach ($rept as $key=>$repts) {
       if ((isset($repts[2]) && $repts[2]==$categoryId) || !isset($repts[2]))
          $nname = str_replace($key, $key . ' ' .$repts[$langid-1], $nname);
  }

  return $nname;
}

public function getLandingSEOData($uri) {
    $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "landing_seo_data` lc WHERE lc.uri = '".$uri."'");
            // $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "landing_seo_data` lc WHERE LOCATE(lc.uri,'".$uri."')");

    return $query;
}

public function getFilterSEOData($data) {

    $query = $this->db->query("SELECT param_name, param_value FROM `" . DB_PREFIX . "filter_seo_data` lc "
        . "WHERE "
        . "lc.filter_group_id = '".$data['filter_group_id']."' AND "
        . "lc.filter_id = '".$data['filter_id']."' AND "
        . "lc.language_id = '".$data['language_id']."' AND "
        . "lc.category_id = '".$data['category_id']."'");
                    /*echo "SELECT param_name, param_value FROM `" . DB_PREFIX . "filter_seo_data` lc "
                    . "WHERE "
                    . "lc.filter_group_id = '".$data['filter_group_id']."' AND "
                    . "lc.filter_id = '".$data['filter_id']."' AND "
                    . "lc.language_id = '".$data['language_id']."' AND "
                    . "lc.category_id = '".$data['category_id']."'";            */
                    return $query;
                }

                public function getSEOInterlonkData($uri) {
                  $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "seo_interlink` lc WHERE lc.uri = '".$uri."'");
                  return $query;
              }

  // Количество доступных товаров по фильтру.
  //
              public function getFilteredProductsCount($categoryId, $filterGroupId, $filterValueId) {

                  $sSQL="SELECT count(*) AS total
                  FROM `oc_bf_aggregate_filters` a,
                  `oc_product_to_category` b,
                  `oc_product` c
                  WHERE c.product_id=a.product_id
                  AND c.status=1
                  AND a.product_id=b.product_id
                  AND b.category_id=".$categoryId."
                  AND group_id=".$filterGroupId."
                  AND value=".$filterValueId."
                  AND TYPE='FILTER'";

                  $query = $this->db->query($sSQL);
                  if (isset($query->row['total'])) {
                      return $query->row['total'];
                  } else {
                      return 0;
                  }
              }


    // новый модуль SEO Filter by gdemon
              public function getLandingFilterSeo($filterConditions, $category_id){
                $sql = "SELECT ftf.filterseo_id FROM `" . DB_PREFIX . "filterseo_to_filter` ftf LEFT JOIN `" . DB_PREFIX . "filterseo` f ON(f.filterseo_id=ftf.filterseo_id) ";

        /*$sq = implode(',',$filterConditions);
        $sq = ' ftf.filter_id IN ('.implode(',',$filterConditions).')';*/

        $sql .= " WHERE f.status=1 AND category_id ='".$category_id."'";

        if(count($filterConditions)>1){
            foreach ($filterConditions as $key=>$val) {

               $sql .= " AND EXISTS (select 1 FROM `oc_filterseo_to_filter` ftf".$key."
               WHERE ftf".$key.".filterseo_id=ftf.filterseo_id AND ftf".$key.".filter_id=".$val.") ";

           }
       } else {

        foreach ($filterConditions as $key=>$val) {
         $sql .=' AND ftf.filter_id = '.$val;
         $sql .=' AND (SELECT COUNT(*) AS count FROM `oc_filterseo_to_filter` ftff WHERE ftff.filterseo_id = ftf.filterseo_id)=1 ';
     }
 }

 $sql .= ' GROUP BY ftf.filterseo_id';

 $query = $this->db->query($sql);
 if($query->row){
    $sql = "SELECT * FROM `" . DB_PREFIX . "filterseo_description` WHERE filterseo_id=".$query->row['filterseo_id']." AND language_id=".(int)$this->config->get('config_language_id');
    $query = $this->db->query($sql);
    return $query->row;
} else {
    return array();
}
}


public function searchPrinters($poshyk) {
    $sql = ("SELECT * FROM `oc_product_compability` WHERE `product_id` = $poshyk AND `connection_type` LIKE '/P'");
    $query = $this->db->query($sql);
    return $query->row;
}

public function searchPrinterNames($id_pro) {
    $sql = ("SELECT * FROM `oc_product_description` WHERE `product_id` = $id_pro");
    $query = $this->db->query($sql);
    return $query->row;
}

public function getFilter($filter_id) {
    $sql = "SELECT *, (SELECT name FROM " . DB_PREFIX . "filter_group_description fgd WHERE f.filter_group_id = fgd.filter_group_id AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS `group` FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id) WHERE f.filter_id = '" . (int)$filter_id . "' AND fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        //vdump($sql);
    $query = $this->db->query($sql);

    return $query->row;
}

}
