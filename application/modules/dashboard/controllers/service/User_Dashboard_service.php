<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Dashboard_service extends MY_Controller
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
			'dashboard/service/Create_document_services_model' => 'csModel',
			'dashboard/service/Dashboard_services_model' => 'dsModel',
			'dashboard/service/User_Dashboard_services_model' => 'udsModel'
		];
		$this->load->model($model_list);
	}


	

	public function update_user_details(){

		$this->udsModel->FacultyID = $this->session->ID;
		$this->udsModel->fname = $this->input->post("fname");
		$this->udsModel->lname = $this->input->post("lname");
		$this->udsModel->mname = $this->input->post("mname");
		$this->udsModel->suffix = $this->input->post("suffix");
		$this->udsModel->age = $this->input->post("age");
		$this->udsModel->address = $this->input->post("address");
		$this->udsModel->conNo = $this->input->post("conNo");
		$this->udsModel->eType = $this->input->post("eType");
		$this->udsModel->department = $this->input->post("department");
		$this->udsModel->eStatus = $this->input->post("eStatus");
		$this->udsModel->position = $this->input->post("position");
		$this->udsModel->pics = $this->input->post("pics");
		$this->udsModel->email = $this->input->post("email");


		// print($this->input->post("Fname"));
		// echo "Controller for save method";
		$response = $this->udsModel->update_user_details();
		echo json_encode($response);
	}
}
