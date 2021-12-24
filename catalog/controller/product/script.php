<?php
class ControllerProductScript extends Controller {

    /**
     *
     */
    public function test1() {
    	$good_words = 'q2612';
    	$query = "SELECT name, IF(name like '%". $good_words. "%', ".
           (substr_count($good_words, " ") + 1). "*10, 0) + IF(name LIKE '%".
           str_replace(" ", "%', 9, 0) + 
           	IF(name LIKE '%", $good_words). "%', 9,
           0) AS relevance FROM oc_product_description  WHERE name LIKE '%". str_replace(" ", "%'
           OR name LIKE '%", $good_words). "%' ORDER BY relevance DESC";
           $res = $this->db->query($query);
           vdump($query);
           vdump($res);

	exit;
    	echo date('Y-m-d',strtotime('+3 day'));
    	

    	//print preg_replace( '/^(\d{3})(\d{3})(\d{2})(\d+)$/iu', '+38($1) $2-$3-$2', '0683266559' );

    	$instr="+38(068) 32-66-559";
		$instr = preg_replace("/[ ()-]/", "", $instr);
		vdump($instr);
		print preg_replace( '/^(\d{3})(\d{3})(\d{2})(\d+)$/iu', '+38($1) $2-$3-$2', $instr );
		//echo $instr;

    }
    public function test() {

    	 $this->load->model('extension/extension');


			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			vdump($results);

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}
			vdump($sort_order);

			array_multisort($sort_order, SORT_ASC, $results);
			vdump($results);
			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}
    }
    public function blackfridey2() {
    	 $data['blackfridey'] = $this->load->controller('module/blackfridey');
    	 echo $data['blackfridey'];
    }
    public function blackfridey() {


    	$this->load->model('extension/news');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		$this->language->load('information/news');


		$news_id = 41;

 		$forse = 1;
		$news = $this->model_extension_news->getNews($news_id,$forse);


		if ($news) {
			$related_prod_id = $this->model_extension_news->getNewsRelatedProducts($news_id);

            foreach ($related_prod_id as $key => $prod_id) {

            	$result = $this->model_catalog_product->getProduct($prod_id['product_id']);
            	if(empty($result))continue;

                if ($this->model_tool_image->isImageExists($result['image'])) {
	                $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
	            } else {
	                $image = $this->model_tool_image->resize('no-photo-img.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
	            }

	            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
	                    //$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
	                    $price = (int)$this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')).' ₴';
	            } else {
	                    $price = false;
	            }

	            if ((float)$result['special']) {
	                    //$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
	                    $special = (int)$this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax'));
	            } else {
	                    $special = false;
	            }
	            //vdump($result['special']);
	            //$special = 16999 .' ₴';

	            if ($this->config->get('config_tax')) {
	                    $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
	            } else {
	                    $tax = false;
	            }

	            if ($this->config->get('config_review_status')) {
	                    $rating = (int)$result['rating'];
	            } else {
	                    $rating = false;
	            }

	            // Акции!
	            $action=array();
	            if ($result['news']) {
	                $newslist=  explode(',', $result['news']);
	                foreach ($newslist as $n) {
	                    $atcion_news = $this->model_extension_news->getNews($n);
	                    if($atcion_news){
	                        if (is_numeric($n)) $action[]=$atcion_news;
	                    }

	                }
	            }
	            	//MOU-LOG-M100-USB-GR
	            //$category_info = $this->model_catalog_category->getCategory($result['category']);

	            //$data['products'][$result['category']][] = array(
	            $data['products'][] = array(
	                'product_id'  => $result['product_id'],
	                'thumb'       => $image,
	                'mpn'       => $result['mpn'],
	                //'category_name'        => $category_info['name'],
	                'name'        => htmlspecialchars($result['name']),
	                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
	                'price'       => $price,
	                'special'     => $special,
	                'tax'         => $tax,
	                'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
	                'rating'      => $result['rating'],
	                'ifexist'     => $result['ifexist'],
	                'quantity'    => $result['quantity'],
	                'tag'         => htmlspecialchars($result['tag']),
	                'jan'         => $result['jan'],
	                'href'        => $this->url->link('product/product', '&product_id=' . $result['product_id']),
	                'action'      => $action

	            );

            }
        }
				//vdump($data['products']);
    	$this->response->setOutput($this->load->view('default/template/product/blackfridey.tpl', $data));

    }
    public function index() {
    	ini_set("display_errors",1);
		error_reporting(E_ALL);

        //https://prote.ua/index.php?route=product/script&get=make_filters
        //https://prote.ua/index.php?route=product/script&get=replace_seo_text
    	//$html = '<a href=>'

    	//exit;

    	$get = $this->request->get['get'];
    	echo "<pre>";
    	print_r($get);
    	echo "</pre>";


        if($get=='clear_url') { // чистим ЧПУ
        	$products = array();
        	exit;


        	$sql = "SELECT * FROM oc_url_alias WHERE query LIKE '%product_id=%' ORDER BY query ";
			$query = $this->db->query($sql);
			//vdump($query->rows);
			foreach ($query->rows as $key => $value) {
				//vdump($value['query']);

				$products[$value['query']][$value['url_alias_id']] = $value;

				/*if(strpos($value['query'],'product_id=') !==false){

					$pr_id = str_replace('product_id=','',$value['query']);
					$products[$pr_id]= $value;

				} elseif(strpos($value['query'],'prn=') !==false){
					$pr_id = str_replace('prn=','',$value['query']);
					$products[$pr_id]= $value;
					//echo $value['query'].'==='.$pr_id.'<br>';
				}*/
			}
			$count=0;
			//vdump($query->row);
			foreach ($products as $key => $value) {
				if($count==1000)exit;
				$min_key = 9999999999;

				foreach ($value as $url_alias_id => $value2) {
					if($min_key >$url_alias_id){
						$min_key = $url_alias_id;
						//vdump('min = '.$min_key);
					}
				}
				foreach ($value as $url_alias_id => $value2) {
					//vdump($min_key . ' = '.$url_alias_id);
					if($min_key !=$url_alias_id){
						//vdump('delete = '.$url_alias_id);
						$sql = "DELETE FROM oc_url_alias WHERE url_alias_id='".$url_alias_id."'";
						echo $sql;
						//$query = $this->db->query($sql);
					}
				}
				$count++;


			}


			$count = 0;
			echo count($products);

			exit;
			foreach ($products as $key => $product) {
				$sql = "SELECT product_id FROM oc_product WHERE `product_id`=".$key."";

				$query = $this->db->query($sql);

				if($query->rows && count($query->rows)>1){
					vdump($query);

				}
				/*if(!$query->row){
					$count++;
					//echo $query->row['product_id'].'</br>';
					$sql = "DELETE FROM oc_url_alias WHERE query='prn=".$key."'";
					//$query = $this->db->query($sql);
					$sql = "DELETE FROM oc_url_alias WHERE query='product_id=".$key."'";
					//$query = $this->db->query($sql);
				}*/

			}
			/*echo "<pre>";
			print_r($count);
			echo "</pre>";*/


			//vdump(count($products));
        } elseif($get=='clear_alt') { // чистим seotext от атрибута alt
            return;
            $sql = "SELECT product_id, seo_text FROM oc_product_description";

            $query = $this->db->query($sql);
            /*echo "<pre>";
            print_r($query );
            echo "</pre>";*/
            foreach($query->rows as $row){
                $row['seo_text'] = html_entity_decode($row['seo_text'], ENT_QUOTES, 'UTF-8');
                $seo_text = preg_replace('~ alt="[^"]*"~i', '', $row['seo_text']);
                //echo  $seo_text;
                $sql2 = "UPDATE oc_product_description SET seo_text='" .$this->db->escape($seo_text)."' WHERE product_id=".$row['product_id'];
                $query = $this->db->query($sql2);
            }
            //vdump($query );

            //echo preg_replace('~style="[^"]*"~i', '', $str);

        } else
    	//return;
        if($get=='url_prn') { // удаляем дубли устройств
            return;
            $c=0;
            //$sql = "SELECT * FROM oc_url_alias WHERE query LIKE 'prn=%'";

            $sql = "SELECT oc_url_alias.*
				FROM oc_url_alias
				INNER JOIN (SELECT `keyword`,COUNT(*) FROM oc_url_alias GROUP BY `keyword` HAVING COUNT(*)>1) as t2 ON oc_url_alias.`keyword` = t2.`keyword`
				WHERE query LIKE 'prn=%'
				ORDER BY `oc_url_alias`.`keyword` ASC";

            $query = $this->db->query($sql);
            foreach ($query->rows as $row) {
                $sql = "SELECT * FROM oc_product WHERE product_id = '".str_replace('prn=','',$row['query'])."'";
                $query2 = $this->db->query($sql);
                if(empty($query2->row)){
                    $c++;
                    $sql = "DELETE FROM oc_url_alias WHERE url_alias_id = '".$row['url_alias_id']."'";
                    //vdump($sql );
                    $this->db->query($sql);
                }
            }
            vdump($query->rows);
            vdump($c);

        } elseif($get=='url_str_to_lower') {
            $count =0;
            $sql = "SELECT * FROM oc_url_alias";
            $query = $this->db->query($sql);
            foreach ($query->rows as $row ){
                $keyword_lower = mb_strtolower($row['keyword']);
                if($keyword_lower ==$row['keyword'])continue;
                echo $row['keyword'].' = '.$keyword_lower .'<br>';
                $count +=1;
            }

            echo $count;


            //vdump($result );

        }elseif($get=='replace_seo_text') {

            return;

            //$sql = "SELECT seo_text FROM oc_product_description WHERE seo_text LIKE '%title=\"Снеки\"%'";
            //$sql = "SELECT seo_text FROM oc_product_description WHERE seo_text LIKE '%<a href=\"/ua/prodtovary/sneki-sladosti-frukty/\" alt=\"Снеки\" title=\"Снеки\">Снеки</a>%'";
            //$sql = "SELECT seo_text FROM oc_product_description WHERE seo_text LIKE '%<a href=\"/ua/paper-materials/office-paper/f84-a5/%'";

            //<a href="/paper-materials/office-paper/f84-a5/" alt="Офисная бумага А5" title="Офисная бумага А5">Офисная бумага А5</a>

            //$sql = "UPDATE `oc_product_description` SET `seo_text`= REPLACE(`seo_text`, '<a href=\"/prodtovary/sneki-sladosti-frukty/\" alt=\"Снеки\" title=\"Снеки\">Снеки</a>', '<a href=\"/paper-materials/office-paper/f84-a5/\" alt=\"Офисная бумага А5\" title=\"Офисная бумага А5\">Офисная бумага А5</a>')";
            /*            $sql = "UPDATE `oc_product_description` SET `seo_text`= REPLACE(`seo_text`,
            '<a href=\"/prodtovary/eda-bystrogo-prigotovleniya/\" alt=\"Еда быстрого приготовления\" title=\"Еда быстрого приготовления\">Еда быстрого приготовления</a>',
            '<a href=\"hoztovary/bumajnye-polotenca/\">Бумажные полотенца</a>')";
                        $query = $this->db->query($sql);

                        $sql = "UPDATE `oc_product_description` SET `seo_text`= REPLACE(`seo_text`,
            '<a href=\"/ua/prodtovary/eda-bystrogo-prigotovleniya/\" alt=\"Їжа жвидкого  приготування\" title=\"Їжа жвидкого  приготування\">Їжа жвидкого  приготування</a>',
            '<a href=\"ua/hoztovary/bumajnye-polotenca/\">Паперові рушники</a>')";
            */

                        $sql = "UPDATE `oc_product_description` SET `seo_text`= REPLACE(`seo_text`,
            '<a href=\"hoztovary/bumajnye-polotenca/\">Бумажные полотенца</a>',
            '<a href=\"hoztovary/bumajnye-polotenca/\" alt=\"Бумажные полотенца\" title=\"Бумажные полотенца\">Бумажные полотенца</a>')";
                        $query = $this->db->query($sql);

                        $sql = "UPDATE `oc_product_description` SET `seo_text`= REPLACE(`seo_text`,
            '<a href=\"ua/hoztovary/bumajnye-polotenca/\">Паперові рушники</a>',
            '<a href=\"ua/hoztovary/bumajnye-polotenca/\" alt=\"Паперові рушники\" title=\"Паперові рушники\">Паперові рушники</a>')";




            $query = $this->db->query($sql);
            echo "<pre>";
            print_r($query);
            echo "</pre>";
            //vdump($query);

        }else
    	if($get=='delete_null_descriptions_products') {
    		echo '=';
    		$sql = "SELECT product_id FROM oc_product_description";
			$query = $this->db->query($sql);
			echo $query->num_rows;

			$products = array();
			$con=0;
			foreach ($query->rows as $key => $row) {
				/*if($row['status']==0){
					$con++;
					$this->model_catalog_script->deleteProduct($row['product_id']);
				}
				echo "</pre>";
				$products[$row['model']][] =$row;*/
			}
			/*$key_tmp='';
			foreach ($products as $key => $model) {
				if($model[0]['price']==0 && $model[1]['price']==0){
					//echo 'error proce =0';
				} elseif($model[0]['price']>0 && $model[1]['price']>0){
					echo 'key='.$key.' -- error price >0<br>';
				}

			}

			echo "status =0  = ".$con;
			echo "<br>всего товаров = ".$query->num_rows;*/

    	}
    	//return;

    	// удаляем дубли
    	if ($get=='delete_dubble_products') {

			$this->load->model('catalog/script');

			// удаляем если status =0 AND quantity =0
			// рабочее удалил 20 000 товаров
			$sql = "SELECT product_id FROM oc_product WHERE status =0 AND quantity =0";
			$query = $this->db->query($sql);

			foreach ($query->rows as $key => $row) {
				//$this->model_catalog_script->deleteProduct($row['product_id']);
			}
			echo "<br>всего товаров = ".$query->num_rows;

			/*

			$sql = "SELECT oc_product.*
				FROM oc_product
				INNER JOIN (SELECT `model`,COUNT(*) FROM oc_product GROUP BY `model` HAVING COUNT(*)>1) as t2 ON oc_product.`model` = t2.`model` WHERE oc_product.`model`!=''
				ORDER BY `oc_product`.`model` ASC";
			$query = $this->db->query($sql);

			$products = array();
			$con=0;
			foreach ($query->rows as $key => $row) {
				if($row['status']==0){
					$con++;
					$this->model_catalog_script->deleteProduct($row['product_id']);
				}
				echo "</pre>";
				$products[$row['model']][] =$row;
			}
			$key_tmp='';
			foreach ($products as $key => $model) {
				if($model[0]['price']==0 && $model[1]['price']==0){
					//echo 'error proce =0';
				} elseif($model[0]['price']>0 && $model[1]['price']>0){
					echo 'key='.$key.' -- error price >0<br>';
				}

			}

			echo "status =0  = ".$con;
			echo "<br>всего товаров = ".$query->num_rows;
			*/
    	}


    	/*
    	$sql = "SELECT oc_url_alias.*
			FROM oc_url_alias
			INNER JOIN (SELECT `keyword`,COUNT(*) FROM oc_url_alias GROUP BY `keyword` HAVING COUNT(*)>1) as t2 ON oc_url_alias.`keyword` = t2.`keyword` WHERE query LIKE 'product_id=%'
			ORDER BY `oc_url_alias`.`keyword` ASC";


		$query = $this->db->query($sql);
		echo "всего товаров = ".$query->num_rows;
	    $c=0;
	    foreach ($query->rows as $key => $row) {
	    	echo "<pre>";
	    	print_r($row);
	    	echo "</pre>";
	    	$mas = explode('=', $row['query']);
	    	$sql = "SELECT quantity, date_modified, status FROM  `oc_product` WHERE  `product_id` ='".$mas[1]."'";
	    	$query2 = $this->db->query($sql);
	    	echo "<pre>";
	    	print_r($query2->row);
	    	echo "</pre>";
	    }
    	return false;
    	exit;*/

    	////////////////////////////////////////////////////
    	// удаление ЧПУ дуюблей - чпу фильтров
    	if ($get=='delete_dubble_for_bfilter_seo_url') {


	    	$sql = "SELECT oc_url_alias.*
				FROM oc_url_alias
				INNER JOIN (SELECT `keyword`,COUNT(*) FROM oc_url_alias GROUP BY `keyword` HAVING COUNT(*)>1) as t2 ON oc_url_alias.`keyword` = t2.`keyword` WHERE query LIKE 'bfilter=%'
				ORDER BY `oc_url_alias`.`keyword`, `oc_url_alias`.`query` ASC";
				//ORDER BY `oc_url_alias`.`keyword` ASC";


		    $query = $this->db->query($sql);

		    $c=0;
		    $c2=0;
		    vdump($query->num_rows);

		    foreach ($query->rows as $key => $row) {

		    	$mas = explode('=f', $row['query']);
		    	$mas = explode(':', $mas[1]);
		    	if($mas[0]<200000){
		    		$mas[1] = str_replace(';', '', $mas[1]);
		    		//$sql = "SELECT * FROM  `oc_attribute` WHERE  `attribute_id` ='".$mas[1]."'";
		    		$sql = "SELECT COUNT(*) as count FROM  `oc_filter` f INNER JOIN oc_product_filter pf ON(pf.filter_id=f.filter_id)
		    		WHERE  f.filter_id ='".$mas[1]."'
		    		 ";
		    		$query = $this->db->query($sql);
		    		$row['count'] = $query->row['count'];

		    		//vdump($query->rows);

		    		if($query->row['count']==0){
						$c++;
						//vdump($row);
						$sql = "SELECT * FROM  `oc_filter_description`
		    			WHERE  filter_id ='".$mas[1]."' ";

		    			$query2 = $this->db->query($sql);
		    			//vdump($query2);

						$sql = "DELETE FROM  `oc_url_alias` WHERE  `url_alias_id` ='".$row['url_alias_id']."'";
						$query = $this->db->query($sql);
						//echo $sql.'<br>';
		    		} else {
		    			// UPDATE oc_product_filter SET filter_id = 11652 WHERE filter_id = 5503
		    			vdump($row);
		    			if($query->row['count']<5){
		    			$sql = "SELECT p.product_id, p.model,pf.filter_id as count FROM  `oc_filter` f INNER JOIN oc_product_filter pf ON(pf.filter_id=f.filter_id)
		    			LEFT JOIN oc_product p ON(p.product_id=pf.product_id)
		    			WHERE  f.filter_id ='".$mas[1]."' ";
		    			vdump($sql);
		    			$query = $this->db->query($sql);

		    			vdump($query);
		    		}
		    			//exit;
		    			$c2++;
		    		}

			    }


		    }
		    echo 'оставили url = '.$c2;
		    echo 'удалили url = '.$c;
	    }
	    if ($get=='delete_dubble_for_bfilter_seo_url2') {
	    	$sql = "SELECT oc_filter_description.*
				FROM oc_filter_description
				INNER JOIN (SELECT `name`,COUNT(*) FROM oc_filter_description WHERE language_id = 1 GROUP BY `name` HAVING COUNT(*)>1 ) as t2 ON oc_filter_description.`name` = t2.`name` WHERE language_id = 1
				-- WHERE query LIKE 'bfilter=%'
				ORDER BY `oc_filter_description`.`name` ASC";

		    vdump($sql);
		    $query = $this->db->query($sql);
		    //vdump($query);
		    $c=0;
		    $c2=0;
		    foreach ($query->rows as $key => $row) {
		    	//vdump($row);
		    	$sql = "SELECT COUNT(*) as count FROM oc_product_filter WHERE filter_id='".$row['filter_id']."'";
		    	$query2 = $this->db->query($sql);
		    	//vdump($query2);
		    	if($query2->row['count']==0){
		    		//удаляем
		    		$sql = "DELETE FROM oc_filter WHERE filter_id='".$row['filter_id']."'";
		    		$this->db->query($sql);
		    		$sql = "DELETE FROM oc_filter_description WHERE filter_id='".$row['filter_id']."'";
		    		$this->db->query($sql);
		    		$c++;
		    	} else{
		    		$c2++;
		    	}
		    }
		    echo "удаляем из oc_filter=".$c."<br>";
		    echo "оставляем=".$c2."<br><br>";
		    $sql="SELECT * FROM oc_filter_xtab fx LEFT JOIN oc_filter f ON(f.filter_id=fx.origin_fid) WHERE f.filter_id is NULL";
		    $query = $this->db->query($sql);
		    $c=0;
		    foreach ($query->rows as $key => $row) {
		    	$sql = "DELETE FROM oc_filter_xtab WHERE x_id='".$row['x_id']."'";
		    	$c++;
		    	$query = $this->db->query($sql);
		    }
		    echo "удаляем из oc_filter_xtab=".$c."<br>";

	    }
	    /////////////////////////////////////////////////
    	exit;
    	// скрипт для Наташи получить url по коду товара

    	if ($get=='get_urls') {

	    	$codes = '45520,64520,64519,64521,33884,62955,34492,62953,34536,36861,39435,33766,62956,33883,34534,33846,34493,33768,33800,33847,33875,33882,33874,107278,33784,33773,33767,33840,37120,33795,33791,33887,33900,33790,34491,33886,33937,34422,33896,33909,34308,33841,33786,49607,33810,33845,33836,33873,37124,16758,33860,34326,36860,34421,33781,33955,60854,33782,33901,33832,36862,33772,49608,33796,33792,33787,37121,33885,33835,34494,33848,33897,33831,33839,37125,33877,33921,33778,33878,41696,33779,33842,33774,41700,33925,33876,42878,33922,41697,33858,33934,33923,35345,33945,33951,33926,41698,33911,41701,42880,33944,33927,64131,33785,41702,33954,38624,42882,33956,100576,49605,11685,33910,33892,33822,33935,33769,33812,33789,33771,41793,15999,33788,15995,33946,35346,33811,64138,34932,33818,49609,34931,32959,33950,33936,64134,33780,33814,33952,63998,15973,37927,58460,58458,37126,58455,58451,33893,33820,33794,36315,37926,33940,62996,33825,32558,15974,33939,64130,63997,30312,33824,64132,33819,18264,18986,64135,33783,64139,12961,33793,37122,33947,33821,34935,32571,34934,64997,33929,109820,27583,35826,33827,58480,32568,44761,58812,109817,58481,18990,33942,109787,33833,33843,26707,33930,109761,33932,109736,33797,32557,32563,30574,35347,14479,109795,58479,33943,10455,14919,33933,45586,45587,45585,18680,33928,109789,58476,58477,58474,58472,26538,34933,33879,33849,19661,109786,15991,33953,109819,109814,33837,15989,28534,109791,32953,32960,33861,33829,60862,109766,33499,1449,109748,33498,58478,32553,109815,33949,34290,33931,32578,32975,58817,33815,44763,64932,15472,64948,58811,10989,109732,44421,109794,33898,34495,15992,33938,44670,64975,109665,34423,64952,64950,40664,32954,32967,33830,38637,43905,33838,33870,35823,43902,34936,33880,34293,10574,64129,44669,39857,109782,107414,49613,41796,33903,329,34291,43831,19486,33889,64518,28487,43955,43954,109751,32549,32551,33902,43953,102095,64951,64949,64989,44418,30430,109822,33813,28530,43952,43907,43832,44672,64934,1427,64987,64857,314,33941,33828,28527,16876,32559,64137,64939,18987,3014,33881,43851,107415,33798,28532,10733,33871,18984,19753,19755,32957,32973,109593,62952,64140,1423,57717,38186,102092,33920,33895,18089,43375,33844,33834,34292,14506,41791,107416,41695,37119,102087,42193,36024,102093,43908,41699,36598,33851,311,109818,14503,23785,18991,33323,32961,32982,9636,63179,41372,33894,107757,30234,44674,1425,102080,41371,18774,107756,109816,41368,26712,302,42192,18988,33890,23784,34281,1422,37123,34496,33872,34282,32576,102094,35822,33899,1439,327,312,1430,33888,44420,1432,26713,41941,63999,41949,3013,44673,104881,34420,41293,35344,33503,18985,26095,33904,3017,33850,43919,44676,42190,102084,26704,18949,32565,32956,32958,32974,26158,34283,1438,18993,33826,1788,102086,29688,104660,13201,64136,100798,35311,36012,18458,12623,36009,36010,41944,42188,102106,62080,34284,35825,36008,30233,36011,37370,33891,36932,43933,31291,17981,36013,14832,102107,308,14497,57716,10564,41033,49606,102079,18992,33823,102102,33513,17502,32962,18082,44675,18050,104886,25230,10732,101332,18770,18989,44671,100529,11383,104661,18083,43857,59688,313,109579,32970,43920,18776,18771,1424,43934,14505,1421,64133,34285,1426,38017,323,63996,102083,109499,14499,318,105295,1437,41294,100809,100807,100528,14323,109500,41295,109704,322,43962,43958,43917,101333,51932,14502,24714,43957,26867,328,18084,57715,14496,107172,14498,319,324,42106,100578,57713,12620,3012,41943,43960,18047,43152,30232,18085,326,315,108028,107886,107926,108032,108027,107958,107882,10510,107884,107885,107883,37036,41794,61683,44568,44574,44573,44559,44565,51992,44556,51991,37522,48387,44558,41795,41797';

	    	$mas_codes = explode(',', $codes);
	    	$str_urls = '';
	    	foreach ($mas_codes as $key => $cod) {
	    		$q = strlen($cod);
	    		if($q==3){
	    			$cod='000'.$cod;
	    		} elseif($q==4){
	    			$cod='00'.$cod;
	    		} elseif($q==5){
	    			$cod='0'.$cod;
	    		}
	    		$sql = "SELECT product_id FROM oc_product  WHERE model  = '".$cod."' ORDER BY product_id DESC";
	    		$query = $this->db->query($sql);
	    		$url = $this->url->link('product/product', 'product_id=' . $query->row['product_id']);
	    		$str_urls.=','.$url;

	    	}
	    	echo $str_urls;

	    }


    	/// рабочий скрипт для отбора совместимости принтеров и картриджей
		if ($get=='select_compability') {
			$count = 0;
			$sql = "SELECT DISTINCT p.product_id, pd.name FROM oc_product p
			LEFT JOIN oc_product_to_category ptc ON(p.product_id=ptc.product_id)
			LEFT JOIN oc_product_attribute pa ON(p.product_id=pa.product_id)
			LEFT JOIN oc_product_description pd ON(p.product_id=pd.product_id)
			WHERE ptc.category_id IN (82, 88) AND pa.language_id = '1' AND pd.language_id = '1' AND pa.attribute_id = 10 AND pa.`text` = 'Panasonic'  ";
			$query = $this->db->query($sql);
			foreach ($query->rows as $key => $row) {
				$sql2 = "SELECT * FROM  oc_product_compability pc
				LEFT JOIN oc_product p ON(pc.product_id=p.product_id)
				LEFT JOIN oc_product_to_category ptc ON(pc.product_id=ptc.product_id)
				 WHERE child_product_id = '".$row['product_id']."' AND p.status=1 AND ptc.category_id IN (31,42) ";
				$query2 = $this->db->query($sql2);
				if($query2->rows){
					$count++;
					echo "<pre>";
					print_r($row['name']);
					echo "</pre>";
					/*echo "<pre>";
					print_r($query2->rows);
					echo "</pre>";*/
				}


			}
			echo $count;
		}
		/// конец ==== рабочий скрипт для отбора совместимости принтеров и картриджей


    	/*$sql = "SELECT * FROM `oc_filter_seo_data`";

    	$query = $this->db->query($sql);
    	$count = 0;
    	foreach ($query->rows as $key => $row) {

    		$filter_id = $row['filter_id'];
    		$filter_group_id = $row['filter_group_id'];


    		$sql2 = "SELECT * FROM `oc_filter` WHERE filter_id = '".$filter_id."'";
    		$query2 = $this->db->query($sql2);
    		//$count++;
    		if(!$query2->rows){
    			$count++;
    			$row['param_value'] = utf8_substr(strip_tags(html_entity_decode($row['param_value'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..';

    			echo "<pre>";
    			print_r($row);
    			echo "</pre>";
    			$sql3 = "SELECT * FROM `oc_filter` WHERE filter_group_id = '".$filter_id."'";
	    		$query3 = $this->db->query($sql3);
	    		//$count++;
	    		if(!$query3->rows){
	    			//$count++;


	    			echo "<pre>";
	    			print_r('нет группы фильтра = '.$row['filter_group_id']);
	    			echo "</pre>";
	    		}
    		}
    	}
    	echo $count;*/


    	// рабочий скрипт Создание УРЛ фильтров
    	if ($get=='make_filters') {

		    //$sql = "SELECT filter_id, filter_group_id, name FROM `oc_filter_description` WHERE language_id = 1";
		    $sql = "SELECT f.filter_id, f.filter_group_id, fd.name FROM `oc_filter` f LEFT JOIN  `oc_filter_description` fd ON(f.filter_id=fd.filter_id) WHERE fd.language_id = 1 /*AND f.filter_group_id < 100000*/";
		    $query = $this->db->query($sql);
		    // echo $sSQL;
		    //
		    //echo $query->num_rows;
		    $count=0;
		    $count1=0;
		    $count3=0;

		    if($query->rows) {

		        foreach ($query->rows as $key => $row) {
		           $search_query = "bfilter=f".$row['filter_group_id'].":".$row['filter_id'].";";
		           $sql2 = "SELECT url_alias_id FROM `oc_url_alias` WHERE query = '".$search_query."'";
		           //echo $sql2.'<br>';
		           $query2 = $this->db->query($sql2);
		           /*echo "<pre>";
		           print_r($query2->row);
		           echo "</pre>";*/
		           if(empty($query2->row)){
		           	if($row['name']){
			           $utmp= $this->ru2Lat($row['name']);
			           // $utmp= $row['name'];

			           $utmp=str_replace(array(' ', ',','%',',','*','--','_-'),array('_','-','-','-','x','-','-'),$utmp);
			           // $utmp= ru2Lat($utmp);
			           // echo $utmp;
			           $utmp='f' . $row['filter_group_id'] . '-' . trim($utmp,' -_');
			           //echo $search_query.'='.$utmp."<br/>";
			           //echo $utmp.'<br>';
			           $count++;
			           // Добавление в БД
			           $sql3="INSERT INTO `oc_url_alias` SET query = '" . $search_query . "', keyword='".$utmp."'";
			           //echo $sql3."<br/>";

			           $this->db->query($sql3);

			           // print_r($row);
			        } else {
			        	$count3++;
			        }
		           } else {
		           		$count1++;
		           }
		        }

		    }
		    echo "<br/>добавили УРЛ фильтров:".$count;
			echo "<br/>не добавляли т.к. УРЛ фильтров уже есть:".$count1;
			echo "<br/>нет названия фильтра:".$count3;

		}



    	// чистим таблицу url_alias от не существующих  product_id
    	/*$sql = "SELECT * FROM `oc_url_alias` WHERE query LIKE 'product_id=%'";
    	$query = $this->db->query($sql);
    	$count = 0;
    	foreach ($query->rows as $key => $row) {

    		$ar = explode('=', $row['query']);
    		$product_id = $ar[1];




    		$sql2 = "SELECT * FROM `oc_product` WHERE product_id = '".$product_id."'";
    		$query2 = $this->db->query($sql2);
    		//$count++;
    		if(!$query2->rows){
    			$count++;

	    		//$sql3 = "DELETE FROM `oc_url_alias` WHERE query = '".$row['query']."'";
	    		//$this->db->query($sql3);
	    		//echo "<pre> НЕТТ ";
	    		//print_r($sql3);
	    		//echo $row['query'];
	    		//echo "</pre>";
    		}
    	}
    	 echo $count;
    	 */
    	// end чистим таблицу url_alias от не существующих  product_id

    	// чистим таблицу url_alias от не существующих bf фильтров
    	/*$sql = "SELECT * FROM `oc_url_alias` WHERE query LIKE 'bfilter=f%'";
    	$query = $this->db->query($sql);
    	$count = 0;
    	foreach ($query->rows as $key => $row) {
    		$query_bf = str_replace(';', '', $row['query']);
    		$ar = explode('=', $query_bf);
    		$filter = $ar[1];
    		$filter_2 = explode(':', $filter);
    		$filter_group_id = str_replace('f', '', $filter_2[0]);
    		$filter_id = $filter_2[1];

    		$sql2 = "SELECT * FROM `oc_filter` WHERE filter_id = '".$filter_id."'";
    		$query2 = $this->db->query($sql2);
    		$count++;
    		if(!$query2->rows){
    			$count++;

	    		//$sql3 = "DELETE FROM `oc_url_alias` WHERE query = '".$row['query']."'";
	    		//$this->db->query($sql3);
	    		//echo "<pre> НЕТТ ";
	    		//print_r($sql3);
	    		//echo $row['query'];
	    		//echo "</pre>";
    		}
    	}
    	 echo $count;
    	 */
    	// end чистим таблицу url_alias от не существующих bf фильтров

    	/*$sSQL="SELECT CONCAT(  'bfilter=f', a.filter_group_id,  ':', b.filter_id ,';') uri, a.filter_group_id, name, c.url_alias_id
	        FROM  `oc_filter_group` a
	        INNER JOIN  `oc_filter_description` b ON a.filter_group_id = b.filter_group_id
	        LEFT JOIN `oc_url_alias` c on c.query=CONCAT(  'bfilter=f', a.filter_group_id,  ':', b.filter_id, ';' )
	        WHERE b.language_id =1
	        HAVING c.url_alias_id is NULL
	    ";*/

    	/*$sql = "
    	SELECT * FROM  `oc_filter`
			WHERE  `filter_group_id` <100000
			AND  `ext_filter_id` IS NULL

			ORDER BY  `oc_filter`.`ext_filter_id`";

		$query = $this->db->query($sql);

		$count=1;
		foreach ($query->rows as $key => $value) {
			echo $value['filter_id'].'</br>';
				$sql = "DELETE FROM `oc_filter` WHERE filter_id=".$value['filter_id'];
					$this->db->query($sql);
			    	$sql = "DELETE FROM `oc_filter_description` WHERE filter_group_id=".$value['filter_group_id'];

			    	$this->db->query($sql);
			    	$count = $count+1;

		}
		echo $count;*/

		//return $query->row;




		/*$sSQL="SELECT CONCAT(  'bfilter=f', a.filter_group_id,  ':', b.filter_id ,';') uri, a.filter_group_id, name, c.url_alias_id
	        FROM  `oc_filter_group` a
	        INNER JOIN  `oc_filter_description` b ON a.filter_group_id = b.filter_group_id
	        LEFT JOIN `oc_url_alias` c on c.query=CONCAT(  'bfilter=f', a.filter_group_id,  ':', b.filter_id, ';' )
	        WHERE b.language_id =1
	        HAVING c.url_alias_id is NULL
	    ";*/

	    /*$query = $this->db->query($sSQL);

	    echo "<pre>";
	    print_r($query);
	    echo "</pre>";*/

	    // Удаляем лишние дубли url фильтров рабочий вариант
	    ///////////////////////////////
	    /*$sql = "SELECT * FROM `oc_filter_description` WHERE `language_id` = 1 ";
		$query = $this->db->query($sql);
		$count =0;

		foreach ($query->rows as $key => $row) {

		   $utmp= $this->ru2Lat($row['name']);
           $utmp=str_replace(array(' ', ',','%',',','*','--','_-'),array('_','-','-','-','x','-','-'),$utmp);
           $utmp='f' . $row['filter_group_id'] . '-' . trim($utmp,' -_');

           $sql = "SELECT * FROM `oc_url_alias` WHERE keyword = '". $utmp."' ORDER BY url_alias_id DESC";
			$query3 = $this->db->query($sql);

			if($query3->rows && count($query3->rows)>1){
			    foreach ($query3->rows as $key => $value) {
			    	if($key>0){
			    		$count++;
			    		//$sql = "DELETE FROM `oc_url_alias` WHERE url_alias_id='".$value['url_alias_id']."'";
			    		//echo $sql;
			    		//$this->db->query($sql);
			    	}
			    }

			} else {
				//echo "нет фильтра = bfilter=f". $row['filter_group_id'] . ":". $row['filter_id'];
			}


		}
		echo $count;*/

		// КОНЕЦ  Удаляем лишние url фильтров
		return;

		///// 11,07,2018 обновляем урл после задвоения значений фильтров
		//$sql = "SELECT * FROM `oc_filter` с LEFT JOIN `oc_filter_description` ON(filter_id=filter_id) WHERE `language_id` = 1 ";
		$sql = "SELECT * FROM `oc_filter_description` WHERE `language_id` = 1 AND `filter_group_id`<100000 ORDER BY filter_group_id, name";
		$query = $this->db->query($sql);
		$count =0;
		$count_b=0;
		$count_m=0;
		$count_r=0;
		foreach ($query->rows as $key => $row) {


			/*echo "<pre>";
			print_r($row);
			echo "</pre>";*/
			echo $row['name'].'<br>';

		   $utmp= $this->ru2Lat($row['name']);

           $utmp=str_replace(array(' ', ',','%',',','*','--','_-'),array('_','-','-','-','x','-','-'),$utmp);

           $utmp='f' . $row['filter_group_id'] . '-' . trim($utmp,' -_');
           //echo $utmp.'<br>';

          // $sql = "SELECT * FROM `oc_filter_description` WHERE filter_group_id='".$row['filter_group_id']."' AND name = '".$row['name']."' AND `language_id` = 1 AND `filter_group_id`<100000 ORDER BY filter_id DESC";


			//$query3 = $this->db->query($sql);
           $sql = "SELECT * FROM `oc_url_alias` WHERE query = 'bfilter=f". $row['filter_group_id'] . ":". $row['filter_id'].";' ORDER BY url_alias_id DESC";
           //echo $sql.'<br>';
			$query3 = $this->db->query($sql);

			if(!$query3->rows){
				/*echo "<pre>";
				print_r($query3->rows);
				echo "</pre>";*/
				echo "нет фильтра = bfilter=f". $row['filter_group_id'] . ":". $row['filter_id'].'<br>';
				$count++;

				$sql = "SELECT * FROM `oc_url_alias` WHERE keyword = '". $utmp."' ORDER BY url_alias_id DESC";
				$query4 = $this->db->query($sql);
				if($query4->row[0]['url_alias_id']>$query3->row['url_alias_id']){
					echo $query4->row[0]['url_alias_id'].' > '.$query3->row['url_alias_id'];
					$count_b++;
				} elseif($query4->row[0]['url_alias_id']<$query3->row['url_alias_id']){
					echo $query4->row[0]['url_alias_id'].' < '.$query3->row['url_alias_id'];
					$count_m++;
				} elseif($query4->row[0]['url_alias_id']=$query3->row['url_alias_id']){
					echo $query4->row[0]['url_alias_id'].' = '.$query3->row['url_alias_id'];
					$count_r++;
				}
				echo "есть вот это...";
				echo "<pre>";
				print_r($query4->rows);
				echo "</pre>";
				//$sSQL="INSERT INTO `oc_url_alias` VALUES (0, 'product_id=" . $lastid . "','".$seftext."')";



			}
			if($query3->rows && count($query3->rows)>1){
				/*echo $sql;
				echo "<pre>";
						print_r($query3->rows);
						echo "</pre>";
			    foreach ($query3->rows as $key => $value) {

			    	if($key>0){

			    		$count++;
			    		//$sql = "DELETE FROM `oc_filter_description` WHERE filter_id='".$value['filter_id']."'";
			    		//echo $sql.'<br>';
			    		//$this->db->query($sql);
			    	}
			    }*/

			} else {
				//echo "нет фильтра = bfilter=f". $row['filter_group_id'] . ":". $row['filter_id'];
			}


		}
		echo '<br>нет фильтра - '.$count;
		echo '<br>больше - '.$count_b;
		echo '<br>меньше - '.$count_m;
		echo '<br>равно - '.$count_r;
		///// end 11,07,2018 обновляем урл после задвоения значений фильтров

    }

    // импорт данных из сеощилд
    public function import_seoshild() {
    	exit;
    	$static_data = require(DIR_ROOT . 'seoshield-clientt/data/static_meta.cache.php');
    	vdump(count($static_data));

    	//$count=0;
    	$meta_text = array();
    	$meta_title = '';
		$meta_h1 = '';
		$meta_description = '';

		$c_category = 0;
		$c_category_none = 0;
		$count_filterseo = 0;
		$count_filterseo_none = 0;

		$this->load->model('catalog/category');
    	$this->load->model('catalog/product');
    	$this->load->model('localisation/zone');

    	foreach ($static_data as $url => $meta) {
    		$meta_title = '';
			$meta_h1 = '';
			$meta_description = '';
			$meta_description_ = '';

    		if(str_replace(' ','',strip_tags($meta[0]))!=''){
    			$meta_title = $meta[0];
    		}
    		if(str_replace(' ','',strip_tags($meta[2]))!=''){
	    		$meta_h1 = $meta[2];
	    	}
	    	if(str_replace(' ','',strip_tags($meta[3]))!=''){
	    		$meta_description = $meta[3];
	    	}
	    	if(str_replace(' ','',strip_tags($meta[1]))!=''){
	    		$meta_description_ = $meta[1];
	    	}


    		//$count++;
    		$url_tmp = trim(str_replace('//prote.ua/','',$url),'/');

    		$urls = explode('/',$url_tmp);

    		$path = array();
    		$bfarray=array();
    		$category_id = false;
    		$filters_array ='';
    		foreach ($urls as $key => $keyword) {
    			if(!$keyword)continue;

    			$keyword = str_replace('f12-','f84-',$keyword);
    			$keyword = str_replace(array('%A3','%3A','%0A','.html'),'',$keyword);
    			$sql = "SELECT LOWER(`keyword`) as 'keyword', `query` FROM `oc_url_alias` WHERE `keyword` = '".$keyword."' ORDER BY url_alias_id";
    			$query = $this->db->query($sql);

    			if($query->row){

					$url_s = explode('=', trim($query->row['query'],';'), 2);
					if($url_s[0]=='category_id'){
						if(!isset($path['path'])) {
                            $path['path'] = $url_s[1];
                            $category_id = $url_s[1];
                        } else {
                            if (strpos($path['path'], $url_s[1])===FALSE){
                                $path['path'] .= '_' . $url_s[1];
                                $category_id = $url_s[1];
                            }
                        }
					} elseif ($url_s[0] == 'bfilter') {
                        $filters_array[] = $bftmparray[1];
                    } elseif ($url_s[0] == 'city') {
                    	$city_id = $url_s[1];
                    }

    			}
    		}

            $meta_description = str_replace(array(' style=""'),'',$meta_description);
    		//$static_data[$url]['get'] = $path;

    		if(!empty($filters_array)){
				//vdump($filters_array);
				continue;
            	$filterseo_info = $this->model_catalog_product->getLandingFilterSeo($filters_array,$category_id);

            	if($filterseo_info){

            		$count_filterseo++;
            		$filterseo_id = $filterseo_info['filterseo_id'];

            		if($filterseo_id==85){
            			vdump($meta);
            		}

        			if($meta_h1){
						$sql = "UPDATE `oc_filterseo_description` SET `meta_h1` = '".$this->db->escape($meta_h1)."' WHERE `filterseo_id`=".(int)$filterseo_id." AND language_id=1";
						//vdump($sql);
						$query = $this->db->query($sql);
					}
					if($meta_title){
						$sql = "UPDATE `oc_filterseo_description` SET `meta_title` = '".$this->db->escape($meta_title)."' WHERE `filterseo_id`=".(int)$filterseo_id." AND language_id=1";
						//vdump($sql);
						$query = $this->db->query($sql);
					}

					if($meta_description){
						$sql = "UPDATE `oc_filterseo_description` SET `description` = '".$this->db->escape($meta_description)."' WHERE `filterseo_id`=".(int)$filterseo_id." AND language_id=1";
						//vdump($sql);
						$query = $this->db->query($sql);
					}
    				$filterseo_info = $this->model_catalog_product->getLandingFilterSeo($filters_array,$category_id);
            		vdump($filterseo_info);
            	} else {
            		continue;
            		$data['filterseo_description'][1] = array(
		            	'name' => $meta_h1,
		            	'description' => $meta_description,
		            	'meta_title' => $meta_title,
		            	'meta_h1' => $meta_h1,
		            	'meta_description' => '',
		            	'meta_keyword' => ''
		            );
	    			$data['category_id'] = $category_id;
				    $data['filter'] ='';
				    $data['filterseo_filters'] = $filters_array;
				    $data['filter_group_id'] = '';
				    $data['keyword'] = 'https:'.$url;
				    $data['status'] = 1;

            		// добавляем посадочную страницу

            		$sql = "INSERT INTO " . DB_PREFIX . "filterseo SET status = '" . (int)$data['status'] . "',
            			category_id = '" . (int)$data['category_id'] . "',
						 url = '" . $this->db->escape($data['keyword']) . "', date_modified = NOW(), date_added = NOW()";
            		$this->db->query($sql);

					$filterseo_id = $this->db->getLastId();

					foreach ($data['filterseo_description'] as $language_id => $value) {
						$sql = "INSERT INTO " . DB_PREFIX . "filterseo_description SET filterseo_id = '" . (int)$filterseo_id . "',
							language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',
							description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "',
							meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "',
							meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'";
						$this->db->query($sql);
					}

					if (isset($data['filterseo_filters'])) {
			            foreach ($data['filterseo_filters'] as $filter_id) {
			                $this->db->query("INSERT INTO " . DB_PREFIX . "filterseo_to_filter SET filterseo_id = '" . (int)$filterseo_id . "',  filter_id = '" . (int)$filter_id . "'");
			            }
			        }


					$this->cache->delete('filterseo');
            	}

    		} elseif($category_id) {

    			continue;

    			$category_info = $this->model_catalog_category->getCategory($category_id);
    			if($category_info){

    				$c_category++;
    				//vdump($category_info);
    				//if(trim($category_info['meta_h1'])!=trim($meta_h1)){
    					// обновляем название категории - рабочая версия
    					//vdump('('.$category_info['name'].')'.$category_info['meta_h1'].' != '.$meta_h1);

    					if($meta_h1){
    						$sql = "UPDATE `oc_category_description` SET `meta_h1` = '".$this->db->escape($meta_h1)."' WHERE `category_id` = ".(int)$category_id." AND language_id=1";
    						//vdump($sql);
    						$query = $this->db->query($sql);
    					}

    					if($meta_title){
    						$sql = "UPDATE `oc_category_description` SET `meta_title` = '".$this->db->escape($meta_title)."' WHERE `category_id` = ".(int)$category_id." AND language_id=1";
    						//vdump($sql);
    						$query = $this->db->query($sql);
    					}

    					if($meta_description){
    						$sql = "UPDATE `oc_category_description` SET `description` = '".$this->db->escape($meta_description)."' WHERE `category_id` = ".(int)$category_id." AND language_id=1";
    						//vdump($sql);
    						$query = $this->db->query($sql);
    					}
    					$this->load->model('catalog/category');

    					$category_info = $this->model_catalog_category->getCategory($category_id);
    					//vdump($category_info);

    				/*} else {
    					//vdump($category_info['meta_h1'].' == '.$meta_h1);
    				}*/
    			} else {
    				$c_category_gorod++;
    			}

    		} elseif($city_id) {
					//continue;
    			//vdump($meta_description_);
    			$cityDescription=$this->model_localisation_zone->getZoneDescription($city_id);

    			if($meta_h1){
					$sql = "UPDATE `oc_zone_description` SET `meta_h1` = '".$this->db->escape($meta_h1)."' WHERE `zone_id` = ".(int)$city_id." AND language_id=1";
					$query = $this->db->query($sql);
				}

				if($meta_title){
					$sql = "UPDATE `oc_zone_description` SET `meta_title` = '".$this->db->escape($meta_title)."' WHERE `zone_id` = ".(int)$city_id." AND language_id=1";
					//vdump($sql);
					$query = $this->db->query($sql);
				}

				if($meta_description){
					$sql = "UPDATE `oc_zone_description` SET `description` = '".$this->db->escape($meta_description)."' WHERE `zone_id` = ".(int)$city_id." AND language_id=1";
					//vdump($sql);
					$query = $this->db->query($sql);
				}
				if($meta_description_){
					$sql = "UPDATE `oc_zone_description` SET `meta_description` = '".$this->db->escape($meta_description_)."' WHERE `zone_id` = ".(int)$city_id." AND language_id=1";
					//vdump($sql);
					$query = $this->db->query($sql);
				}

    		}
    	}

    	//vdump('всего = ');
    	//vdump(count($static_data));
    	vdump('нашли категорий = '.$c_category);
    	vdump('города = '.$c_category_none);
    	vdump('нашли посадочные страницы = '.$count_filterseo);
    	vdump('нет посадочных страниц = '.$count_filterseo_none);
    	//vdump($meta_text);
    	/*$count=0;
    	foreach ($static_data as $url => $meta) {
    		$count++;
    		vdump($meta);
    		if($count>10)break;
    	}*/

    }

    protected function ru2Lat($string) {
        $string=str_replace(array('+'),array('-плюс'),$string);
        $rus = array('ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я',' ', '.','+','(',')','/','\\',chr(34),chr(39),'?','№','&');
        $lat = array('yo','zh','tc','ch','sh','sh','yu','ya','yo','zh','tc','ch','sh','sh','yu','ya', '-', '', '', '','', '', '', '', '', '','N','');
        $string = str_replace($rus,$lat,$string);
        $string = str_ireplace(
        array('А','Б','В','Г','Д','Е','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ъ','Ы','Ь','Э','а','б','в','г','д','е','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ъ','ы','ь','э'),
        array('a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e','a','b','v','g','d','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','','i','','e'),
        $string);

        $string = str_ireplace('--','-', $string);
        return strtolower ($string);
    }


    public function sendOrder(){
    	//echo DIR_SYSTEM . 'library/axapta/rpc.php';
    	//require_once(DIR_SYSTEM . 'library/axapta/rpc.php');
    	//include_once(modification(DIR_SYSTEM . 'library/axapta/rpc.php'));
    	include_once(modification(DIR_SYSTEM . 'library/axapta/axapta.class.php'));
    	echo '123';
    	$axapta = new Axapta();

    	/*$data  = $rpc->getData();
      	$error = $rpc->getError();*/
      	//exit;

      	/*$rpc = new rpc("Logout",
            array(
               'User'      => 'prote',
               'Password'  => 'web-prote',
               'IPAddress' => '91.207.66.27' //
        ),null,$this->registry);   */



      	$absnum ='';
	    $tmp_name = $cli_name;
	    $tmp_email = '';
	    $tmp_phone = lib_convertPhone('');
	    $discount_id = '';
	    $address = '';
	    $client_type = 'prote.ua'; //regtype

	    $axapta = new Axapta();

	    $ax_cust_account = '';
	    $comment_ax = '';

	    $result = $axapta->shopCustInsert('',$tmp_name,$tmp_email,$tmp_phone,$discount_id,$address,$client_type);

      	$param = array(
	        'CustAccount'=> $ax_cust_account, // код клиента
	        'SalesPool'=> 'prote.ua',
	        'SalesOrigin'=> 'prote.ua',
	        'CustPaymMode'=>  1,
	        'DoNotCallBack'=> '',
	        'DeliveryMethod'=> 4, // VM, 12.04.2021. Initialize with 4 (from 1) by default
	        'DeliveryRegion'=> '',
	        'DeliveryState'=> '',
	        'DeliveryCity'=> '',
	        'DeliveryNumber'=> '',
	        'DeliveryStreet'=> $delivery_address,
	        'DeliveryHouse'=> '',
	        'DeliveryFlat'=> '',
	        'OrderLines'=> $OrderLines, //$OrderLines
	        'Comment'=> $comment_ax.' Заказ в 1 клик!', //$comment,
	    );

	    //$result = $axapta->createSalesOrderShop($param);



    }
}
