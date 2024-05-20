<?php
defined('BASEPATH') or exit('No direct script access allowed');
class QR_services_model extends CI_Model
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

    public function generate_rn()
    {
        try {
            $rn = '';
            $this->db->truncate($this->Table->qr);
            $qr_data = array();
            foreach ($this->faculty as $val) {
                $rn = rng_gen($val);
                // var_dump($rn);
                $data = array(
                    'qr' => $rn,
                    'fID' => $val,
                );
                array_push($qr_data, $data);
            }

            $this->db->trans_start();
            $this->db->insert_batch($this->Table->qr, $qr_data);
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

    public function submit_attendance()
    {
        try {
            //check if qr code is passed
            if (!isset($this->qrdata) || $this->status == '' || $this->status == ' ') {
                throw new Exception(ERROR_PROCESSING, true);
            }

            //check if qr code is exist or is valid
            $this->db->select('u.ID, u.Fname, u.Mname, u.Lname');
            $this->db->where('q.qr', $this->qrdata);
            $this->db->join($this->Table->user . ' u', 'u.ID=q.fID', 'left');
            $this->db->from($this->Table->qr . ' q');
            $query = $this->db->get()->row();
            if (empty($query)) {
                throw new Exception(INVALID_QRCODE, true);
            }
            //check if student has check attendance recently and avoid duplication of records
            $status = $this->status == 1 ? 'IN' : 'OUT';

            $this->db->select('*');
            $this->db->from($this->Table->logs);
            $this->db->where('FacultyID', $query->ID);
            $this->db->group_start();
            $this->db->where('DATE(timein_am)', date('Y-m-d'));
            $this->db->or_where('DATE(timeout_am)', date('Y-m-d'));
            $this->db->or_where('DATE(timein_pm)', date('Y-m-d'));
            $this->db->or_where('DATE(timeout_pm)', date('Y-m-d'));
            $this->db->group_end();
            // echo $this->db->get_compiled_select(); // Output the generated SQL query for debugging
            $checker = $this->db->get()->row();
            
            $this->db->trans_start();
            if ($status == 'IN') {
                $time_checker = date("H:i:s") <= '12:00:00' ? 'timein_am' : 'timein_pm';
                if (!empty($checker->$time_checker)) {
                    throw new Exception(INVALID_SCAN, true);
                } elseif (!empty($checker)) {
                    $data = array($time_checker => date("Y-m-d H:i:s"), 'date_updated' => date("Y-m-d H:i:s"));
                    $this->db->where('ID', $checker->ID);
                    $this->db->update($this->Table->logs, $data);
                } else {
                    $data = array('FacultyID' => $query->ID, $time_checker => date("Y-m-d H:i:s"), 'date_log' => date("Y-m-d H:i:s"));
                    $this->db->insert($this->Table->logs, $data);
                }
            } else {
                $time_checker = date("H:i:s") <= '12:00:00' ? 'timeout_am' : 'timeout_pm';
                if (!empty($checker->$time_checker)) {
                    throw new Exception(INVALID_SCAN, true);
                } elseif (!empty($checker)) {
                    $data = array($time_checker => date("Y-m-d H:i:s"), 'date_updated' => date("Y-m-d H:i:s"));
                    $this->db->where('ID', $checker->ID);
                    $this->db->update($this->Table->logs, $data);
                } else {
                    $data = array('FacultyID' => $query->ID, $time_checker => date("Y-m-d H:i:s"), 'date_log' => date("Y-m-d H:i:s"), 'office' => 'DTR');
                    $this->db->insert($this->Table->logs, $data);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false, 'name' => strtoupper($query->Fname) . ' ' . strtoupper($query->Lname));
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }
}
