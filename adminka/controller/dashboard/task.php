<?php
class ControllerDashboardtask extends Controller {
	private $error = array();

	public function index() {

		//$this->load->language('extension/dashboard/task');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('dashboard_task', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'token=' . $this->session->data['token'] . '&type=dashboard', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'token=' . $this->session->data['token'] . '&type=dashboard', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/dashboard/task', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/dashboard/task', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'token=' . $this->session->data['token'] . '&type=dashboard', true);

		if (isset($this->request->post['dashboard_task_width'])) {
			$data['dashboard_task_width'] = $this->request->post['dashboard_task_width'];
		} else {
			$data['dashboard_task_width'] = $this->config->get('dashboard_task_width');
		}
	
		$data['columns'] = array();
		
		for ($i = 3; $i <= 12; $i++) {
			$data['columns'][] = $i;
		}

				
		if (isset($this->request->post['dashboard_task_status'])) {
			$data['dashboard_task_status'] = $this->request->post['dashboard_task_status'];
		} else {
			$data['dashboard_task_status'] = $this->config->get('dashboard_task_status');
		}

		if (isset($this->request->post['dashboard_task_sort_order'])) {
			$data['dashboard_task_sort_order'] = $this->request->post['dashboard_task_sort_order'];
		} else {
			$data['dashboard_task_sort_order'] = $this->config->get('dashboard_task_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		//vdump($data);

		$this->response->setOutput($this->load->view('extension/dashboard/task_form.tpl', $data));

	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/dashboard/task')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function dashboard() {

	    if (!$this->user->hasPermission('modify', 'dashboard/task')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

		$this->load->language('extension/dashboard/task');

		$data['token'] = $this->session->data['token'];

		$this->load->model('extension/task');

		$tasks = $this->model_extension_task->getTasks();

		foreach ($tasks as $key => $value) {
			if($value['status']==0)$value['status']='Ожидание';
			//if($value['status']==1)$value['status']='Обновление';
			if($value['status']==1)$value['status']='<i class="fa fa-spinner fa-spin"></i>';
			if($value['status']==2)$value['status']='Выполнено';
			if($value['status']==3)$value['status']='Ошибка';
			if($value['date_start'] && $value['date_end']){
				$to_time = strtotime($value['date_start']);
        		$from_time = strtotime($value['date_end']);
        		$value['time'] = date('i:s', ($from_time - $to_time));
			}

			$value['date_start'] .= " - ".$value['date_end'];

			$data['tasks'][]	= array(
				'date_start' => $value['date_start'],
				'comment' => $value['comment'],
				'status' => $value['status'],
				'time' => $value['time']
			);
		}

		$data['url_add_task'] = $this->url->link('dashboard/task/addtask', 'token=' . $this->session->data['token'], true);

		return $this->load->view('extension/dashboard/task_info.tpl', $data);
	}

    public function addTask(){
//        $this->log->write('1', true);
        if (!$this->user->hasPermission('modify', 'dashboard/task')) {
            $this->error['warning'] = $this->language->get('error_permission');
            return;
        }

        if(!isset($this->request->get['task']))return;
        $task = $this->request->get['task'];
        $this->load->model('extension/task');
        $dat = array();
        if($task=='full'){
            $dat = array('task' => $task,'comment' => 'Полное обновление');
        } elseif($task=='updatePriceList'){
            $dat = array('task' => $task,'comment' => 'Обновить Цены');
        }

        //$this->log->write($dat);

        if(!$dat) {
            $json['error'] = $task .' не найдено';
        } else {
            $task_id = $this->model_extension_task->addTask($dat);
            //echo $task_id;
            if($task_id>0){
                $json['success'] = 1;

            } else {
                $json['error'] ='ошибка!!!';
            }
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

    }

	public function time_Diff_Minutes($startTime, $endTime) {
        $to_time = strtotime($endTime);
        $from_time = strtotime($startTime);
        return date($this->language->get('datetime_format'), $from_time - $to_time);
        /*$minutes = ($to_time - $from_time) / 60; 
        return ($minutes < 0 ? 0 : abs($minutes));   */

 	} 
}
