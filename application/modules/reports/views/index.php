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

<!-- Main content "collapsed-card" -->
<section class="content">
    <div class="card">
        <div class="card-header" style="background-color:#9F3A3B; color: white;">
            <h3 class="card-title" style="font-weight:550;">DTR Summary Report/Daily Attendance</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool expand1" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="row mt-3 mr-3 ml-3">
                <div class="col-6">
                    &nbsp;
                </div>
                <div class="col-3">
                    <h6>Select Type of Report:</h6>
                    <select class="form-control" id="report_type">
                        <option selected value="tard_undertime">Tardiness/Undertime</option>
                        <option value="overload">Overload</option>
                    </select>
                </div>
                <div class="col-3">
                    <h6>Select Month/Year:</h6>
                    <input class="form-control" type="month" id="select_month1" style="inline-block"
                        value="<?= date('Y-m') ?>">
                </div>
            </div>
        </div>
        <div class="card-body" id="load_summary">
            <!-- Content Loaded here -->
        </div>
        <div class="card-footer" style="background-color:#transparent;">
            <button class="btn btn-primary float-right">Print</button>
        </div>
        <div class="card-footer" style="background-color:#9F3A3B; color: white;">
            <!-- Footer -->
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header" style="background-color:#9F3A3B; color: white;">
            <h3 class="card-title" style="font-weight:550;">Report of deduction for Leave w/o pay, Tardiness and
                Undertime</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool expand2" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="row mt-3 mr-3 ml-3">
                <div class="col-4">
                    &nbsp;
                </div>
                <div class="col-4">
                    &nbsp;
                </div>
                <div class="col-4">
                    <h6>Select Month/Year:</h6>
                    <input class="form-control" type="month" id="select_month2" style="inline-block;"
                        value="<?= date('Y-m') ?>">
                </div>
            </div>
        </div>
        <div class="card-body" id="deduction_summary">
            <!-- Content Here -->
        </div>
        <div class="card-footer" style="background-color:#transparent;">
            <button class="btn btn-primary float-right">Print</button>
        </div>
        <div class="card-footer" style="background-color:#9F3A3B; color: white;">
            <!-- Footer -->
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header" style="background-color:#9F3A3B; color: white;">
            <h3 class="card-title" style="font-weight:550;">Civil Service Form No. 48 Daily Time Record</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool expand2" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="row mt-3 mr-3 ml-3">
                <div class="col-4">
                    &nbsp;
                </div>
                <div class="col-4">
                    <h6>Select Faculty:</h6>
                    <select class="form-control" id="selected_faculty" style="inline-block;">
                        <option value="" selected disabled>Select Faculty</option>
                        <?php
                        foreach ($faculty as $key => $value) {
                            ?>
                            <option value="<?= $value->ID ?>">
                                <?= $value->Lname ?>,
                                <?= $value->Fname ?>
                                <?= substr($value->Mname, 0, 1) ?>.
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <h6>Select Month/Year:</h6>
                    <input class="form-control" type="month" id="select_month3" style="inline-block;"
                        value="<?= date('Y-m') ?>">
                </div>
            </div>
        </div>
        <div class="card-body" id="dtr_form">
            <!-- Content Here -->
        </div>
        <div class="card-footer" style="background-color:#transparent;">
            <button class="btn btn-primary float-right">Print</button>
        </div>
        <div class="card-footer" style="background-color:#9F3A3B; color: white;">
            <!-- Footer -->
        </div>
    </div>
</section>



<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/reports/reports.js"></script>
<script>

</script>