<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Request_model extends CI_Model
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

    public function get_files()
    {
        $this->db->select(
            'fa.*,' .
            'u.Fname,' .
            'u.Lname,' .
            'u.Mname,' . 
            'lt.LeaveType,' 
        );
        $this->db->from($this->Table->file_attachments . ' fa');
        if ($this->dateFrom != null && $this->dateTo != null) {
            $this->db->where('Date_Uploaded >=', date('Y-m-d', strtotime($this->dateFrom)));
            $this->db->where('Date_Uploaded <=', date('Y-m-d', strtotime($this->dateTo)));
        }
        $this->db->join($this->Table->user . ' u', 'u.ID = fa.FacultyID', 'left');
        $this->db->join($this->Table->leave_type . ' lt', 'lt.ID = fa.Concern_Type', 'left');
        $this->db->order_by('fa.Date_Uploaded', 'DESC');
        $this->db->limit(10);

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_leaveType(){
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->leave_type);
        $query = $this->db->get()->result();

        return $query;
    }

    public function dtr_request_list()
    {
        $this->db->select(
            'a.*,' .
            'u.Fname,' .
            'u.Lname,' .
            'u.Mname,'
        );
        $this->db->from($this->Table->acknowledge . ' a');
        $this->db->where('a.ForVerif', 1);
        $this->db->join($this->Table->user . ' u', 'u.ID = a.FacultyID', 'left');
        $this->db->order_by('a.ID', 'DESC');
        $this->db->limit(10);

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_request_dtr()
    {
        $this->db->select(
            'l.*,' .
            'u.Fname,' .
            'u.Lname,' .
            'u.Mname,'
        );
        $this->db->from($this->Table->logs . ' l');
        $this->db->where('l.FacultyID', $this->facultyID);
        $this->db->where('l.date_log >=', date('Y-m-d', strtotime($this->dateFrom)));
        $this->db->where('l.date_log <=', date('Y-m-d', strtotime($this->dateTo)));
        $this->db->join($this->Table->user . ' u', 'u.ID = l.FacultyID', 'left');
        $this->db->order_by('l.date_log', 'ASC');

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_file_to_view()
    {
        $this->db->select('Filename, Date_Uploaded');
        $this->db->from($this->Table->file_attachments);
        $this->db->where('ID', $this->ID);
        $query = $this->db->get()->row();

        return $query;
    }

    public function verify_request()
    {
        try {

            $data = array(
                'verified' => "1",
            );

            $this->db->trans_start();

            $this->db->where('ID', $this->ID);
            $this->db->update($this->Table->file_attachments, $data);


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

    public function update_dtr_entry()
    {
        if ($this->time_in_am != null || !empty($this->time_in_am && $this->date_in_am != null || !empty($this->date_in_am))) {
            $formattedTime1 = date('H:i:s', strtotime($this->time_in_am));
            $formattedDate1 = date('Y-m-d', strtotime($this->date_in_am));
            $sql_datetime_in_am = $formattedDate1 . ' ' . $formattedTime1;
        }
        else{
            $sql_datetime_in_am = null;
        }

        if ($this->time_out_am != null || !empty($this->time_out_am && $this->date_out_am != null || !empty($this->date_out_am))) {
            $formattedTime2 = date('H:i:s', strtotime($this->time_out_am));
            $formattedDate2 = date('Y-m-d', strtotime($this->date_out_am));
            $sql_datetime_out_am = $formattedDate2 . ' ' . $formattedTime2;
        }
        else{
            $sql_datetime_out_am = null;
        }

        if ($this->time_in_pm != null || !empty($this->time_in_pm && $this->date_in_pm != null || !empty($this->date_in_pm))) {
            $formattedTime3 = date('H:i:s', strtotime($this->time_in_pm));
            $formattedDate3 = date('Y-m-d', strtotime($this->date_in_pm));
            $sql_datetime_in_pm = $formattedDate3 . ' ' . $formattedTime3;
        }
        else{
            $sql_datetime_in_pm = null;
        }

        if ($this->time_out_pm != null || !empty($this->time_out_pm && $this->date_out_pm != null || !empty($this->date_out_pm))) {
            $formattedTime4 = date('H:i:s', strtotime($this->time_out_pm));
            $formattedDate4 = date('Y-m-d', strtotime($this->date_out_pm));
            $sql_datetime_out_pm = $formattedDate4 . ' ' . $formattedTime4;
        }
        else{
            $sql_datetime_out_pm = null;
        }

        // var_dump($sql_datetime_out_pm);

        try{
            if($this->time_in_am != null || !empty($this->time_in_am && $this->date_in_am != null || !empty($this->date_in_am))){
                $formattedTime = date('H:i:s', strtotime($this->time_in_am));
                $formattedDate = date('Y-m-d', strtotime($this->date_in_am));
                $sql_datetime_in_am = $formattedDate . ' ' . $formattedTime;
            }

            $data = array(
                'timein_am' => $sql_datetime_in_am,
                'timeout_am' => $sql_datetime_out_am,
                'timein_pm' => $sql_datetime_in_pm,
                'timeout_pm' => $sql_datetime_out_pm,

                'date_updated' => date('Y-m-d')
            );

            $this->db->trans_start();

            $this->db->where('ID', $this->ID);
            $this->db->update($this->Table->logs,$data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>"Entry Updated Succesfully", 'has_error'=>false);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }

    public function verify_dtr_request(){
        try {

            $data = array(
                'ForVerifStatus' => "1",
            );

            $this->db->trans_start();

            $this->db->where('ID', $this->ID);
            $this->db->update($this->Table->acknowledge, $data);


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
