<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		$model_list = [
			'schedule/Schedule_model' => 'sModel',
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
	
	public function load_faculty(){
		$this->data['details'] = $this->sModel->get_faculty();
		$this->data['content'] = 'grid/load_faculty_table';
		$this->load->view('layout',$this->data);
	}

	public function load_calendar(){
		$this->sModel->faculty_id = $this->input->post('faculty_id');
		$this->data['details'] = $this->sModel->get_schedule();
		$this->data['content'] = 'grid/load_sched_calendar';
		$this->load->view('layout',$this->data);
	}
}
