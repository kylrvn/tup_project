<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);
		$this->load->library('calendar');

		$model_list = [
			'schedule/Schedule_model' => 'sModel',
		];
		$this->load->model($model_list);
	}

	/** load main page 
										   
										   
											   
											   */
	public function index()
	{
		$this->data['session'] =  $this->session;
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function non_working_calendar()
	{
		$this->data['session'] =  $this->session;
		$this->data['content'] = 'non_working_days';
		$this->load->view('layout', $this->data);
	}

	public function exam_schedule()
	{
		$this->data['session'] =  $this->session;
		$this->data['calendar'] = $this->load->view('grid/calendar_view', NULL, TRUE); // Load the calendar view and pass it as data
		$this->data['content'] = 'exam_schedule';
		$this->load->view('layout', $this->data);
	}

	public function load_faculty()
	{
		$this->data['details'] = $this->sModel->get_faculty();
		$this->data['content'] = 'grid/load_faculty_table';
		$this->load->view('layout', $this->data);
	}

	public function load_dynamic_calendar()
	{
		$this->data['content'] = 'grid/load_dynamic_sched_calendar';
		$this->load->view('layout', $this->data);
	}

	public function load_calendar()
	{
		$this->sModel->faculty_id = $this->input->post('faculty_id');
		$this->data['details'] = $this->sModel->get_schedule();
		echo json_encode($this->data['details']);
	}


	public function load_faculty_list()
	{
		$this->data['loaded_from'] = $this->uri->segment(3);

		$this->data['details'] = $this->sModel->get_faculty_all();
		$this->data['content'] = 'grid/load_faculty_table';
		$this->load->view('layout', $this->data);
	}

	public function load_exam_schedule()
	{
		$this->data['faculty_id'] = $this->input->post('ID');
		$this->data['department_id'] = $this->input->post('dept_ID');

		$this->data['calendar'] = $this->load->view('grid/calendar_view', NULL, TRUE); // Load the calendar view and pass it as data
		$this->data['content'] = 'grid/load_exam_schedule';
		$this->load->view('layout', $this->data);
	}


}