<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Subjects_model extends CI_Model
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

    public function get_subjects()
    {
        $this->db->select(
            's.Subject_name,' .
            's.color,' .
            's.Active,' .
            'd.department_name'
        );

        $this->db->from($this->Table->subjects . ' s');
        $this->db->join($this->Table->department . ' d', 's.Department = d.ID', 'left');

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_departments()
    {
        $this->db->select('*');
        $this->db->from($this->Table->department);

        $query = $this->db->get()->result();
        return $query;
    }

}