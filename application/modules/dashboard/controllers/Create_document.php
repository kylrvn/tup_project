<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Create_document extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		$model_list = [
			'create_document/Create_document_model' => 'cModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		// $this->data['session'] =  $this->session;
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}
	
	public function get_documents(){
		$ID = $this->uri->segment(3);
		$this->cModel->ID = $ID;
		
		$this->data['details'] = $this->cModel->get_documents();
		$this->data['content'] = 'grid/load_list';
		$this->load->view('layout',$this->data);
	}
}
