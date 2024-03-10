<?php

$numberOfDaysInMonth = $details['num_of_days'];

$daysArray = range(1, $numberOfDaysInMonth);
// var_dump($details['data'][0]->Fname);
?>

<!-- Content Here -->
<div class="row" id="print_DTR_summary">
    <div class="col-12">
        <div class="card" style="font-size:70%;">
            <div class="card-header text-center border-all-no-bottom">
                <img src="<?= base_url() ?>assets/images/Logo/tuplogo.png" width="5%" height="5%">
                <label>
                    Technological University of the Philippines Visayas
                    <br>
                    City of Talisay, Negros Occidental
                    <br>
                    <br>
                    FACULTY DAILY ATTENDANCE CHART
                    <br>
                    OVERLOAD
                </label>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table-black" style="width: 100%;">
                    <thead>
                        <tr style="border-bottom: solid black 1px;">
                            <th class="center-text" colspan="<?= $numberOfDaysInMonth + 2 ?>">
                                For the Month of
                                <?= strtoupper($details['month_in_words']) ?>
                                <?= $details['year'] ?>
                            </th>

                            <!-- <th class="center-text" style="border-left: solid black 1px;" colspan="2">
                                Leave Credits as
                                of
                                <?= $details['year'] ?>
                            </th> -->
                            <th class="center-text" style="border-left: solid black 1px;" colspan="5">TOTAL
                            </th>
                        </tr>
                    </thead>
                    <thead>
                        <tr style="border-bottom: solid black 1px;">
                            <th class="center-text">#</th>
                            <th class="center-text" style="border-left: solid black 1px;">NAME OF EMPLOYEE</th>
                            <?php foreach ($daysArray as $day) { ?>

                                <th class="center-text" style="border-left: solid black 1px; width: 1.7%;">
                                    <?= $day ?>
                                </th>

                            <?php
                            } ?>
                            <!-- <th class="center-text" style="border-left: solid black 1px;">SC</th>
                            <th class="center-text" style="border-left: solid black 1px;">FREQ. SC</th> -->
                            <!-- <th class="center-text" style="border-left: solid black 1px;">TARD</th> -->
                            <th class="center-text" style="border-left: solid black 1px;">OVERLOAD</th>
                            <th class="center-text" style="border-left: solid black 1px;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($details['data'] as $key => $value) {
                        ?>
                            <tr style="border-bottom: solid black 1px;">
                                <td class="center-text">
                                    <b>
                                        <?= $key + 1 ?>
                                    </b>
                                </td>
                                <td class="center-text" style="border-left: solid black 1px;">
                                    <b><?= $value->Lname ?>, <?= $value->Fname ?> <?= $value->Mname ?>.</b>
                                </td>
                                <?php foreach ($daysArray as $day) { ?>
                                    <td class="center-text" style="border-left: solid black 1px;">
                                        <?php
                                        // Find the data for the specific day
                                        $dayData = [];
                                        foreach ($value->daily_ol as $dailyData) {
                                            if (isset($dailyData['day']) && (int)$dailyData['day'] == $day) {
                                                $dayData = $dailyData;
                                                break;
                                            }
                                        }

                                        if (!empty($dayData)) {
                                            // Display undertime and tardiness for the specific day
                                            echo $dayData['ol_daily'];
                                            // if($dayData['ut_daily']!=0){
                                            //     echo sprintf('%02d:%02d', floor($dayData['t_daily'] / 60), $dayData['t_daily'] % 60) . '<br>';
                                            // }
                                            // if($dayData['ut_daily']!=0){
                                            //     echo sprintf('%02d:%02d', floor($dayData['ut_daily'] / 60), $dayData['ut_daily'] % 60) . '<br>';
                                            // }

                                        } else {
                                            // If no data available for the day, display a placeholder
                                            echo '&nbsp;';
                                        }
                                        ?>
                                    </td>
                                <?php } ?>
                                <!-- <td class="center-text" style="border-left: solid black 1px;">
                                    2.503
                                </td>
                                <td class="center-text" style="border-left: solid black 1px;">
                                    0.0
                                </td>
                                <td class="center-text" style="border-left: solid black 1px;">
                                    <b>0.21</b>
                                </td> -->
                                <td class="center-text" style="border-left: solid black 1px;">
                                    <b><?= $value->ol?></b>
                                </td>
                                <td class="center-text" style="border-left: solid black 1px;">
                                    <b><?= $value->ol?></b>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-sm btn-primary">Print</button>