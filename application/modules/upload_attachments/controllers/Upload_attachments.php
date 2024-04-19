<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_attachments extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		$model_list = [
			'upload_attachments/Upload_attachment_model' => 'uModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['leave_type'] = $this->uModel->retrieve_leave_type();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

}
