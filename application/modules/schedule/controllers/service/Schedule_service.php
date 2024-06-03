<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_service extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		// if(is_empty_object($this->session)){
		// 	redirect(base_url().'login/authentication', 'refresh');
		// }

		$model_list = [
			'schedule/service/Schedule_services_model' => 'SsModel'
		];
		$this->load->model($model_list);
	}




	public function save_exam_sched()
	{
		$dateRange = $this->input->post("date_range");
		$dateParts = explode(" - ", $dateRange);

		$dateFrom = trim($dateParts[0]);
		$dateTo = trim($dateParts[1]);

		$this->SsModel->faculty_id = $this->input->post("faculty_id");
		$this->SsModel->department_id = $this->input->post("department_id");

		$this->SsModel->date_from = $dateFrom;
		$this->SsModel->date_to = $dateTo;
		$this->SsModel->school_year = $this->input->post("school_year");
		$this->SsModel->term = $this->input->post("term");

		$response = $this->SsModel->save_exam_schedule();
		echo json_encode($response);
	}

	public function save_events(){
		// var_dump($this->input->post("eventsArray"));
		$this->SsModel->eventsArray = $this->input->post("eventsArray");
		$response = $this->SsModel->save_events();
		echo json_encode($response);
	}

	public function delete_event(){
		$this->SsModel->title = $this->input->post("title");
		$this->SsModel->date = $this->input->post("date");

		$response = $this->SsModel->delete_event();
		echo json_encode($response);
	}

}