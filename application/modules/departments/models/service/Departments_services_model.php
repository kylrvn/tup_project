<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Departments_services_model extends CI_Model
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

    public function add_dept()
    {
        try {

            $data = array
            (
                'department_name' => $this->dept_name,
                'status' => $this->status,
            );

            if($this->status == null || empty($this->status)){
                return (array('message' => "Select Status", 'has_error' => true));
            }

            $this->db->trans_start();

            $this->db->insert($this->Table->department, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

    public function update_dept(){
        try {
            $data = array
            (
                'department_name' => $this->department_name,
                'status' => $this->department_status,
            );

            if($this->department_status == null || empty($this->department_status)){
                return (array('message' => "Select Status", 'has_error' => true));
            }

            $this->db->trans_start();

            $this->db->where("ID", $this->ID);
            $this->db->update($this->Table->department, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

}