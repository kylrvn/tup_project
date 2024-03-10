<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Upload_attachment_services_model extends CI_Model
{
    public $ID;
    public $Table;

    public function __construct()
    {
        parent::__construct();
        $this->session = (object)get_userdata(USER);

        // if(is_empty_object($this->session)){
        // 	redirect(base_url().'login/authentication', 'refresh');
        // }

        $model_list = [];
        $this->load->model($model_list);
        $this->Table = json_decode(TABLE);
    }

    public function upload_file_attachment()
    {
       try{     
            $data = array
            (
               'FacultyID' => $this->FacultyID,
               'Date_Uploaded' => $this->Date_Uploaded,
               'Concern_Type' => $this->Concern_Type,
               'Filename' => $this->Filename
            );

            $this->db->trans_start();
                           
            $this->db->insert($this->Table->file_attachments,$data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }
            else
            {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        }
        catch(Exception$msg)
        {
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }
}