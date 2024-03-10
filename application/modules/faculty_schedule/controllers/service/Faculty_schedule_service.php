<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faculty_schedule_service extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		// if(is_empty_object($this->session)){
		// 	redirect(base_url().'login/authentication', 'refresh');
		// }

		$model_list = [
			'faculty_schedule/service/Faculty_schedule_services_model' => 'fsModel'
		];
		$this->load->model($model_list);
	}

	public function save_schedule(){

		$day_array = $this->input->post("day");
		$time_frame_array = $this->input->post("time_frame");
		$start_time_array = $this->input->post("start_time");
		$end_time_array = $this->input->post("end_time");
		$subject_array = $this->input->post("subject");
		$room_array = $this->input->post("room");

		$data = array_map(function ($day, $time_frame, $start_time, $end_time, $subject, $room) {
			return compact('day', 'time_frame', 'start_time', 'end_time', 'subject', 'room');
		}, $day_array, $time_frame_array, $start_time_array, $end_time_array, $subject_array, $room_array);

		$this->fsModel->faculty_id = $this->session->ID;
		$this->fsModel->data = $data;
	
		// var_dump($data);

		$response = $this->fsModel->save_schedule();
		echo json_encode($response);
	}

}

