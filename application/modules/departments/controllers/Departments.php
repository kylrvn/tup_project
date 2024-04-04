<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departments extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		$model_list = [
			'departments/Departments_model' => 'dModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['departments'] = $this->dModel->get_departments();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function load_departments()
	{
		$this->data['details'] = $this->dModel->get_departments();
		$this->data['content'] = 'grid/load_departments';
		$this->load->view('layout', $this->data);
	}

}