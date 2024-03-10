<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_service extends MY_Controller
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
			'dashboard/service/Dashboard_services_model' => 'dsModel'
		];
		$this->load->model($model_list);
	}


	

	public function save_doc(){

		$this->csModel->Doc_name = $this->input->post("Doc_name");
		$this->csModel->Description = $this->input->post("Description");
		$this->csModel->Category_ID = $this->input->post("Category_ID");
		$this->csModel->Remarks = $this->input->post("Remarks");
		$this->csModel->Publish_by = $this->input->post("Publish_by");
		$this->csModel->Publish_date = $this->input->post("Publish_date");


		// print($this->input->post("Fname"));
		// echo "Controller for save method";
		$response = $this->csModel->save_method_from_model();
		echo json_encode($response);
	}

	public function save_doc_status(){

		$this->csModel->Doc_ID = $this->input->post("Doc_name");
		$this->csModel->Description = $this->input->post("Description");


		// print($this->input->post("Fname"));
		// echo "Controller for save method";
		$response = $this->csModel->save_method_from_model();
		echo json_encode($response);
	}
	public function insert_acknowledgement(){

		$this->dsModel->dataID = $this->input->post("dataID");
		$this->dsModel->FacultyID = $this->input->post("FacultyID");
		$this->dsModel->Acknowledge = $this->input->post("Acknowledge");
		$this->dsModel->ForVerif = $this->input->post("ForVerif");
		$this->dsModel->ForVerifReason = $this->input->post("ForVerifReason");
		// print($this->input->post("Fname"));
		// echo "Controller for save method";
		$response = $this->dsModel->insert_acknowledgement();
		echo json_encode($response);
	}
}
