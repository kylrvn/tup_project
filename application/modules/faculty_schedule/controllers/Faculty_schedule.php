<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Faculty_schedule extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		$model_list = [
			'faculty_schedule/Faculty_schedule_model' => 'FsModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['subjects'] = $this->FsModel->get_subjects();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function load_grid()
	{
		// var_dump($this->cModel->get_schedule());
		$this->data['details'] = $this->FsModel->get_schedule();
		$this->data['content'] = 'grid/load_grid';
		$this->load->view('layout', $this->data);
	}

	public function get_subjects()
	{
		$response = $this->FsModel->get_subjects();
		echo json_encode($response);
	}


}