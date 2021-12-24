<?php

class ModelApiAxapta extends Model {
	//$db = new DB\MySQLi(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
	public $count_product_update = 0;
	public $count_product_add = 0;

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
		$sql = "SELECT * FROM " . DB_PREFIX . "axapta_tasks WHERE status = 1";
		$res = $this->db->query($sql);
		if($res->row)return false;

		$sql = "SELECT * FROM " . DB_PREFIX . "axapta_tasks WHERE status = 0";
		$res = $this->db->query($sql);
		return $res->rows;
	}

	public function addTask($data){

		$sql = "INSERT INTO " . DB_PREFIX . "axapta_tasks SET 
			task_type = '" . $this->db->escape($data['task']) . "', 
			comment = '" . $this->db->escape($data['comment']) . "', 
			status = 0";

			// date_start = NOW(),

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
	public function getProductDocuments($SiteFlag=1) {
		$this->connect();
		// добавил параметр @_SiteFlag
		// если передашь  1 - то forPorte
		// если передашь 0, или ничего - то forPatronService
		// если передашь -1 то все
		$sql = "EXEC dbo.p_getProductDocuments @_SiteFlag='".$SiteFlag."'";
		$query = $this->db_ax->query($sql);
		return $query->rows;
	}

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
				if($row['PriceGroup']=='Розница'){
					$sql = "UPDATE " . DB_PREFIX . "product SET price = '".$price['PriceRrpUa']."' WHERE model = '".$this->db->escape($price['ItemId'])."'";
					$this->db->query($sql);
				}
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
		foreach ($query->rows as $key => $row) {

			//$sql = "EXEC dbo.p_getCategoriesByPriceGroup @_PriceGroupId = '".$row['PriceGroup']."'";
			$sql = "EXEC dbo.p_getGroupSite2ListByPriceGroup @_PriceGroupId = '".$row['PriceGroup']."'";
			$query2 = $this->db_ax->query($sql);
			//$results[]=$query2;
			$sql = "DELETE FROM " . DB_PREFIX . "price_group_ax_to_category WHERE pricegroup = '" . $this->db->escape($row['PriceGroup']) . "'";
			//vdump($sql);
			$this->db->query($sql);
			$GroupSite1Id = array();
			foreach ($query2->rows as $key3 => $row3) {
				//$this->log->write($row3);
				$GroupSite1Id[$row3['GroupSite1Id']] = $row3['GroupSite1Id'];
				$sql = "INSERT INTO `" . DB_PREFIX . "price_group_ax_to_category` SET pricegroup = '".$this->db->escape($row['PriceGroup'])."', category_id_ax = '".$this->db->escape($row3['GroupSite2Id'])."', date_update = NOW()";
				//vdump($sql);
				$this->db->query($sql);
			}
			foreach ($GroupSite1Id as $key3 => $row3) {
				//$this->log->write($row3);
				$sql = "INSERT INTO `" . DB_PREFIX . "price_group_ax_to_category` SET pricegroup = '".$this->db->escape($row['PriceGroup'])."', category_id_ax = '".$this->db->escape($key3)."', date_update = NOW()";
				//vdump($sql);
				$this->db->query($sql);
			}
			//exit;

		}
		return $results;

		//return $query->rows;
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

	public function updateProduct($category_id,$data) {
		//$this->log->write('start model updateProduct');

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

		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE mpn = '" . $this->db->escape($data['ItemId']) . "'");
		if($query->row){ //обновляем товар
			$this->count_product_update++;
			$product_id = $query->row['product_id'];


			$sql = "UPDATE " . DB_PREFIX . "product SET `mpn`='".$data['ItemId']."', `status`='". $status ."', model = '".$data['ItemKod1C']."', sku = '".$data['ItemKod1C']."', price = '".$data['price']."', `quantity`='" . (int)$quantity . "', `delivery_days`='".(int)$data['DlvDays']."', `extavail`='".(int)$data['ExtAvail']."', `extdlvdays`='".(int)$data['ExtDlvDays']."', `asort`='".(int)$asort."', `date_modified`=now(), ifexist='".(int)$ifexist."', `shipping`='1', `date_modified`=now(), `is_complex`='".(int)$data['isComplex']."' WHERE `product_id`= '" . $product_id . "'";
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

				$sql = "UPDATE axapta_files SET product_id = '".(int)$product_id."'', name='".$this->db->escape($file['FileName'])."',
				-- alias='".$this->db->escape($alias)."', update = 1 WHERE ax_filename = '".$this->db->escape($file['FileName'])."'";
				$this->db->query($sql);
			}
			// обновляем бонусные баллы
			$sql = "INSERT INTO " . DB_PREFIX . "product_reward SET customer_group_id = '1', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "' ON DUPLICATE KEY UPDATE customer_group_id = '1', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "'";
			$this->db->query($sql);
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET customer_group_id = '4', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "' ON DUPLICATE KEY UPDATE customer_group_id = '4', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "'");


			return $product_id;

		} else {// добавляем товар

			 $sql = "INSERT INTO `oc_product` (`sku`, `model`, `mpn`, `status`, `quantity`, `price`, `shipping`, `delivery_days`, `extavail`, `extdlvdays`, `date_added`, `ifexist`, `is_complex`) VALUES ('".$data['ItemKod1C']."', '".$data['ItemKod1C']."', '".$data['ItemId']."', '".$status."', '" . $quantity ."', ".$data['price'].", '1', '".$d['DlvDays']."', '".$d['ExtAvail']."', '".$d['ExtDlvDays']."', now(), '".$ifexist."', '".$d['isComplex']."')";
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
				$alias = prepare_alias_file($file['FileName'], 1) .'.'. $ext;      // echo $alias;

				$sql = "INSERT INTO axapta_files SET product_id = '".(int)$product_id."'', name='".$this->db->escape($file['FileName'])."', alias='".$this->db->escape($alias)."', update = 1, ax_filename = '".$this->db->escape($file['FileName'])."'";
				$this->db->query($sql);
			}
			// добавляем бонусные баллы
			$sql = "INSERT INTO " . DB_PREFIX . "product_reward SET customer_group_id = '1', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "'";
			$this->db->query($sql);
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET customer_group_id = '4', points = '" . (int)$data['points'] . "', product_id = '" . (int)$product_id . "'");

			// SEO URL
			$keyword=trim(ru2Lat(trim(mb_substr($data['product_description'][1]['ItemName'],0,50,'UTF-8'))),'-').'-'.$data['ItemKod1C'];

            $keyword=preg_replace("#[^a-zA-Z0-9]+#", "-", $keyword);
            $keyword=preg_replace("#(-){2,}#", "$1", $keyword);
			$sql_prote="SELECT * FROM `oc_url_alias` WHERE `keyword`='".$keyword ."'";
            $query = getQuery($sql_prote, $db_prote);
            if ($query->row) {$keyword .= '-' . substr(md5(date('H:i:s')), 0, 5); }

			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $keyword . "'");


			return $product_id;
		}

	}



	//
	public function updateAvailableStart() {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET status_for_update = '0'");
	}

	public function updateAvailableEnd() {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET status = '0' WHERE status_for_update = '0'");
	}

	public function updateAvailableStatus($datas) {
		foreach ($datas as $data) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET status = '1', status_for_update = '1', AvailStatus = '".$this->db->escape($data['AvailStatus'])."', PreOrderDlv = '".(int)$data['PreOrderDlv']."', ExpectedDate = '".$this->db->escape($data['ExpectedDate'])."' WHERE model = '".$this->db->escape($data['ItemId'])."'");
		}
	}

	public function updateFilters___($filters=array()) {
		$c=0;
		$c2=0;
		foreach ($filters as $key => $filter) {
			vdump($filter);
			//$sql = "SELETCT * FROM oc_filter_group_description WHERE "
			/*$sql = "SELECT * FROM oc_filter_group_description WHERE name='".$this->db->escape($filter['attribute_name'][1])."' AND language_id=1 AND filter_group_id<100000";
			$query = $this->db->query($sql);
			$sql = "SELECT * FROM oc_filter_group_description WHERE name='".$this->db->escape($filter['attribute_name'][2])."' AND language_id=2 AND filter_group_id<100000";
			$query2 = $this->db->query($sql);
			if($query->rows && count($query->rows)==1 && $query2->rows && count($query2->rows)==1){
				echo 'ok<br>';
				$c++;
			} else {
				echo 'error<br>';
				vdump($query->rows);
				vdump($query2->rows);
				$c2++;
			}*/
		}
		echo "Нашли - ".$c."<br>";
		echo "Нашли - ".$c2."<br>";
		//vdump($filters);
	}

	public function updateFiltersGroup($filters=array()) {
		//$this->log->write('start model updateFiltersGroup');

		foreach ($filters as $filter_group_id_ax => $filter) {

			$sql = "INSERT INTO `oc_filter_group` SET 
			filter_group_id = CAST(substr('".$filter['AttributeId']."', 3,10) AS SIGNED),
			sort_order = 0,
			updated = now(),
			ext_filter_group_id = '".$this->db->escape($filter['AttributeId'])."'
          	ON DUPLICATE KEY UPDATE updated = now(), ext_filter_group_id= '".$this->db->escape($filter['AttributeId'])."'";

          	foreach ($filter['attribute_name'] as $language_id => $value) {
				$this->db->query("
					INSERT INTO oc_filter_group_description (filter_group_id,language_id,name,updated) 
					(SELECT filter_group_id FROM oc_filter_group WHERE ext_filter_group_id='".$this->db->escape($filter['AttributeId'])."'),
					'" . (int)$language_id . "', name = '" . $this->db->escape($value) . "', now()");

					/*SET filter_group_id = '" . (int)$filter_group_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value) . "'");*/
			}
			exit;

			/*
			$sql = "SELECT * FROM filter_group WHERE filter_group_id_ax='".$filter_group_id_ax."'";
			$query = $this->db->query($sql);

			if(!$query->row){
				$sql = "INSERT INTO filter_group (filter_group_id_ax, sort_order) VALUES ('". $filter_group_id_ax."', '99')";
				$query = $this->db->query($sql);
				$filter_group_id = $this->db->getLastId();
			} else {
				$filter_group_id = $query->row['filter_group_id'];
				$sql = "DELETE FROM " . DB_PREFIX . "filter_group_description WHERE filter_group_id = '" . (int)$filter_group_id . "'";
				$this->db->query($sql);
			}

			foreach ($filter['attribute_name'] as $language_id => $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "filter_group_description SET filter_group_id = '" . (int)$filter_group_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value) . "'");
			}
			*/
		}
	}

	public function updateFiltersValue($filters=array()) {
		//$this->log->write('start model updateFiltersValue');
		//$res = array();
		//$filterId_to_filter_id_ax = array();
		foreach ($filters as $filter_id_ax => $filter) {
			$sql = "SELECT filter_group_id FROM filter_group WHERE filter_group_id_ax='".$filter_id_ax."'";
			$query = $this->db->query($sql);
			if(!$query->row)continue;
			//$res[$filter_id_ax] = $query->row;
			$filter_group_id =$query->row['filter_group_id'];

			foreach ($filter as $filter_value_id_ax => $value) {
				$sql = "SELECT filter_id FROM filter WHERE filter_id_ax='".$this->db->escape($filter_value_id_ax)."' AND filter_group_id=".(int)$filter_group_id;
				$query = $this->db->query($sql);
				if(!$query->row){
					$sql =	"INSERT INTO filter (filter_id_ax, filter_group_id, sort_order)
						VALUES ('".$this->db->escape($filter_value_id_ax)."', '".$this->db->escape($filter_group_id)."', '99')";
					$query = $this->db->query($sql);
					$filter_id = $this->db->getLastId();
				} else {
					$filter_id = $query->row['filter_id'];

					$sql = "DELETE FROM " . DB_PREFIX . "filter_description WHERE filter_id = '" . (int)$filter_id . "'";
					$query = $this->db->query($sql);

					foreach ($value['name'] as $language_id => $value) {
						if($language_id!=3)continue;
						//$this->db->query("UPDATE " . DB_PREFIX . "product SET `update` = '0'");
						//$sql = "UPDATE  " . DB_PREFIX . "filter_description SET
							/*filter_group_id = '" . (int)$filter_group_id . "', */
						//	name = '" . $this->db->escape($value) . "'
						//	WHERE filter_id = '" . (int)$filter_id . "' AND language_id = '" . (int)$language_id . "'
						//	";
						$sql = "INSERT INTO " . DB_PREFIX . "filter_description SET 
						filter_id = '" . (int)$filter_id . "', 
						filter_group_id = '" . (int)$filter_group_id . "', 
						language_id = '" . (int)$language_id . "', 
						name = '" . $this->db->escape($value) . "'";

						/*if($filter_id=='7200'){
							$this->log->write($sql);
						}*/
						$this->db->query($sql);
					}

				}

				/*foreach ($value['name'] as $language_id => $value) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "filter_description SET
						filter_id = '" . (int)$filter_id . "',
						filter_group_id = '" . (int)$filter_group_id . "',
						language_id = '" . (int)$language_id . "',
						name = '" . $this->db->escape($value) . "'");
				}*/

				/*$filterId_to_filter_id_ax[] = array(
					'filter_id'	=>	$filter_id,
					'filter_id_ax'	=>	$filter_value_id_ax,
					'filter_group_id'	=>	$filter_group_id
				);*/

			}

		}
		//return $res;
	}
	public function updateAttributes($attributes=array()) {
		//$this->log->write('start model updateAttributes');

		foreach ($attributes as $attribute_id_ax => $attribute) {

			$sql = "SELECT * FROM attribute WHERE attribute_id_ax='".$attribute_id_ax."'";
			$query = $this->db->query($sql);

			if(!$query->row){
				$sql = "INSERT INTO attribute (attribute_id_ax, attribute_group_id, sort_order) VALUES ('". $attribute_id_ax."', '1', '99')";
				$query = $this->db->query($sql);
				$attribute_id = $this->db->getLastId();
			} else {
				$attribute_id = $query->row['attribute_id'];
				$sql = "DELETE FROM " . DB_PREFIX . "attribute_description WHERE attribute_id = '" . (int)$attribute_id . "'";
				$this->db->query($sql);
			}

			foreach ($attribute['attribute_name'] as $language_id => $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . (int)$attribute_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value) . "'");
			}

		}
	}

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

		$res = array();
		foreach ($prods_filters as $model => $filters) {

			$sql = "SELECT product_id FROM " . DB_PREFIX . "product WHERE model='".$this->db->escape($model)."'";
			$query = $this->db->query($sql);
			//$res[]=$query->row;
			if(!$query->row)continue;

			$product_id = $query->row['product_id'];

			$sql = "DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'";
			$query = $this->db->query($sql);

			foreach ($filters as $filter) {

				$sql = "SELECT filter_id FROM filter f LEFT JOIN filter_group fg ON(f.filter_group_id=fg.filter_group_id)
				WHERE fg.filter_group_id_ax='".$this->db->escape($filter['FilterId'])."' AND f.filter_id_ax='".$this->db->escape($filter['ValueId'])."'";
				$query = $this->db->query($sql);
				if(!$query->row)continue;

				$filter_id = $query->row['filter_id'];
				$sql = "INSERT INTO product_filter SET product_id ='".(int)$product_id."', filter_id ='".(int)$filter_id."'";
				$query = $this->db->query($sql);
			}

		}
		//return $res;
	}

	public function udateProductAttributes($prods_attributes=array()) {
		//$this->log->write('start model udateProductAttributes');
		$res = array();
		foreach ($prods_attributes as $model => $attributes) {

			$sql = "SELECT product_id FROM " . DB_PREFIX . "product WHERE model='".$this->db->escape($model)."'";
			$query = $this->db->query($sql);
			//$res[]=$query->row;
			if(!$query->row)continue;

			$product_id = $query->row['product_id'];

			$sql = "DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'";
			$query = $this->db->query($sql);
			//$res[] = $sql;

			foreach ($attributes as $attribute) {
				if(!isset($attribute['AttributeId']))continue;

				$sql = "SELECT attribute_id FROM attribute WHERE attribute_id_ax='".$this->db->escape($attribute['AttributeId'])."'";
				//$res[] = $sql;
				$query = $this->db->query($sql);
				if(!$query->row)continue;

				if(isset($query->row['attribute_id']) && isset($attribute['name'])){
					$attribute_id = $query->row['attribute_id'];
					foreach ($attribute['name'] as $language_id => $name) {
						$sql = "INSERT INTO product_attribute SET product_id ='".(int)$product_id."', 
						attribute_id ='".(int)$attribute_id."',
						language_id ='".(int)$language_id."',
						text ='".$this->db->escape($name)."'";
						$query = $this->db->query($sql);
					}
				}

			}


		}
		//return $res;
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
