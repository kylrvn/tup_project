<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_model extends CI_Model
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

    public function get_documents()
    {
        $this->db->select('*');
        $this->db->from($this->Table->document);

        $query = $this->db->get()->result();

        return $query;
    }
    public function get_schedule()
    {
        $this->db->select('*');
        $this->db->from($this->Table->active_term);
        $active_term = $this->db->get()->row();

        $this->db->select('*');
        // $this->db->where('Date >=',date('Y-m-d', strtotime('monday this week')));
        $this->db->where('Active', 1);
        $this->db->where('Faculty_id', $this->session->ID);
        $this->db->where('school_term', $active_term->active_term);
        $this->db->where('school_year', $active_term->active_school_year);

        // $this->db->where('Date <=',date('Y-m-d', strtotime('sunday this week')));
        $this->db->from($this->Table->sched);

        $query = $this->db->get()->result();

        return $query;
        // echo json_encode($query);
    }
    public function get_exam_schedule()
    {
        $this->db->select('*');
        $this->db->from($this->Table->active_term);
        $active_term = $this->db->get()->row();

        $this->db->select('*');
        // $this->db->where('Date >=',date('Y-m-d', strtotime('monday this week')));
        // $this->db->where('Faculty_id', $this->session->ID);
        // $this->db->where('Date <=',date('Y-m-d', strtotime('sunday this week')));
        $this->db->where('term', $active_term->active_term);
        $this->db->where('school_year', $active_term->active_school_year);
        $this->db->from($this->Table->exam_schedule);

        $query = $this->db->get()->result();

        return $query;
    }
    public function get_exam_schedule_filter()
    {
        $this->db->select('*');
        $this->db->from($this->Table->active_term);
        $active_term = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from($this->Table->exam_schedule);
        $this->db->where('from_date', date('Y-m-d', strtotime($this->date)));
        $this->db->or_where('to_date', date('Y-m-d', strtotime($this->date)));
        $this->db->where('term', $active_term->active_term);
        $this->db->where('school_year', $active_term->active_school_year);


        // $this->db->where('Faculty_id', $this->session->ID);
        // $this->db->where('Date <=',date('Y-m-d', strtotime('sunday this week')));


        $query = $this->db->get()->result();
        // echo json_encode($query);
        return $query;
    }
    public function get_dtr_logs()
    {
        // $this->db->select('*');
        // $this->db->from($this->Table->active_term);
        // $active_term = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from($this->Table->logs);
        // $this->db->where('timein_am !=', NULL);
        // $this->db->where('timeout_am !=', NULL);
        // $this->db->where('timein_pm !=', NULL);
        // $this->db->where('timeout_pm !=', NULL);
        $this->db->where('FacultyID', $this->session->ID);
        // $this->db->where('school_term', $active_term->active_term);
        // $this->db->where('school_year', $active_term->active_school_year);
        $query = $this->db->get()->result();
        return $query;
        // echo json_encode($query);
    }
    public function filter_calendar()
    {
        $this->db->select('*');
        $this->db->from($this->Table->active_term);
        $active_term = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from($this->Table->sched);
        $this->db->where('Day', strtolower(date('l', strtotime($this->date))));
        // $this->db->where('Date',strtolower(date('Y-m-d',strtotime($this->date))));
        $this->db->where('Faculty_id', $this->session->ID);
        $this->db->where('school_term', $active_term->active_term);
        $this->db->where('school_year', $active_term->active_school_year);
        $query = $this->db->get()->result();

        // echo json_encode($query);
        return $query;
    }
    public function filter_dtr_logs()
    {
        // $this->db->select('*');
        // $this->db->from($this->Table->active_term);
        // $active_term = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from($this->Table->logs);
        $this->db->where("DATE(date_log)", $this->date);
        $this->db->where('FacultyID', $this->session->ID);
        // $this->db->where('school_term', $active_term->active_term);
        // $this->db->where('school_year', $active_term->active_school_year);
        $query = $this->db->get()->result();

        // echo json_encode($query);
        return $query;
    }
    public function get_acknowledgement_dtr_week()
    {
        $this->db->select('*');
        $this->db->from($this->Table->logs);
        $query = $this->db->get()->result();

        // echo json_encode($query);
        return $query;
    }
    public function get_user_details()
    {
        $this->db->select('*');
        $this->db->from($this->Table->user);
        $this->db->where('ID', $this->session->ID);
        $query = $this->db->get()->row();

        // echo json_encode($query);
        return $query;
    }
    public function get_approved()
    {
        $this->db->select('*');
        $this->db->from($this->Table->acknowledge);
        $this->db->where('Acknowledged', 1);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_records_forverif()
    {
        $this->db->select('*');
        $this->db->from($this->Table->acknowledge);
        $this->db->where('ForVerif', 1);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_qr_data($ID)
    {
        $this->db->select('qr');
        $this->db->where('fID', $ID);
        $this->db->from($this->Table->qr);
        $query = $this->db->get()->row();
        return $query;
    }
}
