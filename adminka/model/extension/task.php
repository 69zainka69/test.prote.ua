<?php
class ModelExtensionTask extends Model {

	public function getTasks($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "axapta_tasks ORDER BY task_id DESC LIMIT 20";
		$query = $this->db->query($sql);		
		return $query->rows;
	}

    public function addTask($data){

        $sql = "INSERT INTO " . DB_PREFIX . "axapta_tasks SET 
			task_type = '" . $this->db->escape($data['task']) . "', 
			comment = '" . $this->db->escape($data['comment']) . "', 
			status = 0";

        // date_start = NOW(),
        //echo $sql;
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
	
}