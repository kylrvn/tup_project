<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_Dashboard_services_model extends CI_Model
{
    public $ID;
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

    public function update_user_details(){
        try{     
            // if(
            //     empty($this->Doc_name) || 
            //     empty($this->Description) || 
            //     empty($this->Category_ID)){
            //     throw new Exception(MISSING_DETAILS, true);
            // }   
            
            $data = array(
                'Fname' => $this->fname,
                'Lname' => $this->lname,
                'Mname' => $this->mname,
                'Suffix' => $this->suffix,
                'Department' => $this->department,
                'Age' => $this->age,
                'Address' => $this->address,
                'Contact_Number' => $this->conNo,
                'Estatus' => $this->eStatus,
                'Rank' => $this->position,
                'User_type' => $this->eType,
                'Email' => $this->email
            );

            $this->db->trans_start();
            $this->db->where('ID', $this->FacultyID);               
            $this->db->update($this->Table->user,$data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }
    
}