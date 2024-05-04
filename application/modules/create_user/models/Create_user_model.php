<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Create_user_model extends CI_Model
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

    public function get_departments()
    {
        $this->db->select('*');
        $this->db->from($this->Table->department);

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_ranks()
    {
        $this->db->select('*');
        $this->db->from($this->Table->ranks);

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_users()
    {
        $user_type_filter = ["1", "2", "3"];

        $this->db->select(
            'u.*,' .
            'd.department_name,'
        );
        $this->db->from($this->Table->user . ' u');
        $this->db->join($this->Table->department . ' d', 'u.Department = d.ID', 'left');
        $this->db->where_in('u.User_type', $user_type_filter);

        $query = $this->db->get()->result();
        return $query;
    }

}