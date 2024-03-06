<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reports_services_model extends CI_Model
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

    // public function save_method_from_model(){
    //     try{     
    //         // if(
    //         //     empty($this->Doc_name) || 
    //         //     empty($this->Description) || 
    //         //     empty($this->Category_ID)){
    //         //     throw new Exception(MISSING_DETAILS, true);
    //         // }   
            
    //         $data = array(
    //             'Doc_name' => $this->Doc_name,
    //             'Description' => $this->Description,
    //             'Category_ID' => $this->Category_ID,
    //             'Remarks' => $this->Remarks,
    //             'Publish_by' => $this->Publish_by,
    //             'Publish_date' => $this->Publish_date,
    //             'Date_created' => date('Y-m-d H:i:s')
    //         );

    //         $this->db->trans_start();
                           
    //         $this->db->insert($this->Table->document,$data);

    //         $this->db->trans_complete();
    //         if ($this->db->trans_status() === FALSE)
    //         {                
    //             $this->db->trans_rollback();
    //             throw new Exception(ERROR_PROCESSING, true);	
    //         }else{
    //             $this->db->trans_commit();
    //             return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false);
    //         }
    //     }
    //     catch(Exception$msg){
    //         return (array('message'=>$msg->getMessage(), 'has_error'=>true));
    //     }
    // }

}