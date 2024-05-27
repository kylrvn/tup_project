<?php
main_header(['Dashboard']);

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Get the number of days in the current month
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

// Initialize an array to store grouped data
$groupedData = [];
$groupedApproved = [];
$groupedForVerif = [];
// Initialize start and end dates for the first week
$startDate = null;
$endDate = null;

// Iterate through each day of the month
for ($day = 1; $day <= $daysInMonth; $day++) {
    // Get the day of the week for the current date
    $currentDate = "$currentYear-$currentMonth-$day";
    $dayOfWeek = date('w', strtotime($currentDate));

    // Skip Sundays
    if ($dayOfWeek == 0) {
        continue;
    }

    // If start date is not set, set it to the current date
    if ($startDate === null) {
        $startDate = $currentDate;
    }

    // Set the end date to the current date
    $endDate = $currentDate;

    // If the end date is a Saturday or the last day of the month, store the week
    if ($dayOfWeek == 6 || $day == $daysInMonth) {
        $groupedData[] = ['start' => $startDate, 'end' => $endDate];
        // Reset start and end dates for the next week
        $startDate = null;
        $endDate = null;
    }
}

$formattedWeeks = [];
// Iterate through grouped data and display
foreach ($groupedData as $weekData) {
    $formattedWeeks[] = date('M j, Y', strtotime($weekData['start'])) . " - " . date('M j, Y', strtotime($weekData['end']));
}
foreach($approved as $key => $value){
    $groupedApproved[] = $value->Schedule;
}
foreach($forVerif as $key => $value){
    $groupedForVerif[] = $value->Schedule;
}
?>


<!-- ############ PAGE START-->


<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 6px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border: 1px solid #ddd;
        }

        th {
            background-color: #db7378;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        header {
            background-color: #9f3a3b;
            color: #fff;
            padding: 15px;
        }

        .user-info {
            display: inline-block;
            text-align: left;
        }

        .user-info h1 {
            margin: 0;
            font-size: 1.5em;
        }

        .user-info p {
            margin: 5px 0 0;
            font-size: 1em;
        }

        .buttons {
            display: inline-block;
            text-align: right;
            float: right;

        }

        .buttons button {
            background-color: #f7dfe1;
            color: black;
            border: none;
            padding: 10px 15px;
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
</head>

<header>



        <div class="user-info">
            <h1>Hello</h1>
    <p><?=date('M d, Y - h:i A');?></p>
        </div>
        <div class="buttons">
            <button data-toggle="modal" data-target="#modal-lg">Acknowledge</button>
            <button onclick="load_calendar(this)">Calendar</button>
            <button onclick="load_account(this)">Accounts</button>
</div>
        
    </header>
    <div class="container" id="load_page">
    </div>

        
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Acknowledge Schedule</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <table>
                <tr>
                    <th>Date</th>
                    <th>Acknowledged</th>
                    <th>Request for Verification</th>
                    <th>Description for Request</th>
                </tr>
                <?php foreach ($formattedWeeks  as $week) {  ?>
                 <tr>   
                <td><?=$week?></td>
                <td> <input type="checkbox" value="1" class="acknowledgement"  data-week="<?=$week?>" data-FacID="<?=$session->ID?>" name="acknowledgement[]" <?php foreach($groupedApproved as $approvedSched){
                    if($approvedSched == $week){
                        echo 'checked';
                    }
                }?>></td>
                <td> <input type="checkbox" value="1" class="forVerif" data-week="<?=$week?>" data-FacID="<?=$session->ID?>" name="forVerif[]" <?php foreach($groupedForVerif as $forVerif){
                    if($forVerif == $week){
                        echo 'checked';
                    }
                }?>></td>
                <td><input type="text" id="reason"></td>
                 </tr>
                <?php }?>
                <!-- <tr>
                    <td><?=$firstDayOfWeek .'-'. $lastDayOfWeek?></td>
                    <td><input type="checkbox"></td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td>Mar 11, 2024 - Mar 16, 2024</td>
                    <td><input type="checkbox"></td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td>Mar 18, 2024 - Mar 23, 2024</td>
                    <td><input type="checkbox"></td>
                    <td><input type="checkbox"></td>
                </tr> -->
            </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="confirm" class="btn btn-success">Confirm</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- ############ PAGE END-->
<?php
main_footer();
?>

<script src="<?php echo base_url() ?>/assets/js/dashboard/dashboard.js"></script>