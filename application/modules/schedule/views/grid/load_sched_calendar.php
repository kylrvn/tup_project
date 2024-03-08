<?php
// var_dump($details);

$days = ["MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"];

$start_time = new DateTime('07:00:00');
$end_time = new DateTime('21:00:00');

$time_intervals = array();

$current_time = clone $start_time;
while ($current_time <= $end_time) {
    $time_intervals[] = $current_time->format('H:i:s');
    $current_time->add(new DateInterval('PT15M'));
}

// var_dump($time_intervals);
?>

<head>
    <style>
        body {
            margin-top: 20px;
        }

        .bg-light-gray {
            background-color: #f7f7f7;
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }


        .bg-sky.box-shadow {
            box-shadow: 0px 5px 0px 0px #00a2a7
        }

        .bg-orange.box-shadow {
            box-shadow: 0px 5px 0px 0px #af4305
        }

        .bg-green.box-shadow {
            box-shadow: 0px 5px 0px 0px #4ca520
        }

        .bg-yellow.box-shadow {
            box-shadow: 0px 5px 0px 0px #dcbf02
        }

        .bg-pink.box-shadow {
            box-shadow: 0px 5px 0px 0px #e82d8b
        }

        .bg-purple.box-shadow {
            box-shadow: 0px 5px 0px 0px #8343e8
        }

        .bg-lightred.box-shadow {
            box-shadow: 0px 5px 0px 0px #d84213
        }


        .bg-sky {
            background-color: #02c2c7
        }

        .bg-orange {
            background-color: #e95601
        }

        .bg-green {
            background-color: #5bbd2a
        }

        .bg-yellow {
            background-color: #f0d001
        }

        .bg-pink {
            background-color: #ff48a4
        }

        .bg-purple {
            background-color: #9d60ff
        }

        .bg-lightred {
            background-color: #ff5722
        }

        .padding-15px-lr {
            padding-left: 15px;
            padding-right: 15px;
        }

        .padding-5px-tb {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .margin-10px-bottom {
            margin-bottom: 10px;
        }

        .border-radius-5 {
            border-radius: 5px;
        }

        .margin-10px-top {
            margin-top: 10px;
        }

        .font-size14 {
            font-size: 14px;
        }

        .text-light-gray {
            color: #d6d5d5;
        }

        .font-size13 {
            font-size: 13px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
    </style>

</head>
<div class="container" style="display:flex; zoom:100s%;">
    <div class="container">
        <table class="table-bordered text-center">
            <thead>
                <tr class="bg-light-gray">
                    <th class="text-uppercase" style="width:50rem;">Time</th>
                    <?php
                    foreach ($days as $value) { ?>
                        <th class="text-uppercase" style="width:50rem;">
                            <?= $value ?>
                        </th>
                        <?php
                    }
                    ?>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($time_intervals as $time) { ?>
                    <tr>
                        <td class="align-middle">
                            <?php
                            $date = DateTime::createFromFormat('H:i:s', $time);
                            $formattedTime = $date->format('h:i A');
                            echo $formattedTime;
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($details as $key => $value) {
                                    $start_time = new DateTime($value->Start_time_am);
                                    $end_time = new DateTime($value->End_time_am);
                        
                                    // Calculate the time difference
                                    $time_converted = $start_time->diff($end_time);
                                    $time_difference = $time_converted->format('%H:%I:%S');
                        
                                    $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');
                        
                                    $interval_minutes = 15 * 60; // 15 minutes in seconds
                                    $number_of_intervals = $time_in_seconds / $interval_minutes;
                        
                                    $result = (double) $number_of_intervals;
                        

                                if ($value->Day == "monday" && $time == $value->Start_time_am) { ?>

                                    <div class="font-size13">
                                        <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                        <?= $result ?>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                        </td>
                        <td>
                            TUESDAY
                        </td>
                        <td>
                            WEDNESDAY
                        </td>
                        <td>
                            THURSDAY
                        </td>
                        <td>
                            FRIDAY
                        </td>
                        <td>
                            SATURDAY
                        </td>
                    </tr>
                    <?php
                } ?>


                <!-- <tr>
                    <td class="align-middle">01:00pm</td>
                    <td>
                        <span
                            class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">English</span>
                        <div class="margin-10px-top font-size14">1:00-2:00</div>
                        <div class="font-size13 text-light-gray">James Smith</div>
                    </td>
                    <td>
                        <span
                            class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                        <div class="margin-10px-top font-size14">1:00-2:00</div>
                        <div class="font-size13 text-light-gray">Ivana Wong</div>
                    </td>
                    <td class="bg-light-gray">

                    </td>
                    <td>
                        <span
                            class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">English</span>
                        <div class="margin-10px-top font-size14">1:00-2:00</div>
                        <div class="font-size13 text-light-gray">James Smith</div>
                    </td>
                    <td>
                        <span
                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Yoga</span>
                        <div class="margin-10px-top font-size14">1:00-2:00</div>
                        <div class="font-size13 text-light-gray">Marta Healy</div>
                    </td>
                    <td>
                        <span
                            class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                        <div class="margin-10px-top font-size14">1:00-2:00</div>
                        <div class="font-size13 text-light-gray">Ivana Wong</div>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>

    <!-- <td>
        <button style="float:right;" type="button" class="btn  btn-danger btn-lg">Save as PDF</button>
    </td> -->
</div>