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
                $testing_var = 0; 
                foreach ($time_intervals as $time) {?>
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
                        if($time == '12:15:00' && $time <= '12:45:00' ){?>
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
                        $loop_mn = 0;
                        foreach ($details as $key => $value) {
                            $day = "monday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am :  $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am :  $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if($day == $value->Day){
                                $loop_mn++;
                            }

                            if($value->Day == $day && $value->Start_time_am == null && $value->End_time_am == null && $time < '12:15:00' && $loop_mn == 1){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if($value->Day == $day && $time < $value->Start_time_am || $value->Day == $day && $time < $value->Start_time_pm && $time > '12:45:00'){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if ($value->Day == $day && $time == $value->Start_time_am || $value->Day == $day && $time == $value->Start_time_pm) { ?>
                                <td rowspan="<?= $result + 1 ?>">
                                    <div class="font-size13">
                                        <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                        <?= $result ?>
                                    </div>
                                </td>
                                <?php
                            } 
                            else if(
                                $value->Day == $day && $time > $value->End_time_am && $time < '12:15:00' && $value->End_time_am != null ||
                                $value->Day == $day && $time > $value->End_time_pm && $time < '22:00:00' && $value->End_time_pm != null && $loop_mn == 2
                                ){?>
                                <td>
                                    <div class="font-size13">
                                       &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                        }
                        ?>

                        <!-- TUESDAY -->
                        <?php
                        $loop_tu = 0;
                        foreach ($details as $key => $value) {
                            $day = "tuesday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am :  $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am :  $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if($day == $value->Day){
                                $loop_tu++;
                            }

                            if($value->Day == $day && $value->Start_time_am == null && $value->End_time_am == null && $time < '12:15:00' && $loop_tu == 1){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if($value->Day == $day && $time < $value->Start_time_am || $value->Day == $day && $time < $value->Start_time_pm && $time > '12:45:00'){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if ($value->Day == $day && $time == $value->Start_time_am || $value->Day == $day && $time == $value->Start_time_pm) { ?>
                                <td rowspan="<?= $result + 1 ?>">
                                    <div class="font-size13">
                                        <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                        <?= $result ?>
                                    </div>
                                </td>
                                <?php
                            } 
                            else if(
                                $value->Day == $day && $time > $value->End_time_am && $time < '12:15:00' && $value->End_time_am != null ||
                                $value->Day == $day && $time > $value->End_time_pm && $time < '22:00:00' && $value->End_time_pm != null && $loop_tu == 2
                                ){?>
                                <td>
                                    <div class="font-size13">
                                       &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                        }
                        ?>

                        <!-- WEDNESDAY -->
                        <?php
                        $loop_wd = 0;
                        foreach ($details as $key => $value) {
                            $day = "wednesday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am :  $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am :  $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if($day == $value->Day){
                                $loop_wd++;
                            }

                            if($value->Day == $day && $value->Start_time_am == null && $value->End_time_am == null && $time < '12:15:00' && $loop_wd == 1){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if($value->Day == $day && $time < $value->Start_time_am || $value->Day == $day && $time < $value->Start_time_pm && $time > '12:45:00'){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if ($value->Day == $day && $time == $value->Start_time_am || $value->Day == $day && $time == $value->Start_time_pm) { ?>
                                <td rowspan="<?= $result + 1 ?>">
                                    <div class="font-size13">
                                        <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                        <?= $result ?>
                                    </div>
                                </td>
                                <?php
                            } 
                            else if(
                                $value->Day == $day && $time > $value->End_time_am && $time < '12:15:00' && $value->End_time_am != null ||
                                $value->Day == $day && $time > $value->End_time_pm && $time < '22:00:00' && $value->End_time_pm != null && $loop_wd == 2
                                ){?>
                                <td>
                                    <div class="font-size13">
                                       &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                        }
                        ?>

                        <!-- THURSDAY -->
                        <?php
                        $loop_th = 0;
                        foreach ($details as $key => $value) {
                            $day = "thursday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am :  $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am :  $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if($day == $value->Day){
                                $loop_th++;
                            }

                            if($value->Day == $day && $value->Start_time_am == null && $value->End_time_am == null && $time < '12:15:00' && $loop_th < 1){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if($value->Day == $day && $time < $value->Start_time_am || $value->Day == $day && $time < $value->Start_time_pm && $time > '12:45:00'){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if ($value->Day == $day && $time == $value->Start_time_am || $value->Day == $day && $time == $value->Start_time_pm) { ?>
                                <td rowspan="<?= $result + 1 ?>">
                                    <div class="font-size13">
                                        <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                        <?= $result ?>
                                    </div>
                                </td>
                                <?php
                            } 
                            else if(
                                $value->Day == $day && $time > $value->End_time_am && $time < '12:15:00' && $value->End_time_am != null ||
                                $value->Day == $day && $time > $value->End_time_pm && $time < '22:00:00' && $value->End_time_pm != null && $loop_th == 2
                                ){?>
                                <td>
                                    <div class="font-size13">
                                       &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                        }
                        ?>

                        <!-- FRIDAY -->
                        <?php
                        $loop_fr = 0;
                        foreach ($details as $key => $value) {
                            $day = "friday";
                            $start_time = new DateTime(isset($value->Start_time_am) ? $value->Start_time_am :  $value->Start_time_pm);
                            $end_time = new DateTime(isset($value->End_time_am) ? $value->End_time_am :  $value->End_time_pm);

                            // Calculate the time difference
                            $time_converted = $start_time->diff($end_time);
                            $time_difference = $time_converted->format('%H:%I:%S');

                            $time_in_seconds = strtotime($time_difference) - strtotime('00:00:00');

                            $interval_minutes = 15 * 60;
                            $number_of_intervals = $time_in_seconds / $interval_minutes;

                            $result = (double) $number_of_intervals;

                            if($day == $value->Day){
                                $loop_fr++;
                            }

                            if($value->Day == $day && $value->Start_time_am == null && $value->End_time_am == null && $time < '12:15:00' && $loop_fr < 1){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if($value->Day == $day && $time < $value->Start_time_am || $value->Day == $day && $time < $value->Start_time_pm && $time > '12:45:00'){?>
                                <td>
                                    <div class="font-size13">
                                        &nbsp;
                                    </div>
                                </td>
                                <?php
                            }
                            else if ($value->Day == $day && $time == $value->Start_time_am || $value->Day == $day && $time == $value->Start_time_pm) { ?>
                                <td rowspan="<?= $result + 1 ?>">
                                    <div class="font-size13">
                                        <?= isset($value->Subject_am) ? $value->Subject_am : $value->Subject_pm ?>
                                        <?= $result ?>
                                    </div>
                                </td>
                                <?php
                            } 
                            else if(
                                $value->Day == $day && $time > $value->End_time_am && $time < '12:15:00' && $value->End_time_am != null ||
                                $value->Day == $day && $time > $value->End_time_pm && $time < '22:00:00' && $value->End_time_pm != null && $loop_fr == 2
                                ){?>
                                <td>
                                    <div class="font-size13">
                                       &nbsp;
                                    </div>
                                </td>
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