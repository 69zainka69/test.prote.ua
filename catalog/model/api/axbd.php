<?php
class ModelApiAxapta extends Model {
	//$db = new DB\MySQLi(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
	public $count_product_update = 0;
	public $count_product_add = 0;
	public $db = '';

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


	public function getGroupSite2List() {
		$this->connect();
		$sql = "EXEC dbo.p_getGroupSite2List";
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



/////////////////////////////////////////////////////////////////////////////
	function getlanguageId($LanguageId) {
	  $myArray = array('ru' => '1', 'ua' => '2');
	  return $myArray[$LanguageId];
	}


	public function getCategories() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c WHERE c.GroupSite2Id <> '' AND c.status = '1'");
		return $query->rows;
	}


		//$this->log->write('start model updateProduct');
        /*if($data['ItemId']=='MFD-XER-6515DN'){
            //vdump($data);
            //exit;
        }*/

   

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

			
			/////////////

	
         
            /////////////

        

//    public function setImageDisable() {
//        $this->db->query("UPDATE " . DB_PREFIX . "oc_product_image SET `update` = '0'");
//    }
//    public function setImageDisable() {
//        $this->db->query("DELETE FROM " . DB_PREFIX . "oc_product_image WHERE `update` = '0'");
//    }

	//




	public function updateFiltersGroup($filters=array()) {

		foreach ($filters as $filter_group_id_ax => $filter) {
            //vdump($filter);
var_dump($filter['AttributeId']);
exit();
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









}
