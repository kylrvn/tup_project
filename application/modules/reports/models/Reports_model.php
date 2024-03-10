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

    public function get_dtr_summary()
    {
        $selected_month = $this->month;

        $date_parts = explode("-", $selected_month);

        $year = $date_parts[0];
        $month = $date_parts[1];

        $undertime_total = 0;
        $tard_total = 0;
        $undertime_tard_total = 0;
        $ut = 0;
        $t = 0;

        $days_in_selected_month = date('t', mktime(0, 0, 0, $month, 1, $year));

        $data_to_send = [];

        $dateObj = DateTime::createFromFormat('!m', $month);
        $monthInWords = $dateObj->format('F');

        $data_to_send["num_of_days"] = $days_in_selected_month;
        $data_to_send["month_in_words"] = $monthInWords;
        $data_to_send["year"] = $year;

        $this->db->select(
            'u.*,'
            // 'd.Date_time,'.
        );
        $this->db->from($this->Table->user . ' u');
        // $this->db->join($this->Table->dtr.' d', 'u.ID=d.Faculty_id','left');
        // $this->db->join($this->Table->sched.' s', 'u.ID=s.Faculty_id','left');

        $data_to_send["data"] = $this->db->get()->result();

        foreach ($data_to_send["data"] as $val) {
            $logs = $this->get_logs($val->ID);
            $sched = $this->get_sched($val->ID);

            $numberOfDaysInMonth = $data_to_send['num_of_days'];
            $daysArray = range(1, $numberOfDaysInMonth);
            foreach ($daysArray as $day) {
                $undertime_tard_daily = array();

                $tempschedarr = array();
                $dayOfWeek = strtolower(date("l", strtotime($day . "-" . $month . "-" . $year))); //Use any date from $selected_month
                foreach ($sched as $schedule) {
                    // Check if the day of the week matches the 'Day' field in the schedule
                    if (strtolower($schedule->Day) === $dayOfWeek) {
                        $tempschedarr[] = array(
                            'subject_am' => $schedule->Subject_am,
                            'subject_pm' => $schedule->Subject_pm,
                            'start_am' => $schedule->Start_time_am,
                            'end_am' => $schedule->End_time_am,
                            'start_pm' => $schedule->Start_time_pm,
                            'end_pm' => $schedule->End_time_pm, // Corrected the mapping here
                            'time_frame' => $schedule->time_frame,
                        );
                    }
                }
                @$arrsize = sizeof(@$tempschedarr);
                foreach ($logs as $k => $log) {
                    if (date("j", strtotime($log->date_log)) == $day) {
                        $quota = 18000;
                        $quota_checker = 0;

                        foreach (@$tempschedarr as $key => $subject) {

                            if ($subject['time_frame'] == "AM") {
                                // echo 'quota atm = '. $quota_checker.'<br>';
                                //for am late detection
                                $amsched = date("H:i:s", strtotime($subject['start_am']));
                                $amtimein = date("H:i:s", strtotime($log->timein_am));
                                $a = strtotime($amsched); // am schedule start 
                                $b = strtotime($amtimein); // am timein
                                $tardiness_minutes = (int)(($b - $a) / 60); // divide by 60 to get minutes format

                                if ($subject['subject_am'] !== null && $tardiness_minutes > 0) {
                                    // echo '[am] day ' . $day . ' : late '.$tardiness_minutes.'<br>';
                                    $t += $tardiness_minutes; //total daily
                                    $tard_total += $tardiness_minutes;
                                }

                                //for am undertime

                                    $amsched_out = date("H:i:s", strtotime($subject['end_am']));
                                    $amtime_out = date("H:i:s", strtotime($log->timeout_am));
                                    $e = strtotime($amsched_out); // am schedule done
                                    $f = strtotime($amtime_out); // am timeout
                                    $undertime_minutes = floor((($e - $f) / 60)); // divide by 60 to get minutes format. Also solving for time is weird so we used floor to round DOWN not up. eg user is 1min and 1 second late, resulting in a 1.98 where if u round it up, it gives the value of 2 instead of one.
                                    // echo $e.' '.$f.' undertime '.$undertime_minutes.'<br>';
                                    $quota_checker += ($f - $b);
                                    if ($quota_checker < $quota && $undertime_minutes > 0) {
                                        // echo $quota_checker .' [am] day ' . $day . ' : undertime '.$undertime_minutes.'<br>';
                                        $undertime_total += $undertime_minutes;
                                        $ut += $undertime_minutes;
                                    }

                            } else {
                                //for pm late detection
                                $pmsched = date("H:i:s", strtotime($subject['start_pm']));
                                $pmtimein = date("H:i:s", strtotime($log->timein_pm));
                                $c = strtotime($pmsched);
                                $d = strtotime($pmtimein);
                                $tardiness_afternoon_minutes = (int)(($d - $c) / 60);

                                if ($subject['subject_pm'] !== null && $tardiness_afternoon_minutes > 0) {
                                    // echo '[pm] day ' . $day . ' :late '.$tardiness_afternoon_minutes.'<br>';
                                    $t += $tardiness_afternoon_minutes;
                                    $tard_total += $tardiness_afternoon_minutes;
                                }

                                // for pm undertime
                                if ($subject['subject_pm'] !== null) {
                                    $pmsched_out = date("H:i:s", strtotime($subject['end_pm']));
                                    $pmtime_out = date("H:i:s", strtotime($log->timeout_pm));
                                    $g = strtotime($pmsched_out);
                                    $h = strtotime($pmtime_out);
                                    $undertime_afternoon_minutes = floor((($g - $h) / 60));
                                    $quota_checker += ($h - $d);

                                    if ($quota_checker < $quota && $undertime_afternoon_minutes > 0) {
                                        // echo '[pm] day ' . $day . ' : undertime '.$undertime_afternoon_minutes.'<br>';
                                        // $undertime_total += $undertime_afternoon_minutes;
                                        $ut += $undertime_afternoon_minutes;
                                    }
                                }

                                //overload checker 

                                if (@$key == $arrsize - 1 && $h > $g) { //check if last subject for today
                                    $quota_checker -= ($h - $g); // subtracts the time hours spent based on the last subject time out
                                }

                                if ($quota_checker > $quota) {
                                    $o = 0; // points for overload
                                    $o = $quota_checker - $quota;

                                    $pts = $o >= 900 ? $this->calculate_daily_overload($o) : 0; //if 15 mins has passed, calculate overload
                                    // echo 'overload pts :' . $pts . '<br>';
                                }
                            }
                            // echo $undertime_total.'<br>';
                        }
                        // echo 'hrs spend on this day "' . $day . '" : ' . ($quota_checker / 3600) . 'hrs <br>';
                        // echo 'ut: ' . $ut . ' t: '. $t.'<br>';

                        break;

                    } //if checker
                    
                } //end log foreach loop
                // $val->daily[] = $undertime_tard_daily;
                if($t!=0 && $ut!=0){
                    $undertime_tard_daily = array(
                        "ut_daily" => $ut,
                        "t_daily" => $t,
                    );
                }
                // var_dump($undertime_tard_daily);
                $ut = 0;
                $t = 0;
            }

            $undertime_tard_total = $undertime_total + $tard_total;
            $val->ut = $undertime_total;
            $val->tt = $tard_total;
            $val->utt = $undertime_tard_total;
            // $val->daily = $undertime_tard_daily;

            $undertime_total = 0;
            $tard_total = 0;
            $undertime_tard_total = 0;

        } /* end of faculty foreach loop */
        // echo json_encode($monthInWords);
        // var_dump($data_to_send["data"]);
        return $data_to_send;
    }

    public function get_deduction_summary()
    {
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

    private function calculate_daily_overload($pts)
    {
        $x = $y = 0;
        $x = round($pts / 3600, 2); //divide per hr then round off
        $y = $x - (int)$x; //get decimal 1.80 -1.00 = 0.80
        $y = $y >= 0.25 ? ($y >= 0.5 ? ($y >= 0.75 ? 0.75 : 0.25) : 0.5) : 0; //round off to specific point
        $x = (int)$x + $y; //finalize point 1.00 + 0.75
        return $x;
    }

    public function get_logs($ID)
    {
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->log);
        $this->db->where('idno', $ID);
        $logs = $this->db->get()->result();
        return $logs;
    }

    public function get_sched($ID)
    {
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->sched);
        $this->db->where('Faculty_id', $ID);
        $this->db->where('Active', 1);
        $query = $this->db->get()->result();
        return $query;
    }
}
