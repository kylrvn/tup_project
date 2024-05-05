<?php
defined('BASEPATH') or exit('No direct script access allowed');

class QR extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		$model_list = [
			'qr/QR_model' => 'qModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}
	public function generate_qr(){
		// $this->data['details'] = $this->cModel->get_user_details();
		$this->data['content'] = 'generate_qr';
		$this->load->view('layout',$this->data);
	}
}