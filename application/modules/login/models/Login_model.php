<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login_model extends CI_Model
{
    public $Username;
    public $Password;
    public $Table;

    public function __construct()
    {
        parent::__construct();
        $model_list = [];
        $this->load->model($model_list);
        $this->Table = json_decode(TABLE);
    }
    public function authentication()
    {

        try {

            if (empty($this->username) || empty($this->password)) {
                throw new Exception(REQUIRED_FIELD);
            }
            $from = 'admin';
            $this->db->select('*');
            $this->db->from($this->Table->user);
            $this->db->where('Username', $this->username);
            $query = $this->db->get()->row();

            $this->db->select('*');
            $this->db->from($this->Table->active_term);
            $term_data = $this->db->get()->row();

            $query->term_data = $term_data;
            
            // if($query->Active == 0){
            //     throw new Exception(DISABLED_ACCOUNT, true);
            // }
            
            // if(empty($query->Branch)){
            //     $userAgent = $_SERVER['HTTP_USER_AGENT'];

            //     if (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false || strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'Tablet') !== false || strpos($userAgent, 'iPad') !== false) {
            //         // It's a mobile device
            //         throw new Exception(MOBILE_DEVICE);
            //     } 
            // }

            if(empty($query)){
                throw new Exception(NO_ACCOUNT, true);
            }
            if($query->Password !== sha1(password_generator($this->password,$query->Salt)) ){
                throw new Exception(NOT_MATCH, true);
            }

            set_userdata(USER,(array)$query);
            $this->session = (object)get_userdata(USER);

            return array('has_error' => false, 'message' => 'Login Success', 'session' => $this->session);
        } catch (Exception $ex) {
            return array('error_message' => $ex->getMessage(), 'has_error' => true);
        }
    }

}