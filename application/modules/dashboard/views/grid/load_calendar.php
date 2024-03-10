<?php
// Define arrays to store timein_am and timeout_pm for each day
$timein_am = [];
$timeout_pm = [];

// Loop through the dtr_logs data to extract timein_am and timeout_pm
foreach ($dtr_logs as $log) {
    // Extract the day from the timein_am
    $day = date('l', strtotime($log->timein_am));
    
    // Store the timein_am and timeout_pm for the corresponding day
    $timein_am[$day] = $log->timein_am;
    $timeout_pm[$day] = $log->timeout_pm;
}

// Accessing timein_am and timeout_pm for each day
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

// Repeat the same for other days of the week


// Group the details by day
$dayDetails = [];
foreach ($details as $detail) {
    $day = $detail->Day;
    if (!isset($dayDetails[$day])) {
        $dayDetails[$day] = [];
    }
    $dayDetails[$day][] = $detail;
}

// Accessing details for each day
@$mondayDetails = @$dayDetails['monday'];
@$tuesdayDetails = @$dayDetails['tuesday'];
@$wednesdayDetails = @$dayDetails['wednesday'];
@$thursdayDetails = @$dayDetails['thursday'];
@$fridayDetails = @$dayDetails['friday'];
@$saturdayDetails = @$dayDetails['saturday'];

// Accessing the first and last items for each day
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
    
    // Check if the new end time falls within or after the lunch break hour
    $lunchStart = strtotime('12:00 PM');
    $lunchEnd = strtotime('1:00 PM');
    
    // Adjust the end time if it falls within the lunch break
    $newEndTime = ($newEndTime >= $lunchStart && $newEndTime < $lunchEnd) ? strtotime('+1 hour', $newEndTime) : $newEndTime;
    $newEndTime = ($newEndTime >= $lunchEnd) ? strtotime('+1 hour', $newEndTime) : $newEndTime;
    
    // Format the new end time
    return date('h:i:a', $newEndTime);
}
?>

<div id="schedule_container">
<table>
    <div class= "text-center" style="width: 5 rem; margin-top:1rem;">
        <input class="form form-control-sm" id="search_date"  type="date">
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
                <strong>Start Time AM:<br></strong><label><?=!(empty($firstMondayItem->Start_time_am)) ? date('h:i:a', strtotime( @$firstMondayItem->Start_time_am)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($firstMondayItem->Start_time)?></label><br><br> -->
                <strong>End Time AM:<br></strong><label><?=!(empty($firstMondayItem->End_time_am)) ? date('h:i:a', strtotime( @$firstMondayItem->End_time_am)) : ''?></label><br><br>
                <strong>Start Time PM:<br></strong><label><?=!(empty($lastMondayItem->Start_time_pm)) ? date('h:i:a', strtotime( @$lastMondayItem->Start_time_pm)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($lastMondayItem->Start_time)?></label><br><br> -->
                <strong>End Time PM:<br></strong><label><?=!(empty($lastMondayItem->End_time_pm)) ? date('h:i:a', strtotime( @$lastMondayItem->End_time_pm)) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($monday_timein_am)) ? @date('h:i:a', strtotime( @$monday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($monday_timein_am)) ? @date('h:i:a', strtotime( @$monday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($mondayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>
          
            <td>
                <strong>Start Time AM:<br></strong><label><?=!(empty($firstTuesdayItem->Start_time_am)) ? date('h:i:a', strtotime( @$firstTuesdayItem->Start_time_am)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($firstTuesdayItem->Start_time)?></label><br><br> -->
                <strong>End Time AM:<br></strong><label><?=!(empty($firstTuesdayItem->End_time_am)) ? date('h:i:a', strtotime( @$firstMondayItem->End_time_am)) : ''?></label><br><br>
                <strong>Start Time PM:<br></strong><label><?=!(empty($lastTuesdayItem->Start_time_pm)) ? date('h:i:a', strtotime( @$lastTuesdayItem->Start_time_pm)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($lastTuesdayItem->Start_time)?></label><br><br> -->
                <strong>End Time PM:<br></strong><label><?=!(empty($lastTuesdayItem->End_time_pm)) ? date('h:i:a', strtotime( @$lastMondayItem->End_time_pm)) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($tuesday_timein_am)) ? date('h:i:a', strtotime($tuesday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($tuesday_timeout_pm)) ? date('h:i:a', strtotime($tuesday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($tuesdayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>
          
            <td>
                <strong>Start Time AM:<br></strong><label><?=!(empty($firstWednesdayItem->Start_time_am)) ? date('h:i:a', strtotime( @$firstWednesdayItem->Start_time_am)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($firstWednesdayItem->Start_time)?></label><br><br> -->
                <strong>End Time AM:<br></strong><label><?=!(empty($firstWednesdayItem->End_time_am)) ? date('h:i:a', strtotime( @$firstWednesdayItem->End_time_am)) : ''?></label><br><br>
                <strong>Start Time PM:<br></strong><label><?=!(empty($lastWednesdayItem->Start_time_pm)) ? date('h:i:a', strtotime( @$lastWednesdayItem->Start_time_pm)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($lastWednesdayItem->Start_time)?></label><br><br> -->
                <strong>End Time PM:<br></strong><label><?=!(empty($lastWednesdayItem->End_time_pm)) ? date('h:i:a', strtotime( @$lastWednesdayItem->End_time_pm)) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($wednesday_timein_am)) ? @date('h:i:a', strtotime( @$wednesday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($wednesday_timeout_pm)) ? @date('h:i:a', strtotime( @$wednesday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($wednesdayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>
           
            <td>
                <strong>Start Time AM:<br></strong><label><?=!(empty($firstThursdayItem->Start_time_am)) ? date('h:i:a', strtotime( @$firstThursdayItem->Start_time_am)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($firstThursdayItem->Start_time)?></label><br><br> -->
                <strong>End Time AM:<br></strong><label><?=!(empty($firstThursdayItem->End_time_am)) ? date('h:i:a', strtotime( @$firstThursdayItem->End_time_am)) : ''?></label><br><br>
                <strong>Start Time PM:<br></strong><label><?=!(empty($lastThursdayItem->Start_time_pm)) ? date('h:i:a', strtotime( @$lastThursdayItem->Start_time_pm)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($lastThursdayItem->Start_time)?></label><br><br> -->
                <strong>End Time PM:<br></strong><label><?=!(empty($lastThursdayItem->End_time_pm)) ? date('h:i:a', strtotime( @$lastThursdayItem->End_time_pm)) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($thursday_timein_am)) ? @date('h:i:a', strtotime( @$thursday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($thursday_timeout_pm)) ? @date('h:i:a', strtotime( @$thursday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($thursdayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>

            <td>
                <strong>Start Time AM:<br></strong><label><?=!(empty($firstFridayItem->Start_time_am)) ? date('h:i:a', strtotime( @$firstFridayItem->Start_time_am)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($firstFridayItem->Start_time)?></label><br><br> -->
                <strong>End Time AM:<br></strong><label><?=!(empty($firstFridayItem->End_time_am)) ? date('h:i:a', strtotime( @$firstFridayItem->End_time_am)) : ''?></label><br><br>
                <strong>Start Time PM:<br></strong><label><?=!(empty($lastFridayItem->Start_time_pm)) ? date('h:i:a', strtotime( @$lastFridayItem->Start_time_pm)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($lastFridayItem->Start_time)?></label><br><br> -->
                <strong>End Time PM:<br></strong><label><?=!(empty($lastFridayItem->End_time_pm)) ? date('h:i:a', strtotime( @$lastFridayItem->End_time_pm)) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($friday_timein_am)) ? @date('h:i:a', strtotime( @$friday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($friday_timeout_pm)) ? @date('h:i:a', strtotime( @$friday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($fridayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>

            <td>
                <strong>Start Time AM:<br></strong><label><?=!(empty($firstSaturdayItem->Start_time_am)) ? date('h:i:a', strtotime( @$firstSaturdayItem->Start_time_am)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($firstSaturdayItem->Start_time)?></label><br><br> -->
                <strong>End Time AM:<br></strong><label><?=!(empty($firstSaturdayItem->End_time_am)) ? date('h:i:a', strtotime( @$firstSaturdayItem->End_time_am)) : ''?></label><br><br>
                <strong>Start Time PM:<br></strong><label><?=!(empty($lastSaturdayItem->Start_time_pm)) ? date('h:i:a', strtotime( @$lastSaturdayItem->Start_time_pm)) : ''?></label><br><br>
                <!-- <strong>End Time:<br></strong><label><?=calculateEndTime($lastSaturdayItem->Start_time)?></label><br><br> -->
                <strong>End Time PM:<br></strong><label><?=!(empty($lastSaturdayItem->End_time_pm)) ? date('h:i:a', strtotime( @$lastSaturdayItem->End_time_pm)) : ''?></label><br><br>
                <strong>Time In: <br><?= !(empty($saturday_timein_am)) ? @date('h:i:a', strtotime( @$saturday_timein_am)) : '' ?></strong> <br><br>
                <strong>Time Out: <br><?= !(empty($saturday_timeout_pm)) ? @date('h:i:a', strtotime( @$saturday_timeout_pm)) : '' ?></strong> <br><br><br><br>
                <strong>Status: <?php echo @(reset($saturdayDetails)->Active== 1) ? '<label style="color:green">ACTIVE</label>' : ''?></strong>
            </td>
	
        </tr>
    </table>
    </div>
    <script src="<?php echo base_url() ?>/assets/js/dashboard/calendar.js"></script>