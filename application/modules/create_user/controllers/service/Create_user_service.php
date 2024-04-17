<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Create_user_service extends MY_Controller
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
			'create_user/service/Create_user_services_model' => 'csModel'
		];
		$this->load->model($model_list);
	}

	public function save()
	{
		$this->csModel->fname = $this->input->post("fname");
		$this->csModel->lname = $this->input->post("lname");
		$this->csModel->mname = $this->input->post("mname");
		$this->csModel->Department = $this->input->post("Department");
		$this->csModel->Rank = $this->input->post("Rank");
		$this->csModel->Faculty_number = $this->input->post("Faculty_number");
		$this->csModel->Username = $this->input->post("Username");
		$this->csModel->User_type = $this->input->post("User_type");
		$this->csModel->Address = $this->input->post("Address");
		$this->csModel->Suffix = $this->input->post("Suffix");
		$this->csModel->Contact_Number = $this->input->post("Contact_Number");

		$response = $this->csModel->save_method_from_model();
		echo json_encode($response);
	}

	public function update()
	{
		$this->csModel->ID = $this->input->post("ID");
		$this->csModel->fname = $this->input->post("fname");
		$this->csModel->lname = $this->input->post("lname");
		$this->csModel->mname = $this->input->post("mname");
		$this->csModel->Department = $this->input->post("Department");
		$this->csModel->Rank = $this->input->post("Rank");
		$this->csModel->Faculty_number = $this->input->post("Faculty_number");
		$this->csModel->Username = $this->input->post("Username");
		$this->csModel->User_type = $this->input->post("User_type");
		$this->csModel->Address = $this->input->post("Address");
		$this->csModel->Suffix = $this->input->post("Suffix");
		$this->csModel->Contact_Number = $this->input->post("Contact_Number");

		$response = $this->csModel->update_user();
		echo json_encode($response);
	}

	public function add_department()
	{
		$this->csModel->dept_name = $this->input->post("dept_name");
		$this->csModel->status = $this->input->post("status");

		$response = $this->csModel->add_dept();
		echo json_encode($response);
	}





}