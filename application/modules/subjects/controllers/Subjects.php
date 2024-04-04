<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subjects extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		$model_list = [
			'subjects/Subjects_model' => 'sModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['departments'] = $this->sModel->get_departments();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function load_subjects()
	{
		$this->data['details'] = $this->sModel->get_subjects();
		$this->data['content'] = 'grid/load_subjects';
		$this->load->view('layout', $this->data);
	}

}