<?php
class ModelApiAxapta extends Model {
	//$db = new DB\MySQLi(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
	public $count_product_update = 0;
	public $count_product_add = 0;
//	public $db = '';

	public function connect() {

		$DB_DRIVER	=	DB_AX_DRIVER;
		$DB_HOSTNAME=	DB_AX_HOSTNAME;
		$DB_USERNAME=	DB_AX_USERNAME;
		$DB_PASSWORD=	DB_AX_PASSWORD;
		$DB_DATABASE=	DB_AX_DATABASE;
		$DB_PORT	=	'';
		include_once(DIR_SYSTEM.'library/db/mpdo.php');
		$class = 'DB2\\' . $DB_DRIVER;
		$this->db_ax = new $class($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE,$DB_PORT);

	}


	public function getTasks(){
        $this->db->query("UPDATE " . DB_PREFIX . "axapta_tasks SET status = 3 WHERE status = 1 AND date_start <= (NOW() - INTERVAL 25 MINUTE)");

		$sql = "SELECT * FROM " . DB_PREFIX . "axapta_tasks WHERE status = 1";
		$res = $this->db->query($sql);

		if($res->row)return false;

		$sql = "SELECT * FROM " . DB_PREFIX . "axapta_tasks WHERE status = 0 ORDER BY task_id LIMIT 1";
		$res = $this->db->query($sql);
		return $res->row;
	}

	public function addTask($data){

//		file_put_contents(DIR_LOGS . 'sql.log', "start" . "\n");	
		
		$sql = "INSERT INTO " . DB_PREFIX . "axapta_tasks SET
			task_type = '" . $this->db->escape($data['task']) . "',
			comment = '" . $this->db->escape($data['comment']) . "',
			status = 0";

			// date_start = NOW(),
//		file_put_contents(DIR_LOGS . 'sql.log', $sql . "\n");
		$this->db->query($sql);
		$task_id = $this->db->getLastId();

		return $task_id;
	}
	public function udateTask($task_id, $status){

		$sql = "UPDATE " . DB_PREFIX . "axapta_tasks SET status = '" . (int)$status . "'";
		if($status==1){
			$sql .= ", date_start = NOW()";
		} elseif($status==2 || $status==3){
			$sql .= ", date_end = NOW()";
		}
		$sql .= " WHERE task_id='".(int)$task_id."'";

		$this->db->query($sql);
		$sql = "SELECT * FROM " . DB_PREFIX . "axapta_tasks WHERE task_id = '".(int)$task_id."'";
		$res = $this->db->query($sql);

		return $res->row;
	}
	public function getGroupSite2List() {
		$this->connect();
		$sql = "EXEC dbo.p_getGroupSite2List";
		$query = $this->db_ax->query($sql);
		return $query->rows;

	}

	public function getProductByGroupSite2($category_id_ax) {
		$this->connect();
		//user_id = it4;
		$sql = "EXEC dbo.p_getProductByGroupSite2 @_GroupSite2Id = '".$category_id_ax."'";

		$query = $this->db_ax->query($sql);

		return $query->rows;
	}

	public function getProductByCategory($CategoryId) {
		$this->connect();
		//user_id = it4;
		$sql = "EXEC dbo.p_getProductByCategory @_CategoryId = '".$CategoryId."'";

		$query = $this->db_ax->query($sql);

		return $query->rows;
	}
	public function getPrices($PriceGroup=''){
		$this->connect();
		$sql = "EXEC dbo.p_getPriceList @_PriceGroupId = '".$PriceGroup."'";
		$query = $this->db_ax->query($sql);
		return $query->rows;
	}
	public function getProductDocuments($SiteFlag=-1) {
		$this->connect();
		// добавил параметр @_SiteFlag
		// если передашь  1 - то forPorte
		// если передашь 0, или ничего - то forPatronService
		// если передашь -1 то все
		$sql = "EXEC dbo.p_getProductDocuments @_SiteFlag='".$SiteFlag."'";
		$query = $this->db_ax->query($sql);
		return $query->rows;
	}

	public function getAttributes() {
		$this->connect();

		$sql = "EXEC dbo.p_getInventAttributeValues";

		$query = $this->db_ax->query($sql);
		//vdump($query);
		return $query->rows;
	}

	public function getAttributeValues() {
		$this->connect();

		$sql = "EXEC dbo.p_getInventAttributeValues";

		$query = $this->db_ax->query($sql);
		//vdump($query);
		return $query->rows;
	}
	public function getAttributeValueName() {
		$this->connect();

		$sql = "EXEC dbo.p_getInventAttributeValueName";

		$query = $this->db_ax->query($sql);
		//vdump($query);
		return $query->rows;
	}
	public function getGroupSite2AttributesSetup($groupSite2Id=false) {
		$this->connect();
		if($groupSite2Id){
			$sql = "EXEC dbo.p_getGroupSite2InventAttributesSetup @_GroupSite2Id = '".$groupSite2Id."'";
		} else {
			$sql = "EXEC dbo.p_getGroupSite2InventAttributesSetup";
		}

		$query = $this->db_ax->query($sql);
		//vdump($query);
		return $query->rows;
	}
	public function getAttributeName() {
		$this->connect();

		$sql = "EXEC dbo.p_getInventAttributeName";


		$query = $this->db_ax->query($sql);
		//vdump($query);
		return $query->rows;
	}

	public function getGroupSite2Attributes($groupSite2Id=false, $itemId='') {
		$this->connect();
		if($groupSite2Id){
			$sql = "EXEC dbo.p_getGroupSite2InventAttributes @_GroupSite2Id = '".$groupSite2Id."', @_itemId = '".$itemId."'";

			$query = $this->db_ax->query($sql);

			return $query->rows;
		}
	}

	// получаем номенклатуры с атрибутами в зависимости от категории
	public function getItemId2AttributesByCategoryId($categoryId=false) {
		$this->connect();
		if($groupSite2Id){
			$sql = "EXEC dbo.p_getItemId2AttributesByCategoryId @_CategoryId = '".$categoryId."'";

			$query = $this->db_ax->query($sql);

			return $query->rows;
		}
	}

	//получаем наличие номенклатур
	public function getProductAvailability($GroupSite2Id=false,$ItemId=false) {
		// @_GroupSite2Id  - необязательный
		// @_ItemId - необязательный
		$sql = "EXEC dbo.p_getProductAvailability";
		if($GroupSite2Id){
			$sql.= " @_GroupSite2Id = '".$GroupSite2Id."'";
			if($ItemId){
				$sql.= ",";
			}
		}
		if($ItemId){
			$sql.= " @_ItemId = '".$ItemId."'";
		}
		$this->connect();
		$query = $this->db_ax->query($sql);
		return $query->rows;
	}

	public function getProductAvailabilityWeb($GroupSite2Id=false) {
		$sql = "EXEC dbo.p_getProductAvailabilityWeb";
		if($GroupSite2Id){
			$sql.= " @_GroupSite2Id = '".$GroupSite2Id."'";
		}
		$this->connect();
		$query = $this->db_ax->query($sql);
		return $query->rows;
	}

	//получаем все возможные акции
	public function getSalesPromotionsList() {
		$this->connect();

		$sql = "EXEC dbo.p_getSalesPromotionsList";

		$query = $this->db_ax->query($sql);
		return $query->rows;
	}
	//получаем номенклатуры которые учавствуют в акциях
	public function getProductBySalesPromotion($salesPromotionId=false) {
		if(!$salesPromotionId)return;
		$this->connect();
		$sql = "EXEC dbo.p_getProductBySalesPromotion @_SalesPromotionId='".$salesPromotionId."'";

		$query = $this->db_ax->query($sql);
		return $query->rows;
	}

	public function getProductCompatibility($CompatibleProductGroupId=false) {

		$this->connect();
		//@_CompatibleProductGroupId - код группы, необязательный
		$sql = "EXEC dbo.p_getProductCompatibility";
		if($CompatibleProductGroupId){
			$sql.=" @_CompatibleProductGroupId='".$CompatibleProductGroupId."'";
		}

		$query = $this->db_ax->query($sql);
		return $query->rows;
	}


	public function getPriceListContract() {

		$this->connect();
		// получаем плайс услуг подряда
		$sql = "EXEC dbo.p_getPriceListContract";
		//vdump($sql);

		$query = $this->db_ax->query($sql);
		return $query->rows;
	}


	///////////////////////////////////////////////////////////////////////////

	public function getPriceList() {
		$this->connect();
		//получаем все ценовые группы
		$results =array();
		$sql = "SELECT * FROM dbo.fn_webPriceGroup('dat')";
		$query = $this->db_ax->query($sql);
		//$results[]=$query;
		foreach ($query->rows as $key => $row) {
			//получаем прайс в зависимости от ценовой группы
			$sql2 = "EXEC dbo.p_getPriceList @_PriceGroupId = '".$row['PriceGroup']."'";
			$query2 = $this->db_ax->query($sql2);

			$sql_d = "DELETE FROM " . DB_PREFIX . "product_price_list WHERE PriceGroupId = '" . $this->db->escape($row['PriceGroup']) . "'";
			$this->db->query($sql_d);


			foreach ($query2->rows as $key2 => $price) {
				$sql = "INSERT INTO " . DB_PREFIX . "product_price_list SET 
					model = '" . $this->db->escape($price['ItemId']) . "', 
					PriceGroupId = '" . $this->db->escape($row['PriceGroup']) . "', 
					PriceUsd = '" . $price['PriceUsd'] . "', 
					PriceUah = '" . $price['PriceUah'] . "', 
					PriceUa = '" . $price['PriceUa'] . "', 
					PriceRspUsd = '" . $price['PriceRspUsd'] . "', 
					PriceRspUah = '" . $price['PriceRspUah'] . "', 
					PriceRrpUsd = '" . $price['PriceRrpUsd'] . "', 
					PriceRrpUah = '" . $price['PriceRrpUah'] . "', 
					PriceRrpUa = '" . $price['PriceRrpUa'] . "'";

				$this->db->query($sql);	
			}
			//exit;
		}

		// обновляем доступность просмотра категорий
		return $results;

		return $query->rows;
	}

/////////////////////////////////////////////////////////////////////////////
	function getlanguageId($LanguageId) {
	  $myArray = array('ru' => '1', 'ua' => '2');
	  return $myArray[$LanguageId];
	}
	public function updateCategories($categories) {

		// обновляем таблицу списка групп товаров на сайте 2
		$categories2 = array();
		$this->db->query("UPDATE axapta_GroupSite2List SET `update` = 0");
		foreach ($categories as $category) {
			$sql = "INSERT INTO axapta_GroupSite2List SET
			GroupSite2Id = '".$this->db->escape($category['GroupSite2Id'])."',
			GroupParentSite2Id = '".$this->db->escape($category['GroupParentSite2Id'])."',
			GroupSite2Name = '".$this->db->escape($category['GroupSite2Name'])."', LanguageId = '".(int)$this->getlanguageId($category['LanguageId'])."', status = 1, `update` = 1
			ON DUPLICATE KEY UPDATE
			GroupSite2Id = '".$this->db->escape($category['GroupSite2Id'])."', GroupParentSite2Id = '".$this->db->escape($category['GroupParentSite2Id'])."', GroupSite2Name = '".$this->db->escape($category['GroupSite2Name'])."', LanguageId = '".(int)$this->getlanguageId($category['LanguageId'])."', status = 1, `update` = 1
			";
			$query = $this->db->query($sql);
			// формируем массив по языкам
			//$categories2[$category['GroupSite2Id']][$this->getlanguageId($category['LanguageId'])] = $category;
		}
		$this->db->query("UPDATE axapta_GroupSite2List SET status = 0 WHERE `update` = 0");
	}

	public function getCategories() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c WHERE c.GroupSite2Id <> '' AND c.status = '1'");
		return $query->rows;
	}

    public function getProductImages($product_id=false){
        $sql = "SELECT `product_id`, `image`, `ax_filename` FROM `oc_product_image` WHERE ax_filename<>''";
        if($product_id){
            $sql .= " AND `product_id`='". $product_id ."'";
        }
        $query = $this->db->query($sql);
        return $query->rows;
    }

	public function updateProduct($category_id,$data) {
		//$this->log->write('start model updateProduct');
        /*if($data['ItemId']=='MFD-XER-6515DN'){
            //vdump($data);
            //exit;
        }*/

        $data['asort'] = ($data['Assortment']=='Под заказ')?1:0;
        if ($data['Avail']=='0') {
            if ($data['DlvDays']<=2 && $data['DlvDays']>0) {
                $avail = 1; $approved = 1; $delivery_days =0; $asort = 0;
            } else {$avail = 0; $approved = 1; $delivery_days = $data['DlvDays']; $asort = $data['asort']; }
        } else {$avail = $data['Avail']; $approved = 1; $delivery_days = $data['DlvDays']; $asort = $data['asort']; }

        $status = $data['price']>0 && $approved ? 1 : 0;
        $ifexist=2;
        $delivery_days=$delivery_days % 100;
        $quantity = (string)100*($avail+$data['ExtAvail']);
        if ($quantity==0) {
            if($asort==1) {
                if ($delivery_days>2) { $ifexist=1;
                } elseif ($delivery_days==0) {$ifexist=0; }
            } else {$ifexist=0; }
        }
        if ($data['price']==0) $ifexist=0;

		$query = $this->db->query("SELECT product_id,image FROM " . DB_PREFIX . "product WHERE mpn = '" . $this->db->escape($data['ItemId']) . "'");
		if($query->row){ //обновляем товар
			$this->count_product_update++;
			$product_id = $query->row['product_id'];

			if(strpos($query->row['image'], 'Doc-')!==false || !$query->row['image']){
                $sql = "UPDATE " . DB_PREFIX . "product SET `mpn`='".$data['ItemId']."', `image`='".$data['image']."', `status`='". $status ."', model = '".$data['ItemKod1C']."', sku = '".$data['ItemKod1C']."', price = '".$data['price']."', `quantity`='" . (int)$quantity . "', `delivery_days`='".(int)$data['DlvDays']."', `extavail`='".(int)$data['ExtAvail']."', `extdlvdays`='".(int)$data['ExtDlvDays']."', `asort`='".(int)$asort."', `date_modified`=now(), ifexist='".(int)$ifexist."', `shipping`='1', `status_for_update`='1', `date_modified`=now(), `is_complex`='" . (int)$data['isComplex'] . "' WHERE `product_id`= '" . $product_id . "'";
            } else{
                $sql = "UPDATE " . DB_PREFIX . "product SET `mpn`='".$data['ItemId']."', `image`='', `status`='". $status ."', model = '".$data['ItemKod1C']."', sku = '".$data['ItemKod1C']."', price = '".$data['price']."', `quantity`='" . (int)$quantity . "', `delivery_days`='".(int)$data['DlvDays']."', `extavail`='".(int)$data['ExtAvail']."', `extdlvdays`='".(int)$data['ExtDlvDays']."', `asort`='".(int)$asort."', `date_modified`=now(), ifexist='".(int)$ifexist."', `shipping`='1', `status_for_update`='1', `date_modified`=now(), `is_complex`='" . (int)$data['isComplex'] . "' WHERE `product_id`= '" . $product_id . "'";
            }

            $this->db->query($sql);

			foreach ($data['product_description'] as $language_id => $value) {
				$sql = "UPDATE " . DB_PREFIX . "product_description SET
				name = '" . $this->db->escape(substr($value['ItemName'], 0, 254)) . "',
				ax_description = '" . $this->db->escape($value['ax_description']) . "'
				 WHERE product_id = '" . (int)$product_id . "' AND language_id = '" . (int)$language_id . "'";
				$this->db->query($sql);
			}

			$sql = "UPDATE " . DB_PREFIX . "product_to_category SET category_id = '" . (int)$category_id . "', main_category = 1 WHERE product_id = '" . (int)$product_id . "'";
			$this->db->query($sql);

			foreach ($data['instructions'] as $file) {
				if(!$file['forProte'])continue;

				$sql = "UPDATE axapta_files SET product_id = '".(int)$product_id."', name='".$this->db->escape($file['FileName'])."',";
				//-- alias='".$this->db->escape($alias)."',
				$sql .= " `update` = 1 WHERE ax_filename = '".$this->db->escape($file['FileName'])."'";
				//vdump($sql);
				$this->db->query($sql);
			}
			// обновляем бонусные баллы
			$sql = "INSERT INTO " . DB_PREFIX . "product_reward SET customer_group_id = '1', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "' ON DUPLICATE KEY UPDATE customer_group_id = '1', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "'";
			$this->db->query($sql);
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET customer_group_id = '4', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "' ON DUPLICATE KEY UPDATE customer_group_id = '4', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "'");


			$images = $this->db->query("SELECT * FROM oc_product_image WHERE product_id = '".(int)$product_id."'");

//			if($images->rows){
//			    foreach ($images->rows as $row){
//			        if(isset($data['product_images'][$row['ax_filename']])){
//                        $data['product_images'][$row['ax_filename']]['image'] = $row['image'];
//                    } /*else{
//                        $data['product_images'][$row['ax_filename']]['image'] = 'img/gallery_ax/'.$row['image'];
//                    }*/
//                }
//            }
//			/// обновление изображений
//            $sort = 0;
//			foreach ($data['product_images'] as $key => $file) {
//                if(isset($file['image'])){
//                    $sql = "UPDATE oc_product_image SET sort_order = '".(int)$sort."', `update` = 1 WHERE product_id = '".(int)$product_id."'
//                    AND ax_filename = '".$this->db->escape($file['FileName'])."'";
//                } else {
//                    $sql = "INSERT INTO oc_product_image SET product_id = '".(int)$product_id."', image = '".$this->db->escape('img/gallery_ax/'.$file['FileName'])."',
//                        sort_order = '".(int)$sort."', ax_filename = '".$this->db->escape($file['FileName'])."', `update` = 1";
//                }
//                $sort++;
//
//                $this->db->query($sql);
//            }

			$this->db->query("DELETE FROM oc_product_image WHERE product_id = '".(int)$product_id."'");
			if(isset($data['product_images'])){
                foreach ($data['product_images'] as $key => $file) {

                    $sql = "INSERT INTO oc_product_image SET product_id = '".(int)$product_id."', image = '".$this->db->escape('img/gallery_ax/'.$file['FileName'])."',
                            sort_order = '".(int)$key."', ax_filename = '".$this->db->escape($file['FileName'])."', `update` = 1";
                    $this->db->query($sql);
                }
            }
			/////////////

            $sql = "DELETE FROM `oc_product_special` WHERE `product_id`=".$product_id;
            $this->db->query($sql);

            if($data['special']){
                $sql = "INSERT INTO `oc_product_special` VALUES (NULL, '".$product_id."',1,1,'".$data['special']."','".date('Y-m-d')."','".date('Y-m-d', strtotime("+2 days"))."')";
                $this->db->query($sql);
				$sql = "INSERT INTO `oc_product_special` VALUES (NULL, '".$product_id."',4,1,'".$data['special']."','".date('Y-m-d')."','".date('Y-m-d', strtotime("+2 days"))."')";
                $this->db->query($sql);
            }

			return $product_id;

		} else {// добавляем товар

			$sql = "INSERT INTO `oc_product` (`sku`, `model`, `mpn`, `image`, `status`, `quantity`, `price`, `shipping`, `delivery_days`, `extavail`, `extdlvdays`, `date_added`, `ifexist`, `status_for_update`, `is_complex`)
                    VALUES ('".$data['ItemKod1C']."', '".$data['ItemKod1C']."',
                    '".$data['ItemId']."', '".$data['image']."', '".$status."', '" . $quantity ."',
                    ".$data['price'].", '1', '".$data['DlvDays']."', '".$data['ExtAvail']."', '".$data['ExtDlvDays']."',
                    now(), '".$ifexist."', '1', '".$data['isComplex']."')";

			$this->db->query($sql);

			$product_id = $this->db->getLastId();

			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '0'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "', main_category = 1");

			foreach ($data['product_description'] as $language_id => $value) {
				$sql = "INSERT INTO " . DB_PREFIX . "product_description SET
				name = '" . $this->db->escape(substr($value['ItemName'], 0, 254)) . "',
				ax_description = '" . $this->db->escape($value['ax_description']) . "',
				product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "'";
				$this->db->query($sql);
			}

			foreach ($data['instructions'] as $file) {
				if(!$file['forProte'])continue;

				$file = $file['FileName'];
				$ext  = explode('.', $file); if ( count($ext) > 1 && !empty($ext[count($ext)-1]) ) {$ext = $ext[count($ext)-1]; } else {$ext = 'pdf'; }
				$alias = $this->prepare_alias_file($file, 1) .'.'. $ext;      // echo $alias;

				$sql = "INSERT INTO axapta_files SET product_id = '".(int)$product_id."', name='".$this->db->escape($file['FileName'])."', alias='".$this->db->escape($alias)."', update = 1, ax_filename = '".$this->db->escape($file['FileName'])."'";

				$this->db->query($sql);

			}
			// добавляем бонусные баллы
			$sql = "INSERT INTO " . DB_PREFIX . "product_reward SET customer_group_id = '1', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "'";
			$this->db->query($sql);
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET customer_group_id = '4', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "'");

            /// добавление изображений
            $sort = 0;

            foreach ($data['product_images'] as $key => $file) {
                $sql = "INSERT INTO oc_product_image SET product_id = '".(int)$product_id."', image = '".$this->db->escape('img/gallery_ax/'.$file['FileName'])."',
                        sort_order = '".(int)$sort."', ax_filename = '".$this->db->escape($file['FileName'])."', `update` = 1";
                $sort++;

                $this->db->query($sql);
            }
            /////////////

            $sql = "DELETE FROM `oc_product_special` WHERE `product_id`=".$product_id;
            $this->db->query($sql);

            if($data['special']){
                $sql = "INSERT INTO `oc_product_special` VALUES (NULL, '".$product_id."',1,1,'".$data['special']."','".date('Y-m-d')."','".date('Y-m-d', strtotime("+2 days"))."')";
                $this->db->query($sql);
            }

			// SEO URL
			$keyword=trim($this->ru2Lat(trim(mb_substr($data['product_description'][1]['ItemName'],0,50,'UTF-8'))),'-').'-'.$data['ItemKod1C'];

            $keyword=preg_replace("#[^a-zA-Z0-9]+#", "-", $keyword);
            $keyword=preg_replace("#(-){2,}#", "$1", $keyword);
			$sql="SELECT * FROM `oc_url_alias` WHERE `keyword`='".$keyword ."'";
            $this->db->query($sql);
            if ($query->row) {$keyword .= '-' . substr(md5(date('H:i:s')), 0, 5); }

			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $keyword . "'");



			return $product_id;
		}

	}

//    public function setImageDisable() {
//        $this->db->query("UPDATE " . DB_PREFIX . "oc_product_image SET `update` = '0'");
//    }
//    public function setImageDisable() {
//        $this->db->query("DELETE FROM " . DB_PREFIX . "oc_product_image WHERE `update` = '0'");
//    }

	//
	public function updateAvailableStart() {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET status_for_update = '0' WHERE src <> 'B'");
	}

	public function updateAvailableEnd() {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET status = '0', price = 0 WHERE status_for_update = '0' AND src <> 'B' ");
	}

	public function updateAvailableStatus($datas) {
		foreach ($datas as $data) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET status = '1', status_for_update = '1', AvailStatus = '".$this->db->escape($data['AvailStatus'])."', PreOrderDlv = '".(int)$data['PreOrderDlv']."', ExpectedDate = '".$this->db->escape($data['ExpectedDate'])."' WHERE model = '".$this->db->escape($data['ItemId'])."'");
		}
	}

	public function addUrlPrn(){
        // Добавление СЕО-урлов для совместимости принтеров
        $sql = 'INSERT INTO `oc_url_alias` (
        SELECT 0, CONCAT("prn=", CAST(`product_id` AS CHAR)), CONCAT("rashod-", b.keyword), now() FROM `oc_product_to_category`
        LEFT JOIN `oc_url_alias` a ON a.`query`=CONCAT("prn=", CAST(`product_id` AS CHAR))
        LEFT JOIN `oc_url_alias` b on b.`query`=CONCAT("product_id=", CAST(`product_id` AS CHAR))
        WHERE `category_id` IN (81,82,88,89,96) AND a.`query` IS NULL)';
        $this->db->query($sql);
    }

	public function updateFiltersGroup($filters=array()) {

		foreach ($filters as $filter_group_id_ax => $filter) {
            //vdump($filter);
			$sql = "INSERT INTO `oc_filter_group` SET filter_group_id = CAST(substr('".$filter['AttributeId']."', 3,10) AS SIGNED), sort_order = 0, updated = now(), ext_filter_group_id = '".$this->db->escape($filter['AttributeId'])."'ON DUPLICATE KEY UPDATE updated = now(), ext_filter_group_id= '".$this->db->escape($filter['AttributeId'])."'";
			//vdump($sql);
			$this->db->query($sql);

          	foreach ($filter['attribute_name'] as $language_id => $value) {
          	    $sql = "INSERT INTO oc_filter_group_description (filter_group_id,language_id,name,updated)
					(SELECT filter_group_id, '" . (int)$language_id . "', '" . $this->db->escape($value) . "', now() FROM oc_filter_group WHERE ext_filter_group_id='".$this->db->escape($filter['AttributeId'])."') ON DUPLICATE KEY UPDATE name = '" . $this->db->escape($value) . "', updated =now()";
				$this->db->query($sql);
                //vdump($sql);
			}
		}

	}

	public function updateFiltersValue($filters=array()) {


		foreach ($filters as $ext_filter_group_id => $filter) {
			$sql = "SELECT filter_group_id FROM oc_filter_group WHERE ext_filter_group_id='".$ext_filter_group_id."'";
			$query = $this->db->query($sql);
			if(!$query->row)continue;
			$filter_group_id= $query->row['filter_group_id'];

			foreach ($filter as $ext_filter_id => $value) {

				$sql = "SELECT filter_id FROM oc_filter WHERE ext_filter_id='".$this->db->escape($ext_filter_id)."'";
				$query = $this->db->query($sql);

				if(!$query->row){
					$sql =	"INSERT INTO oc_filter (filter_group_id, sort_order, updated, ext_filter_id) VALUES ('".$this->db->escape($filter_group_id)."', 0, now(), '".$this->db->escape($ext_filter_id)."')";
					$query = $this->db->query($sql);
					$filter_id = $this->db->getLastId();
				} else {
					$filter_id = $query->row['filter_id'];
				}

				foreach ($value['name'] as $language_id => $name) {
					$sql = "INSERT INTO oc_filter_description (filter_id,filter_group_id,language_id,name,updated) VALUES('".$this->db->escape($filter_id)."', '".$this->db->escape($filter_group_id)."', '" . (int)$language_id . "', '" . $this->db->escape($name) . "', now()) ON DUPLICATE KEY UPDATE language_id =  '".(int)$language_id."', name = '" . $this->db->escape($name) . "', updated =now()";

					$this->db->query($sql);
				}

			}

		}
		//return $res;
	}

	public function updateAttributes($attributes=array()) {
//20201130 attribute_group_id=1, добавил для присвоения группы атрибута (maxis)
		foreach ($attributes as $attribute_id_ax => $attribute) {

			$sql = "INSERT INTO `oc_attribute` SET attribute_id = CAST(substr('".$attribute['AttributeId']."', 3,10) AS SIGNED), attribute_group_id=1, sort_order = 0, updated = now(), ext_attribute_id = '".$this->db->escape($attribute['AttributeId'])."'ON DUPLICATE KEY UPDATE updated = now(), ext_attribute_id = '".$this->db->escape($attribute['AttributeId'])."'";
			$query = $this->db->query($sql);

			foreach ($attribute['attribute_name'] as $language_id => $value) {
				$this->db->query("INSERT INTO oc_attribute_description (attribute_id,language_id,name)
					(SELECT attribute_id, '" . (int)$language_id . "', '" . $this->db->escape($value) . "' FROM oc_attribute WHERE ext_attribute_id='".$this->db->escape($attribute['AttributeId'])."') ON DUPLICATE KEY UPDATE name = '" . $this->db->escape($value) . "'");
				$query = $this->db->query($sql);
			}

		}
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

    function prepare_alias_file($alias){
        $valid="/[^a-z0-9\-]/";

        $title  = str_replace(array("&quot;","&lquot;","&rquot;","&laquo;","&raquo;"),"",$alias);

        $tr     = array(
            "А" => "a",  "Б" => "b",   "В" => "v",  "Г" => "g",   "И" => "i",
            "Д" => "d",  "Е" => "e",   "Ж" => "j",  "З" => "z",   "я" => "ya",
            "Й" => "y",  "К" => "k",   "Л" => "l",  "М" => "m",   "Н" => "n",
            "О" => "o",  "П" => "p",   "Р" => "r",  "С" => "s",   "Т" => "t",
            "У" => "u",  "Ф" => "f",   "Х" => "h",  "Ц" => "C",  "Ч" => "ch",
            "Ш" => "sh", "Щ" => "sch", "Ъ" => "",   "Ы" => "y",  "Ь" => "",
            "Э" => "e",  "Ю" => "yu",  "Я" => "ya", "а" => "a",   "б" => "b",
            "в" => "v",  "г" => "g",   "д" => "d",  "е" => "e",   "ж" => "j",
            "з" => "z",  "и" => "i",   "й" => "y",  "к" => "k",   "л" => "l",
            "м" => "m",  "н" => "n",   "о" => "o",  "п" => "p",   "р" => "r",
            "с" => "s",  "т" => "t",   "у" => "u",  "ф" => "f",   "х" => "h",
            "ц" => "c",  "ч" => "ch",  "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "y", "ь" => "",    "э" => "e",  "ю" => "yu",  " " => "-",
            "Ё" => "jo", "ё" => "jo",  "і" => "i",  "І" => "i",   "." => "",
            "/" => "-",  "Є" => "e",   "є" => "e"
        );
        $title  = strtr($title,$tr);
        $title  = strtolower($title);
        $title  = preg_replace("/\(.*\)/","",$title);
        $title  = preg_replace($valid,"",$title);

        $title  = preg_replace("/\-{2,100}/","-",$title);

        $title  = trim($title,'-');

        return $title;
    }

	///////////////////////////////

	public function ProductSetBeforeApdate() {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `update` = '0'");
	}

	public function ProductDisabled() {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET status = '0' WHERE `update`='0'");
	}


	public function updateFiles($filess=array()) {
		$json = array();
		foreach ($filess as $model => $files) {

			$sql = "SELECT product_id FROM " . DB_PREFIX . "product WHERE model = '" . $this->db->escape($model) . "'";
			//$json['sql1'][] = $sql;
			///return $product_images;
			$query = $this->db->query($sql);

			if($query->row){
				$product_id = $query->row['product_id'];
				if(isset($files['Фото'])){
					foreach ($files['Фото'] as $image) {
						$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($image) . "' WHERE product_id = '" . (int)$product_id . "'");
					}

				}
				if(isset($files['Фото доп'])){
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
					foreach ($files['Фото доп'] as $k => $image) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape($image) . "', sort_order = '" . (int)$k . "'");
					}
				}


				if(isset($files['ОписаниеUA'])){
					foreach ($files['ОписаниеUA'] as $file) {
						$sql = "UPDATE " . DB_PREFIX . "product_description SET file_description = '" . $this->db->escape($file) . "' WHERE product_id = '" . (int)$product_id . "'";
						//$this->log->write($sql);
						$this->db->query($sql);
					}
				} elseif(isset($files['Описание'])){
					foreach ($files['Описание'] as $file) {
						$sql = "UPDATE " . DB_PREFIX . "product_description SET file_description = '" . $this->db->escape($file) . "' WHERE product_id = '" . (int)$product_id . "'";
						//$this->log->write($sql);
						$this->db->query($sql);
					}
				}
			}

		}
		return $json;
	}

	public function udateProductFilters($prods_filters=array()) {
		//$this->log->write('start model udateProductFilters');
        //vdump($prods_filters);

		$res = array();
		foreach ($prods_filters as $model => $filters) {

			$sql = "SELECT product_id FROM " . DB_PREFIX . "product WHERE mpn='".$this->db->escape($model)."'";
			$query = $this->db->query($sql);

			if(!$query->row)continue;
			$product_id = $query->row['product_id'];

			$sql = "DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'";
			//vdump($sql);
			$this->db->query($sql);

			foreach ($filters as $filter) {

				$sql = "INSERT INTO oc_product_filter (product_id, filter_id, updated) SELECT '" . (int)$product_id . "', filter_id, now() FROM oc_filter WHERE ext_filter_id = '".$this->db->escape($filter['ValueId'])."'";
                //vdump($sql);
				$this->db->query($sql);
			}

		}
		//return $res;
	}

	public function udateProductAttributes($prods_attributes=array()) {

		$res = array();
		foreach ($prods_attributes as $model => $attributes) {

			$sql = "SELECT product_id FROM " . DB_PREFIX . "product WHERE mpn='".$this->db->escape($model)."'";
			$query = $this->db->query($sql);

			if(!$query->row)continue;

			$product_id = $query->row['product_id'];

			$sql = "DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'";
			//**vdump($sql);
			$this->db->query($sql);


			foreach ($attributes as $attribute) {
				if(!isset($attribute['AttributeId']))continue;

				/*$sql = "SELECT attribute_id FROM oc_attribute WHERE ext_attribute_id='".$this->db->escape($attribute['AttributeId'])."'";
				$query = $this->db->query($sql);
				if(!$query->row)continue;*/

				/*if(isset($query->row['attribute_id']) && isset($attribute['name'])){
					$attribute_id = $query->row['attribute_id'];*/
					foreach ($attribute['name'] as $language_id => $name) {
						$sql = "INSERT INTO oc_product_attribute (product_id, language_id, attribute_id, `text`)
						SELECT '" . (int)$product_id . "', '".(int)$language_id."', attribute_id,
						'".$this->db->escape($name)."'
						 FROM oc_attribute WHERE ext_attribute_id = '".$this->db->escape($attribute['AttributeId'])."'";
						 //vdump($sql);
						$this->db->query($sql);
					}
				//}

			}


		}
		//return $res;
	}

	public function updateCompatibility($products){

		//$products = array_slice($products,0,10);
		if($products){
		    $this->db->query("UPDATE oc_product_compability SET status=0");
		    //$count = 0;
		    foreach ($products as $key => $value) {
		    	//echo '#';
		        //if($key<173000)continue;

		        $sql = "INSERT INTO oc_product_compability (product_id,child_product_id,model,child_model,	connection_type,status)
						SELECT t1.product_id, t2.child_product_id, '".$this->db->escape($value['ItemId'])."',
						'".$this->db->escape($value['ChildItemId'])."', '".$this->db->escape($value['ProductGroupId'])."', '1'
						FROM (
							(SELECT product_id as product_id  FROM oc_product WHERE mpn='".$this->db->escape($value['ItemId'])."') as t1,
							(SELECT product_id as child_product_id FROM oc_product WHERE mpn='".$this->db->escape($value['ChildItemId'])."') as t2
						)
							WHERE t1.product_id  is not null AND t2.child_product_id is not null
						on duplicate key update status = 1";
		        $this->db->query($sql);
		        $sql = "INSERT INTO oc_product_compability (product_id,child_product_id,model,child_model,	connection_type,status)
						SELECT t1.product_id, t2.child_product_id, '".$this->db->escape($value['ChildItemId'])."',
						'".$this->db->escape($value['ItemId'])."', '".$this->db->escape($value['ProductGroupId'])."', '1'
						FROM (
							(SELECT product_id as product_id  FROM oc_product WHERE mpn='".$this->db->escape($value['ChildItemId'])."') as t1,
							(SELECT product_id as child_product_id FROM oc_product WHERE mpn='".$this->db->escape($value['ItemId'])."') as t2
						)
							WHERE t1.product_id  is not null AND t2.child_product_id is not null
						on duplicate key update status = 1";

		        $this->db->query($sql);

		    }
		    $this->db->query("DELETE FROM oc_product_compability WHERE status=0");
	    }

	}

	public function udateProductSalesPromotion($SalesPromotionId,$productsPromotion=array()){
		$sql = "UPDATE " . DB_PREFIX . "product SET promotion = '' WHERE promotion='".$SalesPromotionId."'";

		$this->db->query($sql);
		foreach ($productsPromotion as $product) {
			$sql = "UPDATE " . DB_PREFIX . "product SET promotion = '".$product['SalesPromotionId']."' WHERE `model`='".$product['ItemId']."'";

			$this->db->query($sql);
		}
	}

	public function deletePriceList() {
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_price_list");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "price_group_ax_to_category");

	}

	// обновление прайса подряда услуг
	public function updatePriceListContract($data) {

		$this->db->query("UPDATE " . DB_PREFIX . "product_price_list_contract SET status = 0");
		$c=0;
		foreach ($data as $service) {
			$sql = "SELECT product_id FROM " . DB_PREFIX . "product WHERE model = '".$this->db->escape($service['ComponentId'])."'";
			//vdump($sql);
			$query = $this->db->query($sql);
			$product_id =0;
			if($query->row){
				$product_id = $query->row['product_id'];
			}
			if(!$service['ComponentId'])$service['ComponentId']=0;

			$sql = "INSERT INTO product_price_list_contract (service_id, conponent_id, service_name, conponent_name, product_id, PriceUah, status)
			VALUES ('".$this->db->escape($service['ServiceId'])."', '".$this->db->escape($service['ComponentId'])."', '".$this->db->escape($service['ServiceName'])."', '".$this->db->escape($service['ComponentName'])."', '".$this->db->escape($product_id)."', '".(float)$service['PriceUah']."', 1)
			ON DUPLICATE KEY UPDATE service_id = '".$this->db->escape($service['ServiceId'])."', conponent_id = '".$this->db->escape($service['ComponentId'])."'";

			$res = $this->db->query($sql);

		}

	}

}
