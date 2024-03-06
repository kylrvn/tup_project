<?php

$numberOfDaysInMonth = $details['num_of_days'];

$daysArray = range(1, $numberOfDaysInMonth);
// var_dump($details);
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
                </label>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table-black" style="width: 100%;">
                    <thead>
                        <tr style="border-bottom: solid black 1px;">
                            <th class="center-text" colspan="33">
                                For the Month of
                                <?= strtoupper($details['month_in_words']) ?> 
                                <?= $details['year']?>
                            </th>

                            <th class="center-text" style="border-left: solid black 1px;" colspan="2">
                                Leave Credits as
                                of
                                <?= date('m-d-Y') ?>
                            </th>
                            <th class="center-text" style="border-left: solid black 1px;" colspan="3">TOTAL
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
                            <th class="center-text" style="border-left: solid black 1px;">SC</th>
                            <th class="center-text" style="border-left: solid black 1px;">FREQ. SC</th>
                            <th class="center-text" style="border-left: solid black 1px;">TARD</th>
                            <th class="center-text" style="border-left: solid black 1px;">UNDERTIME</th>
                            <th class="center-text" style="border-left: solid black 1px;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: solid black 1px;">
                            <td class="center-text">
                                <b>1</b>
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                <b>ALOB, KARL MARIE P.</b>
                            </td>
                            <?php
                            foreach ($daysArray as $day) { ?>
                                <td class="center-text" style="border-left: solid black 1px;">&nbsp;</td>
                                <?php
                            } ?>
                            <td class="center-text" style="border-left: solid black 1px;">
                                2.503
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                0.0
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                <b>0.21</b>
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                <b>0.0</b>
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                <b>2.713</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-sm btn-primary">Print</button>