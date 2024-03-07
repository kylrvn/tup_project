<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reports_model extends CI_Model
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

    public function get_dtr_summary(){
        $selected_month = $this->month;

        $date_parts = explode("-", $selected_month);

        $year = $date_parts[0];
        $month = $date_parts[1];

        $days_in_selected_month = date('t', mktime(0, 0, 0, $month, 1, $year));

        $data_to_send = [];

        $dateObj = DateTime::createFromFormat('!m', $month);
        $monthInWords = $dateObj->format('F');

        $data_to_send["num_of_days"] = $days_in_selected_month;
        $data_to_send["month_in_words"] = $monthInWords;
        $data_to_send["year"] = $year;

        // echo json_encode($monthInWords);
        return $data_to_send;
    }

    public function get_deduction_summary(){
        $selected_month = $this->month;

        $date_parts = explode("-", $selected_month);

        $year = $date_parts[0];
        $month = $date_parts[1];

        $days_in_selected_month = date('t', mktime(0, 0, 0, $month, 1, $year));

        $data_to_send = [];

        $dateObj = DateTime::createFromFormat('!m', $month);
        $monthInWords = $dateObj->format('F');
        $monthInAbbv = $dateObj->format('M');

        $data_to_send["num_of_days"] = $days_in_selected_month;
        $data_to_send["month_in_words"] = $monthInWords;
        $data_to_send["month"] = $monthInAbbv;
        $data_to_send["year"] = $year;

        // echo json_encode($monthInWords);
        return $data_to_send;
    }


}
