<?php
class ControllerApiAxapta extends Controller {

    public function addTask() {
 
	if(!isset($this->request->post['task']))
	    return;
		    
	$task = $this->request->post['task'];
		
	$this->load->model('api/axapta');
		
	$dat = array();
	if($task=='full'){
    	    $dat = array('task' => $task,'comment' => 'Полное обновление (POST)'); // so... this parm in POST ignored?
    	}    

//	$this->log->write($dat, true);

	if(!$dat) {
		$json['error'] = $task .' не найдено в controller/api/addtask';
	} else {

		$task_id = $this->model_api_axapta->addTask($dat);
		$this->log->write($task_id, true);
		if($task_id>0){
			$json['success'] = 1;
		} else {
			$json['error'] ='ошибка!!!';
		}
	}

	$this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($json));

    }
}
