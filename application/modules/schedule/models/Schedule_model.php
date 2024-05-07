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
        $this->db->select(
            'u. *,' .
            'd. department_name,'
        );
        $this->db->from($this->Table->user . ' u');
        $this->db->join($this->Table->department . ' d', 'u.Department = d.ID', 'left');
        $this->db->join($this->Table->sched_verification . ' sv', 'u.ID = sv.facultyID', 'left');
        $this->db->group_by('u.ID');

        if ($this->session->User_type == "1" || $this->session->User_type == "2") {
            $this->db->where('u.ID', $this->session->ID);
        } else if ($this->session->User_type == "3") {
            $this->db->where('sv.verified', '1');
        }
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_faculty_all(){
        $this->db->select(
            'u.*,' .
            'd.department_name,' .
            'd.ID as department_id,' 
        );
        $this->db->from($this->Table->user . ' u');
        $this->db->join($this->Table->department . ' d', 'u.Department = d.ID', 'left');

        if ($this->session->User_type == "1" || $this->session->User_type == "2") {
            $this->db->where('u.ID', $this->session->ID);
        } else if ($this->session->User_type == "3" || $this->session->User_type == "4") {
            $this->db->where('u.Department', $this->session->Department);
        }
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_schedule()
    {
        $this->db->select(
            's.*,' .
            'su.Subject_name,' .
            'su.subject_code,' .
            'su.color,'.
            'u.Lname,'
        );
        $this->db->from($this->Table->sched . ' s');
        $this->db->where('s.Faculty_id', $this->faculty_id);
        $this->db->join($this->Table->subjects . ' su', 's.Subject = su.ID', 'left');
        $this->db->join($this->Table->user . ' u', 's.Faculty_id = u.ID', 'left');

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_all_events()
    {
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->non_working_days);
        $this->db->where("YEAR(from_date) =", date('Y'));

        $query = $this->db->get()->result();

        return $query;
    }
}