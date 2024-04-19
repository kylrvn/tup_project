<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update_actives extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		$model_list = [
			'update_actives/Update_actives_model' => 'uModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['session'] =  $this->session;
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function update_actives_data(){
		$this->uModel->active_term = $this->input->post('active_term');
		$this->uModel->active_school_year = $this->input->post('active_school_year');
		// var_dump($this->input->post('active_school_year'));
		$response = $this->uModel->update_current_actives();
		echo json_encode($response);
	}

}