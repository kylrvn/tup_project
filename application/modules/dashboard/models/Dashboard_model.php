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

    public function get_documents(){
        $this->db->select('*');
        $this->db->from($this->Table->document);

        $query = $this->db->get()->result();
        
        return $query;
        


    }
    public function get_schedule(){
        $this->db->select('*');
        $this->db->where('Date >=',date('Y-m-d', strtotime('monday this week')));
        $this->db->where('Date <=',date('Y-m-d', strtotime('sunday this week')));
        $this->db->from($this->Table->sched);

        $query = $this->db->get()->result();
        
        return $query;
    }
}

