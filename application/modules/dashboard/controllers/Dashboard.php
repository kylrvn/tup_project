<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		$model_list = [
			'dashboard/Dashboard_model' => 'cModel',
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
	
	public function get_calendar(){
		$this->data['details'] = $this->  cModel->get_schedule();
		$this->data['content'] = 'grid/load_calendar';
		$this->load->view('layout',$this->data);
	}
	public function get_account(){
		$this->data['content'] = 'grid/load_account';
		$this->load->view('layout',$this->data);
	}
}
