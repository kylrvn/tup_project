<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subjects_service extends MY_Controller
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
			'subjects/service/Subjects_services_model' => 'SsModel'
		];
		$this->load->model($model_list);
	}

	public function add_subject()
	{
		$this->SsModel->subject_name = $this->input->post("subject_name");
		$this->SsModel->subject_code = $this->input->post("subject_code");

		$this->SsModel->color = $this->input->post("color");
		$this->SsModel->department = $this->input->post("department");
		$this->SsModel->status = $this->input->post("status");

		$response = $this->SsModel->add_subject();
		echo json_encode($response);
	}

	public function update_subject()
	{

		$this->SsModel->ID = $this->input->post("id");
		$this->SsModel->subject_name = $this->input->post("subject_name");
		$this->SsModel->subject_code = $this->input->post("subject_code");

		$this->SsModel->color = $this->input->post("color");
		$this->SsModel->department = $this->input->post("department");
		$this->SsModel->status = $this->input->post("status");

		$response = $this->SsModel->update_subject();
		echo json_encode($response);
	}

}