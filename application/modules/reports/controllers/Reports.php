<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		$model_list = [
			'reports/Reports_model' => 'rModel',
		];
		$this->load->model($model_list);
	}
	public function index()
	{
		// $this->data['session'] =  $this->session;
		$this->data['faculty'] = $this->rModel->get_faculty();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function load_dtr()
	{
		$this->rModel->month = $this->input->post('selected_month');
		$this->rModel->faculty = $this->input->post('selected_faculty');

		$this->data['details'] = $this->rModel->get_csf_48();
		// var_dump(@$this->rModel->get_csf_48());
		$this->data['content'] = 'grid/load_dtr';
		$this->load->view('layout', $this->data);
	}
	public function load_dtr_summary()
	{
		// $this->data['details'] = $this->  cModel->get_schedule();

		$this->rModel->month = $this->input->post('selected_month');
		$this->rModel->facultyType = $this->input->post('faculty_type');

		$this->data['details'] = $this->rModel->get_dtr_summary();

		if ($this->input->post('report_type') == "tard_undertime") {
			$this->data['content'] = 'grid/load_dtr_summary';
		} else if ($this->input->post('report_type') == "overload") {
			$this->data['content'] = 'grid/load_dtr_summary_overload';
		}
		$this->load->view('layout', $this->data);
	}

	public function load_deduction_summary()
	{
		$this->rModel->month = $this->input->post('selected_month');
		$this->rModel->facultyType = $this->input->post('facultyType');

		$this->data['details'] = $this->rModel->get_deduction_summary();
		$this->data['content'] = 'grid/load_deduction_summary';
		$this->load->view('layout', $this->data);
	}
}