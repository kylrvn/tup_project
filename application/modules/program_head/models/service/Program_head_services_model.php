<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class Program_head_services_model extends CI_Model
{
    public $ID;
    public $Table;

    public function __construct()
    {
        parent::__construct();
        $this->session = (object) get_userdata(USER);

        // if(is_empty_object($this->session)){
        // 	redirect(base_url().'login/authentication', 'refresh');
        // }

        $model_list = [];
        $this->load->model($model_list);
        $this->Table = json_decode(TABLE);
    }

    public function approve_dtr_schedule()
    {
        // var_dump($this->data);

        try {
                foreach($this->postData as $key => $data){
                    $dataArray = array(
                        'Acknowledged' => 2
                    );
                    $this->db->trans_start();
                        $this->db->where('FacultyID', $data['facultyID']);
                        $this->db->where('ID', $data['dataID']);
                        $this->db->update($this->Table->acknowledge, $dataArray);
    
                        $this->db->trans_complete();
                }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => "Update Successful", 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }
}