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
                        <tr style="border-bottom: solid black 1px;">
                            <td class="center-text">
                                <b>1</b>
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                <b>ALOB, KARL MARIE P.</b>
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                2.503
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                &nbsp;
                            </td>
                            <td class="center-text" style="border-left: solid black 1px;">
                                &nbsp;
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>