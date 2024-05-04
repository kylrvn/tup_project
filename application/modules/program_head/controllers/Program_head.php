<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Program_head extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		$model_list = [
			'program_head/Program_head_model' => 'pModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['session'] =  $this->session;
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function load_dtr_schedule()
	{
		// var_dump($this->cModel->get_schedule());
		$this->data['session'] =  $this->session;
		$this->data['details'] = $this->pModel->get_faculty();
		
		$this->data['content'] = 'grid/load_grid';
		$this->load->view('layout', $this->data);
	}
	public function load_calendar(){
		$this->pModel->faculty_id = $this->input->post('faculty_id');
		$this->data['details'] = $this->pModel->get_schedule();
		$this->data['content'] = 'grid/load_sched_calendar';
		$this->load->view('layout',$this->data);
	}
	public function get_dtr(){
		$this->pModel->faculty_id = $this->input->post('faculty_id');
		$data = $this->pModel->get_dtr();
		$this->data['details'] =  $data['query'];
		$this->data['results'] =  $data['result'];
		// echo json_encode($this->data['details']);
		$this->data['content'] = 'grid/load_dtr_schedule';
		$this->load->view('layout', $this->data);
	}

	public function approve_schedule(){
		$this->pModel->facultyID = $this->input->post('facultyID');
		$this->pModel->schoolYear = $this->input->post('schoolYear');
		$this->pModel->schoolTerm = $this->input->post('schoolTerm');
		$response = $this->pModel->approve_schedule();
		echo json_encode($response);
	}


}