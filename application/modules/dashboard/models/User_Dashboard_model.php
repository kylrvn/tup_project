<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_Dashboard_model extends CI_Model
{
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

    public function get_documents(){
        $this->db->select('*');
        $this->db->from($this->Table->document);

        $query = $this->db->get()->result();
        
        return $query;
        


    }
    public function get_schedule(){
        $this->db->select('*');
        $this->db->where('Date >=',date('Y-m-d', strtotime('monday this week')));
        $this->db->where('Faculty_id', $this->session->ID);
        // $this->db->where('Date <=',date('Y-m-d', strtotime('sunday this week')));
        $this->db->from($this->Table->sched);

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
    public function filter_calendar(){
        $this->db->select('*');
        $this->db->from($this->Table->sched);
        $this->db->where('Date',$this->date);
        $this->db->where('Faculty_id', $this->session->ID);
        $query = $this->db->get()->result();

        // echo json_encode($query);
        return $query;
    }
    public function filter_dtr_logs(){
        $this->db->select('*');
        $this->db->from($this->Table->logs);
        $this->db->where("DATE(date_log)",$this->date);
        $this->db->where('FacultyID', $this->session->ID);
        $query = $this->db->get()->result();

        // echo json_encode($query);
        return $query;
    }
    public function get_acknowledgement_dtr_week(){
        $this->db->select('*');
        $this->db->from($this->Table->logs);
        $query = $this->db->get()->result();

        // echo json_encode($query);
        return $query;
    }
    public function get_user_details(){
        $this->db->select('*');
        $this->db->from($this->Table->user);
        $this->db->where('ID', $this->session->ID);
        $query = $this->db->get()->row();

        // echo json_encode($query);
        return $query;
    }
}

