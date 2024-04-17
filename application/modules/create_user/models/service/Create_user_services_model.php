<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Create_user_services_model extends CI_Model
{
    public $ID;
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

    public function save_method_from_model()
    {
        try {
            $U_ID = auth_token();
            $Defaultpassword = "123456";
            $locker = locker();
            $password = sha1(password_generator($Defaultpassword, $locker));

            $data = array
            (
                'Fname' => $this->fname,
                'Lname' => $this->lname,
                'Mname' => $this->mname,
                'Department' => $this->Department,
                'Address' => $this->Address,
                'Rank' => $this->Rank,
                'Faculty_number' => $this->Faculty_number,
                'Username' => $this->Username,
                'User_type' => $this->User_type,
                'Password' => $password,
                'Salt' => $locker,
                'Contact_Number' => $this->Contact_Number,
                'Suffix' => $this->Suffix,
                'U_ID' => $U_ID,
            );

            $this->db->trans_start();

            $this->db->insert($this->Table->user, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

    public function update_user()
    {
        try {

            $data = array
            (
                'Fname' => $this->fname,
                'Lname' => $this->lname,
                'Mname' => $this->mname,
                'Department' => $this->Department,
                'Address' => $this->Address,
                'Rank' => $this->Rank,
                'Faculty_number' => $this->Faculty_number,
                'Username' => $this->Username,
                'User_type' => $this->User_type,
                'Contact_Number' => $this->Contact_Number,
                'Suffix' => $this->Suffix,
            );

            $this->db->trans_start();

            $this->db->where('ID', $this->ID);
            $this->db->update($this->Table->user, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

    public function add_dept()
    {
        try {

            $data = array
            (
                'department_name' => $this->dept_name,
                'status' => $this->status,
            );

            $this->db->trans_start();

            $this->db->insert($this->Table->department, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }
}