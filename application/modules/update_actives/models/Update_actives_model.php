<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Update_actives_model extends CI_Model
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

    public function update_current_actives(){
        // var_dump($this->session->term_data->active_term);
        try {
            $data = array(
                'active_term' => $this->active_term,
                'active_school_year' => $this->active_school_year,
            );

            $this->db->trans_start();

            $this->db->where('ID', '1');
            $this->db->update($this->Table->active_term, $data);

            $this->session->term_data->active_term = $this->active_term;
            $this->session->term_data->active_school_year = $this->active_school_year;

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => "Active Term and School Year Updated", 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

}