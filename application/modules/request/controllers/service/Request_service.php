<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_service extends MY_Controller
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
			'request/service/Request_services_model' => 'rsModel'
		];
		$this->load->model($model_list);
	}


	

	// public function save_doc(){

	// 	$this->csModel->Doc_name = $this->input->post("Doc_name");
	// 	$this->csModel->Description = $this->input->post("Description");
	// 	$this->csModel->Category_ID = $this->input->post("Category_ID");
	// 	$this->csModel->Remarks = $this->input->post("Remarks");
	// 	$this->csModel->Publish_by = $this->input->post("Publish_by");
	// 	$this->csModel->Publish_date = $this->input->post("Publish_date");


	// 	// print($this->input->post("Fname"));
	// 	// echo "Controller for save method";
	// 	$response = $this->csModel->save_method_from_model();
	// 	echo json_encode($response);
	// }

}
