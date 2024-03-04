<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan_service extends MY_Controller
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
			'scan/service/Scan_services_model' => 'csModel'
		];
		$this->load->model($model_list);
	}
public function check_validation(){
	$this->csModel->Faculty_id = $this->input->post("faculty_no");
	

	$response=$this->csModel->check_validation();
	echo json_encode($response);
}

public function search(){
	$this->csModel->Search_text = $this->post("Search_text");
	
	$this->data['details'] = $this->csModel->search();
	$this->data['content'] = 'grid/load_list';
	$this->load->view('layout', $this->data);
}
	

	
}
