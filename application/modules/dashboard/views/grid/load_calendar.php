<?php
// Define arrays to store timein_am and timeout_pm for each day
$timein_am = [];
$timeout_pm = [];
$exam_schedule = [];
$day_dtr = [];

foreach($exam_Schedule as $key => $dates){
   
    $period = new DatePeriod(
        new DateTime($dates->from_date),
        new DateInterval('P1D'),
        new DateTime($dates->to_date.'+'. 1)
    );
    foreach($period as $key => $value){
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

    $day = date('l', strtotime($log->timein_am));
    

    $logDate = date('Y-m-d', strtotime($log->date_log));
    
 
    if ($logDate >= $startOfWeek && $logDate <= $endOfWeek && date('N', strtotime($logDate)) != 7) {
        $timein_am[$day] = $log->timein_am;
        $timeout_pm[$day] = $log->timeout_pm;
        $day_dtr[$day] = $logDate; 
    }
    else{
        $timein_am[$day] = $log->timein_am;
        $timeout_pm[$day] = $log->timeout_pm;
        $day_dtr[$day] = $logDate;
    }
}


foreach ($exam_schedule as $key => $value) {

    if (isset($day_dtr[$key]) && $value == $day_dtr[$key] && $value != null) {

        $timein_am[$key] = isset($timein_am[$key]) ? $timein_am[$key] : '';
        $timeout_pm[$key] = isset($timeout_pm[$key]) ? $timeout_pm[$key] : '';
        $monday_timein_am = isset($timein_am['Monday']) ? $timein_am['Monday'] : '';
        $monday_timeout_pm = isset($timeout_pm['Monday']) ? $timeout_pm['Monday'] : '';

        $tuesday_timein_am = isset($timein_am['Tuesday']) ? $timein_am['Tuesday'] : '';
        $tuesday_timeout_pm = isset($timeout_pm['Tuesday']) ? $timeout_pm['Tuesday'] : '';
        $wednesday_timein_am = isset($timein_am['Wednesday']) ? $timein_am['Wednesday'] : '';
        $wednesday_timeout_pm = isset($timeout_pm['Wednesday']) ? $timeout_pm['Wednesday'] : '';

        $thursday_timein_am = isset($timein_am['Thursday']) ? $timein_am['Thursday'] : '';
        $thursday_timeout_pm = isset($timeout_pm['Thursday']) ? $timeout_pm['Thursday'] : '';

        $friday_timein_am = isset($timein_am['Friday']) ? $timein_am['Friday'] : '';
        $friday_timeout_pm = isset($timeout_pm['Friday']) ? $timeout_pm['Friday'] : '';

        $saturday_timein_am = isset($timein_am['Saturday']) ? $timein_am['Saturday'] : '';
        $saturday_timeout_pm = isset($timeout_pm['Saturday']) ? $timeout_pm['Saturday'] : '';
    }  
}
// $timein_am[$key] = isset($timein_am[$key]) ? $timein_am[$key] : '';
// $timeout_pm[$key] = isset($timeout_pm[$key]) ? $timeout_pm[$key] : '';
$monday_timein_am = isset($timein_am['Monday']) ? $timein_am['Monday'] : '';
$monday_timeout_pm = isset($timeout_pm['Monday']) ? $timeout_pm['Monday'] : '';

$tuesday_timein_am = isset($timein_am['Tuesday']) ? $timein_am['Tuesday'] : '';
$tuesday_timeout_pm = isset($timeout_pm['Tuesday']) ? $timeout_pm['Tuesday'] : '';
$wednesday_timein_am = isset($timein_am['Wednesday']) ? $timein_am['Wednesday'] : '';
$wednesday_timeout_pm = isset($timeout_pm['Wednesday']) ? $timeout_pm['Wednesday'] : '';

$thursday_timein_am = isset($timein_am['Thursday']) ? $timein_am['Thursday'] : '';
$thursday_timeout_pm = isset($timeout_pm['Thursday']) ? $timeout_pm['Thursday'] : '';

$friday_timein_am = isset($timein_am['Friday']) ? $timein_am['Friday'] : '';
$friday_timeout_pm = isset($timeout_pm['Friday']) ? $timeout_pm['Friday'] : '';

$saturday_timein_am = isset($timein_am['Saturday']) ? $timein_am['Saturday'] : '';
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

function calculateEndTime($startTime) {
    $newEndTime = strtotime('+5 hours', strtotime($startTime));
    
    $lunchStart = strtotime('12:00 PM');
    $lunchEnd = strtotime('1:00 PM');
    
    $newEndTime = ($newEndTime >= $lunchStart && $newEndTime < $lunchEnd) ? strtotime('+1 hour', $newEndTime) : $newEndTime;
    $newEndTime = ($newEndTime >= $lunchEnd) ? strtotime('+1 hour', $newEndTime) : $newEndTime;
    
    return date('h:i:a', $newEndTime);
}
?>

<div id="schedule_container">
<table>
    <div class= "text-center" style="width: 5 rem; margin-top:1rem;">
        <input class="form form-control-sm datetimepicker-input" id="search_date"  type="date">
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
                <strong>Time In: <br><?= !empty($monday_timein_am) ? date('h:i a', strtotime($monday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !empty($monday_timeout_pm) ? date('h:i a', strtotime($monday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($mondayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>
          
            <td>
                <strong>Start Time:<br></strong><label><?=!empty($firstTuesdayItem->Start_time) ? calculateEndTime($lastTuesdayItem->Start_time) : ''?></label><br><br>
                <strong>End Time:<br></strong><label><?=!empty($lastTuesdayItem->End_time) ? calculateEndTime($firstTuesdayItem->End_time) : ''?></label><br><br>
            
                <strong>Time In: <br><?= !(empty($tuesday_timein_am)) ? date('h:i:a', strtotime($tuesday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($tuesday_timeout_pm)) ? date('h:i:a', strtotime($tuesday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($tuesdayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>
          
            <td>
                <strong>Start Time:<br></strong><label><?=!empty($firstWednesdayItem->Start_time) ? calculateEndTime($lastWednesdayItem->Start_time) : ''?></label><br><br>
                <strong>End Time:<br></strong><label><?=!empty($lastWednesdayItem->End_time) ? calculateEndTime($firstWednesdayItem->End_time) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($wednesday_timein_am)) ? @date('h:i:a', strtotime( @$wednesday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($wednesday_timeout_pm)) ? @date('h:i:a', strtotime( @$wednesday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($wednesdayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>
           
            <td>
                <strong>Start Time:<br></strong><label><?=!empty($firstThursdayItem->Start_time) ? calculateEndTime($lastThursdayItem->Start_time) : ''?></label><br><br>
                <strong>End Time:<br></strong><label><?=!empty($lastThursdayItem->End_time) ? calculateEndTime($firstThursdayItem->End_time) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($thursday_timein_am)) ? @date('h:i:a', strtotime( @$thursday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($thursday_timeout_pm)) ? @date('h:i:a', strtotime( @$thursday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($thursdayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>

            <td>
                <strong>Start Time:<br></strong><label><?=!empty($firstFridayItem->Start_time) ? calculateEndTime($lastFridayItem->Start_time) : ''?></label><br><br>
                <strong>End Time:<br></strong><label><?=!empty($lastFridayItem->End_time) ? calculateEndTime($firstFridayItem->End_time) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($friday_timein_am)) ? @date('h:i:a', strtotime( @$friday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($friday_timeout_pm)) ? @date('h:i:a', strtotime( @$friday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($fridayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>

            <td>
                <strong>Start Time:<br></strong><label><?=!empty($firstSaturdayItem->Start_time) ? calculateEndTime($lastSaturdayItem->Start_time) : ''?></label><br><br>
                <strong>End Time:<br></strong><label><?=!empty($lastSaturdayItem->End_time) ? calculateEndTime($firstSaturdayItem->End_time) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($saturday_timein_am)) ? @date('h:i:a', strtotime( @$saturday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($saturday_timeout_pm)) ? @date('h:i:a', strtotime( @$saturday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($saturdayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>
	
        </tr>
    </table>
    </div>
    <script src="<?php echo base_url() ?>/assets/js/dashboard/calendar.js"></script>