<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update_actives_service extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object) get_userdata(USER);

		// if(is_empty_object($this->session)){
		// 	redirect(base_url().'login/authentication', 'refresh');
		// }

		$model_list = [
			'update_actives/service/Update_actives_model_services_model' => 'uaModel'
		];
		$this->load->model($model_list);
	}

}