<?php
class ModelCatalogCategory extends Model {

    public function getCategoryeru($category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c
      LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id AND cd.language_id = '1')
      -- LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id)
      WHERE c.category_id = '" . (int)$category_id . "'
      -- AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
      AND c.status = '1'");

		return $query->row;
	}

    public function getCategoryer($category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c
      LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id AND cd.language_id = '2')
      -- LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id)
      WHERE c.category_id = '" . (int)$category_id . "'
      -- AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
      AND c.status = '1'");

		return $query->row;
	}

	public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c
      LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "')
      -- LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id)
      WHERE c.category_id = '" . (int)$category_id . "'
      -- AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
      AND c.status = '1'");

		return $query->row;
	}

	public function getCategoryRedirect($path) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_redirect WHERE path = '" . $path . "'");

		return $query->row;
	}

	public function getCategories($parent_id = 0) {
            if ($parent_id==20000) {
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id in (20,30,40) AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");
            } else {
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

            }
    return $query->rows;
  }

    public function getRecommendationCategories($id_category) {
    $category_data = $this->db->query("
        SELECT r.id_category_recommendation1 as cat1, r.id_category_recommendation2 as cat2, r.id_category_recommendation3 as cat3, r.id_category_recommendation4 as cat4
        FROM oc_category_recommendation r
        WHERE r.id_category = '" . (int)$id_category . "' LIMIT 1");
    return $category_data->rows;
    }
  public function getCategoriesChildren($category_id = 0) {
            //DISTINCT
		  $sql = "SELECT * FROM " . DB_PREFIX . "category_children c
          LEFT JOIN " . DB_PREFIX . "category_children_description cd ON (c.category_id = cd.category_id)
          WHERE c.category_id = '" . (int)$category_id . "' AND c.key = cd.key AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY c.key ORDER BY c.sort_order, LCASE(cd.name)";

      $query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCategoryFilters($category_id) {
		$implode = array();

		$query = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "category_filter WHERE category_id = '" . (int)$category_id . "'");

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

	public function getCategoryLayoutId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getTotalCategoriesByCategoryId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row['total'];
	}

  public function getextendedheadingaddition ($heading_title, $filter_addition) {
      // Согласование падежей?
      // РУССКИЙ язык!
      // **********************************
      // Первое слово...
      $arr=explode (' ', $heading_title);
      $firstWord=mb_strtoupper($arr[0]);
      if ((int)$this->config->get('config_language_id')==1) { //русский язык
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
                   if (($returnValue2 = preg_match('/(.*)(А|І|Е|А)$/', mb_strtoupper($firstWordfilter), $matches2)) && !preg_match('/(.*)(АСОРТІ)$/', mb_strtoupper($firstWordfilter), $matches3) )  // |?АСОРТІ
                      $firstWordfilter = $matches2[1] . 'ИЙ';
               } else if ($returnValue = preg_match('/(.*)(ЕЇ|І|И|ЧОРНИЛА|ПОЛОТНА)/', $firstWord, $matches)) {
                   //if (($returnValue2 = preg_match('/(.*)(ИЙ|А|Е|Ь)$/', mb_strtoupper($firstWordfilter), $matches2)) && !preg_match('/(.*)(САШЕ)$/', mb_strtoupper($firstWordfilter), $matches3))

                   if(mb_strtoupper($firstWordfilter)=='ПЛІВКА'){
                      $firstWordfilter = 'ПЛІВКИ';
                   } elseif(mb_strtoupper($firstWordfilter)=='КАНЦЕЛЯРСЬКА КНИГА'){
                      $firstWordfilter = 'КАНЦЕЛЯРСЬКІ КНИГИ';
                   } elseif (($returnValue2 = preg_match('/(.*)(ИЙ|А|Е|Ь)$/', mb_strtoupper($firstWordfilter), $matches2)) && !preg_match('/(.*)(САШЕ)$/', mb_strtoupper($firstWordfilter), $matches3))
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
		$sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "category_description cd LEFT JOIN " . DB_PREFIX . "category c using(category_id)";


		if (!empty($data['filter_name'])) {
        $sql .= " WHERE /*cd.language_id = " . (int)$this->config->get('config_language_id') . '*/ ';

        $implode = array();

        $words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

        foreach ($words as $word) {
            $implode[] = "cd.name LIKE '%" . $this->db->escape($word) . "%'";
            $implodeseo[] = "cd.meta_h1 LIKE '%" . $this->db->escape($word) . "%'";
        }

        if ($implode) {
            //$sql .= " AND " . implode(" AND ", $implode) . "";
            $sql .= "  " . implode(" AND ", $implode) . "";
        }

        if ($implodeseo) {
            $sql .= " OR (" . implode(" AND ", $implodeseo) . ")";
        }
		}

    if (!empty($data['limit'])) {
        //$sql .= " LIMIT " . (int)$data['limit'] . "";
        $sql .= " LIMIT " . 30 . "";
    }
    // echo $sql;

    $query = $this->db->query($sql);
    $category_data=array();
		foreach ($query->rows as $result) {
                    $category_data[] = $result;
		}

		return $category_data;
	}

  public function getCategoriesSearchFullText($data = array()) {

    if (isset($data['langid'])) $this->config->set('config_language_id', $data['langid']);

    $sql = "SELECT p2c.category_id, cd.name, c.image,COUNT(*) AS count";

    $sql .= " FROM oc_product_to_category p2c
                  INNER JOIN oc_category_description cd ON (p2c.category_id = cd.category_id AND cd.language_id='" . (int)$this->config->get('config_language_id') . "')
                  INNER JOIN oc_category c ON (c.category_id = cd.category_id)";

    if (!empty($data['filter_name'])) {
        $this->load->model('module/search_engine');
        $condition = $this->model_module_search_engine->getSearchCondition($data['filter_name']);

        $sql .=
          " INNER JOIN (
            SELECT p.product_id
            FROM oc_product_description pd
            INNER JOIN oc_product p ON (p.product_id = pd.product_id)
            WHERE
              ". $condition ."
              AND p.status = '1'
              AND p.price > 0
              AND p.date_available <= NOW()
              GROUP BY p.product_id
          ) as cnt ON (cnt.product_id = p2c.product_id)";
    }

    $sql .= " GROUP BY p2c.category_id ORDER BY count DESC";

    if (isset($data['start']) || isset($data['limit'])) {
      if (!isset($data['start']) || isset($data['start']) &&$data['start'] < 0) {
        $data['start'] = 0;
      }

      if (!isset($data['limit']) || isset($data['limit'])&& $data['limit']< 1) {
        $data['limit'] = 20;
      }

      $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
    } else {
            $sql .= " LIMIT 4";
    }

    $query = $this->db->query($sql);


    return $query->rows;
  }

  public function getCategoryQuestions($category_id) {
        $question_data = array();

        if(method_exists($this->db,'set_charset_utf8mb4')){
            $this->db->set_charset_utf8mb4();
        } else {
            $this->db->query("SET CHARACTER SET utf8mb4");
        }

        $sql = "SELECT * FROM " . DB_PREFIX . "category_question_description qd
          LEFT JOIN " . DB_PREFIX . "category_question fq ON(qd.category_id = fq.category_id AND qd.question_id = fq.question_id) WHERE qd.category_id = '" . (int)$category_id . "' AND qd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY fq.question_id";

        $query = $this->db->query($sql);

        foreach ($query->rows as $row) {

                $questions[] = array(
                    'question_id' => $row['question_id'],
                    'config' => $row['config'],
                    'update_config' => $row['update_config'],
                    'name' => $row['name'],
                    'text' => $row['text']
                );

                $question_data = array(
                    'category_id' => $row['category_id'],
                    'questions'=> $questions
                );
        }

        return $question_data;
    }

    public function getFilterseoQuestions($filterseo_id) {
        $question_data = array();

        if(method_exists($this->db,'set_charset_utf8mb4')){
            $this->db->set_charset_utf8mb4();
        } else {
            $this->db->query("SET CHARACTER SET utf8mb4");
        }
        $sql = "SELECT * FROM " . DB_PREFIX . "filterseo_question_description qd
          LEFT JOIN " . DB_PREFIX . "filterseo_question fq ON(qd.filterseo_id = fq.filterseo_id AND qd.question_id = fq.question_id) WHERE qd.filterseo_id = '" . (int)$filterseo_id . "' AND qd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY fq.question_id";
        $query = $this->db->query($sql);

        foreach ($query->rows as $row) {

                $questions[] = array(
                    'question_id' => $row['question_id'],
                    'config' => $row['config'],
                    'update_config' => $row['update_config'],
                    'name' => $row['name'],
                    'text' => $row['text']
                );

                $question_data = array(
                    'category_id' => $row['filterseo_id'],
                    'questions'=> $questions
                );
        }

        return $question_data;
    }

}
