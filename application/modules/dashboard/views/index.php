<?php
main_header(['Dashboard']);
// Get data from the controller
$week_sched_dtr = $week_sched_dtr;

// Initialize an array to store grouped data
$groupedData = [];

// Iterate through each data item
foreach ($week_sched_dtr as $item) {
    // Skip items for Sundays
    if (date('w', strtotime($item->date_log)) == 0) {
        continue;
    }

    // Get the week number of the year for the current item's date
    $weekNumber = date('W', strtotime($item->date_log));

    // Group data by week number
    if (!isset($groupedData[$weekNumber])) {
        $groupedData[$weekNumber] = [];
    }
    $groupedData[$weekNumber][] = $item;
}
$formattedWeeks = [];
// Iterate through grouped data and display
foreach ($groupedData as $weekNumber => $weekData) {
    // Calculate Monday and Saturday dates for the week
    $startDate = null;
    $endDate = null;

    foreach ($weekData as $data) {
        $currentDate = date('Y-m-d', strtotime($data->date_log));
        $dayOfWeek = date('w', strtotime($currentDate));
        if ($dayOfWeek == 1 && $startDate === null) {
            $startDate = date('M j, Y', strtotime($currentDate));
        } elseif ($dayOfWeek == 6 && $endDate === null) {
            $endDate = date('M j, Y', strtotime($currentDate));
        }
    }

    // Display the week range if both start and end dates are found
    if ($startDate !== null && $endDate !== null) {
        $formattedWeeks[] = "$startDate - $endDate";
    }
}
// echo json_encode($week_sched_dtr);
?>
<!-- ############ PAGE START-->


<head>

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
            padding: 15px;
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
                <td> <input type="checkbox" value="1" class="acknowledgement" data-week="<?=$week?>" data-FacID="<?=$session->ID?>" name="acknowledgement[]"></td>
                <td> <input type="checkbox" value="1" class="forVerif" data-week="<?=$week?>" data-FacID="<?=$session->ID?>" name="forVerif[]"></td>
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