<?php
defined('BASEPATH') or exit ('No direct script access allowed');
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
        // var_dump($this->data);

        try {
            foreach ($this->data as $key => $value) {

                $data = array(
                    'Faculty_id' => $this->faculty_id,

                    'time_frame' => $value['time_frame'],

                    'Subject' => $value['subject'],

                    'Room' => $value['room'],
                    'Day' => $value['day'],

                    'Start_time' => $value['start_time'],
                    'End_time' => $value['end_time'],
                );

                if (
                    empty ($value['day']) || $value['day'] == "" &&
                    empty ($value['time_frame']) || $value['time_frame'] == "" &&
                    empty ($value['start_time']) || $value['start_time'] == "" &&
                    empty ($value['end_time']) || $value['end_time'] == "" &&
                    empty ($value['subject']) || $value['subject'] == "" &&
                    empty ($value['room']) || $value['room'] == ""
                ) {
                    // Do Nothing
                } else {
                    $this->db->trans_start();

                    $this->db->insert($this->Table->sched, $data);

                    $this->db->trans_complete();
                }

            }
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

    public function update_schedule()
    {
        try {

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
            return (array('message' => $msg->getMessage(), 'has_error' => true));
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
            return (array('message' => $msg->getMessage(), 'has_error' => true));
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
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }
}