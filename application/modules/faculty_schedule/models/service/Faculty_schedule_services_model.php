<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Faculty_schedule_services_model extends CI_Model
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

    public function save_schedule()
    {
        $start_time = $this->start_time;
        $start_hour = (int) substr($start_time, 0, 2);
        $start_period = ($start_hour < 12) ? 'AM' : 'PM';

        $end_time = $this->end_time;
        $end_hour = (int) substr($end_time, 0, 2);
        $end_period = ($end_hour < 12) ? 'AM' : 'PM';

        if($start_period == 'AM'){
            $start_time_am = $this->start_time;
            $start_time_pm = null;
        }
        else{
            $start_time_am = null;
            $start_time_pm = $this->start_time;
        }

        if($end_period == 'AM'){
            $end_time_am = $this->end_time;
            $end_time_pm = null;
        }
        else{
            $end_time_am = null;
            $end_time_pm = $this->end_time;
        }

        if($start_period == 'AM'){
            $subject_am = $this->subject;
            $subject_pm = null;
        }
        else{
            $subject_am = null;
            $subject_pm = $this->subject;
        }

        try {

            $data = array(
                'Faculty_id' => $this->faculty_id,

                'Subject_am' => $subject_am,
                'Subject_pm' => $subject_pm,

                'Room' => $this->room,
                'Day' => $this->day,

                'Start_time_am' => $start_time_am,
                'End_time_am' => $end_time_am,
                'Start_time_pm' => $start_time_pm, 
                'End_time_pm' => $end_time_pm,
            );

            $this->db->trans_start();

            $this->db->insert($this->Table->sched, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return(array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }


    public function update_schedule()
    {
        try {
            // if(
            //     empty($this->Money) || 
            //     empty($this->Lname) || 
            //     empty($this->Cnum)){
            //     throw new Exception(MISSING_DETAILS, true);
            // }   

            $data = array(
                'Subject' => $this->subject,
                'Room' => $this->room,
                'Day' => $this->day,
                'Start_time' => $this->start_time,
                'End_time' => $this->end_time,
            );

            $this->db->trans_start();
            $this->db->where('ID', $this->ID);
            $this->db->update($this->Table->sched, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return(array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

    public function delete()
    {
        try {

            $data = array(
                'Active' => "0",

            );

            $this->db->trans_start();
            $this->db->where('ID', $this->sched_id);
            $this->db->update($this->Table->sched, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => DELETED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return(array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

    public function update()
    {
        try {
            // if(empty($this->Fname) || empty($this->Lname)){
            //     throw new Exception(MISSING_DETAILS, true);
            // }      

            $data = array(
                'Faculty_id' => $this->faculty_id,
                'Subject' => $this->subject,
                'Room' => $this->room,
                'Day' => $this->day,
                'Start_time' => $this->start_time,
                'End_time' => $this->end_time
            );

            $this->db->trans_start();
            $this->db->where('ID', $this->ID);
            $this->db->update($this->Table->sched, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return(array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }
}