<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Create_user extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		$model_list = [
			'create_user/Create_user_model' => 'cModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['departments'] = $this->cModel->get_departments();
		$this->data['ranks'] = $this->cModel->get_ranks();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function load_users()
	{
		$this->data['details'] = $this->cModel->get_users();
		$this->data['content'] = 'grid/load_users';
		$this->load->view('layout', $this->data);
	}

}