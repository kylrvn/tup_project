<?php
// Define arrays to store timein_am and timeout_pm for each day
$timein_am = [];
$timeout_pm = [];
$exam_schedule = [];
$day_dtr = [];
$late_undertime = [];
$overtime = [];


foreach ($exam_Schedule as $key => $dates) {

    $period = new DatePeriod(
        new DateTime($dates->from_date),
        new DateInterval('P1D'),
        new DateTime($dates->to_date . '+' . 1)
    );
    foreach ($period as $key => $value) {
        $day_exam_sched = $value->format('l');
        $exam_schedule[$day_exam_sched] = $value->format('Y-m-d');
    }
}

$currentDate = new DateTime();


$currentDate->modify('this week');
$startOfWeek = $currentDate->format('Y-m-d');


$currentDate->modify('this sunday');
$endOfWeek = $currentDate->format('Y-m-d');


foreach ($dtr_logs as $log) {

    if (!empty($log->timein_am)) {
        $day = date('l', strtotime($log->timein_am));
    } else {
        $day = date('l', strtotime($log->timein_pm));
    }


    $logDate = date('Y-m-d', strtotime($log->date_log));


    if ($logDate >= $startOfWeek && $logDate <= $endOfWeek && date('N', strtotime($logDate)) != 7) {
        $timein_am[$day] = $log->timein_am;
        $timeout_am[$day] = $log->timeout_am;
        $timein_pm[$day] = $log->timein_pm;
        $timeout_pm[$day] = $log->timeout_pm;
        $day_dtr[$day] = $logDate;
    } else {
        $timein_am[$day] = $log->timein_am;
        $timeout_am[$day] = $log->timeout_am;
        $timein_pm[$day] = $log->timein_pm;
        $timeout_pm[$day] = $log->timeout_pm;
        $day_dtr[$day] = $logDate;
    }
}


foreach ($exam_schedule as $key => $value) {

    if (isset($day_dtr[$key]) && $value == $day_dtr[$key] && $value != null) {

        $timein_am[$key] = isset($timein_am[$key]) ? $timein_am[$key] : '';
        $timeout_pm[$key] = isset($timeout_pm[$key]) ? $timeout_pm[$key] : '';
        $monday_timein_am = isset($timein_am['Monday']) ? $timein_am['Monday'] : '';
        $monday_timeout_am = isset($timeout_am['Monday']) ? $timeout_am['Monday'] : '';

        $monday_timein_pm = isset($timein_pm['Monday']) ? $timein_pm['Monday'] : '';
        $monday_timeout_pm = isset($timeout_pm['Monday']) ? $timeout_pm['Monday'] : '';

        $tuesday_timein_am = isset($timein_am['Tuesday']) ? $timein_am['Tuesday'] : '';
        $tuesday_timeout_am = isset($timeout_am['Tuesday']) ? $timeout_am['Tuesday'] : '';
        $tuesday_timein_pm = isset($timein_pm['Tuesday']) ? $timein_pm['Tuesday'] : '';
        $tuesday_timeout_pm = isset($timeout_pm['Tuesday']) ? $timeout_pm['Tuesday'] : '';

        $wednesday_timein_am = isset($timein_am['Wednesday']) ? $timein_am['Wednesday'] : '';
        $wednesday_timeout_am = isset($timeout_am['Wednesday']) ? $timeout_am['Wednesday'] : '';
        $wednesday_timein_pm = isset($timein_pm['Wednesday']) ? $timein_pm['Wednesday'] : '';
        $wednesday_timeout_pm = isset($timeout_pm['Wednesday']) ? $timeout_pm['Wednesday'] : '';

        $thursday_timein_am = isset($timein_am['Thursday']) ? $timein_am['Thursday'] : '';
        $thursday_timeout_am = isset($timeout_am['Thursday']) ? $timeout_am['Thursday'] : '';
        $thursday_timein_pm = isset($timein_pm['Thursday']) ? $timein_pm['Thursday'] : '';
        $thursday_timeout_pm = isset($timeout_pm['Thursday']) ? $timeout_pm['Thursday'] : '';

        $friday_timein_am = isset($timein_am['Friday']) ? $timein_am['Friday'] : '';
        $friday_timeout_am = isset($timeout_am['Friday']) ? $timeout_am['Friday'] : '';
        $friday_timeout_pm = isset($timeout_pm['Friday']) ? $timeout_pm['Friday'] : '';
        $friday_timein_pm = isset($timein_pm['Friday']) ? $timein_pm['Friday'] : '';

        $saturday_timein_am = isset($timein_am['Saturday']) ? $timein_am['Saturday'] : '';
        $saturday_timeout_am = isset($timeout_am['Saturday']) ? $timeout_am['Saturday'] : '';
        $saturday_timein_pm = isset($timein_pm['Saturday']) ? $timein_pm['Saturday'] : '';
        $saturday_timeout_pm = isset($timeout_pm['Saturday']) ? $timeout_pm['Saturday'] : '';

        @$mti = isset($timein_am['Monday']) ? $timein_am['Monday'] : $timein_pm['Monday'];
        @$mto = isset($timeout_pm['Monday']) ? $timeout_pm['Monday'] : $timeout_am['Monday'];
        @$tti = isset($timein_am['Tuesday']) ? $timein_am['Tuesday'] : $timein_pm['Tuesday'];
        @$tto = isset($timeout_pm['Tuesday']) ? $timeout_pm['Tuesday'] : $timeout_am['Tuesday'];
        @$wti = isset($timein_am['Wednesday']) ? $timein_am['Wednesday'] : $timein_pm['Wednesday'];
        @$wto = isset($timeout_pm['Wednesday']) ? $timeout_pm['Wednesday'] : $timeout_am['Wednesday'];
        @$thti = isset($timein_am['Thursday']) ? $timein_am['Thursday'] : $timein_pm['Thursday'];
        @$thto = isset($timeout_pm['Thursday']) ? $timeout_pm['Thursday'] : $timeout_am['Thursday'];
        @$fti = isset($timein_am['Friday']) ? $timein_am['Friday'] : $timein_pm['Friday'];
        @$fto = isset($timeout_pm['Friday']) ? $timeout_pm['Friday'] : $timeout_am['Friday'];
        @$satti = isset($timein_am['Saturday']) ? $timein_am['Saturday'] : $timein_pm['Saturday'];
        @$satto = isset($timeout_pm['Saturday']) ? $timeout_pm['Saturday'] : $timeout_am['Saturday'];
    }
}
// $timein_am[$key] = isset($timein_am[$key]) ? $timein_am[$key] : '';
// $timeout_pm[$key] = isset($timeout_pm[$key]) ? $timeout_pm[$key] : '';
$monday_timein_am = isset($timein_am['Monday']) ? $timein_am['Monday'] : '';
$monday_timeout_am = isset($timeout_am['Monday']) ? $timeout_am['Monday'] : '';

$monday_timein_pm = isset($timein_pm['Monday']) ? $timein_pm['Monday'] : '';
$monday_timeout_pm = isset($timeout_pm['Monday']) ? $timeout_pm['Monday'] : '';
// echo json_encode($monday_timein_pm);
$tuesday_timein_am = isset($timein_am['Tuesday']) ? $timein_am['Tuesday'] : '';
$tuesday_timeout_am = isset($timeout_am['Tuesday']) ? $timeout_am['Tuesday'] : '';
$tuesday_timein_pm = isset($timein_pm['Tuesday']) ? $timein_pm['Tuesday'] : '';
$tuesday_timeout_pm = isset($timeout_pm['Tuesday']) ? $timeout_pm['Tuesday'] : '';

$wednesday_timein_am = isset($timein_am['Wednesday']) ? $timein_am['Wednesday'] : '';
$wednesday_timeout_am = isset($timeout_am['Wednesday']) ? $timeout_am['Wednesday'] : '';
$wednesday_timein_pm = isset($timein_pm['Wednesday']) ? $timein_pm['Wednesday'] : '';
$wednesday_timeout_pm = isset($timeout_pm['Wednesday']) ? $timeout_pm['Wednesday'] : '';

$thursday_timein_am = isset($timein_am['Thursday']) ? $timein_am['Thursday'] : '';
$thursday_timeout_am = isset($timeout_am['Thursday']) ? $timeout_am['Thursday'] : '';
$thursday_timein_pm = isset($timein_pm['Thursday']) ? $timein_pm['Thursday'] : '';
$thursday_timeout_pm = isset($timeout_pm['Thursday']) ? $timeout_pm['Thursday'] : '';

$friday_timein_am = isset($timein_am['Friday']) ? $timein_am['Friday'] : '';
$friday_timeout_am = isset($timeout_am['Friday']) ? $timeout_am['Friday'] : '';
$friday_timeout_pm = isset($timeout_pm['Friday']) ? $timeout_pm['Friday'] : '';
$friday_timein_pm = isset($timein_pm['Friday']) ? $timein_pm['Friday'] : '';

$saturday_timein_am = isset($timein_am['Saturday']) ? $timein_am['Saturday'] : '';
$saturday_timeout_am = isset($timeout_am['Saturday']) ? $timeout_am['Saturday'] : '';
$saturday_timein_pm = isset($timein_pm['Saturday']) ? $timein_pm['Saturday'] : '';
$saturday_timeout_pm = isset($timeout_pm['Saturday']) ? $timeout_pm['Saturday'] : '';
$dayDetails = [];
foreach ($details as $detail) {
    $day = $detail->Day;
    if (!isset($dayDetails[$day])) {
        $dayDetails[$day] = [];
    }
    $dayDetails[$day][] = $detail;
}


@$mondayDetails = @$dayDetails['monday'];
@$tuesdayDetails = @$dayDetails['tuesday'];
@$wednesdayDetails = @$dayDetails['wednesday'];
@$thursdayDetails = @$dayDetails['thursday'];
@$fridayDetails = @$dayDetails['friday'];
@$saturdayDetails = @$dayDetails['saturday'];


@$firstMondayItem = reset($mondayDetails);
@$firstTuesdayItem = reset($tuesdayDetails);
@$firstWednesdayItem = reset($wednesdayDetails);
@$firstThursdayItem = reset($thursdayDetails);
@$firstFridayItem = reset($fridayDetails);
@$firstSaturdayItem = reset($saturdayDetails);

@$lastMondayItem = end($mondayDetails);
@$lastTuesdayItem = end($tuesdayDetails);
@$lastWednesdayItem = end($wednesdayDetails);
@$lastThursdayItem = end($thursdayDetails);
@$lastFridayItem = end($fridayDetails);
@$lastSaturdayItem = end($saturdayDetails);

for ($i = 0; $i < 6; $i++) {
    switch ($i) {
        case 0:
            @$x = check_late($mti, $firstMondayItem);
            @$y = check_undertime($mti, $firstMondayItem, $mto, $lastMondayItem);
            @$z = get_overtime($mti, $firstMondayItem, $mto, $lastMondayItem);
            $late_undertime[$i]['ut'] = @$y;
            $late_undertime[$i]['lt'] = @$x;
            $overtime[$i] = @$z;
            break;
        case 1:
            @$x = check_late($tti, $firstTuesdayItem);
            @$y = check_undertime($tti, $firstTuesdayItem, $tto, $lastTuesdayItem);
            @$z = get_overtime($tti, $firstTuesdayItem, $tto, $lastTuesdayItem);
            $late_undertime[$i]['ut'] = @$y;
            $late_undertime[$i]['lt'] = @$x;
            $overtime[$i] = @$z;
            break;
        case 2:
            @$x = check_late($wti, $firstWednesdayItem);
            @$y = check_undertime($wti, $firstWednesdayItem, $wto, $lastWednesdayItem);
            @$z = get_overtime($wti, $firstWednesdayItem, $wto, $lastWednesdayItem);
            $late_undertime[$i]['ut'] = @$y;
            $late_undertime[$i]['lt'] = @$x;
            $overtime[$i] = @$z;
            break;
        case 3:
            @$x = check_late($thti, $firstThursdayItem);
            @$y = check_undertime($tti, $firstThursdayItem, $thto, $lastThursdayItem);
            @$z = get_overtime($thti, $firstThursdayItem, $thto, $lastThursdayItem);
            $late_undertime[$i]['ut'] = @$y;
            $late_undertime[$i]['lt'] = @$x;
            $overtime[$i] = @$z;
            break;
        case 4:
            @$x = check_late($fti, $firstFridayItem);
            @$y = check_undertime($fti, $firstFridayItem, $fto, $lastFridayItem);
            @$z = get_overtime($fti, $firstFridayItem, $fto, $lastFridayItem);
            $late_undertime[$i]['ut'] = @$y;
            $late_undertime[$i]['lt'] = @$x;
            $overtime[$i] = @$z;
            break;
        case 5:
            @$x = check_late($satti, $firstSaturdayItem);
            @$y = check_undertime($satti, $firstSaturdayItem, $satto, $lastSaturdayItem);
            @$z = get_overtime($satti, $firstSaturdayItem, $satto, $lastSaturdayItem);
            $late_undertime[$i]['ut'] = @$y;
            $late_undertime[$i]['lt'] = @$x;
            $overtime[$i] = @$z;
            break;
    }
}

function calculateEndTime($startTime)
{
    $newEndTime = strtotime('+5 hours', strtotime($startTime));

    $lunchStart = strtotime('12:00 PM');
    $lunchEnd = strtotime('1:00 PM');

    $newEndTime = ($newEndTime >= $lunchStart && $newEndTime < $lunchEnd) ? strtotime('+1 hour', $newEndTime) : $newEndTime;
    $newEndTime = ($newEndTime >= $lunchEnd) ? strtotime('+1 hour', $newEndTime) : $newEndTime;

    return date('h:i:a', $newEndTime);
}

function check_undertime($ti, $sti, $to, $sto)
{
    $quota = 18000;
    $quota_checker = strtotime($to) - strtotime($ti);

    if ($to!=null && $sto != null && $quota_checker < $quota) {
        $to = strtotime($to);
        $sto = strtotime($sto);
        $u = floor((($sto - $to) / 60));
        return $u;
    } else {
        $u = 0;
        return $u;
    }
}

function check_late($ti, $sti)
{
    if ($ti!=null && $sti!=null && $ti > $sti) {
        $ti = strtotime($ti);
        $sti = strtotime($sti);
        $tardiness_minutes = (int) (($ti - $sti) / 60); // divide by 60 to get minutes format
        if ($tardiness_minutes > 0 && $ti!=null && $sti!=null) {
            $t = $tardiness_minutes;
            return $t;
        } else {
            $t = 0;
            return $t;
        }
    } else {
        $t = 0;
        return $t;
    }
}

function calculate_overload($pts)
{
    @$x = @$y = 0;
    @$x = round($pts / 3600, 2); //divide per hr then round off
    @$y = @$x - (int) @$x; //get decimal 1.80 -1.00 = 0.80
    @$y = @$y >= 0.25 ? (@$y >= 0.5 ? (@$y >= 0.75 ? 0.75 : 0.25) : 0.5) : 0; //round off to specific point
    @$x = (int) @$x + @$y; //finalize point 1.00 + 0.75
    return @$x;
}


function get_overtime($ti, $sti, $to, $sto)
{
    $quota = 18000;
    if ($to!=null && $sto!=null & $to > $sto ) {
        $to = strtotime($to);
        $sto = strtotime($sto);
        $ti = strtotime($ti);
        $quota_checker = ($to - $ti) - ($to - $sto);

        $ot = $quota_checker - $quota;
        $ot = $ot >= 900 ? calculate_overload($ot) : 0;
        return $ot;
    } else {
        return 0;
    }
}

var_dump(@$mondayDetails);
?>

<div id="schedule_container">
    <table>
        <div class="text-center" style="width: 5 rem; margin-top:1rem;">
            <input class="form form-control-sm datetimepicker-input" id="search_date" type="date">
            <input class="btn btn-danger btn-sm" type="submit" id="search_btn">
        </div>
        <tr>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
        </tr>
        <tr>
            <td>
                <strong>Start Time:<br></strong><label><?= !empty($firstMondayItem->Start_time) ? date('h:i a', strtotime($firstMondayItem->Start_time)) : '' ?></label><br><br>
                <strong>End Time:<br></strong><label><?= !empty($lastMondayItem->End_time) ? date('h:i a', strtotime($lastMondayItem->End_time)) : '' ?></label><br><br>
                <strong>Time In: <br><?= !empty($monday_timein_am) ? date('h:i a', strtotime($monday_timein_am)) : (!empty($monday_timein_pm) ? date('h:i a', strtotime($monday_timein_pm)) : ' ') ?></strong> <br><br>
                <strong>Time Out: <br><?= !empty($monday_timeout_pm) ? date('h:i a', strtotime($monday_timeout_pm)) : (!empty($monday_timeout_am) ? date('h:i a', strtotime($monday_timeout_am)) : ' ') ?></strong> <br><br><br><br>

                <strong>Status: <?php echo @(reset($mondayDetails)->Active == 1) ? '<label style="color:green">ACTIVE</label>' : '' ?></strong><br><br><br>
                <?php if (@$late_undertime[0]['ut']!= null || @$late_undertime[0]['lt']!= null) { ?>
                    <strong> <?=@$late_undertime[0]['lt']?> MINS LATE </strong><br>
                    <strong> <?=@$late_undertime[0]['ut']?> MINS UNDERTIME </strong><br>
                <?php } else {
                    echo '<strong>COMPLETED</strong><br>';
                } ?>
                <strong>Overload: <?= @$overtime[0] * 60 ?> MINS</strong><br>
            </td>

            <td>
                <strong>Start Time:<br></strong><label><?= !empty($firstTuesdayItem->Start_time) ? calculateEndTime($lastTuesdayItem->Start_time) : '' ?></label><br><br>
                <strong>End Time:<br></strong><label><?= !empty($lastTuesdayItem->End_time) ? calculateEndTime($firstTuesdayItem->End_time) : '' ?></label><br><br>

                <strong>Time In: <br><?= !empty($tuesday_timein_am) ? date('h:i a', strtotime($tuesday_timein_am)) : (!empty($tuesday_timein_pm) ? date('h:i a', strtotime($tuesday_timein_pm)) : ' ') ?></strong> <br><br>
                <strong>Time Out: <br><?= !empty($tuesday_timeout_pm) ? date('h:i a', strtotime($tuesday_timeout_pm)) : (!empty($tuesday_timeout_am) ? date('h:i a', strtotime($tuesday_timeout_am)) : ' ') ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($tuesdayDetails)->Active == 1) ? '<label style="color:green">ACTIVE</label>' : '' ?></strong><br><br><br>
                <?php if (@$late_undertime[1]['ut']!= null || @$late_undertime[1]['lt']!= null) { ?>
                    <strong> <?=@$late_undertime[1]['lt']?> MINS LATE </strong><br>
                    <strong> <?=@$late_undertime[1]['ut']?> MINS UNDERTIME </strong><br>
                <?php } else {
                    echo '<strong>COMPLETED</strong><br>';
                } ?>
                <strong>Overload: <?= @$overtime[1] * 60 ?> MINS</strong><br>
            </td>

            <td>
                <strong>Start Time:<br></strong><label><?= !empty($firstWednesdayItem->Start_time) ? calculateEndTime($lastWednesdayItem->Start_time) : '' ?></label><br><br>
                <strong>End Time:<br></strong><label><?= !empty($lastWednesdayItem->End_time) ? calculateEndTime($firstWednesdayItem->End_time) : '' ?></label><br><br>
                <strong>Time In: <br><?= !empty($wednesday_timein_am) ? date('h:i a', strtotime($wednesday_timein_am)) : (!empty($wednesday_timein_pm) ? date('h:i a', strtotime($wednesday_timein_pm)) : ' ') ?></strong> <br><br>
                <strong>Time Out: <br><?= !empty($wednesday_timeout_pm) ? date('h:i a', strtotime($wednesday_timeout_pm)) : (!empty($wednesday_timeout_am) ? date('h:i a', strtotime($wednesday_timeout_am)) : ' ') ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($wednesdayDetails)->Active == 1) ? '<label style="color:green">ACTIVE</label>' : '' ?></strong><br><br><br>
                <?php if (@$late_undertime[2]['ut']!= null || @$late_undertime[2]['lt']!= null) { ?>
                    <strong> <?=@$late_undertime[2]['lt']?> MINS LATE </strong><br>
                    <strong> <?=@$late_undertime[2]['ut']?> MINS UNDERTIME </strong><br>
                <?php } else {
                    echo '<strong>COMPLETED</strong><br>';
                } ?>
                <strong>Overload: <?= @$overtime[2] * 60 ?> MINS</strong><br>
            </td>

            <td>
                <strong>Start Time:<br></strong><label><?= !empty($firstThursdayItem->Start_time) ? calculateEndTime($lastThursdayItem->Start_time) : '' ?></label><br><br>
                <strong>End Time:<br></strong><label><?= !empty($lastThursdayItem->End_time) ? calculateEndTime($firstThursdayItem->End_time) : '' ?></label><br><br>
                <strong>Time In: <br><?= !empty($thursday_timein_am) ? date('h:i a', strtotime($thursday_timein_am)) : (!empty($thursday_timein_pm) ? date('h:i a', strtotime($thursday_timein_pm)) : ' ') ?></strong> <br><br>
                <strong>Time Out: <br><?= !empty($thursday_timeout_pm) ? date('h:i a', strtotime($thursday_timeout_pm)) : (!empty($thursday_timeout_am) ? date('h:i a', strtotime($thursday_timeout_am)) : ' ') ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($thursdayDetails)->Active == 1) ? '<label style="color:green">ACTIVE</label>' : '' ?></strong><br><br><br>
                <?php if (@$late_undertime[3]['ut']!= null || @$late_undertime[3]['lt']!= null) { ?>
                    <strong> <?=@$late_undertime[3]['lt']?> MINS LATE </strong><br>
                    <strong> <?=@$late_undertime[3]['ut']?> MINS UNDERTIME </strong><br>
                <?php } else {
                    echo '<strong>COMPLETED</strong><br>';
                } ?>
                <strong>Overload: <?= @$overtime[3] * 60 ?> MINS</strong><br>
            </td>

            <td>
                <strong>Start Time:<br></strong><label><?= !empty($firstFridayItem->Start_time) ? calculateEndTime($lastFridayItem->Start_time) : '' ?></label><br><br>
                <strong>End Time:<br></strong><label><?= !empty($lastFridayItem->End_time) ? calculateEndTime($firstFridayItem->End_time) : '' ?></label><br><br>
                <strong>Time In: <br><?= !empty($friday_timein_am) ? date('h:i a', strtotime($friday_timein_am)) : (!empty($friday_timein_pm) ? date('h:i a', strtotime($friday_timein_pm)) : ' ') ?></strong> <br><br>
                <strong>Time Out: <br><?= !empty($friday_timeout_pm) ? date('h:i a', strtotime($friday_timeout_pm)) : (!empty($friday_timeout_am) ? date('h:i a', strtotime($friday_timeout_am)) : ' ') ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($fridayDetails)->Active == 1) ? '<label style="color:green">ACTIVE</label>' : '' ?></strong><br><br><br>
                <?php if (@$late_undertime[4]['ut']!= null || @$late_undertime[4]['lt']!= null) { ?>
                    <strong> <?=@$late_undertime[4]['lt']?> MINS LATE </strong><br>
                    <strong> <?=@$late_undertime[4]['ut']?> MINS UNDERTIME </strong><br>
                <?php } else {
                    echo '<strong>COMPLETED</strong><br>';
                } ?>
                <strong>Overload: <?= @$overtime[4] * 60 ?> MINS</strong><br>
            </td>

            <td>
                <strong>Start Time:<br></strong><label><?= !empty($firstSaturdayItem->Start_time) ? calculateEndTime($lastSaturdayItem->Start_time) : '' ?></label><br><br>
                <strong>End Time:<br></strong><label><?= !empty($lastSaturdayItem->End_time) ? calculateEndTime($firstSaturdayItem->End_time) : '' ?></label><br><br>
                <strong>Time In: <br><?= !empty($saturday_timein_am) ? date('h:i a', strtotime($saturday_timein_am)) : (!empty($saturday_timein_pm) ? date('h:i a', strtotime($saturday_timein_pm)) : ' ') ?></strong> <br><br>
                <strong>Time Out: <br><?= !empty($saturday_timeout_pm) ? date('h:i a', strtotime($saturday_timeout_pm)) : (!empty($saturday_timeout_am) ? date('h:i a', strtotime($saturday_timeout_am)) : ' ') ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($saturdayDetails)->Active == 1) ? '<label style="color:green">ACTIVE</label>' : '' ?></strong><br><br><br>
                <?php if (@$late_undertime[5]['ut']!= null || @$late_undertime[5]['lt']!= null) { ?>
                    <strong> <?=@$late_undertime[5]['lt']?> MINS LATE </strong><br>
                    <strong> <?=@$late_undertime[5]['ut']?> MINS UNDERTIME </strong><br>
                <?php } else {
                    echo '<strong>COMPLETED</strong><br>';
                } ?>
                <strong>Overload: <?= @$overtime[5] * 60 ?> MINS</strong><br>
            </td>

        </tr>
    </table>
</div>
<script src="<?php echo base_url() ?>/assets/js/dashboard/calendar.js"></script>