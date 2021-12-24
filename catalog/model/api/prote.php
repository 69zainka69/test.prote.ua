<?php
class ModelApiAxapta extends Model {
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

//		file_put_contents(DIR_LOGS . 'sql.log', "prote" . "\n");
		
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
	
	
	public function updateFiltersGroup($filters=array()) {
		//$this->log->write('start model updateFiltersGroup');

		foreach ($filters as $filter_group_id_ax => $filter) {

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

	public function updateProduct($category_id,$data) {
		//$this->log->write('start model updateProduct');

		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE model = '" . $this->db->escape($data['model']) . "'");
		if($query->row){ //обновляем товар
			$product_id = $query->row['product_id'];
			$this->db->query("UPDATE " . DB_PREFIX . "product SET 
				CommodityGroupId = '" . $this->db->escape($data['CommodityGroupId']) . "', 
				model = '" . $this->db->escape($data['model']) . "', 
				NameAlias = '" . $this->db->escape($data['NameAlias']) . "', 
				KodTNVED = '". $this->db->escape($data['KodTNVED'])."', 
				PackQty = '". (int)$data['PackQty']."', 
				ItemProducerId = '". $this->db->escape($data['ItemProducerId'])."', 
				location = '', 
				quantity = '100', 
				minimum = '1', 
				subtract = '', 
				stock_status_id = '7', 
				date_available = NOW(), 
				manufacturer_id = '1', 
				shipping = '1', 
				price = '0', 
				points = '0', 
				weight = '0', 
				weight_class_id = '1', 
				length = '0', 
				width = '0', 
				height = '0', 
				length_class_id = '1', 
				status = '1', 
				`update` = '1', 
				noindex = '1', 
				tax_class_id = '9', 
				sort_order = '1', 
				date_added = NOW(), 
				date_modified = NOW()
				WHERE product_id='".$product_id."'");

			$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");
			foreach ($data['product_description'] as $language_id => $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET 
					product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', 
					name = '" . $this->db->escape($value['ItemName']) . "', 
					description = '" . $this->db->escape($value['ItemDescription']) . "',
					ItemOriginName = '" . $this->db->escape($value['ItemOriginName']) . "'
					 ");
			}

			/*$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '0'");*/

			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "', main_category = 1");

		} else {// добавляем товар
			$this->db->query("INSERT INTO " . DB_PREFIX . "product SET 
				CommodityGroupId = '" . $this->db->escape($data['CommodityGroupId']) . "', 
				model = '" . $this->db->escape($data['model']) . "', 
				NameAlias = '". $this->db->escape($data['NameAlias'])."', 
				KodTNVED = '". $this->db->escape($data['KodTNVED'])."', 
				PackQty = '". (int)$data['PackQty']."', 
				ItemProducerId = '". $this->db->escape($data['ItemProducerId'])."', 
				location = '', 
				quantity = '100', 
				minimum = '1', 
				subtract = '', 
				stock_status_id = '7', 
				date_available = NOW(), 
				manufacturer_id = '1', 
				shipping = '1', 
				price = '0', 
				points = '0', 
				weight = '0', 
				weight_class_id = '1', 
				length = '0', 
				width = '0', 
				height = '0', 
				length_class_id = '1', 
				status = '1', 
				`update` = '1', 
				noindex = '1', 
				tax_class_id = '9', 
				sort_order = '1', 
				date_added = NOW(), 
				date_modified = NOW()");

			$product_id = $this->db->getLastId();

			/*if (isset($data['image'])) {
				$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int)$product_id . "'");
			}*/
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '0'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "', main_category = 1");
			
			// SEO URL
			$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id . "'");
			foreach ($data['product_description'] as $language_id => $keyword) {
				$keyword_seo = translit($keyword['ItemName'].'_'.$language_id);
				if (!empty($keyword_seo)) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '0', language_id = '" . (int)$language_id . "', query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($keyword_seo) . "'");
				}
			}
			

			return $product_id;
		}
		
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
				echo $sql;
				$query = $this->db->query($sql);
				if(!$query->row)continue;
				
				$filter_id = $query->row['filter_id'];
				$sql = "INSERT INTO product_filter SET product_id ='".(int)$product_id."', filter_id ='".(int)$filter_id."'";
				echo $sql;
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

	public function getCategories() {
		$sql = "SELECT category_id_ax FROM category";
		
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function updateCategories($parent_cat_id_ax,$categories) {
			$log=array();
		// проверяем существует ли родительская категория
		$sql = "SELECT category_id FROM category WHERE category_id_ax='".$this->db->escape($parent_cat_id_ax)."'";	
		$query = $this->db->query($sql);
		//$log['error'][] = $query;
		//return $log;
		if($query->row){
			$parent_category_id = $query->row['category_id'];
			$sort_order=100;
			foreach ($categories as $data) {
				// ищем категорнию site2
				$sql = "SELECT category_id FROM category WHERE category_id_ax='".$this->db->escape($data['GroupSite2Id'])."'";	
				$query = $this->db->query($sql);
				/*$this->log->write($data);
				$this->log->write($query);*/

				if($query->row){
					$category_id = $query->row['category_id'];
					// обновляем категорию

					foreach ($data['category_description'] as $language_id => $value) {
						$sql = "UPDATE `category_description` SET 
						 name = '" . $this->db->escape($value) . "' 
						 WHERE category_id = '" . (int)$category_id . "' AND language_id = '" . (int)$language_id . "'";
						$this->db->query($sql);
					}

				} else {
					// добавляем категорию
					$sql = "INSERT INTO category SET category_id_ax = '" . $this->db->escape($data['GroupSite2Id']) . "', 
					parent_id = '" . (int)$parent_category_id . "',
					sort_order = '" . (int)$sort_order . "', status = '1', date_added = NOW()";
					$query = $this->db->query($sql);
					$category_id = $this->db->getLastId();

					foreach ($data['category_description'] as $language_id => $value) {
						$sql = "INSERT INTO `category_description` SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value) . "'";
						$this->db->query($sql);
					}

					$this->db->query("INSERT INTO `category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$parent_category_id . "', `level` = '0'");
					$this->db->query("INSERT INTO `category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$category_id . "', `level` = '1'");
					$this->db->query("INSERT INTO category_to_store SET category_id = '" . (int)$category_id . "', store_id = '0'");
					$this->db->query("INSERT INTO category_to_layout SET category_id = '" . (int)$category_id . "', store_id = '0', layout_id = '0'");
					

					foreach ($data['keyword'] as $language_id => $keyword) {
						if (!empty($keyword)) {
							// проверяем есть ли keyword а таблице
							$sql = "SELECT * FROM seo_url WHERE keyword = '" . $this->db->escape($keyword) . "'";
							$query = $this->db->query($sql);
							if($query->row){
								$keyword_ald = $keyword;
								$keyword = $this->db->escape($keyword) .'_'.rand(0,200);
								$log['error'][] = 'При импорте категории обнаружен одинаковый keyword = '.$keyword_ald.", новый keyword = ".$keyword;
								
							}

							$this->db->query("INSERT INTO seo_url SET store_id = '0', language_id = '" . (int)$language_id . "', query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->db->escape($keyword) . "'");
						}
					}

					//return $category_id;
				}
				$sort_order=$sort_order+10;
			}
		} else {
			return false;
		}
		return $log;

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