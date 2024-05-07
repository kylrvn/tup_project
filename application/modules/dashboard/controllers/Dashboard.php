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
		$this->load->helper('file');
	}

	/** load main page 
	
	
		
	 */
	public function index()
	{
		$this->data['session'] =  $this->session;
		$this->data['week_sched_dtr'] = $this->cModel->get_acknowledgement_dtr_week();
		$this->data['approved'] = $this->cModel->get_approved();
		$this->data['forVerif'] = $this->cModel->get_records_forverif();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function get_calendar()
	{
		$this->data['details'] = $this->cModel->get_schedule();
		$this->data['exam_Schedule'] = $this->cModel->get_exam_schedule();
		$this->data['dtr_logs'] = $this->cModel->get_dtr_logs();
		// echo json_encode($this->data['dtr_logs']);
		$this->data['content'] = 'grid/load_calendar';
		$this->load->view('layout', $this->data);
	}
	public function filter_calendar()
	{
		$this->cModel->date = $this->input->post('date');
		if (!empty($this->cModel->date)) {
			$this->data['details'] = $this->cModel->filter_calendar();
			$this->data['dtr_logs'] = $this->cModel->filter_dtr_logs();
			$this->data['exam_Schedule'] = $this->cModel->get_exam_schedule_filter();
		} else {
			$this->data['details'] = $this->cModel->get_schedule();
			$this->data['dtr_logs'] = $this->cModel->get_dtr_logs();
			$this->data['exam_Schedule'] = $this->cModel->get_exam_schedule();
		}
		// echo json_encode($this->data['dtr_logs']);
		$calendar_html = $this->load->view('grid/load_calendar', $this->data, true); // Load the view with filtered data and capture it as a string
		echo $calendar_html;
	}

	public function get_account()
	{
		$this->data['details'] = $this->cModel->get_user_details();
		$this->data['content'] = 'grid/load_account';
		$this->load->view('layout', $this->data);
	}
	public function generate_qr()
	{
		$this->data['session'] = $this->session;
		$data_obj = $this->cModel->get_qr_data($this->session->ID);
		$qr_data = $data_obj->qr;
		// var_dump($qr_data);
		// Create QR code instance
		$qrCode = new \Endroid\QrCode\QrCode($qr_data);

		// // Write QR code to PNG format
		// $result = (new \Endroid\QrCode\Writer\PngWriter())->write($qrCode);

		$result = (new \Endroid\QrCode\Writer\PngWriter())->write($qrCode);

		// Save the image to a file (for debugging)
		// $file = 'qr_code.png';
		// file_put_contents($file, $result->getString());

		// Output the image
		header('Content-Type: ' . $result->getMimeType());
		echo $result->getString();
	}
	public function qr_faculty()
	{
		// $this->data['details'] = $this->cModel->get_user_details();
		// $data_obj = $this->cModel->get_qr_data($this->session->ID);
		// var_dump($data_obj);
		$this->data['session'] =  $this->session;
		$this->data['content'] = 'qr_faculty';
		$this->load->view('layout', $this->data);
	}
}
