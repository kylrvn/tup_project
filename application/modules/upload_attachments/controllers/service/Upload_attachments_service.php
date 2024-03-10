<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_attachments_service extends MY_Controller
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
			'upload_attachments/service/Upload_attachment_services_model' => 'usModel'
		];
		$this->load->model($model_list);
	}

	public function upload_file_attachment()
	{
		$this->usModel->Date_Uploaded = $this->input->post("date");
		$this->usModel->Concern_Type = $this->input->post("concernType");
		$this->usModel->FacultyID = $this->session->ID;
		
		 // Handle file upload
		 $config['upload_path'] = 'assets/uploads/'; // Directory path where you want to store the uploaded files
		 $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx'; // Allowed file types
		 $config['max_size'] = 10240; // Maximum file size in kilobytes (10 MB)
		 $config['file_name'] = $this->usModel->FacultyID.'_'.$this->usModel->Date_Uploaded.'_'.uniqid(); // Unique file name
		 
		 $this->load->library('upload', $config);
		 
		 if (!$this->upload->do_upload('file')) {
			 // If file upload fails, return error message
			 $error = array('error' => $this->upload->display_errors());
			 echo json_encode($error);
		 } else {
			 // If file upload succeeds, retrieve file data
			 $file_data = $this->upload->data();
			 $filename = $file_data['file_name']; // Retrieve the uploaded file name
			 $this->usModel->Filename = $filename;
			 $response = $this->usModel->upload_file_attachment();
			 echo json_encode($response);
		 }
		 
	 }
	}
	

