<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Create_document_model extends CI_Model
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
}
