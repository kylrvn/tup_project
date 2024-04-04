<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class Program_head_model extends CI_Model
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

    public function get_dtr()
    {
        // var_dump($this->session);
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->acknowledge);
        $this->db->where('Acknowledged', '1');
        $this->db->where('FacultyID', $this->faculty_id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_faculty()
    {
        // var_dump($this->session);
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->user);
        // $this->db->where('Acknowledged', '1');
        // $this->db->where('FacultyID', $this->session->ID);
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
    public function get_dtr_logs(){
        $this->db->select('*');
        $this->db->from($this->Table->logs);
        $this->db->where('timein_am !=', NULL);
        $this->db->where('timeout_am !=', NULL);
        // $this->db->where('timein_pm !=', NULL);
        // $this->db->where('timeout_pm !=', NULL);
        $this->db->where('FacultyID', $this->session->ID);
        $query = $this->db->get()->result();
        return $query;
        // echo json_encode($query);
    }
    
}