<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Faculty_schedule_model extends CI_Model
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

    public function get_schedule()
    {
        // var_dump($this->session);
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->sched);
        $this->db->where('Active', '1');
        $this->db->where('Faculty_id', $this->session->ID);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_subjects()
    {
        $this->db->select(
            'Subject_name,' .
            'ID'
        );
        $this->db->from($this->Table->subjects);
        $this->db->where('Active', '1');
        $query = $this->db->get()->result();
        return $query;
    }

}