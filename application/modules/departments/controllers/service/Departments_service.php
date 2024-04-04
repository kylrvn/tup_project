<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departments_service extends MY_Controller
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
			'departments/service/Departments_services_model' => 'dsModel'
		];
		$this->load->model($model_list);
	}

	public function add_department()
	{
		$this->dsModel->dept_name = $this->input->post("dept_name");
		$this->dsModel->status = $this->input->post("status");

		$response = $this->dsModel->add_dept();
		echo json_encode($response);
	}

}