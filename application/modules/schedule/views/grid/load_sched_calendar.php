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
<div class="container" style="width:100%;">
    <div class="row">
        <table class="table-bordered text-center col-12">
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
                $data_days = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
                $data = [];
                $over_all_loop = 0;;
                foreach ($details as $key => $value) {
                    if (in_array($value->Day, $data_days)) {
                        array_push($data, $value->Day);
                    }
                    $over_all_loop++;
                }
                $mondayCount = 0;
                $tuesdayCount = 0;
                $wednesdayCount = 0;
                $thursdayCount = 0;
                $fridayCount = 0;
                $saturdayCount = 0;

                foreach ($data as $day) {
                    switch ($day) {
                        case "monday":
                            $mondayCount++;
                            break;
                        case "tuesday":
                            $tuesdayCount++;
                            break;
                        case "wednesday":
                            $wednesdayCount++;
                            break;
                        case "thursday":
                            $thursdayCount++;
                            break;
                        case "friday":
                            $fridayCount++;
                            break;
                        case "saturday":
                            $saturdayCount++;
                            break;
                        // Add more cases for other days if needed
                    }
                }
                foreach ($time_intervals as $time) { ?>
                    <tr>
                        <td class="align-middle">
                            <?php
                            $date = DateTime::createFromFormat('H:i:s', $time);
                            $formattedTime = $date->format('h:i A');
                            echo $formattedTime;
                            ?>
                        </td>
                        <!-- Dynamic Expansion of Schedule -->
                        <?php
                        if ($time == '12:15:00' && $time <= '12:45:00') { ?>
                            <td rowspan="3" colspan="6">
                                <div class="font-size13">
                                    NOON BREAK
                                </div>
                            </td>
                            <?php
                        }
                        ?>

                        <!-- MONDAY -->
                        <?php
                        $loop_monday = 0;
                        $loop1 = 0;
                        foreach ($details as $key => $value) {
                            $day = "monday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am : $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am : $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if ($value->Day == $day) {
                                $loop_monday++;
                            }

                            $loop1++;

                            if ($mondayCount > 1) {
                                // Upper
                                if ($value->Day == $day && $loop_monday == 1 && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_am) { ?>
                                            <td rowspan="<?=$result + 1?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>

                                    </div>
                                    <?php
                                }

                                // Lower
                                if ($value->Day == $day && $loop_monday == 2 && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_pm) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>
                                    </div>
                                    <?php
                                }
                            } else if ($mondayCount == 1) {

                                // Upper
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>

                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>

                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                                // Lower
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                            } else {
                                // Upper  ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '07:00:00' && $time < '12:15:00' && $loop1 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                    <?php

                                    // Lower   ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '13:00:00' && $time < '22:00:00' && $loop1 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                <?php
                            }
                        }
                        ?>

                        <!-- TUESDAY -->
                        <?php
                        $loop_tuesday = 0;
                        $loop2 = 0;
                        foreach ($details as $key => $value) {
                            $day = "tuesday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am : $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am : $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if ($value->Day == $day) {
                                $loop_tuesday++;
                            }

                            $loop2++;

                            if ($tuesdayCount > 1) {
                                // Upper
                                if ($value->Day == $day && $loop_tuesday == 1 && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_am) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>

                                    </div>
                                    <?php
                                }

                                // Lower
                                if ($value->Day == $day && $loop_tuesday == 2 && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_pm) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>
                                    </div>
                                    <?php
                                }
                            } else if ($tuesdayCount == 1) {

                                // Upper
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>

                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                                // Lower
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                            } else {
                                // Upper  ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '07:00:00' && $time < '12:15:00' && $loop2 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                    <?php

                                    // Lower   ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '13:00:00' && $time < '22:00:00' && $loop2 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                <?php
                            }
                        }
                        ?>

                        <!-- WEDNESDAY -->
                        <?php
                        $loop_wednesday = 0;
                        $loop3 = 0;
                        foreach ($details as $key => $value) {
                            $day = "wednesday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am : $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am : $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if ($value->Day == $day) {
                                $loop_wednesday++;
                            }

                            $loop3++;

                            if ($wednesdayCount > 1) {
                                // Upper
                                if ($value->Day == $day && $loop_wednesday == 1 && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_am) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>

                                    </div>
                                    <?php
                                }

                                // Lower
                                if ($value->Day == $day && $loop_wednesday == 2 && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_pm) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>
                                    </div>
                                    <?php
                                }
                            } else if ($wednesdayCount == 1) {

                                // Upper
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>

                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                                // Lower
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                            } else {
                                // Upper  ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '07:00:00' && $time < '12:15:00' && $loop3 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                    <?php

                                    // Lower   ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '13:00:00' && $time < '22:00:00' && $loop3 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                <?php
                            }
                        }
                        ?>
                        <!-- THURSDAY -->
                        <?php
                        $loop_thursday = 0;
                        $loop4 = 0;
                        foreach ($details as $key => $value) {
                            $day = "thursday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am : $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am : $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if ($value->Day == $day) {
                                $loop_thursday++;
                            }

                            $loop4++;

                            if ($thursdayCount > 1) {
                                // Upper
                                if ($value->Day == $day && $loop_thursday == 1 && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_am) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>

                                    </div>
                                    <?php
                                }

                                // Lower
                                if ($value->Day == $day && $loop_thursday == 2 && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_pm) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>
                                    </div>
                                    <?php
                                }
                            } else if ($thursdayCount == 1) {

                                // Upper
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>

                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                                // Lower
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                            } else {
                                // Upper  ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '07:00:00' && $time < '12:15:00' && $loop4 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                    <?php

                                    // Lower   ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '13:00:00' && $time < '22:00:00' && $loop4 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                <?php
                            }
                        }
                        ?>

                        <!-- FRIDAY -->
                        <?php
                        $loop_friday = 0;
                        $loop5 = 0;
                        foreach ($details as $key => $value) {
                            $day = "friday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am : $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am : $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if ($value->Day == $day) {
                                $loop_friday++;
                            }

                            $loop5++;

                            if ($fridayCount > 1) {
                                // Upper
                                if ($value->Day == $day && $loop_friday == 1 && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_am) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>

                                    </div>
                                    <?php
                                }

                                // Lower
                                if ($value->Day == $day && $loop_friday == 2 && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_pm) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>
                                    </div>
                                    <?php
                                }
                            } else if ($fridayCount == 1) {

                                // Upper
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>

                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                                // Lower
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                            } else {
                                // Upper  ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '07:00:00' && $time < '12:15:00' && $loop5 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                    <?php

                                    // Lower   ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '13:00:00' && $time < '22:00:00' && $loop5 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                <?php
                            }
                        }
                        ?>

                        <!-- SATURDAY -->
                        <?php
                        $loop_saturday = 0;
                        $loop6 = 0;
                        foreach ($details as $key => $value) {
                            $day = "saturday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am : $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am : $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if ($value->Day == $day) {
                                $loop_saturday++;
                            }

                            $loop6++;

                            if ($saturdayCount > 1) {
                                // Upper
                                if ($value->Day == $day && $loop_saturday == 1 && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_am) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>

                                    </div>
                                    <?php
                                }

                                // Lower
                                if ($value->Day == $day && $loop_saturday == 2 && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($time == $value->Start_time_pm) { ?>
                                            <td rowspan="<?= $result + 1 ?>">
                                                <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                            </td>
                                            <?php
                                        } ?>
                                    </div>
                                    <?php
                                }
                            } else if ($saturdayCount == 1) {

                                // Upper
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>

                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time < '12:15:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_am || $time > $value->End_time_am) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_am) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                                // Lower
                                if ($value->Start_time_am != null && $value->End_time_am != null) {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_am != null && $value->End_time_am != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    if ($value->Day == $day && $time > '12:45:00' && $time < '22:00:00' && $value->Start_time_pm != null && $value->End_time_pm != null) { ?>
                                            <div class="font-size13">
                                                <?php
                                                if ($time < $value->Start_time_pm || $time > $value->End_time_pm) { ?>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($time == $value->Start_time_pm) { ?>
                                                    <td rowspan="<?= $result + 1 ?>">
                                                    <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                                    </td>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                    }
                                }

                            } else {
                                // Upper  ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '07:00:00' && $time < '12:15:00' && $loop6 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                    <?php

                                    // Lower   ?>
                                    <div class="font-size13">
                                        <?php
                                        if ($time >= '13:00:00' && $time < '22:00:00' && $loop6 > $over_all_loop) { ?>
                                            <td>
                                                &nbsp;
                                            </td>
                                        <?php
                                        } ?>
                                    </div>
                                <?php
                            }
                        }
                        ?>


                        <!-- <td>
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
                        </td> -->
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