<?php
defined('BASEPATH') or exit('No direct script access allowed');
class QR_model extends CI_Model
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

    public function get_faculty_list()
    {
        $this->db->select('*');
        $this->db->from($this->Table->user);
        $this->db->group_start();
        $this->db->where('User_type', 1);
        $this->db->or_where('User_type', 5);
        $this->db->group_end();
        $query = $this->db->get()->result();
        // var_dump($query);
        return $query;
    }
}
