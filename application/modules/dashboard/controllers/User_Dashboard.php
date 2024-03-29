<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Dashboard extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		$model_list = [
			'dashboard/User_Dashboard_model' => 'udModel',
		];
		$this->load->model($model_list);
	}

	/** load main page 
	
	
		
		*/
	public function index()
	{
		$this->data['session'] =  $this->session;
		$this->data['week_sched_dtr'] = $this->cModel->get_acknowledgement_dtr_week();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}
	
	public function get_calendar(){
		$this->data['details'] = $this->cModel->get_schedule();
		$this->data['dtr_logs'] = $this->cModel->get_dtr_logs();
		// echo json_encode($this->data['dtr_logs']);
		$this->data['content'] = 'grid/load_calendar';
		$this->load->view('layout',$this->data);
	}
	public function filter_calendar(){
		$this->cModel->date = $this->input->post('date');
		$this->data['details'] = $this->cModel->filter_calendar();
		$this->data['dtr_logs'] = $this->cModel->filter_dtr_logs();
		// echo json_encode($this->data['dtr_logs']);
		$calendar_html = $this->load->view('grid/load_calendar', $this->data, true); // Load the view with filtered data and capture it as a string
		echo $calendar_html; 
	}
	
	public function get_account(){
		$this->data['details'] = $this->cModel->get_user_details();
		$this->data['content'] = 'grid/load_account';
		$this->load->view('layout',$this->data);
	}
}
