<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Schedule_services_model extends CI_Model
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

    public function save_exam_schedule()
    {
        try {

            $data = array(

                'faculty_id' => $this->faculty_id,
                'department_id' => $this->department_id,

                'term' => $this->term,
                'school_year' => $this->school_year,
                'from_date' => date('Y-m-d', strtotime($this->date_from)),
                'to_date' => date('Y-m-d', strtotime($this->date_to)),
            );

            $this->db->trans_start();

            $this->db->insert($this->Table->exam_schedule, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => "Exam Schedule Saved Successfuly", 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

    public function save_events()
    {
        try {

            // var_dump($this->eventsArray);

            $this->db->trans_start();

            foreach ($this->eventsArray as $key => $value) {

                // var_dump($value);
                $data = array(
                    'type' => $value["title"],
                    'from_date' => $value["start"],
                    'to_date' => ($value["end"] == "" ? null : $value["end"]),
                );

                // Check existing data
                $this->db->where('type', $data['type']);
                $this->db->where('from_date', $data['from_date']);
                if (!empty($data['to_date'])) {
                    $this->db->where('to_date', $data['to_date']);
                } else {
                    $this->db->where('to_date IS NULL');
                }
                $query = $this->db->get($this->Table->non_working_days);

                if ($query->num_rows() == 0) {
                    //If data doesnt exist
                    $this->db->insert($this->Table->non_working_days, $data);
                } else {
                    // if data exists
                }

            }


            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => "Calendar Saved Successfuly", 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }

}