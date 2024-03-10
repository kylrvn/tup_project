<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Schedule_model extends CI_Model
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

    public function get_faculty()
    {
        $this->db->select('*');
        $this->db->from($this->Table->user);

        if($this->session->User_type == "faculty"){
            $this->db->where('ID', $this->session->ID);
        }
        else if($this->session->User_type == "HR"){
            // Do nothing
        }
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_schedule()
    {
        $this->db->select('*');
        $this->db->from($this->Table->sched);
        $this->db->where('Faculty_id', $this->faculty_id);
        
        $query = $this->db->get()->result();

        return $query;
    }
}
