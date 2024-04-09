<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Subjects_services_model extends CI_Model
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

    public function add_subject()
    {
        try {

            $data = array
            (
                'Subject_name' => $this->subject_name,
                'color' => $this->color,
                'Department' => $this->department,
                'Active' => $this->status,
            );

            $this->db->trans_start();

            $this->db->insert($this->Table->subjects, $data);

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

    public function update_subject()
    {
        try {

            $data = array
            (
                'Subject_name' => $this->subject_name,
                'color' => $this->color,
                'Department' => $this->department,
                'Active' => $this->status,
            );

            $this->db->trans_start();

            $this->db->where("ID", $this->ID);
            $this->db->update($this->Table->subjects, $data);

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