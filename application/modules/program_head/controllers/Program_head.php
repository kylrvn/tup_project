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
		// $this->data['subjects'] = $this->pModel->get_subjects();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function load_dtr_schedule()
	{
		// var_dump($this->cModel->get_schedule());
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
	// public function get_calendar(){
	// 	$this->data['details'] = $this->pModel->get_schedule();
	// 	$this->data['dtr_logs'] = $this->pModel->get_dtr_logs();
	// 	// echo json_encode($this->data['dtr_logs']);
	// 	$this->data['content'] = 'grid/load_calendar';
	// 	$this->load->view('layout',$this->data);
	// }
	// public function get_subjects()
	// {
	// 	$response = $this->pModel->get_subjects();
	// 	echo json_encode($response);
	// }


}