<?php
$numberOfDaysInMonth = $details['num_of_days'];
// var_dump($details);
?>

<!-- Content Here -->
<div class="row" id="print_DTR_summary">
    <div class="col-12">
        <div class="card" style="font-size:70%;">
            <div class="card-header text-center">
                <!-- <img src="<?= base_url() ?>assets/images/Logo/tuplogo.png" width="5%" height="5%"> -->
                <label>
                    <b>Technological University of the Philippines Visayas</b>
                    <br>
                    City of Talisay, Negros Occidental
                    <br>
                    <br>
                    Report of Deduction for Leave w/o pay, Tardiness and Undertime
                    <br>
                    For the month of
                    <?= strtoupper($details['month_in_words']) ?>
                    <?= $details['year'] ?>
                </label>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table-black" style="width: 100%;">
                    <thead>
                        <tr style="border-bottom: solid black 1px;">
                            <th class="center-text" rowspan="2">#</th>
                            <th class="center-text" style="border-left: solid black 1px;" rowspan="2">NAME OF EMPLOYEES
                            </th>
                            <th class="center-text" style="border-left: solid black 1px;" rowspan="2">
                                <?= strtoupper($details['month']) ?>. T/U
                            </th>
                            <th class="center-text" style="border-left: solid black 1px;" colspan="2">
                                <?= $details['month_in_words'] ?> Absences
                            </th>
                        </tr>
                        <tr style="border-bottom: solid black 1px;">
                            <th class="center-text" style="border-left: solid black 1px;">Inclusive Dates</th>
                            <th class="center-text" style="border-left: solid black 1px;"># of days</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr style="border-bottom: solid black 1px;">
                            <td class="center-text">
                                <b>
                                    k
                                </b>
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                <b>
                                    namaewa
                                </b>
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                    undertimu tardu total desu
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">Inclusivo Date</td>
                            <td class="center-text" style="border-left: solid black 1px;"># of days</td>
                        </tr> -->
                        <?php
                        foreach (@$details['data'] as $key => $value) {
                            ?>
                            <tr style="border-bottom: solid black 1px;">
                                <td class="center-text">
                                    <b>
                                        <?= @$key + 1 ?>
                                    </b>
                                </td>
                                <td class="center-text" style="border-left: solid black 1px;">
                                    <b>
                                        <?= @$value->Lname ?>,
                                        <?= @$value->Fname ?>
                                        <?= @$value->Mname ?>.
                                    </b>
                                </td>
                                <td class="center-text" style="border-left: solid black 1px;">
                                    <?= sprintf('%02d:%02d', floor(@$value->utt / 60), @$value->utt % 60) ?>
                                </td>
                                <td class="center-text" style="border-left: solid black 1px;">
                                    <?php

                                    $monthDays = array(
                                        '01' => null,
                                        '02' => null,
                                        '03' => null,
                                        '04' => null,
                                        '05' => null,
                                        '06' => null,
                                        '07' => null,
                                        '08' => null,
                                        '09' => null,
                                        '10' => null,
                                        '11' => null,
                                        '12' => null
                                    );

                                    foreach ($value->dates_absent as $absent) {
                                        $parts = explode('-', $absent);
                                        $month = $parts[0];
                                        $day = $parts[1];

                                        if (!isset($monthDays[$month])) {
                                            $monthDays[$month] = array();
                                        }

                                        $monthDays[$month][] = $day;
                                    }
                                    foreach ($monthDays as $key => $month) {
                                        if ($month != null) {

                                            $dateObj = DateTime::createFromFormat('!m', $key);

                                            echo $dateObj->format('F') . ". ";

                                            $count = count($month);

                                            foreach ($month as $key => $days) {
                                                echo $days;
                                                if ($key < $count - 1) {
                                                    echo ", ";
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="center-text" style="border-left: solid black 1px;">
                                    <?= @$value->absent_count ?>
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