<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program_head_service extends MY_Controller
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
			'program_head/service/Program_head_services_model' => 'psModel'
		];
		$this->load->model($model_list);
	}

	public function approve_dtr_schedule(){
		$postData = $this->input->post('data');
		$this->psModel->postData = $postData;
		// foreach($postData as $key => $value){
		// 	$this->psModel->dataID = $value['dataID'];
		// 	$this->psModel->facultyID = $value['facultyID'];
		// 	echo json_encode($this->psModel->dataID.' '. $this->psModel->facultyID);
		// }
		$response = $this->psModel->approve_dtr_schedule();
		echo json_encode($response);
		
	}

}

