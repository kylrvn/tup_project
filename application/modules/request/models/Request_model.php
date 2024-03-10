<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Request_model extends CI_Model
{
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

    public function get_files()
    {
        $this->db->select(
            'fa.*,' .
            'u.Fname,' .
            'u.Lname,' .
            'u.Mname,'
        );
        $this->db->from($this->Table->file_attachments . ' fa');
        $this->db->join($this->Table->user . ' u', 'u.ID = fa.FacultyID', 'left');

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_file_to_view()
    {
        $this->db->select('Filename, Date_Uploaded');
        $this->db->from($this->Table->file_attachments);
        $this->db->where('ID', $this->ID);
        $query = $this->db->get()->row();

        return $query;
    }

    public function verify_request()
    {
        try {

            $data = array(
                'verified' => "1",
            );

            $this->db->trans_start();

            $this->db->where('ID', $this->ID);
            $this->db->update($this->Table->file_attachments, $data);


            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return(array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

}
