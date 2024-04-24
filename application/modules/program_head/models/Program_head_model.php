<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Program_head_model extends CI_Model
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

    public function get_dtr()
    {
        // var_dump($this->session);
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->acknowledge);
        $this->db->where('Acknowledged', '1');
        $this->db->where('FacultyID', $this->faculty_id);
        $query = $this->db->get()->result();
        $results = [];
        foreach ($query as $key => $value) {
            $result = $this->get_dtr_logs_daily($value->Schedule);
            if (!empty($result) || $result != null) {
                $results[] = $result;
            }

        }

        return ['query' => $query, 'result' => $results];
    }
    public function get_dtr_logs_daily($schedule)
    {
        $dateRangesString = $schedule;
        $processedResults = [];
        // Remove extra double quotation marks to properly separate date ranges
        $dateRangesString = str_replace('""', '" "', $dateRangesString);

        // Split the string into an array using the delimiter " "
        $dateRangesArray = explode('" "', $dateRangesString);

        foreach ($dateRangesArray as $dateRange) {
            // Split each date range into start and end dates
            $dates = explode(' - ', $dateRange);

            // Add start and end dates to the processed array
            $processedDateRanges[] = [
                'start_date' => $dates[0],
                'end_date' => $dates[1]
            ];
        }
        foreach ($processedDateRanges as $dates) {
            $startDate = date('Y-m-d', strtotime($dates['start_date']));
            $endDate = date('Y-m-d', strtotime($dates['end_date']));

            $this->db->select('date_log');
            $this->db->from($this->Table->logs);
            $this->db->where('date_log >=', $startDate);
            $this->db->where('date_log <=', $endDate);
            $result = $this->db->get()->result();
            // echo json_encode($result);
            return $result;
        }

    }
    public function get_faculty()
    {
        // var_dump($this->session);
        $user_types_allowed = ["1", "2"];
        $this->db->select(
            'u.*,' .
            'd.department_name,' .
            'sv.dateSubmitted,' .
            'sv.schoolYear,' .
            'sv.schoolTerm,' .
            'sv.verified,' .
            'sv.edited,'
        );
        $this->db->from($this->Table->user . ' u');
        $this->db->where_in('User_type', $user_types_allowed);
        $this->db->join($this->Table->department . ' d', 'u.Department = d.ID', ' left');
        $this->db->join($this->Table->sched_verification . ' sv', 'u.ID = sv.facultyID', ' left');
        // $this->db->where('verified', '0');

        $query = $this->db->get()->result();
        return $query;
    }
    public function get_schedule()
    {
        $this->db->select('*');
        $this->db->from($this->Table->sched);
        $this->db->where('Faculty_id', $this->faculty_id);

        $query = $this->db->get()->result();

        return $query;
    }
    public function get_dtr_logs()
    {
        $this->db->select('*');
        $this->db->from($this->Table->logs);
        $this->db->where('timein_am !=', NULL);
        $this->db->where('timeout_am !=', NULL);
        // $this->db->where('timein_pm !=', NULL);
        // $this->db->where('timeout_pm !=', NULL);
        $this->db->where('FacultyID', $this->session->ID);
        $query = $this->db->get()->result();
        return $query;

        // echo json_encode($query);
    }

    public function approve_schedule()
    {
        try {
                $data = array(
                    'verified' => 1,
                );

                $this->db->trans_start();
                $this->db->where('facultyID', $this->facultyID);
                $this->db->where('schoolYear', $this->schoolYear);
                $this->db->where('schoolTerm', $this->schoolTerm);
                $this->db->update($this->Table->sched_verification, $data);

                $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => "Approved Successfully", 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }
}