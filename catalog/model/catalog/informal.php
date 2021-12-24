<?php
class ModelCataloginformal extends Model {


    public function getinformals() {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "informal c LEFT JOIN " . DB_PREFIX . "informal_description cd ON (c.informal_id = cd.informal_id) LEFT JOIN " . DB_PREFIX . "informal_to_store c2s ON (c.informal_id = c2s.informal_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

        return $query->rows;
    }
    
	public function getinformal($informal_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "informal c LEFT JOIN " . DB_PREFIX . "informal_description cd ON (c.informal_id = cd.informal_id) LEFT JOIN " . DB_PREFIX . "informal_to_store c2s ON (c.informal_id = c2s.informal_id) WHERE c.informal_id = '" . (int)$informal_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row;
	}
        
	public function getCategories($parent_id = 0) {
            
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

  		return $query->rows;
	}

    
    public function getCategory($parent_id = 0) {
            
    	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");
    
  		return $query->row;
  	}
  

	public function getinformalFilters($informal_id) {
		$implode = array();

		$query = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "informal_filter WHERE informal_id = '" . (int)$informal_id . "'");

		foreach ($query->rows as $result) {
			$implode[] = (int)$result['filter_id'];
		}

		$filter_group_data = array();

		if ($implode) {
			$filter_group_query = $this->db->query("SELECT DISTINCT f.filter_group_id, fgd.name, fg.sort_order FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_group fg ON (f.filter_group_id = fg.filter_group_id) LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (fg.filter_group_id = fgd.filter_group_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY f.filter_group_id ORDER BY fg.sort_order, LCASE(fgd.name)");

			foreach ($filter_group_query->rows as $filter_group) {
				$filter_data = array();

				$filter_query = $this->db->query("SELECT DISTINCT f.filter_id, fd.name FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND f.filter_group_id = '" . (int)$filter_group['filter_group_id'] . "' AND fd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY f.sort_order, LCASE(fd.name)");

				foreach ($filter_query->rows as $filter) {
					$filter_data[] = array(
						'filter_id' => $filter['filter_id'],
						'name'      => $filter['name']
					);
				}

				if ($filter_data) {
					$filter_group_data[] = array(
						'filter_group_id' => $filter_group['filter_group_id'],
						'name'            => $filter_group['name'],
						'filter'          => $filter_data
					);
				}
			}
		}

		return $filter_group_data;
	}

	public function getinformalLayoutId($informal_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "informal_to_layout WHERE informal_id = '" . (int)$informal_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getTotalCategoriesByinformalId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "informal c LEFT JOIN " . DB_PREFIX . "informal_to_store c2s ON (c.informal_id = c2s.informal_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row['total'];
	}
  
  public function getextendedheadingaddition ($heading_title, $filter_addition) {
      // Согласование падежей?
      // РУССКИЙ язык!
      // **********************************
      // Первое слово...
      $arr=explode (' ', $heading_title);
      $firstWord=mb_strtoupper($arr[0]);
      if ((int)$this->config->get('config_language_id')==1) { 
      // Окончания первого слова
      $twoL=mb_substr($firstWord, -2);
      $oneL =mb_substr($firstWord, -1);
      
      // Первое слово фильтра 
      $arr2=explode(',', $filter_addition); // print_r($arr2);
      $filtres=array();
      
      
      
      
        foreach ($arr2 as $val2) {     
            $firstWordfilter=trim($val2); // echo $firstWord;
            if ($firstWordfilter != 'в наличии') {
                // $firstWordfilterUpper = mb_strtoupper($firstWordfilter);
                $matches = null;
                $matches2 = null;
                if ($returnValue = preg_match('/(.*)(НИЙ|ТОНЕР)/', $firstWord, $matches)) {
                    if ($returnValue2 = preg_match('/(.*)(АЯ|ОЕ)$/', mb_strtoupper($firstWordfilter), $matches2))
                       $firstWordfilter = $matches2[1] . 'ЫЙ';
                } else if ($returnValue = preg_match('/(.*)(ЫЕ|И|Ы|ЧЕРНИЛА|ХОЛСТЫ)/', $firstWord, $matches)) {  
                    if ($returnValue2 = preg_match('/(.*)(КАЯ)$/', mb_strtoupper($firstWordfilter), $matches2))
                       $firstWordfilter = $matches2[1] . 'КИЕ'; 
                    else
                    if ($returnValue2 = preg_match('/(.*)(ЫЙ|АЯ|ОЕ)$/', mb_strtoupper($firstWordfilter), $matches2))
                       $firstWordfilter = $matches2[1] . 'ЫЕ'; 
                } else if ($returnValue = preg_match('/(.*)(АЯ|ТЬ|А)$/', $firstWord, $matches)) {
                    if ($returnValue2 = preg_match('/(.*)(ЫЙ|ЫЕ|ИЕ)$/', mb_strtoupper($firstWordfilter), $matches2))
                       $firstWordfilter = $matches2[1] . 'АЯ';                
                }
                // print_r($matches);
                $filtres[] = $firstWordfilter;
            } else {
                $filtres[] = 'в наявності';
            }
        } 
      
      
      
      /*
      foreach ($arr2 as $val2) {     
        $firstWordfilter=trim($val2);
        // echo $firstWordfilter;
        // Окончания первого фильтра
        $twoLfilter=mb_strtoupper(mb_substr($firstWordfilter, -2));         
        
        // Сложный набор условий
        if ($firstWord=='ЧЕРНИЛА') {
            if (in_array($twoLfilter, array('ЫЙ', 'АЯ', 'ОЕ'))) $twoLfilteradd='ЫЕ';
        } else if ($firstWord=='ТОНЕР') {
            if (in_array($twoLfilter, array('АЯ', 'ОЕ'))) $twoLfilteradd='ЫЙ';
        } else if ($oneL=='А' OR $twoL=='АЯ') { 
            if (in_array($twoLfilter, array('ЫЙ', 'ЫЕ', 'ОЕ', 'ОЙ'))) $twoLfilteradd='АЯ';                    
        } else if (in_array($oneL, array('И', 'Ы')) OR in_array ($twoL, array('ЫЕ', 'ИЕ'))) {
            if (in_array($twoLfilter, array('ЫЙ', 'АЯ', 'ОЕ'))) $twoLfilteradd='ЫЕ';
        }  
        // Заменяем окончание слова новым
        if ($twoLfilteradd && $firstWordfilter !== 'в наличии') {      
           $firstWordfilter = mb_substr($firstWordfilter, 0, mb_strlen($firstWordfilter,'UTF-8')-mb_strlen($twoLfilteradd, 'UTF-8'), 'UTF-8') . $twoLfilteradd; 
        }
        $filtres[] = $firstWordfilter;        
      } 
      
      */

//  if (0) {
//         if ($firstWord=='ЧОРНИЛА') {
//             if (in_array($twoLfilter, array('ИЙ') OR in_array($oneLfilter, array('А', 'Е'))) $twoLfilteradd='І';
//         } else if ($firstWord=='ТОНЕР') {
//             if (in_array($oneLfilter, array('А', 'Е'))) $twoLfilteradd='ИЙ';
//         } else if ($oneL=='А') { 
//             if (in_array($twoLfilter, array('ЫЙ', 'ЫЕ', 'ОЕ'))) $twoLfilteradd='АЯ';                    
//         } else if (in_array($oneL, array('І', 'И')) OR in_array ($twoL, array('ЫЕ', 'ИЕ'))) {
//             if (in_array($twoLfilter, array('ИЙ', 'АЯ', 'ОЕ'))) $twoLfilteradd='ЫЕ';
//         }
//       
//  }
       } else {
           
           // УКРАИНСКИЙ язык!
           // **********************************
           
           // Первое слово фильтра 
           $arr2=explode(',', $filter_addition);
           $filtres=array();
           foreach ($arr2 as $val2) {     
               $firstWordfilter=trim($val2); // echo $firstWord;
               if ($firstWordfilter != 'в наличии') {
               // $firstWordfilterUpper = mb_strtoupper($firstWordfilter);
               $matches = null;
               $matches2 = null;
               if ($returnValue = preg_match('/(.*)(НИЙ|ІР|ТОНЕР)/', $firstWord, $matches)) {
                   if ($returnValue2 = preg_match('/(.*)(А|І|Е|А|?АСОРТІ)$/', mb_strtoupper($firstWordfilter), $matches2))
                      $firstWordfilter = $matches2[1] . 'ИЙ';
               } else if ($returnValue = preg_match('/(.*)(ЕЇ|І|И|ЧОРНИЛА|ПОЛОТНА)/', $firstWord, $matches)) {  
                   if ($returnValue2 = preg_match('/(.*)(ИЙ|А|Е|Ь|?САШЕ)$/', mb_strtoupper($firstWordfilter), $matches2))
                      $firstWordfilter = $matches2[1] . 'І'; 
               } else if ($returnValue = preg_match('/(.*)(НА|ТЬ)$/', $firstWord, $matches)) {
                   if ($returnValue2 = preg_match('/(.*)(НИЙ|НІ|НЕ)$/', mb_strtoupper($firstWordfilter), $matches2))
                      $firstWordfilter = $matches2[1] . 'НА';                
               }
               // print_r($matches);
               $filtres[] = $firstWordfilter;
           } else {
               $filtres[] = 'в наявності';
           }
           } 
//          if окончание категории заканчивается на "НА" ИЛИ "ТЬ", 
//              ТО if окончание названия фильтра заканчивается на "НИЙ" ИЛИ "НІ" ИЛИ "НЕ" ИЛИ ТО менять на "НА" 
//          else if окончание категории заканчивается на "ЕЇ" ИЛИ "І" ИЛИ "И" ИЛИ "ЧОРНИЛА" ИЛИ "ПОЛОТНА", 
//              ТО ЕСЛИ окончание названия фильтра заканчивается на "ИЙ" ИЛИ "А" ИЛИ "Е", ТО менять на "І" 
//          else if окончание категории заканчивается на "НИЙ" ИЛИ "ІР", 
//              ТО ЕСЛИ окончание названия фильтра заканчивается на "НА" ИЛИ "НІ" ИЛИ "НЕ" ИЛИ ТО менять на "НИЙ"


      }
         
      $firstWordfilter = mb_strtolower((implode(', ', $filtres)));
       
      return $firstWordfilter;
  }
  
  public function getCategoriesByFilter($data = array()) { 
                // file_put_contents('/var/www/vm.ua/dirs.log', print_r($data, 1), FILE_APPEND);
		$sql = "SELECT * FROM " . DB_PREFIX . "informal_description cd LEFT JOIN " . DB_PREFIX . "informal c using(informal_id)";
		

		if (!empty($data['filter_name'])) {
                    $sql .= " WHERE cd.language_id = " . (int)$this->config->get('config_language_id') . ' ';
			
                    $implode = array();

                    $words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

                    foreach ($words as $word) {
                            $implode[] = "cd.name LIKE '%" . $this->db->escape($word) . "%'";
                            $implodeseo[] = "cd.meta_h1 LIKE '%" . $this->db->escape($word) . "%'";
                    }

                    if ($implode) {
                            $sql .= " AND " . implode(" AND ", $implode) . "";
                    }

                    if ($implodeseo) {
                            $sql .= " OR (" . implode(" AND ", $implodeseo) . ")";
                    }							

			
		}
                // echo $sql;
                
                $query = $this->db->query($sql);
                $informal_data=array();
		foreach ($query->rows as $result) {
                    $informal_data[] = $result;
		}

		return $informal_data;
	}
  
  
}