<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reports_model extends CI_Model
{
    public $Table;
    public $user_type = ["1", "2"];
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

    public function get_dtr_summary() // overall calculation
    {
        $selected_month = $this->month;

        $date_parts = explode("-", $selected_month);

        $year = $date_parts[0];
        $month = $date_parts[1];
        $holiday = [];
        $undertime_total = 0;
        $tard_total = 0;
        $undertime_tard_total = 0;
        $overtime_total = 0;
        $ut = 0;
        $t = 0;
        $ov = 0;
        $undertime_tard_daily = array();
        $logs_data = array();
        $quota = 0;
        $days_in_selected_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $leave_dates = [];

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

        if ($this->facultyType == "1") {
            $this->db->where_in('u.User_type', $this->user_type);
        } else if ($this->facultyType == "5") {
            $this->db->where('u.User_type', $this->facultyType);
        }
        // $this->db->join($this->Table->dtr.' d', 'u.ID=d.Faculty_id','left');
        // $this->db->join($this->Table->sched.' s', 'u.ID=s.Faculty_id','left');

        $data_to_send["data"] = $this->db->get()->result();
        $holiday = $this->get_holidays($year, $month);
        foreach ($data_to_send["data"] as $val) {

            $leave_dates = $this->get_leave_dates($val->ID);
            $logs = $this->get_logs($val->ID);
            $sched = $this->get_sched($val->ID);

            $this->db->select('*');
            $this->db->where('faculty_id', $val->ID);
            $this->db->where('MONTH(from_date)', $month);
            $this->db->where('YEAR(from_date)', $year);
            $this->db->from($this->Table->exam_schedule);
            $exam_sched = $this->db->get()->result();
            // $sql = $this->db->last_query();
            // echo $sql;

            $exam_sched_arrdays = array();
            @$start_exam_day = date('j', strtotime($exam_sched[0]->from_date));
            @$end_exam_day = date('j', strtotime($exam_sched[0]->to_date));

            for ($start_exam_day; $start_exam_day <= $end_exam_day; $start_exam_day++) {
                $exam_sched_arrdays[] = $year . '-' . $month . '-' . $start_exam_day;
            }

            $numberOfDaysInMonth = $data_to_send['num_of_days'];
            $daysArray = range(1, $numberOfDaysInMonth);
            foreach ($daysArray as $day) {
                $am_count = 0;
                $tempschedarr = array();
                $dayOfWeek = strtolower(date("l", strtotime($day . "-" . $month . "-" . $year))); //Use any date from $selected_month

                foreach ($sched as $schedule) {

                    // Check if the day of the week matches the 'Day' field in the schedule
                    if (strtolower($schedule->Day) === $dayOfWeek) {
                        $am_count += substr_count(strtolower($schedule->time_frame), 'am');
                        $quota = $quota == 0 ? $schedule->scheme : $quota;

                        $tempschedarr[] = array(
                            'start_time' => $schedule->Start_time,
                            'end_time' => $schedule->End_time,
                            'time_frame' => $schedule->time_frame,
                        );
                    }
                }

                @$arrsize = sizeof(@$tempschedarr);
                foreach ($logs as $k => $log) {

                    if (in_array($this->month . '-' . $day, $holiday)) {
                        $undertime_tard_daily[$day] = [
                            "day" => $day,
                            "ut_daily" => 0,
                            "t_daily" => 0,
                        ];
                        $overload_daily[$day] = [
                            "day" => $day,
                            "ol_daily" => 0,
                        ];
                        break;
                    }

                    if ($this->month . '-' . $day == date("Y-m-j", strtotime(@$log->date_log))) {
                        // echo '<br>'.$day.'- ';
                        // $quota = 18000;
                        $quota = $quota * 3600;
                        $quota_checker = 0;
                        $dayFormatted = sprintf('%02d', $day);

                        if (in_array($this->month . '-' . $day, $exam_sched_arrdays)) {
                            $quota = 18000;
                            $quota_checker = 0;
                            $t = 0; // placeholder for tardiness
                            //checks for undertime
                            $timein = date("H:i:s", strtotime($log->timein_am == null ? $log->timein_pm : $log->timein_am));
                            $timeout = date("H:i:s", strtotime($log->timeout_am == null ? $log->timeout_pm : $log->timeout_am));
                            $time_in = strtotime($timein);
                            $time_out = strtotime($timeout);
                            $quota_checker = $time_out - $time_in;
                            if ($quota_checker < $quota) {
                                $ut += floor((($quota - $quota_checker) / 60));
                                $undertime_total += floor((($quota - $quota_checker) / 60));
                            }
                            $undertime_tard_daily[$day] = [
                                "day" => $day,
                                "ut_daily" => $ut,
                                "t_daily" => $t,
                            ];
                            $overload_daily[$day] = [
                                "day" => $day,
                                "ol_daily" => $ov,
                            ];
                            break;
                        } else if (@$leave_dates[0]->leaveDate == $this->month . '-' . $dayFormatted) {

                            foreach ($leave_dates as $leave) {

                                // var_dump($this->month . '-' . $day);

                                if ($leave->leaveDate == $this->month . '-' . $dayFormatted) {

                                    $leaveType = $this->get_leave_type($leave->leaveType);
                                    $leaveTypeLegend = [
                                        "Vacation Leave" => "VL",
                                        "Mandatory/Forced Leave" => "M/FL",
                                        "Sick Leave" => "SL",
                                        "Maternity Leave" => "ML",
                                        "Paternity Leave" => "PL",
                                        "Special Privilege Leave" => "SPL",
                                        "Solo Parent Leave" => "PRL",
                                        "Study Leave" => "STDY",
                                        "10-Day VAWC Leave" => "VAWC",
                                        "Rehabilitation Privilige" => "RP",
                                        "Special Benefits for Women" => "SBW",
                                        "Special Emergency (Calamity) Leave" => "CL",
                                        "Adoption Leave" => "AL",
                                        "Official Business" => "OB",
                                        "Suspended" => "S",
                                        "Leave without Pay" => "LWOP",
                                    ];

                                    $leaveAbbv = null;
                                    foreach ($leaveTypeLegend as $key => $value) {
                                        if ($key == $leaveType->LeaveType) {
                                            $leaveAbbv = $value;
                                        }
                                    }

                                    $undertime_tard_daily[$day] = [

                                        "day" => $day,
                                        "ut_daily" => -1,
                                        "t_daily" => -1,
                                        "leave_data" => $leaveAbbv,

                                    ];
                                    $overload_daily[$day] = [
                                        "day" => $day,
                                        "ol_daily" => -1,
                                    ];

                                    break;
                                }
                            }
                        } else {

                            //checker to check if current schedule of the day contains any AM subject.
                            if (strpos(@$tempschedarr[0]['time_frame'], 'AM') !== false) {
                                $b = 0;
                                $start_day = 0;
                                $late_time = 0;

                                foreach ($tempschedarr as $key => $subject) {

                                    if ($subject['time_frame'] == "AM") {

                                        //for am late detection
                                        $amsched = date("H:i:s", strtotime(@$tempschedarr[0]['start_time'])); // gets the first subject only for basis in late calculation
                                        $amschedout = date("H:i:s", strtotime($subject['end_time']));
                                        $amtimein = date("H:i:s", strtotime($log->timein_am));
                                        $a = strtotime($amsched); // am schedule start 
                                        $b = strtotime($amtimein); // am timein
                                        $eto = strtotime($amschedout);
                                        $start_day = date("H:i:s", strtotime(@$tempschedarr[0]['start_time']));
                                        $start_day = strtotime($start_day); // data for basis in undertime and overload calculation

                                        $tardiness_minutes = (int) (($b - $a) / 60); // divide by 60 to get minutes format

                                        // if ($subject['subject_am'] !== null && $tardiness_minutes > 0) {
                                        if ($tardiness_minutes > 0 && @$tempschedarr[0]['start_time'] == $subject['start_time']) {
                                            $t += $tardiness_minutes; //total daily
                                            $late_time = $tardiness_minutes * 60;
                                            $tard_total += $tardiness_minutes;
                                        }

                                        //checks if user decides to time out in the morning and if current looped subject is 2nd morning subject || UPDATE : should cater 2 subjects or more.
                                        if (@$am_count == $key + 1) {
                                            $time_out = date("H:i:s", strtotime($log->timeout_pm == null ? $log->timeout_am : $log->timeout_pm));
                                            if ($time_out <= "12:00:00") {
                                                $h = strtotime($time_out);
                                                $quota_checker += ($h - $a);
                                                $undertime_earlyout_minutes = floor((($eto - $h) / 60));
                                                if ($quota_checker < $quota) {
                                                    // $ut += floor(($quota - $quota_checker) / 60);
                                                    // $undertime_total += floor(($quota - $quota_checker) / 60);
                                                    if ($undertime_earlyout_minutes > 0) {
                                                        $ut += $undertime_earlyout_minutes;
                                                        $undertime_total += $undertime_earlyout_minutes;
                                                        // echo $ut;

                                                    }
                                                    break;
                                                }
                                            }
                                        }
                                    } else {
                                        $pmsched_out = date("H:i:s", strtotime($subject['end_time']));
                                        $pmtime_out = date("H:i:s", strtotime($log->timeout_pm));
                                        $g = strtotime($pmsched_out);
                                        $h = strtotime($pmtime_out);
                                        if ($b < @$start_day) {
                                            $quota_checker += ($h - ($b + ($start_day - $b))) - 3600;
                                        } else {
                                            $quota_checker += ($h - $b) - 3600; // end time - start time
                                        }

                                        $undertime_afternoon_minutes = floor((($quota - $quota_checker) / 60));
                                        if ($quota_checker < $quota && $undertime_afternoon_minutes > 0) {
                                            $undertime_total += $undertime_afternoon_minutes;
                                            $ut += $undertime_afternoon_minutes;
                                        }
                                        $quota_checker = ($h - $start_day) - 3600;
                                        //overload checker 
                                        if (@$key == $arrsize - 1 && $h > $g) { //check if last subject for today
                                            $quota_checker -= ($h - $g); // subtracts the time hours spent based on the last subject time out
                                        }

                                        if ($late_time != 0) {
                                            $quota_checker = $quota_checker - $late_time;
                                        } else {
                                            $quota_checker = ($h - $b) - 3600; // end time - start time
                                        }
                                        // if($val->ID=='65') echo 'DAY '.$day.'am - '.$quota_checker.'<br>';

                                        if ($quota_checker > $quota && @$key == $arrsize - 1) {
                                            // echo $day.' triggered<br>';
                                            $o = 0; // points for overload
                                            $o = $quota_checker - $quota;
                                            $ov = $o >= 900 ? $this->calculate_daily_overload($o) : 0; //if 15 mins has passed, calculate overload
                                            $overtime_total += $ov;
                                            // if ($val->ID == '65') echo 'DAY ' . $day . 'am - ' . $o . '<br>';
                                            // echo $day.' '.$overtime_total.' triggered<br>';
                                        }
                                    }
                                }
                                // echo $quota_checker;
                            } else { //AFTERNOON SUBJECT CHECKER
                                $b = 0;
                                $start_day = 0;
                                $late_time = 0;
                                foreach (@$tempschedarr as $key => $subject) {
                                    $start_time = date("H:i:s", strtotime(@$tempschedarr[0]['start_time']));
                                    $start_time = strtotime($start_time);
                                    $timein = date("H:i:s", strtotime($log->timein_pm));
                                    $schedstart = date("H:i:s", strtotime($subject['start_time']));
                                    $time_in = strtotime($timein);
                                    $sched_start = strtotime($schedstart);
                                    $tardiness_minutes = (int) (($time_in - $sched_start) / 60);

                                    if ($tardiness_minutes > 0) { // updated code to check only if late
                                        $t += $tardiness_minutes; //total daily
                                        $tard_total += $tardiness_minutes;
                                    }

                                    $schedend = date("H:i:s", strtotime($subject['end_time']));
                                    $sched_end = strtotime($schedend);
                                    $timeout = date("H:i:s", strtotime($log->timeout_pm));
                                    $time_out = strtotime($timeout);
                                    $quota_checker = ($time_out - $time_in);

                                    // undertime
                                    if (@$arrsize == $key + 1 || $time_out < $sched_end) {
                                        $undertime_afternoon_minutes = floor((($time_out - $sched_end) / 60));
                                        if ($quota_checker < $quota && $undertime_afternoon_minutes > 0) {
                                            $ut += $undertime_afternoon_minutes;
                                        }
                                    }

                                    // overload
                                    if (@$arrsize == $key + 1 && $time_out > $sched_end) {
                                        $quota_checker -= ($time_out - $sched_end);
                                    }
                                    // echo 'DAY '.$day.'pm - '.$quota_checker.'<br>';
                                    if ($quota_checker > $quota) {
                                        $o = 0; // points for overload
                                        $o = $quota_checker - $quota;

                                        $ov = $o >= 900 ? $this->calculate_daily_overload($o) : 0; //if 15 mins has passed, calculate overload
                                        $overtime_total += $ov;
                                    }
                                }
                            }

                            $undertime_tard_daily[$day] = [
                                "day" => $day,
                                "ut_daily" => $ut,
                                "t_daily" => $t,
                            ];
                            $overload_daily[$day] = [
                                "day" => $day,
                                "ol_daily" => $ov,
                            ];
                            break;
                        }
                    } // end of if date checker

                } //end log foreach loop

                if (!isset($undertime_tard_daily[$day])) {
                    $undertime_tard_daily[$day] = [];
                }
                if (!isset($overload_daily[$day])) {
                    $overload_daily[$day] = [];
                }
                // if($val->ID=='65'){
                //     echo 'day'.$day.' ot : '. $ov.' total : '. $overtime_total.'<br>'; 
                // }

                $ov = 0;
                $ut = 0;
                $t = 0;
                $quota = 0;
            }

            $undertime_tard_total = $undertime_total + $tard_total;
            $val->ut = $undertime_total;
            $val->tt = $tard_total;
            $val->utt = $undertime_tard_total;
            $val->ol = $overtime_total;
            $val->daily = $undertime_tard_daily;
            $val->daily_ol = $overload_daily;

            $undertime_total = 0;
            $tard_total = 0;
            $undertime_tard_total = 0;
            $overtime_total = 0;
            $undertime_tard_daily = [];
            $overload_daily = [];

            // $data_to_send["data"][] = $val;
        } /* end of faculty foreach loop */
        // var_dump(@$data_to_send["data"]);
        return $data_to_send;
    }

    public function get_deduction_summary() // absents
    {
        $selected_month = $this->month;

        $date_parts = explode("-", $selected_month);

        $year = $date_parts[0];
        $month = $date_parts[1];

        $days_in_selected_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $leave_dates = [];
        $data_to_send = [];
        $quota = 0;
        $undertime_total = 0;
        $tard_total = 0;
        $undertime_tard_total = 0;
        $overtime_total = 0;
        $ut = 0;
        $t = 0;
        $ov = 0;
        $undertime_tard_daily = array();
        $absent_count = 0;
        $absent_dates = array();

        $dateObj = DateTime::createFromFormat('!m', $month);
        $monthInWords = $dateObj->format('F');
        $monthInAbbv = $dateObj->format('M');

        $data_to_send["num_of_days"] = $days_in_selected_month;
        $data_to_send["month_in_words"] = $monthInWords;
        $data_to_send["month"] = $monthInAbbv;
        $data_to_send["year"] = $year;

        $this->db->select(
            'u.*,'
            // 'd.Date_time,'.
        );
        $this->db->from($this->Table->user . ' u');

        if ($this->facultyType == "1") {
            $this->db->where_in('u.User_type', $this->user_type);
        } else if ($this->facultyType == "5") {
            $this->db->where('u.User_type', $this->facultyType);
        }
        $data_to_send["data"] = $this->db->get()->result();
        $holiday = $this->get_holidays($year, $month);
        // var_dump($holiday);
        foreach ($data_to_send["data"] as $val) {

            $logs = $this->get_logs($val->ID);
            $sched = $this->get_sched($val->ID);
            $leave_dates = $this->get_leave_dates($val->ID);

            $this->db->select('*');
            $this->db->where('faculty_id', $val->ID);
            $this->db->where('MONTH(from_date)', $month);
            $this->db->where('YEAR(from_date)', $year);
            $this->db->from($this->Table->exam_schedule);
            $exam_sched = $this->db->get()->result();
            // $sql = $this->db->last_query();
            // echo $sql;

            $exam_sched_arrdays = array();
            @$start_exam_day = date('j', strtotime($exam_sched[0]->from_date));
            @$end_exam_day = date('j', strtotime($exam_sched[0]->to_date));

            for ($start_exam_day; $start_exam_day <= $end_exam_day; $start_exam_day++) {
                $exam_sched_arrdays[] = $year . '-' . $month . '-' . $start_exam_day;
            }

            $numberOfDaysInMonth = $data_to_send['num_of_days'];
            $daysArray = range(1, $numberOfDaysInMonth);
            $absent_count = $numberOfDaysInMonth;
            foreach ($daysArray as $day) {
                $absent_checker = false;
                $dayOfWeek = strtolower(date("l", strtotime($day . "-" . $month . "-" . $year))); //Use any date from $selected_month
                if ($month == date('m') && $day <= date('j')) {
                    if ($dayOfWeek == 'saturday' || $dayOfWeek == 'sunday') {
                        $absent_checker = true;
                        $absent_count--;
                    } else {
                        $am_count = 0;
                        $tempschedarr = array();

                        foreach ($sched as $schedule) {
                            // $am_count = substr_count(strtolower($schedule->time_frame), 'am');
                            // Check if the day of the week matches the 'Day' field in the schedule
                            if (strtolower($schedule->Day) === $dayOfWeek) {
                                $am_count += substr_count(strtolower($schedule->time_frame), 'am');
                                $quota = $quota == 0 ? $schedule->scheme : $quota;
                                // echo "Time Frame: {$schedule->time_frame}, AM Count: {$am_count}\n";
                                $tempschedarr[] = array(
                                    'start_time' => $schedule->Start_time,
                                    'end_time' => $schedule->End_time,
                                    'time_frame' => $schedule->time_frame,
                                );
                            }
                        }
                        // var_dump($tempschedarr);
                        @$arrsize = sizeof(@$tempschedarr);
                        foreach ($logs as $k => $log) {
                            // if (date("j", strtotime($log->date_log)) == $day) {
                            if (in_array($this->month . '-' . $day, $holiday)) {
                                // echo 'AAA';
                                $undertime_tard_daily[$day] = [
                                    "day" => $day,
                                    "ut_daily" => 0,
                                    "t_daily" => 0,
                                ];
                                $overload_daily[$day] = [
                                    "day" => $day,
                                    "ol_daily" => 0,
                                ];
                                $absent_count--;
                                $absent_checker = true;
                                break;
                            }

                            if (in_array($this->month . '-' . $day, $leave_dates)) {
                                // echo 'AAA';
                                $undertime_tard_daily[$day] = [
                                    "day" => $day,
                                    "ut_daily" => 0,
                                    "t_daily" => 0,
                                ];
                                $overload_daily[$day] = [
                                    "day" => $day,
                                    "ol_daily" => 0,
                                ];
                                $absent_count--;
                                $absent_checker = true;
                                break;
                            }

                            if ($this->month . '-' . $day == date("Y-m-j", strtotime(@$log->date_log))) {
                                $absent_checker = true;
                                $absent_count--;
                                // echo '<br>'.$day.'- ';
                                // $quota = 18000;
                                $quota = $quota * 3600;
                                $quota_checker = 0;
                                if (in_array($this->month . '-' . $day, $exam_sched_arrdays)) {
                                    $quota = 18000;
                                    $quota_checker = 0;

                                    //checks for undertime
                                    $timein = date("H:i:s", strtotime($log->timein_am == null ? $log->timein_pm : $log->timein_am));
                                    $timeout = date("H:i:s", strtotime($log->timeout_am == null ? $log->timeout_pm : $log->timeout_am));
                                    $time_in = strtotime($timein);
                                    $time_out = strtotime($timeout);
                                    $quota_checker = $time_out - $time_in;
                                    if ($quota_checker < $quota) {
                                        $ut += floor((($quota - $quota_checker) / 60));
                                        $undertime_total += floor((($quota - $quota_checker) / 60));
                                    }
                                    $undertime_tard_daily[$day] = [
                                        "day" => $day,
                                        "ut_daily" => $ut,
                                        "t_daily" => $t,
                                    ];
                                    $overload_daily[$day] = [
                                        "day" => $day,
                                        "ol_daily" => $ov,
                                    ];
                                    break;
                                } else {
                                    //checker to check if current schedule of the day contains any AM subject.
                                    if (strpos(@$tempschedarr[0]['time_frame'], 'AM') !== false) {
                                        $b = 0;
                                        foreach ($tempschedarr as $key => $subject) {
                                            // $b = 0;
                                            // $h = 0;
                                            if ($subject['time_frame'] == "AM") {
                                                //for am late detection
                                                $amsched = date("H:i:s", strtotime($subject['start_time']));
                                                $amschedout = date("H:i:s", strtotime($subject['end_time']));
                                                $amtimein = date("H:i:s", strtotime($log->timein_am));
                                                $a = strtotime($amsched); // am schedule start 
                                                $b = strtotime($amtimein); // am timein
                                                $eto = strtotime($amschedout);
                                                $tardiness_minutes = (int) (($b - $a) / 60); // divide by 60 to get minutes format

                                                // if ($subject['subject_am'] !== null && $tardiness_minutes > 0) {
                                                if ($tardiness_minutes > 0) { // updated code to check only if late
                                                    $t += $tardiness_minutes; //total daily
                                                    $tard_total += $tardiness_minutes;
                                                }

                                                //checker if user decides to time out in the morning

                                                // $time_out = date("H:i:s", strtotime($log->timeout_pm == null ? $log->timeout_am : $log->timeout_pm));
                                                //checks if current looped subject is 2nd morning subject
                                                if (@$am_count == $key + 1) {
                                                    // if (@$am_count == $key + 1 && date("H:i:s", strtotime('10:00:00')) >= $amsched || date("H:i:s", strtotime('12:00:00')) <= $amsched) {
                                                    $time_out = date("H:i:s", strtotime($log->timeout_pm == null ? $log->timeout_am : $log->timeout_pm));
                                                    if ($time_out <= "13:00:00") {
                                                        $h = strtotime($time_out);
                                                        $quota_checker += ($h - $a);
                                                        $undertime_earlyout_minutes = floor((($eto - $h) / 60));
                                                        // echo $quota_checker.' '.$quota;
                                                        if ($quota_checker < $quota) {
                                                            $ut += floor(($quota - $quota_checker) / 60);
                                                            $undertime_total += floor(($quota - $quota_checker) / 60);
                                                            if ($undertime_earlyout_minutes > 0) {
                                                                $ut += $undertime_earlyout_minutes;
                                                                $undertime_total += $undertime_earlyout_minutes;
                                                                // echo $ut;
                                                            }
                                                            break;
                                                        }
                                                    }
                                                }
                                            } else {
                                                $pmsched_out = date("H:i:s", strtotime($subject['end_time']));
                                                $pmtime_out = date("H:i:s", strtotime($log->timeout_pm));
                                                $g = strtotime($pmsched_out);
                                                $h = strtotime($pmtime_out);
                                                $undertime_afternoon_minutes = floor((($g - $h) / 60));
                                                $quota_checker += ($h - $b) - 3600; // end time - start time
                                                // echo $h.' - '.$b;
                                                if ($quota_checker < $quota && $undertime_afternoon_minutes > 0) {
                                                    $undertime_total += $undertime_afternoon_minutes;
                                                    $ut += $undertime_afternoon_minutes;
                                                }

                                                //overload checker 

                                                if (@$key == $arrsize - 1 && $h > $g) { //check if last subject for today

                                                    $quota_checker -= ($h - $g); // subtracts the time hours spent based on the last subject time out
                                                }

                                                if ($quota_checker > $quota) {
                                                    $o = 0; // points for overload
                                                    $o = $quota_checker - $quota;

                                                    $ov = $o >= 900 ? $this->calculate_daily_overload($o) : 0; //if 15 mins has passed, calculate overload
                                                    $overtime_total += $ov;
                                                }
                                            }
                                        }
                                        // echo $quota_checker;
                                    } else {

                                        foreach (@$tempschedarr as $key => $subject) {

                                            $timein = date("H:i:s", strtotime($log->timein_pm));
                                            $schedstart = date("H:i:s", strtotime($subject['start_time']));
                                            $time_in = strtotime($timein);
                                            $sched_start = strtotime($schedstart);
                                            $tardiness_minutes = (int) (($time_in - $sched_start) / 60);

                                            if ($tardiness_minutes > 0) { // updated code to check only if late
                                                echo 'late?' . $tardiness_minutes;
                                                $t += $tardiness_minutes; //total daily
                                                $tard_total += $tardiness_minutes;
                                            }

                                            $schedend = date("H:i:s", strtotime($subject['end_time']));
                                            $sched_end = strtotime($schedend);
                                            $timeout = date("H:i:s", strtotime($log->timeout_pm));
                                            $time_out = strtotime($timeout);
                                            $quota_checker = ($time_out - $time_in);

                                            // undertime
                                            if (@$arrsize == $key + 1 || $time_out < $sched_end) {
                                                $undertime_afternoon_minutes = floor((($time_out - $sched_end) / 60));
                                                if ($quota_checker < $quota && $undertime_afternoon_minutes > 0) {
                                                    $ut += $undertime_afternoon_minutes;
                                                }
                                            }

                                            // overload
                                            if (@$arrsize == $key + 1 && $time_out > $sched_end) {
                                                $quota_checker -= ($time_out - $sched_end);
                                            }

                                            if ($quota_checker > $quota) {
                                                $o = 0; // points for overload
                                                $o = $quota_checker - $quota;

                                                $ov = $o >= 900 ? $this->calculate_daily_overload($o) : 0; //if 15 mins has passed, calculate overload
                                                $overtime_total += $ov;
                                            }
                                        }
                                    }

                                    $undertime_tard_daily[$day] = [
                                        "day" => $day,
                                        "ut_daily" => $ut,
                                        "t_daily" => $t,
                                    ];

                                    break;
                                }
                            } // end of if date checker

                        } //end log foreach loop
                    }
                    // if (!$absent_checker) {
                    //     $bi = strlen($day) < 2 ? 0 . $day : $day;
                    //     $date_absent = $month . '-' . $bi;
                    //     array_push($absent_dates, $date_absent);
                    // }
                } elseif ($month != date('m')) {
                    if ($dayOfWeek == 'saturday' || $dayOfWeek == 'sunday') {
                        $absent_count--;
                        $absent_checker = true;
                    } else {
                        $am_count = 0;
                        $tempschedarr = array();

                        foreach ($sched as $schedule) {
                            // $am_count = substr_count(strtolower($schedule->time_frame), 'am');
                            // Check if the day of the week matches the 'Day' field in the schedule
                            if (strtolower($schedule->Day) === $dayOfWeek) {
                                $am_count += substr_count(strtolower($schedule->time_frame), 'am');

                                // echo "Time Frame: {$schedule->time_frame}, AM Count: {$am_count}\n";
                                $tempschedarr[] = array(
                                    'start_time' => $schedule->Start_time,
                                    'end_time' => $schedule->End_time,
                                    'time_frame' => $schedule->time_frame,
                                );
                            }
                        }
                        // var_dump($tempschedarr);
                        @$arrsize = sizeof(@$tempschedarr);
                        foreach ($logs as $k => $log) {
                            // if (date("j", strtotime($log->date_log)) == $day) {
                            if ($this->month . '-' . $day == date("Y-m-j", strtotime(@$log->date_log))) {
                                $absent_checker = true;
                                $absent_count--;
                                // echo '<br>'.$day.'- ';
                                $quota = 18000;
                                $quota_checker = 0;
                                if (in_array($this->month . '-' . $day, $exam_sched_arrdays)) {
                                    $quota = 18000;
                                    $quota_checker = 0;

                                    //checks for undertime
                                    $timein = date("H:i:s", strtotime($log->timein_am == null ? $log->timein_pm : $log->timein_am));
                                    $timeout = date("H:i:s", strtotime($log->timeout_am == null ? $log->timeout_pm : $log->timeout_am));
                                    $time_in = strtotime($timein);
                                    $time_out = strtotime($timeout);
                                    $quota_checker = $time_out - $time_in;
                                    if ($quota_checker < $quota) {
                                        $ut += floor((($quota - $quota_checker) / 60));
                                        $undertime_total += floor((($quota - $quota_checker) / 60));
                                    }
                                    $undertime_tard_daily[$day] = [
                                        "day" => $day,
                                        "ut_daily" => $ut,
                                        "t_daily" => $t,
                                    ];
                                    $overload_daily[$day] = [
                                        "day" => $day,
                                        "ol_daily" => $ov,
                                    ];
                                    break;
                                } else {
                                    //checker to check if current schedule of the day contains any AM subject.
                                    if (strpos(@$tempschedarr[0]['time_frame'], 'AM') !== false) {
                                        $b = 0;
                                        foreach ($tempschedarr as $key => $subject) {
                                            // $b = 0;
                                            // $h = 0;
                                            if ($subject['time_frame'] == "AM") {
                                                //for am late detection
                                                $amsched = date("H:i:s", strtotime(@$tempschedarr[0]['start_time']));
                                                $amschedout = date("H:i:s", strtotime($subject['end_time']));
                                                $amtimein = date("H:i:s", strtotime($log->timein_am));
                                                $a = strtotime($amsched); // am schedule start 
                                                $b = strtotime($amtimein); // am timein
                                                $eto = strtotime($amschedout);
                                                $tardiness_minutes = (int) (($b - $a) / 60); // divide by 60 to get minutes format

                                                // if ($subject['subject_am'] !== null && $tardiness_minutes > 0) {
                                                if ($tardiness_minutes > 0 && @$tempschedarr[0]['start_time'] != $subject['start_time']) {
                                                    $t += $tardiness_minutes; //total daily
                                                    $tard_total += $tardiness_minutes;
                                                }

                                                //checker if user decides to time out in the morning

                                                // $time_out = date("H:i:s", strtotime($log->timeout_pm == null ? $log->timeout_am : $log->timeout_pm));
                                                //checks if current looped subject is 2nd morning subject
                                                if (@$am_count == $key + 1) {
                                                    // if (@$am_count == $key + 1 && date("H:i:s", strtotime('10:00:00')) >= $amsched || date("H:i:s", strtotime('12:00:00')) <= $amsched) {
                                                    $time_out = date("H:i:s", strtotime($log->timeout_pm == null ? $log->timeout_am : $log->timeout_pm));
                                                    if ($time_out <= "13:00:00") {
                                                        $h = strtotime($time_out);
                                                        $quota_checker += ($h - $a);
                                                        $undertime_earlyout_minutes = floor((($eto - $h) / 60));
                                                        // echo $quota_checker.' '.$quota;
                                                        if ($quota_checker < $quota) {
                                                            $ut += floor(($quota - $quota_checker) / 60);
                                                            $undertime_total += floor(($quota - $quota_checker) / 60);
                                                            if ($undertime_earlyout_minutes > 0) {
                                                                $ut += $undertime_earlyout_minutes;
                                                                $undertime_total += $undertime_earlyout_minutes;
                                                                // echo $ut;
                                                            }
                                                            break;
                                                        }
                                                    }
                                                }
                                            } else {
                                                $pmsched_out = date("H:i:s", strtotime($subject['end_time']));
                                                $pmtime_out = date("H:i:s", strtotime($log->timeout_pm));
                                                $g = strtotime($pmsched_out);
                                                $h = strtotime($pmtime_out);
                                                $undertime_afternoon_minutes = floor((($g - $h) / 60));
                                                $quota_checker += ($h - $b) - 3600; // end time - start time
                                                // echo $h.' - '.$b;
                                                if ($quota_checker < $quota && $undertime_afternoon_minutes > 0) {
                                                    $undertime_total += $undertime_afternoon_minutes;
                                                    $ut += $undertime_afternoon_minutes;
                                                }

                                                //overload checker 

                                                if (@$key == $arrsize - 1 && $h > $g) { //check if last subject for today

                                                    $quota_checker -= ($h - $g); // subtracts the time hours spent based on the last subject time out
                                                }

                                                if ($quota_checker > $quota) {
                                                    $o = 0; // points for overload
                                                    $o = $quota_checker - $quota;

                                                    $ov = $o >= 900 ? $this->calculate_daily_overload($o) : 0; //if 15 mins has passed, calculate overload
                                                    $overtime_total += $ov;
                                                }
                                            }
                                        }
                                        // echo $quota_checker;
                                    } else {

                                        foreach (@$tempschedarr as $key => $subject) {

                                            $timein = date("H:i:s", strtotime($log->timein_pm));
                                            $schedstart = date("H:i:s", strtotime($subject['start_time']));
                                            $time_in = strtotime($timein);
                                            $sched_start = strtotime($schedstart);
                                            $tardiness_minutes = (int) (($time_in - $sched_start) / 60);

                                            if ($tardiness_minutes > 0) { // updated code to check only if late
                                                echo 'late?' . $tardiness_minutes;
                                                $t += $tardiness_minutes; //total daily
                                                $tard_total += $tardiness_minutes;
                                            }

                                            $schedend = date("H:i:s", strtotime($subject['end_time']));
                                            $sched_end = strtotime($schedend);
                                            $timeout = date("H:i:s", strtotime($log->timeout_pm));
                                            $time_out = strtotime($timeout);
                                            $quota_checker = ($time_out - $time_in);

                                            // undertime
                                            if (@$arrsize == $key + 1 || $time_out < $sched_end) {
                                                $undertime_afternoon_minutes = floor((($time_out - $sched_end) / 60));
                                                if ($quota_checker < $quota && $undertime_afternoon_minutes > 0) {
                                                    $ut += $undertime_afternoon_minutes;
                                                }
                                            }

                                            // overload
                                            if (@$arrsize == $key + 1 && $time_out > $sched_end) {
                                                $quota_checker -= ($time_out - $sched_end);
                                            }

                                            if ($quota_checker > $quota) {
                                                $o = 0; // points for overload
                                                $o = $quota_checker - $quota;

                                                $ov = $o >= 900 ? $this->calculate_daily_overload($o) : 0; //if 15 mins has passed, calculate overload
                                                $overtime_total += $ov;
                                            }
                                        }
                                    }

                                    $undertime_tard_daily[$day] = [
                                        "day" => $day,
                                        "ut_daily" => $ut,
                                        "t_daily" => $t,
                                    ];

                                    break;
                                }
                            } // end of if date checker

                        } //end log foreach loop
                    }
                    // if (!$absent_checker) {
                    //     $bi = strlen($day) < 2 ? 0 . $day : $day;
                    //     $date_absent = $month . '-' . $bi;
                    //     array_push($absent_dates, $date_absent);
                    // }
                } elseif ($month == date('m') && $day > date('j')) {
                    $absent_count--;
                    $absent_checker = true;
                }

                if (!$absent_checker) {
                    $bi = strlen($day) < 2 ? 0 . $day : $day;
                    $date_absent = $month . '-' . $bi;
                    array_push($absent_dates, $date_absent);
                }

                if (!isset($undertime_tard_daily[$day])) {
                    $undertime_tard_daily[$day] = [];
                }
                if (!isset($overload_daily[$day])) {
                    $overload_daily[$day] = [];
                }
                $ov = 0;
                $ut = 0;
                $t = 0;
                $quota = 0;
            }

            $undertime_tard_total = $undertime_total + $tard_total;
            $val->ut = $undertime_total;
            $val->tt = $tard_total;
            $val->utt = $undertime_tard_total;
            $val->daily = $undertime_tard_daily;
            $val->absent_count = $absent_count;
            $val->dates_absent = $absent_dates;
            // var_dump($absent_dates);
            $undertime_total = 0;
            $tard_total = 0;
            $absent_count = 0;
            $undertime_tard_total = 0;
            $undertime_tard_daily = [];
            $absent_dates = [];

            // $data_to_send["data"][] = $val;

        } /* end of faculty foreach loop */

        return $data_to_send;
    }

    public function get_logs($ID)
    {
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->log);
        $this->db->where('FacultyID', $ID);
        $logs = $this->db->get()->result();
        // var_dump($logs);
        return $logs;
    }

    public function get_leave_dates($ID)
    {
        $leave_arr = [];
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->leave_dates);
        $this->db->where('FacultyID', $ID);
        $leave = $this->db->get()->result();
        // var_dump($logs);
        foreach ($leave as $val) {
            $leave_arr[] = $val->leaveDate;
        }
        return $leave;
    }

    public function get_leave_type($ID)
    {
        $this->db->select(
            'LeaveType'
        );
        $this->db->from($this->Table->leave_type);
        $this->db->where('ID', $ID);
        $leave = $this->db->get()->row();
        return $leave;
    }

    public function get_faculty()
    {
        $user_type = ["1", "5"];
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->user);
        // $this->db->where_in('User_type', $this->user_type);
        $this->db->where_in('User_type', $user_type);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_sched($ID)
    {
        $this->db->select('*');
        $this->db->where('Faculty_id', $ID);
        $this->db->where('Active', 1);
        $this->db->order_by("STR_TO_DATE(Start_time, '%h:%i %p') ASC");
        $this->db->from($this->Table->sched);
        // Moved 'ASC' outside STR_TO_DATE() function
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_csf_48() // DTR
    {
        $data_to_send = [];

        $selected_month = $this->month;

        $date_parts = explode("-", $selected_month);

        $year = $date_parts[0];
        $month = $date_parts[1];

        $days_in_selected_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $quota = 0;
        $ot = 0;
        $data_to_send = [];
        $undertime_total = 0;
        $ut = 0;
        $overtime_total = 0;
        $undertime_tard_daily = array();
        $logs_data = array();
        $quota_total = 0;
        $quota_checker = 0;
        $dateObj = DateTime::createFromFormat('!m', $month);
        $monthInWords = $dateObj->format('F');
        $monthInAbbv = $dateObj->format('M');

        $data_to_send['selected_month'] = "$monthInWords 1 - $days_in_selected_month, $year";
        $data_to_send['num_of_days'] = $days_in_selected_month;
        $holiday = $this->get_holidays($year, $month);
        $user_type = ["1", "5"];
        $this->db->select(
            '*'
        );
        $this->db->from($this->Table->user);
        $this->db->where_in('User_type', $user_type);
        $this->db->where('ID', $this->faculty);
        $faculty_deets = $this->db->get()->row();
        $data_to_send['faculty_details'] = $faculty_deets;
        // var_dump($faculty_deets);

        if ($faculty_deets) {
            $logs = $this->get_logs($data_to_send['faculty_details']->ID);
            $sched = $this->get_sched($data_to_send['faculty_details']->ID);

            // var_dump($logs);
            $this->db->select('*');
            $this->db->where('faculty_id', $data_to_send['faculty_details']->ID);
            $this->db->where('MONTH(from_date)', $month);
            $this->db->where('YEAR(from_date)', $year);
            $this->db->from($this->Table->exam_schedule);
            $exam_sched = $this->db->get()->result();

            $exam_sched_arrdays = array();
            @$start_exam_day = date('j', strtotime($exam_sched[0]->from_date));
            @$end_exam_day = date('j', strtotime($exam_sched[0]->to_date));

            for ($start_exam_day; $start_exam_day <= $end_exam_day; $start_exam_day++) {
                $exam_sched_arrdays[] = $year . '-' . $month . '-' . $start_exam_day;
            }

            $numberOfDaysInMonth = $data_to_send['num_of_days'];
            $daysArray = range(1, $numberOfDaysInMonth);

            foreach ($daysArray as $day) {
                // echo $day.'<br>';
                $quota_checker = 0;
                $am_count = 0;
                $ot = 0;
                $tempschedarr = array();
                $dayOfWeek = strtolower(date("l", strtotime($day . "-" . $month . "-" . $year))); //Use any date from $selected_month

                foreach ($sched as $schedule) {
                    // Check if the day of the week matches the 'Day' field in the schedule

                    if (strtolower($schedule->Day) === $dayOfWeek) {
                        // var_dump($schedule);

                        $am_count += substr_count(strtolower($schedule->time_frame), 'am');
                        $quota = $quota == 0 ? $schedule->scheme : $quota;

                        $tempschedarr[] = array(
                            'start_time' => $schedule->Start_time,
                            'end_time' => $schedule->End_time,
                            'time_frame' => $schedule->time_frame,
                        );
                    }
                }

                @$arrsize = sizeof(@$tempschedarr);

                foreach ($logs as $k => $log) {

                    if (in_array($this->month . '-' . $day, $holiday)) {
                        break;
                    }
                    if ($this->month . '-' . $day == date("Y-m-j", strtotime($log->date_log))) {
                        $quota = $quota * 3600;
                        $logs_data[$day] = [
                            "am_in" => $log->timein_am ?? '-',
                            "am_out" => $log->timeout_am ?? '-',
                            "pm_in" => $log->timein_pm ?? '-',
                            "pm_out" => $log->timeout_pm ?? '-',
                        ];

                        $quota_checker = 0;
                        if (in_array($this->month . '-' . $day, $exam_sched_arrdays)) {
                            $quota = 18000;
                            $quota_checker = 0;

                            //checks for undertime
                            $timein = date("H:i:s", strtotime($log->timein_am == null ? $log->timein_pm : $log->timein_am));
                            $timeout = date("H:i:s", strtotime($log->timeout_am == null ? $log->timeout_pm : $log->timeout_am));
                            $time_in = strtotime($timein);
                            $time_out = strtotime($timeout);
                            $quota_checker = $time_out - $time_in;
                            if ($quota_checker < $quota) {
                                $ut += floor((($quota - $quota_checker) / 60));
                                $undertime_total += floor((($quota - $quota_checker) / 60));
                            }
                            $undertime_tard_daily[$day] = $ut;
                            break;
                        } else {

                            //checker to check if current schedule of the day contains any AM subject. standard schedule format
                            if (strpos(@$tempschedarr[0]['time_frame'], 'AM') !== false) {

                                $b = 0;
                                $start_day = 0;
                                $late_time = 0;

                                foreach ($tempschedarr as $key => $subject) {

                                    if ($subject['time_frame'] == "AM") {

                                        //for am late detection
                                        $amsched = date("H:i:s", strtotime(@$tempschedarr[0]['start_time']));
                                        $amschedout = date("H:i:s", strtotime($subject['end_time']));
                                        $amtimein = date("H:i:s", strtotime($log->timein_am));
                                        $a = strtotime($amsched); // am schedule start 
                                        $b = strtotime($amtimein); // am timein
                                        $eto = strtotime($amschedout);
                                        $start_day = date("H:i:s", strtotime(@$tempschedarr[0]['start_time']));
                                        $start_day = strtotime($start_day);

                                        $tardiness_minutes = (int) (($b - $a) / 60);
                                        if ($tardiness_minutes > 0 && @$tempschedarr[0]['start_time'] == $subject['start_time']) {
                                            // $t += $tardiness_minutes; //total daily
                                            $late_time = $tardiness_minutes * 60;
                                            // $tard_total += $tardiness_minutes;
                                        }
                                        //checker if user decides to time out in the morning

                                        // $time_out = date("H:i:s", strtotime($log->timeout_pm == null ? $log->timeout_am : $log->timeout_pm));
                                        //checks if current looped subject is 2nd morning subject
                                        if (@$am_count == $key + 1) {

                                            // if (@$am_count == $key + 1 && date("H:i:s", strtotime('10:00:00')) >= $amsched || date("H:i:s", strtotime('12:00:00')) <= $amsched) {
                                            $time_out = date("H:i:s", strtotime($log->timeout_pm == null ? $log->timeout_am : $log->timeout_pm));
                                            if ($time_out <= "13:00:00") {
                                                $h = strtotime($time_out);
                                                $quota_checker += ($h - $a);
                                                $undertime_earlyout_minutes = floor((($eto - $h) / 60));
                                                // echo $quota_checker.' '.$quota;
                                                if ($quota_checker < $quota) {
                                                    $ut += floor(($quota - $quota_checker) / 60);
                                                    $undertime_total += floor(($quota - $quota_checker) / 60);
                                                    if ($undertime_earlyout_minutes > 0) {
                                                        $ut += $undertime_earlyout_minutes;
                                                        $undertime_total += $undertime_earlyout_minutes;
                                                        // echo $ut;
                                                    }
                                                    break;
                                                }
                                            }
                                        }
                                    } else {

                                        $pmsched_out = date("H:i:s", strtotime($subject['end_time']));
                                        $pmtime_out = date("H:i:s", strtotime($log->timeout_pm));
                                        $g = strtotime($pmsched_out);
                                        $h = strtotime($pmtime_out);
                                        $undertime_afternoon_minutes = floor((($g - $h) / 60));
                                        // $quota_checker += ($h - $b) - 3600; // end time - start time
                                        if ($b < @$start_day) {
                                            $quota_checker += ($h - ($b + ($start_day - $b))) - 3600;
                                        } else {
                                            $quota_checker += ($h - $b) - 3600; // end time - start time
                                        }

                                        $undertime_afternoon_minutes = floor((($quota - $quota_checker) / 60));
                                        if ($quota_checker < $quota && $undertime_afternoon_minutes > 0) {
                                            $undertime_total += $undertime_afternoon_minutes;
                                            $ut += $undertime_afternoon_minutes;
                                        }

                                        //overload calculation 
                                        if (@$key == $arrsize - 1 && $h > $g) { //check if last subject for today
                                            $quota_checker -= ($h - $g); // subtracts the time hours spent based on the last subject time out
                                        }

                                        if ($late_time != 0) {
                                            $quota_checker = $quota_checker - $late_time;
                                        } else {
                                            $quota_checker = ($h - $b) - 3600; // end time - start time
                                        }

                                        if (@$quota < $quota_checker && $data_to_send['faculty_details']->User_type == 1 && @$key == @$arrsize - 1) {
                                            $o = 0; // points for overload
                                            $o = $quota_checker - $quota;
                                            $ov = $o >= 900 ? $this->calculate_daily_overload($o) : 0; //if 15 mins has passed, calculate overload
                                            $ot = $ov;
                                            // echo 'DAY ' . $day . 'am - ' . $o . '<br>';
                                        }

                                        $quota_checker = ($h - $start_day) - 3600; //for total hour spent       


                                    }
                                }
                            } else {

                                foreach (@$tempschedarr as $key => $subject) {

                                    $timein = date("H:i:s", strtotime($log->timein_pm));
                                    $schedstart = date("H:i:s", strtotime($subject['start_time']));
                                    $time_in = strtotime($timein);
                                    $sched_start = strtotime($schedstart);

                                    $schedend = date("H:i:s", strtotime($subject['end_time']));
                                    $sched_end = strtotime($schedend);
                                    $timeout = date("H:i:s", strtotime($log->timeout_pm));
                                    $time_out = strtotime($timeout);
                                    $quota_checker = ($time_out - $time_in);

                                    // undertime
                                    if (@$arrsize == $key + 1 || $time_out < $sched_end) {
                                        $undertime_afternoon_minutes = floor((($time_out - $sched_end) / 60));
                                        if ($quota_checker < $quota && $undertime_afternoon_minutes > 0) {
                                            $ut += $undertime_afternoon_minutes;
                                        }
                                    }
                                }
                            }

                            $undertime_tard_daily[$day] = $ut;

                            break;
                        }
                    } // end of if date checker

                } //end log foreach loop

                if (!isset($undertime_tard_daily[$day])) {
                    $undertime_tard_daily[$day] = 0;
                }

                if (!isset($logs_data[$day])) {
                    $logs_data[$day] = [
                        "am_in" => '-',
                        "am_out" => '-',
                        "pm_in" => '-',
                        "pm_out" => '-',
                    ];
                }

                $ut = 0;
                // break;
                $quota = 0;
                $q = $this->calculate_daily_overload(@$quota_checker);
                $quota_total += $q != 0 ? $q - @$ot : 0;
                $overtime_total += ($q != 0 && $ot != 0) ? @$ot : 0;
                // echo 'day ' . $day . ' -' . $q . ' ot - '. $ot .  ' ot TOTAL - '. $overtime_total .'<br>';
                // echo 'day '. $day .' -' .$quota_total.'<br>';
                // $quota_total = ;
            }

            $data_to_send['faculty_details']->ut = $undertime_total;
            $data_to_send['faculty_details']->daily = $undertime_tard_daily;
            $data_to_send['faculty_details']->logs = $logs_data;
        }
        @$data_to_send['faculty_details']->quota = @$quota_total;
        @$data_to_send['faculty_details']->ot = @$overtime_total;

        return $data_to_send;
    }

    public function get_holidays($y, $m)
    {
        $this->db->select('*');
        $this->db->where('MONTH(from_date)', $m);
        $this->db->where('YEAR(from_date)', $y);
        $this->db->where('MONTH(to_date)', $m);
        $this->db->where('YEAR(to_date)', $y);
        $this->db->from($this->Table->non_working_days);
        $result = $this->db->get()->result();
        $arr = [];
        foreach ($result as $key => $value) {

            @$start_hold = date('j', strtotime($value->from_date));
            @$end_hold = date('j', strtotime($value->to_date));
            if ($start_hold == $end_hold) {
                $arr[] = $y . '-' . $m . '-' . $start_hold;
            } else {
                for ($start_hold; $start_hold <= $end_hold; $start_hold++) {
                    $arr[] = $y . '-' . $m . '-' . $start_hold;
                }
            }
        }
        return $arr;
    }

    private function undertime_calculation()
    {
    }

    private function tardiness_calculation()
    {
    }

    private function overload_calculation()
    {
    }

    private function calculate_daily_overload($pts)
    {
        $x = $y = 0;
        $x = round($pts / 3600, 2); //divide per hr then round off
        $y = $x - (int) $x; //get decimal 1.80 -1.00 = 0.80
        // echo 'X-' . ($x - (int) $x ).'<br>';
        // echo $x .'<br>';

        $y = $y >= 0.25 ? ($y >= 0.5 ? ($y >= 0.75 ? 0.75 : 0.5) : 0.25) : 0; //round off to specific point
        // echo $y .'<br>';
        $x = (int) $x + $y; //finalize point 1.00 + 0.75
        return $x;
    }
}
