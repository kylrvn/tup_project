<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faculty_schedule_service extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		// if(is_empty_object($this->session)){
		// 	redirect(base_url().'login/authentication', 'refresh');
		// }

		$model_list = [
			'faculty_schedule/service/Faculty_schedule_services_model' => 'fsModel'
		];
		$this->load->model($model_list);
	}

	public function save_schedule(){
		$this->fsModel->faculty_id = $this->session->ID;
		$this->fsModel->subject = $this->input->post("subject");
		$this->fsModel->day = $this->input->post("day");
		$this->fsModel->room = $this->input->post("room");
		$this->fsModel->start_time = $this->input->post("start_time");
		$this->fsModel->end_time = $this->input->post("end_time");

		$response = $this->fsModel->save_schedule();
		echo json_encode($response);
	}

	public function update_schedule(){
		$this->fsModel->ID = $this->input->post("ID");
		$this->fsModel->subject = $this->input->post("subject");
		$this->fsModel->day = $this->input->post("day");
		$this->fsModel->room = $this->input->post("room");
		$this->fsModel->start_time = $this->input->post("start_time");
		$this->fsModel->end_time = $this->input->post("end_time");
	
		$response = $this->fsModel->update_schedule();
		echo json_encode($response);
	}


	public function update(){
		$this->fsModel->faculty_id = $this->input->post("faculty_id");
		$this->fsModel->subject = $this->input->post("subject");
		$this->fsModel->day = $this->input->post("day");
		$this->fsModel->room = $this->input->post("room");
		$this->fsModel->start_time  = $this->input->post("start_time");
		$this->fsModel->end_time = $this->input->post("end_time");

		$response = $this->fsModel->update();
		echo json_encode($response);
	}
	public function delete(){
		$this->fsModel->sched_id = $this->input->post("sched_id");
		

		$response = $this->fsModel->delete();
		echo json_encode($response);
	} 
}

