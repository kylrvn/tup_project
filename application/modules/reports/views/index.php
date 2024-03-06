<?php
main_header(['Reports']);
?>
<!-- ############ PAGE START-->

<head>
    <style>
        .center-text {
            text-align: center;
        }

        .table-black {
            border: 1px solid black;
        }

        .border-all-no-bottom {
            border-top: 1px solid black;
            border-left: 1px solid black;
            border-right: 1px solid black;
            display: flex;
        }

        .text-center {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin: 0;
            /* Reset margin for the paragraph */
        }
    </style>
</head>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Reports</h1>
            </div>
        </div>
    </div>
</div>

<?php
$currentMonth = date('m');
$currentYear = date('Y');
$currentMonthWords = date('F');

$numberOfDaysInMonth = date('t', mktime(0, 0, 0, $currentMonth, 1, $currentYear));

$daysArray = range(1, $numberOfDaysInMonth);
?>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-weight:550;">DTR Summary Report/Daily Attendance</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Content Here -->
            <div class="row" id="print_DTR_summary">
                <div class="col-12">
                    <div class="card" style="font-size:70%;">
                        <div class="card-header text-center border-all-no-bottom">
                        <img src="<?=base_url()?>assets/images/Logo/tuplogo.png" width="5%" height="5%">
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
                                            <?= strtoupper($currentMonthWords) ?>
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
                                        foreach($daysArray as $day){?>
                                            <td class="center-text" style="border-left: solid black 1px;">&nbsp;</td>
                                        <?php
                                        }?>
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
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-weight:550;">Report of deduction for Leave w/o pay, Tardiness and
                Undertime</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Content Here -->
        </div>
        <div class="card-footer">
            <!-- Footer -->
        </div>
    </div>
</section>



<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/dashboard/dashboard.js"></script>