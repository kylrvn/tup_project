<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Scan_services_model extends CI_Model
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
    public function check_validation(){

        $time_in_am;
        $time_out_am;
        $time_in_pm;
        $time_out_pm;
        $Date_time;

        try{
            // if(
            //     empty($this->faculty_no)){
            //     throw new Exception(MISSING_DETAILS, true);
            //     }
                // $data = array(
                //     'Faculty_id' => $this->faculty_no,
                // );
                // $this->db->trans_start();
                // $this->db->insert($this->Table->scan,$data);
                // $this->db->trans_complete();
                // if ($this->db->trans_status()===FALSE)
                // {
                //     $this->db->trans_rollback();
                //     throw new Exception(ERROR_PROCESSING, true);
            //     }
                if(!empty($this->Faculty_id)){
                    // var_dump(date('m-d-Y'));
                    $this->db->select('*');
                    $this->db->from($this->Table->user);
                    $this->db->where('Faculty_number', $this->Faculty_id);
                    $this->db->where('Date_time', date('m-d-Y'));
                    $query = $this->db->get()->row();
                    if(!empty($query)){
                        if ($query->Faculty_number==$this->Faculty_id){
                            $data = array(
                                'Faculty_id' =>$this->Faculty_id,
                                'Date_time' =>date('m-d-Y'),
                            );
                            $this->db->trans_start();
                            $this->db->insert($this->Table->scan,$data);
                            $this->db->trans_complete();
                            if ($this->db->trans_status()===FALSE)
                            {
                                $this->db->trans_rollback();
                                throw new Exception(ERROR_PROCESSING, true);
                        }
                        else
                        {
                            $this->db->trans_commit();
                            return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false);
                        }
                            // $this->store($query->Faculty_id);
                        //  echo json_encode("Matched");   
                        }
                    
                    }
                    else {
                        $data = array(
                            'Faculty_id' =>$this->Faculty_id,
                            'Date_time' =>date('m-d-Y'),
                        );
                        $this->db->trans_start();
                        $this->db->update($this->Table->scan,$data);
                        $this->db->trans_complete();
                        
                    }
                }
                else {
                    echo json_encode("Error");  
                    // $this->db->trans_commit();
                    // return array ('message' => SAVED_SUCCESSFUL, 'has_error'=>false);
                }

        }
        catch(Exception$msg){
            return (array('message'=>"error", 'has_error'=>true));
        }
    }
    public function store($Faculty_id){
        $F_id=$Faculty_id;
        $data = array(
            'Faculty_id' =>$F_id,
        );
        $this->db->trans_start();
        $this->db->insert($this->Table->scan,$data);
        $this->db->trans_complete();
        if ($this->db->trans_status()===FALSE)
        {
            $this->db->trans_rollback();
            throw new Exception(ERROR_PROCESSING, true);
    }
    }
    public function search(){
        try{

            $this->db->select('*');
            $this->db->where('faculty_no', $this->Search_text);
            $this->db->from($this->Table->scan);
            
            $query = $this->db->get()->result();
            var_dump($query);

        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }
}