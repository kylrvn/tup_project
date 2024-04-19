<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		$model_list = [
			'request/Request_model' => 'rModel',
		];
		$this->load->model($model_list);
	}

	/** load main page 
	
	
		
		*/
	public function index()
	{
		// $this->data['session'] =  $this->session;
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}
	
	public function load_files(){
		$dateFrom = null;
		$dateTo = null;
		if ($this->input->post('dateRange') != null){
			$parts = explode("-", $this->input->post('dateRange'));
			$dateFrom = trim($parts[0]);
			$dateTo = trim($parts[1]);
		}
		else{
			$dateFrom = null;
			$dateTo = null;
		}
		$this->rModel->dateFrom = $dateFrom;
		$this->rModel->dateTo = $dateTo;
		$this->data['details'] = $this->rModel->get_files();
		$this->data['content'] = 'grid/load_attachments';
		$this->load->view('layout',$this->data);
	}

	public function load_dtr_requests(){
		$this->data['details'] = $this->rModel->dtr_request_list();
		$this->data['content'] = 'grid/load_dtr_request';
		$this->load->view('layout',$this->data);
	}

	public function view_file(){
		$this->rModel->ID = $this->input->post('ID');
		$this->data['image'] = $this->rModel->get_file_to_view();
		$this->data['content'] = 'grid/view_file';
		$this->load->view('layout',$this->data);
	}

	public function verify_file(){
		$this->rModel->ID = $this->input->post('ID');

		$response = $this->rModel->verify_request();
		echo json_encode($response);
	}

}
